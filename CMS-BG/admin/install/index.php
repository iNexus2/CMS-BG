<?php
/**
 * @brief		Installer bootstrap
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		2 Apr 2013
 * @version		SVN_VERSION_NUMBER
 */

define('READ_WRITE_SEPARATION', FALSE);
require_once '../../init.php';
\IPS\Dispatcher\Setup::i()->setLocation('install')->run();