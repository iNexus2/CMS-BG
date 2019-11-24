<?php
/**
 * @package		Messages
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\gms\widgets;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * messageBlock Widget
 */
class _messageBlock extends \IPS\Widget\PermissionCache
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'messageBlock';
	
	/**
	 * @brief	App
	 */
	public $app = 'gms';
		
	/**
	 * @brief	Plugin
	 */
	public $plugin = '';
	
	/**
	 * Initialise this widget
	 *
	 * @return void
	 */ 
	public function init()
	{
		/*parent::init();*/
        $this->template( array( \IPS\Theme::i()->getTemplate( 'global', 'gms', 'front' ), 'messageRow' ) );
	}
	
	/**
	 * Specify widget configuration
	 *
	 * @param	null|\IPS\Helpers\Form	$form	Form object
	 * @return	null|\IPS\Helpers\Form
	 */
	public function configuration( &$form=null )
	{
 		if ( $form === null )
		{
	 		$form = new \IPS\Helpers\Form;
 		}

        $form->add( new \IPS\Helpers\Form\Node( 'message', isset( $this->configuration['message'] ) ? $this->configuration['message'] : 0, FALSE, array( 'class' => 'IPS\gms\Message', 'zeroVal' => "message_zeroVal" ) ) );
 		
        return $form;
 	} 
 	
 	 /**
 	 * Ran before saving widget configuration
 	 *
 	 * @param	array	$values	Values from form
 	 * @return	array
 	 */
 	public function preConfig( $values )
 	{
 	    if( isset( $values['message'] ) AND $values['message'] )
        {
            $values['message'] = $values['message']->id;
        }  	  
      
 		return $values;
 	}

	/**
	 * Render a widget
	 *
	 * @return	string
	 */
	public function render()
	{
	    $message = NULL;
        
        /* What? */
        if( !isset( $this->configuration['message'] ) OR !$this->configuration['message'] )
        {
            return \IPS\Theme::i()->getTemplate( 'global', 'gms', 'front' )->messageList( TRUE );    
        }
       
	    /* Get selected message */
        try
        {
            $message = \IPS\gms\Message::load( $this->configuration['message'] );
        }
        catch ( \OutOfRangeException $e ) 
        { 
            return ''; 
        }        

        /* Print widget */
		return $this->output( $message );
	}
}