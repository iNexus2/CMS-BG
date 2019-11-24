<?php
namespace IPS\Theme\Cache;
class class_bimchatbox_front_embed extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function chatvars( $emoticons, $badwords ) {
		$return = '';
		$return .= <<<CONTENT

<script type='text/javascript'>
	ips.setSetting( 'chatbox_conf_interval', 
CONTENT;

$return .= \IPS\Settings::i()->chatbox_conf_interval;
$return .= <<<CONTENT
 );
	ips.setSetting( 'chatbox_soundEnabled', ips.utils.db.get( 'chatbox', 'sounds' ) );
	ips.setSetting( 'chatbox_topStyle', 
CONTENT;

$return .= \IPS\Settings::i()->chatbox_conf_ordertop;
$return .= <<<CONTENT
 );	
	ips.setSetting( 'chatbox_maxMSG', 
CONTENT;

$return .= \IPS\Settings::i()->chatbox_conf_chatlimit;
$return .= <<<CONTENT
 );
	ips.setSetting( 'chatbox_maxEmoticons', 
CONTENT;

$return .= \IPS\Settings::i()->chatbox_conf_maxemoticons;
$return .= <<<CONTENT
 );	
	ips.setSetting( 'chatbox_Emoticons', 
CONTENT;

$return .= json_encode( $emoticons );
$return .= <<<CONTENT
 );	
	ips.setSetting( 'badwords', 
		
CONTENT;

$return .= json_encode( $badwords );
$return .= <<<CONTENT

	);	
	ips.setSetting( 'chatbox_imgPost', 
CONTENT;

$return .= \IPS\Settings::i()->chatbox_conf_imgPost;
$return .= <<<CONTENT
 );	
	ips.setSetting( 'chatbox_24h', 
CONTENT;

if ( \IPS\Settings::i()->chatbox_conf_timeformat == '24' ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
 );	
	ips.setSetting( 'chatbox_getAll', false );
	
CONTENT;

if ( \IPS\Member::loggedin()->member_id ):
$return .= <<<CONTENT

		ips.setSetting( 'chatbox_myname', '
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedin()->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' );
	
CONTENT;

endif;
$return .= <<<CONTENT

</script>
CONTENT;

		return $return;
}}