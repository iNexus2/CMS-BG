<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\extensions\core\Uninstall;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Uninstall callback
 */
class _Donate
{
	/**
	 * Code to execute before the application has been uninstalled
	 *
	 * @param	string	$application	Application directory
	 * @return	array
	 */
	public function preUninstall( $application )
	{
	}

	/**
	 * Code to execute after the application has been uninstalled
	 *
	 * @param	string	$application	Application directory
	 * @return	array
	 */
	public function postUninstall( $application )
	{
	    /* Setup list of our permissions */
	    $ourPermissions = array( 'g_dt_view', 'g_dt_donate', 'g_dt_view_goals', 'g_dt_view_donations' );
        
        /* Go through and delete */                      
        foreach( $ourPermissions as $perm )
        {
            if( \IPS\Db::i()->checkForColumn( 'core_groups', $perm ) )
            {
                \IPS\Db::i()->dropColumn( 'core_groups', array( $perm ) );    
            }            
        }	   
	}
}