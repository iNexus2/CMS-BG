//<?php
/* To prevent PHP errors (extending class does not exist) revealing path */
if (!defined('\IPS\SUITE_UNIQUE_KEY')) {
    exit;
}

class hook128 extends _HOOK_CLASS_ {

    public function signinas() {
	try
	{
	
	        if (\IPS\Member::loggedIn()->hasAcpRestriction('core', 'members', 'member_login')) {
	
	            /* Load Member and Admin */
	            $member = \IPS\Member::load(\IPS\Request::i()->id);
	            $admin = \IPS\Member::loggedIn();
	            if (!$member->isAdmin() && $member->member_id != $admin->member_id) {
	
	                /* Log It */
	                \IPS\Db::i()->insert('core_admin_logs', array(
	                    'member_id' => \IPS\Member::loggedIn()->member_id,
	                    'ctime' => time(),
	                    'note' => json_encode(array($member->name => FALSE)),
	                    'ip_address' => \IPS\Request::i()->ipAddress(),
	                    'appcomponent' => 'core',
	                    'module' => 'members',
	                    'controller' => 'members',
	                    'do' => 'login',
	                    'lang_key' => 'acplog__members_loginas'
	                ));
	
	                /* Do it */
	                $_SESSION['logged_in_from'] = array('id' => $admin->member_id, 'name' => $admin->name);
	                $unique_id = \IPS\Login::generateRandomString();
	                $_SESSION['logged_in_as_key'] = $unique_id;
	                \IPS\Data\Store::i()->$unique_id = $member->member_id;
	            }
	        }
	
	        /* Reload page */
	        \IPS\Output::i()->redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : \IPS\Http\Url::internal('') );
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