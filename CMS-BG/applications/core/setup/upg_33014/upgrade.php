<?php
/**
 * @brief		Upgrade steps
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		3 Jun 2014
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\core\setup\upg_33014;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Upgrade steps
 */
class _Upgrade
{
	/**
	 * Step 1
	 *
	 * @return	array	If returns TRUE, upgrader will proceed to next step. If it returns any other value, it will set this as the value of the 'extra' GET parameter and rerun this step (useful for loops)
	 */
	public function step1()
	{
		\IPS\Db::i()->delete( 'core_sys_conf_settings', "conf_key IN( 'topic_marking_noquery', 'live_search_disable' )" );
		unset( \IPS\Data\Store::i()->settings );
		
		\IPS\Db::i()->addIndex( 'core_hooks', array(
			'type'			=> 'key',
			'name'			=> 'hook_enabled',
			'columns'		=> array( 'hook_enabled', 'hook_position' )
		) );
		\IPS\Db::i()->addIndex( 'core_hooks', array(
			'type'			=> 'key',
			'name'			=> 'hook_key',
			'columns'		=> array( 'hook_key' )
		) );

		/* Finish */
		return TRUE;
	}
}