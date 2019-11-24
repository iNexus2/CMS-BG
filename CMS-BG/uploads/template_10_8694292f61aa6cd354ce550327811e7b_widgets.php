<?php
namespace IPS\Theme\Cache;
class class_bimchatbox_front_widgets extends \IPS\Theme\Template
{
	public $cache_key = '82e238fb5d63057039aeae7a06229de6';
	function bimchatbox( $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "chat", "bimchatbox" )->main( $orientation );
$return .= <<<CONTENT

CONTENT;

		return $return;
}}