<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\extensions\core\GroupForm;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Admin CP Group Form
 */
class _Donate
{
	/**
	 * Process Form
	 *
	 * @param	\IPS\Form\Tabbed		$form	The form
	 * @param	\IPS\Member\Group		$group	Existing Group
	 * @return	void
	 */
	public function process( &$form, $group )
	{		
        /* Donate Permissions */
		$form->addHeader( 'donate_permissions' );
		$form->add( new \IPS\Helpers\Form\YesNo( 'g_dt_view', $group->g_dt_view ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'g_dt_donate', $group->g_dt_donate ) );
		$form->add( new \IPS\Helpers\Form\YesNo( 'g_dt_view_goals', $group->g_dt_view_goals ) );   
        $form->add( new \IPS\Helpers\Form\YesNo( 'g_dt_view_donations', $group->g_dt_view_donations ) ); 
        $form->add( new \IPS\Helpers\Form\YesNo( 'g_dt_send_donations', $group->g_dt_send_donations ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'g_dt_moderate_donations', $group->g_dt_moderate_donations ) );        
	}
	
	/**
	 * Save
	 *
	 * @param	array				$values	Values from form
	 * @param	\IPS\Member\Group	$group	The group
	 * @return	void
	 */
	public function save( $values, &$group )
	{
	    /* Setup list of our permissions */
	    $ourPermissions = array( 'g_dt_view', 'g_dt_donate', 'g_dt_view_goals', 'g_dt_view_donations', 'g_dt_send_donations', 'g_dt_moderate_donations' );
        
        /* Go through and save */                      
        foreach( $ourPermissions as $perm )
        {
            $group->$perm = (int) $values[ $perm ];   
        }	
	}
}