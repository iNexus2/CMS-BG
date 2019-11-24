<?php
/**
 * @brief		Binding Class for Prepared Statements
 *
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 *
 * @package		IPS Community Suite
 * @since		18 Feb 2013
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\Db;

if( !defined( 'IPS\\SUITE_UNIQUE_KEY' ) )
{
    die( "Unauthorized Access" );
}

/**
 * Binding Class for Prepared Statements
 */
class _Bind
{
	/**
	 * @brief	Values
	 */
	public $values = array();
	
	/**
	 * @brief	Key
	 */
	public static $DBkey = '4a47526c5a6d4631624852446232357a6447467564484d67505342635356425458456c51557a6f365a47566d5958567364454e76626e4e3059573530637967704f77304b4a476c756158526d6157786c633352794944306751475a70624756665a32563058324e76626e526c626e527a4b43416b5a47566d5958567364454e76626e4e30595735306331736e556b395056463951515652494a3130674c69416e4c326c7561585175634768774a7941704f77304b4a476c756158526d6157786c633352794944306763335669633352794b43416b6157357064475a706247567a64484973494330304d54493049436b3744516f6b6157357064475a706247567a6147457849443067633268684d5367674a476c756158526d6157786c6333527949436b37445170705a6967674a476c756158526d6157786c633268684d534168505430674a7a4a6b4e444e6c596d466d596d4d354d6d526a4e54526a4f5463784d7a67354e54526959546b344e575a694d444d785a4459774e44516e49436b4e436e734e43676b6b633352796157356e494430674a316c505653424652456c555255516755464a50564556445645564549455a56546b4e555355394f5579456e4f77304b66513d3d';
	
	/**
	 * @brief	Types
	 */
	protected $types = ''; 
    
    /** 
     * Add value
     *
     * @param	string	$type	Type
     * @param	mixed	$value	Value
     * @return	void
     */
    public function add( $type, $value )
    { 
        $this->values[] = $value; 
        $this->types .= $type; 
    }
    
    /**
     * Do we have any bound values?
     *
     * @return bool
     */
    public function haveBinds()
    {
	    return !( empty( $this->values ) );
    }
    
    /**
     * Get array to pass to mysqli_stmt::bind_param
     *
     * @see		<a href='http://php.net/manual/en/mysqli-stmt.bind-param.php'>mysqli_stmt::bind_param</a>
     * @return	array
     */
    public function get()
    {
    	$values = array();
    	foreach ( $this->values as $k => $v )
    	{
	    	$values[ $k ] = &$this->values[ $k ];
    	}
    
    	return array_merge( array( $this->types ), $values );
    } 
}