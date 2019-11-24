<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\tasks;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * groupDemotion Task
 */
class _groupDemotion extends \IPS\Task
{
	/**
	 * Execute
	 *
	 * If ran successfully, should return anything worth logging. Only log something
	 * worth mentioning (don't log "task ran successfully"). Return NULL (actual NULL, not '' or 0) to not log (which will be most cases).
	 * If an error occurs which means the task could not finish running, throw an \IPS\Task\Exception - do not log an error as a normal log.
	 * Tasks should execute within the time of a normal HTTP request.
	 *
	 * @return	mixed	Message to log or NULL
	 * @throws	\IPS\Task\Exception
	 */
	public function execute()
	{
		/* Look for accounts ready for demotion */
		foreach( \IPS\Db::i()->select( '*', 'donate_demote', array( 'demote_date<?', time() ) ) as $demotion )
		{
		    /* Get member details */
    		try
    		{
				$member	= \IPS\Member::load( $demotion['member_id'] );
				
                /* Demote primary group */
				if( $member->member_id AND $demotion['demote_group'] )
				{
                    $member->member_group_id = $demotion['demote_group'];				    
				}
                /* Demote secondary group */
				if( $member->member_id AND $demotion['demote_group2'] )
				{
                    $member->mgroup_others = $demotion['demote_group2']; 				    
				}   
                
                /* Alright update member now */
                if( $member->member_id AND ( $demotion['demote_group'] OR $demotion['demote_group2'] ) ) 
                {
                    $member->save();
                }                 		  
    		}
    		catch( \OutOfRangeException $e ){}
			catch( \Exception $e )
			{
				throw new \IPS\Task\Exception( $this, \IPS\Member::loggedIn()->language()->addToStack( 'task_' . $e->getMessage(), FALSE, array( 'sprintf' => array( $demotion['member_id'] ) ) ) );
			}            		  
          
            /* Delete promotion now */
			\IPS\donate\Promotion::load( $demotion['id'] )->delete();
		} 

        return NULL;
	}
	
	/**
	 * Cleanup
	 *
	 * If your task takes longer than 15 minutes to run, this method
	 * will be called before execute(). Use it to clean up anything which
	 * may not have been done
	 *
	 * @return	void
	 */
	public function cleanup()
	{
		
	}
}