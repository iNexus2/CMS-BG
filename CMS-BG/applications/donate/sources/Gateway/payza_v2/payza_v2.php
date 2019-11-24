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
 * Payza v2 Gateway
 */
class _payza_v2 extends \IPS\donate\Gateway
{	
	/**
	 * Gateway URL
	 */
	public function gatewayURL()
	{    
        return \IPS\Http\Url::external( $this->dev ? 'https://sandbox.Payza.com/sandbox/payprocess.aspx' : 'https://secure.payza.com/checkout' );   
    }
    
	/**
	 * Payment Screen
	 */
	public function paymentScreen( \IPS\Helpers\Form $form, $member, $donation )
	{
	    /* Get any gateway settings */
		$settings = json_decode( $this->settings, TRUE );  

        /* Add form settings */
        $form->hiddenValues['ap_merchant'] = $this->email;
        $form->hiddenValues['ap_itemname'] = \IPS\Member::loggedIn()->language()->addToStack('forum_donation'); 
        $form->hiddenValues['ap_itemcode'] = \IPS\Member::loggedIn()->member_id;
        $form->hiddenValues['ap_amount'] = $donation['amount'];
        $form->hiddenValues['apc_1'] = $donation['goal'];
        $form->hiddenValues['ap_currency'] = $donation['currency'];
        $form->hiddenValues['ap_ipnversion'] = '2';
        $form->hiddenValues['ap_purchasetype'] = 'item';
        $form->hiddenValues['ap_quantity'] = '1';                
        $form->hiddenValues['ap_alerturl'] = \IPS\Http\Url::internal( 'app=donate&do=payment&gateway='.$this->id );
        $form->hiddenValues['ap_returnurl'] = \IPS\Http\Url::internal( 'app=donate', 'front', 'donate' );
        $form->hiddenValues['ap_cancelurl'] = \IPS\Http\Url::internal( 'app=donate', 'front', 'donate' ); 

        /* Add anonymous/anonymous amount options */
        if( \IPS\Settings::i()->dt_anon_donation )
        {
            $form->add( new \IPS\Helpers\Form\YesNo( 'apc_2', FALSE, FALSE, array(), NULL, NULL, NULL, 'apc_2' ) );
        }
        if( \IPS\Settings::i()->dt_anon_donation_amount )
        {
            $form->add( new \IPS\Helpers\Form\YesNo( 'apc_3', FALSE, FALSE, array(), NULL, NULL, NULL, 'apc_3' ) );
        }        

		return $form;
	}
    
	/**
	 * Process payment fields
	 */    
	public function process( $result=array() )
	{ 	 
	    $paymentFields = array( 'member_id'        => isset( $result['ap_itemcode'] ) ? (int) $result['ap_itemcode'] : 0,
                                'amount'           => isset( $result['ap_amount'] ) ? $result['ap_amount'] : 0,
                                'currency'         => isset( $result['ap_currency'] ) ? $result['ap_currency'] : 0,
                                'goal'             => isset( $result['apc_1'] ) ? (int) $result['apc_1'] : 0,                                      
                                'status'           => $result['ap_status'] == 'Success' ? 1 : 0,
                                'gateway_email'    => isset( $result['ap_merchant'] ) ? $result['ap_merchant'] : '',
                                'gateway_receiver' => isset( $result['ap_merchant'] ) ? $result['ap_merchant'] : '',                                
                                'anonymous'        => isset( $result['apc_2'] ) ? (int) $result['apc_2'] : 0, 
                                'anonymous_amount' => isset( $result['apc_3'] ) ? (int) $result['apc_3'] : 0,
                                'txn_id'           => $result['ap_referencenumber'],      
                                'note'             => '',   
                                'fees'             => isset( $result['ap_feeamount'] ) ? $result['ap_feeamount'] : 0,                                                                 
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

	    if( $this->dev )
        {
            $urls = array( 'full_url' => 'https://sandbox.Payza.com/sandbox/IPN2.ashx', 'host_url' => 'www.sandbox.Payza.com', 'path_url' => '/sandbox/IPN2.ashx' );    
        }
        else
        {
            $urls = array( 'full_url' => 'https://secure.payza.com/ipn2.ashx', 'host_url' => 'www.secure.payza.com', 'path_url' => '/ipn2.ashx' ); 
        }  
        
        $port = 80;
        
        # Setup Payzas token        
        $post_back['token'] = urlencode( $_POST['token'] );
		$post_back_str = implode('&', $post_back);	
        
        # Lets ease into the new function.
        $use_new_poster = 0;
        
        if( $use_new_poster )
        {               
        }
        else
        {
    		if ( function_exists("curl_init") AND function_exists("curl_exec") )
    		{
    			if ( $sock = curl_init() )
    			{
    				curl_setopt( $sock, CURLOPT_URL            , $urls['full_url'] );
    				curl_setopt( $sock, CURLOPT_TIMEOUT        , 30 );
    				curl_setopt( $sock, CURLOPT_POST           , TRUE );
    				curl_setopt( $sock, CURLOPT_POSTFIELDS     , $post_back_str );
    				curl_setopt( $sock, CURLOPT_RETURNTRANSFER , TRUE ); 
                    curl_setopt( $sock, CURLOPT_PORT		   , $port ); 
    		
    				$response = curl_exec($sock);
    				
    				curl_close($sock);
    				
    				if ($response !== FALSE)
    				{
    					$curl_used = 1;
    				}
    			}
    		}		
    
    		if ( ! $curl_used )
    		{
    			$header  = "POST {$urls['path_url']} HTTP/1.0\r\n";
    			$header .= "Host: {$urls['host_url']}\r\n";
    			$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    			$header .= "Content-Length: " . strlen($post_back_str) . "\r\n\r\n";			
    			
    			if ( $fp = fsockopen( $urls['host_url'], $port, $errno, $errstr, 30 ) )
    			{			 
                    socket_set_timeout($fp, 30);
    				fwrite($fp, $header . $post_back_str);
    				
    				while ( ! feof($fp) )
    				{
    					$response .= fgets($fp, 1024);
    				}
    				
    				fclose($fp);
    			}
    		}            
        }
        
		if( strlen($response) > 0 )
		{
			if( urldecode($response) == "INVALID TOKEN" )
			{
                return false;
			}
			else
			{
                $response = urldecode($response);
                $response = explode( "&", $response );
                
                foreach( $response as $ap )
                {
                	$ele = explode("=", $ap);
                	$result[$ele[0]] = $ele[1];	
                }
                
                return $result;
			}
	
		}			
	}
}