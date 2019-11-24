//<?php

class hook152 extends _HOOK_CLASS_
{
	public function content()
	{
		try
		{
			$content = parent::content();
			
			if ( \IPS\Settings::i()->bim_hide_on == 1 )
			{
				if ( \IPS\Member::loggedIn()->member_id != $this->author_id && in_array(\IPS\Member::loggedIn()->member_group_id, explode(",", \IPS\Settings::i()->bim_hide_groups) ) && ( ( \IPS\Settings::i()->bim_hide_forums == 0 ) OR in_array( $this->item()->forum_id, explode( ",", \IPS\Settings::i()->bim_hide_forums ) ) ) )
				{			
					$msg = \IPS\Theme::i()->getTemplate( 'plugins', 'core', 'global' )->bim_hide_msg();
					
					$content = str_replace("<a></a>", "", $content);
					
					if ( \IPS\Settings::i()->bim_hide_manual == 1)
					{
						$content = preg_replace('/\[hide\](.+?)\[\/hide\]/is', $msg, $content);			
					}
					
					if ( \IPS\Settings::i()->bim_hide_link == 1)
					{
						$content = preg_replace('/<a((?:(?!ipsAttachLink_image).)+)<\/a>/iU', $msg, $content);			
					}
					
					if( \IPS\Settings::i()->bim_hide_code == 1 )
					{
						$content = preg_replace('#<pre(.*?)>(.*?)</pre>#si', $msg, $content);
					}
				}
				else
				{
					$content = str_replace('[hide]', "", $content);
					$content = str_replace('[/hide]', "", $content);
				}
			}
			return $content;		
		}
		catch ( \RuntimeException $e )
		{
			return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
		}
	}

}