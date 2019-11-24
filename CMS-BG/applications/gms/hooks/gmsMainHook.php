//<?php
/**
 * @package		Messages
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
class gms_hook_gmsMainHook extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'globalTemplate' => 
  array (
    0 => 
    array (
      'selector' => '#elContent',
      'type' => 'add_before',
      'content' => '{template="messageList" group="global" app="gms" params=""}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */




}