<?php
/**
 * @package		Messages
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\gms\setup\upg_100001;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 2.2.0 (IPB4) Upgrade Code
 */
class _Upgrade
{
	/**
	 * Main changes
	 */
	public function step1()
	{
        \IPS\Db::i()->renameTable( 'global_messages', 'gms_messages' );	
        \IPS\Db::i()->dropTable( 'global_messages_pages' );
        
        /* Remove IPB 3.4 settings */
        \IPS\Db::i()->delete( 'core_sys_conf_settings', "conf_key IN( 'gms_include_title' )" ); 
        
        /* Re-enable app again */
        \IPS\Db::i()->update( 'core_applications', array( 'app_enabled' => 1 ), array( 'app_directory=?', 'gms' ) ); 
        
        return TRUE;             
	}

	/**
	 * Column modifications
	 */
	public function step2()
	{
	    \IPS\Db::i()->dropColumn( 'gms_messages', array( 'pages' ) );
       
		\IPS\Db::i()->changeColumn( 'gms_messages', 'block_forums', array(
			'name'			=> 'forums',
			'type'			=> 'text',
			'allow_null'	=> true,
			'default'		=> null
		) );
        
		\IPS\Db::i()->changeColumn( 'gms_messages', 'perms', array(
			'name'			=> 'perms',
			'type'			=> 'text',
			'allow_null'	=> true,
			'default'		=> null
		) );  
        
		\IPS\Db::i()->changeColumn( 'gms_messages', 'skins', array(
			'name'			=> 'skins',
			'type'			=> 'varchar',
			'length'		=> 255,
			'allow_null'	=> true,
			'default'		=> null
		) );  
        
		\IPS\Db::i()->changeColumn( 'gms_messages', 'options', array(
			'name'			=> 'options',
			'type'			=> 'text',
			'allow_null'	=> true,
			'default'		=> null
		) );
        
        return TRUE;                            
	}
    
	/**
	 * Custom lang setup
	 */
	public function step3()
	{
        /* Change app name */
        \IPS\Lang::saveCustom( 'gms', '__app_gms', 'Messages' );	   	   
       
        /* Convert messages */
		foreach( \IPS\Db::i()->select( '*', 'gms_messages' ) as $message )
		{
			\IPS\Lang::saveCustom( 'gms', "gms_message_{$message['id']}", $message['title'] );
			\IPS\Lang::saveCustom( 'gms', "gms_message_{$message['id']}_message", $message['message'] );
		}
        
        /* Rebuild our messages */
        \IPS\Task::queue( 'core', 'RebuildNonContentPosts', array( 'extension' => 'gms_Messages' ), 3 );

        /* Drop old columns */
		\IPS\Db::i()->dropColumn( 'gms_messages', array( 'title', 'message' ) );
        
        return TRUE;                         
	} 
    
	/**
	 * Serialize to JSON
	 */
	public function step4()
	{
        /* Convert messages */
		foreach( \IPS\Db::i()->select( '*', 'gms_messages' ) as $message )
		{
            $message['options']	= json_encode( \unserialize( $message['options'] ) );

			\IPS\Db::i()->update( 'gms_messages', array( 'options' => $message['options'] ), array( 'id=?', $message['id'] ) );
		} 
        
        return TRUE;                        
	}    
      
}