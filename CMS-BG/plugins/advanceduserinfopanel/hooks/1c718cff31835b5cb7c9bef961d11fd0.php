//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook128 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'postContainer' => 
  array (
    0 => 
    array (
      'selector' => 'article[itemtype=\'http://schema.org/Answer\'] > aside.ipsComment_author.cAuthorPane.ipsColumn.ipsColumn_medium',
      'type' => 'replace',
      'content' => '    <aside class=\'ipsComment_author cAuthorPane ipsColumn ipsColumn_medium\'>
		<h3 class=\'ipsType_sectionHead cAuthorPane_author ipsType_blendLinks ipsType_break\' itemprop="creator" itemscope itemtype="http://schema.org/Person"><strong itemprop="name">{$comment->author()->link( $comment->warningRef() )|raw}</strong></h3>
		<ul class=\'cAuthorPane_info ipsList_reset\'>
			{{if $comment->author()->rank[\'image\'] && $comment->author()->member_id}}
				<li class=\'ipsResponsive_hidePhone\'>{$comment->author()->rank[\'image\']|raw}</li>
			{{endif}}
            <li class=\'cAuthorPane_photo\'>
				{template="userPhoto" app="core" group="global" params="$comment->author(), \'large\', $comment->warningRef()"}
				{{if \IPS\Member::loggedIn()->group[\'g_bdm_canSee\'] AND $comment->author()->bdm_mood}}
                <div class="mood 
                {{if settings.bd_moods_displaypos==0}}mood-top-left
                {{elseif settings.bd_moods_displaypos==1}}mood-top-right
                {{elseif settings.bd_moods_displaypos==2}}mood-bottom-right         
                {{elseif settings.bd_moods_displaypos==3}}mood-bottom 
                {{elseif settings.bd_moods_displaypos==4}}mood-bottom-left
                {{endif}}">{expression=\'\IPS\bdmoods\Mood::load($comment->author()->bdm_mood)->get_image($comment->author()->get_moodTitle())\' raw=\'true\'}</div>{{endif}}
			</li>
			<div class=\'ContactInfoBox\'>
		    {{if \IPS\Settings::i()->User_Group_Active == 1}}
			<hr class=\'aupHr\'>
            <li class=\'aupBorder\'>
			    <span class=\'aupTitle\'><i class="fa fa-users" aria-hidden="true"></i> {lang="User_Group"}:</span>
				<span class=\'aupContent\'>{expression="\IPS\Member\Group::load( $comment->author()->member_group_id )->formattedName" raw="true"}</span>
			</li>
			<br/>
			{{endif}}
			{{if \IPS\Settings::i()->User_Rank_Active == 1}}
			<hr class=\'aupHr\'>
            {{if $comment->author()->member_title && $comment->author()->member_id}}
				<li class=\'ipsType_break aupBorder\'>
				    <span class=\'aupTitle\'><i class="fa fa-star" aria-hidden="true"></i> {lang="Member_Title"}:</span>
				    <span class=\'aupContent\'>{$comment->author()->member_title}</span>
				</li>
			<br>
			{{elseif $comment->author()->rank[\'title\'] && $comment->author()->member_id}}
			    <li class=\'ipsType_break aupBorder\'>
				    <span class=\'aupTitle\'><i class="fa fa-star" aria-hidden="true"></i> {lang="Member_Rank"}:</span>
				    <span class=\'aupContent\'>{$comment->author()->rank[\'title\']}</span>
				</li>
			<br>
			{{endif}}
			{{endif}}
			{{if \IPS\Settings::i()->User_ID_Active == 1}}
			<hr class=\'aupHr\'>
			<li class=\'aupBorder\'>
			    <span class=\'aupTitle\'><i class="fa fa-id-card-o" aria-hidden="true"></i> {lang="Member ID"}:</span>
				<span class=\'aupContent\'>{$comment->author()->member_id}</span>
			</li>
            <br/>
			{{endif}}
			{{if \IPS\Member::loggedIn()->group[\'g_bdm_canSee\'] AND \IPS\Settings::i()->User_Moods_Active == 1 AND $comment->author()->bdm_mood }}
			<hr class=\'aupHr\'>
			<li class=\'ipsType_break aupBorder\'>
                <span class=\'aupTitle\'><i class="fa fa-smile-o" aria-hidden="true"></i> {lang="User_Mood"}:</span>
                <span class=\'aupContent\'>{$comment->author()->get_moodTitle()}</span>
            </li> 
			<br/>
            {{endif}}
			{{if \IPS\Settings::i()->Post_Count_Active == 1}}
			<hr class=\'aupHr\'>
			<li class=\'aupBorder\'>
			    <span class=\'aupTitle\'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {lang="Content_Count"}:</span>
				<span class=\'aupContent\'>{lang="member_post_count" pluralize="$comment->author()->member_posts"}</span>
			</li>
			<br/>
			{{endif}}
			{{if \IPS\Settings::i()->User_Rep_Active == 1}}
			<hr class=\'aupHr\'>
			<li class=\'aupBorder\'>
			    <span class=\'aupTitle\'><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {lang="Total_Rep"}:</span>
				<span class=\'aupContent\'>{template="reputationBadge" group="global" app="core" params="$comment->author()"}</span>
			</li>
			<br/>
			{{endif}}
			{{if \IPS\Settings::i()->User_Join_Date_Active == 1}}
			<hr class=\'aupHr\'>
			<li class=\'ipsType_break aupBorder\'>
				<span class=\'aupTitle\'><i class="fa fa-calendar-o" aria-hidden="true"></i> {lang="joined"}:</span>
		        <span class=\'aupContent\'>{datetime="$comment->author()->joined" dateonly="true"}</span>
			</li>
			<br/>
			{{endif}}
			{{if \IPS\Settings::i()->Online_Status_Active == 1}}
			<hr class=\'aupHr\'>
			<li class=\'ipsType_break aupBorder\'>
				<span class=\'aupTitle\'><i class="fa fa-bell-o" aria-hidden="true"></i> {lang="Online_Status"}:</span>
		        <span class=\'aupContent\'>{{if $comment->author()->isOnline()}}<span style=\'color:green;font-weight:bold;\'>Online</span>{{else}}<span style=\'color:red;font-weight:bold;\'>Offline</span>{{endif}}</span>
			</li>
			<br/>
			{{endif}}
            {{if \IPS\Settings::i()->User_MOTD_Active == 1}}
            <hr class=\'aupHr\'>
			<li class=\'ipsType_break aupBorder\'>
				<span class=\'aupTitle\'><i class="fa fa-trophy" aria-hidden="true"></i> {lang="members_days_won_count"}:</span>
		        <span class=\'aupContent\'>{number="$comment->author()->getReputationDaysWonCount()"}</span>
			</li>
			<br/>
            {{endif}}
			<hr class=\'aupHr\'>
			{{if $comment->author()->reputationImage()}}	
			<li class=\'ipsPad_half ipsResponsive_hidePhone\'>
				<img src=\'{file="$comment->author()->reputationImage()" extension="core_Theme"}\' title=\'{{if $comment->author()->reputation()}}{$comment->author()->reputation()}{{endif}}\' alt=\'\'>
			</li>
            <br/>
			<hr class=\'aupHr\'>
			{{endif}}
			{template="customFieldsDisplay" group="global" app="core" params="$comment->author()"}
		</ul>
	</aside>',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
