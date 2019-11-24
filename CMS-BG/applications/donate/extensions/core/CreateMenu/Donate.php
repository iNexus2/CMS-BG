<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\extensions\core\CreateMenu;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Create Menu Extension: Donate
 */
class _Donate
{
	/**
	 * Get Items
	 *
	 * @return	array example: return array( '{example_key}' => { instance of \IPS\Http\Url::internal } ) );
	 */
	public function getItems()
	{
		if ( \IPS\donate\Donation::canCreate( \IPS\Member::loggedIn() ) )
		{
			return array( 'donate' => array( 'link' => \IPS\Http\Url::internal( "app=donate&module=donate&controller=payment", 'front', 'donate_donate' ) ) );
		}

		return array();
	}
}