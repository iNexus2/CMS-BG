//<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
class donate_hook_donateTopicView extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'postContainer' => 
  array (
    0 => 
    array (
      'selector' => 'article[itemtype=\'http://schema.org/Answer\'] > aside.ipsComment_author.cAuthorPane.ipsColumn.ipsColumn_medium > ul.cAuthorPane_info.ipsList_reset',
      'type' => 'add_inside_end',
      'content' => '{template="topicView" group="global" location="front" app="donate" params="$comment"}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */








}