//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class donate_hook_profileTemplate extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'profileHeader' => 
  array (
    0 => 
    array (
      'selector' => '#elProfileStats > ul.ipsList_inline.ipsPos_left > li',
      'type' => 'add_after',
      'content' => '{{if !isset( $donateTemplateLoaded )}}
	{{$donateTemplateLoaded = TRUE;}}
	{template="profileHook" group="global" app="donate" params="$member"}
{{endif}}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
