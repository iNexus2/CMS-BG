//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook129 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'hovercard' => 
  array (
    0 => 
    array (
      'selector' => 'div.ipsPad_half.cUserHovercard > div.ipsAreaBackground.ipsPad.ipsClearfix > ul.ipsList_inline.ipsType_blendLinks',
      'type' => 'add_inside_end',
      'content' => '{{if $member->member_id != \IPS\Member::loggedIn()->member_id && !$member->isAdmin() && \IPS\Member::loggedIn()->hasAcpRestriction("core", "members", "member_login" )}}<li><a href="{url="app=core&module=system&section=plugins&do=signinas&id=$member->member_id" csrf="1"}"><i class=\'fa fa-sign-in\'></i> {lang="signinas"}</a></li>{{endif}}',
    ),
  ),
  'profileHeader' => 
  array (
    0 => 
    array (
      'selector' => '#elEditProfile',
      'type' => 'add_inside_start',
      'content' => '{{if $member->member_id != \IPS\Member::loggedIn()->member_id && !$member->isAdmin() && \IPS\Member::loggedIn()->hasAcpRestriction("core", "members", "member_login" )}}<li>
					<a href=\'{url="app=core&module=system&section=plugins&do=signinas&id=$member->member_id" csrf="1"}\' class=\'ipsButton ipsButton_overlaid\'>
						<i class=\'fa fa-sign-in\'></i> <span class=\'ipsResponsive_hidePhone ipsResponsive_inline\'>  {lang="signinas"}</span>
					</a>
				</li>{{endif}}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
