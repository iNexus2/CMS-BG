<?php
/**
 * @brief		Upgrader: Custom Upgrade Options
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		5 Jun 2014
 * @version		SVN_VERSION_NUMBER
 */

$options	= array(
	new \IPS\Helpers\Form\Radio( '32000_avatar_or_photo', NULL, TRUE, array( 'options' => array( 'avatars' => 'avph_avatar', 'photos' => 'avph_photo' ) ) )
);