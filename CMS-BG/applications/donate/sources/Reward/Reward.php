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
 * Reward Node
 */
class _Reward extends \IPS\Node\Model
{
	/**
	 * @brief	[ActiveRecord] Multiton Store
	 */
	protected static $multitons;    
	public static $databaseTable = 'donate_rewards';
	public static $databasePrefix = '';
	public static $nodeTitle = 'donate_rewards';
    public static $databaseColumnId = 'rid';
    public static $modalForms = FALSE;

	public static $databaseColumnMap = array(
		'title'	=> 'title',
	);

	/**
	 * Set the title
	 *
	 * @param	string	$title	Title
	 * @return	void
	 */
	public function set_title( $title )
	{
		$this->_data['title'] = $title;
	}

	public function get__title()
	{
		if ( !$this->rid )
		{
			return '';
		}	   
       
        return $this->title;
	}
    
	/**
	 * [Node] Does the currently logged in user have permission to copy this node?
	 *
	 * @return	bool
	 */
	public function canCopy()
	{
		return TRUE;
	}  
    
	/**
	 * [Node] Get whether or not this node is enabled
	 *
	 * @note	Return value NULL indicates the node cannot be enabled/disabled
	 * @return	bool|null
	 */
	protected function get__enabled()
	{
		return $this->active;
	}

	/**
	 * [Node] Set whether or not this node is enabled
	 *
	 * @param	bool|int	$enabled	Whether to set it enabled or disabled
	 * @return	void
	 */
	protected function set__enabled( $enabled )
	{
		$this->active = $enabled;
	}     
         
	/**
	 * [Node] Get description
	 *
	 * @return	string
	 */
	protected function get__description()
	{
		return $this->amount_range1.' - '.$this->amount_range2;
	}        
         
	/**
	 * [Node] Add/Edit Form
	 *
	 * @param	\IPS\Helpers\Form	$form	The form
	 * @return	void
	 */
	public function form( &$form )
	{        
	    /* Get default exclude groups */
		$excludeGroups = array();

		foreach( \IPS\Member\Group::groups() as $group )
		{
			if( $group->g_access_cp OR $group->g_is_supmod )
			{
				$excludeGroups[] = $group->g_id;
			}
		}

        /* Reward form */
        $form->addHeader( 'reward_general_header' );
		$form->add( new \IPS\Helpers\Form\Text( 'reward_title', $this->rid ? $this->title : '', TRUE ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'reward_active', $this->rid ? $this->active : TRUE, FALSE ) );
        $form->add( new \IPS\Helpers\Form\NumberRange( 'reward_amount_range', $this->rid ? array( 'start' => $this->amount_range1, 'end' => $this->amount_range2 ) : array( 'start' => 0, 'end' => 100 ), FALSE, array( 'start' => array( 'decimals' => 2 ), 'end' => array( 'decimals' => 2 ) ) ) );

        $form->addHeader( 'reward_promotion_header' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'reward_promote_enable', $this->rid ? $this->promote_enable : FALSE, FALSE, array( 'togglesOn' => array( 'promote_extension', 'promote_options', 'promote_days_primary', 'promote_days_secondary', 'promote_primary', 'promote_primary_exclude', 'promote_secondary', 'promote_secondary_exclude' ) ) ) );
        $form->add( new \IPS\Helpers\Form\Select( 'reward_promote_options', $this->rid ? $this->promote_options : 2, FALSE, array( 'toggles' => array( 2 => array( 'promote_days_primary', 'promote_days_secondary', 'promote_extension' ), 3 => array( 'promote_days_primary', 'promote_days_secondary', 'promote_extension' ) ), 'options' => array( 1 => 'reward_permanent_promotion', 2 => 'reward_per_donation', 3 => 'reward_per_amount' ) ), NULL, NULL, NULL, 'promote_options' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'reward_promote_extension', $this->rid ? $this->promote_extension : TRUE, FALSE, array(), NULL, NULL, NULL, 'promote_extension' ) );
        $form->add( new \IPS\Helpers\Form\Number( 'reward_promote_days_primary', $this->promote_days_primary ? $this->promote_days_primary : 30, FALSE, array( 'min' => 1 ), NULL, NULL, \IPS\Member::loggedIn()->language()->addToStack( 'reward_days' ), 'promote_days_primary' ) );
        $form->add( new \IPS\Helpers\Form\Number( 'reward_promote_days_secondary', $this->promote_days_secondary ? $this->promote_days_secondary : 30, FALSE, array( 'min' => 1 ), NULL, NULL, \IPS\Member::loggedIn()->language()->addToStack( 'reward_days' ), 'promote_days_secondary' ) );        

		$form->add( new \IPS\Helpers\Form\Select( 'reward_promote_primary', $this->rid ? $this->promote_primary : '', FALSE, array( 'options' => \IPS\Member\Group::groups( TRUE, FALSE ), 'parse' => 'normal' ), NULL, NULL, NULL, 'promote_primary' ) );
		$form->add( new \IPS\Helpers\Form\Select( 'reward_promote_primary_exclude', $this->rid ? explode( ",", $this->promote_primary_exclude ) : $excludeGroups, FALSE, array( 'options' => \IPS\Member\Group::groups( TRUE, FALSE ), 'parse' => 'normal', 'multiple' => TRUE ), NULL, NULL, NULL, 'promote_primary_exclude' ) );
		$form->add( new \IPS\Helpers\Form\Select( 'reward_promote_secondary', $this->rid ? explode( ",", $this->promote_secondary ) : '', FALSE, array( 'options' => \IPS\Member\Group::groups( TRUE, FALSE ), 'parse' => 'normal', 'multiple' => TRUE ), NULL, NULL, NULL, 'promote_secondary' ) );
		$form->add( new \IPS\Helpers\Form\Select( 'reward_promote_secondary_exclude', $this->rid ? explode( ",", $this->promote_secondary_exclude ) : $excludeGroups, FALSE, array( 'options' => \IPS\Member\Group::groups( TRUE, FALSE ), 'parse' => 'normal', 'multiple' => TRUE ), NULL, NULL, NULL, 'promote_secondary_exclude' ) );

	}
	
	/**
	 * [Node] Format form values from add/edit form for save
	 *
	 * @param	array	$values	Values from the form
	 * @return	array
	 */
	public function formatFormValues( $values )
	{    
	    /* Remove prefix */
 		foreach( $values as $k => $v )
		{
			if( mb_substr( $k, 0, 7 ) === 'reward_' )
			{
				unset( $values[ $k ] );
				$values[ mb_substr( $k, 7 ) ] = $v;
			}
		}	   
       
	    /* Remove group promotion fields */
        if( !$values['promote_enable'] )
        {
            foreach( array( 'promote_extension', 'promote_options', 'promote_days_primary', 'promote_days_secondary', 'promote_primary', 'promote_primary_exclude', 'promote_secondary', 'promote_secondary_exclude' ) as $field )
            {
                unset( $values[ $field ] );
            }
        }	  

        /* Split amount range field */
        if( is_array( $values['amount_range'] ) )
        {
            $values['amount_range1'] = $values['amount_range']['start'];
            $values['amount_range2'] = $values['amount_range']['end'];   
            
            unset( $values['amount_range'] );        
        }
        
        /* Check for amount range overlap */
        foreach( \IPS\donate\Reward::roots() as $reward )
		{
            /* Skip current reward */
		    if( $this->_id == $reward->_id )
            {
                continue;    
            }
                    
            /* Check for any overlap with existing rewards */
            if( $values['amount_range1'] >= $reward->amount_range1 AND $values['amount_range1'] <= $reward->amount_range2 )
            {
                throw new \InvalidArgumentException( \IPS\Member::loggedIn()->language()->addToStack('reward_amount_overlap') );
            }            
        }
        
        /* Save our group arrays as comma sep */
        if( isset( $values['promote_primary_exclude'] ) )
        {
            $values['promote_primary_exclude'] = implode( ",", $values['promote_primary_exclude'] );    
        }
        if( isset( $values['promote_secondary'] ) )
        {
            $values['promote_secondary'] = implode( ",", $values['promote_secondary'] );    
        }  
        if( isset( $values['promote_secondary_exclude'] ) )
        {
            $values['promote_secondary_exclude'] = implode( ",", $values['promote_secondary_exclude'] );    
        }              

		return $values;
	}

	/**
	 * [ActiveRecord] Delete Record
	 *
	 * @return	void
	 */
	public function delete()
	{
		return parent::delete();
	}

	/**
	 * Search
	 *
	 * @param	string		$column	Column to search
	 * @param	string		$query	Search query
	 * @param	string|null	$order	Column to order by
	 * @param	mixed		$where	Where clause
	 * @return	array
	 */
	public static function search( $column, $query, $order=NULL, $where=array() )
	{
		if ( $column === '_title' )
		{
			$column	= 'title';
		}

		if( $order == '_title' )
		{
			$order	= 'title';
		}

		return parent::search( $column, $query, $order, $where );
	} 
    
	/**
	 * Issue reward
	 */
	static public function issue( $amount=0, $member=NULL )
	{ 
        /* Which member? */
		$member = $member ?: \IPS\Member::loggedIn();	 
        $upgradeSecondary = TRUE;          
       
	    /* Amount needed */
	    if( !$amount OR !$member->member_id )
        {
            return;    
        }
        
        /* Use total donations? */
        if( \IPS\Settings::i()->dt_member_rewards_total_donations )
        {
            $totalAmount = \IPS\Db::i()->select( 'SUM(amount)', 'donate_users', array( array( 'member_id=?', $member->member_id ) ) )->first();
            
            /* Use total amount */
            if( $totalAmount )
            {
                $amount = $totalAmount;    
            }          
        }   

        /* Get our reward */ 
		try
		{
            $reward = \IPS\donate\Reward::constructFromData( \IPS\Db::i()->select( '*', 'donate_rewards', array( array( 'active=? AND promote_enable=? AND ? BETWEEN amount_range1 AND amount_range2', 1, 1, $amount ) ) )->first() );
		}
		catch( \UnderflowException $e )
        {
            return;
        }   
        
        /* We at least need this to have a value */
        if( !$reward->promote_primary )
        {
            return;
        }
        
        /* Save record of previous groups */
        $oldPrimaryGroup   = $member->member_group_id;
        $oldSecondaryGroup = $member->mgroup_others;

        /* Check primary group not excluded */
        if( !$member->inGroup( explode( ',', $reward->promote_primary_exclude ) ) )
        {           
            
            /* Update member group if not already changed */
            if( $reward->promote_primary && $member->member_group_id != $reward->promote_primary )
            {
                $member->member_group_id = $reward->promote_primary;
                $member->save();     
            }
        }
        
        /* Already has secondary groups? */
        if( $member->mgroup_others )
        {
            /* Check members secondary groups against our exclude groups */
            foreach( explode( ',', $member->mgroup_others ) as $groupID )
            {
                if( in_array( $groupID, explode( ',', $reward->promote_secondary_exclude ) ) )
                {
        		    $upgradeSecondary = FALSE;
                }  
            } 
            
            /* Can we merge groups */
            if( $upgradeSecondary )
            {
                $newSecondaryGroups = array_merge( explode( ",", $reward->promote_secondary ), explode( ",", $member->mgroup_others ) );             
            }                       
        }
        /* Just perform a straight upgrade */
        else
        {
            $newSecondaryGroups = explode( ",", $reward->promote_secondary );             
        }
        
        /* Upgrade secondary groups */
        if( $upgradeSecondary AND $reward->promote_secondary AND $member->mgroup_others != $reward->promote_secondary )
        {
            $member->mgroup_others = implode( ",", $newSecondaryGroups );
            $member->save();            
        } 
        
        /* Calculate promotion time */      
        if( $reward->promote_options == 2 )
        {
            $primaryGroupDays   = $reward->promote_days_primary;
            $secondaryGroupDays = $reward->promote_days_secondary;            
        }         
        else if( $reward->promote_options == 3 )
        {
            $primaryGroupDays   = $reward->promote_days_primary * $amount;
            $secondaryGroupDays = $reward->promote_days_secondary * $amount;            
        }         
        
        /* Setup promotion time limit */
        if( $reward->promote_options > 1 )
        {
            /* Load current promotion */
     		try
    		{
                $promotion = \IPS\donate\Promotion::load( $member->member_id, 'member_id' );
                
                /* Extend promotion time? */
                $donationCount = \IPS\Db::i()->select( 'id', 'donate_users', array( array( 'member_id=?', $member->member_id ) ) )->count();
                
                if( $donationCount AND $reward->promote_extension )
                {
                    /* Update promotion time and save */
                    $promotion->demote_date = \IPS\DateTime::ts( $promotion->demote_date )->add( new \DateInterval('P'.$primaryGroupDays.'D') );            
                    $promotion->save();                    
                }                
    		}
    		catch( \OutOfRangeException $e )
            {
				/* Add new promotion */
				$promotion = new \IPS\donate\Promotion;
				$promotion->member_id       = $member->member_id; 
                $promotion->original_group  = $oldPrimaryGroup;  
                $promotion->new_group       = $reward->promote_primary; 
                $promotion->demote_group    = $oldPrimaryGroup; 
                $promotion->original_group2 = $oldSecondaryGroup; 
                $promotion->demote_group2   = $oldSecondaryGroup;
                $promotion->new_group2      = $newSecondaryGroups ? implode( ",", $newSecondaryGroups ) : NULL; 
                $promotion->date_added      = time();  
                $promotion->demote_date     = time(); 
                
                /* Update promotion time and save */
                $promotion->demote_date = \IPS\DateTime::ts( $promotion->demote_date )->add( new \DateInterval('P'.$primaryGroupDays.'D') );            
                $promotion->save();  
                
                /* Send pm about it */
                if( \IPS\Settings::i()->dt_new_promotion_pm )
                {
                    self::sendPromotionPM( $member );   
                }                                   
            }     
        }
	}
    
	/**
	 * Send promotion pm
	 */      
	protected static function sendPromotionPM( $member=NULL )
	{       
	    /* Lets stop here */
	    if( !$member )
        {
            return;
        }
       
        /* Setup pm title and msg */
        $msgTitle = \IPS\Member::loggedIn()->language()->addToStack( 'new_donation_promotion_pm_subject' );
        $msgPost  = \IPS\Member::loggedIn()->language()->addToStack( 'new_donation_promotion_pm_message' );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $msgTitle );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $msgPost );      

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
        $conversation->is_system = TRUE;
        $conversation->to_member_id = $member->member_id;
        $conversation->save();

 		/* Authorize everyone */       
		$c_members[] = $member->member_id;
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
}