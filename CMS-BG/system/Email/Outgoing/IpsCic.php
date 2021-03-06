<?php
/**
 * @brief		IPS CiC Email Class
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		13 Dec 2016
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\Email\Outgoing;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * IPS CiC Email Class
 */
class _IpsCic extends \IPS\Email
{
	/* !Configuration */
	
	/**
	 * @brief	The number of emails that can be sent in one "go"
	 */
	const MAX_EMAILS_PER_GO = 200;
	
	/**
	 * @brief	If sending a bulk email to more than MAX_EMAILS_PER_GO - does this
	 *			class require waiting between cycles? For "standard" classes like
	 *			PHP and SMTP, this will be TRUE - and will cause bulk mails to go
	 *			to a class. For APIs like SparkPost, this can be FALSE
	 */
	const REQUIRES_TIME_BREAK = FALSE;
	
	/**
	 * @brief	IPS Cloud Email Endpoint
	 */
	const ENDPOINT = 'http://ips-cic-email.invisioncic.com/sendEmail.php';
	
	/**
	 * @brief	Community
	 */
	protected $community;
	
	/**
	 * Constructor
	 *
	 * @param	string	$apiKey	API Key
	 * @return	void
	 */
	public function __construct()
	{
		if ( \IPS\CIC and preg_match( '/^\/var\/www\/html\/(.+?)(?:\/|$)/i', \IPS\ROOT_PATH, $matches ) )
		{
			$this->community = $matches[1];
		}
		else
		{
			throw new \RuntimeException('Site not compatible with IPS Cloud Email');
		}
	}
	
	/**
	 * Send the email
	 * 
	 * @param	mixed	$to					The member or email address, or array of members or email addresses, to send to
	 * @param	mixed	$cc					Addresses to CC (can also be email, member or array of either)
	 * @param	mixed	$bcc				Addresses to BCC (can also be email, member or array of either)
	 * @param	mixed	$fromEmail			The email address to send from. If NULL, default setting is used
	 * @param	mixed	$fromName			The name the email should appear from. If NULL, default setting is used
	 * @param	array	$additionalHeaders	The name the email should appear from. If NULL, default setting is used
	 * @return	void
	 * @throws	\IPS\Email\Outgoing\Exception
	 */
	public function _send( $to, $cc=array(), $bcc=array(), $fromEmail = NULL, $fromName = NULL, $additionalHeaders = array() )
	{
		\IPS\Http\Url::external( static::ENDPOINT )->request()->post( array(
			'siteId'			=> $this->community,
			'to'				=> explode( ',', static::_parseRecipients( $to, TRUE ) ),
			'cc'				=> explode( ',', static::_parseRecipients( $cc, TRUE ) ),
			'bcc'				=> explode( ',', static::_parseRecipients( $bcc, TRUE ) ),
			'fromEmail'			=> $fromEmail ?: \IPS\Settings::i()->email_out,
			'fromName'			=> $fromName ?: \IPS\Settings::i()->board_name,
			'additionalHeaders'	=> $additionalHeaders,
			'subject'			=> $this->compileSubject( static::_getMemberFromRecipients( $to ) ),
			'html'				=> $this->compileContent( 'html', static::_getMemberFromRecipients( $to ) ),
			'plaintext'			=> $this->compileContent( 'plaintext', static::_getMemberFromRecipients( $to ) ),
			'precedence'		=> ( $this->type === static::TYPE_LIST ) ? 'list' : ( $this->type === static::TYPE_BULK ? 'bulk' : '' )
		) );
	}
	
}