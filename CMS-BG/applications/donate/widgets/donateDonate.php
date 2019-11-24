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
 * donateDonate Widget
 */
class _donateDonate extends \IPS\Widget\StaticCache
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'donateDonate';
	
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
	 * Render a widget
	 *
	 * @return	string
	 */
	public function render()
	{
	    /* Can donate? */
        if( !\IPS\Member::loggedIn()->group['g_dt_donate'] )
        {
            return '';
        }       
       
  		/* More info form */
		$form = new \IPS\Helpers\Form( 'form', 'donate', \IPS\Http\Url::internal( "app=donate&module=donate&controller=payment&_new=1", 'front', 'donate_donate' ) );
		$form->class = 'ipsForm_noLabels ipsForm_fullWidth ipsPad';
        
        /* Amount select or enter */
        /* Temp removal until better solution can be found for this bug http://www.devfuse.com/forums/tracker/issue-1025-321-donation-box-widget/?catfilter=1 */
        /* Payment page has amount details anyway, so not a complete loss */
        /*if( \IPS\Settings::i()->dt_amounts )
        {
            $form->add( new \IPS\Helpers\Form\Select( 'amount', NULL, FALSE, array( 'options' => array_combine( explode( ',', \IPS\Settings::i()->dt_amounts ), explode( ',', \IPS\Settings::i()->dt_amounts ) ) ) ) );        
        }
        else
        {
            $form->add( new \IPS\Helpers\Form\Text( 'amount', NULL, FALSE, array( 'placeholder' => \IPS\Member::loggedIn()->language()->addToStack('enter_amount') ) ) );  
        }*/                                       
        	
		return $this->output( $form );   

	}
}