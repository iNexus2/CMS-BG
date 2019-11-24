<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\setup\upg_100001;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 3.2.0 Beta 1 Upgrade Code
 */
class _Upgrade
{
	/**
	 * Main changes
	 */
	public function step1()
	{
        /* Remove old IPB 3.4 settings */
        \IPS\Db::i()->delete( 'core_sys_conf_settings', "conf_key IN( 'dt_online', 'dt_enable_rss', 'dt_member_id', 'dt_goals_perpage', 
        'dt_bar_bg', 'dt_donations_perpage', 'dt_top_donors', 'dt_latest_donations', 'dt_include_fees', 'dt_disable_completed', 'dt_default_calc',
        'dt_points_database', 'dt_points_field' )" ); 
        
        /* Re-enable app again */
        \IPS\Db::i()->update( 'core_applications', array( 'app_enabled' => 1 ), array( 'app_directory=?', 'donate' ) ); 
        
        return TRUE;             
	}
    
	/**
	 * Column modifications
	 */
	public function step2()
	{
        /* Drop old group columns */
		\IPS\Db::i()->dropColumn( 'core_groups', array( 'g_dt_view_offline' ) );	

        \IPS\Db::i()->dropColumn( 'donate_users', array( 'member_seo_name' ) );   
               
        return TRUE;                            
	} 
    
	/**
	 * Custom lang setup
	 */
	public function step3()
	{
        /* Change app name */
        \IPS\Lang::saveCustom( 'donate', '__app_donate', 'Donations' );	   	   
       
        /* Convert goals */
		foreach( \IPS\Db::i()->select( '*', 'donate_goals' ) as $goal )
		{
			\IPS\Lang::saveCustom( 'donate', "donate_goal_{$goal['g_id']}", $goal['g_name'] );
			\IPS\Lang::saveCustom( 'donate', "donate_goal_{$goal['g_id']}_desc", $goal['g_desc'] );
		}
        
        /* Rebuild our goals */
        \IPS\Task::queue( 'core', 'RebuildNonContentPosts', array( 'extension' => 'donate_Goals' ), 3 );

        /* Drop old columns */
		\IPS\Db::i()->dropColumn( 'donate_goals', array( 'g_name', 'g_desc' ) );
        
        return TRUE;                         
	} 
    
	/**
	 * Serialize to JSON
	 */
	public function step4()
	{
        /* Convert gateways */
		foreach( \IPS\Db::i()->select( '*', 'donate_gateways' ) as $gateway )
		{
		    if( $gateway['gw_fields'] )
            {
                $save['gw_fields'] = json_encode( \unserialize( $gateway['gw_fields'] ) );                
            }
            else
            {
                $save['gw_fields'] = '';  
            }

		    if( $gateway['gw_settings'] )
            {
                $save['gw_settings'] = json_encode( \unserialize( $gateway['gw_settings'] ) );                
            }
            else
            {
                $save['gw_settings'] = '';  
            }
            
			\IPS\Db::i()->update( 'donate_gateways', $save, array( 'gw_id=?', $gateway['gw_id'] ) );
		}
        
        return TRUE;                        
	}           
}