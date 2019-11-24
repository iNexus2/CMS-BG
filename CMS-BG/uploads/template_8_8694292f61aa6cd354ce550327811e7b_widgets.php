<?php
namespace IPS\Theme\Cache;
class class_bimchatbox_front_widgets extends \IPS\Theme\Template
{
	public $cache_key = '43c5d9edca0dc3eee2872c122411b0e4';
	function bimchatbox( $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "chat", "bimchatbox" )->main( $orientation );
$return .= <<<CONTENT

CONTENT;

		return $return;
}}