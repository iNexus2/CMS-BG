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
 * Skrill Gateway
 */
class _skrill extends \IPS\donate\Gateway
{	
	/**
	 * Gateway URL
	 */
	public function gatewayURL()
	{    
        return \IPS\Http\Url::external( $this->dev ? 'http://www.moneybookers.com/app/test_payment.pl' : 'https://www.moneybookers.com/app/payment.pl' );   
    }
    
	/**
	 * Payment Screen
	 */
	public function paymentScreen( \IPS\Helpers\Form $form, $member, $donation )
	{
	    /* Get any gateway settings */
		$settings = json_decode( $this->settings, TRUE );  

        /* Add form settings */
        $form->hiddenValues['pay_to_email'] = $this->email;
        $form->hiddenValues['detail1_description'] = \IPS\Member::loggedIn()->language()->addToStack('forum_donation'); 
        $form->hiddenValues['detail1_text'] = \IPS\Member::loggedIn()->member_id;
        $form->hiddenValues['amount'] = $donation['amount'];
        $form->hiddenValues['detail4_text'] = $donation['goal'];
        $form->hiddenValues['currency'] = $donation['currency'];
        $form->hiddenValues['language'] = 'EN';
        $form->hiddenValues['status_url'] = \IPS\Http\Url::internal( 'app=donate&do=payment&gateway='.$this->id );
        $form->hiddenValues['return_url'] = \IPS\Http\Url::internal( 'app=donate', 'front', 'donate' );
        $form->hiddenValues['cancel_url'] = \IPS\Http\Url::internal( 'app=donate', 'front', 'donate' ); 

        /* Add anonymous/anonymous amount options */
        if( \IPS\Settings::i()->dt_anon_donation )
        {
            $form->hiddenValues['detail2_description'] = \IPS\Member::loggedIn()->language()->addToStack('anonymous');
            $form->add( new \IPS\Helpers\Form\YesNo( 'detail2_text', FALSE, FALSE, array(), NULL, NULL, NULL, 'detail2_text' ) );
        }
        if( \IPS\Settings::i()->dt_anon_donation_amount )
        {
            $form->hiddenValues['detail3_description'] = \IPS\Member::loggedIn()->language()->addToStack('anonymous_amount');
            $form->add( new \IPS\Helpers\Form\YesNo( 'detail3_text', FALSE, FALSE, array(), NULL, NULL, NULL, 'detail3_text' ) );
        }        

		return $form;
	}
    
	/**
	 * Process payment fields
	 */    
	public function process( $result=array() )
	{ 	   
	    $paymentFields = array( 'member_id'        => isset( $result['detail1_text'] ) ? (int) $result['detail1_text'] : 0,
                                'amount'           => $result['mb_amount'],
                                'currency'         => isset( $result['mb_currency'] ) ? $result['mb_currency'] : 0,
                                'goal'             => isset( $result['detail4_text'] ) ? (int) $result['detail4_text'] : 0,                                      
                                'status'           => $result['status'] == 2 ? 1 : 0,
                                'gateway_email'    => isset( $result['pay_to_email'] ) ? $result['pay_to_email'] : '',  
                                'gateway_receiver' => isset( $result['pay_to_email'] ) ? $result['pay_to_email'] : '',                              
                                'anonymous'        => isset( $result['detail2_text'] ) ? (int) $result['detail2_text'] : 0, 
                                'anonymous_amount' => isset( $result['detail2_text'] ) ? (int) $result['detail2_text'] : 0,
                                'txn_id'           => $result['transaction_id'],      
                                'note'             => '',   
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
		$settings = json_decode( $this->settings );

        # Combine our fields for validation
        $concatFields = $_POST['merchant_id'].$_POST['transaction_id'].strtoupper( md5( $gatewaySettings['secret_word'] ) ).$_POST['mb_amount'].$_POST['mb_currency'].$_POST['status'];

        # Validate our fields and secret word.
        if( strtoupper( md5( $concatFields ) ) == $_POST['md5sig'] )
        {
            return $_POST;
        }
        else
        {
            return false;
        }			
	}
}