//<?php

class hook133 extends _HOOK_CLASS_
{

	public function getTopicAuthorPosts($member_id, $topic_id)
	{
		try
		{
			try
			{
				try
				{
					if( $member_id == 0 )
					{
						return 0;
					}
					else
					{
						$where[] = "author_id = " . $member_id . " AND topic_id = " . $topic_id;
						$author_posts = \IPS\forums\Topic\Post::getItemsWithPermission( $where );
						
						return count($author_posts);
					}
				}
				catch ( \RuntimeException $e )
				{
					return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
				}
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