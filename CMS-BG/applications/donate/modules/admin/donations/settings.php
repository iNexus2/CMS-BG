<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\modules\admin\donations;

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
		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('donation_settings');

		/* Get tags */
		$tags = \IPS\donate\Donation::getTags();

		$form = new \IPS\Helpers\Form;

        $form->addHeader( 'donation_settings' );
        $form->add( new \IPS\Helpers\Form\Text( 'dt_amounts', \IPS\Settings::i()->dt_amounts, FALSE, array( 'nullLang' => 'dt_amounts_null' ), NULL, NULL, NULL, 'dt_amounts' ) );
        $form->add( new \IPS\Helpers\Form\Text( 'dt_min_donation', \IPS\Settings::i()->dt_min_donation, FALSE, array(), NULL, NULL, NULL, 'dt_min_donation' ) ); 
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_enable_donation_rss', \IPS\Settings::i()->dt_enable_donation_rss, FALSE, array(), NULL, NULL, NULL, 'dt_enable_donation_rss' ) ); 
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_anon_donation', \IPS\Settings::i()->dt_anon_donation, FALSE, array(), NULL, NULL, NULL, 'dt_anon_donation' ) ); 
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_anon_donation_amount', \IPS\Settings::i()->dt_anon_donation_amount, FALSE, array(), NULL, NULL, NULL, 'dt_anon_donation_amount' ) ); 
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_include_fees', \IPS\Settings::i()->dt_include_fees, FALSE, array(), NULL, NULL, NULL, 'dt_include_fees' ) ); 
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_hide_topic_hook', \IPS\Settings::i()->dt_hide_topic_hook, FALSE, array(), NULL, NULL, NULL, 'dt_hide_topic_hook' ) ); 
        $form->add( new \IPS\Helpers\Form\Node( 'dt_default_currency', \IPS\Settings::i()->dt_default_currency, FALSE, array( 'class' => '\IPS\donate\Currency' ) ) );

        $form->addHeader( 'donate_topic_settings_header' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_create_topic', \IPS\Settings::i()->dt_create_topic, FALSE, array( 'togglesOn' => array( 'dt_topic_author', 'dt_create_own_topic', 'dt_create_topic_forum', 'dt_topic_title', 'dt_topic_message' ) ), NULL, NULL, NULL, 'dt_create_topic' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_create_own_topic', \IPS\Settings::i()->dt_create_own_topic, FALSE, array( 'togglesOff' => array( 'dt_topic_author' ) ), NULL, NULL, NULL, 'dt_create_own_topic' ) );
        $form->add( new \IPS\Helpers\Form\Member( 'dt_topic_author', ( \IPS\Settings::i()->dt_topic_author ) ? \IPS\Member::load( \IPS\Settings::i()->dt_topic_author ) : \IPS\Member::loggedIn(), FALSE, array(), NULL, NULL, NULL, 'dt_topic_author' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'dt_topic_title', NULL, FALSE, array( 'app' => 'donate', 'key' => 'dt_topic_title_value' ), NULL, NULL, NULL, 'dt_topic_title' ) );
        $form->add( new \IPS\Helpers\Form\Node( 'dt_create_topic_forum', \IPS\Settings::i()->dt_create_topic_forum ?: NULL, FALSE, array( 'class' => 'IPS\forums\Forum', 'multiple' => FALSE, 'permissionCheck' => function ( $forum ) { return $forum->sub_can_post and !$forum->redirect_url; } ), NULL, NULL, NULL, 'dt_create_topic_forum' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'dt_topic_message', NULL, FALSE, array( 'app' => 'donate', 'key' => 'dt_topic_message_value', 'editor' => array( 'app' => 'core', 'key' => 'Admin', 'autoSaveKey' => 'dt_topic_message', 'attachIds' => array( NULL, NULL, 'dt_topic_message' ), 'tags' => $tags ) ), NULL, NULL, NULL, 'dt_topic_message' ) );

        $form->addHeader( 'donate_pm_settings_header' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_new_promotion_pm', \IPS\Settings::i()->dt_new_promotion_pm, FALSE, array(), NULL, NULL, NULL, 'dt_new_promotion_pm' ) );         
        $form->add( new \IPS\Helpers\Form\YesNo( 'dt_new_donation_pm', \IPS\Settings::i()->dt_new_donation_pm, FALSE, array( 'togglesOn' => array( 'dt_pm_sender', 'dt_new_donation_pm_subject', 'dt_new_donation_pm_message' ) ), NULL, NULL, NULL, 'dt_new_donation_pm' ) ); 
        $form->add( new \IPS\Helpers\Form\Member( 'dt_pm_sender', ( \IPS\Settings::i()->dt_pm_sender ) ? \IPS\Member::load( \IPS\Settings::i()->dt_topic_author ) : \IPS\Member::loggedIn(), FALSE, array(), NULL, NULL, NULL, 'dt_pm_sender' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'dt_new_donation_pm_subject', NULL, FALSE, array( 'app' => 'donate', 'key' => 'dt_new_donation_pm_subject_value' ), NULL, NULL, NULL, 'dt_new_donation_pm_subject' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'dt_new_donation_pm_message', NULL, FALSE, array( 'app' => 'donate', 'key' => 'dt_new_donation_pm_message_value', 'editor' => array( 'app' => 'core', 'key' => 'Admin', 'autoSaveKey' => 'dt_new_donation_pm_message', 'attachIds' => array( NULL, NULL, 'dt_new_donation_pm_message' ), 'tags' => $tags ) ), NULL, NULL, NULL, 'dt_new_donation_pm_message' ) );

		if ( $values = $form->values() )
		{
		    $rebuildGoals = FALSE;
          
		    /* Format values */
    		if ( isset( $values['dt_amounts'] ) )
    		{
    			$values['dt_amounts'] = $values['dt_amounts'] ?: NULL;
    		}		  
    		if ( isset( $values['dt_default_currency'] ) )
    		{
    			$values['dt_default_currency'] = $values['dt_default_currency'] ? $values['dt_default_currency']->id: 0;
    		}
    		if ( isset( $values['dt_topic_author'] ) )
    		{
    			$values['dt_topic_author'] = $values['dt_topic_author'] ? $values['dt_topic_author']->member_id: 0;
    		}
    		if ( isset( $values['dt_pm_sender'] ) )
    		{
    			$values['dt_pm_sender'] = $values['dt_pm_sender'] ? $values['dt_pm_sender']->member_id: 0;
    		}            
    		if ( isset( $values['dt_create_topic_forum'] ) )
    		{
    			$values['dt_create_topic_forum'] = $values['dt_create_topic_forum'] ? $values['dt_create_topic_forum']->_id: 0;
    		}
                                             
		    /* Save translatable fields */
			foreach ( array( 'dt_topic_title' => 'dt_topic_title_value', 'dt_topic_message' => 'dt_topic_message_value', 'dt_new_donation_pm_subject' => 'dt_new_donation_pm_subject_value', 'dt_new_donation_pm_message' => 'dt_new_donation_pm_message_value' ) as $k => $v )
			{
                if ( array_key_exists( $k, $values ) )
                {			 
				    \IPS\Lang::saveCustom( 'donate', $v, $values[ $k ] );
				    unset( $values[ $k ] );
                }
			}	  
                       
            /* Flag a goal rebuild? */
            if( $values['dt_include_fees'] != \IPS\Settings::i()->dt_include_fees )
            {
                $rebuildGoals = TRUE;    
            }
          
            /* Save settings */
			$form->saveAsSettings( $values );   
            
            /* Rebuild goals */
            if( $rebuildGoals === TRUE )
            {
                \IPS\donate\Goal::rebuildActiveGoals();
            }     
		}

		\IPS\Output::i()->output = $form;
	}
}