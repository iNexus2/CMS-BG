<?php
namespace IPS\Theme\Cache;
class class_core_front_staffdirectory extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function layout_blocks( $users ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$count=0;
$return .= <<<CONTENT


CONTENT;

foreach ( $users as $user ):
$return .= <<<CONTENT

	
CONTENT;

if ( $count%4 == 0 ):
$return .= <<<CONTENT

		<div class='ipsGrid ipsGrid_collapsePhone cStaffDirectory_blocks'>
	
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsGrid_span3 ipsType_center ipsAreaBackground_light ipsPad'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $user->member(), 'small' );
$return .= <<<CONTENT

			<h3 class='ipsType_sectionHead'>
				
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( "core_staff_directory_name_{$user->id}" )  ):
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) ) ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $user->member()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "core_staff_directory_name_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$val = "core_staff_directory_name_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
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

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( "core_staff_directory_title_{$user->id}" ) ):
$return .= <<<CONTENT

					
CONTENT;

$val = "core_staff_directory_title_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

if ( $user->member()->member_title ):
$return .= <<<CONTENT

						
CONTENT;
$return .= htmlspecialchars( $user->member()->member_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

elseif ( $user->member()->rank['title'] ):
$return .= <<<CONTENT

						
CONTENT;
$return .= htmlspecialchars( $user->member()->rank['title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
			
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm AND !$user->member()->members_disable_pm AND \IPS\Member::loggedIn()->member_id AND \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

				<br>
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
"><i class='fa fa-envelope'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_send', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

$count++;
$return .= <<<CONTENT

	
CONTENT;

if ( $count%4 == 0 ):
$return .= <<<CONTENT

		</div>
		<br>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

if ( $count%4 != 0 ):
$return .= <<<CONTENT

	</div>
	<br>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function layout_blocks_preview(  ) {
		$return = '';
		$return .= <<<CONTENT


<div class='cStaffDirPreview cStaffDirPreview_blocks'>
	<div class='ipsGrid ipsGrid_collapsePhone'>
		<div class='ipsGrid_span3 ipsType_center cStaffDirPreview_block'>
			<span class='cStaffDirPreview_photo'></span><br>
			<span class='cStaffDirPreview_title'></span>
		</div>
		<div class='ipsGrid_span3 ipsType_center cStaffDirPreview_block'>
			<span class='cStaffDirPreview_photo'></span><br>
			<span class='cStaffDirPreview_title'></span>
		</div>
		<div class='ipsGrid_span3 ipsType_center cStaffDirPreview_block'>
			<span class='cStaffDirPreview_photo'></span><br>
			<span class='cStaffDirPreview_title'></span>
		</div>
		<div class='ipsGrid_span3 ipsType_center cStaffDirPreview_block'>
			<span class='cStaffDirPreview_photo'></span><br>
			<span class='cStaffDirPreview_title'></span>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function layout_full( $users ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $users as $user ):
$return .= <<<CONTENT

	<div class='ipsAreaBackground_light ipsPad ipsPhotoPanel ipsPhotoPanel_small ipsSpacer_bottom ipsSpacer_half cStaffDirectory_full'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $user->member(), 'small' );
$return .= <<<CONTENT

		<div>
			<h3 class='ipsType_sectionHead'>
				
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( "core_staff_directory_name_{$user->id}" )  ):
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) ) ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $user->member()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "core_staff_directory_name_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$val = "core_staff_directory_name_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
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

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( "core_staff_directory_title_{$user->id}" ) ):
$return .= <<<CONTENT

					
CONTENT;

$val = "core_staff_directory_title_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

if ( $user->member()->member_title ):
$return .= <<<CONTENT

						
CONTENT;
$return .= htmlspecialchars( $user->member()->member_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

elseif ( $user->member()->rank['title'] ):
$return .= <<<CONTENT

						
CONTENT;
$return .= htmlspecialchars( $user->member()->rank['title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
			
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( "core_staff_directory_bio_{$user->id}" ) ):
$return .= <<<CONTENT

				<br>
				<div class='ipsType_richText ipsType_normal' data-ipsTruncate data-ipsTruncate-size="4 lines" data-ipsTruncate-type="hide">
CONTENT;

$val = "core_staff_directory_bio_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
			
CONTENT;

endif;
$return .= <<<CONTENT
			
			
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm AND !$user->member()->members_disable_pm AND \IPS\Member::loggedIn()->member_id AND \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

				<br>
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
"><i class='fa fa-envelope'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_send', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function layout_full_preview(  ) {
		$return = '';
		$return .= <<<CONTENT


<div class='cStaffDirPreview cStaffDirPreview_full'>
	<div class='cStaffDirPreview_block cStaffDirPreview_row'>
		<span class='cStaffDirPreview_photo'></span><br>
		<span class='cStaffDirPreview_title'></span>
		<span class='cStaffDirPreview_text'></span>
	</div>
	<div class='cStaffDirPreview_block cStaffDirPreview_row'>
		<span class='cStaffDirPreview_photo'></span><br>
		<span class='cStaffDirPreview_title'></span>
		<span class='cStaffDirPreview_text'></span>
	</div>
	<div class='cStaffDirPreview_block cStaffDirPreview_row'>
		<span class='cStaffDirPreview_photo'></span><br>
		<span class='cStaffDirPreview_title'></span>
		<span class='cStaffDirPreview_text'></span>
	</div>
</div>
CONTENT;

		return $return;
}

	function layout_half( $users ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$count=0;
$return .= <<<CONTENT


CONTENT;

foreach ( $users as $user ):
$return .= <<<CONTENT

	
CONTENT;

if ( $count%2 == 0 ):
$return .= <<<CONTENT

		<div class='ipsGrid ipsGrid_collapsePhone ipsSpacer_bottom cStaffDirectory_half'>
	
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsGrid_span6 ipsPhotoPanel ipsPhotoPanel_small ipsAreaBackground_light ipsPad'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $user->member(), 'small' );
$return .= <<<CONTENT

				<div>
					<h3 class='ipsType_sectionHead'>
						
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( "core_staff_directory_name_{$user->id}" )  ):
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) ) ):
$return .= <<<CONTENT

								<a href='
CONTENT;
$return .= htmlspecialchars( $user->member()->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "core_staff_directory_name_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
</a>
							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

$val = "core_staff_directory_name_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							{$user->member()->link()}
						
CONTENT;

endif;
$return .= <<<CONTENT

					</h3>
					<p class='ipsType_light ipsType_normal ipsType_reset'>
						
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( "core_staff_directory_title_{$user->id}" )  ):
$return .= <<<CONTENT

							
CONTENT;

$val = "core_staff_directory_title_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

if ( $user->member()->member_title ):
$return .= <<<CONTENT

								
CONTENT;
$return .= htmlspecialchars( $user->member()->member_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

							
CONTENT;

elseif ( $user->member()->rank['title'] ):
$return .= <<<CONTENT

								
CONTENT;
$return .= htmlspecialchars( $user->member()->rank['title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</p>
					
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( "core_staff_directory_bio_{$user->id}" ) ):
$return .= <<<CONTENT

						<br>
						<div class='ipsType_richText ipsType_normal' data-ipsTruncate data-ipsTruncate-size="4 lines" data-ipsTruncate-type="hide">
CONTENT;

$val = "core_staff_directory_bio_{$user->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
					
CONTENT;

endif;
$return .= <<<CONTENT
			
					
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm AND !$user->member()->members_disable_pm AND \IPS\Member::loggedIn()->member_id AND \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

						<br>
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
"><i class='fa fa-envelope'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_send', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
	
CONTENT;

$count++;
$return .= <<<CONTENT

	
CONTENT;

if ( $count%2 == 0 ):
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

if ( $count%2 != 0 ):
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function layout_half_preview(  ) {
		$return = '';
		$return .= <<<CONTENT


<div class='cStaffDirPreview cStaffDirPreview_full'>
	<div class='ipsGrid ipsGrid_collapsePhone'>
		<div class='ipsGrid_span6 cStaffDirPreview_block cStaffDirPreview_row'>
			<span class='cStaffDirPreview_photo'></span><br>
			<span class='cStaffDirPreview_title'></span>
			<span class='cStaffDirPreview_text'></span>
		</div>
		<div class='ipsGrid_span6 cStaffDirPreview_block cStaffDirPreview_row'>
			<span class='cStaffDirPreview_photo'></span><br>
			<span class='cStaffDirPreview_title'></span>
			<span class='cStaffDirPreview_text'></span>
		</div>
	</div>
	<div class='ipsGrid ipsGrid_collapsePhone'>
		<div class='ipsGrid_span6 cStaffDirPreview_block cStaffDirPreview_row'>
			<span class='cStaffDirPreview_photo'></span><br>
			<span class='cStaffDirPreview_title'></span>
			<span class='cStaffDirPreview_text'></span>
		</div>
		<div class='ipsGrid_span6 cStaffDirPreview_block cStaffDirPreview_row'>
			<span class='cStaffDirPreview_photo'></span><br>
			<span class='cStaffDirPreview_title'></span>
			<span class='cStaffDirPreview_text'></span>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function template( $groups, $userIsStaff=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom'>

CONTENT;

if ( $userIsStaff ):
$return .= <<<CONTENT

	<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=staffdirectory&controller=directory&do=form", null, "staffdirectory", array(), 0 ) );
$return .= <<<CONTENT
" class='ipsPos_right ipsButton ipsButton_small ipsButton_important' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'leader_edit_mine', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-pencil'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'leader_edit_mine', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>

CONTENT;

endif;
$return .= <<<CONTENT

<h1 class='ipsType_pageTitle'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'staff_directory', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</h1>
</div>


CONTENT;

foreach ( $groups as $group ):
$return .= <<<CONTENT

	
CONTENT;

if ( count( $group->members() ) ):
$return .= <<<CONTENT

		<section class='ipsBox cStaffDirectory ipsfocus_reset'>
			
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT
<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;
$return .= htmlspecialchars( $group->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT

			<div class='ipsPad_half'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "staffdirectory", "core", 'front' )->{$group->template}( $group->members() );
$return .= <<<CONTENT

			</div>
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT

		</section>
		<br>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}