<?php
/**
 * @package		Messages
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
namespace IPS\gms;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Message Node
 */
class _Message extends \IPS\Node\Model
{
	protected static $multitons;    
    public static $databaseColumnId = 'id';
	public static $databaseTable = 'gms_messages';
	public static $databasePrefix = '';
	public static $databaseColumnOrder = 'position';
	public static $nodeTitle = 'module__messages_messages';
	public static $titleLangPrefix = 'gms_message_';
    public static $descriptionLangSuffix = '_message';
        
	/**
	 * [Node] Get whether or not this node is enabled
	 *
	 * @note	Return value NULL indicates the node cannot be enabled/disabled
	 * @return	bool|null
	 */
	protected function get__enabled()
	{
		return $this->status;
	}

	/**
	 * [Node] Set whether or not this node is enabled
	 *
	 * @param	bool|int	$enabled	Whether to set it enabled or disabled
	 * @return	void
	 */
	protected function set__enabled( $enabled )
	{
		$this->status	= $enabled;
	}  
    
	/**
	 * [Node] Get Description
	 *
	 * @return	string|null
	 */
	protected function get__description()
	{
	    /* Yeah get rid of this */
	    if( \IPS\Dispatcher::i()->controllerLocation == 'admin' )
        {
            return FALSE;    
        }
        
        /* Get message lang */
		try
		{
		    /* Lets try this for now */
		    $message = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', \IPS\Member::loggedIn()->language()->get( 'gms_message_' . $this->id . '_message' ) );
			return $message;
		}
		catch( \UnderflowException $e )
		{
			return FALSE;
		}
	}  
    
	/**
	 * Member can see message?
	 */
	public function canSee()
	{
        /* Make sure enabled */
        if( !$this->status )
        {
            return FALSE;    
        }  
        
        /* Any forum restrictions? */
        if( $this->forums != '*' )
        {
            /* Only show in forums */
            if( \IPS\Dispatcher::i()->controller != 'forums' )
            {
                return FALSE;
            }
              
            /* If in forums, only show to specified forums */            
            if( \IPS\Dispatcher::i()->controller == 'forums' AND !in_array( \IPS\Request::i()->id, explode( ',', $this->forums ) ) )
            {
                return FALSE;   
            }                 
        }     

        /* Can view in this skin */
        if( $this->skins != '*' && !in_array( \IPS\Theme::defaultTheme(), explode( ',', $this->skins ) ) )
        {
            return FALSE;   
        }         

        /* Has group perms? */
        if( $this->perms != '*' && !\IPS\Member::loggedIn()->inGroup( explode( ',', $this->perms ) ) )
        {
            return FALSE; 
        }   
        
        /* Above days joined number? */
        if( $this->days_joined && \IPS\Member::loggedIn()->joined->diff( \IPS\DateTime::create() )->days >= $this->days_joined )
        {
            return FALSE;
        }
		
		return TRUE;
	}
    
	/**
	 * Get the messages
	 */
	public static function messages()
	{
	    /* Change to random order */
	    if( \IPS\Settings::i()->gms_orderby == 'random' )
        {
            static::$databaseColumnOrder = 'rand()';    
        }
        
        $messages = array();
        
        /* Get messages */
        $_messages = parent::roots();    
        
        /* See what we can view */
        foreach( $_messages as $message )
        {
            /* Can see message? */
            if( $message->canSee() )
            {
                $messages[] = $message;    
            }        
        }

        /* Cut down messages */
        if( \IPS\Settings::i()->gms_limit AND count( $messages ) )
        {
            $messages = array_slice( $messages, 0, intval( \IPS\Settings::i()->gms_limit ), TRUE );    
        }   
      
        /* Return messages */
		return $messages;
	}                
        	
	/**
	 * [Node] Add/Edit Form
	 *
	 * @param	\IPS\Helpers\Form	$form	The form
	 * @return	void
	 */
	public function form( &$form )
	{		
        /* Decode json fields */        
        $this->options = json_decode( $this->options );        

        /* Display form */  
        $form->addTab( 'message' );     
		$form->addHeader( 'message' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'status', $this->id ? $this->status : TRUE, FALSE, array() ) );
		$form->add( new \IPS\Helpers\Form\Translatable( 'title', NULL, TRUE, array( 'app' => 'gms', 'key' => ( $this->id ? "gms_message_{$this->id}" : NULL ) ) ) );
  		$form->add( new \IPS\Helpers\Form\Translatable( 'message', NULL, TRUE, array(
			'app'		=> 'gms',
			'key'		=> ( $this->id ? "gms_message_{$this->id}_message" : NULL ),
			'editor'	=> array(
				'app'			=> 'gms',
				'key'			=> 'Messages',
				'autoSaveKey'	=> ( $this->id ? "gms-message-{$this->id}-message" : "gms-new-message-message" ),
				'attachIds'		=> $this->id ? array( $this->id, NULL, 'message' ) : NULL, 'minimize' => 'message_placeholder'
			)
		), NULL, NULL, NULL, 'message' ) );

        $form->addTab( 'settings' );     
		$form->addHeader( 'settings' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'show_title', $this->id ? $this->show_title : TRUE, FALSE, array() ) );
        $form->add( new \IPS\Helpers\Form\Number( 'days_joined', $this->id ? $this->days_joined : 0, FALSE, array(), NULL, NULL, \IPS\Member::loggedIn()->language()->addToStack('days'), 'days_joined' ) );
        $form->add( new \IPS\Helpers\Form\Select( 'perms', ( $this->id AND $this->perms != '*' ) ? explode( ',', $this->perms ) : '*', FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'multiple' => true, 'unlimited' => '*', 'unlimitedLang' => 'perms_unlimitedLang' ), NULL, NULL, NULL, 'perms' ) );
        $form->add( new \IPS\Helpers\Form\Node( 'forums', ( $this->id AND $this->forums != '*' ) ? explode( ',', $this->forums ) : 0, FALSE, array( 'class' => 'IPS\forums\Forum', 'permissionCheck' => function ( $forum ) { return $forum->sub_can_post and !$forum->redirect_url; }, 'multiple' => true, 'zeroVal' => 'forums_zeroVal' ), NULL, NULL, NULL, 'forums' ) );
        $form->add( new \IPS\Helpers\Form\Node( 'skins', ( $this->id AND $this->skins != '*' ) ? explode( ',', $this->skins ) : 0, FALSE, array( 'class' => '\IPS\Theme', 'multiple' => true, 'zeroVal' => 'skins_zeroVal' ), NULL, NULL, NULL, 'skins' ) );
        $form->add( new \IPS\Helpers\Form\Select( 'message_style', ( isset( $this->options->message_style ) AND $this->options->message_style ) ? $this->options->message_style : 1, FALSE, array( 'options' => array( 1 => 'style_normal', 2 => 'style_message', 3 => 'style_error', 5 => 'style_success', 6 => 'style_warning', 4 => 'style_other' ), 'userSuppliedInput'	=> 4, 'toggles'	=> array( 4	=> array( '4_message_style' ) ) ), NULL, NULL, NULL, 'message_style' ) );   
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
            \IPS\File::claimAttachments( 'gms-new-message-message', $this->id, NULL, 'description', TRUE );
		}	   
               
        /* Save custom lang */        
		foreach ( array( 'title' => "gms_message_{$this->id}", 'message' => "gms_message_{$this->id}_message" ) as $fieldKey => $langKey )
		{
			if ( isset( $values[ $fieldKey ] ) )
			{
				\IPS\Lang::saveCustom( 'gms', $langKey, $values[ $fieldKey ] );
				unset( $values[ $fieldKey ] );
			}
		}  
        
        /* Check forum */
		if( isset( $values['forums'] ) )
		{
			if ( $values['forums'] == 0 )
			{
				$values['forums'] = '*';
			}
			else 
			{
				$forums = array();
				foreach ( $values['forums'] as $forum )
				{
					$forums[] = $forum->_id;
				}
				
				$values['forums'] = ( implode( ',', $forums ) );
			}
		}

        /* Check skin */
		if( isset( $values['skins'] ) )
		{
			if ( $values['skins'] == 0 )
			{
				$values['skins'] = '*';
			}
			else 
			{
				$skins = array_keys( $values['skins'] );				
				$values['skins'] = ( implode( ',', $skins ) );
			}
		}        

        /* Setup options settings */
		foreach ( array( 'message_style' ) as $optionField )
        {       
            $values['options'][ $optionField ] = $values[ $optionField ];    
            unset( $values[ $optionField ] );
        }            
        
        /* Encode json fields */
        $values['options'] = json_encode( $values['options'] );  

		/* Send to parent */
		return $values;
	}  

	/**
	 * Delete Record
	 *
	 * @return	void
	 */
	public function delete()
	{
	    \IPS\File::unclaimAttachments( 'gms_Messages', $this->id );
		parent::delete();
        
        /* Delete custom lang */
		foreach ( array( 'title' => "gms_message_{$this->id}", 'message' => "gms_message_{$this->id}_message" ) as $fieldKey => $langKey )
		{        
			\IPS\Lang::deleteCustom( 'gms', $langKey );
		}
	}  
}