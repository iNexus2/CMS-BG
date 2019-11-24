<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\widgets;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * donateStats Widget
 */
class _donateStats extends \IPS\Widget\PermissionCache
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'donateStats';
	
	/**
	 * @brief	App
	 */
	public $app = 'donate';
		
	/**
	 * @brief	Plugin
	 */
	public $plugin = '';
	
	/**
	 * Initialise this widget
	 *
	 * @return void
	 */ 
	public function init()
	{
		parent::init();
	}

	/**
	 * Render a widget
	 *
	 * @return	string
	 */
	public function render()
	{
	    $stats = array();

        /* Get donation totals */
        $donationWhere[] = array( 'donate_users.status=? AND donate_goals.g_show=?', 1, 1 );
        
        /* Automatic reset? */
        if( \IPS\Settings::i()->dt_donation_reset )
        {
            $donationWhere[] = array( 'date>?', (int) \IPS\Settings::i()->dt_donation_reset );    
        }      
        /*if( \IPS\Settings::i()->dt_goal_reset )
        {
            $donationWhere[] = array( 'donate_goals.g_start_date>?', (int) \IPS\Settings::i()->dt_goal_reset );    
        }*/   
        
        $stats['totalDonations'] = \IPS\Db::i()->select( 'SUM(amount * rate)', 'donate_users', $donationWhere )->join(
					'donate_goals',
					'donate_goals.g_id=donate_users.goal'
			)->first();   
        
        /* Get fee totals */
        if( \IPS\Settings::i()->dt_include_fees )
        {
            $stats['totalFees'] = \IPS\Db::i()->select( 'SUM(fees)', 'donate_users', $donationWhere )->join(
					'donate_goals',
					'donate_goals.g_id=donate_users.goal'
			)->first();  
            
            /* Take out fees for donation total */
            $stats['totalDonations'] = $stats['totalDonations'] - $stats['totalFees'];
        }
                
        /* Get goal totals */
        if( \IPS\Settings::i()->dt_goal_total )
        {
            $stats['totalGoals'] = \IPS\Settings::i()->dt_goal_total;    
        }
        else
        {
            $goalWhere[] = array( 'g_show=?', 1 );
            
            /* Automatic reset? */
            /*if( \IPS\Settings::i()->dt_goal_reset )
            {
                $goalWhere[] = array( 'g_start_date>?', (int) \IPS\Settings::i()->dt_goal_reset );    
            }*/           
            
            $stats['totalGoals'] = \IPS\Db::i()->select( 'SUM(g_amount)', 'donate_goals', $goalWhere )->first();     
        }        
       
		return $this->output( $stats );
	}
}