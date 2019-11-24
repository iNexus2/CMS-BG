//<?php

class hook135 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'globalTemplate' => 
  array (
    0 => 
    array (
      'selector' => '#ipsLayout_header > header > ul.ipsList_inline.ipsType_light.ipsResponsive_hidePhone',
      'type' => 'add_inside_end',
      'content' => '{template="clearCacheLink" group="plugins" location="global"}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */








}