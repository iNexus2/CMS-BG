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
 * Goal Node
 */
class _Goal extends \IPS\Node\Model
{
	protected static $multitons;    
    protected static $databaseIdFields = array( 'name' );
    public static $databaseColumnId = 'id'; 
	public static $databaseTable = 'donate_goals';
	public static $databasePrefix = 'g_';
	public static $nodeTitle = 'goals';
    public static $formLangPrefix = 'goal_';
    public static $titleLangPrefix = 'donate_goal_';
   	public static $descriptionLangSuffix = '_desc';
    public static $databaseColumnOrder = 'priority';

	public static $databaseColumnMap = array(
		'title'	=> 'name',
	);
    
	/**
	 * Form fields prefix with "forum_" but the database columns do not have this prefix - let's strip for the massChange feature
	 *
	 * @param	string	$k	Key
	 * @param	mixed	$v	Value
	 * @return	void
	 */
	public function __set( $k, $v )
	{
		if( mb_strpos( $k, "goal_" ) === 0 AND $k != 'goal_status' )
		{
			$k = preg_replace( "/^goal_(.+?)$/", "$1", $k );
			$this->$k	= $v;
			return;
		}

		parent::__set( $k, $v );
	}        
    
	/**
	 * [Node] Get whether or not this node is enabled
	 *
	 * @note	Return value NULL indicates the node cannot be enabled/disabled
	 * @return	bool|null
	 */
	protected function get__enabled()
	{
		return $this->show;
	}

	/**
	 * [Node] Set whether or not this node is enabled
	 *
	 * @param	bool|int	$enabled	Whether to set it enabled or disabled
	 * @return	void
	 */
	protected function set__enabled( $enabled )
	{
		$this->show = $enabled;
	} 
    
	/**
	 * Get number of items
	 *
	 * @return	int
	 */
	protected function get__items()
	{
		return (int) $this->donations;
	}
	
	/**
	 * Set number of items
	 *
	 * @param	int	$val	Items
	 * @return	int
	 */
	protected function set__items( $val )
	{
		$this->donations = (int) $val;
	}    

	/**
	 * [Node] Get description
	 *
	 * @return	string
	 */
	protected function get__description()
	{
	    /* Format dates */
	    $startDate = $this->start_date ? \IPS\DateTime::ts( $this->start_date )->format( 'Y-m-d' ) : '';	   
	    $endDate   = $this->end_date ? ' - '. \IPS\DateTime::ts( $this->end_date )->format( 'Y-m-d' ) : '';
        
		return $startDate . $endDate;
	}   
    
	/**
	 * Get received amount with fee calcuation
	 *
	 */
	public function get__received()
	{
	    /* Override received amount with fee calculation */
		if( \IPS\Settings::i()->dt_include_fees )
        {
            $fees = \IPS\Db::i()->select( 'SUM(fees)', 'donate_users', array( array( 'goal=?', $this->id ) ) )->first(); 
            return $this->received - $fees;    
        }
        
        return $this->received;
	}         
    
	/**
	 * Get currency
	 *
	 */
	public function get__currency()
	{
		if ( $this->cur )
		{
			try
			{
			    $currency = \IPS\donate\Currency::load( $this->cur );
				return $currency->tag;
			}
			catch ( \OutOfRangeException $e ) { }
		}
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
	 * @brief	Cached URL
	 */
	protected $_url	= NULL;

	/**
	 * Get URL
	 *
	 * @return	\IPS\Http\Url
	 */
	public function url()
	{
		if( $this->_url === NULL )
		{
			$this->_url = \IPS\Http\Url::internal( "app=donate&module=donate&controller=browse&id={$this->_id}", 'front', 'donate_goal', array( $this->seo_name ? $this->seo_name : 'goal' ) ); /* Add backup seo name */
		}

		return $this->_url;
	}    
         
	/**
	 * [Node] Add/Edit Form
	 *
	 * @param	\IPS\Helpers\Form	$form	The form
	 * @return	void
	 */
	public function form( &$form )
	{        
        /* Goal form */  
        $form->addHeader( $this->id ? 'add_goal' : 'add_goal' ); 
        $form->add( new \IPS\Helpers\Form\Translatable( 'goal_name', NULL, TRUE, array( 'app' => 'donate', 'key' => ( $this->id ? "donate_goal_{$this->id}" : NULL ) ) ) );
        $form->add( new \IPS\Helpers\Form\Number( 'goal_amount', $this->id ? $this->amount : '100.00', TRUE, array( 'decimals' => 2 ), NULL, NULL, NULL, 'amount' ) );        
        $form->add( new \IPS\Helpers\Form\Node( 'goal_cur', $this->id ? $this->cur : 1, TRUE, array( 'class' => '\IPS\donate\Currency' ) ) );
        $form->add( new \IPS\Helpers\Form\DateRange( 'goal_date_range', $this->id ? array( 'start' => $this->start_date, 'end' => $this->end_date ) : array( 'start' => time(), 'end' => 0 ), FALSE, array( 'unlimited' => 0, 'unlimitedLang' => "disable" ), NULL, NULL, NULL, 'date_range' ) );  
        $form->add( new \IPS\Helpers\Form\YesNo( 'goal_show', $this->id ? $this->show : TRUE, FALSE, array( 'togglesOn' => array( 'goal_force' ) ) ) );   
        $form->add( new \IPS\Helpers\Form\YesNo( 'goal_force', $this->id ? $this->force : TRUE, FALSE, array(), NULL, NULL, NULL, 'goal_force' ) );   
		$form->add( new \IPS\Helpers\Form\YesNo( 'goal_private', $this->id ? $this->private : FALSE, FALSE, array() ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'goal_featured', $this->id ? $this->featured : FALSE, FALSE, array() ) );
  
		$form->add( new \IPS\Helpers\Form\Translatable( 'goal__desc', NULL, FALSE, array(
			'app'		=> 'donate',
			'key'		=> ( $this->id ? "donate_goal_{$this->id}_desc" : NULL ),
			'editor'	=> array(
				'app'			=> 'donate',
				'key'			=> 'Goals',
				'autoSaveKey'	=> ( $this->id ? "donate-goal-{$this->id}-desc" : "donate-new-goal-desc" ),
				'attachIds'		=> $this->id ? array( $this->id, NULL, 'desc' ) : NULL, 'minimize' => 'desc_placeholder'
			)
		), NULL, NULL, NULL, 'goal__desc' ) );
        
        /* Set paypal email address? */
		try
		{
			$gateway = \IPS\donate\Gateway::load( 'paypal', 'gw_file' ); 
            
            if( $gateway->active )
            {
                 $form->addHeader( 'goalemails__paypal_settings' ); 
                 $form->add( new \IPS\Helpers\Form\Text( 'goalemails__paypal', $this->id ? $this->emails  : '', FALSE, array() ) );    
            }
		}
		catch( \OutOfRangeException $e ){}         
	}
	
	/**
	 * [Node] Format form values from add/edit form for save
	 *
	 * @param	array	$values	Values from the form
	 * @return	array
	 */
	public function formatFormValues( $values )
	{ 
		if ( !$this->id )
		{
			$this->save();
		}	   
        
        /* Save paypal gateway email */
		if( isset( $values['goalemails__paypal'] ) )
		{
			$values['g_emails'] = $values['goalemails__paypal'] ? $values['goalemails__paypal'] : NULL;
            unset( $values['goalemails__paypal'] );
		}        
        
        /* Sort out date range */
        if( $values['goal_date_range'] )
        {
            $values['start_date'] = ( $values['goal_date_range']['start'] ) ? $values['goal_date_range']['start']->getTimestamp() : time(); /* We need this */   
            $values['end_date']   = ( $values['goal_date_range']['end'] ) ? $values['goal_date_range']['end']->getTimestamp() : 0;  
            
            unset( $values['goal_date_range'] ); 
        }

        /* Check currency field */
		if( isset( $values['goal_cur'] ) )
		{
			$values['goal_cur'] = $values['goal_cur'] ? intval( $values['goal_cur']->id ) : 0;
		}	   
                      
        /* Save custom lang */        
		foreach ( array( 'goal_name' => "donate_goal_{$this->id}", 'goal__desc' => "donate_goal_{$this->id}_desc" ) as $fieldKey => $langKey )
		{
			if ( isset( $values[ $fieldKey ] ) )
			{
				\IPS\Lang::saveCustom( 'donate', $langKey, $values[ $fieldKey ] );
				
				if ( $fieldKey === 'goal_name' )
				{
					$this->seo_name = \IPS\Http\Url::seoTitle( $values[ $fieldKey ][ \IPS\Lang::defaultLanguage() ] );
				}
				
				unset( $values[ $fieldKey ] );
			}
		}  

		return $values;
	}
    
 	/**
	 * [Node] Perform actions after saving the form
	 *
	 * @param	array	$values	Values from the form
	 * @return	void
	 */
	public function postSaveForm( $values )
	{
	    /* Rebuild goals */
	    $this->rebuildGoalStats();
        
        /* Rebuild widget cache */
        \IPS\Widget::deleteCaches( 'donateGoals', 'donate' );
        \IPS\Widget::deleteCaches( 'donateStats', 'donate' );
       
        /* Clear attachments */
		\IPS\File::claimAttachments( 'donate-new-goal-desc', $this->id, NULL, 'desc', TRUE );
	}    
     
  	/**
	 * [Node] Rebuild goal stats
	 *
	 * @return	void
	 */
	public function rebuildGoalStats()
	{
        $donationWhere[] = array( 'goal=? AND status=?', $this->_id, 1 );
        
        /* Automatic reset? */
        if( \IPS\Settings::i()->dt_donation_reset )
        {
            $donationWhere[] = array( 'date>?', (int) \IPS\Settings::i()->dt_donation_reset );    
        } 	   
        
   	    /* Calculate received based on gateway fee setting. */
		if( \IPS\Settings::i()->dt_include_fees )
        {
            $this->received = \IPS\Db::i()->select( 'SUM(amount - fees * rate)', 'donate_users', $donationWhere )->first();           
        }
        else
        {
            $this->received = \IPS\Db::i()->select( 'SUM(amount * rate)', 'donate_users', $donationWhere )->first();             
        }
       
	    /* Calculate totals for everything else. */
        $this->donations   = \IPS\Db::i()->select( 'COUNT(*)', 'donate_users', $donationWhere )->first();
        $this->goal_status = ( $this->received ) ? ( $this->received / $this->amount ) * 100 : 0;
        
        /* Close if target reached */
        if( !$this->force && $this->received >= $this->amount )
        {
            $this->show = 0;
        }
        
        /* Save goal */
        $this->save();
	} 
    
  	/**
	 * [Node] Rebuild all active goals
	 *
	 * @return	void
	 */
	public static function rebuildActiveGoals()
	{
	    /* Rebuild all goals that are active. */
        foreach( \IPS\donate\Goal::roots( NULL, NULL, array( 'g_show=1' ) ) as $goal )
        {
            $goal->rebuildGoalStats();
        }  
	}    
    
	/**
	 * Return sharelinks for this node
	 *
	 * @return array
	 */
	public function sharelinks()
	{
        $sharelinks = array();

		$shareService	= 'IPS\core\ShareLinks\Service';

		foreach( $shareService::shareLinks() as $node )
		{
			if( $node->enabled and ( $node->groups === "*" or \IPS\Member::loggedIn()->inGroup( explode( ',', $node->groups ) ) ) )
			{
				if( file_exists( \IPS\ROOT_PATH . '/system/Content/ShareServices/' . ucwords( $node->key ) . '.php' ) )
				{
					$className	= "IPS\\Content\\ShareServices\\" . ucwords( $node->key );
					$sharelinks[ $node->key ]	= new $className( $this->url(), $this->_title );
				}
			}
		}
		
		return $sharelinks;
	}    

	/**
	 * [ActiveRecord] Delete Record
	 *
	 * @return	void
	 */
	public function delete()
	{
		\IPS\File::unclaimAttachments( 'donate_goals', $this->id );
		parent::delete();
        
		foreach ( array( 'name' => "donate_goal_{$this->id}",
                         'desc' => "donate_goal_{$this->id}_desc"  ) as $fieldKey => $langKey )
		{        
			\IPS\Lang::deleteCustom( 'donate', $langKey );
		}
	}

}