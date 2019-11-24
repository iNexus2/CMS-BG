<?php
namespace IPS\Theme\Cache;
class class_downloads_front_widgets extends \IPS\Theme\Template
{
	public $cache_key = '5f739e309b3ced1095d348a6df0355fc';
	function downloadStats( $stats, $latestFile, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_downloadStats', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner'>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsPad_half'>
			<ul class='ipsDataList' id='elDownloadsStats'>
				<li class='ipsDataItem'>
					<div class='ipsDataItem_main ipsPos_middle'>
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_files_front', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class='ipsDataItem_stats ipsDataItem_statsLarge'>
						<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalFiles'] );
$return .= <<<CONTENT
</span>
					</div>
				</li>
				
CONTENT;

if ( $stats['totalComments'] ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_main ipsPos_middle'>
							<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
						</div>
						<div class='ipsDataItem_stats ipsDataItem_statsLarge'>
							<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalComments'] );
$return .= <<<CONTENT
</span>
						</div>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $stats['totalReviews'] ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_main ipsPos_middle'>
							<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_reviews', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
						</div>
						<div class='ipsDataItem_stats ipsDataItem_statsLarge'>
							<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalReviews'] );
$return .= <<<CONTENT
</span>
						</div>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
			<hr class='ipsHr'>
			
CONTENT;

if ( $latestFile ):
$return .= <<<CONTENT

				<div id='elDownloadStatsLatest' class='ipsClearfix'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->thumbImage( $latestFile->primary_screenshot, $latestFile->name, 'small', 'ipsPos_left' );
$return .= <<<CONTENT

					<div class='ipsWidget_latestItem'>
						<strong class='ipsType_small ipsType_uppercase'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'latest_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong><br>
						<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $latestFile->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$sprintf = array($latestFile->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' class='ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $latestFile->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
						<span class='ipsType_light ipsType_medium'>
CONTENT;

$htmlsprintf = array($latestFile->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
						<p class='ipsType_medium ipsType_reset'>
CONTENT;

if ( !$latestFile->downloads ):
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

endif;
$return .= <<<CONTENT
<i class='fa fa-arrow-circle-down'></i> 
CONTENT;
$return .= htmlspecialchars( $latestFile->downloads, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( !$latestFile->downloads ):
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $latestFile->container()->bitoptions['comments'] ):
$return .= <<<CONTENT
&nbsp;&nbsp;
CONTENT;

if ( !$latestFile->comments ):
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

endif;
$return .= <<<CONTENT
<i class='fa fa-comment'></i> 
CONTENT;
$return .= htmlspecialchars( $latestFile->comments, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( !$latestFile->comments ):
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT
</p>
					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$columns = 2;
$return .= <<<CONTENT

		
CONTENT;

$columns += ( $stats['totalComments'] ) ? 1 : 0;
$return .= <<<CONTENT

		
CONTENT;

$columns += ( $stats['totalReviews'] ) ? 1 : 0;
$return .= <<<CONTENT

		
CONTENT;

$span = 12 / $columns;
$return .= <<<CONTENT

		<div class='ipsGrid ipsGrid_collapsePhone ipsWidget_stats'>
			<div class='ipsGrid_span
CONTENT;
$return .= htmlspecialchars( $span, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_center cDownloadsWidget_statsNumber'>
				<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalFiles'] );
$return .= <<<CONTENT
</span><br>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_files_front', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>
			
CONTENT;

if ( $stats['totalComments'] ):
$return .= <<<CONTENT

				<div class='ipsGrid_span
CONTENT;
$return .= htmlspecialchars( $span, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_center cDownloadsWidget_statsNumber'>
					<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalComments'] );
$return .= <<<CONTENT
</span><br>
					<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $stats['totalReviews'] ):
$return .= <<<CONTENT

				<div class='ipsGrid_span
CONTENT;
$return .= htmlspecialchars( $span, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_center cDownloadsWidget_statsNumber'>
					<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalReviews'] );
$return .= <<<CONTENT
</span><br>
					<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_reviews', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $latestFile ):
$return .= <<<CONTENT

				<div class='ipsGrid_span
CONTENT;
$return .= htmlspecialchars( $span, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_left cNewestMember'>
					<div id='elDownloadStatsLatest' class='ipsClearfix'>
						<span class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'latest_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span><br>
						<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $latestFile->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$sprintf = array($latestFile->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' class='ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $latestFile->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
						<span class='ipsType_light ipsType_medium'>
CONTENT;

$htmlsprintf = array($latestFile->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
						<p class='ipsType_medium ipsType_reset'>
CONTENT;

if ( !$latestFile->downloads ):
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

endif;
$return .= <<<CONTENT
<i class='fa fa-arrow-circle-down'></i> 
CONTENT;
$return .= htmlspecialchars( $latestFile->downloads, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( !$latestFile->downloads ):
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $latestFile->container()->bitoptions['comments'] ):
$return .= <<<CONTENT
&nbsp;&nbsp;
CONTENT;

if ( !$latestFile->comments ):
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

endif;
$return .= <<<CONTENT
<i class='fa fa-comment'></i> 
CONTENT;
$return .= htmlspecialchars( $latestFile->comments, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( !$latestFile->comments ):
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT
</p>
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
CONTENT;

		return $return;
}

	function downloadsCommentFeed( $comments, $title, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !empty( $comments )  ):
$return .= <<<CONTENT

	<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsWidget_inner ipsPad_half'>
			<ul class='ipsDataList ipsDataList_reducedSpacing'>
				
CONTENT;

foreach ( $comments as $comment ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_icon ipsPos_top'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'tiny' );
$return .= <<<CONTENT

						</div>
						<div class='ipsDataItem_main'>
							<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $comment->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsType_medium ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $comment->item()->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
							<p class='ipsType_reset ipsType_light ipsType_medium ipsType_blendLinks'>
CONTENT;

$htmlsprintf = array($comment->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 &middot; <a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>{$comment->dateLine()}</a></p>
							<div class='ipsType_medium ipsType_textBlock ipsType_richText ipsType_break ipsContained ipsSpacer_top ipsSpacer_half' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT
6 lines
CONTENT;

else:
$return .= <<<CONTENT
2 lines
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTruncate-watch='false'>
								{$comment->truncated( true )}
							</div>
						</div>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsWidget_inner'>
			<ul class='ipsDataList'>
				
CONTENT;

foreach ( $comments as $comment ):
$return .= <<<CONTENT

					<li class='ipsDataItem ipsClearfix'>
						<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'mini', $comment->warningRef() );
$return .= <<<CONTENT

							<div>
								<p class='ipsPos_right ipsType_reset ipsType_blendLinks'>
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
'><i class='fa fa-share-alt'></i></a>
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

						<div class='ipsPad ipsClearfix'>
							
CONTENT;

if ( in_array( 'IPS\Content\Reputation', class_implements( $comment ) ) and \IPS\Settings::i()->reputation_highlight and $comment->reputation() >= \IPS\Settings::i()->reputation_highlight and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

								<strong class='ipsComment_popularFlag' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></strong>
							
CONTENT;

endif;
$return .= <<<CONTENT

							<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $comment->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsDataItem_title ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $comment->item()->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
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

						</div>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
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

	function downloadsReviewFeed( $comments, $title, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !empty( $comments )  ):
$return .= <<<CONTENT

	<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsWidget_inner ipsPad_half'>
			<ul class='ipsDataList ipsDataList_reducedSpacing'>
				
CONTENT;

foreach ( $comments as $comment ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_icon ipsPos_top'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'tiny' );
$return .= <<<CONTENT

						</div>
						<div class='ipsDataItem_main'>
							<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $comment->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $comment->item()->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
							<span class='ipsType_light ipsType_small'>
CONTENT;

$htmlsprintf = array($comment->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 &middot; <a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->id ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>{$comment->dateLine()}</a></span>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->rating( 'small', $comment->rating, \IPS\Settings::i()->reviews_rating_out_of );
$return .= <<<CONTENT

							<div class='ipsType_medium ipsType_textBlock ipsType_richText ipsType_break ipsContained' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT
6 lines
CONTENT;

else:
$return .= <<<CONTENT
2 lines
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTruncate-watch='false'>
								{$comment->truncated( true )}
							</div>
						</div>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsWidget_inner'>
			<ul class='ipsDataList'>
				
CONTENT;

foreach ( $comments as $comment ):
$return .= <<<CONTENT

					<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'mini', $comment->warningRef() );
$return .= <<<CONTENT

					<div>
						<p class='ipsPos_right ipsType_reset ipsType_blendLinks'>
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
'><i class='fa fa-share-alt'></i></a>
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
					
CONTENT;

if ( in_array( 'IPS\Content\Reputation', class_implements( $comment ) ) and \IPS\Settings::i()->reputation_highlight and $comment->reputation() >= \IPS\Settings::i()->reputation_highlight and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

						<strong class='ipsComment_popularFlag' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $comment->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsDataItem_title ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $comment->item()->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
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

				</div>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
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

	function fileFeed( $files, $title, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner'>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsPad_half'>
			
CONTENT;

if ( count( $files ) ):
$return .= <<<CONTENT

				<ul class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $files as $file ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->fileRow( $file, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( count( $files ) ):
$return .= <<<CONTENT

			<ul class='ipsGrid ipsGrid_collapsePhone ipsWidget_columns'>
				
CONTENT;

foreach ( $files as $idx => $file ):
$return .= <<<CONTENT

					
CONTENT;

if ( $idx < 4 ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->fileRow( $file, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		
CONTENT;

else:
$return .= <<<CONTENT

			<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function fileRow( $file, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsDataItem 
CONTENT;

if ( $orientation == 'horizontal' ):
$return .= <<<CONTENT
ipsGrid_span3
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<div class='ipsDataItem_icon ipsPos_top'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->thumbImage( $file->primary_screenshot_thumb, $file->name, 'tiny' );
$return .= <<<CONTENT

		
CONTENT;

$price = NULL;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Application::appIsEnabled( 'nexus' ) and \IPS\Settings::i()->idm_nexus_on ):
$return .= <<<CONTENT

			<p class="cWidgetPrice ipsType_reset ipsType_medium ipsType_center">
				
CONTENT;

if ( $file->isPaid() ):
$return .= <<<CONTENT

					
CONTENT;

if ( $price = $file->price() ):
$return .= <<<CONTENT

						{$price}
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_free_feed', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div class='ipsDataItem_main'>
		<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$sprintf = array($file->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' class='ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $file->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
		<span class='ipsType_light ipsType_medium ipsType_blendLinks'>
CONTENT;

$htmlsprintf = array($file->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span><br>
		
CONTENT;

if ( $file->container()->bitoptions['reviews'] ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->rating( 'small', $file->rating, \IPS\Settings::i()->reviews_rating_out_of );
$return .= <<<CONTENT
 &nbsp;&nbsp;
		
CONTENT;

endif;
$return .= <<<CONTENT


		<span class='ipsType_medium ipsType_reset ipsType_noBreak'>
			
CONTENT;

if ( $file->isPaid() and in_array( 'purchases', explode( ',', \IPS\Settings::i()->idm_nexus_display ) ) ):
$return .= <<<CONTENT

				<span 
CONTENT;

if ( !$file->purchaseCount() ):
$return .= <<<CONTENT
class='ipsType_light'
CONTENT;

endif;
$return .= <<<CONTENT
 title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'idm_purchases', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-shopping-cart'></i> 
CONTENT;
$return .= htmlspecialchars( $file->purchaseCount(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>&nbsp;&nbsp;
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !$file->isPaid() or in_array( 'downloads', explode( ',', \IPS\Settings::i()->idm_nexus_display ) ) ):
$return .= <<<CONTENT

				<span 
CONTENT;

if ( !$file->downloads ):
$return .= <<<CONTENT
class='ipsType_light'
CONTENT;

endif;
$return .= <<<CONTENT
 title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloads', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-arrow-circle-down'></i> 
CONTENT;
$return .= htmlspecialchars( $file->downloads, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>&nbsp;&nbsp;
			
CONTENT;

endif;
$return .= <<<CONTENT


			
CONTENT;

if ( $file->container()->bitoptions['comments'] ):
$return .= <<<CONTENT
<span 
CONTENT;

if ( !$file->comments ):
$return .= <<<CONTENT
class='ipsType_light'
CONTENT;

endif;
$return .= <<<CONTENT
 title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-comment'></i> 
CONTENT;
$return .= htmlspecialchars( $file->comments, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

		</span>
	</div>
</li>
CONTENT;

		return $return;
}

	function topDownloads( $week, $month, $year, $all, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_topDownloads', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>


CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

	<div class='ipsTabs ipsTabs_small ipsTabs_stretch ipsClearfix' id='elDownloadsTopDownloads' data-ipsTabBar data-ipsTabBar-contentArea='#elDownloadsTopDownloads_content'>
		<a href='#elDownloadsTopDownloads' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
		<ul role="tablist">
			<li>
				<a href='#ipsTabs_elDownloadsTopDownloads_elDownloads_topDownloadsWeek_panel' id='elDownloads_topDownloadsWeek' class='ipsTabs_item ipsTabs_activeItem ipsType_center' role="tab" aria-selected='true'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_week', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			<li>
				<a href='#ipsTabs_elDownloadsTopDownloads_elDownloads_topDownloadsMonth_panel' id='elDownloads_topDownloadsMonth' class='ipsTabs_item ipsType_center' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_month', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>		
			<li>
				<a href='#ipsTabs_elDownloadsTopDownloads_elDownloads_topDownloadsYear_panel' id='elDownloads_topDownloadsYear' class='ipsTabs_item ipsType_center' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_year', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			<li>
				<a href='#ipsTabs_elDownloadsTopDownloads_elDownloads_topDownloadsAll_panel' id='elDownloads_topDownloadsAll' class='ipsTabs_item ipsType_center' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_alltime', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
		</ul>
	</div>

	<section id='elDownloadsTopDownloads_content' class='ipsWidget_inner'>
		<div id="ipsTabs_elDownloadsTopDownloads_elDownloads_topDownloadsWeek_panel" class='ipsTabs_panel ipsPad_half'>
			
CONTENT;

if ( count( $week ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $week as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->fileRow( $data );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_downloaded_files__week', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div id="ipsTabs_elDownloadsTopDownloads_elDownloads_topDownloadsMonth_panel" class='ipsTabs_panel ipsPad_half'>
			
CONTENT;

if ( count( $month ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $month as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->fileRow( $data );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_downloaded_files__month', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div id="ipsTabs_elDownloadsTopDownloads_elDownloads_topDownloadsYear_panel" class='ipsTabs_panel ipsPad_half'>
			
CONTENT;

if ( count( $year ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $year as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->fileRow( $data );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_downloaded_files__year', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div id="ipsTabs_elDownloadsTopDownloads_elDownloads_topDownloadsAll_panel" class='ipsTabs_panel ipsPad_half'>
			
CONTENT;

if ( count( $all ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $all as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->fileRow( $data );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_downloaded_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</section>

CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsGrid ipsGrid_collapsePhone ipsWidget_columns'>
		<div class='ipsGrid_span3'>
			<h4 class='ipsType_sectionHead ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'week', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>

			
CONTENT;

if ( count( $week ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $week as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->fileRow( $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset ipsType_left ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_downloaded_files__week', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsGrid_span3'>
			<h4 class='ipsType_sectionHead ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'month', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>

			
CONTENT;

if ( count( $month ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $month as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->fileRow( $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset ipsType_left ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_downloaded_files__month', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsGrid_span3'>
			<h4 class='ipsType_sectionHead ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'year', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>

			
CONTENT;

if ( count( $year ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $year as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->fileRow( $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset ipsType_left ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_downloaded_files__year', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsGrid_span3'>
			<h4 class='ipsType_sectionHead ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'alltime', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>

			
CONTENT;

if ( count( $all ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $all as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->fileRow( $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset ipsType_left ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_downloaded_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
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

		return $return;
}

	function topSubmitterRow( $idx, $data, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsDataItem'>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsDataItem_generic ipsPos_middle ipsDataItem_size1 ipsType_center ipsType_large ipsType_light'><strong>
CONTENT;

$return .= htmlspecialchars( $idx + 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsDataItem_main ipsPhotoPanel ipsPhotoPanel_tiny'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $data['member'], 'tiny' );
$return .= <<<CONTENT

		<div>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$data['member']->member_id}&do=content&type=downloads_file", "front", "profile_content", $data['member']->members_seo_name, 0 ) );
$return .= <<<CONTENT
' class='ipsType_truncate ipsType_truncateLine'>
CONTENT;
$return .= htmlspecialchars( $data['member']->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a><br>
			<span class='ipsType_small'><strong>
CONTENT;

$pluralize = array( $data['files'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download_file_count', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</strong> &nbsp;&middot;&nbsp;<span data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_avg_rating', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->rating( 'small', $data['rating'], \IPS\Settings::i()->reviews_rating_out_of );
$return .= <<<CONTENT
</span></span>
		</div>
	</div>
</li>
CONTENT;

		return $return;
}

	function topSubmitters( $week, $month, $year, $all, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_topSubmitters', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>


CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

	<div class='ipsTabs ipsTabs_small ipsTabs_stretch ipsClearfix' id='elDownloadsTopSubmitters' data-ipsTabBar data-ipsTabBar-contentArea='#elDownloadsTopSubmitters_content'>
		<a href='#elDownloadsTopSubmitters' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
		<ul role="tablist">
			<li>
				<a href='#ipsTabs_elDownloadsTopSubmitters_elDownloads_topSubmittersWeek_panel' id='elDownloads_topSubmittersWeek' class='ipsTabs_item ipsTabs_activeItem ipsType_center' role="tab" aria-selected='true'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_week', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			<li>
				<a href='#ipsTabs_elDownloadsTopSubmitters_elDownloads_topSubmittersMonth_panel' id='elDownloads_topSubmittersMonth' class='ipsTabs_item ipsType_center' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_month', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>		
			<li>
				<a href='#ipsTabs_elDownloadsTopSubmitters_elDownloads_topSubmittersYear_panel' id='elDownloads_topSubmittersYear' class='ipsTabs_item ipsType_center' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_year', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			<li>
				<a href='#ipsTabs_elDownloadsTopSubmitters_elDownloads_topSubmittersAll_panel' id='elDownloads_topSubmittersAll' class='ipsTabs_item ipsType_center' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_alltime', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
		</ul>
	</div>

	<section id='elDownloadsTopSubmitters_content' class='ipsWidget_inner'>
		<div id="ipsTabs_elDownloadsTopSubmitters_elDownloads_topSubmittersWeek_panel" class='ipsTabs_panel'>
			
CONTENT;

if ( count( $week ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $week as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->topSubmitterRow( $idx, $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_submitters_empty__week', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div id="ipsTabs_elDownloadsTopSubmitters_elDownloads_topSubmittersMonth_panel" class='ipsTabs_panel'>
			
CONTENT;

if ( count( $month ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $month as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->topSubmitterRow( $idx, $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_submitters_empty__month', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div id="ipsTabs_elDownloadsTopSubmitters_elDownloads_topSubmittersYear_panel" class='ipsTabs_panel'>
			
CONTENT;

if ( count( $year ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $year as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->topSubmitterRow( $idx, $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_submitters_empty__year', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div id="ipsTabs_elDownloadsTopSubmitters_elDownloads_topSubmittersAll_panel" class='ipsTabs_panel'>
			
CONTENT;

if ( count( $all ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $all as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->topSubmitterRow( $idx, $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_submitters_empty__all', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</section>

CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsGrid ipsGrid_collapsePhone ipsWidget_columns'>
		<div class='ipsGrid_span3'>
			<h4 class='ipsType_sectionHead ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'week', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>

			
CONTENT;

if ( count( $week ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $week as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->topSubmitterRow( $idx, $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset ipsType_left ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_submitters_empty__week', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsGrid_span3'>
			<h4 class='ipsType_sectionHead ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'month', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>

			
CONTENT;

if ( count( $month ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $month as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->topSubmitterRow( $idx, $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset ipsType_left ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_submitters_empty__month', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsGrid_span3'>
			<h4 class='ipsType_sectionHead ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'year', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>

			
CONTENT;

if ( count( $year ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $year as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->topSubmitterRow( $idx, $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset ipsType_left ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_submitters_empty__year', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsGrid_span3'>
			<h4 class='ipsType_sectionHead ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'alltime', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>

			
CONTENT;

if ( count( $all ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_reducedSpacing'>
					
CONTENT;

foreach ( $all as $idx => $data ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "downloads" )->topSubmitterRow( $idx, $data, $orientation );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPad'>
					<p class='ipsType_reset ipsType_left ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_submitters_empty__all', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
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

		return $return;
}}