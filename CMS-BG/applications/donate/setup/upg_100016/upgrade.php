<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\setup\upg_100016;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 3.2.13 Upgrade Code
 */
class _Upgrade
{
	/**
	 * Rebuild active goals
	 */
	public function step1()
	{
   	    /* Rebuild all goals */
        foreach( \IPS\donate\Goal::roots( NULL, NULL, array( 'g_show=1' ) ) as $goal )
        {
            $goalName = $goal->_title;
            \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $goalName );
            
            /* Rebuild seo name and stats */
            $goal->seo_name = \IPS\Http\Url::seoTitle( $goalName );
            $goal->rebuildGoalStats();
        }
        
        return TRUE;                         
	}
    
	/**
	 * Rebuild inactive goals
	 */
	public function step2()
	{
   	    /* Rebuild all goals */
        foreach( \IPS\donate\Goal::roots( NULL, NULL, array( 'g_show=0' ) ) as $goal )
        {
            $goalName = $goal->_title;
            \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $goalName );
            
            /* Rebuild seo name and stats */
            $goal->seo_name = \IPS\Http\Url::seoTitle( $goalName );
            $goal->rebuildGoalStats();
        }
        
        return TRUE;                         
	}    
}