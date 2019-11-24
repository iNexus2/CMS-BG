<?php
namespace IPS\Theme\Cache;
class class_core_front_widgets extends \IPS\Theme\Template
{
	public $cache_key = '60cdbefebbae65e26b7c525e6d11b996';
	function activeUsers( $members, $memberCount, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


<h3 class='ipsType_reset ipsWidget_title'>
	
CONTENT;

if ( \IPS\Dispatcher::i()->application->directory !== 'core' ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_activeUsers', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_activeUsers_noApp', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $orientation == 'horizontal' ):
$return .= <<<CONTENT

		&nbsp;&nbsp;<span class='ipsType_light ipsType_unbold ipsType_medium'>
CONTENT;

$pluralize = array( $memberCount ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_user_online_info', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
	
CONTENT;

endif;
$return .= <<<CONTENT

</h3>
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

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) )  ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $members as $row ):
$return .= <<<CONTENT

					<li><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$row['member_id']}", null, "profile", array( $row['seo_name'] ), 0 ) );
$return .= <<<CONTENT
" data-ipsHover data-ipsHover-target='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$row['member_id']}&do=hovercard", null, "profile", array( $row['seo_name'] ), 0 ) );
$return .= <<<CONTENT
' title="
CONTENT;

$sprintf = array($row['member_name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_user_profile', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member\Group::load( $row['member_group'] )->formatName( $row['member_name'] );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

foreach ( $members as $row ):
$return .= <<<CONTENT

					<li>
						
CONTENT;

$return .= \IPS\Member\Group::load( $row['member_group'] )->formatName( $row['member_name'] );
$return .= <<<CONTENT

					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
		
CONTENT;

if ( $memberCount > 60 && $orientation == 'vertical' ):
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'active_users_empty', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function announcements( $announcements, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_announcements', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner'>
	
CONTENT;

if ( !empty( $announcements )  ):
$return .= <<<CONTENT

		<ul class='ipsList_reset ipsPad'>
			
CONTENT;

foreach ( $announcements as $announcement ):
$return .= <<<CONTENT

				<li class='ipsPhotoPanel ipsPhotoPanel_tiny cAnnouncement ipsClearfix'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $announcement->member_id ), 'tiny' );
$return .= <<<CONTENT

					<div>
						
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

							<h4 class='ipsType_large ipsType_reset'>
								<div class='ipsType_break ipsContained'>
									<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=announcement&id={$announcement->id}", null, "announcement", array( $announcement->seo_title ), 0 ) );
$return .= <<<CONTENT
' class='ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Lang::wordbreak( htmlspecialchars( $announcement->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) );
$return .= <<<CONTENT
</a>
								</div>
							</h4>
							
CONTENT;

if ( $announcement->start ):
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

$val = ( $announcement->start instanceof \IPS\DateTime ) ? $announcement->start : \IPS\DateTime::ts( $announcement->start );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

							<br><br>
						
CONTENT;

else:
$return .= <<<CONTENT

							<h4 class='ipsType_large ipsType_reset'>
								<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=announcement&id={$announcement->id}", null, "announcement", array( $announcement->seo_title ), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
CONTENT;

if ( $announcement->start ):
$return .= <<<CONTENT
 &nbsp;&nbsp;<span class='ipsType_light ipsType_medium ipsType_unbold'>
CONTENT;

$val = ( $announcement->start instanceof \IPS\DateTime ) ? $announcement->start : \IPS\DateTime::ts( $announcement->start );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

							</h4>							
						
CONTENT;

endif;
$return .= <<<CONTENT
						
						<div class='ipsType_medium ipsType_textBlock ipsType_richText ipsContained' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='
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
							{$announcement->truncated( true )}
						</div>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsPad'>
			<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_announcements', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function blankWidget( $widget ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsWidgetBlank">
	
CONTENT;

if ( method_exists( $widget, 'configuration' ) AND $widget->configuration( $form ) !== NULL ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_blank_or_no_context', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_blank_or_no_context_no_config', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function blockList( $availableBlocks ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( $availableBlocks['plugin'] ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $availableBlocks['plugin'] as $pluginId => $blocks ):
$return .= <<<CONTENT

	<h3 class='ipsToolbox_sectionTitle ipsCursor_pointer cSidebarManager_closed' data-action='toggleSection'>
CONTENT;

$return .= htmlspecialchars( \IPS\Plugin::load( $pluginId )->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
	<ul class='ipsList_reset ipsHide'>
		
CONTENT;

foreach ( $blocks as $block ):
$return .= <<<CONTENT

			<li data-blockTitle="
CONTENT;
$return .= htmlspecialchars( $block->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-blockID='plugin_
CONTENT;
$return .= htmlspecialchars( $block->plugin, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $block->key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $block->hasConfiguration() ):
$return .= <<<CONTENT
data-blockConfig='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $block->menuStyle) ):
$return .= <<<CONTENT
data-menuStyle='
CONTENT;
$return .= htmlspecialchars( $block->menuStyle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !empty( $block->allowReuse) ):
$return .= <<<CONTENT
data-allowReuse='true'
CONTENT;

endif;
$return .= <<<CONTENT
 class='ipsCursor_drag cSidebarManager_block'>
				<h4 class='ipsType_reset'>
CONTENT;

$val = "block_{$block->key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<p class='ipsType_reset ipsType_light ipsType_small'>
CONTENT;

$val = "block_{$block->key}_desc"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( isset( $availableBlocks['apps'] ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $availableBlocks['apps'] as $app => $blocks ):
$return .= <<<CONTENT

	<h3 class='ipsToolbox_sectionTitle ipsCursor_pointer cSidebarManager_closed' data-action='toggleSection'>
CONTENT;

$val = "__app_{$app}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<ul class='ipsList_reset ipsHide'>
		
CONTENT;

foreach ( $blocks as $block ):
$return .= <<<CONTENT

			<li data-blockTitle="
CONTENT;
$return .= htmlspecialchars( $block->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-blockID='app_
CONTENT;
$return .= htmlspecialchars( $block->app, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $block->key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $block->hasConfiguration() ):
$return .= <<<CONTENT
data-blockConfig='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $block->menuStyle) ):
$return .= <<<CONTENT
data-menuStyle='
CONTENT;
$return .= htmlspecialchars( $block->menuStyle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !empty( $block->allowReuse) ):
$return .= <<<CONTENT
data-allowReuse='true'
CONTENT;

endif;
$return .= <<<CONTENT
 class='ipsCursor_drag cSidebarManager_block'>
				<h4 class='ipsType_reset'>
CONTENT;

$val = "block_{$block->key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<p class='ipsType_reset ipsType_light ipsType_small'>
CONTENT;

$val = "block_{$block->key}_desc"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
	<p class='ipsType_light ipsType_center ipsPad_half ipsHide'><em>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_app_widgets', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em></p>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function formTemplate( $widget, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm ipsForm_vertical" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( $uploadField ):
$return .= <<<CONTENT

		<input type="hidden" name="MAX_FILE_SIZE" value="
CONTENT;
$return .= htmlspecialchars( $uploadField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<input type="hidden" name="plupload" value="
CONTENT;

$return .= htmlspecialchars( md5( uniqid() ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsMenu_headerBar'>
		<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editBlockSettings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
	</div>
	
CONTENT;

if ( $widget->menuStyle === 'modal' ):
$return .= <<<CONTENT

		<div class='ipsPad'>
			<ul class='ipsList_reset'>
				
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( is_object( $input )  ):
$return .= <<<CONTENT

							{$input->rowHtml($form)}
						
CONTENT;

else:
$return .= <<<CONTENT

							{$input}
						
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
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsMenu_innerContent ipsPad'>
			<ul class='ipsList_reset'>
				
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( is_object( $input )  ):
$return .= <<<CONTENT

							{$input->rowHtml($form)}
						
CONTENT;

else:
$return .= <<<CONTENT

							{$input}
						
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
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsMenu_footerBar ipsType_center'>
		
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

			{$button}
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>
</form>
CONTENT;

		return $return;
}

	function members( $members, $title, $display='csv', $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
	
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

</h3>

CONTENT;

if ( $display === 'csv' ):
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

if ( count( $members ) ):
$return .= <<<CONTENT

		<ul class='ipsList_inline ipsList_csv ipsList_noSpacing'>
			
CONTENT;

foreach ( $members as $row ):
$return .= <<<CONTENT

				<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLinkFromData( $row->member_id, $row->name, $row->members_seo_name, $row->member_group_id );
$return .= <<<CONTENT
</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsType_reset ipsType_medium ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_members_no_results', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

else:
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

if ( count( $members )  ):
$return .= <<<CONTENT

		<ul class='ipsList_reset'>
			
CONTENT;

foreach ( $members as $member ):
$return .= <<<CONTENT

				<li class='ipsPhotoPanel ipsPhotoPanel_tiny cAnnouncement'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT

					<div>
						<h4 class='ipsType_large ipsType_reset'>{$member->link()} <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation", null, "profile_reputation", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
'  class='ipsPos_right ipsRepBadge 
CONTENT;

if ( $member->pp_reputation_points > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $member->pp_reputation_points < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $member->pp_reputation_points > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $member->pp_reputation_points < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->pp_reputation_points );
$return .= <<<CONTENT
</a></h4>
						{$member->groupName}
						<br>
						<span class='ipsType_light ipsType_small'>
CONTENT;

$htmlsprintf = array($member->joined->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_member_joined_date', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
						
CONTENT;

if ( $member->last_activity ):
$return .= <<<CONTENT

							<br><span class='ipsType_light ipsType_small'>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $member->last_activity )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_member_last_active_date', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_members_no_results', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function recentStatusUpdates( $statuses, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_recentStatusUpdates', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner cStatusUpdateWidget' data-controller="core.front.core.statusFeedWidget">
	
CONTENT;

if ( \IPS\core\Statuses\Status::canCreateFromCreateMenu() ):
$return .= <<<CONTENT

		<div class="ipsAreaBackground ipsPad_half" data-role='statusFormArea'>
			<div class='ipsComposeArea_editor' data-role='statusDummy'>
				<div class='ipsComposeArea_dummy ipsType_light' tabindex='-1'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</div>
			</div>
			<div data-role='statusEditor' class='ipsHide'></div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<ul class='ipsDataList' data-role="statusFeed">
		
CONTENT;

foreach ( $statuses as $status ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "core" )->recentStatusUpdatesStatus( $status );
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
	
CONTENT;

if ( count( $statuses ) == 0 ):
$return .= <<<CONTENT

		<div class='ipsType_center ipsType_light ipsPad_half' data-role="statusFeedEmpty">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_recent_statuses', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function recentStatusUpdatesStatus( $status ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsDataItem 
CONTENT;

if ( $status->hidden() ):
$return .= <<<CONTENT
 ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
' data-statusID='
CONTENT;
$return .= htmlspecialchars( $status->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<div class='ipsDataItem_icon ipsPos_top'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $status->author(), 'tiny' );
$return .= <<<CONTENT

	</div>
	<div class='ipsDataItem_main ipsType_medium ipsType_break'>
		<p class='ipsType_medium ipsType_reset'>
			
CONTENT;

if ( $status->member_id != $status->author()->member_id ):
$return .= <<<CONTENT

				<strong class='ipsType_light'>{$status->author()->link()}</strong> &nbsp;&raquo;&nbsp; <strong>
CONTENT;

$return .= \IPS\Member::load( $status->member_id )->link();
$return .= <<<CONTENT
</strong>
			
CONTENT;

else:
$return .= <<<CONTENT

				<strong>{$status->author()->link()}</strong>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</p> 
		<div class='ipsType_richText ipsContained' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='3 lines' data-ipsTruncate-watch='false'>
			{$status->truncated()}
		</div>
		<span class='ipsType_light ipsType_small ipsType_blendLinks'><a href='
CONTENT;
$return .= htmlspecialchars( $status->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = ( $status->date instanceof \IPS\DateTime ) ? $status->date : \IPS\DateTime::ts( $status->date );$return .= $val->html();
$return .= <<<CONTENT
</a>
CONTENT;

if ( $status->replies or $status->canComment() ):
$return .= <<<CONTENT
 &middot; <a href="
CONTENT;
$return .= htmlspecialchars( $status->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$pluralize = array( $status->replies ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_num_replies', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT
</span>
	</div>
</li>

CONTENT;

		return $return;
}

	function relatedContent( $similar ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_relatedContent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsPad_half ipsWidget_inner'>
	<ul class='ipsDataList ipsDataList_reducedSpacing'>
	
CONTENT;

foreach ( $similar as $item ):
$return .= <<<CONTENT

		<li class='ipsDataItem'>
			<div class='ipsDataItem_icon'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $item->author(), 'tiny' );
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main'>
				<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$sprintf = array($item->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' class='ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$htmlsprintf = array($item->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span><br>
				
CONTENT;

if ( $content = $item->truncated() ):
$return .= <<<CONTENT

					<div class='ipsType_richText ipsType_normal' data-ipsTruncate data-ipsTruncate-type="remove" data-ipsTruncate-size="2 lines">
						{$content}
					</div>
				
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

		return $return;
}

	function stats( $stats, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_stats', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner'>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsPad_half'>
			<ul class="ipsDataList">
				<li class="ipsDataItem">
					<div class="ipsDataItem_main ipsPos_middle">
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_total_members', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class="ipsDataItem_stats ipsDataItem_statsLarge">
						<span class="ipsDataItem_stats_number">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['member_count'] );
$return .= <<<CONTENT
</span>
					</div>
				</li>
				<li class="ipsDataItem">
					<div class="ipsDataItem_main ipsPos_middle">
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_most_online', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class="ipsDataItem_stats ipsDataItem_statsLarge">
						<span class="ipsDataItem_stats_number">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['most_online']['count'] );
$return .= <<<CONTENT
</span><br>
						<span class="ipsType_light ipsType_small"><time>
CONTENT;
$return .= htmlspecialchars( $stats['most_online']['time'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</time></span>
					</div>
				</li>
			</ul>
			<hr class='ipsHr'>
			
CONTENT;

if ( $stats['last_registered'] ):
$return .= <<<CONTENT

				<div class='ipsClearfix ipsPad_bottom'>
					<div class='ipsPos_left ipsType_center cNewestMember'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $stats['last_registered'], 'small' );
$return .= <<<CONTENT

					</div>
					<div class='ipsWidget_latestItem'>
						<strong class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_newest_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong><br>
						<span class='ipsType_normal'>{$stats['last_registered']->link()}</span><br>
						<span class='ipsType_medium ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_joined', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <time>
CONTENT;
$return .= htmlspecialchars( $stats['last_registered']->joined->getTimestamp(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</time></span>
					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsGrid ipsGrid_collapsePhone ipsWidget_stats'>
			<div class='ipsGrid_span4 ipsType_center'>
				<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['member_count'] );
$return .= <<<CONTENT
</span><br>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_total_members', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>
			<div class='ipsGrid_span4 ipsType_center'>
				<span class='ipsType_large ipsWidget_statsCount' data-ipsTooltip title='<time data-norelative="true">
CONTENT;
$return .= htmlspecialchars( $stats['most_online']['time'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</time>'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['most_online']['count'] );
$return .= <<<CONTENT
</span><br>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_most_online', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>
			<div class='ipsGrid_span4 ipsType_left ipsPhotoPanel ipsPhotoPanel_mini cNewestMember'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $stats['last_registered'], 'mini' );
$return .= <<<CONTENT

				<div>
					<span class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_newest_member', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span><br>
					<span class='ipsType_normal'>{$stats['last_registered']->link()}</span><br>
					<span class='ipsType_small ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_joined', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <time>
CONTENT;
$return .= htmlspecialchars( $stats['last_registered']->joined->getTimestamp(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</time></span>
				</div>
			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function topContributorRow( $idx, $data, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsDataItem'>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsDataItem_icon ipsPos_middle ipsType_center ipsType_large ipsType_light'><strong>
CONTENT;

$return .= htmlspecialchars( $idx + 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsDataItem_main ipsPhotoPanel ipsPhotoPanel_tiny'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $data['member'], 'tiny' );
$return .= <<<CONTENT

		<div>
			{$data['member']->link()}
			<br>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$data['member']->member_id}&do=reputation", null, "profile_reputation", array( $data['member']->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $data['rep'] > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $data['rep'] < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $data['rep'] > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $data['rep'] < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;
$return .= htmlspecialchars( $data['rep'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
		</div>
	</div>
</li>
CONTENT;

		return $return;
}

	function topContributorRows( $results, $timeframe, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $results ) ):
$return .= <<<CONTENT

	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<ol class='ipsDataList ipsDataList_reducedSpacing cTopContributors'>
			
CONTENT;

$idx = 1;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $results as $memberId => $rep ):
$return .= <<<CONTENT

				
CONTENT;

$member = \IPS\Member::load( $memberId );
$return .= <<<CONTENT

				<li class='ipsDataItem'>
					<div class='ipsDataItem_icon ipsPos_middle ipsType_center ipsType_large ipsType_light'><strong>
CONTENT;

$return .= htmlspecialchars( $idx++, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></div>
					<div class='ipsDataItem_main ipsPhotoPanel ipsPhotoPanel_tiny'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT

						<div>
							{$member->link()}
							<br>
							
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

								<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation", null, "profile_reputation", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $rep ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

else:
$return .= <<<CONTENT

								<span title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $rep ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class="ipsGrid ipsGrid_collapsePhone">
			
CONTENT;

$count = 0;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $results as $memberId => $rep ):
$return .= <<<CONTENT

				
CONTENT;

if ( $count == 4 ):
$return .= <<<CONTENT

					
CONTENT;

break;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$count++;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$member = \IPS\Member::load( $memberId );
$return .= <<<CONTENT

				<div class='ipsGrid_span3'>
					<div class='ipsPad_half ipsPhotoPanel ipsPhotoPanel_tiny'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT

						<div>
							<p class='ipsType_reset ipsTruncate ipsTruncate_line'>
								{$member->link()}
							</p>
							
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

								<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation", null, "profile_reputation", array( $member->members_seo_name ), 0 ) );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $rep ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

else:
$return .= <<<CONTENT

								<span title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $rep ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</div>
				</div>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsPad'>
		<p class='ipsType_reset'>
CONTENT;

$val = "top_contributors_empty__{$timeframe}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function topContributors( $topContributorsThisWeek, $limit, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_topContributors', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsTabs ipsTabs_small ipsTabs_stretch ipsClearfix' id='elTopContributors' data-ipsTabBar data-ipsTabBar-updateURL='false' data-ipsTabBar-contentArea='#elTopContributors_content'>
	<a href='#elTopContributors' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
	<ul role="tablist" class='ipsList_reset'>
		<li>
			<a href='#ipsTabs_elTopContributors_el_topContributorsWeek_panel' id='el_topContributorsWeek' class='ipsTabs_item ipsTabs_activeItem' role="tab" aria-selected='true'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'week', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>
		<li>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=topContributors&time=month&limit={$limit}&orientation={$orientation}", null, "", array(), 0 ) );
$return .= <<<CONTENT
' id='el_topContributorsMonth' class='ipsTabs_item' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'month', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>		
		<li>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=topContributors&time=year&limit={$limit}&orientation={$orientation}", null, "", array(), 0 ) );
$return .= <<<CONTENT
' id='el_topContributorsYear' class='ipsTabs_item' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'year', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>
		<li>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=topContributors&time=all&limit={$limit}&orientation={$orientation}", null, "", array(), 0 ) );
$return .= <<<CONTENT
' id='el_topContributorsAll' class='ipsTabs_item' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'alltime', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>
	</ul>
</div>

<section id='elTopContributors_content' class='ipsWidget_inner'>
	<div id="ipsTabs_elTopContributors_el_topContributorsWeek_panel" class='ipsTabs_panel'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "core" )->topContributorRows( $topContributorsThisWeek, 'week', $orientation );
$return .= <<<CONTENT

	</div>
</section>
CONTENT;

		return $return;
}

	function whosOnline( $members, $memberCount, $guests, $anonymous, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whosOnline', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

if ( $orientation == 'horizontal' ):
$return .= <<<CONTENT

		&nbsp;&nbsp;<span class='ipsType_light ipsType_unbold ipsType_medium'>
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

	<span class='ipsType_medium ipsType_light ipsType_unbold ipsType_blendLinks'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=online&controller=online", null, "online", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_full_list', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></span>
</h3>
<div class='ipsWidget_inner ipsPad'>
	
CONTENT;

if ( $memberCount ):
$return .= <<<CONTENT

		<ul class='ipsList_inline ipsList_csv ipsList_noSpacing'>
			
CONTENT;

foreach ( $members as $row ):
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

</div>
CONTENT;

		return $return;
}}