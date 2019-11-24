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
 * Currency Node
 */
class _Currency extends \IPS\Node\Model
{
	/**
	 * @brief	[ActiveRecord] Multiton Store
	 */
	protected static $multitons;    
    protected static $databaseIdFields = array( 'c_name', 'c_tag' );
	public static $databaseColumnId = 'id';    
	public static $databaseTable = 'donate_currency';
	public static $databasePrefix = 'c_';
	public static $nodeTitle = 'currencies';
    public static $databaseColumnOrder = 'position';

	public static $databaseColumnMap = array(
		'title'	=> 'name',
	);

	/**
	 * Set the title
	 *
	 * @param	string	$title	Title
	 * @return	void
	 */
	public function set_title( $title )
	{
		$this->_data['name'] = $title;
	}

	public function get__title()
	{
		if ( !$this->id )
		{
			return '';
		}	   
       
        return $this->name;
	}
    
	/**
	 * [Node] Does the currently logged in user have permission to copy this node?
	 *
	 * @return	bool
	 */
	public function canCopy()
	{
		return FALSE;
	}   
         
	/**
	 * [Node] Add/Edit Form
	 *
	 * @param	\IPS\Helpers\Form	$form	The form
	 * @return	void
	 */
	public function form( &$form )
	{        
        /* Currency form */
		$form->add( new \IPS\Helpers\Form\Text( 'name', $this->id ? $this->name : '', TRUE ) );
		$form->add( new \IPS\Helpers\Form\Text( 'tag', $this->id ? $this->tag : '', TRUE, array( 'minLength' => 3, 'maxLength' => 3, 'size' => 3 ) ) );
        $form->add( new \IPS\Helpers\Form\Text( 'symbol', $this->id ? $this->symbol : '', TRUE ) );
        $form->add( new \IPS\Helpers\Form\Text( 'rate', $this->id ? $this->rate : '', TRUE ) );
	}
	
	/**
	 * [Node] Format form values from add/edit form for save
	 *
	 * @param	array	$values	Values from the form
	 * @return	array
	 */
	public function formatFormValues( $values )
	{       
		if ( !$this->id )
		{
			//$this->save();
		}

		return $values;
	}

	/**
	 * [Node] Get buttons to display in tree
	 * Example code explains return value
	 * @encode
	 * @param	string	$url		Base URL
	 * @param	bool	$subnode	Is this a subnode?
	 * @return	array
	 */
	public function getButtons( $url, $subnode=FALSE )
	{
		$buttons = parent::getButtons( $url, $subnode );

		if( isset( $buttons['edit'] ) )
		{
			$buttons['edit']['data']  = array( 'ipsDialog' => '', 'ipsDialog-title' => \IPS\Member::loggedIn()->language()->addToStack('edit_currency') );
		}	
        
        /* Protect first currency. */
        if( $this->id == 1 )
        {
            unset( $buttons['delete'] );    
        }

		return $buttons;
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

	/**
	 * Search
	 *
	 * @param	string		$column	Column to search
	 * @param	string		$query	Search query
	 * @param	string|null	$order	Column to order by
	 * @param	mixed		$where	Where clause
	 * @return	array
	 */
	public static function search( $column, $query, $order=NULL, $where=array() )
	{
		if ( $column === '_title' )
		{
			$column	= 'c_name';
		}

		if( $order == '_title' )
		{
			$order	= 'c_name';
		}

		return parent::search( $column, $query, $order, $where );
	}
}