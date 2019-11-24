<?php
namespace IPS\Theme\Cache;
class class_core_front__veilon extends \IPS\Theme\Template
{
	public $cache_key = '82e238fb5d63057039aeae7a06229de6';
	function _veilon_body_slider(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['veilon_se'] == '1' and \IPS\Theme::i()->settings['veilon_se_wcs'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['veilon_se_wcs'] ) ) ):
$return .= <<<CONTENT

<div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1000/1000/nightlife/1)"></div>
            <div class="lazyPreloader"><div class="lazyPreloader-wrapper"><div class="lazyPreloader-spinner"></div></div></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1000/1000/nightlife/2)"></div>
            <div class="lazyPreloader"><div class="lazyPreloader-wrapper"><div class="lazyPreloader-spinner"></div></div></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1000/1000/nightlife/3)"></div>
            <div class="lazyPreloader"><div class="lazyPreloader-wrapper"><div class="lazyPreloader-spinner"></div></div></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1000/1000/nightlife/4)"></div>
            <div class="lazyPreloader"><div class="lazyPreloader-wrapper"><div class="lazyPreloader-spinner"></div></div></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1000/1000/nightlife/5)"></div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-white"></div>
        <!-- Add Arrows -->
        <div class="swiper-next"></div>
        <div class="swiper-prev"></div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function _veilon_footer(  ) {
		$return = '';
		$return .= <<<CONTENT

<footer id="secondaryFooter">
<div class="ipsLayout_container">
	<div class="ipsGrid 
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_nav_type'] === 'custom_vertical' ):
$return .= <<<CONTENT
nav_footer
CONTENT;

endif;
$return .= <<<CONTENT
">
			
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_section1'] and \IPS\Theme::i()->settings['veilon_footer_section1_width'] ):
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_wcs1'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['veilon_footer_wcs1'] ) ) ):
$return .= <<<CONTENT

					<div class="
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section1_width'];
$return .= <<<CONTENT
" data-block="1">
						<h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section1_h1'];
$return .= <<<CONTENT
</h2>
						<span class="veilonLeft">				
							
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section1_textarea'];
$return .= <<<CONTENT

						</span>	
						
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_second_colums'] ):
$return .= <<<CONTENT

							<span class="veilonRight">				
								<p>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_second_colums_content'];
$return .= <<<CONTENT
</p>
							</span>	
						
CONTENT;

endif;
$return .= <<<CONTENT
		
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_section2'] and \IPS\Theme::i()->settings['veilon_footer_section2_width'] ):
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_wcs2'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['veilon_footer_wcs2'] ) ) ):
$return .= <<<CONTENT

					<div class="
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section2_width'];
$return .= <<<CONTENT
" data-block="2">
						<h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section2_h1'];
$return .= <<<CONTENT
</h2>
						<span class="veilonLeft">				
							
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section2_textarea'];
$return .= <<<CONTENT

						</span>	
						
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_second_colums2'] ):
$return .= <<<CONTENT

							<span class="veilonRight">				
								<p>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_second_colums2_content'];
$return .= <<<CONTENT
</p>
							</span>	
						
CONTENT;

endif;
$return .= <<<CONTENT
		
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_section3'] and \IPS\Theme::i()->settings['veilon_footer_section3_width'] ):
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_wcs3'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['veilon_footer_wcs3'] ) ) ):
$return .= <<<CONTENT

					<div class="
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section3_width'];
$return .= <<<CONTENT
" data-block="3">
						<h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section3_h1'];
$return .= <<<CONTENT
</h2>
						<span class="veilonLeft">				
							
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section3_textarea'];
$return .= <<<CONTENT

						</span>	
						
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_second_colums3'] ):
$return .= <<<CONTENT

							<span class="veilonRight">				
								<p>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_second_colums3_content'];
$return .= <<<CONTENT
</p>
							</span>	
						
CONTENT;

endif;
$return .= <<<CONTENT
		
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_section4'] and \IPS\Theme::i()->settings['veilon_footer_section4_width'] ):
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_wcs4'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['veilon_footer_wcs4'] ) ) ):
$return .= <<<CONTENT

					<div class="
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section4_width'];
$return .= <<<CONTENT
" data-block="4">
						<h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section4_h1'];
$return .= <<<CONTENT
</h2>
						
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_social_icons_position'] === 'headerlastfooter' ):
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_social_icons'] ):
$return .= \IPS\Theme::i()->getTemplate( "_veilon", "core" )->_veilon_social_icons(  );
endif;
$return .= <<<CONTENT

						
CONTENT;

elseif ( \IPS\Theme::i()->settings['veilon_social_icons_position'] === 'lastfooterblock' ):
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_social_icons'] ):
$return .= \IPS\Theme::i()->getTemplate( "_veilon", "core" )->_veilon_social_icons(  );
endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

						<span class="veilonLeft">				
							
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_footer_section4_textarea'];
$return .= <<<CONTENT

						</span>	
						
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_footer_second_colum4'] ):
$return .= <<<CONTENT

							<span class="veilonRight">				
								<p>
CONTENT;


$return .= <<<CONTENT
</p>
							</span>	
						
CONTENT;

endif;
$return .= <<<CONTENT
		
					</div>
					
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_social_icons'] ):
$return .= \IPS\Theme::i()->getTemplate( "_veilon", "core" )->_veilon_social_icons(  );
endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		</div>
</footer>
CONTENT;

		return $return;
}

	function _veilon_guestmessage(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['veilon_guestmessage'] == '1' and \IPS\Theme::i()->settings['veilon_gm_wcs'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['veilon_gm_wcs'] ) ) ):
$return .= <<<CONTENT

<center>
	<div id='guestMessage'>
	<h1>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_guestmessage_head'];
$return .= <<<CONTENT
</h1>
	
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_guestmessage_content'];
$return .= <<<CONTENT

	<ul class="ipsList_inline veilon_top">
  			
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_guestmessage_signin'] ):
$return .= <<<CONTENT

	    	<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ) );
$return .= <<<CONTENT
' class="ipsButton ipsButton_alternate">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
	    	
CONTENT;

endif;
$return .= <<<CONTENT

	    	
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_guestmessage_signup'] ):
$return .= <<<CONTENT

	    	<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), 0 ) );
$return .= <<<CONTENT
' class="ipsButton ipsButton_primary">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
	    	
CONTENT;

endif;
$return .= <<<CONTENT

  		</ul>
	</div>
</center>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function _veilon_header_slider(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['veilon_se'] == '1' and \IPS\Theme::i()->settings['veilon_se_wcs'] =='*' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Theme::i()->settings['veilon_se_wcs'] ) ) ):
$return .= <<<CONTENT

<div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1000/1000/nightlife/1)"></div>
            <div class="lazyPreloader"><div class="lazyPreloader-wrapper"><div class="lazyPreloader-spinner"></div></div></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1000/1000/nightlife/2)"></div>
            <div class="lazyPreloader"><div class="lazyPreloader-wrapper"><div class="lazyPreloader-spinner"></div></div></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1000/1000/nightlife/3)"></div>
            <div class="lazyPreloader"><div class="lazyPreloader-wrapper"><div class="lazyPreloader-spinner"></div></div></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1000/1000/nightlife/4)"></div>
            <div class="lazyPreloader"><div class="lazyPreloader-wrapper"><div class="lazyPreloader-spinner"></div></div></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1000/1000/nightlife/5)"></div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-white"></div>
        <!-- Add Arrows -->
        <div class="swiper-next"></div>
        <div class="swiper-prev"></div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function _veilon_js_body(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_enable'] ):
$return .= <<<CONTENT

<script type="text/javascript" src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "_veilon/js/owl.carousel-min.js", "core", 'front', false );
$return .= <<<CONTENT
"></script> 
<script>
  $(document).ready(function() {
    $("#owl-veilon").owlCarousel({
		
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_pagination_enable'] ):
$return .= <<<CONTENT

		    pagination : true,
		    
CONTENT;

else:
$return .= <<<CONTENT

		    pagination : false,
		
CONTENT;

endif;
$return .= <<<CONTENT

    navigation : false,
    slideSpeed : 300,
    paginationSpeed : 400,
    mouseDrag: false,
    touchDrag: false,
    items : 1, 
    itemsDesktop : false,
    itemsDesktopSmall : false,
    itemsTablet: false,
    itemsMobile : false,
    responsive: true,
    
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_stoponhover'] ):
$return .= <<<CONTENT

    stopOnHover : true,

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['veilon_pagination_autoplay'] ):
$return .= <<<CONTENT

    
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_pagination_autoplay'];
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


    });

  });
</script>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['veilon_nprogress'] ):
$return .= <<<CONTENT

<script src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "nprogress.js", "core", 'front/_veilon/js', false );
$return .= <<<CONTENT
"></script>
<script>
	$('body').show();
	$('.version').text(NProgress.version);
	
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_nprogress_show_spinner'] ):
$return .= <<<CONTENT
NProgress.configure({ showSpinner: false });
CONTENT;

endif;
$return .= <<<CONTENT

	NProgress.start();
	setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
</script>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function _veilon_js_head(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function _veilon_navbaritems( $roots, $subBars=NULL, $parent=0, $preview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $roots as $id => $item ):
$return .= <<<CONTENT

	
CONTENT;

if ( $preview or $item->canView() ):
$return .= <<<CONTENT

		
CONTENT;

if ( $item->active() ):
$return .= <<<CONTENT

			
CONTENT;

\IPS\core\FrontNavigation::i()->activePrimaryNavBar = $item->id;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		<li aria-haspopup="true" 
CONTENT;

if ( $active ):
$return .= <<<CONTENT
class='ipsNavBar_active' data-active
CONTENT;

endif;
$return .= <<<CONTENT
 id='elNavSecondary_
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="navBarItem" data-navApp="
CONTENT;

$return .= htmlspecialchars( mb_substr( get_class( $item ), 4, mb_strpos( get_class( $item ), '\\', 4 ) - 4 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-navExt="
CONTENT;

$return .= htmlspecialchars( mb_substr( get_class( $item ), mb_strrpos( get_class( $item ), '\\' ) + 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-navTitle="
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			
CONTENT;

$children = $item->children();
$return .= <<<CONTENT

			
CONTENT;

if ( $children ):
$return .= <<<CONTENT

					<a href="
CONTENT;

if ( $item->link() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
#
CONTENT;

endif;
$return .= <<<CONTENT
" id="elNavigation_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-appendTo='#
CONTENT;

if ( $parent ):
$return .= <<<CONTENT
elNavSecondary_
CONTENT;
$return .= htmlspecialchars( $parent, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
elNavSecondary_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenu-activeClass='ipsNavActive_menu' data-navItem-id="
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $active ):
$return .= <<<CONTENT
data-navDefault
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i>
				</a>
						<ul id="elNavigation_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" class="ipsMenu ipsMenu_auto ipsHide">
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->navBarChildren( $children, $preview );
$return .= <<<CONTENT

						</ul>
			
CONTENT;

else:
$return .= <<<CONTENT

				<a href="
CONTENT;

if ( $item->link() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
#
CONTENT;

endif;
$return .= <<<CONTENT
" data-navItem-id="
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $item->active() ):
$return .= <<<CONTENT
data-navDefault
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $subBars && isset( $subBars[ $id ] ) && count( $subBars[ $id ] ) ):
$return .= <<<CONTENT

			
				<ul class='ipsNavBar_secondary 
CONTENT;

if ( !$active ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "_veilon", "core", 'front' )->_veilon_navbaritems( $subBars[ $id ], NULL, $item->id, $preview );
$return .= <<<CONTENT

					<li class='ipsHide' id='elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='navMore'>
						<a href='#' data-ipsMenu data-ipsMenu-appendTo='#elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_dropdown'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
						<ul class='ipsHide ipsMenu ipsMenu_auto' id='elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_dropdown_menu' data-role='moreDropdown'></ul>
					</li>
				</ul>
			
			
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

		return $return;
}

	function _veilon_slider(  ) {
		$return = '';
		$return .= <<<CONTENT

	<div id="owl-veilon" class="owl-carousel owl-theme">
		
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_section1'] ):
$return .= <<<CONTENT

		<div class="item" style="background-image: url(
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section1_cover'];
$return .= <<<CONTENT
);">
			<div class="veilon-text">
				<div class="veilon-desc">
					<h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section1_header'];
$return .= <<<CONTENT
</h2>
					<p>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section1_content'];
$return .= <<<CONTENT
</p>
					
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_rm_enable'] ):
$return .= <<<CONTENT
<a class="veilon__rm__button" href="
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section1_link'];
$return .= <<<CONTENT
">Read More</a>
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_section2'] ):
$return .= <<<CONTENT

		<div class="item" style="background-image: url(
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section2_cover'];
$return .= <<<CONTENT
);">
			<div class="veilon-text">
				<div class="veilon-desc">
					<h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section2_header'];
$return .= <<<CONTENT
</h2>
					<p>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section2_content'];
$return .= <<<CONTENT
</p>
					
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_rm_enable'] ):
$return .= <<<CONTENT
<a class="veilon__rm__button" href="
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section2_link'];
$return .= <<<CONTENT
">Read More</a>
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_section3'] ):
$return .= <<<CONTENT

		<div class="item" style="background-image: url(
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section3_cover'];
$return .= <<<CONTENT
);">
			<div class="veilon-text">
				<div class="veilon-desc">
					<h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section3_header'];
$return .= <<<CONTENT
</h2>
					<p>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section3_content'];
$return .= <<<CONTENT
</p>
					
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_rm_enable'] ):
$return .= <<<CONTENT
<a class="veilon__rm__button" href="
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section3_link'];
$return .= <<<CONTENT
">Read More</a>
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_section4'] ):
$return .= <<<CONTENT

		<div class="item" style="background-image: url(
CONTENT;


$return .= <<<CONTENT
);">
			<div class="veilon-text">
				<div class="veilon-desc">
					<h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section4_header'];
$return .= <<<CONTENT
</h2>
					<p>
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section4_content'];
$return .= <<<CONTENT
</p>
					
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_slider_rm_enable'] ):
$return .= <<<CONTENT
<a class="veilon__rm__button" href="
CONTENT;

$return .= \IPS\Theme::i()->settings['veilon_slider_section4_link'];
$return .= <<<CONTENT
">Read More</a>
CONTENT;

endif;
$return .= <<<CONTENT

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

	function _veilon_social_icons(  ) {
		$return = '';
		$return .= <<<CONTENT



<ul class="veilon-social-icons ipsList_inline ipsPos_right">
	
CONTENT;

foreach ( explode(',',\IPS\Theme::i()->settings['veilon_select_social_icons']) as $key => $icon ):
$return .= <<<CONTENT

		
CONTENT;

$pairs = explode( PHP_EOL, \IPS\Theme::i()->settings['veilon_social_icons_links'] );
$return .= <<<CONTENT

		
CONTENT;

$title = ucfirst($icon);
$return .= <<<CONTENT

		<a title="
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" target="_blank" href="
CONTENT;
$return .= htmlspecialchars( $pairs[$key], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsTooltip><i class="fa fa-
CONTENT;
$return .= htmlspecialchars( $icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_larger"></i></a>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>

CONTENT;

		return $return;
}

	function _veilon_vertical_navbar( $preview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

	<nav class='v-nav' data-controller='core.front.core.navBar'>
		<div class='ipsNavBar_primary 
CONTENT;

if ( !count( \IPS\core\FrontNavigation::i()->subBars( $preview ) ) ):
$return .= <<<CONTENT
ipsNavBar_noSubBars
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix'>
			<ul data-role="primaryNavBar" class='
CONTENT;

if ( !$preview ):
$return .= <<<CONTENT
ipsResponsive_showDesktop ipsResponsive_block
CONTENT;

endif;
$return .= <<<CONTENT
'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->navBarItems( \IPS\core\FrontNavigation::i()->roots( $preview ), \IPS\core\FrontNavigation::i()->subBars( $preview ), 0, $preview );
$return .= <<<CONTENT

			 
			</ul>
		</div>
	</nav>

CONTENT;

elseif ( \IPS\Member::loggedIn()->group['g_view_board'] ):
$return .= <<<CONTENT

	<nav class='ipsLayout_container'>
		<div class='ipsNavBar_primary ipsNavBar_noSubBars ipsClearfix'>
			<a id='elBackHome' href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_community_home', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-left'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'community_home', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</div>
	</nav>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function guestMessage(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['veilon_guestmessage'] ):
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Member::loggedIn()->member_id  ):
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

<div id='daewoGuestMessage'>
	<p>
CONTENT;


$return .= <<<CONTENT
</p>
  <ul class="ipsList_inline ipsSpacer_top">
  	
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_guestmessage_sn'] ):
$return .= <<<CONTENT

    	<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ) );
$return .= <<<CONTENT
' class="ipsButton daewo_blue">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
    	
CONTENT;

endif;
$return .= <<<CONTENT

    	
CONTENT;

if ( \IPS\Theme::i()->settings['veilon_guestmessage_su'] ):
$return .= <<<CONTENT

    	<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), 0 ) );
$return .= <<<CONTENT
' class="ipsButton daewo_red">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
    	
CONTENT;

endif;
$return .= <<<CONTENT

  	</ul>
</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT



CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function secondaryFooter(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['customFooter'] ):
$return .= <<<CONTENT

<div id="secondaryFooter">
	<div class="ipsGrid">
			
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_section1'] ):
$return .= <<<CONTENT

			<div class="ipsGrid_span4">
				<h2>
CONTENT;


$return .= <<<CONTENT
</h2>
				
<p>
	
CONTENT;


$return .= <<<CONTENT

</p>
				
		</div>
		
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_section2'] ):
$return .= <<<CONTENT

			<div class="ipsGrid_span3">
				<h2>
CONTENT;


$return .= <<<CONTENT
</h2>
				

CONTENT;


$return .= <<<CONTENT

			
			</div>
			
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_section3'] ):
$return .= <<<CONTENT

			<div class="ipsGrid_span3">
			<h2>
CONTENT;


$return .= <<<CONTENT
</h2>
				
			
CONTENT;


$return .= <<<CONTENT

			
			</div>
			
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_section4'] ):
$return .= <<<CONTENT

			<div class="ipsGrid_span2">
				<h2>
CONTENT;


$return .= <<<CONTENT
</h2>
				
<p>
	
CONTENT;


$return .= <<<CONTENT

</p>
<div class="secondaryFooterLinks">
					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_facebook'] ):
$return .= <<<CONTENT

					<a class="secondaryFacebookButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_googlePlus'] ):
$return .= <<<CONTENT

					<a class="secondaryGooglePlusButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_vk'] ):
$return .= <<<CONTENT

					<a class="secondaryVkButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_pinterest'] ):
$return .= <<<CONTENT

					<a class="secondaryPinterestButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_vimeo'] ):
$return .= <<<CONTENT

					<a class="secondaryVimeoButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_twitter'] ):
$return .= <<<CONTENT

					<a class="secondaryTwitterButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_youtube'] ):
$return .= <<<CONTENT

					<a class="secondaryYoutubeButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_linkedln'] ):
$return .= <<<CONTENT

					<a class="secondaryLinkenldButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_instagram'] ):
$return .= <<<CONTENT

					<a class="secondaryInstagramButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_flikr'] ):
$return .= <<<CONTENT

					<a class="secondaryFlikrButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_steam'] ):
$return .= <<<CONTENT

					<a class="secondarySteamButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['customFooter_rss'] ):
$return .= <<<CONTENT

					<a class="secondaryRssButton" href="
CONTENT;


$return .= <<<CONTENT
" target="blank"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
					
</div>

				
			</div>
			
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
</div>

CONTENT;

else:
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}