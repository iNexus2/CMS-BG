<?php
namespace IPS\Theme\Cache;
class class_donate_front_payment extends \IPS\Theme\Template
{
	public $cache_key = '6e1f840c39b425b524abd74ce399d994';
	function paymentMessage(  ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsType_normal'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donation_success_message', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
<br><br><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate", null, "donate", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'return_donations', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</div>
CONTENT;

		return $return;
}

	function paymentWrapper( $content ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsType_center ipsPad'>
	<i class='ipsType_huge fa fa-money'></i>
	<h1 class='ipsType_reset ipsType_veryLarge ipsType_center'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donation', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
</div>

<section class='ipsAreaBackground_light ipsPad'>
	<div class='ipsBox ipsPad'>
		{$content}
	</div>
</section>
CONTENT;

		return $return;
}}