<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
namespace IPS\donate;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Promotion Node
 */
class _Promotion extends \IPS\Patterns\ActiveRecord
{
	/**
	 * @brief	[ActiveRecord] Multiton Store
	 */
	protected static $multitons;    
    protected static $databaseIdFields = array( 'member_id' );
	public static $databaseColumnId = 'id';        
	public static $databaseTable = 'donate_demote';
	public static $databasePrefix = '';	

	/**
	 * [ActiveRecord] Save Record
	 *
	 * @return	void
	 */
	public function save()
	{
        if( is_array( $this->demote_group2 ) )
        {
            $this->demote_group2 = implode( ",", $this->demote_group2 );
        }    

		if( $this->demote_date instanceof \IPS\DateTime )
		{
			$this->demote_date = $this->demote_date->getTimestamp();
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