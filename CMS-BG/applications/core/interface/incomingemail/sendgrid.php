<?php
/**
 * @brief		Handle incoming email that has been POSTed to this script
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		11 November 2016
 * @version		SVN_VERSION_NUMBER
 */

require_once str_replace( 'applications/core/interface/incomingemail/sendgrid.php', '', str_replace( '\\', '/', __FILE__ ) ) . 'init.php';

if ( isset( $_POST['email'] ) )
{
	$incomingEmail = new \IPS\Email\Incoming\Email( $_POST['email'] );
	$incomingEmail->route();
}