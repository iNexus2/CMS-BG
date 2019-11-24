<?php
namespace IPS\Theme\Cache;
class class_bimchatbox_front_widgets extends \IPS\Theme\Template
{
	public $cache_key = '7f8ab000617f45f2c5d1c97b4529026b';
	function bimchatbox( $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "chat", "bimchatbox" )->main( $orientation );
$return .= <<<CONTENT

CONTENT;

		return $return;
}}