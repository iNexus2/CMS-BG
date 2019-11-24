<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\modules\front\donate;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * payment
 */
class _payment extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{	
		parent::execute();
        
	    /* Can donate? */
        if( !\IPS\Member::loggedIn()->group['g_dt_donate'] )	
        {
            \IPS\Output::i()->error( 'donate_error', '', 403, '' );    
        }        

		/* You must purchase copyright removal before removing */
        if( !\IPS\Settings::i()->devfuse_copy_num && !\IPS\Request::i()->isAjax() )
        {
            \IPS\Output::i()->output .= "<div style='clear:both;text-align:center;position:absolute;bottom:15px;width:95%;'><a href='http://www.devfuse.com/' class='ipsType_light ipsType_smaller'>IP.Board Donations by DevFuse</a></div>";    
        }        
	}

	/**
	 * Payment Screen
	 *
	 * @return	void
	 */
	protected function manage()
	{
	    /* Set up the step array */
		$steps = array();
        		
        /* Setup first basic step */		
		$steps['setup'] = function( $data )
		{
      		/* Basic form */
    		$form = new \IPS\Helpers\Form( 'basic', 'continue' );
    		$form->class = ' ipsForm_fullWidth ipsPad';

            /* Amount select or enter */
            if( \IPS\Settings::i()->dt_amounts )
            {
                $form->add( new \IPS\Helpers\Form\Select( 'amount', NULL, TRUE, array( 'options' => array_combine( explode( ',', \IPS\Settings::i()->dt_amounts ), explode( ',', \IPS\Settings::i()->dt_amounts ) ) ) ) );        
            }
            else
            {
                $form->add( new \IPS\Helpers\Form\Text( 'amount', NULL, TRUE, array( 'placeholder' => \IPS\Member::loggedIn()->language()->addToStack('enter_amount') ) ) );  
            }
            
            /* Build currency list */
    		foreach( \IPS\donate\Currency::roots() as $currency )
    		{
    		    /* Save first currency if only one */
    		    $firstCurrency = $currency->tag;
                
                /* Add to list */
    			$currenyOptions[ $currency->tag ] = $currency->_title;
    		}   

            /* No point giving list if only 1 currency shown */
            if( count( $currenyOptions ) > 1 )
            {
                $form->add( new \IPS\Helpers\Form\Select( 'currency', TRUE, TRUE, array( 'options' => $currenyOptions ) ) );            
            }  
            else
            {
                $form->hiddenValues['currency'] = $firstCurrency;
            }
            
            /* Build goal list */
            $goalOptions = array();
            
    		foreach( \IPS\donate\Goal::roots( NULL, NULL, array( array( 'g_show=1' ) ) ) as $goal )
    		{
    			$goalOptions[ $goal->id ] = $goal->_title;
    		}             
            
            /* Add goal select */
            if( count( $goalOptions ) )
            {
                $form->add( new \IPS\Helpers\Form\Select( 'goal', NULL, FALSE, array( 'options' => $goalOptions ) ) );             
            }  
            else
            {
                $form->hiddenValues['goal'] = 0;
            }            
            
            /* Build gateway list */
            $gatewayOptions = array();
            
    		foreach( \IPS\donate\Gateway::roots( NULL, NULL, array( 'gw_active=1' ) ) as $goal )
    		{
    			$gatewayOptions[ $goal->id ] = $goal->name;
    		} 
            
            /* We need at least 1 gateway to continue */
            if( !count( $gatewayOptions ) )
            {                  
                \IPS\Output::i()->error( 'gateways_required', '', 403, 'gateways_required_admin' );
            }                        
            
            /* Add goal select */
            $form->add( new \IPS\Helpers\Form\Select( 'gateway', NULL, TRUE, array( 'options' => $gatewayOptions ) ) );            

			if( $values = $form->values() )
			{
			    /* Format amount vlue */
			    $values['amount'] = new \IPS\donate\Currency\Money( $values['amount'], '' );
                $values['amount'] = (string) $values['amount'];
                
                /* Require minimum amount */
                if( $values['amount'] < \IPS\Settings::i()->dt_min_donation )
                {
                    $form->error = \IPS\Member::loggedIn()->language()->addToStack( 'minimum_amount_required', FALSE, array( 'sprintf' => array( new \IPS\donate\Currency\Money( \IPS\Settings::i()->dt_min_donation, '' ) ) ) );
                }                           
             
			    /* Check required fields */
                if( !$values['amount'] )
                {
                    $form->error = \IPS\Member::loggedIn()->language()->addToStack( 'amount_required' );
                } 
                if( !$values['currency'] )
                {
                    $form->error = \IPS\Member::loggedIn()->language()->addToStack( 'currency_required' );
                } 
                if( !$values['gateway'] )
                {
                    $form->error = \IPS\Member::loggedIn()->language()->addToStack( 'gateway_required' );
                }
                           
                /* Any form errors? */
                if( isset( $form->error ) AND $form->error )
                {
                    return $form;   
                }

				return $values;
			}            
			
            return \IPS\Output::i()->output = $form;
		};
		
        /* Now lets get more info */
		$steps['payment_screen'] = function ( $data )
		{
		    /* Get payment gateway */
            $gateway = \IPS\donate\Gateway::load( $data['gateway'] );
            
            /* Setup payment form */
    		$form = new \IPS\Helpers\Form( 'donation', ( $gateway->gatewayURL() !== NULL ) ? 'pay_now' : '', $gateway->gatewayURL() );
    		$form->class = 'ipsForm_fullWidth ipsPad';    
            $form->ajaxOutput = FALSE;      
        
            /* Add donation amount */
            $form->addDummy( 'donation_amount', new \IPS\donate\Currency\Money( $data['amount'], $data['currency'] ) );
            
            /* Add goal details */
            if( isset( $data['goal'] ) AND $data['goal'] )
            {
                $goal = \IPS\donate\Goal::load( $data['goal'] );
                $form->addDummy( 'donation_goal', $goal->_title );   
            }           
        
            /* Add gateway summary */
            if( $gateway->summary )
            {
                $form->addDummy( $gateway->name, $gateway->summary );          
            } 
            
            /* Add Recipient Options */
            if( $gateway->emails )
            {
                $recipientEmails = json_decode( $gateway->emails );
                $emailOptions = array();
                
                foreach( $recipientEmails as $recipient )
                {
                    $emailOptions[ $recipient->value ] = $recipient->key;
                }
                
                $form->add( new \IPS\Helpers\Form\Select( 'business', FALSE, FALSE, array( 'options' => $emailOptions ), NULL, NULL, NULL, 'business' ) );             
            }            

            /* Print payment screen */            
            return \IPS\Output::i()->output = $gateway->paymentScreen( $form, array(), $data, $goal );  
		};
        
		/* Display */
		\IPS\Output::i()->sidebar['enabled'] = FALSE;
		\IPS\Output::i()->bodyClasses[] = 'ipsLayout_minimal';        
		\IPS\Output::i()->title	= \IPS\Member::loggedIn()->language()->addToStack('make_donation');
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate('payment')->paymentWrapper( (string) new \IPS\Helpers\Wizard( $steps, \IPS\Http\Url::internal( "app=donate&module=donate&controller=payment", 'front', 'donate_donate' ), TRUE ) );    
	}
}