<?php
/**
 * @brief		Upgrader: Custom Post Upgrade Message
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		16 May 2016
 * @version		SVN_VERSION_NUMBER
 */

if ( \IPS\Application::appIsEnabled('cms' ) )
{
	$message = \IPS\Theme::i()->getTemplate( 'global' )->block( NULL, "Please check any custom moderator permissions (ACP -> Members -> Moderators) for Pages Database categories. These have been reset to 'All Categories'." );
}	
