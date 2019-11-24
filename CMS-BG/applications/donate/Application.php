<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
namespace IPS\donate;

/**
 * Donations Application Class
 */
class _Application extends \IPS\Application
{
	/**
	 * Init
	 *
	 * @return	void
	 */
	public function init()
	{
		/* Can view donations app? */
		if ( !\IPS\Member::loggedIn()->group['g_dt_view'] AND \IPS\Request::i()->do != 'payment' )
		{
			\IPS\Output::i()->error( 'node_error', '', 404, '' );
		}
	}
    
	/**
	 * Install 'other' items.
	 *
	 * @return void
	 */
	public function installOther()
	{
	    /* Give non guests what permissions they need */
		foreach( \IPS\Member\Group::groups( TRUE, FALSE ) as $group )
		{
		    /* VIP */
            if( $group->g_access_cp )
            {
    			$group->g_dt_moderate_donations = TRUE;                                    
    			$group->save();
            }            
		}
        
        /* Add PM custom lang */
		\IPS\Lang::saveCustom( 'donate', 'dt_new_donation_pm_subject_value', "New Donation" );
        \IPS\Lang::saveCustom( 'donate', 'dt_new_donation_pm_message_value', "<p>Hi %member_name%,</p><p>Thank you for your donation of %amount%. We look forward to improving the forums with your donation.</p><p>Thanks %board_name%</p>" );        

        /* Add topic custom lang */
		\IPS\Lang::saveCustom( 'donate', 'dt_topic_title_value', "New Donation %member_name%" );
        \IPS\Lang::saveCustom( 'donate', 'dt_topic_message_value', "<p>Hi %member_name%,</p><p>Thank you for your donation of %amount%. We look forward to improving the forums with your donation.</p><p>Thanks %board_name%</p>" );        
        
	}      
    
	/**
	 * [Node] Get Icon for tree
	 *
	 * @note	Return the class for the icon (e.g. 'globe')
	 * @return	string|null
	 */
	protected function get__icon()
	{
		return 'dollar';
	}
    
	/**
	 * Default front navigation
	 *
	 * @code
	 	
	 	// Each item...
	 	array(
			'key'		=> 'Example',		// The extension key
			'app'		=> 'core',			// [Optional] The extension application. If ommitted, uses this application	
			'config'	=> array(...),		// [Optional] The configuration for the menu item
			'title'		=> 'SomeLangKey',	// [Optional] If provided, the value of this language key will be copied to menu_item_X
			'children'	=> array(...),		// [Optional] Array of child menu items for this item. Each has the same format.
		)
	 	
	 	return array(
		 	'rootTabs' 		=> array(), // These go in the top row
		 	'browseTabs'	=> array(),	// These go under the Browse tab on a new install or when restoring the default configuraiton; or in the top row if installing the app later (when the Browse tab may not exist)
		 	'browseTabsEnd'	=> array(),	// These go under the Browse tab after all other items on a new install or when restoring the default configuraiton; or in the top row if installing the app later (when the Browse tab may not exist)
		 	'activityTabs'	=> array(),	// These go under the Activity tab on a new install or when restoring the default configuraiton; or in the top row if installing the app later (when the Activity tab may not exist)
		)
	 * @endcode
	 * @return array
	 */
	public function defaultFrontNavigation()
	{
		return array(
			'rootTabs'		=> array( array( 'key' => 'Donate' ) ),
			'browseTabs'	=> array(),
			'browseTabsEnd'	=> array(),
			'activityTabs'	=> array()
		);
	}        
}