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
 * donateDonations Widget
 */
class _donateDonations extends \IPS\Widget
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'donateDonations';
	
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

		$form->add( new \IPS\Helpers\Form\Node( 'd_goal', isset( $this->configuration['d_goal'] ) ? $this->configuration['d_goal'] : 0, FALSE, array( 'class' => 'IPS\donate\Goal', 'multiple' => TRUE, 'zeroVal' => 'd_goal_zeroVal' ) ) );		
		$form->add( new \IPS\Helpers\Form\Number( 'd_limit', isset( $this->configuration['d_limit'] ) ? $this->configuration['d_limit'] : 5, FALSE, array(), NULL, NULL, NULL, 'd_limit' ) );
		$form->add( new \IPS\Helpers\Form\Select( 'd_type', isset( $this->configuration['d_type'] ) ? $this->configuration['d_type'] : 1, FALSE, array( 'options' => array( 1 => 'latest_donations', 2 => 'top_donors' ) ), NULL, NULL, NULL, 'd_type' ) );

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
        /* Check goal */
		if( isset( $values['d_goal'] ) AND $values['d_goal'] )
		{
			$goals = array();
			foreach ( $values['d_goal'] as $goal )
			{
				$goals[] = $goal->_id;
			}
			
			$values['d_goal'] = ( implode( ',', $goals ) );
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
	    /* Can view donations? */
        if( !\IPS\Member::loggedIn()->group['g_dt_view_donations'] )	
        {
            return '';    
        } 	   
       
        /* Setup where array */
        $where[] = array( 'status=?', 1 );
        
        /* Automatic reset? */
        if( \IPS\Settings::i()->dt_donation_reset )
        {
            $where[] = array( 'date>?', (int) \IPS\Settings::i()->dt_donation_reset );    
        }        
        
        /* Filter by goal? */
        if( isset( $this->configuration['d_goal'] ) AND $this->configuration['d_goal'] )
        {   
            $where[] = array( 'goal IN(' . $this->configuration['d_goal'] . ')' );
        }
        
        $donations = array();

        /* Get top donors */
        if( isset( $this->configuration['d_type'] ) AND $this->configuration['d_type'] == 2 )
        {
            $where[] = array( 'member_id>?', 0 );
            $where[] = array( 'anon=?', 0 );
            $where[] = array( 'anon_amount=?', 0 );            
            
            try
            {
                $donations = \IPS\Db::i()->select( 'member_id as member, SUM(amount) AS total_amount', 'donate_users', $where, 'total_amount DESC', ( isset( $this->configuration['d_limit'] ) ) ? $this->configuration['d_limit'] : 5, array( 'member_id' ) )->setKeyField('member')->setValueField('total_amount') ;   		                
            }
            catch ( \IPS\Db\Exception $e )
            {
                return '';
            }                
        }
        
        /* Get latest donations */
        else
        {
    		foreach( \IPS\Db::i()->select( '*' ,'donate_users', $where, 'date DESC', isset( $this->configuration['d_limit'] ) ? $this->configuration['d_limit'] : 5 ) as $donation )
    		{
                $donations[] = \IPS\donate\Donation::constructFromData( $donation );
    		}
        }

		return $this->output( $donations, ( isset( $this->configuration['d_type'] ) AND $this->configuration['d_type'] ) ? $this->configuration['d_type'] : 1 );
	}
}