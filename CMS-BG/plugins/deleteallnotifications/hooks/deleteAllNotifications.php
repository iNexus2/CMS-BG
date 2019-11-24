//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook151 extends _HOOK_CLASS_
{
	public function clearNotifications()
	{
		try
		{
			\IPS\Session::i()->csrfCheck();
			
			if( \IPS\Member::loggedIn()->member_id )
			{
		        \IPS\Db::i()->delete( 'core_notifications', array( 'member=?', \IPS\Member::loggedIn()->member_id ) );
				\IPS\Member::loggedIn()->recountNotifications();
				
				if( \IPS\Request::i()->isAjax() )
				{
					\IPS\Output::i()->json( array( 'ok' => true, 'message' => \IPS\Member::loggedIn()->language()->addToStack('cNotifications_done') ) );
				}
				else
				{
					\IPS\Output::i()->redirect( !empty( $_SERVER['HTTP_REFERER'] ) ? \IPS\Http\Url::external( $_SERVER['HTTP_REFERER'] ) : \IPS\Http\Url::internal( '' ), 'cNotifications_done' );
				}
			}
			
			\IPS\Output::i()->redirect( \IPS\Http\Url::internal('') );
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
}
