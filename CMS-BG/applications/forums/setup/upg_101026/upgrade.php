<?php
/**
 * @brief		4.1.7 Upgrade Code
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @subpackage	Forums
 * @since		04 Jan 2016
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\forums\setup\upg_101026;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 4.1.9 Upgrade Code
 */
class _Upgrade
{
	/**
	 * Trigger background task
	 *
	 * @return	array	If returns TRUE, upgrader will proceed to next step. If it returns any other value, it will set this as the value of the 'extra' GET parameter and rerun this step (useful for loops)
	 */
	public function step1()
	{
		\IPS\Task::queue( 'forums', 'HiddenFirstPost', array(), 4 );

		return TRUE;
	}
	
	/**
	 * Custom title for this step
	 *
	 * @return string
	 */
	public function step1CustomTitle()
	{
		return "Updating incorrectly hidden topics";
	}
}