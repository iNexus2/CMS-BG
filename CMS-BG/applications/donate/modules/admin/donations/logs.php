<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\modules\admin\donations;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * logs
 */
class _logs extends \IPS\Dispatcher\Controller
{	
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'logs_manage' );
		parent::execute();
	}
	
	/**
	 * Manage
	 *
	 * @return	void
	 */
	protected function manage()
	{		
		/* Create the table */
		$table = new \IPS\Helpers\Table\Db( 'donate_logs', \IPS\Http\Url::internal( 'app=donate&module=donations&controller=logs' ) );
		$table->langPrefix = 'donationlogs_';
		$table->include = array( 'author_id', 'date', 'ip_address', 'problem', 'post_data' );
		$table->mainColumn = 'author_id';
        $table->widths = array( 'post_data' => 50 );
		$table->parsers = array(
				'author_id'	=> function( $val )
				{
					try
					{
						return htmlentities( \IPS\Member::load( $val )->name, \IPS\HTMLENTITIES, 'UTF-8', FALSE );
					}
					catch ( \OutOfRangeException $e )
					{
						return 'Guest';
					}
				},				
                'ip_address'=> function( $val )
				{
					if ( \IPS\Member::loggedIn()->hasAcpRestriction( 'core', 'members', 'membertools_ip' ) )
					{
						return "<a href='" . \IPS\Http\Url::internal( "app=core&module=members&controller=ip&ip={$val}" ) . "'>{$val}</a>";
					}
					return $val;
				},
				'date'		=> function( $val )
				{
					return (string) \IPS\DateTime::ts( (int) $val );
				},
				'post_data'	=> function( $val )
				{
					return "<div data-ipsTruncate data-ipsTruncate-type='hide' data-ipsTruncate-size='3 lines'>{$val}</div>";
				}                
		);
		$table->sortBy = $table->sortBy ?: 'date';
		$table->sortDirection = $table->sortDirection ?: 'desc';
        
 		/* Search */
        $table->quickSearch = 'post_data';
		$table->advancedSearch	= array(
				'author_id'			=> \IPS\Helpers\Table\SEARCH_MEMBER,
				'ip_address'		=> \IPS\Helpers\Table\SEARCH_CONTAINS_TEXT,
				'date'				=> \IPS\Helpers\Table\SEARCH_DATE_RANGE
        );  

		$table->rowButtons = function( $row )
		{
			$return['delete'] = array(
				'icon'		=> 'times-circle',
				'title'		=> 'delete',
				'link'		=> \IPS\Http\Url::internal( 'app=donate&module=donations&controller=logs&do=delete&id=' ) . $row['id'],
				'data'		=> array( 'delete' => '' ),
			);

			return $return;
		};                      
                
		/* Display */
		\IPS\Output::i()->breadcrumb[] = array( \IPS\Http\Url::internal( 'app=donate&module=donations&controller=logs' ), \IPS\Member::loggedIn()->language()->addToStack( 'donationlogs' ) );
		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack( 'donationlogs' );
		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'global', 'core' )->block( 'donationlogs', (string) $table );
	}
    
	/**
	 * Delete log
	 *
	 * @return	void
	 */
	protected function delete()
	{
		/* Load */
		$current = \IPS\Db::i()->select( '*', 'donate_logs', array( "id=?", intval( \IPS\Request::i()->id ) ) )->first();
		if ( !$current )
		{
			\IPS\Output::i()->error( 'node_error', '', 404, '' );
		}
		
		/* Delete */
		\IPS\Db::i()->delete( 'donate_logs', array( array( "id=?", $current['id'] ) ) );
		
		/* Redirect */
		\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=donate&module=donations&controller=logs' ) );
	}
}