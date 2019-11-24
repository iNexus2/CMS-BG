<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\extensions\core\Profile;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * @brief	Profile extension: Donate
 */
class _Donate
{
	/**
	 * Member
	 */
	protected $member;
	
	/**
	 * Constructor
	 *
	 * @param	\IPS\Member	$member	Member whose profile we are viewing
	 * @return	void
	 */
	public function __construct( \IPS\Member $member )
	{
		$this->member = $member;
	}
	
	/**
	 * Is there content to display?
	 *
	 * @return	bool
	 */
	public function showTab()
	{
		return (bool) \IPS\Db::i()->select( 'COUNT(*)', 'donate_users', array( array( 'member_id=? AND status=1 AND anon=0', $this->member->member_id ) ) )->first();
	}
	
	/**
	 * Display
	 *
	 * @return	string
	 */
	public function render()
	{
	    /* Setup featured posts table */
        $table = new \IPS\Helpers\Table\Content( 'IPS\donate\Donation', $this->member->url()->setQueryString( array( 'tab' => 'node_donate_Donate' ) ) );
        $table->rowsTemplate = array( \IPS\Theme::i()->getTemplate( 'browse', 'donate', 'front' ), 'donationRow' );
        $table->where[] = array( 'donate_users.member_id=? AND donate_users.status=1 AND donate_users.anon=0', $this->member->member_id );
        $table->noModerate = TRUE;
        
		return (string) $table;
	}
}