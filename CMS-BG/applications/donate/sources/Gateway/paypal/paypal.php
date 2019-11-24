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
 * PayPal Gateway
 */
class _paypal extends \IPS\donate\Gateway
{	
	/**
	 * Gateway URL
	 */
	public function gatewayURL()
	{    
        return \IPS\Http\Url::external( $this->dev ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr' );   
    }
    
	/**
	 * Payment Screen
	 */
	public function paymentScreen( \IPS\Helpers\Form $form, $member, $donation, $goal=NULL )
	{
	    /* Get any gateway settings */
		$settings = json_decode( $this->settings, TRUE );  
        
        /* Set default Paypal Address */
        $form->hiddenValues['business'] = $this->email;
        
        /* Do we have goal paypal address? */
        if( $goal->emails )
        {
            $form->hiddenValues['business'] = $goal->emails;    
        }   
         
        /* Add form settings */
        $form->hiddenValues['cmd'] = '_donations';
        $form->hiddenValues['item_name'] = \IPS\Member::loggedIn()->language()->addToStack('forum_donation'); 
        $form->hiddenValues['item_number'] = \IPS\Member::loggedIn()->member_id;
        $form->hiddenValues['amount'] = $donation['amount'];
        $form->hiddenValues['custom'] = $donation['goal'];
        $form->hiddenValues['currency_code'] = $donation['currency'];
        $form->hiddenValues['quantity'] = '1';
        $form->hiddenValues['no_shipping'] = '1';
        $form->hiddenValues['rm'] = '2';
        $form->hiddenValues['notify_url'] = \IPS\Http\Url::internal( 'app=donate&do=payment&gateway='.$this->id );
        $form->hiddenValues['return'] = \IPS\Http\Url::internal( 'app=donate', 'front', 'donate' );
        $form->hiddenValues['cancel_return'] = \IPS\Http\Url::internal( 'app=donate', 'front', 'donate' ); 
        $form->hiddenValues['bn'] = 'PP-BuyNowBF';
        
        /* Add anonymous/anonymous amount options */
        if( \IPS\Settings::i()->dt_anon_donation )
        {
            $form->hiddenValues['on0'] = \IPS\Member::loggedIn()->language()->addToStack('anonymous');
            $form->add( new \IPS\Helpers\Form\Custom( 'os0', FALSE, FALSE, array( 'getHtml'	=> function( $element )
			{
                $checkboxName = preg_replace( '/^(.+?\[?.+?)(\])?$/', '$1_checkbox$2', $element->name );
                return \IPS\Theme::i()->getTemplate( 'forms', 'core', 'global' )->checkbox( $element->name, $element->value, FALSE, NULL, NULL, NULL, $checkboxName, $element->htmlId ?: preg_replace( "/[^a-zA-Z0-9\-_]/", "_", $element->name ), TRUE, NULL );
			}
            ), NULL, NULL, NULL, 'os0' ) );
        }

        if( \IPS\Settings::i()->dt_anon_donation_amount )
        {
            $form->hiddenValues['on1'] = \IPS\Member::loggedIn()->language()->addToStack('anonymous_amount');
            $form->add( new \IPS\Helpers\Form\Custom( 'os1', FALSE, FALSE, array( 'getHtml'	=> function( $element )
			{
                $checkboxName = preg_replace( '/^(.+?\[?.+?)(\])?$/', '$1_checkbox$2', $element->name );
                return \IPS\Theme::i()->getTemplate( 'forms', 'core', 'global' )->checkbox( $element->name, $element->value, FALSE, NULL, NULL, NULL, $checkboxName, $element->htmlId ?: preg_replace( "/[^a-zA-Z0-9\-_]/", "_", $element->name ), TRUE, NULL );
			}
            ), NULL, NULL, NULL, 'os1' ) );            
        }         

		return $form;
	}
    
	/**
	 * Process payment fields
	 */    
	public function process( $result=array() )
	{ 	   
	    $paymentFields = array( 'member_id'        => isset( $result['item_number'] ) ? (int) $result['item_number'] : 0,
                                'amount'           => $result['mc_gross'],
                                'currency'         => isset( $result['mc_currency'] ) ? $result['mc_currency'] : 0,
                                'goal'             => isset( $result['custom'] ) ? (int) $result['custom'] : 0,                                      
                                'status'           => $result['payment_status'] == 'Completed' ? 1 : 0,
                                'gateway_email'    => isset( $result['business'] ) ? $result['business'] : '',  
                                'gateway_receiver' => isset( $result['receiver_id'] ) ? $result['receiver_id'] : '',                                
                                'anonymous'        => isset( $result['option_selection1'] ) ? (int) $result['option_selection1'] : 0, 
                                'anonymous_amount' => isset( $result['option_selection2'] ) ? (int) $result['option_selection2'] : 0,
                                'txn_id'           => $result['txn_id'],      
                                'note'             => isset( $result['memo'] ) ? $result['memo'] : '',   
                                'fees'             => isset( $result['mc_fee'] ) ? $result['mc_fee'] : 0                                                                 
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

	    if( !$settings->dev )
        {
            $urls = array( 'full_url' => 'https://www.paypal.com/cgi-bin/webscr', 'host_url' => 'www.paypal.com', 'path_url' => '/cgi-bin/webscr' );    
        }
        else
        {
            $urls = array( 'full_url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr', 'host_url' => 'www.sandbox.paypal.com', 'path_url' => '/cgi-bin/webscr' );
        }  

		$post_back[] = 'cmd=_notify-validate';

		if( !$post_back_str )
		{
			foreach ($_POST as $key => $val)
			{
				$post_back[] = $key . '=' . urlencode ($val);
			}
			
			$post_back_str = implode('&', $post_back);
		}
        
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
    				curl_setopt( $sock, CURLOPT_TIMEOUT        , 15 );
    				curl_setopt( $sock, CURLOPT_POST           , TRUE );
    				curl_setopt( $sock, CURLOPT_POSTFIELDS     , $post_back_str );
    				curl_setopt( $sock, CURLOPT_RETURNTRANSFER , TRUE ); 
                    curl_setopt( $sock, CURLOPT_PORT		   , 80 ); 
    		
    				$result = curl_exec($sock);
    				
    				curl_close($sock);
    				
    				if ($result !== FALSE)
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
    			
    			if ( $fp = fsockopen( $urls['host_url'], 80, $errno, $errstr, 30 ) )
    			{			 
                    socket_set_timeout($fp, 30);
    				fwrite($fp, $header . $post_back_str);
    				
    				while ( ! feof($fp) )
    				{
    					$result .= fgets($fp, 1024);
    				}
    				
    				fclose($fp);
    			}
    		}            
        }
        
		if( $result == "INVALID" )
		{
			return false;
		}
		else
		{     
		    return $_POST;
		}			
	}
}