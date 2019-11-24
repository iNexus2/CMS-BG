<?php
namespace IPS\Theme\Cache;
class class_forums_front_index extends \IPS\Theme\Template
{
	public $cache_key = '60cdbefebbae65e26b7c525e6d11b996';
	function forumGridItem( $forum ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $forum->can('view') ):
$return .= <<<CONTENT


CONTENT;

$lastPost = $forum->lastPost();
$return .= <<<CONTENT

	<div class="ipsDataItem ipsGrid_span4 ipsAreaBackground_reset cForumGrid 
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
cForumGrid_unread ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix" data-forumID="
CONTENT;
$return .= htmlspecialchars( $forum->_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

		<div class='ipsPhotoPanel ipsPhotoPanel_mini ipsClearfix ipsPad ipsAreaBackground_light cForumGrid_forumInfo'>
			<span class='ipsPos_left'>
				
CONTENT;

if ( !$forum->redirect_on AND \IPS\forums\Topic::containerUnread( $forum ) AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'do', 'markRead' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action='markAsRead'>
				
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $forum->icon ):
$return .= <<<CONTENT

						<img src="
CONTENT;

$return .= \IPS\File::get( "forums_Icons", $forum->icon )->url;
$return .= <<<CONTENT
" class='cForumGrid_icon 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

if ( $forum->redirect_on ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_large cForumIcon_redirect 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<i class='fa fa-arrow-right'></i>
							</span>
						
CONTENT;

elseif ( $forum->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_large cForumIcon_answers 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<i class='fa fa-question'></i>
							</span>
						
CONTENT;

elseif ( $forum->password ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_large cForumIcon_password 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
								
CONTENT;

if ( $forum->loggedInMemberHasPasswordAccess() ):
$return .= <<<CONTENT

									<i class='fa fa-unlock'></i>
								
CONTENT;

else:
$return .= <<<CONTENT

									<i class='fa fa-lock'></i>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</span>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_large cForumIcon_normal 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<i class="fa fa-comments"></i>
							</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( !$forum->redirect_on AND \IPS\forums\Topic::containerUnread( $forum ) AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</span>
			<div>
				<h3 class='ipsType_reset ipsType_sectionHead ipsTruncate ipsTruncate_line cForumGrid_title'>
					
CONTENT;

if ( $forum->password && !$forum->loggedInMemberHasPasswordAccess() ):
$return .= <<<CONTENT

						<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'passForm', '1' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forum_requires_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</h3>
				
CONTENT;

if ( !$forum->redirect_on ):
$return .= <<<CONTENT

					
CONTENT;

$count = \IPS\forums\Topic::contentCount( $forum, TRUE );
$return .= <<<CONTENT

					<p class='ipsType_reset'>
CONTENT;

$pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'posts_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\forums\Topic::modPermission( 'unhide', NULL, $forum ) AND ( $forum->queued_topics OR $forum->queued_posts ) ):
$return .= <<<CONTENT

					<strong class='ipsType_warning ipsType_medium'>
						<i class='fa fa-warning'></i>
						
CONTENT;

if ( $forum->queued_topics ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'advanced_search_submitted' => 1, 'topic_type' => 'queued_topics' ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$pluralize = array( $forum->queued_topics ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_topics_badge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $forum->queued_topics, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'>0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						/
						
CONTENT;

if ( $forum->queued_posts ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'advanced_search_submitted' => 1, 'topic_type' => 'queued_posts' ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$pluralize = array( $forum->queued_posts ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_posts_badge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $forum->queued_posts, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'>0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</strong>					
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		
		<div class='ipsPad'>
			
CONTENT;

if ( $forum->description ):
$return .= <<<CONTENT

				<div class='ipsType_richText ipsType_normal'>{$forum->description}</div>
			
CONTENT;

endif;
$return .= <<<CONTENT


			
CONTENT;

if ( $forum->hasChildren() ):
$return .= <<<CONTENT

				<h4 class='ipsType_minorHeading ipsSpacer_top'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'subforums', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<ul class="ipsDataItem_subList ipsList_inline ipsClearfix">
					
CONTENT;

foreach ( $forum->children() as $subforum ):
$return .= <<<CONTENT

					<li class="
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $subforum ) ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
">
						<a href="
CONTENT;
$return .= htmlspecialchars( $subforum->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
                            
CONTENT;
$return .= htmlspecialchars( $subforum->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $subforum ) ):
$return .= <<<CONTENT

								<span class='ipsItemStatus ipsItemStatus_tiny 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $subforum ) && !$subforum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
									<i class="fa fa-circle"></i>
								</span>
							
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

endif;
$return .= <<<CONTENT

		</div>

		<div class='cForumGrid_info'>
			<hr class='ipsHr'>

			
CONTENT;

if ( !$forum->redirect_on ):
$return .= <<<CONTENT

				
CONTENT;

if ( $lastPost ):
$return .= <<<CONTENT

					<div class='ipsPhotoPanel ipsPhotoPanel_tiny'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $lastPost['author'], 'tiny' );
$return .= <<<CONTENT

						<div>
							<ul class='ipsList_reset'>
								<li><a href="
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_url']->setQueryString( 'do', 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsType_break' title='
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $lastPost['topic_title'] ), '0', "30" ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $lastPost['topic_title'] ) ) > "30" ) ? '&hellip;' : '' );
$return .= <<<CONTENT
</a></li>
								<li class='ipsType_light ipsTruncate ipsTruncate_line'>
CONTENT;

$htmlsprintf = array($lastPost['author']->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
, <a href='
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_url']->setQueryString( 'do', 'getLastComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_last_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

$val = ( $lastPost['date'] instanceof \IPS\DateTime ) ? $lastPost['date'] : \IPS\DateTime::ts( $lastPost['date'] );$return .= $val->html();
$return .= <<<CONTENT
</a></li>
							</ul>
						</div>
					</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<p class='ipsType_light ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

if ( $forum->password ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_forum_posts_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_forum_posts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_light ipsType_reset ipsTruncate ipsTruncate_line'>
					
CONTENT;

$pluralize = array( $forum->redirect_hits ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'redirect_hits', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

				</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function forumRow( $forum, $isSubForum=FALSE, $table=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $forum->can('view') ):
$return .= <<<CONTENT


CONTENT;

$lastPost = $forum->lastPost();
$return .= <<<CONTENT

	<li class="ipsDataItem ipsDataItem_responsivePhoto 
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix" data-forumID="
CONTENT;
$return .= htmlspecialchars( $forum->_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<div class="ipsDataItem_icon ipsDataItem_category">
			
CONTENT;

if ( !$forum->redirect_on ):
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $forum ) AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
<a href="
CONTENT;

if ( $isSubForum ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'do' => 'markRead', 'return' => $forum->parent_id ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'do', 'markRead' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" data-action='markAsRead' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_forum_read', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $forum->icon ):
$return .= <<<CONTENT

					<img src="
CONTENT;

$return .= \IPS\File::get( "forums_Icons", $forum->icon )->url;
$return .= <<<CONTENT
" class='ipsItemStatus ipsItemStatus_custom 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

if ( $forum->redirect_on ):
$return .= <<<CONTENT

						<span class='ipsItemStatus ipsItemStatus_large cForumIcon_redirect 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<i class='fa fa-arrow-right'></i>
						</span>
					
CONTENT;

elseif ( $forum->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

						<span class='ipsItemStatus ipsItemStatus_large cForumIcon_answers 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<i class='fa fa-question'></i>
						</span>
					
CONTENT;

elseif ( $forum->password ):
$return .= <<<CONTENT

						<span class='ipsItemStatus ipsItemStatus_large cForumIcon_password 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
							
CONTENT;

if ( $forum->loggedInMemberHasPasswordAccess() ):
$return .= <<<CONTENT

								<i class='fa fa-unlock'></i>
							
CONTENT;

else:
$return .= <<<CONTENT

								<i class='fa fa-lock'></i>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</span>
					
CONTENT;

else:
$return .= <<<CONTENT

						<span class='ipsItemStatus ipsItemStatus_large cForumIcon_normal 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<i class="fa fa-comments"></i>
						</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !$forum->redirect_on and \IPS\forums\Topic::containerUnread( $forum ) AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

			</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class="ipsDataItem_main">
			<h4 class="ipsDataItem_title ipsType_large ipsType_break">
				
CONTENT;

if ( $forum->password && !$forum->loggedInMemberHasPasswordAccess() ):
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'passForm', '1' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forum_requires_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				
CONTENT;

else:
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $forum->redirect_on ):
$return .= <<<CONTENT

					&nbsp;&nbsp;<span class='ipsType_light ipsType_medium'>(
CONTENT;

$pluralize = array( $forum->redirect_hits ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'redirect_hits', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
)</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</h4>
			
CONTENT;

if ( $forum->hasChildren() ):
$return .= <<<CONTENT

				<ul class="ipsDataItem_subList ipsList_inline 
CONTENT;

if ( $forum->description ):
$return .= <<<CONTENT
withBorder
CONTENT;

endif;
$return .= <<<CONTENT
">
					
CONTENT;

foreach ( $forum->children() as $subforum ):
$return .= <<<CONTENT

						<li class="
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $subforum ) ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
">
							<a href="
CONTENT;
$return .= htmlspecialchars( $subforum->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><i class="fa fa-arrow-circle-o-right"></i> 
CONTENT;
$return .= htmlspecialchars( $subforum->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $forum->description ):
$return .= <<<CONTENT

				<div class="ipsDataItem_meta ipsType_richText">{$forum->description}</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		
CONTENT;

if ( !$forum->redirect_on ):
$return .= <<<CONTENT

			<div class="ipsDataItem_stats ipsDataItem_statsLarge">
				
CONTENT;

if ( $lastPost ):
$return .= <<<CONTENT

					<dl>
						
CONTENT;

$count = \IPS\forums\Topic::contentCount( $forum, TRUE );
$return .= <<<CONTENT

						<dt class="ipsDataItem_stats_number">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $count );
$return .= <<<CONTENT
</dt>
						<dd class="ipsDataItem_stats_type ipsType_light">
CONTENT;

$pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'posts_no_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</dd>
					</dl>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\forums\Topic::modPermission( 'unhide', NULL, $forum ) AND $unapprovedContent = $forum->unapprovedContentRecursive() and ( $unapprovedContent['topics'] OR $unapprovedContent['posts'] ) ):
$return .= <<<CONTENT

					<strong class='ipsType_warning ipsType_medium'>
						<i class='fa fa-warning'></i>
						
CONTENT;

if ( $unapprovedContent['topics'] ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'advanced_search_submitted' => 1, 'topic_type' => 'queued_topics' ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$pluralize = array( $unapprovedContent['topics'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_topics_badge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $unapprovedContent['topics'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'>0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						/
						
CONTENT;

if ( $unapprovedContent['posts'] ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'advanced_search_submitted' => 1, 'topic_type' => 'queued_posts' ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$pluralize = array( $unapprovedContent['posts'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_posts_badge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $unapprovedContent['posts'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'>0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</strong>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<ul class="ipsDataItem_lastPoster ipsDataItem_withPhoto">
				
CONTENT;

if ( $lastPost ):
$return .= <<<CONTENT

					<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $lastPost['author'], 'tiny' );
$return .= <<<CONTENT
</li>
					
CONTENT;

if ( $lastPost['topic_title'] ):
$return .= <<<CONTENT
<li><a href="
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_url']->setQueryString( 'do', 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $lastPost['topic_title'] ), '0', "26" ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $lastPost['topic_title'] ) ) > "26" ) ? '&hellip;' : '' );
$return .= <<<CONTENT
</a></li>
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsType_blendLinks'>
CONTENT;

$htmlsprintf = array($lastPost['author']->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</li>
					
CONTENT;

if ( $lastPost['topic_title'] ):
$return .= <<<CONTENT

						<li class="ipsType_light"><a href='
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_url']->setQueryString( 'do', 'getLastComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_last_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

$val = ( $lastPost['date'] instanceof \IPS\DateTime ) ? $lastPost['date'] : \IPS\DateTime::ts( $lastPost['date'] );$return .= $val->html();
$return .= <<<CONTENT
</a></li>
					
CONTENT;

else:
$return .= <<<CONTENT

						<li class="ipsType_light">
CONTENT;

$val = ( $lastPost['date'] instanceof \IPS\DateTime ) ? $lastPost['date'] : \IPS\DateTime::ts( $lastPost['date'] );$return .= $val->html();
$return .= <<<CONTENT
</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					<li class='ipsType_light ipsResponsive_showDesktop'>
CONTENT;

if ( $forum->password ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_forum_posts_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_forum_posts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>	
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $table and $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $forum->_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $forum ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state=''>
					<span></span>
				</span>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</li>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function forumTableRow( $table, $headers, $forums ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $forums as $forum ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumRow( $forum, FALSE, $table );
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function index(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('forums') );
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	<ul class="ipsToolList ipsToolList_horizontal ipsResponsive_hideDesktop ipsResponsive_block ipsClearfix">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->indexButtons(  );
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT


<section>
	<ol class='ipsList_reset cForumList' data-controller='core.global.core.table, forums.front.forum.forumList' data-baseURL=''>
		
CONTENT;

foreach ( \IPS\forums\Forum::roots() as $category ):
$return .= <<<CONTENT

			
CONTENT;

if ( $category->can('view') && $category->hasChildren() ):
$return .= <<<CONTENT

			<li data-categoryID='
CONTENT;
$return .= htmlspecialchars( $category->_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cForumRow ipsBox ipsSpacer_bottom' cat-title="
CONTENT;
$return .= htmlspecialchars( $category->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				<h2 class="ipsType_sectionTitle ipsType_reset cForumTitle">
					<a href='#' class='ipsPos_right ipsJS_show ipsType_noUnderline cForumToggle' data-action='toggleCategory' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'toggle_this_category', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></a>
					<a href='
CONTENT;
$return .= htmlspecialchars( $category->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $category->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				</h2>
				
CONTENT;

if ( \IPS\Theme::i()->settings['forum_layout'] === 'grid' ):
$return .= <<<CONTENT

					<div class='ipsAreaBackground ipsPad' data-role="forums">
						<div class='ipsGrid ipsGrid_collapsePhone' data-ipsGrid data-ipsGrid-minItemSize='250' data-ipsGrid-maxItemSize='500' data-ipsGrid-equalHeights='row'>
							
CONTENT;

foreach ( $category->children() as $forum ):
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumGridItem( $forum );
$return .= <<<CONTENT

							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</div>
					</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<ol class="ipsDataList ipsDataList_large ipsDataList_zebra ipsAreaBackground_reset" data-role="forums">
						
CONTENT;

foreach ( $category->children() as $forum ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumRow( $forum );
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ol>
				
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

	</ol>
</section>
CONTENT;

		return $return;
}

	function indexButtons(  ) {
		$return = '';
		$return .= <<<CONTENT


<li>
	<a class="ipsButton ipsButton_large ipsButton_important ipsButton_fullWidth" href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=forums&module=forums&controller=forums&do=add", null, "", array(), 0 ) );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_forum', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</li>
CONTENT;

		return $return;
}}