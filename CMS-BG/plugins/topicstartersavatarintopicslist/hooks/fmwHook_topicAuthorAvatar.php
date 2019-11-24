//<?php

class hook126 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'topicRow' => 
  array (
    0 => 
    array (
      'selector' => 'li.ipsDataItem.ipsDataItem_responsivePhoto[itemprop=\'itemListElement\'][itemtype=\'http://schema.org/Article\'] > div.ipsDataItem_main',
      'type' => 'add_before',
      'content' => '<div class="ipsDataItem_authorAvatar{{if !settings.topicAuthorPosts_enableCounter}} ipsDataItem_authorAvatarNoCounter{{endif}}">
	{template="userPhoto" app="core" group="global" params="$row->author(), \'tiny\'"}
	{{if settings.topicAuthorPosts_enableCounter}}
		<span class="ipsNotificationCount" title="{lang="topicAuthorAvatar_aotsp"}" data-ipsTooltip>{$row->author()->getTopicAuthorPosts($row->author()->member_id, $row->$idField)}</span>
	{{endif}}
</div>',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */




























}