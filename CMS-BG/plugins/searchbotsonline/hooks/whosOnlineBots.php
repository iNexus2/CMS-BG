//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook126 extends _HOOK_CLASS_
{
	public function output( $members, $memberCount, $guests, $anonymous )
	{
		try
		{
			if( isset( $members[0] ) )
			{
				$tmp = array();
				foreach( $members as $k => $v )
				{
					$tmp[ ( $v['member_id'] ?: $k ) ] = $v;
				}
				$members = $tmp;
			}
		
			$tmp = array();
			foreach( \IPS\Db::i()->select( 'member_id, login_type, uagent_key, member_group', 'core_sessions', array( 'running_time>? AND login_type IN(?, ?)', \IPS\DateTime::create()->sub( new \DateInterval( 'PT30M' ) )->getTimeStamp(), \IPS\Session\Front::LOGIN_TYPE_SPIDER, \IPS\Session\Front::LOGIN_TYPE_MEMBER ), 'running_time DESC' ) as $row )
			{
				switch( $row['login_type'] )
				{
					case \IPS\Session\Front::LOGIN_TYPE_MEMBER:
						if( isset( $members[ $row['member_id'] ] ) )
						{
							$tmp[ $row['member_id'] ] = $members[ $row['member_id'] ];
						}
					break;
					
					case \IPS\Session\Front::LOGIN_TYPE_SPIDER:
						if( !isset( $tmp[ $row['uagent_key'] ] ) )
						{
							$row['member_name'] = ucfirst( $row['uagent_key'] );
							$row['seo_name']    = '';
							$tmp[ $row['uagent_key'] ] = $row;
						}
					break;
				}
			}
			
			$members = $tmp;
			
			return parent::output( $members, $memberCount, $guests, $anonymous );
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
