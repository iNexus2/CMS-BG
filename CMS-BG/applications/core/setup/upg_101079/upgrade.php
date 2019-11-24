<?php
/**
 * @brief		4.1.18 Upgrade Code
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		01 Dec 2016
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\core\setup\upg_101079;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 4.1.18 Upgrade Code
 */
class _Upgrade
{
	/**
	 * Convert group promotion types. Previous versions used a bitwise column but as of this version 3 types are used
	 *
	 * @return	array	If returns TRUE, upgrader will proceed to next step. If it returns any other value, it will set this as the value of the 'extra' GET parameter and rerun this step (useful for loops)
	 */
	public function step1()
	{
		foreach ( \IPS\Member\Group::groups() as $group )
		{
			$group->g_promotion_type = $group->g_bitoptions['gbw_promote_unit_type'];
			$group->save();
		}
		return TRUE;
	}

	/**
	 * Custom title for this step
	 *
	 * @return string
	 */
	public function step1CustomTitle()
	{
		return "Converting group promotion types";
	}
	
	/**
	 * Update Settings 
	 *
	 * @return	array	If returns TRUE, upgrader will proceed to next step. If it returns any other value, it will set this as the value of the 'extra' GET parameter and rerun this step (useful for loops)
	 */
	public function step2()
	{
		if ( \IPS\Settings::i()->prune_log_system > 30 )
		{
			\IPS\Db::i()->update( 'core_sys_conf_settings', array( 'conf_value' => 30 ), array( 'conf_key=?', 'prune_log_system' ) );
		}
		
		//IV
		// \IPS\Db::i()->update( 'core_sys_conf_settings', array( 'conf_value' => intval( $_SESSION['upgrade_options']['core']['']['diagnostics_reporting'] ) ), array( 'conf_key=?', 'diagnostics_reporting' ) );
		// unset( \IPS\Data\Store::i()->settings );

		return TRUE;
	}

	/**
	 * Custom title for this step
	 *
	 * @return string
	 */
	public function step2CustomTitle()
	{
		return "Updating settings";
	}
	
	/**
	 * Initiate rebuild tasks for repuation
	 *
	 * @return boolean
	 */
	public function finish()
	{
		$classes = array();
		foreach ( \IPS\Application::allExtensions( 'core', 'ContentRouter', FALSE ) as $object )
		{
			$classes = array_merge( $object->classes, $classes );
		}
		
		foreach( $classes as $item )
		{
			try
			{
				$commentClass = NULL;
				$reviewClass  = NULL;
				
				if ( isset( $item::$commentClass ) )
				{
					$commentClass = $item::$commentClass;
				}
				
				if ( isset( $item::$reviewClass ) )
				{
					$reviewClass = $item::$reviewClass;
				}
				
				if ( isset( $item::$reputationType ) )
				{
					\IPS\Task::queue( 'core', 'RebuildReputationIndex', array( 'class' => $item ), 3, array( 'class' ) );
				}
				
				if ( $commentClass and isset( $commentClass::$reputationType ) )
				{
					\IPS\Task::queue( 'core', 'RebuildReputationIndex', array( 'class' => $commentClass ), 3, array( 'class' ) );
				}
				
				if ( $reviewClass and isset( $reviewClass::$reputationType ) )
				{
					\IPS\Task::queue( 'core', 'RebuildReputationIndex', array( 'class' => $reviewClass ), 3, array( 'class' ) );
				}
			}
			catch( \Exception $e ) { }
		}
		
		/* Rebuild search index */
		\IPS\Content\Search\Index::i()->rebuild();
		
		return TRUE;
	}
}