<?php
/**
 * @brief		File Storage Extension: Image proxy cache
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		7 Nov 2016
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\core\extensions\core\FileStorage;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * File Storage Extension: Image proxy cache
 */
class _Imageproxycache
{
	/**
	 * Count stored files
	 *
	 * @return	int
	 */
	public function count()
	{
		return \IPS\Db::i()->select( 'COUNT(*)', 'core_image_proxy' )->first();
	}
	
	/**
	 * Move stored files
	 *
	 * @param	int			$offset					This will be sent starting with 0, increasing to get all files stored by this extension
	 * @param	int			$storageConfiguration	New storage configuration ID
	 * @param	int|NULL	$oldConfiguration		Old storage configuration ID
	 * @throws	\UnderflowException					When file record doesn't exist. Indicating there are no more files to move
	 * @return	void|int							An offset integer to use on the next cycle, or nothing
	 */
	public function move( $offset, $storageConfiguration, $oldConfiguration=NULL )
	{
		$cache = \IPS\Db::i()->select( '*', 'core_image_proxy', array(), 'md5_url', array( $offset, 1 ) )->first();

		try
		{
			$file = \IPS\File::get( $oldConfiguration ?: 'core_Imageproxycache', $cache['location'] )->move( $storageConfiguration );

			if ( (string) $file != $cache['location'] )
			{
				\IPS\Db::i()->update( 'core_image_proxy', array( 'location' => (string) $file ), array( 'md5_url=?', $cache['md5_url'] ) );
			}
		}
		catch( \Exception $e )
		{
			/* Any issues are logged and the \IPS\Db::i()->update not run as the exception is thrown */
		}
	}

	/**
	 * Check if a file is valid
	 *
	 * @param	\IPS\Http\Url	$file		The file to check
	 * @return	bool
	 */
	public function isValidFile( $file )
	{
		try
		{
			\IPS\Db::i()->select( '*', 'core_image_proxy', array( 'location=?', (string) $file ) )->first();

			return TRUE;
		}
		catch ( \UnderflowException $e )
		{
			return FALSE;
		}
	}

	/**
	 * Delete all stored files
	 *
	 * @return	void
	 */
	public function delete()
	{
		foreach( \IPS\Db::i()->select( '*', 'core_image_proxy', 'location IS NOT NULL' ) as $cache )
		{
			try
			{
				\IPS\File::get( 'core_Imageproxycache', $cache['location'] )->delete();
			}
			catch( \Exception $e ){}
		}
	}
	
	/**
	 * Fix all URLs
	 *
	 * @param	int			$offset					This will be sent starting with 0, increasing to get all files stored by this extension
	 * @return void
	 */
	public function fixUrls( $offset )
	{
		$cache = \IPS\Db::i()->select( '*', 'core_image_proxy', array(), 'md5_url', array( $offset, 1 ) )->first();

		try
		{
			if ( $new = \IPS\File::repairUrl( $cache['location'] ) )
			{
				\IPS\Db::i()->update( 'core_image_proxy', array( 'location' => (string) $new ), array( 'md5_url=?', $cache['location'] ) );
			}
		}
		catch( \Exception $e )
		{
			/* Any issues are logged and the \IPS\Db::i()->update not run as the exception is thrown */
		}
	}
}