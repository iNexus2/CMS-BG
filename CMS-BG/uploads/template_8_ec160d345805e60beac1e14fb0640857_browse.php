<?php
namespace IPS\Theme\Cache;
class class_donate_front_browse extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function donationList( $table ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack( 'page__donations' ) );
$return .= <<<CONTENT


<div class='ipsClear ipsBox'>
{$table}
</div>
CONTENT;

		return $return;
}

	function donationRow( $table, $headers, $rows, $type=1 ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $member => $row ):
$return .= <<<CONTENT

	<li class="ipsDataItem">
        
CONTENT;

if ( $type == 2 ):
$return .= <<<CONTENT

    		<div class='ipsDataItem_icon ipsPos_top ipsResponsive_hidePhone'>
    			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $member ), 'tiny' );
$return .= <<<CONTENT

    		</div>
    		<div class='ipsDataItem_generic ipsDataItem_size6'>
    			<h4 class='ipsDataItem_title'>				
    				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( \IPS\Member::load( $member ), NULL );
$return .= <<<CONTENT

    			</h4>
    		</div> 
    		<div class="ipsDataItem_main">&nbsp;</div>              
    		<div class='ipsDataItem_generic ipsDataItem_size4'>
                <div class="ipsCommentCount ipsPos_right" data-ipsTooltip title='
CONTENT;

$return .= new \IPS\donate\Currency\Money( $row, -1, '' );
$return .= <<<CONTENT
'>
CONTENT;

$return .= new \IPS\donate\Currency\Money( $row, -1, '' );
$return .= <<<CONTENT
</div>
    		</div>        
        
CONTENT;

else:
$return .= <<<CONTENT

    		<div class='ipsDataItem_icon ipsPos_top ipsResponsive_hidePhone'>
                
CONTENT;

if ( $row->anon ):
$return .= <<<CONTENT

                    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( 0 ), 'tiny' );
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
            
    		</div>
    		<div class='ipsDataItem_generic ipsDataItem_size6'>
    			<h4 class='ipsDataItem_title'>	
                    
CONTENT;

if ( $row->anon ):
$return .= <<<CONTENT

                        <i>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'anonymous_donation_tag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</i>
                    
CONTENT;

else:
$return .= <<<CONTENT
			
    				    
CONTENT;

if ( $row->member_id ):
$return .= <<<CONTENT
{$row->author()->link()}
CONTENT;

else:
$return .= <<<CONTENT
<i>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'offline_donation', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</i>
CONTENT;

endif;
$return .= <<<CONTENT

                    
CONTENT;

endif;
$return .= <<<CONTENT

    			</h4>
   			    <p class='ipsType_reset ipsType_light'>
CONTENT;

$val = ( $row->__get( $row::$databaseColumnMap['date'] ) instanceof \IPS\DateTime ) ? $row->__get( $row::$databaseColumnMap['date'] ) : \IPS\DateTime::ts( $row->__get( $row::$databaseColumnMap['date'] ) );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</p>
    		</div>
    		<div class="ipsDataItem_main">
				<div class='ipsType_richText ipsType_medium' data-ipsTruncate data-ipsTruncate-size='4 lines' data-ipsTruncate-type='remove'>
					{$row->content()}
				</div>            
    		</div>  
    		<div class='ipsDataItem_generic ipsDataItem_size4'>
                <div class="ipsCommentCount ipsPos_right" data-ipsTooltip title='
CONTENT;

$return .= new \IPS\donate\Currency\Money( $row->_amount, $row->_currency, $row->anon_amount OR ( $row->goal() AND $row->goal()->private ) ? TRUE : FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= new \IPS\donate\Currency\Money( $row->_amount, $row->_currency, $row->anon_amount OR ( $row->goal() AND $row->goal()->private ) ? TRUE : FALSE );
$return .= <<<CONTENT
</div>
    		</div>          
        
CONTENT;

endif;
$return .= <<<CONTENT
            
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function goalBlock( $goal ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox'>
	<h2 class='ipsType_sectionTitle ipsType_reset'><a href="
CONTENT;
$return .= htmlspecialchars( $goal->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $goal->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h2>
	<div class='ipsPad_half'>
	   <span class='ipsType_light ipsType_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'goal_starts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $goal->start_date instanceof \IPS\DateTime ) ? $goal->start_date : \IPS\DateTime::ts( $goal->start_date );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
 
CONTENT;

if ( $goal->end_date ):
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_ends', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $goal->end_date instanceof \IPS\DateTime ) ? $goal->end_date : \IPS\DateTime::ts( $goal->end_date );$return .= (string) $val->localeDate();
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>

		<div class='ipsClearfix ipsType_medium'>
            <div data-role='commentContent' class='ipsType_normal ipsPad_half ipsType_richText ipsContained' data-controller='core.front.core.lightboxedImages'>
                {$goal->description}
            </div>
			<ul class='ipsList_inline ipsType_small ipsEmbedded_stats'>
				<li><i class='fa fa-money'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $goal->_items );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donations', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
                <li><i class='fa fa-eye'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $goal->views );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'views', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
                
                <li class='ipsPos_right'>
                    <div class='ipsGrid_span6 ipsResponsive_hidePhone'>
                    <div class='ipsPos_center ipsType_center' data-ipsTooltip data-ipsTooltip-label="
CONTENT;

if ( round( $goal->goal_status ) > 100 ):
$return .= <<<CONTENT
100
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( round( $goal->goal_status ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
% 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'percent_of_goal_reached', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
                       <span class="ipsAttachment_progress"><span style='width: 
CONTENT;

if ( round( $goal->goal_status ) > 100 ):
$return .= <<<CONTENT
100
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( round( $goal->goal_status ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
%'></span></span><br>

                    </div>
                    </div>                     
                </li>
                <li class='ipsPos_right'><span class='ipsType_light ipsType_small ipsResponsive_hidePhone'>
CONTENT;

$return .= new \IPS\donate\Currency\Money( $goal->received, $goal->_currency, '', '' );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_of', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$return .= new \IPS\donate\Currency\Money( $goal->amount, $goal->_currency, '', '' );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'goal_reached', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></li>
			</ul>
		</div>
	</div>
</div>
<br />
CONTENT;

		return $return;
}

	function goalList( $goals ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack( 'page__goals' ) );
$return .= <<<CONTENT


<div class='ipsBox'>
	<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'page__goals', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
    <ol class="ipsDataList ipsDataList_large">
        
CONTENT;

if ( !empty( $goals )  ):
$return .= <<<CONTENT

            
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->goalRow( NULL, NULL, $goals );
$return .= <<<CONTENT

        
CONTENT;

else:
$return .= <<<CONTENT

            <li class='ipsDataItem ipsDataItem_main'>
                <p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_active_goals', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
            </li>
        
CONTENT;

endif;
$return .= <<<CONTENT

    </ol>
</div>
CONTENT;

		return $return;
}

	function goalPage( $goal, $donations ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( $goal->_title );
$return .= <<<CONTENT



CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->goalBlock( $goal );
$return .= <<<CONTENT
  


CONTENT;

if ( \IPS\Member::loggedIn()->group['g_dt_view_donations'] ):
$return .= <<<CONTENT

    <div class='ipsClear ipsBox'>
    {$donations}
    </div>

CONTENT;

endif;
$return .= <<<CONTENT


<br>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sharelinks( $goal );
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function goalRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class="ipsDataItem">
		<div class="ipsDataItem_main">
        	<h4 class='ipsDataItem_title'>				
				
CONTENT;
$return .= htmlspecialchars( $row->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</h4>
            <div class='ipsType_light ipsType_small ipsSpacer_bottom'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'goal_starts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $row->start_date instanceof \IPS\DateTime ) ? $row->start_date : \IPS\DateTime::ts( $row->start_date );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
 
CONTENT;

if ( $row->end_date ):
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_ends', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $row->end_date instanceof \IPS\DateTime ) ? $row->end_date : \IPS\DateTime::ts( $row->end_date );$return .= (string) $val->localeDate();
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</div>
            <div data-role='commentContent' class='ipsType_normal ipsType_richText ipsSpacer_bottom ipsContained' data-controller='core.front.core.lightboxedImages' data-ipsTruncate data-ipsTruncate-size='4 lines' data-ipsTruncate-type='remove'>
                {$row->description}
            </div>  
            
            <div class='ipsPos_right'>
                <span class='ipsType_light ipsType_small ipsResponsive_hidePhone'>
CONTENT;

$return .= new \IPS\donate\Currency\Money( $row->received, $row->_currency, '', '' );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_of', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$return .= new \IPS\donate\Currency\Money( $row->amount, $row->_currency, '', '' );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'goal_reached', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>

                <div class='ipsGrid_span4 ipsResponsive_hidePhone'>
                    <div class='ipsPos_center ipsType_center' data-ipsTooltip data-ipsTooltip-label="
CONTENT;

if ( round( $row->goal_status ) > 100 ):
$return .= <<<CONTENT
100
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( round( $row->goal_status ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
% 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'percent_of_goal_reached', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
                       <span class="ipsAttachment_progress"><span style='width: 
CONTENT;

if ( round( $row->goal_status ) > 100 ):
$return .= <<<CONTENT
100
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( round( $row->goal_status ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
%'></span></span><br>
                    </div>
                </div>                     
            </div>            
                     
			<ul class='ipsList_inline ipsType_small'>
				<li><i class='fa fa-money'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $row->_items );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donations', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
                <li><i class='fa fa-eye'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $row->views );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'views', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
                
			</ul>                         
		</div>  
		<div class='ipsDataItem_generic ipsDataItem_size4'>
		</div>              
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function index( $donations ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('__app_donate') );
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Member::loggedIn()->group['g_dt_donate'] ):
$return .= <<<CONTENT

    <ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsSpacer_bottom ipsSpacer_half">
    	<li class='ipsToolList_primaryAction'>
    		<a class="ipsButton ipsButton_medium ipsButton_important ipsButton_fullWidth" href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate&module=donate&controller=payment&_new=1", null, "donate_donate", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
    	</li>
    </ul>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Member::loggedIn()->group['g_dt_view_goals'] ):
$return .= <<<CONTENT

    <div class='ipsClear ipsBox'>	
        
CONTENT;

foreach ( \IPS\donate\Goal::roots( NULL, NULL, ( \IPS\Settings::i()->dt_goal_reset ) ? array( 'g_show=1 AND g_start_date > ?', \IPS\Settings::i()->dt_goal_reset ) : array( 'g_show=1' ) ) as $goal ):
$return .= <<<CONTENT

            
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->goalBlock( $goal );
$return .= <<<CONTENT

        
CONTENT;

endforeach;
$return .= <<<CONTENT
    
    </div>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Member::loggedIn()->group['g_dt_view_donations'] ):
$return .= <<<CONTENT

    <div class='ipsClear ipsBox'>
    	<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'latest_donations', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
        <ol class="ipsDataList ipsDataList_large">
            
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->donationRow( NULL, NULL, $donations );
$return .= <<<CONTENT

        </ol>
    </div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function topDonorsList( $donations=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack( 'page__top_donors' ) );
$return .= <<<CONTENT


<div class='ipsBox'>
	<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'page__top_donors', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
    <ol class="ipsDataList ipsDataList_large">
        
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "browse", \IPS\Request::i()->app )->donationRow( NULL, NULL, $donations, 2 );
$return .= <<<CONTENT

    </ol>
</div>
CONTENT;

		return $return;
}}