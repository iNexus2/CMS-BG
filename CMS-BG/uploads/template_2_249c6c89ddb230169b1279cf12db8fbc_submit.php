<?php
namespace IPS\Theme\Cache;
class class_videos_front_submit extends \IPS\Theme\Template
{
	public $cache_key = 'cc7a0b96a5466081026f7422220a2b9a';
	function categorySelect( $form ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('videos_select_category') );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsPad'>

CONTENT;

endif;
$return .= <<<CONTENT

	{$form}

CONTENT;

if ( \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function formPage( $category, $form ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( $category->_title );
$return .= <<<CONTENT


<div class='ipsBox ipsPad'>
<div class='ipsType_normal ipsType_richText'>
	{$form}
</div>
</div>
CONTENT;

		return $return;
}}