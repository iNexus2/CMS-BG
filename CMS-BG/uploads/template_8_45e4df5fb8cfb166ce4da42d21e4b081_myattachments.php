<?php
namespace IPS\Theme\Cache;
class class_core_front_myattachments extends \IPS\Theme\Template
{
	public $cache_key = '27c955579ec3eccd2d385804660129b0';
	function rows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $attachment ):
$return .= <<<CONTENT

	<div class='ipsDataItem ipsAttach ipsAttach_done'>
		<div class='ipsDataItem_generic ipsDataItem_size3 ipsResponsive_hidePhone ipsResponsive_block ipsType_center'>
			<a href="
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
applications/core/interface/file/attachment.php?id=
CONTENT;
$return .= htmlspecialchars( $attachment['attach_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				
CONTENT;

if ( $attachment['attach_is_image'] ):
$return .= <<<CONTENT

					<img src="
CONTENT;

$return .= \IPS\File::get( "core_Attachment", $attachment['attach_location'] )->url;
$return .= <<<CONTENT
" alt='' class='ipsImage ipsThumb_small' data-ipsLightbox data-ipsLightbox-group="myAttachments">
				
CONTENT;

else:
$return .= <<<CONTENT

					<i class='fa fa-file ipsType_large'></i>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		</div>
		<div class='ipsDataItem_main'>
			<h2 class='ipsDataItem_title ipsType_reset ipsType_medium ipsAttach_title ipsTruncate ipsTruncate_line ipsType_blendLinks'><a href="
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
applications/core/interface/file/attachment.php?id=
CONTENT;
$return .= htmlspecialchars( $attachment['attach_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $attachment['attach_file'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h2>
			<p class='ipsDataItem_meta ipsType_light'>
				
CONTENT;

$return .= \IPS\Output\Plugin\Filesize::humanReadableFilesize( $attachment['attach_filesize'] );
$return .= <<<CONTENT
 &middot; 
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $attachment['attach_date'] )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachment_uploaded', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

			</p>
		</div>
		<div class='ipsDataItem_generic ipsDataItem_size9 ipsType_light'>
			{$attachment['attach_content']}
		</div>
		<div class='ipsDataItem_stats ipsType_light'>
			
CONTENT;

if ( !$attachment['attach_is_image'] ):
$return .= <<<CONTENT

CONTENT;

$pluralize = array( $attachment['attach_hits'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'attach_hits_count', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_delete_attachments'] or !count( \IPS\core\extensions\core\EditorMedia\Attachment::$locations[ $attachment['attach_id'] ] ) ):
$return .= <<<CONTENT

			<div class='ipsDataItem_generic ipsDataItem_size3 ipsType_right ipsResponsive_noFloat'>
				<li>
					<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=attachments&do=delete&id={$attachment['attach_id']}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "attachments", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

if ( count($rows) > 1 ):
$return .= <<<CONTENT
&page=
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->page, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

elseif ( isset( \IPS\Request::i()->page ) AND \IPS\Request::i()->page > 1 ):
$return .= <<<CONTENT
&page=
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->page-1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action="deleteAttachment"><i class='fa fa-trash-o'></i></a>
				</li>
			</div>	
		
CONTENT;

endif;
$return .= <<<CONTENT
	
	</div>

CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function template( $table, $used, $count ) {
		$return = '';
		$return .= <<<CONTENT

<h1 class="ipsType_pageTitle ipsPageHeader">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>


CONTENT;

if ( \IPS\Member::loggedIn()->group['g_attach_max'] > 0 ):
$return .= <<<CONTENT

	
CONTENT;

$percentage = round( ( $used / ( \IPS\Member::loggedIn()->group['g_attach_max'] * 1024 ) ) * 100 );
$return .= <<<CONTENT

	<div class='ipsBox ipsfocus_reset'>
		
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT
<h2 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachment_quota', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT

		<div class='ipsProgressBar ipsProgressBar_fullWidth ipsClear 
CONTENT;

if ( $percentage >= 90 ):
$return .= <<<CONTENT
ipsProgressBar_warning
CONTENT;

endif;
$return .= <<<CONTENT
' >
			<div class='ipsProgressBar_progress' style="width: 
CONTENT;
$return .= htmlspecialchars( $percentage, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
%">
				<span data-role="percentage">
CONTENT;
$return .= htmlspecialchars( $percentage, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>%
			</div>
		</div>
		<br>
		<p class='ipsType_reset ipsType_center'>
			
CONTENT;

$sprintf = array(\IPS\Output\Plugin\Filesize::humanReadableFilesize( $used ), \IPS\Output\Plugin\Filesize::humanReadableFilesize( \IPS\Member::loggedIn()->group['g_attach_max'] * 1024 )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

		</p>
      
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT

	</div>
<br />

CONTENT;

endif;
$return .= <<<CONTENT


<div class='ipsBox ipsfocus_reset' data-controller="core.front.attachments.list">
	
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT
<h2 class='ipsType_sectionTitle ipsType_medium ipsType_reset'>
CONTENT;

$pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments_count', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT

	{$table}
  
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}}