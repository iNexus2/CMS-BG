//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook127 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'whosOnline' => 
  array (
    0 => 
    array (
      'selector' => 'div.ipsWidget_inner',
      'type' => 'replace',
      'content' => '<div class=\'ipsWidget_inner {{if $orientation == \'vertical\'}}ipsPad{{else}}ipsPad_half{{endif}}\'>
	{{if count( $members )}}
		<ul class=\'ipsList_inline ipsList_csv ipsList_noSpacing\'>
			{{foreach $members as $row}}
				<li>{template="userLinkFromData" group="global" app="core" params="$row[\'member_id\'], $row[\'member_name\'], $row[\'seo_name\'], $row[\'member_group\']"}</li>
			{{endforeach}}
		</ul>
		{{if $orientation == \'vertical\' and $memberCount > 60}}
			<p class=\'ipsType_medium ipsType_reset\'>
				<a href=\'{url="app=core&module=online&controller=online" seoTemplate="online"}\'>{lang="and_x_others" pluralize="$memberCount - 60"}</a>
			</p>
		{{endif}}
	{{else}}
		<p class=\'ipsType_reset ipsType_medium ipsType_light\'>{lang="whos_online_users_empty"}</p>
	{{endif}}
</div>',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
