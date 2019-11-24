//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook150 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'notificationsTable' => 
  array (
    0 => 
    array (
      'selector' => 'div.ipsPageHeader.ipsClearfix.ipsSpacer_bottom > div.ipsPos_right',
      'type' => 'add_inside_start',
      'content' => '<a class="ipsButton ipsButton_negative ipsButton_verySmall clearNotifications Notifications_main" href="{url="app=core&module=system&section=plugins&do=clearNotifications" csrf="1"}"><i class="fa fa-trash-o"></i> {lang="cNotifications_clear"}</a>',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
