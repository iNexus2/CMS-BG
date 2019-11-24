<?php
/**
 * @brief		URL input class for Form Builder
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		11 Mar 2013
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\Helpers\Form;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * URL input class for Form Builder
 */
class _Url extends Text
{
	/**
	 * @brief	Default Options
	 * @code
	 	$childDefaultOptions = array(
	 		'allowedProtocols'	=> array( 'http', 'https' ),	// Allowed protocols. Default is http and https. Be careful changing this not to introduce security issues.
	 		'allowedMimes'		=> 'image/*',					// Sets the allowed mimetype(s). Can be string or array. * is a wildcard. Default is NULL, which allows any mimetypes. Note, setting this will not allow localhost URLs.
	 		'file'				=> 'Profile',					// If provided, the contents of the URL will be fetched and written as a file, an \IPS\File object will then be returned rather than a string. Provide the extension name which specifies the storage location to use. Note, setting this will not allow localhost URLs.
	 		'maxFileSize'		=> NULL,						// If provided along with 'file', the resulting file that is written to disk cannot be greater than this size in megabytes. NULL for no limit (default is NULL).
	 		'maxDimensions'		=> NULL,						// If supplied as an array with keys 'width' and 'height' and the resulting file is an image, the image will be scaled down to these maximum dimensions. NULL for no limits (default is NULL).
	 		'rateLimit'			=> 20,							// Rate-limit requests to prevent the ability to DOS a remote server - time between allowed attempts in seconds (defaults to 20). NULL to disable rate limiting.
	 	);
	 * @endcode
	 */
	public $childDefaultOptions = array(
		'allowedProtocols'	=> array( 'http', 'https' ),
		'allowedMimes'		=> NULL,
		'file'				=> FALSE,
		'maxFileSize'		=> NULL,
		'maxDimensions'		=> NULL,
		'rateLimit'			=> 20
	);
	
	/**
	 * Validate
	 *
	 * @throws	\InvalidArgumentException
	 * @throws	\DomainException
	 * @return	TRUE
	 */
	public function validate()
	{
		parent::validate();
		
		if ( $this->value )
		{
			$value = $this->formatValue();
			
			/* Check the URL is valid */
			if ( !( $value instanceof \IPS\Http\Url ) )
			{
				throw new \InvalidArgumentException('form_url_bad');
			}
			
			/* And that it's an allowed protocol */
			if ( !in_array( mb_strtolower( $value->data['scheme'] ), $this->options['allowedProtocols'] ) )
			{
				throw new \DomainException('form_url_bad_protocol');
			}
			
			/* Try to fetch it, if necessary */
			if ( $this->options['file'] or $this->options['allowedMimes'] )
			{
				/* Localhost is not allowed as sending a HTTP request to the local server will cause scripts which are relying 
					on only being accessible to the local machine to execute */
				if ( $value->isLocalhost() )
				{
					throw new \DomainException( \IPS\Member::loggedIn()->language()->addToStack( 'form_url_localhost', FALSE, array( 'sprintf' => array( \IPS\Http\Url::internal('')->data['host'] ) ) ) );
				}
				
				/* Is rate limiting enabled (the default)? */
				if( $this->options['rateLimit'] !== NULL AND intval( $this->options['rateLimit'] ) > 0 )
				{
					/* We need to rate limit URL fetch requests - have we tried to fetch this field yet? */
					$_key = 'url_fetch_' . $this->htmlId;

					if( isset( $_SESSION[ $_key ] ) AND $_SESSION[ $_key ] )
					{
						/* Was it less than 20 seconds ago? If so, make the user wait */
						$timeLeft =  $_SESSION[ $_key ] - ( time() - intval( $this->options['rateLimit'] ) );
						if( $timeLeft > 0 )
						{
							throw new \DomainException( \IPS\Member::loggedIn()->language()->addToStack( 'form_url_too_soon', FALSE, array( 'sprintf' => array( $this->options['rateLimit'], $timeLeft ) ) ) );
						}
					}

					$_SESSION[ $_key ] = time();
				}

				try
				{
					$response = $value->request()->get();

					/* Check MIME */
					if ( $this->options['allowedMimes'] )
					{
						$match = FALSE;
                        $contentType = ( isset( $response->httpHeaders['Content-Type'] ) ) ? $response->httpHeaders['Content-Type'] : ( ( isset( $response->httpHeaders['content-type'] ) ) ? $response->httpHeaders['content-type'] : NULL );
						if( $contentType )
						{
							foreach ( is_array( $this->options['allowedMimes'] ) ? $this->options['allowedMimes'] : array( $this->options['allowedMimes'] ) as $mime )
							{
								if ( preg_match( '/^' . str_replace( '~~', '.+', preg_quote( str_replace( '*', '~~', $mime ), '/' ) ) . '$/i', $contentType ) )
								{
									$match = TRUE;
									break;
								}
							}
						}
						
						if ( !$match )
						{
							throw new \DomainException( 'form_url_bad_mime' );
						}
					}
					
					/* Write file if necessary */
					if ( $this->options['file'] )
					{
						$filename		= preg_replace( "/(.+?)(\?|$)/", "$1", mb_substr( $value, mb_strrpos( $value, '/' ) + 1 ) );
						$response		= (string) $response;

						if( $this->options['maxFileSize'] !== NULL )
						{
							$maxFileSize	= $this->options['maxFileSize'] * 1048576;

							if( \strlen( $response ) > $maxFileSize )
							{
								unset( $response );
								throw new \DomainException( \IPS\Member::loggedIn()->language()->addToStack( 'upload_too_big', TRUE, array( 'sprintf' => $this->options['maxFileSize'] ) ), 2 );
							}
						}

						try
						{
							$this->value = \IPS\File::create( $this->options['file'], $filename, $response );

							/* Do we need to resize images down? */
							if( $this->value->isImage() AND $this->options['maxDimensions'] !== NULL )
							{
								try
								{
									$image = \IPS\Image::create( $this->value->contents() );

									if( $image::exifSupported() )
									{
										$image->setExifData( $this->value->contents() );
									}
									
									$image->resizeToMax( $this->options['maxDimensions']['width'] ?: NULL, $this->options['maxDimensions']['height'] ?: NULL );
					
									$this->value->replace( (string) $image );
								}
								catch ( \Exception $e ) { }
							}
						}
						catch( \InvalidArgumentException $e )
						{
							throw new \DomainException( 'form_url_error' );
						}
					}
				}
				catch ( \IPS\Http\Request\Exception $e )
				{
					throw new \DomainException( 'form_url_error' );
				}
			}
		}
	}
	
	/**
	 * Get Value
	 *
	 * @return	string
	 */
	public function getValue()
	{
		$val = str_replace( 'feed://', 'http://', parent::getValue() );
		if ( $val and !mb_strpos( $val, '://' ) )
		{
			$val = "http://{$val}";
		}
		
		return $val;
	}
	
	/**
	 * Format Value
	 *
	 * @return	\IPS\Http\Url|string
	 */
	public function formatValue()
	{
		if ( $this->value and !( $this->value instanceof \IPS\Http\Url ) )
		{
			try
			{
				return \IPS\Http\Url::createFromString( $this->value, TRUE, TRUE );
			}
			catch ( \InvalidArgumentException $e )
			{
				return $this->value;
			}
		}
		
		return $this->value;
	}
}