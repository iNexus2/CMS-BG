<?php
namespace IPS\Theme\Cache;
class class_downloads_front_view extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function changeLog( $file, $version ) {
		$return = '';
		$return .= <<<CONTENT

<p class='ipsType_reset ipsType_light'>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $version['b_backup'] )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_version_released', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
<div class='ipsType_richText ipsType_normal'>
	
CONTENT;

if ( $version['b_changelog'] ):
$return .= <<<CONTENT

		{$version['b_changelog']}
	
CONTENT;

else:
$return .= <<<CONTENT

		<p><em>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_no_changelog', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em></p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

if ( isset( $version['b_id'] ) and ( $file->canDownload() or ( $file->canEdit() and \IPS\Member::loggedIn()->group['idm_bypass_revision'] ) ) ):
$return .= <<<CONTENT

	<ul class='ipsList_inline'>
		<li><img src='
CONTENT;

$return .= \IPS\Theme::i()->resource( "subitem_stem.png", "core", '', false );
$return .= <<<CONTENT
' alt=''> <strong>
CONTENT;

$sprintf = array($version['b_version']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'with_version', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong></li>
		
CONTENT;

if ( $file->canDownload() ):
$return .= <<<CONTENT

			<li><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'do' => 'download', 'version' => $version['b_id'] ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $file->container()->message('disclaimer') or count( $file->files( $version['b_id'] ) ) > 1 ):
$return .= <<<CONTENT
data-ipsDialog
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $file->canEdit() and \IPS\Member::loggedIn()->group['idm_bypass_revision'] ):
$return .= <<<CONTENT

			<li><a href="
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'do' => 'restorePreviousVersion', 'version' => $version['b_id'] ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-confirm data-confirmMessage="
CONTENT;

$sprintf = array($version['b_version']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'version_restore_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" data-confirmSubMessage="
CONTENT;

$sprintf = array($version['b_version']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'version_restore_confirm_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'do' => 'deletePreviousVersion', 'version' => $version['b_id'] ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmMessage="
CONTENT;

$sprintf = array($version['b_version']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'version_delete_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'do' => 'previousVersionVisibility', 'version' => $version['b_id'] ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					
CONTENT;

if ( $version['b_hidden'] ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide_from_members', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide_from_members', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function commentForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='' ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" 
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT
enctype="multipart/form-data"
CONTENT;

endif;
$return .= <<<CONTENT
>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT

		<input type="hidden" name="MAX_FILE_SIZE" value="
CONTENT;
$return .= htmlspecialchars( $uploadField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<input type="hidden" name="plupload" value="
CONTENT;

$return .= htmlspecialchars( md5( uniqid() ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsAreaBackground_light ipsPad'>
		<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'write_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<ul class='ipsForm ipsForm_vertical'>
			
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

					{$input}
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

			<li class='ipsFieldRow ipsClearfix'>
				<div class='ipsFieldRow_content'>
					<button type='submit' class='ipsButton ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				</div>
			</li>
		</ul>
	</div>
</form>
CONTENT;

		return $return;
}

	function comments( $file ) {
		$return = '';
		$return .= <<<CONTENT


<div data-controller='core.front.core.commentFeed, core.front.core.ignoredComments' 
CONTENT;

if ( \IPS\Settings::i()->auto_polling_enabled ):
$return .= <<<CONTENT
data-autoPoll
CONTENT;

endif;
$return .= <<<CONTENT
 data-commentsType='comments' data-baseURL='
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $file->isLastPage() ):
$return .= <<<CONTENT
data-lastPage
CONTENT;

endif;
$return .= <<<CONTENT
 data-feedID='file-
CONTENT;
$return .= htmlspecialchars( $file->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='comments'>
	
CONTENT;

if ( $file->commentPageCount() > 1 ):
$return .= <<<CONTENT

		{$file->commentPagination( array( 'tab' ) )}
		<br><br>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div data-role='commentFeed' data-controller='core.front.core.moderation'>
		
CONTENT;

if ( count( $file->comments() ) ):
$return .= <<<CONTENT

			<form action="
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( 'do', 'multimodComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-ipsPageAction data-role='moderationTools'>
				
CONTENT;

$commentCount=0; $timeLastRead = $file->timeLastRead(); $lined = FALSE;
$return .= <<<CONTENT

				
CONTENT;

foreach ( $file->comments() as $comment ):
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

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentMultimod( $file );
$return .= <<<CONTENT

			</form>
		
CONTENT;

else:
$return .= <<<CONTENT

			<p class='ipsType_normal ipsType_light ipsType_reset' data-role='noComments'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( $file->commentPageCount() > 1 ):
$return .= <<<CONTENT

		<hr class='ipsHr'>
		{$file->commentPagination( array( 'tab' ) )}
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $file->commentForm() || $file->locked() || \IPS\Member::loggedin()->restrict_post || \IPS\Member::loggedIn()->members_bitoptions['unacknowledged_warnings'] ):
$return .= <<<CONTENT

		<div class='ipsAreaBackground ipsPad ipsSpacer_top' data-role='replyArea'>
			
CONTENT;

if ( $file->commentForm() ):
$return .= <<<CONTENT

				
CONTENT;

if ( $file->locked() ):
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_warning ipsComposeArea_warning ipsSpacer_bottom ipsSpacer_half'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_locked_can_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				{$file->commentForm()}
			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $file->locked() ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->commentUnavailable( 'file_locked_cannot_comment' );
$return .= <<<CONTENT

				
CONTENT;

elseif ( \IPS\Member::loggedin()->restrict_post ):
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

	function download( $file, $terms = NULL, $download = NULL, $confirmUrl, $multipleFiles, $waitingOn=NULL, $waitingFor=0 ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller='downloads.front.view.download'>
	
CONTENT;

if ( $terms ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "view", "downloads" )->downloadTerms( $file, $terms, $confirmUrl, $multipleFiles );
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "view", "downloads" )->multipleFiles( $file, $download, $waitingOn, $waitingFor );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function downloadButton( $file ) {
		$return = '';
		$return .= <<<CONTENT


<li>
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
' class='ipsButton ipsButton_fullWidth ipsButton_large ipsButton_important' 
CONTENT;

if ( $file->container()->message('disclaimer') or count( $file->files() ) > 1 or \IPS\Member::loggedIn()->group['idm_wait_period'] ):
$return .= <<<CONTENT
data-ipsDialog
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</li>

CONTENT;

		return $return;
}

	function downloadSidebar( $file ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function downloadTeaser(  ) {
		$return = '';
		$return .= <<<CONTENT


<span class="ipsType_light ipsType_blendLinks ipsResponsive_hidePhone ipsResponsive_inline"><i class="fa fa-info-circle"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download_teaser', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>

CONTENT;

		return $return;
}

	function downloadTerms( $file, $downloadTerms, $confirmUrl, $multipleFiles ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPad'>
	<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download_terms', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download_terms_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>

	<hr class='ipsHr'>

	<div class='ipsType_richText ipsType_medium'>
		{$downloadTerms}
	</div>
</div>
<div class='ipsAreaBackground ipsType_right ipsPad'>
	<ul class='ipsList_inline'>
		<li><a href='
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_link ipsButton_medium' data-action='dialogClose' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cancel_downloading', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cancel', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		<li><a href='
CONTENT;
$return .= htmlspecialchars( $confirmUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_medium' data-action='
CONTENT;

if ( $multipleFiles or \IPS\Member::loggedIn()->group['idm_wait_period'] ):
$return .= <<<CONTENT
selectFile
CONTENT;

else:
$return .= <<<CONTENT
download
CONTENT;

endif;
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'agree_and_download_full', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'agree_and_download', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
	</ul>
</div>
CONTENT;

		return $return;
}

	function log( $file, $table ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $file->container()->log ):
$return .= <<<CONTENT

	<div class='ipsPad_half'><div class='ipsMessage ipsMessage_info'>
CONTENT;

$pluralize = array( $file->container()->log ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'log_days', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</div></div>

CONTENT;

endif;
$return .= <<<CONTENT

{$table}
CONTENT;

		return $return;
}

	function logRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class='ipsGrid_span6 ipsPhotoPanel ipsPhotoPanel_mini ipsClearfix ipsPad_half'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $row['dmid'] ), 'mini' );
$return .= <<<CONTENT

		<div>
			<h3 class='ipsType_normal ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $row['dmid'] )->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
			<span class='ipsType_light'>
CONTENT;

$val = ( $row['dtime'] instanceof \IPS\DateTime ) ? $row['dtime'] : \IPS\DateTime::ts( $row['dtime'] );$return .= (string) $val;
$return .= <<<CONTENT
</span>
		</div>
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function logTable( $table, $headers, $rows, $quickSearch ) {
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
' data-controller='core.global.core.table' 
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



	
CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

		<ol class='ipsGrid ipsGrid_collapsePhone ipsPad ipsClear 
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

	function multipleFiles( $fileObject, $files, $waitingOn, $waitingFor ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPad'>
	<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download_your_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<p class='ipsType_reset ipsType_normal ipsType_light'>
CONTENT;

$pluralize = array( count( $files ) ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download_file_count', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</p>
	<hr class='ipsHr'>
	<ul class='ipsDataList ipsDataList_reducedSpacing'>
		
CONTENT;

foreach ( $files as $k => $file ):
$return .= <<<CONTENT

			
CONTENT;

$data = $files->data();
$return .= <<<CONTENT

			<li class='ipsDataItem'>
				<div class='ipsDataItem_main'>
					<h4 class='ipsDataItem_title'>
CONTENT;

if ( $data['record_realname'] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $data['record_realname'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $data['record_location'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h4>
					
CONTENT;

if ( $data['record_size'] ):
$return .= <<<CONTENT
<p class='ipsType_reset ipsDataItem_meta'>
CONTENT;

$return .= \IPS\Output\Plugin\Filesize::humanReadableFilesize( $data['record_size'] );
$return .= <<<CONTENT
</p>
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				
CONTENT;

if ( $waitingOn == $k ):
$return .= <<<CONTENT

					<div class='ipsDataItem_generic ipsDataItem_size6 ipsType_warning'>
						<noscript>
CONTENT;

$pluralize = array( $waitingFor ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'wait_x_seconds_noscript', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</noscript>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='ipsDataItem_generic ipsDataItem_size4 ipsType_right'>
					<span class="ipsHide" data-role="downloadCounterContainer">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download_begins_in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <span data-role="downloadCounter"></span> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'seconds', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
					<a href='
CONTENT;
$return .= htmlspecialchars( $fileObject->url()->setQueryString( array( 'do' => 'download', 'r' => $k, 'confirm' => 1, 't' => 1, 'version' => isset( \IPS\Request::i()->version ) ? \IPS\Request::i()->version : NULL ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small' data-action="download" 
CONTENT;

if ( \IPS\Member::loggedIn()->group['idm_wait_period'] ):
$return .= <<<CONTENT
data-wait='true'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</div>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
CONTENT;

		return $return;
}

	function reviews( $file ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller='core.front.core.commentFeed' 
CONTENT;

if ( \IPS\Settings::i()->auto_polling_enabled ):
$return .= <<<CONTENT
data-autoPoll
CONTENT;

endif;
$return .= <<<CONTENT
 data-commentsType='reviews' data-baseURL='
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $file->isLastPage('reviews') ):
$return .= <<<CONTENT
data-lastPage
CONTENT;

endif;
$return .= <<<CONTENT
 data-feedID='file-
CONTENT;
$return .= htmlspecialchars( $file->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
-reviews' id='reviews'>
	
CONTENT;

if ( $file->reviewForm() ):
$return .= <<<CONTENT

		
CONTENT;

if ( $file->locked() ):
$return .= <<<CONTENT

			<strong class='ipsType_warning'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'item_locked_can_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div id='elFileReviewForm'>
			{$file->reviewForm()}
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( $file->hasReviewed() ):
$return .= <<<CONTENT

			<!-- Already reviewed -->
		
CONTENT;

elseif ( $file->locked() ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->commentUnavailable( 'item_locked_cannot_review' );
$return .= <<<CONTENT

		
CONTENT;

elseif ( \IPS\Member::loggedin()->restrict_post ):
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Member::loggedIn()->restrict_post == -1 ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->reviewUnavailable( 'restricted_cannot_comment' );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->reviewUnavailable( 'restricted_cannot_comment', \IPS\Member::loggedIn()->warnings(5,NULL,'rpa'), \IPS\Member::loggedIn()->restrict_post );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

elseif ( $file->mustDownloadBeforeReview() ):
$return .= <<<CONTENT

			<p class='ipsType_reset ipsType_light ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_download_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

elseif ( \IPS\Member::loggedIn()->members_bitoptions['unacknowledged_warnings'] ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->reviewUnavailable( 'unacknowledged_warning_cannot_post', \IPS\Member::loggedIn()->warnings( 1, FALSE ) );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( count( $file->reviews() ) ):
$return .= <<<CONTENT

		
CONTENT;

if ( !$file->hasReviewed() ):
$return .= <<<CONTENT
<hr class='ipsHr'>
CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsClearfix ipsSpacer_bottom">
			
CONTENT;

if ( $file->reviewPageCount() > 1 ):
$return .= <<<CONTENT

				<div class="ipsPos_left ipsResponsive_noFloat">
					{$file->reviewPagination( array( 'tab', 'sort' ) )}
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class="ipsClearfix ipsPos_right ipsResponsive_hidePhone">
				<ul class="ipsButtonRow ipsClearfix">
					<li data-action="tableFilter">
						<a href="
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'tab' => 'reviews', 'page' => 1, 'sort' => 'helpful' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="
CONTENT;

if ( !isset( \IPS\Request::i()->sort ) or \IPS\Request::i()->sort != 'newest' ):
$return .= <<<CONTENT
ipsButtonRow_active
CONTENT;

endif;
$return .= <<<CONTENT
" data-action="filterClick">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'most_helpful', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
					<li data-action="tableFilter">
						<a href="
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'tab' => 'reviews', 'page' => 1, 'sort' => 'newest' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="
CONTENT;

if ( isset( \IPS\Request::i()->sort ) and \IPS\Request::i()->sort == 'newest' ):
$return .= <<<CONTENT
ipsButtonRow_active
CONTENT;

endif;
$return .= <<<CONTENT
" data-action="filterClick">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'newest', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				</ul>
			</div>
		</div>
		
		<div data-role='commentFeed' data-controller='core.front.core.moderation'>
			<form action="
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( 'do', 'multimodReview' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-ipsPageAction data-role='moderationTools'>
				
CONTENT;

$reviewCount=0; $timeLastRead = $file->timeLastRead(); $lined = FALSE;
$return .= <<<CONTENT

				
CONTENT;

foreach ( $file->reviews() as $review ):
$return .= <<<CONTENT

					
CONTENT;

if ( !$lined and $timeLastRead and $timeLastRead->getTimestamp() < $review->mapped('date') ):
$return .= <<<CONTENT

						
CONTENT;

if ( $lined = TRUE and $reviewCount ):
$return .= <<<CONTENT

							<hr class="ipsCommentUnreadSeperator">
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

$reviewCount++;
$return .= <<<CONTENT

					{$review->html()}
				
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentMultimod( $file, 'review' );
$return .= <<<CONTENT

			</form>
		</div>
		
CONTENT;

if ( $file->reviewPageCount() > 1 ):
$return .= <<<CONTENT

			<div>
				{$file->reviewPagination( array( 'tab', 'sort' ) )}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

elseif ( !$file->canReview() ):
$return .= <<<CONTENT

		<p class="ipsType_normal ipsType_light ipsType_reset" data-role="noReviews">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_reviews', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function view( $file, $commentsAndReviews, $versionData, $previousVersions, $next=NULL, $prev=NULL, $cfields=array() ) {
		$return = '';
		$return .= <<<CONTENT

<div itemscope itemtype="http://schema.org/CreativeWork">
	<div class='
CONTENT;

if ( $file->primary_screenshot ):
$return .= <<<CONTENT
ipsColumns ipsColumns_collapsePhone
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix'>
		<div 
CONTENT;

if ( $file->primary_screenshot_thumb ):
$return .= <<<CONTENT
class='ipsColumn ipsColumn_fluid'
CONTENT;

endif;
$return .= <<<CONTENT
>
			<h1 class='ipsType_pageTitle ipsContained_container'>

				
CONTENT;

if ( $file->prefix() OR ( $file->canEdit() AND $file::canTag( NULL, $file->container() ) AND $file::canPrefix( NULL, $file->container() ) ) ):
$return .= <<<CONTENT

					<span 
CONTENT;

if ( !$file->prefix() ):
$return .= <<<CONTENT
class='ipsHide'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( ( $file->canEdit() AND $file::canTag( NULL, $file->container() ) AND $file::canPrefix( NULL, $file->container() ) ) ):
$return .= <<<CONTENT
data-editablePrefix
CONTENT;

endif;
$return .= <<<CONTENT
>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $file->prefix( TRUE ), $file->prefix() );
$return .= <<<CONTENT

					</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
				
CONTENT;

if ( $file->hidden() === 1 ):
$return .= <<<CONTENT

					<span><span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span></span>
				
CONTENT;

elseif ( $file->hidden() === -1 ):
$return .= <<<CONTENT

					<span><span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $file->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $file->canUnfeature() ):
$return .= <<<CONTENT

					<span><span class="ipsBadge ipsBadge_icon ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></span></span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $file->canEdit() ):
$return .= <<<CONTENT

					<div class='ipsType_break ipsContained' data-controller="core.front.core.moderation">
						
CONTENT;

if ( $file->locked() ):
$return .= <<<CONTENT
<i class='fa fa-lock'></i> 
CONTENT;

endif;
$return .= <<<CONTENT
<span data-role="editableTitle" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'click_hold_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $file->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span> 
CONTENT;
$return .= htmlspecialchars( $file->version, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<div class='ipsType_break ipsContained'>
CONTENT;

if ( $file->locked() ):
$return .= <<<CONTENT
<i class='fa fa-lock'></i> 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $file->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $file->version, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</h1>
			
			
CONTENT;

if ( $file->isPaid() ):
$return .= <<<CONTENT

				<p class="ipsType_pageTitle ipsType_reset ipsSpacer_top ipsSpacer_half">
					
CONTENT;

if ( $price = $file->price() ):
$return .= <<<CONTENT

						<span class='cFilePrice'>{$price}</span>
						
CONTENT;

if ( $renewalTerm = $file->renewalTerm() ):
$return .= <<<CONTENT

							<span class='ipsType_light'>&middot; 
CONTENT;

$sprintf = array($renewalTerm); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_renewal_term_val', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span>
						
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


			
CONTENT;

if ( $file->container()->bitoptions['reviews'] ):
$return .= <<<CONTENT

				<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
					<meta itemprop='ratingValue' content='
CONTENT;
$return .= htmlspecialchars( $file->averageReviewRating(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					<meta itemprop='reviewCount' content='
CONTENT;
$return .= htmlspecialchars( $file->reviews, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->rating( 'large', $file->averageReviewRating(), \IPS\Settings::i()->reviews_rating_out_of, $file->memberReviewRating() );
$return .= <<<CONTENT
&nbsp;&nbsp; <span class='ipsType_normal ipsType_light'>(
CONTENT;

$pluralize = array( $file->reviews ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_reviews', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
)</span>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT


			<div class='ipsPos_right ipsResponsive_noFloat ipsResponsive_hidePhone'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'downloads', 'file', $file->id, $file->followers()->count( TRUE ) );
$return .= <<<CONTENT

			</div>

			<hr class='ipsHr'>

			<div class='ipsPhotoPanel ipsPhotoPanel_tiny ipsClearfix ipsSpacer_bottom'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $file->author(), 'tiny', $file->warningRef() );
$return .= <<<CONTENT

				<div>
					<p class='ipsType_reset ipsType_large ipsType_blendLinks'>
						
CONTENT;

$htmlsprintf = array($file->author()->link( $file->warningRef() )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate_itemprop', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

CONTENT;

if ( \IPS\Member::loggedIn()->group['idm_view_approvers'] and $file->approver ):
$return .= <<<CONTENT
 
CONTENT;

$sprintf = array(\IPS\Member::load( $file->approver )->name); $htmlsprintf = array(\IPS\DateTime::ts( $file->approvedon )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_approved_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf, 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

					</p>
					
CONTENT;

if ( $file->author()->member_id OR $file->canChangeAuthor() ):
$return .= <<<CONTENT

					<ul class='ipsList_inline'>
						
CONTENT;

if ( $file->author()->member_id ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$file->author()->member_id}&do=content&type=downloads_file", "front", "profile_content", $file->author()->members_seo_name, 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_users_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $file->canChangeAuthor() ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'do' => 'changeAuthor' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_author_d', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_author_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_author_d', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>	

			
CONTENT;

if ( count( $file->tags() ) OR ( $file->canEdit() AND $file::canTag( NULL, $file->container() ) ) ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $file->tags(), FALSE, FALSE, ( $file->canEdit() AND $file::canTag( NULL, $file->container() ) ) ? $file->url() : NULL );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>

	</div>

	
CONTENT;

if ( $file->hidden() === 1 and $file->canUnhide() ):
$return .= <<<CONTENT

		<div class="ipsMessage ipsMessage_warning ipsSpacer_both">
			<p class="ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			<br>
			<ul class='ipsList_inline'>
				<li><a href="
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_positive ipsButton_verySmall" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve_title_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class="fa fa-check"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

if ( $file->canDelete() ):
$return .= <<<CONTENT

					<li><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloads_delete_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_negative ipsButton_verySmall'><i class='fa fa-times'></i> 
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

	
	
CONTENT;

if ( $file->screenshots()->getInnerIterator()->count( true ) ):
$return .= <<<CONTENT

		<section class='ipsBox ipsSpacer_both'>
			<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$pluralize = array( $file->screenshots()->getInnerIterator()->count( true ) ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'screenshots_ct', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
			<div class='ipsPad_half ipsAreaBackground'>
				<div class='ipsCarousel ipsClearfix' data-ipsCarousel data-ipsCarousel-showDots>
					<ul class='cDownloadsCarousel ipsClearfix' data-role="carouselItems">
						
CONTENT;

$fullScreenshots = iterator_to_array( $file->screenshots() );
$return .= <<<CONTENT

						
CONTENT;

foreach ( $file->screenshots( 1 ) as $id => $screenshot ):
$return .= <<<CONTENT

							<li class='ipsCarousel_item ipsAreaBackground_reset ipsPad_half'>
								<span style="background-image: url( '
CONTENT;

$return .= htmlspecialchars( str_replace( array( '(', ')' ), array( '\(', '\)' ), $screenshot->url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' )" class="ipsThumb ipsThumb_medium ipsThumb_bg ipsCursor_pointer" data-ipsLightbox data-ipsLightbox-group="download_
CONTENT;
$return .= htmlspecialchars( $file->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-fullURL="
CONTENT;
$return .= htmlspecialchars( $fullScreenshots[ $id ]->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
									<img src="
CONTENT;
$return .= htmlspecialchars( $screenshot->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" alt="" 
CONTENT;

if ( $file->primary_screenshot_thumb == $screenshot ):
$return .= <<<CONTENT
itemprop='image'
CONTENT;

endif;
$return .= <<<CONTENT
>
								</span>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
					<span class='ipsCarousel_shadow ipsCarousel_shadowLeft'></span>
					<span class='ipsCarousel_shadow ipsCarousel_shadowRight'></span>
					<a href='#' class='ipsCarousel_nav ipsHide' data-action='prev'><i class='fa fa-chevron-left'></i></a>
					<a href='#' class='ipsCarousel_nav ipsHide' data-action='next'><i class='fa fa-chevron-right'></i></a>
				</div>
			</div>
		</section>
	
CONTENT;

endif;
$return .= <<<CONTENT
 

	<div class='ipsColumns ipsColumns_collapsePhone ipsBox'>
		<article class='ipsColumn ipsColumn_fluid'>
			<div class='ipsPad'>
				<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<section class='ipsType_normal ipsSpacer_top'>
					<div class='ipsType_richText ipsContained ipsType_break' itemprop='text' data-controller='core.front.core.lightboxedImages'>
						{$file->content()}
					</div>

					
CONTENT;

if ( $versionData['b_changelog'] or !empty( $previousVersions ) ):
$return .= <<<CONTENT

						<hr class='ipsHr ipsSpacer_both ipsSpacer_double'>
						<section data-controller='downloads.front.view.changeLog'>
							<h2 class='ipsType_sectionHead'>
CONTENT;

$sprintf = array($versionData['b_version']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'whats_new_in_version', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

if ( !empty( $previousVersions ) ):
$return .= <<<CONTENT
 &nbsp;&nbsp;<a href='#' id='elChangelog' data-ipsMenu data-ipsMenu-selectable="radio" class='ipsButton ipsButton_verySmall ipsButton_light' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_changelog_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_changelog', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
CONTENT;

endif;
$return .= <<<CONTENT
</h2>

							<div data-role='changeLogData'>
								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "view", \IPS\Request::i()->app )->changeLog( $file, $versionData );
$return .= <<<CONTENT

							</div>
							<ul class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' id='elChangelog_menu'>
								<li class='ipsMenu_item 
CONTENT;

if ( !\IPS\Request::i()->changelog ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $file->version, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQuerystring( 'changelog', 0 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$sprintf = array($file->version); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_changelog_for', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $file->version, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

foreach ( $previousVersions as $version ):
$return .= <<<CONTENT

									<li class='ipsMenu_item 
CONTENT;

if ( \IPS\Request::i()->changelog == $version['b_id'] ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $version['b_hidden'] ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;

$return .= htmlspecialchars( md5( $version['b_version'] . $version['b_backup'] . mt_rand() ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-changelogTitle="
CONTENT;
$return .= htmlspecialchars( $version['b_version'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
										<a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( 'changelog', $version['b_id'] ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$sprintf = array($version['b_version']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_changelog_for', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
											
CONTENT;
$return .= htmlspecialchars( $version['b_version'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
<br>
											<span class='ipsType_light'>
CONTENT;

$return .= \IPS\DateTime::ts( $version['b_backup'] )->html();
$return .= <<<CONTENT
</span>
										</a>
									</li>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</ul>
						</section>
					
CONTENT;

endif;
$return .= <<<CONTENT


					<hr class='ipsHr ipsSpacer_top ipsSpacer_double'>

					
CONTENT;

if ( $file instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

						<div class='ipsPos_right'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $file );
$return .= <<<CONTENT

						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT


					
CONTENT;

if ( $file->canEdit() or $file->canPin() or $file->canUnpin() or $file->canFeature() or $file->canUnfeature() or $file->canHide() or $file->canUnhide() or $file->canMove() or $file->canLock() or $file->canUnlock() or $file->canDelete() ):
$return .= <<<CONTENT

						<a href='#elFileActions_menu' id='elFileActions' class='ipsButton ipsButton_light ipsButton_verySmall' data-ipsMenu>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_actions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
						<ul id='elFileActions_menu' class='ipsMenu ipsMenu_auto ipsHide'>
							
CONTENT;

if ( $file->canEdit() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'do' => 'newVersion' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'upload_new_version_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'upload_new_version', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'do' => 'edit' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloads_edit_details_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloads_edit_details', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $file->canFeature() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'feature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature_title_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( $file->canUnfeature() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unfeature' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfeature_title_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( $file->canPin() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'pin' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin_title_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $file->canUnpin() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unpin' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unpin_title_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unpin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $file->canHide() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'hide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide_title_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( $file->canUnhide() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

if ( $file->hidden() === 1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve_title_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide_title_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

if ( $file->hidden() === 1 ):
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

if ( $file->canLock() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'lock' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock_title_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $file->canUnlock() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unlock' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock_title_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $file->canMove() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'do' => 'move' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"  title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloads_move_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( $file->canDelete() ):
$return .= <<<CONTENT
				
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloads_delete_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_view_moderation_log') ):
$return .= <<<CONTENT

								<li class='ipsMenu_sep'><hr></li>
								<li class="ipsMenu_item"><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->csrf()->setQueryString( array( 'do' => 'modLog' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( !\IPS\Member::loggedIn()->group['gbw_no_report']  ):
$return .= <<<CONTENT

						&nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $file->url('report'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_submit_success', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</section>
			</div>
		</article>
		<aside class='ipsColumn ipsColumn_wide'>
			<div class='ipsPad'>
				<ul class="ipsToolList ipsToolList_vertical ipsClearfix">
					
CONTENT;

if ( $file->canBuy() ):
$return .= <<<CONTENT

						
CONTENT;

if ( $file->canDownload() ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "view", "downloads" )->downloadButton( $file );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

						<li class='ipsToolList_primaryAction'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $file->url('buy')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_fullWidth ipsButton_large ipsButton_important'><i class='fa fa-shopping-cart'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'buy_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( $price = $file->price() ):
$return .= <<<CONTENT
 - {$price}
CONTENT;

endif;
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

if ( $file->canDownload() or !$file->downloadTeaser() ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "view", "downloads" )->downloadButton( $file );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							{$file->downloadTeaser()}
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( ( isset( $purchasesToRenew ) or $purchasesToRenew = $file->purchasesToRenew() ) and count( $purchasesToRenew ) ):
$return .= <<<CONTENT

						<li class='ipsToolList_primaryAction'>
							
CONTENT;

if ( count( $purchasesToRenew ) === 1 ):
$return .= <<<CONTENT

								
CONTENT;

foreach ( $purchasesToRenew as $purchase ):
$return .= <<<CONTENT

									<a href='
CONTENT;
$return .= htmlspecialchars( $purchase->url()->setQueryString('do', 'renew')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_fullWidth ipsButton_large ipsButton_important'><i class='fa fa-refresh'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'purchase_renew_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 - 
CONTENT;
$return .= htmlspecialchars( $purchase->renewals->cost, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								<a href='#elFileRenew_menu' id='elFileRenew' class='ipsButton ipsButton_fullWidth ipsButton_large ipsButton_important' data-ipsMenu><i class='fa fa-refresh'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'purchase_renew_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
								<ul id='elFileRenew_menu' class='ipsMenu ipsMenu_auto ipsHide'>
									
CONTENT;

foreach ( $purchasesToRenew as $purchase ):
$return .= <<<CONTENT

										<li class='ipsMenu_item'><a href="
CONTENT;
$return .= htmlspecialchars( $purchase->url()->setQueryString('do', 'renew')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $purchase->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
<br><span class='ipsType_light'>
CONTENT;
$return .= htmlspecialchars( $purchase->renewals, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></a></li>
									
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

				</ul>
				<hr class='ipsHr'>

				
CONTENT;

if ( $file->topic() ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $file->topic()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dl_get_support_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_normal ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dl_get_support', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					<br>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_information', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<ul class="ipsDataList ipsDataList_reducedSpacing ipsSpacer_top">
					<li class="ipsDataItem">
						<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'views', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
						<span class="ipsDataItem_generic cFileInfoData">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $file->views );
$return .= <<<CONTENT
</span>
						<meta itemprop='interactionCount' content='UserPageVisits:
CONTENT;
$return .= htmlspecialchars( $file->views, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					</li>
					
CONTENT;

if ( $file->isPaid() and !$file->nexus and in_array( 'purchases', explode( ',', \IPS\Settings::i()->idm_nexus_display ) ) ):
$return .= <<<CONTENT

						<li class="ipsDataItem" title='
CONTENT;

$pluralize = array( $file->downloads ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_downloads', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
' data-ipsTooltip>
							<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'idm_purchases', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
							<span class="ipsDataItem_generic cFileInfoData">
CONTENT;
$return .= htmlspecialchars( $file->purchaseCount(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
							<meta itemprop='interactionCount' content='UserDownloads:
CONTENT;
$return .= htmlspecialchars( $file->downloads, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( !$file->isPaid() or in_array( 'downloads', explode( ',', \IPS\Settings::i()->idm_nexus_display ) )  ):
$return .= <<<CONTENT

						<li class="ipsDataItem">
							<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloads_file_info', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
							<span class="ipsDataItem_generic cFileInfoData">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $file->downloads );
$return .= <<<CONTENT
</span>
							<meta itemprop='interactionCount' content='UserDownloads:
CONTENT;
$return .= htmlspecialchars( $file->downloads, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class="ipsDataItem">
						<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submitted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
						<span class="ipsDataItem_generic cFileInfoData">
CONTENT;

$val = ( $file->submitted instanceof \IPS\DateTime ) ? $file->submitted : \IPS\DateTime::ts( $file->submitted );$return .= $val->html();
$return .= <<<CONTENT
</span>
						<meta itemprop='dateCreated' content='
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::ts( $file->submitted )->format( 'Y-m-d' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					</li>
					
CONTENT;

if ( $file->updated != $file->submitted ):
$return .= <<<CONTENT

						<li class="ipsDataItem">
							<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'updated', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
							<span class="ipsDataItem_generic cFileInfoData">
CONTENT;

$val = ( $file->updated instanceof \IPS\DateTime ) ? $file->updated : \IPS\DateTime::ts( $file->updated );$return .= $val->html();
$return .= <<<CONTENT
</span>
							<meta itemprop='dateModified' content='
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::ts( $file->updated )->format( 'Y-m-d' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $file->filesize() ):
$return .= <<<CONTENT

						<li class="ipsDataItem">
							<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'filesize', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
							<span class="ipsDataItem_generic cFileInfoData">
CONTENT;

$return .= \IPS\Output\Plugin\Filesize::humanReadableFilesize( $file->filesize() );
$return .= <<<CONTENT
</span>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

foreach ( $cfields as $k => $v ):
$return .= <<<CONTENT

						<li class="ipsDataItem">
							<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$val = "downloads_{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
							<div class="ipsDataItem_generic ipsType_break cFileInfoData">
								{$v}
							</div>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>

				
CONTENT;

if ( $file->canViewDownloaders() and $file->downloads ):
$return .= <<<CONTENT

					<br>
					<a href='
CONTENT;
$return .= htmlspecialchars( $file->url('log'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_downloader_list', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='' data-ipsDialog data-ipsDialog-size="narrow" data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'downloaders', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'who_downloaded', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT


				<div class='ipsResponsive_showPhone ipsResponsive_block ipsSpacer_top'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'downloads', 'file', $file->id, $file->followers()->count( TRUE ) );
$return .= <<<CONTENT

				</div>
			</div>
		</aside>
	</div>
	<br>
	
	
CONTENT;

if ( $prev || $next ):
$return .= <<<CONTENT

		<div class='ipsGrid ipsGrid_collapsePhone ipsPager ipsSpacer_top'>
			
CONTENT;

if ( $prev !== NULL ):
$return .= <<<CONTENT

				<div class="ipsGrid_span6 ipsType_left ipsPager_prev">
					<a href="
CONTENT;
$return .= htmlspecialchars( $prev->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
						<span class="ipsPager_type">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
						<span class="ipsPager_title ipsType_light ipsTruncate ipsTruncate_line">
CONTENT;
$return .= htmlspecialchars( $prev->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					</a>
				</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsGrid_span6'>&nbsp;</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $next !== NULL ):
$return .= <<<CONTENT

				<div class="ipsGrid_span6 ipsType_right ipsPager_next">
					<a href="
CONTENT;
$return .= htmlspecialchars( $next->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
						<span class="ipsPager_type">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
						<span class="ipsPager_title ipsType_light ipsTruncate ipsTruncate_line">
CONTENT;
$return .= htmlspecialchars( $next->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					</a>
				</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsGrid_span6'>&nbsp;</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<hr class='ipsHr'>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( count( $file->shareLinks() ) ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sharelinks( $file );
$return .= <<<CONTENT

		<br>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $commentsAndReviews ):
$return .= <<<CONTENT

		<a id="replies"></a>
		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_feedback', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		{$commentsAndReviews}
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}}