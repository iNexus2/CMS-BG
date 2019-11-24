<?php
namespace IPS\Theme\Cache;
class class_donate_front_widgets extends \IPS\Theme\Template
{
	public $cache_key = 'c6329c24047b6937229f5db5eda41bb2';
	function donateDonate( $form, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elDonateBox' class='ipsWidget ipsWidget_vertical ipsBox'>    
    <h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_donateDonate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
    <div class='ipsWidget_inner'>
    	<div class='ipsPad_half'>      
            <div class='ipsPos_center ipsType_center'>
                
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_donateDonate_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

            </div>
        
            {$form} 
  		</div>
    </div>
</div>
CONTENT;

		return $return;
}

	function donateDonations( $donations, $type, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !empty( $donations )  ):
$return .= <<<CONTENT

	<h3 class='ipsWidget_title ipsType_reset'>
CONTENT;

if ( $type == 2 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'top_donors', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'latest_donations', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h3>

	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsPad_half ipsWidget_inner'>
			<ul class='ipsDataList ipsDataList_reducedSpacing'>
				
CONTENT;

foreach ( $donations as $member => $donation ):
$return .= <<<CONTENT

                    
CONTENT;

if ( $type == 2 ):
$return .= <<<CONTENT

    					<li class='ipsDataItem'>
    						<div class='ipsDataItem_icon ipsPos_top'>
                                
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $member ), 'tiny' );
$return .= <<<CONTENT

    						</div>
    						<div class='ipsDataItem_main'>
    							<div class="ipsCommentCount ipsPos_right">
CONTENT;

$return .= new \IPS\donate\Currency\Money( $donation, -1, '' );
$return .= <<<CONTENT
</div>
    							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( \IPS\Member::load( $member ), NULL );
$return .= <<<CONTENT
<br>		
    						</div>
    					</li>    
                    
CONTENT;

else:
$return .= <<<CONTENT

    					<li class='ipsDataItem'>
    						<div class='ipsDataItem_icon ipsPos_top'>
                                
CONTENT;

if ( $donation->anon ):
$return .= <<<CONTENT

                                    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( 0 ), 'tiny' );
$return .= <<<CONTENT

                                
CONTENT;

else:
$return .= <<<CONTENT
			
                				    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $donation->author(), 'tiny' );
$return .= <<<CONTENT

                                
CONTENT;

endif;
$return .= <<<CONTENT
                             
    						</div>
    						<div class='ipsDataItem_main'>
    							<div class="ipsCommentCount ipsPos_right" data-ipsTooltip title='
CONTENT;

$return .= new \IPS\donate\Currency\Money( $donation->_amount, $donation->_currency, $donation->anon_amount OR ( $donation->goal() AND $donation->goal()->private ) ? TRUE : FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= new \IPS\donate\Currency\Money( $donation->_amount, $donation->_currency, $donation->anon_amount OR ( $donation->goal() AND $donation->goal()->private ) ? TRUE : FALSE );
$return .= <<<CONTENT
</div>
    							
CONTENT;

if ( $donation->anon ):
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

if ( $donation->member_id ):
$return .= <<<CONTENT
{$donation->author()->link()}
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
<br>
   							    <span class='ipsType_light ipsType_small'>
CONTENT;

$val = ( $donation->date instanceof \IPS\DateTime ) ? $donation->date : \IPS\DateTime::ts( $donation->date );$return .= $val->html();
$return .= <<<CONTENT
</span>
    						</div>
    					</li>                    
                    
CONTENT;

endif;
$return .= <<<CONTENT
                
				
CONTENT;

endforeach;
$return .= <<<CONTENT

  				<li class='ipsDataItem'>
					<div class='ipsDataItem_main ipsType_small ipsType_light ipsType_center'>
                        
CONTENT;

if ( $type == 2 ):
$return .= <<<CONTENT

                            <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate&module=donate&controller=browse&do=topdonors", null, "donate_topdonors", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_top_donors', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
                        
CONTENT;

else:
$return .= <<<CONTENT

                            <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate&module=donate&controller=browse&do=donations", null, "donate_donations", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_donations', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>                       
                        
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				</li>                
			</ul>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsWidget_inner'>
			<ul class='ipsDataList'>
				
CONTENT;

foreach ( $donations as $member => $donation ):
$return .= <<<CONTENT

                    
CONTENT;

if ( $type == 2 ):
$return .= <<<CONTENT

                        <li class="ipsDataItem ipsDataItem_responsivePhoto">        
    						<div class='ipsDataItem_icon ipsPos_top'>
    							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $member ), 'tiny' );
$return .= <<<CONTENT

    						</div>                      
                        	<div class='ipsDataItem_main'>
                        		<h4 class='ipsDataItem_title ipsType_break'>
                        			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( \IPS\Member::load( $member ), NULL );
$return .= <<<CONTENT
<br>	
                        		</h4>
    							<div class="ipsCommentCount ipsPos_right">
CONTENT;

$return .= new \IPS\donate\Currency\Money( $donation, -1, '' );
$return .= <<<CONTENT
</div>
                        	</div>
                        </li> 
                    
CONTENT;

else:
$return .= <<<CONTENT

                        <li class="ipsDataItem ipsDataItem_responsivePhoto">        
    						<div class='ipsDataItem_icon ipsPos_top'>
                                
CONTENT;

if ( $donation->anon ):
$return .= <<<CONTENT

                                    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( 0 ), 'tiny' );
$return .= <<<CONTENT

                                
CONTENT;

else:
$return .= <<<CONTENT
			
                				    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $donation->author(), 'tiny' );
$return .= <<<CONTENT

                                
CONTENT;

endif;
$return .= <<<CONTENT

    						</div>                      
                        	<div class='ipsDataItem_main'>
                        		<h4 class='ipsDataItem_title ipsType_break'>
                                    
CONTENT;

if ( $donation->anon ):
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

if ( $donation->member_id ):
$return .= <<<CONTENT
{$donation->author()->link()}
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
<br>
                                    
CONTENT;

endif;
$return .= <<<CONTENT
                                
                           		</h4>
    							<div class="ipsCommentCount ipsPos_right" data-ipsTooltip title='
CONTENT;

if ( $type == 2 ):
$return .= <<<CONTENT

CONTENT;

$return .= new \IPS\donate\Currency\Money( $donation->total_amount, '', '' );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= new \IPS\donate\Currency\Money( $donation->_amount, '', '' );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

if ( $type == 2 ):
$return .= <<<CONTENT

CONTENT;

$return .= new \IPS\donate\Currency\Money( $donation->total_amount, '', '' );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
 
CONTENT;

$return .= new \IPS\donate\Currency\Money( $donation->_amount, '', '' );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</div>
                        		
CONTENT;

if ( $type == 1 ):
$return .= <<<CONTENT

                                    
CONTENT;

if ( $donation->goal ):
$return .= <<<CONTENT

                                        <p class='ipsType_reset ipsType_medium ipsType_light'>
                                			
CONTENT;
$return .= htmlspecialchars( $donation->container()->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

                                		</p>
                                    
CONTENT;

endif;
$return .= <<<CONTENT
    
                                    
CONTENT;

if ( $donation->note ):
$return .= <<<CONTENT

                                		<p class='ipsType_reset ipsType_small ipsType_light'>
                                			
CONTENT;
$return .= htmlspecialchars( $donation->note, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

                                		</p>
                                    
CONTENT;

endif;
$return .= <<<CONTENT

                                
CONTENT;

endif;
$return .= <<<CONTENT

                        	</div>
                        </li>                    
                    
CONTENT;

endif;
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

	function donateGoals( $goal, $goals ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $goal ):
$return .= <<<CONTENT

    <h3 class='ipsWidget_title ipsType_reset'>
CONTENT;
$return .= htmlspecialchars( $goal->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
    <div class='ipsPad ipsWidget_inner'>
        <div class='ipsContained'>
    		{$goal->description}
    	</div>
        <div data-ipsTooltip data-ipsTooltip data-ipsTooltip-label="
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
    		<span class="ipsAttachment_progress" style='width: 100%'><span style='width: 
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
            <span class='ipsType_light ipsType_small ipsResponsive_hidePhone'>
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
</span>		
    	</div>  
        
        <a class="ipsButton ipsButton_small ipsButton_primary ipsButton_fullWidth ipsSpacer_top ipsSpacer_half" href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate&module=donate&controller=payment&_new=1", null, "donate_donate", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
    </div>

CONTENT;

else:
$return .= <<<CONTENT

    
CONTENT;

if ( !empty( $goals )  ):
$return .= <<<CONTENT

        <h3 class='ipsWidget_title ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_donateGoals', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
        <div class='ipsPad ipsWidget_inner'>    
    		
CONTENT;

foreach ( $goals as $goal ):
$return .= <<<CONTENT

                <span class='ipsType_normal'>
CONTENT;
$return .= htmlspecialchars( $goal->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
                <div data-ipsTruncate data-ipsTruncate-size='5 lines' data-ipsTruncate-type='remove' class='ipsContained' >
                    {$goal->description}
                </div><br />
                
                <div data-ipsTooltip data-ipsTooltip-label="
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
                    <span class="ipsAttachment_progress" style='width: 100%'><span style='width: 
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
                    <span class='ipsType_light ipsType_small ipsResponsive_hidePhone'>
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
</span>		
                </div>  
                
                <a class="ipsButton ipsButton_small ipsButton_primary ipsButton_fullWidth ipsSpacer_top ipsSpacer_half" href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate&module=donate&controller=payment&_new=1", null, "donate_donate", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
                
                <hr class='ipsHr'>
    		
CONTENT;

endforeach;
$return .= <<<CONTENT
			
    		<div class='ipsType_small ipsType_light ipsType_center'>
                <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate&module=donate&controller=browse&do=goals", null, "donate_goals", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_goals', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>                       
    		</div>       
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

	function donateSend( $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elDonateBox' class='ipsWidget ipsWidget_vertical ipsBox'>    
    <h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_donateSend_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
    <div class='ipsWidget_inner'>
    	<div class='ipsPad ipsType_center'>      
            <div class='ipsSpacer_bottom'>
                
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->donate_amount); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donatesend_info', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

            </div>
        
        	<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate&module=donate&controller=send&do=sendTotal", "front", "", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_fullWidth' data-ipsDialog data-ipsDialog-modal='true' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_send_donation_total', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
        	   
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_send_donation', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

        	</a>  
  		</div>
    </div>
</div>
CONTENT;

		return $return;
}

	function donateStats( $stats, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_donateStats', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_donations', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class="ipsDataItem_stats ipsDataItem_statsLarge">
						<span class="ipsDataItem_stats_number">
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalDonations'], -1, '', '' );
$return .= <<<CONTENT
</span>
					</div>
				</li>
                
CONTENT;

if ( isset( $stats['totalFees'] ) ):
$return .= <<<CONTENT

    				<li class="ipsDataItem">
    					<div class="ipsDataItem_main ipsPos_middle">
    						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_fees', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
    					</div>
    					<div class="ipsDataItem_stats ipsDataItem_statsLarge">
    						<span class="ipsDataItem_stats_number">
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalFees'], -1, '', '' );
$return .= <<<CONTENT
</span>
    					</div>
    				</li>                
                
CONTENT;

endif;
$return .= <<<CONTENT
                
                
CONTENT;

if ( $stats['totalGoals'] ):
$return .= <<<CONTENT

    				<li class="ipsDataItem">
    					<div class="ipsDataItem_main ipsPos_middle">
    						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_goals', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
    					</div>
    					<div class="ipsDataItem_stats ipsDataItem_statsLarge">
    						<span class="ipsDataItem_stats_number">
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalGoals'], -1, '', '' );
$return .= <<<CONTENT
</span>
    					</div>
    				</li>                
                    
    				<li class="ipsDataItem_selected">
    					<div class="ipsDataItem_main ipsPos_middle">
    						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'still_needed', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
    					</div>
    					<div class="ipsDataItem_stats ipsDataItem_statsLarge">
    						<span class="ipsDataItem_stats_number">
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalGoals'] - $stats['totalDonations'], -1, '', '' );
$return .= <<<CONTENT
</span>
    					</div>
    				</li>                
    				<li class="ipsDataItem">
    					<div class="ipsDataItem_main ipsType_center ipsPos_middle">
    					   <div data-ipsTooltip data-ipsTooltip-label="
CONTENT;

if ( round( $stats['totalDonations'] / $stats['totalGoals'] * 100 ) > 100 ):
$return .= <<<CONTENT
100
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( round( $stats['totalDonations'] / $stats['totalGoals'] * 100 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( round( $stats['totalDonations'] / $stats['totalGoals'] * 100 ) > 100 ):
$return .= <<<CONTENT
100
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( round( $stats['totalDonations'] / $stats['totalGoals'] * 100 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
%'></span></span><br>
                                <span class='ipsType_light ipsType_small ipsResponsive_hidePhone'>
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalDonations'], -1, '', '' );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_of', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalGoals'], -1, '', '' );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'goal_reached', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>		
                        	</div>  
    					</div>	
    				</li> 
                
CONTENT;

endif;
$return .= <<<CONTENT
              
			</ul>
          
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsGrid ipsGrid_collapsePhone ipsWidget_stats'>
			<div class='ipsGrid_span3 ipsType_center'>
				<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalDonations'], -1, '', '' );
$return .= <<<CONTENT
</span><br>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_donations', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>
            
CONTENT;

if ( isset( $stats['totalFees'] ) ):
$return .= <<<CONTENT

    			<div class='ipsGrid_span3 ipsType_center'>
    				<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalFees'], -1, '', '' );
$return .= <<<CONTENT
</span><br>
    				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_fees', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
    			</div>            
            
CONTENT;

endif;
$return .= <<<CONTENT
                   
            
CONTENT;

if ( $stats['totalGoals'] ):
$return .= <<<CONTENT

    			<div class='ipsGrid_span3 ipsType_center'>
    				<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalGoals'], -1, '', '' );
$return .= <<<CONTENT
</span><br>
    				<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'total_goals', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
    			</div>
    			<div class='ipsGrid_span3 ipsType_center'>				
    				<div>
    					<span class='ipsType_normal'>
                        	<div data-ipsTooltip data-ipsTooltip-label="
CONTENT;

if ( round( $stats['totalDonations'] / $stats['totalGoals'] * 100 ) > 100 ):
$return .= <<<CONTENT
100
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( round( $stats['totalDonations'] / $stats['totalGoals'] * 100 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
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

if ( round( $stats['totalDonations'] / $stats['totalGoals'] * 100 ) > 100 ):
$return .= <<<CONTENT
100
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( round( $stats['totalDonations'] / $stats['totalGoals'] * 100 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
%'></span></span><br>
                                <span class='ipsType_light ipsType_small ipsResponsive_hidePhone'>
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalDonations'], -1, '', '' );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_of', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$return .= new \IPS\donate\Currency\Money( $stats['totalGoals'], -1, '', '' );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'goal_reached', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>		
                        	</div> 
                        </span>
    				</div>
    			</div>
            
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}}