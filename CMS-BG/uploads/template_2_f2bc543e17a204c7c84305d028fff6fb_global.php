<?php
namespace IPS\Theme\Cache;
class class_videos_front_global extends \IPS\Theme\Template
{
	public $cache_key = '93826fd1df1590e282335a3fa4af4fad';
	function commentTableHeader( $comment, $video ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsDataList ipsAreaBackground_light ipsClearfix'>
	<div class='ipsDataItem'>
		<div class='ipsDataItem_generic ipsDataItem_size2'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->thumbImage( \IPS\File::get( 'videos_Thumbs', $video->thumbnail )->url, $video->title, '', 'cSearchActivity_image', 'view_this', $video->url() );
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<h3 class='ipsType_sectionHead'><a href='
CONTENT;
$return .= htmlspecialchars( $video->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$sprintf = array($video->title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $video->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h3>
			<p class='ipsType_normal ipsType_light ipsType_blendLinks ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'videos_in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $video->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $video->container()->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></p>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function snippet( $activity, $type='activity' ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $activity instanceof \IPS\videos\Video\Comment ):
$return .= <<<CONTENT

	
CONTENT;

$item = $activity->item();
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

$item = $activity;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


<div class='cSearchActivity_info ipsContained'>
	<div class='ipsColumns'>
		<div class='ipsColumn ipsColumn_narrow'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->thumbImage( \IPS\File::get( 'videos_Thumbs', $item->thumbnail )->url, $item->title, '', 'cSearchActivity_image', 'view_this', $item->url() );
$return .= <<<CONTENT

		</div>
		<div class='ipsColumn ipsColumn_fluid'>
			
CONTENT;

if ( $activity instanceof \IPS\videos\Video\Comment ):
$return .= <<<CONTENT

				<div class='ipsType_medium ipsType_richText ipsContained ipsSpacer_bottom ipsSpacer_half' data-ipsTruncate data-ipsTruncate-size='3 lines' data-ipsTruncate-type='remove'>
					{$activity->truncated()}
				</div>
				<ul class='ipsList_inline ipsType_light'>
					
CONTENT;

if ( $type != 'search' and $activity instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

						<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationMini( $activity, '', NULL, TRUE );
$return .= <<<CONTENT
</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $type != 'search' ):
$return .= <<<CONTENT
<a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_normal ipsType_break'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='ipsType_medium ipsType_richText ipsContained ipsSpacer_both ipsSpacer_half' data-ipsTruncate data-ipsTruncate-size='3 lines' data-ipsTruncate-type='remove'>
					{$item->truncated()}
				</div>
				<ul class='ipsList_inline ipsType_light'>
					<li>
CONTENT;

$pluralize = array( $item->views ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_video_views', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
					
CONTENT;

if ( \IPS\Settings::i()->vs_enable_comments AND \IPS\Member::loggedIn()->group['g_vs_view_comments'] ):
$return .= <<<CONTENT

						<li>
CONTENT;

$pluralize = array( $item->num_comments ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_video_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $type != 'search' and $item instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

						<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationMini( $item, '', NULL, TRUE );
$return .= <<<CONTENT
</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function thumb( $video, $size='' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$thumbDims = explode( ',', \IPS\Settings::i()->vs_standard_thumbnail );
$return .= <<<CONTENT
 
<a href='
CONTENT;
$return .= htmlspecialchars( $video->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>

CONTENT;

if ( $video->thumbnail ):
$return .= <<<CONTENT

	<div class='ipsThumb 
CONTENT;

if ( $size ):
$return .= <<<CONTENT
ipsThumb_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 ipsThumb_bg' style='
CONTENT;

if ( isset( $thumbDims[0] ) AND !$size ):
$return .= <<<CONTENT
width: 100%; height: 
CONTENT;

if ( isset( $thumbDims[1] ) AND $thumbDims[1] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $thumbDims[1], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
140
CONTENT;

endif;
$return .= <<<CONTENT
px;
CONTENT;

endif;
$return .= <<<CONTENT
 background-image: url( 
CONTENT;

$return .= \IPS\File::get( "videos_Thumbs", $video->thumbnail )->url;
$return .= <<<CONTENT
 );'>
		<img src='
CONTENT;

$return .= \IPS\File::get( "videos_Thumbs", $video->thumbnail )->url;
$return .= <<<CONTENT
' alt='' class=''>
	</div>                        

CONTENT;

else:
$return .= <<<CONTENT

    <div class='ipsNoThumb ipsThumb ipsThumb_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( isset( $thumbDims[0] ) AND !$size ):
$return .= <<<CONTENT
style='
CONTENT;

if ( isset( $thumbDims[0] ) AND !$size ):
$return .= <<<CONTENT
width: 100%; height: 
CONTENT;

if ( isset( $thumbDims[1] ) AND $thumbDims[1] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $thumbDims[1], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
140
CONTENT;

endif;
$return .= <<<CONTENT
px;
CONTENT;

endif;
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
></div>

CONTENT;

endif;
$return .= <<<CONTENT

</a>
CONTENT;

		return $return;
}

	function video( $video ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $video->video_type == 'media_upload' OR $video->video_type == 'media_upload_url' ):
$return .= <<<CONTENT

    <video id="video
CONTENT;
$return .= htmlspecialchars( $video->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" width="100%" preload controls>
    	<source src="
CONTENT;

$return .= \IPS\File::get( "videos_Videos", $video->video_data )->url;
$return .= <<<CONTENT
" />
    </video>        

CONTENT;

else:
$return .= <<<CONTENT
 
    {$video->embed}

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}