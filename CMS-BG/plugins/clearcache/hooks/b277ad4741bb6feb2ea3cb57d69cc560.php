//<?php

class hook134 extends _HOOK_CLASS_
{
    /**
     * Clear Caches
     *
     * @return	string|NULL
     */
    public function clearCache()
    {
	try
	{
	        /* Clear JS Maps first */
	        \IPS\Output::clearJsFiles();
	
	        /* Reset theme maps to make sure bad data hasn't been cached by visits mid-setup */
	        foreach( \IPS\Theme::themes() as $id => $set )
	        {
	            /* Update mappings */
	            $set->css_map = array();
	            $set->save();
	        }
	
	        \IPS\Data\Store::i()->clearAll();
	        \IPS\Data\Cache::i()->clearAll();
	
	        \IPS\Output::i()->redirect( \IPS\Http\Url::internal( NULL ), 'ClearCache_complete' );
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