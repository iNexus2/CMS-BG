<?php
namespace IPS\Theme\Cache;
class class_core_front_statuses extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function statusContainer( $status, $authorData=NULL, $profileOwnerData=NULL, $condensed=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<li 
CONTENT;

if ( !$condensed ):
$return .= <<<CONTENT
data-controller='core.front.statuses.status'
CONTENT;

endif;
$return .= <<<CONTENT
 class='ipsStreamItem ipsStreamItem_contentBlock 
CONTENT;

if ( $condensed ):
$return .= <<<CONTENT
ipsStreamItem_condensed
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $status->hidden() ):
$return .= <<<CONTENT
 ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
 ipsAreaBackground_reset ipsPad' data-timestamp='
CONTENT;
$return .= htmlspecialchars( $status->date, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='activityItem' data-statusid="
CONTENT;
$return .= htmlspecialchars( $status->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<a id='status-
CONTENT;
$return .= htmlspecialchars( $status->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></a>
	<div class='ipsStreamItem_container'>
		<div class='ipsStreamItem_header ipsPhotoPanel ipsPhotoPanel_mini'>
			<span class='ipsStreamItem_contentType' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_update', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-user'></i></span>
			
CONTENT;

if ( $authorData ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhotoFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'], \IPS\Member::photoUrl( $authorData ), ( $condensed ? 'tiny' : 'mini' ) );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $status->author(), ( $condensed ? 'tiny' : 'mini' ) );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<div>
				<h2 class='ipsType_reset ipsStreamItem_title 
CONTENT;

if ( $condensed ):
$return .= <<<CONTENT
ipsStreamItem_titleSmall
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_break'>
					
CONTENT;

if ( $status->member_id != $status->author()->member_id ):
$return .= <<<CONTENT

						<ul class='ipsList_inline ipsList_noSpacing'>
							<li>
								<strong>
									
CONTENT;

if ( $authorData ):
$return .= <<<CONTENT

										
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLinkFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'] );
$return .= <<<CONTENT

									
CONTENT;

else:
$return .= <<<CONTENT

										
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->userLink( $status->author() );
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

								</strong>
							</li>
							<li>
								&nbsp;<i class='fa fa-angle-right'></i>&nbsp;
							</li>
							<li>
								<strong>
									
CONTENT;

if ( $profileOwnerData ):
$return .= <<<CONTENT

										
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLinkFromData( $profileOwnerData['member_id'], $profileOwnerData['name'], $profileOwnerData['members_seo_name'] );
$return .= <<<CONTENT

									
CONTENT;

else:
$return .= <<<CONTENT

										
CONTENT;

$return .= \IPS\Member::load( $status->member_id )->link();
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

								</strong>
							</li>
						</ul>
					
CONTENT;

else:
$return .= <<<CONTENT

						<strong>
							
CONTENT;

if ( $authorData ):
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLinkFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'] );
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->userLink( $status->author() );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $status->hidden() ):
$return .= <<<CONTENT

						<span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hidden', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</h2>
				
CONTENT;

if ( $condensed ):
$return .= <<<CONTENT

					<ul class='ipsList_inline ipsStreamItem_stats ipsType_light'>
						<li>
							<a href='
CONTENT;
$return .= htmlspecialchars( $status->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $status->date instanceof \IPS\DateTime ) ? $status->date : \IPS\DateTime::ts( $status->date );$return .= $val->html();
$return .= <<<CONTENT
</a>
						</li>
					</ul>
					<p class="ipsStreamItem_status ipsType_reset">
						
CONTENT;

if ( $status->member_id == $status->author()->member_id ):
$return .= <<<CONTENT

							
CONTENT;

if ( $authorData ):
$return .= <<<CONTENT

								
CONTENT;

$htmlsprintf = array($authorData['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_posted_status_self', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

$htmlsprintf = array($status->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_posted_status_self', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

if ( $authorData ):
$return .= <<<CONTENT

								
CONTENT;

$htmlsprintf = array($authorData['name'], $profileOwnerData['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_posted_status_other', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

$htmlsprintf = array($status->author()->name, \IPS\Member::load( $status->member_id )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_posted_status_other', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		
CONTENT;

if ( !$condensed ):
$return .= <<<CONTENT

			<div class='ipsStreamItem_snippet'>
				<div class='ipsType_richText ipsType_normal ipsContained'>{$status->content}</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( !$condensed ):
$return .= <<<CONTENT

			<ul class='ipsList_inline ipsStreamItem_meta ipsFaded_withHover'>
				<li class='ipsType_medium'>
CONTENT;

if ( $status->locked() ):
$return .= <<<CONTENT
<i class='fa fa-lock'></i>
CONTENT;

endif;
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $status->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'><span class='ipsType_light'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $status->date instanceof \IPS\DateTime ) ? $status->date : \IPS\DateTime::ts( $status->date );$return .= $val->html();
$return .= <<<CONTENT
</span></a></li>
				
CONTENT;

if ( $status instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled and ( $status->reputation() or ( $status->canGiveReputation( 1 ) or $status->canGiveReputation( -1 ) ) ) ):
$return .= <<<CONTENT

					<li class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationMini( $status->reputation(), $status->canGiveReputation( 1 ), $status->canGiveReputation( -1 ), $status->url('showRep'), $status->url('rep') );
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $status->canDelete() || $status->canLock() || $status->canUnlock() || $status->canHide() || $status->canUnhide() ):
$return .= <<<CONTENT

					<li>
						<a href='#elStatus_
CONTENT;
$return .= htmlspecialchars( $status->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu data-ipsMenu-activeClass='ipsFaded_cancel' id='elStatus_
CONTENT;
$return .= htmlspecialchars( $status->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsFaded ipsFaded_more'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
						<ul class='ipsMenu ipsMenu_narrow ipsHide' id='elStatus_
CONTENT;
$return .= htmlspecialchars( $status->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
							
CONTENT;

if ( !$status->locked() and $status->canLock() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href="
CONTENT;
$return .= htmlspecialchars( $status->url('moderate')->setQueryString( 'action', 'lock' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

elseif ( $status->locked() and $status->canUnlock() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href="
CONTENT;
$return .= htmlspecialchars( $status->url('moderate')->setQueryString( 'action', 'unlock' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( !$status->hidden() and $status->canHide() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $status->url('moderate')->setQueryString( 'action', 'hide' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

elseif ( $status->hidden() and $status->canUnhide() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $status->url('moderate')->setQueryString( 'action', 'unhide' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $status->canDelete() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a data-confirm href="
CONTENT;
$return .= htmlspecialchars( $status->url('moderate')->setQueryString( 'action', 'delete' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
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

if ( !\IPS\Member::loggedIn()->group['gbw_no_report'] and !$status->hidden() ):
$return .= <<<CONTENT

					<li><a href='
CONTENT;
$return .= htmlspecialchars( $status->url('report'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-action='reportStatus' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsFaded ipsFaded_more'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT
	
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( !$condensed && ( count( $status->comments() ) ||  $status->canComment() ) ):
$return .= <<<CONTENT

			<div class='ipsComment_feed ipsComment_subComments ipsType_medium'>
				<ol class="ipsList_reset" data-role='statusComments' data-currentPage='
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->page ? intval( \IPS\Request::i()->page ) : 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "statuses", \IPS\Request::i()->app )->statusReplies( $status );
$return .= <<<CONTENT

				</ol>
				
CONTENT;

if ( \IPS\core\Statuses\Status::canCreateReply( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

					<div class="ipsComment ipsFieldRow_fullWidth ipsAreaBackground_light ipsPad" data-role="replyComment">
						<div class="ipsComment_content ipsContained">
							{$status->commentForm()}
						</div>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT
	
	</div>
</li>
CONTENT;

		return $return;
}

	function statusContentRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $status ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "statuses", "core" )->statusContainer( $status );
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function statusPagination( $baseUrl, $pages, $comments, $activePage=1, $perPage=3, $direction='prev' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $pages > 1 ):
$return .= <<<CONTENT

	
CONTENT;

if ( $direction == 'prev' && $activePage != $pages && !( $activePage > $pages ) ):
$return .= <<<CONTENT

		<li class="ipsComment ipsClearfix ipsAreaBackground_light cStatusUpdates_pagination">
			<a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( 'page', $activePage + 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="loadPreviousComments"><i class="fa fa-angle-up"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_prev_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<span class="ipsType_light">
CONTENT;

$pluralize = array( $comments - ( $activePage * $perPage ) ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_more', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span></a>
		</li>
	
CONTENT;

elseif ( $direction == 'next' && $activePage > 1 ):
$return .= <<<CONTENT

		<li class="ipsComment ipsClearfix ipsAreaBackground_light cStatusUpdates_pagination">
			<a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( 'page', $activePage - 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="loadNextComments"><i class="fa fa-angle-down"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_next_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<span class="ipsType_light">
CONTENT;

$pluralize = array( ( $activePage - 1 ) * $perPage ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_more', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span></a>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function statusReplies( $status ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $status->commentPageCount() > 1 ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "statuses", "core", 'front' )->statusPagination( $status->url(), $status->commentPageCount(), $status->commentCount(), \IPS\Request::i()->page ? intval( \IPS\Request::i()->page ) : 1, \IPS\core\Statuses\Status::getCommentsPerPage(), 'prev' );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

foreach ( $status->commentsForDisplay() as $comment ):
$return .= <<<CONTENT

	{$comment->html()}

CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() and $status->commentPageCount() > 1 ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "statuses", "core", 'front' )->statusPagination( $status->url(), $status->commentPageCount(), $status->commentCount(), \IPS\Request::i()->page ? intval( \IPS\Request::i()->page ) : 1, \IPS\core\Statuses\Status::getCommentsPerPage(), 'next' );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function statusReply( $status, $comment ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsComment_content ipsFaded_withHover" data-controller="core.front.core.comment">
	<p class="ipsComment_author ipsType_normal" itemprop="creator" itemscope="" itemtype="http://schema.org/Person">
		<strong>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->userLink( $comment->author() );
$return .= <<<CONTENT
</strong>
		
CONTENT;

if ( $comment->hidden() ):
$return .= <<<CONTENT

			<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hidden', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</p>
	<div data-role="commentContent" class='ipsType_richText ipsType_medium ipsContained' data-controller='core.front.core.lightboxedImages'>
		{$comment->content}
	</div>
	<ul class="ipsList_inline ipsType_medium cStatusTools">
		<li class="ipsType_light"><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

$val = ( $comment->date instanceof \IPS\DateTime ) ? $comment->date : \IPS\DateTime::ts( $comment->date );$return .= $val->html();
$return .= <<<CONTENT
</a></li>
		
CONTENT;

if ( $comment instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled and ( $comment->reputation() or ( $comment->canGiveReputation( 1 ) or $comment->canGiveReputation( -1 ) ) ) ):
$return .= <<<CONTENT

			<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationMini( $comment->reputation(), $comment->canGiveReputation( 1 ), $comment->canGiveReputation( -1 ), $comment->url('showRep'), $comment->url('rep') );
$return .= <<<CONTENT
</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $comment->canDelete() || ( $comment instanceof \IPS\Content\Hideable && ( !$comment->hidden() and $comment->canHide() ) || ( $comment->hidden() and $comment->canUnhide() ) )  ):
$return .= <<<CONTENT

			<li>
				<a href='#elComment_
CONTENT;
$return .= htmlspecialchars( $comment->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elComment_
CONTENT;
$return .= htmlspecialchars( $comment->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-activeClass='ipsFaded_cancel' class='ipsFaded ipsFaded_more'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
				<ul class='ipsMenu ipsMenu_narrow ipsHide' id='elComment_
CONTENT;
$return .= htmlspecialchars( $comment->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
					
CONTENT;

if ( $comment instanceof \IPS\Content\Hideable ):
$return .= <<<CONTENT

						
CONTENT;

if ( !$comment->hidden() and $comment->canHide() ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('moderate')->setQueryString( 'action', 'hide' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

elseif ( $comment->hidden() and $comment->canUnhide() ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('moderate')->setQueryString( 'action', 'unhide' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $comment->canDelete() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a data-confirm href='
CONTENT;
$return .= htmlspecialchars( $comment->url('moderate')->setQueryString( 'action', 'delete' )->csrf()->setQueryString('page',\IPS\Request::i()->page), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $comment instanceof \IPS\Content\ReportCenter and !\IPS\Member::loggedIn()->group['gbw_no_report'] and !$comment->hidden()  ):
$return .= <<<CONTENT

			<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('report'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-action='reportComment' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsFaded ipsFaded_more'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>
</div>
CONTENT;

		return $return;
}

	function statusReplyContainer( $status, $comment ) {
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

	<li class='ipsComment ipsComment_ignored ipsPad_half ipsType_light' id='elIgnoreComment_
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

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_ignoring', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	</li>

CONTENT;

endif;
$return .= <<<CONTENT
	
<li class="ipsComment ipsAreaBackground_light ipsClearfix
CONTENT;

if ( $comment->hidden() ):
$return .= <<<CONTENT
 ipsModerated
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
" data-commentid="
CONTENT;
$return .= htmlspecialchars( $comment->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" itemscope itemtype="http://schema.org/Comment">
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'tiny' );
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "statuses", "core" )->statusReply( $status, $comment );
$return .= <<<CONTENT

</li>
CONTENT;

		return $return;
}

	function statusReplyContentRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $reply ):
$return .= <<<CONTENT

	
CONTENT;

$item = $reply->item();
$return .= <<<CONTENT

	<li data-controller='core.front.statuses.status' class='ipsStreamItem ipsStreamItem_contentBlock 
CONTENT;

if ( $item->hidden() ):
$return .= <<<CONTENT
 ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
 ipsAreaBackground_reset ipsPad' data-timestamp='
CONTENT;
$return .= htmlspecialchars( $item->date, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='activityItem' data-statusid="
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<a id='status-
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></a>
		<div class='ipsStreamItem_container'>
			<div class='ipsStreamItem_header ipsPhotoPanel ipsPhotoPanel_mini'>
				<span class='ipsStreamItem_contentType' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_update', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-user'></i></span>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $item->author(), 'mini' );
$return .= <<<CONTENT

				<div>
					<h2 class='ipsType_reset ipsStreamItem_title ipsType_break'>
						<strong>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->userLink( $item->author() );
$return .= <<<CONTENT
</strong>
CONTENT;

if ( $item->member_id != $item->author()->member_id ):
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-angle-right'></i>&nbsp; <strong>
CONTENT;

$return .= \IPS\Member::load( $item->member_id )->link();
$return .= <<<CONTENT
</strong>
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $item->hidden() ):
$return .= <<<CONTENT

							<span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hidden', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</h2>
				</div>
			</div>
			<div class='ipsStreamItem_snippet'>
				<div class='ipsType_richText ipsType_normal ipsContained'>{$item->content}</div>
			</div>
			<ul class='ipsList_inline ipsStreamItem_meta ipsFaded_withHover'>
				<li class='ipsType_medium'>
CONTENT;

if ( $item->locked() ):
$return .= <<<CONTENT
<i class='fa fa-lock'></i>
CONTENT;

endif;
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'><span class='ipsType_light'>
CONTENT;

$val = ( $item->date instanceof \IPS\DateTime ) ? $item->date : \IPS\DateTime::ts( $item->date );$return .= $val->html();
$return .= <<<CONTENT
</span></a></li>
				
CONTENT;

if ( $item instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled and ( $item->reputation() or ( $item->canGiveReputation( 1 ) or $item->canGiveReputation( -1 ) ) ) ):
$return .= <<<CONTENT

					<li class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationMini( $item->reputation(), $item->canGiveReputation( 1 ), $item->canGiveReputation( -1 ), $item->url('showRep'), $item->url('rep') );
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $item->canDelete() || $item->canLock() || $item->canUnlock() || $item->canHide() || $item->canUnhide() ):
$return .= <<<CONTENT

					<li>
						<a href='#elStatus_
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu data-ipsMenu-activeClass='ipsFaded_cancel' id='elStatus_
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsFaded ipsFaded_more'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
						<ul class='ipsMenu ipsMenu_narrow ipsHide' id='elStatus_
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
							
CONTENT;

if ( !$item->locked() and $item->canLock() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href="
CONTENT;
$return .= htmlspecialchars( $item->url('moderate')->setQueryString( 'action', 'lock' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

elseif ( $item->locked() and $item->canUnlock() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href="
CONTENT;
$return .= htmlspecialchars( $item->url('moderate')->setQueryString( 'action', 'unlock' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( !$item->hidden() and $item->canHide() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $item->url('moderate')->setQueryString( 'action', 'hide' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

elseif ( $item->hidden() and $item->canUnhide() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $item->url('moderate')->setQueryString( 'action', 'unhide' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $item->canDelete() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a data-confirm href="
CONTENT;
$return .= htmlspecialchars( $item->url('moderate')->setQueryString( 'action', 'delete' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
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

if ( !\IPS\Member::loggedIn()->group['gbw_no_report'] and !$item->hidden() ):
$return .= <<<CONTENT

					<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->url('report'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-action='reportStatus' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsFaded ipsFaded_more'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT
	
			</ul>

			
CONTENT;

if ( !$item->hidden() && ( count( $item->comments() ) ||  \IPS\core\Statuses\Status::canCreate( \IPS\Member::loggedIn() ) )  ):
$return .= <<<CONTENT

				<div class='ipsComment_feed ipsComment_subComments ipsType_medium'>
					<ol class="ipsList_reset" data-role='statusComments' data-currentPage='
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->page ? intval( \IPS\Request::i()->page ) : 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "statuses", \IPS\Request::i()->app )->statusReplyContainer( $item, $reply );
$return .= <<<CONTENT

						
CONTENT;

if ( ( $item->mapped('num_comments') - 1 ) > 0 ):
$return .= <<<CONTENT

							<li class='ipsComment ipsAreaBackground_light ipsPad_half ipsType_light'>
								<p class='ipsType_reset ipsType_medium ipsComment_content'><a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$pluralize = array( ( $item->mapped('num_comments') - 1 ) ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_see_x_other_replies', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</a></p>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ol>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT
	
		</div>
	</li>


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function statusRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT

<div data-role='commentFeed' class='
CONTENT;

if ( \IPS\Request::i()->do == 'content' ):
$return .= <<<CONTENT
cStatusUpdates ipsPad
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<ol class='ipsType_normal ipsList_reset'>
		
CONTENT;

foreach ( $rows as $status ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "statuses", "core" )->statusContainer( $status );
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ol>
</div>
CONTENT;

		return $return;
}}