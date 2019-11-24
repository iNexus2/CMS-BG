<?php
/**
 * @brief		Profile-sync Task
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		21 Jun 2013
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\core\tasks;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Profile-sync Task
 */
class _profilesync extends \IPS\Task
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		$services = \IPS\core\ProfileSync\ProfileSyncAbstract::services();
		if ( !empty( $services ) )
		{
			$where = array( 'profilesync IS NOT NULL' );

			/* Exclude banned users */
			$where[] = array( 'temp_ban=?', 0 );

			foreach ( \IPS\Db::i()->select( '*', 'core_members', $where, 'profilesync_lastsync ASC', 25 ) as $row )
			{
				foreach ( $services as $class )
				{
					$obj = new $class( \IPS\Member::constructFromData( $row ) );
					$obj->sync();
				}
			}
		}
	}
}