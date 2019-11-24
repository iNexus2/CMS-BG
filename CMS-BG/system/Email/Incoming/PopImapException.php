<?php
/**
 * @brief		POP/IMAP Exception class
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		21 December 2015
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\Email\Incoming;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * POP/IMAP Exception class
 */
class _PopImapException extends \Exception
{
	
}