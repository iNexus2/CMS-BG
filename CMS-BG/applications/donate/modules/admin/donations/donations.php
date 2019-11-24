<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\modules\admin\donations;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * donations
 */
class _donations extends \IPS\Dispatcher\Controller
{	
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'donations_manage' );
		parent::execute();
	}
    
	/**
	 * Manage
	 *
	 * @return	void
	 */
	protected function manage()
	{		
		/* Create the table */
		$table = new \IPS\Helpers\Table\Db( 'donate_users', \IPS\Http\Url::internal( 'app=donate&module=donations&controller=donations' ) );
		$table->langPrefix = 'donation_';

		/* Column stuff */
		$table->include = array( 'member_id', 'date', 'goal', 'amount', 'note', 'status' );
		$table->mainColumn = 'date_added';
		$table->widths  = array(
			'status' => '5'
		);

		/* Sort stuff */
		$table->sortBy = $table->sortBy ?: 'date';
		$table->sortDirection = $table->sortDirection ?: 'desc';

		/* Search */
		$table->quickSearch = 'member_name';
		$table->advancedSearch = array(
			'member_id'	   => \IPS\Helpers\Table\SEARCH_MEMBER,
			'date'	       => \IPS\Helpers\Table\SEARCH_DATE_RANGE,
            'amount'	       => \IPS\Helpers\Table\SEARCH_NUMERIC,
			'currency'	=> array( \IPS\Helpers\Table\SEARCH_NODE, array(
				'class'				=> '\IPS\donate\Currency',
				'zeroVal'			=> 'any'
			) ),             
			'note'	 => \IPS\Helpers\Table\SEARCH_CONTAINS_TEXT,   
			'goal'	=> array( \IPS\Helpers\Table\SEARCH_NODE, array(
				'class'				=> '\IPS\donate\Goal',
				'zeroVal'			=> 'any'
			) ),                                                   
			);

		/* Formatters */
		$table->parsers = array(
			'member_id'	=> function( $val, $row )
			{
				try
				{
				    $member = htmlentities( \IPS\Member::load( $val )->name, \IPS\HTMLENTITIES, 'UTF-8', FALSE );
                    
				    if( $row['anon'] )
                    {
                         return "<span class='ipsType_light' data-ipstooltip='' data-ipstooltip-label='".\IPS\Member::loggedIn()->language()->addToStack('anonymous_donation')."'><s>{$member}</s></span>";   
                    }				    
                    
					return $member;
				}
				catch ( \OutOfRangeException $e )
				{
					return '--';
				}
			},        
			'date'			=> function( $val, $row )
			{
				$date	= \IPS\DateTime::ts( $val );

				return $date->localeDate();
			},
			'goal' => function( $val )
			{
				try
				{
					return \IPS\donate\Goal::load( $val )->_title;
				}
				catch ( \OutOfRangeException $e )
				{
					return '--';
				}
			},
			'amount' => function( $val, $row )
			{             
				try
				{
				    $amount = new \IPS\donate\Currency\Money( $val, \IPS\donate\Currency::load( $row['currency'] )->tag ); 
                    
				    if( $row['anon_amount'] )
                    {
                         return "<span class='ipsType_light' data-ipstooltip='' data-ipstooltip-label='".\IPS\Member::loggedIn()->language()->addToStack('anonymous_donation_amount')."'><s>{$amount}</s></span>";   
                    }
                    
				    return $amount;
				}
				catch ( \OutOfRangeException $e )
				{
					return '--';
				}
			},
			'note' => function( $val )
			{
				if( $val )
                {
                    return $val;   
                }
				{
					return '--';
				}
			}, 
			'status' => function( $val )
			{
				if( $val )
                {
                    return "<span class='ipsBadge ipsBadge_positive'>".\IPS\Member::loggedIn()->language()->addToStack('approved')."</span>";   
                }
				{
					return "<span class='ipsBadge ipsBadge_negative'>".\IPS\Member::loggedIn()->language()->addToStack('unapproved')."</span>";
				}
			},             
                                 
		);
        
        /* Root buttons */
		$table->rootButtons = array(
			'add'		=> array(
				'icon'		=> 'plus',
				'title'		=> 'add_donation',
				'link'		=> \IPS\Http\Url::internal( 'app=donate&module=donations&controller=donations&do=add' ),
                'data'		=> array( 'ipsDialog' => '' ),
			),
		);        

		/* Row buttons */
		$table->rowButtons = function( $row )
		{
			$return['edit'] = array(
				'icon'		=> 'pencil',
				'title'		=> 'edit',
				'link'		=> \IPS\Http\Url::internal( 'app=donate&module=donations&controller=donations&do=edit&id=' ) . $row['id'],
				'hotkey'	=> 'e',
                'data'		=> array( 'ipsDialog' => '' ),
			);
					
			$return['delete'] = array(
				'icon'		=> 'times-circle',
				'title'		=> 'delete',
				'link'		=> \IPS\Http\Url::internal( 'app=donate&module=donations&controller=donations&do=delete&id=' ) . $row['id'],
				'data'		=> array( 'delete' => '' ),
			);
			
			return $return;
		};

		/* Display */
		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack('donations');
		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'global', 'core' )->block( 'title', (string) $table );
	}  
    
	/**
	 * Add donation
	 *
	 * @return	void
	 */
	public function add()
	{
		/* Page title */
		\IPS\Output::i()->title	= \IPS\Member::loggedIn()->language()->addToStack('add_donation');

		/* Donation form */
		$form = new \IPS\Helpers\Form;
        $form->addHeader('basic_settings');
		$form->add( new \IPS\Helpers\Form\YesNo( 'donation_status', TRUE, FALSE ) );
		$form->add( new \IPS\Helpers\Form\Member( 'donation_member_id', NULL, FALSE, array() ) );
        $form->add( new \IPS\Helpers\Form\Date( 'donation_date', NULL, FALSE ) );
        $form->add( new \IPS\Helpers\Form\Number( 'donation_amount', 0, TRUE, array( 'decimals' => 2, 'min' => -10000 ), NULL, NULL, NULL, 'amount' ) );     
        $form->add( new \IPS\Helpers\Form\Number( 'donation_fees', 0, FALSE, array( 'decimals' => 2 ), NULL, NULL, NULL, 'fees' ) );     
        $form->add( new \IPS\Helpers\Form\Node( 'donation_currency', 1, FALSE, array( 'class' => '\IPS\donate\Currency' ) ) );
		$form->add( new \IPS\Helpers\Form\Node( 'donation_goal', NULL, FALSE, array( 'class' => 'IPS\donate\Goal', 'url' => \IPS\Http\Url::internal( 'app=donate&module=donations&controller=donations&do=add', 'admin' ) ) ) );
		$form->add( new \IPS\Helpers\Form\TextArea( 'donation_note', NULL, FALSE ) );

        $form->addHeader('advanced_settings');
        $form->add( new \IPS\Helpers\Form\YesNo( 'donation_anon', FALSE, FALSE ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'donation_anon_amount', FALSE, FALSE ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'donation_upgrade_group', TRUE, FALSE ) );

		/* Handle submissions */
		if ( $values = $form->values() )
		{
			/* Insert the new record */
			$donation	= new \IPS\donate\Donation;
			$donation->status	   = $values['donation_status'];
			$donation->member_id   = ( $values['donation_member_id'] instanceof \IPS\Member ) ? $values['donation_member_id']->member_id : 0;
            $donation->member_name = ( $values['donation_member_id'] instanceof \IPS\Member ) ? $values['donation_member_id']->name : 0;
			$donation->date	       = ( isset( $values['donation_date'] ) AND $values['donation_date'] ) ? $values['donation_date']->getTimestamp() : time();
			$donation->amount	   = $values['donation_amount'];
			$donation->fees	       = $values['donation_fees'];
			$donation->currency	   = $values['donation_currency']->_id;
            $donation->rate	       = ( isset( $values['donation_currency'] ) AND $values['donation_currency'] ) ? $values['donation_currency']->rate : 1;
			$donation->goal	       = ( $values['donation_goal'] instanceof \IPS\donate\Goal ) ? $values['donation_goal']->_id : 0;
			$donation->note	       = $values['donation_note'];  
			$donation->anon	       = $values['donation_anon'];  
 			$donation->anon_amount = $values['donation_anon_amount'];                                                      
			$donation->save();
            
            /* Build goal stats */
            if( isset( $values['donation_goal'] ) AND $values['donation_goal'] )
            {
                $container = \IPS\donate\Goal::load( $values['donation_goal']->_id ); 
                $container->rebuildGoalStats();   
            }
            
            /* Run member group upgrade */
            if( isset( $values['donation_upgrade_group'] ) AND $values['donation_upgrade_group'] AND $values['donation_member_id'] )
            {
                \IPS\donate\Reward::issue( $values['donation_amount'], $values['donation_member_id'] );    
            }
            
            /* Update donor count */
            if( isset( $values['donation_member_id'] ) AND $values['donation_member_id'] instanceof \IPS\Member )
            {
        		$donation->rebuildDonorCount( $values['donation_member_id'] );               
            }         

			/* Redirect */
			\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=donate&module=donations&controller=donations' ), 'saved' );
		}

		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'global', 'core' )->block( 'add_donation', $form, FALSE );
	} 
    
	/**
	 * Edit donation
	 *
	 * @return	void
	 */
	public function edit()
	{
		/* Page title */
		\IPS\Output::i()->title	= \IPS\Member::loggedIn()->language()->addToStack('edit_donation');

		/* Get existing record */
		try
		{
			$donation = \IPS\donate\Donation::load( \IPS\Request::i()->id );
		}
		catch( \OutOfRangeException $e )
		{
			\IPS\Output::i()->error( 'donation_not_found', '', 404, '' );
		}

		/* Donation form */
		$form = new \IPS\Helpers\Form;
        $form->addHeader('basic_settings');
		$form->add( new \IPS\Helpers\Form\YesNo( 'donation_status', $donation->status ? TRUE : FALSE , FALSE ) );
		$form->add( new \IPS\Helpers\Form\Member( 'donation_member_id', ( $donation->member_id ) ? \IPS\Member::load( $donation->member_id ) : NULL, FALSE, array() ) );
        $form->add( new \IPS\Helpers\Form\Date( 'donation_date', $donation->date, TRUE ) );
        $form->add( new \IPS\Helpers\Form\Number( 'donation_amount', $donation->amount, TRUE, array( 'decimals' => 2, 'min' => -10000 ), NULL, NULL, NULL, 'amount' ) );     
        $form->add( new \IPS\Helpers\Form\Number( 'donation_fees', $donation->fees, FALSE, array( 'decimals' => 2 ), NULL, NULL, NULL, 'fees' ) );     
        $form->add( new \IPS\Helpers\Form\Node( 'donation_currency', $donation->currency, FALSE, array( 'class' => '\IPS\donate\Currency' ) ) );
		$form->add( new \IPS\Helpers\Form\Node( 'donation_goal', $donation->goal ? $donation->goal : NULL, FALSE, array( 'class' => 'IPS\donate\Goal', 'url' => \IPS\Http\Url::internal( 'app=donate&module=donations&controller=donations&do=add', 'admin' ) ) ) );
		$form->add( new \IPS\Helpers\Form\TextArea( 'donation_note', $donation->note ? $donation->note : NULL, FALSE ) );

        $form->addHeader('advanced_settings');
        $form->add( new \IPS\Helpers\Form\YesNo( 'donation_anon', $donation->anon ? TRUE : FALSE, FALSE ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'donation_anon_amount', $donation->anon_amount ? TRUE : FALSE, FALSE ) );

		/* Handle submissions */
		if ( $values = $form->values() )
		{
			$donation->status	   = $values['donation_status'];
			$donation->member_id   = ( $values['donation_member_id'] instanceof \IPS\Member ) ? $values['donation_member_id']->member_id : 0;
            $donation->member_name = ( $values['donation_member_id'] instanceof \IPS\Member ) ? $values['donation_member_id']->name : 0;
			$donation->date	       = ( isset( $values['donation_date'] ) AND $values['donation_date'] ) ? $values['donation_date']->getTimestamp() : time();
			$donation->amount	   = $values['donation_amount'];
			$donation->fees	       = $values['donation_fees'];
			$donation->currency	   = $values['donation_currency']->_id;
            $donation->rate	       = ( isset( $values['donation_currency'] ) AND $values['donation_currency'] ) ? $values['donation_currency']->rate : 1;
			$donation->goal	       = ( $values['donation_goal'] instanceof \IPS\donate\Goal ) ? $values['donation_goal']->_id : 0;
			$donation->note	       = $values['donation_note'];  
			$donation->anon	       = $values['donation_anon'];  
 			$donation->anon_amount = $values['donation_anon_amount'];   		                                                        
			$donation->save();
            
            /* Build goal stats */
            if( isset( $values['donation_goal'] ) AND $values['donation_goal'] )
            {
                $container = \IPS\donate\Goal::load( $values['donation_goal']->_id ); 
                $container->rebuildGoalStats();   
            }    
            
            /* Update donor count */
            if( isset( $values['donation_member_id'] ) AND $values['donation_member_id'] instanceof \IPS\Member )
            {
        		$donation->rebuildDonorCount( $values['donation_member_id'] );               
            }                    

			/* Redirect */
			\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=donate&module=donations&controller=donations' ), 'saved' );
		}

		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'global', 'core' )->block( 'edit_donation', $form, FALSE );
	}
    
	/**
	 * Delete donation
	 *
	 * @return	void
	 */
	protected function delete()
	{
		/* Delete the donation */
		try
		{
			$donation = \IPS\donate\Donation::load( \IPS\Request::i()->id );
			$donation->delete();
		}
		catch( \OutOfRangeException $e )
		{
			\IPS\Output::i()->error( 'donation_not_found', '', 404, '' );
		}	   
		
		/* Redirect */
		\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=donate&module=donations&controller=donations' ) );
	}             
}