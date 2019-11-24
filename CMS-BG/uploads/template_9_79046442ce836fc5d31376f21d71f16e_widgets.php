<?php
namespace IPS\Theme\Cache;
class class_videos_front_widgets extends \IPS\Theme\Template
{
	public $cache_key = 'a8d8daeacb221d8aff48629a46e239b2';
	function videosComments( $comments, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->vs_enable_comments AND \IPS\Member::loggedIn()->group['g_vs_view_comments'] ):
$return .= <<<CONTENT

    <h3 class='ipsWidget_title ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_videosComments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
    <div class='ipsWidget_inner'>
    
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

    	<div class='ipsPad_half'>
            
CONTENT;

if ( count( $comments ) ):
$return .= <<<CONTENT
        
        		<ul class='ipsDataList ipsDataList_reducedSpacing'>
        			
CONTENT;

foreach ( $comments as $row ):
$return .= <<<CONTENT

        				<li class='ipsDataItem'>
        					<div class='ipsDataItem_icon ipsPos_top'>
        						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'tiny' );
$return .= <<<CONTENT

        					</div>
        					<div class='ipsDataItem_main'>
        						<a href="
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsDataItem_title ipsType_break'>
CONTENT;

$return .= \IPS\Lang::wordbreak( htmlspecialchars( $row->item()->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) );
$return .= <<<CONTENT
</a><br>
        						<span class='ipsType_light ipsType_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'videos_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: {$row->author()->link()} &middot; 
CONTENT;

$val = ( $row->date_added instanceof \IPS\DateTime ) ? $row->date_added : \IPS\DateTime::ts( $row->date_added );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>
        						<div class='ipsType_small ipsType_textBlock ipsType_richText ipsType_break' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='6 lines'>
        							{$row->truncated( true )}
        						</div>
        					</div>
        				</li>
        			
CONTENT;

endforeach;
$return .= <<<CONTENT

        			<li class='ipsDataItem'>
        				<div class='ipsDataItem_main ipsType_small ipsType_light ipsType_center'>
                            <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=videos&module=videos&controller=comments", null, "videos_comments", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_all_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
        				</div>
        			</li>                
        		</ul>
    		
CONTENT;

else:
$return .= <<<CONTENT

    			<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_video_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( count( $comments ) ):
$return .= <<<CONTENT

        		<ul class='ipsGrid ipsGrid_collapsePhone ipsWidget_columns'>
        			
CONTENT;

foreach ( $comments as $idx => $row ):
$return .= <<<CONTENT

        				
CONTENT;

if ( $idx < 4 ):
$return .= <<<CONTENT

        					<li class='ipsDataItem ipsGrid_span3'>
        						<div class='ipsDataItem_icon ipsPos_top'>
        							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'tiny' );
$return .= <<<CONTENT

        						</div>
        						<div class='ipsDataItem_main'>
        							<a href="
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsDataItem_title ipsType_break'>
CONTENT;

$return .= \IPS\Lang::wordbreak( htmlspecialchars( $row->item()->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) );
$return .= <<<CONTENT
</a><br>
        							<span class='ipsType_light ipsType_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'videos_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: {$row->author()->link()} &middot; 
CONTENT;

$val = ( $row->date_added instanceof \IPS\DateTime ) ? $row->date_added : \IPS\DateTime::ts( $row->date_added );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>
        							<div class='ipsType_small ipsType_textBlock ipsType_richText ipsType_break' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='2 lines'>
        								{$row->truncated( true )}
        							</div>
        						</div>
        					</li>						
        				
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_video_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function videosStats( $stats, $latestVideo, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_videosStats', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner'>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsPad_half'>
			<ul class='ipsDataList' id='elVideoStats'>
				<li class='ipsDataItem'>
					<div class='ipsDataItem_main ipsPos_middle'>
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class='ipsDataItem_stats ipsDataItem_statsLarge'>
						<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalVideos'] );
$return .= <<<CONTENT
</span>
					</div>
				</li>
				<li class='ipsDataItem'>
					<div class='ipsDataItem_main ipsPos_middle'>
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_video_submitters', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class='ipsDataItem_stats ipsDataItem_statsLarge'>
						<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalSubmitters'] );
$return .= <<<CONTENT
</span>
					</div>
				</li>                
				
CONTENT;

if ( \IPS\Settings::i()->vs_enable_comments AND $stats['totalComments'] ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_main ipsPos_middle'>
							<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_video_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

				<li class='ipsDataItem'>
					<div class='ipsDataItem_main ipsPos_middle'>
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_video_views', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class='ipsDataItem_stats ipsDataItem_statsLarge'>
						<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalViews'] );
$return .= <<<CONTENT
</span>
					</div>
				</li>
			</ul>
			<hr class='ipsHr'>
			
CONTENT;

if ( $latestVideo ):
$return .= <<<CONTENT

				<div id='elVideoStatsLatest' class='ipsClearfix'>
					<span class='ipsPos_left'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $latestVideo->author(), 'small' );
$return .= <<<CONTENT
</span>
					<div class='ipsWidget_latestItem'>
						<strong class='ipsType_small ipsType_uppercase'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'latest_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong><br>
						<a href="
CONTENT;
$return .= htmlspecialchars( $latestVideo->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Lang::wordbreak( htmlspecialchars( $latestVideo->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) );
$return .= <<<CONTENT
</a>
						<span class='ipsType_light ipsType_medium'>
CONTENT;

$htmlsprintf = array($latestVideo->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
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

$columns = 4;
$return .= <<<CONTENT

		
CONTENT;

$columns += ( \IPS\Settings::i()->vs_enable_comments AND $stats['totalComments'] ) ? 2 : 0;
$return .= <<<CONTENT

		
CONTENT;

$span = 12 / $columns;
$return .= <<<CONTENT

		<div class='ipsGrid ipsGrid_collapsePhone ipsWidget_stats'>
			<div class='ipsGrid_span
CONTENT;
$return .= htmlspecialchars( $span, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_center cVideoWidget_statsNumber'>
				<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalVideos'] );
$return .= <<<CONTENT
</span><br>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>
			<div class='ipsGrid_span
CONTENT;
$return .= htmlspecialchars( $span, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_center cVideoWidget_statsNumber'>
				<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalSubmitters'] );
$return .= <<<CONTENT
</span><br>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_video_submitters', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>            
			
CONTENT;

if ( \IPS\Settings::i()->vs_enable_comments AND $stats['totalComments'] ):
$return .= <<<CONTENT

				<div class='ipsGrid_span
CONTENT;
$return .= htmlspecialchars( $span, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_center cVideoWidget_statsNumber'>
					<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalComments'] );
$return .= <<<CONTENT
</span><br>
					<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_video_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsGrid_span
CONTENT;
$return .= htmlspecialchars( $span, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_center cVideoWidget_statsNumber'>
				<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['totalViews'] );
$return .= <<<CONTENT
</span><br>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_video_views', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>
			
CONTENT;

if ( $latestVideo ):
$return .= <<<CONTENT

				<div class='ipsGrid_span
CONTENT;
$return .= htmlspecialchars( $span, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_left cNewestMember'>
					<div id='elVideoStatsLatest' class='ipsClearfix'>
						<span class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'latest_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span><br>
						<a href="
CONTENT;
$return .= htmlspecialchars( $latestVideo->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Lang::wordbreak( htmlspecialchars( $latestVideo->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) );
$return .= <<<CONTENT
</a>
						<span class='ipsType_light ipsType_medium'>
CONTENT;

$htmlsprintf = array($latestVideo->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
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

	function videosVideos( $videos, $orderField='date', $widgetTitle, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

    <h3 class='ipsWidget_title ipsType_reset'>
CONTENT;

if ( $widgetTitle ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $widgetTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $orderField == 'last_updated' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_videosVideos_last_updated', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

elseif ( $orderField == 'video_rating' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_videosVideos_top_rated', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_videosVideos_latest_videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h3>
    <div class='ipsWidget_inner'>
    	<div class='ipsPad_half'>
            
CONTENT;

if ( count( $videos ) ):
$return .= <<<CONTENT

                <ul class='ipsDataList ipsDataList_reducedSpacing'>
    				
CONTENT;

foreach ( $videos as $row ):
$return .= <<<CONTENT

    					<li class='ipsDataItem'>
    						<div class='ipsDataItem_icon ipsPos_top'>
                                
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "videos" )->thumb( $row, 'tiny' );
$return .= <<<CONTENT

    						</div>
    						<div class='ipsDataItem_main'>
                                
CONTENT;

if ( \IPS\Settings::i()->vs_enable_comments AND \IPS\Member::loggedIn()->group['g_vs_view_comments'] ):
$return .= <<<CONTENT

                                    <div class="ipsCommentCount ipsPos_right 
CONTENT;

if ( ( $row->num_comments ) === 0 ):
$return .= <<<CONTENT
ipsFaded
CONTENT;

endif;
$return .= <<<CONTENT
" data-ipsTooltip title='
CONTENT;

$pluralize = array( $row->num_comments ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_video_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( $row->num_comments, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
                                
CONTENT;

endif;
$return .= <<<CONTENT

    
    							<a href="
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsDataItem_title ipsType_break'>
CONTENT;

$return .= \IPS\Lang::wordbreak( htmlspecialchars( $row->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) );
$return .= <<<CONTENT
</a>
                                
CONTENT;

if ( $orderField == 'video_rating' AND $row->averageRating() ):
$return .= <<<CONTENT
<br>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rating( 'small', $row->averageRating() );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
<br>
    							<span class='ipsType_light ipsType_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'videos_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: {$row->author()->link()} &middot; 
CONTENT;

$val = ( ( $orderField == 'last_updated' AND $row->last_updated ) ? $row->last_updated : $row->date instanceof \IPS\DateTime ) ? ( $orderField == 'last_updated' AND $row->last_updated ) ? $row->last_updated : $row->date : \IPS\DateTime::ts( ( $orderField == 'last_updated' AND $row->last_updated ) ? $row->last_updated : $row->date );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>
    						</div>
    					</li>
    				
CONTENT;

endforeach;
$return .= <<<CONTENT

     				<li class='ipsDataItem'>
    					<div class='ipsDataItem_main ipsType_small ipsType_light ipsType_center'>
                            <a 
CONTENT;

if ( $orderField == 'date' ):
$return .= <<<CONTENT
href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=videos&module=videos&controller=browse&do=listall", null, "videos_listall", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=videos&module=videos&controller=browse&do=listall&sortby={$orderField}&sortdirection=desc", null, "videos_listall", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_all_videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
    					</div>
    				</li>                    
                </ul>
    		
CONTENT;

else:
$return .= <<<CONTENT

    			<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
    		
CONTENT;

endif;
$return .= <<<CONTENT
                    
    	</div>
    </div>    

CONTENT;

else:
$return .= <<<CONTENT

    <h3 class='ipsWidget_title ipsType_reset'>
CONTENT;

if ( $widgetTitle ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $widgetTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $orderField == 'last_updated' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_videosVideos_last_updated', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

elseif ( $orderField == 'video_rating' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_videosVideos_top_rated', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_videosVideos_latest_videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h3>
    <div class='ipsWidget_inner'>
		
CONTENT;

if ( count( $videos ) ):
$return .= <<<CONTENT

			<ul class='ipsGrid ipsGrid_collapsePhone ipsWidget_columns'>
				
CONTENT;

foreach ( $videos as $idx => $row ):
$return .= <<<CONTENT

                    <li class='ipsGrid_span3 ipsType_center ipsType_blendLinks ipsClearfix ipsPad_half' style='min-width: 150px;'>
                    	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "videos" )->thumb( $row );
$return .= <<<CONTENT

                		<div class='ipsSpacer_top ipsSpacer_half'>
                			<h3 class='ipsType_normal ipsType_reset ipsTruncate ipsTruncate_line' data-ipsTruncate data-ipsTruncate-size='1 lines' data-ipsTruncate-type='remove'>
                                <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$sprintf = array($row->title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
                			</h3>
                			<span class='ipsType_light ipsType_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'videos_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: {$row->author()->link()} &middot; 
CONTENT;

$val = ( $row->date instanceof \IPS\DateTime ) ? $row->date : \IPS\DateTime::ts( $row->date );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>                 		
                        </div>
                    </li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		
CONTENT;

else:
$return .= <<<CONTENT

			<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

    </div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}