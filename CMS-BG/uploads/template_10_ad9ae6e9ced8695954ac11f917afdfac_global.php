<?php
namespace IPS\Theme\Cache;
class class_forums_front_global extends \IPS\Theme\Template
{
	public $cache_key = '82e238fb5d63057039aeae7a06229de6';
	function commentTableHeader( $comment, $topic ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$iposted = $topic->container()->contentPostedIn();
$return .= <<<CONTENT


CONTENT;

$idField = $topic::$databaseColumnId;
$return .= <<<CONTENT

<div>
	<h3 class='ipsType_sectionHead ipsContained_container'>
		
CONTENT;

if ( $topic->unread() ):
$return .= <<<CONTENT

			<span>
				<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url( 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
					<span class='ipsItemStatus'><i class="fa 
CONTENT;

if ( in_array( $topic->$idField, $iposted ) ):
$return .= <<<CONTENT
fa-star
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
"></i></span>
				</a>
			</span>
		
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

if ( in_array( $topic->$idField, $iposted ) ):
$return .= <<<CONTENT

				<span><span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span></span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsType_break ipsContained'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $comment->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$sprintf = array($topic->title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' class='ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $topic->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
		</div>
		
CONTENT;

if ( $topic->container()->allow_rating ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->rating( 'large', $topic->rating_hits ? ( $topic->rating_total / $topic->rating_hits ) : 0 );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</h3>
	<p class='ipsType_normal ipsType_light ipsType_blendLinks ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $topic->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $topic->container()->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></p>
</div>
CONTENT;

		return $return;
}

	function manageFollowNodeRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$contentItemClass = $row::$contentItemClass;
$return .= <<<CONTENT

	<li class="ipsDataItem 
CONTENT;

if ( method_exists( $row, 'tableClass' ) && $row->tableClass() ):
$return .= <<<CONTENT
ipsDataItem_
CONTENT;
$return .= htmlspecialchars( $row->tableClass(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" data-controller='core.front.system.manageFollowed' data-followID='
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_area'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
-
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_rel_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<div class='ipsDataItem_main'>
			<h4 class='ipsDataItem_title'>
				
CONTENT;

if ( $row->_locked ):
$return .= <<<CONTENT

					<i class="fa fa-lock"></i>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
				<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					
CONTENT;
$return .= htmlspecialchars( $row->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</h4>
			<ul class='ipsList_inline ipsType_light'>
				
CONTENT;

$count = \IPS\forums\Topic::contentCount( $row, TRUE );
$return .= <<<CONTENT

				<li>
CONTENT;

$pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'posts_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
			</ul>
		</div>
		
		<div class='ipsDataItem_generic ipsDataItem_size1 ipsType_center ipsType_large'>
			<span class='ipsBadge ipsBadge_icon ipsBadge_new 
CONTENT;

if ( !$row->_followData['follow_is_anon'] ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='followAnonymous' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_is_anon', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
		</div>

		<div class='ipsDataItem_generic ipsDataItem_size6'>
			<ul class='ipsList_reset'>
				<li title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_when', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-role='followDate'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $row->_followData['follow_added'] instanceof \IPS\DateTime ) ? $row->_followData['follow_added'] : \IPS\DateTime::ts( $row->_followData['follow_added'] );$return .= $val->html();
$return .= <<<CONTENT
</li>
				<li title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_how', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-role='followFrequency'>
					
CONTENT;

if ( $row->_followData['follow_notify_freq'] == 'none' ):
$return .= <<<CONTENT

						<i class='fa fa-bell-slash-o'></i>
					
CONTENT;

else:
$return .= <<<CONTENT

						<i class='fa fa-bell'></i>
					
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

$val = "follow_freq_{$row->_followData['follow_notify_freq']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</li>
			</ul>
		</div>

		<div class='ipsDataItem_generic ipsDataItem_size6 ipsType_center'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core" )->manageFollow( $row->_followData['follow_app'], $row->_followData['follow_area'], $row->_followData['follow_rel_id'] );
$return .= <<<CONTENT

		</div>

		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function row( $table, $headers, $topic, $showReadMarkers=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $topic::$databaseColumnId;
$return .= <<<CONTENT


CONTENT;

$iPosted = isset( $table->contentPostedIn ) ? $table->contentPostedIn : ( $table AND method_exists( $table, 'container' ) AND $topic->container() !== NULL ) ? $topic->container()->contentPostedIn() : array();
$return .= <<<CONTENT

<li class="ipsDataItem ipsDataItem_responsivePhoto 
CONTENT;

if ( $topic->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( method_exists( $topic, 'tableClass' ) && $topic->tableClass() ):
$return .= <<<CONTENT
ipsDataItem_
CONTENT;
$return .= htmlspecialchars( $topic->tableClass(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $topic->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
">
	
CONTENT;

if ( $showReadMarkers ):
$return .= <<<CONTENT

		
CONTENT;

if ( $topic->unread() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_icon ipsPos_top'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url( 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
					<span class='ipsItemStatus'><i class="fa 
CONTENT;

if ( in_array( $topic->$idField, $iPosted ) ):
$return .= <<<CONTENT
fa-star
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
"></i></span>
				</a>
			</div>
		
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

if ( in_array( $topic->$idField, $iPosted ) ):
$return .= <<<CONTENT

				<div class='ipsDataItem_icon ipsPos_top'>
					<span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span>
				</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsDataItem_icon ipsPos_top'>&nbsp;</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsDataItem_main'>
		<h4 class='ipsDataItem_title ipsContained_container'>
			
CONTENT;

if ( $topic->mapped('pinned') || $topic->mapped('featured') || $topic->hidden() === -1 || $topic->hidden() === 1 ):
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->hidden() === -1 ):
$return .= <<<CONTENT

					<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $topic->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
				
CONTENT;

elseif ( $topic->hidden() === 1 ):
$return .= <<<CONTENT

					<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
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

					<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
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

					<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
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

			
			<div class='ipsType_break ipsContained'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $topic->canView() ):
$return .= <<<CONTENT
data-ipsHover data-ipsHover-target='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString('preview', 1), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsHover-timeout='1.5' 
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

						<strong class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'question_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
:</strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;
$return .= htmlspecialchars( $topic->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>

				
CONTENT;

if ( $topic->commentPageCount() > 1 ):
$return .= <<<CONTENT

					{$topic->commentPagination( array(), 'miniPagination' )}
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</h4>
		
		<p class='ipsType_reset ipsType_medium ipsType_light'>
			
CONTENT;

$htmlsprintf = array($topic->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $topic->mapped('date') instanceof \IPS\DateTime ) ? $topic->mapped('date') : \IPS\DateTime::ts( $topic->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Request::i()->controller != 'forums' ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href="
CONTENT;
$return .= htmlspecialchars( $topic->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $topic->container()->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</p>
		<ul class='ipsList_inline ipsClearfix ipsType_light'>
			
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->topic_answered_pid ):
$return .= <<<CONTENT

					<li class='ipsType_success'><i class='fa fa-check-circle'></i> <strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answered', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
				
CONTENT;

else:
$return .= <<<CONTENT

					<li class='ipsType_light'><i class='fa fa-question'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'awaiting_answer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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
	<ul class='ipsDataItem_stats'>
		
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

			<li>
				<span class='ipsDataItem_stats_number'>
CONTENT;

if ( $topic->question_rating ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $topic->question_rating, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
</span>
				<span class='ipsDataItem_stats_type'>
CONTENT;

$pluralize = array( $topic->question_rating ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'votes_no_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
			</li>	
			
CONTENT;

foreach ( $topic->stats(FALSE) as $k => $v ):
$return .= <<<CONTENT

				
CONTENT;

if ( $k == 'forums_comments' OR $k == 'answers_no_number' ):
$return .= <<<CONTENT

					<li>
						<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $v );
$return .= <<<CONTENT
</span>
						<span class='ipsDataItem_stats_type'>
CONTENT;

$pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answers_no_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
					</li>
				
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

foreach ( $topic->stats(FALSE) as $k => $v ):
$return .= <<<CONTENT

				<li 
CONTENT;

if ( in_array( $k, $topic->hotStats ) ):
$return .= <<<CONTENT
class="ipsDataItem_stats_hot" data-text='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hot_item', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hot_item_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
					<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $v );
$return .= <<<CONTENT
</span>
					<span class='ipsDataItem_stats_type'>
CONTENT;

$val = "{$k}"; $pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>
	<ul class='ipsDataItem_lastPoster ipsDataItem_withPhoto'>
		<li>
			
CONTENT;

if ( $topic->mapped('num_comments') ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $topic->lastCommenter(), 'tiny' );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $topic->author(), 'tiny' );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
		<li>
			
CONTENT;

if ( $topic->mapped('num_comments') ):
$return .= <<<CONTENT

				{$topic->lastCommenter()->link()}
			
CONTENT;

else:
$return .= <<<CONTENT

				{$topic->author()->link()}
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
		<li class="ipsType_light">
			<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url( 'getLastComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_last_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
				
CONTENT;

if ( $topic->mapped('last_comment') ):
$return .= <<<CONTENT

CONTENT;

$val = ( $topic->mapped('last_comment') instanceof \IPS\DateTime ) ? $topic->mapped('last_comment') : \IPS\DateTime::ts( $topic->mapped('last_comment') );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$val = ( $topic->mapped('date') instanceof \IPS\DateTime ) ? $topic->mapped('date') : \IPS\DateTime::ts( $topic->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		</li>
	</ul>
	
CONTENT;

if ( method_exists( $table, 'canModerate' ) AND $table->canModerate() ):
$return .= <<<CONTENT

		<div class='ipsDataItem_modCheck'>
			<span class='ipsCustomInput'>
				<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $topic ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $topic->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $topic->tableStates(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
				<span></span>
			</span>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</li>
CONTENT;

		return $return;
}

	function rows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "forums" )->row( $table, $headers, $row );
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

	function searchNoPermission( $lang, $link=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<li class="ipsStreamItem ipsStreamItem_contentBlock ipsAreaBackground_reset ipsPad">
	<div class='ipsType_center ipsType_light ipsType_large'>
		
CONTENT;
$return .= htmlspecialchars( $lang, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $link ):
$return .= <<<CONTENT
 <a href="
CONTENT;
$return .= htmlspecialchars( $link, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enter_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</li>

CONTENT;

		return $return;
}}