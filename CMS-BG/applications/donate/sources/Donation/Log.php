<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
namespace IPS\donate\Donation;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Log Record
 */
class _Log extends \IPS\Patterns\ActiveRecord
{
	/**
	 * @brief	[ActiveRecord] Multiton Store
	 */
	protected static $multitons;    
	public static $databaseTable = 'donate_logs';
	public static $databasePrefix = '';	 

	/**
	 * [ActiveRecord] Save Record
	 *
	 * @return	void
	 */
	public function save()
	{
	    /* Fill in default fields */
        if( !$this->author_id )
        {
            $this->author_id = (int) \IPS\Member::loggedIn()->member_id;
        }
        if( !$this->author_name )
        {
            $this->author_name = \IPS\Member::loggedIn()->name;
        }
        if( !$this->ip_address )
        {            
            $this->ip_address = \IPS\Request::i()->ipAddress();
        }

        $this->date = time();

        /* Require problem field */
        if( !$this->problem )
        {        
            $this->problem = \IPS\Member::loggedIn()->language()->get( 'donationlog__donation' );
        }
        
        /* Append post data */
        if( $this->post_data )
        {
            $this->post_data = $this->post_data ."<br><br>". print_r( $_POST, TRUE );
        }
        else
        {
            $this->post_data = print_r( $_POST, TRUE );    
        }
       
		return parent::save();
	}

	/**
	 * [ActiveRecord] Delete Record
	 *
	 * @return	void
	 */
	public function delete()
	{
		return parent::delete();
	}
}