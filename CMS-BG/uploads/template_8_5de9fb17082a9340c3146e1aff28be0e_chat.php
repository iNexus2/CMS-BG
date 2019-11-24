<?php
namespace IPS\Theme\Cache;
class class_bimchatbox_front_chat extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function chatform( $chats, $orientation ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPad_half' id='chatBoxForm'>
	<div class="bimcb_chatArea ipsBox ipsClearfix">
		
CONTENT;

if ( \IPS\Application::load('bimchatbox')->can_Chat() ):
$return .= <<<CONTENT

			
CONTENT;

if ( !in_array(\IPS\Member::loggedIn()->member_id, explode(",", \IPS\Settings::i()->chatbox_conf_blocklist)) ):
$return .= <<<CONTENT

				<form data-action='chatform' id="cbInput_container">
					<input class='bimcb_chatInput' id="txt" name="txt" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_placeholder', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' autocomplete="off">
					<div class='cbItems'>
						<a href='#' data-ipsmenu data-ipsmenu-above='true' data-ipsmenu-appendto='#ipsLayout_contentArea' data-ipsmenu-closeonclick='false' id='elEmoticons_chatbox' data-ipstooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_emoticons', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
							<img src='
CONTENT;

$return .= \IPS\Theme::i()->resource( "emo.png", "bimchatbox", 'front', false );
$return .= <<<CONTENT
' width='24px' height='24px'>
						</a>
						<button type="submit" class="ipsButton ipsButton_primary ipsButton_verySmall" data-action="chat" id="chat_button"><span class="ipsType_small"><i class="fa fa-level-down fa-rotate-90"></i></span></button>
					</div>
				</form>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad_half ipsType_warning' style='margin-top: 5px;'><i class="fa fa-exclamation-triangle"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_error_inblock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsPad_half' style='margin-top: 5px;'><i class="fa fa-exclamation-triangle"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_error_noper', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function edit( $chat ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox' data-controller="bimChatBoxMain">
	<h3 class="ipsType_reset ipsType_sectionTitle ipsClearfix">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<div class="ipsPad">
		<textarea rows="4" cols="50" id="editmsg_
CONTENT;
$return .= htmlspecialchars( $chat['id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $chat['chat'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</textarea>
		<br><br>
		<a href="#" data-action="edit" data-id="
CONTENT;
$return .= htmlspecialchars( $chat['id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_primary">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'save', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>		
	</div>
</div>
CONTENT;

		return $return;
}

	function emoticons( $emoticons ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller="bimChatBoxMain">
	<div id='chatbox_emoticonMenu'>
		<div class='ipsMenu_headerBar'>
			<p class='ipsType_reset ipsPos_right'><a href='#' class='ipsType_blendLinks' data-role='categoryTrigger' data-ipsMenu data-ipsMenu-appendTo='#chatbox_emoticonMenu' id='id_more'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_emocategories', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a></p>
			<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_emoticons', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
			<ul data-role='categoryMenu' class='ipsMenu ipsMenu_auto' id='id_more_menu' role='menu' style='display: none'>
				
CONTENT;

foreach ( $emoticons as $k => $group ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' role='menuitem' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='EmoCatChoose'><a href='#'>
CONTENT;
$return .= htmlspecialchars( $group['title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
		<div class='ipsMenu_innerContent ipsEmoticons_content'>
			
CONTENT;

foreach ( $emoticons as $k => $group ):
$return .= <<<CONTENT

				
CONTENT;

$cnt++;
$return .= <<<CONTENT

				<div id='emoCat_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='emoCat' 
CONTENT;

if ( $cnt > 1 ):
$return .= <<<CONTENT
style="display: none;"
CONTENT;

endif;
$return .= <<<CONTENT
>
					<div class='ipsAreaBackground_light ipsPad_half'><strong>
CONTENT;
$return .= htmlspecialchars( $group['title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></div>
					<div class='ipsEmoticons_category' data-categoryid='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						
CONTENT;

foreach ( (array) $group['emoticons'] as $emo ):
$return .= <<<CONTENT

							<div data-action="emo_emo" class="cbEmoList" data-emoticon="
CONTENT;
$return .= htmlspecialchars( $emo['text'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title="
CONTENT;
$return .= htmlspecialchars( $emo['text'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><img src="
CONTENT;
$return .= htmlspecialchars( $emo['src'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></div>
						
CONTENT;

endforeach;
$return .= <<<CONTENT
				
					</div>			
				</div>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function main( $orientation ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$ann = \IPS\Application::load('bimchatbox')->announcement();
$return .= <<<CONTENT

<div data-controller="bimChatBoxMain">
	<div class="ipsTabs ipsClearfix" id="elChatbox" data-ipstabbar data-ipstabbar-contentarea="#elChatboxContent">
		
CONTENT;

if ( $orientation != 'vertical' ):
$return .= <<<CONTENT

			<ul class="ipsPos_right ipsList_inline ipsList_noSpacing">
				<li>
					<a href="#" class="ipsButton ipsButton_verySmall ipsButton_overlaid" data-action="toggleSound" data-ipstooltip="" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_togglesound', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class="fa fa-volume-up"></i></a>
				</li>
				
CONTENT;

if ( \IPS\Application::load('bimchatbox')->can_Manage() ):
$return .= <<<CONTENT

					<li>
						<a href="#" class="ipsButton ipsButton_verySmall ipsButton_overlaid" data-ipsDialog data-ipsDialog-url='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=bimchatbox&module=chatbox&controller=chatbox&do=cbmanage", null, "", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog-size='narrow' data-ipstooltip="" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_management', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class="fa fa-wrench"></i></a>			
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT
		
			</ul>
		
CONTENT;

else:
$return .= <<<CONTENT

			<ul class="ipsPos_right ipsList_inline ipsList_noSpacing manaButtonSmall">
				<li>
					<a href="#" data-action="toggleSound" data-ipstooltip="" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_togglesound', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class="fa fa-volume-up"></i></a>&nbsp;&nbsp;
				</li>
				
CONTENT;

if ( \IPS\Application::load('bimchatbox')->can_Manage() ):
$return .= <<<CONTENT

					<li>
						<a href="#" data-ipsDialog data-ipsDialog-url='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=bimchatbox&module=chatbox&controller=chatbox&do=cbmanage", null, "", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog-size='narrow' data-ipstooltip="" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_management', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class="fa fa-wrench"></i></a>			
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT
		
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT
		
		
CONTENT;

if ( $ann && \IPS\Settings::i()->chatbox_conf_anntab == 1 ):
$return .= <<<CONTENT

			<a href="#" data-action="expandTabs" id="cbexpandTabs"><i class="fa fa-caret-down"></i></a>
			<ul role="tablist" class="ipsList_reset" id="elChatboxBar">
				<li>
					<a href="#" role="tab" id="chatbox" class="ipsFaded_withHover ipsTabs_item ipsTabs_activeItem 
CONTENT;

if ( $orientation=='vertical' ):
$return .= <<<CONTENT
cbTabSmall
CONTENT;

endif;
$return .= <<<CONTENT
" aria-selected="true">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
				<li>
					<a href="#" role="tab" id="cbannouncement" class="ipsFaded_withHover ipsTabs_item 
CONTENT;

if ( $orientation=='vertical' ):
$return .= <<<CONTENT
cbTabSmall
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_ann_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
			</ul>
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='cbTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div id="elChatboxContent">
		<div id="ipsTabs_elChatbox_chatbox_panel" class="ipsTabs_panel" data-tab="chatbox" aria-hidden="false" style="display: block;">	
			
CONTENT;

if ( $ann && \IPS\Settings::i()->chatbox_conf_anntab != 1 ):
$return .= <<<CONTENT

				<div class="ipsAreaBackground ipsPad_half ipsClearfix">
					{$ann}
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Settings::i()->chatbox_conf_ordertop == 1 ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "chat", "bimchatbox" )->chatform( $chat, $orientation );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT
				
			<div id='chatboxWrap' 
CONTENT;

if ( \IPS\Settings::i()->chatbox_conf_height ):
$return .= <<<CONTENT
style='height: 
CONTENT;

$return .= \IPS\Settings::i()->chatbox_conf_height;
$return .= <<<CONTENT
px !important;'
CONTENT;

endif;
$return .= <<<CONTENT
>
				
CONTENT;

if ( \IPS\Settings::i()->chatbox_conf_ordertop != 1 ):
$return .= <<<CONTENT

					<div id='loadMore' data-action='loadMore' class='ipsAreaBackground_light ipsPad_half ipsType_center ipsCursor_pointer'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cb_loadmore', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<ul id='chatcontent' class="ipsDataList ipsDataList_reducedSpacing ipsLoading">
				</ul>
				
CONTENT;

if ( \IPS\Settings::i()->chatbox_conf_ordertop == 1 ):
$return .= <<<CONTENT

					<div id='loadMore' data-action='loadMore' class='ipsAreaBackground_light ipsPad_half ipsType_center ipsCursor_pointer'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cb_loadmore', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
				
CONTENT;

endif;
$return .= <<<CONTENT
				
			</div>
			
CONTENT;

if ( \IPS\Settings::i()->chatbox_conf_ordertop != 1 ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "chat", "bimchatbox" )->chatform( $chat, $orientation );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		
CONTENT;

if ( $ann && \IPS\Settings::i()->chatbox_conf_anntab == 1 ):
$return .= <<<CONTENT

			<div id="ipsTabs_elChatbox_cbannouncement_panel" class="ipsTabs_panel" data-tab="cbannouncement" aria-hidden="false" style="display: none;">
				<div class='ipsPad' id='announcementWrap' 
CONTENT;

if ( \IPS\Settings::i()->chatbox_conf_height ):
$return .= <<<CONTENT
style='height: 
CONTENT;

$return .= \IPS\Settings::i()->chatbox_conf_height;
$return .= <<<CONTENT
px !important;'
CONTENT;

endif;
$return .= <<<CONTENT
>
					{$ann}
				</div>
			</div>	
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function manage( $form ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox'>
	<h3 class="ipsType_reset ipsType_sectionTitle ipsClearfix">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'chatbox_management', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<div class="ipsPad">
		{$form}
	</div>
</div>

CONTENT;

		return $return;
}}