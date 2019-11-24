//<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */
 
class donate_hook_forceGuestAccess extends _HOOK_CLASS_
{
	/**
	 * Define that the page should load even if the user is banned and not logged in
	 *
	 * @return	bool
	 */
	protected function notAllowedBannedPage()
	{
		try
		{
		    /* Allow guest access to payment function for now. */
		    if( $this->application->directory == 'donate' AND $this->module->key == 'donate' AND $this->controller == 'index' AND \IPS\Request::i()->do == 'payment' )
	        {
	            return false;
	        }	   
	       
			return call_user_func_array( 'parent::notAllowedBannedPage', func_get_args() );
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}

}