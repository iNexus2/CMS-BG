<?php
namespace IPS\Theme\Cache;
class class_core_global_global extends \IPS\Theme\Template
{
	public $cache_key = 'a8d8daeacb221d8aff48629a46e239b2';
	function advertisementImage( $advertisement, $acpLink=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $advertisement->_images ) ):
$return .= <<<CONTENT

<div class='ipsAdvertisement ipsSpacer_both ipsSpacer_half'>
	<ul class='ipsList_inline ipsType_center ipsList_reset ipsList_noSpacing'>
		<li class='ipsAdvertisement_large ipsResponsive_showDesktop ipsResponsive_inlineBlock ipsAreaBackground_light'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				<a href='
CONTENT;

if ( $acpLink ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $acpLink->makeSafeForAcp(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=redirect&do=advertisement&ad=$advertisement->id" . "&csrfKey=" . \IPS\Session::i()->csrfKey, "front", "", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $advertisement->new_window ):
$return .= <<<CONTENT
target='_blank'
CONTENT;

endif;
$return .= <<<CONTENT
 rel='nofollow noopener noreferrer'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<img src='
CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['large'] )->url;
$return .= <<<CONTENT
' alt="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'advertisement_alt', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsImage ipsContained'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
		
CONTENT;

if ( !$acpLink  ):
$return .= <<<CONTENT

		<li class='ipsAdvertisement_medium ipsResponsive_showTablet ipsResponsive_inlineBlock ipsAreaBackground_light'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				<a href='
CONTENT;

if ( $acpLink ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $acpLink->makeSafeForAcp(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=redirect&do=advertisement&ad=$advertisement->id" . "&csrfKey=" . \IPS\Session::i()->csrfKey, "front", "", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $advertisement->new_window ):
$return .= <<<CONTENT
target='_blank'
CONTENT;

endif;
$return .= <<<CONTENT
 rel='nofollow noopener noreferrer'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<img src='
CONTENT;

if ( !empty( $advertisement->_images['medium'] ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['medium'] )->url;
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['large'] )->url;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' alt="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'advertisement_alt', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsImage ipsContained'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>

		<li class='ipsAdvertisement_small ipsResponsive_showPhone ipsResponsive_inlineBlock ipsAreaBackground_light'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				<a href='
CONTENT;

if ( $acpLink ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $acpLink->makeSafeForAcp(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=redirect&do=advertisement&ad=$advertisement->id" . "&csrfKey=" . \IPS\Session::i()->csrfKey, "front", "", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $advertisement->new_window ):
$return .= <<<CONTENT
target='_blank'
CONTENT;

endif;
$return .= <<<CONTENT
 rel='nofollow noopener noreferrer'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<img src='
CONTENT;

if ( !empty( $advertisement->_images['small'] ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['small'] )->url;
$return .= <<<CONTENT

CONTENT;

elseif ( !empty( $advertisement->_images['medium'] ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['medium'] )->url;
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['large'] )->url;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' alt="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'advertisement_alt', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsImage ipsContained'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>
	
CONTENT;

if ( $acpLink ):
$return .= <<<CONTENT

		<div class="ipsType_center ipsType_small"><a href="
CONTENT;
$return .= htmlspecialchars( $acpLink->makeSafeForAcp(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $acpLink, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
	
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

	function basicUrl( $url, $newWindow=TRUE, $title=NULL, $wordbreak=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $wordbreak ):
$return .= <<<CONTENT
<div class='ipsType_break ipsContained'>
CONTENT;

endif;
$return .= <<<CONTENT
<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

if ( $newWindow === TRUE ):
$return .= <<<CONTENT
 target='_blank'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

if ( $title ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
CONTENT;

if ( $wordbreak ):
$return .= <<<CONTENT
</div>
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function chart( $chart, $type, $options, $format=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<table class="ipsTable" data-ipsChart data-ipsChart-type="
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsChart-extraOptions='{$options}' 
CONTENT;

if ( $format ):
$return .= <<<CONTENT
data-ipsChart-format='
CONTENT;
$return .= htmlspecialchars( $format, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
	<thead>
		<tr>
			
CONTENT;

foreach ( $chart->headers as $data ):
$return .= <<<CONTENT

				<th data-colType="
CONTENT;
$return .= htmlspecialchars( $data['type'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $data['label'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</th>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</tr>
	</thead>
	<tbody>
		
CONTENT;

foreach ( $chart->rows as $row ):
$return .= <<<CONTENT

			<tr>
				
CONTENT;

foreach ( $row as $value ):
$return .= <<<CONTENT

					<td>
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</td>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</tr>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</tbody>
</table>
<div></div>
CONTENT;

		return $return;
}

	function dynamicChart( $chart, $html ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsChart' data-controller='core.admin.core.dynamicChart' data-chart-url='
CONTENT;
$return .= htmlspecialchars( $chart->baseURL, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-chart-identifier='
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-chart-type="
CONTENT;
$return .= htmlspecialchars( $chart->type, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-chart-timescale="
CONTENT;
$return .= htmlspecialchars( $chart->timescale, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<div class='ipsPad ipsAreaBackground ipsClearfix'>
		
CONTENT;

if ( $chart->title ):
$return .= <<<CONTENT

			<h2 class='ipsType_sectionHead'>
CONTENT;
$return .= htmlspecialchars( $chart->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<ul class='ipsList_inline'>
			<li data-role="groupingButtons">
				<span class="ipsButton_split ipsClearfix">
					
CONTENT;

foreach ( array( 'daily', 'weekly', 'monthly' ) as $k ):
$return .= <<<CONTENT

						<a class='ipsButton ipsButton_verySmall 
CONTENT;

if ( $chart->type == 'Table' ):
$return .= <<<CONTENT
ipsButton_disabled ipsButton_veryLight
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $chart->timescale == $k ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_veryLight
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' href="
CONTENT;
$return .= htmlspecialchars( $chart->url->setQueryString( array( 'timescale' => array( $chart->identifier => $k ), 'noheader' => 1 ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-timescale="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $chart->timescale == $k ):
$return .= <<<CONTENT
data-selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$val = "stats_date_group_$k"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</span>
			</li>
			<li class="ipsClearfix">
				<a data-action='chartDate' data-ipsMenu data-ipsMenu-closeOnBlur='false' data-ipsMenu-closeOnClick='false' id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
Date' href="#" class="ipsButton ipsButton_verySmall ipsButton_veryLight"><i class='fa fa-calendar'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_date_range', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
				<div id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
Date_menu' class='ipsMenu ipsMenu_normal ipsHide ipsPad'>
					<form accept-charset='utf-8' action="
CONTENT;
$return .= htmlspecialchars( $chart->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-role="dateForm" data-ipsForm>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->date( 'start', $chart->start ? $chart->start->localeDate() : NULL, FALSE, NULL, NULL, FALSE, FALSE, NULL, NULL, array(), TRUE, 'ipsField_fullWidth', \IPS\Member::loggedIn()->language()->addToStack('stats_start_date') );
$return .= <<<CONTENT

						<br><br>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->date( 'end', $chart->start ? $chart->start->localeDate() : NULL, FALSE, NULL, NULL, FALSE, FALSE, NULL, NULL, array(), TRUE, 'ipsField_fullWidth', \IPS\Member::loggedIn()->language()->addToStack('stats_end_date') );
$return .= <<<CONTENT

						<br><br>
						<button type="submit" class="ipsButton ipsButton_primary ipsButton_fullWidth" data-role="updateDate">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
					</form>
				</div>
			</li>
			
CONTENT;

if ( count( $chart->availableFilters ) > 0 ):
$return .= <<<CONTENT

				<li>
					<a data-action="chartFilter" data-ipsMenu data-ipsMenu-selectable data-ipsMenu-closeOnClick='false' id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
Filter' href="#" class="ipsButton ipsButton_verySmall ipsButton_veryLight"><i class='fa fa-filter'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_chart_filters', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
					<ul id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
Filter_menu' class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' data-role='filterMenu'>
						
CONTENT;

foreach ( $chart->availableFilters as $f => $name ):
$return .= <<<CONTENT

							<li class='ipsMenu_item 
CONTENT;

if ( in_array( $f, $chart->currentFilters ) ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $f, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href="
CONTENT;
$return .= htmlspecialchars( $chart->flipUrlFilter( $f ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( count( $chart->availableTypes ) > 1 ):
$return .= <<<CONTENT

				<li class='ipsPos_right'>
					<span class="ipsButton_split ipsClearfix">
						
CONTENT;

foreach ( $chart->availableTypes as $t ):
$return .= <<<CONTENT

							<a class='ipsButton ipsButton_verySmall 
CONTENT;

if ( $chart->type == $t ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_veryLight
CONTENT;

endif;
$return .= <<<CONTENT
' href="
CONTENT;
$return .= htmlspecialchars( $chart->url->setQueryString( array( 'type' => array( $chart->identifier => $t ), 'noheader' => 1 ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsTooltip title='
CONTENT;

$val = "chart_{$t}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-type='
CONTENT;
$return .= htmlspecialchars( $t, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $chart->type == $t ):
$return .= <<<CONTENT
data-selected
CONTENT;

endif;
$return .= <<<CONTENT
>
								
CONTENT;

if ( $t === 'Table' ):
$return .= <<<CONTENT

									<i class="fa fa-table"></i>
								
CONTENT;

elseif ( $t === 'LineChart' ):
$return .= <<<CONTENT

									<i class="fa fa-line-chart"></i>
								
CONTENT;

elseif ( $t === 'ColumnChart' ):
$return .= <<<CONTENT

									<i class="fa fa-bar-chart"></i>
								
CONTENT;

elseif ( $t === 'BarChart' ):
$return .= <<<CONTENT

									<i class="fa fa-bar-chart fa-rotate-90"></i>
								
CONTENT;

elseif ( $t === 'PieChart' ):
$return .= <<<CONTENT

									<i class="fa fa-pie-chart"></i>
								
CONTENT;

elseif ( $t === 'GeoChart' ):
$return .= <<<CONTENT

									<i class="fa fa-globe"></i>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</a>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</span>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
		
	</div>
	<div class='ipsChart_chart ipsPad' data-role="chart">
		{$html}
	</div>
</div>
CONTENT;

		return $return;
}

	function googleMap( $linkUrl, $imageUrl, $lat=NULL, $long=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $lat and $long ):
$return .= <<<CONTENT

	<span itemscope itemtype='http://schema.org/GeoCoordinates'>
		<meta itemprop='latitude' content='
CONTENT;
$return .= htmlspecialchars( $lat, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<meta itemprop='longitude' content='
CONTENT;
$return .= htmlspecialchars( $long, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<a href='
CONTENT;
$return .= htmlspecialchars( $linkUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_blank' itemprop='url' rel='noopener noreferrer'><img src='
CONTENT;
$return .= htmlspecialchars( $imageUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='' class='ipsImage'></a>
	</span>

CONTENT;

else:
$return .= <<<CONTENT

	<a href='
CONTENT;
$return .= htmlspecialchars( $linkUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_blank' itemprop='url' rel='noopener noreferrer'><img src='
CONTENT;
$return .= htmlspecialchars( $imageUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='' class='ipsImage'></a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function includeCSS(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( array_unique( \IPS\Output::i()->cssFiles, SORT_STRING ) as $file ):
$return .= <<<CONTENT

	<link rel='stylesheet' href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::external( $file )->setQueryString( 'v', \IPS\SUITE_UNIQUE_KEY ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' media='all'>

CONTENT;

endforeach;
$return .= <<<CONTENT



CONTENT;

$customCss = \IPS\Theme::i()->css( 'custom.css', 'core', 'front' );
$return .= <<<CONTENT


CONTENT;

foreach ( $customCss as $css ):
$return .= <<<CONTENT

<link rel='stylesheet' href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::external( $css )->setQueryString( 'v', \IPS\SUITE_UNIQUE_KEY ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' media='all'>

CONTENT;

endforeach;
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Output::i()->headCss ):
$return .= <<<CONTENT

<style type='text/css'>
	
CONTENT;

$return .= \IPS\Output::i()->headCss;
$return .= <<<CONTENT

</style>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function includeJS(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	<script type='text/javascript'>
		var ipsDebug = 
CONTENT;

if ( ( \IPS\IN_DEV and \IPS\DEV_DEBUG_JS ) or \IPS\DEBUG_JS ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
;		
	
CONTENT;

if ( \IPS\IN_DEV ):
$return .= <<<CONTENT

		var CKEDITOR_BASEPATH = '
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "applications/core/dev/ckeditor", "none", "", array(), \IPS\Http\Url::PROTOCOL_RELATIVE ) );
$return .= <<<CONTENT
/';
	
CONTENT;

else:
$return .= <<<CONTENT

		var CKEDITOR_BASEPATH = '
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "applications/core/interface/ckeditor/ckeditor", "none", "", array(), \IPS\Http\Url::PROTOCOL_RELATIVE ) );
$return .= <<<CONTENT
/';
	
CONTENT;

endif;
$return .= <<<CONTENT

		var ipsSettings = {
			
CONTENT;

if ( \IPS\Dispatcher::hasInstance() and \IPS\Dispatcher::i()->controllerLocation == 'admin' ):
$return .= <<<CONTENT

			adsess: "
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->adsess, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\COOKIE_DOMAIN !== NULL ):
$return .= <<<CONTENT

			cookie_domain: "
CONTENT;

$return .= htmlspecialchars( \IPS\COOKIE_DOMAIN, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\COOKIE_PATH !== NULL ):
$return .= <<<CONTENT

			cookie_path: "
CONTENT;

$return .= htmlspecialchars( \IPS\COOKIE_PATH, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\COOKIE_PREFIX !== NULL ):
$return .= <<<CONTENT

			cookie_prefix: "
CONTENT;

$return .= htmlspecialchars( \IPS\COOKIE_PREFIX, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( mb_substr( \IPS\Settings::i()->base_url, 0, 5 ) == 'https' AND \IPS\COOKIE_BYPASS_SSLONLY !== TRUE ):
$return .= <<<CONTENT

			cookie_ssl: true,
			
CONTENT;

else:
$return .= <<<CONTENT

			cookie_ssl: false,
			
CONTENT;

endif;
$return .= <<<CONTENT

			imgURL: "
CONTENT;

$return .= \IPS\Theme::i()->resource( "./", "", 'front', false );
$return .= <<<CONTENT
",
			baseURL: "
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::baseUrl( \IPS\Http\Url::PROTOCOL_RELATIVE ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			jsURL: "
CONTENT;

$return .= htmlspecialchars( rtrim( \IPS\Http\Url::baseUrl( \IPS\Http\Url::PROTOCOL_RELATIVE ), '/' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
/applications/core/interface/js/js.php",
			csrfKey: "
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			antiCache: "
CONTENT;

$return .= htmlspecialchars( \IPS\SUITE_UNIQUE_KEY, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			disableNotificationSounds: 
CONTENT;

if ( \IPS\Member::loggedIn()->members_bitoptions['disable_notification_sounds'] ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
,
			useCompiledFiles: 
CONTENT;

if ( \IPS\IN_DEV ):
$return .= <<<CONTENT
false
CONTENT;

else:
$return .= <<<CONTENT
true
CONTENT;

endif;
$return .= <<<CONTENT
,
			links_external: 
CONTENT;

$return .= \IPS\Settings::i()->links_external;
$return .= <<<CONTENT
,
			memberID: 
CONTENT;

$return .= htmlspecialchars( ( \IPS\Member::loggedIn()->member_id ) ? \IPS\Member::loggedIn()->member_id : 0, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

		};
	</script>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

foreach ( array_unique( array_filter( \IPS\Output::i()->jsFiles ), SORT_STRING ) as $js ):
$return .= <<<CONTENT


CONTENT;

$js = \IPS\Http\Url::external( $js );
$return .= <<<CONTENT

<script type='text/javascript' src='
CONTENT;

if ( $js->data['host'] == parse_url( \IPS\Settings::i()->base_url, PHP_URL_HOST ) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( $js->setQueryString( 'v', \IPS\SUITE_UNIQUE_KEY ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( $js, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ips></script>

CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

foreach ( array_unique( \IPS\Output::i()->jsFilesAsync, SORT_STRING ) as $js ):
$return .= <<<CONTENT

<script type="text/javascript" src="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::external( $js )->setQueryString( 'v', \IPS\SUITE_UNIQUE_KEY ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" async="true"></script>

CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() and ( count( \IPS\Output::i()->jsVars ) || \IPS\Output::i()->headJs) ):
$return .= <<<CONTENT

	<script type='text/javascript'>
		
CONTENT;

foreach ( \IPS\Output::i()->jsVars as $k => $v ):
$return .= <<<CONTENT

			ips.setSetting( '
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
', 
CONTENT;

if ( ! is_array( $v ) ):
$return .= <<<CONTENT
jQuery.parseJSON('
CONTENT;

$return .= json_encode( $v );
$return .= <<<CONTENT
')
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= json_encode( $v );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 );
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Output::i()->headJs;
$return .= <<<CONTENT

	</script>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Theme::i()->settings['ipsf_countdown'] ):
$return .= <<<CONTENT

<script src='
CONTENT;

$return .= \IPS\Theme::i()->resource( "ipsfocus/jquery.countdown.min.js", "core", 'front', false );
$return .= <<<CONTENT
'></script>

CONTENT;

endif;
$return .= <<<CONTENT


<script type='text/javascript'>


CONTENT;

if ( (\IPS\Theme::i()->settings['ipsf_backgroundType'] === 'ipsfocus_backgroundPicker') AND (\IPS\Theme::i()->settings['pickerGroups'] === "" OR \IPS\Member::loggedIn()->inGroup( explode(',', \IPS\Theme::i()->settings['pickerGroups']) ) )  ):
$return .= <<<CONTENT

    var backgroundCookie = ips.utils.cookie.get( '
CONTENT;

$return .= \IPS\Theme::i()->settings['ifBg_cookiePrefix'];
$return .= <<<CONTENT
_ifbg_class' );
    if ( ( backgroundCookie != null ))	{
        $("html").addClass('' + backgroundCookie + '');
    }
    else{
        $("html").addClass('ipsfocus_bg
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsf_pickerDefault'];
$return .= <<<CONTENT
');
    }

CONTENT;

else:
$return .= <<<CONTENT

        $("html").addClass('ipsfocus_bg
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsf_pickerDefault'];
$return .= <<<CONTENT
');

CONTENT;

endif;
$return .= <<<CONTENT


$(document).ready(function(){


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->js_general(  );
$return .= <<<CONTENT



CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->js_navigationMore(  );
$return .= <<<CONTENT

  

CONTENT;

if ( \IPS\Theme::i()->settings['ipsf_backgroundType'] === 'ipsfocus_backgroundPicker' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->js_backgroundPicker(  );
endif;
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Theme::i()->settings['ipsf_christmas'] ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->js_christmas(  );
endif;
$return .= <<<CONTENT

 

CONTENT;

if ( (\IPS\Theme::i()->settings['globalMessage']) AND (\IPS\Theme::i()->settings['globalDismiss']) ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->js_globalMessage(  );
endif;
$return .= <<<CONTENT

 
});
</script>
CONTENT;

		return $return;
}

	function includeMeta(  ) {
		$return = '';
		$return .= <<<CONTENT

<meta charset="utf-8">

CONTENT;

if ( \IPS\Theme::i()->settings['responsive'] ):
$return .= <<<CONTENT

	<meta name="viewport" content="width=device-width, initial-scale=1">

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( !isset( \IPS\Output::i()->metaTags['og:image'] ) and \IPS\Theme::i()->logo_sharer  ):
$return .= <<<CONTENT

	<meta property="og:image" content="
CONTENT;

$return .= \IPS\Theme::i()->logo_sharer;
$return .= <<<CONTENT
">

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

foreach ( \IPS\Output::i()->metaTags as $name => $content ):
$return .= <<<CONTENT

	
CONTENT;

if ( $name == 'canonical' ):
$return .= <<<CONTENT

		<link rel="canonical" href="
CONTENT;
$return .= htmlspecialchars( $content, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( $name != 'title' ):
$return .= <<<CONTENT

			
CONTENT;

if ( is_array( $content )  ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $content as $_value  ):
$return .= <<<CONTENT

					<meta 
CONTENT;

if ( mb_substr( $name, 0, 3 ) === 'og:' or mb_substr( $name, 0, 3 ) === 'fb:' ):
$return .= <<<CONTENT
property
CONTENT;

else:
$return .= <<<CONTENT
name
CONTENT;

endif;
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" content="
CONTENT;
$return .= htmlspecialchars( $_value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				<meta 
CONTENT;

if ( mb_substr( $name, 0, 3 ) === 'og:' or mb_substr( $name, 0, 3 ) === 'fb:' ):
$return .= <<<CONTENT
property
CONTENT;

else:
$return .= <<<CONTENT
name
CONTENT;

endif;
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" content="
CONTENT;
$return .= htmlspecialchars( $content, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

<meta name="theme-color" content="
CONTENT;

$return .= \IPS\Theme::i()->settings['header'];
$return .= <<<CONTENT
">

CONTENT;

foreach ( \IPS\Output::i()->linkTags as $type => $href ):
$return .= <<<CONTENT
<link rel="
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" href="
CONTENT;

$return .= htmlspecialchars( $href, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" />
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

foreach ( \IPS\Output::i()->rssFeeds as $title => $url ):
$return .= <<<CONTENT
<link rel="alternate" type="application/rss+xml" title="
CONTENT;

$val = "{$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" />
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Output::i()->base ):
$return .= <<<CONTENT

	<base target="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->base, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function js_backgroundPicker(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['pickerGroups'] === "" OR \IPS\Member::loggedIn()->inGroup( explode(',', \IPS\Theme::i()->settings['pickerGroups']) )  ):
$return .= <<<CONTENT


    $(".ipsfocus_toggleBgPicker").click(function( event ) {
        event.preventDefault();
        $("#ipsf_pickerWrap").slideToggle();
    });

    $("#ipsf_picker span").click(function(){
        var backgroundClass = $(this).attr("data-backgroundClass");
        $("html").removeClass("ipsfocus_bg1 ipsfocus_bg2 ipsfocus_bg3 ipsfocus_bg4 ipsfocus_bg5 ipsfocus_bg6").addClass(backgroundClass);

        ips.utils.cookie.set( '
CONTENT;

$return .= \IPS\Theme::i()->settings['ifBg_cookiePrefix'];
$return .= <<<CONTENT
_ifbg_class', '' + backgroundClass + '', true );

    });


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function js_christmas(  ) {
		$return = '';
		$return .= <<<CONTENT

$(".ipsfocus_christmas").append("<div class='ipsfocus_snow'><i class='snowFlake'></i></div><div class='ipsfocus_snowBottom'></div>");

var snowlist = $('.ipsfocus_snow');
for ( i = 0; i < 60;i++){
      snowlist.find('.snowFlake:first').clone().appendTo(snowlist);
}
CONTENT;

		return $return;
}

	function js_general(  ) {
		$return = '';
		$return .= <<<CONTENT

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};

var detectDevice = function(){
	var grabPageWidth = $('body').css('min-width');
	return parseFloat(grabPageWidth, 10);
}
detectDevice();
/*
	Desktop = 30
	Tablet = 20
	Mobile = 10
*/


// Relocate search bar
var relocateSearch = function(){
	if (detectDevice() > 25){
		$("#elSearch").prependTo("#searchWrap");
	} else {
		$("#elSearch").prependTo("#respSearch");
	}
}
relocateSearch();


var resizeWindow = function(){
    var wClasses = "wDesktop wTablet wMobile"
	if(detectDevice() === 30){
		$("body").removeClass(wClasses).addClass("wDesktop");
	} else if(detectDevice() === 20){
		$("body").removeClass(wClasses).addClass("wTablet");
	} else {
		$("body").removeClass(wClasses).addClass("wMobile");
	}
}
resizeWindow();


// Bug fix: The resize event is triggered when tablets and mobiles are scrolled, breaking the search bar in Android and Chrome
var cachedDevice = detectDevice();

// Run width functions after 1000ms pause
$(window).resize(debounce(function(){
	var newDevice = detectDevice();
    if(newDevice !== cachedDevice){
        
        resizeWindow();
        relocateSearch();
        
        cachedDevice = newDevice;
    }
}, 1000));
	

// Hide post controls as a guest to prevent empty bar
$(".cPost .ipsComment_controls li.ipsHide:only-child").parent().hide();

// Hide gallery descriptions if they don't exist
if ($('.galleryDescription .ipsType_richText').is(':empty')){
    $(".galleryDescription").hide();
}

// Hide empty divs in ipsPageHeader to prevent unnecessary margins
$('.ipsPageHeader .ipsSpacer_top').each(function(){
    if(!/[\S]/.test($(this).html())) { 
        $(this).hide();
    }
});
      
      
// Toggle class
$('[data-toggleClass]').on( "click", function(event) {
    event.preventDefault();
    var toggleClass = $(this).attr('data-toggleClass');
    $('html').toggleClass(toggleClass);
});
CONTENT;

		return $return;
}

	function js_globalMessage(  ) {
		$return = '';
		$return .= <<<CONTENT

var dismissCookie = ips.utils.cookie.get( 'focusMessage_
CONTENT;

$return .= \IPS\Theme::i()->settings['globalMessageCookie'];
$return .= <<<CONTENT
' );

if ( dismissCookie != 'dismissed' )	{
    $(".ipsfocus_globalMessage").addClass('displayGlobalMessage');
}

$(".ipsfocus_dismissGlobalMessage").click(function( event ) {
    event.preventDefault();
    $(".ipsfocus_globalMessage").slideUp();
    ips.utils.cookie.set( 'focusMessage_
CONTENT;

$return .= \IPS\Theme::i()->settings['globalMessageCookie'];
$return .= <<<CONTENT
', 'dismissed', true );
});
CONTENT;

		return $return;
}

	function js_navigationMore(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function lkeyWarning(  ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $lkeyWarning = \IPS\Output::i()->licenseKeyWarning() ):
$return .= <<<CONTENT

	
CONTENT;

if ( $lkeyWarning == 'none' ):
$return .= <<<CONTENT

		<div class="ipsMessage ipsMessage_error" id='elLicenseKey'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'license_error_none', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			<span class="ipsType_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'license_error_admin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		</div>
	
CONTENT;

elseif ( $lkeyWarning == 'expired' && !isset( \IPS\Request::i()->cookie['licenseDismiss'] ) ):
$return .= <<<CONTENT

		<div class="ipsMessage ipsMessage_general" id='elLicenseKey' data-controller='core.global.core.license'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'license_error_expired', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			<ul class='ipsList_inline'>
				<li>
					<a href='
CONTENT;

$return .= \IPS\Http\Url::ips( "docs/renew_my_license" );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_veryLight'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'license_renew_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
				<li>
					<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=settings&controller=licensekey&do=refresh", "admin", "", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_veryLight'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'license_check_again', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
				<li>
					<span class="ipsType_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'license_error_admin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</li>
			</ul>
			<a href='#' data-role='closeMessage' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'license_dismiss', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>&times;</a>
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

	function message( $message, $type, $debug=NULL, $parse=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $debug !== NULL ):
$return .= <<<CONTENT

	<div class="ipsMessage ipsMessage_
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

if ( $parse ):
$return .= <<<CONTENT

			
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			{$message}
		
CONTENT;

endif;
$return .= <<<CONTENT

		<br><br>
		<pre>
CONTENT;
$return .= htmlspecialchars( $debug, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<p class="ipsMessage ipsMessage_
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

if ( $parse ):
$return .= <<<CONTENT

			
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			{$message}
		
CONTENT;

endif;
$return .= <<<CONTENT

	</p>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function miniPagination( $baseUrl, $pages, $activePage=1, $perPage=25, $ajax=FALSE, $pageParam='page' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $pages > 1 ):
$return .= <<<CONTENT

	<ul class='ipsPagination ipsPagination_mini' id='elPagination_
CONTENT;

$return .= htmlspecialchars( md5($baseUrl), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

foreach ( range( 1, ( 4 > $pages ) ? $pages : 4 ) as $i ):
$return .= <<<CONTENT

			<li class='ipsPagination_page'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $i ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$sprintf = array($i); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_page_x', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

if ( $pages > 4 ):
$return .= <<<CONTENT

			<li class='ipsPagination_last'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $pages ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'last_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <i class='fa fa-caret-right'></i></a></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function multipleRedirect( $url ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsRedirect_manualButton">
	<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'mr' => '0', '_mrReset' => 1 ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsButton ipsButton_primary">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</div>
<div data-controller="core.global.core.multipleRedirect" data-url="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<div class="ipsRedirect ipsHide ipsPad">
		<div class="ipsLoading ipsRedirect_loading" data-role="loadingIcon"></div>
		<div class="ipsRedirect_progress ipsHide" data-role="progressBarContainer">
			<div class="ipsProgressBar ipsProgressBar_animated">
				<div class="ipsProgressBar_progress" data-role="progressBar"></div>
			</div>
		</div>
		<span data-role="message"></span>
	</div>
</div>
CONTENT;

		return $return;
}

	function pagination( $baseUrl, $pages, $activePage=1, $perPage=25, $ajax=TRUE, $pageParam='page', $simple=false ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $activePage > 1 || $pages > 1 ):
$return .= <<<CONTENT

	
CONTENT;

$uniqId = uniqid();
$return .= <<<CONTENT

	<ul class='ipsPagination' id='elPagination_
CONTENT;

$return .= htmlspecialchars( md5($baseUrl), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $uniqId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-pages='
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $ajax and ( \IPS\Theme::i()->settings['ajax_pagination'] or \IPS\Request::i()->isAjax()) ):
$return .= <<<CONTENT
data-ipsPagination 
CONTENT;

if ( $pageParam != 'page' ):
$return .= <<<CONTENT
data-ipsPagination-pageParam='
CONTENT;
$return .= htmlspecialchars( $pageParam, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsPagination-pages="
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsPagination-perPage='
CONTENT;
$return .= htmlspecialchars( $perPage, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
		
CONTENT;

if ( $simple ):
$return .= <<<CONTENT

			
CONTENT;

if ( $activePage > 1 ):
$return .= <<<CONTENT

				<li class='ipsPagination_prev'><a href='
CONTENT;

if ( $activePage - 1 === 1 ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->stripQueryString( $pageParam ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $activePage - 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' rel="prev" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage - 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $activePage < $pages ):
$return .= <<<CONTENT

				<li class='ipsPagination_next'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $activePage + 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="next" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage + 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

if ( $activePage != 1 ):
$return .= <<<CONTENT

				<li class='ipsPagination_first'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->stripQueryString( $pageParam ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="first" data-page='1' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-double-left'></i></a></li>
				<li class='ipsPagination_prev'><a href='
CONTENT;

if ( $activePage - 1 === 1 ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->stripQueryString( $pageParam ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $activePage - 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' rel="prev" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage - 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

foreach ( range( ( ( $activePage - 5 ) > 0 ) ? ( $activePage - 5 ) : 1, $activePage - 1 ) as $idx => $i ):
$return .= <<<CONTENT

					<li class='ipsPagination_page'><a href='
CONTENT;

if ( $i === 1 ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->stripQueryString( $pageParam ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $i ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-page='
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				<li class='ipsPagination_first ipsPagination_inactive'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->stripQueryString( $pageParam ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="first" data-page='1' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-double-left'></i></a></li>
				<li class='ipsPagination_prev ipsPagination_inactive'><a href='
CONTENT;

if ( $activePage - 1 === 1 ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->stripQueryString( $pageParam ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $activePage - 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' rel="prev" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage - 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<li class='ipsPagination_page ipsPagination_active'><a href='
CONTENT;

if ( $activePage === 1 ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->stripQueryString( $pageParam ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $activePage ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-page='
CONTENT;
$return .= htmlspecialchars( $activePage, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $activePage, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

if ( $activePage != $pages ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( range( $activePage + 1, ( ( $activePage + 5 ) > $pages ) ? $pages : ( $activePage + 5 ) ) as $idx => $i ):
$return .= <<<CONTENT

					<li class='ipsPagination_page'><a href='
CONTENT;

if ( $i === 1 ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->stripQueryString( $pageParam ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $i ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-page='
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

				<li class='ipsPagination_next'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $activePage + 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="next" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage + 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li class='ipsPagination_last'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $pages ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="last" data-page='
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'last_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-double-right'></i></a></li>
			
CONTENT;

else:
$return .= <<<CONTENT

				<li class='ipsPagination_next ipsPagination_inactive'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $activePage + 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="next" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage + 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li class='ipsPagination_last ipsPagination_inactive'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( $pageParam, $pages ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="last" data-page='
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'last_page', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-double-right'></i></a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $pages > 1 ):
$return .= <<<CONTENT

				<li class='ipsPagination_pageJump'>
					<a href='#' data-ipsMenu data-ipsMenu-closeOnClick='false' data-ipsMenu-appendTo='#elPagination_
CONTENT;

$return .= htmlspecialchars( md5($baseUrl), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $uniqId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elPagination_
CONTENT;

$return .= htmlspecialchars( md5($baseUrl), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_jump'>
CONTENT;

$sprintf = array($activePage, $pages); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pagination', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i></a>
					<div class='ipsMenu ipsMenu_narrow ipsPad ipsHide' id='elPagination_
CONTENT;

$return .= htmlspecialchars( md5($baseUrl), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_jump_menu'>
						<form accept-charset='utf-8' method='post' action='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( 'page', NULL ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="pageJump">
							<ul class='ipsForm ipsForm_horizontal'>
								<li class='ipsFieldRow'>
									<input type='number' min='1' max='
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'page_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsField_fullWidth' name='
CONTENT;
$return .= htmlspecialchars( $pageParam, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
								</li>
								<li class='ipsFieldRow ipsFieldRow_fullWidth'>
									<input type='submit' class='ipsButton_fullWidth ipsButton ipsButton_verySmall ipsButton_primary' value='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
								</li>
							</ul>
						</form>
					</div>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function poll( $poll, $url ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !isset( \IPS\Request::i()->fetchPoll ) ):
$return .= <<<CONTENT

<section class='ipsBox ipsfocus_reset' data-controller='core.front.core.poll'>

CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $poll->canVote() and \IPS\Request::i()->_poll != 'results' and ( !$poll->getVote() or \IPS\Request::i()->_poll == 'form') and $pollForm = $poll->buildForm() ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT
<h2 class='ipsType_sectionTitle ipsType_reset'>
			
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_close_polls') ):
$return .= <<<CONTENT

				
CONTENT;

if ( ! $poll->poll_closed ):
$return .= <<<CONTENT

					<a class='ipsPos_right ipsType_small' href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'pollStatus', 'value' => 0 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-lock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_close', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

else:
$return .= <<<CONTENT

					<a class='ipsPos_right ipsType_small' href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'pollStatus', 'value' => 1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-unlock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_open', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsType_break'>
				
CONTENT;
$return .= htmlspecialchars( $poll->poll_question, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&nbsp;&nbsp;
				
CONTENT;

if ( $poll->votes ):
$return .= <<<CONTENT
<span class='ipsType_normal ipsType_light'>
CONTENT;

$pluralize = array( $poll->votes ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_num_votes', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT

		<div class='ipsPad ipsClearfix' data-role='pollContents'>
			{$pollForm->customTemplate( array( \IPS\Theme::i()->getTemplate( 'global', 'core', 'global' ), 'pollForm' ), $url )}
		</div>
	
CONTENT;

elseif ( !$poll->canVote() or $poll->getVote() or ( \IPS\Request::i()->_poll == 'results' and $poll->canViewResults() ) ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT
<h2 class='ipsType_sectionTitle ipsType_reset'>
			
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_close_polls') ):
$return .= <<<CONTENT

				
CONTENT;

if ( ! $poll->poll_closed ):
$return .= <<<CONTENT

					<a class='ipsPos_right ipsType_small' href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'pollStatus', 'value' => 0 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-lock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_close', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

else:
$return .= <<<CONTENT

					<a class='ipsPos_right ipsType_small' href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'pollStatus', 'value' => 1 ) )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-unlock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_open', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsType_break'>
				
CONTENT;
$return .= htmlspecialchars( $poll->poll_question, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
&nbsp;&nbsp;
				
CONTENT;

if ( $poll->votes ):
$return .= <<<CONTENT
<span class='ipsType_normal ipsType_light'>
CONTENT;

$pluralize = array( $poll->votes ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_num_votes', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT

		
CONTENT;

if ( $poll->poll_closed ):
$return .= <<<CONTENT

			<div class="ipsMessage ipsMessage_warning">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_closed_for_votes', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsPad ipsClearfix' data-role='pollContents'>
			<ol class='ipsList_reset cPollList'>
				
CONTENT;

foreach ( $poll->choices as $questionId => $question ):
$return .= <<<CONTENT

					<li>
						<h3 class='ipsType_sectionHead'><div class='ipsType_break ipsContained'>
CONTENT;
$return .= htmlspecialchars( $questionId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
. 
CONTENT;
$return .= htmlspecialchars( $question['question'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div></h3>
						<ul class='ipsList_reset cPollList_choices'>
							
CONTENT;

foreach ( $question['choice'] as $k => $choice ):
$return .= <<<CONTENT

								<li class='ipsGrid ipsGrid_collapsePhone'>
									<div class='ipsGrid_span4 ipsType_right ipsType_richText ipsType_break'>
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
									<div class='ipsGrid_span1 ipsType_small'>
										
CONTENT;

if ( $poll->canSeeVoters() && $question['votes'][ $k ] > 0 ):
$return .= <<<CONTENT

											<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=poll&do=voters&id={$poll->pid}&question={$questionId}&option={$k}", null, "", array(), 0 ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_voters', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks' data-ipsTooltip data-ipsDialog data-ipsDialog-size="narrow" data-ipsDialog-title="
CONTENT;
$return .= htmlspecialchars( $choice, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
										
CONTENT;

else:
$return .= <<<CONTENT

											<span class='ipsFaded'>
										
CONTENT;

endif;
$return .= <<<CONTENT

											<i class='fa fa-user'></i> 
CONTENT;
$return .= htmlspecialchars( $question['votes'][ $k ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

if ( $poll->canSeeVoters() && $question['votes'][ $k ] > 0 ):
$return .= <<<CONTENT

											</a>
										
CONTENT;

else:
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

$htmlsprintf = array(\IPS\Http\Url::internal( 'app=core&module=system&controller=login', 'front', 'login' ), \IPS\Http\Url::internal( 'app=core&module=system&controller=register', 'front', 'register' )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_guest', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT

	
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

	function pollForm( $url, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
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

foreach ( $elements as $collection ):
$return .= <<<CONTENT

		<ol class='ipsList_reset cPollList cPollList_questions'>
			
CONTENT;

foreach ( $collection as $idx => $input ):
$return .= <<<CONTENT

				<li class='ipsFieldRow ipsFieldRow_noLabel'>
					<h3 class='ipsType_sectionHead'><div class='ipsType_break ipsContained'>
CONTENT;
$return .= htmlspecialchars( $idx, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
. 
CONTENT;
$return .= htmlspecialchars( $input->label, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div></h3>
					
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

	function pollVoters( $votes ) {
		$return = '';
		$return .= <<<CONTENT

<ul class="ipsGrid ipsGrid_collapsePhone ipsPad">
	
CONTENT;

foreach ( $votes as $vote ):
$return .= <<<CONTENT

		<li class='ipsGrid_span6 ipsPhotoPanel ipsPhotoPanel_mini'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $vote->member_id ), 'mini' );
$return .= <<<CONTENT

			<div class='ipsType_break'>
				<h3 class='ipsType_normal ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $vote->member_id )->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
				<span class="ipsType_light ipsType_medium">
CONTENT;

$val = ( $vote->vote_date instanceof \IPS\DateTime ) ? $vote->vote_date : \IPS\DateTime::ts( $vote->vote_date );$return .= $val->html();
$return .= <<<CONTENT
</span>
			</div>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>
CONTENT;

		return $return;
}

	function prettyprint( $code ) {
		$return = '';
		$return .= <<<CONTENT

<pre class='prettyprint'>
CONTENT;
$return .= htmlspecialchars( $code, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
CONTENT;

		return $return;
}

	function redirect( $url, $message ) {
		$return = '';
		$return .= <<<CONTENT

<!DOCTYPE html>
<html lang="
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->bcp47(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" dir="
CONTENT;

if ( \IPS\Member::loggedIn()->language()->isrtl ):
$return .= <<<CONTENT
rtl
CONTENT;

else:
$return .= <<<CONTENT
ltr
CONTENT;

endif;
$return .= <<<CONTENT
">
	<head>
		<title>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'redirecting', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</title>
		<meta http-equiv="refresh" content="2; url=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeMeta(  );
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeCSS(  );
$return .= <<<CONTENT

	</head>
	<body>
		<p class="ipsMessage ipsMessage_info ipsRedirectMessage">
			<strong>
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong><br>
			<br>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'redirecting_wait', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
$return .= <<<CONTENT

	</body>
</html>
CONTENT;

		return $return;
}

	function textBlock( $message ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsType_normal'>
	{$message}
</div>
<br>


CONTENT;

		return $return;
}

	function truncatedUrl( $url, $newWindow=TRUE, $length=50 ) {
		$return = '';
		$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

if ( $newWindow === TRUE ):
$return .= <<<CONTENT
 target='_blank'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $url ), '0', $length ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $url ) ) > $length ) ? '&hellip;' : '' );
$return .= <<<CONTENT
</a>
CONTENT;

		return $return;
}

	function vineEmbed( $url ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsEmbeddedVideo 
CONTENT;

if ( \IPS\Settings::i()->max_video_width > 0 ):
$return .= <<<CONTENT
ipsEmbeddedVideo_limited
CONTENT;

endif;
$return .= <<<CONTENT
" contenteditable="false"><div><iframe class="vine-embed" src="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
/embed/simple" width="600" height="600" frameborder="0"></iframe><script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script></div></div>
CONTENT;

		return $return;
}

	function wizard( $stepNames, $activeStep, $output, $baseUrl, $showSteps ) {
		$return = '';
		$return .= <<<CONTENT

<div data-ipsWizard>
	
CONTENT;

if ( $showSteps ):
$return .= <<<CONTENT

		<ul class="ipsStepBar ipsClearFix" data-role="wizardStepbar">
			
CONTENT;

$doneSteps = TRUE;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $stepNames as $step => $name ):
$return .= <<<CONTENT

				
CONTENT;

if ( $activeStep == $name ):
$return .= <<<CONTENT

CONTENT;

$doneSteps = FALSE;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsStep 
CONTENT;

if ( $activeStep == $name ):
$return .= <<<CONTENT
ipsStep_active
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
CONTENT;

if ( $doneSteps ):
$return .= <<<CONTENT

						<a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( '_step', $name ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="wizardLink">
					
CONTENT;

else:
$return .= <<<CONTENT

						<span>
					
CONTENT;

endif;
$return .= <<<CONTENT

						<strong class='ipsStep_title'>
CONTENT;

$sprintf = array($step + 1); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'step_number', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong>
						<span class='ipsStep_desc'>
CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
					
CONTENT;

if ( $doneSteps ):
$return .= <<<CONTENT

						</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div data-role="wizardContent">
		{$output}
	</div>
</div>
CONTENT;

		return $return;
}}