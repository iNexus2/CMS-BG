<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\modules\admin\setup;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * currencies
 */
class _currencies extends \IPS\Node\Controller
{
	/**
	 * Node Class
	 */
	protected $nodeClass = 'IPS\donate\Currency';
	
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'currencies_manage' );
		parent::execute();
	}
    
	public function _getRootButtons()
	{
		$buttons['add_currency']  = array(
			'icon'	=> 'plus',
			'title'	=> 'add_currency',
			'link'	=> \IPS\Http\Url::internal( $this->url->setQueryString( array( 'do' => 'form' ) ) ),
		    'data'		=> array( 'ipsDialog' => '', 'ipsDialog-title' => \IPS\Member::loggedIn()->language()->addToStack('add_currency') )
			);
            
		return $buttons;
	}    
}