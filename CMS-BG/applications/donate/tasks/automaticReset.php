<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\tasks;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * automaticReset Task
 */
class _automaticReset extends \IPS\Task
{
	/**
	 * Execute
	 *
	 * If ran successfully, should return anything worth logging. Only log something
	 * worth mentioning (don't log "task ran successfully"). Return NULL (actual NULL, not '' or 0) to not log (which will be most cases).
	 * If an error occurs which means the task could not finish running, throw an \IPS\Task\Exception - do not log an error as a normal log.
	 * Tasks should execute within the time of a normal HTTP request.
	 *
	 * @return	mixed	Message to log or NULL
	 * @throws	\IPS\Task\Exception
	 */
	public function execute()
	{
        $donationReset = 0;
        $goalReset     = 0;

        /* Donation auto reset */
        if( \IPS\Settings::i()->dt_donation_reset_day > 0 )
        {
    		# Can we update reset time already?   
    		if( \IPS\Settings::i()->dt_donation_reset_timeframe == 'year' && \IPS\Settings::i()->dt_donation_reset_day == date('z') )
    		{
    			$donationReset = time();			
    		}
    		else if( \IPS\Settings::i()->dt_donation_reset_timeframe == 'month' && \IPS\Settings::i()->dt_donation_reset_day == date('j') )
    		{
    			$donationReset = time();				
    		}    		
    		else if( \IPS\Settings::i()->dt_donation_reset_timeframe == 'week' && \IPS\Settings::i()->dt_donation_reset_day == date('w')+1 )
    		{
    			$donationReset = time();				
    		}
            
            /* Reset date now */
            if( $donationReset )
            {
        		\IPS\Db::i()->update( 'core_sys_conf_settings', array( 'conf_value' => $donationReset ), array( 'conf_key=?', 'dt_donation_reset' ) );
        		unset( \IPS\Data\Store::i()->settings ); 
                
                /* Rebuild active goals */
                \IPS\donate\Goal::rebuildActiveGoals();                                           
            }
        }       

        /* Goal auto reset */
        /*if( \IPS\Settings::i()->dt_goal_reset_day > 0 )
        {
    		# Can we update reset time already?   
    		if( \IPS\Settings::i()->dt_goal_reset_timeframe == 'year' && \IPS\Settings::i()->dt_goal_reset_day == date('z') )
    		{
    			$goalReset = time();			
    		}
    		else if( \IPS\Settings::i()->dt_goal_reset_timeframe == 'month' && \IPS\Settings::i()->dt_goal_reset_day == date('j') )
    		{
    			$goalReset = time();				
    		}    		
    		else if( \IPS\Settings::i()->dt_goal_reset_timeframe == 'week' && \IPS\Settings::i()->dt_goal_reset_day == date('w')+1 )
    		{
    			$goalReset = time();				
    		}
            
            if( $goalReset )
            {
        		\IPS\Db::i()->update( 'core_sys_conf_settings', array( 'conf_value' => $goalReset ), array( 'conf_key=?', 'dt_goal_reset' ) );
        		unset( \IPS\Data\Store::i()->settings );                           
            }
        }*/	   
       
		return NULL;
	}
	
	/**
	 * Cleanup
	 *
	 * If your task takes longer than 15 minutes to run, this method
	 * will be called before execute(). Use it to clean up anything which
	 * may not have been done
	 *
	 * @return	void
	 */
	public function cleanup()
	{
		
	}
}