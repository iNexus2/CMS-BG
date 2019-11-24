<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
namespace IPS\donate;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Donation Item
 */
class _Donation extends \IPS\Content\Item implements \IPS\Content\Shareable
{
	/**
	 * @brief	Database Table
	 */
	public static $databaseTable = 'donate_users';
	
	/**
	 * @brief	Application
	 */
	public static $application = 'donate';
    
	/**
	 * @brief	Module
	 */
	public static $module = 'donate';    
	
	/**
	 * @brief	Database Prefix
	 */
	public static $databasePrefix = '';
	
	/**
	 * @brief	Multiton Store
	 */
	protected static $multitons;
	
	/**
	 * @brief	Database ID Fields
	 */
	protected static $databaseIdFields = array( 'id' );
	
	/**
	 * @brief	[ActiveRecord] ID Database Column
	 */
	public static $databaseColumnId = 'id';
    		
	/**
	 * @brief	Database Column Map
	 */
	public static $databaseColumnMap = array(
			'title'			=> 'member_name',
			'date'			=> 'date',
			'author'		=> 'member_id',
			'content'		=> 'note',
            'approved'		=> 'status',
	);
	
	/**
	 * @brief	Title
	 */
	public static $title = 'donation';
	
	/**
	 * @brief	Title
	 */
	public static $icon = 'bullhorn';

	/**
	 * Get container
	 *
	 * @return	\IPS\Node\Model
	 * @note	Certain functionality requires a valid container but some areas do not use this functionality (e.g. messenger)
	 * @note	Some functionality refers to calls to the container when managing comments (e.g. deleting a comment and decrementing content counts). In this instance, load the parent items container.
	 * @throws	\OutOfRangeException|\BadMethodCallException
	 */
	public function container()
	{
		if ( $this->goal )
		{
			try
			{
				return \IPS\donate\Goal::load( $this->goal );
			}
			catch ( \OutOfRangeException $e ) { }
		}
	}
    
	/**
	 * @brief	Cached URLs
	 */
	protected $_url	= array();

	/**
	 * Get URL
	 *
	 * @param	string|NULL		$action		Action
	 * @return	\IPS\Http\Url
	 */
	public function url( $action=NULL )
	{
		return NULL;
	}    

	/**
	 * Save Donation
	 *
	 * @return	void
	 */
	public function save()
	{
	    /* Fix up fields */
        $this->currency = $this->currency ? (int) $this->currency : 0;
        $this->goal     = $this->goal ? (int) $this->goal : 0;

        /* Generate txn id */
        if( !$this->txn_id )
        {
            $this->txn_id = time();    
        }
        
        /* Sync topic */
		if( \IPS\Application::appIsEnabled('forums') )
		{
			$this->syncTopic();
		}       
        
        /* Send pm to new donor? */
        if( $this->_new AND $this->member_id AND \IPS\Settings::i()->dt_new_donation_pm )
        {
            $this->sendDonationPM();   
        }

		return parent::save();
	}

	/**
	 * [ActiveRecord] Delete Record
	 *
	 * @return	void
	 */
	public function delete()
	{
	    /* Delete discussion topic */
		if( $topic = $this->topic() )
		{
			$topic->delete();
		}	   
       
		return parent::delete();
	}
    
	/**
	 * Get author
	 *
	 */
	public function author()
	{
		try
		{
			return \IPS\Member::load( $this->member_id );
		}
		catch ( \OutOfRangeException $e ) { }
	} 
    
	/**
	 * Get amount with fee calcuation
	 *
	 */
	public function get__amount()
	{
		if( $this->fees AND \IPS\Settings::i()->dt_include_fees )
        {
            return $this->amount - $this->fees;    
        }
        
        return $this->amount;
	}    
    
	/**
	 * Get currency
	 *
	 */
	public function get__currency()
	{
		if ( $this->currency )
		{
			try
			{
			    $currency = \IPS\donate\Currency::load( $this->currency );
				return $currency->tag;
			}
			catch ( \OutOfRangeException $e ) { }
		}
	}   

	/**
	 * Get goal
	 *
	 */
	public function goal()
	{
		if ( $this->goal )
		{
			try
			{
			    $goal = \IPS\donate\Goal::load( $this->goal );
				return $goal;
			}
			catch ( \OutOfRangeException $e ) 
            { 
			     return NULL;
			}
		}
        
        return NULL;
	}     
    
	/**
	 * Get Donation Topic
	 * @return	\IPS\forums\Topic|NULL
	 */
	public function topic()
	{
		if ( \IPS\Application::appIsEnabled('forums') and $this->topic_id )
		{
			try
			{
				return \IPS\forums\Topic::load( $this->topic_id );
			}
			catch ( \OutOfRangeException $e )
			{
				return NULL;
			}
		}
		
		return NULL;
	} 
    
	/**
	 * Rebuild memebr donation count
	 */
	public function rebuildDonorCount( $member=NULL )
	{
	    /* We need this */
		if( !$member )
        {
            return FALSE;
        }
        
        /* Calculate total donations for this member */
        $totalDonations = \IPS\Db::i()->select( 'COUNT(*) as totalDonations, SUM(amount) as totalAmount, SUM(fees) as totalFees', 'donate_users', array( array( 'member_id=? AND status=1', $member->member_id ) ) )->first(); 
        
        /* Update members profile */
        $member->donate_donations = (int) $totalDonations['totalDonations'];
        $member->donate_amount    = ( \IPS\Settings::i()->dt_include_fees ) ? $totalDonations['totalAmount'] - $totalDonations['totalFees'] : $totalDonations['totalAmount'];
        $member->save();

		return $totalDonations;
	}    
    
	/**
	 * Send new donation pm
	 */      
	protected function sendDonationPM()
	{       
		/* Get tag values */
		$tags = self::returnTagValues( $this ); 	   
       
        /* Setup pm title and msg */
        $msgTitle = \IPS\Member::loggedIn()->language()->addToStack( 'dt_new_donation_pm_subject_value' );
        $msgPost  = \IPS\Member::loggedIn()->language()->addToStack( 'dt_new_donation_pm_message_value' );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $msgTitle );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $msgPost );
        
         /* Swap out our tags */
		foreach( $tags as $key => $value )
		{
            $msgTitle = str_replace( $key, $value, $msgTitle );
            $msgPost  = str_replace( $key, $value, $msgPost );            
		}             

        /* Set pm sender */
		try
		{
			$pmSender = \IPS\Member::load( \IPS\Settings::i()->dt_pm_sender );
		}
		catch( \OutOfRangeException $ex )
		{
            return; 
		} 
        
        /* What do you think your doing? */
        if( !$pmSender->member_id )
        {
            return;
        }            

        /* Create conversation */        
   		$conversation = \IPS\core\Messenger\Conversation::createItem( $pmSender, $pmSender->ip_address, \IPS\DateTime::ts( time() ) );
        $conversation->title = $msgTitle;
        $conversation->to_member_id = $this->member_id;
        $conversation->save();

 		/* Authorize everyone */       
		$c_members[] = $this->member_id;
        $c_members[] = $pmSender->member_id;
		$conversation->authorize( $c_members );         
        
        /* Add message */ 
		$message = \IPS\core\Messenger\Message::create( $conversation, $msgPost, TRUE, NULL, NULL, $pmSender );
		$conversation->first_msg_id = $message->id;
		$conversation->save(); 
        
        /* Send notification */ 
		$notification = new \IPS\Notification( \IPS\Application::load('core'), 'private_message_added', $conversation, array( $conversation, $pmSender ) );
		$notification->send();                     
	}    
    
 	/**
	 * Sync Topic
	 *
	 * @return	void
	 */
	protected function syncTopic()
	{
        /* Forums enabled? */
		if ( ! \IPS\Application::appIsEnabled( 'forums' ) )
		{
			return;
		}
        
        /* Discussion topics enabled? */
        if( !\IPS\Settings::i()->dt_create_topic )
        {
            return;   
        }
        
        /* Get forum id */ 
        $forumID = (int) \IPS\Settings::i()->dt_create_topic_forum;
     
		/* Check the forum */
		try
		{
			$forum = \IPS\forums\Forum::load( $forumID );
		}
		catch( \OutOfRangeException $ex )
		{
            return; 
		} 
                
		/* Topic author is donor */
        $authorID = (int) $this->member_id;
        
        /* Override topic author with author */
        if( !\IPS\Settings::i()->dt_create_own_topic )
        {
            $authorID = (int) \IPS\Settings::i()->dt_topic_author;   
        }
        
        /* Check member details */
		try
		{
			$author = \IPS\Member::load( $authorID );
		}
		catch( \OutOfRangeException $ex )
		{
            return; 
		}               
        
		/* Format post content */
        $topicTitle  = \IPS\Member::loggedIn()->language()->addToStack( 'dt_topic_title_value' );
        $postContent = \IPS\Member::loggedIn()->language()->addToStack( 'dt_topic_message_value' );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $topicTitle );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $postContent );
        
        /* Swap out our tags */
		$tags = self::returnTagValues( $this );
        
		foreach( $tags as $key => $value )
		{
		    \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $value );
          
            $topicTitle  = str_replace( $key, $value, $topicTitle );		  
			$postContent = str_replace( $key, $value, $postContent );
		} 

		/* Existing topic */
		if ( $this->topic_id )
		{          
			/* Get */
			try
			{
				$topic = \IPS\forums\Topic::load( $this->topic_id );
				if ( !$topic )
				{
					return;
				}
                
				$topic->title = $topicTitle;
				if ( \IPS\Settings::i()->tags_enabled AND $this->tags() )
				{
					$topic->setTags( $this->prefix() ? array_merge( $this->tags(), array( 'prefix' => $this->prefix() ) ) : $this->tags() );
				}
				$topic->save();
				$firstPost = $topic->comments( 1 );
				$firstPost->post = $postContent;
				$firstPost->save();
			}
			catch ( \OutOfRangeException $e )
			{
				return;
			}
		}
		/* New topic */
		else
		{
			/* Create topic */
			$topic = \IPS\forums\Topic::createItem( $author, $author->ip_address, \IPS\DateTime::ts( $this->date ), $forum, $this->hidden() );
			$topic->title = $topicTitle;
			$topic->topic_archive_status = \IPS\forums\Topic::ARCHIVE_EXCLUDE;
			$topic->save();

			if ( \IPS\Settings::i()->tags_enabled AND $this->tags() )
			{
				$topic->setTags( $this->prefix() ? array_merge( $this->tags(), array( 'prefix' => $this->prefix() ) ) : $this->tags() );
			}
			
			/* Add post */
			$post = \IPS\forums\Topic\Post::create( $topic, $postContent, TRUE, NULL, NULL, $author );
			$topic->topic_firstpost = $post->pid;
			$topic->save();
			
			/* Update event */
			$this->topic_id = $topic->tid;
			$this->save();
		}
	}         
    
	/**
	 * Retrieve the tags that are used in topic
	 *
	 * @return	array 	An array of tags in foramt of 'tag' => 'explanation text'
	 */
	public static function getTags()
	{
		/* Setup tags */
		$tags = array(
			'%member_name%' => \IPS\Member::loggedIn()->language()->addToStack('dttag_member_name'),
			'%amount%'	    => \IPS\Member::loggedIn()->language()->addToStack('dttag_amount'),
			'%board_name%'	=> \IPS\Member::loggedIn()->language()->addToStack('dttag_board_name'),
			'%currency%'	=> \IPS\Member::loggedIn()->language()->addToStack('dttag_currency'),
		);

		return $tags;
	} 
    
	/**
	 * Return tag values
	 *
	 * @param	NULL|\IPS\Member	$member	Member object
	 * @return	array
	 */
	protected static function returnTagValues( $donation=NULL )
	{
	    /* Default tags */
 		$tags['%member_name%'] = $donation->member_name ? $donation->member_name : \IPS\Member::loggedIn()->language()->get( 'donate_guest' );    
		$tags['%board_name%']  = \IPS\Settings::i()->board_name;
		$tags['%amount%']	   = new \IPS\donate\Currency\Money( $donation->amount, $donation->_currency );
		$tags['%currency%']	   = $donation->_currency;
        
        /* Override anonymous donations and amounts */
        if( $donation->anon )
        {
            $tags['%member_name%'] = \IPS\Member::loggedIn()->language()->get( 'anonymous_donation_tag' );    
        }        
        if( $donation->anon_amount )
        {
            $tags['%amount%']   = '--';
            $tags['%currency%']	= '';    
        }
        
		return $tags;
	}    
}