<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2016 DevFuse
 */

namespace IPS\donate\modules\front\donate;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Send Donations
 */
class _send extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{	
		parent::execute();
	}

	/**
	 * Edit Donation Total
	 *
	 * @return	void
	 */
	protected function editTotal()
	{
		/* Can view app? */
		if ( !\IPS\Member::loggedIn()->group['g_dt_moderate_donations'] )
		{
			\IPS\Output::i()->error( 'donate_no_managetotal_perms', '', 403, '' );
		}

		/* Get member */
		$member = \IPS\Member::load( \IPS\Request::i()->member );
		if ( !$member->member_id )
		{
			\IPS\Output::i()->error( 'node_error', '', 404, '' );
		}	   
        
		/* Build form */
		$form = new \IPS\Helpers\Form;
        $form->add( new \IPS\Helpers\Form\Number( 'donate_c_new_amount', $member->donate_amount, FALSE, array( 'decimals' => 2 ) ) );
        $form->add( new \IPS\Helpers\Form\TextArea( 'donate_c_notes', NULL ) );	   
       
		/* Save form */
		if ( $values = $form->values() )
		{
            /* Log donation change */ 
			\IPS\Db::i()->insert( 'donate_changes', array(
				'c_donor'	        => $member->member_id,
				'c_member'	        => \IPS\Member::loggedIn()->member_id,
				'c_date'	        => time(),
				'c_previous_amount'	=> $member->donate_amount,
				'c_new_amount'	    => number_format( $values['donate_c_new_amount'], '2', '.' ,'' ),
				'c_notes'		    => ( isset( $values['donate_c_notes'] ) AND $values['donate_c_notes'] ) ? $values['donate_c_notes'] : NULL,
			) );            	  
          
		    /* Update donation total */ 
            $member->donate_amount = number_format( $values['donate_c_new_amount'], '2', '.', '' );   
            $member->save();         

			\IPS\Output::i()->redirect( $member->url()->setQueryString( array( 'tab' => 'node_donate_DonateChanges' ) ) );
		}
		
		/* Display form */
        \IPS\Output::i()->sidebar['enabled'] = FALSE;
        \IPS\Output::i()->title	= \IPS\Member::loggedIn()->language()->addToStack('donate_edit_donation_total');
		\IPS\Output::i()->output = $form->customTemplate( array( call_user_func_array( array( \IPS\Theme::i(), 'getTemplate' ), array( 'forms', 'core' ) ), 'popupTemplate' ) );
	} 
    
	/**
	 * Send Donation Total
	 *
	 * @return	void
	 */
	protected function sendTotal()
	{
		/* Can view app? */
		if ( !\IPS\Member::loggedIn()->group['g_dt_send_donations'] )
		{
			\IPS\Output::i()->error( 'donate_no_sendtotal_perms', '', 403, '' );
		}

        /* Build form */
		$form = new \IPS\Helpers\Form( 'form', 'donate_send_donation' );
		$form->class = 'ipsPad';
        
        $form->add( new \IPS\Helpers\Form\Member( 'donatesend_member_id', NULL, TRUE, array(), function( $member )
			{
			    /* We can not send to ourself */ 
				if( is_object( $member ) AND $member->member_id == \IPS\Member::loggedIn()->member_id )
                {
                    throw new \InvalidArgumentException( 'donate_no_send_self' );    
                }
			} ) );
        $form->add( new \IPS\Helpers\Form\Number( 'donatesend_amount', 0, TRUE, array( 'decimals' => 2 ), function( $val )
			{
			    /* You can only give what you have */ 
				if( $val > \IPS\Member::loggedIn()->donate_amount )
                {
                    throw new \InvalidArgumentException( 'donate_no_send_excess' );    
                }
			} ) );
        $form->add( new \IPS\Helpers\Form\TextArea( 'donatesend_note', NULL, FALSE, array() ) );                                   
       
		/* Save form */
		if ( $values = $form->values() )
		{
            /* Add log for sender */ 
			\IPS\Db::i()->insert( 'donate_changes', array(
				'c_donor'	        => \IPS\Member::loggedIn()->member_id,
				'c_member'	        => \IPS\Member::loggedIn()->member_id,
				'c_date'	        => time(),
				'c_previous_amount'	=> \IPS\Member::loggedIn()->donate_amount,
				'c_new_amount'	    => number_format( \IPS\Member::loggedIn()->donate_amount - $values['donatesend_amount'], '2', '.' ,'' ),
				'c_notes'		    => ( isset( $values['donatesend_note'] ) AND $values['donatesend_note'] ) ? $values['donatesend_note'] . ' (' . \IPS\Member::loggedIn()->language()->get('donate_send_note') . $values['donatesend_member_id']->name .' )' : '(' . \IPS\Member::loggedIn()->language()->get('donate_send_note') . $values['donatesend_member_id']->name .' )',
			    'c_approved'        => 0
            ) );            	  
          
		    /* Minus senders total donations */ 
            \IPS\Member::loggedIn()->donate_amount = number_format( \IPS\Member::loggedIn()->donate_amount - $values['donatesend_amount'], '2', '.', '' );   
            \IPS\Member::loggedIn()->save();
            
            /* Add log for receiver */ 
			\IPS\Db::i()->insert( 'donate_changes', array(
				'c_donor'	        => $values['donatesend_member_id']->member_id,
				'c_member'	        => \IPS\Member::loggedIn()->member_id,
				'c_date'	        => time(),
				'c_previous_amount'	=> $values['donatesend_member_id']->donate_amount,
				'c_new_amount'	    => number_format( $values['donatesend_member_id']->donate_amount + $values['donatesend_amount'], '2', '.' ,'' ),
				'c_notes'		    => ( isset( $values['donatesend_note'] ) AND $values['donatesend_note'] ) ? $values['donatesend_note'] : NULL,
                'c_approved'        => 0
			) );                    

			\IPS\Output::i()->redirect( \IPS\Member::loggedIn()->url()->setQueryString( array( 'tab' => 'node_donate_DonateChanges' ) ) );
		}
		
		/* Display form */
        \IPS\Output::i()->sidebar['enabled'] = FALSE;
        \IPS\Output::i()->title	 = \IPS\Member::loggedIn()->language()->addToStack('donate_send_donation_total');
		\IPS\Output::i()->output = $form->customTemplate( array( call_user_func_array( array( \IPS\Theme::i(), 'getTemplate' ), array( 'forms', 'core' ) ), 'popupTemplate' ) );
	}
    

	/**
	 * Approve transfer
	 *
	 * @return	void
	 */
	protected function approve()
	{ 
        /* Get transfer details */
        try
        {
            $transfer = \IPS\Db::i()->select( '*', 'donate_changes', array( 'c_id=? AND c_approved=0 AND c_donor != c_member', \IPS\Request::i()->id ) )->first();
        }
		catch( \UnderflowException $ex )
		{
			\IPS\Output::i()->error( 'donate_no_transfer_found', '', 403, '' );
		}        

        /* Work out transfer difference */
        $changeAmount = $transfer['c_new_amount'] - $transfer['c_previous_amount'];
        
        /* Transfer amount across */
        try
        {
            $member = \IPS\Member::load( $transfer['c_donor'] );               
            $member->donate_amount = number_format( $member->donate_amount + $changeAmount, '2', '.', '' );   
            $member->save();     
        }
    	catch( \OutOfRangeException $ex )
        {
            \IPS\Output::i()->error( 'donate_no_transfer_found', '', 403, '' );    
        }   
        
        /* Mark sender and receiver transfers as approved now */
        \IPS\Db::i()->update( 'donate_changes', array( 'c_approved' => 1 ), array( 'c_id=?', $transfer['c_id'] ) );
        \IPS\Db::i()->update( 'donate_changes', array( 'c_approved' => 1 ), array( 'c_id=?', $transfer['c_id'] - 1 ) );
        
        /* Redirect back to profile tab */
        \IPS\Output::i()->redirect( $member->url()->setQueryString( array( 'tab' => 'node_donate_DonateChanges' ) ) );        
    }
    
	/**
	 * Reject transfer
	 *
	 * @return	void
	 */
	protected function reject()
	{ 
        /* Get transfer details */
        try
        {
            $transfer = \IPS\Db::i()->select( '*', 'donate_changes', array( 'c_id=? AND c_approved=0 AND c_donor != c_member', \IPS\Request::i()->id ) )->first();
        }
		catch( \UnderflowException $ex )
		{
			\IPS\Output::i()->error( 'donate_no_transfer_found', '', 403, '' );
		}        

        /* Work out transfer difference */
        $changeAmount = $transfer['c_new_amount'] - $transfer['c_previous_amount'];

        /* Give back transfer amount */
        try
        {
            $member = \IPS\Member::load( $transfer['c_member'] );               
            $member->donate_amount = number_format( $member->donate_amount + $changeAmount, '2', '.', '' );   
            $member->save();     
        }
    	catch( \OutOfRangeException $ex )
        {
            \IPS\Output::i()->error( 'donate_no_transfer_found', '', 403, '' );    
        }   
        
        /* Mark sender and receiver transfers as approved now */
        \IPS\Db::i()->update( 'donate_changes', array( 'c_approved' => 2 ), array( 'c_id=?', $transfer['c_id'] ) );
        \IPS\Db::i()->update( 'donate_changes', array( 'c_approved' => 2 ), array( 'c_id=?', $transfer['c_id'] - 1 ) );
        
        /* Redirect back to profile tab */
        \IPS\Output::i()->redirect( \IPS\Member::loggedIn()->url()->setQueryString( array( 'tab' => 'node_donate_DonateChanges' ) ) );        
    }    
}