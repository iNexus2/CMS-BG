<?php
namespace IPS\Theme\Cache;
class class_core_front_global extends \IPS\Theme\Template
{
	public $cache_key = 'd4d4a3dc40dedef2b935857445f12793';
	function acknowledgeWarning( $warnings=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $warnings as $idx => $warning ):
$return .= <<<CONTENT

	
CONTENT;

if ( $idx === 0 ):
$return .= <<<CONTENT

		<div class='ipsMessage ipsMessage_error'>
			<h4 class='ipsMessage_title'>
CONTENT;

$sprintf = array(\IPS\Member::load( $warning->moderator )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'you_have_been_warned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</h4>
			
CONTENT;

if ( \IPS\Member::loggedIn()->isBanned() ):
$return .= <<<CONTENT

				
CONTENT;

if ( $warning->note_member ):
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_medium'>{$warning->note_member}</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'must_acknowledge_msg', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				<br>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=view&id={$warning->member}&w={$warning->id}", null, "warn_view", array( \IPS\Member::loggedIn()->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_veryLight' data-ipsDialog data-ipsDialog-size='narrow'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_warning_details', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<br>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function blankTemplate( $html, $title=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<!DOCTYPE html>
<html lang="
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->bcp47(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" dir="
CONTENT;

if ( \IPS\Member::loggedIn()->language()->isrtl ):
$return .= <<<CONTENT
rtl
CONTENT;

else:
$return .= <<<CONTENT
ltr
CONTENT;

endif;
$return .= <<<CONTENT
">
	<head>
		<title>
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->getTitle( $title ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</title>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeMeta(  );
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeCSS(  );
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['js_include'] != 'footer' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
endif;
$return .= <<<CONTENT

	</head>
	<body class='ipsApp ipsApp_front ipsClearfix ipsLayout_noBackground 
CONTENT;

if ( isset( \IPS\Request::i()->cookie['hasJS'] ) ):
$return .= <<<CONTENT
ipsJS_has
CONTENT;

else:
$return .= <<<CONTENT
ipsJS_none
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix
CONTENT;

foreach ( \IPS\Output::i()->bodyClasses as $class ):
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endforeach;
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Output::i()->globalControllers ):
$return .= <<<CONTENT
data-controller='
CONTENT;

$return .= htmlspecialchars( implode( ',', \IPS\Output::i()->globalControllers ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( \IPS\Output::i()->inlineMessage ) ):
$return .= <<<CONTENT
data-message="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->inlineMessage, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 itemscope itemtype="http://schema.org/WebSite">
		{$html}
		
CONTENT;

if ( \IPS\Theme::i()->settings['js_include'] == 'footer' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Output::i()->endBodyCode;
$return .= <<<CONTENT

	</body>
</html>
CONTENT;

		return $return;
}

	function box( $content=NULL, $classes=array() ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsBox 
CONTENT;

if ( count( $classes) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( implode( ' ', $classes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
	{$content}
</div>
CONTENT;

		return $return;
}

	function breadcrumb( $useMicrodata=TRUE, $position='top', $markRead=TRUE ) {
		$return = '';
		$return .= <<<CONTENT

<nav class='ipsBreadcrumb ipsBreadcrumb_
CONTENT;
$return .= htmlspecialchars( $position, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsFaded_withHover'>
	
CONTENT;

if ( $position == 'bottom' ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rssMenu(  );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


	<ul class='ipsList_inline ipsPos_right'>
		
CONTENT;

$defaultStream = \IPS\core\Stream::defaultStream();
$return .= <<<CONTENT

		<li 
CONTENT;

if ( !\IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'discover' ) )  ):
$return .= <<<CONTENT
 class='ipsHide'
CONTENT;

endif;
$return .= <<<CONTENT
>
			<a data-action="defaultStream" class='ipsType_light 
CONTENT;

if ( ! $defaultStream ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'  href='
CONTENT;

if ( $defaultStream ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $defaultStream->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'><i class='icon-newspaper'></i> <span>
CONTENT;

if ( $defaultStream ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $defaultStream->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span></a>
		</li>
		
CONTENT;

if ( $markRead && \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

			<li>
				<a data-action="markSiteRead" class='ipsType_light' data-controller="core.front.core.markRead" href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=markread" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "mark_site_as_read", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_site_read', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_site_read_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>

	<ul 
CONTENT;

if ( $useMicrodata ):
$return .= <<<CONTENT
itemscope itemtype="http://schema.org/BreadcrumbList"
CONTENT;

endif;
$return .= <<<CONTENT
>
		<li 
CONTENT;

if ( $useMicrodata ):
$return .= <<<CONTENT
 itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"
CONTENT;

endif;
$return .= <<<CONTENT
>
			<a title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'home', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
' 
CONTENT;

if ( $useMicrodata ):
$return .= <<<CONTENT
itemscope itemtype="http://schema.org/Thing" itemprop="item"
CONTENT;

endif;
$return .= <<<CONTENT
>
				<span 
CONTENT;

if ( $useMicrodata ):
$return .= <<<CONTENT
itemprop="name"
CONTENT;

endif;
$return .= <<<CONTENT
><i class='fa fa-home'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'home', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( count( \IPS\Output::i()->breadcrumb ) ):
$return .= <<<CONTENT
 <i class='fa fa-angle-right'></i>
CONTENT;

endif;
$return .= <<<CONTENT
</span>
			</a>
			<meta itemprop="position" content="1">
		</li>
		
CONTENT;

$i = 0;
$return .= <<<CONTENT

		
CONTENT;

foreach ( \IPS\Output::i()->breadcrumb as $k => $b ):
$return .= <<<CONTENT

			<li 
CONTENT;

if ( $useMicrodata ):
$return .= <<<CONTENT
 itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"
CONTENT;

endif;
$return .= <<<CONTENT
>
				
CONTENT;

if ( $b[0] === NULL ):
$return .= <<<CONTENT

					
CONTENT;
$return .= htmlspecialchars( $b[1], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $b[0], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $useMicrodata ):
$return .= <<<CONTENT
itemscope itemtype="http://schema.org/Thing" itemprop="item"
CONTENT;

endif;
$return .= <<<CONTENT
>
						<span 
CONTENT;

if ( $useMicrodata ):
$return .= <<<CONTENT
itemprop="name"
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $b[1], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( ( $i + 1 != count( \IPS\Output::i()->breadcrumb ) ) ):
$return .= <<<CONTENT
<i class='fa fa-angle-right'></i>
CONTENT;

endif;
$return .= <<<CONTENT
</span>
					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<meta itemprop="position" content="
CONTENT;
$return .= htmlspecialchars( $i+2, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			</li>
			
CONTENT;

$i++;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</nav>
CONTENT;

		return $return;
}

	function buttons( $buttons ) {
		$return = '';
		$return .= <<<CONTENT

<ul class='ipsToolList ipsToolList_horizontal ipsClearfix'>
	
CONTENT;

foreach ( $buttons as $button ):
$return .= <<<CONTENT

		<li class='
CONTENT;

if ( isset( $button['hidden'] ) and $button['hidden'] ):
$return .= <<<CONTENT
ipsJS_hide
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( isset( $button['id'] ) ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $button['id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
			<a
				
CONTENT;

if ( isset( $button['link'] ) ):
$return .= <<<CONTENT
href='
CONTENT;
$return .= htmlspecialchars( $button['link'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

				title='
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
				class='ipsButton ipsButton_alternate ipsButton_small ipsButton_fullWidth 
CONTENT;

if ( isset( $button['class'] ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $button['class'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'
				role="button"
				
CONTENT;

if ( isset( $button['id'] ) ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $button['id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_button"
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['target'] ) ):
$return .= <<<CONTENT
target="
CONTENT;
$return .= htmlspecialchars( $button['target'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['data'] ) ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $button['data'] as $k => $v ):
$return .= <<<CONTENT

						data-
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['hotkey'] ) ):
$return .= <<<CONTENT

					data-keyAction='
CONTENT;
$return .= htmlspecialchars( $button['hotkey'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
				
CONTENT;

endif;
$return .= <<<CONTENT

			>
				
CONTENT;

if ( $button['icon'] ):
$return .= <<<CONTENT

					<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $button['icon'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i>&nbsp;
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT


				
CONTENT;

if ( isset($button['dropdown']) ):
$return .= <<<CONTENT

					&nbsp;<i class='fa fa-caret-down'></i>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>
CONTENT;

		return $return;
}

	function cachingLog( $log ) {
		$return = '';
		$return .= <<<CONTENT

<div id="elCachingLog">
	
CONTENT;

foreach ( $log as $i => $log ):
$return .= <<<CONTENT

		<div class="cCachingLog" data-ipsDialog data-ipsDialog-content="#elCachingLog
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
			
CONTENT;

if ( $log[0] === 'get' ):
$return .= <<<CONTENT

				<span class="cCachingLogMethod cCachingLogMethod_get">get</span>
				<span class="cCachingLogKey">
CONTENT;
$return .= htmlspecialchars( $log[1], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

elseif ( $log[0] === 'set' ):
$return .= <<<CONTENT

				<span class="cCachingLogMethod cCachingLogMethod_set">set</span>
				<span class="cCachingLogKey">
CONTENT;
$return .= htmlspecialchars( $log[1], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

elseif ( $log[0] === 'check' ):
$return .= <<<CONTENT

				<span class="cCachingLogMethod cCachingLogMethod_check">check</span>
				<span class="cCachingLogKey">
CONTENT;
$return .= htmlspecialchars( $log[1], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

elseif ( $log[0] === 'key' ):
$return .= <<<CONTENT

				<span class="cCachingLogMethod cCachingLogMethod_delete">delete</span>
				<span class="cCachingLogKey">
CONTENT;
$return .= htmlspecialchars( $log[1], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div id='elCachingLog
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsPad ipsHide'>
			
CONTENT;

if ( $log[2] !== NULL ):
$return .= <<<CONTENT

				<pre class="prettyprint lang-php">
CONTENT;
$return .= htmlspecialchars( $log[2], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
				<hr class="ipsHr">
			
CONTENT;

endif;
$return .= <<<CONTENT

			<pre class="prettyprint lang-php">
CONTENT;
$return .= htmlspecialchars( $log[3], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
		</div>
		<hr class="ipsHr">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function comment( $item, $comment, $editorName, $app, $type, $class='' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT

<div id='comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap' data-controller='core.front.core.comment' data-commentApp='
CONTENT;
$return .= htmlspecialchars( $app, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentType='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentID="
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-quoteData='
CONTENT;

$return .= htmlspecialchars( json_encode( array('userid' => $comment->author()->member_id, 'username' => $comment->author()->name, 'timestamp' => $comment->mapped('date'), 'contentapp' => $app, 'contenttype' => $type, 'contentclass' => $class, 'contentid' => $item->id, 'contentcommentid' => $comment->$idField) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment_content ipsType_medium'>
	
CONTENT;

if ( in_array( 'IPS\Content\Reputation', class_implements( $comment ) ) and \IPS\Settings::i()->reputation_highlight and $comment->reputation() >= \IPS\Settings::i()->reputation_highlight and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

		<strong class='ipsComment_popularFlag' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-heart'></i></strong>
	
CONTENT;

endif;
$return .= <<<CONTENT


	<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'mini', $comment->warningRef() );
$return .= <<<CONTENT

		<div>
			<p class='ipsPos_right ipsType_reset ipsType_blendLinks'>
				
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_use_ip_tools') and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) ):
$return .= <<<CONTENT

					<span class='ipsResponsive_hidePhone'>(<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=ip_tools&ip=$comment->ip_address", null, "modcp_ip_tools", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$sprintf = array($comment->ip_address); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_prefix', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a>)
CONTENT;

if ( count( $comment->sharelinks() ) or count( $item->commentMultimodActions() ) ):
$return .= <<<CONTENT
 &middot;
CONTENT;

endif;
$return .= <<<CONTENT
</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( count( $comment->sharelinks() ) ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false' id='elShareComment_
CONTENT;
$return .= htmlspecialchars( $comment->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='shareComment'><i class='fa fa-share-alt'></i></a>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( count( $item->commentMultimodActions() ) ):
$return .= <<<CONTENT

					<span class='ipsCustomInput'>
						<input type="checkbox" name="multimod[
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1" data-role="moderation" data-actions="
CONTENT;

if ( $comment->canSplit() ):
$return .= <<<CONTENT
split merge
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->hidden() === -1 AND $comment->canUnhide() ):
$return .= <<<CONTENT
unhide
CONTENT;

elseif ( $comment->hidden() === 1 AND $comment->canUnhide() ):
$return .= <<<CONTENT
approve
CONTENT;

elseif ( $comment->canHide() ):
$return .= <<<CONTENT
hide
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->canDelete() ):
$return .= <<<CONTENT
delete
CONTENT;

endif;
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $comment->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $comment->tableStates(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
						<span></span>
					</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
			<h3 class='ipsComment_author ipsType_blendLinks'>
				<strong class='ipsType_normal'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $comment->author(), $comment->warningRef() );
$return .= <<<CONTENT
</strong>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationBadge( $comment->author() );
$return .= <<<CONTENT

			</h3>
			<p class='ipsComment_meta ipsType_light ipsType_medium'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>{$comment->dateLine()}</a>
				
CONTENT;

if ( $comment->editLine() ):
$return .= <<<CONTENT

					(
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edited_lc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->hidden() ):
$return .= <<<CONTENT

					&middot; 
CONTENT;
$return .= htmlspecialchars( $comment->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $comment instanceof \IPS\Content\ReportCenter and !\IPS\Member::loggedIn()->group['gbw_no_report'] and $comment->hidden() !== 1  ):
$return .= <<<CONTENT

					&middot; <a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('report'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-remoteSubmit data-ipsDialog-size='medium' data-ipsDialog-flashMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_submit_success', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-action='reportComment' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>

			
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') and $comment->warning ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentWarned( $comment );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
	<div class='ipsPad'>
		
		<div data-role='commentContent' class='ipsType_normal ipsType_richText ipsType_break ipsContained' data-controller='core.front.core.lightboxedImages'>
			
CONTENT;

if ( $comment->hidden() === 1 && $comment->author()->member_id == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				<strong class='ipsType_medium ipsType_warning'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'comment_awaiting_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
			
CONTENT;

endif;
$return .= <<<CONTENT

			{$comment->content()}
			
			
CONTENT;

if ( $comment->editLine() ):
$return .= <<<CONTENT

				{$comment->editLine()}
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		
		
CONTENT;

if ( $comment->hidden() !== 1 && $comment instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $comment, 'ipsPos_right ipsResponsive_noFloat' );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT


		<ul class='ipsComment_controls ipsClearfix' data-role="commentControls">
			
CONTENT;

if ( $comment->hidden() === 1 && ( $comment->canUnhide() || $comment->canDelete() ) ):
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->canUnhide() ):
$return .= <<<CONTENT

					<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('unhide')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_positive' data-action='approveComment'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->canDelete() ):
$return .= <<<CONTENT

					<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('delete')->csrf()->setQueryString('page',\IPS\Request::i()->page), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-action='deleteComment' data-updateOnDelete="#commentCount" class='ipsButton ipsButton_verySmall ipsButton_negative'><i class='fa fa-times'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->canEdit() || $comment->canSplit() || $comment->canHide() ):
$return .= <<<CONTENT

					<li>
						<a href='#elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i></a>
						<ul id='elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_narrow ipsHide'>
							
CONTENT;

if ( $comment->canEdit() ):
$return .= <<<CONTENT

								
CONTENT;

if ( $comment->mapped('first') and $comment->item()->canEdit() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( 'do', 'edit' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

else:
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('edit'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $comment->canSplit() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('split'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='splitComment' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $item::$title )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split_to_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $comment instanceof \IPS\Content\Hideable and $comment->canHide() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('hide')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->hidden() === 0 and $item->canComment() and $editorName ):
$return .= <<<CONTENT

					<li data-ipsQuote-editor='
CONTENT;
$return .= htmlspecialchars( $editorName, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsQuote-target='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsJS_show'>
						<button class='ipsButton ipsButton_light ipsButton_verySmall ipsButton_narrow cMultiQuote ipsHide' data-action='multiQuoteComment' data-ipsTooltip data-ipsQuote-multiQuote data-mqId='mq
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'multiquote', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-plus'></i></button>
					</li>
					<li data-ipsQuote-editor='
CONTENT;
$return .= htmlspecialchars( $editorName, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsQuote-target='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsJS_show'>
						<a href='#' data-action="quoteComment" data-ipsQuote-singleQuote>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'quote', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->canEdit() ):
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->mapped('first') and $comment->item()->canEdit() ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( 'do', 'edit' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

else:
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('edit'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->canDelete() || $comment->canSplit() || ( $comment instanceof \IPS\Content\Hideable AND ( ( !$comment->hidden() and $comment->canHide() ) || ( $comment->hidden() and $comment->canUnhide() ) ) ) ):
$return .= <<<CONTENT

					<li>
						<a href='#elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i></a>
						<ul id='elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_narrow ipsHide'>
							
CONTENT;

if ( $comment instanceof \IPS\Content\Hideable ):
$return .= <<<CONTENT

								
CONTENT;

if ( !$comment->hidden() and $comment->canHide() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('hide')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

elseif ( $comment->hidden() and $comment->canUnhide() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('unhide')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $comment->canSplit() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('split'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='splitComment' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $item::$title )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split_to_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $comment->canDelete() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('delete')->csrf()->setQueryString('page',\IPS\Request::i()->page), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='deleteComment' data-updateOnDelete="#commentCount">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<li class='ipsHide' data-role='commentLoading'>
				<span class='ipsLoading ipsLoading_tiny ipsLoading_noAnim'></span>
			</li>
		</ul>
	</div>

	<div class='ipsMenu ipsMenu_wide ipsHide cPostShareMenu' id='elShareComment_
CONTENT;
$return .= htmlspecialchars( $comment->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
		<div class='ipsPad'>
			<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
			<hr class='ipsHr'>
			<h5 class='ipsType_normal ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'link_to_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>
			<input type='text' value='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsField_fullWidth'>
			
CONTENT;

if ( count( $comment->sharelinks() ) ):
$return .= <<<CONTENT

			<h5 class='ipsType_normal ipsType_reset ipsSpacer_top'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_externally', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sharelinks( $comment );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function commentContainer( $item, $comment ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT


CONTENT;

$itemClassSafe = str_replace( '\\', '_', mb_substr( $comment::$itemClass, 4 ) );
$return .= <<<CONTENT


CONTENT;

if ( $comment->isIgnored() ):
$return .= <<<CONTENT

	<div class='ipsComment ipsComment_ignored ipsPad_half ipsType_light' id='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ignoreCommentID='elComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ignoreUserID='
CONTENT;
$return .= htmlspecialchars( $comment->author()->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignoring_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu data-ipsMenu-menuID='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu-appendTo='#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="ignoreOptions" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_post_ignore_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
		<ul class='ipsMenu ipsHide' id='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
			<li class='ipsMenu_item' data-ipsMenuValue='showPost'><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_this_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li class='ipsMenu_sep'><hr></li>
			<li class='ipsMenu_item' data-ipsMenuValue='stopIgnoring'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=remove&id={$comment->author()->member_id}", null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stop_ignoring_posts_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a></li>
			<li class='ipsMenu_item'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore", null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_ignore_preferences', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</ul>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


<a id='comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></a>
<article itemscope 
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT
data-memberGroup="
CONTENT;
$return .= htmlspecialchars( $comment->author()->member_group_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

endif;
$return .= <<<CONTENT
 itemtype="http://schema.org/Comment" id='elComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment 
CONTENT;

if ( in_array( 'IPS\Content\Reputation', class_implements( $comment ) ) and \IPS\Settings::i()->reputation_highlight and $comment->reputation() >= \IPS\Settings::i()->reputation_highlight and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT
ipsComment_popular
CONTENT;

endif;
$return .= <<<CONTENT
 ipsComment_parent ipsClearfix ipsClear 
CONTENT;

if ( $comment->isIgnored() ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT
ipsComment_highlighted
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $comment->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->comment( $item, $comment, $item::$formLangPrefix . 'comment', $item::$application, $item::$module, $itemClassSafe );
$return .= <<<CONTENT

</article>
CONTENT;

		return $return;
}

	function commentEditHistory( $editHistory, $comment ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>

CONTENT;

endif;
$return .= <<<CONTENT


<div class="ipsPad" data-role="commentFeed">
	
CONTENT;

if ( count($editHistory)  ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $editHistory as $edit ):
$return .= <<<CONTENT

	<article class='ipsComment ipsComment_parent ipsClearfix ipsClear'>
		<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini ipsPhotoPanel_notPhone'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $edit['member'] ), 'mini' );
$return .= <<<CONTENT

			<div>
				<h3 class='ipsComment_author ipsType_sectionHead'>
					
CONTENT;

$return .= \IPS\Member::load( $edit['member'] )->link();
$return .= <<<CONTENT

				</h3>
				<p class='ipsComment_meta ipsType_light'>
					
CONTENT;

$val = ( $edit['time'] instanceof \IPS\DateTime ) ? $edit['time'] : \IPS\DateTime::ts( $edit['time'] );$return .= $val->html();
$return .= <<<CONTENT

					
CONTENT;

if ( $edit['reason'] ):
$return .= <<<CONTENT

					<br>
					
CONTENT;
$return .= htmlspecialchars( $edit['reason'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>
			</div>
		</div>
		<div class='ipsAreaBackground_reset ipsPad'>
			<div class='ipsType_richText'>
				{$edit['new']}
			</div>
		</div>
	</article>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<article class='ipsComment ipsComment_parent ipsClearfix ipsClear'>
		<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini ipsPhotoPanel_notPhone'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'mini' );
$return .= <<<CONTENT

			<div>
				<h3 class='ipsComment_author ipsType_sectionHead'>
					{$comment->author()->link()}
				</h3>
				<p class='ipsComment_meta ipsType_light'>
					
CONTENT;

$val = ( $comment->mapped('date') instanceof \IPS\DateTime ) ? $comment->mapped('date') : \IPS\DateTime::ts( $comment->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

				</p>
			</div>
		</div>
		<div class='ipsAreaBackground_reset ipsPad'>
			<div class='ipsType_richText'>
				{$edit['old']}
			</div>
		</div>
	</article>
	
CONTENT;

else:
$return .= <<<CONTENT

	<p class='ipsType_large ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_edit_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function commentEditLine( $comment, $supportsReason=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<span class='ipsType_reset ipsType_medium ipsType_light' data-excludequote>
	<strong>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $comment->mapped('edit_time') )->html(FALSE), htmlspecialchars( $comment->mapped('edit_member_name'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'date_edited', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</strong>
	
CONTENT;

if ( $supportsReason && $comment->mapped('edit_reason') ):
$return .= <<<CONTENT

		<br>
CONTENT;
$return .= htmlspecialchars( $comment->mapped('edit_reason'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->edit_log == 2 and ( \IPS\Settings::i()->edit_log_public or \IPS\Member::loggedIn()->modPermission('can_view_editlog') )  ):
$return .= <<<CONTENT

		<a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('editlog'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>(
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)</a>
		
CONTENT;

if ( !$comment->mapped('edit_show') AND \IPS\Member::loggedIn()->modPermission('can_view_editlog') ):
$return .= <<<CONTENT

		<br>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'comment_edit_show_anyways', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</span>
CONTENT;

		return $return;
}

	function commentMultimod( $item, $type='comment' ) {
		$return = '';
		$return .= <<<CONTENT

<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" />

CONTENT;

$method = $type . 'MultimodActions';
$return .= <<<CONTENT


CONTENT;

if ( $actions = $item->$method() and count( $actions ) ):
$return .= <<<CONTENT

	<div class="ipsClearfix">
		<div class="ipsAreaBackground ipsPad ipsClearfix" data-role="pageActionOptions">
			<div class="ipsPos_right">
				<select name="modaction" data-role="moderationAction">
					
CONTENT;

if ( in_array( 'approve', $actions ) ):
$return .= <<<CONTENT

						<option value='approve' data-icon='check-circle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( in_array( 'split_merge', $actions ) ):
$return .= <<<CONTENT

						<option value='split' data-icon='expand'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value='merge' data-icon='level-up'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( in_array( 'hide', $actions ) or in_array( 'unhide', $actions ) ):
$return .= <<<CONTENT

						<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='eye' data-action='hide'>
							
CONTENT;

if ( in_array( 'hide', $actions ) ):
$return .= <<<CONTENT

								<option value='hide'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( in_array( 'unhide', $actions ) ):
$return .= <<<CONTENT

								<option value='unhide'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</optgroup>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( in_array( 'delete', $actions ) ):
$return .= <<<CONTENT

						<option value='delete' data-icon='trash'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</select>
				<button type="submit" class="ipsButton ipsButton_alternate ipsButton_verySmall">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
			</div>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function commentTableHeader( $comment, $status ) {
		$return = '';
		$return .= <<<CONTENT



<div class='ipsDataList ipsAreaBackground_light ipsClearfix'>
	<div class='ipsDataItem'>
		<div class='ipsDataItem_icon'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $status->author() );
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<p class='ipsType_medium ipsType_light ipsType_blendLinks ipsType_reset'>
				
CONTENT;

$htmlsprintf = array($status->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_updated_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

			</p>
			<div class='ipsType_richText ipsType_medium' data-ipsTruncate data-ipsTruncate-size='5 lines' data-ipsTruncate-type='remove'>
				{$status->truncated()}
			</div>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function commentWarned( $comment ) {
		$return = '';
		$return .= <<<CONTENT


<!-- Moderator warning -->
<div class="ipsType_reset ipsPad ipsAreaBackground_light ipsClearfix ipsPhotoPanel ipsPhotoPanel_mini">
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $comment->warning->moderator ), 'mini' );
$return .= <<<CONTENT

	<div>
		<strong class='ipsType_warning ipsType_normal'>
CONTENT;

$sprintf = array(\IPS\Member::load( $comment->warning->moderator )->name, \IPS\Member::load( $comment->warning->member )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_given_post_warning', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong>
		<br>
		<span class='ipsType_light'>
			<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_reason_message', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong> 
CONTENT;

$val = "core_warn_reason_{$comment->warning->reason}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &middot; <strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_points_message', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong> 
CONTENT;
$return .= htmlspecialchars( $comment->warning->points, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 &middot; <a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=view&id={$comment->warning->member}&w={$comment->warning->id}", null, "warn_view", array( $comment->author()->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_warning_details_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_warning_details', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</span>
	</div>
</div>
CONTENT;

		return $return;
}

	function commentsAndReviewsTabs( $content, $id ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller='core.front.core.commentsWrapper' data-tabsId='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	{$content}
</div>
CONTENT;

		return $return;
}

	function controlStrip( $buttons ) {
		$return = '';
		$return .= <<<CONTENT

<ul class='ipsControlStrip ipsType_noBreak ipsList_reset' data-ipsControlStrip>
	
CONTENT;

foreach ( $buttons as $button ):
$return .= <<<CONTENT

		<li class='ipsControlStrip_button 
CONTENT;

if ( isset( $button['hidden'] ) and $button['hidden'] ):
$return .= <<<CONTENT
ipsJS_hide
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( isset( $button['id'] ) ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $button['id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
			<a
				
CONTENT;

if ( isset( $button['link'] ) ):
$return .= <<<CONTENT
href='
CONTENT;
$return .= htmlspecialchars( $button['link'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

				title='
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
				data-ipsTooltip
				aria-label="
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
				
				
CONTENT;

if ( isset( $button['class'] ) ):
$return .= <<<CONTENT
class='
CONTENT;
$return .= htmlspecialchars( $button['class'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['data'] ) ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $button['data'] as $k => $v ):
$return .= <<<CONTENT

						data-
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['hotkey'] ) ):
$return .= <<<CONTENT

					data-keyAction='
CONTENT;
$return .= htmlspecialchars( $button['hotkey'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
				
CONTENT;

endif;
$return .= <<<CONTENT

			>
				<i class='ipsControlStrip_icon fa fa-
CONTENT;
$return .= htmlspecialchars( $button['icon'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i>
				<span class='ipsControlStrip_item'>
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</a>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>

CONTENT;

		return $return;
}

	function coverPhoto( $url, $coverPhoto ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHead_special ipsCoverPhoto' data-controller='core.front.core.coverPhoto' data-url="
CONTENT;
$return .= htmlspecialchars( $url->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-coverOffset='
CONTENT;
$return .= htmlspecialchars( $coverPhoto->offset, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $coverPhoto->file ):
$return .= <<<CONTENT

		<div class='ipsCoverPhoto_container'>
			<img src='
CONTENT;
$return .= htmlspecialchars( $coverPhoto->file->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsCoverPhoto_photo' alt=''>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $coverPhoto->editable ):
$return .= <<<CONTENT

		<a href='#elEditPhoto_menu' data-hideOnCoverEdit class='ipsCoverPhoto_button ipsPos_right ipsButton ipsButton_verySmall ipsButton_narrow ipsButton_overlaid' data-ipsMenu id='elEditPhoto' data-role='coverPhotoOptions'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsColumns ipsColumns_collapsePhone' data-hideOnCoverEdit>
		<div class='ipsColumn ipsColumn_fluid'>
			
CONTENT;

if ( $coverPhoto->editable ):
$return .= <<<CONTENT

				<ul class='ipsMenu ipsMenu_auto ipsHide' id='elEditPhoto_menu'>
					
CONTENT;

if ( $coverPhoto->file ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( 'do', 'coverPhotoRemove' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='removeCoverPhoto'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_remove', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						<li class='ipsMenu_item ipsHide'>
							<a href='#' data-action='positionCoverPhoto'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_reposition', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsMenu_item'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( 'do', 'coverPhotoUpload' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_add', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_add', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

			{$coverPhoto->overlay}
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function customFieldsDisplay( $author ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $author->contentProfileFields() as $group => $fields ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $fields as $field => $value ):
$return .= <<<CONTENT

	<li class='ipsResponsive_hidePhone ipsType_break'>
		{$value}
	</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function designersModeBuilding( $html, $title=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<!DOCTYPE html>
<html lang="
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->bcp47(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" dir="
CONTENT;

if ( \IPS\Member::loggedIn()->language()->isrtl ):
$return .= <<<CONTENT
rtl
CONTENT;

else:
$return .= <<<CONTENT
ltr
CONTENT;

endif;
$return .= <<<CONTENT
">
	<head>
		<title>
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->getTitle( $title ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</title>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeMeta(  );
$return .= <<<CONTENT

	<style type="text/css">
		/* ======================================================== */
/* PROGRESS BAR */
@-webkit-keyframes progress-bar-stripes {
  from { background-position: 40px 0; }
  to { background-position: 0 0; }
}
@-moz-keyframes progress-bar-stripes {
  from { background-position: 40px 0; }
  to { background-position: 0 0; }
}
@-ms-keyframes progress-bar-stripes {
  from { background-position: 40px 0; }
  to { background-position: 0 0; }
}
@-o-keyframes progress-bar-stripes {
  from { background-position: 0 0; }
  to { background-position: 40px 0; }
}
@keyframes progress-bar-stripes {
  from { background-position: 40px 0; }
  to { background-position: 0 0; }
}

.ipsProgressBar {
	width: 50%;
	margin: auto;
	height: 26px;
	overflow: hidden;
	background: rgb(156,156,156);
	background: -moz-linear-gradient(top, rgba(156,156,156,1) 0%, rgba(180,180,180,1) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(156,156,156,1)), color-stop(100%,rgba(180,180,180,1)));
	background: -webkit-linear-gradient(top, rgba(156,156,156,1) 0%,rgba(180,180,180,1) 100%);
	background: -o-linear-gradient(top, rgba(156,156,156,1) 0%,rgba(180,180,180,1) 100%);
	background: -ms-linear-gradient(top, rgba(156,156,156,1) 0%,rgba(180,180,180,1) 100%);
	background: linear-gradient(to bottom, rgba(156,156,156,1) 0%,rgba(180,180,180,1) 100%);
	border-radius: 4px;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
}
	
	.ipsProgressBar.ipsProgressBar_fullWidth {
		width: 100%;
	}

	.ipsProgressBar.ipsProgressBar_animated .ipsProgressBar_progress {
		background-color: #5490c0;
		background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
		background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
		background-size: 40px 40px;
	}

.ipsProgressBar_progress {
	float: left;
	width: 0;
	height: 100%;
	font-size: 12px;
	font-weight: bold;
	color: #ffffff;
	text-align: center;
	text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.25);
	background: #5490c0;
	position: relative;
	white-space: nowrap;
	line-height: 26px;
}
	
	.ipsProgressBar_warning .ipsProgressBar_progress {
		background: #8c3737;
	}

	.ipsProgressBar > span:first-child {
		padding-left: 7px;
	}

	.ipsProgressBar_progress[data-progress]:after {
		position: absolute;
		right: 5px;
		top: 0;
		line-height: 32px;
		color: #fff;
		content: attr(data-progress);
		display: block;
		font-weight: bold;
	}
	
	span[data-role=message] {
		text-align: center;
		display: block;
		margin: 8px;
		font-family: Helvetica;
	}

	</style>
	</head>
	<body class="ipsApp ipsApp_front ipsJS_none ipsClearfix ipsLayout_noBackground">
		{$html}
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
$return .= <<<CONTENT

	</body>
</html>
CONTENT;

		return $return;
}

	function embedComment( $item, $comment, $url, $image=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbedded 
CONTENT;

if ( $image ):
$return .= <<<CONTENT
ipsEmbedded_withImage
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<div class='ipsEmbedded_headerArea'>
		<h4 class='ipsType_reset ipsType_normal ipsTruncate ipsTruncate_line'>
			<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $comment::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$val = "{$comment::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></i> &nbsp;
			<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_top'>
				
CONTENT;

if ( $item::$firstCommentRequired ):
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->isFirst() ):
$return .= <<<CONTENT

						
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$sprintf = array($item->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'embed_reply_to', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$sprintf = array($item->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'embed_comment_on', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		</h4>
	</div>
	<div class='ipsEmbedded_content'>
		<div class='ipsPhotoPanel ipsPhotoPanel_notPhone ipsPhotoPanel_mini ipsClearfix ipsType_medium'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'mini', NULL, '', FALSE );
$return .= <<<CONTENT

			<div>
				<span class='ipsType_light ipsType_small'>
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $comment->mapped('date') instanceof \IPS\DateTime ) ? $comment->mapped('date') : \IPS\DateTime::ts( $comment->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT
</span>
				<div data-ipsTruncate data-ipsTruncate-size='1 lines' data-ipsTruncate-type='remove'>
					{$comment->truncated( TRUE )}
				</div>
			</div>
		</div>
	</div>
	
CONTENT;

if ( $image ):
$return .= <<<CONTENT

		<div style='background-image: url( "
CONTENT;

$return .= htmlspecialchars( str_replace( array( '(', ')' ), array( '\(', '\)' ), $image->url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" );' class='ipsEmbedded_image'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_top'>
				<img src='
CONTENT;
$return .= htmlspecialchars( $image->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			</a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function embedExternal( $output, $js ) {
		$return = '';
		$return .= <<<CONTENT

<!DOCTYPE html>
<html lang="
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->bcp47(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" dir="
CONTENT;

if ( \IPS\Member::loggedIn()->language()->isrtl ):
$return .= <<<CONTENT
rtl
CONTENT;

else:
$return .= <<<CONTENT
ltr
CONTENT;

endif;
$return .= <<<CONTENT
">
	<head>
		<script type='text/javascript'>
			var ipsDebug = 
CONTENT;

if ( ( \IPS\IN_DEV and \IPS\DEV_DEBUG_JS ) or \IPS\DEBUG_JS ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
;
		</script>

		
CONTENT;

if ( is_array( $js ) ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $js as $jsInclude ):
$return .= <<<CONTENT

				<script type='text/javascript' src='
CONTENT;
$return .= htmlspecialchars( $jsInclude, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></script>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT


		<style type='text/css' rel='stylesheet'>
			body {
				padding: 0;
				margin: 0;
			}
			body #ipsEmbedLoading {
				display: none;
			}
			body.unloaded #ipsEmbedLoading {
				display: block;
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				border: 1px solid rgba(0,0,0,0.05);
				background: #fff;
			}

			@-webkit-keyframes dummy_anim {
			  0% { background-color: #f8f8f8; }
			  50% { background-color: #f2f2f2; }
			  99% { background-color: #f8f8f8; }
			}
			@-moz-keyframes dummy_anim {
			  0% { background-color: #f8f8f8; }
			  50% { background-color: #f2f2f2; }
			  99% { background-color: #f8f8f8; }
			}
			@-ms-keyframes dummy_anim {
			  0% { background-color: #f8f8f8; }
			  50% { background-color: #f2f2f2; }
			  99% { background-color: #f8f8f8; }
			}
			@-o-keyframes dummy_anim {
			  0% { background-color: #f8f8f8; }
			  50% { background-color: #f2f2f2; }
			  99% { background-color: #f8f8f8; }
			}
			@keyframes dummy_anim {
			  0% { background-color: #f8f8f8; }
			  50% { background-color: #f2f2f2; }
			  99% { background-color: #f8f8f8; }
			}
			#ipsEmbedLoading:before,
			#ipsEmbedLoading:after,
			#ipsEmbedLoading span:before,
			#ipsEmbedLoading span:after {
				display: block;
				content: '';
				position: absolute;
				
CONTENT;

$return .= "-webkit-animation: dummy_anim 1s infinite;
	-moz-animation: dummy_anim 1s infinite;
	-ms-animation: dummy_anim 1s infinite;
	-o-animation: dummy_anim 1s infinite;
	animation: dummy_anim 1s infinite;";
$return .= <<<CONTENT

			}
			#ipsEmbedLoading:before {
				width: 50px;
				height: 50px;
				top: 15px;
				left: 15px;
			}
			#ipsEmbedLoading:after {
				width: 300px;
				height: 17px;
				top: 15px;
				left: 80px;
			}
			#ipsEmbedLoading span:before {
				width: 200px;
				height: 12px;
				top: 40px;
				left: 80px;
			}
			#ipsEmbedLoading span:after {
				width: 90%;
				opacity: 0.5;
				left: 15px;
				top: 80px;
				bottom: 15px;
			}

			.ipsJS_has#ipsEmbed {
				opacity: 0.0001;
			}
		</style>
	</head>
	<body class='unloaded 
CONTENT;

if ( isset( \IPS\Request::i()->cookie['hasJS'] ) ):
$return .= <<<CONTENT
ipsJS_has
CONTENT;

else:
$return .= <<<CONTENT
ipsJS_none
CONTENT;

endif;
$return .= <<<CONTENT
'>
		<div id='ipsEmbed'>
			{$output}
		</div>
		<div id='ipsEmbedLoading'>
			<span></span>
		</div>
	</body>
</html>
CONTENT;

		return $return;
}

	function embedItem( $item, $url, $image=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbedded 
CONTENT;

if ( $image ):
$return .= <<<CONTENT
ipsEmbedded_withImage
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<div class='ipsEmbedded_headerArea'>
		<h4 class='ipsType_reset ipsType_normal ipsTruncate ipsTruncate_line'><i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $item::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$val = "{$item::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></i> &nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_top'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h4>
	</div>
	<div class='ipsEmbedded_content'>
		<div class='ipsPhotoPanel ipsPhotoPanel_notPhone ipsPhotoPanel_mini ipsClearfix ipsType_medium'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $item->author(), 'mini', NULL, '', FALSE );
$return .= <<<CONTENT

			<div>
				
CONTENT;

if ( $container = $item->containerWrapper() ):
$return .= <<<CONTENT

					<span class='ipsType_light ipsType_small'>
						
CONTENT;

$sprintf = array($item->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $container->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
, 
CONTENT;

$val = ( $item->mapped('date') instanceof \IPS\DateTime ) ? $item->mapped('date') : \IPS\DateTime::ts( $item->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

					</span>
				
CONTENT;

else:
$return .= <<<CONTENT

					<span class='ipsType_light ipsType_small'>
CONTENT;

$sprintf = array($item->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $item->mapped('date') instanceof \IPS\DateTime ) ? $item->mapped('date') : \IPS\DateTime::ts( $item->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT
</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<div data-ipsTruncate data-ipsTruncate-size='1 lines' data-ipsTruncate-type='remove'>
					{$item->truncated( TRUE )}
				</div>
				<ul class='ipsList_inline ipsType_small ipsEmbedded_stats'>
					
CONTENT;

if ( $item instanceof \IPS\Content\Ratings and $rating = $item->averageRating() ):
$return .= <<<CONTENT

						<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rating( 'small', $rating, 5, $item->memberRating() );
$return .= <<<CONTENT
</li>
					
CONTENT;

elseif ( isset( $item::$reviewClass ) AND $rating = $item->averageReviewRating() ):
$return .= <<<CONTENT

						<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rating( 'small', $rating, \IPS\Settings::i()->reviews_rating_out_of, $item->memberReviewRating() );
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

if ( $item->reviews ):
$return .= <<<CONTENT
(
CONTENT;

$pluralize = array( $item->reviews ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'from_num_reviews', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
)
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_reviews_yet', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $item::$commentClass ):
$return .= <<<CONTENT

						
CONTENT;

if ( $item::$firstCommentRequired ):
$return .= <<<CONTENT

							<li><i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $item->mapped('num_comments') - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replies_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
						
CONTENT;

else:
$return .= <<<CONTENT

							<li><i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $item->mapped('num_comments') ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			</div>
		</div>
	</div>
	
CONTENT;

if ( $image ):
$return .= <<<CONTENT

		<div style='background-image: url( "
CONTENT;

$return .= htmlspecialchars( str_replace( array( '(', ')' ), array( '\(', '\)' ), $image->url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" );' class='ipsEmbedded_image'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_top'>
				<img src='
CONTENT;
$return .= htmlspecialchars( $image->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			</a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function embedReview( $item, $review, $url, $image=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbedded 
CONTENT;

if ( $image ):
$return .= <<<CONTENT
ipsEmbedded_withImage
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<div class='ipsEmbedded_headerArea'>
		<h4 class='ipsType_reset ipsType_normal ipsTruncate ipsTruncate_line'>
			<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $review::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$val = "{$review::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></i> &nbsp;
			<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_top'>
				
CONTENT;

$sprintf = array($item->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'embed_review_of', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

			</a>
		</h4>
	</div>
	<div class='ipsEmbedded_content'>
		<div class='ipsPhotoPanel ipsPhotoPanel_notPhone ipsPhotoPanel_mini ipsClearfix ipsType_medium'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $review->author(), 'mini', NULL, '', FALSE );
$return .= <<<CONTENT

			<div>
				<span class='ipsType_light ipsType_small'>
CONTENT;

$sprintf = array($review->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $review->mapped('date') instanceof \IPS\DateTime ) ? $review->mapped('date') : \IPS\DateTime::ts( $review->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT
</span>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rating( 'small', $review->mapped('rating') );
$return .= <<<CONTENT

				<div data-ipsTruncate data-ipsTruncate-size='1 lines' data-ipsTruncate-type='remove'>
					{$review->truncated( TRUE )}
				</div>
			</div>
		</div>
	</div>
	
CONTENT;

if ( $image ):
$return .= <<<CONTENT

		<div style='background-image: url( "
CONTENT;

$return .= htmlspecialchars( str_replace( array( '(', ')' ), array( '\(', '\)' ), $image->url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" );' class='ipsEmbedded_image'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_top'>
				<img src='
CONTENT;
$return .= htmlspecialchars( $image->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			</a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function error( $title, $message, $code, $extra, $member, $faultyPluginOrApp=NULL ) {
		$return = '';
		$return .= <<<CONTENT


<section id='elError' class='ipsType_center'>
	<div class='ipsAreaBackground_light ipsPad'>
		<i class='fa fa-exclamation-circle ipsType_huge'></i>
		<p class='ipsType_reset ipsType_light ipsType_large'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'something_went_wrong', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
		<div id='elErrorMessage' class='ipsPos_center'>
			{$message}
		</div>
		<p class='ipsType_light ipsType_reset ipsType_normal'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'error_page_code', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <strong>
CONTENT;
$return .= htmlspecialchars( $code, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
		</p>
		
CONTENT;

if ( ( \IPS\IN_DEV or $member->isAdmin() ) and $extra ):
$return .= <<<CONTENT

			
CONTENT;

if ( $faultyPluginOrApp ):
$return .= <<<CONTENT

			<p class="ipsType_reset  ipsType_large ipsPos_center">
				
CONTENT;
$return .= htmlspecialchars( $faultyPluginOrApp, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</p>
			
CONTENT;

endif;
$return .= <<<CONTENT


			<div class="ipsPad ipsType_left">
				<h3 class="ipsType_minorHeading">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'error_technical_details', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				<textarea rows="13" style="font-family: monospace;">
CONTENT;
$return .= htmlspecialchars( $extra, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</textarea>
				<p class="ipsType_small ipsType_light">
					
CONTENT;

if ( $member->isAdmin() ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'error_technical_details_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

if ( $member->hasAcpRestriction( 'core', 'support', 'system_logs_view' ) ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'error_technical_details_logs', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

elseif ( \IPS\IN_DEV ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'error_technical_details_dev', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( \IPS\Member::loggedIn()->isAdmin() and \IPS\Member::loggedIn()->hasAcpRestriction( 'core', 'support', 'get_support' ) ):
$return .= <<<CONTENT

		<p class='ipsType_light ipsType_large'>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=support&controller=support", "admin", "", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_support', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
				<i class="fa fa-lock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_support', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</a>
		</p>
	
CONTENT;

elseif ( \IPS\core\modules\front\contact\contact::canUseContactUs() and !( \IPS\Dispatcher::i()->application->directory == 'core' and \IPS\Dispatcher::i()->module and \IPS\Dispatcher::i()->module->key == 'contact' ) ):
$return .= <<<CONTENT

		<p class='ipsType_light ipsType_large'>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=contact&controller=contact", null, "contact", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact_admin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact_admin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</a>
		</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

		<br>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_normal ipsButton_medium' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</a>
	
CONTENT;

endif;
$return .= <<<CONTENT

</section>
CONTENT;

		return $return;
}

	function favico(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( \IPS\Theme::i()->logo['favicon'] ) and \IPS\Theme::i()->logo['favicon'] !== null ):
$return .= <<<CONTENT

	<link rel='shortcut icon' href='
CONTENT;

$return .= \IPS\Theme::i()->logo_favicon;
$return .= <<<CONTENT
'>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function findComment( $header, $item, $comment ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT


CONTENT;

$itemClassSafe = str_replace( '\\', '_', mb_substr( $comment::$itemClass, 4 ) );
$return .= <<<CONTENT


CONTENT;

if ( ! \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	<h1 class='ipsType_pageTitle'><a href="
CONTENT;
$return .= htmlspecialchars( $item->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->$idField ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $header, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h1>
	<br />

CONTENT;

endif;
$return .= <<<CONTENT

<article itemscope itemtype="http://schema.org/Comment" id='elComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment 
CONTENT;

if ( in_array( 'IPS\Content\Reputation', class_implements( $comment ) ) and \IPS\Settings::i()->reputation_highlight and $comment->reputation() >= \IPS\Settings::i()->reputation_highlight ):
$return .= <<<CONTENT
ipsComment_popular
CONTENT;

endif;
$return .= <<<CONTENT
 ipsComment_parent ipsClearfix ipsClear 
CONTENT;

if ( $comment->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<div id='comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap' data-controller='core.front.core.comment' data-commentApp='
CONTENT;
$return .= htmlspecialchars( $comment::$application, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentType='
CONTENT;
$return .= htmlspecialchars( $item::$module, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentID="
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-quoteData='
CONTENT;

$return .= htmlspecialchars( json_encode( array('userid' => $comment->author()->member_id, 'username' => $comment->author()->name, 'timestamp' => $comment->mapped('date'), 'contentapp' => $comment::$application, 'contenttype' => $item::$module, 'contentclass' => $itemClassSafe, 'contentid' => $item->id, 'contentcommentid' => $comment->$idField) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment_content ipsType_medium'>
		
CONTENT;

if ( in_array( 'IPS\Content\Reputation', class_implements( $comment ) ) and \IPS\Settings::i()->reputation_highlight and $comment->reputation() >= \IPS\Settings::i()->reputation_highlight and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

			<strong class='ipsComment_popularFlag' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-heart'></i></strong>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
		<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini ipsPhotoPanel_notPhone'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'mini', $comment->warningRef() );
$return .= <<<CONTENT

			<div>
				<h3 class='ipsComment_author ipsType_blendLinks'>
					<strong class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $comment->author(), $comment->warningRef() );
$return .= <<<CONTENT
</strong>
				</h3>
				<p class='ipsComment_meta ipsType_light ipsType_medium'>
					<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>{$comment->dateLine()}</a>
					
CONTENT;

if ( $comment->editLine() ):
$return .= <<<CONTENT

						&middot; {$comment->editLine()}
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->hidden() ):
$return .= <<<CONTENT

						&middot; 
CONTENT;
$return .= htmlspecialchars( $comment->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>
				
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') and $comment->warning ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentWarned( $comment );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		<div class='ipsAreaBackground_reset ipsPad'>			
			<div data-role='commentContent' class='ipsType_richText ipsContained' data-controller='core.front.core.lightboxedImages'>
				
CONTENT;

if ( $comment->hidden() === 1 && $comment->author()->member_id == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					<strong class='ipsType_medium ipsType_warning'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'comment_awaiting_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
CONTENT;

endif;
$return .= <<<CONTENT

				{$comment->content()}
			</div>
			
CONTENT;

if ( $comment->hidden() !== 1 && $comment instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

				<br>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $comment );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</article>
CONTENT;

		return $return;
}

	function follow( $app, $area, $id, $count ) {
		$return = '';
		$return .= <<<CONTENT


<div data-followApp='
CONTENT;
$return .= htmlspecialchars( $app, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-followArea='
CONTENT;
$return .= htmlspecialchars( $area, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-followID='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.front.core.followButton'>
	
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

		<span class='ipsType_light ipsType_blendLinks ipsResponsive_hidePhone ipsResponsive_inline'><i class='fa fa-info-circle'></i> <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_sign_in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>&nbsp;&nbsp;</span>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->followButton( $app, $area, $id, $count );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function followButton( $app, $area, $id, $count ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->following( $app, $area, $id ) ):
$return .= <<<CONTENT

		<div class="ipsFollow ipsButton ipsButton_primary ipsButton_verySmall" data-role="followButton" data-following="true">
			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsType_blendLinks ipsType_noUnderline" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
			<a class='ipsCommentCount' href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=followers&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'followers_tooltip', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'who_follows_this', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $count, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT
	
		<div class="ipsFollow ipsButton ipsButton_light ipsButton_verySmall" data-role="followButton" data-following="false">
			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_this_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsType_blendLinks ipsType_noUnderline" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

if ( $count > 0 ):
$return .= <<<CONTENT

				<a class='ipsCommentCount' href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=followers&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'followers_tooltip', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'who_follows_this', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $count, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
			
CONTENT;

else:
$return .= <<<CONTENT

				<span class='ipsCommentCount'>
CONTENT;
$return .= htmlspecialchars( $count, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<div class="ipsFollow ipsPos_middle ipsButton ipsButton_light ipsButton_verySmall 
CONTENT;

if ( $count == 0 ):
$return .= <<<CONTENT
ipsButton_disabled
CONTENT;

endif;
$return .= <<<CONTENT
" data-role="followButton">
		
CONTENT;

if ( $count > 0 ):
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=followers&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'followers_tooltip', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks ipsType_noUnderline' data-ipsTooltip data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'who_follows_this', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
		
CONTENT;

endif;
$return .= <<<CONTENT

				<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'followers', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				<span class='ipsCommentCount'>
CONTENT;
$return .= htmlspecialchars( $count, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
		
CONTENT;

if ( $count ):
$return .= <<<CONTENT

			</a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function footer(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( ( \IPS\Settings::i()->site_online || \IPS\Member::loggedIn()->group['g_access_offline'] ) and ( \IPS\Dispatcher::i()->application instanceof \IPS\Application AND \IPS\Dispatcher::i()->application->canAccess() ) ):
$return .= <<<CONTENT

<div class="ipsPos_left">
<ul class='ipsList_inline' id="elFooterLinks">
	
CONTENT;

$languages = \IPS\Lang::getEnabledLanguages();
$return .= <<<CONTENT

	
CONTENT;

if ( count( $languages ) > 1 ):
$return .= <<<CONTENT

		<li>
			<a href='#elNavLang_menu' id='elNavLang' data-ipsMenu data-ipsMenu-above>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'language', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
			<ul id='elNavLang_menu' class='ipsMenu ipsMenu_selectable ipsHide'>
			
CONTENT;

foreach ( $languages as $id => $lang  ):
$return .= <<<CONTENT

				<li class='ipsMenu_item
CONTENT;

if ( \IPS\Member::loggedIn()->language()->id == $id || ( $lang->default && \IPS\Member::loggedIn()->language === 0 ) ):
$return .= <<<CONTENT
 ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
					<form action="
CONTENT;

$return .= str_replace( array( 'http://', 'https://' ), '//', str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=language" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "language", array(), 0 ) ) );
$return .= <<<CONTENT
" method="post">
					<button type='submit' name='id' value='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_link'>
CONTENT;

if ( $lang->get__icon() ):
$return .= <<<CONTENT
<i class='
CONTENT;
$return .= htmlspecialchars( $lang->get__icon(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i> 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $lang->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( $lang->default ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'default', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</button>
					</form>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

$themes = \IPS\Theme::getThemesWithAccessPermission();
$return .= <<<CONTENT

	
CONTENT;

if ( count ( $themes ) > 1  ):
$return .= <<<CONTENT

		<li>
			<a href='#elNavTheme_menu' id='elNavTheme' data-ipsMenu data-ipsMenu-above>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'skin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
			<ul id='elNavTheme_menu' class='ipsMenu ipsMenu_selectable ipsHide'>
			
CONTENT;

foreach ( $themes as $id => $set  ):
$return .= <<<CONTENT

				
CONTENT;

if ( $set->canAccess() ):
$return .= <<<CONTENT

					<li class='ipsMenu_item
CONTENT;

if ( \IPS\Theme::i()->id == $id ):
$return .= <<<CONTENT
 ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
						<form action="
CONTENT;

$return .= str_replace( array( 'http://', 'https://' ), '//', str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=theme" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "theme", array(), 0 ) ) );
$return .= <<<CONTENT
" method="post">
						<button type='submit' name='id' value='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_link'>
CONTENT;

$val = "{$set->_title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

if ( $set->is_default ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'default', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</button>
						</form>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->privacy_type != "none" ):
$return .= <<<CONTENT

		<li><a href='
CONTENT;

if ( \IPS\Settings::i()->privacy_type == "internal" ):
$return .= <<<CONTENT

CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=privacy", null, "privacy", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Settings::i()->privacy_link;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'privacy', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\core\modules\front\contact\contact::canUseContactUs() and !( \IPS\Dispatcher::i()->application->directory == 'core' and \IPS\Dispatcher::i()->module and \IPS\Dispatcher::i()->module->key == 'contact' ) ):
$return .= <<<CONTENT

		<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=contact&controller=contact", null, "contact", array(), 0 ) );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Settings::i()->contact_type != 'contact_redirect'  ):
$return .= <<<CONTENT
data-ipsdialog data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact_sent_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsdialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
	
CONTENT;

endif;
$return .= <<<CONTENT

</ul>
<div id="MagnumCopyright"><a href="https://invisionpower.com/profile/537452-taman/">IPS Magnum Theme</a></div>

CONTENT;

if ( \IPS\Dispatcher::i()->application instanceof \IPS\Application AND \IPS\Dispatcher::i()->application->canManageWidgets() ):
$return .= <<<CONTENT

	<button type='button' id='elWidgetControls' data-action='openSidebar' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'manage_blocks', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_narrow'><i class='fa fa-chevron-right'></i></button>

CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

endif;
$return .= <<<CONTENT

<p id='elCopyright'>
	<span id='elCopyright_userLine'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'copyright_line_value', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
	
CONTENT;

if ( !$licenseData = \IPS\IPS::licenseKey() or !isset($licenseData['products']['copyright']) or !$licenseData['products']['copyright'] ):
$return .= <<<CONTENT
<a rel='nofollow' title='Community Software by Invision Power Services, Inc.' href='http://anonymz.com/?https://www.invisionpower.com/'>Community Software by Invision Power Services, Inc.</a>
CONTENT;

endif;
$return .= <<<CONTENT

</p>
CONTENT;

		return $return;
}

	function genericBlock( $content, $title='', $classes=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $title ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->pageHeader( $title );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<div class='
CONTENT;

if ( $classes ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
	{$content}
</div>
CONTENT;

		return $return;
}

	function globalTemplate( $title,$html,$location=array() ) {
		$return = '';
		$return .= <<<CONTENT


<!DOCTYPE html><html lang="
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->bcp47(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" dir="
CONTENT;

if ( \IPS\Member::loggedIn()->language()->isrtl ):
$return .= <<<CONTENT
rtl
CONTENT;

else:
$return .= <<<CONTENT
ltr
CONTENT;

endif;
$return .= <<<CONTENT
"><head><title>
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->getTitle( $title ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</title>
<!--[if lt IE 9]>
			
CONTENT;

foreach ( \IPS\Theme::i()->css( 'extra/ie8.css', 'core' ) as $css ):
$return .= <<<CONTENT
<link rel="stylesheet" type="text/css" href="
CONTENT;
$return .= htmlspecialchars( $css, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

endforeach;
$return .= <<<CONTENT

		    <script src="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "applications/core/interface/html5shiv/html5shiv.js", "none", "", array(), \IPS\Http\Url::PROTOCOL_RELATIVE ) );
$return .= <<<CONTENT
"></script>
		<![endif]-->
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeMeta(  );
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeCSS(  );
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['js_include'] != 'footer' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->favico(  );
$return .= <<<CONTENT

	</head><body class="ipsApp ipsApp_front 
CONTENT;

if ( isset( \IPS\Request::i()->cookie['hasJS'] ) ):
$return .= <<<CONTENT
ipsJS_has
CONTENT;

else:
$return .= <<<CONTENT
ipsJS_none
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix
CONTENT;

foreach ( \IPS\Output::i()->bodyClasses as $class ):
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endforeach;
$return .= <<<CONTENT
" 
CONTENT;

if ( \IPS\Output::i()->globalControllers ):
$return .= <<<CONTENT
data-controller="
CONTENT;

$return .= htmlspecialchars( implode( ',', \IPS\Output::i()->globalControllers ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( \IPS\Output::i()->inlineMessage ) ):
$return .= <<<CONTENT
data-message="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->inlineMessage, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

endif;
$return .= <<<CONTENT
 data-pageapp="
CONTENT;
$return .= htmlspecialchars( $location['app'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-pagelocation="front" data-pagemodule="
CONTENT;
$return .= htmlspecialchars( $location['module'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-pagecontroller="
CONTENT;
$return .= htmlspecialchars( $location['controller'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" itemscope itemtype="http://schema.org/WebSite"><meta itemprop="url" content="
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
">
<a href="#elContent" class="ipsHide" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'jump_to_content_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" accesskey="m">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'jump_to_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

if ( !\IPS\Settings::i()->site_online && \IPS\Member::loggedIn()->group['g_access_offline'] ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->offlineMessage(  );
endif;
$return .= <<<CONTENT

		<div id="ipsLayout_header" class="ipsClearfix">
			
CONTENT;

if ( !in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavBar(  );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			<header><div class="ipsLayout_container logobg 
CONTENT;

if ( \IPS\Theme::i()->settings['remove_logo_mt'] == 1 ):
$return .= <<<CONTENT
ipsResponsive_hidePhone ipsResponsive_hideTablet
CONTENT;

endif;
$return .= <<<CONTENT
">
                      
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->logo(  );
$return .= <<<CONTENT

				</div>
				<div class="magnumNav">
					
CONTENT;

if ( !in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userBar(  );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->navBar(  );
$return .= <<<CONTENT
			
				</div>
			</header>
</div>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->ta_swipersliderBase(  );
$return .= <<<CONTENT

		<main role="main" id="ipsLayout_body" class="ipsLayout_container"><div id="ipsLayout_contentArea">
				<div id="ipsLayout_contentWrapper">
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->breadcrumb( true, 'top' );
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['enable_widget_top'] == '1' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->ta_WidgetsT(  );
endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['sidebar_position'] == 'left' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sidebar( 'left' );
endif;
$return .= <<<CONTENT

					<div id="ipsLayout_mainArea">
						<a id="elContent"></a>
                      	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->updateWarning(  );
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->lkeyWarning(  );
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_global_header' );
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Member::loggedIn()->members_bitoptions['unacknowledged_warnings'] ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->acknowledgeWarning( \IPS\Member::loggedIn()->warnings( 1, FALSE ) );
endif;
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->widgetContainer( 'header', 'horizontal' );
$return .= <<<CONTENT

						{$html}
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->widgetContainer( 'footer', 'horizontal' );
$return .= <<<CONTENT

					</div>
					
CONTENT;

if ( \IPS\Theme::i()->settings['sidebar_position'] == 'right' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sidebar( 'right' );
endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['enable_widget_bottom'] == '1' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->ta_WidgetsB(  );
endif;
$return .= <<<CONTENT

                  	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->breadcrumb( false, 'bottom' );
$return .= <<<CONTENT

				</div>
			</div>
			
CONTENT;

if ( \IPS\Member::loggedIn()->msg_show_notification and $conversation = \IPS\core\Messenger\Conversation::latestUnreadConversation() ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->inlineMessage( $conversation->comments( 1, 0, 'date', 'desc' ) );
endif;
$return .= <<<CONTENT

      	</main><footer class="footer-wrap">
            
CONTENT;

if ( \IPS\Theme::i()->settings['footer_enabled'] == '1'  ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->ta_Footer(  );
endif;
$return .= <<<CONTENT

			<!-- SCROLL TO TOP -->
<div class="scroll-top-wrapper">
   <span class="scroll-top-inner"><i class="fa fa-2x fa-arrow-circle-up"></i></span>
</div>
<div id="ipsLayout_footer">
          		<div class="ipsLayout_container ipsClearfix">
					
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_global_footer' );
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->footer(  );
$return .= <<<CONTENT

				</div>
        	</div>
		</footer>
		
CONTENT;

if ( !in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

CONTENT;

if ( \IPS\Theme::i()->settings['responsive'] ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavigation(  );
endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['js_include'] == 'footer' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Settings::i()->ipbseo_ga_enabled ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Settings::i()->ipseo_ga;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Settings::i()->viglink_enabled ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->viglink(  );
endif;
$return .= <<<CONTENT

		
CONTENT;

if ( isset( $_SESSION['live_meta_tags'] ) and $_SESSION['live_meta_tags'] and \IPS\Member::loggedIn()->isAdmin() ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->metaTagEditor(  );
endif;
$return .= <<<CONTENT

		
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id and \IPS\Settings::i()->guest_terms_bar ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->guestTermsBar( base64_encode( \IPS\Settings::i()->base_url ) );
endif;
$return .= <<<CONTENT

      	<!--ipsQueryLog-->
		<!--ipsCachingLog-->
		
CONTENT;

$return .= \IPS\Output::i()->endBodyCode;
$return .= <<<CONTENT

        
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->ta_includeJS(  );
$return .= <<<CONTENT

  	</body></html>

CONTENT;

		return $return;
}

	function guestCommentTeaser( $item, $login, $isReview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$ref = base64_encode( $item->url() . '#replyForm' );
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->allow_reg ):
$return .= <<<CONTENT

	<div class='ipsType_center ipsPad'>
		
CONTENT;

if ( $isReview ):
$return .= <<<CONTENT

			<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_review_title_reg', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
			<p class='ipsType_light ipsType_normal ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_review_desc_reg', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

else:
$return .= <<<CONTENT

			<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_title_reg', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
			<p class='ipsType_light ipsType_normal ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_desc_reg', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
		<div class='ipsGrid ipsGrid_collapsePhone ipsSpacer_top'>
			<div class='ipsGrid_span6 ipsAreaBackground_light ipsPad'>
				<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_account', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<p class='ipsType_normal ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_account_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				<br>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), \IPS\Settings::i()->logins_over_https ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_account_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
			<div class='ipsGrid_span6 ipsAreaBackground_light ipsPad'>
				<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<p class='ipsType_normal ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				<br>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login&ref={$ref}", null, "login", array(), \IPS\Settings::i()->logins_over_https ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_primary ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		</div>
	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsType_center ipsPad'>
		<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_title_noreg', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<p class='ipsType_light ipsType_normal ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_desc_noreg', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<br>
		<br>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login&ref={$ref}", null, "login", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_alternate ipsButton_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function guestTermsBar( $currentUrl ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$termsLang = \IPS\Member::loggedIn()->language()->addToStack( 'terms_of_use' );
$return .= <<<CONTENT


CONTENT;

$privacyLang = \IPS\Member::loggedIn()->language()->addToStack( 'terms_privacy' );
$return .= <<<CONTENT


CONTENT;

$glLang = \IPS\Member::loggedIn()->language()->addToStack( 'guidelines' );
$return .= <<<CONTENT


CONTENT;

$termsUrl = (string) \IPS\Http\Url::internal( 'app=core&module=system&controller=terms', 'front', 'terms' );
$return .= <<<CONTENT


CONTENT;

$terms = "<a href='$termsUrl'>$termsLang</a>";
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Settings::i()->privacy_type == 'internal' ):
$return .= <<<CONTENT

	
CONTENT;

$privacyUrl = (string) \IPS\Http\Url::internal( 'app=core&module=system&controller=privacy', 'front', 'privacy' );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

$privacyUrl = \IPS\Settings::i()->privacy_link;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

$privacy = "<a href='$privacyUrl'>$privacyLang</a>";
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Settings::i()->gl_type == 'internal' ):
$return .= <<<CONTENT

	
CONTENT;

$glUrl = (string) \IPS\Http\Url::internal( 'app=core&module=system&controller=guidelines', 'front', 'guidelines' );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

$glUrl = \IPS\Settings::i()->gl_link;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

$guidelines = "<a href='$glUrl'>$glLang</a>";
$return .= <<<CONTENT


<div id='elGuestTerms' class='ipsPad_half ipsJS_hide' data-role='guestTermsBar' data-controller='core.front.core.guestTerms'>
	<div class='ipsLayout_container'>
		<div class='ipsGrid ipsGrid_collapsePhone'>
			<div class='ipsGrid_span10'>
				<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_terms_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<p class='ipsType_reset ipsType_medium cGuestTerms_contents'>
CONTENT;

$htmlsprintf = array($terms, $privacy, $guidelines); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_terms_bar_text_value', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
			</div>
			<div class='ipsGrid_span2'>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=terms&do=dismiss&ref={$currentUrl}", null, "", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_veryLight ipsButton_large ipsButton_fullWidth' data-action='dismissTerms'><i class='fa fa-check'></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_terms_close', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function inlineMessage( $message ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elInlineMessage' class='ipsPad' title='
CONTENT;

$sprintf = array($message->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_inline_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
	<div class='ipsPhotoPanel ipsPhotoPanel_medium'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $message->author(), 'medium' );
$return .= <<<CONTENT

		<div class='ipsType_normal'>
			<strong>
CONTENT;
$return .= htmlspecialchars( $message->item()->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong><br>
			<span class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_inline_date', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $message->date instanceof \IPS\DateTime ) ? $message->date : \IPS\DateTime::ts( $message->date );$return .= $val->html();
$return .= <<<CONTENT
</span>
			<br>
			<div data-ipsTruncate data-ipsTruncate-type="remove" data-ipsTruncate-size="3 lines">
				{$message->post}
			</div>
			<hr class='ipsHr'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $message->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_inline_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
CONTENT;

if ( \IPS\Member::loggedIn()->msg_count_new > 1 ):
$return .= <<<CONTENT
 <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger", null, "messaging", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_inline_view_all', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $message->canReport() ):
$return .= <<<CONTENT
 &nbsp;&nbsp; <a href='
CONTENT;
$return .= htmlspecialchars( $message->url('report'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><span class='ipsResponsive_showPhone ipsResponsive_inline'><i class='fa fa-flag'></i></span><span class='ipsResponsive_hidePhone ipsResponsive_inline'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a>
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function itemIcon( $iconInfo ) {
		$return = '';
		$return .= <<<CONTENT


<span class='ipsItemStatus 
CONTENT;

if ( $iconInfo['size'] ):
$return .= <<<CONTENT
ipsItemStatus_
CONTENT;
$return .= htmlspecialchars( $iconInfo['size'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'><i class='
CONTENT;

if ( $iconInfo['type'] == 'unread' ):
$return .= <<<CONTENT
fa fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
'></i></span>
CONTENT;

		return $return;
}

	function loginPopup( $login ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elUserSignIn_menu' class='ipsMenu ipsMenu_auto ipsHide'>
	<div data-role="loginForm">
		
CONTENT;

if ( count ( $login->forms( FALSE, TRUE ) ) > 1 ):
$return .= <<<CONTENT

			<div class='ipsColumns ipsColumns_noSpacing'>
				<div class='ipsColumn ipsColumn_wide' id='elUserSignIn_internal'>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

foreach ( $login->forms( FALSE, TRUE ) as $k => $form ):
$return .= <<<CONTENT

			
CONTENT;

if ( $k === '_standard' ):
$return .= <<<CONTENT

				{$form->customTemplate( array( \IPS\Theme::i()->getTemplate( 'global', 'core', 'front' ), 'loginPopupForm' ) )}
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

if ( count ( $login->forms( FALSE, TRUE ) ) > 1 ):
$return .= <<<CONTENT

				</div>
				<div class='ipsColumn ipsColumn_wide'>
					<div class='ipsPad' id='elUserSignIn_external'>
						<div class='ipsAreaBackground_light ipsPad_half'>
							<p class='ipsType_reset ipsType_small ipsType_center'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_with_these', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></p>
							<br>
							
CONTENT;

foreach ( $login->forms( FALSE, TRUE ) as $k => $form ):
$return .= <<<CONTENT

								
CONTENT;

if ( $k !== '_standard' ):
$return .= <<<CONTENT

									<div class='ipsPad_half ipsType_center'>
										{$form}
									</div>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</div>
					</div>
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

	function loginPopupForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsPad ipsForm ipsForm_vertical" method='post' action='
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsValidation novalidate>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<h4 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
	<br><br>
	<ul class='ipsList_reset'>
		
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

				
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Text ):
$return .= <<<CONTENT

					<li class="ipsFieldRow ipsFieldRow_noLabel ipsFieldRow_fullWidth">
						<input type="
CONTENT;
$return .= htmlspecialchars( $input->formType, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" required placeholder="
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name='
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					</li>
				
CONTENT;

else:
$return .= <<<CONTENT

					{$input->rowHtml($form)}
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

		<li class="ipsFieldRow ipsFieldRow_fullWidth">
			<br>
			<button type="submit" class="ipsButton ipsButton_primary ipsButton_small" id="elSignIn_submit">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
			<br>
			<p class="ipsType_right ipsType_small">
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=lostpass", null, "lostpassword", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</p>
		</li>
	</ul>
</form>
CONTENT;

		return $return;
}

	function logo(   ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->logo['front']['url'] !== null  ):
$return .= <<<CONTENT


CONTENT;

$logo = \IPS\File::get( 'core_Theme', \IPS\Theme::i()->logo['front']['url'] )->url;
$return .= <<<CONTENT

<a href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
' id='elLogo' accesskey='1'><img src="
CONTENT;
$return .= htmlspecialchars( $logo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" alt='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->board_name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', TRUE );
$return .= <<<CONTENT
'></a>

CONTENT;

else:
$return .= <<<CONTENT

<a href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
' id='elSiteTitle' accesskey='1'>
CONTENT;

if ( \IPS\Theme::i()->settings['site_title'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['site_title'];
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function metaTagEditor(  ) {
		$return = '';
		$return .= <<<CONTENT


<div id='elMetaTagEditor' class='ipsToolbox ipsPad ipsScrollbar' data-controller="core.front.system.metaTagEditor">
	<h3 class='ipsToolbox_title ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'live_meta_tag_editor', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<form accept-charset='utf-8' method='post' action="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=metatags&do=save", null, "", array(), 0 ) );
$return .= <<<CONTENT
" data-ipsForm>
		<input type='hidden' name='meta_url' value='
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->metaTagsUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

		<h4 class='ipsToolbox_sectionTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_page_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
		<input name='meta_tag_title' type='text' value="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->metaTagsTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<br><br>

		<h4 class='ipsToolbox_sectionTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_tags_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>

		<ul class='ipsList_reset' id='elMetaTagEditor_tags'>
			
CONTENT;

foreach ( \IPS\Output::i()->metaTags as $name => $content ):
$return .= <<<CONTENT

				<li>
					<ul class='ipsForm ipsForm_vertical'>
						<li class='ipsFieldRow ipsFieldRow_fullWidth'>
							<select name='meta_tag_name[]'>
								<option value='keywords' 
CONTENT;

if ( $name == 'keywords' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_keywords', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='description' 
CONTENT;

if ( $name == 'description' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_description', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='robots' 
CONTENT;

if ( $name == 'robots' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_robots', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='other' 
CONTENT;

if ( !in_array( $name, array( 'keywords', 'description', 'robots' ) ) ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_other', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
							</select>
						</li>
						<li class='ipsFieldRow ipsFieldRow_fullWidth'>
							<input name='meta_tag_name_other[]' type='text' value="
CONTENT;

if ( !in_array( $name, array( 'keywords', 'description', 'robots' ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_name', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
						</li>
						<li class='ipsFieldRow ipsFieldRow_fullWidth'>
							<input name='meta_tag_content[]' type='text' value="
CONTENT;
$return .= htmlspecialchars( $content, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
						</li>
					</ul>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

			<li class='ipsHide' data-role='metaTemplate'>
				<ul class='ipsForm ipsForm_vertical'>
					<li class='ipsFieldRow ipsFieldRow_fullWidth'>
						<select name='meta_tag_name[]' class='ipsField_fullWidth'>
							<option value='keywords'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_keywords', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
							<option value='description'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_description', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
							<option value='robots'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_robots', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
							<option value='other'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_other', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						</select>
					</li>
					<li class='ipsFieldRow ipsFieldRow_fullWidth'>
						<input name='meta_tag_name_other[]' type='text' value="" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_name', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
					</li>
					<li class='ipsFieldRow ipsFieldRow_fullWidth'>
						<input name='meta_tag_content[]' type='text' value="" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
					</li>
				</ul>
			</li>
		</ul>
		<br>
		<a href='#' class='ipsJS_show ipsButton ipsButton_normal ipsButton_fullWidth ipsButton_verySmall' data-action='addMeta'><i class='fa fa-plus'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_another_meta_tag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>

		<div class="ipsClearfix ipsPad ipsType_center" id='elMetaTagEditor_submit'>
			<button class='ipsButton ipsButton_important' role='button' type='submit'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'save', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=metatags&do=end", null, "", array(), 0 ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'end_metatags', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</div>
	</form>
</div>
CONTENT;

		return $return;
}

	function mobileNavBar(   ) {
		$return = '';
		$return .= <<<CONTENT

<ul id='elMobileNav' class='ipsList_inline ipsResponsive_hideDesktop ipsResponsive_block' data-controller='core.front.core.mobileNav' data-default="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->defaultSearchOption[0], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

if ( count( \IPS\Output::i()->breadcrumb ) ):
$return .= <<<CONTENT

		
CONTENT;

if ( count( \IPS\Output::i()->breadcrumb ) == 1 ):
$return .= <<<CONTENT

			<li id='elMobileBreadcrumb'>
				<a href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
'>
					<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'home', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</a>
			</li>
		
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

$i = 0;
$return .= <<<CONTENT

			
CONTENT;

foreach ( \IPS\Output::i()->breadcrumb as $k => $b ):
$return .= <<<CONTENT

				
CONTENT;

if ( $i + 2 == count( \IPS\Output::i()->breadcrumb ) ):
$return .= <<<CONTENT

					<li id='elMobileBreadcrumb'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $b[0], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
							<span>
CONTENT;
$return .= htmlspecialchars( $b[1], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
						</a>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$i++;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
	
CONTENT;

$defaultStream = \IPS\core\Stream::defaultStream();
$return .= <<<CONTENT

	<li 
CONTENT;

if ( !\IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'discover' ) )  ):
$return .= <<<CONTENT
class='ipsHide'
CONTENT;

endif;
$return .= <<<CONTENT
>
		<a data-action="defaultStream" class='ipsType_light'  href='
CONTENT;

if ( $defaultStream ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $defaultStream->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=discover&controller=streams", null, "discover_all", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'><i class='icon-newspaper'></i></a>
	</li>

	
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'search' ) ) ):
$return .= <<<CONTENT

		<li class='ipsJS_show'>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search", null, "search", array(), 0 ) );
$return .= <<<CONTENT
' data-action="mobileSearch"><i class='fa fa-search'></i></a>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<li data-ipsDrawer data-ipsDrawer-drawerElem='#elMobileDrawer'>
		<a href='#'>
			
CONTENT;

$total = \IPS\Member::loggedIn()->notification_cnt;
$return .= <<<CONTENT

			
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

				
CONTENT;

$total += \IPS\Member::loggedIn()->msg_count_new;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) and \IPS\Member::loggedIn()->modPermission('can_view_reports') ):
$return .= <<<CONTENT

				
CONTENT;

$total += \IPS\Member::loggedIn()->reportCount();
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $total ):
$return .= <<<CONTENT

				<span class='ipsNotificationCount' data-notificationType='total'>
CONTENT;
$return .= htmlspecialchars( $total, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<i class='fa fa-navicon'></i>
		</a>
	</li>
</ul>
CONTENT;

		return $return;
}

	function mobileNavigation(   ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elMobileDrawer' class='ipsDrawer ipsHide'>
	<a href='#' class='ipsDrawer_close' data-action='close'><span>&times;</span></a>
	<div class='ipsDrawer_menu'>
		<div class='ipsDrawer_content'>
			
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				<ul id='elUserNav_mobile' class='ipsList_inline signed_in ipsClearfix'>
					<li class='cNotifications cUserNav_icon'>
						<a href='#elMobNotifications_menu' id='elMobNotifications' data-ipsMenu data-ipsMenu-menuID='elFullNotifications_menu' data-ipsMenu-closeOnClick='false'>
							<i class='fa fa-bell'></i> <span class='ipsNotificationCount 
CONTENT;

if ( !\IPS\Member::loggedIn()->notification_cnt ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-notificationType='notify'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->notification_cnt, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
						</a>
					</li>
					
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

						<li class='cInbox cUserNav_icon'>
							<a href='#elMobInbox_menu' id='elMobInbox' data-ipsMenu data-ipsMenu-menuID='elFullInbox_menu' data-ipsMenu-closeOnClick='false'>
								<i class='fa fa-envelope'></i> <span class='ipsNotificationCount 
CONTENT;

if ( !\IPS\Member::loggedIn()->msg_count_new ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-notificationType='inbox'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->msg_count_new, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
							</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) and \IPS\Member::loggedIn()->modPermission('can_view_reports') ):
$return .= <<<CONTENT

						<li class='cReports cUserNav_icon'>
							<a href='#elMobReports_menu' id='elMobReports' data-ipsMenu data-ipsMenu-menuID='elFullReports_menu' data-ipsMenu-closeOnClick='false'>
								<i class='fa fa-warning'></i> 
CONTENT;

if ( \IPS\Member::loggedIn()->reportCount() ):
$return .= <<<CONTENT
<span class='ipsNotificationCount' data-notificationType='reports'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->reportCount(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT


			<div class='ipsSpacer_bottom ipsPad'>
				<ul class='ipsToolList ipsToolList_vertical'>
					
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

						<li>
							<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login&do=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_small ipsButton_fullWidth'>
								
CONTENT;

if ( isset( $_SESSION['logged_in_as_key'] ) ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($_SESSION['logged_in_from']['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'switch_to_account', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

else:
$return .= <<<CONTENT

						<li>
							<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), \IPS\Settings::i()->logins_over_https ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_small ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

if ( \IPS\Settings::i()->allow_reg ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), \IPS\Settings::i()->logins_over_https ) );
$return .= <<<CONTENT
' id='elRegisterButton_mobile' class='ipsButton ipsButton_small ipsButton_fullWidth ipsButton_important'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT


					
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

						<li>
							<a class='ipsButton ipsButton_small ipsButton_primary ipsButton_fullWidth' data-action="markSiteRead" data-controller="core.front.core.markRead" href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=markread" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "mark_site_as_read", array(), 0 ) );
$return .= <<<CONTENT
'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_site_read_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			</div>

			<ul class='ipsDrawer_list'>
				
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					<li class='ipsDrawer_itemParent'>
						<h4 class='ipsDrawer_title'><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mobile_menu_account', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></h4>
						<ul class='ipsDrawer_list'>
							<li data-action="back"><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mobile_menu_back', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) ) ):
$return .= <<<CONTENT

								<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_my_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_attach_max'] != 0 ):
$return .= <<<CONTENT

								<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=attachments", null, "attachments", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=followed", null, "followed_content", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_followed_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li id='elAccountSettingsLinkMobile'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings", null, "settings", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_account_settings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_settings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			                <li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore", null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_manage_ignore', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

if ( ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) AND \IPS\Member::loggedIn()->modPermission() ) or ( \IPS\Member::loggedIn()->isAdmin() AND !\IPS\Settings::i()->security_remove_acp_link ) ):
$return .= <<<CONTENT

								
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) AND \IPS\Member::loggedIn()->modPermission() ):
$return .= <<<CONTENT

									<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp", null, "modcp", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_modcp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( \IPS\Member::loggedIn()->isAdmin() AND !\IPS\Settings::i()->security_remove_acp_link  ):
$return .= <<<CONTENT

									<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::baseURL( ( \IPS\Settings::i()->logins_over_https ) ? \IPS\Http\Url::PROTOCOL_HTTPS : \IPS\Http\Url::PROTOCOL_RELATIVE ) . \IPS\CP_DIRECTORY, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_blank'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_admincp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-lock'></i></a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT


				
CONTENT;

$primaryBars = \IPS\core\FrontNavigation::i()->roots();
$return .= <<<CONTENT

				
CONTENT;

$subBars = \IPS\core\FrontNavigation::i()->subBars();
$return .= <<<CONTENT

				
				
CONTENT;

foreach ( $primaryBars as $id => $item ):
$return .= <<<CONTENT

					
CONTENT;

if ( $item->canView() ):
$return .= <<<CONTENT

						
CONTENT;

$children = $item->children();
$return .= <<<CONTENT

						
CONTENT;

if ( ( $subBars && isset( $subBars[ $id ] ) && count( $subBars[ $id ] ) ) || $children ):
$return .= <<<CONTENT

							<li class='ipsDrawer_itemParent'>
								<h4 class='ipsDrawer_title'><a href='#'>
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h4>
								<ul class='ipsDrawer_list'>
									<li data-action="back"><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mobile_menu_back', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

if ( $item->link() && $item->link() !== '#' ):
$return .= <<<CONTENT

										<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $children ):
$return .= <<<CONTENT

										
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavigationChildren( $children );
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $subBars && isset( $subBars[ $id ] ) && count( $subBars[ $id ] ) ):
$return .= <<<CONTENT

										
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavigationChildren( $subBars[ $id ] );
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT
	
								</ul>
							</li>
						
CONTENT;

else:
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( method_exists( $item, 'target' ) AND $item->target() ):
$return .= <<<CONTENT
target='
CONTENT;
$return .= htmlspecialchars( $item->target(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function mobileNavigationChildren( $items ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

foreach ( $items as $child ):
$return .= <<<CONTENT

	
CONTENT;

if ( $child->canView() ):
$return .= <<<CONTENT

		
CONTENT;

if ( $children = $child->children() ):
$return .= <<<CONTENT

			
CONTENT;

$id = md5( uniqid() . mt_rand() );
$return .= <<<CONTENT

			<li class='ipsDrawer_itemParent'>
				<h4 class='ipsDrawer_title'><a href='#'>
CONTENT;
$return .= htmlspecialchars( $child->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h4>
				<ul class='ipsDrawer_list'>
					<li data-action="back"><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mobile_menu_back', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

if ( $child->link() && $child->link() !== '#' ):
$return .= <<<CONTENT

						<li>
							<a href='
CONTENT;
$return .= htmlspecialchars( $child->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
								
CONTENT;
$return .= htmlspecialchars( $child->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavigationChildren( $children );
$return .= <<<CONTENT

				</ul>
			</li>
		
CONTENT;

elseif ( $child instanceof \IPS\core\extensions\core\FrontNavigation\MenuHeader ):
$return .= <<<CONTENT

			<li class='ipsDrawer_section'>
				
CONTENT;
$return .= htmlspecialchars( $child->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</li>
		
CONTENT;

elseif ( $child instanceof \IPS\core\extensions\core\FrontNavigation\MenuSeparator ):
$return .= <<<CONTENT

			
		
CONTENT;

elseif ( $child instanceof \IPS\core\extensions\core\FrontNavigation\MenuButton ):
$return .= <<<CONTENT

			<li class='ipsPad_half'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $child->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_important ipsButton_verySmall ipsButton_fullWidth'>
					
CONTENT;
$return .= htmlspecialchars( $child->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

else:
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $child->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( method_exists( $child, 'target' ) AND $child->target() ):
$return .= <<<CONTENT
target='
CONTENT;
$return .= htmlspecialchars( $child->target(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;
$return .= htmlspecialchars( $child->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function modBadges( $member ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function navBar( $preview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

	<nav 
CONTENT;

if ( \IPS\Theme::i()->settings['appneeded'] ):
$return .= <<<CONTENT
 class='ipsLayout_container' data-controller='core.front.core.navBar'
CONTENT;

endif;
$return .= <<<CONTENT
>
		<div class='ipsNavBar_primary 
CONTENT;

if ( !count( \IPS\core\FrontNavigation::i()->subBars( $preview ) ) ):
$return .= <<<CONTENT
ipsNavBar_noSubBars
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix'>
			
CONTENT;

if ( !$preview and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'search' ) ) AND !in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

				<div id='elSearch' class='ipsPos_right' data-controller='core.front.core.quickSearch' itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" data-default="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->defaultSearchOption[0], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					<form accept-charset='utf-8' action='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search", null, "search", array(), 0 ) );
$return .= <<<CONTENT
' method='post'>
						<meta itemprop="target" content="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search&q=", null, "search", array(), 0 ) );
$return .= <<<CONTENT
{q}">
						<a href='#' id='elSearchFilter' data-ipsMenu data-ipsMenu-selectable='radio' data-ipsMenu-appendTo='#elSearch' class="ipsHide">
							<span data-role='searchingIn'>
								
CONTENT;

if ( count( \IPS\Output::i()->contextualSearchOptions ) ):
$return .= <<<CONTENT

									
CONTENT;

foreach ( \IPS\Output::i()->contextualSearchOptions as $name => $data ):
$return .= <<<CONTENT

										
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

$defaultSearchType = $data['type'];
$return .= <<<CONTENT

										
CONTENT;

if ( isset( $data['nodes'] ) AND $data['nodes'] ):
$return .= <<<CONTENT
<input name="nodes" value="
CONTENT;
$return .= htmlspecialchars( $data['nodes'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="searchFilter" type="hidden">
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

if ( isset( $data['item'] ) AND $data['item'] ):
$return .= <<<CONTENT
<input name="item" value="
CONTENT;
$return .= htmlspecialchars( $data['item'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="searchFilter" type="hidden">
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

break;
$return .= <<<CONTENT

									
CONTENT;

endforeach;
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$defaultSearchType = \IPS\Output::i()->defaultSearchOption[0];
$return .= <<<CONTENT

									
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->addToStack( \IPS\Output::i()->defaultSearchOption[1] ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							</span>
							<i class='fa fa-caret-down'></i>
						</a>
						<input type="hidden" name="type" value="
CONTENT;
$return .= htmlspecialchars( $defaultSearchType, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="searchFilter">
						<ul id='elSearchFilter_menu' class='ipsMenu ipsMenu_selectable ipsMenu_narrow ipsHide'>
							<li class='ipsMenu_item 
CONTENT;

if ( \IPS\Output::i()->defaultSearchOption[0] == 'all' AND !count(\IPS\Output::i()->contextualSearchOptions) ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='all'>
								<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_everything', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_everything', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
							<li class='ipsMenu_sep'><hr></li>
							
CONTENT;

if ( count( \IPS\Output::i()->contextualSearchOptions ) ):
$return .= <<<CONTENT

								
CONTENT;

$setDefault = FALSE;
$return .= <<<CONTENT

								
CONTENT;

foreach ( \IPS\Output::i()->contextualSearchOptions as $name => $data ):
$return .= <<<CONTENT

									<li class='ipsMenu_item 
CONTENT;

if ( $setDefault === FALSE ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

$setDefault = TRUE;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;

$return .= htmlspecialchars( json_encode( $data ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-options='
CONTENT;

$return .= htmlspecialchars( json_encode( $data ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
										<a href='#'>
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
									</li>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

								<li class='ipsMenu_sep'><hr></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							<li data-role='globalSearchMenuOptions'></li>
							<li class='ipsMenu_item ipsMenu_itemNonSelect'>
								<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search", null, "search", array(), 0 ) );
$return .= <<<CONTENT
' accesskey='4'><i class='fa fa-cog'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'advanced_search', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						</ul>
						<input type='search' id='elSearchField' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_placeholder', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' name='q' itemprop="query-input">
                      	<button type='submit'>
							<svg viewBox="0 0 32 32" class="icon nav-magnifier-icon">
								<path d="M12.98,0C5.81,0,0,5.81,0,12.98c0,7.17,5.81,12.98,12.98,12.98c7.17,0,12.98-5.81,12.98-12.98C25.97,5.81,20.15,0,12.98,0z M12.98,23.06c-5.56,0-10.07-4.51-10.07-10.07c0-5.56,4.51-10.07,10.07-10.07c5.56,0,10.07,4.51,10.07,10.07 C23.06,18.55,18.55,23.06,12.98,23.06z"></path>
								<path d="M18.08,18.49c0,1.27-2.22,2.3-4.96,2.3s-4.96-1.03-4.96-2.3c0-1.27,2.22-1.64,4.96-1.64S18.08,17.21,18.08,18.49z"></path>
								<path d="M31.25,31.25L31.25,31.25c-1,1-2.64,1-3.65,0l-7.87-7.87c-1-1,0-1.64,1-2.65l0,0c1-1,1.64-2,2.65-1l7.87,7.87 C32.25,28.6,32.25,30.25,31.25,31.25z"></path>
							</svg>
                      	</button>
					</form>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<ul data-role="primaryNavBar" class='menu flex 
CONTENT;

if ( !$preview ):
$return .= <<<CONTENT
ipsResponsive_showDesktop ipsResponsive_block
CONTENT;

endif;
$return .= <<<CONTENT
'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->navBarItems( \IPS\core\FrontNavigation::i()->roots( $preview ), \IPS\core\FrontNavigation::i()->subBars( $preview ), 0, $preview );
$return .= <<<CONTENT

              	
CONTENT;

if ( \IPS\Theme::i()->settings['appneeded'] ):
$return .= <<<CONTENT

					<li class='ipsHide' id='elNavigationMore' data-role='navMore'>
						<a href='#' data-ipsMenu data-ipsMenu-appendTo='#elNavigationMore' id='elNavigationMore_dropdown'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						<ul class='ipsNavBar_secondary ipsHide' data-role='secondaryNavBar'>
							<li class='ipsHide' id='elNavigationMore_more' data-role='navMore'>
								<a href='#' data-ipsMenu data-ipsMenu-appendTo='#elNavigationMore_more' id='elNavigationMore_more_dropdown'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
								<ul class='ipsHide ipsMenu ipsMenu_auto' id='elNavigationMore_more_dropdown_menu' data-role='moreDropdown'></ul>
							</li>
						</ul>
					</li>
              	
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>
	</nav>

CONTENT;

elseif ( \IPS\Member::loggedIn()->group['g_view_board'] ):
$return .= <<<CONTENT

	<nav 
CONTENT;

if ( \IPS\Theme::i()->settings['appneeded'] ):
$return .= <<<CONTENT
class='ipsLayout_container'
CONTENT;

endif;
$return .= <<<CONTENT
>
		<div class='ipsNavBar_primary ipsNavBar_noSubBars ipsClearfix'>
			<a id='elBackHome' href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_community_home', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-left'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'community_home', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</div>
	</nav>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function navBarChildren( $items, $preview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $items as $item ):
$return .= <<<CONTENT

	
CONTENT;

if ( $preview or $item->canView() ):
$return .= <<<CONTENT

		
CONTENT;

if ( $children = $item->children() ):
$return .= <<<CONTENT

			
CONTENT;

$id = md5( uniqid() . mt_rand() );
$return .= <<<CONTENT

			<li id='elNavigation_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsMenu_item ipsMenu_subItems'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
				<ul id='elNavigation_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_auto ipsHide'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->navBarChildren( $children, $preview );
$return .= <<<CONTENT

				</ul>
			</li>
		
CONTENT;

elseif ( $item instanceof \IPS\core\extensions\core\FrontNavigation\MenuHeader ):
$return .= <<<CONTENT

			<li class='ipsMenu_title'>
				
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</li>
		
CONTENT;

elseif ( $item instanceof \IPS\core\extensions\core\FrontNavigation\MenuSeparator ):
$return .= <<<CONTENT

			<li class='ipsMenu_sep'>
				<hr>
			</li>
		
CONTENT;

elseif ( $item instanceof \IPS\core\extensions\core\FrontNavigation\MenuButton ):
$return .= <<<CONTENT

			<li class='ipsPad_half'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_verySmall ipsButton_fullWidth'>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

else:
$return .= <<<CONTENT

			<li class='ipsMenu_item' {$item->attributes()}>
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( method_exists( $item, 'target' ) AND $item->target() ):
$return .= <<<CONTENT
target='
CONTENT;
$return .= htmlspecialchars( $item->target(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function navBarItems( $roots, $subBars=NULL, $parent=0, $preview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $roots as $id => $item ):
$return .= <<<CONTENT

	
CONTENT;

if ( $preview or $item->canView() ):
$return .= <<<CONTENT

		
CONTENT;

$active = $item->activeOrChildActive();
$return .= <<<CONTENT

		
CONTENT;

if ( $active ):
$return .= <<<CONTENT

			
CONTENT;

\IPS\core\FrontNavigation::i()->activePrimaryNavBar = $item->id;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		<li 
CONTENT;

if ( $active ):
$return .= <<<CONTENT
class='ipsNavBar_active' data-active
CONTENT;

endif;
$return .= <<<CONTENT
 id='elNavSecondary_
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="navBarItem" data-navApp="
CONTENT;

$return .= htmlspecialchars( mb_substr( get_class( $item ), 4, mb_strpos( get_class( $item ), '\\', 4 ) - 4 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-navExt="
CONTENT;

$return .= htmlspecialchars( mb_substr( get_class( $item ), mb_strrpos( get_class( $item ), '\\' ) + 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" nav_title='
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			
CONTENT;

$children = $item->children();
$return .= <<<CONTENT

			
CONTENT;

if ( $children ):
$return .= <<<CONTENT

				<a href="
CONTENT;

if ( $item->link() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
#
CONTENT;

endif;
$return .= <<<CONTENT
" id="elNavigation_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-appendTo='#
CONTENT;

if ( $parent ):
$return .= <<<CONTENT
elNavSecondary_
CONTENT;
$return .= htmlspecialchars( $parent, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
elNavSecondary_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenu-activeClass='ipsNavActive_menu' data-navItem-id="
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $active ):
$return .= <<<CONTENT
data-navDefault
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i>
				</a>
				<ul id="elNavigation_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" class="ipsMenu ipsMenu_auto ipsHide">
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->navBarChildren( $children, $preview );
$return .= <<<CONTENT

				</ul>
			
CONTENT;

else:
$return .= <<<CONTENT

				<a href="
CONTENT;

if ( $item->link() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
#
CONTENT;

endif;
$return .= <<<CONTENT
" 
CONTENT;

if ( method_exists( $item, 'target' ) AND $item->target() ):
$return .= <<<CONTENT
target='
CONTENT;
$return .= htmlspecialchars( $item->target(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 data-navItem-id="
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $active ):
$return .= <<<CONTENT
data-navDefault
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $subBars && isset( $subBars[ $id ] ) && count( $subBars[ $id ] ) ):
$return .= <<<CONTENT

				<ul class='ipsNavBar_secondary 
CONTENT;

if ( !$active ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='secondaryNavBar'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->navBarItems( $subBars[ $id ], NULL, $item->id, $preview );
$return .= <<<CONTENT

					<li class='ipsHide' id='elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='navMore'>
						<a href='#' data-ipsMenu data-ipsMenu-appendTo='#elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_dropdown'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
						<ul class='ipsHide ipsMenu ipsMenu_auto' id='elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_dropdown_menu' data-role='moreDropdown'></ul>
					</li>
				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function offlineMessage(  ) {
		$return = '';
		$return .= <<<CONTENT


<div id='elSiteOffline'>
	<h2 class='ipsType_reset'><i class='fa fa-warning'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'offline_message_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'offline_message_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
</div>
CONTENT;

		return $return;
}

	function pageHeader( $title, $blurb='', $rawBlurb=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom'>
	<h1 class='ipsType_pageTitle'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>
	
CONTENT;

if ( $blurb ):
$return .= <<<CONTENT

		<div class='ipsPageHeader_info ipsType_light'>
			
CONTENT;

if ( !$rawBlurb ):
$return .= <<<CONTENT

				
CONTENT;
$return .= htmlspecialchars( $blurb, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				{$blurb}
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function prefix( $encoded, $text ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $text ):
$return .= <<<CONTENT

	<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search&tags={$encoded}", null, "tags", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($text); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_tagged_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class='ipsTag_prefix'><span>
CONTENT;
$return .= htmlspecialchars( $text, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function queryLog( $log ) {
		$return = '';
		$return .= <<<CONTENT

<div id="elQueryLog">
	<h3 class='ipsType_center'>
CONTENT;

$return .= htmlspecialchars( count( $log ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
	
CONTENT;

foreach ( $log as $i => $query ):
$return .= <<<CONTENT

		<div>
			<pre class="prettyprint lang-sql" data-ipsDialog data-ipsDialog-content="#elQueryLog
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
CONTENT;
$return .= htmlspecialchars( $query['query'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
			
CONTENT;

if ( $query['extra'] ):
$return .= <<<CONTENT

				<div class="ipsType_center">
					<strong class="ipsType_warning"><i class="fa fa-exclamation-circle"></i> 
CONTENT;
$return .= htmlspecialchars( $query['extra'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
				</div>
				<br>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div id='elQueryLog
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsPad ipsHide'>
				<br>
				<pre>
CONTENT;
$return .= htmlspecialchars( $query['query'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
				<hr class="ipsHr">
				<pre class="prettyprint lang-php">
CONTENT;
$return .= htmlspecialchars( $query['backtrace'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
				<br>
			</div>
		</div>
		<hr class="ipsHr">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function rating( $size, $value, $max=5, $memberRating=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div 
CONTENT;

if ( $memberRating ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$sprintf = array($memberRating, $max, $value); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'you_rated_x_stars', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 class='ipsClearfix ipsRating 
CONTENT;

if ( $memberRating ):
$return .= <<<CONTENT
ipsRating_rated
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $size ):
$return .= <<<CONTENT
ipsRating_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $memberRating ):
$return .= <<<CONTENT

		<ul class='ipsRating_mine'>
			
CONTENT;

foreach ( range( 1, $max ) as $i ):
$return .= <<<CONTENT

				
CONTENT;

if ( $i <= $memberRating ):
$return .= <<<CONTENT

					<li class='ipsRating_on'>
						<i class='fa fa-star'></i>
					</li>
				
CONTENT;

else:
$return .= <<<CONTENT

					<li class='ipsRating_off'>
						<i class='fa fa-star'></i>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<ul class='ipsRating_collective'>
		
CONTENT;

foreach ( range( 1, $max ) as $i ):
$return .= <<<CONTENT

			
CONTENT;

if ( $i <= $value ):
$return .= <<<CONTENT

				<li class='ipsRating_on'>
					<i class='fa fa-star'></i>
				</li>
			
CONTENT;

elseif ( ( $i - 0.5 ) <= $value ):
$return .= <<<CONTENT

				<li class='ipsRating_half'>
					<i class='fa fa-star-half'></i><i class='fa fa-star-half fa-flip-horizontal'></i>
				</li>
			
CONTENT;

else:
$return .= <<<CONTENT

				<li class='ipsRating_off'>
					<i class='fa fa-star'></i>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
CONTENT;

		return $return;
}

	function reputation( $content, $extraClass='', $forceType=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $content instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

	<div data-controller='core.front.core.reputation' class='ipsClearfix 
CONTENT;

if ( $extraClass ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $extraClass, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
		
CONTENT;

if ( \IPS\Settings::i()->reputation_point_types == 'like' ):
$return .= <<<CONTENT

			
CONTENT;

if ( $content->canGiveReputation( 1 ) || $content->canGiveReputation( -1 ) || $content->likeBlurb() ):
$return .= <<<CONTENT

				<div class='ipsLikeRep ipsPos_right ipsResponsive_noFloat'>
					
CONTENT;

if ( $content->likeBlurb() ):
$return .= <<<CONTENT

						<span class='ipsLike_contents'>{$content->likeBlurb()}</span>
					
CONTENT;

endif;
$return .= <<<CONTENT


					
CONTENT;

if ( $content->canGiveReputation( 1 ) ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'rep' )->setQueryString( 'rep', 1 )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="giveReputation" class='ipsButton ipsButton_like ipsButton_alternate'><i class='fa fa-heart'></i> <span class='ipsHide' data-role='repCount'>
CONTENT;
$return .= htmlspecialchars( $content->reputation(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'like', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $content->canGiveReputation( -1 ) ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'rep' )->setQueryString( 'rep', -1 )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="giveReputation" class='ipsButton ipsButton_like ipsButton_veryLight'><i class='fa fa-times'></i> <span class='ipsHide' data-role='repCount'>
CONTENT;
$return .= htmlspecialchars( $content->reputation(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlike', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsLikeRep ipsPos_right'>
				
CONTENT;

if ( $content->canGiveReputation( 1 ) ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'rep' )->setQueryString( 'rep', 1 )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="giveReputation" class='ipsButton ipsButton_rep ipsButton_repUp'><i class='fa fa-arrow-up'></i></a>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $content->canGiveReputation( -1 ) ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'rep' )->setQueryString( 'rep', -1 )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="giveReputation" class='ipsButton ipsButton_rep ipsButton_repDown'><i class='fa fa-arrow-down'></i></a>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
				
CONTENT;

if ( \IPS\Settings::i()->reputation_show_content ):
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'showRep' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rep_log_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_repped', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip class='ipsReputation_count ipsType_blendLinks 
CONTENT;

if ( $content->reputation() < 0 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

elseif ( $content->reputation() > 0 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

else:
$return .= <<<CONTENT
ipsType_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa fa-heart ipsType_small'></i> 
CONTENT;
$return .= htmlspecialchars( $content->reputation(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<span class='ipsReputation_count ipsType_blendLinks 
CONTENT;

if ( $content->reputation() < 0 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

elseif ( $content->reputation() > 0 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

else:
$return .= <<<CONTENT
ipsType_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa fa-heart ipsType_small'></i> 
CONTENT;
$return .= htmlspecialchars( $content->reputation(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function reputationBadge( $author ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->reputation_enabled and \IPS\Settings::i()->reputation_show_profile and $author->member_id ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$author->member_id}&do=reputation", null, "profile_reputation", array( $author->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $author->pp_reputation_points > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $author->pp_reputation_points < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

else:
$return .= <<<CONTENT

		<span title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $author->pp_reputation_points > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $author->pp_reputation_points < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

endif;
$return .= <<<CONTENT

			<i class='fa 
CONTENT;

if ( $author->pp_reputation_points > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $author->pp_reputation_points < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( abs( $author->pp_reputation_points ) );
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

		</a>
	
CONTENT;

else:
$return .= <<<CONTENT

		</span>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reputationLog( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class='ipsGrid_span6 ipsPhotoPanel ipsPhotoPanel_mini ipsClearfix'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $row['member_id'] ), 'mini' );
$return .= <<<CONTENT

		<div>
			<h3 class='ipsType_normal ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $row['member_id'] )->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
			<span class='ipsType_light'>
				
CONTENT;

if ( $row['rep_rating'] === '1' && \IPS\Settings::i()->reputation_point_types != 'like' ):
$return .= <<<CONTENT
<i class='ipsType_large ipsType_positive fa fa-arrow-circle-up'></i>
CONTENT;

elseif ( \IPS\Settings::i()->reputation_point_types != 'like' ):
$return .= <<<CONTENT
<i class='ipsType_large ipsType_negative fa fa-arrow-circle-down'></i>
CONTENT;

endif;
$return .= <<<CONTENT
 <span class='ipsType_medium'>
CONTENT;

$val = ( $row['rep_date'] instanceof \IPS\DateTime ) ? $row['rep_date'] : \IPS\DateTime::ts( $row['rep_date'] );$return .= $val->html();
$return .= <<<CONTENT
</span>
			</span>
		</div>
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reputationLogTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div data-baseurl='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-resort='
CONTENT;
$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.global.core.table' 
CONTENT;

if ( $table->getPaginationKey() != 'page' ):
$return .= <<<CONTENT
data-pageParam='
CONTENT;
$return .= htmlspecialchars( $table->getPaginationKey(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>

	
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT



	
CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

		<ol class='ipsGrid ipsGrid_collapsePhone ipsPad ipsClear 
CONTENT;

foreach ( $table->classes as $class ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

endforeach;
$return .= <<<CONTENT
' id='elTable_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="tableRows" itemscope itemtype="http://schema.org/ItemList">
			
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

		</ol>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsType_center ipsPad'>
			<p class='ipsType_large ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_rows_in_table', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

if ( method_exists( $table, 'container' ) AND $table->container() !== NULL ):
$return .= <<<CONTENT

				
CONTENT;

if ( $table->container()->can('add') ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $table->container()->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_medium'>
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_first_row', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

				
	
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function reputationMini( $repCount, $canRepUp, $canRepDown, $showRepUrl, $giveRepUrl ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller='core.front.core.reputation' class='ipsRep_mini'>
	
CONTENT;

if ( \IPS\Settings::i()->reputation_point_types == 'like' ):
$return .= <<<CONTENT

		<div class='ipsLikeRep'>
			
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

				<a href='
CONTENT;
$return .= htmlspecialchars( $showRepUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'like_log_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip class='ipsReputation_count 
CONTENT;

if ( $repCount == 0 ):
$return .= <<<CONTENT
ipsType_light
CONTENT;

else:
$return .= <<<CONTENT
ipsType_blendLinks
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa fa-heart ipsType_small'></i> 
CONTENT;
$return .= htmlspecialchars( $repCount, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
			
CONTENT;

else:
$return .= <<<CONTENT

				<span class='ipsReputation_count 
CONTENT;

if ( $repCount < 0 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

elseif ( $repCount > 0 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

else:
$return .= <<<CONTENT
ipsType_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $repCount < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

elseif ( $repCount > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_small'></i> 
CONTENT;
$return .= htmlspecialchars( $repCount, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $canRepUp ):
$return .= <<<CONTENT

				&nbsp;&nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $giveRepUrl->setQueryString( array( 'rep' => 1, 'mini' => 1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="giveReputation">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'like', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $canRepDown ):
$return .= <<<CONTENT

				&nbsp;&nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $giveRepUrl->setQueryString( array( 'rep' => -1, 'mini' => 1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="giveReputation">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlike', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsLikeRep'>
			
CONTENT;

if ( $canRepUp ):
$return .= <<<CONTENT

				<a href='
CONTENT;
$return .= htmlspecialchars( $giveRepUrl->setQueryString( array( 'rep' => 1, 'mini' => 1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="giveReputation" class='ipsButton ipsButton_rep ipsButton_repUp'><i class='fa fa-arrow-up'></i></a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $canRepDown ):
$return .= <<<CONTENT

				<a href='
CONTENT;
$return .= htmlspecialchars( $giveRepUrl->setQueryString( array( 'rep' => -1, 'mini' => 1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="giveReputation" class='ipsButton ipsButton_rep ipsButton_repDown'><i class='fa fa-arrow-down'></i></a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
			
CONTENT;

if ( \IPS\Settings::i()->reputation_show_content ):
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $showRepUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rep_log_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_repped', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip class='ipsReputation_count 
CONTENT;

if ( $repCount < 0 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

elseif ( $repCount > 0 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

else:
$return .= <<<CONTENT
ipsType_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $repCount < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

elseif ( $repCount > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_small'></i> 
CONTENT;
$return .= htmlspecialchars( $repCount, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				
CONTENT;

else:
$return .= <<<CONTENT

					<span class='ipsReputation_count 
CONTENT;

if ( $repCount < 0 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

elseif ( $repCount > 0 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

else:
$return .= <<<CONTENT
ipsType_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $repCount < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

elseif ( $repCount > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_small'></i> 
CONTENT;
$return .= htmlspecialchars( $repCount, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function reputationOthers( $contentURL, $lang, $names ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->reputation_point_types == 'like' ):
$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $contentURL, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-destructOnClose data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'like_log_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_liked', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsTooltip-label='
CONTENT;
$return .= htmlspecialchars( $names, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsTooltip-json data-ipsTooltip-safe>
CONTENT;
$return .= htmlspecialchars( $lang, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>

CONTENT;

else:
$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $contentURL, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-destructOnClose data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rep_log_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_repped', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
CONTENT;
$return .= htmlspecialchars( $lang, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function review( $item, $review, $editorName, $app, $type ) {
		$return = '';
		$return .= <<<CONTENT

<div id='review-
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap' data-controller='core.front.core.comment' data-commentApp='
CONTENT;
$return .= htmlspecialchars( $app, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentType='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
-review' data-commentID="
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-quoteData='
CONTENT;

$return .= htmlspecialchars( json_encode( array('userid' => $review->author()->member_id, 'username' => $review->author()->name, 'timestamp' => $review->mapped('date'), 'contentapp' => $app, 'contenttype' => $type, 'contentid' => $item->id, 'contentcommentid' => $review->id) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment_content ipsType_medium' itemprop='review' itemscope itemtype="http://schema.org/Review">
	<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_small ipsPhotoPanel_notPhone'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $review->author(), 'small', $review->warningRef(), 'ipsPos_left' );
$return .= <<<CONTENT

		<div>
			<p class='ipsPos_right ipsType_reset ipsType_blendLinks'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $review->item()->url()->setQueryString( array( 'do' => 'findReview', 'review' => $review->id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false' id='elShareComment_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='shareComment'><i class='fa fa-share-alt'></i></a>
				
CONTENT;

if ( count( $item->reviewMultimodActions() ) ):
$return .= <<<CONTENT

					<span class='ipsCustomInput'>
						<input type="checkbox" name="multimod[
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1" data-role="moderation" data-actions="
CONTENT;

if ( $review->hidden() === -1 AND $review->canUnhide() ):
$return .= <<<CONTENT
unhide
CONTENT;

elseif ( $review->hidden() === 1 AND $review->canUnhide() ):
$return .= <<<CONTENT
approve
CONTENT;

elseif ( $review->canHide() ):
$return .= <<<CONTENT
hide
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $review->canDelete() ):
$return .= <<<CONTENT
delete
CONTENT;

endif;
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $review->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $review->tableStates(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
						<span></span>
					</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
			<h3 class="ipsComment_author ipsType_blendLinks">
				<strong class='ipsType_normal' itemprop='author'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $review->author(), $review->warningRef() );
$return .= <<<CONTENT
</strong>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationBadge( $review->author() );
$return .= <<<CONTENT

			</h3>
			<p class="ipsComment_meta ipsType_medium ipsType_light">
				
CONTENT;

if ( $review->mapped('date') ):
$return .= <<<CONTENT

					<meta itemprop='datePublished' content='
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::ts( $review->mapped('date') )->format( 'Y-m-d' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = ( $review->mapped('date') instanceof \IPS\DateTime ) ? $review->mapped('date') : \IPS\DateTime::ts( $review->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unknown_date', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT


				
CONTENT;

if ( $review->editLine() ):
$return .= <<<CONTENT

					&middot; {$review->editLine()}
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $review->hidden() ):
$return .= <<<CONTENT

					&middot; 
CONTENT;
$return .= htmlspecialchars( $review->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $review->hidden() !== 1 and $review instanceof \IPS\Content\ReportCenter and !\IPS\Member::loggedIn()->group['gbw_no_report']  ):
$return .= <<<CONTENT

					&middot; <a href='
CONTENT;
$return .= htmlspecialchars( $review->url('report'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-remoteSubmit data-ipsDialog-size='medium' data-ipsDialog-flashMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_submit_success', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-action='reportComment' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
			<ul class='ipsList_inline ipsClearfix ipsRating ipsRating_large' itemprop='reviewRating' itemscope itemtype='http://schema.org/Rating'>
				<meta itemprop='worstRating' content='1'>
				<meta itemprop='bestRating' content='
CONTENT;

$return .= htmlspecialchars( intval( \IPS\Settings::i()->reviews_rating_out_of ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				
CONTENT;

foreach ( range( 1, intval( \IPS\Settings::i()->reviews_rating_out_of ) ) as $i ):
$return .= <<<CONTENT

					<li class='
CONTENT;

if ( $review->mapped('rating') >= $i ):
$return .= <<<CONTENT
ipsRating_on
CONTENT;

else:
$return .= <<<CONTENT
ipsRating_off
CONTENT;

endif;
$return .= <<<CONTENT
'>
						
CONTENT;

if ( $review->mapped('rating') === $i ):
$return .= <<<CONTENT
<span itemprop='ratingValue' class='ipsHide'>
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

						<i class='fa fa-star'></i>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>&nbsp;&nbsp; 
CONTENT;

if ( $review->mapped('votes_total') ):
$return .= <<<CONTENT
<strong class='ipsType_medium'>{$review->helpfulLine()}</strong><br>
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
	<div class='ipsPad'>
		<div id="review-
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="commentContent" class="ipsType_richText ipsType_normal ipsType_break ipsContained" itemprop="reviewBody" data-controller='core.front.core.lightboxedImages'>
			{$review->content()}
		</div>

		
CONTENT;

if ( $review->hidden() !== 1 ):
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Member::loggedIn()->member_id and ( !$review->mapped('votes_data') or !array_key_exists( \IPS\Member::loggedIn()->member_id, json_decode( $review->mapped('votes_data'), TRUE ) ) ) and $review->author()->member_id != \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				<span class='ipsType_medium'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'did_you_find_this_helpful', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong> &nbsp;&nbsp;&nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $review->url('rate')->setQueryString( 'helpful', TRUE )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light' data-action="rateReview"><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'yes', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a> <a href='
CONTENT;
$return .= htmlspecialchars( $review->url('rate')->setQueryString( 'helpful', FALSE )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light' data-action="rateReview"><i class='fa fa-times'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></span>
				<br class='ipsClear'>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
			
CONTENT;

if ( $review instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $review, 'ipsPos_right ipsResponsive_noFloat' );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

if ( ( \IPS\Member::loggedIn()->member_id and ( !$review->mapped('votes_data') or !array_key_exists( \IPS\Member::loggedIn()->member_id, json_decode( $review->mapped('votes_data'), TRUE ) ) ) ) || $review->canEdit() || $review->canDelete() || $review->canHide() || $review->canUnhide() ):
$return .= <<<CONTENT

			
CONTENT;

if ( $review->canEdit() || $review->canDelete() || $review->canHide() || $review->canUnhide() ):
$return .= <<<CONTENT

				<ul class='ipsComment_controls ipsClearfix' data-role="commentControls">
					
CONTENT;

if ( $review->hidden() === 1 && ( $review->canUnhide() || $review->canDelete() ) ):
$return .= <<<CONTENT

						
CONTENT;

if ( $review->canUnhide() ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('unhide')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_positive' data-action='approveComment'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $review->canDelete() ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('delete')->csrf()->setQueryString('page',\IPS\Request::i()->page), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-action='deleteComment' data-updateOnDelete="#commentCount" class='ipsButton ipsButton_verySmall ipsButton_negative'><i class='fa fa-times'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $review->canEdit() || $review->canSplit() ):
$return .= <<<CONTENT

							<li>
								<a href='#elControls_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elControls_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo='#review-
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i></a>
								<ul id='elControls_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_narrow ipsHide'>
									
CONTENT;

if ( $review->canEdit() ):
$return .= <<<CONTENT

										
CONTENT;

if ( $review->mapped('first') and $review->item()->canEdit() ):
$return .= <<<CONTENT

											<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->item()->url()->setQueryString( 'do', 'edit' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
										
CONTENT;

else:
$return .= <<<CONTENT

											<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('edit'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
										
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $review->canSplit() ):
$return .= <<<CONTENT

										<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('split'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='splitComment' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $item::$title )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split_to_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</ul>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

if ( $review->canEdit() ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('edit'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT
	
						
CONTENT;

if ( $review->canDelete() || $review->canHide() || $review->canUnhide() ):
$return .= <<<CONTENT

							<li>
								<a href='#elControls_review
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elControls_review
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo='#review-
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i></a>
								<ul id='elControls_review
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_narrow ipsHide'>
									
CONTENT;

if ( $review instanceof \IPS\Content\Hideable ):
$return .= <<<CONTENT

										
CONTENT;

if ( !$review->hidden() and $review->canHide() ):
$return .= <<<CONTENT

											<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('hide')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
										
CONTENT;

elseif ( $review->hidden() and $review->canUnhide() ):
$return .= <<<CONTENT

											<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('unhide')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
										
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $review->canDelete() ):
$return .= <<<CONTENT

										<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('delete')->csrf()->setQueryString('page',\IPS\Request::i()->page), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-action='deleteComment' data-updateOnDelete="#reviewCount">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</ul>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsHide' data-role='commentLoading'>
						<span class='ipsLoading ipsLoading_tiny ipsLoading_noAnim'></span>
					</li>
				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
	<div class='ipsMenu ipsMenu_wide ipsHide cPostShareMenu' id='elShareComment_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
		<div class='ipsPad'>
			<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
			<hr class='ipsHr'>
			<h5 class='ipsType_normal ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'link_to_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>
			<input type='text' value='
CONTENT;
$return .= htmlspecialchars( $review->item()->url()->setQueryString( array( 'do' => 'findReview', 'review' => $review->id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsField_fullWidth'>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function reviewContainer( $item, $review ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $review::$databaseColumnId;
$return .= <<<CONTENT


CONTENT;

if ( $review->isIgnored() ):
$return .= <<<CONTENT

	<div class='ipsComment ipsComment_ignored ipsPad_half ipsType_light'>
		
CONTENT;

$sprintf = array($review->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignoring_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<a id='review-
CONTENT;
$return .= htmlspecialchars( $review->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></a>
	<article itemscope="" itemtype="http://schema.org/Comment" id="elReview_
CONTENT;
$return .= htmlspecialchars( $review->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsComment ipsComment_parent ipsClearfix ipsClear 
CONTENT;

if ( $review->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
">
		
CONTENT;

if ( !$item->printedAverageReviewRating ):
$return .= <<<CONTENT

			<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
				<meta itemprop="ratingValue" content="
CONTENT;
$return .= htmlspecialchars( $item->averageReviewRating(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				<meta itemprop="reviewCount" content="
CONTENT;
$return .= htmlspecialchars( $item->reviewCount(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			</div>
			
CONTENT;

$item->printedAverageReviewRating = true;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->review( $item, $review, $item::$formLangPrefix . 'review', $item::$application, $item::$module );
$return .= <<<CONTENT

	</article>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reviewHelpful( $helpful, $total ) {
		$return = '';
		$return .= <<<CONTENT


<span class='ipsResponsive_hidePhone ipsResponsive_inline'>
	
CONTENT;

$sprintf = array($helpful, \IPS\Member::loggedIn()->language()->pluralize( \IPS\Member::loggedIn()->language()->get( 'x_members' ), array( $total ) )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_members_found_helpful', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

</span>
<span class='ipsResponsive_showPhone ipsResponsive_inline'>
	<i class='fa fa-smile-o'></i> 
CONTENT;
$return .= htmlspecialchars( $helpful, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 / 
CONTENT;

$pluralize = array( $total ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_members_found_helpful_phone', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

</span>
CONTENT;

		return $return;
}

	function rssMenu(  ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( count( \IPS\Output::i()->rssFeeds ) ):
$return .= <<<CONTENT

	<a href='#' id='elRSS' class='ipsPos_right ipsType_large' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'available_rss', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsMenu><i class='fa fa-rss-square'></i></a>
	<ul id='elRSS_menu' class='ipsMenu ipsMenu_auto ipsHide'>
		
CONTENT;

foreach ( \IPS\Output::i()->rssFeeds as $title => $url ):
$return .= <<<CONTENT

			<li class='ipsMenu_item'><a title="
CONTENT;

$val = "{$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$val = "{$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function searchBar(  ) {
		$return = '';
		$return .= <<<CONTENT

			
CONTENT;

if ( !$preview and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'search' ) ) AND !in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

				<div id='elSearch' class='ipsPos_right' data-controller='core.front.core.quickSearch' itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" data-default="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->defaultSearchOption[0], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					<form accept-charset='utf-8' action='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search", null, "search", array(), 0 ) );
$return .= <<<CONTENT
' method='
CONTENT;

if ( \IPS\Settings::i()->use_friendly_urls and \IPS\Settings::i()->htaccess_mod_rewrite ):
$return .= <<<CONTENT
get
CONTENT;

else:
$return .= <<<CONTENT
post
CONTENT;

endif;
$return .= <<<CONTENT
'>
						<meta itemprop="target" content="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search&q=", null, "search", array(), 0 ) );
$return .= <<<CONTENT
{q}">
						<input type="hidden" name="type" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->defaultSearchOption[0], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="searchFilter">
						
						<ul id='elSearchFilter_menu' class='ipsMenu ipsMenu_selectable ipsMenu_narrow ipsHide'>
							<li class='ipsMenu_item 
CONTENT;

if ( \IPS\Output::i()->defaultSearchOption[0] == 'all' ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='all'>
								<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_everything', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_everything', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
							<li class='ipsMenu_sep'><hr></li>
							
CONTENT;

if ( count( \IPS\Output::i()->contextualSearchOptions ) ):
$return .= <<<CONTENT

								
CONTENT;

foreach ( \IPS\Output::i()->contextualSearchOptions as $name => $data ):
$return .= <<<CONTENT

									<li class='ipsMenu_item' data-ipsMenuValue='
CONTENT;

$return .= htmlspecialchars( json_encode( $data ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-options='
CONTENT;

$return .= htmlspecialchars( json_encode( $data ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
										<a href='#'>
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
									</li>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

								<li class='ipsMenu_sep'><hr></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							<li data-role='globalSearchMenuOptions'></li>
							<li class='ipsMenu_item ipsMenu_itemNonSelect'>
								<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search", null, "search", array(), 0 ) );
$return .= <<<CONTENT
' accesskey='4'><i class='fa fa-cog'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'advanced_search', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						</ul>
						<input type='search' id='elSearchField' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_placeholder', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' name='q' itemprop="query-input">
						<button type='submit'>
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="23" height="23" viewBox="0 0 23 23">
  <defs>
    <style>
      .cls-1 {
        fill: #fff;
        fill-rule: evenodd;
        filter: url(#filter);
      }
    </style>
    <filter id="filter" x="1180" y="24" width="23" height="23" filterUnits="userSpaceOnUse">
      <feOffset result="offset" in="SourceAlpha"/>
      <feGaussianBlur result="blur" stdDeviation="1.414"/>
      <feFlood result="flood" flood-color="#29bdc6"/>
      <feComposite result="composite" operator="in" in2="blur"/>
      <feBlend result="blend" in="SourceGraphic"/>
    </filter>
  </defs>
  <path id="icon-search" class="cls-1" d="M1200.59,42.639l-4.23-4.227a8.468,8.468,0,1,0-1.95,1.955l4.23,4.226A1.38,1.38,0,0,0,1200.59,42.639Zm-15.15-5.119a5.715,5.715,0,1,1,4.04,1.673A5.684,5.684,0,0,1,1185.44,37.52Z" transform="translate(-1180 -24)"/>
</svg>

                      </button>
					</form>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function secondaryFooter(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['customFooter'] ):
$return .= <<<CONTENT

<div id="secondaryFooter">
	<div class="ipsGrid">
			
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_section1'] ):
$return .= <<<CONTENT

			<div class="ipsGrid_span4">
				<h2>
CONTENT;


$return .= <<<CONTENT
</h2>
				
<p>
	
CONTENT;


$return .= <<<CONTENT

</p>
				
		</div>
		
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_section2'] ):
$return .= <<<CONTENT

			<div class="ipsGrid_span3">
				<h2>
CONTENT;


$return .= <<<CONTENT
</h2>
				

CONTENT;


$return .= <<<CONTENT

			
			</div>
			
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_section3'] ):
$return .= <<<CONTENT

			<div class="ipsGrid_span3">
			<h2>
CONTENT;


$return .= <<<CONTENT
</h2>
				
			
CONTENT;


$return .= <<<CONTENT

			
			</div>
			
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_section4'] ):
$return .= <<<CONTENT

			<div class="ipsGrid_span2">
				<h2>
CONTENT;


$return .= <<<CONTENT
</h2>
				
<p>
	
CONTENT;


$return .= <<<CONTENT

</p>
<div class="secondaryFooterLinks">
					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_facebook'] ):
$return .= <<<CONTENT

					<a class="secondaryFacebookButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_googlePlus'] ):
$return .= <<<CONTENT

					<a class="secondaryGooglePlusButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_vk'] ):
$return .= <<<CONTENT

					<a class="secondaryVkButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_pinterest'] ):
$return .= <<<CONTENT

					<a class="secondaryPinterestButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_vimeo'] ):
$return .= <<<CONTENT

					<a class="secondaryVimeoButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_twitter'] ):
$return .= <<<CONTENT

					<a class="secondaryTwitterButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_youtube'] ):
$return .= <<<CONTENT

					<a class="secondaryYoutubeButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_linkedln'] ):
$return .= <<<CONTENT

					<a class="secondaryLinkenldButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_instagram'] ):
$return .= <<<CONTENT

					<a class="secondaryInstagramButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_flikr'] ):
$return .= <<<CONTENT

					<a class="secondaryFlikrButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_steam'] ):
$return .= <<<CONTENT

					<a class="secondarySteamButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_rss'] ):
$return .= <<<CONTENT

					<a class="secondaryRssButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
					
</div>

				
			</div>
			
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
</div>

CONTENT;

else:
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function secondarySlider( $title,$html,$location=array() ) {
		$return = '';
		$return .= <<<CONTENT

<div id="owl-main">
    <div id="owl-banner-main" class="owl-carousel owl-theme owl-loaded">





 <div class="owl-stage-outer">
            <div style="transform: translate3d(-3806px, 0px, 0px); transition: all 0s ease 0s; width: 17127px;" class="owl-stage">
                <div style="width: 1903px; margin-right: 0px;" class="owl-item cloned">
                    <div class="item">
                        <a href="http://www.model-changing.net/blogs/blog/53-hc-rp-czsk-arathor-rp-mythia/" target="blank"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "head.pnf", "core", 'global', false );
$return .= <<<CONTENT
" alt="Arathor RP Mythia">
                        </a>
                    </div>
                </div>
                <div style="width: 1903px; margin-right: 0px;" class="owl-item cloned">
                    <div class="item">
                        <a href="http://www.model-changing.net/blogs/blog/49-dead-rp-the-sunset-of-lordaeron/" target="blank"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "head.pnf", "core", 'global', false );
$return .= <<<CONTENT
" alt="Sunset of Lordaeron">
                        </a>
                    </div>
                </div>
                <div style="width: 1903px; margin-right: 0px;" class="owl-item active">
                    <div class="item"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "head.pnf", "core", 'global', false );
$return .= <<<CONTENT
" alt="1">
                    </div>
                </div>
                <div style="width: 1903px; margin-right: 0px;" class="owl-item">
                    <div class="item"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "head.pnf", "core", 'global', false );
$return .= <<<CONTENT
" alt="2">
                    </div>
                </div>
                <div style="width: 1903px; margin-right: 0px;" class="owl-item">
                    <div class="item">
                        <a href="http://www.model-changing.net/blogs/blog/34-rp-fr-shadow-storm/" target="blank"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "head.pnf", "core", 'global', false );
$return .= <<<CONTENT
" alt="Shadow Storm FR">
                        </a>
                    </div>
                </div>
                <div style="width: 1903px; margin-right: 0px;" class="owl-item">
                    <div class="item">
                        <a href="http://www.model-changing.net/blogs/blog/53-hc-rp-czsk-arathor-rp-mythia/" target="blank"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "head.pnf", "core", 'global', false );
$return .= <<<CONTENT
" alt="Arathor RP Mythia">
                        </a>
                    </div>
                </div>
                <div style="width: 1903px; margin-right: 0px;" class="owl-item">
                    <div class="item">
                        <a href="http://www.model-changing.net/blogs/blog/49-dead-rp-the-sunset-of-lordaeron/" target="blank"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "head.pnf", "core", 'global', false );
$return .= <<<CONTENT
" alt="Sunset of Lordaeron">
                        </a>
                    </div>
                </div>
                <div style="width: 1903px; margin-right: 0px;" class="owl-item cloned">
                    <div class="item"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "head.pnf", "core", 'global', false );
$return .= <<<CONTENT
" alt="1">
                    </div>
                </div>
                <div style="width: 1903px; margin-right: 0px;" class="owl-item cloned">
                    <div class="item"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "head.pnf", "core", 'global', false );
$return .= <<<CONTENT
" alt="2">
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-controls">
            <div class="owl-nav">
                <div style="display: none;" class="owl-prev">prev</div>
                <div style="display: none;" class="owl-next">next</div>
            </div>
            <div class="owl-dots" style="">
                <div class="owl-dot active"><span></span>
                </div>
                <div class="owl-dot"><span></span>
                </div>
                <div class="owl-dot"><span></span>
                </div>
                <div class="owl-dot"><span></span>
                </div>
                <div class="owl-dot"><span></span>
                </div>
            </div>
        </div>
    </div>
    <div id="owl-gradient"></div>
</div>
CONTENT;

		return $return;
}

	function sharelinks( $item ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $item->sharelinks() )  ):
$return .= <<<CONTENT

	<ul class='ipsList_inline ipsList_noSpacing ipsClearfix' data-controller="core.front.core.sharelink">
		
CONTENT;

foreach ( $item->sharelinks() as $sharelink  ):
$return .= <<<CONTENT

			<li>{$sharelink}</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function sidebar( $position='left' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( (isset( \IPS\Output::i()->sidebar['enabled'] ) and \IPS\Output::i()->sidebar['enabled'] ) && ( ( isset( \IPS\Output::i()->sidebar['contextual'] ) && trim( \IPS\Output::i()->sidebar['contextual'] ) !== '' ) || ( isset( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) && count( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) ) || ( \IPS\Dispatcher::i()->application instanceof \IPS\Application AND \IPS\Dispatcher::i()->application->canManageWidgets() ) ) ):
$return .= <<<CONTENT

	<div id='ipsLayout_sidebar' class='ipsLayout_sidebar
CONTENT;
$return .= htmlspecialchars( $position, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( !( isset( \IPS\Output::i()->sidebar['contextual'] ) && trim( \IPS\Output::i()->sidebar['contextual'] ) !== '' ) && ( !isset( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) || !count( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) ) && \IPS\Dispatcher::i()->application->canManageWidgets() ):
$return .= <<<CONTENT
ipsLayout_sidebarUnused
CONTENT;

endif;
$return .= <<<CONTENT
' data-controller='core.front.widgets.sidebar'>
		
CONTENT;

if ( isset( \IPS\Output::i()->sidebar['contextual'] ) && trim( \IPS\Output::i()->sidebar['contextual'] ) !== '' ):
$return .= <<<CONTENT

			<aside id="elContextualTools" class='ipsClearfix' 
CONTENT;

if ( isset( \IPS\Output::i()->sidebar['sticky'] ) ):
$return .= <<<CONTENT
data-ipsSticky
CONTENT;

endif;
$return .= <<<CONTENT
>
				
CONTENT;

$return .= \IPS\Output::i()->sidebar['contextual'];
$return .= <<<CONTENT

			</aside>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( isset(\IPS\Output::i()->sidebar['widgets']['sidebar']) and count( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) and ( \IPS\core\Advertisement::loadByLocation( 'ad_sidebar' ) )  ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_sidebar' );
$return .= <<<CONTENT

			<br><br>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->widgetContainer( 'sidebar', 'vertical' );
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function signature( $member ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Member::loggedIn()->isIgnoring( $member, 'signatures' ) AND \IPS\Settings::i()->signatures_enabled AND \IPS\Member::loggedIn()->members_bitoptions['view_sigs'] ):
$return .= <<<CONTENT

	<div data-role="memberSignature" class='ipsResponsive_hidePhone'>
		<hr class='ipsHr'>

		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

			
CONTENT;

$uniqid = md5( uniqid() );
$return .= <<<CONTENT

			<div class='ipsPos_right'>
				<a href='#elSigIgnore
CONTENT;
$return .= htmlspecialchars( $uniqid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-memberID="
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='elSigIgnore
CONTENT;
$return .= htmlspecialchars( $uniqid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='signatureOptions' data-ipsMenu class='ipsFaded ipsFaded_more ipsFaded_withHover ipsType_light' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_signature_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
					<i class='fa fa-times'></i> <i class='fa fa-caret-down'></i>
				</a>

				<ul class='ipsMenu ipsMenu_medium ipsHide' id='elSigIgnore
CONTENT;
$return .= htmlspecialchars( $uniqid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
					
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id ):
$return .= <<<CONTENT

						<li class='ipsMenu_item' data-ipsMenuValue='oneSignature'>
							<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=ignoreType&type=signatures&member_id={$member->member_id}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide_members_signature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-ipsMenuValue='allSignatures'>
						<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=toggleSigs" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide_all_signatures', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				</ul>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT


		<div class='ipsType_light ipsType_richText'>
			{$member->signature}
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function ta_Categories(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['category_r1'] == '1' ):
$return .= <<<CONTENT

	.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r1'];
$return .= <<<CONTENT
"] h2{
		background: 
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_ti_bg_r1'];
$return .= <<<CONTENT
;
		
CONTENT;

if ( \IPS\Theme::i()->settings['cat_ti_bg_gradi_r1'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['cat_ti_bg_gradi_r1'];
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

	}
	.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r1'];
$return .= <<<CONTENT
"] a.ipsType_sectionTitle,
	.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r1'];
$return .= <<<CONTENT
"] .ipsType_sectionTitle a{
		color: 
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_ti_font_r1'];
$return .= <<<CONTENT
;
	}
	
CONTENT;

if ( \IPS\Theme::i()->settings['cat_private_r1'] == '1' ):
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['cat_exclude_group_r1'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['cat_exclude_group_r1'] ) ) ):
$return .= <<<CONTENT
 
CONTENT;

else:
$return .= <<<CONTENT

			.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r1'];
$return .= <<<CONTENT
"] > ol:before {
    			content: "";
    			position: absolute;
    			top: 0;
    			width: 100%;
    			height: 100%;
    			z-index: 1;
			}
			.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r1'];
$return .= <<<CONTENT
"] > ol:before {
				
CONTENT;

if ( \IPS\Theme::i()->settings['cat_private_bg_r1'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['cat_private_bg_r1'];
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			}
			.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r1'];
$return .= <<<CONTENT
"] > ol:after {
  				content: "
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_private_ti_r1'];
$return .= <<<CONTENT
";
				font-size: 25px;
				color: 
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_private_ti_font_r1'];
$return .= <<<CONTENT
; 
				position: absolute;
				top: 50%;
				left: 50%;
				width: 100%;
				text-align: center;
				-ms-transform: translate(-50%, -50%);
				-webkit-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
				z-index: 1;
			}
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['category_r2'] == '1' ):
$return .= <<<CONTENT

	.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r2'];
$return .= <<<CONTENT
"] h2{
		background: 
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_ti_bg_r2'];
$return .= <<<CONTENT
;
		
CONTENT;

if ( \IPS\Theme::i()->settings['cat_ti_bg_gradi_r2'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['cat_ti_bg_gradi_r2'];
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

	}
	.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r2'];
$return .= <<<CONTENT
"] a.ipsType_sectionTitle,
	.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r2'];
$return .= <<<CONTENT
"] .ipsType_sectionTitle a{
		color: 
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_ti_font_r2'];
$return .= <<<CONTENT
;
	}
	
CONTENT;

if ( \IPS\Theme::i()->settings['cat_private_r2'] == '1' ):
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['cat_exclude_group_r2'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['cat_exclude_group_r2'] ) ) ):
$return .= <<<CONTENT
 
CONTENT;

else:
$return .= <<<CONTENT

			.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r2'];
$return .= <<<CONTENT
"] > ol:before {
    			content: "";
    			position: absolute;
    			top: 0;
    			width: 100%;
    			height: 100%;
    			z-index: 1;
			}
			.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r2'];
$return .= <<<CONTENT
"] > ol:before {
				
CONTENT;

if ( \IPS\Theme::i()->settings['cat_private_bg_r2'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['cat_private_bg_r2'];
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			}
			.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r2'];
$return .= <<<CONTENT
"] > ol:after {
  				content: "
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_private_ti_r2'];
$return .= <<<CONTENT
";
				font-size: 25px;
				color: 
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_private_ti_font_r2'];
$return .= <<<CONTENT
; 
				position: absolute;
				top: 50%;
				left: 50%;
				width: 100%;
				text-align: center;
				-ms-transform: translate(-50%, -50%);
				-webkit-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
				z-index: 1;
			}
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['category_r3'] == '1' ):
$return .= <<<CONTENT

	.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r3'];
$return .= <<<CONTENT
"] h2{
		background: 
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_ti_bg_r3'];
$return .= <<<CONTENT
;
		
CONTENT;

if ( \IPS\Theme::i()->settings['cat_ti_bg_gradi_r3'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['cat_ti_bg_gradi_r3'];
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

	}
	.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r3'];
$return .= <<<CONTENT
"] a.ipsType_sectionTitle,
	.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r3'];
$return .= <<<CONTENT
"] .ipsType_sectionTitle a{
		color: 
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_ti_font_r3'];
$return .= <<<CONTENT
;
	}
	
CONTENT;

if ( \IPS\Theme::i()->settings['cat_private_r3'] == '1' ):
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['cat_exclude_group_r3'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['cat_exclude_group_r3'] ) ) ):
$return .= <<<CONTENT
 
CONTENT;

else:
$return .= <<<CONTENT

			.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r3'];
$return .= <<<CONTENT
"] > ol:before {
    			content: "";
    			position: absolute;
    			top: 0;
    			width: 100%;
    			height: 100%;
    			z-index: 1;
			}
			.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r3'];
$return .= <<<CONTENT
"] > ol:before {
				
CONTENT;

if ( \IPS\Theme::i()->settings['cat_private_bg_r3'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['cat_private_bg_r3'];
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			}
			.cForumRow[cat-title="
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_title_r3'];
$return .= <<<CONTENT
"] > ol:after {
  				content: "
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_private_ti_r3'];
$return .= <<<CONTENT
";
				font-size: 25px;
				color: 
CONTENT;

$return .= \IPS\Theme::i()->settings['cat_private_ti_font_r3'];
$return .= <<<CONTENT
; 
				position: absolute;
				top: 50%;
				left: 50%;
				width: 100%;
				text-align: center;
				-ms-transform: translate(-50%, -50%);
				-webkit-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
				z-index: 1;
			}
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function ta_Footer(  ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ta-Footer 
CONTENT;

if ( \IPS\Theme::i()->settings['footer_showonmobile'] == 0 ):
$return .= <<<CONTENT
ipsResponsive_hidePhone ipsResponsive_hideTablet
CONTENT;

endif;
$return .= <<<CONTENT
">
  	<div class="ipsLayout_container">
    
CONTENT;

if ( \IPS\Theme::i()->settings['footer_bgimage'] || \IPS\Theme::i()->settings['footer_custombackground'] ):
$return .= <<<CONTENT
<div class="footerBG"></div>
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsColumns ipsColumns_collapseTablet'>
    	
CONTENT;

if ( \IPS\Theme::i()->settings['footer_links1'] ):
$return .= <<<CONTENT

			<div class='ipsColumn ipsColumn_medium'>
				<div class="links">
                  	<h3>
CONTENT;

$return .= \IPS\Theme::i()->settings['footer_links1_header'];
$return .= <<<CONTENT
</h3>
					
CONTENT;

$return .= \IPS\Theme::i()->settings['footer_links1'];
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

        
CONTENT;

if ( \IPS\Theme::i()->settings['footer_links2'] ):
$return .= <<<CONTENT

			<div class='ipsColumn ipsColumn_medium'>
				<div class="links">
                  	<h3>
CONTENT;

$return .= \IPS\Theme::i()->settings['footer_links2_header'];
$return .= <<<CONTENT
</h3>
					
CONTENT;

$return .= \IPS\Theme::i()->settings['footer_links2'];
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['footer_links3'] ):
$return .= <<<CONTENT

			<div class='ipsColumn ipsColumn_medium'>
				<div class="links">
                  	<h3>
CONTENT;

$return .= \IPS\Theme::i()->settings['footer_links3_header'];
$return .= <<<CONTENT
</h3>
					
CONTENT;

$return .= \IPS\Theme::i()->settings['footer_links3'];
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['footer_articles'] == '1' ):
$return .= <<<CONTENT

			<div class='ipsColumn ipsColumn_veryWide '>
				<div class="mArticles">
					{block="Pages_Footer_Articles"}
				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['footer_about'] ):
$return .= <<<CONTENT

			<div class='ipsColumn ipsColumn_fluid'>
              <div class="about">
					<h3>
CONTENT;

$return .= \IPS\Theme::i()->settings['footer_aboutheader'];
$return .= <<<CONTENT
</h3>
					<section class='ipsType_normal ipsType_richText ipsType_break' 
CONTENT;

if ( \IPS\Theme::i()->settings['truncate_about'] == '1' ):
$return .= <<<CONTENT
data-ipsTruncate data-ipsTruncate-size='
CONTENT;

$return .= \IPS\Theme::i()->settings['truncate_lines'];
$return .= <<<CONTENT
 lines' data-ipsTruncate-type='hide'
CONTENT;

endif;
$return .= <<<CONTENT
>
						
CONTENT;

$return .= \IPS\Theme::i()->settings['footer_about'];
$return .= <<<CONTENT

					</section>
					<div class="followUs">
						
CONTENT;

$return .= \IPS\Theme::i()->settings['footer_follow'];
$return .= <<<CONTENT

					</div>
               	 </div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
</div>
CONTENT;

		return $return;
}

	function ta_Social(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['social_enable'] == '1' ):
$return .= <<<CONTENT

	<div class="socialLinks">
		<div class="followUs">
			
CONTENT;

$return .= \IPS\Theme::i()->settings['footer_follow'];
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function ta_WidgetsB(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['g_whocansee_bottom'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['g_whocansee_bottom'] ) ) ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Theme::i()->settings['g_widget_position_bottom'] ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( explode(',', \IPS\Theme::i()->settings['g_widget_position_bottom']) as $val ):
$return .= <<<CONTENT

			
CONTENT;

if ( $val == 'forums' and \IPS\Request::i()->module == 'forums' or $val == 'store' and \IPS\Request::i()->module == 'store' or $val == 'pages' and \IPS\Request::i()->module == 'pages' or $val == 'downloads' and \IPS\Request::i()->module == 'downloads' or $val == 'chat' and \IPS\Request::i()->module == 'chat' or $val == 'gallery' and \IPS\Request::i()->module == 'gallery' or $val == 'blogs' and \IPS\Request::i()->module == 'blogs' or $val == 'calendar' and \IPS\Request::i()->module == 'calendar' or $val == 'activity' and \IPS\Request::i()->module == 'discover' or $val == 'staffdirectory' and \IPS\Request::i()->module == 'staffdirectory' or $val == 'search' and \IPS\Request::i()->module == 'search' or $val == 'support' and \IPS\Request::i()->module == 'support' or $val == 'members' and \IPS\Request::i()->module == 'members' or $val == 'online' and \IPS\Request::i()->module == 'online' ):
$return .= <<<CONTENT

				<div class="ta-customBlock">
					
CONTENT;

if ( \IPS\Theme::i()->settings['g_widget_title_bottom'] ):
$return .= <<<CONTENT

						<h3 class="ipsType_reset ipsWidget_title">
							
CONTENT;

$return .= \IPS\Theme::i()->settings['g_widget_title_bottom'];
$return .= <<<CONTENT

						</h3>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<div class="ipsWidget_inner ipsPad_half">
						
CONTENT;

$return .= \IPS\Theme::i()->settings['g_widget_content_bottom'];
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $val == 'all' ):
$return .= <<<CONTENT

				<div class="ta-customBlock">
					
CONTENT;

if ( \IPS\Theme::i()->settings['g_widget_title_bottom'] ):
$return .= <<<CONTENT

						<h3 class="ipsType_reset ipsWidget_title">
							
CONTENT;

$return .= \IPS\Theme::i()->settings['g_widget_title_bottom'];
$return .= <<<CONTENT

						</h3>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<div class="ipsWidget_inner ipsPad_half">
						
CONTENT;

$return .= \IPS\Theme::i()->settings['g_widget_content_bottom'];
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function ta_WidgetsT(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['g_whocansee_top'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['g_whocansee_top'] ) ) ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Theme::i()->settings['g_widget_position_top'] ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( explode(',', \IPS\Theme::i()->settings['g_widget_position_top']) as $val ):
$return .= <<<CONTENT

			
CONTENT;

if ( $val == 'forums' and \IPS\Request::i()->module == 'forums' or $val == 'store' and \IPS\Request::i()->module == 'store' or $val == 'pages' and \IPS\Request::i()->module == 'pages' or $val == 'downloads' and \IPS\Request::i()->module == 'downloads' or $val == 'chat' and \IPS\Request::i()->module == 'chat' or $val == 'gallery' and \IPS\Request::i()->module == 'gallery' or $val == 'blogs' and \IPS\Request::i()->module == 'blogs' or $val == 'calendar' and \IPS\Request::i()->module == 'calendar' or $val == 'activity' and \IPS\Request::i()->module == 'discover' or $val == 'staffdirectory' and \IPS\Request::i()->module == 'staffdirectory' or $val == 'search' and \IPS\Request::i()->module == 'search' or $val == 'support' and \IPS\Request::i()->module == 'support' or $val == 'members' and \IPS\Request::i()->module == 'members' or $val == 'online' and \IPS\Request::i()->module == 'online' ):
$return .= <<<CONTENT

				<div class="ta-customBlock">
					
CONTENT;

if ( \IPS\Theme::i()->settings['g_widget_title_top'] ):
$return .= <<<CONTENT

						<h3 class="ipsType_reset ipsWidget_title">
							
CONTENT;

$return .= \IPS\Theme::i()->settings['g_widget_title_top'];
$return .= <<<CONTENT

						</h3>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<div class="ipsWidget_inner ipsPad_half">
						
CONTENT;

$return .= \IPS\Theme::i()->settings['g_widget_content_top'];
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $val == 'all' ):
$return .= <<<CONTENT

				<div class="ta-customBlock">
					
CONTENT;

if ( \IPS\Theme::i()->settings['g_widget_title_top'] ):
$return .= <<<CONTENT

						<h3 class="ipsType_reset ipsWidget_title">
							
CONTENT;

$return .= \IPS\Theme::i()->settings['g_widget_title_top'];
$return .= <<<CONTENT

						</h3>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<div class="ipsWidget_inner ipsPad_half">
						
CONTENT;

$return .= \IPS\Theme::i()->settings['g_widget_content_top'];
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function ta_swiperSlider(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['slider_whocansee1'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['slider_whocansee1'] ) ) or \IPS\Theme::i()->settings['slider_whocansee2'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['slider_whocansee2'] ) ) or \IPS\Theme::i()->settings['slider_whocansee3'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['slider_whocansee3'] ) ) or \IPS\Theme::i()->settings['slider_whocansee4'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['slider_whocansee4'] ) ) or \IPS\Theme::i()->settings['slider_whocansee5'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['slider_whocansee5'] ) ) ):
$return .= <<<CONTENT

<div class="swiper-container">
	<div class="swiper-wrapper">
		
CONTENT;

if ( \IPS\Theme::i()->settings['slider_whocansee1'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['slider_whocansee1'] ) ) ):
$return .= <<<CONTENT

      	
CONTENT;

if ( \IPS\Theme::i()->settings['slider_1'] ):
$return .= <<<CONTENT

			<div class="swiper-slide slide-1">
				<div class="slide-bg swiper-lazy" data-background="
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image1'];
$return .= <<<CONTENT
"></div>
              	<div class="swiper-lazy-preloader"></div>
                <div class="slide-ov"></div>
				<div class="slide-container" 
CONTENT;

if ( \IPS\Theme::i()->settings['slider_effect'] == 'fade' ):
$return .= <<<CONTENT
data-swiper-parallax="-50%"
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

if ( \IPS\Theme::i()->settings['slider_1_content'] || \IPS\Theme::i()->settings['slider_1_title'] || \IPS\Theme::i()->settings['slider_1_buttons'] ):
$return .= <<<CONTENT

                  		<div class="slide-contents">
							<h4 class="ipsType_veryLarge"><span>
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_1_title'];
$return .= <<<CONTENT
</span></h4>
							<section class='ipsType_normal ipsType_richText ipsType_break'>
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_1_content'];
$return .= <<<CONTENT
</section>
							
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_1_buttons'];
$return .= <<<CONTENT
 
                  		</div>
                  	
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['slider_whocansee2'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['slider_whocansee2'] ) ) ):
$return .= <<<CONTENT

      	
CONTENT;

if ( \IPS\Theme::i()->settings['slider_2'] ):
$return .= <<<CONTENT

			<div class="swiper-slide slide-2">
				<div class="slide-bg swiper-lazy" data-background="
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image2'];
$return .= <<<CONTENT
"></div>
              	<div class="swiper-lazy-preloader"></div>
                <div class="slide-ov"></div>
				<div class="slide-container" 
CONTENT;

if ( \IPS\Theme::i()->settings['slider_effect'] == 'fade' ):
$return .= <<<CONTENT
data-swiper-parallax="-50%"
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

if ( \IPS\Theme::i()->settings['slider_2_content'] || \IPS\Theme::i()->settings['slider_2_title'] || \IPS\Theme::i()->settings['slider_2_buttons'] ):
$return .= <<<CONTENT

                  		<div class="slide-contents">
							<h4 class="ipsType_veryLarge"><span>
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_2_title'];
$return .= <<<CONTENT
</span></h4>
							<section class='ipsType_normal ipsType_richText ipsType_break'>
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_2_content'];
$return .= <<<CONTENT
</section>
							
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_2_buttons'];
$return .= <<<CONTENT
 
                  		</div>
                  	
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

      	
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['slider_whocansee3'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['slider_whocansee3'] ) ) ):
$return .= <<<CONTENT

      	
CONTENT;

if ( \IPS\Theme::i()->settings['slider_3'] ):
$return .= <<<CONTENT

			<div class="swiper-slide slide-3">
				<div class="slide-bg swiper-lazy" data-background="
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image3'];
$return .= <<<CONTENT
"></div>
              	<div class="swiper-lazy-preloader"></div>
				<div class="slide-ov"></div>
				<div class="slide-container" 
CONTENT;

if ( \IPS\Theme::i()->settings['slider_effect'] == 'fade' ):
$return .= <<<CONTENT
data-swiper-parallax="-50%"
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

if ( \IPS\Theme::i()->settings['slider_3_content'] || \IPS\Theme::i()->settings['slider_3_title'] || \IPS\Theme::i()->settings['slider_3_buttons'] ):
$return .= <<<CONTENT

                  		<div class="slide-contents">
							<h4 class="ipsType_veryLarge"><span>
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_3_title'];
$return .= <<<CONTENT
</span></h4>
							<section class='ipsType_normal ipsType_richText ipsType_break'>
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_3_content'];
$return .= <<<CONTENT
</section>
							
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_3_buttons'];
$return .= <<<CONTENT
 
                  		</div>
                  	
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['slider_whocansee4'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['slider_whocansee4'] ) ) ):
$return .= <<<CONTENT

      	
CONTENT;

if ( \IPS\Theme::i()->settings['slider_4'] ):
$return .= <<<CONTENT

			<div class="swiper-slide slide-4">
				<div class="slide-bg swiper-lazy" data-background="
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image4'];
$return .= <<<CONTENT
"></div>
              	<div class="swiper-lazy-preloader"></div>
				<div class="slide-ov"></div>
				<div class="slide-container" 
CONTENT;

if ( \IPS\Theme::i()->settings['slider_effect'] == 'fade' ):
$return .= <<<CONTENT
data-swiper-parallax="-50%"
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

if ( \IPS\Theme::i()->settings['slider_4_content'] || \IPS\Theme::i()->settings['slider_4_title'] || \IPS\Theme::i()->settings['slider_4_buttons'] ):
$return .= <<<CONTENT

                  		<div class="slide-contents">
							<h4 class="ipsType_veryLarge"><span>
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_4_title'];
$return .= <<<CONTENT
</span></h4>
							<section class='ipsType_normal ipsType_richText ipsType_break'>
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_4_content'];
$return .= <<<CONTENT
</section>
							
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_4_buttons'];
$return .= <<<CONTENT
 
                  		</div>
                  	
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

      	
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['slider_whocansee5'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['slider_whocansee5'] ) ) ):
$return .= <<<CONTENT

      	
CONTENT;

if ( \IPS\Theme::i()->settings['slider_5'] ):
$return .= <<<CONTENT

			<div class="swiper-slide slide-5">
				<div class="slide-bg swiper-lazy" data-background="
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image5'];
$return .= <<<CONTENT
"></div>
              	<div class="swiper-lazy-preloader"></div>
				<div class="slide-ov"></div>
				<div class="slide-container" 
CONTENT;

if ( \IPS\Theme::i()->settings['slider_effect'] == 'fade' ):
$return .= <<<CONTENT
data-swiper-parallax="-50%"
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

if ( \IPS\Theme::i()->settings['slider_5_content'] || \IPS\Theme::i()->settings['slider_5_title'] || \IPS\Theme::i()->settings['slider_5_buttons'] ):
$return .= <<<CONTENT

                  		<div class="slide-contents">
							<h4 class="ipsType_veryLarge"><span>
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_5_title'];
$return .= <<<CONTENT
</span></h4>
							<section class='ipsType_normal ipsType_richText ipsType_break'>
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_5_content'];
$return .= <<<CONTENT
</section>
							
CONTENT;

$return .= \IPS\Theme::i()->settings['slider_5_buttons'];
$return .= <<<CONTENT
 
                  		</div>
                  	
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['slider_enable_articles'] ):
$return .= <<<CONTENT

			{block="pages_slider_1"}
      		{block="pages_slider_2"}
			{block="pages_slider_3"}
			{block="pages_slider_4"}
      		{block="pages_slider_5"}
			{block="pages_slider_6"}
			{block="pages_slider_7"}
      		{block="pages_slider_8"}
			{block="pages_slider_9"}
			{block="pages_slider_10"}
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( \IPS\Theme::i()->settings['slider_enable_pagination'] ):
$return .= <<<CONTENT

		<div class="swiper-pagination ipsLayout_container"></div>
	
CONTENT;

endif;
$return .= <<<CONTENT

  	
CONTENT;

if ( \IPS\Theme::i()->settings['slider_navigation_buttons'] ):
$return .= <<<CONTENT

		<div class="swiper-next"></div>
        <div class="swiper-prev"></div>
  	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

if ( \IPS\Theme::i()->settings['remo_bodbgimgwidslider'] == '1' and \IPS\Theme::i()->settings['header_layout'] == 'wide' ):
$return .= <<<CONTENT
<style>body.ipsApp.ipsApp_front{background-image: none!important}</style>
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<div class="ta-Header">
		<div class="ta-headerImage" style="background-image: url(
CONTENT;

if ( \IPS\Theme::i()->settings['u_hdrimgs'] ):
$return .= <<<CONTENT

CONTENT;

if ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider1' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image1'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider2' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image2'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider3' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image3'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider4' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image4'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider5' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image5'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'none' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['header_image'];
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
)"></div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function ta_swipersliderBase(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['enable_slider'] == '1' and \IPS\Theme::i()->settings['enable_slider_whocansee'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['enable_slider_whocansee'] ) ) ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Theme::i()->settings['slider_specificpage'] ):
$return .= <<<CONTENT

		
CONTENT;

if ( in_array('pages', explode(',', \IPS\Theme::i()->settings['slider_specificpage'])) and \IPS\Request::i()->module == 'pages' or in_array('forums', explode(',', \IPS\Theme::i()->settings['slider_specificpage'])) and \IPS\Request::i()->module == 'forums' or in_array('forumsfront', explode(',', \IPS\Theme::i()->settings['slider_specificpage'])) and \IPS\Request::i()->module == 'forums' and \IPS\Request::i()->controller == 'index' or in_array('gallery', explode(',', \IPS\Theme::i()->settings['slider_specificpage'])) and \IPS\Request::i()->module == 'gallery' or in_array('blogs', explode(',', \IPS\Theme::i()->settings['slider_specificpage'])) and \IPS\Request::i()->module == 'blogs' ):
$return .= <<<CONTENT
				
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->ta_swiperSlider(  );
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			<div class="ta-Header">
				<div class="ta-headerImage" style="background-image: url(
CONTENT;

if ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider1' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image1'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider2' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image2'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider3' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image3'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider4' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image4'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider5' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image5'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'none' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['header_image'];
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
)"></div>
            </div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['slider_homeall'] == 'homepage' and \IPS\Dispatcher::i()->application->default ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->ta_swiperSlider(  );
$return .= <<<CONTENT

		
CONTENT;

elseif ( \IPS\Theme::i()->settings['slider_homeall'] == 'everywhere' ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->ta_swiperSlider(  );
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			<div class="ta-Header">
				<div class="ta-headerImage" style="background-image: url(
CONTENT;

if ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider1' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image1'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider2' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image2'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider3' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image3'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider4' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image4'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider5' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image5'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'none' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['header_image'];
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
)"></div>
            </div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<div class="ta-Header">
		<div class="ta-headerImage" style="background-image: url(
CONTENT;

if ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider1' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image1'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider2' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image2'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider3' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image3'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider4' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image4'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'slider5' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['slider_image5'];
$return .= <<<CONTENT

CONTENT;

elseif ( \IPS\Theme::i()->settings['u_hdrimgs'] == 'none' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->settings['header_image'];
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
)"></div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function tabs( $tabNames, $activeId, $defaultContent, $url, $tabParam='tab', $parseNames=TRUE, $contained=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsTabs ipsClearfix' id='elTabs_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTabBar data-ipsTabBar-contentArea='#ipsTabs_content_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT
data-ipsTabBar-updateURL='false'
CONTENT;

endif;
$return .= <<<CONTENT
>
	<a href='#elTabs_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( count ( $tabNames ) > 1 ):
$return .= <<<CONTENT
data-action='expandTabs'><i class='fa fa-caret-down'></i>
CONTENT;

else:
$return .= <<<CONTENT
>
CONTENT;

endif;
$return .= <<<CONTENT
</a>
	<ul role='tablist'>
		
CONTENT;

foreach ( $tabNames as $i => $name ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( $tabParam, $i ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsTabs_item 
CONTENT;

if ( $i == $activeId ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
" title='
CONTENT;

if ( $parseNames ):
$return .= <<<CONTENT

CONTENT;

$return .= strip_tags( \IPS\Member::loggedIn()->language()->get( $name ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= strip_tags( $name );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' role="tab" aria-selected="
CONTENT;

if ( $i == $activeId ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
">
					
CONTENT;

if ( $parseNames ):
$return .= <<<CONTENT

CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
{$name}
CONTENT;

endif;
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
<section id='ipsTabs_content_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_panels 
CONTENT;

if ( $contained ):
$return .= <<<CONTENT
ipsTabs_contained
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

foreach ( $tabNames as $i => $name ):
$return .= <<<CONTENT

		
CONTENT;

if ( $i == $activeId ):
$return .= <<<CONTENT

			<div id='ipsTabs_elTabs_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class="ipsTabs_panel" aria-labelledby="
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
				{$defaultContent}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</section>

CONTENT;

		return $return;
}

	function tag( $tag, $tagEditUrl=NULL ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$urlEncodedTag = rawurlencode( $tag );
$return .= <<<CONTENT

<li 
CONTENT;

if ( $tagEditUrl ):
$return .= <<<CONTENT
class='ipsTags_deletable'
CONTENT;

endif;
$return .= <<<CONTENT
>
	<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search&tags={$urlEncodedTag}", null, "tags", array(), 0 ) );
$return .= <<<CONTENT
" class='ipsTag' title="
CONTENT;

$sprintf = array($tag); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_tagged_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"><span>
CONTENT;
$return .= htmlspecialchars( $tag, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></a>
	
CONTENT;

if ( $tagEditUrl ):
$return .= <<<CONTENT

		<a href='
CONTENT;
$return .= htmlspecialchars( $tagEditUrl->setQueryString( 'do', 'editTags' )->setQueryString( 'removeTag', $tag )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTag_remove' data-action='removeTag' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_tag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>&times;</a>
	
CONTENT;

endif;
$return .= <<<CONTENT

</li>
CONTENT;

		return $return;
}

	function tags( $tags, $showCondensed=FALSE, $hideResponsive=FALSE, $tagEditUrl=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$id = uniqid();
$return .= <<<CONTENT


CONTENT;

if ( count( $tags ) OR $tagEditUrl ):
$return .= <<<CONTENT

	
CONTENT;

if ( $showCondensed ):
$return .= <<<CONTENT

		<ul class='ipsTags ipsTags_inline ipsList_inline 
CONTENT;

if ( $hideResponsive ):
$return .= <<<CONTENT
ipsResponsive_hidePhone ipsResponsive_inline
CONTENT;

endif;
$return .= <<<CONTENT
'>
			
CONTENT;

if ( count( $tags ) ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $tags as $idx => $tag ):
$return .= <<<CONTENT

					
CONTENT;

if ( $idx < 2 ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tag( $tag, $tagEditUrl );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( count( $tags ) > 2 ):
$return .= <<<CONTENT

				<li class='ipsType_small'>
					<span class='ipsType_light ipsCursor_pointer' data-ipsMenu id='elTags_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$pluralize = array( count( $tags ) - 2 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_x_more', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down ipsJS_show'></i></span>
					<div class='ipsHide ipsMenu ipsMenu_normal ipsPad_half cTagPopup' id='elTags_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
						<p class='ipsType_medium ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'tagged_with', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
						<ul class='ipsTags ipsList_inline'>
							
CONTENT;

foreach ( $tags as $tag ):
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tag( $tag, NULL );
$return .= <<<CONTENT

							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</ul>
					</div>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

else:
$return .= <<<CONTENT

		<ul class='ipsTags ipsList_inline 
CONTENT;

if ( $hideResponsive ):
$return .= <<<CONTENT
ipsResponsive_hidePhone ipsResponsive_inline
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $tagEditUrl ):
$return .= <<<CONTENT
data-controller='core.front.core.tagEditor' data-tagEditID='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Settings::i()->tags_min ):
$return .= <<<CONTENT
data-minTags='
CONTENT;

$return .= \IPS\Settings::i()->tags_min;
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( \IPS\Settings::i()->tags_max ):
$return .= <<<CONTENT
data-maxTags='
CONTENT;

$return .= \IPS\Settings::i()->tags_max;
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
>
			
CONTENT;

if ( count( $tags ) ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $tags as $tag ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tag( $tag, $tagEditUrl );
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $tagEditUrl ):
$return .= <<<CONTENT

				<li class='ipsTags_edit'>
					<a href="
CONTENT;
$return .= htmlspecialchars( $tagEditUrl->setQueryString( 'do', 'editTags' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_tags', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-closeOnClick='false' id='elTagEditor_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_veryVerySmall ipsButton_light'><i class='fa fa-plus'></i>
CONTENT;

if ( !count( $tags ) ):
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_tags', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
		
CONTENT;

if ( $tagEditUrl ):
$return .= <<<CONTENT

			<div id='elTagEditor_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_wide ipsHide'>
				<div data-controller='core.front.core.tagEditorForm'>
					<div class='ipsPad'>
						<span><i class='icon-spinner2 ipsLoading_tinyIcon'></i>  &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'loading', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
					</div>
				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function thumbImage( $image, $name, $size='medium', $classes='', $lang='view_this', $url='', $extension='core_Attachment' ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $image ):
$return .= <<<CONTENT

	
CONTENT;

$image = ( $image instanceof \IPS\File ) ? (string) $image->url : $image;
$return .= <<<CONTENT

	
CONTENT;

if ( $url ):
$return .= <<<CONTENT
<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$val = "{$lang}"; $sprintf = array($name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'
CONTENT;

else:
$return .= <<<CONTENT
<span
CONTENT;

endif;
$return .= <<<CONTENT
 style='background-image: url( "
CONTENT;

$return .= \IPS\File::get( $extension, $image )->url;
$return .= <<<CONTENT
" )' class='
CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsThumb ipsThumb_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsThumb_bg'>
		<img src='
CONTENT;

$return .= \IPS\File::get( $extension, $image )->url;
$return .= <<<CONTENT
' alt=''>
	
CONTENT;

if ( $url ):
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

if ( $url ):
$return .= <<<CONTENT
<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$val = "{$lang}"; $sprintf = array($name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'
CONTENT;

else:
$return .= <<<CONTENT
<span
CONTENT;

endif;
$return .= <<<CONTENT
 class='
CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsNoThumb ipsThumb ipsThumb_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

if ( $url ):
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

		return $return;
}

	function updateWarning(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $newVersion = \IPS\Application::load('core')->availableUpgrade( TRUE ) and \IPS\Member::loggedIn()->hasAcpRestriction( 'core', 'system', 'upgrade_manage' ) ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Application::load('core')->missingSecurityPatches() ):
$return .= <<<CONTENT

		<div class="ipsMessage ipsMessage_error" id='elLicenseKey'>
			
CONTENT;

$sprintf = array($newVersion['version']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dashboard_version_info', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_security_update', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			<ul class='ipsList_inline'>
				<li>
					<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=upgrade&_new=1", "admin", "", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_veryLight'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'upgrade_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
			</ul>
		</div>
	
CONTENT;

elseif ( !isset( \IPS\Request::i()->cookie['updateBannerDismiss'] ) ):
$return .= <<<CONTENT

		<div class="ipsMessage ipsMessage_general" id='elLicenseKey' data-controller='core.global.core.updateBanner'>
			
CONTENT;

$sprintf = array($newVersion['version']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dashboard_version_info', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

			<ul class='ipsList_inline'>
				<li>
					<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=upgrade&_new=1", "admin", "", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_veryLight'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'upgrade_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
			</ul>
			<a href='#' data-role='closeMessage' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'license_dismiss', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>&times;</a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userBar(   ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Member::loggedIn()->member_id  ):
$return .= <<<CONTENT

	<ul id='elUserNav' class='ipsList_inline cSignedIn ipsClearfix ipsResponsive_showDesktop' data-controller='core.front.core.userbar
CONTENT;

if ( \IPS\Member::loggedIn()->member_id && \IPS\Settings::i()->auto_polling_enabled ):
$return .= <<<CONTENT
,core.front.core.instantNotifications
CONTENT;

endif;
$return .= <<<CONTENT
'>
		
CONTENT;

if ( !\IPS\Member::loggedIn()->restrict_post and count( \IPS\Member::loggedIn()->createMenu() ) ):
$return .= <<<CONTENT

			<li id='cCreate'>
				<a href='#elCreateNew_menu' id='elCreateNew' data-ipsTooltip data-ipsMenu title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'create_menu_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
					<strong><i class='fa fa-plus'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'create_menu', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong> <i class='fa fa-caret-down'></i>
				</a>
				<div id='elCreateNew_menu' class='ipsMenu ipsMenu_auto ipsHide'>
					<ul>
						
CONTENT;

foreach ( \IPS\Member::loggedIn()->createMenu() as $k => $url ):
$return .= <<<CONTENT

							<li class="ipsMenu_item">
								<a href="
CONTENT;
$return .= htmlspecialchars( $url['link'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
								
CONTENT;

if ( isset( $url['extraData'] ) ):
$return .= <<<CONTENT

									
CONTENT;

foreach ( $url['extraData'] as $data => $v ):
$return .= <<<CONTENT

										
CONTENT;
$return .= htmlspecialchars( $data, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
									
CONTENT;

endforeach;
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( isset($url['title']) AND $url['title'] ):
$return .= <<<CONTENT
 data-ipsDialog-title='
CONTENT;

$val = "{$url['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( isset($url['flashMessage']) ):
$return .= <<<CONTENT
 data-ipsdialog-flashmessage="
CONTENT;

$val = "{$url['flashMessage']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

								>
CONTENT;

$val = "{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</div>
			</li>
			<li class='elUserNav_sep'></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<li class='cNotifications cUserNav_icon'>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications", null, "notifications", array(), 0 ) );
$return .= <<<CONTENT
' id='elFullNotifications' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'userbar_notifications', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false'>
				<i class='fa fa-bell'></i> <span class='ipsNotificationCount 
CONTENT;

if ( !\IPS\Member::loggedIn()->notification_cnt ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-notificationType='notify' data-currentCount='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->notification_cnt, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->notification_cnt, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</a>
			<div id='elFullNotifications_menu' class='ipsMenu ipsMenu_wide ipsHide'>
				<div class='ipsMenu_headerBar'>
					<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=options", null, "notifications_options", array(), 0 ) );
$return .= <<<CONTENT
" class="ipsType_light ipsPos_right"><i class="fa fa-cog"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notification_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				</div>
				<div class='ipsMenu_innerContent'>
					<ol class='ipsDataList ipsDataList_readStatus' data-role='notifyList' data-ipsKeyNav data-ipsKeyNav-observe='return' id='elNotifyContent'></ol>
				</div>
				<div class='ipsMenu_footerBar ipsType_center'>
					<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications", null, "notifications", array(), 0 ) );
$return .= <<<CONTENT
'><i class='fa fa-bars'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_notifications', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</div>
			</div>
		</li>
		
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

			<li class='cInbox cUserNav_icon'>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger", null, "messaging", array(), 0 ) );
$return .= <<<CONTENT
' id='elFullInbox' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'userbar_messages', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false'>
					<i class='fa fa-envelope'></i> <span class='ipsNotificationCount 
CONTENT;

if ( !\IPS\Member::loggedIn()->msg_count_new ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-notificationType='inbox' data-currentCount='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->msg_count_new, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->msg_count_new, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
				</a>
				<div id='elFullInbox_menu' class='ipsMenu ipsMenu_wide ipsHide' data-controller='core.front.core.messengerMenu'>
					<div class='ipsMenu_headerBar'>
						<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose", null, "messenger_compose", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" id='elMessengerPopup_compose' class='ipsPos_right ipsButton ipsButton_primary ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'inbox', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
					</div>
					<div class='ipsMenu_innerContent'><ol class='ipsDataList' data-role='inboxList' data-ipsKeyNav data-ipsKeyNav-observe='return' id='elInboxContent'></ol></div>
					<div class='ipsMenu_footerBar ipsType_center'>
						<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger", null, "messaging", array(), 0 ) );
$return .= <<<CONTENT
'><i class='fa fa-bars'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_inbox', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</div>
				</div>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) and \IPS\Member::loggedIn()->modPermission('can_view_reports') ):
$return .= <<<CONTENT

			<li class='cReports cUserNav_icon'>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=reports", null, "modcp_reports", array(), 0 ) );
$return .= <<<CONTENT
' id='elFullReports' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'userbar_reports', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false'>
					<i class='fa fa-warning'></i> 
CONTENT;

if ( \IPS\Member::loggedIn()->reportCount() ):
$return .= <<<CONTENT
<span class='ipsNotificationCount' data-notificationType='reports'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->reportCount(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

				</a>
				<div id='elFullReports_menu' class='ipsMenu ipsMenu_wide ipsHide'>
					<div class='ipsMenu_headerBar'><h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_center_header', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4></div>
					<div class='ipsMenu_innerContent' data-role="reportsList"></div>
					<div class='ipsMenu_footerBar ipsType_center'>
						<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=reports", null, "modcp_reports", array(), 0 ) );
$return .= <<<CONTENT
'><i class='fa fa-bars'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_center_link', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</div>
				</div>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<li class='elUserNav_sep'></li>
		<li id='cUserLink'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::loggedIn(), 'tiny' );
$return .= <<<CONTENT

			<a href='#elUserLink_menu' id='elUserLink' data-ipsMenu>
				
CONTENT;

if ( isset( $_SESSION['logged_in_as_key'] ) ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($_SESSION['logged_in_from']['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'front_logged_in_as', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i>
			</a>
			<ul id='elUserLink_menu' class='ipsMenu ipsMenu_normal ipsHide'>
				<li class='ipsMenu_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
				
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) ) ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-menuItem='profile'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_my_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) and \IPS\Member::loggedIn()->members_disable_pm AND \IPS\Member::loggedIn()->members_disable_pm != 2 ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-menuItem='messages'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=enableMessenger" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "messaging", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_messenger', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm data-confirmMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_disabled_msg', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_messages', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_attach_max'] != 0 ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-menuItem='attachments'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=attachments", null, "attachments", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsMenu_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_settings_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
				<li class='ipsMenu_item' data-menuItem='manageFollowed'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=followed", null, "followed_content", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_followed_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li class='ipsMenu_item' id='elAccountSettingsLink' data-menuItem='settings'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings", null, "settings", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_account_settings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_settings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
                <li class='ipsMenu_item' data-menuItem='ignoredUsers'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore", null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_manage_ignore', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li class='ipsMenu_sep'><hr></li>
				
CONTENT;

if ( ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) AND \IPS\Member::loggedIn()->modPermission() ) or \IPS\Member::loggedIn()->isAdmin() ):
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) AND \IPS\Member::loggedIn()->modPermission() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item' data-menuItem='modcp'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp", null, "modcp", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_modcp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->isAdmin() AND !\IPS\Settings::i()->security_remove_acp_link  ):
$return .= <<<CONTENT

						<li class='ipsMenu_item' data-menuItem='admincp'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "", "admin", "", array(), 0 ) );
$return .= <<<CONTENT
' target='_blank'><i class='fa fa-lock'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_admincp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsMenu_sep'><hr></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsMenu_item' data-menuItem='signout'>
					<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login&do=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "logout", array(), 0 ) );
$return .= <<<CONTENT
'>
						
CONTENT;

if ( isset( $_SESSION['logged_in_as_key'] ) ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($_SESSION['logged_in_from']['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'switch_to_account', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

					</a>
				</li>
			</ul>
		</li>
	</ul>

CONTENT;

else:
$return .= <<<CONTENT

	<ul id='elUserNav' class='ipsList_inline cSignedOut ipsClearfix ipsResponsive_hidePhone ipsResponsive_block'>
		<li id='elSignInLink'>
			
CONTENT;

if ( \IPS\Settings::i()->logins_over_https AND !\IPS\Request::i()->isSecure() ):
$return .= <<<CONTENT

				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), \IPS\Settings::i()->logins_over_https ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

else:
$return .= <<<CONTENT

				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), \IPS\Settings::i()->logins_over_https ) );
$return .= <<<CONTENT
' data-ipsMenu-closeOnClick="false" data-ipsMenu id='elUserSignIn'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i>
				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->loginPopup( new \IPS\Login( \IPS\Http\Url::internal( 'app=core&module=system&controller=login', 'front', 'login', NULL, \IPS\Settings::i()->logins_over_https ) ) );
$return .= <<<CONTENT

		</li>
		
CONTENT;

if ( \IPS\Settings::i()->allow_reg ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), \IPS\Settings::i()->logins_over_https ) );
$return .= <<<CONTENT
' id='elRegisterButton' class='ipsButton ipsButton_normal ipsButton_primary'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userLink( $member, $warningRef=NULL, $groupFormatting=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $member->member_id AND \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) )  ):
$return .= <<<CONTENT
<a href='
CONTENT;

if ( $warningRef ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( 'wr', $warningRef ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsHover data-ipsHover-target='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( array( 'do' => 'hovercard', 'wr' => $warningRef, 'referrer' => urlencode( \IPS\Request::i()->url() ) ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_user_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class="ipsType_break">
CONTENT;

if ( $groupFormatting && $member->group['prefix'] ):
$return .= <<<CONTENT
{$member->group['prefix']}
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $groupFormatting && $member->group['suffix'] ):
$return .= <<<CONTENT
{$member->group['suffix']}
CONTENT;

endif;
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $groupFormatting && $member->group['prefix'] ):
$return .= <<<CONTENT
{$member->group['prefix']}
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $groupFormatting && $member->group['suffix'] ):
$return .= <<<CONTENT
{$member->group['suffix']}
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userLinkFromData( $id, $name, $seoName, $groupIdForFormatting=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $id AND \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) )  ):
$return .= <<<CONTENT
<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$id}", null, "profile", array( $seoName ?: \IPS\Http\Url::seoTitle( $name ) ), 0 ) );
$return .= <<<CONTENT
' data-ipsHover data-ipsHover-target='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$id}&do=hovercard", null, "profile", array( $seoName ?: \IPS\Http\Url::seoTitle( $name ) ), 0 ) );
$return .= <<<CONTENT
' title="
CONTENT;

$sprintf = array($name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_user_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class="ipsType_break">
CONTENT;

if ( $groupIdForFormatting ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member\Group::load( $groupIdForFormatting )->formatName( $name );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $groupIdForFormatting ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member\Group::load( $groupIdForFormatting )->formatName( $name );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userPhoto( $member, $size='small', $warningRef=NULL, $classes='', $hovercard=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $member->member_id and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) ) ):
$return .= <<<CONTENT


CONTENT;

$memberURL = ( $warningRef ) ? $member->url()->setQueryString( 'wr', $warningRef ) : $member->url();
$return .= <<<CONTENT

	<a href="
CONTENT;
$return .= htmlspecialchars( $memberURL, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $hovercard ):
$return .= <<<CONTENT
data-ipsHover data-ipsHover-target="
CONTENT;
$return .= htmlspecialchars( $memberURL->setQueryString( 'do', 'hovercard' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 class="ipsUserPhoto ipsUserPhoto_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $classes ):
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_user_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
		<img src='
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' itemprop="image">
	</a>

CONTENT;

else:
$return .= <<<CONTENT

	<span class='ipsUserPhoto ipsUserPhoto_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( $classes ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
		<img src='
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' itemprop="image">
	</span>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userPhotoFromData( $id, $name, $seoName, $photoUrl, $size='small', $classes='', $hovercard=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $id and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) ) ):
$return .= <<<CONTENT

	<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$id}", null, "profile", array( $seoName ?: \IPS\Http\Url::seoTitle( $name ) ), 0 ) );
$return .= <<<CONTENT
" 
CONTENT;

if ( $hovercard ):
$return .= <<<CONTENT
data-ipsHover data-ipsHover-target="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$id}&do=hovercard", null, "profile", array( $seoName ?: \IPS\Http\Url::seoTitle( $name ) ), 0 ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 class="ipsUserPhoto ipsUserPhoto_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $classes ):
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_user_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
		<img src='
CONTENT;
$return .= htmlspecialchars( $photoUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt=''>
	</a>

CONTENT;

else:
$return .= <<<CONTENT

	<span class='ipsUserPhoto ipsUserPhoto_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( $classes ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
		<img src='
CONTENT;
$return .= htmlspecialchars( $photoUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt=''>
	</span>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function viglink(  ) {
		$return = '';
		$return .= <<<CONTENT

<!--VIGLINK-->

CONTENT;

if ( \IPS\Settings::i()->viglink_groups =='all' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Settings::i()->viglink_groups ) ) ):
$return .= <<<CONTENT

	<script type="text/javascript">
	  var vglnk = { key: '
CONTENT;

$return .= \IPS\Settings::i()->viglink_api_key;
$return .= <<<CONTENT
'
CONTENT;

if ( \IPS\Settings::i()->viglink_subid ):
$return .= <<<CONTENT
,
	                sub_id: '
CONTENT;

$return .= \IPS\Settings::i()->viglink_subid;
$return .= <<<CONTENT
'
	                
CONTENT;

endif;
$return .= <<<CONTENT

	              };
	
	  (function(d, t) {
	    var s = d.createElement(t); s.type = 'text/javascript'; s.async = true;
	    s.src = '//cdn.viglink.com/api/vglnk.js';
	    var r = d.getElementsByTagName(t)[0]; r.parentNode.insertBefore(s, r);
	  }(document, 'script'));
	</script>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function widgetContainer( $id, $orientation='horizontal' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( ( isset( \IPS\Output::i()->sidebar['widgets'][ $id ] ) && count( \IPS\Output::i()->sidebar['widgets'][ $id ] ) ) || ( \IPS\Dispatcher::i()->application instanceof \IPS\Application AND \IPS\Dispatcher::i()->application->canManageWidgets() ) ):
$return .= <<<CONTENT

	<div class='cWidgetContainer 
CONTENT;

if ( !isset( \IPS\Output::i()->sidebar['widgets'][ $id ] ) or !count( \IPS\Output::i()->sidebar['widgets'][ $id ] ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Dispatcher::i()->application->canManageWidgets() ):
$return .= <<<CONTENT
data-controller='core.front.widgets.area'
CONTENT;

endif;
$return .= <<<CONTENT
 data-role='widgetReceiver' data-orientation='
CONTENT;
$return .= htmlspecialchars( $orientation, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-widgetArea='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<ul class='ipsList_reset'>
			
CONTENT;

if ( isset( \IPS\Output::i()->sidebar['widgets'][ $id ] ) ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( \IPS\Output::i()->sidebar['widgets'][ $id ] as $widget ):
$return .= <<<CONTENT

					
CONTENT;

$widgetHtml = (string) $widget;
$return .= <<<CONTENT

					<li class='ipsWidget ipsWidget_
CONTENT;
$return .= htmlspecialchars( $orientation, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsBox
CONTENT;

if ( trim( $widgetHtml ) === '' ):
$return .= <<<CONTENT
 ipsWidgetHide ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-blockID='
CONTENT;

if ( isset($widget->app) AND !empty($widget->app) ):
$return .= <<<CONTENT
app_
CONTENT;
$return .= htmlspecialchars( $widget->app, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;

else:
$return .= <<<CONTENT
plugin_
CONTENT;
$return .= htmlspecialchars( $widget->plugin, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $widget->key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $widget->uniqueKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

if ( $widget->hasConfiguration() ):
$return .= <<<CONTENT
 data-blockConfig="true"
CONTENT;

endif;
$return .= <<<CONTENT
 data-blockTitle="
CONTENT;

$val = "block_{$widget->key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-controller='core.front.widgets.block'>{$widgetHtml}</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}