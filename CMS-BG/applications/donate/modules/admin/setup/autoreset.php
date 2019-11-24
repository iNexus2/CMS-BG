<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\modules\admin\setup;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * autoreset
 */
class _autoreset extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'autoreset_manage' );
		parent::execute();
	}

	/**
	 * Automatic Reset Settings
	 *
	 * @return	void
	 */
	protected function manage()
	{
		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('module__setup_autoreset');	   
       
		$form = new \IPS\Helpers\Form;
        $form->addTab( 'donations' );
        $form->addMessage( 'donations_autoreset', 'information', TRUE );
        $form->addHeader( 'donations' );

        $form->add( new \IPS\Helpers\Form\Date( 'dt_donation_reset', \IPS\Settings::i()->dt_donation_reset, FALSE, array( 'time' => FALSE ), NULL, NULL, '<a href="' . \IPS\Http\Url::internal( "app=donate&module=setup&controller=autoreset&do=removeDonation") . '">' . \IPS\Member::loggedIn()->language()->addToStack('reset_remove') . '</a>', 'dt_donation_reset' ) );
		$form->add( new \IPS\Helpers\Form\Custom( 'dt_donation_reset_settings', array( \IPS\Settings::i()->dt_donation_reset_day, \IPS\Settings::i()->dt_donation_reset_timeframe ), FALSE, array(
			'getHtml' => function( $element )
			{
				return \IPS\Theme::i()->getTemplate( 'forms' )->resetinterval( $element->name, $element->value ?: array() );
			},
			'formatValue' => function ( $element )
			{
			    $day       = ( isset( $element->value[0] ) AND $element->value[0] ) ? $element->value[0] : '';
			    $timeframe = ( isset( $element->value[1] ) AND $element->value[1] ) ? $element->value[1] : '';
                             
				return array( 0 => $day, 1 => $timeframe );			 
			}
		) ) );  
        
        /*$form->addTab( 'goals' );
        $form->addMessage( 'goals_autoreset', 'information', TRUE );
        $form->addHeader( 'goals' );
        $form->add( new \IPS\Helpers\Form\Date( 'dt_goal_reset', \IPS\Settings::i()->dt_goal_reset, FALSE, array( 'time' => FALSE ), NULL, NULL, '<a href="' . \IPS\Http\Url::internal( "app=donate&module=setup&controller=autoreset&do=removeGoal") . '">' . \IPS\Member::loggedIn()->language()->addToStack('reset_remove') . '</a>', 'dt_goal_reset' ) );
		$form->add( new \IPS\Helpers\Form\Custom( 'dt_goal_reset_settings', array( \IPS\Settings::i()->dt_goal_reset_day, \IPS\Settings::i()->dt_goal_reset_timeframe ), FALSE, array(
			'getHtml' => function( $element )
			{
				return \IPS\Theme::i()->getTemplate( 'forms' )->resetinterval( $element->name, $element->value ?: array() );
			},
			'formatValue' => function ( $element )
			{
			    $day       = ( isset( $element->value[0] ) AND $element->value[0] ) ? $element->value[0] : '';
			    $timeframe = ( isset( $element->value[1] ) AND $element->value[1] ) ? $element->value[1] : '';
                             
				return array( 0 => $day, 1 => $timeframe );			 
			}
		) ) ); */       
 
		if ( $values = $form->values() )
		{
		    /* Donation reset values */
            $values['dt_donation_reset'] = ( $values['dt_donation_reset'] ) ? $values['dt_donation_reset']->getTimestamp() : 0; 
	  
            if( isset( $values['dt_donation_reset_settings'][0] )  )
            {
                $values['dt_donation_reset_day'] = intval( $values['dt_donation_reset_settings'][0] ); 
            }
            if( isset( $values['dt_donation_reset_settings'][1] )  )
            {
                $values['dt_donation_reset_timeframe'] = $values['dt_donation_reset_settings'][1]; 
            }     

		    /* Goal reset values */
            /*$values['dt_goal_reset'] = ( $values['dt_goal_reset'] ) ? $values['dt_goal_reset']->getTimestamp() : 0; 
	  
            if( isset( $values['dt_goal_reset_settings'][0] ) )
            {
                $values['dt_goal_reset_day'] = intval( $values['dt_goal_reset_settings'][0] ); 
            }
            if( isset( $values['dt_goal_reset_settings'][1] ) )
            {
                $values['dt_goal_reset_timeframe'] = $values['dt_goal_reset_settings'][1]; 
            }*/

            /* Remove placeholder values */
            unset( $values['dt_donation_reset_settings'] );
            unset( $values['dt_goal_reset_settings'] );
            
			$form->saveAsSettings( $values );
            
            /* Rebuild active goals */
            \IPS\donate\Goal::rebuildActiveGoals();            
            
			\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=donate&module=setup&controller=autoreset' ), 'saved' );            
		}

		\IPS\Output::i()->output = $form;
	}
    
	/**
	 * Remove Donation Reset
	 *
	 * @return	void
	 */
	protected function removeDonation()
	{ 
	    /* Remove reset and update settings */
		\IPS\Db::i()->update( 'core_sys_conf_settings', array( 'conf_value' => '' ), array( 'conf_key=?', 'dt_donation_reset' ) );
		\IPS\Settings::i()->dt_donation_reset = '';
					
		unset( \IPS\Data\Store::i()->settings );
        
        /* Rebuild active goals */
        \IPS\donate\Goal::rebuildActiveGoals();           
                        
        \IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=donate&module=setup&controller=autoreset' ), 'saved' ); 	   
    }
    
	/**
	 * Remove Goal Reset
	 *
	 * @return	void
	 */
	protected function removeGoal()
	{ 
	    /* Remove reset and update settings */
		\IPS\Db::i()->update( 'core_sys_conf_settings', array( 'conf_value' => '' ), array( 'conf_key=?', 'dt_goal_reset' ) );
		\IPS\Settings::i()->dt_goal_reset = '';
					
		unset( \IPS\Data\Store::i()->settings );
        
        /* Rebuild active goals */
        \IPS\donate\Goal::rebuildActiveGoals();           
                        
        \IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=donate&module=setup&controller=autoreset' ), 'saved' ); 	   
    }    
}