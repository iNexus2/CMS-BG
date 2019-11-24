<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\modules\admin\goals;

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
		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('goal_settings');

		$form = new \IPS\Helpers\Form;

        $form->addHeader( 'goal_settings' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_enable_goal_rss', \IPS\Settings::i()->dt_enable_goal_rss, FALSE, array(), NULL, NULL, NULL, 'dt_enable_goal_rss' ) );     
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_goal_close', \IPS\Settings::i()->dt_goal_close, FALSE, array(), NULL, NULL, NULL, 'dt_goal_close' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_member_rewards_total_donations', \IPS\Settings::i()->dt_member_rewards_total_donations, FALSE, array(), NULL, NULL, NULL, 'dt_member_rewards_total_donations' ) ); 
        $form->add( new \IPS\Helpers\Form\Number( 'dt_latest_goals', \IPS\Settings::i()->dt_latest_goals, FALSE, array(), NULL, NULL, NULL, 'dt_latest_goals' ) ); 
        $form->add( new \IPS\Helpers\Form\Number( 'dt_goal_total', \IPS\Settings::i()->dt_goal_total, FALSE, array( 'unlimited' => 0, 'unlimitedLang' => 'disable' ), NULL, NULL, NULL, 'dt_goal_total' ) ); 
  
		if ( $values = $form->values() )
		{
			$form->saveAsSettings();
		}

		\IPS\Output::i()->output = $form;
	}
}