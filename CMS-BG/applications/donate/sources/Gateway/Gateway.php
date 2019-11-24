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
 * Gateway Node
 */
class _Gateway extends \IPS\Node\Model
{
	protected static $multitons;   
    protected static $databaseIdFields = array( 'gw_id', 'gw_file' ); 
    public static $databaseColumnId = 'id'; 
	public static $databaseTable = 'donate_gateways';
	public static $databasePrefix = 'gw_';
	public static $nodeTitle = 'payment_gateways';
	public static $databaseColumnMap = array(
		'title'	=> 'name',
	);
    
	/**
	 * Construct ActiveRecord from database row
	 *
	 * @param	array	$data							Row from database table
	 * @param	bool	$updateMultitonStoreIfExists	Replace current object in multiton store if it already exists there?
	 * @return	static
	 */
	public static function constructFromData( $data, $updateMultitonStoreIfExists = TRUE )
	{
		$classname = 'IPS\donate\Gateway\\' . $data['gw_file'];
		if( !class_exists( $classname ) )
		{
			throw new \OutOfRangeException;
		}
		
		/* Initiate object */
		$obj = new $classname;
		$obj->_new = FALSE;
		
		/* Import data */
		foreach( $data as $k => $v )
		{
			if( static::$databasePrefix AND mb_strpos( $k, static::$databasePrefix ) === 0 )
			{
				$k = \substr( $k, \strlen( static::$databasePrefix ) );
			}

			$obj->_data[ $k ] = $v;
		}
        
		$obj->changed = array();
		
		if( method_exists( $obj, 'init' ) )
		{
			$obj->init();
		}
				
		/* Return it */
		return $obj;
	}
    
	/**
	 * Payment Screen
	 * @return	array
	 */
	public function paymentScreen( \IPS\Helpers\Form $form, $member, $donation )
	{
		return NULL;
	}

	/**
	 * Authorize Payment
	 */
	public function auth( $donation )
	{
		return NULL;
	}        

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
	 * [Node] Get whether or not this node is enabled
	 *
	 * @note	Return value NULL indicates the node cannot be enabled/disabled
	 * @return	bool|null
	 */
	protected function get__enabled()
	{
		return $this->active;
	}

	/**
	 * [Node] Set whether or not this node is enabled
	 *
	 * @param	bool|int	$enabled	Whether to set it enabled or disabled
	 * @return	void
	 */
	protected function set__enabled( $enabled )
	{
		$this->active	= $enabled;
	}       
         
	/**
	 * [Node] Add/Edit Form
	 *
	 * @param	\IPS\Helpers\Form	$form	The form
	 * @return	void
	 */
	public function form( &$form )
	{        
        /* Add instructions note */
        if( $this->instructions )
        {
            /* Swap out gateway url tag */
            $this->instructions = str_replace( '%gateway_url%', \IPS\Http\Url::internal( 'app=donate&do=payment&gateway=', 'front' )->setQueryString( array( 'gateway' => $this->id ) ), $this->instructions );
            
            $form->addHeader( 'gateway_instructions' );
            $form->addMessage( $this->instructions, '', FALSE );            
        }

        /* Gateway Settings */
        $form->addHeader( 'gateway_settings' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'gw_active', $this->id ? $this->active : TRUE, FALSE, array() ) );        
		$form->add( new \IPS\Helpers\Form\Text( 'gw_name', $this->id ? $this->name : '', TRUE, array() ) );
		$form->add( new \IPS\Helpers\Form\Text( 'gw_file', $this->id ? $this->file : '', TRUE, array() ) );
        $form->add( new \IPS\Helpers\Form\Text( 'gw_email', $this->id ? $this->email : '', FALSE, array( 'disabled' => ( $this->file == 'paymentwall' ) ? TRUE : FALSE ) ) );  
        
        /* Restrict to Paypal for now */
        if( $this->file == 'paypal' )
        {
            $form->add( new \IPS\Helpers\Form\YesNO( 'gw_emails_enable', $this->emails ? TRUE : FALSE, FALSE, array( 'togglesOn' => array( 'gw_emails' ) ) ) );
            $form->add( new \IPS\Helpers\Form\Stack( 'gw_emails', ( $this->id AND $this->emails ) ? json_decode( $this->emails, TRUE ) : NULL, FALSE, array( 'stackFieldType' => 'KeyValue' ), NULL, NULL, NULL, 'gw_emails' ) );            
        }     
        
        $form->add( new \IPS\Helpers\Form\YesNo( 'gw_dev', $this->id ? $this->dev : FALSE, FALSE, array() ) );
        $form->add( new \IPS\Helpers\Form\TextArea( 'gw_summary', $this->id ? $this->summary : '', FALSE, array() ) );
        
        /* Custom fields */
        $gatewayFields   = json_decode( $this->fields, true ); /* Messy but lets do this for now */
        $gatewaySettings = json_decode( $this->settings, true );
              
        if( count( $gatewayFields ) AND is_array( $gatewayFields ) )
        {
            $form->addHeader( 'gateway_fields' );
            
            foreach( $gatewayFields as $field )
            {
                if( $field['type'] == 'input' )
                {
                    $form->add( new \IPS\Helpers\Form\Text( $field['name'], $this->id ? $gatewaySettings[ $field['name'] ] : '', FALSE, array() ) );
                }
                else if( $field['type'] == 'yes_no' )
                {
                    $form->add( new \IPS\Helpers\Form\YesNo( $field['name'], $this->id ? intval( $gatewaySettings[ $field['name'] ] ) : FALSE, TRUE, array() ) );
 
                } 
                else if( $field['type'] == 'textarea' )
                {
                    $form->add( new \IPS\Helpers\Form\TextArea( $field['name'], $this->id ? $gatewaySettings[ $field['name'] ] : '', FALSE, array() ) );
                }                
                else if( $field['type'] == 'dropdown' )
                {
                    if( is_array( $field['options'] ) AND count( $field['options'] ) )
                    {
                        foreach( $field['options'] as $key => $value )
                        {
                            $fieldDropdown[] = array( $key, $value );
                        }    
                    }
                 } 
                else
                {}                
            }
        }
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
			$this->save();
		}
         
        /* Swap field keys for now */
		foreach ( array( 'gw_name' => "name", 'gw_file' => "file", 'gw_email' => "email", 'gw_emails' => "emails", 'gw_active' => "active", 'gw_dev' => "dev", 'gw_summary' => "summary" ) as $fieldKey => $newKey )
		{
			if ( isset( $values[ $fieldKey ] ) )
			{
				$values[ $newKey ] = $values[ $fieldKey ];
				 
				unset( $values[ $fieldKey ] );
			}
		}
        
        /* Process multiple emails */        
        $values['emails'] = ( isset( $values['emails'] ) AND $values['emails'] AND $values['gw_emails_enable'] ) ? json_encode( $values['emails'] ) : NULL;
        unset( $values['gw_emails_enable'] );
        
        /* Go through gateway settings and encode */
        $gateway = parent::load( $this->id );
        $gatewayFields = json_decode( $gateway->fields, true );
        
        if( count( $gatewayFields ) AND is_array( $gatewayFields ) )
        {
            foreach( $gatewayFields as $field )
            {
                $values['settings'][ $field['name'] ] = $values[ $field['name'] ];   
                unset( $values[ $field['name'] ] );   
            }
            
            $values['settings'] = json_encode( $values['settings'] );
        }

		return $values;
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
			$column	= 'gw_name';
		}

		if( $order == '_title' )
		{
			$order	= 'gw_name';
		}

		return parent::search( $column, $query, $order, $where );
	}    
}