<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\extensions\core\MemberSync;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Member Sync
 */
class _Donate
{
	/**
	 * Member is merged with another member
	 *
	 * @param	\IPS\Member	$member		Member being kept
	 * @param	\IPS\Member	$member2	Member being removed
	 * @return	void
	 */
	public function onMerge( $member, $member2 )
	{
		\IPS\Db::i()->update( 'donate_demote', array( 'member_id' => $member->member_id ), array( 'member_id=?', $member2->member_id ) );
		\IPS\Db::i()->update( 'donate_logs', array( 'author_id' => $member->member_id ), array( 'author_id=?', $member2->member_id ) );
		\IPS\Db::i()->update( 'donate_users', array( 'member_id' => $member->member_id ), array( 'member_id=?', $member2->member_id ) );        
	}
	
	/**
	 * Member is deleted
	 *
	 * @param	$member	\IPS\Member	The member
	 * @return	void
	 */
	public function onDelete( $member )
	{
		\IPS\Db::i()->delete( 'donate_demote', array( 'member_id=?', $member->member_id ) );
		\IPS\Db::i()->delete( 'donate_logs', array( 'author_id=?', $member->member_id ) );
		\IPS\Db::i()->delete( 'donate_users', array( 'member_id=?', $member->member_id ) );        
	}
}