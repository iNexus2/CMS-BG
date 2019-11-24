<?php
/**
 * @brief		Report Comment Model
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		15 Jul 2013
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\core\Reports;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Report Comment Model
 */
class _Comment extends \IPS\Content\Comment
{
	/**
	 * @brief	[ActiveRecord] Database Table
	 */
	public static $databaseTable = 'core_rc_comments';
	
	/**
	 * @brief	[ActiveRecord] Database Prefix
	 */
	public static $databasePrefix = '';
	
	/**
	 * @brief	[ActiveRecord] Multiton Store
	 */
	protected static $multitons;
		
	/**
	 * @brief	[Content\Comment]	Item Class
	 */
	public static $itemClass = 'IPS\core\Reports\Report';
	
	/**
	 * @brief	Application
	 */
	public static $application = 'core';
	
	/**
	 * @brief	[Content\Comment]	Database Column Map
	 */
	public static $databaseColumnMap = array(
		'item'			=> 'rid',
		'date'			=> 'comment_date',
		'content'		=> 'comment',
		'author'		=> 'comment_by',
		'author_name'	=> 'author_name',
		'ip_address'	=> 'ip_address',
	);
	
	/**
	 * @brief	Title
	 */
	public static $title = 'report_comment';

	/**
	 * Get mapped value
	 *
	 * @param	string	$key	date,content,ip_address,first
	 * @return	mixed
	 */
	public function mapped( $key )
	{
		/* Get the reported content items title */
		if ( $key === 'title' )
		{
			return $this->item()->mapped( 'title' );
		}

		return parent::mapped( $key );
	}

	/**
	 * Can view this entry
	 *
	 * @param	\IPS\Member|NULL	$member		The member or NULL for currently logged in member.
	 * @return	bool
	 */
	public function canView( $member = NULL )
	{
		$member = $member ?: \IPS\Member::loggedIn();

		$return = parent::canView($member);

		if ( $return AND $member->modPermission('can_view_reports') )
		{
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Get URL for doing stuff
	 *
	 * @param	string|NULL		$action		Action
	 * @return	\IPS\Http\Url
	 */
	public function url( $action='find' )
	{
		$url = parent::url( $action );
		if ( isset( $url->queryString['do'] ) )
		{
			return $url->setQueryString( array( 'do' => NULL, 'action' => $url->queryString['do'] ) );
		}
		return $url;
	}
}
