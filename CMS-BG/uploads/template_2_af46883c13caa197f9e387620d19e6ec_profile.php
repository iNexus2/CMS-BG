<?php
namespace IPS\Theme\Cache;
class class_core_front_profile extends \IPS\Theme\Template
{
	public $cache_key = '93826fd1df1590e282335a3fa4af4fad';
	function allFollowers( $member, $followers ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT
<h2 class='ipsType_sectionTitle'>
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_followers', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $followers !== NULL AND $followers->count( TRUE ) > 50 ):
$return .= <<<CONTENT

	
CONTENT;

$url = \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=followers&id={$member->member_id}", 'front', 'profile_followers', $member->members_seo_name );
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		<div data-role="tablePagination">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $url, ceil( $followers->count( TRUE ) / 50 ), \IPS\Request::i()->page ?: 1, 50 );
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

<ul class='ipsDataList'>
	
CONTENT;

if ( count( $followers ) ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $followers AS $follower ):
$return .= <<<CONTENT

			<li class='ipsDataItem ipsClearfix 
CONTENT;

if ( $follower['follow_is_anon'] ):
$return .= <<<CONTENT
ipsFaded
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<div class='ipsDataItem_icon ipsPos_top'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load($follower['follow_member_id']), 'tiny', NULL, '', FALSE );
$return .= <<<CONTENT
<br>
				</div>
				<div class='ipsDataItem_main'>
					
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $follower['follow_member_id'] and ( !\IPS\Member::load($follower['follow_member_id'])->members_bitoptions['pp_setting_moderate_followers'] or \IPS\Member::loggedIn()->following( 'core', 'member', $follower['follow_member_id'] ) ) ):
$return .= <<<CONTENT

					
CONTENT;

$thisFollowers = \IPS\Member::load( $follower['follow_member_id'] )->followers();
$return .= <<<CONTENT

						<div class='ipsPos_right'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberFollow( 'core', 'member', $follower['follow_member_id'], ( $thisFollowers === NULL ) ? 0 : $thisFollowers->count( TRUE ), TRUE );
$return .= <<<CONTENT
</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<strong class='ipsDataItem_title'>
CONTENT;

$return .= \IPS\Member::load($follower['follow_member_id'])->link();
$return .= <<<CONTENT
</strong> 
CONTENT;

if ( $follower['follow_is_anon'] ):
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'anon_follower', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
<br>
					
CONTENT;

$return .= \IPS\Member\Group::load( \IPS\Member::load($follower['follow_member_id'])->member_group_id )->formattedName;
$return .= <<<CONTENT

				</div>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</ul>

CONTENT;

if ( $followers !== NULL AND $followers->count( TRUE ) > 50 ):
$return .= <<<CONTENT

	<br>
	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		<div data-role="tablePagination">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $url, ceil( $followers->count( TRUE ) / 50 ), \IPS\Request::i()->page ?: 1, 50 );
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function fieldTab( $field, $value ) {
		$return = '';
		$return .= <<<CONTENT

<h2 class='ipsType_pageTitle ipsSpacer_top'>
CONTENT;

$val = "{$field}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
<div class='ipsType_richText ipsType_normal ipsSpacer_top' data-controller='core.front.core.lightboxedImages'>
	{$value}
</div>

CONTENT;

		return $return;
}

	function followers( $member, $followers ) {
		$return = '';
		$return .= <<<CONTENT


<h2 class='ipsWidget_title ipsType_reset'>
	
CONTENT;

if ( \IPS\Member::loggedIn()->member_id === $member->member_id ):
$return .= <<<CONTENT

		<a href='#elFollowPref_menu' data-role='followOption' data-ipsMenu data-ipsMenu-selectable='radio' data-ipsMenu-appendTo='#elFollowers' id='elFollowPref' class='ipsType_blendLinks ipsType_small ipsPos_right'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
		<ul id='elFollowPref_menu' class='ipsMenu ipsMenu_selectable ipsMenu_normal ipsHide'>
			<li data-ipsMenuValue='enable' class='ipsMenu_item 
CONTENT;

if ( !$member->members_bitoptions['pp_setting_moderate_followers'] ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=changeFollow&enabled=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "profile", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'allow_follow', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			<li data-ipsMenuValue='disable' class='ipsMenu_item 
CONTENT;

if ( $member->members_bitoptions['pp_setting_moderate_followers'] ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=changeFollow&enabled=0" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "profile", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disallow_follow', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			<li class='ipsMenu_sep'><hr></li>
			<li class='ipsPad_half ipsType_center ipsType_light ipsType_medium'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_setting_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</li>
		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

$pluralize = array( ($followers !== NULL) ? $followers->count( TRUE ) : 0 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_followers', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

</h2>
<div class='ipsWidget_inner'>
	
CONTENT;

if ( count( $followers ) ):
$return .= <<<CONTENT

		<ul class='ipsGrid ipsSpacer_top'>
			
CONTENT;

foreach ( $followers as $idx => $follower ):
$return .= <<<CONTENT

				
CONTENT;

if ( $idx <= 11 ):
$return .= <<<CONTENT

					<li class='ipsGrid_span3 ipsType_center 
CONTENT;

if ( $follower['follow_is_anon'] ):
$return .= <<<CONTENT
ipsFaded
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $follower['follow_member_id'] )->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $follower['follow_is_anon'] ):
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'anon_follower', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load($follower['follow_member_id']), 'mini', NULL, '', FALSE );
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

else:
$return .= <<<CONTENT

		<p class='ipsType_center ipsPad_half ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_followers_yet', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

if ( $followers !== NULL and $followers->count( TRUE ) > 12 ):
$return .= <<<CONTENT

	<p class='ipsType_right ipsType_reset ipsPad_half ipsType_small ipsType_light ipsAreaBackground_light'>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=followers&id={$member->member_id}", null, "profile_followers", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_followers', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-right'></i></a>
	</p>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function hovercard( $member, $addWarningUrl ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$rnd = uniqid();
$return .= <<<CONTENT


CONTENT;

$referrer = \IPS\Request::i()->referrer;
$return .= <<<CONTENT


CONTENT;

$coverPhoto = $member->coverPhoto();
$return .= <<<CONTENT

<!-- When altering this template be sure to also check for similar in main profile view -->
<div class="ipsPad_half cUserHovercard" id="elUserHovercard_
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $rnd, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<div class="ipsPageHead_special" id="elProfileHeader_
CONTENT;
$return .= htmlspecialchars( $rnd, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-controller="core.front.core.coverPhoto" data-url="
CONTENT;
$return .= htmlspecialchars( $member->url()->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-coveroffset="
CONTENT;
$return .= htmlspecialchars( $coverPhoto->offset, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

if ( $coverPhoto->file ):
$return .= <<<CONTENT

			<div class="ipsCoverPhoto_container">
				<img src="
CONTENT;
$return .= htmlspecialchars( $coverPhoto->file->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsCoverPhoto_photo" alt="">
</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<a href="
CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><img src="
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsUserPhoto ipsUserPhoto_medium"></a>
		<h2 class="ipsType_reset ipsType_sectionHead ipsTruncate ipsTruncate_line ipsType_blendLinks"><a href="
CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h2>
		<p class="ipsType_reset ipsType_normal">
CONTENT;

$return .= \IPS\Member\Group::load( $member->member_group_id )->formattedName;
$return .= <<<CONTENT
</p>
	</div>
	<br>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationBadge( $member );
$return .= <<<CONTENT

	<div class="cUserHovercard_data">
		<ul class="ipsDataList ipsDataList_reducedSpacing">
<li class="ipsDataItem">
				<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_member_posts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
				<span class="ipsDataItem_main">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->member_posts );
$return .= <<<CONTENT
</span>
			</li>
			<li class="ipsDataItem">
				<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_joined', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
				<span class="ipsDataItem_main">
CONTENT;

$val = ( $member->joined instanceof \IPS\DateTime ) ? $member->joined : \IPS\DateTime::ts( $member->joined );$return .= $val->html();
$return .= <<<CONTENT
</span>
			</li>
			<li class="ipsDataItem">
				<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_last_visit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
				<span class="ipsDataItem_main">
					
CONTENT;

if ( $member->isOnline() ):
$return .= <<<CONTENT
<i class="fa fa-circle ipsOnlineStatus_online" data-ipstooltip title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"></i>
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $member->last_activity ):
$return .= <<<CONTENT

CONTENT;

$val = ( $member->last_activity instanceof \IPS\DateTime ) ? $member->last_activity : \IPS\DateTime::ts( $member->last_activity );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'never', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

				</span>
			</li>
			
CONTENT;

if ( $member->isOnline() AND $member->location ):
$return .= <<<CONTENT

				<li class="ipsDataItem">
					<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_users_location_lang', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
					<span class="ipsDataItem_main">{$member->location()}</span>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_see_emails') ):
$return .= <<<CONTENT

				<li class="ipsDataItem">
					<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
					<span class="ipsDataItem_main">
						
CONTENT;
$return .= htmlspecialchars( $member->email, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
<br><span class="ipsType_light ipsType_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_email_addresses', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
					</span>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Settings::i()->warn_on and !$member->inGroup( explode( ',', \IPS\Settings::i()->warn_protected ) ) and ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') or ( \IPS\Settings::i()->warn_show_own and \IPS\Member::loggedIn()->member_id == $member->member_id ) ) ):
$return .= <<<CONTENT

				<li class="ipsDataItem">
					<span class="ipsDataItem_generic ipsDataItem_size3"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_warnings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
					<span class="ipsDataItem_main">
CONTENT;
$return .= htmlspecialchars( $member->warn_level, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "plugins", "core", 'global' )->totalTimeSpentOnlineCard( $member );
$return .= <<<CONTENT
</ul>
</div>
	<br><div class="ipsAreaBackground ipsPad ipsClearfix">
		<ul class="ipsList_inline ipsType_blendLinks">
			
CONTENT;

if ( !$member->members_disable_pm and !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

				<li><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$member->member_id}", null, "messenger_compose", array(), 0 ) );
$return .= <<<CONTENT
" data-ipsdialog data-ipsdialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsdialog-remotesubmit data-ipsdialog-flashmessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsdialog-forcereload><i class="fa fa-envelope"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_send', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $member->canBeIgnored()  ):
$return .= <<<CONTENT

				<li><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&id={$member->member_id}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
"><i class="fa fa-times-circle"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_ignore', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<li><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=content&id={$member->member_id}", "front", "profile_content", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
"><i class="fa fa-search"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

if ( ( \IPS\Member::loggedIn()->canWarn( $member ) || ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and !$member->modPermission() and !$member->isAdmin() ) ) and $member->member_id != \IPS\Member::loggedIn()->member_id  ):
$return .= <<<CONTENT

				<li class="ipsPos_right">
					<a href="#elUserHovercard_
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_more_menu" id="elUserHovercard_
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $rnd, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_more" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipstooltip data-ipsmenu data-ipsmenu-appendto="#elUserHovercard_
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $rnd, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
						<i class="fa fa-cog ipsType_large"></i> <i class="fa fa-caret-down"></i>
					</a>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
		
CONTENT;

if ( ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') AND $member->member_id != \IPS\Member::loggedIn()->member_id ) || \IPS\Member::loggedIn()->canWarn( $member ) ):
$return .= <<<CONTENT

			<ul class="ipsMenu ipsMenu_narrow ipsHide" id="elUserHovercard_
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $rnd, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_more_menu">
				
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and $member->member_id != \IPS\Member::loggedIn()->member_id and !$member->modPermission() and !$member->isAdmin() ):
$return .= <<<CONTENT

					
CONTENT;

if ( $member->members_bitoptions['bw_is_spammer'] ):
$return .= <<<CONTENT

						<li class="ipsMenu_item"><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$member->member_id}&s=0&referrer={$referrer}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" data-confirm data-confirmsubmessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"><i class="fa fa-flag"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

else:
$return .= <<<CONTENT

						<li class="ipsMenu_item"><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$member->member_id}&s=1&referrer={$referrer}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" data-confirm><i class="fa fa-flag"></i> 
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

				
CONTENT;

if ( \IPS\Member::loggedIn()->canWarn( $member ) ):
$return .= <<<CONTENT

					<li class="ipsMenu_item"><a href="
CONTENT;
$return .= htmlspecialchars( $addWarningUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_user_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsdialog data-ipsdialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"><i class="fa fa-exclamation-triangle"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

		return $return;
}

	function memberFollow( $app, $area, $id, $count, $search=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<div data-followApp='
CONTENT;
$return .= htmlspecialchars( $app, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-followArea='
CONTENT;
$return .= htmlspecialchars( $area, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-followID='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $search ):
$return .= <<<CONTENT
data-buttonType='search'
CONTENT;

endif;
$return .= <<<CONTENT
 data-controller='core.front.core.followButton'>
	
CONTENT;

if ( $search ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberSearchFollowButton( $app, $area, $id, $count );
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberFollowButton( $app, $area, $id, $count );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function memberFollowButton( $app, $area, $id, $count ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	<div class="ipsResponsive_hidePhone ipsResponsive_block">
		
CONTENT;

if ( \IPS\Member::loggedIn()->following( $app, $area, $id ) ):
$return .= <<<CONTENT

			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsButton ipsButton_positive" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick><i class='fa fa-check'></i><i class='fa fa-user'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
		
CONTENT;

else:
$return .= <<<CONTENT
	
			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_this_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsButton ipsButton_primary" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick><i class='fa fa-plus'></i><i class='fa fa-user'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div class="ipsResponsive_showPhone ipsResponsive_block">
		
CONTENT;

if ( \IPS\Member::loggedIn()->following( $app, $area, $id ) ):
$return .= <<<CONTENT

			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsButton ipsButton_positive ipsButton_fullWidth ipsButton_small" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick><i class='fa fa-check'></i><i class='fa fa-user'></i> <i class='fa fa-caret-down'></i></a>
		
CONTENT;

else:
$return .= <<<CONTENT
	
			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_this_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsButton ipsButton_fullWidth ipsButton_small ipsButton_alternate" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick><i class='fa fa-plus'></i><i class='fa fa-user'></i></a>
		
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

	function memberSearchFollowButton( $app, $area, $id, $count ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->following( $app, $area, $id ) ):
$return .= <<<CONTENT

		<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}&from_search=1", null, "", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_small ipsButton_positive ipsButton_fullWidth" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
	
CONTENT;

else:
$return .= <<<CONTENT
	
		<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}&from_search=1", null, "", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_this_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_small ipsButton_primary ipsButton_fullWidth" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function nameHistoryRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		<li class='ipsDataItem'>
			<div class="ipsDataItem_main ipsType_center">
		   		<h4 class='ipsType_minorHeading'>
CONTENT;

$val = ( $row['dname_date'] instanceof \IPS\DateTime ) ? $row['dname_date'] : \IPS\DateTime::ts( $row['dname_date'] );$return .= $val->html();
$return .= <<<CONTENT
</h4>
		   		<p class='ipsType_reset ipsType_large'>
		      		
CONTENT;
$return .= htmlspecialchars( $row['dname_previous'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 &nbsp;&nbsp;<i class='fa fa-angle-right'></i>&nbsp;&nbsp; 
CONTENT;
$return .= htmlspecialchars( $row['dname_current'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

		      	</p>
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

	function nameHistoryTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT



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

if ( count( $rows ) ):
$return .= <<<CONTENT

<ol class='ipsDataList ipsClear 
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
    <p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_rows_in_table', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
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

CONTENT;

		return $return;
}

	function photoCrop( $name, $value, $photo ) {
		$return = '';
		$return .= <<<CONTENT


<div data-controller='core.front.profile.cropper' id='elPhotoCropper' class='ipsAreaBackground_light ipsType_center ipsPad'>
	<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'photo_crop_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<p class='ipsType_light ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'photo_crop_instructions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	<br>

	<div data-role='cropper'>
		<img src="
CONTENT;
$return .= htmlspecialchars( $photo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role='profilePhoto'>
	</div>

	<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[0]' value='
CONTENT;
$return .= htmlspecialchars( $value[0], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='topLeftX'>
	<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[1]' value='
CONTENT;
$return .= htmlspecialchars( $value[1], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='topLeftY'>
	<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[2]' value='
CONTENT;
$return .= htmlspecialchars( $value[2], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='bottomRightX'>
	<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[3]' value='
CONTENT;
$return .= htmlspecialchars( $value[3], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='bottomRightY'>
</div>
CONTENT;

		return $return;
}

	function profile( $member, $mainContent, $visitors, $sidebarFields, $followers, $addWarningUrl ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<!-- When altering this template be sure to also check for similar in the hovercard -->
<div data-controller='core.front.profile.main'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core", 'front' )->profileHeader( $member, false );
$return .= <<<CONTENT

	<div class='ipsSpacer_top'><div data-role="profileContent">

CONTENT;

endif;
$return .= <<<CONTENT

      <div class='ipsBox'>
		<div class='ipsColumns ipsColumns_noSpacing ipsColumns_collapseTablet' data-controller="core.front.profile.body">
			<div class='ipsColumn ipsColumn_fixed ipsColumn_veryWide ipsAreaBackground_light' id='elProfileInfoColumn'>
				<div class='ipsPad'>
					
CONTENT;

if ( \IPS\Settings::i()->reputation_enabled and \IPS\Settings::i()->reputation_show_profile ):
$return .= <<<CONTENT

						<div class='cProfileSidebarBlock ipsBox ipsSpacer_bottom'>
							
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

								<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation", null, "profile_reputation", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" data-action="repLog" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_reputation', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
							
CONTENT;

endif;
$return .= <<<CONTENT

								<div class='cProfileRepScore ipsPad_half 
CONTENT;

if ( $member->pp_reputation_points > 1 ):
$return .= <<<CONTENT
cProfileRepScore_positive
CONTENT;

elseif ( $member->pp_reputation_points < 0 ):
$return .= <<<CONTENT
cProfileRepScore_negative
CONTENT;

else:
$return .= <<<CONTENT
cProfileRepScore_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'>
									<h2 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_reputation', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
									<span class='cProfileRepScore_points'>
CONTENT;
$return .= htmlspecialchars( $member->pp_reputation_points, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
									
CONTENT;

if ( $member->reputation() ):
$return .= <<<CONTENT

										<span class='cProfileRepScore_title'>
CONTENT;
$return .= htmlspecialchars( $member->reputation(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $member->reputationImage() ):
$return .= <<<CONTENT

										<div class='ipsAreaBackground_reset ipsAreaBackground_rounded ipsPad_half ipsType_center'>
											<img src='
CONTENT;

$return .= \IPS\File::get( "core_Theme", $member->reputationImage() )->url;
$return .= <<<CONTENT
' alt=''>
										</div>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</div>
							
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

								<p class='ipsType_reset ipsPad_half ipsType_right ipsType_light ipsType_small'>
									
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_show_activity', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-right'></i>
								</p>
							</a>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
					
CONTENT;

if ( \IPS\Settings::i()->warn_on and !$member->inGroup( explode( ',', \IPS\Settings::i()->warn_protected ) ) and ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') or ( \IPS\Settings::i()->warn_show_own and \IPS\Member::loggedIn()->member_id == $member->member_id ) ) ):
$return .= <<<CONTENT

						<div class='cProfileSidebarBlock ipsBox ipsSpacer_bottom'>
							<div id='elWarningInfo' class='ipsPad 
CONTENT;

if ( $member->mod_posts || $member->restrict_post || $member->temp_ban ):
$return .= <<<CONTENT
ipsAreaBackground_negative
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix'>
								<i class='ipsPos_left 
CONTENT;

if ( $member->warn_level > 0 || $member->mod_posts || $member->restrict_post || $member->temp_ban ):
$return .= <<<CONTENT
fa fa-exclamation-triangle
CONTENT;

else:
$return .= <<<CONTENT
fa fa-circle-o ipsType_light
CONTENT;

endif;
$return .= <<<CONTENT
'></i>
								<div>
									<h2 class='ipsType_sectionHead'>
CONTENT;

$pluralize = array( $member->warn_level ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_warn_level', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
									<br>
									
CONTENT;

if ( !$member->mod_posts && !$member->restrict_post && !$member->temp_ban ):
$return .= <<<CONTENT

										<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_restrictions_applied', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
										<br>
									
CONTENT;

else:
$return .= <<<CONTENT

										<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restrictions_applied', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
										<ul class='ipsList_bullets ipsSpacer_top ipsSpacer_half'>
											
CONTENT;

if ( $member->mod_posts ):
$return .= <<<CONTENT

												<li data-ipsTooltip title="
CONTENT;

if ( $member->mod_posts == -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_modq_perm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( $member->mod_posts )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_modq_temp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
													
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_modq', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

												</li>
											
CONTENT;

endif;
$return .= <<<CONTENT

											
CONTENT;

if ( $member->restrict_post ):
$return .= <<<CONTENT

												<li data-ipsTooltip title="
CONTENT;

if ( $member->restrict_post == -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_nopost_perm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( $member->restrict_post )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_nopost_temp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
													
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_nopost', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

												</li>
											
CONTENT;

endif;
$return .= <<<CONTENT

											
CONTENT;

if ( $member->temp_ban ):
$return .= <<<CONTENT

												<li data-ipsTooltip title="
CONTENT;

if ( $member->temp_ban == -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_banned_perm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( $member->temp_ban )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_banned_temp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
													
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_banned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( ( \IPS\Member::loggedIn()->canWarn( $member ) || ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and !$member->modPermission() and !$member->isAdmin() ) ) and $member->member_id != \IPS\Member::loggedIn()->member_id  ):
$return .= <<<CONTENT

										<br>
										<ul class='
CONTENT;

if ( \IPS\Member::loggedIn()->canWarn( $member ) && \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and $member->member_id != \IPS\Member::loggedIn()->member_id and !$member->modPermission() and !$member->isAdmin() ):
$return .= <<<CONTENT
ipsButton_split
CONTENT;

else:
$return .= <<<CONTENT
ipsList_inline
CONTENT;

endif;
$return .= <<<CONTENT
'>
											
CONTENT;

if ( \IPS\Member::loggedIn()->canWarn( $member ) ):
$return .= <<<CONTENT

												<li>
													<a href='
CONTENT;
$return .= htmlspecialchars( $addWarningUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elWarnUserButton' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_light ipsButton_verySmall' title='
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
												</li>
											
CONTENT;

endif;
$return .= <<<CONTENT

											
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and $member->member_id != \IPS\Member::loggedIn()->member_id and !$member->modPermission() and !$member->isAdmin() ):
$return .= <<<CONTENT

												<li>
													
CONTENT;

if ( $member->members_bitoptions['bw_is_spammer'] ):
$return .= <<<CONTENT

														<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&id={$member->member_id}&s=0" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
													
CONTENT;

else:
$return .= <<<CONTENT

														<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&id={$member->member_id}&s=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
													
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

								</div>
							</div>
							
CONTENT;

if ( count( $member->warnings( 1 ) ) ):
$return .= <<<CONTENT

								<div data-role="recentWarnings" class=''>
									<ol class='ipsDataList'>
										
CONTENT;

foreach ( $member->warnings( 2 ) as $warning ):
$return .= <<<CONTENT

											<li class="ipsDataItem" id='elWarningOverview_
CONTENT;
$return .= htmlspecialchars( $warning->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
												<div class='ipsDataItem_icon ipsType_center'>
													<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&id={$member->member_id}&w={$warning->id}", null, "warn_view", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' class="ipsType_blendLinks" data-ipsTooltip title='
CONTENT;

$pluralize = array( $warning->points ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'wan_action_points', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
														<span class="ipsPoints">
CONTENT;
$return .= htmlspecialchars( $warning->points, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
													</a>
												</div>
												<div class='ipsDataItem_main'>
													
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
' data-ipsTooltip data-action="revoke" class='ipsPos_right ipsButton ipsButton_small ipsButton_light ipsButton_narrow' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke_this_warning', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-size='medium'><i class="fa fa-undo"></i></a>
													
CONTENT;

endif;
$return .= <<<CONTENT

													<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&id={$member->member_id}&w={$warning->id}", null, "warn_view", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-showFrom='#elWarningOverview_
CONTENT;
$return .= htmlspecialchars( $warning->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog-size='narrow' class="ipsType_blendLinks" title=''>
														<h4 class="ipsType_reset ipsType_medium ipsType_unbold">
															
CONTENT;

if ( \IPS\Settings::i()->warnings_acknowledge ):
$return .= <<<CONTENT

																
CONTENT;

if ( $warning->acknowledged ):
$return .= <<<CONTENT

																	<strong class='ipsType_success' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_acknowledged', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-check-circle'></i></strong>
																
CONTENT;

else:
$return .= <<<CONTENT

																	<strong class='ipsType_light' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_not_acknowledged', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-circle-o'></i></strong>
																
CONTENT;

endif;
$return .= <<<CONTENT

															
CONTENT;

endif;
$return .= <<<CONTENT

															
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
									<p class='ipsType_reset ipsType_center ipsType_small ipsPad_half'>
										<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&id={$member->member_id}", null, "warn_list", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_warnings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-remoteVerify='false' data-ipsDialog-remoteSubmit='false' data-ipsDialog-title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_warnings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_c', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
									</p>
								</div>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					
CONTENT;

else:
$return .= <<<CONTENT

                        
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and !$member->inGroup( explode( ',', \IPS\Settings::i()->warn_protected ) ) and \IPS\Member::loggedIn()->member_id != $member->member_id ):
$return .= <<<CONTENT

                            
CONTENT;

if ( $member->members_bitoptions['bw_is_spammer'] ):
$return .= <<<CONTENT

                                <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&id={$member->member_id}&s=0" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
                            
CONTENT;

else:
$return .= <<<CONTENT

                                <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&id={$member->member_id}&s=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
                            
CONTENT;

endif;
$return .= <<<CONTENT

                        
CONTENT;

endif;
$return .= <<<CONTENT

                    
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( count( $followers ) || \IPS\Member::loggedIn()->member_id === $member->member_id ):
$return .= <<<CONTENT

						<div class='ipsWidget ipsWidget_vertical cProfileSidebarBlock ipsBox ipsSpacer_bottom' id='elFollowers' data-feedID='member-
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.front.profile.followers'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->followers( $member, $followers );
$return .= <<<CONTENT

						</div>
	 				
CONTENT;

endif;
$return .= <<<CONTENT


					<div class='ipsWidget ipsWidget_vertical cProfileSidebarBlock ipsBox ipsSpacer_bottom'>
						<h2 class='ipsWidget_title ipsType_reset'>
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_about', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</h2>
						<div class='ipsWidget_inner ipsPad'>
							
CONTENT;

if ( $member->group['g_icon']  ):
$return .= <<<CONTENT

								<div class='ipsType_center ipsPad_half'><img src='
CONTENT;

$return .= \IPS\File::get( "core_Theme", $member->group['g_icon'] )->url;
$return .= <<<CONTENT
' alt=''></div>
							
CONTENT;

endif;
$return .= <<<CONTENT

							<ul class='ipsDataList ipsDataList_reducedSpacing cProfileFields'>
								
CONTENT;

if ( $member->isOnline() AND $member->location ):
$return .= <<<CONTENT

									<li class="ipsDataItem">
										<span class="ipsDataItem_generic ipsDataItem_size3 ipsType_break"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_users_location_lang', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
										<span class="ipsDataItem_main">{$member->location()}</span>
									</li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $member->member_title || $member->rank['title'] || $member->rank['image'] ):
$return .= <<<CONTENT

									<li class='ipsDataItem'>
										<span class='ipsDataItem_generic ipsDataItem_size3 ipsType_break'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_rank', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
										<div class='ipsDataItem_generic'>
											
CONTENT;

if ( $member->member_title ):
$return .= <<<CONTENT

												
CONTENT;
$return .= htmlspecialchars( $member->member_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

												<br>
											
CONTENT;

elseif ( $member->rank['title'] ):
$return .= <<<CONTENT

												
CONTENT;
$return .= htmlspecialchars( $member->rank['title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

												<br>
											
CONTENT;

endif;
$return .= <<<CONTENT

											{$member->rank['image']}
										</div>
									</li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $member->birthday ):
$return .= <<<CONTENT

									<li class='ipsDataItem'>
										<span class='ipsDataItem_generic ipsDataItem_size3 ipsType_break'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'bday', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
										<span class='ipsDataItem_generic'>
CONTENT;
$return .= htmlspecialchars( $member->birthday, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
									</li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</ul>
						</div>
					</div>
					
CONTENT;

foreach ( $sidebarFields as $group => $fields ):
$return .= <<<CONTENT

						
CONTENT;

if ( count( $fields ) ):
$return .= <<<CONTENT

						<div class='ipsWidget ipsWidget_vertical cProfileSidebarBlock ipsBox ipsSpacer_bottom'>
							
CONTENT;

if ( $group != 'core_pfieldgroups_0' ):
$return .= <<<CONTENT

                                <h2 class='ipsWidget_title ipsType_reset'>
CONTENT;

$val = "{$group}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
                            
CONTENT;

endif;
$return .= <<<CONTENT

                            <div class='ipsWidget_inner ipsPad'>
								<ul class='ipsDataList ipsDataList_reducedSpacing cProfileFields'>
									
CONTENT;

foreach ( $fields as $field => $value ):
$return .= <<<CONTENT

										<li class='ipsDataItem'>
											<span class='ipsDataItem_generic ipsDataItem_size3 ipsType_break'><strong>
CONTENT;

$val = "{$field}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
											<span class='ipsDataItem_generic'>{$value}</span>
										</li>
									
CONTENT;

endforeach;
$return .= <<<CONTENT

								</ul>
							</div>
						</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_see_emails') ):
$return .= <<<CONTENT

						<div class='ipsWidget ipsWidget_vertical cProfileSidebarBlock ipsBox ipsSpacer_bottom'>
							<h2 class='ipsWidget_title ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_contact', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
							<div class='ipsWidget_inner ipsPad'>
								<ul class='ipsDataList ipsDataList_reducedSpacing'>
									<li class='ipsDataItem'>
										<span class='ipsDataItem_generic ipsDataItem_size3'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
										<span class='ipsDataItem_generic'><a href='mailto:
CONTENT;
$return .= htmlspecialchars( $member->email, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_this_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Lang::wordbreak( htmlspecialchars( $member->email, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) );
$return .= <<<CONTENT
</a></span>
									</li>
								</ul>
							</div>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( !empty( $visitors ) || \IPS\Member::loggedIn()->member_id == $member->member_id ):
$return .= <<<CONTENT

						<div class='ipsWidget ipsWidget_vertical cProfileSidebarBlock ipsBox ipsSpacer_bottom' data-controller='core.front.profile.toggleBlock'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", \IPS\Request::i()->app )->recentVisitorsBlock( $member, $visitors );
$return .= <<<CONTENT

						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>

			</div>
			<section class='ipsColumn ipsColumn_fluid'>
              
				{$mainContent}
             
			</section>
        </div></div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div></div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function profileActivity( $member, $latestActivity, $statusForm=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller="core.front.statuses.statusFeed">
	
CONTENT;

if ( $statusForm ):
$return .= <<<CONTENT

		<div class='ipsAreaBackground_light ipsPad ipsSpacer_bottom'>
			<div class='ipsComposeArea ipsComposeArea_withPhoto ipsClearfix' data-role='newStatus'>
				<div class='ipsPos_left ipsResponsive_hidePhone ipsResponsive_block'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::loggedIn(), 'small' );
$return .= <<<CONTENT
</div>
				<div class='ipsComposeArea_editor'>
					{$statusForm}
				</div>
			</div>
		</div>
	
CONTENT;

elseif ( !count( $latestActivity ) ):
$return .= <<<CONTENT

		<div class='ipsPad ipsType_center ipsType_large ipsType_light'>
			
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_recent_activity', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $statusForm or count( $latestActivity ) ):
$return .= <<<CONTENT

		<ol class='ipsStream ipsList_reset' data-role='activityStream' id='elProfileActivityOverview'>
			
CONTENT;

foreach ( $latestActivity as $activity ):
$return .= <<<CONTENT

				{$activity->html()}
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function profileHeader( $member, $small=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$coverPhoto = $member->coverPhoto();
$return .= <<<CONTENT

<header data-role="profileHeader"><div class="ipsPageHead_special 
CONTENT;

if ( $small === true ):
$return .= <<<CONTENT
cProfileHeaderMinimal
CONTENT;

endif;
$return .= <<<CONTENT
" id="elProfileHeader" data-controller="core.front.core.coverPhoto" data-url="
CONTENT;
$return .= htmlspecialchars( $member->url()->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-coveroffset="
CONTENT;
$return .= htmlspecialchars( $coverPhoto->offset, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

if ( $coverPhoto->file ):
$return .= <<<CONTENT

			<div class="ipsCoverPhoto_container">
				<img src="
CONTENT;
$return .= htmlspecialchars( $coverPhoto->file->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsCoverPhoto_photo" alt="">
</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_modify_profiles') or ( \IPS\Member::loggedIn()->member_id == $member->member_id and $member->group['g_edit_profile'] ) ):
$return .= <<<CONTENT

			<ul class="ipsButton_split" id="elEditProfile" data-hideoncoveredit>
<li>
					<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=edit&id={$member->member_id}", "front", "edit_profile", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_overlaid" data-ipsdialog data-ipsdialog-modal="true" data-ipsdialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
						<i class="fa fa-pencil"></i> <span class="ipsResponsive_hidePhone ipsResponsive_inline">  
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
					</a>
				</li>
				
CONTENT;

if ( $coverPhoto->editable ):
$return .= <<<CONTENT

					<li>
					<a href="#elEditPhoto_menu" data-hideoncoveredit class="ipsButton ipsButton_overlaid" data-ipsmenu id="elEditPhoto" data-role="coverPhotoOptions">
						<i class="fa fa-picture-o"></i> <span class="ipsResponsive_hidePhone ipsResponsive_inline">  
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit_cover_photo_tab', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></span>
					</a>
					<ul class="ipsMenu ipsMenu_auto ipsHide" id="elEditPhoto_menu">
						
CONTENT;

if ( $coverPhoto->file ):
$return .= <<<CONTENT

						<li class="ipsMenu_item" data-role="photoEditOption">
							<a href="
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( 'do', 'coverPhotoRemove' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="removeCoverPhoto">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_remove', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						<li class="ipsMenu_item ipsHide" data-role="photoEditOption">
							<a href="#" data-action="positionCoverPhoto">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_reposition', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<li class="ipsMenu_item">
							<a href="
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( 'do', 'coverPhotoUpload' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsdialog data-ipsdialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_add', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_add', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
					</ul>
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
			
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsColumns ipsColumns_collapsePhone" data-hideoncoveredit>
			<div class="ipsColumn ipsColumn_fixed ipsColumn_narrow ipsPos_center" id="elProfilePhoto">
				
CONTENT;

if ( $member->pp_main_photo and ( mb_substr( $member->pp_photo_type, 0, 5 ) === 'sync-' or $member->pp_photo_type === 'custom' ) ):
$return .= <<<CONTENT

					<a href="
CONTENT;

$return .= \IPS\File::get( "core_Profile", $member->pp_main_photo )->url;
$return .= <<<CONTENT
" data-ipslightbox class="ipsUserPhoto ipsUserPhoto_xlarge">					
						<img src="
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" alt=""></a>
				
CONTENT;

else:
$return .= <<<CONTENT

					<span class="ipsUserPhoto ipsUserPhoto_xlarge">					
						<img src="
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" alt=""></span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_modify_profiles') or ( \IPS\Member::loggedIn()->member_id == $member->member_id and $member->group['g_edit_profile'] ) ):
$return .= <<<CONTENT

					<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=editPhoto&id={$member->member_id}", "front", "edit_profile_photo", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_verySmall ipsButton_light ipsButton_narrow" data-action="editPhoto" data-ipsdialog data-ipsdialog-forcereload="true" data-ipsdialog-modal="true" data-ipsdialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit_photo_tab', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit_photo_tab', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipstooltip><i class="fa fa-photo"></i></a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class="ipsColumn ipsColumn_fluid">
				<div class="ipsPos_left ipsPad cProfileHeader_name">
					<h1 class="ipsType_reset">
						
CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					</h1>
					
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_view_displaynamehistory'] AND $member->hasNameChanges() ):
$return .= <<<CONTENT

						<a href="
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( 'do', 'namehistory' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cProfileHeader_history ipsType_large ipsPos_right" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'membername_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipstooltip data-ipsdialog data-ipsdialog-modal="true" data-ipsdialog-size="narrow" data-ipsdialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'membername_history', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
							<i class="fa fa-history"></i>
						</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<span>
CONTENT;

$return .= \IPS\Member\Group::load( $member->member_group_id )->formattedName;
$return .= <<<CONTENT
</span>
				</div>
				
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id ):
$return .= <<<CONTENT

					<ul class="ipsList_inline ipsPad ipsResponsive_hidePhone ipsResponsive_block">
						
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id and ( !$member->members_bitoptions['pp_setting_moderate_followers'] or \IPS\Member::loggedIn()->following( 'core', 'member', $member->member_id ) ) ):
$return .= <<<CONTENT

							
CONTENT;

$memberFollowers = $member->followers();
$return .= <<<CONTENT

							<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberFollow( 'core', 'member', $member->member_id, ( $memberFollowers === NULL ) ? 0 : $memberFollowers->count( TRUE ) );
$return .= <<<CONTENT
</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Member::loggedIn()->member_id && !$member->members_disable_pm and !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

							<li><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$member->member_id}", null, "messenger_compose", array(), 0 ) );
$return .= <<<CONTENT
" data-ipsdialog data-ipsdialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsdialog-remotesubmit data-ipsdialog-flashmessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_primary"><i class="fa fa-envelope"></i> <span class="ipsResponsive_showDesktop ipsResponsive_inline">  
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_send', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a></li>
						
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

	<div class="ipsGrid ipsAreaBackground ipsPad ipsResponsive_showPhone ipsResponsive_block">
		
CONTENT;

$span = 1;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id && \IPS\Member::loggedIn()->member_id != $member->member_id and !$member->members_bitoptions['pp_setting_moderate_followers'] ):
$return .= <<<CONTENT

			
CONTENT;

$span++;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id && \IPS\Member::loggedIn()->member_id && !$member->members_disable_pm and !\IPS\Member::loggedIn()->members_disable_pm ):
$return .= <<<CONTENT

			
CONTENT;

$span++;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id && \IPS\Member::loggedIn()->member_id != $member->member_id and !$member->members_bitoptions['pp_setting_moderate_followers'] ):
$return .= <<<CONTENT

			<div class="ipsGrid_span
CONTENT;

if ( $span == 1 ):
$return .= <<<CONTENT
12
CONTENT;

elseif ( $span == 2 ):
$return .= <<<CONTENT
6
CONTENT;

else:
$return .= <<<CONTENT
4
CONTENT;

endif;
$return .= <<<CONTENT
">
				
CONTENT;

$memberFollowers = $member->followers();
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberFollow( 'core', 'member', $member->member_id, ( $memberFollowers === NULL ) ? 0 : $memberFollowers->count( TRUE ) );
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id && \IPS\Member::loggedIn()->member_id && !$member->members_disable_pm and !\IPS\Member::loggedIn()->members_disable_pm ):
$return .= <<<CONTENT

			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$member->member_id}", null, "messenger_compose", array(), 0 ) );
$return .= <<<CONTENT
" data-ipsdialog data-ipsdialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsdialog-remotesubmit data-ipsdialog-flashmessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsdialog-forcereload class="ipsGrid_span
CONTENT;

if ( $span == 1 ):
$return .= <<<CONTENT
12
CONTENT;

elseif ( $span == 2 ):
$return .= <<<CONTENT
6
CONTENT;

else:
$return .= <<<CONTENT
4
CONTENT;

endif;
$return .= <<<CONTENT
 ipsButton ipsButton_alternate ipsButton_small"><i class="
			fa fa-envelope"></i> <i class="fa fa-caret-right"></i></a>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div data-role="switchView" class="ipsGrid_span
CONTENT;

if ( $span == 1 ):
$return .= <<<CONTENT
12
CONTENT;

elseif ( $span == 2 ):
$return .= <<<CONTENT
6
CONTENT;

else:
$return .= <<<CONTENT
4
CONTENT;

endif;
$return .= <<<CONTENT
">
			<div data-action="goToProfile" data-type="phone" class="
CONTENT;

if ( $small != true ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
">
				<a href="
CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_light ipsButton_small ipsButton_fullWidth" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"><i class="fa fa-user"></i></a>
			</div>
			<div data-action="browseContent" data-type="phone" class="
CONTENT;

if ( $small == true ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
">
				<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=content&id={$member->member_id}", "front", "profile_content", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_alternate ipsButton_small ipsButton_fullWidth" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"><i class="fa fa-newspaper-o"></i></a>
			</div>
		</div>
	</div>

	<div id="elProfileStats" class="ipsClearfix">
		<div data-role="switchView" class="ipsResponsive_hidePhone ipsResponsive_block">
			<a href="
CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_veryLight ipsButton_medium ipsPos_right 
CONTENT;

if ( $small != true ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
" data-action="goToProfile" data-type="full" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"><i class="fa fa-user"></i> <span class="ipsResponsive_showDesktop ipsResponsive_inline"> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_view_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a>
			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=content&id={$member->member_id}", "front", "profile_content", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_light ipsButton_medium ipsPos_right 
CONTENT;

if ( $small == true ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
" data-action="browseContent" data-type="full" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"><i class="fa fa-newspaper-o"></i> <span class="ipsResponsive_showDesktop ipsResponsive_inline"> 
CONTENT;

if ( \IPS\Member::loggedIn()->member_id === $member->member_id ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_browse_my_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_browse_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span></a>
		</div>
		<ul class="ipsList_inline ipsPos_left">
<li>
				<h4 class="ipsType_minorHeading">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_member_posts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->member_posts );
$return .= <<<CONTENT

			</li>
CONTENT;

if ( !isset( $donateTemplateLoaded ) ):
$return .= <<<CONTENT

	
CONTENT;

$donateTemplateLoaded = TRUE;
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "donate" )->profileHook( $member );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

			<li>
				<h4 class="ipsType_minorHeading">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'joined', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				
CONTENT;

$val = ( $member->joined instanceof \IPS\DateTime ) ? $member->joined : \IPS\DateTime::ts( $member->joined );$return .= $val->html();
$return .= <<<CONTENT

			</li>
CONTENT;

if ( !isset( $donateTemplateLoaded ) ):
$return .= <<<CONTENT

	
CONTENT;

$donateTemplateLoaded = TRUE;
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "donate" )->profileHook( $member );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

			<li>
				<h4 class="ipsType_minorHeading">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_last_visit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<span>
					
CONTENT;

if ( $member->isOnline() ):
$return .= <<<CONTENT
<i class="fa fa-circle ipsOnlineStatus_online" data-ipstooltip title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"></i>
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $member->last_activity ):
$return .= <<<CONTENT

CONTENT;

$val = ( $member->last_activity instanceof \IPS\DateTime ) ? $member->last_activity : \IPS\DateTime::ts( $member->last_activity );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'never', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

				</span>
			</li>
CONTENT;

if ( !isset( $donateTemplateLoaded ) ):
$return .= <<<CONTENT

	
CONTENT;

$donateTemplateLoaded = TRUE;
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "donate" )->profileHook( $member );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Settings::i()->reputation_leaderboard_on and \IPS\Settings::i()->reputation_show_days_won_trophy and $member->getReputationDaysWonCount() ):
$return .= <<<CONTENT

			<li>
				<h4 class="ipsType_minorHeading">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_days_won_count', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<span data-ipstooltip title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_days_won_count_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->getReputationDaysWonCount() );
$return .= <<<CONTENT
</span>
			</li>
CONTENT;

if ( !isset( $donateTemplateLoaded ) ):
$return .= <<<CONTENT

	
CONTENT;

$donateTemplateLoaded = TRUE;
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "donate" )->profileHook( $member );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "plugins", "core", 'global' )->totalTimeSpentOnlineProfile( $member );
$return .= <<<CONTENT
</ul>
</div>
</header>

CONTENT;

		return $return;
}

	function profileTabs( $member, $tabs, $activeTab, $activeTabContents ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $tabs ) > 1 ):
$return .= <<<CONTENT

	<div class='ipsTabs ipsTabs_stretch ipsClearfix' id='elProfileTabs' data-ipsTabBar data-ipsTabBar-contentArea='#elProfileTabs_content'>
		<a href='#elProfileTabs' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
		<ul role="tablist">
			
CONTENT;

foreach ( $tabs as $tab => $title ):
$return .= <<<CONTENT

				<li>
					<a href='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( 'tab', $tab ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elProfileTab_
CONTENT;
$return .= htmlspecialchars( $tab, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_item ipsType_center 
CONTENT;

if ( $activeTab == $tab ):
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

$val = "{$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

<div id='elProfileTabs_content' class='ipsTabs_panels ipsPad_double ipsAreaBackground_reset'>
	
CONTENT;

foreach ( $tabs as $tab => $title ):
$return .= <<<CONTENT

		
CONTENT;

if ( $activeTab == $tab ):
$return .= <<<CONTENT

			<div id="ipsTabs_elProfileTabs_elProfileTab_
CONTENT;
$return .= htmlspecialchars( $tab, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel" class='ipsTabs_panel ipsAreaBackground_reset'>
				{$activeTabContents}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function recentVisitorsBlock( $member, $visitors ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $member->members_bitoptions['pp_setting_count_visitors'] ):
$return .= <<<CONTENT

	
	<h2 class='ipsWidget_title ipsType_reset'>
		
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_modify_profiles') or ( \IPS\Member::loggedIn()->member_id == $member->member_id and $member->group['g_edit_profile'] ) ):
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=visitors&id=$member->member_id" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "profile", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' class='ipsType_light ipsType_normal ipsPos_right ipsFaded ipsFaded_more ipsFaded_withHover' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide_recent_visitors', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action='disable'><i class='fa fa-times'></i></a>
		
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_recent_visitors', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</h2>
	<div class='ipsWidget_inner ipsPad'>
		<span class='ipsType_light'>
			
CONTENT;

$pluralize = array( $member->members_profile_views ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_views', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

		</span>
		
CONTENT;

if ( count($visitors)  ):
$return .= <<<CONTENT

			<ul class='ipsDataList ipsDataList_reducedSpacing ipsSpacer_top'>
			
CONTENT;

foreach ( $visitors as $visitor ):
$return .= <<<CONTENT

				<li class='ipsDataItem'>
					<div class='ipsType_center ipsDataItem_icon'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $visitor['member'], 'tiny' );
$return .= <<<CONTENT

					</div>
					<div class='ipsDataItem_main'>
						<h3 class='ipsDataItem_title'>{$visitor['member']->link()}</h3>
						<p class='ipsDataItem_meta ipsType_light'>
CONTENT;

$val = ( $visitor['visit_time'] instanceof \IPS\DateTime ) ? $visitor['visit_time'] : \IPS\DateTime::ts( $visitor['visit_time'] );$return .= $val->html();
$return .= <<<CONTENT
</p>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsType_center ipsType_medium'>
				<p class='ipsType_light'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_recent_visitors', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</p>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<h2 class='ipsWidget_title ipsType_reset'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_recent_visitors', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</h2>
	<div class='ipsWidget_inner ipsPad'>
		<div class='ipsType_center ipsType_medium'>
			<p class='ipsType_light'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disabled_recent_visitors', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</p>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=visitors&id={$member->member_id}&state=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "profile", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' class='' data-action='enable'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enable', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

		return $return;
}

	function singleStatus( $member, $status ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPad' id='elSingleStatusUpdate'>
	<h2 class='ipsType_pageTitle 
CONTENT;

if ( !isset( \IPS\Request::i()->status ) ):
$return .= <<<CONTENT
ipsSpacer_top
CONTENT;

endif;
$return .= <<<CONTENT
'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'viewing_single_status', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</h2>
	<p class='ipsType_reset ipsType_normal ipsSpacer_bottom'>
		<a href='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( array( 'do' => 'content', 'type' => 'core_statuses_status', 'change_section' => 1 ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-caret-left'></i> 
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_statuses_by_x', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a>
	</p>
	<div data-controller='core.front.profile.statusFeed' class='cStatusUpdates ipsSpacer_top'>
		<ol class='ipsType_normal ipsList_reset' data-role='commentFeed'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "statuses", "core" )->statusContainer( $status );
$return .= <<<CONTENT

		</ol>
	</div>
</div>
CONTENT;

		return $return;
}

	function tableRow( $table, $headers, $members ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $members as $member ):
$return .= <<<CONTENT

	
CONTENT;

$loadedMember = \IPS\Member::load( $member->member_id );
$return .= <<<CONTENT

	<li class='ipsDataItem'>
		<div class='ipsDataItem_icon'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $loadedMember, 'medium' );
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<h3 class='ipsType_sectionHead'>{$loadedMember->link()}</h3> 
CONTENT;

if ( $loadedMember->isOnline() ):
$return .= <<<CONTENT
<i class="fa fa-circle ipsOnlineStatus_online" data-ipsTooltip title='
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'></i>
CONTENT;

endif;
$return .= <<<CONTENT
<br>
			<span class='ipsType_normal'>
CONTENT;

$return .= \IPS\Member\Group::load( $member->member_group_id )->formattedName;
$return .= <<<CONTENT
</span>
			<ul class='ipsList_inline ipsType_light'>
				<li><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_member_posts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: 
CONTENT;
$return .= htmlspecialchars( $loadedMember->member_posts, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></li>
				<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_joined', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $loadedMember->joined instanceof \IPS\DateTime ) ? $loadedMember->joined : \IPS\DateTime::ts( $loadedMember->joined );$return .= $val->html();
$return .= <<<CONTENT
</li>
				
CONTENT;

if ( $loadedMember->last_activity ):
$return .= <<<CONTENT

					<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_last_visit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $loadedMember->last_activity instanceof \IPS\DateTime ) ? $loadedMember->last_activity : \IPS\DateTime::ts( $loadedMember->last_activity );$return .= $val->html();
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>
		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $member ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userContent( $member, $types, $currentAppModule, $currentType, $table ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<div data-controller='core.front.profile.main'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core", 'front' )->profileHeader( $member, true );
$return .= <<<CONTENT

	<div data-role="profileContent">

CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsColumns ipsColumns_collapsePhone ipsSpacer_top">
			<div class="ipsColumn ipsColumn_wide">
				<div class="ipsSideMenu ipsAreaBackground_light ipsPad" id="modcp_menu" data-ipsTabBar data-ipsTabBar-contentArea='#elUserContent' data-ipsTabBar-itemselector=".ipsSideMenu_item" data-ipsTabBar-activeClass="ipsSideMenu_itemActive" data-ipsSideMenu>
					<h3 class="ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium">
						<a href="#user_content" class="ipsPad_double" data-action="openSideMenu"><i class="fa fa-bars"></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_content_type', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;<i class="fa fa-caret-down"></i></a>
					</h3>
					<div>
						<ul class="ipsSideMenu_list">
							<li><a href="
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( array( 'do' => 'content', 'change_section' => 1 ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( !$currentType ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all_activity', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						</ul>
						
CONTENT;

foreach ( $types as $app => $_types ):
$return .= <<<CONTENT

							<h4 class='ipsSideMenu_subTitle'>
CONTENT;

$val = "module__{$app}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
							<ul class="ipsSideMenu_list">
								
CONTENT;

foreach ( $_types as $key => $class ):
$return .= <<<CONTENT

									<li><a href="
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( array( 'do' => 'content', 'type' => $key, 'change_section' => 1 ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( $currentType == $key ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
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
			</div>
			<div class="ipsColumn ipsColumn_fluid" id='elUserContent'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->userContentSection( $member, $types, $currentAppModule, $currentType, $table );
$return .= <<<CONTENT

			</div>
		</div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userContentSection( $member, $types, $currentAppModule, $currentType, $table ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox ipsfocus_reset'>
	
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT
<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

if ( !$currentAppModule ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all_content_by_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $types[ $currentAppModule ][ $currentType ]::$title . '_pl' ), $member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_by_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
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
}

	function userContentStream( $member, $results, $pagination ) {
		$return = '';
		$return .= <<<CONTENT


<div data-baseurl="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=content&id={$member->member_id}&page=1", null, "profile_content", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" data-resort="listResort" data-tableid="topics"> <!-- data-controller="core.global.core.table" -->
	
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			<div data-role="tablePagination">
				{$pagination}
			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<ol class='ipsDataList ipsDataList_large cSearchActivity ipsStream' data-role="tableRows" itemscope itemtype="http://schema.org/ItemList">
		
CONTENT;

foreach ( $results as $activity ):
$return .= <<<CONTENT

			{$activity->html()}
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ol>
	
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			{$pagination}
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function userReputation( $member, $types, $currentAppModule, $currentType, $table ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<div data-controller='core.front.profile.main'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core", 'front' )->profileHeader( $member, true );
$return .= <<<CONTENT

	<br>
	<div data-role="profileContent">

CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsColumns ipsColumns_collapsePhone ipsSpacer_top">
			<aside class="ipsColumn ipsColumn_wide">
				<div class="cProfileRepScore ipsPad_half 
CONTENT;

if ( $member->pp_reputation_points > 1 ):
$return .= <<<CONTENT
cProfileRepScore_positive
CONTENT;

elseif ( $member->pp_reputation_points < 0 ):
$return .= <<<CONTENT
cProfileRepScore_negative
CONTENT;

else:
$return .= <<<CONTENT
cProfileRepScore_neutral
CONTENT;

endif;
$return .= <<<CONTENT
">
					<h2 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_reputation', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
					<span class='cProfileRepScore_points'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->pp_reputation_points );
$return .= <<<CONTENT
</span>		
				</div>
				<br>
				<div class="ipsSideMenu ipsAreaBackground_light ipsPad" data-ipsTabBar data-ipsTabBar-contentArea='#elUserReputation' data-ipsTabBar-itemselector=".ipsSideMenu_item" data-ipsTabBar-activeClass="ipsSideMenu_itemActive" data-ipsSideMenu>
					<h3 class="ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium">
						<a href="#user_reputation" class="ipsPad_double" data-action="openSideMenu"><i class="fa fa-bars"></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_content_type', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;<i class="fa fa-caret-down"></i></a>
					</h3>
					<div>
						
CONTENT;

foreach ( $types as $app => $_types ):
$return .= <<<CONTENT

							<h4 class='ipsSideMenu_subTitle'>
CONTENT;

$val = "module__{$app}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
							<ul class="ipsSideMenu_list">
								
CONTENT;

foreach ( $_types as $key => $class ):
$return .= <<<CONTENT

									<li><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation&type={$key}&change_section=1", null, "profile_reputation", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( $currentType == $key ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
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
			</aside>
			<section class="ipsColumn ipsColumn_fluid">
				<div class='ipsBox'>
					<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
					<div id='elUserReputation'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->userReputationSection( $table );
$return .= <<<CONTENT

					</div>
				</div>
			</section>
		</div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT
	
CONTENT;

		return $return;
}

	function userReputationRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		<li class='ipsDataItem'>		
			
CONTENT;

if ( \IPS\Settings::i()->reputation_point_types != 'like' ):
$return .= <<<CONTENT

				<div class='ipsDataItem_generic ipsDataItem_size1'>
					
CONTENT;

if ( $row->rep_rating === 1 ):
$return .= <<<CONTENT

						<span class='ipsButton ipsButton_large ipsButton_narrow ipsButton_rep ipsButton_repUp ipsButton_noHover cProfileRepLog_button'>
							<i class='fa fa-arrow-up'></i>
						</span>
					
CONTENT;

else:
$return .= <<<CONTENT

						<span class='ipsButton ipsButton_large ipsButton_narrow ipsButton_rep ipsButton_repDown ipsButton_noHover cProfileRepLog_button'>
							<i class='fa fa-arrow-down'></i>
						</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center ipsResponsive_hidePhone'>
				
CONTENT;

if ( $row->rep_member == \IPS\Request::i()->id ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( \IPS\Request::i()->id ), 'mini' );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $row->rep_member ), 'mini' );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main'>
				<span class=''>
					
CONTENT;

if ( \IPS\Settings::i()->reputation_point_types != 'like' ):
$return .= <<<CONTENT

						
CONTENT;

if ( $row instanceof \IPS\Content\Comment or $row instanceof \IPS\Content\Review ):
$return .= <<<CONTENT

							
CONTENT;

$item = $row->item();
$return .= <<<CONTENT

							
CONTENT;

if ( $row->rep_member != \IPS\Request::i()->id ):
$return .= <<<CONTENT

								
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member_received )->link(), \IPS\Member::load( $row->rep_member )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_comment_received', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( $row->rep_member_received ):
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), \IPS\Member::load( $row->rep_member_received )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_comment_gave', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_comment_gave_no_recipient', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

if ( $row->rep_member != \IPS\Request::i()->id ):
$return .= <<<CONTENT

								
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member_received )->link(), \IPS\Member::load( $row->rep_member )->link(), $row->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_item_received', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( $row->rep_member_received ):
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), \IPS\Member::load( $row->rep_member_received )->link(), $row->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_item_gave', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), $row->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_item_gave_no_recipient', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						<strong>
							
CONTENT;

if ( $row instanceof \IPS\Content\Comment or $row instanceof \IPS\Content\Review ):
$return .= <<<CONTENT

								
CONTENT;

$item = $row->item();
$return .= <<<CONTENT

								
CONTENT;

if ( $row->rep_member_received ):
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), $row->url(), $row->indefiniteArticle(), \IPS\Member::load( $row->rep_member_received )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), $row->url(), $row->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_comment_no_recipient', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( $row->rep_member_received ):
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), $row->indefiniteArticle(), \IPS\Member::load( $row->rep_member_received )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_item', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), $row->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_item_no_recipient', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</span>
				<span class='ipsType_light ipsType_medium'>&nbsp;&nbsp;
CONTENT;

$val = ( $row->rep_date instanceof \IPS\DateTime ) ? $row->rep_date : \IPS\DateTime::ts( $row->rep_date );$return .= $val->html();
$return .= <<<CONTENT
</span>
				<br>
				
CONTENT;

if ( $row->truncated() ):
$return .= <<<CONTENT

					<div class='ipsType_medium ipsType_richText ipsContained cProfileRepLog_text' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='2 lines'>
						{$row->truncated()}
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

	function userReputationSection( $table ) {
		$return = '';
		$return .= <<<CONTENT


<section class='ipsDataList ipsDataList_large'>
	{$table}
</section>
CONTENT;

		return $return;
}

	function userReputationTable( $table, $headers, $rows, $quickSearch ) {
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

if ( $table->showAdvancedSearch AND ( (isset( $table->sortOptions ) and !empty( $table->sortOptions )) OR $table->advancedSearch ) OR !empty( $table->filters ) OR $table->pages > 1 ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
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

if ( $col == 'title' ):
$return .= <<<CONTENT
asc
CONTENT;

else:
$return .= <<<CONTENT
desc
CONTENT;

endif;
$return .= <<<CONTENT
'><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $col, 'sortdirection' => ( $col == 'title' ) ? 'asc' : 'desc', 'page' => '1' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( count( $rows ) ):
$return .= <<<CONTENT

		<ol class='ipsDataList ipsClear 
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
			<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_rows_in_table', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
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
}}