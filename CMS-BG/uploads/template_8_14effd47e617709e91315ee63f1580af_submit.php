<?php
namespace IPS\Theme\Cache;
class class_downloads_front_submit extends \IPS\Theme\Template
{
	public $cache_key = '43c5d9edca0dc3eee2872c122411b0e4';
	function bulkForm( $form, $category ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('submit_bulk_information') );
$return .= <<<CONTENT

<hr class='ipsHr'>


CONTENT;

if ( $form->error ):
$return .= <<<CONTENT

	<div class="ipsMessage ipsMessage_error">
		
CONTENT;
$return .= htmlspecialchars( $form->error, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

	</div>
	<br>

CONTENT;

endif;
$return .= <<<CONTENT



<form accept-charset='utf-8' method="post" action="
CONTENT;
$return .= htmlspecialchars( $form->action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" enctype="multipart/form-data" id='elDownloadsSubmit' data-ipsForm>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $form->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $form->hiddenValues as $k => $v ):
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

foreach ( $form->elements as $fileName => $collection ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;
$return .= htmlspecialchars( $fileName, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
		<div class='ipsAreaBackground ipsPad_half'>
			<div class='ipsAreaBackground_reset ipsPad'>
				<ul class='ipsForm ipsForm_vertical'>
					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\FormAbstract ):
$return .= <<<CONTENT

							{$input}
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			</div>
		</div>
		<br><hr class='ipsHr'><br>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


	<div class='ipsType_right'>
		<button type='submit' class='ipsButton ipsButton_large ipsButton_primary' data-role='submitForm'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'save_and_submit_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
	</div>
</form>
CONTENT;

		return $return;
}

	function categorySelector( $form ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('select_category') );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsPad'>

CONTENT;

endif;
$return .= <<<CONTENT

	{$form}

CONTENT;

if ( \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function editDetailsInfo( $file ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsMessage ipsMessage_info'><a href='
CONTENT;
$return .= htmlspecialchars( $file->url()->setQueryString( array( 'do' => 'newVersion' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'upload_new_version_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_versioning_info_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></div>
CONTENT;

		return $return;
}

	function linkedScreenshotField( $name, $value ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller="downloads.front.submit.linkedScreenshots" data-name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-initialValue='
CONTENT;

$return .= htmlspecialchars( json_encode( $value ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<ul data-role="fieldsArea" class="ipsList_reset"></ul>
	<a class="ipsButton ipsButton_light ipsButton_small" data-action="addField"><i class="fa fa-plus-circle"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stack_add', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</div>
CONTENT;

		return $return;
}

	function newVersion( $form, $versioning ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHeader ipsSpacer_bottom'>
	<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'upload_new_version', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
</div>

CONTENT;

if ( $versioning and !\IPS\Member::loggedIn()->group['idm_bypass_revision'] ):
$return .= <<<CONTENT

	<div class='ipsLayout_contentSection ipsType_textBlock ipsType_normal'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_version_versioning', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</div>
	<br>

CONTENT;

endif;
$return .= <<<CONTENT

{$form}
CONTENT;

		return $return;
}

	function submitForm( $form, $category, $terms, $bulk=0 ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$nonInfoFields = array('files', 'import_files', 'url_files', 'screenshots', 'url_screenshots');
$return .= <<<CONTENT


CONTENT;

$step = 1;
$return .= <<<CONTENT



CONTENT;

if ( $bulk ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack( 'submit_form_desc_bulk', TRUE, array( 'sprintf' => $category->_title ) ) );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack( 'submit_form_desc', TRUE, array( 'sprintf' => $category->_title ) ) );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<hr class='ipsHr'>


CONTENT;

if ( $form->error ):
$return .= <<<CONTENT

	<div class="ipsMessage ipsMessage_error">
		
CONTENT;
$return .= htmlspecialchars( $form->error, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

	</div>
	<br>

CONTENT;

endif;
$return .= <<<CONTENT



<form accept-charset='utf-8' method="post" action="
CONTENT;
$return .= htmlspecialchars( $form->action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='elDownloadsSubmit' enctype="multipart/form-data" 
CONTENT;

if ( $category->bitoptions['allowss'] AND $category->bitoptions['reqss'] ):
$return .= <<<CONTENT
data-screenshotsReq='1'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $bulk ):
$return .= <<<CONTENT
data-bulkUpload='1'
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsForm data-controller='downloads.front.submit.main'>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $form->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $form->hiddenValues as $k => $v ):
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


	<div class='ipsColumns ipsColumns_collapsePhone'>
		<div class='ipsColumn ipsColumn_veryNarrow ipsType_center'>
			<span class='cDownloadsSubmit_step'>
CONTENT;
$return .= htmlspecialchars( $step, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

$step++;
$return .= <<<CONTENT
</span>
		</div>
		<div class='ipsColumn ipsColumn_fluid'>
			<div class='ipsBox'>
				<h3 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_your_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				<div class='ipsAreaBackground ipsPad ipsClearfix'>
					
CONTENT;

if ( isset( $form->elements['']['import_files'] ) || isset( $form->elements['']['url_files'] ) ):
$return .= <<<CONTENT

						<ul class='ipsList_inline ipsClearfix ipsType_right'>
							
CONTENT;

if ( isset( $form->elements['']['url_files'] ) ):
$return .= <<<CONTENT

								<li>
									<a href='#' class='ipsButton ipsButton_veryLight ipsButton_verySmall' id='elURLFiles' data-ipsMenu data-ipsMenu-closeOnClick='false' data-ipsMenu-appendTo='#elDownloadsSubmit'>
										<i class='fa fa-globe'></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_files_by_url', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i>
										<span class='ipsNotificationCount 
CONTENT;

if ( !count( $form->elements['']['url_files']->value ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='fileCount'>
CONTENT;

$return .= htmlspecialchars( count( $form->elements['']['url_files']->value ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
									</a>
									<div id='elURLFiles_menu' class='ipsMenu ipsMenu_normal ipsHide ipsPad'>
										<ul class='ipsFieldRow_fullWidth'>
											{$form->elements['']['url_files']}
										</ul>
										<hr class='ipsHr'>
										<a href='#' class='ipsButton ipsButton_fullWidth ipsButton_important' data-action='confirmUrls'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_menu_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
									</div>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( isset( $form->elements['']['import_files'] ) ):
$return .= <<<CONTENT

								<li>
									<a href='#' class='ipsButton ipsButton_veryLight ipsButton_verySmall' id='elImportFiles' data-ipsMenu data-ipsMenu-closeOnClick='false' data-ipsMenu-appendTo='#elDownloadsSubmit'>
										<i class='fa fa-folder'></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_files_by_path', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i>
										<span class='ipsNotificationCount 
CONTENT;

if ( !count( $form->elements['']['import_files']->value ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='fileCount'>
CONTENT;

$return .= htmlspecialchars( count( $form->elements['']['import_files']->value ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
									</a>
									<div id='elImportFiles_menu' class='ipsMenu ipsMenu_normal ipsHide ipsPad'>
										<ul class='ipsFieldRow_fullWidth'>
											{$form->elements['']['import_files']}
										</ul>
										<hr class='ipsHr'>
										<a href='#' class='ipsButton ipsButton_fullWidth ipsButton_important' data-action='confirmImports'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_menu_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
									</div>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<div id='elDownloadsSubmit_progress' class='ipsClear' data-ipsSticky>
						<div class='ipsProgressBar ipsProgressBar_animated ipsClear' >
							<div class='ipsProgressBar_progress' data-progress='0%'></div>
						</div>
					</div>
					<div id='elDownloadsSubmit_uploader' class='ipsClear'>
						{$form->elements['']['files']->html( $form )}
						<button type='button' class='ipsButton ipsButton_veryLight ipsButton_verySmall ipsHide' data-action='uploadMore'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'upload_more_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	
CONTENT;

if ( !$bulk  ):
$return .= <<<CONTENT

		
CONTENT;

if ( $category->bitoptions['allowss']  ):
$return .= <<<CONTENT

			<div id='elDownloadsSubmit_screenshots'>
				<br><br>
				<div class='ipsColumns ipsColumns_collapsePhone'>
					<div class='ipsColumn ipsColumn_veryNarrow ipsType_center'>
						<span class='cDownloadsSubmit_step'>
CONTENT;
$return .= htmlspecialchars( $step, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

$step++;
$return .= <<<CONTENT
</span>
					</div>
					<div class='ipsColumn ipsColumn_fluid'>
						<div class='ipsBox'>
							<h3 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_screenshots', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
							<div class='ipsAreaBackground ipsPad_half'>
								
CONTENT;

if ( isset( $form->elements['']['url_screenshots'] ) ):
$return .= <<<CONTENT

									<ul class='ipsList_inline ipsClearfix ipsType_right'>
										<li>
											<a href='#' class='ipsButton ipsButton_veryLight ipsButton_verySmall' id='elURLScreenshots' data-ipsMenu data-ipsMenu-closeOnClick='false' data-ipsMenu-appendTo='#elDownloadsSubmit_screenshots'>
												<i class='fa fa-globe'></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_screenshots_by_url', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i>
												<span class='ipsNotificationCount 
CONTENT;

if ( !count( $form->elements['']['url_screenshots']->value ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='fileCount'>
CONTENT;

$return .= htmlspecialchars( count( $form->elements['']['url_screenshots']->value ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
											</a>
											<div id='elURLScreenshots_menu' class='ipsMenu ipsMenu_wide ipsHide ipsPad'>
												<ul class='ipsFieldRow_fullWidth'>
													{$form->elements['']['url_screenshots']}
												</ul>
												<hr class='ipsHr'>
												<a href='#' class='ipsButton ipsButton_fullWidth ipsButton_important' data-action='confirmScreenshotUrls'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_menu_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
											</div>
										</li>
									</ul>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( isset( $form->elements['']['screenshots'] ) ):
$return .= <<<CONTENT

								<div id='elDownloadsSubmit_screenshots'>
									{$form->elements['']['screenshots']->html( $form )}
								</div>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</div>
						</div>
					</div>
				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT


		<div id='elDownloadsSubmit_otherinfo'>
			<br><br>
			<div class='ipsColumns ipsColumns_collapsePhone'>
				<div class='ipsColumn ipsColumn_veryNarrow ipsType_center'>
					<span class='cDownloadsSubmit_step'>
CONTENT;
$return .= htmlspecialchars( $step, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

$step++;
$return .= <<<CONTENT
</span>
				</div>
				<div class='ipsColumn ipsColumn_fluid'>
					<div class='ipsBox'>
						<h3 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_file_information', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
						<div class='ipsPad'>
							<ul class='ipsForm ipsForm_vertical'>
								
CONTENT;

foreach ( $form->elements as $collection ):
$return .= <<<CONTENT

									
CONTENT;

foreach ( $collection as $fieldName => $input ):
$return .= <<<CONTENT

										
CONTENT;

if ( !in_array( $fieldName, $nonInfoFields ) ):
$return .= <<<CONTENT

											{$input}
										
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

endforeach;
$return .= <<<CONTENT

								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</ul>
						</div>
					</div>
				</div>
			</div>

			
CONTENT;

if ( $terms ):
$return .= <<<CONTENT

				<br><br>
				<div class='ipsColumns ipsColumns_collapsePhone'>
					<div class='ipsColumn ipsColumn_veryNarrow ipsType_center'>
						<span class='cDownloadsSubmit_step'>
CONTENT;
$return .= htmlspecialchars( $step, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

$step++;
$return .= <<<CONTENT
</span>
					</div>
					<div class='ipsColumn ipsColumn_fluid'>
						<div class='ipsBox ipsPad'>
							<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'csubmissionterms_placeholder', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
							<br><br>
							<div class='ipsType_richText'>
								{$terms}
							</div>
						</div>
					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

elseif ( $terms ):
$return .= <<<CONTENT

		<br>
		<div class='ipsColumns ipsColumns_collapsePhone'>
			<div class='ipsColumn ipsColumn_veryNarrow ipsType_center'>
				<span class='cDownloadsSubmit_step'>
CONTENT;
$return .= htmlspecialchars( $step, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

$step++;
$return .= <<<CONTENT
</span>
			</div>
			<div class='ipsColumn ipsColumn_fluid'>
				<div class='ipsBox ipsPad'>
					<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'csubmissionterms_placeholder', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
					<br><br>
					<div class='ipsType_richText'>
						{$terms}
					</div>
				</div>
			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	<hr class='ipsHr'>
	<div class='ipsType_right'>
		<button type='submit' class='ipsButton ipsButton_large ipsButton_primary' data-role='submitForm'>
CONTENT;

if ( $bulk ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'continue', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'save_and_submit_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</button>
	</div>
</form>
CONTENT;

		return $return;
}

	function topic( $file ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPad'>

CONTENT;

if ( $file->container()->bitoptions['topic_screenshot'] and $file->primary_screenshot ):
$return .= <<<CONTENT

	<div class='ipsColumns ipsColumns_collapsePhone'>
		<div class='ipsColumn ipsColumn_medium ipsType_center'>
			<a href="
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				
CONTENT;

$image = ( $file->primary_screenshot instanceof \IPS\File ) ? (string) $file->primary_screenshot->url : $file->primary_screenshot;
$return .= <<<CONTENT

				<img src='
CONTENT;

$return .= \IPS\File::get( "downloads_Screenshots", $image )->url;
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $file->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			</a>
			<br><br>
			<a href="
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_primary ipsButton_fullWidth ipsButton_small'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</a>
		</div>
		<div class='ipsColumn_fluid'>

CONTENT;

endif;
$return .= <<<CONTENT

			<h3 class='ipsType_sectionHead'>
CONTENT;
$return .= htmlspecialchars( $file->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
			
CONTENT;

if ( !$file->container()->bitoptions['topic_screenshot'] or !$file->primary_screenshot ):
$return .= <<<CONTENT

				<a href="
CONTENT;
$return .= htmlspecialchars( $file->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_primary ipsButton_fullWidth ipsButton_small'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<hr class='ipsHr'>
			<div class='ipsType_normal ipsType_richText ipsContained ipsType_break'>
				{$file->desc}
			</div>
			<hr class='ipsHr'>
			<ul class='ipsDataList ipsDataList_reducedSpacing ipsDataList_collapsePhone'>
				<li class='ipsDataItem'>
					<div class='ipsDataItem_generic ipsDataItem_size5'>
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_submitter', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class='ipsDataItem_main'>
						{$file->author()->link()}
					</div>
				</li>
				<li class='ipsDataItem'>
					<div class='ipsDataItem_generic ipsDataItem_size5'>
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_submitted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class='ipsDataItem_main'>
						
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::ts( $file->submitted )->localeDate(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					</div>
				</li>
				<li class='ipsDataItem'>
					<div class='ipsDataItem_generic ipsDataItem_size5'>
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'file_cat', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class='ipsDataItem_main'>
						<a href="
CONTENT;
$return .= htmlspecialchars( $file->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $file->container()->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					</div>
				</li>
				
CONTENT;

foreach ( $file->customFields( TRUE ) as $k => $v ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_generic ipsDataItem_size5'>
							<strong>
CONTENT;

$val = "downloads_{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
						</div>
						<div class='ipsDataItem_main'>
							{$v}
						</div>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>

CONTENT;

if ( $file->container()->bitoptions['topic_screenshot'] and $file->primary_screenshot ):
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

</div>
<p>&nbsp;</p>
CONTENT;

		return $return;
}

	function wizardForm( $stepNames, $activeStep, $output, $baseUrl, $showSteps ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

foreach ( $stepNames as $step => $name ):
$return .= <<<CONTENT

	
CONTENT;

if ( $activeStep == $name ):
$return .= <<<CONTENT

		{$output}
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}