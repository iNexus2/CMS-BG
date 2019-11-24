<?php
namespace IPS\Theme\Cache;
class class_core_front_sharelinks extends \IPS\Theme\Template
{
	public $cache_key = '6e1f840c39b425b524abd74ce399d994';
	function delicious( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_delicious" target="_blank" data-role='shareLink' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delicious_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener noreferrer'>
	<i class="fa fa-delicious"></i>
</a>
CONTENT;

		return $return;
}

	function digg( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_digg" target="_blank" data-role="shareLink" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'digg_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener noreferrer'>
	<i class="fa fa-digg"></i>
</a>
CONTENT;

		return $return;
}

	function email( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cShareLink cShareLink_email' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'send_email_form', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_sent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
	<i class="fa fa-envelope"></i>
</a>
CONTENT;

		return $return;
}

	function facebook( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href="https://www.facebook.com/sharer/sharer.php?u=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_facebook" target="_blank" data-role="shareLink" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'facebook_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener noreferrer'>
	<i class="fa fa-facebook"></i>
</a>
CONTENT;

		return $return;
}

	function google( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href="https://plus.google.com/share?url=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_google" target="_blank" data-role="shareLink" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'googleplus_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener noreferrer'>
	<i class="fa fa-google-plus"></i>
</a>
CONTENT;

		return $return;
}

	function linkedin( $url, $title ) {
		$return = '';
		$return .= <<<CONTENT

<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&amp;title=
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_linkedin" target="_blank" data-role="shareLink" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lin_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener noreferrer'>
	<i class="fa fa-linkedin"></i>
</a>
CONTENT;

		return $return;
}

	function pinterest( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_pinterest" target="_blank" data-role="shareLink" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinterest_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener noreferrer'>
	<i class="fa fa-pinterest"></i>
</a>
CONTENT;

		return $return;
}

	function reddit( $url, $title ) {
		$return = '';
		$return .= <<<CONTENT

<a href="http://www.reddit.com/submit?url=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&amp;title=
CONTENT;

$return .= htmlspecialchars( urlencode( $title ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_reddit" target="_blank" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reddit_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener noreferrer'>
	<i class="fa fa-reddit"></i>
</a>
CONTENT;

		return $return;
}

	function stumble( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href="http://www.stumbleupon.com/submit?url=
CONTENT;

$return .= htmlspecialchars( urlencode( $url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_stumble" target="_blank" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stumble_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener noreferrer'>
	<i class="fa fa-stumbleupon"></i>
</a>
CONTENT;

		return $return;
}

	function twitter( $url, $title ) {
		$return = '';
		$return .= <<<CONTENT

<a href="http://twitter.com/share?text=
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&amp;url=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_twitter" target="_blank" data-role="shareLink" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'twitter_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener noreferrer'>
	<i class="fa fa-twitter"></i>
</a>
CONTENT;

		return $return;
}}