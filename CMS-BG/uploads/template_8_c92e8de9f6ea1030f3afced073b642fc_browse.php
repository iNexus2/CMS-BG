<?php
namespace IPS\Theme\Cache;
class class_downloads_front_browse extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function categories(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	<div class="ipsPageHeader ipsPad_half ipsClearfix ipsSpacer_bottom" id='elDownloadersHeader' data-ipsSticky data-ipsSticky-disableIn='phone'>
		<h1 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( '__app_downloads', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;&nbsp;<a href='#elDownloadsCategories_menu' data-ipsMenu data-ipsMenu-appendTo='#elDownloadersHeader' id='elDownloadsCategories' class='ipsButton ipsButton_light ipsButton_small'><span class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloads_category_select', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;&nbsp;</span> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a></h1>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->categoryMenu( \IPS\downloads\Category::roots() );
$return .= <<<CONTENT

	</div>
	<div class='ipsBox'>
		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'categories', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>

CONTENT;

endif;
$return .= <<<CONTENT

		<ol class="ipsDataList ipsDataList_large">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->categoryRow( NULL, NULL, \IPS\downloads\Category::roots() );
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

	function categoriesSidebar( $currentCategory=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$categories = $currentCategory ? $currentCategory->children() : \IPS\downloads\Category::roots();
$return .= <<<CONTENT

<div id='elDownloadsCategories' class='ipsWidget ipsWidget_vertical ipsBox'>
	<h3 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

if ( $currentCategory ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'subcategories', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'categories', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h3>
	<div class='ipsPad_half'>
		<div class='ipsSideMenu'>
			<ul class='ipsSideMenu_list'>
				
CONTENT;

foreach ( $categories as $category ):
$return .= <<<CONTENT

					
CONTENT;

if ( $category->open OR \IPS\Member::loggedIn()->isAdmin() ):
$return .= <<<CONTENT

						<li>
							<a href="
CONTENT;
$return .= htmlspecialchars( $category->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsSideMenu_item ipsTruncate ipsTruncate_line'><span class='ipsBadge ipsBadge_style1 ipsPos_right cDownloadsCategoryCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( \IPS\downloads\File::contentCount( $category ) );
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

										
CONTENT;

if ( $subcategory->open OR \IPS\Member::loggedIn()->isAdmin() ):
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

$pluralize = array( count( $category->children() ) - 5 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_x_more', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
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
" class='ipsSideMenu_item ipsTruncate ipsTruncate_line'><strong class='ipsPos_right ipsType_small cDownloadsCategoryCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( \IPS\downloads\File::contentCount( $subcategory ) );
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

endif;
$return .= <<<CONTENT

									
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

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=downloads&module=downloads&controller=browse&do=categories", null, "downloads_categories", array(), 0 ) );
$return .= <<<CONTENT
' class=''>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'browse_categories_d', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-right'></i></a>
			</p>
		</div>
		
CONTENT;

if ( \IPS\Application::appIsEnabled( 'nexus' ) and \IPS\Settings::i()->idm_nexus_on ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "store", "nexus" )->chooseCurrency( $currentCategory ? $currentCategory->url() : \IPS\Http\Url::internal('app=downloads&module=downloads&controller=browse', 'front', 'downloads') );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function category( $category, $table ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPageHeader ipsClearfix ipsSpacer_bottom">
	<h1 class="ipsType_pageTitle">
CONTENT;
$return .= htmlspecialchars( $category->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>
	<div class='ipsPos_right ipsResponsive_noFloat ipsResponsive_hidePhone'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'downloads', 'category', $category->_id, \IPS\downloads\File::containerFollowers( $category )->count( TRUE ) );
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( $category->hasChildren() ):
$return .= <<<CONTENT

		<br>
		<a href='#elDownloadsCategories_menu' data-ipsMenu id='elDownloadsCategories' class='ipsButton ipsButton_fullWidth ipsButton_light ipsButton_small ipsResponsive_block ipsResponsive_hideDesktop'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'subcategory', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i></a>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $category->description ):
$return .= <<<CONTENT

		<div class='ipsPageHeader_info ipsType_normal'>
			{$category->description}
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->categoryMenu( $category->children() );
$return .= <<<CONTENT



CONTENT;

if ( \IPS\downloads\Category::canOnAny('add') AND ( !$category OR $category->can('add') )  ):
$return .= <<<CONTENT

<ul class="ipsToolList ipsToolList_horizontal ipsResponsive_hidePhone ipsClearfix ipsSpacer_both">
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->categoryButtons( \IPS\downloads\Category::canOnAny('add'), $category );
$return .= <<<CONTENT

</ul>

CONTENT;

endif;
$return .= <<<CONTENT


<div class='ipsBox cDownloadsCategoryTable'>
{$table}
</div>


CONTENT;

if ( \IPS\downloads\Category::canOnAny('add') AND ( !$category OR $category->can('add') )  ):
$return .= <<<CONTENT

<ul class="ipsToolList ipsToolList_horizontal ipsResponsive_showPhone ipsResponsive_block ipsClearfix ipsSpacer_top">
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->categoryButtons( \IPS\downloads\Category::canOnAny('add'), $category );
$return .= <<<CONTENT

</ul>

CONTENT;

endif;
$return .= <<<CONTENT


<div class='ipsResponsive_showPhone ipsResponsive_block ipsSpacer_top'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'downloads', 'category', $category->_id, \IPS\downloads\File::containerFollowers( $category )->count( TRUE ) );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function categoryButtons( $canSubmitFiles, $currentCategory=NULL ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $canSubmitFiles AND ( !$currentCategory OR $currentCategory->can('add') )  ):
$return .= <<<CONTENT

<li class='ipsToolList_primaryAction'>
	<a class="ipsButton ipsButton_medium ipsButton_important ipsButton_fullWidth" href="
CONTENT;

if ( $currentCategory ):
$return .= <<<CONTENT

CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=downloads&module=downloads&controller=submit&category={$currentCategory->id}&_new=1", null, "downloads_submit", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=downloads&module=downloads&controller=submit&_new=1", null, "downloads_submit", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_a_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-size='narrow'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_a_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</li>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function categoryMenu( $categories ) {
		$return = '';
		$return .= <<<CONTENT

<ul class='ipsMenu ipsMenu_auto ipsHide' id='elDownloadsCategories_menu'>
	
CONTENT;

foreach ( $categories as $cat ):
$return .= <<<CONTENT

		
CONTENT;

if ( $cat->can('view') ):
$return .= <<<CONTENT

			<li class='ipsMenu_item'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $cat->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><span class="ipsMenu_itemCount">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( \IPS\downloads\File::contentCount( $cat ) );
$return .= <<<CONTENT
</span>
CONTENT;
$return .= htmlspecialchars( $cat->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>

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

if ( $category->can('view') AND ( $category->open OR \IPS\Member::loggedIn()->isAdmin() ) ):
$return .= <<<CONTENT

		<li class="ipsDataItem ipsDataItem_responsivePhoto ipsClearfix">
			<div class='ipsDataItem_icon'>
				<span class='ipsItemStatus ipsItemStatus_large 
CONTENT;

if ( !\IPS\downloads\File::containerUnread( $category ) ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
					<i class="fa fa-download"></i>
				</span>
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

if ( \IPS\downloads\File::containerUnread( $subcategory ) ):
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

$count = \IPS\downloads\File::contentCount( $category );
$return .= <<<CONTENT

				<dt class="ipsDataItem_stats_number">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $count );
$return .= <<<CONTENT
</dt>
				<dd class="ipsDataItem_stats_type ipsType_light">
CONTENT;

$pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'files_no_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</dd>
			</dl>
			<ul class="ipsDataItem_lastPoster ipsDataItem_withPhoto">
				
CONTENT;

if ( $lastPost = $category->lastFile() ):
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
$return .= htmlspecialchars( $lastPost->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
					<li class='ipsType_blendLinks'>
CONTENT;

$htmlsprintf = array($lastPost->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</li>
					<li data-short="1 dy" class="ipsType_light">
CONTENT;

$val = ( $lastPost->submitted instanceof \IPS\DateTime ) ? $lastPost->submitted : \IPS\DateTime::ts( $lastPost->submitted );$return .= $val->html();
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		
CONTENT;

if ( method_exists( $table, 'canModerate' ) AND $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $category->_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $category ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function featuredFile( $file ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsCarousel_item ipsAreaBackground_reset ipsPad'>
	<div class='ipsColumns ipsColumns_collapsePhone'>
		<div class='ipsColumn ipsColumn_medium ipsType_center'>
			
CONTENT;

if ( $file->primary_screenshot ):
$return .= <<<CONTENT

            
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->thumbImage( $file->primary_screenshot_thumb, $file->name, 'large', '', 'view_this', $file->url() );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPos_left ipsNoThumb ipsThumb ipsThumb_large'></div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsColumn ipsColumn_fluid'>
			<h2 class='ipsType_pageTitle ipsContained_container'>
				
CONTENT;

if ( $file->prefix() ):
$return .= <<<CONTENT

					<span><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=search&controller=search&tags={$file->prefix( TRUE )}", null, "tags", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($file->prefix()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_tagged_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class='ipsTag_prefix'>
CONTENT;
$return .= htmlspecialchars( $file->prefix(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<a href='
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $file->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				
CONTENT;

if ( $file->mapped('pinned') || $file->hidden() === -1 || $file->hidden() === 1 ):
$return .= <<<CONTENT

					
CONTENT;

if ( $file->hidden() === -1 ):
$return .= <<<CONTENT

						<span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $file->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
					
CONTENT;

elseif ( $file->hidden() === 1 ):
$return .= <<<CONTENT

						<span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $file->mapped('pinned') ):
$return .= <<<CONTENT

						<span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				&nbsp; <span class='ipsType_large ipsType_light ipsType_unbold ipsType_noBreak'>
CONTENT;

$htmlsprintf = array($file->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
			</h2>
			<ul class='ipsList_inline ipsSpacer_top ipsSpacer_half'>
				
CONTENT;

if ( $price = $file->price() ):
$return .= <<<CONTENT

					<li>
						<span class='cFilePrice ipsType_large'>{$price}</span>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $file->container()->bitoptions['reviews'] ):
$return .= <<<CONTENT

					<li>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->rating( 'large', $file->rating, \IPS\Settings::i()->reviews_rating_out_of );
$return .= <<<CONTENT

					</li>
					<li class='ipsType_normal'>
						
CONTENT;

if ( $file->reviews ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( 'tab', 'reviews' )->setFragment('replies'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

$pluralize = array( $file->reviews ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_reviews', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

						
CONTENT;

if ( $file->reviews ):
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

if ( $file->isPaid() and in_array( 'purchases', explode( ',', \IPS\Settings::i()->idm_nexus_display ) ) ):
$return .= <<<CONTENT

					<li class='ipsType_normal'>
						
CONTENT;

if ( $purchases = $file->purchaseCount() ):
$return .= <<<CONTENT

							<i class='fa fa-shopping-cart'></i> 
CONTENT;
$return .= htmlspecialchars( $purchases, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'><i class='fa fa-shopping-cart'></i> 0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
				
CONTENT;

if ( !$file->isPaid() or in_array( 'downloads', explode( ',', \IPS\Settings::i()->idm_nexus_display ) ) ):
$return .= <<<CONTENT

					<li class='ipsType_normal'>
						
CONTENT;

if ( $file->downloads ):
$return .= <<<CONTENT

							<i class='fa fa-arrow-circle-down'></i> 
CONTENT;
$return .= htmlspecialchars( $file->downloads, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'><i class='fa fa-arrow-circle-down'></i> 0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
				
CONTENT;

if ( $file->container()->bitoptions['comments'] ):
$return .= <<<CONTENT

					<li class='ipsType_normal'>
						
CONTENT;

if ( $file->comments ):
$return .= <<<CONTENT

							<i class='fa fa-comment'></i> 
CONTENT;
$return .= htmlspecialchars( $file->comments, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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
			
			<div class='ipsType_richText ipsType_normal ipsSpacer_both' data-ipsTruncate data-ipsTruncate-type="remove" data-ipsTruncate-size="2 lines">
				{$file->truncated(TRUE)}
			</div>

			<ul class='ipsToolList ipsToolList_horizontal'>
				
CONTENT;

if ( ( $file->canDownload() or ( $file->container()->message('npd') and !$file->canBuy() ) ) && !$file->canBuy() ):
$return .= <<<CONTENT

					<li class='ipsToolList_primaryAction ipsPos_left'>
						<a href='
CONTENT;

if ( \IPS\Settings::i()->idm_antileech ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $file->url('download')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $file->url('download'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsButton ipsButton_important ipsButton_fullWidth ipsButton_small' 
CONTENT;

if ( $file->container()->message('disclaimer') or count( $file->files() ) > 1 or \IPS\Member::loggedIn()->group['idm_wait_period'] ):
$return .= <<<CONTENT
data-ipsDialog
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				
CONTENT;

elseif ( $file->canBuy() ):
$return .= <<<CONTENT

					<li class='ipsToolList_primaryAction ipsPos_left'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $file->url('buy')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_small ipsButton_fullWidth ipsButton_important'><i class='fa fa-shopping-cart'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'buy_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( $price ):
$return .= <<<CONTENT
 - 
CONTENT;

$return .= htmlspecialchars( strip_tags($price), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsPos_left'>
					<a href='
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_fullWidth ipsButton_small' title='
CONTENT;

$sprintf = array($file->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more_information', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
			</ul>								
		</div>
	</div>
</li>
CONTENT;

		return $return;
}

	function index( $featured, $new, $rated, $downloaded ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPageHeader ipsClearfix ipsSpacer_bottom">
	<h1 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloads', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
</div>
<a href='#elDownloadsCategories_menu' data-ipsMenu id='elDownloadsCategories' class='ipsButton ipsButton_light ipsButton_small ipsButton_fullWidth ipsResponsive_hideDesktop ipsResponsive_block ipsSpacer_bottom'><span class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloads_category_select', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;&nbsp;</span> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->categoryMenu( \IPS\downloads\Category::roots() );
$return .= <<<CONTENT



CONTENT;

if ( !empty( $featured ) ):
$return .= <<<CONTENT

	<div class='ipsBox ipsSpacer_bottom'>
		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured_downloads', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<section id='elDownloadsFeatured'>
			<div class='ipsCarousel ipsClearfix' data-ipsCarousel data-ipsCarousel-fullSizeItems data-ipsCarousel-slideshow data-ipsCarousel-shadows='false'>
				<ul class='cDownloadsCarousel ipsClearfix' data-role="carouselItems">
					
CONTENT;

foreach ( $featured as $file ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", "downloads" )->featuredFile( $file );
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
	</div>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( \IPS\downloads\Category::canOnAny('add') ):
$return .= <<<CONTENT

	<ul class="ipsToolList ipsToolList_horizontal ipsResponsive_hidePhone ipsClearfix ipsSpacer_bottom">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->categoryButtons( \IPS\downloads\Category::canOnAny('add') );
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

	
	<div class='ipsBox'>
		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'browse_whats_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class='ipsAreaBackground ipsPad_half'>
			
CONTENT;

if ( count( $new ) ):
$return .= <<<CONTENT

				<div class='ipsCarousel ipsClearfix' data-ipsCarousel data-ipsCarousel-showDots>
					<ul class='cDownloadsCarousel' data-role="carouselItems">
						
CONTENT;

foreach ( $new as $idx => $file ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->indexBlock( $file );
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
			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_light ipsPad'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>

	<div class='ipsBox ipsSpacer_top'>
		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'browse_highest_rated', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class='ipsAreaBackground ipsPad_half'>
			
CONTENT;

if ( count( $rated ) ):
$return .= <<<CONTENT

				<div class='ipsCarousel ipsClearfix' data-ipsCarousel data-ipsCarousel-showDots>
					<ul class='cDownloadsCarousel' data-role="carouselItems">
						
CONTENT;

foreach ( $rated as $idx => $file ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->indexBlock( $file );
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
			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_light ipsPad'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_rated_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>

	<div class='ipsBox ipsSpacer_top'>
		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'browse_most_downloaded', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class='ipsAreaBackground ipsPad_half'>
			
CONTENT;

if ( count( $downloaded ) ):
$return .= <<<CONTENT

				<div class='ipsCarousel ipsClearfix' data-ipsCarousel data-ipsCarousel-showDots>
					<ul class='cDownloadsCarousel' data-role="carouselItems">
						
CONTENT;

foreach ( $downloaded as $idx => $file ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->indexBlock( $file );
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
			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_light ipsPad'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_downloaded_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>


CONTENT;

if ( \IPS\downloads\Category::canOnAny('add') ):
$return .= <<<CONTENT

	<ul class="ipsToolList ipsToolList_horizontal ipsResponsive_showPhone ipsResponsive_block ipsClearfix ipsSpacer_top">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->categoryButtons( \IPS\downloads\Category::canOnAny('add') );
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function indexBlock( $file ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsAreaBackground_reset ipsType_blendLinks ipsClearfix cDownloadsCarouselItem ipsPad_half ipsCarousel_item'>
	<a href='
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$sprintf = array($file->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->thumbImage( $file->primary_screenshot_thumb, $file->name );
$return .= <<<CONTENT

    </a>
		<div class='cDownloadsCarouselItem_info ipsSpacer_top ipsSpacer_half'>
			<h3 class='ipsType_normal ipsType_reset ipsTruncate ipsTruncate_line'>
				
CONTENT;

if ( $file->unread() ):
$return .= <<<CONTENT

					<span class='ipsItemStatus ipsItemStatus_small' data-ipsTooltip title='
CONTENT;

if ( $file->unread() === -1 ):
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

                <a href='
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$sprintf = array($file->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $file->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				
CONTENT;

if ( $file->mapped('pinned') || $file->hidden() === -1 || $file->hidden() === 1 ):
$return .= <<<CONTENT

					
CONTENT;

if ( $file->hidden() === -1 ):
$return .= <<<CONTENT

						<span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $file->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
					
CONTENT;

elseif ( $file->hidden() === 1 ):
$return .= <<<CONTENT

						<span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $file->mapped('pinned') ):
$return .= <<<CONTENT

						<span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</h3>
			
			<p class='ipsType_medium ipsType_reset ipsType_blendLinks ipsTruncate ipsTruncate_line'>
CONTENT;

$htmlsprintf = array($file->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

if ( $file->container()->bitoptions['reviews'] ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->rating( 'medium', $file->rating, \IPS\Settings::i()->reviews_rating_out_of );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<p class='ipsType_medium ipsType_reset'>
				
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

$pluralize = array( $file->purchaseCount() ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_purchases', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
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

$pluralize = array( $file->downloads ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_downloads', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
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

$pluralize = array( $file->comments ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-comment'></i> 
CONTENT;
$return .= htmlspecialchars( $file->comments, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
			
			
CONTENT;

if ( \IPS\Application::appIsEnabled( 'nexus' ) and \IPS\Settings::i()->idm_nexus_on ):
$return .= <<<CONTENT

				<span class="cFilePrice ipsType_medium">
					
CONTENT;

if ( $file->isPaid() ):
$return .= <<<CONTENT

						
CONTENT;

if ( $price = $file->price() ):
$return .= <<<CONTENT

							{$price}
						
CONTENT;

else:
$return .= <<<CONTENT

							&nbsp;
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_free', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
</li>
CONTENT;

		return $return;
}

	function indexSidebar( $canSubmitFiles, $currentCategory=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->categoriesSidebar( $currentCategory );
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function noFiles( $category ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsType_center ipsPad'>
	<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_files_in_cat', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>

	
CONTENT;

if ( $category->can('add') ):
$return .= <<<CONTENT

		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=downloads&module=downloads&controller=submit&_new=1&category={$category->id}", null, "downloads_submit", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_medium' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_first_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-size='narrow'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_first_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function rows( $table, $headers, $files ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $files ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $files as $file ):
$return .= <<<CONTENT

		<li class='ipsDataItem 
CONTENT;

if ( $file->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( method_exists( $file, 'tableClass' ) && $file->tableClass() ):
$return .= <<<CONTENT
ipsDataItem_
CONTENT;
$return .= htmlspecialchars( $file->tableClass(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $file->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
'>
			<div class='ipsDataItem_generic ipsDataItem_size3 ipsPos_top'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->thumbImage( $file->primary_screenshot_thumb, $file->name, 'medium', '', 'view_this', $file->url() );
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Application::appIsEnabled( 'nexus' ) and \IPS\Settings::i()->idm_nexus_on ):
$return .= <<<CONTENT

					<p class='ipsType_large ipsType_center ipsType_reset ipsSpacer_top ipsSpacer_half'>
						<span class='cFilePrice'>
							
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_free', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</span>
					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main'>
				<h4 class='ipsDataItem_title ipsType_sectionHead ipsContained_container'>
					
CONTENT;

if ( $file->unread() ):
$return .= <<<CONTENT

						<span><span class='ipsItemStatus ipsItemStatus_small' data-ipsTooltip title='
CONTENT;

if ( $file->unread() === -1 ):
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
'><i class="fa fa-circle"></i></span>&nbsp;</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
					
CONTENT;

if ( $file->mapped('pinned') || $file->mapped('featured') || $file->hidden() === -1 || $file->hidden() === 1 ):
$return .= <<<CONTENT

						
CONTENT;

if ( $file->hidden() === -1 ):
$return .= <<<CONTENT

							<span><span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $file->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
						
CONTENT;

elseif ( $file->hidden() === 1 ):
$return .= <<<CONTENT

							<span><span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $file->mapped('pinned') ):
$return .= <<<CONTENT

							<span><span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $file->mapped('featured') ):
$return .= <<<CONTENT

							<span><span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_positive" data-ipsTooltip title='
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

if ( $file->prefix() ):
$return .= <<<CONTENT

						<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $file->prefix( TRUE ), $file->prefix() );
$return .= <<<CONTENT
</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
					<div class='ipsType_break ipsContained'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$sprintf = array($file->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 
CONTENT;

if ( $file->canEdit() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'click_hold_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsTruncate ipsTruncate_line' 
CONTENT;

if ( $file->canEdit() ):
$return .= <<<CONTENT
data-role="editableTitle"
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $file->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
				</h4>
				<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
					
CONTENT;

$htmlsprintf = array($file->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Request::i()->app != 'downloads' ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href="
CONTENT;
$return .= htmlspecialchars( $file->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $file->container()->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>
				<div class='ipsType_medium ipsType_richText ipsType_break ipsSpacer_top' data-ipsTruncate data-ipsTruncate-type="remove" data-ipsTruncate-size="2 lines">
					{$file->truncated()}
				</div>

				<p class='ipsType_normal'>
					
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
><i class='fa fa-shopping-cart'></i> 
CONTENT;

$pluralize = array( $file->purchaseCount() ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_purchases', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
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
><i class='fa fa-arrow-circle-down'></i> 
CONTENT;

$pluralize = array( $file->downloads ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_downloads', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>

				
CONTENT;

if ( count( $file->tags() ) ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $file->tags() );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_generic ipsDataItem_size8'>
				
CONTENT;

if ( $file->container()->bitoptions['reviews'] ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->rating( 'large', $file->averageReviewRating(), \IPS\Settings::i()->reviews_rating_out_of, $file->memberReviewRating() );
$return .= <<<CONTENT
&nbsp;&nbsp; <span class='ipsType_normal ipsType_light'>(
CONTENT;

$pluralize = array( $file->reviews ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_reviews', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
)</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $file->container()->bitoptions['comments'] ):
$return .= <<<CONTENT

					<p class='ipsType_normal'>
						
CONTENT;

if ( $file->comments ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( 'tab', 'comments' )->setFragment('replies'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $file->comments ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

						
CONTENT;

if ( $file->comments ):
$return .= <<<CONTENT

							</a>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<p class='ipsType_medium'><strong>
CONTENT;

if ( $file->updated == $file->submitted ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submitted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $file->submitted instanceof \IPS\DateTime ) ? $file->submitted : \IPS\DateTime::ts( $file->submitted );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'updated', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $file->updated instanceof \IPS\DateTime ) ? $file->updated : \IPS\DateTime::ts( $file->updated );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</strong></p>
			</div>
			
CONTENT;

if ( method_exists( $table, 'canModerate' ) AND $table->canModerate() ):
$return .= <<<CONTENT

				<div class='ipsDataItem_modCheck'>
					<span class='ipsCustomInput'>
						<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $file->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $file ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $file->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $file->tableStates(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}