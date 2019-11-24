<?php
namespace IPS\Theme\Cache;
class class_core_global_plugins extends \IPS\Theme\Template
{
	public $cache_key = '93826fd1df1590e282335a3fa4af4fad';
	function timeSpentWidget( $users, $format, $orientation='vertical' ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT


CONTENT;

if ( !empty( $users )  ):
$return .= <<<CONTENT

	<h3 class='ipsWidget_title ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_time_online', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>

	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsPad_half ipsWidget_inner'>
			<ul class='ipsDataList ipsDataList_reducedSpacing'>
				
CONTENT;

foreach ( $users as $user ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_icon ipsPos_top'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $user, 'tiny' );
$return .= <<<CONTENT

						</div>
						<div class='ipsDataItem_main'>
							<a href="
CONTENT;
$return .= htmlspecialchars( $user->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsDataItem_title ipsType_break'>
CONTENT;

if ( $format ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLinkFromData( $user->member_id, $user->name, $user->members_seo_name, $user->member_group_id );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
{$user->link()}
CONTENT;

endif;
$return .= <<<CONTENT
</a><br>
							
CONTENT;

$totalTime = \IPS\Member::loggedIn()->getTotalTimeSpentOnline( $user, $user->time_spent, TRUE );
$return .= <<<CONTENT

							<span class='ipsType_light ipsType_small'>
CONTENT;
$return .= htmlspecialchars( $totalTime, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
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

foreach ( $users as $user ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_icon ipsPos_top'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $user, 'tiny' );
$return .= <<<CONTENT

						</div>
						<div class='ipsDataItem_main'>
							<a href="
CONTENT;
$return .= htmlspecialchars( $user->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsDataItem_title ipsType_break'>
CONTENT;

if ( $format ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLinkFromData( $user->member_id, $user->name, $user->members_seo_name, $user->member_group_id );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
{$user->link()}
CONTENT;

endif;
$return .= <<<CONTENT
</a><br>
							
CONTENT;

$totalTime = \IPS\Member::loggedIn()->getTotalTimeSpentOnline( $user, $user->time_spent, TRUE );
$return .= <<<CONTENT

							<span class='ipsType_light ipsType_small'>
CONTENT;
$return .= htmlspecialchars( $totalTime, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
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

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_timeSpentWidget" );
		}
		return $return;
}

	function totalTimeSpentOnlineCard( $member ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->timeSpent_viewGroups =='all' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Settings::i()->timeSpent_viewGroups ) ) ):
$return .= <<<CONTENT

	
CONTENT;

$totalTime = $member->time_spent > 0 ? \IPS\Member::loggedIn()->getTotalTimeSpentOnline( $member, $member->time_spent, FALSE ) : 0;
$return .= <<<CONTENT

	
CONTENT;

if ( $totalTime ):
$return .= <<<CONTENT

		<li class="ipsDataItem">
			<span class="ipsDataItem_generic ipsDataItem_size3">
				<strong>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'time_spent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</strong>
			</span>
			<span class="ipsDataItem_main">
				
CONTENT;
$return .= htmlspecialchars( $totalTime, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</span>
		</li>	
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_totalTimeSpentOnlineCard" );
		}
		return $return;
}

	function totalTimeSpentOnlineProfile( $member ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->timeSpent_viewGroups =='all' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Settings::i()->timeSpent_viewGroups ) ) ):
$return .= <<<CONTENT

	
CONTENT;

$totalTime = $member->time_spent > 0 ? \IPS\Member::loggedIn()->getTotalTimeSpentOnline( $member, $member->time_spent, FALSE ) : 0;
$return .= <<<CONTENT

	
CONTENT;

if ( $totalTime ):
$return .= <<<CONTENT

		<li>
			<h4 class="ipsType_minorHeading">
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'time_spent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</h4>
			<span>
			
CONTENT;
$return .= htmlspecialchars( $totalTime, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</span>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_totalTimeSpentOnlineProfile" );
		}
		return $return;
}

	function totalTimeSpentOnlineTopics( $comment ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->timeSpent_viewGroups =='all' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Settings::i()->timeSpent_viewGroups ) ) ):
$return .= <<<CONTENT

	
CONTENT;

$totalTime = $comment->author()->time_spent > 0 ? \IPS\Member::loggedIn()->getTotalTimeSpentOnline( $comment->author(), $comment->author()->time_spent, TRUE ) : 0;
$return .= <<<CONTENT

	
CONTENT;

if ( $totalTime ):
$return .= <<<CONTENT

		<span>
			<li class="ipsType_light">
				
CONTENT;
$return .= htmlspecialchars( $totalTime, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</li>
		</span>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_totalTimeSpentOnlineTopics" );
		}
		return $return;
}}