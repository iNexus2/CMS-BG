<?php
namespace IPS\Theme\Cache;
class class_videos_front_browse extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function categories(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	<div class="ipsPageHeader ipsPad_half ipsClearfix ipsSpacer_bottom">
		<h1 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'module__videos_categories', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	</div>
	<div class='ipsBox'>
		

CONTENT;

endif;
$return .= <<<CONTENT

<ol class="ipsDataList ipsDataList_large">
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->categoryRow( NULL, NULL, \IPS\videos\Category::roots() );
$return .= <<<CONTENT

</ol>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT
	
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function categoriesBlock( $currentCategory=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$categories = $currentCategory ? $currentCategory->children() : \IPS\videos\Category::roots();
$return .= <<<CONTENT


CONTENT;

if ( !empty( $categories ) ):
$return .= <<<CONTENT

<div id='elVideosCategories' class='ipsWidget ipsWidget_vertical ipsBox'>
	<h3 class='ipsWidget_title ipsType_reset'>
CONTENT;

if ( $currentCategory ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'video_subcategories', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'video_categories', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h3>
	<div class='ipsWidget_inner'>
		<div class='ipsSideMenu'>
			<ul class='ipsSideMenu_list'>
				
CONTENT;

foreach ( $categories as $idx => $category ):
$return .= <<<CONTENT

                    
CONTENT;

if ( !\IPS\Request::i()->group OR ( \IPS\Request::i()->group AND $category->_options->cat_group AND $category->_options->cat_group == \IPS\Request::i()->group )  ):
$return .= <<<CONTENT

    					<li>
    						<a href="
CONTENT;
$return .= htmlspecialchars( $category->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsSideMenu_item 
CONTENT;

if ( $currentCategory && $currentCategory->id == $category->id ):
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 ipsTruncate ipsTruncate_line'><span class='ipsBadge ipsBadge_style1 ipsPos_right cVideosCategoryCount'>
CONTENT;

$return .= htmlspecialchars( \IPS\videos\Video::contentCount( $category ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span><strong class='ipsType_normal'>
CONTENT;
$return .= htmlspecialchars( $category->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></a>
    						
CONTENT;

if ( $category->hasChildren() ):
$return .= <<<CONTENT

    							<ul class="ipsSideMenu_list">
    								
CONTENT;

foreach ( $category->children() as $idx => $subcategory ):
$return .= <<<CONTENT

    									<li>
    										
CONTENT;

if ( $idx >= 5 ):
$return .= <<<CONTENT

    											<a href='
CONTENT;
$return .= htmlspecialchars( $category->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsSideMenu_item'><span class='ipsType_light ipsType_small'>
CONTENT;

$sprintf = array(count( $category->children() ) - 5); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_x_more', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span></a>
    											
CONTENT;

break;
$return .= <<<CONTENT

    										
CONTENT;

else:
$return .= <<<CONTENT

    											<a href="
CONTENT;
$return .= htmlspecialchars( $subcategory->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsSideMenu_item ipsTruncate ipsTruncate_line'><strong class='ipsPos_right ipsType_small cVideosCategoryCount'>
CONTENT;

$return .= htmlspecialchars( \IPS\videos\Video::contentCount( $subcategory ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
CONTENT;
$return .= htmlspecialchars( $subcategory->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
    										
CONTENT;

endif;
$return .= <<<CONTENT

    									</li>
    								
CONTENT;

endforeach;
$return .= <<<CONTENT

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

			</ul>
			<p class='ipsType_center'>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=videos&module=videos&controller=browse&do=categories", null, "videos_categories", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_all_categories', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</p>
		</div>
	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function categoryPage( $category, $table ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $category ):
$return .= <<<CONTENT

    <div class="ipsPageHeader ipsClearfix ipsSpacer_bottom">
		
CONTENT;

if ( $category->cat_image ):
$return .= <<<CONTENT

			<img src="
CONTENT;

$return .= \IPS\File::get( "videos_CategoryImage", $category->cat_image )->url;
$return .= <<<CONTENT
" class='ipsThumb ipsThumb_tiny'>
		
CONTENT;

endif;
$return .= <<<CONTENT
    
    	<h1 class="ipsType_pageTitle">
CONTENT;
$return .= htmlspecialchars( $category->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>
    	<div class='ipsPos_right ipsResponsive_noFloat ipsResponsive_hidePhone'>
    		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'videos', 'category', $category->_id, \IPS\videos\Video::containerFollowers( $category )->count( TRUE ) );
$return .= <<<CONTENT

    	</div>
    	
CONTENT;

if ( $category->description ):
$return .= <<<CONTENT

    		<div class='ipsPageHeader_info ipsType_normal'>
    			{$category->description}
    		</div>
    	
CONTENT;

endif;
$return .= <<<CONTENT

        
    	
CONTENT;

if ( $category->_rules ):
$return .= <<<CONTENT

    		<div class='ipsMessage ipsMessage_info'>
    			{$category->_rules}
    		</div>
    	
CONTENT;

endif;
$return .= <<<CONTENT
         
    </div>

CONTENT;

else:
$return .= <<<CONTENT

    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('page__listall') );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( \IPS\videos\Category::canOnAny('add') AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

    <ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsSpacer_bottom">
        <li class='ipsToolList_primaryAction'>
        	<a class="ipsButton ipsButton_medium ipsButton_normal ipsButton_fullWidth" href="
CONTENT;

if ( $category ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $category->url()->setQueryString( array( 'filter' => 'filter_myvideos' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=videos&module=videos&controller=browse&do=listall&filter=filter_myvideos", null, "videos_listall", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_videos_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
        </li>     
        <li class='ipsToolList_primaryAction'>
        	<a class="ipsButton ipsButton_medium ipsButton_important ipsButton_fullWidth" 
CONTENT;

if ( isset( $category ) && !$category->cat_only AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=videos&module=videos&controller=submit&do=submit&category={$category->_id}", null, "videos_add", array(), 0 ) );
$return .= <<<CONTENT
"
CONTENT;

else:
$return .= <<<CONTENT
href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=videos&module=videos&controller=submit&_new=1", null, "videos_add", array(), 0 ) );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-size='narrow'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
        </li>
    </ul>

CONTENT;

endif;
$return .= <<<CONTENT


<div class='ipsClear ipsBox'>
{$table}
</div>
CONTENT;

		return $return;
}

	function categoryRow( $table, $headers, $categories ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $categories as $category ):
$return .= <<<CONTENT

	
CONTENT;

if ( $category->can('view') ):
$return .= <<<CONTENT
    
        
CONTENT;

if ( !\IPS\Request::i()->group OR ( \IPS\Request::i()->group AND $category->_options->cat_group AND $category->_options->cat_group == \IPS\Request::i()->group )  ):
$return .= <<<CONTENT
     
    		<li class="ipsDataItem ipsDataItem_responsivePhoto ipsClearfix">
    			<div class='ipsDataItem_icon'>
                    
CONTENT;

if ( $category->cat_image ):
$return .= <<<CONTENT

            			<img src="
CONTENT;

$return .= \IPS\File::get( "videos_CategoryImage", $category->cat_image )->url;
$return .= <<<CONTENT
" class='ipsThumb ipsThumb_tiny'>
                    
CONTENT;

else:
$return .= <<<CONTENT
            
        				<span class='ipsItemStatus ipsItemStatus_large 
CONTENT;

if ( !\IPS\videos\Video::containerUnread( $category ) ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
        					<i class="fa fa-video"></i>
        				</span>
                    
CONTENT;

endif;
$return .= <<<CONTENT

    			</div>
    			<div class="ipsDataItem_main ipsPos_middle">
    				<h4 class="ipsDataItem_title ipsType_large">
    					<a href="
CONTENT;
$return .= htmlspecialchars( $category->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $category->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
    				</h4>
    				
CONTENT;

if ( $category->hasChildren() ):
$return .= <<<CONTENT

    					<ul class="ipsDataItem_subList ipsList_inline">
    						
CONTENT;

foreach ( $category->children() as $subcategory ):
$return .= <<<CONTENT

    							<li class="
CONTENT;

if ( \IPS\videos\Video::containerUnread( $subcategory ) ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
">
    								<a href="
CONTENT;
$return .= htmlspecialchars( $subcategory->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $subcategory->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $category->description ):
$return .= <<<CONTENT

    					<p class="ipsDataItem_meta">{$category->description}</p>
    				
CONTENT;

endif;
$return .= <<<CONTENT

    			</div>
    			<dl class="ipsDataItem_stats ipsDataItem_statsLarge">
    				
CONTENT;

$count = \IPS\videos\Video::contentCount( $category );
$return .= <<<CONTENT

    				<dt class="ipsDataItem_stats_number">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $count );
$return .= <<<CONTENT
</dt>
    				<dd class="ipsDataItem_stats_type ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</dd>
    			</dl>
    			<ul class="ipsDataItem_lastPoster ipsDataItem_withPhoto">
    				
CONTENT;

if ( $lastPost = $category->lastVideo() ):
$return .= <<<CONTENT

    					<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $lastPost->author(), 'tiny' );
$return .= <<<CONTENT
</li>
    					<li><a href="
CONTENT;
$return .= htmlspecialchars( $lastPost->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsType_break ipsContained'>
CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $lastPost->title ), '0', "30" ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $lastPost->title ) ) > "30" ) ? '&hellip;' : '' );
$return .= <<<CONTENT
</a></li>
    					<li>
CONTENT;

$htmlsprintf = array($lastPost->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</li>
    					<li data-short="1 dy" class="ipsType_light">
CONTENT;

$val = ( $lastPost->date instanceof \IPS\DateTime ) ? $lastPost->date : \IPS\DateTime::ts( $lastPost->date );$return .= $val->html();
$return .= <<<CONTENT
</li>
    				
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


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function commentList( $table ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('module__videos_comments') );
$return .= <<<CONTENT


<div class='ipsBox'>
	{$table}
</div>
CONTENT;

		return $return;
}

	function featuredVideo( $video ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsCarousel_item ipsAreaBackground_reset ipsPad'>
	<div class='ipsColumns ipsColumns_collapsePhone'>
        
CONTENT;

if ( !\IPS\Settings::i()->vs_featured_embed ):
$return .= <<<CONTENT

    		<div class='ipsColumn ipsColumn_medium ipsType_center'>
    			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "videos" )->thumb( $video );
$return .= <<<CONTENT

    		</div>
        
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsColumn ipsColumn_fluid'>
			<h2 class='ipsType_pageTitle'>
				
CONTENT;

if ( $video->prefix() ):
$return .= <<<CONTENT

					<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search&do=tags&tag={$video->prefix( TRUE )}", null, "tags", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($video->prefix()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_tagged_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class='ipsTag_prefix'>
CONTENT;
$return .= htmlspecialchars( $video->prefix(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<a href='
CONTENT;
$return .= htmlspecialchars( $video->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $video->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				<span class='ipsType_large ipsType_light ipsType_unbold ipsType_noBreak'>
CONTENT;

$htmlsprintf = array($video->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
			</h2>
			<ul class='ipsList_inline'>
				<li>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->rating( 'large', $video->averageRating() );
$return .= <<<CONTENT

				</li>
				
CONTENT;

if ( \IPS\Settings::i()->vs_enable_comments ):
$return .= <<<CONTENT

					<li class='ipsType_normal'>
						
CONTENT;

if ( $video->num_comments ):
$return .= <<<CONTENT

							<i class='fa fa-comment'></i> 
CONTENT;
$return .= htmlspecialchars( $video->num_comments, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'><i class='fa fa-comment'></i> 0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>            
			
            
CONTENT;

if ( !\IPS\Settings::i()->vs_featured_embed ):
$return .= <<<CONTENT

    			<div class='ipsType_richText ipsType_normal ipsSpacer_top' data-ipsTruncate data-ipsTruncate-type="remove" data-ipsTruncate-size="2 lines">
    				{$video->truncated()}
    			</div>
            
CONTENT;

endif;
$return .= <<<CONTENT
            
            
            
CONTENT;

if ( \IPS\Settings::i()->vs_featured_embed ):
$return .= <<<CONTENT

                <div class='ipsType_normal ipsType_richText ipsContained ipsSpacer_top' 
CONTENT;

if ( \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT
style='max-width: 900px;'
CONTENT;

endif;
$return .= <<<CONTENT
> 
                    {$video->embed}
                </div>  
            
CONTENT;

endif;
$return .= <<<CONTENT
								
		</div>
	</div>
</li>
CONTENT;

		return $return;
}

	function index( $videos, $featured ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('module__videos_videos') );
$return .= <<<CONTENT



CONTENT;

if ( \IPS\videos\Category::canOnAny('add') AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

    <ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsSpacer_bottom">
        <li class='ipsToolList_primaryAction'>
        	<a class="ipsButton ipsButton_medium ipsButton_normal ipsButton_fullWidth" href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=videos&module=videos&controller=browse&do=listall&filter=filter_myvideos", null, "videos_listall", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_videos_button', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
        </li>     
        <li class='ipsToolList_primaryAction'>
        	<a class="ipsButton ipsButton_medium ipsButton_important ipsButton_fullWidth" href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=videos&module=videos&controller=submit&_new=1", null, "videos_add", array(), 0 ) );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-size='narrow'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_video', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
        </li>
    </ul>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( !empty( $featured ) ):
$return .= <<<CONTENT

	<div class='ipsBox ipsSpacer_bottom' data-controller='videos.front.index.featured'>
		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$pluralize = array( count($featured) ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured_videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
        
        
CONTENT;

if ( \IPS\Settings::i()->vs_featured_switch ):
$return .= <<<CONTENT

            <div style='max-height:620px !important;' class='ipsCarousel ipsClearfix' data-ipsCarousel data-ipsCarousel-fullSizeItems data-ipsCarousel-slideshow data-ipsCarousel-shadows='false'>
                <ul class='cVideosCarousel ipsClearfix' data-role="carouselItems">
        			
CONTENT;

foreach ( $featured as $idx => $video ):
$return .= <<<CONTENT

                        
CONTENT;

if ( $idx < 1 ):
$return .= <<<CONTENT

        				    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", "videos" )->featuredVideo( $video );
$return .= <<<CONTENT

                        
CONTENT;

endif;
$return .= <<<CONTENT

        			
CONTENT;

endforeach;
$return .= <<<CONTENT
     
                </ul>  
            </div> 
        
CONTENT;

else:
$return .= <<<CONTENT
   
    		<section id='elVideosFeatured'>
    			<div style='max-height:620px !important;' class='ipsCarousel ipsClearfix' data-ipsCarousel data-ipsCarousel-fullSizeItems data-ipsCarousel-slideshow data-ipsCarousel-shadows='false'>
    				<ul class='cVideosCarousel ipsClearfix' data-role="carouselItems">
    					
CONTENT;

foreach ( $featured as $video ):
$return .= <<<CONTENT

    						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", "videos" )->featuredVideo( $video );
$return .= <<<CONTENT

    					
CONTENT;

endforeach;
$return .= <<<CONTENT

    				</ul>
    				<span class='ipsCarousel_shadow ipsCarousel_shadowLeft'></span>
    				<span class='ipsCarousel_shadow ipsCarousel_shadowRight'></span>
    				<a href='#' class='ipsCarousel_nav ipsHide' data-action='prev'><i class='fa fa-chevron-left'></i></a>
    				<a href='#' class='ipsCarousel_nav ipsHide' data-action='next'><i class='fa fa-chevron-right'></i></a>
    			</div>
    		</section>
        
CONTENT;

endif;
$return .= <<<CONTENT

        
        
CONTENT;

if ( \IPS\Settings::i()->vs_featured_switch ):
$return .= <<<CONTENT

            <ul class='ipsGrid ipsGrid_collapsePhone ipsSpacer_top ipsSpacer_half'> 
        		
CONTENT;

foreach ( $featured as $idx => $video ):
$return .= <<<CONTENT

                    <li class='ipsGrid_span1 ipsType_center ipsAreaBackground_reset ipsClearfix ipsPad_half cFeaturedSwitch' data-videoID='
CONTENT;
$return .= htmlspecialchars( $video->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
                        
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "videos" )->thumb( $video, 'small' );
$return .= <<<CONTENT

                    </li>
        		
CONTENT;

endforeach;
$return .= <<<CONTENT

            </ul>
        
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT


<div class='ipsBox'>
	<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	<div class='ipsAreaBackground ipsPad_half'>
		
CONTENT;

if ( count( $videos ) ):
$return .= <<<CONTENT

			<div class='ipsClearfix'>
				<ul class='ipsGrid ipsGrid_collapsePhone'> 
					
CONTENT;

foreach ( $videos as $idx => $row ):
$return .= <<<CONTENT

                        <li class='ipsGrid_span3 ipsType_center ipsAreaBackground_reset ipsType_blendLinks ipsClearfix  
CONTENT;

if ( $row->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
' style='min-width: 150px;'>
                        	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "videos" )->thumb( $row );
$return .= <<<CONTENT

                    		<div class='ipsPad_half'>
                    			<h3 class='ipsType_medium ipsType_reset ipsTruncate ipsTruncate_line' data-ipsTruncate data-ipsTruncate-size='1 lines' data-ipsTruncate-type='remove'>
                                    <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
                    			</h3>
                    			<span class='ipsType_light ipsType_small ipsTruncate ipsTruncate_line'>
                                    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'tiny', NULL, 'ipsUserPhoto_tiny_videos' );
$return .= <<<CONTENT

                                    {$row->author()->link()} &middot; 
CONTENT;

$val = ( $row->date instanceof \IPS\DateTime ) ? $row->date : \IPS\DateTime::ts( $row->date );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
 &middot; 
CONTENT;

$pluralize = array( $row->views ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_video_views', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

                                </span>                 		
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

			<p class='ipsType_reset ipsType_light ipsPad'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_videos', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>      
</div>
<ul class="ipsToolList ipsToolList_horizontal ipsSpacer_both ipsClearfix">
	<li class='ipsToolList_primaryAction'>
		<a class="ipsButton ipsButton_medium ipsButton_normal ipsButton_fullWidth" href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=videos&module=videos&controller=browse&do=listall", null, "videos_listall", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'videos_view_more', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &rarr;</a>
	</li>
</ul>
CONTENT;

		return $return;
}

	function videoRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class="ipsDataItem ipsAreaBackground_reset 
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 
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

if ( $row->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
">
		<div class='ipsDataItem_icon ipsPos_top ipsResponsive_hidePhone'>
            
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "videos" )->thumb( $row, 'tiny' );
$return .= <<<CONTENT
	
		</div>
		<div class='ipsDataItem_main'>
            <h4 class='ipsDataItem_title ipsType_sectionHead'>
				
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT

					<span class='ipsItemStatus ipsItemStatus_small' data-ipsTooltip title='
CONTENT;

if ( $row->unread() === -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'updated', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'><i class="fa fa-circle"></i></span>&nbsp;
				
CONTENT;

endif;
$return .= <<<CONTENT
            
            
    			
CONTENT;

if ( $row->prefix() ):
$return .= <<<CONTENT

    				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $row->prefix( TRUE ), $row->prefix() );
$return .= <<<CONTENT

    			
CONTENT;

endif;
$return .= <<<CONTENT
        
    
				<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>

    			
CONTENT;

if ( $row->hidden() === -1 ):
$return .= <<<CONTENT

    				<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $row->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
    			
CONTENT;

elseif ( $row->hidden() === 1 ):
$return .= <<<CONTENT

    				<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span>
    			
CONTENT;

endif;
$return .= <<<CONTENT

                
CONTENT;

if ( $row->averageRating() ):
$return .= <<<CONTENT
<br>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rating( 'small', $row->averageRating() );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
<br>
		    </h4>
            
			
CONTENT;

if ( count( $row->tags() ) ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $row->tags() );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT
            
        </div>

		<ul class='ipsDataItem_stats'>			
			<li>
				<span class='ipsDataItem_stats_number'>
CONTENT;

$pluralize = array( $row->num_comments ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_video_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>				
			</li>		
			<li class='ipsType_light'>
				<span class='ipsDataItem_stats_number'>
CONTENT;

$pluralize = array( $row->views ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_video_views', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
			</li>			
		</ul>

		<ul class='ipsDataItem_lastPoster ipsDataItem_withPhoto'>
			<li>		
                
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'tiny' );
$return .= <<<CONTENT

			</li>
			<li>
				{$row->author()->link()}	
			</li>
			<li class="ipsType_light">
                
CONTENT;

$val = ( $row->__get( $row::$databaseColumnMap['date'] ) instanceof \IPS\DateTime ) ? $row->__get( $row::$databaseColumnMap['date'] ) : \IPS\DateTime::ts( $row->__get( $row::$databaseColumnMap['date'] ) );$return .= (string) $val->localeDate();
$return .= <<<CONTENT

			</li>
		</ul>                
		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck ipsType_noBreak ipsPos_center'>
				<a href='#elVideo
CONTENT;
$return .= htmlspecialchars( $row->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elVideo
CONTENT;
$return .= htmlspecialchars( $row->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_large ipsPos_middle ipsType_blendLinks' data-ipsMenu>
					<i class='fa fa-cog'></i> <i class='fa fa-caret-down'></i>
				</a>
                
				<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;
$return .= htmlspecialchars( $row->tableStates(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>

				<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide' id='elVideo
CONTENT;
$return .= htmlspecialchars( $row->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
					
CONTENT;

if ( $row->canEdit() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'edit' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $row->canHide() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'hide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $row->canUnhide() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

if ( $row->hidden() === 1 ):
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

if ( $row->hidden() === 1 ):
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

if ( $row->canFeature() AND !$row->featured ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'feature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $row->canUnfeature() AND $row->featured ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unfeature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $row->canMove() ):
$return .= <<<CONTENT
				
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'move' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $row->canDelete() ):
$return .= <<<CONTENT
	
                        <li class='ipsMenu_sep'></li>			
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

	function videoTable( $table, $headers, $rows, $quickSearch ) {
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
' data-controller='core.global.core.table
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT
,core.front.core.moderation
CONTENT;

endif;
$return .= <<<CONTENT
' 
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

if ( $table->title ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset ipsClear'>
CONTENT;

$val = "{$table->title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $table->canModerate() OR ( $table->showAdvancedSearch AND ( (isset( $table->sortOptions ) and !empty( $table->sortOptions )) OR $table->advancedSearch ) ) OR !empty( $table->filters ) OR $table->pages > 1 ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		
CONTENT;

if ( $table->canModerate() AND $table->showFilters ):
$return .= <<<CONTENT

			<ul class="ipsButtonRow ipsPos_right ipsClearfix">
				<li>
					<a class="ipsJS_show" href="#elCheck_menu" id="elCheck_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$val = "{$table->langPrefix}select_rows_tooltip"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsAutoCheck data-ipsAutoCheck-context="#elTable_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active">
						<span class="cAutoCheckIcon ipsType_medium"><i class="fa fa-square-o"></i></span> <i class="fa fa-caret-down"></i>
						<span class='ipsNotificationCount' data-role='autoCheckCount'>0</span>
					</a>
					<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide" id="elCheck_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
						<li class="ipsMenu_title">
CONTENT;

$val = "{$table->langPrefix}select_rows"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
						<li class="ipsMenu_item" data-ipsMenuValue="all"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						<li class="ipsMenu_item" data-ipsMenuValue="none"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'none', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

if ( count($table->getFilters()) ):
$return .= <<<CONTENT

							<li class="ipsMenu_sep"><hr></li>
							
CONTENT;

foreach ( $table->getFilters() as $filter ):
$return .= <<<CONTENT

								
CONTENT;

if ( $filter ):
$return .= <<<CONTENT

									<li class="ipsMenu_item" data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $filter, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><a href="#">
CONTENT;

$val = "{$filter}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

else:
$return .= <<<CONTENT

									<li class="ipsMenu_sep"><hr></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</li>
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
		<ul class="ipsButtonRow ipsPos_right ipsClearfix">
			
CONTENT;

if ( $table->showAdvancedSearch AND ( ( isset( $table->sortOptions ) and count( $table->sortOptions ) > 1 ) OR $table->advancedSearch ) ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

if ( isset($table->sortOptions)  ):
$return .= <<<CONTENT

					<a href="#elSortByMenu_menu" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="sortButton" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
							
CONTENT;

$custom = TRUE;
$return .= <<<CONTENT

							
CONTENT;

foreach ( $table->sortOptions as $k => $col ):
$return .= <<<CONTENT

								<li class="ipsMenu_item 
CONTENT;

if ( $col === $table->sortBy ):
$return .= <<<CONTENT

CONTENT;

$custom = FALSE;
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $col, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-sortDirection='
CONTENT;

if ( $col == 'date' OR $col == 'num_comments' OR $col == 'views' OR $col == 'video_rating' ):
$return .= <<<CONTENT
desc
CONTENT;

else:
$return .= <<<CONTENT
asc
CONTENT;

endif;
$return .= <<<CONTENT
'><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $col, 'sortdirection' => ( $col == 'date_run' OR $col == 'date' OR $col == 'num_comments' OR $col == 'views' OR $col == 'video_rating' ) ? 'desc' : 'asc', 'page' => '1' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$val = "{$table->langPrefix}sort_{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->advancedSearch ):
$return .= <<<CONTENT

							<li class="ipsMenu_item 
CONTENT;

if ( $custom ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-noSelect="true">
								<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'advancedSearchForm' => '1', 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_sort', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
					
CONTENT;

elseif ( $table->advancedSearch ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'advancedSearchForm' => '1', 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_sort', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( !empty( $table->filters ) ):
$return .= <<<CONTENT

				<li>
					<a href="#elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" data-role="tableFilterMenu" id="elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'filter_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
						<li data-action="tableFilter" data-ipsMenuValue='' class='ipsMenu_item 
CONTENT;

if ( !$table->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => '', 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection, 'page' => '1' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$table->langPrefix}all"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

foreach ( $table->filters as $k => $q ):
$return .= <<<CONTENT

							<li data-action="tableFilter" data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsMenu_item 
CONTENT;

if ( $k === $table->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection, 'page' => '1' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$table->langPrefix}{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
        
		<ul class='ipsButtonRow ipsPos_right ipsClearfix'>
			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'listType' => 'thumb', 'csrfKey' => \IPS\Session::i()->csrfKey ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='Set as thumbnail' class='
CONTENT;

if ( !isset( \IPS\Request::i()->cookie['listType'] ) OR \IPS\Request::i()->cookie['listType'] == 'thumb'  ):
$return .= <<<CONTENT
ipsButtonRow_active
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa fa-th-large'></i></a>
			</li>
			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'listType' => 'list', 'csrfKey' => \IPS\Session::i()->csrfKey ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='Set as list' class='
CONTENT;

if ( isset( \IPS\Request::i()->cookie['listType'] ) AND \IPS\Request::i()->cookie['listType'] == 'list'  ):
$return .= <<<CONTENT
ipsButtonRow_active
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa fa-th-list'></i></a>
			</li>
		</ul>       
		
		
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
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

if ( $table->canModerate() ):
$return .= <<<CONTENT

		<form action="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-role='moderationTools' data-ipsPageAction>
        <input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" />
	
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

            <div class='ipsAreaBackground'>
    			<ol class='ipsGrid ipsDataList ipsClear 
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
            </div>
		
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

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class="ipsAreaBackground ipsPad ipsClearfix" data-role="pageActionOptions">
				<div class="ipsPos_right">
					<select name="modaction" data-role="moderationAction">
						
CONTENT;

if ( $table->canModerate('unhide') ):
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

if ( $table->canModerate('feature') or $table->canModerate('unfeature') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='star' data-action='feature'>
								
CONTENT;

if ( $table->canModerate('feature') ):
$return .= <<<CONTENT

									<option value='feature'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unhide') ):
$return .= <<<CONTENT

									<option value='unfeature'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfeature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( $table->canModerate('pin') or $table->canModerate('unpin') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='thumb-tack' data-action='pin'>
								
CONTENT;

if ( $table->canModerate('pin') ):
$return .= <<<CONTENT

									<option value='pin'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unpin') ):
$return .= <<<CONTENT

									<option value='unpin'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unpin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( $table->canModerate('hide') or $table->canModerate('unhide') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='eye' data-action='hide'>
								
CONTENT;

if ( $table->canModerate('hide') ):
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

if ( $table->canModerate('unhide') ):
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

if ( $table->canModerate('lock') or $table->canModerate('unlock') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='lock' data-action='lock'>
								
CONTENT;

if ( $table->canModerate('lock') ):
$return .= <<<CONTENT

									<option value='lock'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unlock') ):
$return .= <<<CONTENT

									<option value='unlock'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( $table->canModerate('move') ):
$return .= <<<CONTENT

							<option value='move' data-icon='arrow-right'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('split_merge') ):
$return .= <<<CONTENT

							<option value='merge' data-icon='level-up'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( method_exists( $table, 'customActions' ) ):
$return .= <<<CONTENT

							
CONTENT;

foreach ( $table->customActions() as $action ):
$return .= <<<CONTENT

								
CONTENT;

if ( is_array( $action['action'] )  ):
$return .= <<<CONTENT

									<optgroup label="
CONTENT;

$val = "{$action['grouplabel']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='
CONTENT;
$return .= htmlspecialchars( $action['icon'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='
CONTENT;
$return .= htmlspecialchars( $action['groupaction'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
										
CONTENT;

foreach ( $action['action'] as $_action ):
$return .= <<<CONTENT

											<option value='
CONTENT;
$return .= htmlspecialchars( $_action['action'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$_action['label']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
										
CONTENT;

endforeach;
$return .= <<<CONTENT

									</optgroup>
								
CONTENT;

else:
$return .= <<<CONTENT

									<option value='
CONTENT;
$return .= htmlspecialchars( $action['action'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-icon='
CONTENT;
$return .= htmlspecialchars( $action['icon'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$action['label']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
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

if ( $table->savedActions ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'saved_actions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='tasks' data-action='saved_actions'>
								
CONTENT;

foreach ( $table->savedActions as $k => $v ):
$return .= <<<CONTENT

									<option value='savedAction-
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table instanceof \IPS\core\Followed\Table ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'adjust_follow', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='bell' data-action='adjust_follow'>
								<option value='follow_immediate'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_type_immediate_prefixed', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='follow_daily'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_type_daily_prefixed', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='follow_weekly'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_type_weekly_prefixed', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='follow_none'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_type_none', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
							</optgroup>
							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'adjust_follow_privacy', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='ban' data-action='adjust_follow_privacy'>
								<option value='follow_public'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_public', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='follow_anonymous'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_anonymous', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
							</optgroup>
							<option value='unfollow' data-icon='times'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfollow', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('delete') ):
$return .= <<<CONTENT

							<option value='delete' data-icon='times-circle'>
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
		</form>
	
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

	function videoThumbRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class="ipsGrid_span3 ipsType_center ipsAreaBackground_reset ipsType_blendLinks ipsClearfix ipsPad_half 
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 
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

if ( $row->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
">						
    	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "videos" )->thumb( $row );
$return .= <<<CONTENT

		<div class='ipsSpacer_top ipsSpacer_half'>
			<h3 class='ipsType_normal ipsType_reset ipsTruncate ipsTruncate_line' data-ipsTruncate data-ipsTruncate-size='1 lines' data-ipsTruncate-type='remove'>
                <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

            
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

                <div class='ipsPos_right'>
     				<a href='#elVideo
CONTENT;
$return .= htmlspecialchars( $row->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elVideo
CONTENT;
$return .= htmlspecialchars( $row->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_large ipsPos_middle ipsType_blendLinks' data-ipsMenu>
    					<i class='fa fa-cog'></i> <i class='fa fa-caret-down'></i>
    				</a>
    				<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;
$return .= htmlspecialchars( $row->tableStates(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
           
    				<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide' id='elVideo
CONTENT;
$return .= htmlspecialchars( $row->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
    					
CONTENT;

if ( $row->canEdit() ):
$return .= <<<CONTENT
				
    						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'edit' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $row->canHide() ):
$return .= <<<CONTENT
				
    						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'hide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $row->canUnhide() ):
$return .= <<<CONTENT
				
    						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

if ( $row->hidden() === 1 ):
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

if ( $row->hidden() === 1 ):
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

if ( $row->canFeature() ):
$return .= <<<CONTENT
				
    						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'feature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $row->canUnfeature() ):
$return .= <<<CONTENT
				
    						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unfeature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $row->canMove() ):
$return .= <<<CONTENT
				
    						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'move' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $row->canDelete() ):
$return .= <<<CONTENT
	
                            <li class='ipsMenu_sep'></li>			
    						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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
}}