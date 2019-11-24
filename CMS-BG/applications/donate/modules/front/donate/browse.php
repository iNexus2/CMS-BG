<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\modules\front\donate;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * browse
 */
class _browse extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		parent::execute();
                
		/* Latest goals RSS feed link */
		if( \IPS\Settings::i()->dt_enable_goal_rss AND \IPS\Member::loggedIn()->group['g_dt_view_goals'] )
		{
			\IPS\Output::i()->rssFeeds[ 'latest_goals_rss' ] = \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&do=goalsRSS', 'front', 'donate_goals_rss' );
		} 
        
		/* Latest donations RSS feed link */
		if( \IPS\Settings::i()->dt_enable_donation_rss AND \IPS\Member::loggedIn()->group['g_dt_view_donations'] )
		{
			\IPS\Output::i()->rssFeeds[ 'latest_donations_rss' ] = \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&do=donationsRSS', 'front', 'donate_donations_rss' );
		}                        
        
		/* You must purchase copyright removal before removing */
        if( !\IPS\Settings::i()->devfuse_copy_num && !\IPS\Request::i()->isAjax() )
        {
            \IPS\Output::i()->output .= "<div style='clear:both;text-align:center;position:absolute;bottom:15px;width:95%;'><a href='http://www.devfuse.com/' class='ipsType_light ipsType_smaller'>IP.Board Donations by DevFuse</a></div>";    
        }       
	}

	/**
	 * View Goal
	 *
	 * @return	void
	 */
	protected function manage()
	{
	    /* Can view goals? */
        if( !\IPS\Member::loggedIn()->group['g_dt_view_goals'] )	
        {
            \IPS\Output::i()->error( 'node_error', '', 403, '' );    
        }   
       
	    /* Get goal */
		try
		{
            $goal = \IPS\donate\Goal::loadAndCheckPerms( \IPS\Request::i()->id, 'view' );
		}
		catch ( \OutOfRangeException $e )
		{
			\IPS\Output::i()->error( 'node_error', '', 404, '' );
		}
        
        /* Get goals donations */        
		$table = new \IPS\Helpers\Table\Content( '\IPS\donate\Donation', \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&id='.$goal->_id ), array( array( 'goal=? AND status=?', $goal->_id, 1 ) ), NULL, FALSE, 'read' );
		$table->rowsTemplate = array( \IPS\Theme::i()->getTemplate( 'browse' ), 'donationRow' );
		$table->sortBy = 'date';
		$table->sortDirection = 'desc';
        $table->limit = 10;
        $table->noModerate = TRUE; 
        $table->sortOptions = array();  
        $table->title = \IPS\Member::loggedIn()->language()->addToStack( 'donations' );    
        
        /* Add view count */
        $goal->views = $goal->views + 1;
        $goal->save();
        
		/* Online User Location */
		$permissions = \IPS\Dispatcher::i()->module->permissions();
		\IPS\Session::i()->setLocation( $goal->url(), explode( ",", $permissions['perm_view'] ), 'loc_donate_viewing_goal', array( "donate_goal_{$goal->_id}" => TRUE ) );                                   
        
		/* Display */
		\IPS\Output::i()->title	 = $goal->_title;
		\IPS\Output::i()->breadcrumb[] = array( \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&id='.$goal->_id, 'front', 'donate_goal', $goal->seo_name ), $goal->_title );        
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'browse' )->goalPage( $goal, (string) $table );        
	}

	/**
	 * View All Donations
	 *
	 * @return	void
	 */
	protected function donations()
	{
	    /* Can view donations? */
        if( !\IPS\Member::loggedIn()->group['g_dt_view_donations'] )	
        {
            \IPS\Output::i()->error( 'node_error', '', 403, '' );    
        }	   
       
        /* Get all donations */        
		$table = new \IPS\Helpers\Table\Content( '\IPS\donate\Donation', \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&do=donations' ), array( array( 'status=?', 1 ) ), NULL, FALSE, 'read' );
		$table->rowsTemplate = array( \IPS\Theme::i()->getTemplate( 'browse' ), 'donationRow' );
		$table->sortBy = 'date';
		$table->sortDirection = 'desc';
        $table->limit = 10;
        $table->noModerate = TRUE; 
        $table->sortOptions = array();  
        $table->title = \IPS\Member::loggedIn()->language()->addToStack( 'page__donations' );
        
		/* Set Online Location */
		$permissions = \IPS\Dispatcher::i()->module->permissions();
		\IPS\Session::i()->setLocation( \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&do=donations', 'front', 'donate_donations' ), explode( ',', $permissions['perm_view'] ), 'loc_donate_donations' );                         	       
                
		/* Display */
		\IPS\Output::i()->title	 = \IPS\Member::loggedIn()->language()->addToStack( 'page__donations' );
		\IPS\Output::i()->breadcrumb[] = array( NULL, \IPS\Member::loggedIn()->language()->addToStack( 'page__donations' ) );        
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'browse' )->donationList( (string) $table );        
	}
    
	/**
	 * View All Goals
	 *
	 * @return	void
	 */
	protected function goals()
	{
	    /* Can view goals? */
        if( !\IPS\Member::loggedIn()->group['g_dt_view_goals'] )	
        {
            \IPS\Output::i()->error( 'node_error', '', 403, '' );    
        }	   
       
        /* Get all goals */ 
        $goals = \IPS\donate\Goal::roots( NULL, NULL, array( 'g_show=1' ) );
        
		/* Set Online Location */
		$permissions = \IPS\Dispatcher::i()->module->permissions();
		\IPS\Session::i()->setLocation( \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&do=goals', 'front', 'donate_goals' ), explode( ',', $permissions['perm_view'] ), 'loc_donate_goals' );                         	               
      
		/* Display */
		\IPS\Output::i()->title	 = \IPS\Member::loggedIn()->language()->addToStack( 'page__goals' );
		\IPS\Output::i()->breadcrumb[] = array( NULL, \IPS\Member::loggedIn()->language()->addToStack( 'page__goals' ) );        
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'browse' )->goalList( $goals );        
	}

	/**
	 * View Top Donors
	 *
	 * @return	void
	 */
	protected function topdonors()
	{
	    /* Can view donations? */
        if( !\IPS\Member::loggedIn()->group['g_dt_view_donations'] )	
        {
            \IPS\Output::i()->error( 'node_error', '', 403, '' );    
        }	   
        
        $donations = array();
       
        /* Setup where array */
        $where[] = array( 'member_id>?', 0 );
        $where[] = array( 'status=?', 1 );
        $where[] = array( 'anon=?', 0 );
        $where[] = array( 'anon_amount=?', 0 );	   
               
	    /* Get all top donors */
        $donations = \IPS\Db::i()->select( 'member_id as member, SUM(amount) AS total_amount', 'donate_users', $where, 'total_amount DESC', 10, array( 'member_id' ) )->setKeyField('member')->setValueField('total_amount') ;
              
		/* Set Online Location */
		$permissions = \IPS\Dispatcher::i()->module->permissions();
		\IPS\Session::i()->setLocation( \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&do=topdonors', 'front', 'donate_topdonors' ), explode( ',', $permissions['perm_view'] ), 'loc_donate_topdonors' );                         	                             
                
		/* Display */
		\IPS\Output::i()->title	 = \IPS\Member::loggedIn()->language()->addToStack( 'page__top_donors' );
		\IPS\Output::i()->breadcrumb[] = array( NULL, \IPS\Member::loggedIn()->language()->addToStack( 'page__top_donors' ) );        
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'browse' )->topDonorsList( $donations );        
	} 
    
	/**
	 * Latest Goals RSS
	 *
	 * @return	void
	 */
	protected function goalsRSS()
	{
	    /* Can view goals? */
        if( !\IPS\Member::loggedIn()->group['g_dt_view_goals'] )	
        {
            \IPS\Output::i()->error( 'node_error', '', 403, '' );    
        }	   
       
		if( !\IPS\Settings::i()->dt_enable_goal_rss )
		{
			\IPS\Output::i()->error( 'rss_offline', '', 403 );
		}
        
		/* Show rss feed */
		$document = \IPS\Xml\Rss::newDocument( \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&do=goals', 'front', 'donate_goals' ), \IPS\Member::loggedIn()->language()->get('latest_goals_rss'), \IPS\Member::loggedIn()->language()->get('latest_goals_rss') );
		
		foreach( \IPS\donate\Goal::roots() as $goal )
		{
			$document->addItem( $goal->_title, $goal->url(), '', \IPS\DateTime::ts( $goal->start_date ), $goal->_id );
		}

		\IPS\Output::i()->sendOutput( $document->asXML(), 200, 'text/xml' ); 
	}   

	/**
	 * Latest Donations RSS
	 *
	 * @return	void
	 */
	protected function donationsRSS()
	{
	    /* Can view donations? */
        if( !\IPS\Member::loggedIn()->group['g_dt_view_donations'] )	
        {
            \IPS\Output::i()->error( 'node_error', '', 403, '' );    
        }	   
       
		if( !\IPS\Settings::i()->dt_enable_donation_rss )
		{
			\IPS\Output::i()->error( 'rss_offline', '', 403 );
		}
        
        $where[] = array( 'status=?', 1 );
        
        /* Automatic reset? */
        if( \IPS\Settings::i()->dt_donation_reset )
        {
            $where[] = array( 'date>?', (int) \IPS\Settings::i()->dt_donation_reset );    
        }

		/* Show rss feed */
		$document = \IPS\Xml\Rss::newDocument( \IPS\Http\Url::internal( 'app=donate&module=donate&controller=browse&do=donations', 'front', 'donate_donations' ), \IPS\Member::loggedIn()->language()->get('latest_donations_rss'), \IPS\Member::loggedIn()->language()->get('latest_donations_rss') );
		
        /* Get donations */
        $donations = array(); 
        
		foreach( \IPS\Db::i()->select( '*' ,'donate_users', $where, 'date DESC', 10 ) as $row )
		{
            $donation = \IPS\donate\Donation::constructFromData( $row );
            $document->addItem( $donation->member_name ? $donation->member_name : 'Guest', \IPS\Http\Url::internal( 'app=donate', 'front', 'donate' ), $donation->note, \IPS\DateTime::ts( $donation->date ), $donation->id );
		}

		\IPS\Output::i()->sendOutput( $document->asXML(), 200, 'text/xml' ); 
	}        
}