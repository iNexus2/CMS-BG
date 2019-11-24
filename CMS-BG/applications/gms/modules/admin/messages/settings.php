<?php
/**
 * @package		Messages
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\gms\modules\admin\messages;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * settings
 */
class _settings extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'settings_manage' );
		parent::execute();
	}

	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('settings');

		$form = new \IPS\Helpers\Form;

        /* Form Settings */
        $form->addHeader( 'general_settings' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'gms_enable', \IPS\Settings::i()->gms_enable, FALSE, array( 'togglesOn' => array( 'gms_include_global_title', 'gms_collapse', 'gms_orderby', 'gms_limit' ) ), NULL, NULL, NULL, 'gms_enable' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'gms_include_global_title', \IPS\Settings::i()->gms_include_global_title, FALSE, array( 'togglesOn' => array( 'gms_title' ) ), NULL, NULL, NULL, 'gms_include_global_title' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'gms_title', NULL, FALSE, array( 'app' => 'gms', 'key' => 'gms_title_value' ), NULL, NULL, NULL, 'gms_title' ) );    
        $form->add( new \IPS\Helpers\Form\YesNo( 'gms_collapse', \IPS\Settings::i()->gms_collapse, FALSE, array(), NULL, NULL, NULL, 'gms_collapse' ) );
        $form->add( new \IPS\Helpers\Form\Select( 'gms_orderby', \IPS\Settings::i()->gms_orderby, FALSE, array( 'options' => array( 'random' => 'gms_orderby_random', 'position' => 'gms_orderby_position'  ) ), NULL, NULL, NULL, 'gms_orderby' ) );
        $form->add( new \IPS\Helpers\Form\Number( 'gms_limit', \IPS\Settings::i()->gms_limit, FALSE, array(), NULL, NULL, NULL, 'gms_limit' ) );
          
		if ( $values = $form->values() )
		{
		    /* Save translatable fields */
			foreach ( array( 'gms_title' => 'gms_title_value' ) as $k => $v )
			{
				\IPS\Lang::saveCustom( 'gms', $v, $values[ $k ] );
				unset( $values[ $k ] );
			}		  
          
			$form->saveAsSettings();
		}

		\IPS\Output::i()->output = $form;
	}
}