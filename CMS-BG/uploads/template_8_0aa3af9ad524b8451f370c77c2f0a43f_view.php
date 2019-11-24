<?php
namespace IPS\Theme\Cache;
class class_videos_front_view extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function commentRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class="ipsDataItem 
CONTENT;

if ( $row->approved !== 1 ):
$return .= <<<CONTENT
ipsFaded ipsFaded_withHover
CONTENT;

endif;
$return .= <<<CONTENT
 ipsDataItem_unread 
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
 
CONTENT;

if ( !$row->approved ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
">

		<div class='ipsDataItem_icon ipsPos_top ipsResponsive_hidePhone'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'tiny' );
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<h4 class='ipsDataItem_title'>				
				<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_entry', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'videos_in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: 
CONTENT;
$return .= htmlspecialchars( $row->item()->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</h4>
			<p class='ipsType_reset ipsType_light'>
CONTENT;

$sprintf = array($row->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $row->date instanceof \IPS\DateTime ) ? $row->date : \IPS\DateTime::ts( $row->date );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</p>
			<div class='ipsDataItem_meta'>
				<br>
				<div class='ipsType_richText ipsType_medium' data-ipsTruncate data-ipsTruncate-size='4 lines' data-ipsTruncate-type='remove'>
					{$row->text}
				</div>               

			</div>
		</div>
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function comments( $entry ) {
		$return = '';
		$return .= <<<CONTENT

<div class='' data-controller='core.front.core.commentFeed' data-baseURL='
CONTENT;
$return .= htmlspecialchars( $entry->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $entry->isLastPage() ):
$return .= <<<CONTENT
data-lastPage
CONTENT;

endif;
$return .= <<<CONTENT
 data-feedID='event-
CONTENT;
$return .= htmlspecialchars( $entry->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='comments'>
	
CONTENT;

if ( $entry->commentPageCount() > 1 ):
$return .= <<<CONTENT

		{$entry->commentPagination( array( 'tab' ) )}
		<br><br>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div data-role='commentFeed' data-controller='core.front.core.moderation'>
		
CONTENT;

if ( ( $comments = $entry->comments() and count( $comments ) ) ):
$return .= <<<CONTENT

			<form action="
CONTENT;
$return .= htmlspecialchars( $entry->url()->setQueryString( 'do', 'multimodComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-ipsPageAction data-role='moderationTools'>
				
CONTENT;

$commentCount=0; $timeLastRead = $entry->timeLastRead(); $lined = FALSE;
$return .= <<<CONTENT

				
CONTENT;

foreach ( $comments as $comment ):
$return .= <<<CONTENT

					
CONTENT;

if ( !$lined and $timeLastRead and $timeLastRead->getTimestamp() < $comment->mapped('date') ):
$return .= <<<CONTENT

						
CONTENT;

if ( $lined = TRUE and $commentCount ):
$return .= <<<CONTENT

							<hr class="ipsCommentUnreadSeperator">
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

$commentCount++;
$return .= <<<CONTENT

					{$comment->html()}
				
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentMultimod( $entry );
$return .= <<<CONTENT

			</form>
		
CONTENT;

else:
$return .= <<<CONTENT

			<p class='ipsType_normal ipsType_light ipsType_center' data-role='noComments'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( $entry->commentPageCount() > 1 ):
$return .= <<<CONTENT

		<hr class='ipsHr'>
		{$entry->commentPagination( array( 'tab' ) )}
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $entry->commentForm() || $entry->locked() || \IPS\Member::loggedIn()->restrict_post || \IPS\Member::loggedIn()->members_bitoptions['unacknowledged_warnings'] ):
$return .= <<<CONTENT

		<a id='replyForm'></a>
		<div data-role='replyArea' class='ipsBox ipsBox_transparent ipsAreaBackground ipsPad 
CONTENT;

if ( !$entry->canComment() ):
$return .= <<<CONTENT
cTopicPostArea_noSize
CONTENT;

endif;
$return .= <<<CONTENT
 ipsSpacer_top'>
			
CONTENT;

if ( $entry->commentForm() ):
$return .= <<<CONTENT

				
CONTENT;

if ( $entry->locked() ):
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_warning ipsComposeArea_warning ipsSpacer_bottom ipsSpacer_half'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'event_locked_can_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				{$entry->commentForm()}
				
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $entry->locked() ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->commentUnavailable( 'event_locked_cannot_comment' );
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

</div>
CONTENT;

		return $return;
}

	function view( $video ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox ipsPad_half ipsSpacer_bottom'>
    <div class='ipsType_pageTitle'>
        <div class='ipsPos_right ipsResponsive_noFloat ipsResponsive_hidePhone'>
        	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'videos', 'video', $video->tid, $video->followers()->count( TRUE ) );
$return .= <<<CONTENT

        </div>
    
    	
CONTENT;

if ( $video->prefix() ):
$return .= <<<CONTENT

    		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $video->prefix( TRUE ), $video->prefix() );
$return .= <<<CONTENT

    	
CONTENT;

endif;
$return .= <<<CONTENT

    
    	<h1 itemprop='name' class="ipsType_pageTitle">
CONTENT;
$return .= htmlspecialchars( $video->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>
    	
CONTENT;

if ( $video->hidden() === 1 ):
$return .= <<<CONTENT

    		<span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span>
    	
CONTENT;

elseif ( $video->hidden() === -1 ):
$return .= <<<CONTENT

    		<span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $video->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
    	
CONTENT;

endif;
$return .= <<<CONTENT
       
    	
CONTENT;

if ( $video->mapped('featured') ):
$return .= <<<CONTENT

    		<span class="ipsBadge ipsBadge_icon ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></span>
    	
CONTENT;

endif;
$return .= <<<CONTENT
    
    </div>
    
    <div class="ipsDataItem ipsSpacer_bottom">
    	<div class='ipsDataItem_icon ipsPos_top ipsResponsive_hidePhone'>
    		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $video->author(), 'tiny' );
$return .= <<<CONTENT

    	</div>
    	<div class='ipsDataItem_main ipsType_normal'>				
            
CONTENT;

$sprintf = array($video->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $video->__get( $video::$databaseColumnMap['date'] ) instanceof \IPS\DateTime ) ? $video->__get( $video::$databaseColumnMap['date'] ) : \IPS\DateTime::ts( $video->__get( $video::$databaseColumnMap['date'] ) );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
          
         
        	<ul class='ipsList_inline ipsType_small'>
        		<li><i class='fa fa-eye'></i> 
CONTENT;

$pluralize = array( $video->views ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_video_views', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>    
                
CONTENT;

if ( \IPS\Settings::i()->vs_enable_comments AND \IPS\Member::loggedIn()->group['g_vs_view_comments'] ):
$return .= <<<CONTENT
                        
        		    <li><i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $video->num_comments ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_video_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
                
CONTENT;

endif;
$return .= <<<CONTENT

        		<li>
            </ul> 
            
    		<div class='ipsClearfix ipsResponsive_hidePhone ipsSpacer_top ipsSpacer_half'>
    			{$video->rating()}
    		</div>          
            
    		
CONTENT;

if ( count( $video->tags() ) ):
$return .= <<<CONTENT
		
    			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $video->tags() );
$return .= <<<CONTENT

    		
CONTENT;

endif;
$return .= <<<CONTENT
        
        </div>
    </div>    
</div> 
        
<div class='ipsBox ipsPad_half ipsClearfix ipsSpacer_bottom'>
    <div class='ipsType_normal ipsType_richText ipsContained'>
        
CONTENT;

if ( \IPS\Settings::i()->vs_extra_videos AND $extraVideo = $video->getExtraVideo() ):
$return .= <<<CONTENT

            {$extraVideo}
        
CONTENT;

else:
$return .= <<<CONTENT

            
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "videos" )->video( $video );
$return .= <<<CONTENT

        
CONTENT;

endif;
$return .= <<<CONTENT

        
        
CONTENT;

if ( \IPS\Settings::i()->vs_extra_videos AND count( $video->extraVideos() ) ):
$return .= <<<CONTENT

    		<ul class='ipsButton_split ipsSpacer_top'>
                <li><a href='
CONTENT;
$return .= htmlspecialchars( $video->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton 
CONTENT;

if ( !isset( \IPS\Request::i()->extra ) ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_light
CONTENT;

endif;
$return .= <<<CONTENT
 '>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'extra_video_main', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
                
CONTENT;

foreach ( $video->extraVideos() as $id => $_video ):
$return .= <<<CONTENT

      			   <li><a href='
CONTENT;
$return .= htmlspecialchars( $video->url()->setQueryString( array( 'extra' => $id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton 
CONTENT;

if ( isset( \IPS\Request::i()->extra ) && \IPS\Request::i()->extra == $id ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_light
CONTENT;

endif;
$return .= <<<CONTENT
 '>
CONTENT;
$return .= htmlspecialchars( $_video['key'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
                
CONTENT;

endforeach;
$return .= <<<CONTENT

     		</ul>           
        
CONTENT;

endif;
$return .= <<<CONTENT
       
    </div> 
    
	
CONTENT;

if ( $video instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

		<div class='ipsSpacer_top ipsPos_right'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $video );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT
       
     
    
CONTENT;

if ( $video->description ):
$return .= <<<CONTENT
       
        <div class='ipsSpacer_top ipsBox ipsBox_container ipsType_normal ipsType_richText' data-ipsTruncate data-ipsTruncate-size='3 lines' data-ipsTruncate-type='hide'>
            {$video->description}
        </div> 
    
CONTENT;

endif;
$return .= <<<CONTENT
  

	<ul class='ipsToolList ipsToolList_horizontal ipsSpacer_both ipsPos_left ipsClearfix ipsResponsive_noFloat'>
		
CONTENT;

if ( $video->canEdit() or $video->canHide() or $video->canUnhide() or $video->canFeature() or $video->canUnfeature() or $video->canMove() or $video->canDelete() ):
$return .= <<<CONTENT

			<li>
				<a href='#elVideoActions_menu' id='elVideoActions' class='ipsButton ipsButton_light ipsButton_verySmall ipsButton_fullWidth' data-ipsMenu>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'videos_manage', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
				<ul id='elVideoActions_menu' class='ipsMenu ipsMenu_auto ipsHide'>
					
CONTENT;

if ( $video->canEdit() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $video->url()->csrf()->setQueryString( array( 'do' => 'edit' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'video_edit_details_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'video_edit_details', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $video->canHide() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $video->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'hide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide_title_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( $video->canUnhide() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $video->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

if ( $video->hidden() === 1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve_title_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide_title_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

if ( $video->hidden() === 1 ):
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

if ( $video->canFeature() AND !$video->featured ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $video->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'feature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature_title_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( $video->canUnfeature() AND $video->featured ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $video->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unfeature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfeature_title_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfeature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $video->canMove() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $video->url()->csrf()->setQueryString( array( 'do' => 'move' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"  title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'video_move_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $video->canDelete() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $video->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'video_delete_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
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

if ( !\IPS\Member::loggedIn()->group['gbw_no_report']  ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $video->url('report'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_submit_success', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_link ipsButton_verySmall ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $video->topic()  ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $video->topic()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'video_discussion_topic_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_link ipsButton_verySmall ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'video_discussion_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT
        
	</ul>                       
</div> 


CONTENT;

if ( \IPS\Settings::i()->vs_enable_comments AND \IPS\Member::loggedIn()->group['g_vs_view_comments'] ):
$return .= <<<CONTENT
 
	<a id="replies"></a>
	<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'video_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "view", "videos" )->comments( $video );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT
  

<div class='ipsGrid ipsGrid_collapsePhone ipsPager ipsClearfix ipsSpacer_top'>
	<div class="ipsGrid_span6 ipsType_left ipsPager_prev">
		<a href="
CONTENT;
$return .= htmlspecialchars( $video->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($video->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_video_category', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" rel="up">
			<span class="ipsPager_type">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_back_to_video_category', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			<span class="ipsPager_title ipsType_light ipsType_break">
CONTENT;

$val = "{$video->container()->_title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'wordbreak' => TRUE ) );
$return .= <<<CONTENT
</span>
		</a>
	</div>
</div>


CONTENT;

if ( count( $video->shareLinks() ) ):
$return .= <<<CONTENT

    <hr class='ipsHr'>        
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sharelinks( $video );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}