<?php
namespace IPS\Theme\Cache;
class class_donate_front_global extends \IPS\Theme\Template
{
	public $cache_key = '00fbddddc19148f36701c264fe3c6edf';
	function donateChangeRow( $table, $headers, $rows, $includeFirstCommentInCommentCount=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		<li class="ipsDataItem ipsDataItem_responsivePhoto 
CONTENT;

if ( !$row['c_approved'] ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( method_exists( $row, 'tableClass' ) && $row->tableClass() ):
$return .= <<<CONTENT
ipsDataItem_
CONTENT;
$return .= htmlspecialchars( $row->tableClass(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
        	<div class='ipsDataItem_generic ipsDataItem_size3'>
        		<span class='ipsBadge ipsBadge_button ipsBadge_verySmall 
CONTENT;

if ( $row['c_new_amount'] == $row['c_previous_amount'] ):
$return .= <<<CONTENT
ipsBadge_neutral
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $row['c_new_amount'] > $row['c_previous_amount'] ):
$return .= <<<CONTENT
ipsBadge_positive
CONTENT;

else:
$return .= <<<CONTENT
ipsBadge_negative
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

if ( $row['c_new_amount'] == $row['c_previous_amount'] ):
$return .= <<<CONTENT
No Change
CONTENT;

else:
$return .= <<<CONTENT
<i class='fa fa-
CONTENT;

if ( $row['c_new_amount'] > $row['c_previous_amount'] ):
$return .= <<<CONTENT
plus
CONTENT;

else:
$return .= <<<CONTENT
minus
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= new \IPS\donate\Currency\Money( $row['c_new_amount'] - $row['c_previous_amount'], '', '' );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
        	</div>

			<div class='ipsDataItem_main'>
				<h4 class='ipsDataItem_title ipsType_break'>
                    
CONTENT;

if ( $row['c_notes'] ):
$return .= <<<CONTENT
{$row['c_notes']}
CONTENT;

else:
$return .= <<<CONTENT
<i>No note left..</i>
CONTENT;

endif;
$return .= <<<CONTENT
   
				</h4>

				
CONTENT;

if ( !$row['c_approved'] AND $row['c_donor']->member_id != $row['c_member']->member_id ):
$return .= <<<CONTENT

                    <ul class='ipsButton_split ipsPos_right'>
                        <li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate&module=donate&controller=send&do=approve&id={$row['c_id']}", "front", "", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_positive'>Approve</a></li>
                        <li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate&module=donate&controller=send&do=reject&id={$row['c_id']}", "front", "", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_negative' data-confirm>Reject</a></li>
                    </ul>
                
CONTENT;

endif;
$return .= <<<CONTENT
   
				
CONTENT;

if ( !$row['c_approved'] AND $row['c_donor']->member_id == $row['c_member']->member_id ):
$return .= <<<CONTENT

                    <span class='ipsPos_right ipsBadge ipsBadge_warning'>Transfer Pending</span>
                
CONTENT;

endif;
$return .= <<<CONTENT
  
				
CONTENT;

if ( $row['c_approved'] == 2 ):
$return .= <<<CONTENT

                    <span class='ipsPos_right ipsBadge ipsBadge_negative'>Transfer Rejected</span>
                
CONTENT;

endif;
$return .= <<<CONTENT
                                            
			</div>
    		<ul class='ipsDataItem_lastPoster ipsDataItem_withPhoto'>
                
CONTENT;

if ( $row['c_member'] ):
$return .= <<<CONTENT

        			<li>		
                        
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row['c_member'], 'tiny' );
$return .= <<<CONTENT

        			</li>
                
CONTENT;

endif;
$return .= <<<CONTENT

    			<li>
                    
CONTENT;

if ( $row['c_member'] ):
$return .= <<<CONTENT

                        {$row['c_member']->link()}
                    
CONTENT;

endif;
$return .= <<<CONTENT
                    	
    			</li>              
    			<li class="ipsType_light">
                    
CONTENT;

$val = ( $row['c_date'] instanceof \IPS\DateTime ) ? $row['c_date'] : \IPS\DateTime::ts( $row['c_date'] );$return .= $val->html();
$return .= <<<CONTENT

    			</li>
    		</ul>			           
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function profileHook( $member ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Member::loggedIn()->member_id == $member->member_id OR \IPS\Member::loggedIn()->group['g_dt_moderate_donations'] ):
$return .= <<<CONTENT

    <li>
	    <h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_member_donations', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
	    
CONTENT;

if ( \IPS\Member::loggedIn()->member_id == $member->member_id OR \IPS\Member::loggedIn()->group['g_dt_moderate_donations'] ):
$return .= <<<CONTENT
<a href='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( array( 'tab' => 'node_donate_DonateChanges' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$return .= new \IPS\donate\Currency\Money( $member->donate_amount, -1, '' );
$return .= <<<CONTENT

CONTENT;

if ( \IPS\Member::loggedIn()->member_id == $member->member_id OR \IPS\Member::loggedIn()->group['g_dt_moderate_donations'] ):
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT
&nbsp;

        
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_dt_moderate_donations'] ):
$return .= <<<CONTENT
    
        	<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=donate&module=donate&controller=send&do=editTotal&member={$member->member_id}", "front", "", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks' data-ipsDialog data-ipsDialog-modal='true' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donate_edit_donation_total', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
        		<i class='fa fa-pencil-square'></i>&nbsp;</span>
        	</a>  
        
CONTENT;

endif;
$return .= <<<CONTENT
              
    </li> 

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function topicView( $comment ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Settings::i()->dt_hide_topic_hook AND $comment->author()->donate_donations ):
$return .= <<<CONTENT

	<li class="ipsType_light ipsSpacer_top" data-ipsTooltip title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'donor_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">      
		<span class="ipsBadge ipsBadge_small ipsBadge_icon ipsBadge_positive"><i class="fa fa-dollar"></i></span> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_donor', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</li>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}