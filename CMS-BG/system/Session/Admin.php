<?php
/**
 * @brief		Admin Session Handler
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		11 Mar 2013
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\Session;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Admin Session Handler
 */
class _Admin extends \IPS\Session
{
	/**
	 * @brief	Unix Timestamp of log in time
	 */
	public $logInTime;
			
	/**
	 * Open Session
	 *
	 * @param	string	$savePath	Save path
	 * @param	string	$sessionName Session Name
	 * @return	void
	 */
	public function open( $savePath, $sessionName )
	{
		return TRUE;
	}
	
	/**
	 * Read Session
	 *
	 * @param	string	$sessionId	Session ID
	 * @return	string
	 */
	public function read( $sessionId )
	{
		/* Get user agent info */
		$this->userAgent	= \IPS\Http\Useragent::parse();

		try
		{
			/* Load session */
			$session = \IPS\Db::i()->select( '*', 'core_sys_cp_sessions', array( 'session_id=?', $sessionId ) )->first();
			$this->logInTime = $session['session_log_in_time'];
			
			/* Store this so plugins can access */
			$this->sessionData	= $session;

			/* Load member */
			$this->member = $session['session_member_id'] ? \IPS\Member::load( $session['session_member_id'] ) : new \IPS\Member;
			if ( $this->member->member_id and !$this->member->isAdmin() )
			{
				throw new \DomainException('NO_ACPACCESS');
			}
						
			/* Validate adsess */
			if ( \IPS\Request::i()->adsess !== $session['session_id'] )
			{
				throw new \DomainException('NO_ADSESS');
			}
			
			/* Check IP address */
			if ( ( defined( '\IPS\BYPASS_ACP_IP_CHECK' ) and !\IPS\BYPASS_ACP_IP_CHECK ) and \IPS\Settings::i()->match_ipaddress and $session['session_ip_address'] !== \IPS\Request::i()->ipAddress() )
			{
				throw new \DomainException('BAD_IP');
			}
			
			/* Return data */
			return $session['session_app_data'];
		}
		catch ( \Exception $e )
		{
			$this->member = new \IPS\Member;
			$this->logInTime = 0;
			$this->error = $e;
			return '';
		}
	}
	
	/**
	 * Write Session
	 *
	 * @param	string	$sessionId	Session ID
	 * @param	string	$data		Session Data
	 * @return	bool
	 */
	public function write( $sessionId, $data )
	{
		\IPS\Db::i()->replace( 'core_sys_cp_sessions', array(
			'session_id'				=> $sessionId,
			'session_ip_address'		=> \IPS\Request::i()->ipAddress(),
			'session_member_name'		=> $this->member->name ?: '-',
			'session_member_id'			=> $this->member->member_id ?: 0,
			'session_member_login_key'	=> $this->member->member_login_key ?: '',
			'session_location'			=> 'app=' . ( \IPS\Dispatcher::i()->application ? \IPS\Dispatcher::i()->application->directory : '' ) . '&module=' . ( \IPS\Dispatcher::i()->module ? \IPS\Dispatcher::i()->module->key : '' ) . '&controller=' . \IPS\Dispatcher::i()->controller,
			'session_log_in_time'		=> $this->logInTime,
			'session_running_time'		=> time(),
			'session_url'				=> \IPS\Request::i()->url(),
			'session_app_data'			=> $data
			) );
		
		return TRUE;
	}
	
	/**
	 * Close Session
	 *
	 * @return	bool
	 */
	public function close()
	{
		return TRUE;
	}
	
	/**
	 * Destroy Session
	 *
	 * @param	string	$sessionId	Session ID
	 * @return	bool
	 */
	public function destroy( $sessionId )
	{
		\IPS\Db::i()->delete( 'core_sys_cp_sessions', array( 'session_id=?', $sessionId ) );
		return TRUE;
	}
	
	/**
	 * Garbage Collection
	 *
	 * @param	int		$lifetime	Unix timestamp of the oldest session to keep
	 * @return	bool
	 */
	public function gc( $lifetime )
	{
		\IPS\Db::i()->delete( 'core_sys_cp_sessions', array( 'session_running_time<?', ( time() - $lifetime ) ) );
		return TRUE;
	}
	
	/**
	 * Admin Log
	 *
	 * @code
	 	\IPS\Session::i()->log( 'acplog__enhancements_enable', array( 'enhancements__foo' => TRUE ) );
	 * @endcode
	 * @param	string	$langKey	Language key for log
	 * @param	array	$params		Key/Values - keys are variables to use in sprintf on $langKey, values are booleans indicating if they are language keys themselves (TRUE) or raw data (FALSE)
	 * @param	bool	$noDupes	If TRUE, will check the last log and not log again if it's the same and less than an hour ago
	 * @return	void
	 */
	public function log( $langKey, $params=array(), $noDupes=FALSE )
	{
		if ( $noDupes )
		{
			try
			{
				$lastLog = \IPS\Db::i()->select( '*', 'core_admin_logs', array( 'member_id=?', $this->member->member_id ), 'ctime DESC', 1 )->first();
				if ( $lastLog['ctime'] > ( time() - 3600 ) and $lastLog['lang_key'] == $langKey )
				{
					return;
				}
			}
			catch ( \UnderflowException $e ) { }
		}
	
		\IPS\Db::i()->insert( 'core_admin_logs', array(
			'member_id'		=> $this->member->member_id,
			'member_name'	=> \IPS\Member::loggedIn()->name,
			'ctime'			=> time(),
			'note'			=> json_encode( $params ),
			'ip_address'	=> \IPS\Request::i()->ipAddress(),
			'appcomponent'	=> \IPS\Dispatcher::i()->application->directory,
			'module'		=> \IPS\Dispatcher::i()->module->key,
			'controller'	=> \IPS\Dispatcher::i()->controller,
			'do'			=> \IPS\Request::i()->do,
			'lang_key'		=> $langKey
		) );
	}
}