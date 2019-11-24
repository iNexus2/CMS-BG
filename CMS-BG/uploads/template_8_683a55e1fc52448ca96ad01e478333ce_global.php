<?php
namespace IPS\Theme\Cache;
class class_downloads_front_global extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function commentTableHeader( $comment, $file ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsDataList ipsAreaBackground_light ipsClearfix'>
	<div class='ipsDataItem'>
		<div class='ipsDataItem_generic ipsDataItem_size2'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->thumbImage( $file->primary_screenshot, $file->name, 'small', '', 'view_this', $file->url() );
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<h3 class='ipsType_sectionHead'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$sprintf = array($file->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $file->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h3>
			<p class='ipsType_normal ipsType_light ipsType_blendLinks ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $file->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $file->container()->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></p>
			
CONTENT;

if ( $file->container()->bitoptions['reviews'] ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->rating( 'large', $file->rating, \IPS\Settings::i()->reviews_rating_out_of );
$return .= <<<CONTENT
 &nbsp;&nbsp;
			
CONTENT;

endif;
$return .= <<<CONTENT


			<span class='ipsType_reset'>
CONTENT;

if ( !$file->downloads ):
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

endif;
$return .= <<<CONTENT
<i class='fa fa-arrow-circle-down'></i> 
CONTENT;
$return .= htmlspecialchars( $file->downloads, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( !$file->downloads ):
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $file->container()->bitoptions['comments'] ):
$return .= <<<CONTENT
&nbsp;&nbsp;
CONTENT;

if ( !$file->comments ):
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

endif;
$return .= <<<CONTENT
<i class='fa fa-comment'></i> 
CONTENT;
$return .= htmlspecialchars( $file->comments, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( !$file->comments ):
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT
</span>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function manageFollowRow( $table, $headers, $rows, $includeFirstCommentInCommentCount=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$idField = $row::$databaseColumnId;
$return .= <<<CONTENT

		<li class="ipsDataItem ipsDataItem_responsivePhoto 
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
" data-controller='core.front.system.manageFollowed' data-followID='
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_area'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
-
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_rel_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<div class='ipsDataItem_generic ipsDataItem_size2 ipsDataItem_imageColumn'>
				
CONTENT;

if ( $row->_primary_screenshot  ):
$return .= <<<CONTENT

					<div class='ipsThumb ipsThumb_bg ipsThumb_small' style='background-image: url( 
CONTENT;

$return .= htmlspecialchars( str_replace( array( '(', ')' ), array( '\(', '\)' ), $row->primary_screenshot->url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 )'></div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<span class='ipsThumb ipsNoThumb ipsThumb_small' />
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main ipsPos_middle'>
				<h4 class='ipsDataItem_title ipsContained_container'>
					
CONTENT;

if ( $row->mapped('locked') ):
$return .= <<<CONTENT

						<i class="fa fa-lock"></i>
					
CONTENT;

endif;
$return .= <<<CONTENT


					
CONTENT;

if ( $row->mapped('pinned') || $row->mapped('featured') || $row->hidden() === -1 || $row->hidden() === 1 ):
$return .= <<<CONTENT

						<span>
							
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

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT

								<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT

								<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
					
CONTENT;

if ( $row->prefix() ):
$return .= <<<CONTENT

						<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $row->prefix( TRUE ), $row->prefix() );
$return .= <<<CONTENT
</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
					<div class='ipsType_break ipsContained'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
							
CONTENT;

if ( $row->mapped('title') ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
<em class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em>
CONTENT;

endif;
$return .= <<<CONTENT

						</a>
					</div>
				</h4>
				<div class='ipsDataItem_meta ipsType_light ipsType_blendLinks' data-ipsTruncate data-ipsTruncate-size='2 lines' data-ipsTruncate-type='remove'>
					
CONTENT;

if ( method_exists( $row, 'tableDescription' ) ):
$return .= <<<CONTENT

						{$row->tableDescription()}
					
CONTENT;

else:
$return .= <<<CONTENT

                        
CONTENT;

$htmlsprintf = array($row->author()->link( $row->warningRef() )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $row->__get( $row::$databaseColumnMap['date'] ) instanceof \IPS\DateTime ) ? $row->__get( $row::$databaseColumnMap['date'] ) : \IPS\DateTime::ts( $row->__get( $row::$databaseColumnMap['date'] ) );$return .= $val->html();
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href="
CONTENT;
$return .= htmlspecialchars( $row->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $row->container()->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>				
			</div>

			<div class='ipsDataItem_generic ipsDataItem_size1 ipsType_center ipsType_large cFollowedContent_anon'>
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

			<div class='ipsDataItem_generic ipsDataItem_size6 cFollowedContent_info'>
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

			<div class='ipsDataItem_generic ipsDataItem_size6 ipsType_center cFollowedContent_manage'>
				
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
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $row->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->tableStates(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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
}

	function searchResultCommentSnippet( $indexData, $screenshot, $url, $reviewRating, $condensed ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $condensed ):
$return .= <<<CONTENT

	
CONTENT;

if ( $screenshot ):
$return .= <<<CONTENT

		<span class='ipsThumb_bg ipsThumb_small ipsPos_left' style='background-image: url("
CONTENT;

$return .= \IPS\File::get( "downloads_Screenshots", $screenshot )->url;
$return .= <<<CONTENT
")'>
			<img src='
CONTENT;

$return .= \IPS\File::get( "downloads_Screenshots", $screenshot )->url;
$return .= <<<CONTENT
' alt='' class="">
		</span>
	
CONTENT;

else:
$return .= <<<CONTENT

		<span class='ipsNoThumb ipsThumb_small ipsPos_left'></span>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsColumns ipsColumns_collapsePhone ipsColumns_noSpacing'>
		<div class='ipsColumn ipsColumn_narrow'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				
CONTENT;

if ( $screenshot ):
$return .= <<<CONTENT

					<img src='
CONTENT;

$return .= \IPS\File::get( "downloads_Screenshots", $screenshot )->url;
$return .= <<<CONTENT
' class='ipsImage ipsStream_image'>
				
CONTENT;

else:
$return .= <<<CONTENT

					<div class='ipsNoThumb ipsNoThumb_file ipsThumb_medium'></div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		</div>
		<div class='ipsColumn ipsColumn_fluid'>
			<div class='ipsStream_comment ipsPad'>
				
CONTENT;

if ( $reviewRating !== NULL ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rating( 'medium', $reviewRating, \IPS\Settings::i()->reviews_rating_out_of );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( trim( $indexData['index_content'] ) !== '' ):
$return .= <<<CONTENT

					<div class='ipsType_richText ipsType_break ipsType_medium' 
CONTENT;

if ( !( \IPS\Dispatcher::i()->application->directory == 'core' and \IPS\Dispatcher::i()->module and \IPS\Dispatcher::i()->module->key == 'search' ) ):
$return .= <<<CONTENT
data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='3 lines' data-ipsTruncate-watch='false'
CONTENT;

else:
$return .= <<<CONTENT
data-searchable data-findTerm
CONTENT;

endif;
$return .= <<<CONTENT
>
						{$indexData['index_content']}
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function searchResultFileSnippet( $indexData, $itemData, $screenshot, $url, $price, $condensed ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $condensed ):
$return .= <<<CONTENT

	
CONTENT;

if ( $screenshot ):
$return .= <<<CONTENT

		<span class='ipsThumb_bg ipsThumb_small ipsPos_left' style='background-image: url("
CONTENT;

$return .= \IPS\File::get( "downloads_Screenshots", $screenshot )->url;
$return .= <<<CONTENT
")'>
			<img src='
CONTENT;

$return .= \IPS\File::get( "downloads_Screenshots", $screenshot )->url;
$return .= <<<CONTENT
' alt='' class="">
		</span>
	
CONTENT;

else:
$return .= <<<CONTENT

		<span class='ipsNoThumb ipsThumb_small ipsPos_left'></span>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsColumns ipsColumns_collapsePhone'>
		<div class='ipsColumn ipsColumn_medium'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				
CONTENT;

if ( $screenshot ):
$return .= <<<CONTENT

					<img src='
CONTENT;

$return .= \IPS\File::get( "downloads_Screenshots", $screenshot )->url;
$return .= <<<CONTENT
' class='ipsImage ipsStream_image'>
				
CONTENT;

else:
$return .= <<<CONTENT

					<div class='ipsNoThumb ipsThumb_small'></div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		</div>
		<div class='ipsColumn ipsColumn_fluid ipsStream_snippetInfo'>
			<p class='ipsType_reset ipsType_light ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'version', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $itemData['file_version'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
			
CONTENT;

if ( !$price or in_array( 'downloads', explode( ',', \IPS\Settings::i()->idm_nexus_display ) )  ):
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_normal'><i class='fa fa-download'></i> 
CONTENT;

$pluralize = array( $itemData['file_downloads'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_downloads', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT


			
			
CONTENT;

if ( trim( $indexData['index_content'] ) !== '' ):
$return .= <<<CONTENT

				<div class='ipsSpacer_top ipsSpacer_half ipsType_richText ipsType_break ipsType_medium' 
CONTENT;

if ( !( \IPS\Dispatcher::i()->application->directory == 'core' and \IPS\Dispatcher::i()->module and \IPS\Dispatcher::i()->module->key == 'search' ) ):
$return .= <<<CONTENT
data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='2 lines' data-ipsTruncate-watch='false'
CONTENT;

else:
$return .= <<<CONTENT
data-searchable data-findTerm
CONTENT;

endif;
$return .= <<<CONTENT
>
					{$indexData['index_content']}
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
			
CONTENT;

if ( \IPS\Application::appIsEnabled( 'nexus' ) and \IPS\Settings::i()->idm_nexus_on ):
$return .= <<<CONTENT

				<p class='ipsType_large ipsType_reset ipsSpacer_top ipsSpacer_half'>
					<span class='ipsStream_price'>
						
CONTENT;

if ( $price ):
$return .= <<<CONTENT

							{$price}
						
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
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}