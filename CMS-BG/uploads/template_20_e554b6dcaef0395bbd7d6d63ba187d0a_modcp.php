<?php
namespace IPS\Theme\Cache;
class class_core_front_modcp extends \IPS\Theme\Template
{
	public $cache_key = '6e1f840c39b425b524abd74ce399d994';
	function announcementRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class="ipsDataItem 
CONTENT;

if ( $row->active !== 1 ):
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

if ( !$row->active ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
 cModCPAnnouncementRow">
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_announcement', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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
				&nbsp;&nbsp;
				
CONTENT;

if ( $row->active ):
$return .= <<<CONTENT

					<span class='ipsBadge ipsBadge_new'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'active', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				
CONTENT;

else:
$return .= <<<CONTENT

					<span class='ipsBadge ipsBadge_style5'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'inactive', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</h4>
			<p class='ipsType_reset ipsType_light'>
CONTENT;

$sprintf = array($row->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $row->__get( $row::$databaseColumnMap['date'] ) instanceof \IPS\DateTime ) ? $row->__get( $row::$databaseColumnMap['date'] ) : \IPS\DateTime::ts( $row->__get( $row::$databaseColumnMap['date'] ) );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</p>
			<div class='ipsDataItem_meta'>
				<br>
				<div class='ipsType_richText ipsType_medium' data-ipsTruncate data-ipsTruncate-size='4 lines' data-ipsTruncate-type='remove'>
					{$row->content}
				</div>
			</div>
		</div>
		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck ipsType_noBreak ipsPos_center'>
				<a href='#elAnnouncement
CONTENT;
$return .= htmlspecialchars( $row->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elAnnouncement
CONTENT;
$return .= htmlspecialchars( $row->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_large ipsPos_middle ipsType_blendLinks' data-ipsMenu>
					<i class='fa fa-cog'></i> <i class='fa fa-caret-down'></i>
				</a>
				<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

				<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide' id='elAnnouncement
CONTENT;
$return .= htmlspecialchars( $row->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
					<li class='ipsMenu_item'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $row->url('status')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_toggle', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
							<span data-role="ipsMenu_selectedText">
CONTENT;

if ( $row->active ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_mark_inactive', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_mark_active', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
						</a>
					</li>
					<li class='ipsMenu_item'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $row->url('create'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_announcement', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-modal='true' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_announcement', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
							<span data-role="ipsMenu_selectedText">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
						</a>
					</li>
					<li class='ipsMenu_sep'></li>
					<li class='ipsMenu_item'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $row->url('delete')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</li>
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

	function announcements( $table ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPad'>
	<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&tab=announcements&action=create", null, "modcp_announcements", array(), 0 ) );
$return .= <<<CONTENT
' id='elAdd_Announcement' class='ipsButton ipsButton_primary ipsPos_right' data-ipsDialog data-ipsDialog-modal='true' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_announcement', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-add'></i>&nbsp;<span class='ipsResponsive_inline'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_announcement', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a>
	<br><br><br>
	<div class='ipsClear ipsBox'>
		{$table}
	</div>
</div>
CONTENT;

		return $return;
}

	function approvalQueue( $output ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad" data-controller="core.front.modcp.approveQueue" data-url="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=approval", null, "modcp_approval", array(), 0 ) );
$return .= <<<CONTENT
">
	{$output}
</div>
CONTENT;

		return $return;
}

	function approvalQueueEmpty(  ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsType_center ipsType_large ipsEmpty">
	<i class="fa fa-check"></i>
	<br>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approval_queue_empty', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function approvalQueueHeader( $item, $approveUrl, $skipUrl, $deleteUrl, $hideUrl ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsBox ipsPad ipsClearfix ipsClear" data-ipsSticky>
	<ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsPos_right" id="elApprovalToolbar">
		<li>
			
CONTENT;

if ( $approveUrl ):
$return .= <<<CONTENT

				<a href="
CONTENT;
$return .= htmlspecialchars( $approveUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_positive" data-action="approvalQueueNext">
					<i class="fa fa-check"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			
CONTENT;

else:
$return .= <<<CONTENT

				<a href="#" class="ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_positive ipsButton_disabled" data-action="approvalQueueNext">
					<i class="fa fa-check"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
		<li>
			
CONTENT;

if ( $hideUrl ):
$return .= <<<CONTENT

				<a href="
CONTENT;
$return .= htmlspecialchars( $hideUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_alternate" data-action="approvalQueueNext">
					<i class="fa fa-low-vision"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			
CONTENT;

else:
$return .= <<<CONTENT

				<a href="#" class="ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_positive ipsButton_disabled" data-action="approvalQueueNext">
					<i class="fa fa-low-vision"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
		<li>
			<a href="
CONTENT;
$return .= htmlspecialchars( $skipUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_medium ipsButton_light ipsType_center ipsButton_fullWidth" data-action="approvalQueueNext">
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'skip_this_item', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</a>
		</li>
		<li>
			
CONTENT;

if ( $deleteUrl ):
$return .= <<<CONTENT

				<a href="
CONTENT;
$return .= htmlspecialchars( $deleteUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_negative" data-action="approvalQueueNext">
					<i class="fa fa-times"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			
CONTENT;

else:
$return .= <<<CONTENT

				<a href="#" class="ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_negative ipsButton_disabled" data-action="approvalQueueNext">
					<i class="fa fa-times"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>			
	</ul>
</div>
<br>
CONTENT;

		return $return;
}

	function approvalQueueItem( $item, $ref, $container, $title ) {
		$return = '';
		$return .= <<<CONTENT

<div id="elApprovePanel" class='ipsBox'>
	<article itemscope="" itemtype="http://schema.org/Comment" class="ipsClearfix ipsClear">
		<div class='ipsPad'>
			<p class="ipsPos_right ipsPad_half">
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_normal ipsType_light'>
					<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $item::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i> 
CONTENT;

$val = "{$item::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</p>
			<div class="ipsPhotoPanel ipsPhotoPanel_small ipsClearfix"> 
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->userPhoto( $item->author() );
$return .= <<<CONTENT

				<div>
					<a href="#user
CONTENT;
$return .= htmlspecialchars( $item->author()->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" id="user
CONTENT;
$return .= htmlspecialchars( $item->author()->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsType_sectionHead" data-ipsmenu="">
CONTENT;
$return .= htmlspecialchars( $item->author()->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 &nbsp;<i class="fa fa-caret-down"></i></a>
					<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide" id="user
CONTENT;
$return .= htmlspecialchars( $item->author()->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
						
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('mod_can_warn') ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=warn&id={$item->author()->member_id}&ref={$ref}", null, "warn_add", array( $item->author()->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array($item->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_issued', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-role="warnUserDialog">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $item->author()->member_id != \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

							
CONTENT;

if ( $item->author()->members_bitoptions['bw_is_spammer'] ):
$return .= <<<CONTENT

								<li class='ipsMenu_item' data-ipsMenuValue='spamFlagButton'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$item->author()->member_id}&s=0" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $item->author()->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

else:
$return .= <<<CONTENT

								<li class='ipsMenu_item' data-ipsMenuValue='spamFlagButton'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$item->author()->member_id}&s=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $item->author()->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

						<li class="ipsMenu_item"><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$item->author()->member_id}", null, "messenger_compose", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_send', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					</ul>
					
CONTENT;

if ( $container ):
$return .= <<<CONTENT

						<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'posted_in_container', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href="
CONTENT;
$return .= htmlspecialchars( $container->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $container->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></p>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<p class="ipsType_light ipsType_reset">
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $item->mapped('date') )->html(FALSE)); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'date_replied', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
				</p></div>
			</div>
		</div>
		<div class='ipsAreaBackground_light ipsPad'>
			<div class='ipsBox'>
				<h2 class="ipsType_sectionTitle ipsType_blendLinks"><a href="
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h2>
				<div class="ipsType_richText ipsPost ipsType_normal ipsPad">
					{$item->content()}
				</div>
			</div>
		</div>
	</article>
</div>

CONTENT;

		return $return;
}

	function approvalQueueSplash( $skipNextTime ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad">
	<div class="ipsType_center ipsType_large ipsPos_center">
		<div id='elModCPApprovalSplash'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approval_queue_splash', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</div>
		<br><br>
		<form action="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=approval&go=1", null, "modcp_approval", array(), 0 ) );
$return .= <<<CONTENT
" method="post">
			<button type="submit" class="ipsButton ipsButton_large ipsButton_primary">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approval_queue_start', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button><br><br>
			<span class="ipsType_normal ipsType_light"><input name="skipnext" value='1' type="checkbox" 
CONTENT;

if ( $skipNextTime ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approval_queue_skip', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		</form>
	</div>
</div>

CONTENT;

		return $return;
}

	function commentsList( $comments, $url, $totalCount, $perPage ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $url, $totalCount, isset( \IPS\Request::i()->page ) ? intval( \IPS\Request::i()->page ) : 1, $perPage );
$return .= <<<CONTENT


CONTENT;

if ( count( $comments )  ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $comments as $comment ):
$return .= <<<CONTENT

		{$comment->html()}
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $url, $totalCount, isset( \IPS\Request::i()->page ) ? intval( \IPS\Request::i()->page ) : 1, $perPage );
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function hiddenContent( $content, $tabs, $activeTab ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsLayout_contentSection'>
	<div class='ipsTabs ipsClearfix' id='elmodCPTabs' data-ipsTabBar data-ipsTabBar-contentArea='#elModCPHiddenTabContent'>
		<a href='#elmodCPTabs' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
		<ul role='tablist' class='ipsList_reset'>
			
CONTENT;

foreach ( $tabs as $key => $tab ):
$return .= <<<CONTENT

				<li>
					<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&tab=hidden&area=$key", null, "", array(), 0 ) );
$return .= <<<CONTENT
' id='modcp_
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_item 
CONTENT;

if ( $activeTab === $key ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' role="tab" aria-selected="
CONTENT;

if ( $activeTab == $key ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
">
						
CONTENT;

$val = "{$tab}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>
</div>
<section id='elModCPHiddenTabContent' class='ipsPad'>
	<div id="ipsTabs_elmodCPTabs_modcp_
CONTENT;
$return .= htmlspecialchars( $activeTab, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel" class="ipsTabs_panel" aria-labelledby="modcp_
CONTENT;
$return .= htmlspecialchars( $activeTab, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
		{$content}
	</div>
</section>
	
CONTENT;

		return $return;
}

	function ipMemberRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( empty( $rows ) ):
$return .= <<<CONTENT

	<tr>
		<td colspan="
CONTENT;

$return .= htmlspecialchars( count( $headers ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			<div class='ipsPad_double ipsType_light'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</div>
		</td>
	</tr>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $r ):
$return .= <<<CONTENT

		<tr class='ipsClearfix'>
			
CONTENT;

foreach ( $r as $k => $v ):
$return .= <<<CONTENT

				<td>
					
CONTENT;

if ( $k === '_buttons' ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->controlStrip( $v );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						{$v}
					
CONTENT;

endif;
$return .= <<<CONTENT

				</td>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</tr>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function ipMemberTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div data-baseurl="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-resort='
CONTENT;
$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller="core.global.core.table">
	<div class='ipsClearfix'>
		
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

			</div>
			<br>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div class="ipsBox ipsClear">
		<h2 class='ipsType_sectionTitle ipsType_reset ipsClear'>
CONTENT;

$sprintf = array($table->extra->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ips_used_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</h2>
		<table class='ipsTable ipsTable_responsive ipsTable_zebra 
CONTENT;

foreach ( $table->classes as $class ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

endforeach;
$return .= <<<CONTENT
' data-role="table" data-ipsKeyNav data-ipsKeyNav-observe='e d return'>
			<thead>
				<tr class='ipsAreaBackground'>
					
CONTENT;

foreach ( $headers as $k => $header ):
$return .= <<<CONTENT

						
CONTENT;

if ( $header !== '_buttons' ):
$return .= <<<CONTENT

							<th>
CONTENT;

$val = "{$table->langPrefix}{$header}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</th>
						
CONTENT;

elseif ( $header === '_buttons' ):
$return .= <<<CONTENT

							<th>&nbsp;</th>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</tr>
			</thead>
			<tbody data-role="tableRows">
				
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

			</tbody>
		</table>
		<br>
		
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function iptools( $form, $members ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground ipsPad ipsFieldRow ipsFieldRow_primary ipsBox ipsBox_transparent' id='elModCPIPTools'>
	{$form}
</div>
<div class='ipsAreaBackground ipsPad ipsFieldRow ipsFieldRow_primary ipsBox ipsBox_transparent' id='elModCPIPMemberTools'>
	{$members}
</div>
CONTENT;

		return $return;
}

	function memberManagementRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class='ipsDataItem ipsGrid_span6 ipsFaded_withHover ipsClearfix' id='elUserRow_
CONTENT;

$return .= htmlspecialchars( md5( $row['name'] ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<p class="ipsType_reset ipsDataItem_icon">
			{$row['photo']}
		</p>		
		<div class='ipsDataItem_main'>
			<h4 class='ipsDataItem_title'><strong>{$row['name']}</strong></h4>			
			<ul class='ipsList_inline ipsType_noBreak ipsList_reset'>
				
CONTENT;

foreach ( $row['_buttons'] as $button ):
$return .= <<<CONTENT

					
CONTENT;

if ( $button['title'] == 'modcp_view_warnings' ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $button['link'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

				<li class="ipsFaded">
					<a href="#elUserMod
CONTENT;
$return .= htmlspecialchars( $row['member_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" id="elUserMod
CONTENT;
$return .= htmlspecialchars( $row['member_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsType_large ipsPos_middle ipsType_blendLinks" data-ipsMenu>
						<i class="fa fa-cog"></i> <i class="fa fa-caret-down"></i>
					</a>
				</li>
			</ul>
			<ul class='ipsMenu ipsHide' id='elUserMod
CONTENT;
$return .= htmlspecialchars( $row['member_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
				
CONTENT;

foreach ( $row['_buttons'] as $button ):
$return .= <<<CONTENT

					<li class='ipsMenu_item'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $button['link'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
							
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function members( $content, $tabs, $activeTab, $form ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground ipsPad ipsFieldRow ipsFieldRow_primary ipsBox ipsBox_transparent' id='elModCPMemberSearch'>
	{$form}
</div>
<div class='ipsBox'>
	<div class='ipsTabs ipsClearfix' id='elmodCPTabs' data-ipsTabBar data-ipsTabBar-contentArea='#elModCPMemberTabContent'>
		<a href='#elmodCPTabs' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
		<ul role='tablist' class='ipsList_reset'>
			
CONTENT;

foreach ( $tabs as $key => $tab ):
$return .= <<<CONTENT

				<li>
					<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&tab=members&area=$key", null, "modcp_members", array(), 0 ) );
$return .= <<<CONTENT
' id='modcp_
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_item 
CONTENT;

if ( $activeTab === $key ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' role="tab" aria-selected="
CONTENT;

if ( $activeTab == $tab ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
">
						
CONTENT;

$val = "modcp_members_{$key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>
	<section id='elModCPMemberTabContent' class='ipsPad'>
		<div id="ipsTabs_elmodCPTabs_modcp_
CONTENT;
$return .= htmlspecialchars( $activeTab, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel" class="ipsTabs_panel" aria-labelledby="modcp_
CONTENT;
$return .= htmlspecialchars( $activeTab, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
			{$content}
		</div>
	</section>
</div>
CONTENT;

		return $return;
}

	function recentWarningsRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( empty( $rows ) ):
$return .= <<<CONTENT

	<tr>
		<td colspan="4">
			<div class='ipsPad_double ipsType_light'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</div>
		</td>
	</tr>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $warning ):
$return .= <<<CONTENT

		<li class='ipsDataItem'>
			<div class='ipsDataItem_icon ipsPos_top'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $warning->member ), 'tiny' );
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main'>
				<h3 class='ipsType_sectionHead'>
					<a href="
CONTENT;
$return .= htmlspecialchars( $warning->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' class="ipsPos_left ipsType_blendLinks" data-ipsTooltip title='
CONTENT;

$pluralize = array( $warning->points ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'wan_action_points', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
						<span class="ipsPoints ipsPoints_small">
CONTENT;
$return .= htmlspecialchars( $warning->points, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span> 
CONTENT;

$val = "core_warn_reason_{$warning->reason}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</h3>
				<p class='ipsType_medium ipsType_reset'><strong>
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $warning->member )->link(), \IPS\Member::load( $warning->moderator )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_warned_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</strong> &nbsp;&nbsp;<span class='ipsType_light ipsType_noBreak'>
CONTENT;

$val = ( $warning->date instanceof \IPS\DateTime ) ? $warning->date : \IPS\DateTime::ts( $warning->date );$return .= $val->html();
$return .= <<<CONTENT
</span></p>

				
CONTENT;

if ( \IPS\Settings::i()->warnings_acknowledge ):
$return .= <<<CONTENT

					<span class='ipsType_medium ipsType_noBreak'>
						
CONTENT;

if ( $warning->acknowledged ):
$return .= <<<CONTENT

							<strong class='ipsType_success'><i class='fa fa-check-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_acknowledged', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_not_acknowledged', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $warning->note_mods ):
$return .= <<<CONTENT

					<div class='ipsSpacer_top ipsType_richText ipsType_medium ipsContained ipsType_break' data-ipsTruncate data-ipsTruncate-size='4 lines' data-ipsTruncate-type='remove'>
						{$warning->note_mods}
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

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function recentWarningsTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsBox'>
	<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'modcp_recent_warnings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	<ul class='ipsDataList ipsDataList_large'>
		
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

	</ul>

	
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function report( $report,$comment,$item,$ref,$prevReport,$prevItem,$nextReport,$nextItem ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $comment ):
$return .= <<<CONTENT

	
CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT

	
CONTENT;

$quoteData = json_encode( array( 'userid' => $comment->author()->member_id, 'username' => $comment->author()->name, 'timestamp' => $comment->mapped('date'), 'contentapp' => $item::$application, 'contenttype' => $item::$module, 'contentclass' => str_replace( '\\', '_', mb_substr( $comment::$itemClass, 4 ) ) ) );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

if ( $item ):
$return .= <<<CONTENT

		
CONTENT;

$class = get_class( $item );
$return .= <<<CONTENT

		
CONTENT;

$quoteData = json_encode( array( 'userid' => $item->author()->member_id, 'username' => $item->author()->name, 'timestamp' => $item->mapped('date'), 'contentapp' => $item::$application, 'contenttype' => $item::$module, 'contentclass' => str_replace( '\\', '_', mb_substr( get_class( $item ), 4 ) ) ) );
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$quoteData = json_encode( array() );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<article class='ipsColumns ipsColumns_collapseTablet ipsClear ipsClearfix' data-controller="core.front.modcp.report">
	<div class='ipsColumn ipsColumn_fluid' data-controller='core.front.core.comment' data-quoteData='
CONTENT;
$return .= htmlspecialchars( $quoteData, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

if ( $comment ):
$return .= <<<CONTENT

			<div class="ipsClearfix" id='elReportComment'>
				<h2 class="ipsType_sectionHead">
					<a href='
CONTENT;
$return .= htmlspecialchars( $report->url()->setQueryString( array( 'action' => 'find', 'parent' => 1 ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $comment->item()->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				</h2>
				<br>
				<a href='
CONTENT;
$return .= htmlspecialchars( $report->url()->setQueryString( array( 'action' => 'find' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_normal ipsType_light'>
					{$report->tableDescription()}
				</a>
				<br><br>
				<div class='ipsPost' data-role='commentContent'>
					<div data-ipsTruncate data-ipsTruncate-type="hide" data-ipsTruncate-size="#elReportPanel">
						<div class='ipsType_richText ipsType_normal ipsContained' data-controller='core.front.core.lightboxedImages'>
							{$comment->content()}
						</div>
					</div>
				</div>
				<hr class='ipsHr'>
				<ul class='ipsList_inline' data-role="commentControls">
					
CONTENT;

if ( $comment->canEdit( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('edit'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&_report=
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->canHide( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('hide')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&_report=
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='hideComment' data-ipsDialog data-ipsDialog-title="
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

if ( $comment->canDelete( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('delete')->csrf()->setQueryString('page',\IPS\Request::i()->page), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&_report=
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='deleteComment' data-showOnDelete="#elReportCommentDeleted" data-hideOnDelete="#elReportComment">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->item()->canDelete( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->url('moderate')->setQueryString( 'action', 'delete' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&_report=
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='deleteComment' data-showOnDelete="#elReportCommentDeleted" data-hideOnDelete="#elReportComment">
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $item::$title )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_thing', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			</div>
		
CONTENT;

elseif ( $item ):
$return .= <<<CONTENT

			<div class="ipsClearfix" id='elReportComment'>
				<h2 class="ipsType_sectionHead">
					<a href='
CONTENT;
$return .= htmlspecialchars( $report->url()->setQueryString( 'action', 'find' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				</h2>
				<br>
				<a href='
CONTENT;
$return .= htmlspecialchars( $report->url()->setQueryString( array( 'action' => 'find' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_normal ipsType_light'>
					<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $item::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i> 
CONTENT;

$val = "{$item::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
				<br><br>
				<div class='ipsPost' data-role='commentContent'>
					<div data-ipsTruncate data-ipsTruncate-type="hide" data-ipsTruncate-size="#elReportPanel">
						<div class='ipsType_richText ipsType_normal ipsContained' data-controller='core.front.core.lightboxedImages'>
							{$item->content()}
						</div>
					</div>
				</div>
				<hr class='ipsHr'>
				<ul class='ipsList_inline' data-role="commentControls">
					
CONTENT;

if ( $item->canEdit( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->url('edit'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&_report=
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $item->canHide( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->url('moderate')->setQueryString( 'action', 'hide' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&_report=
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='hideComment' data-ipsDialog data-ipsDialog-title="
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

if ( $item->canDelete( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->url('moderate')->setQueryString( 'action', 'delete' )->csrf()->setQueryString('page',\IPS\Request::i()->page), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&_report=
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='deleteComment' data-showOnDelete="#elReportCommentDeleted" data-hideOnDelete="#elReportComment">
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

		<div class="ipsType_center ipsType_large ipsEmpty 
CONTENT;

if ( $comment or $item ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
" id='elReportCommentDeleted'>
			<i class="fa fa-trash-o"></i>
			<br>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</div>
	</div>
	<aside class='ipsColumn ipsColumn_veryWide'>
		<div id="elReportSidebar">
			<div class='ipsAreaBackground ipsPad_half' id='elReportSidebar_toggle' data-controller='core.front.modcp.reportToggle'>
				<div class='ipsPad_half ipsType_center ipsType_normal'>
					<p class='ipsType_reset ipsType_large cReportSidebar_icon ipsSpacer_bottom ipsSpacer_half'><i class='
CONTENT;

if ( $report->status == 1 ):
$return .= <<<CONTENT
fa fa-flag
CONTENT;

elseif ( $report->status == 2 ):
$return .= <<<CONTENT
fa fa-exclamation-triangle
CONTENT;

else:
$return .= <<<CONTENT
fa fa-check-circle
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='reportIcon'></i></p>
					<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
:</strong> <span data-role="reportStatus">
CONTENT;

$val = "report_status_{$report->status}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</div>

				<a href='#elReportItem
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elReportItem
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small ipsButton_fullWidth' data-ipsMenu data-ipsMenu-closeOnClick data-ipsMenu-appendTo='#elReportSidebar_toggle' data-ipsMenu-selectable>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_report_as', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i>
				</a>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "modcp", \IPS\Request::i()->app )->reportToggle( $report, '', FALSE );
$return .= <<<CONTENT

			</div>
			<br>
			<div id='elReportPanel' class='ipsBox'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "modcp", \IPS\Request::i()->app )->reportPanel( $report,$comment,$ref );
$return .= <<<CONTENT

			</div>
		</div>
	</aside>
</article>
<br>
<nav class='ipsPager ipsGrid ipsClearFix ipsList_inline'>
	<div class='ipsGrid_span6 ipsPager_prev'>
		
CONTENT;

if ( $prevReport ):
$return .= <<<CONTENT

			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=reports&action=view&id={$prevReport['id']}", null, "modcp_report", array(), 0 ) );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'previous_report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
				<span class='ipsPager_type'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'previous_report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				
CONTENT;

if ( $prevItem ):
$return .= <<<CONTENT

					<span class='ipsPager_title ipsType_break ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $prevItem->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
				
CONTENT;

else:
$return .= <<<CONTENT

					<span class='ipsPager_title'><em class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em></span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div class='ipsGrid_span6 ipsType_right ipsPager_next'>
		
CONTENT;

if ( $nextReport ):
$return .= <<<CONTENT

			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=reports&action=view&id={$nextReport['id']}", null, "modcp_report", array(), 0 ) );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next_report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
				<span class='ipsPager_type'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next_report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				
CONTENT;

if ( $nextItem ):
$return .= <<<CONTENT

					<span class='ipsPager_title ipsType_break ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $nextItem->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
				
CONTENT;

else:
$return .= <<<CONTENT

					<span class='ipsPager_title'><em class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em></span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</nav>
<section class='ipsBox'>
	<h2 class="ipsType_sectionTitle ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'responses_to_report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	<div data-controller="core.front.core.commentsWrapper" data-tabsId='elTabsReport'>
		<div class="ipsTabs ipsTabs_contained ipsClearfix" id="elTabsReport" data-ipsTabBar data-ipstabbar-contentarea="#elReportComments">
			<a href="#elTabs_report" data-action="expandTabs"><i class="fa fa-caret-down"></i></a>
			<ul role="tablist">
				<li>
					<a href="#" id="elUserReports" class="ipsTabs_item ipsTabs_activeItem" title="" role="tab" aria-selected="true">
						
CONTENT;

$pluralize = array( count( $report->reports() ) ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_user_reports', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

					</a>
				</li>
				<li>
					<a href="#" id="elTabsReport_tab_mod_comments" class="ipsTabs_item" title="" role="tab" aria-selected="false">
						
CONTENT;

$pluralize = array( $report->num_comments ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_mod_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

					</a>
				</li>
			</ul>
		</div>
		<div id="elReportComments" class="ipsTabs_contained ipsTabs_panels">
			<div id="ipsTabs_elTabsReport_elUserReports_panel" class="ipsTabs_panel" aria-labelledby="elUserReports" aria-hidden="false">
				<div data-role="commentFeed">
					
CONTENT;

foreach ( $report->reports() as $r ):
$return .= <<<CONTENT

						<article itemscope itemtype="http://schema.org/Comment" id="elCommentMod_
CONTENT;
$return .= htmlspecialchars( $r['rid'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsComment ipsComment_parent ipsClearfix ipsClear ">
							<div class='ipsComment_content ipsType_medium'>
								<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini'>
									
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $r['report_by'] ), 'mini' );
$return .= <<<CONTENT

									<div>
										<h3 class='ipsComment_author ipsType_normal ipsType_blendLinks'>
CONTENT;

$return .= \IPS\Member::load( $r['report_by'] )->link();
$return .= <<<CONTENT
</h3>
										
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_use_ip_tools') and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) ):
$return .= <<<CONTENT

											<p class='ipsPos_right ipsType_reset ipsType_blendLinks ipsFaded ipsFaded_more'>
												<span class='ipsResponsive_hidePhone'>(<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=ip_tools&ip={$r['ip_address']}", null, "modcp_ip_tools", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$sprintf = array($r['ip_address']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_prefix', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a>)</span>
											</p>
										
CONTENT;

endif;
$return .= <<<CONTENT

										<p class="ipsComment_meta ipsType_light ipsType_medium">
											
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_date_submitted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $r['date_reported'] instanceof \IPS\DateTime ) ? $r['date_reported'] : \IPS\DateTime::ts( $r['date_reported'] );$return .= $val->html();
$return .= <<<CONTENT

										</p>
									</div>
								</div>
								<div class='ipsPad'>
									<div class="ipsType_normal ipsType_richText ipsType_break ipsContained" data-controller='core.front.core.lightboxedImages'>
										
CONTENT;

if ( $r['report'] ):
$return .= <<<CONTENT

											{$r['report']}
										
CONTENT;

else:
$return .= <<<CONTENT

											<p><em class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_no_message', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em></p>
										
CONTENT;

endif;
$return .= <<<CONTENT

									</div>
								</div>
							</div>
						</article>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</div>
			</div>
			<div id="ipsTabs_elTabsReport_elTabsReport_tab_mod_comments_panel" class="ipsTabs_panel" aria-labelledby="elTabsReport_tab_mod_comments" aria-hidden="false">
				<div data-controller='core.front.core.commentFeed' 
CONTENT;

if ( \IPS\Settings::i()->auto_polling_enabled ):
$return .= <<<CONTENT
data-autoPoll
CONTENT;

endif;
$return .= <<<CONTENT
 data-commentsType='mod_comments' data-baseURL='
CONTENT;
$return .= htmlspecialchars( $report->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $report->isLastPage() ):
$return .= <<<CONTENT
data-lastPage
CONTENT;

endif;
$return .= <<<CONTENT
 data-feedID='report-
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					
CONTENT;

if ( $report->commentPageCount() > 1 ):
$return .= <<<CONTENT

						{$report->commentPagination()}
						<br><br>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<div data-role='commentFeed' data-controller='core.front.core.moderation'>
						<form action="
CONTENT;
$return .= htmlspecialchars( $report->url()->csrf()->setQueryString( 'action', 'multimodComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-ipsPageAction data-role='moderationTools'>
							
CONTENT;

foreach ( $report->comments() as $modcomment ):
$return .= <<<CONTENT

								{$modcomment->html()}
							
CONTENT;

endforeach;
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentMultimod( $report );
$return .= <<<CONTENT

						</form>
					</div>
					
CONTENT;

if ( $report->commentPageCount() > 1 ):
$return .= <<<CONTENT

						<hr class='ipsHr'>
						{$report->commentPagination()}
						<br><br>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<div data-role='replyArea' class='ipsAreaBackground ipsPad'>
						{$report->commentForm()}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
CONTENT;

		return $return;
}

	function reportList( $table ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox' data-controller='core.front.modcp.reportList'>
	{$table}
</div>
CONTENT;

		return $return;
}

	function reportListOverview( $table, $headers, $rows, $quickSearch, $advancedSearch ) {
		$return = '';
		$return .= <<<CONTENT

<ol class='ipsDataList'>
	
CONTENT;

if ( count($rows) ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

			<li class="ipsDataItem 
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
">
				<div class='ipsDataItem_icon ipsPos_top ipsType_center'>
					<i class='ipsType_large 
CONTENT;

if ( $row->status == 1 ):
$return .= <<<CONTENT
fa fa-flag
CONTENT;

elseif ( $row->status == 2 ):
$return .= <<<CONTENT
fa fa-exclamation-triangle
CONTENT;

else:
$return .= <<<CONTENT
fa fa-check-circle
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="ipsMenu_selectedIcon" title="
CONTENT;

if ( $row->status == 1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_status_1', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

elseif ( $row->status == 2 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_status_2', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_status_3', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" data-ipsTooltip></i>
				</div>
				<div class="ipsDataItem_main">
					<h4 class="ipsDataItem_title"><a href='
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
</a></h4>
					<ul class="ipsDataItem_meta ipsList_inline">
						<li class='ipsType_light'>
							
CONTENT;

if ( $row->last_updated ):
$return .= <<<CONTENT

CONTENT;

$val = ( $row->last_updated instanceof \IPS\DateTime ) ? $row->last_updated : \IPS\DateTime::ts( $row->last_updated );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$val = ( $row->first_report_date instanceof \IPS\DateTime ) ? $row->first_report_date : \IPS\DateTime::ts( $row->first_report_date );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

						</li>
						
CONTENT;

foreach ( $row->stats() as $k => $v ):
$return .= <<<CONTENT

							<li>
								<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $v );
$return .= <<<CONTENT
</span>
								<span class='ipsDataItem_stats_type'>
CONTENT;

$val = "{$k}"; $pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</div>
				<div class='ipsDataItem_generic ipsDataItem_size1 ipsResponsive_hidePhone ipsType_center'>
					
CONTENT;

if ( $lastComment = $row->comments( 1, 0, 'date', 'desc' ) ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $lastComment->author(), 'tiny' );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'tiny' );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		<li class='ipsDataItem'>
			<div class='ipsPad ipsType_light ipsType_center ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results_reports', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

</ol>
CONTENT;

		return $return;
}

	function reportPanel( $report,$comment,$ref ) {
		$return = '';
		$return .= <<<CONTENT

<div data-role="authorPanel">
	
CONTENT;

if ( $report->author ):
$return .= <<<CONTENT

		<div class="ipsPhotoPanel ipsPhotoPanel_small ipsPad ipsAreaBackground ipsClear ipsClearfix">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $report->author ), 'small' );
$return .= <<<CONTENT
	
			<div>
				<a href="#user
CONTENT;
$return .= htmlspecialchars( $report->author, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" id="user
CONTENT;
$return .= htmlspecialchars( $report->author, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsType_sectionHead" data-ipsMenu>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $report->author )->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 &nbsp;<i class="fa fa-caret-down"></i></a>
				<br>
				
CONTENT;

if ( \IPS\Member::load( $report->author )->mod_posts ):
$return .= <<<CONTENT

					<p class="ipsBadge ipsBadge_warning" data-ipsTooltip title="
CONTENT;

if ( \IPS\Member::load( $report->author )->mod_posts == -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_modq_perm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( \IPS\Member::load( $report->author )->mod_posts )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_modq_temp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_modq', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::load( $report->author )->restrict_post ):
$return .= <<<CONTENT

					<p class="ipsBadge ipsBadge_warning" data-ipsTooltip title="
CONTENT;

if ( \IPS\Member::load( $report->author )->restrict_post == -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_nopost_perm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( \IPS\Member::load( $report->author )->restrict_post )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_nopost_temp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_nopost', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::load( $report->author )->temp_ban ):
$return .= <<<CONTENT

					<p class="ipsBadge ipsBadge_warning" data-ipsTooltip title="
CONTENT;

if ( \IPS\Member::load( $report->author )->temp_ban == -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_banned_perm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( \IPS\Member::load( $report->author )->temp_ban )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_banned_temp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_banned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide' id='user
CONTENT;
$return .= htmlspecialchars( $report->author, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
			
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('mod_can_warn') ):
$return .= <<<CONTENT

				<li class='ipsMenu_item'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=warn&id={$report->author}&ref={$ref}", null, "warn_add", array( \IPS\Member::load( $report->author )->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array(\IPS\Member::load( $report->author )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_issued', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-role="warnUserDialog">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $report->author != \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::load( $report->author )->members_bitoptions['bw_is_spammer'] ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-ipsMenuValue='spamUnFlagButton'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$report->author}&s=0" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( \IPS\Member::load( $report->author )->members_seo_name ), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

else:
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-ipsMenuValue='spamFlagButton'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$report->author}&s=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( \IPS\Member::load( $report->author )->members_seo_name ), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<li class="ipsMenu_item"><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$report->author}", null, "messenger_compose", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_send', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</ul>
		
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') ):
$return .= <<<CONTENT

			<div class='ipsPad'>
				<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'previous_warnings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
CONTENT;

if ( count(\IPS\Member::load( $report->author )->warnings( 1 )) ):
$return .= <<<CONTENT

					<ol class='ipsDataList'>
						
CONTENT;

foreach ( \IPS\Member::load( $report->author )->warnings( 2 ) as $warning ):
$return .= <<<CONTENT

							<li class="ipsDataItem">
								<div class='ipsDataItem_generic ipsDataItem_size1 ipsType_center'>
									<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=view&id={$report->author}&w={$warning->id}", null, "warn_view", array( \IPS\Member::load( $report->author )->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" data-ipsHover class="ipsType_blendLinks">
										<span class="ipsPoints">
CONTENT;
$return .= htmlspecialchars( $warning->points, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
									</a>
								</div>
								<div class='ipsDataItem_main'>
									<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=view&id={$report->author}&w={$warning->id}", null, "warn_view", array( \IPS\Member::load( $report->author )->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" data-ipsHover class="ipsType_blendLinks">
										<h4 class="ipsDataItem_title">
CONTENT;

$val = "core_warn_reason_{$warning->reason}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
										<p class='ipsDataItem_meta ipsType_light'>
											
CONTENT;

$sprintf = array(\IPS\Member::load( $warning->moderator )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $warning->date instanceof \IPS\DateTime ) ? $warning->date : \IPS\DateTime::ts( $warning->date );$return .= $val->html();
$return .= <<<CONTENT

										</p>
									</a>
								</div>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ol>
					<br>
					<div class='ipsType_center'>
						<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&id={$report->author}", null, "warn_list", array( \IPS\Member::load( $report->author )->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' class=''><i class='fa fa-bars'></i> &nbsp;&nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_c', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_light ipsType_medium'>
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_previous_warnings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

else:
$return .= <<<CONTENT

		<div class="ipsPhotoPanel ipsPhotoPanel_small ipsClearfix">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( 0 ), 'small' );
$return .= <<<CONTENT
	
			<div>
				<span class="ipsType_sectionHead" data-ipsMenu>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( 0 )->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function reportToggle( $report, $ref='list', $showIcon=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $showIcon ):
$return .= <<<CONTENT

<a href='#elReportItem
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elReportItem
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="changeStatus" class='ipsType_blendLinks' data-ipsMenu data-ipsMenu-closeOnClick>
	<span class="cReportIcon ipsType_large"><i class='
CONTENT;

if ( $report->status == 1 ):
$return .= <<<CONTENT
fa fa-flag
CONTENT;

elseif ( $report->status == 2 ):
$return .= <<<CONTENT
fa fa-exclamation-triangle
CONTENT;

else:
$return .= <<<CONTENT
fa fa-check-circle
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="ipsMenu_selectedIcon"></i></span> &nbsp;<i class='fa fa-caret-down'></i>
</a>

CONTENT;

endif;
$return .= <<<CONTENT

<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide' id='elReportItem
CONTENT;
$return .= htmlspecialchars( $report->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
	<li class='ipsMenu_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_as', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
	<li class='ipsMenu_item' data-ipsMenuValue='3'>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&tab=reports&id={$report->id}&action=view&setStatus=3&ref={$ref}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "modcp_report", array(), 0 ) );
$return .= <<<CONTENT
' data-action='ipsMenu_ping'>
			<i class='fa fa-check-circle' data-role="ipsMenu_selectedIcon"></i> &nbsp;<span data-role="ipsMenu_selectedText">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_status_3', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		</a>
	</li>
	<li class='ipsMenu_item' data-ipsMenuValue='2'>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&tab=reports&id={$report->id}&action=view&setStatus=2&ref={$ref}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "modcp_report", array(), 0 ) );
$return .= <<<CONTENT
' data-action='ipsMenu_ping'>
			<i class='fa fa-exclamation-triangle' data-role="ipsMenu_selectedIcon"></i> &nbsp;<span data-role="ipsMenu_selectedText">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_status_2', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		</a>
	</li>
	<li class='ipsMenu_item' data-ipsMenuValue='1'>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&tab=reports&id={$report->id}&action=view&setStatus=1&ref={$ref}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "modcp_report", array(), 0 ) );
$return .= <<<CONTENT
' data-action='ipsMenu_ping'>
			<i class='fa fa-flag' data-role="ipsMenu_selectedIcon"></i> &nbsp;<span data-role="ipsMenu_selectedText">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_status_1', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		</a>
	</li>
	
CONTENT;

if ( !$showIcon and $report->canDelete( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

		<li class='ipsMenu_sep'></li>
		<li class='ipsMenu_item'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $report->url()->csrf()->setQueryString('_action', 'delete'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='ipsMenu_ping'>
				<i class='fa fa-times'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</a>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

</ul>
CONTENT;

		return $return;
}

	function tableWrapper( $table, $title='' ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox' data-controller='core.front.modcp.reportList'>
	
CONTENT;

if ( $title ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset ipsClear'>
CONTENT;

$val = "{$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	
CONTENT;

endif;
$return .= <<<CONTENT

	{$table}
</div>
CONTENT;

		return $return;
}

	function template( $content, $tabs, $activeTab, $contentTypes, $approvalCount ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom'>
	
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_view_reports') ):
$return .= <<<CONTENT

		<div class='ipsPos_right ipsResponsive_hidePhone'>
			<ul class='ipsList_inline ipsPad_half'>
				<li 
CONTENT;

if ( !$approvalCount ):
$return .= <<<CONTENT
class='ipsType_light'
CONTENT;

endif;
$return .= <<<CONTENT
><span id='elModCPApprovalCount' class='ipsBadge 
CONTENT;

if ( !$approvalCount ):
$return .= <<<CONTENT
ipsBadge_style6
CONTENT;

else:
$return .= <<<CONTENT
 ipsBadge_style1
CONTENT;

endif;
$return .= <<<CONTENT
 ipsBadge_medium'>
CONTENT;
$return .= htmlspecialchars( $approvalCount, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'modcp_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
				<li 
CONTENT;

if ( !\IPS\Member::loggedIn()->reportCount() ):
$return .= <<<CONTENT
class='ipsType_light'
CONTENT;

endif;
$return .= <<<CONTENT
><span class='ipsBadge 
CONTENT;

if ( !\IPS\Member::loggedIn()->reportCount() ):
$return .= <<<CONTENT
ipsBadge_style6
CONTENT;

else:
$return .= <<<CONTENT
 ipsBadge_style1
CONTENT;

endif;
$return .= <<<CONTENT
 ipsBadge_medium'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->reportCount(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'active_reports', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
			</ul>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<h1 class='ipsType_pageTitle'><i class='fa fa-lock'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'modcp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
</div>
<br>

<section>
	<div class='ipsColumns ipsColumns_collapsePhone'>
		<div class='ipsColumn ipsColumn_medium'>
			<div class='ipsSideMenu' id='modcp_menu' data-ipsSideMenu>
				<h3 class='ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium'>
					<a href='#modcp_menu' class='ipsPad_double' data-action='openSideMenu'><i class='fa fa-bars'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'modcp_sections', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;<i class='fa fa-caret-down'></i></a>
				</h3>
				<h4 class='ipsSideMenu_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'modcp_tools', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<ul class='ipsSideMenu_list'>
				
CONTENT;

foreach ( $tabs as $key => $tab ):
$return .= <<<CONTENT

					
CONTENT;

if ( $key !== 'hidden' ):
$return .= <<<CONTENT

						<li class='ipsSideMenu_item 
CONTENT;

if ( $activeTab == $key ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=$key", null, "modcp_{$key}", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$val = "modcp_{$key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
				<h4 class='ipsSideMenu_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'modcp_hidden', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<ul class='ipsSideMenu_list'>
					<li class="ipsSideMenu_item 
CONTENT;

if ( $activeTab === 'hidden' and !\IPS\Request::i()->type ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
"><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=hidden", null, "modcp_content", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_everything', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				</ul>
				
CONTENT;

foreach ( $contentTypes as $app => $type  ):
$return .= <<<CONTENT

					<h5 class='ipsSideMenu_subTitle'>
CONTENT;

$val = "module__{$app}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>
					<ul class='ipsSideMenu_list'>
						
CONTENT;

foreach ( $type as $key => $class ):
$return .= <<<CONTENT

							<li class="ipsSideMenu_item 
CONTENT;

if ( $activeTab === 'hidden' and \IPS\Request::i()->type == $key ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
"><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=hidden&type={$key}", null, "modcp_content", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$val = "{$class::$title}_pl"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>	
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				
CONTENT;

endforeach;
$return .= <<<CONTENT
				
			</div>
		</div>
		<div class='ipsColumn ipsColumn_fluid' id='elModCPContent'>
			{$content}
		</div>
	</div>
</section>
CONTENT;

		return $return;
}

	function unapprovedContent( $content, $tabs, $activeTab ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsLayout_contentSection'>
	<div class='ipsTabs ipsClearfix' id='elmodCPTabs' data-ipsTabBar data-ipsTabBar-contentArea='#elModCPHiddenTabContent'>
		<a href='#elmodCPTabs' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
		<ul role='tablist' class='ipsList_reset'>
			
CONTENT;

foreach ( $tabs as $key => $tab ):
$return .= <<<CONTENT

				<li>
					<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=modcp&tab=approval&area=$key", null, "", array(), 0 ) );
$return .= <<<CONTENT
' id='modcp_
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_item 
CONTENT;

if ( $activeTab === $key ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' role="tab" aria-selected="
CONTENT;

if ( $activeTab == $tab ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
">
						
CONTENT;

$val = "{$tab}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>
</div>
<section id='elModCPHiddenTabContent' class='ipsPad'>
	<div id="ipsTabs_elmodCPTabs_modcp_
CONTENT;
$return .= htmlspecialchars( $activeTab, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel" class="ipsTabs_panel" aria-labelledby="modcp_
CONTENT;
$return .= htmlspecialchars( $activeTab, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
		{$content}
	</div>
</section>
	
CONTENT;

		return $return;
}

	function warnActions( $actions, $member, $min ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsAreaBackground ipsPad">
	<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'assigned_point_levels', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<p class='ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_points_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	<ol class='ipsDataList ipsDataList_reducedSpacing'>
		
CONTENT;

if ( $min ):
$return .= <<<CONTENT

			<li class="ipsDataItem">
				<div class='ipsDataItem_generic ipsDataItem_size1 ipsPos_top'>
					<span class="ipsPoints"><i class='fa fa-angle-left'></i> 
CONTENT;
$return .= htmlspecialchars( $min, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
				</div>
				<div class='ipsDataItem_main'>
					<p class="ipsType_light ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_punishment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

foreach ( $actions as $action ):
$return .= <<<CONTENT

			<li class="ipsDataItem">
				<div class='ipsDataItem_generic ipsDataItem_size1 ipsPos_top'>
					<span class="ipsPoints">
CONTENT;
$return .= htmlspecialchars( $action['wa_points'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
				</div>
				<div class='ipsDataItem_main'>
					
CONTENT;

if ( $action['wa_mq'] or $action['wa_rpa'] or $action['wa_suspend'] ):
$return .= <<<CONTENT

						<ul class='ipsList_reset ipsType_medium'>
							
CONTENT;

if ( $action['wa_mq'] ):
$return .= <<<CONTENT

								<li>
									<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_mq', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
									<br>
									<span class="ipsType_light">
										<i class='fa fa-clock-o'></i>
										
CONTENT;

if ( $action['wa_mq'] != -1 ):
$return .= <<<CONTENT

											
CONTENT;

if ( $action['wa_mq_unit'] == 'h' ):
$return .= <<<CONTENT

												
CONTENT;

$pluralize = array( $action['wa_mq'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'f_hours', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

											
CONTENT;

else:
$return .= <<<CONTENT

												
CONTENT;

$pluralize = array( $action['wa_mq'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'f_days', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

											
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

else:
$return .= <<<CONTENT

											
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'indefinitely', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

										
CONTENT;

endif;
$return .= <<<CONTENT

									</span>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $action['wa_rpa'] ):
$return .= <<<CONTENT

								<li>
									<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_rpa', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
									<br>
									<span class="ipsType_light">
										<i class='fa fa-clock-o'></i>
										
CONTENT;

if ( $action['wa_rpa'] != -1 ):
$return .= <<<CONTENT

											
CONTENT;

if ( $action['wa_rpa_unit'] == 'h' ):
$return .= <<<CONTENT

												
CONTENT;

$pluralize = array( $action['wa_rpa'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'f_hours', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

											
CONTENT;

else:
$return .= <<<CONTENT

												
CONTENT;

$pluralize = array( $action['wa_rpa'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'f_days', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

											
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

else:
$return .= <<<CONTENT

											
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'indefinitely', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

										
CONTENT;

endif;
$return .= <<<CONTENT

									</span>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $action['wa_suspend'] ):
$return .= <<<CONTENT

								<li>
									<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_suspend', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
									<br>
									<span class="ipsType_light">
										<i class='fa fa-clock-o'></i> 
										
CONTENT;

if ( $action['wa_suspend'] != -1 ):
$return .= <<<CONTENT

											
CONTENT;

if ( $action['wa_suspend_unit'] == 'h' ):
$return .= <<<CONTENT

												
CONTENT;

$pluralize = array( $action['wa_suspend'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'f_hours', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

											
CONTENT;

else:
$return .= <<<CONTENT

												
CONTENT;

$pluralize = array( $action['wa_suspend'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'f_days', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

											
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

else:
$return .= <<<CONTENT

											
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'indefinitely', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

										
CONTENT;

endif;
$return .= <<<CONTENT

									</span>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					
CONTENT;

else:
$return .= <<<CONTENT

						<p class='ipsType_light ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_punishment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ol>
</div>
CONTENT;

		return $return;
}

	function warnHovercard( $warning ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad" id="warnhovercard_
CONTENT;
$return .= htmlspecialchars( $warning->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-controller="core.front.modcp.warnPopup">	
	<h2 class="ipsType_pageTitle">
		
CONTENT;

if ( $warning->canViewDetails() ):
$return .= <<<CONTENT

			<span class='ipsPoints'>
CONTENT;
$return .= htmlspecialchars( $warning->points, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

$val = "core_warn_reason_{$warning->reason}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</h2>
	
CONTENT;

if ( \IPS\Settings::i()->warnings_acknowledge OR \IPS\Member::loggedIn()->members_bitoptions['unacknowledged_warnings'] ):
$return .= <<<CONTENT

		<p class='ipsType_medium'>
			
CONTENT;

if ( $warning->acknowledged ):
$return .= <<<CONTENT

				<strong class='ipsType_success'><i class='fa fa-check-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_acknowledged', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $warning->canAcknowledge() ):
$return .= <<<CONTENT

					<div class='ipsAreaBackground_light ipsPad ipsType_center'>
						<a href="
CONTENT;
$return .= htmlspecialchars( $warning->url('acknowledge')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_important ipsButton_medium ipsButton_fullWidth"><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'acknowledge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						<p class='ipsType_light ipsType_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'acknowledge_message', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<strong class='ipsType_light'><i class='fa fa-circle-o'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_not_acknowledged', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
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

if ( $content = $warning->content() ):
$return .= <<<CONTENT

		<a href='
CONTENT;
$return .= htmlspecialchars( $content->url()->setQueryString( '_warn', $warning->id ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_light ipsType_blendLinks' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_go_to_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $content::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i> &nbsp;&nbsp;
CONTENT;

if ( $content instanceof \IPS\Content\Comment ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $content->item()->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $content->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $warning->canViewDetails() ):
$return .= <<<CONTENT

		<hr class='ipsHr'>
		<div class='ipsPhotoPanel ipsPhotoPanel_tiny'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $warning->moderator ), 'tiny' );
$return .= <<<CONTENT

			<div>
				
CONTENT;

if ( $warning->canDelete() ):
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $warning->url('delete')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke_this_warning', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action="revoke" class='ipsPos_right ipsButton ipsButton_verySmall ipsButton_primary'><i class="fa fa-undo"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<p class="ipsType_reset">
CONTENT;

$sprintf = array(\IPS\Member::load( $warning->moderator )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
				<p class='ipsType_reset ipsType_light'>
CONTENT;

$val = ( $warning->date instanceof \IPS\DateTime ) ? $warning->date : \IPS\DateTime::ts( $warning->date );$return .= $val->html();
$return .= <<<CONTENT
</p>
			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $warning->canViewDetails() or $warning->mq or $warning->rpa or $warning->suspend ):
$return .= <<<CONTENT

		<hr class='ipsHr'>
		<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_punishment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
		<br>
		<ul class='ipsList_bullets ipsType_medium'>
			
CONTENT;

if ( $warning->canViewDetails() ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

if ( $warning->expire_date ):
$return .= <<<CONTENT

						
CONTENT;

if ( $warning->expire_date < time() ):
$return .= <<<CONTENT

							
CONTENT;

if ( $warning->expire_date == -1 ):
$return .= <<<CONTENT

								
CONTENT;

$sprintf = array($warning->points); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_action_points_never_expire', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

$sprintf = array($warning->points, \IPS\DateTime::ts( $warning->expire_date )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_action_points_expired', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

$sprintf = array($warning->points, \IPS\DateTime::ts( $warning->expire_date )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_action_points_expire', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$sprintf = array($warning->points); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_action_points', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT
			
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $warning->mq ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_modq', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 - 
					
CONTENT;

if ( $warning->mq == -1 ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'indefinitely', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::formatInterval( new \DateInterval( $warning->mq ), 2 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $warning->rpa ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_nopost', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 - 
					
CONTENT;

if ( $warning->rpa == -1 ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'indefinitely', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::formatInterval( new \DateInterval( $warning->rpa ), 2 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $warning->suspend ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_banned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 - 
					
CONTENT;

if ( $warning->suspend == -1 ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'indefinitely', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::formatInterval( new \DateInterval( $warning->suspend ), 2 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $warning->note_member ):
$return .= <<<CONTENT

		<hr class='ipsHr'>
		<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_member_note', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
		<div class='ipsType_richText ipsType_medium'>
			{$warning->note_member}
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $warning->note_mods and \IPS\Member::loggedIn()->modPermission('mod_see_warn') ):
$return .= <<<CONTENT

		<hr class='ipsHr'>
		<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_mod_note', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
		<div class='ipsType_richText ipsType_medium'>
			{$warning->note_mods}
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function warningRevoke( $warning ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsPad'>
	<p class='ipsType_large'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_revoke_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</p>
</div>
<div class='ipsAreaBackground_light ipsType_right ipsPad'>
	<ul class='ipsList_inline'>
		<li><a href='
CONTENT;
$return .= htmlspecialchars( $warning->url('delete')->setQueryString('undo', 1)->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_revoke_undo', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		<li><a href='
CONTENT;
$return .= htmlspecialchars( $warning->url('delete')->setQueryString('undo', 0)->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
	</ul>
</div>
CONTENT;

		return $return;
}

	function warningRowPoints( $points ) {
		$return = '';
		$return .= <<<CONTENT

<span class="ipsType_large">
CONTENT;
$return .= htmlspecialchars( $points, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
<br>

CONTENT;

$pluralize = array( $points ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'wan_action_points', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

CONTENT;

		return $return;
}}