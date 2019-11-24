<?php
namespace IPS\Theme\Cache;
class class_forums_front_topics extends \IPS\Theme\Template
{
	public $cache_key = '93826fd1df1590e282335a3fa4af4fad';
	function post( $item, $comment, $editorName, $app, $type, $class='' ) {
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

$return .= htmlspecialchars( json_encode( array('userid' => $comment->author()->member_id, 'username' => $comment->author()->name, 'timestamp' => $comment->mapped('date'), 'contentapp' => $comment::$application, 'contenttype' => $type, 'contentid' => $item->tid, 'contentclass' => $class, 'contentcommentid' => $comment->$idField) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment_content ipsType_medium 
CONTENT;

if ( $comment->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
 ipsFaded_withHover'>
	
CONTENT;

if ( \IPS\Settings::i()->reputation_highlight and $comment->reputation() >= \IPS\Settings::i()->reputation_highlight and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

		<strong class='ipsComment_popularFlag' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-heart'></i></strong>
	
CONTENT;

endif;
$return .= <<<CONTENT


	<div class='ipsComment_meta ipsType_light'>
		<p class='ipsPos_right ipsType_reset ipsType_blendLinks ipsFaded ipsFaded_more'>
			
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
</a>) &middot;</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $comment->mapped('first')  ):
$return .= <<<CONTENT

				<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false' id='elSharePost_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='shareComment'><i class='fa fa-share-alt'></i></a>
			
CONTENT;

else:
$return .= <<<CONTENT

				<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->$idField ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false' id='elSharePost_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='shareComment'><i class='fa fa-share-alt'></i></a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( count( $item->commentMultimodActions() ) and !$comment->mapped('first') ):
$return .= <<<CONTENT

				&middot; 
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

		<p class='ipsType_reset'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->$idField ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-action='reportComment' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsFaded ipsFaded_more'><span class='ipsResponsive_showPhone ipsResponsive_inline'><i class='fa fa-flag'></i></span><span class='ipsResponsive_hidePhone ipsResponsive_inline'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</p>
	</div>

	
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') and $comment->warning ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentWarned( $comment );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT



	<div class='cPost_contentWrap ipsPad'>		
		<div data-role='commentContent' itemprop='text' class='ipsType_normal ipsType_richText ipsContained' data-controller='core.front.core.lightboxedImages'>
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

if ( !( $comment->hidden() === 1 && ( $comment->canUnhide() || $comment->canDelete() ) ) ):
$return .= <<<CONTENT

			
CONTENT;

if ( $comment instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $comment, 'ipsPos_right ipsResponsive_noFloat' );
$return .= <<<CONTENT

			
CONTENT;

endif;
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
' data-action='deleteComment' data-updateOnDelete="#commentCount" class='ipsButton ipsButton_verySmall ipsButton_negative'><i class='fa fa-times'></i> 
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
						<a href='#' data-action='quoteComment' data-ipsQuote-singleQuote>
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

if ( $comment->canDelete() || $comment->canHide() || $comment->canUnhide() || $comment->canSplit() ):
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
		
CONTENT;

if ( $comment->author()->signature ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->signature( $comment->author() );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

	<div class='ipsMenu ipsMenu_wide ipsHide cPostShareMenu' id='elSharePost_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
		<div class='ipsPad'>
			<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
			<hr class='ipsHr'>
			<h5 class='ipsType_normal ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'link_to_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>
			
CONTENT;

if ( $comment->mapped('first')  ):
$return .= <<<CONTENT

			<input type='text' value='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsField_fullWidth'>
			
CONTENT;

else:
$return .= <<<CONTENT

			<input type='text' value='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->$idField ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsField_fullWidth'>
			
CONTENT;

endif;
$return .= <<<CONTENT


			
CONTENT;

if ( !$comment->item()->container()->disable_sharelinks and count( $comment->sharelinks() ) ):
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

	function postContainer( $item, $comment, $votes=array(), $otherClasses='' ) {
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

	<div class="ipsComment ipsComment_ignored ipsType_light" id="elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ignorecommentid="elComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ignoreuserid="
CONTENT;
$return .= htmlspecialchars( $comment->author()->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignoring_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href="#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" data-ipsmenu data-ipsmenu-menuid="elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" data-ipsmenu-appendto="#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="ignoreOptions" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_post_ignore_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsType_blendLinks">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
		<ul class="ipsMenu ipsHide" id="elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
<li class="ipsMenu_item ipsJS_show" data-ipsmenuvalue="showPost"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_this_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li class="ipsMenu_sep ipsJS_show"><hr></li>
			<li class="ipsMenu_item" data-ipsmenuvalue="stopIgnoring"><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=remove&id={$comment->author()->member_id}", null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stop_ignoring_posts_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a></li>
			<li class="ipsMenu_item"><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore", null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_ignore_preferences', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</ul>
</div>

CONTENT;

endif;
$return .= <<<CONTENT


<a id="comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></a>
<article itemscope 
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT
data-membergroup="
CONTENT;
$return .= htmlspecialchars( $comment->author()->member_group_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $item->isQuestion() && !$comment->new_topic ):
$return .= <<<CONTENT
itemprop="suggestedAnswer 
CONTENT;

if ( $comment->post_bwoptions['best_answer'] ):
$return .= <<<CONTENT
acceptedAnswer
CONTENT;

endif;
$return .= <<<CONTENT
" itemtype="http://schema.org/Answer" 
CONTENT;

else:
$return .= <<<CONTENT
itemtype="http://schema.org/Comment" 
CONTENT;

endif;
$return .= <<<CONTENT
 id="elComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cPost ipsBox 
CONTENT;

if ( $otherClasses ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $otherClasses, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 ipsComment 
CONTENT;

if ( \IPS\Settings::i()->reputation_highlight and $comment->reputation() >= \IPS\Settings::i()->reputation_highlight and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT
ipsComment_popular
CONTENT;

endif;
$return .= <<<CONTENT
 ipsComment_parent ipsClearfix ipsClear ipsColumns ipsColumns_noSpacing ipsColumns_collapsePhone 
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT
ipsComment_highlighted
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $comment->isIgnored() ):
$return .= <<<CONTENT
ipsHide
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
">
	
CONTENT;

if ( $item->isQuestion() and !$comment->new_topic ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "topics", "forums" )->postRating( $item, $comment, $votes );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	<aside class="ipsComment_author cAuthorPane ipsColumn ipsColumn_medium"><h3 class="ipsType_sectionHead cAuthorPane_author ipsType_blendLinks ipsType_break" itemprop="creator" itemscope itemtype="http://schema.org/Person">
<strong itemprop="name">{$comment->author()->link( $comment->warningRef() )}</strong> <span class="ipsResponsive_showPhone ipsResponsive_inline">  
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationBadge( $comment->author() );
$return .= <<<CONTENT
</span>
</h3>
		<ul class="cAuthorPane_info ipsList_reset">
			
CONTENT;

if ( $comment->author()->member_title && $comment->author()->member_id ):
$return .= <<<CONTENT

				<li class="ipsResponsive_hidePhone ipsType_break">
CONTENT;
$return .= htmlspecialchars( $comment->author()->member_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</li>
			
CONTENT;

elseif ( $comment->author()->rank['title'] && $comment->author()->member_id ):
$return .= <<<CONTENT

				<li class="ipsResponsive_hidePhone ipsType_break">
CONTENT;
$return .= htmlspecialchars( $comment->author()->rank['title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $comment->author()->rank['image'] && $comment->author()->member_id ):
$return .= <<<CONTENT

				<li class="ipsResponsive_hidePhone">{$comment->author()->rank['image']}</li>
			
CONTENT;

endif;
$return .= <<<CONTENT


			<li class="cAuthorPane_photo">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'large', $comment->warningRef() );
$return .= <<<CONTENT

			</li>
			<li>
CONTENT;

$return .= \IPS\Member\Group::load( $comment->author()->member_group_id )->formattedName;
$return .= <<<CONTENT
</li>
			
CONTENT;

if ( \IPS\Member\Group::load( $comment->author()->member_group_id )->g_icon  ):
$return .= <<<CONTENT

				<li class="ipsResponsive_hidePhone"><img src="
CONTENT;

$return .= \IPS\File::get( "core_Theme", $comment->author()->group['g_icon'] )->url;
$return .= <<<CONTENT
" alt="" class="cAuthorGroupIcon"></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $comment->author()->member_id ):
$return .= <<<CONTENT

				<li class="ipsResponsive_hidePhone">
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationBadge( $comment->author() );
$return .= <<<CONTENT
</li>
				<li class="ipsType_light">
CONTENT;

$pluralize = array( $comment->author()->member_posts ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_post_count', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
				
CONTENT;

if ( $comment->author()->reputationImage() ):
$return .= <<<CONTENT

					<li class="ipsPad_half ipsResponsive_hidePhone">
						<img src="
CONTENT;

$return .= \IPS\File::get( "core_Theme", $comment->author()->reputationImage() )->url;
$return .= <<<CONTENT
" title="
CONTENT;

if ( $comment->author()->reputation() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $comment->author()->reputation(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" alt="">
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->customFieldsDisplay( $comment->author() );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "donate", 'front' )->topicView( $comment );
$return .= <<<CONTENT
</ul></aside><div class="ipsColumn ipsColumn_fluid">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "topics", "forums" )->post( $item, $comment, $item::$formLangPrefix . 'comment', $item::$application, $item::$module, $itemClassSafe );
$return .= <<<CONTENT

	</div>
</article>

CONTENT;

		return $return;
}

	function postRating( $item, $comment, $votes=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT

<div class='cRatingColumn 
CONTENT;

if ( $comment->post_bwoptions['best_answer'] ):
$return .= <<<CONTENT
cRatingColumn_on
CONTENT;

else:
$return .= <<<CONTENT
ipsAreaBackground
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === 1 ):
$return .= <<<CONTENT
cRatingColumn_up
CONTENT;

elseif ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === -1 ):
$return .= <<<CONTENT
cRatingColumn_down
CONTENT;

endif;
$return .= <<<CONTENT
 ipsColumn ipsColumn_narrow ipsType_center' data-controller='forums.front.topic.answers'>
	<meta itemprop="upvoteCount" content="
CONTENT;
$return .= htmlspecialchars( $comment->post_field_int, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
	<ul class='ipsList_reset'>
	
CONTENT;

if ( !$item->isArchived()  ):
$return .= <<<CONTENT

		
CONTENT;

if ( $comment->post_bwoptions['best_answer'] or $item->canSetBestAnswer() ):
$return .= <<<CONTENT

			<li>
				
CONTENT;

if ( $item->canSetBestAnswer() and !$comment->post_bwoptions['best_answer'] ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->csrf()->setQueryString( array( 'do' => 'bestAnswer', 'answer' => $comment->pid ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'set_as_best_answer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator cBestAnswerIndicator_off' data-ipsTooltip><i class='fa fa-check'></i></a>
				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

if ( $item->canSetBestAnswer() ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->csrf()->setQueryString( array( 'do' => 'unsetBestAnswer' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unset_as_best_answer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator' data-ipsTooltip><i class='fa fa-check'></i></a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<strong class='cBestAnswerIndicator' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'best_answer_tooltip', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-check'></i></strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
		
CONTENT;

if ( $comment->canVote() ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->setQueryString( array( 'do' => 'rateAnswer', 'answer' => $comment->pid, 'rating' => 1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='
CONTENT;

if ( !$comment->canVote(1) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 cAnswerRate cAnswerRate_up 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

endif;
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'vote_answer_up', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-caret-up'></i></a>
				<span class='
CONTENT;

if ( $comment->canVote(1) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 cAnswerRate cAnswerRate_up 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa fa-caret-up'></i></span>
			</li>
		
CONTENT;

else:
$return .= <<<CONTENT

			<li>
				<span class='cAnswerRate cAnswerRate_up cAnswerRate_noPermission' 
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_rate_answer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
><i class='fa fa-caret-up'></i></span>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT


			<li>
				<span title="
CONTENT;

$pluralize = array( $comment->post_field_int ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'votes_no_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
" data-role="voteCount" data-voteCount="
CONTENT;
$return .= htmlspecialchars( $comment->post_field_int, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='cAnswerRating 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

elseif ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $comment->post_field_int, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</li>

		
CONTENT;

if ( $comment->canVote() && \IPS\Settings::i()->forums_answers_downvote ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->setQueryString( array( 'do' => 'rateAnswer', 'answer' => $comment->pid, 'rating' => -1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='
CONTENT;

if ( !$comment->canVote(-1) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 cAnswerRate cAnswerRate_down 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'vote_answer_down', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-caret-down'></i></a>
				<span class='
CONTENT;

if ( $comment->canVote(-1) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 cAnswerRate cAnswerRate_down 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa fa-caret-down'></i></span>
			</li>
		
CONTENT;

elseif ( \IPS\Settings::i()->forums_answers_downvote ):
$return .= <<<CONTENT

			<li>
				<span class='cAnswerRate cAnswerRate_down cAnswerRate_noPermission' 
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_rate_answer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
><i class='fa fa-caret-down'></i></span>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( isset($comment->post_field_int)  ):
$return .= <<<CONTENT

			<li>
				<span title="
CONTENT;

$pluralize = array( $comment->post_field_int ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'votes_no_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
" data-role="voteCount" data-voteCount="
CONTENT;
$return .= htmlspecialchars( $comment->post_field_int, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='cAnswerRating 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

elseif ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $comment->post_field_int, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>

</div>
CONTENT;

		return $return;
}

	function topic( $topic, $comments, $question=NULL, $votes=array(), $nextUnread=NULL, $pagination, $topicVotes=array() ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $topic->isArchived() ):
$return .= <<<CONTENT

	<div class='ipsMessage ipsMessage_info ipsSpacer_bottom'>
		<h4 class='ipsMessage_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_is_archived', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
		<p class='ipsType_reset'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_archived_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

	<div itemscope itemtype="http://schema.org/Question">

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

	<div class='ipsColumns'>
		<div class='cRatingColumn cRatingColumn_question ipsColumn ipsColumn_narrow ipsType_center'>
			<ul class='ipsList_reset'>
				
CONTENT;

if ( $topic->canVote() ):
$return .= <<<CONTENT

					<li>
						<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'rateQuestion', 'rating' => 1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='
CONTENT;

if ( !$topic->canVote(1) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 cAnswerRate cAnswerRate_up 
CONTENT;

if ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

endif;
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'vote_question_up', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-caret-up'></i></a>
						<span class='
CONTENT;

if ( $topic->canVote(1) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 cAnswerRate cAnswerRate_up 
CONTENT;

if ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa fa-caret-up'></i></span>
					</li>
				
CONTENT;

else:
$return .= <<<CONTENT

					<li>
						<span class='cAnswerRate cAnswerRate_up cAnswerRate_noPermission' 
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_rate_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
><i class='fa fa-caret-up'></i></span>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT


					<li><span data-role="voteCount" data-voteCount="
CONTENT;

$return .= htmlspecialchars( intval( $topic->question_rating ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='cAnswerRating 
CONTENT;

if ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

elseif ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( intval( $topic->question_rating ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></li>

				
CONTENT;

if ( $topic->canVote() && \IPS\Settings::i()->forums_answers_downvote ):
$return .= <<<CONTENT

					<li>
						<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'rateQuestion', 'rating' => -1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='
CONTENT;

if ( !$topic->canVote(-1) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 cAnswerRate cAnswerRate_down 
CONTENT;

if ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'vote_question_down', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-caret-down'></i></a>
						<span class='
CONTENT;

if ( $topic->canVote(-1) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 cAnswerRate cAnswerRate_down 
CONTENT;

if ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa fa-caret-down'></i></span>
					</li>
				
CONTENT;

elseif ( \IPS\Settings::i()->forums_answers_downvote ):
$return .= <<<CONTENT

					<li>
						<span class='cAnswerRate cAnswerRate_down cAnswerRate_noPermission' 
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_rate_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
><i class='fa fa-caret-down'></i></span>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
			<meta itemprop="upvoteCount" content="
CONTENT;

$return .= htmlspecialchars( intval( $topic->question_rating ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		</div>
		<div class='ipsColumn ipsColumn_fluid'>

CONTENT;

endif;
$return .= <<<CONTENT

<div class="ipsPageHeader ipsClearfix">
	
CONTENT;

if ( !$topic->isArchived() and !$topic->container()->password ):
$return .= <<<CONTENT

		<div class='ipsPos_right ipsResponsive_noFloat ipsResponsive_hidePhone'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'forums', 'topic', $topic->tid, $topic->followersCount() );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsPhotoPanel ipsPhotoPanel_small ipsPhotoPanel_notPhone ipsClearfix'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $topic->author(), 'small', $topic->warningRef() );
$return .= <<<CONTENT

		<div>
			<h1 class='ipsType_pageTitle ipsContained_container'>
				
CONTENT;

if ( $topic->mapped('pinned') || $topic->mapped('featured') || $topic->hidden() === -1 || $topic->hidden() === 1 ):
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->hidden() === -1 ):
$return .= <<<CONTENT

						<span><span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $topic->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
					
CONTENT;

elseif ( $topic->hidden() === 1 ):
$return .= <<<CONTENT

						<span><span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->mapped('pinned') ):
$return .= <<<CONTENT

						<span><span class="ipsBadge ipsBadge_icon ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->mapped('featured') ):
$return .= <<<CONTENT

						<span><span class="ipsBadge ipsBadge_icon ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></span></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT


				
CONTENT;

if ( $topic->prefix() OR ( $topic->canEdit() AND $topic::canTag( NULL, $topic->container() ) AND $topic::canPrefix( NULL, $topic->container() ) ) ):
$return .= <<<CONTENT

					<span 
CONTENT;

if ( !$topic->prefix() ):
$return .= <<<CONTENT
class='ipsHide'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( ( $topic->canEdit() AND $topic::canTag( NULL, $topic->container() ) AND $topic::canPrefix( NULL, $topic->container() ) ) ):
$return .= <<<CONTENT
data-editablePrefix
CONTENT;

endif;
$return .= <<<CONTENT
>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $topic->prefix( TRUE ), $topic->prefix() );
$return .= <<<CONTENT

					</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canEdit() ):
$return .= <<<CONTENT

					<div class='ipsType_break ipsContained' data-controller="core.front.core.moderation">
						<span 
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT
 itemprop="name"
CONTENT;

endif;
$return .= <<<CONTENT
 data-role="editableTitle" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'click_hold_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $topic->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<div class='ipsType_break ipsContained'>
						<span 
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT
 itemprop="name"
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $topic->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</h1>
			
CONTENT;

if ( $topic->locked() && $topic->topic_open_time && $topic->topic_open_time > time() ):
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_medium'><strong><i class='fa fa-clock-o'></i> 
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $topic->topic_open_time )->html(), \IPS\DateTime::ts( $topic->topic_open_time )->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_unlocks_at', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</strong></p>
			
CONTENT;

elseif ( !$topic->locked() && $topic->topic_close_time && $topic->topic_close_time > time() ):
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_medium'><strong><i class='fa fa-clock-o'></i> 
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $topic->topic_close_time )->html(), \IPS\DateTime::ts( $topic->topic_close_time )->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locks_at', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</strong></p>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<p class='ipsType_reset ipsType_blendLinks 
CONTENT;

if ( count( $topic->tags() ) OR ( $topic->canEdit() AND $topic::canTag( NULL, $topic->container() ) ) ):
$return .= <<<CONTENT
ipsSpacer_bottom ipsSpacer_half
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<span class='ipsType_normal'>
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

CONTENT;

$htmlsprintf = array($topic->author()->link( $topic->warningRef() )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_byline_no_date', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$htmlsprintf = array($topic->author()->link( $topic->warningRef() )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_started_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>, <span class='ipsType_light ipsType_noBreak'>
CONTENT;

$val = ( $topic->start_date instanceof \IPS\DateTime ) ? $topic->start_date : \IPS\DateTime::ts( $topic->start_date );$return .= $val->html();
$return .= <<<CONTENT
</span><br>
			</p>
			
CONTENT;

if ( count( $topic->tags() ) OR ( $topic->canEdit() AND $topic::canTag( NULL, $topic->container() ) ) ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $topic->tags(), FALSE, FALSE, ( $topic->canEdit() AND $topic::canTag( NULL, $topic->container() ) ) ? $topic->url() : NULL );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</div>


CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( $topic->hidden() === 1 and $topic->canUnhide() ):
$return .= <<<CONTENT

	<div class="ipsMessage ipsMessage_warning ipsSpacer_top">
		<p class="ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<ul class='ipsList_inline ipsSpacer_top'>
			<li><a href="
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_positive ipsButton_verySmall" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve_title_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class="fa fa-check"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

if ( $topic->canDelete() ):
$return .= <<<CONTENT

				<li><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_delete_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_negative ipsButton_verySmall'><i class='fa fa-times'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


<div class='ipsClearfix'>
	
CONTENT;

if ( $topic->container()->forum_allow_rating ):
$return .= <<<CONTENT

		<div class='ipsPad_half ipsPos_left ipsType_light ipsResponsive_hidePhone'>
			
CONTENT;

if ( $topic->canRate() ):
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_small'>
					
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rate_this_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rate_this_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

				</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

			{$topic->rating()}
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
	<ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsSpacer_both 
CONTENT;

if ( !$topic->canComment() and !( $topic->canPin() or $topic->canUnpin() or $topic->canFeature() or $topic->canUnfeature() or $topic->canHide() or $topic->canUnhide() or $topic->canMove() or $topic->canLock() or $topic->canUnlock() or $topic->canDelete() or $topic->availableSavedActions() ) ):
$return .= <<<CONTENT
ipsResponsive_hidePhone
CONTENT;

endif;
$return .= <<<CONTENT
">
		
CONTENT;

if ( $topic->canComment() ):
$return .= <<<CONTENT

			<li class='ipsToolList_primaryAction'>
				<span data-controller='forums.front.topic.reply'>
					
CONTENT;

if ( $topic->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

						<a href='#replyForm' class='ipsButton 
CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT
ipsButton_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_important
CONTENT;

endif;
$return .= <<<CONTENT
 ipsButton_medium ipsButton_fullWidth' data-action='replyToTopic'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answer_this_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT
 (
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'locked', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)
CONTENT;

endif;
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<a href='#replyForm' class='ipsButton 
CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT
ipsButton_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_important
CONTENT;

endif;
$return .= <<<CONTENT
 ipsButton_medium ipsButton_fullWidth' data-action='replyToTopic'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reply_to_this_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT
 (
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'locked', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)
CONTENT;

endif;
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</span>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $topic->container()->can('add') ):
$return .= <<<CONTENT

			<li class='ipsResponsive_hidePhone'>
				
CONTENT;

if ( $topic->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $topic->container()->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_link ipsButton_medium ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_a_question_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_a_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

else:
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $topic->container()->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_link ipsButton_medium ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $topic->canPin() or $topic->canUnpin() or $topic->canFeature() or $topic->canUnfeature() or $topic->canHide() or $topic->canUnhide() or $topic->canMove() or $topic->canLock() or $topic->canUnlock() or $topic->canDelete() or $topic->availableSavedActions() or $topic->canMerge() or $topic->canUnarchive() or \IPS\Member::loggedIn()->modPermission('can_view_moderation_log') ):
$return .= <<<CONTENT

			<li>
				<a href='#elTopicActions_menu' id='elTopicActions' class='ipsButton ipsButton_link ipsButton_medium ipsButton_fullWidth' data-ipsMenu>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderator_actions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
				<ul id='elTopicActions_menu' class='ipsMenu ipsMenu_auto ipsHide'>
					
CONTENT;

if ( $topic->canFeature() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'feature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canUnfeature() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unfeature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfeature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canPin() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'pin' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canUnpin() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unpin' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unpin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canHide() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'hide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

					
CONTENT;

if ( $topic->canUnhide() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

if ( $topic->hidden() === 1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canLock() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'lock' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canUnlock() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unlock' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canMove() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'move' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"  >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canMerge() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'merge' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canUnarchive() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'unarchive' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage="
CONTENT;
$return .= htmlspecialchars( $topic->unarchiveBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unarchive', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canDelete() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( !$topic->isArchived() and $topic->availableSavedActions() ):
$return .= <<<CONTENT

						<li class='ipsMenu_sep'><hr></li>
						
CONTENT;

foreach ( $topic->availableSavedActions() as $action ):
$return .= <<<CONTENT

							<li class="ipsMenu_item"><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'savedAction', 'action' => $action->_id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm>
CONTENT;
$return .= htmlspecialchars( $action->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_view_moderation_log') ):
$return .= <<<CONTENT
	
						<li class='ipsMenu_sep'><hr></li>
						<li class="ipsMenu_item"><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'modLog' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

	</ul>
</div>

CONTENT;

if ( $poll = $topic->getPoll() ):
$return .= <<<CONTENT

{$poll}
<br>

CONTENT;

endif;
$return .= <<<CONTENT

<div data-controller='core.front.core.commentFeed,forums.front.topic.view, core.front.core.ignoredComments' 
CONTENT;

if ( \IPS\Settings::i()->auto_polling_enabled ):
$return .= <<<CONTENT
data-autoPoll
CONTENT;

endif;
$return .= <<<CONTENT
 data-baseURL='
CONTENT;
$return .= htmlspecialchars( $topic->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $topic->isLastPage() and !$topic->isQuestion() ):
$return .= <<<CONTENT
data-lastPage
CONTENT;

endif;
$return .= <<<CONTENT
 data-feedID='topic-
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cTopic ipsClear ipsSpacer_top'>
	
CONTENT;

if ( $topic->isQuestion() && $question ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'question_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class='ipsAreaBackground_light ipsPad'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "topics", "forums" )->postContainer( $topic, $question, $votes, 'cPostQuestion' );
$return .= <<<CONTENT

		</div>
		
		<div class='ipsBox ipsSpacer_top'>
			<h2 class='ipsType_sectionTitle ipsType_reset ipsType_medium'><meta itemprop="answerCount" content="
CONTENT;

$return .= htmlspecialchars( $topic->posts - 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$pluralize = array( ( $topic->posts ) ? $topic->posts - 1 : 0 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answer_count', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
			<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
				<ul class="ipsPos_right ipsButtonRow ipsClearfix">
					<li>
						<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id="elSortBy_answers" 
CONTENT;

if ( !isset( \IPS\Request::i()->sortby ) ):
$return .= <<<CONTENT
class='ipsButtonRow_active
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by_answers', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
					<li>
						<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( 'sortby', 'date' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id="elSortBy_date" 
CONTENT;

if ( isset( \IPS\Request::i()->sortby ) and \IPS\Request::i()->sortby == 'date' ):
$return .= <<<CONTENT
class='ipsButtonRow_active
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by_date', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				</ul>
				
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

					{$pagination}
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset ipsType_medium' data-role="comment_count" data-commentCountString="js_num_topic_posts">
CONTENT;

$pluralize = array( $topic->posts ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reply_count', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
		
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

			<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
				{$pagination}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


	<div data-role='commentFeed' data-controller='core.front.core.moderation' class='ipsAreaBackground_light ipsPad'>
		<form action="
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( 'do', 'multimodComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-ipsPageAction data-role='moderationTools'>
			
CONTENT;

$postCount=0; $timeLastRead = $topic->timeLastRead(); $lined = FALSE;
$return .= <<<CONTENT

			
CONTENT;

if ( count( $comments ) ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $comments as $comment ):
$return .= <<<CONTENT

					
CONTENT;

if ( !$topic->isQuestion() and !$lined and $timeLastRead and $timeLastRead->getTimestamp() < $comment->mapped('date') ):
$return .= <<<CONTENT

						
CONTENT;

if ( $lined = TRUE and $postCount ):
$return .= <<<CONTENT

							<hr class="ipsCommentUnreadSeperator">
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

$postCount++;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "topics", "forums" )->postContainer( $topic, $comment, $votes );
$return .= <<<CONTENT

					
CONTENT;

if ( $postCount == 1 AND $advertisement = \IPS\core\Advertisement::loadByLocation( 'ad_topic_view' ) ):
$return .= <<<CONTENT

						{$advertisement}
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

					<p class='ipsType_center ipsType_light ipsType_large ipsPad' data-role="noComments">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_answers', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentMultimod( $topic );
$return .= <<<CONTENT

		</form>
	</div>

	
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			{$pagination}
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $topic->commentForm() || $topic->locked() || \IPS\Member::loggedIn()->restrict_post || \IPS\Member::loggedIn()->members_bitoptions['unacknowledged_warnings'] ):
$return .= <<<CONTENT

		<a id='replyForm'></a>
		<div data-role='replyArea' class='cTopicPostArea ipsBox ipsBox_transparent ipsAreaBackground ipsPad 
CONTENT;

if ( !$topic->canComment() ):
$return .= <<<CONTENT
cTopicPostArea_noSize
CONTENT;

endif;
$return .= <<<CONTENT
 ipsSpacer_top'>
			
CONTENT;

if ( $topic->commentForm() ):
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_warning ipsComposeArea_warning ipsSpacer_bottom ipsSpacer_half'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locked_can_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

elseif ( ( $topic->getPoll() and $topic->getPoll()->poll_only ) ):
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_warning ipsComposeArea_warning ipsSpacer_bottom ipsSpacer_half'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_poll_can_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				{$topic->commentForm()}
			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->commentUnavailable( 'topic_locked_cannot_comment' );
$return .= <<<CONTENT

				
CONTENT;

elseif ( \IPS\Member::loggedIn()->restrict_post ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->commentUnavailable( 'restricted_cannot_comment', \IPS\Member::loggedIn()->warnings(5,NULL,'rpa'), \IPS\Member::loggedIn()->restrict_post );
$return .= <<<CONTENT

				
CONTENT;

elseif ( \IPS\Member::loggedIn()->members_bitoptions['unacknowledged_warnings'] ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->commentUnavailable( 'unacknowledged_warning_cannot_post', \IPS\Member::loggedIn()->warnings( 1, FALSE ) );
$return .= <<<CONTENT

				
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

if ( !$topic->isArchived() and !$topic->container()->password ):
$return .= <<<CONTENT

		<div class='ipsResponsive_noFloat ipsResponsive_showPhone ipsResponsive_block ipsSpacer_top'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'forums', 'topic', $topic->tid, $topic->followersCount() );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>


CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( $topic->canPin() or $topic->canUnpin() or $topic->canFeature() or $topic->canUnfeature() or $topic->canHide() or $topic->canUnhide() or $topic->canMove() or $topic->canLock() or $topic->canUnlock() or $topic->canDelete() or $topic->availableSavedActions() ):
$return .= <<<CONTENT

	<ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsSpacer_top ipsResponsive_hidePhone">
		<li>
			<a href='#elTopicActions_menu' id='elTopicActions' class='ipsButton ipsButton_link ipsButton_medium ipsButton_fullWidth' data-ipsMenu>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderator_actions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
			<ul id='elTopicActions_menu' class='ipsMenu ipsMenu_auto ipsHide'>
				
CONTENT;

if ( $topic->canFeature() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'feature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canUnfeature() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unfeature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfeature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canPin() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'pin' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canUnpin() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unpin' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unpin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canHide() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'hide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

				
CONTENT;

if ( $topic->canUnhide() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

if ( $topic->hidden() === 1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canLock() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'lock' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canUnlock() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unlock' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canMove() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'move' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"  >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canMerge() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'merge' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canUnarchive() ):
$return .= <<<CONTENT

					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'unarchive' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage="
CONTENT;
$return .= htmlspecialchars( $topic->unarchiveBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unarchive', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canDelete() ):
$return .= <<<CONTENT
				
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( !$topic->isArchived() and $topic->availableSavedActions() ):
$return .= <<<CONTENT

					<li class='ipsMenu_sep'><hr></li>
					
CONTENT;

foreach ( $topic->availableSavedActions() as $action ):
$return .= <<<CONTENT

						<li class="ipsMenu_item"><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'savedAction', 'action' => $action->_id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm>
CONTENT;
$return .= htmlspecialchars( $action->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_view_moderation_log') ):
$return .= <<<CONTENT
	
					<li class='ipsMenu_sep'><hr></li>
					<li class="ipsMenu_item"><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'modLog' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</li>
	</ul>

CONTENT;

endif;
$return .= <<<CONTENT


<div class='ipsGrid ipsGrid_collapsePhone ipsPager ipsClearfix ipsSpacer_top'>
	<div class="ipsGrid_span6 ipsType_left ipsPager_prev">
		<a href="
CONTENT;
$return .= htmlspecialchars( $topic->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($topic->container()->metaTitle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_forum', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" rel="up">
			<span class="ipsPager_type">
CONTENT;

if ( $topic->isQuestion()  ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_back_to_qa_forum', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_back_to_forum', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
			<span class="ipsPager_title ipsType_light ipsTruncate ipsTruncate_line">
CONTENT;

$val = "{$topic->container()->_title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		</a>
	</div>
	
CONTENT;

if ( $nextUnread !== NULL ):
$return .= <<<CONTENT

		<div class='ipsGrid_span6 ipsType_right ipsPager_next'>
			<a href="
CONTENT;
$return .= htmlspecialchars( $nextUnread->url()->setQueryString( array( 'do' => 'getNewComment' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_next_unread_question_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_next_unread_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
				<span class="ipsPager_type">
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_next_unread_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_next_unread', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
				<span class="ipsPager_title ipsType_light ipsTruncate ipsTruncate_line">
CONTENT;
$return .= htmlspecialchars( $nextUnread->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>


CONTENT;

if ( !$topic->container()->disable_sharelinks ):
$return .= <<<CONTENT

	<hr class='ipsHr'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sharelinks( $topic );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}