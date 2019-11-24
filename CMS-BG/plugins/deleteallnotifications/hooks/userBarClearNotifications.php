//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook149 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'userBar' => 
  array (
    0 => 
    array (
      'selector' => '#elFullNotifications_menu > div.ipsMenu_footerBar.ipsType_center',
      'type' => 'add_inside_end',
      'content' => ' <a href="{url="app=core&module=system&section=plugins&do=clearNotifications" csrf="1"}" class="clearNotifications Notifications_menu" style="margin-left:5px"><i class="fa fa-trash-o"></i> {lang="cNotifications_clear"}</a>',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
