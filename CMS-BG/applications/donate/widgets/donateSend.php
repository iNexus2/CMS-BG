<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2016 DevFuse
 */

namespace IPS\donate\widgets;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * donateSend Widget
 */
class _donateSend extends \IPS\Widget\StaticCache
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'donateSend';
	
	/**
	 * @brief	App
	 */
	public $app = 'donate';
		
	/**
	 * @brief	Plugin
	 */
	public $plugin = '';
	
	/**
	 * Render a widget
	 *
	 * @return	string
	 */
	public function render()
	{
	    /* Can send donations? */
        if( !\IPS\Member::loggedIn()->group['g_dt_send_donations'] )
        {
            return '';
        }       
       
  		/* More info form */
		/*$form = new \IPS\Helpers\Form( 'form', 'donate_send_donation', \IPS\Http\Url::internal( "app=donate&module=donate&controller=send&do=send", 'front' ) );
		$form->class = 'ipsForm_noLabels ipsForm_fullWidth ipsPad';
        
        $form->add( new \IPS\Helpers\Form\Member( 'donatesend_member_id', \IPS\Member::loggedIn(), TRUE ) );
        $form->add( new \IPS\Helpers\Form\Number( 'donatesend_amount', '10.00', TRUE, array( 'decimals' => 2 ) ) );
        $form->add( new \IPS\Helpers\Form\TextArea( 'donatesend_note', NULL, FALSE, array( 'placeholder' => \IPS\Member::loggedIn()->language()->addToStack('donatesend_note_placeholder') ) ) ); */                                   
        	
		return $this->output(); 
	}
}