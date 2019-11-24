<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
namespace IPS\donate\Gateway;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Offline Gateway
 */
class _offline extends \IPS\donate\Gateway
{
	/**
	 * Gateway URL
	 */
	public function gatewayURL()
	{    
        return \IPS\Http\Url::internal( 'app=donate&do=payment&gateway=' )->setQueryString( array( 'gateway' => $this->id ) );   
    }
    
	/**
	 * Payment Screen
	 */
	public function paymentScreen( \IPS\Helpers\Form $form, $member, $donation )
	{
	    /* Get any gateway settings */
		$settings = json_decode( $this->settings, TRUE );     
         
        /* Add form settings */
        $form->hiddenValues['item_name'] = \IPS\Member::loggedIn()->language()->addToStack('forum_donation'); 
        $form->hiddenValues['member_id'] = \IPS\Member::loggedIn()->member_id;
        $form->hiddenValues['amount']    = $donation['amount'];
        $form->hiddenValues['goal']      = $donation['goal'];
        $form->hiddenValues['txn_id']    = time();
        $form->hiddenValues['currency']  = $donation['currency'];
        
        /* Add note for offline donation */
        $form->add( new \IPS\Helpers\Form\TextArea( 'note', FALSE, FALSE, array( 'maxLength' => 255, 'placeholder' => \IPS\Member::loggedIn()->language()->addToStack('note_placeholder') ), NULL, NULL, NULL, 'note' ) );       
        
        /* Add anonymous/anonymous amount options */
        if( \IPS\Settings::i()->dt_anon_donation )
        {
            $form->add( new \IPS\Helpers\Form\YesNo( 'anonymous', FALSE, FALSE, array(), NULL, NULL, NULL, 'anonymous' ) );
        }
        if( \IPS\Settings::i()->dt_anon_donation_amount )
        {
            $form->add( new \IPS\Helpers\Form\YesNo( 'anonymous_amount', FALSE, FALSE, array(), NULL, NULL, NULL, 'anonymous_amount' ) );
        }        

		return $form;
	}

	/**
	 * Process payment fields
	 */    
	public function process( $result=array() )
	{ 
	    $paymentFields = array( 'member_id'        => isset( $result['member_id'] ) ? (int) $result['member_id'] : 0,
                                'amount'           => $result['amount'],
                                'currency'         => isset( $result['currency'] ) ? $result['currency'] : 0,
                                'goal'             => isset( $result['goal'] ) ? (int) $result['goal'] : 0,                                      
                                'status'           => 0,
                                'gateway_email'    => isset( $result['gateway_email'] ) ? $result['gateway_email'] : '',    
                                'gateway_receiver' => isset( $result['gateway_email'] ) ? $result['gateway_email'] : '',                            
                                'anonymous'        => isset( $result['anonymous_checkbox'] ) ? (int) $result['anonymous_checkbox'] : 0, 
                                'anonymous_amount' => isset( $result['anonymous_amount_checkbox'] ) ? (int) $result['anonymous_amount_checkbox'] : 0,
                                'txn_id'           => $result['txn_id'],      
                                'note'             => isset( $result['note'] ) ? $result['note'] : '',   
                                'fees'             => 0                                                                  
                              );
       
        return $paymentFields;	   
    }    
	
	/**
	 * Authorize Payment
	 */
	public function auth( $donation )
	{
	    /* Get any gateway settings */
		$settings = json_decode( $this->settings, TRUE );
	
        /* Return straight donation */
        return $donation;			
	}
}