<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\widgets;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * donateGoals Widget
 */
class _donateGoals extends \IPS\Widget\PermissionCache
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'donateGoals';
	
	/**
	 * @brief	App
	 */
	public $app = 'donate';
		
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
		parent::init();
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
 
		$form->add( new \IPS\Helpers\Form\Node( 'select_goal', isset( $this->configuration['select_goal'] ) ? $this->configuration['select_goal'] : 0, FALSE, array( 'class' => 'IPS\donate\Goal', 'zeroVal' => 'select_goal_zeroVal', ) ) );
 		
		$form->add( new \IPS\Helpers\Form\Number( 'goal_limit', isset( $this->configuration['goal_limit'] ) ? $this->configuration['goal_limit'] : 5, FALSE, array(), NULL, NULL, NULL, 'goal_limit' ) );
		$form->add( new \IPS\Helpers\Form\Select( 'goal_type', isset( $this->configuration['goal_type'] ) ? $this->configuration['goal_type'] : 1, FALSE, array( 'options' => array( 1 => 'latest_goals', 2 => 'featured_goals' ) ), NULL, NULL, NULL, 'goal_type' ) );

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
 	    if( isset( $values['select_goal'] ) AND $values['select_goal'] )
        {
            $values['select_goal'] = $values['select_goal']->id;
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
	    $goal  = NULL;
	    $goals = NULL;
        
	    /* Can view goals? */
        if( !\IPS\Member::loggedIn()->group['g_dt_view_goals'] )	
        {
            return '';    
        }        
               
	    /* Show selected goal */
	    if( isset( $this->configuration['select_goal'] ) AND $this->configuration['select_goal'] )
        {
            try
            {
                $goal = \IPS\donate\Goal::load( $this->configuration['select_goal'] );
                
                if( !$goal->show )
                {
                    return '';
                }
            }
            catch ( \OutOfRangeException $e ) 
            { 
                return ''; 
            }  
        }
        else
        {
            $goals = \IPS\donate\Goal::roots( NULL, NULL, ( isset( $this->configuration['goal_type'] ) AND $this->configuration['goal_type'] == 1 ) ? array( 'g_featured=0 AND g_show=1' ) : array( 'g_featured=1 AND g_show=1' ) ); 
        }
       
		return $this->output( $goal, $goals );
	}
}