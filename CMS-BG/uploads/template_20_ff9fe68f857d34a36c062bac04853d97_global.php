<?php
namespace IPS\Theme\Cache;
class class_gms_front_global extends \IPS\Theme\Template
{
	public $cache_key = 'f08b9663d84b3750506d9fdebffa0d5a';
	function messageList( $override=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->gms_enable OR $override == TRUE ):
$return .= <<<CONTENT

    
CONTENT;

if ( \IPS\Settings::i()->gms_include_global_title AND count( \IPS\gms\Message::messages() ) AND $override == FALSE ):
$return .= <<<CONTENT

        <h3>
CONTENT;

$return .= htmlspecialchars( str_replace( '%board_name%', \IPS\Settings::i()->board_name, \IPS\Member::loggedIn()->language()->get( 'gms_title_value' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>  
    
CONTENT;

endif;
$return .= <<<CONTENT


    
CONTENT;

foreach ( \IPS\gms\Message::messages() as $message ):
$return .= <<<CONTENT

        
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "gms" )->messageRow( $message );
$return .= <<<CONTENT

    
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function messageRow( $message ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $message->canSee() ):
$return .= <<<CONTENT
 
    
CONTENT;

if ( $options = json_decode( $message->options, TRUE ) AND ( $options['message_style'] == '1' OR $options['message_style'] == '2' )  ):
$return .= <<<CONTENT

        <div class='ipsMessage ipsMessage_info'>
        	
CONTENT;

if ( $message->show_title ):
$return .= <<<CONTENT
<h4 class='ipsMessage_title'>
CONTENT;
$return .= htmlspecialchars( $message->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h4>
CONTENT;

endif;
$return .= <<<CONTENT

        	<p class='ipsType_reset ipsType_medium'>{$message->_description}</p>
        </div>  
    
CONTENT;

elseif ( $options['message_style'] == '3' ):
$return .= <<<CONTENT

        <div class='ipsMessage ipsMessage_error'>
        	
CONTENT;

if ( $message->show_title ):
$return .= <<<CONTENT
<h4 class='ipsMessage_title'>
CONTENT;
$return .= htmlspecialchars( $message->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h4>
CONTENT;

endif;
$return .= <<<CONTENT

        	<p class='ipsType_reset ipsType_medium'>{$message->_description}</p>
        </div>
    
CONTENT;

elseif ( $options['message_style'] == '5' ):
$return .= <<<CONTENT

        <div class='ipsMessage ipsMessage_success'>
        	
CONTENT;

if ( $message->show_title ):
$return .= <<<CONTENT
<h4 class='ipsMessage_title'>
CONTENT;
$return .= htmlspecialchars( $message->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h4>
CONTENT;

endif;
$return .= <<<CONTENT

        	<p class='ipsType_reset ipsType_medium'>{$message->_description}</p>
        </div>  
    
CONTENT;

elseif ( $options['message_style'] == '6' ):
$return .= <<<CONTENT

        <div class='ipsMessage ipsMessage_warning'>
        	
CONTENT;

if ( $message->show_title ):
$return .= <<<CONTENT
<h4 class='ipsMessage_title'>
CONTENT;
$return .= htmlspecialchars( $message->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h4>
CONTENT;

endif;
$return .= <<<CONTENT

        	<p class='ipsType_reset ipsType_medium'>{$message->_description}</p>
        </div> 
    
CONTENT;

elseif ( !is_numeric( $options['message_style'] ) ):
$return .= <<<CONTENT

        <div class='
CONTENT;
$return .= htmlspecialchars( $options['message_style'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
        	
CONTENT;

if ( $message->show_title ):
$return .= <<<CONTENT
<div id='gms_message_
CONTENT;
$return .= htmlspecialchars( $message->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_title'>
CONTENT;
$return .= htmlspecialchars( $message->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
CONTENT;

endif;
$return .= <<<CONTENT

        	<div id='gms_message_
CONTENT;
$return .= htmlspecialchars( $message->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_message'>{$message->_description}</div>
        </div>         
    
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}