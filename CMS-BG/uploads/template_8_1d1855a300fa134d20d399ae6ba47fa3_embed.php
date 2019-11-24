<?php
namespace IPS\Theme\Cache;
class class_core_global_embed extends \IPS\Theme\Template
{
	public $cache_key = 'a057bb55030d4ae500a3cc9e42011493';
	function embedNoPermission(  ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbedded'>
    <div class='ipsEmbedded_headerArea'>
        <h4 class='ipsType_reset ipsType_normal ipsTruncate ipsTruncate_line'><i class='fa fa-warning'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'embed_no_perm_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
    </div>
    <div class='ipsEmbedded_content'>
    	<p class="ipsType_large ipsPad ipsType_light">
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'embed_no_perm_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
    </div>
</div>
CONTENT;

		return $return;
}

	function embedUnavailable(  ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbedded'>
    <div class='ipsEmbedded_headerArea'>
        <h4 class='ipsType_reset ipsType_normal ipsTruncate ipsTruncate_line'><i class='fa fa-warning'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'embed_unavailable_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
    </div>
    <div class='ipsEmbedded_content'>
    	<p class="ipsType_large ipsPad ipsType_light">
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'embed_unavailable_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
    </div>
</div>
CONTENT;

		return $return;
}

	function google( $url ) {
		$return = '';
		$return .= <<<CONTENT

<script type='text/javascript' src='https://apis.google.com/js/plusone.js'></script>
<div class='g-post' data-href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_blank' rel='noopener noreferrer'>
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
CONTENT;

		return $return;
}

	function googleMaps( $q, $mapType, $zoom = NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbeddedOther' contenteditable="false">
	<iframe height="450"
	
CONTENT;

if ( $mapType == 'place' ):
$return .= <<<CONTENT

		src="https://www.google.com/maps/embed/v1/place?key=
CONTENT;

$return .= \IPS\Settings::i()->google_maps_api_key;
$return .= <<<CONTENT
&q=
CONTENT;
$return .= htmlspecialchars( $q, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

elseif ( $mapType =='coordinates' ):
$return .= <<<CONTENT

		src="https://www.google.com/maps/embed/v1/view?key=
CONTENT;

$return .= \IPS\Settings::i()->google_maps_api_key;
$return .= <<<CONTENT
&center=
CONTENT;
$return .= htmlspecialchars( $q, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&zoom=
CONTENT;
$return .= htmlspecialchars( $zoom, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

endif;
$return .= <<<CONTENT
>
	</iframe>
</div>

CONTENT;

		return $return;
}

	function iframe( $url, $width=NULL, $height=NULL, $embedId=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbeddedOther 
CONTENT;

if ( \IPS\Settings::i()->max_video_width > 0 ):
$return .= <<<CONTENT
ipsEmbeddedOther_limited
CONTENT;

endif;
$return .= <<<CONTENT
' contenteditable="false">
	<iframe src="{$url}" data-controller="core.front.core.autoSizeIframe" 
CONTENT;

if ( $embedId ):
$return .= <<<CONTENT
data-embedId='
CONTENT;
$return .= htmlspecialchars( $embedId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
></iframe>
</div>
CONTENT;

		return $return;
}

	function link( $url, $title ) {
		$return = '';
		$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_blank' rel='noopener noreferrer'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
CONTENT;

		return $return;
}

	function photo( $imageUrl, $linkUrl=NULL, $title=NULL, $width=NULL, $height=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $linkUrl ):
$return .= <<<CONTENT
<a href='
CONTENT;
$return .= htmlspecialchars( $linkUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_blank' rel='noopener noreferrer'>
CONTENT;

endif;
$return .= <<<CONTENT

    <img src='
CONTENT;
$return .= htmlspecialchars( $imageUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsImage' 
CONTENT;

if ( $width ):
$return .= <<<CONTENT
width="
CONTENT;
$return .= htmlspecialchars( $width, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
px"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $height ):
$return .= <<<CONTENT
height="
CONTENT;
$return .= htmlspecialchars( $height, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
px"
CONTENT;

endif;
$return .= <<<CONTENT
>

CONTENT;

if ( $linkUrl ):
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function video( $html ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbeddedVideo 
CONTENT;

if ( \IPS\Settings::i()->max_video_width > 0 ):
$return .= <<<CONTENT
ipsEmbeddedVideo_limited
CONTENT;

endif;
$return .= <<<CONTENT
' contenteditable="false"><div>{$html}</div></div>
CONTENT;

		return $return;
}

	function vine( $url ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsEmbeddedVideo"><iframe class="vine-embed" src="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
/embed/simple" width="600" height="600" frameborder="0"></iframe><script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script></div>
CONTENT;

		return $return;
}}