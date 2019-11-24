//<?php
class hook131 extends _HOOK_CLASS_
{
public static function furlDefinition( $revert=FALSE )
	{
		try
		{
			$furls = parent::furlDefinition($revert);
	
			if ( !isset( $furls['settings_Steam'] ) )
			{
				$furls['settings_Steam'] = array(
					'friendly'  => 'settings/steam',
					'real'      => 'app=core&module=system&controller=settings&area=profilesync&service=Steam'
				);
			}
	
			return $furls;
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