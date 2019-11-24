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
 * @brief	Profile extension: DonateChanges
 */
class _DonateChanges
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
        /* Only show to profile owner or moderator */
		return ( $this->member->member_id == \IPS\Member::loggedIn()->member_id OR \IPS\Member::loggedIn()->group['g_dt_moderate_donations'] ) ? TRUE : FALSE;
	}
	
	/**
	 * Display
	 *
	 * @return	string
	 */
	public function render()
	{
	    /* Setup donation changes table */
        $table = new \IPS\Helpers\Table\Db( 'donate_changes', $this->member->url()->setQueryString( array( 'tab' => 'node_donate_DonateChanges' ) ) );
        $table->rowsTemplate = array( \IPS\Theme::i()->getTemplate( 'global', 'donate', 'front' ), 'donateChangeRow' );
		$table->langPrefix = 'donate_';
        $table->limit = 10;
        $table->where[] = array( 'c_donor=?', $this->member->member_id );
        
		/* Column stuff */
		$table->include = array( 'c_id', 'c_donor', 'c_member', 'c_date', 'c_previous_amount', 'c_new_amount', 'c_notes', 'c_approved' );
		$table->mainColumn = 'c_notes';
        
        $table->sortOptions['c_date'] = 'c_date';   
        $table->sortOptions['c_member'] = 'c_member'; 
        
		/* Sort stuff */
		$table->sortBy = $table->sortBy ?: 'c_date';
		$table->sortDirection = $table->sortDirection ?: 'desc';
        
        /* Filters */
 		$table->filters = array(
			'filter_note_left' => 'c_notes IS NOT NULL',
            'filter_pending' => 'c_approved=0',
            'filter_mychanges' => array( 'c_member = ?', \IPS\Member::loggedIn()->member_id ),
            'filter_last_24hours' => array( 'c_date > ?', \IPS\DateTime::create()->sub( new \DateInterval( 'P1D' ) )->getTimestamp() ),
		);       

		/* Search */
		$table->advancedSearch = array(
			'c_notes'		=> \IPS\Helpers\Table\SEARCH_CONTAINS_TEXT,
			'c_member' => \IPS\Helpers\Table\SEARCH_MEMBER,
            'c_date'		=> \IPS\Helpers\Table\SEARCH_DATE_RANGE,
			);

		$table->parsers = array(   
			'c_donor' => function( $val, $row )
			{
                /* Yes it's possible */			     
                if( !$val )
                {
                    return NULL;
                }			 
             
        		try
        		{
        			return \IPS\Member::load( $val );
        		}
        		catch( \OutOfRangeException $ex )
        		{
                    return NULL; 
        		}
			},             
			'c_member' => function( $val, $row )
			{
                /* Yes it's possible */			     
                if( !$val )
                {
                    return NULL;
                }			 
             
        		try
        		{
        			return \IPS\Member::load( $val );
        		}
        		catch( \OutOfRangeException $ex )
        		{
                    return NULL; 
        		}
			},                                
		);       
                
		return (string) $table;
	}
}