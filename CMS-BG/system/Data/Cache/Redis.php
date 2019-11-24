<?php
/**
 * @brief		Redis Cache Class
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		18 Oct 2013
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\Data\Cache;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Redis Cache Class
 */
class _Redis extends \IPS\Data\Cache
{
	/**
	 * Server supports this method?
	 *
	 * @return	bool
	 */
	public static function supported()
	{
		return class_exists('Redis');
	}
	
	/**
	 * Configuration
	 *
	 * @param	array	$configuration	Existing settings
	 * @return	array	\IPS\Helpers\Form\FormAbstract elements
	 */
	public static function configuration( $configuration )
	{
		return array(
			'server'	=> new \IPS\Helpers\Form\Text( 'server_host', isset( $configuration['server'] ) ? $configuration['server'] : '', FALSE, array( 'placeholder' => '127.0.0.1' ), function( $val )
			{
				if ( \IPS\Request::i()->cache_method === 'Redis' and empty( $val ) )
				{
					throw new \DomainException( 'datastore_redis_servers_err' );
				}
			} ),
			'port'		=> new \IPS\Helpers\Form\Number( 'server_port', isset( $configuration['port'] ) ? $configuration['port'] : NULL, FALSE, array( 'placeholder' => '6379' ), function( $val )
			{
				if ( \IPS\Request::i()->cache_method === 'Redis' AND $val AND ( $val < 0 OR $val > 65535 ) )
				{
					throw new \DomainException( 'datastore_redis_servers_err' );
				}
			} ),
			'password'	=> new \IPS\Helpers\Form\Password( 'server_password', isset( $configuration['password'] ) ? $configuration['password'] : '', FALSE ),
		);
	}

	/**
	 * @brief	Connection resource
	 */
	protected static $links	= array();

	/**
	 * @brief	Connection key
	 */
	protected $connectionKey	= NULL;

	/**
	 * @brief	Connection timeout - keep low or you negate the benefits of caching
	 */
	protected $timeout	= 2;

	/**
	 * Constructor
	 *
	 * @param	array	$configuration	Configuration
	 * @return	void
	 */
	public function __construct( $configuration )
	{
		/* Figure out our connection key, as you could theoretically attempt to connect to more than one Redis server */
		$this->connectionKey	= md5( $configuration['server'] . ':' . $configuration['port'] );

		/* If we've already attempted to establish this link, just return now */
		if( isset( static::$links[ $this->connectionKey ] ) )
		{
			return;
		}

		/* Connect to server */
		try
		{
			static::$links[ $this->connectionKey ]	= new \Redis;

			if( static::$links[ $this->connectionKey ]->connect( $configuration['server'], $configuration['port'], $this->timeout ) === FALSE )
			{
				$this->resetConnection();

				throw new \RedisException;
			}
			else
			{
				if( $configuration['password'] )
				{
					if( static::$links[ $this->connectionKey ]->auth( $configuration['password'] ) === FALSE )
					{
						$this->resetConnection();

						throw new \RedisException;
					}
				}
			}

			if( static::$links[ $this->connectionKey ] !== NULL )
			{
				static::$links[ $this->connectionKey ]->setOption( \Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP );
			}

			/* If connection times out, connect can return TRUE and we won't know until our next attempt to talk to the server,
				so we should ping now to verify we were able to connect successfully */
			static::$links[ $this->connectionKey ]->ping();

			register_shutdown_function( function( $object ){
				try
				{
					if( isset( static::$links[ $object->connectionKey ] ) AND static::$links[ $object->connectionKey ] )
					{
						static::$links[ $object->connectionKey ]->close();
						unset( static::$links[ $object->connectionKey ] );
					}
				}
				catch( \RedisException $e ){}
			}, $this );

			\IPS\Log::debug( "Connected to Redis", 'cache' );
		}
		catch( \RedisException $e )
		{
			$this->resetConnection( $e );
			\IPS\Log::debug( "Connection to Redis failed", 'cache' );
		}
	}

	/**
	 * Abstract Method: Get
	 *
	 * @param   string          $key
	 * @return  string|FALSE    Value from the _datastore; FALSE if key doesn't exist
	 */
	protected function get( $key )
	{
		if( isset( $this->cache[ $key ] ) )
		{
			\IPS\Log::debug( "Get {$key} from Redis (already loaded)", 'cache' );
			return $this->cache[ $key ];
		}

		if ( static::$links[ $this->connectionKey ] )
		{
			\IPS\Log::debug( "Get {$key} from Redis", 'cache' );

			try
			{
				$this->cache[ $key ]	= static::$links[ $this->connectionKey ]->get( \IPS\SUITE_UNIQUE_KEY . '_' . $key );

				return $this->cache[ $key ];
			}
			catch( \RedisException $e )
			{
				$this->resetConnection( $e );

				return FALSE;
			}
		}

		/* No connection */
		return FALSE;
	}
	
	/**
	 * Abstract Method: Set
	 *
	 * @param	string			$key	Key
	 * @param	string			$value	Value
	 * @param	\IPS\DateTime	$expire	Expreation time, or NULL for no expiration
	 * @return	bool
	 */
	protected function set( $key, $value, \IPS\DateTime $expire = NULL )
	{
		if ( static::$links[ $this->connectionKey ] )
		{
			\IPS\Log::debug( "Set {$key} in Redis", 'cache' );

			try
			{
				if ( $expire )
				{
					return (bool) static::$links[ $this->connectionKey ]->setex( \IPS\SUITE_UNIQUE_KEY . '_' . $key, $expire->getTimestamp() - time(), $value );
				}
				else
				{
					return (bool) static::$links[ $this->connectionKey ]->set( \IPS\SUITE_UNIQUE_KEY . '_' . $key, $value );
				}
			}
			catch( \RedisException $e )
			{
				$this->resetConnection( $e );

				return FALSE;
			}
		}

		/* No connection */
		return FALSE;
	}
	
	/**
	 * Abstract Method: Exists?
	 *
	 * @param	string	$key	Key
	 * @return	bool
	 */
	protected function exists( $key )
	{
		if( isset( $this->cache[ $key ] ) )
		{
			\IPS\Log::debug( "Check exists {$key} from Redis (already loaded)", 'cache' );
			return ( $this->cache[ $key ] === FALSE ) ? FALSE : TRUE;
		}

		\IPS\Log::debug( "Check exists {$key} from Redis", 'cache' );

		/* We do a get instead of an exists() check because it will cause the cache value to be fetched and cached inline, saving another call to the server */
		return ( $this->get( $key ) === FALSE ) ? FALSE : TRUE;
	}
	
	/**
	 * Abstract Method: Delete
	 *
	 * @param	string	$key	Key
	 * @return	bool
	 */
	protected function delete( $key )
	{
		if ( static::$links[ $this->connectionKey ] )
		{
			\IPS\Log::debug( "Delete {$key} from Redis", 'cache' );

			try
			{
				return (bool) static::$links[ $this->connectionKey ]->delete( \IPS\SUITE_UNIQUE_KEY . '_' . $key );
			}
			catch( \RedisException $e )
			{
				$this->resetConnection( $e );
			}
		}

		/* No connection */
		return FALSE;
	}

	/**
	 * Reset connection
	 *
	 * @param	\RedisException|NULL	If this was called as a result of an exception, log that to the debug log
	 * @return void
	 */
	protected function resetConnection( \RedisException $e = NULL )
	{
		if ( $e !== NULL )
		{
			\IPS\Log::debug( $e, 'redis_exception' );
		}
		static::$links[ $this->connectionKey ]	= NULL;
		throw new \IPS\Data\Cache\Exception;
	}

	/**
	 * Abstract Method: Clear All Caches
	 *
	 * @return	void
	 */
	public function clearAll()
	{
		parent::clearAll();

		if ( static::$links[ $this->connectionKey ] )
		{
			static::$links[ $this->connectionKey ]->flushDb();
		}
	}
}