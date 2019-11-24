//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook34 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'globalTemplate' => 
  array (
    0 => 
    array (
      'selector' => '#ipsLayout_footer',
      'type' => 'add_before',
      'content' => '<!-- SCROLL TO TOP -->
<div class="scroll-top-wrapper">
   <span class="scroll-top-inner"><i class="fa fa-2x fa-arrow-circle-up"></i></span>
</div>',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
