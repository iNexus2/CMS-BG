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
 * index
 */
class _index extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 */
	public function execute()
	{
		parent::execute();

		/* Latest goals RSS feed link */
		if( \IPS\Settings::i()->dt_enable_goal_rss AND \IPS\Member::loggedIn()->group['g_dt_view_goals'] )
		{
			\IPS\Output::i()->rssFeeds[ 'latest_goals_rss' ] = \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&do=goalsRSS', 'front', 'donate_goals_rss' );
		} 
        
		/* Latest donations RSS feed link */
		if( \IPS\Settings::i()->dt_enable_donation_rss AND \IPS\Member::loggedIn()->group['g_dt_view_donations'] )
		{
			\IPS\Output::i()->rssFeeds[ 'latest_donations_rss' ] = \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&do=donationsRSS', 'front', 'donate_donations_rss' );
		}              
        
		/* You must purchase copyright removal before removing */
        if( !\IPS\Settings::i()->devfuse_copy_num && !\IPS\Request::i()->isAjax() )
        {
            \IPS\Output::i()->output .= "<div style='clear:both;text-align:center;position:absolute;bottom:15px;width:95%;'><a href='http://www.devfuse.com/' class='ipsType_light ipsType_smaller'>IP.Board Donations by DevFuse</a></div>";    
        }        
	}

	/**
	 * Overview page
	 */
	protected function manage()
	{	   
        $where[] = array( 'status=?', 1 );
        
        /* Automatic reset? */
        if( \IPS\Settings::i()->dt_donation_reset )
        {
            $where[] = array( 'date>?', (int) \IPS\Settings::i()->dt_donation_reset );    
        }
        
        /* Get donations */
        $donations = array(); 
        
		foreach( \IPS\Db::i()->select( '*' ,'donate_users', $where, 'date DESC', 5 ) as $donation )
		{
            $donations[] = \IPS\donate\Donation::constructFromData( $donation );
		}    
        
		/* Set Online Location */
		$permissions = \IPS\Dispatcher::i()->module->permissions();
		\IPS\Session::i()->setLocation( \IPS\Http\Url::internal( 'app=donate&module=donate&controller=index', 'front', 'donate' ), explode( ',', $permissions['perm_view'] ), 'loc_donate_index' );                         	   
       
		/* Display */
		\IPS\Output::i()->title	= \IPS\Member::loggedIn()->language()->addToStack('__app_donate');
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'browse' )->index( $donations );
	}
    
	/**
	 * Incoming Payment
	 *
	 * @return	void
	 */
	protected function payment()
	{    
	  	# Need data to process
		if( empty( $_POST ) && empty( $_GET ) )
		{
     		$this->_logError( 'donationlog__emptypost', 'donationlog__emptypost_desc' );		  
		}    

        /* Get gateway details */
		try
		{
			$gateway = \IPS\donate\Gateway::load( \IPS\Request::i()->gateway ); 
		}
		catch( \Exception $e )
        {
            $this->_logError( 'donationlog__gateway', $e );
		}       
        
        /* Process donation */
		try
		{
			$donation = $gateway->auth( $_POST );
		}
		catch( \Exception $e )
        {
			$this->_logError( 'donationlog__auth', $e );
		}        
		try
		{
            $donation = $gateway->process( $donation );
		}
		catch( \Exception $e )
        {
			$this->_logError( 'donationlog__process', $e );
		}
        
        /* Get member details if member */
        $member = NULL;
        
        if( isset( $donation['member_id'] ) AND $donation['member_id'] )
        {        
    		try
    		{
    			$member = \IPS\Member::load( $donation['member_id'] );
    		}
			catch ( \OutOfRangeException $e ) 
            {
                $this->_logError( 'donationlog__member', $e );
			}                        
        }         
        
        /* Get goal details */
        if( isset( $donation['goal'] ) AND $donation['goal'] )
        {        
    		try
    		{
    			$goal = \IPS\donate\Goal::load( $donation['goal'] );
    		}
			catch ( \OutOfRangeException $e ) 
            {
                $this->_logError( 'donationlog__goal', $e, $member );
			} 
        }        
        
        /* Check againgst goal email */
        if( $goal->emails )
        {
            if( mb_strtolower( $donation['gateway_email'] ) != mb_strtolower( trim( $goal->emails ) ) && mb_strtolower( $donation['gateway_receiver'] ) != mb_strtolower( trim( $goal->emails ) ) )
            {
    			$this->_logError( 'donationlog__goalemail_mismatch', 'donationlog__goalemail_mismatch_desc', $member );            
            }            
        }
        else
        {
            if( $gateway->emails ) 
            {
                $gatewayEmails = json_decode( $gateway->emails, TRUE );    
                
                foreach( $gatewayEmails as $address )
                {
                    $emailMatches[ $address['value'] ] = mb_strtolower( $address['value'] );         
                } 
    
                /* Check extra emails are valid */
                if( !in_array( mb_strtolower( $donation['gateway_email'] ), $emailMatches ) && !in_array( mb_strtolower( $donation['gateway_receiver'] ), $emailMatches ) )
                {
        			$this->_logError( 'donationlog__gateway_mismatch', 'donationlog__gateway_mismatch_desc', $member );            
                }                
            }
            else
            {
                /* Check default gateway address or id matches */
                if( mb_strtolower( $donation['gateway_email'] ) != mb_strtolower( trim( $gateway->email ) ) && mb_strtolower( $donation['gateway_receiver'] ) != mb_strtolower( trim( $gateway->email ) ) )
                {
        			$this->_logError( 'donationlog__gateway_mismatch', 'donationlog__gateway_mismatch_desc', $member );            
                }            
            }            
        }

        /* Check for duplicate txn id */
        $existingDonation = \IPS\Db::i()->select( 'txn_id', 'donate_users', array( array( 'txn_id=?', $donation['txn_id'] ) ) )->count();
        
        if( $existingDonation )
        {
			$this->_logError( 'donationlog__txn', 'donationlog__txn_desc', $member );     
        }

        /* Get curreny details */
        if( isset( $donation['currency'] ) AND $donation['currency'] )
        {
			try
			{
			    $currency = \IPS\donate\Currency::load( $donation['currency'], 'c_tag' );
			}
			catch ( \OutOfRangeException $e ) 
            {
                $this->_logError( 'donationlog__currency', $e, $member );
			}             
        }
        
        /* Save donation to database */ 
		try
		{
    		$save = new \IPS\donate\Donation;
    		$save->status	   = (int) $donation['status'];
    		$save->member_id   = (int) $member->member_id;
            $save->member_name = $member->name ? $member->name : 'Guest';
            $save->txn_id	   = $donation['txn_id'];
    		$save->date	       = time();
    		$save->amount	   = $donation['amount'];
    		$save->fees	       = $donation['fees'];
    		$save->currency	   = isset( $currency ) ? $currency->_id : 0;
            $save->rate	       = isset( $currency ) ? $currency->rate : 1;
    		$save->goal	       = isset( $goal ) ? $goal->_id : 0;
    		$save->note	       = ( isset( $donation['note'] ) AND $donation['note'] ) ? $donation['note'] : '';  
    		$save->anon	       = (int) $donation['anonymous'];  
    		$save->anon_amount = (int) $donation['anonymous_amount'];                                                     
    		$save->save();
            
            /* Log non error */
     		$log = new \IPS\donate\Donation\Log;
    		$log->problem = \IPS\Member::loggedIn()->language()->get( 'donationlog__success' );
            
            /* Make donor log author */
            if( isset( $member ) AND $member )
            {
        	    $log->author_id   = (int) $member->member_id;
                $log->author_name = $member->name;  
            }      
                                                                     
    		$log->save();            
            
            /* Build goal stats */
            if( isset( $goal ) )
            {
                $goal->rebuildGoalStats();   
            }            
		}
		catch ( \Exception $e ) 
        {
            $this->_logError( 'donationlog__donation', $e, $member );
		}        

        /* Run a few more member tasks */
        if( isset( $member ) AND $member )
        {
            /* Promote group if donation approved */
            if( $donation['status'] )
            {
        		try
        		{
                    \IPS\donate\Reward::issue( $donation['amount'], $member );
        		}
        		catch ( \Exception $e ) 
                {
                    $this->_logError( 'donationlog__success', $e, $member );
        		}                
            }
            
            /* Update donor count */
    		try
    		{
	            /* Increase if approved donation */
    		    if( $donation['status'] )
                {
                    $member->donate_donations = $member->donate_donations + 1;
                    $member->donate_amount    = $member->donate_amount + $donation['amount'];
                    $member->save();                    
                }
    		}
    		catch( \Exception $e )
            {
                $this->_logError( 'donationlog__member', $e, $member ); 
    		}                         
        }
        
        /* Show offline donors message */
        if( $gateway->file == 'offline' )
        {
            return \IPS\Output::i()->output = \IPS\Theme::i()->getTemplate('payment')->paymentMessage();          
        }        

        exit();
    }
    
	/**
	 * Log Payment Error
	 */
	protected function _logError( $problem=NULL, $error=NULL, $member=NULL )
	{ 
	    /* Get lang strings for errors */
		if( \IPS\Member::loggedIn()->language()->checkKeyExists( $problem ) )
		{
			$problem = \IPS\Member::loggedIn()->language()->get( $problem );
		}	   

		if( !preg_match( '/[^A-Za-z0-9_]/', $error ) && \IPS\Member::loggedIn()->language()->checkKeyExists( $error ) )
		{
			$error = \IPS\Member::loggedIn()->language()->get( $error );
		}
        
        /* Log error */
 		$log = new \IPS\donate\Donation\Log;
		$log->problem   = $problem;         
		$log->post_data = $error;  
        
        /* Use donor member details if present */
        if( $member )
        {
            $log->author_id   = (int) $member->member_id;
            $log->author_name = $member->name;
            $log->ip_address  = $member->ip_address;
        }
                                                        
		$log->save();
        
        /* Display error */
        print $problem;
        exit();
    }           	   
}