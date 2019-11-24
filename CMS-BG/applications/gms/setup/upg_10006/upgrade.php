<?php
/**
 * @package		Messages
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
namespace IPS\gms\setup\upg_10006;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 2.1.2 Upgrade Code
 */
class _Upgrade
{
	public function step1()
	{
		\IPS\core\Setup\Upgrade::runLegacySql( 'gms', 10006 );
		
		return TRUE;
	}
}