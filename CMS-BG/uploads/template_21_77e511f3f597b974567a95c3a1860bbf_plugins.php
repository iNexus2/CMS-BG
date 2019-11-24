<?php
namespace IPS\Theme\Cache;
class class_core_global_plugins extends \IPS\Theme\Template
{
	public $cache_key = '6f50c4c26cce4f40947e4dcb0b05c3ed';
	function WaSearchBots( $members, $memberCount, $guests, $anonymous ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whosOnline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

if ( $orientation == 'horizontal' ):
$return .= <<<CONTENT

		&nbsp;&nbsp;<span class='ipsType_light ipsType_unbold ipsType_medium WA_unbold'>
CONTENT;

$pluralize = array( $memberCount ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whos_online_info_members', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
, 
CONTENT;

$pluralize = array( $anonymous ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whos_online_info_anonymous', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
, 
CONTENT;

$pluralize = array( $guests ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whos_online_info_guests', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<span class='ipsType_light ipsType_unbold ipsType_medium'>

CONTENT;

$pluralize = array( $memberCount ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whos_online_info_members', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
, 

CONTENT;

$pluralize = array( $anonymous ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whos_online_info_anonymous', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
, 

CONTENT;

$pluralize = array( $guests ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whos_online_info_guests', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
, 

CONTENT;

$pluralize = array( count($members['searchbots']) ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'WaSerachBotsOnline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

</span>
<span class='ipsType_medium ipsType_light ipsType_unbold ipsType_blendLinks'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=online&controller=online", null, "online", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_full_list', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></span></h3>


CONTENT;

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_WaSearchBots" );
		}
		return $return;
}

	function WaSearchBotsList( $members, $memberCount, $guests, $anonymous, $orientation='vertical' ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT

<div class='ipsWidget_inner 
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT
ipsPad
CONTENT;

else:
$return .= <<<CONTENT
ipsPad_half
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $memberCount ):
$return .= <<<CONTENT

		<ul class='ipsList_inline ipsList_csv ipsList_noSpacing'>
			
CONTENT;

foreach ( $members['users'] as $row ):
$return .= <<<CONTENT

				<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLinkFromData( $row['member_id'], $row['member_name'], $row['seo_name'], $row['member_group'] );
$return .= <<<CONTENT
</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
		
CONTENT;

if ( $orientation == 'vertical' and $memberCount > 60 ):
$return .= <<<CONTENT

			<p class='ipsType_medium ipsType_reset'>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=online&controller=online", null, "online", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$pluralize = array( $memberCount - 60 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_x_others', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</a>
			</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsType_reset ipsType_medium ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'whos_online_users_empty', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( count($members['searchbots']) > 0 ):
$return .= <<<CONTENT

		<ul class='ipsList_inline ipsList_csv ipsList_noSpacing'>
			
CONTENT;

foreach ( $members['searchbots'] as $bot ):
$return .= <<<CONTENT

				<li><a>
CONTENT;
$return .= htmlspecialchars( $bot, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

else:
$return .= <<<CONTENT

		<p>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'WaSearchBotsNoOnline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_WaSearchBotsList" );
		}
		return $return;
}

	function clearCacheLink(  ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT

<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=support&controller=support&do=clearCache", null, "", array(), 0 ) );
$return .= <<<CONTENT
'><i class='fa fa-refresh'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ClearCache_link', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
CONTENT;

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_clearCacheLink" );
		}
		return $return;
}

	function staffMembers( $users, $onlineCount, $orientation='vertical' ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT


CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

    
CONTENT;

foreach ( $users as $user ):
$return .= <<<CONTENT

        
CONTENT;

if ( $user->member()->isOnline() ):
$return .= <<<CONTENT

            <li class='ipsDataItem 
CONTENT;

if ( $orientation == 'horizontal' ):
$return .= <<<CONTENT
ipsGrid_span3
CONTENT;

endif;
$return .= <<<CONTENT
'>
                <div class='ipsDataItem_icon ipsPos_top'>
                    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $user->member(), 'tiny' );
$return .= <<<CONTENT

                </div>
                <div class="ipsDataItem_main">
                    <h3 class='ipsType_sectionHead'>
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( "core_staff_directory_name_{$user->id}" ) ):
$return .= <<<CONTENT
<a href='
CONTENT;
$return .= htmlspecialchars( $user->member()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "core_staff_directory_name_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT
{$user->member()->link()}
CONTENT;

endif;
$return .= <<<CONTENT
</h3>
                    <p class='ipsType_reset ipsType_normal ipsType_light'>
                         
CONTENT;

$return .= \IPS\Member\Group::load( $user->member()->member_group_id )->formattedName;
$return .= <<<CONTENT

                         <span class="ipsPos_right">
                             
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm AND !$user->member()->members_disable_pm ):
$return .= <<<CONTENT

                                  <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$user->member()->member_id}", null, "messenger_compose", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-forceReload data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"><i class='fa fa-envelope'></i> </a>
                             
CONTENT;

endif;
$return .= <<<CONTENT

                         </span>
                    </p>
                </div>
            </li>
        
CONTENT;

endif;
$return .= <<<CONTENT

    
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

    
CONTENT;

foreach ( $users as $user ):
$return .= <<<CONTENT

        <div class='ipsGrid_span3'>
            
CONTENT;

if ( $user->member()->isOnline() ):
$return .= <<<CONTENT

                <div class='ipsDataItem_icon ipsPos_top'>
                    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $user->member(), 'tiny' );
$return .= <<<CONTENT

                </div>
                <div class="ipsDataItem_main">
                    <h3 class='ipsType_sectionHead'>
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( "core_staff_directory_name_{$user->id}" ) ):
$return .= <<<CONTENT
<a href='
CONTENT;
$return .= htmlspecialchars( $user->member()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "core_staff_directory_name_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT
{$user->member()->link()}
CONTENT;

endif;
$return .= <<<CONTENT
</h3>
                    <p class='ipsType_reset ipsType_normal ipsType_light'>
                        
CONTENT;

$return .= \IPS\Member\Group::load( $user->member()->member_group_id )->formattedName;
$return .= <<<CONTENT

                        <span class="ipsPos_right">
                            
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm AND !$user->member()->members_disable_pm ):
$return .= <<<CONTENT

                                <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$user->member()->member_id}", null, "messenger_compose", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-forceReload data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"><i class='fa fa-envelope'></i> </a>
                            
CONTENT;

endif;
$return .= <<<CONTENT

                        </span>
                    </p>
                 </div>
            
CONTENT;

endif;
$return .= <<<CONTENT

        </div>
     
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT








CONTENT;

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_staffMembers" );
		}
		return $return;
}

	function staffOnline( $groups, $userIsStaff=FALSE, $onlineCount, $orientation='vertical' ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT


CONTENT;

if ( !empty( $onlineCount )  ):
$return .= <<<CONTENT

    <h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_staffOnline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
    <div class='ipsWidget_inner'>
        
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

        <div class='ipsPad_half ipsBox'>
            <ul class='ipsDataList ipsDataList_reducedSpacing'>
                
CONTENT;

foreach ( $groups as $group ):
$return .= <<<CONTENT

                    
CONTENT;

if ( count( $group->members() ) ):
$return .= <<<CONTENT

                        
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "plugins", "core", 'global' )->staffMembers( $group->members(), $onlineCount, $orientation='vertical' );
$return .= <<<CONTENT

                    
CONTENT;

endif;
$return .= <<<CONTENT

                
CONTENT;

endforeach;
$return .= <<<CONTENT

            </ul>
        </div>
        
CONTENT;

else:
$return .= <<<CONTENT

        <div class='ipsGrid ipsGrid_collapsePhone'>
            
CONTENT;

foreach ( $groups as $group ):
$return .= <<<CONTENT

                
CONTENT;

if ( count( $group->members() ) ):
$return .= <<<CONTENT

                    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "plugins", "core", 'global' )->staffMembers( $group->members(), $onlineCount, $orientation );
$return .= <<<CONTENT

                
CONTENT;

endif;
$return .= <<<CONTENT

            
CONTENT;

endforeach;
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

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_staffOnline" );
		}
		return $return;
}

	function steam( $url ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT


<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_fullWidth ipsSocial ipsSocial_steam'>
	<span class='ipsSocial_icon'><i class='fa fa-steam'></i></span>
	<span class='ipsSocial_text'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login_steam', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
</a>
CONTENT;

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_steam" );
		}
		return $return;
}}