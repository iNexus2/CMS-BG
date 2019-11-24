<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\extensions\core\OutputPlugins;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Template Plugin
 */
class _Formatmoney
{
	/**
	 * @brief	Can be used when compiling CSS
	 */
	public static $canBeUsedInCss = FALSE;
	
	/**
	 * Run the plug-in
	 *
	 * @param	string 		$data	  The initial data from the tag
	 * @param	array		$options    Array of options
	 * @return	string		Code to eval
	 */
	public static function runPlugin( $data, $options )
	{       
        /* Has currency? */  
		if( isset( $options['currency'] ) AND $options['currency'] )
		{          
            $options['currency'] = $options['currency'];
		}
		else
		{
			$options['currency'] = "''";
		} 
        
        /* Anonymous amount? */  
		if( isset( $options['anonymous'] ) AND $options['anonymous']  )
		{     
            $options['currency'] = $options['currency'];
		}
		else
		{
			$options['anonymous'] = "''";
		}            
        
        return 'new \IPS\donate\Currency\Money( ' . $data . ", {$options['currency']}, {$options['anonymous']} )";
   
	}
}