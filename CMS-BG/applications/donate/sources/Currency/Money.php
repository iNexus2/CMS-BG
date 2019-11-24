<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
namespace IPS\donate\Currency;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Currency Node
 */
class _Money
{
	public $amount;
	public $currency;
	public $anonymous;    
    
	/**
	 * Contructar
	 */
	public function __construct( $amount, $currency='-1', $anonymous=0 )
	{
		$this->amount    = floatval( $amount );
		$this->currency  = $currency;
		$this->anonymous = intval( $anonymous );        
        
        /* Use default currency if none provided. */
        if( $currency == -1 )
        {
			try
			{
			    $currency = \IPS\donate\Currency::load( \IPS\Settings::i()->dt_default_currency );
				$this->currency = $currency->tag;
			}
			catch ( \OutOfRangeException $e ) { }            
        }
	}

	/**
	 * Round money
	 */
	public function round()
	{
		if ( mb_strlen( mb_substr( mb_strrchr( $this->amount, '.' ), 1 ) ) > 2 )
		{
			$mult = pow( 10, 2 );
			$this->amount = ceil( $this->amount * $mult ) / $mult;
		}
        
		return $this;
	}   
    
 	/**
	 * Return it
	 */
	public function __toString()
	{		
	    /* Anonymous amount? */
        if( $this->anonymous )
        {
            return '--';
        }
       
		/* Try this for now */
		if( function_exists( 'money_format' ) and trim( \IPS\Member::loggedIn()->language()->locale['int_curr_symbol'] ) === $this->currency  )
		{
			return money_format( '%n', $this->amount );
		}
        
		/* Just return basic if nothing else */
		$amount = number_format( $this->amount, 2 );
        if( $this->currency )
        {
            $amount .= " {$this->currency}";    
        }
        return $amount;
	}           
}