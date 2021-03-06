<?php
namespace IPS\Theme\Cache;
class class_forums_front_widgets extends \IPS\Theme\Template
{
	public $cache_key = '5f739e309b3ced1095d348a6df0355fc';
	function forumStatistics( $stats, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_forumStatistics', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner'>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsPad_half'>
			<ul class='ipsDataList'>
				<li class='ipsDataItem'>
					<div class='ipsDataItem_main ipsPos_middle'>
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_topics', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class='ipsDataItem_stats ipsDataItem_statsLarge'>
						<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['total_topics'] );
$return .= <<<CONTENT
</span>
					</div>
				</li>
				<li class='ipsDataItem'>
					<div class='ipsDataItem_main ipsPos_middle'>
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_posts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class='ipsDataItem_stats ipsDataItem_statsLarge'>
						<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['total_posts'] );
$return .= <<<CONTENT
</span>
					</div>
				</li>
			</ul>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsGrid ipsGrid_collapsePhone ipsWidget_stats'>
			<div class='ipsGrid_span6 ipsType_center'>
				<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['total_topics'] );
$return .= <<<CONTENT
</span><br>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_topics', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>
			<div class='ipsGrid_span6 ipsType_center'>
				<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['total_posts'] );
$return .= <<<CONTENT
</span><br>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_posts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function hotTopics( $topics, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !empty( $topics )  ):
$return .= <<<CONTENT

	<h3 class='ipsWidget_title ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_hotTopics', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>

	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsPad_half ipsWidget_inner'>
			<ul class='ipsDataList ipsDataList_reducedSpacing'>
				
CONTENT;

foreach ( $topics as $topic ):
$return .= <<<CONTENT

					<li class='ipsDataItem
CONTENT;

if ( $topic->unread() ):
$return .= <<<CONTENT
 ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $topic->hidden() ):
$return .= <<<CONTENT
 ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
'>
						<div class='ipsDataItem_icon ipsPos_top'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $topic->author(), 'tiny' );
$return .= <<<CONTENT

						</div>
						<div class='ipsDataItem_main cWidgetComments'>
							<div class="ipsCommentCount ipsPos_right 
CONTENT;

if ( ( $topic->posts - 1 ) === 0 ):
$return .= <<<CONTENT
ipsFaded
CONTENT;

endif;
$return .= <<<CONTENT
" data-ipsTooltip title='
CONTENT;

$pluralize = array( $topic->posts - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replies_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $topic->posts - 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
							
							<div class='ipsType_break ipsContained'>
								
CONTENT;

if ( $topic->mapped('featured') || $topic->hidden() === -1 || $topic->hidden() === 1 ):
$return .= <<<CONTENT

									
CONTENT;

if ( $topic->hidden() === -1 ):
$return .= <<<CONTENT

										<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $topic->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
									
CONTENT;

elseif ( $topic->hidden() === 1 ):
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

if ( $topic->mapped('featured') ):
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

								<a href="
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( 'do', 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$sprintf = array($topic->title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' class='ipsDataItem_title'>
CONTENT;
$return .= htmlspecialchars( $topic->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							</div>
							<p class='ipsType_reset ipsType_medium ipsType_blendLinks ipsContained'>
								<span>
CONTENT;

$htmlsprintf = array($topic->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span><br>
								<span class='ipsType_light'>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $topic->mapped('date') )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_started_date', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
							</p>
						</div>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsWidget_inner'>
			<ul class='ipsDataList'>
				
CONTENT;

foreach ( $topics as $topic ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "forums" )->row( NULL, NULL, $topic, FALSE );
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function poll( $topic, $poll, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

{$poll}

CONTENT;

		return $return;
}

	function pollFormWidget( $url, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( 'do', 'widgetPoll' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" 
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT
enctype="multipart/form-data"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm>
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
		
	
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

		<ol class='ipsList_reset cPollList cPollList_questions'>
			
CONTENT;

foreach ( $collection as $idx => $input ):
$return .= <<<CONTENT

				<li class='ipsFieldRow ipsFieldRow_noLabel'>
					<h4 class='ipsType_normal ipsType_reset'><div class='ipsType_break ipsContained'>
CONTENT;
$return .= htmlspecialchars( $idx, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
. 
CONTENT;
$return .= htmlspecialchars( $input->label, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div></h4>
					
CONTENT;

if ( !$input->options['multiple'] ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->radio( $input->name, $input->value, $input->required, $input->options['options'], $input->options['disabled'], '', $input->options['disabled'] );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->checkboxset( $input->name, $input->value, $input->required, $input->options['options'], $input->options['disabled'], $input->options['toggles'], isset( $input->options['descriptions'] ) ? $input->options['descriptions'] : NULL, $input->options['userSuppliedInput'] );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
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

endforeach;
$return .= <<<CONTENT

		</ol>
		<br>
		<a class='ipsType_light ipsType_break' href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_view_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		<br>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<hr class='ipsHr'>
	<ul class="ipsPos_left ipsToolList ipsToolList_horizontal ipsList_reset ipsClearfix">
		
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

			<li>{$button}</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

        <li><a class='ipsButton ipsButton_link' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_results_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' href="
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( '_poll', 'results' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( !\IPS\Settings::i()->allow_result_view ):
$return .= <<<CONTENT
data-viewResults-confirm="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_allow_result_view', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-action='viewResults'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_results', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
	</ul>
</form>
CONTENT;

		return $return;
}

	function pollWidget( $poll, $url ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !isset( \IPS\Request::i()->fetchPoll ) ):
$return .= <<<CONTENT

<section class='ipsBox' data-controller='core.front.core.poll'>

CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $poll->canVote() and \IPS\Request::i()->_poll != 'results' and ( !$poll->getVote() or \IPS\Request::i()->_poll == 'form') and $pollForm = $poll->buildForm() ):
$return .= <<<CONTENT

		<h3 class='ipsWidget_title ipsType_reset'>
			<div class='ipsType_break ipsContained'>
				
CONTENT;
$return .= htmlspecialchars( $poll->poll_question, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&nbsp;&nbsp;
				<span class='ipsType_small ipsType_light'>
CONTENT;

$pluralize = array( $poll->votes ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_num_votes', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
			</div>
		</h3>
		<div class='ipsPad_half ipsWidget_inner ipsClearfix' data-role='pollContents'>
			{$pollForm->customTemplate( array( \IPS\Theme::i()->getTemplate( 'widgets', 'forums', 'front' ), 'pollFormWidget' ), $url )}
		</div>
	
CONTENT;

elseif ( !$poll->canVote() or $poll->getVote() or ( \IPS\Request::i()->_poll == 'results' and \IPS\Settings::i()->allow_result_view ) ):
$return .= <<<CONTENT

		<h3 class='ipsWidget_title ipsType_reset'>
			<div class='ipsType_break ipsContained'>
				
CONTENT;
$return .= htmlspecialchars( $poll->poll_question, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&nbsp;&nbsp;
				<span class='ipsType_small ipsType_light'>
CONTENT;

$pluralize = array( $poll->votes ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_num_votes', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
			</div>
		</h3>
		<div class='ipsPad_half ipsWidget_inner ipsClearfix' data-role='pollContents'>
			<ol class='ipsList_reset cPollList'>
				
CONTENT;

foreach ( $poll->choices as $questionId => $question ):
$return .= <<<CONTENT

					<li>
						<h3 class='ipsType_normal ipsType_reset'><div class='ipsType_break ipsContained'>
CONTENT;
$return .= htmlspecialchars( $questionId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
. 
CONTENT;
$return .= htmlspecialchars( $question['question'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div></h3>
						<br>
						<ul class='ipsList_reset cPollList_choices'>
							
CONTENT;

foreach ( $question['choice'] as $k => $choice ):
$return .= <<<CONTENT

								<li class='ipsGrid ipsGrid_collapsePhone'>
									<div class='ipsGrid_span4 ipsType_right ipsType_richText ipsType_small ipsType_break'>
										{$choice}
									</div>
									<div class='ipsGrid_span7'>
										<span class='cPollVoteBar'>
											<span style='width: 
CONTENT;

if ( array_sum( $question['votes'] ) > 0  ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( intval( ( $question['votes'][ $k ] / array_sum( $question['votes'] ) ) * 100 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
%' data-votes='
CONTENT;

if ( array_sum( $question['votes'] ) > 0 ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( round( ( $question['votes'][ $k ] / array_sum( $question['votes'] ) ) * 100, 2 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
%' 
CONTENT;

if ( array_sum( $question['votes'] ) && intval( ( $question['votes'][ $k ] / array_sum( $question['votes'] ) ) * 100 ) > 30 ):
$return .= <<<CONTENT
class='cPollVoteBar_inside'
CONTENT;

endif;
$return .= <<<CONTENT
></span>
										</span>
									</div>
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</ul>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ol>
			
CONTENT;

if ( $poll->canVote() || !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				<hr class='ipsHr'>
				
CONTENT;

if ( $poll->canVote() ):
$return .= <<<CONTENT
<a href="
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( '_poll', 'form' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_vote_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light' data-action='viewResults'><i class='fa fa-caret-left'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_vote_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

CONTENT;

$htmlsprintf = array(\IPS\Http\Url::internal( 'app=core&module=system&controller=login', 'front', 'login', NULL, \IPS\Settings::i()->logins_over_https ), \IPS\Http\Url::internal( 'app=core&module=system&controller=register', 'front', 'register', NULL, \IPS\Settings::i()->logins_over_https )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_guest', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<a class='ipsPos_right ipsType_light ipsType_small ipsType_break' href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_view_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( !isset( \IPS\Request::i()->fetchPoll ) ):
$return .= <<<CONTENT

</section>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function postFeed( $comments, $title, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !empty( $comments )  ):
$return .= <<<CONTENT

	<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsWidget_inner ipsPad_half'>
			<ul class='ipsDataList ipsDataList_reducedSpacing'>
				
CONTENT;

foreach ( $comments as $comment ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_icon ipsPos_top'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'tiny' );
$return .= <<<CONTENT

						</div>
						<div class='ipsDataItem_main'>
							<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $comment->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$sprintf = array($comment->item()->title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' class='ipsType_medium ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $comment->item()->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
							<p class='ipsType_reset ipsType_light ipsType_medium ipsType_blendLinks'>
CONTENT;

$htmlsprintf = array($comment->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 &middot; <a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->pid ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>{$comment->dateLine()}</a></p>
							<div class='ipsType_medium ipsType_textBlock ipsType_richText ipsType_break ipsContained ipsSpacer_top ipsSpacer_half' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT
6 lines
CONTENT;

else:
$return .= <<<CONTENT
2 lines
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTruncate-watch='false'>
								{$comment->truncated( true )}
							</div>
						</div>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsWidget_inner'>
			<ul class='ipsDataList'>
				
CONTENT;

foreach ( $comments as $comment ):
$return .= <<<CONTENT

					<li class='ipsDataItem ipsClearfix'>
						<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'mini', $comment->warningRef() );
$return .= <<<CONTENT

							<div>
								<p class='ipsPos_right ipsType_reset ipsType_blendLinks'>
									<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->pid ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false' id='elShareComment_
CONTENT;
$return .= htmlspecialchars( $comment->pid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='shareComment'><i class='fa fa-share-alt'></i></a>
								</p>
								<h3 class='ipsComment_author ipsType_blendLinks'>
									<strong class='ipsType_normal'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $comment->author(), $comment->warningRef() );
$return .= <<<CONTENT
</strong>
									
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationBadge( $comment->author() );
$return .= <<<CONTENT

								</h3>
								<p class='ipsComment_meta ipsType_light ipsType_medium'>
									<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->pid ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>{$comment->dateLine()}</a>
									
CONTENT;

if ( $comment->editLine() ):
$return .= <<<CONTENT

										(
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edited_lc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $comment->hidden() ):
$return .= <<<CONTENT

										&middot; 
CONTENT;
$return .= htmlspecialchars( $comment->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $comment instanceof \IPS\Content\ReportCenter and !\IPS\Member::loggedIn()->group['gbw_no_report'] and $comment->hidden() !== 1  ):
$return .= <<<CONTENT

										&middot; <a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('report'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-remoteSubmit data-ipsDialog-size='medium' data-ipsDialog-flashMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_submit_success', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-action='reportComment' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</p>
					
								
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') and $comment->warning ):
$return .= <<<CONTENT

									
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentWarned( $comment );
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							</div>
						</div>

						<div class='ipsPad ipsClearfix'>
							<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $comment->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$sprintf = array($comment->item()->title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' class='ipsDataItem_title ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Lang::wordbreak( htmlspecialchars( $comment->item()->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) );
$return .= <<<CONTENT
</a></div>
							<div data-role='commentContent' class='ipsType_normal ipsType_richText ipsType_break ipsContained' data-controller='core.front.core.lightboxedImages'>
								
CONTENT;

if ( $comment->hidden() === 1 && $comment->author()->member_id == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

									<strong class='ipsType_medium ipsType_warning'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'comment_awaiting_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
								
CONTENT;

endif;
$return .= <<<CONTENT

								{$comment->content()}
								
								
CONTENT;

if ( $comment->editLine() ):
$return .= <<<CONTENT

									{$comment->editLine()}
								
CONTENT;

endif;
$return .= <<<CONTENT

							</div>
							
							
CONTENT;

if ( $comment->hidden() !== 1 && $comment instanceof \IPS\Content\Reputation and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $comment, 'ipsPos_right ipsResponsive_noFloat' );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function topicFeed( $topics, $title, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !empty( $topics )  ):
$return .= <<<CONTENT

	<h3 class='ipsWidget_title ipsType_reset'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>

	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsPad_half ipsWidget_inner'>
			<ul class='ipsDataList ipsDataList_reducedSpacing'>
				
CONTENT;

foreach ( $topics as $topic ):
$return .= <<<CONTENT

					<li class='ipsDataItem
CONTENT;

if ( $topic->unread() ):
$return .= <<<CONTENT
 ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $topic->hidden() ):
$return .= <<<CONTENT
 ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
'>
						<div class='ipsDataItem_icon ipsPos_top'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $topic->author(), 'tiny' );
$return .= <<<CONTENT

						</div>
						<div class='ipsDataItem_main cWidgetComments'>
							<div class="ipsCommentCount ipsPos_right 
CONTENT;

if ( ( $topic->posts - 1 ) === 0 ):
$return .= <<<CONTENT
ipsFaded
CONTENT;

endif;
$return .= <<<CONTENT
" data-ipsTooltip title='
CONTENT;

$pluralize = array( $topic->posts - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replies_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $topic->posts - 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
							
							<div class='ipsType_break ipsContained'>
								
CONTENT;

if ( $topic->mapped('featured') || $topic->hidden() === -1 || $topic->hidden() === 1 ):
$return .= <<<CONTENT

									
CONTENT;

if ( $topic->hidden() === -1 ):
$return .= <<<CONTENT

										<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $topic->hiddenBlurb(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
									
CONTENT;

elseif ( $topic->hidden() === 1 ):
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

if ( $topic->mapped('featured') ):
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
							
								<a href="
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( 'do', 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$sprintf = array($topic->title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' class='ipsDataItem_title'>
CONTENT;
$return .= htmlspecialchars( $topic->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							</div>
							<p class='ipsType_reset ipsType_medium ipsType_blendLinks ipsContained'>
								<span>
CONTENT;

$htmlsprintf = array($topic->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span><br>
								<span class='ipsType_light'>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $topic->mapped('date') )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_started_date', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
							</p>
						</div>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsWidget_inner'>
			<ul class='ipsDataList'>
				
CONTENT;

foreach ( $topics as $topic ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "forums", 'front' )->row( NULL, NULL, $topic, FALSE );
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}