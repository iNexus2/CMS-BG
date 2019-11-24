<?php
namespace IPS\Theme\Cache;
class class_core_global_members extends \IPS\Theme\Template
{
	public $cache_key = '5f739e309b3ced1095d348a6df0355fc';
	function attachmentLocations( $locations, $truncateLinks=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $locations ) ):
$return .= <<<CONTENT

	<ul class="ipsList_reset">
		
CONTENT;

foreach ( $locations as $location ):
$return .= <<<CONTENT

			<li>
				
CONTENT;

if ( $location instanceof \IPS\Content or $location instanceof \IPS\Node\Model ):
$return .= <<<CONTENT

					<a href="
CONTENT;

if ( \IPS\Dispatcher::i()->controllerLocation == 'admin' ):
$return .= <<<CONTENT

CONTENT;

if ( method_exists( $location, 'acpUrl' ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $location->acpUrl(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $location->url()->makeSafeForAcp(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $location->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" target="_blank" class="ipsType_blendLinks">
						
CONTENT;

if ( isset( $location::$icon ) ):
$return .= <<<CONTENT
<i class="fa fa-
CONTENT;
$return .= htmlspecialchars( $location::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( isset( $location::$title ) ):
$return .= <<<CONTENT
title="
CONTENT;

$val = "{$location::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip
CONTENT;

endif;
$return .= <<<CONTENT
></i> 
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $location instanceof \IPS\Content\Item ):
$return .= <<<CONTENT

							
CONTENT;
$return .= htmlspecialchars( $location->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

elseif ( $location instanceof \IPS\Node\Model ):
$return .= <<<CONTENT

							
CONTENT;
$return .= htmlspecialchars( $location->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;
$return .= htmlspecialchars( $location->item()->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</a>
				
CONTENT;

elseif ( $location instanceof \IPS\Http\Url ):
$return .= <<<CONTENT

					<a href="
CONTENT;

if ( \IPS\Dispatcher::i()->controllerLocation == 'admin' ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $location->makeSafeForAcp(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $location, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" class="ipsType_blendLinks" target="_blank"
CONTENT;

if ( $truncateLinks ):
$return .= <<<CONTENT
 title="
CONTENT;
$return .= htmlspecialchars( $location, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
						
CONTENT;

if ( $truncateLinks ):
$return .= <<<CONTENT

							
CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $location ), '0', "60" ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $location ) ) > "60" ) ? '&hellip;' : '' );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;
$return .= htmlspecialchars( $location, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>

CONTENT;

else:
$return .= <<<CONTENT

	<p class="">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'attach_locations_empty', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function bdayForm_day( $name, $value, $error='' ) {
		$return = '';
		$return .= <<<CONTENT


<select name="bday[day]">
	<option value='0' 
CONTENT;

if ( $value['day'] == 0  ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
></option>
	
CONTENT;

foreach ( range( 1, 31 ) as $day ):
$return .= <<<CONTENT

		<option value='
CONTENT;
$return .= htmlspecialchars( $day, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $value['day'] == $day  ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $day, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</select>

CONTENT;

		return $return;
}

	function bdayForm_month( $name, $value, $error='' ) {
		$return = '';
		$return .= <<<CONTENT


<select name="bday[month]">
	<option value='0' 
CONTENT;

if ( $value['month'] == 0  ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
></option>
	
CONTENT;

foreach ( range( 1, 12 ) as $month ):
$return .= <<<CONTENT

		<option value='
CONTENT;
$return .= htmlspecialchars( $month, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $value['month'] == $month  ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::create()->setDate( 2000, $month, 15 )->strFormat('%B'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</select>


CONTENT;

		return $return;
}

	function bdayForm_year( $name, $value, $error='' ) {
		$return = '';
		$return .= <<<CONTENT


<select name="bday[year]">
	<option value='0'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'not_telling', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
	
CONTENT;

foreach ( array_reverse( range( date('Y') - 150, date('Y') ) ) as $year ):
$return .= <<<CONTENT

		<option value='
CONTENT;
$return .= htmlspecialchars( $year, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $value['year'] == $year  ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $year, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</select>

CONTENT;

		return $return;
}

	function ipLookup( $url, $geolocation, $map, $hostName, $counts ) {
		$return = '';
		$return .= <<<CONTENT


<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_address_info', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
<div class='ipsPad ipsAreaBackground_light cIPInfo'>
	
CONTENT;

if ( $geolocation or $hostName ):
$return .= <<<CONTENT

		<div class='ipsColumns ipsColumns_noSpacing ipsColumns_collapsePhone'>
			<div class='ipsColumn ipsColumn_wide ipsAreaBackground_light'>
				<div class='ipsPad cIPInfo_map'>
					
CONTENT;

if ( $hostName ):
$return .= <<<CONTENT

						<p>
CONTENT;

$sprintf = array($hostName); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_geolocation_hostname', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $geolocation ):
$return .= <<<CONTENT

						
CONTENT;

if ( $map ):
$return .= <<<CONTENT

							{$map}
							<br>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<p>{$geolocation}</p>
						<p class="ipsType_light ipsType_small"><i class="fa fa-info-circle"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_geolocation_info', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
			<div class='ipsColumn ipsColumn_fluid'>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class="ipsGrid ipsGrid_collapsePhone ipsAreaBackground_reset">
		
CONTENT;

foreach ( $counts as $key => $value ):
$return .= <<<CONTENT

			
CONTENT;

if ( $value ):
$return .= <<<CONTENT

				<div class='ipsGrid_span4 ipsPad ipsType_center'>
					<a href="
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( 'area', $key ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsType_blendLinks">
						<span class='ipsType_veryLarge cIPInfo_value'>
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span><br>
						<p class='ipsType_reset ipsTruncate ipsTruncate_line ipsType_minorHeading'>
CONTENT;

$val = "ipAddresses__{$key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					</a>
				</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsGrid_span4 ipsPad ipsType_center ipsType_light ipsFaded'>
					<span class='ipsType_veryLarge cIPInfo_value'>
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span><br>
					<p class='ipsType_reset ipsTruncate ipsTruncate_line ipsType_minorHeading'>
CONTENT;

$val = "ipAddresses__{$key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( $geolocation ):
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function messengerQuota( $member, $count ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $member->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging', 'front' ) ) AND $member->group['g_max_messages'] > 0 ):
$return .= <<<CONTENT

	<div class='ipsGrid_span6 ipsResponsive_hidePhone'>
		<div class='ipsPos_right ipsType_right' data-role="quotaTooltip" data-ipsTooltip data-ipsTooltip-label="
CONTENT;

$sprintf = array($member->group['g_max_messages']); $pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_quota', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf, 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
">
			
CONTENT;

$percent = floor( 100 / $member->group['g_max_messages'] * $count );
$return .= <<<CONTENT

			<span class="ipsAttachment_progress"><span data-role='quotaWidth' style='width: 
CONTENT;

$return .= htmlspecialchars( $percent > 100 ? 100 : $percent, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
%'></span></span><br>
			<span class='ipsType_light ipsResponsive_hidePhone'>
CONTENT;

$sprintf = array($percent); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_quota_short', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function notificationLabel( $key, $data ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $data['icon'] ):
$return .= <<<CONTENT

	<i class="fa fa-
CONTENT;
$return .= htmlspecialchars( $data['icon'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></i>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

$val = "{$key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

		return $return;
}}