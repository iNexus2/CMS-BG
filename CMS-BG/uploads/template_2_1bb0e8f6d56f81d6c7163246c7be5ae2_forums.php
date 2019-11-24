<?php
namespace IPS\Theme\Cache;
class class_forums_front_forums extends \IPS\Theme\Template
{
	public $cache_key = '93826fd1df1590e282335a3fa4af4fad';
	function forumButtons( $forum ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $forum->can('add') ):
$return .= <<<CONTENT

	<li class='ipsToolList_primaryAction'>
		
CONTENT;

if ( $forum->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

			<a class="ipsButton ipsButton_medium ipsButton_important ipsButton_fullWidth" href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_a_question_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_a_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

else:
$return .= <<<CONTENT

			<a class="ipsButton ipsButton_medium ipsButton_important ipsButton_fullWidth" href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</li>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $forum->topics AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	<li>
		<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'do' => 'markRead', 'fromForum' => 1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_forum_read_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_link' data-action='markForumRead'><i class="fa fa-check"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_forum_read', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</li>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function forumDisplay( $forum, $table ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->advancedSearchForm ):
$return .= <<<CONTENT

	
CONTENT;

$followerCount = \IPS\forums\Topic::containerFollowerCount( $forum );
$return .= <<<CONTENT

	<div class="ipsPageHeader ipsClearfix">
		<header class='ipsSpacer_bottom'>
			<h1 class="ipsType_pageTitle">
CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>
			
CONTENT;

if ( $forum->sub_can_post and !$forum->password ):
$return .= <<<CONTENT

				<div class='ipsPos_right ipsResponsive_noFloat ipsResponsive_hidePhone'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'forums','forum', $forum->_id, $followerCount );
$return .= <<<CONTENT

				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $forum->description ):
$return .= <<<CONTENT

				<div class='ipsType_richText ipsType_normal'>
					{$forum->description}
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</header>
	</div>
	
CONTENT;

if ( $forum->show_rules == 1 ):
$return .= <<<CONTENT

		<hr class='ipsHr'>
		<a href="#elForumRules" class='ipsJS_show ipsType_normal' data-ipsDialog data-ipsDialog-title="
CONTENT;

$val = "forums_forum_{$forum->id}_rulestitle"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsDialog-content="#elForumRules">
CONTENT;

$val = "forums_forum_{$forum->id}_rulestitle"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		<div id='elForumRules' class='ipsAreaBackground_light ipsPad ipsJS_hide'>
			<div class='ipsType_richText ipsType_medium'>
CONTENT;

$val = "forums_forum_{$forum->id}_rules"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		</div>
	
CONTENT;

elseif ( $forum->show_rules == 2 ):
$return .= <<<CONTENT

		<hr class='ipsHr'>
		<div class='ipsfocus_rules'>
			<strong class='ipsType_normal'>
CONTENT;

$val = "forums_forum_{$forum->id}_rulestitle"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
			<div class='ipsType_richText ipsType_normal ipsSpacer_top'>
CONTENT;

$val = "forums_forum_{$forum->id}_rules"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
	
CONTENT;

if ( $forum->children() ):
$return .= <<<CONTENT

		<div class='ipsList_reset cForumList ipsBox ipsSpacer_bottom ipsfocus_reset' data-controller='forums.front.forum.forumList' data-baseURL=''>
			
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT

			<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

if ( $forum->sub_can_post ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'subforums_header', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'subforums_header_category', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h2>
			
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Theme::i()->settings['forum_layout'] === 'grid' ):
$return .= <<<CONTENT

				<div class='ipsAreaBackground_reset ipsPad' data-role="forums">
					<div class='ipsGrid ipsGrid_collapsePhone' data-ipsGrid data-ipsGrid-minItemSize='300' data-ipsGrid-maxItemSize='400' data-ipsGrid-equalHeights='row'>
						
CONTENT;

foreach ( $forum->children( 'view' ) as $childforum ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumGridItem( $childforum );
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<ol class="ipsDataList ipsDataList_zebra ipsDataList_large ipsAreaBackground_reset">
					
CONTENT;

foreach ( $forum->children( 'view' ) as $childforum ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumRow( $childforum, TRUE );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT
			
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<div data-controller='forums.front.forum.forumPage'>
	<ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsSpacer_both ipsResponsive_hidePhone">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->forumButtons( $forum );
$return .= <<<CONTENT

	</ul>
	{$table}
	<ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsSpacer_both ipsResponsive_showPhone ipsResponsive_block">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->forumButtons( $forum );
$return .= <<<CONTENT

	</ul>
</div>

CONTENT;

if ( !\IPS\Request::i()->advancedSearchForm && $forum->sub_can_post and !$forum->password ):
$return .= <<<CONTENT

	<div class='ipsResponsive_showPhone ipsResponsive_block ipsSpacer ipsSpacer_both'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'forums','forum', $forum->_id, $followerCount );
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function forumHome( $forum, $featuredTopic, $popularQuestions, $newQuestions ) {
		$return = '';
		$return .= <<<CONTENT

<br>

CONTENT;

if ( $featuredTopic ):
$return .= <<<CONTENT

	<div class="ipsPad">
		<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<br><br>
		<div class="ipsPhotoPanel ipsPhotoPanel_small ipsClearfix">
			<img src='
CONTENT;

$return .= htmlspecialchars( $featuredTopic->author()->photo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsUserPhoto ipsUserPhoto_small ipsPos_left">
			<div>
				<h3 class="ipsType_reset ipsType_large">
					<a href="
CONTENT;
$return .= htmlspecialchars( $featuredTopic->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $featuredTopic->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				</h3>
				<p class="ipsType_reset ipsType_normal ipsType_light">
CONTENT;

$htmlsprintf = array($featuredTopic->author()->link(), \IPS\DateTime::ts( $featuredTopic->start_date )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
				<br>
				<div class="ipsType_normal" data-ipsTruncate data-ipsTruncate-type="remove" data-ipsTruncate-size="5 lines">
					
CONTENT;
$return .= htmlspecialchars( $featuredTopic->truncated(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</div>
			</div>
		</div>
	</div>
	<hr class="ipsHr">

CONTENT;

endif;
$return .= <<<CONTENT

<div class="ipsGrid ipsGrid_collapsePhone">
	<div class="ipsGrid_span6 ipsPad">
		<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'most_popular_questions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<p class="ipsType_reset ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'from_the_past_30_days', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<ol class="ipsDataList ipsDataList_reducedSpacing" id="elTopicList" itemscope="" itemtype="http://schema.org/ItemList">
			<meta itemprop="itemListOrder" content="Descending">
			
CONTENT;

foreach ( $popularQuestions as $question ):
$return .= <<<CONTENT

				<li class="ipsDataItem 
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
" itemprop="itemListElement">
					<div class='ipsDataItem_generic ipsDataItem_size1'>
						<img src="
CONTENT;
$return .= htmlspecialchars( $question->author()->photo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsUserPhoto ipsUserPhoto_mini'>
					</div>
					<div class="ipsDataItem_main">
						<h4 class="ipsDataItem_title">
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT
 <i class="fa fa-circle cTopicIcon"></i> 
CONTENT;

endif;
$return .= <<<CONTENT
<a href="
CONTENT;
$return .= htmlspecialchars( $question->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $question->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h4>
						<ul class="ipsDataItem_meta ipsList_inline ipsType_light">
							
CONTENT;

if ( $question->bestAnswer() ):
$return .= <<<CONTENT

								<li>
									
CONTENT;

$htmlsprintf = array($question->bestAnswer()->author()->link(), \IPS\DateTime::ts( $question->bestAnswer()->post_date )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'best_answer_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
	</div>
	<div class="ipsGrid_span6 ipsPad">
		<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_questions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<p class="ipsType_reset ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'awaiting_an_answer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<ol class="ipsDataList ipsDataList_reducedSpacing" id="elTopicList" itemscope="" itemtype="http://schema.org/ItemList">
			<meta itemprop="itemListOrder" content="Descending">
			
CONTENT;

foreach ( $newQuestions as $question ):
$return .= <<<CONTENT

				<li class="ipsDataItem 
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
" itemprop="itemListElement">
					<div class='ipsDataItem_generic ipsDataItem_size1'>
						<img src="
CONTENT;
$return .= htmlspecialchars( $question->author()->photo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsUserPhoto ipsUserPhoto_mini'>
					</div>
					<div class="ipsDataItem_main">
						<h4 class="ipsDataItem_title">
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT
 <i class="fa fa-circle cTopicIcon"></i> 
CONTENT;

endif;
$return .= <<<CONTENT
<a href="
CONTENT;
$return .= htmlspecialchars( $question->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $question->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h4>
						<ul class="ipsDataItem_meta ipsList_inline ipsType_light">
							<li>
								
CONTENT;

$htmlsprintf = array($question->author()->link(), \IPS\DateTime::ts( $question->start_date )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

							</li>
						</ul>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
	</div>
</div>
CONTENT;

		return $return;
}

	function forumPasswordPopup( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT


<form accept-charset='utf-8' class="ipsForm ipsForm_vertical" method='post' action='
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsValidation novalidate>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT


	<div class='ipsPad'>
		<p class='ipsType_normal ipsType_reset'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enter_forum_password_1', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>

		<br>
		<ul class='ipsList_reset'>
			
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

					
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Text ):
$return .= <<<CONTENT

						<li class="ipsFieldRow ipsFieldRow_primary ipsFieldRow_noLabel ipsFieldRow_fullWidth 
CONTENT;

if ( $input->error ):
$return .= <<<CONTENT
ipsFieldRow_error
CONTENT;

endif;
$return .= <<<CONTENT
">
							<input type="
CONTENT;
$return .= htmlspecialchars( $input->formType, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" required placeholder="
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name='
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
							
CONTENT;

if ( $input->error ):
$return .= <<<CONTENT

								<br>
								<span class="ipsType_warning">
CONTENT;

$val = "{$input->error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>
	<div class='ipsPad ipsAreaBackground ipsType_right'>
		<button type="submit" class="ipsButton ipsButton_primary ipsButton_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enter_forum', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
	</div>
</form>
CONTENT;

		return $return;
}

	function forumSelector( $form ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsPad'>
	{$form}
</div>
CONTENT;

		return $return;
}

	function forumTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox ipsfocus_reset' data-baseurl='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-resort='
CONTENT;
$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-tableID='topics' data-controller='core.global.core.table
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT
,core.front.core.moderation
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT

	
CONTENT;

if ( $table->title ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle 
CONTENT;

if ( !$table->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT
ipsType_medium
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_reset ipsClear'>
CONTENT;
$return .= htmlspecialchars( $table->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT

	
CONTENT;

if ( $table->count > 0 ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<ul class="ipsButtonRow ipsPos_right ipsClearfix">
				<li>
					<a class="ipsJS_show" href="#elCheck_menu" id="elCheck_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$val = "{$table->langPrefix}select_rows_tooltip"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsAutoCheck data-ipsAutoCheck-context="#elTable_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active">
						<span class="cAutoCheckIcon ipsType_medium"><i class="fa fa-square-o"></i></span> <i class="fa fa-caret-down"></i>
						<span class='ipsNotificationCount' data-role='autoCheckCount'>0</span>
					</a>
					<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide" id="elCheck_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
						<li class="ipsMenu_title">
CONTENT;

$val = "{$table->langPrefix}select_rows"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
						<li class="ipsMenu_item" data-ipsMenuValue="all"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						<li class="ipsMenu_item" data-ipsMenuValue="none"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'none', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

if ( count($table->getFilters()) ):
$return .= <<<CONTENT

							<li class="ipsMenu_sep"><hr></li>
							
CONTENT;

foreach ( $table->getFilters() as $filter ):
$return .= <<<CONTENT

								<li class="ipsMenu_item" data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $filter, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><a href="#">
CONTENT;

$val = "{$filter}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</li>
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT


		<ul class="ipsButtonRow ipsPos_right ipsClearfix">
			
CONTENT;

if ( isset( $table->sortOptions ) and !empty( $table->sortOptions )  ):
$return .= <<<CONTENT

				<li>
					<a href="#elSortByMenu_menu" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role='sortButton' data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
						
CONTENT;

$custom = TRUE;
$return .= <<<CONTENT

						
CONTENT;

foreach ( $table->sortOptions as $k => $col ):
$return .= <<<CONTENT

							<li class="ipsMenu_item 
CONTENT;

if ( $col === $table->sortBy ):
$return .= <<<CONTENT

CONTENT;

$custom = FALSE;
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $col, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-sortDirection='
CONTENT;

if ( $col == 'title' ):
$return .= <<<CONTENT
asc
CONTENT;

else:
$return .= <<<CONTENT
desc
CONTENT;

endif;
$return .= <<<CONTENT
'><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $col, 'sortdirection' => ( $col == 'title' ) ? 'asc' : 'desc', 'page' => '1' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$val = "{$table->langPrefix}sort_{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->advancedSearch ):
$return .= <<<CONTENT

							<li class="ipsMenu_item 
CONTENT;

if ( $custom ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-noSelect="true">
								<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'advancedSearchForm' => '1', 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_sort', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !empty( $table->filters ) ):
$return .= <<<CONTENT

				<li>
					<a href="#elFilterByMenu_menu" id="elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role='tableFilterMenu' data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'filter_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' data-role="tableFilterMenu" id='elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
						<li data-action="tableFilter" data-ipsMenuValue='' class='ipsMenu_item 
CONTENT;

if ( !$table->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => '', 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection, 'page' => '1' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$table->langPrefix}all"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

foreach ( $table->filters as $k => $q ):
$return .= <<<CONTENT

							<li data-action="tableFilter" data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsMenu_item 
CONTENT;

if ( $k === $table->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection, 'page' => '1' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$table->langPrefix}{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>

		
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

		<form action="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-role='moderationTools' data-ipsPageAction>
	
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

			<ol class='ipsDataList ipsDataList_zebra ipsClear cForumTopicTable 
CONTENT;

if ( $table->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT
cForumQuestions
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

foreach ( $table->classes as $class ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

endforeach;
$return .= <<<CONTENT
' id='elTable_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="tableRows" itemscope itemtype="http://schema.org/ItemList">
				
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

			</ol>
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsType_center ipsPad'>
				<p class='ipsType_large'>
CONTENT;

if ( $table->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_questions_in_forum', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_topics_in_forum', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</p>

				
CONTENT;

if ( $table->container()->can('add') ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $table->container()->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_medium'>
						
CONTENT;

if ( $table->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_first_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_first_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class="ipsAreaBackground ipsPad ipsClearfix" data-role="pageActionOptions">
				<div class="ipsPos_right">
					<select name="modaction" data-role="moderationAction">
						
CONTENT;

if ( $table->canModerate('unhide') ):
$return .= <<<CONTENT

							<option value='approve' data-icon='check-circle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('feature') or $table->canModerate('unfeature') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='star' data-action='feature'>
								
CONTENT;

if ( $table->canModerate('feature') ):
$return .= <<<CONTENT

									<option value='feature'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unhide') ):
$return .= <<<CONTENT

									<option value='unfeature'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfeature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('pin') or $table->canModerate('unpin') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='thumb-tack' data-action='pin'>
								
CONTENT;

if ( $table->canModerate('pin') ):
$return .= <<<CONTENT

									<option value='pin'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unpin') ):
$return .= <<<CONTENT

									<option value='unpin'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unpin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('hide') or $table->canModerate('unhide') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='eye' data-action='hide'>
								
CONTENT;

if ( $table->canModerate('hide') ):
$return .= <<<CONTENT

									<option value='hide'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unhide') ):
$return .= <<<CONTENT

									<option value='unhide'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('lock') or $table->canModerate('unlock') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='lock' data-action='lock'>
								
CONTENT;

if ( $table->canModerate('lock') ):
$return .= <<<CONTENT

									<option value='lock'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unlock') ):
$return .= <<<CONTENT

									<option value='unlock'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('move') ):
$return .= <<<CONTENT

							<option value='move' data-icon='arrow-right'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('split_merge') ):
$return .= <<<CONTENT

							<option value='merge' data-icon='level-up'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('delete') ):
$return .= <<<CONTENT

							<option value='delete' data-icon='trash'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->savedActions ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'saved_actions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='tasks' data-action='saved_actions'>
								
CONTENT;

foreach ( $table->savedActions as $k => $v ):
$return .= <<<CONTENT

									<option value='savedAction-
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</select>
					<button type="submit" class="ipsButton ipsButton_alternate ipsButton_verySmall">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				</div>
			</div>
		</form>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
	
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT

	
</div>
CONTENT;

		return $return;
}

	function popularQuestionRow( $question, $forum ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$iposted = $forum->contentPostedIn( null, array( $question->tid ) );
$return .= <<<CONTENT


CONTENT;

if ( !$question->mapped('moved_to') ):
$return .= <<<CONTENT

	<li class="ipsDataItem cForumQuestion 
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $question->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
">
		<div class='ipsDataItem_icon'>
			
CONTENT;

if ( $question->topic_answered_pid ):
$return .= <<<CONTENT

				<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answered', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator' data-ipsTooltip>
					<i class='fa fa-check'></i>
				</span>
			
CONTENT;

else:
$return .= <<<CONTENT

				<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'awaiting_answer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator cBestAnswerIndicator_off' data-ipsTooltip>
					<i class='fa fa-question'></i>
				</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<h4 class='ipsDataItem_title ipsType_break'>
				<div class='ipsType_break ipsContained'>
					
CONTENT;

if ( $question->locked() ):
$return .= <<<CONTENT

						<i class='fa fa-lock' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locked', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></i>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $question->url( 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
							<span class='ipsItemStatus'><i class="fa 
CONTENT;

if ( in_array( $question->tid, $iposted ) ):
$return .= <<<CONTENT
fa-star
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
"></i></span>
						</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

if ( in_array( $question->tid, $iposted ) ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $question->mapped('pinned') || $question->mapped('featured') || $question->hidden() === -1 || $question->hidden() === 1 ):
$return .= <<<CONTENT

					<span>
						
CONTENT;

if ( $question->hidden() === -1 ):
$return .= <<<CONTENT

							<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $question->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
						
CONTENT;

elseif ( $question->hidden() === 1 ):
$return .= <<<CONTENT

							<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $question->mapped('pinned') ):
$return .= <<<CONTENT

							<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $question->mapped('featured') ):
$return .= <<<CONTENT

							<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $question->prefix() ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $question->prefix( TRUE ), $question->prefix() );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $question->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						
CONTENT;

if ( $question->mapped('title') ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $question->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
<em class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em>
CONTENT;

endif;
$return .= <<<CONTENT

					</a>
				</div>
			</h4>
			<div class='ipsDataItem_meta'>
				<p class='ipsType_reset ipsType_normal ipsType_light'>
					
CONTENT;

$htmlsprintf = array($question->author()->link(), \IPS\DateTime::ts( $question->start_date )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_byline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

				</p>
			</div>
			
CONTENT;

if ( count( $question->tags() ) ):
$return .= <<<CONTENT

				<p>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $question->tags() );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center cForumQuestion_stat'>
			<span>
CONTENT;

if ( $question->question_rating ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $question->question_rating, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
</span>
			<span class='ipsType_light'>
CONTENT;

$pluralize = array( $question->question_rating ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'votes_no_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
		</div>
		<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center cForumQuestion_stat'>
			
CONTENT;

foreach ( $question->stats(FALSE) AS $k => $v ):
$return .= <<<CONTENT

				
CONTENT;

if ( $k == 'forums_comments' OR $k == 'answers_no_number' ):
$return .= <<<CONTENT

					<span itemprop="answerCount">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $v );
$return .= <<<CONTENT
</span>
					<span class='ipsType_light'>
CONTENT;

$pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answers_no_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</div>
	</li>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function qaForum( $table, $popularQuestions, $newQuestions, $featuredTopic, $forum ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $popularQuestions && $newQuestions ):
$return .= <<<CONTENT

	<div class='ipsBox ipsSpacer_bottom ipsSpacer_double'>
		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'explore_questions_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class="ipsTabs ipsClearfix" id="elQuestionsTabs" data-ipsTabBar data-ipsTabBar-contentarea="#elQuestionsTabsContent">
			<a href="#elQuestionsTabs" data-action="expandTabs"><i class="fa fa-caret-down"></i></a>
			<ul role="tablist" class="ipsList_reset">
				<li>
					<a href="#elPopularQuestions" role="tab" id="elPopularQuestions" class="ipsTabs_item 
CONTENT;

if ( count( $popularQuestions ) || !count( $popularQuestions ) && !count( $newQuestions ) ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( count( $popularQuestions ) || !count( $popularQuestions ) && !count( $newQuestions ) ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'popular_questions_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>				
				<li>
					<a href="#elNewQuestions" id="elNewQuestions" role="tab" class="ipsTabs_item 
CONTENT;

if ( !count( $popularQuestions ) && count( $newQuestions ) ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( !count( $popularQuestions ) && count( $newQuestions ) ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
">
						
CONTENT;

if ( \IPS\Settings::i()->forums_new_questions ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_questions_title_no_answer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_questions_title_no_best', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

					</a>
				</li>
			</ul>
		</div>
		<section id='elQuestionsTabsContent'>
			<div id="ipsTabs_elQuestionsTabs_elPopularQuestions_panel" class="ipsTabs_panel" aria-labelledby="elPopularQuestions">
				
CONTENT;

if ( count( $popularQuestions ) ):
$return .= <<<CONTENT

					<ol class='ipsDataList ipsDataList_zebra ipsClear cForumTopicTable cForumQuestions cTopicList' id='elTable_popularQuestions' data-role="tableRows">
						
CONTENT;

foreach ( $popularQuestions as $question ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->popularQuestionRow( $question, $forum );
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ol>
				
CONTENT;

else:
$return .= <<<CONTENT

					<div class='ipsType_center ipsType_light'>
						<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_popular_questions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div id="ipsTabs_elQuestionsTabs_elNewQuestions_panel" class="ipsTabs_panel" aria-labelledby="elNewQuestions">
				
CONTENT;

if ( count( $newQuestions ) ):
$return .= <<<CONTENT

					<ol class='ipsDataList ipsDataList_zebra ipsClear cForumTopicTable cForumQuestions cTopicList' id='elTable_newQuestions' data-role="tableRows">
						
CONTENT;

foreach ( $newQuestions as $question ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->popularQuestionRow( $question, $forum );
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ol>
				
CONTENT;

else:
$return .= <<<CONTENT

					<div class='ipsType_center ipsType_light'>
						<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_questions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</section>
	</div>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

if ( $popularQuestions ):
$return .= <<<CONTENT

		<section class='ipsBox ipsSpacer_bottom ipsSpacer_double'>
			<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'popular_questions_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
			
CONTENT;

if ( count( $popularQuestions ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_readStatus ipsClear cForumTopicTable' id='elTable_' data-role="tableRows">
					
CONTENT;

foreach ( $popularQuestions as $question ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->popularQuestionRow( $question, $forum );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsType_center ipsType_light'>
					<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_popular_questions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</section>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $newQuestions ):
$return .= <<<CONTENT

		<section class='ipsBox ipsSpacer_bottom ipsSpacer_double'>
			<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

if ( \IPS\Settings::i()->forums_new_questions ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_questions_title_no_answer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_questions_title_no_best', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h2>
			
CONTENT;

if ( count( $newQuestions ) ):
$return .= <<<CONTENT

			<ol class='ipsDataList ipsDataList_readStatus ipsClear cForumTopicTable' id='elTable_' data-role="tableRows">
				
CONTENT;

foreach ( $newQuestions as $question ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->popularQuestionRow( $question, $forum );
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsType_center ipsType_light'>
				<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_questions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</section>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

{$table}
CONTENT;

		return $return;
}

	function questionRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$rowIds = array();
$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$idField = $row::$databaseColumnId;
$return .= <<<CONTENT

	
CONTENT;

$rowIds[] = $row->$idField;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

$iposted = ( method_exists( $table, 'container' ) AND $table->container() !== NULL ) ? $table->container()->contentPostedIn( null, $rowIds ) : array();
$return .= <<<CONTENT


CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$idField = $row::$databaseColumnId;
$return .= <<<CONTENT

		
CONTENT;

if ( $row->mapped('moved_to') ):
$return .= <<<CONTENT

			
CONTENT;

if ( $movedTo = $row->movedTo() ):
$return .= <<<CONTENT

				<li class="ipsDataItem">
					<div class='ipsDataItem_icon ipsType_center ipsType_noBreak'>
						<i class="fa fa-arrow-left ipsType_large"></i>
					</div>
					<div class='ipsDataItem_main'>
						<h4 class='ipsDataItem_title ipsType_break'>
							<div class='ipsType_break ipsContained'>
								<em><a href='
CONTENT;
$return .= htmlspecialchars( $movedTo->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_new_location', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></em>
							</div>
						</h4>
						<div class='ipsDataItem_meta'>
							
CONTENT;

if ( isset( $row::$databaseColumnMap['status'] ) ):
$return .= <<<CONTENT

								
CONTENT;

$statusField = $row::$databaseColumnMap['status'];
$return .= <<<CONTENT

								
CONTENT;

if ( $row->$statusField == 'merged' ):
$return .= <<<CONTENT

									<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->url(), $movedTo->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'question_merged_to', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
								
CONTENT;

else:
$return .= <<<CONTENT

									<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->container()->url(), $movedTo->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'question_moved_to', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->container()->url(), $movedTo->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'question_moved_to', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</div>
					
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

						<div class='ipsDataItem_modCheck'>
							<span class='ipsCustomInput'>
								<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT
pinned
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT
featured
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<span></span>
							</span>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			<li class="ipsDataItem 
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( method_exists( $row, 'tableClass' ) && $row->tableClass() ):
$return .= <<<CONTENT
ipsDataItem_
CONTENT;
$return .= htmlspecialchars( $row->tableClass(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
 cForumQuestion" data-rowID='
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' itemscope itemtype="http://schema.org/Question">
				<div class='ipsDataItem_icon'>
					
CONTENT;

if ( $row->topic_answered_pid ):
$return .= <<<CONTENT

						<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answered', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator' data-ipsTooltip>
							<i class='fa fa-check'></i>
						</span>
					
CONTENT;

else:
$return .= <<<CONTENT

						<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'awaiting_answer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator cBestAnswerIndicator_off' data-ipsTooltip>
							<i class='fa fa-question'></i>
						</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<div class='ipsDataItem_main'>
					<h4 class='ipsDataItem_title ipsContained_container'>
						<div class='ipsType_break ipsContained'>
							
CONTENT;

if ( $row->locked() ):
$return .= <<<CONTENT

								<span><i class='fa fa-lock' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locked', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></i></span>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT

								<span>
									<a href='
CONTENT;
$return .= htmlspecialchars( $row->url( 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
										<span class='ipsItemStatus'><i class="fa 
CONTENT;

if ( in_array( $row->$idField, $iposted ) ):
$return .= <<<CONTENT
fa-star
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
"></i></span>
									</a>
								</span>
							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( in_array( $row->$idField, $iposted ) ):
$return .= <<<CONTENT

									<span><span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span></span>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT


							
CONTENT;

if ( $row->mapped('pinned') || $row->mapped('featured') || $row->hidden() === -1 || $row->hidden() === 1 ):
$return .= <<<CONTENT

							<span>
								
CONTENT;

if ( $row->hidden() === -1 ):
$return .= <<<CONTENT

									<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $row->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
								
CONTENT;

elseif ( $row->hidden() === 1 ):
$return .= <<<CONTENT

									<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT

									<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT

									<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></span>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</span>
							
CONTENT;

endif;
$return .= <<<CONTENT


							
CONTENT;

if ( $row->prefix() ):
$return .= <<<CONTENT

								<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $row->prefix( TRUE ), $row->prefix() );
$return .= <<<CONTENT
</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
							<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

if ( $row->mapped('title') ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->canEdit() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'click_hold_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $row->tableHoverUrl and $row->canView() ):
$return .= <<<CONTENT
data-ipsHover data-ipsHover-target='
CONTENT;
$return .= htmlspecialchars( $row->url()->setQueryString('preview', 1), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsHover-timeout='1.5'
CONTENT;

endif;
$return .= <<<CONTENT
 itemprop="url" 
CONTENT;

if ( $row->canEdit() ):
$return .= <<<CONTENT
 data-role="editableTitle"
CONTENT;

endif;
$return .= <<<CONTENT
>
								<span itemprop="name">
									
CONTENT;

if ( $row->mapped('title') ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
<em class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em>
CONTENT;

endif;
$return .= <<<CONTENT

								</span>
							</a>
						</div>
					</h4>
					<div class='ipsDataItem_meta'>
						<p class='ipsDataItem_meta ipsType_reset ipsType_light ipsType_blendLinks'>
							<span itemprop="author" itemscope itemtype="http://schema.org/Person">
								
CONTENT;

$htmlsprintf = array($row->author()->link(), \IPS\DateTime::ts( $row->start_date )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_byline_itemprop', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

							</span>
							<meta itemprop="dateCreated" content="
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::ts( $row->start_date )->rfc3339(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
							
CONTENT;

if ( \IPS\Request::i()->controller != 'forums' ):
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href="
CONTENT;
$return .= htmlspecialchars( $row->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $row->container()->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</p>
						
CONTENT;

if ( count( $row->tags() ) ):
$return .= <<<CONTENT

							<div>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $row->tags() );
$return .= <<<CONTENT
</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				</div>
				<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center cForumQuestion_stat'>
					<span itemprop="upvoteCount">
CONTENT;

if ( $row->question_rating ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->question_rating, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
</span>
					<span class='ipsType_light'>
CONTENT;

$pluralize = array( $row->question_rating ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'votes_no_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
				</div>
				<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center cForumQuestion_stat'>
					
CONTENT;

foreach ( $row->stats(FALSE) AS $k => $v ):
$return .= <<<CONTENT

						
CONTENT;

if ( $k == 'forums_comments' OR $k == 'answers_no_number' ):
$return .= <<<CONTENT

							<span itemprop="answerCount">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $v );
$return .= <<<CONTENT
</span>
							<span class='ipsType_light'>
								
CONTENT;

$pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answers_no_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

								
CONTENT;

if ( \IPS\forums\Topic::modPermission( 'unhide', NULL, $row->container() ) AND $unapprovedComments = $row->mapped('unapproved_comments') ):
$return .= <<<CONTENT

									&nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->setQueryString( 'queued_posts', 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_warning ipsType_small ipsResponsive_noFloat' data-ipsTooltip title='
CONTENT;

$pluralize = array( $row->topic_queuedposts ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_posts_badge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i> <strong>
CONTENT;
$return .= htmlspecialchars( $unapprovedComments, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</div>
				
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

					<div class='ipsDataItem_modCheck'>
						<span class='ipsCustomInput'>
							<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $row->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->tableStates(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
							<span></span>
						</span>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function topicHover( $topic, $overviews ) {
		$return = '';
		$return .= <<<CONTENT


<div class='cTopicHovercard' data-controller='forums.front.forum.hovercard' data-topicID='
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	
CONTENT;

if ( count( $overviews ) > 1 ):
$return .= <<<CONTENT

		<div class="ipsTabs ipsTabs_small ipsTabs_container ipsClearfix" id="elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsTabBar data-ipsTabBar-contentarea="#elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_content">
			<a href="#elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="expandTabs"><i class="fa fa-caret-down"></i></a>
			<ul role="tablist">
				
CONTENT;

foreach ( $overviews as $tabID => $tabData ):
$return .= <<<CONTENT

					<li>
						<a href="#ipsTabs_elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $tabID, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel" id="elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $tabID, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsTabs_item ipsType_center" role="tab" aria-selected="
CONTENT;

if ( $tabID == 'firstPost' ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$val = "{$tabData[0]}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
		<div id='elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_content' class='ipsTabs_panels ipsTabs_contained cTopicHovercard_container ipsScrollbar'>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsPad cTopicHovercard_container ipsScrollbar'>
	
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

foreach ( $overviews as $tabID => $tabData ):
$return .= <<<CONTENT

			
CONTENT;

if ( count( $overviews ) > 1 ):
$return .= <<<CONTENT

				<div id='ipsTabs_elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $tabID, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class='ipsTabs_panel'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='ipsPhotoPanel ipsPhotoPanel_tiny ipsClearfix'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $tabData[1]->author(), 'tiny' );
$return .= <<<CONTENT

					<div class='ipsType_small'>
						<strong>
CONTENT;
$return .= htmlspecialchars( $tabData[1]->author()->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
						<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
							
CONTENT;

$val = ( $tabData[1]->mapped('date') instanceof \IPS\DateTime ) ? $tabData[1]->mapped('date') : \IPS\DateTime::ts( $tabData[1]->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

							
CONTENT;

if ( $tabData[1]->item()->unread()  ):
$return .= <<<CONTENT

								&middot; <a href='
CONTENT;
$return .= htmlspecialchars( $tabData[1]->item()->url('markRead')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_topic_read', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action='markTopicRead'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_topic_read', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $tabData[1] instanceof \IPS\Content\ReportCenter and !\IPS\Member::loggedIn()->group['gbw_no_report']  ):
$return .= <<<CONTENT

								&middot; <a href='
CONTENT;
$return .= htmlspecialchars( $tabData[1]->url('report'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-remoteSubmit data-ipsDialog-size='medium' data-ipsDialog-flashMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_submit_success', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-action='reportComment' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><span class='ipsResponsive_showPhone ipsResponsive_inline'><i class='fa fa-flag'></i></span><span class='ipsResponsive_hidePhone ipsResponsive_inline'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</p>
					</div>
				</div>
				<hr class='ipsHr'>

				<div class='ipsType_richText ipsType_small' data-controller='core.front.core.lightboxedImages'>
					{$tabData[1]->content()}
				</div>
			
CONTENT;

if ( count( $overviews ) > 1 ):
$return .= <<<CONTENT

				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function topicRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$rowIds = array();
$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$idField = $row::$databaseColumnId;
$return .= <<<CONTENT

	
CONTENT;

$rowIds[] = $row->$idField;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

$iposted = ( method_exists( $table, 'container' ) AND $table->container() !== NULL ) ? $table->container()->contentPostedIn( null, $rowIds ) : array();
$return .= <<<CONTENT


CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

$rowCount=0;
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		
CONTENT;

if ( $rowCount == 1 AND $advertisement = \IPS\core\Advertisement::loadByLocation( 'ad_forum_listing' ) ):
$return .= <<<CONTENT

			<li class="ipsDataItem">
				{$advertisement}
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$rowCount++;
$return .= <<<CONTENT

		
CONTENT;

$idField = $row::$databaseColumnId;
$return .= <<<CONTENT

		
CONTENT;

if ( $row->mapped('moved_to') ):
$return .= <<<CONTENT

			
CONTENT;

if ( $movedTo = $row->movedTo() AND $movedTo->container()->can('view') ):
$return .= <<<CONTENT

				<li class="ipsDataItem">
					<div class='ipsDataItem_icon ipsType_center ipsType_noBreak'>
						<i class="fa fa-arrow-left ipsType_large"></i>
					</div>
					<div class='ipsDataItem_main'>
						<h4 class='ipsDataItem_title ipsContained_container'>
							<div class='ipsType_break ipsContained'>
								<em><a href='
CONTENT;
$return .= htmlspecialchars( $movedTo->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_new_location', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></em>
							</div>
						</h4>
						<div class='ipsDataItem_meta'>
							
CONTENT;

if ( isset( $row::$databaseColumnMap['status'] ) ):
$return .= <<<CONTENT

								
CONTENT;

$statusField = $row::$databaseColumnMap['status'];
$return .= <<<CONTENT

								
CONTENT;

if ( $row->$statusField == 'merged' ):
$return .= <<<CONTENT

									<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->url(), $movedTo->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_merged_to', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
								
CONTENT;

else:
$return .= <<<CONTENT

									<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->container()->url(), $movedTo->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_moved_to', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->container()->url(), $movedTo->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_moved_to', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</div>
					
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

						<div class='ipsDataItem_modCheck'>
							<span class='ipsCustomInput'>
								<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT
unfeature
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT
unpin
CONTENT;

endif;
$return .= <<<CONTENT
 delete" data-state='
CONTENT;

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT
pinned
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT
featured
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<span></span>
							</span>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			<li class="ipsDataItem ipsDataItem_responsivePhoto 
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( method_exists( $row, 'tableClass' ) && $row->tableClass() ):
$return .= <<<CONTENT
ipsDataItem_
CONTENT;
$return .= htmlspecialchars( $row->tableClass(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
" data-rowID='
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' itemprop="itemListElement" itemscope itemtype="http://schema.org/Article">
				
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					<div class='ipsDataItem_icon ipsPos_top'>
						
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $row->url( 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
								<span class='ipsItemStatus'><i class="fa 
CONTENT;

if ( in_array( $row->$idField, $iposted ) ):
$return .= <<<CONTENT
fa-star
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
"></i></span>
							</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

if ( in_array( $row->$idField, $iposted ) ):
$return .= <<<CONTENT

								<span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span>
							
CONTENT;

else:
$return .= <<<CONTENT

								&nbsp;
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='ipsDataItem_main'>
					<h4 class='ipsDataItem_title ipsContained_container'>
						
CONTENT;

if ( $row->locked() ):
$return .= <<<CONTENT

							<span>
								<i class='ipsType_medium fa fa-lock' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locked', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></i>
							</span>	
							
CONTENT;

if ( $row->topic_open_time && $row->topic_open_time > time() ):
$return .= <<<CONTENT

								<span><strong class='ipsType_small ipsType_noBreak' data-ipsTooltip title='
CONTENT;

$sprintf = array(\IPS\DateTime::ts( $row->topic_open_time )->relative(), \IPS\DateTime::ts( $row->topic_open_time )->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_unlocks_at', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array(\IPS\DateTime::ts($row->topic_open_time)->relative(1)); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_unlocks_at_short', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong>&nbsp;&nbsp;</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

elseif ( !$row->locked() && $row->topic_close_time && $row->topic_close_time > time() ):
$return .= <<<CONTENT

							<span><strong class='ipsType_small ipsType_noBreak' data-ipsTooltip title='
CONTENT;

$sprintf = array(\IPS\DateTime::ts( $row->topic_close_time )->relative(), \IPS\DateTime::ts( $row->topic_close_time )->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locks_at', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'><i class='fa fa-clock-o'></i> 
CONTENT;

$sprintf = array(\IPS\DateTime::ts($row->topic_close_time)->relative(1)); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locks_at_short', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong>&nbsp;&nbsp;</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
						
CONTENT;

if ( $row->mapped('pinned') || $row->mapped('featured') || $row->hidden() === -1 || $row->hidden() === 1 ):
$return .= <<<CONTENT

							
CONTENT;

if ( $row->hidden() === -1 ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $row->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
							
CONTENT;

elseif ( $row->hidden() === 1 ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span></span>
							
CONTENT;

endif;
$return .= <<<CONTENT
							
							
CONTENT;

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span></span>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></span></span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

										
						
CONTENT;

if ( $row->prefix() ):
$return .= <<<CONTENT

							<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $row->prefix( TRUE ), $row->prefix() );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT
						
						
						<div class='ipsType_break ipsContained'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='' title='
CONTENT;

if ( $row->mapped('title') ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->canEdit() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'click_hold_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' itemprop="url"
CONTENT;

if ( $row->tableHoverUrl and $row->canView() ):
$return .= <<<CONTENT
 data-ipsHover data-ipsHover-target='
CONTENT;
$return .= htmlspecialchars( $row->url()->setQueryString('preview', 1), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsHover-timeout='1.5'
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $row->canEdit() ):
$return .= <<<CONTENT
 data-role="editableTitle"
CONTENT;

endif;
$return .= <<<CONTENT
>
								<span itemprop="name headline">
									
CONTENT;

if ( $row->mapped('title') or $row->mapped('title') == 0 ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
<em class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em>
CONTENT;

endif;
$return .= <<<CONTENT

								</span>
							</a>

							
CONTENT;

if ( $row->commentPageCount() > 1 ):
$return .= <<<CONTENT

								{$row->commentPagination( array(), 'miniPagination' )}
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
						<meta itemprop="position" content="
CONTENT;
$return .= htmlspecialchars( $row->tid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					</h4>
					<div class='ipsDataItem_meta ipsType_reset ipsType_light ipsType_blendLinks'>
						<span itemprop="author" itemscope itemtype="http://schema.org/Person">
							
CONTENT;

$htmlsprintf = array($row->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_itemprop', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

						</span>
CONTENT;

$val = ( $row->mapped('date') instanceof \IPS\DateTime ) ? $row->mapped('date') : \IPS\DateTime::ts( $row->mapped('date') );$return .= $val->html(FALSE);
$return .= <<<CONTENT

						<meta itemprop="dateCreated datePublished" content="
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::create( $row->__get( $row::$databaseColumnMap['date'] ) )->rfc3339(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
						
CONTENT;

if ( !in_array( \IPS\Dispatcher::i()->controller, array( 'forums', 'index' ) ) ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href="
CONTENT;
$return .= htmlspecialchars( $row->container()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $row->container()->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( count( $row->tags() ) ):
$return .= <<<CONTENT

							&nbsp;&nbsp;
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $row->tags(), true );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				</div>
				<ul class='ipsDataItem_stats'>
					
CONTENT;

foreach ( $row->stats(FALSE) as $k => $v ):
$return .= <<<CONTENT

						<li 
CONTENT;

if ( $k == 'num_views' ):
$return .= <<<CONTENT
class='ipsType_light'
CONTENT;

elseif ( in_array( $k, $row->hotStats ) ):
$return .= <<<CONTENT
class="ipsDataItem_stats_hot" data-text='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hot_item', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hot_item_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
							<span class='ipsDataItem_stats_number' 
CONTENT;

if ( $k == 'forums_comments' OR $k == 'answers_no_number' ):
$return .= <<<CONTENT
itemprop='commentCount'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $v );
$return .= <<<CONTENT
</span>
							<span class='ipsDataItem_stats_type'>
CONTENT;

$val = "{$k}"; $pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
							
CONTENT;

if ( ( $k == 'forums_comments' OR $k == 'answers_no_number' ) && \IPS\forums\Topic::modPermission( 'unhide', NULL, $row->container() ) AND $unapprovedComments = $row->mapped('unapproved_comments') ):
$return .= <<<CONTENT

								&nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->setQueryString( 'queued_posts', 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_warning ipsType_small ipsPos_right ipsResponsive_noFloat' data-ipsTooltip title='
CONTENT;

$pluralize = array( $row->topic_queuedposts ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_posts_badge', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i> <strong>
CONTENT;
$return .= htmlspecialchars( $unapprovedComments, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></a>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
				<ul class='ipsDataItem_lastPoster ipsDataItem_withPhoto ipsType_blendLinks'>
					<li>
						
CONTENT;

if ( $row->mapped('num_comments') ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->lastCommenter(), 'tiny' );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'tiny' );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</li>
					<li>
						
CONTENT;

if ( $row->mapped('num_comments') ):
$return .= <<<CONTENT

							{$row->lastCommenter()->link()}
						
CONTENT;

else:
$return .= <<<CONTENT

							{$row->author()->link()}
						
CONTENT;

endif;
$return .= <<<CONTENT

					</li>
					<li class="ipsType_light">
						<a href='
CONTENT;
$return .= htmlspecialchars( $row->url( 'getLastComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_last_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
							
CONTENT;

if ( $row->mapped('last_comment') ):
$return .= <<<CONTENT

CONTENT;

$val = ( $row->mapped('last_comment') instanceof \IPS\DateTime ) ? $row->mapped('last_comment') : \IPS\DateTime::ts( $row->mapped('last_comment') );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$val = ( $row->mapped('date') instanceof \IPS\DateTime ) ? $row->mapped('date') : \IPS\DateTime::ts( $row->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

						</a>
					</li>
				</ul>
				
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

					<div class='ipsDataItem_modCheck'>
						<span class='ipsCustomInput'>
							<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $row->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->tableStates(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
							<span></span>
						</span>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}