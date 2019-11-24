<?php
/**
 * @package		Donations
 * @author		<a href='http://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2015 DevFuse
 */

namespace IPS\donate\modules\admin\donations;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * promotions
 */
class _promotions extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'promotions_manage' );
		parent::execute();
	}
    
	/**
	 * Manage
	 *
	 * @return	void
	 */
	protected function manage()
	{		
		/* Create the table */
		$table = new \IPS\Helpers\Table\Db( 'donate_demote', \IPS\Http\Url::internal( 'app=donate&module=donations&controller=promotions' ) );
		$table->langPrefix = 'demote_';

		/* Column stuff */
		$table->include = array( 'member_id', 'date_added', 'demote_date', 'original_group', 'new_group', 'demote_group' );
		$table->mainColumn = 'date_added';

		/* Sort stuff */
		$table->sortBy = $table->sortBy ?: 'date_added';
		$table->sortDirection = $table->sortDirection ?: 'desc';

		/* Search */
		$table->quickSearch = 'member_name';
		$table->advancedSearch = array(
			'member_id'		 => \IPS\Helpers\Table\SEARCH_MEMBER,
			'date_added'	 => \IPS\Helpers\Table\SEARCH_DATE_RANGE,
			'demote_date'	 => \IPS\Helpers\Table\SEARCH_DATE_RANGE,                                
			);

		/* Formatters */
		$table->parsers = array(
			'member_id'	=> function( $val )
			{
				try
				{
					return htmlentities( \IPS\Member::load( $val )->name, \IPS\HTMLENTITIES, 'UTF-8', FALSE );
				}
				catch ( \OutOfRangeException $e )
				{
					return '--';
				}
			},        
			'date_added'			=> function( $val, $row )
			{
				$date	= \IPS\DateTime::ts( $val );

				return $date->localeDate();
			},
			'demote_date'	=> function( $val, $row )
			{
				$date	= \IPS\DateTime::ts( $val );

				return $date->localeDate();
			},
			'original_group' => function( $val )
			{
				try
				{
					return \IPS\Member\Group::load( $val )->name;
				}
				catch ( \OutOfRangeException $e )
				{
					return '--';
				}
			},
			'new_group' => function( $val )
			{
				try
				{
					return \IPS\Member\Group::load( $val )->name;
				}
				catch ( \OutOfRangeException $e )
				{
					return '--';
				}
			},  
			'demote_group' => function( $val )
			{
				try
				{
					return \IPS\Member\Group::load( $val )->name;
				}
				catch ( \OutOfRangeException $e )
				{
					return '--';
				}
			},                                  
		);

		/* Row buttons */
		$table->rowButtons = function( $row )
		{
			$return['edit'] = array(
				'icon'		=> 'pencil',
				'title'		=> 'edit',
				'link'		=> \IPS\Http\Url::internal( 'app=donate&module=donations&controller=promotions&do=edit&id=' ) . $row['id'],
				'hotkey'	=> 'e',
                'data'		=> array( 'ipsDialog' => '' ),
			);
					
			$return['delete'] = array(
				'icon'		=> 'times-circle',
				'title'		=> 'delete',
				'link'		=> \IPS\Http\Url::internal( 'app=donate&module=donations&controller=promotions&do=delete&id=' ) . $row['id'],
				'data'		=> array( 'delete' => '' ),
			);
			
			return $return;
		};

		/* Display */
		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack('group_promotions');
		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'global', 'core' )->block( 'title', (string) $table );
	} 
    
	/**
	 * Edit promotion
	 *
	 * @return	void
	 */
	public function edit()
	{
		/* Get existing record */
		try
		{
			$promotion = \IPS\donate\Promotion::load( \IPS\Request::i()->id );
		}
		catch( \OutOfRangeException $e )
		{
			\IPS\Output::i()->error( 'promotion_not_found', '', 404, '' );
		}

		/* Build the form */
		$form = new \IPS\Helpers\Form;
        $form->addHeader( 'promotion_settings' );
		$form->add( new \IPS\Helpers\Form\Member( 'member_id', \IPS\Member::load( $promotion->member_id )->name, FALSE, array( 'disabled' => TRUE ) ) );
        $form->add( new \IPS\Helpers\Form\Date( 'date_added', $promotion->date_added, FALSE, array( 'disabled' => TRUE ), NULL, NULL, NULL ) );
        $form->add( new \IPS\Helpers\Form\Date( 'demote_date', $promotion->demote_date, TRUE ) );
        
        $form->addHeader( 'primary_group' );
		$form->add( new \IPS\Helpers\Form\Select( 'original_group', $promotion->original_group, FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'disabled' => TRUE ) ) );
		$form->add( new \IPS\Helpers\Form\Select( 'new_group', $promotion->new_group, FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'disabled' => TRUE ) ) );
		$form->add( new \IPS\Helpers\Form\Select( 'demote_group', $promotion->demote_group, TRUE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal' ) ) );

		$form->addHeader( 'secondary_groups' );
        $form->add( new \IPS\Helpers\Form\Select( 'original_group2', explode( ",", $promotion->original_group2 ), FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'disabled' => TRUE, 'multiple' => TRUE ) ) );
		$form->add( new \IPS\Helpers\Form\Select( 'new_group2', explode( ",", $promotion->new_group2 ), FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'disabled' => TRUE, 'multiple' => TRUE ) ) );
		$form->add( new \IPS\Helpers\Form\Select( 'demote_group2', explode( ",", $promotion->demote_group2 ), FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'multiple' => TRUE ) ) );

		/* Handle submissions */
		if ( $values = $form->values() )
		{
			/* Insert the new record */
			$promotion->demote_date	  = $values['demote_date'];
			$promotion->demote_group  = $values['demote_group'];
			$promotion->demote_group2 = $values['demote_group2'];
			$promotion->save();

			/* Redirect */
			\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=donate&module=donations&controller=promotions' ), 'saved' );
		}

		\IPS\Output::i()->title		=  \IPS\Member::loggedIn()->language()->addToStack('edit_promotion');;
		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'global', 'core' )->block( $promotion->member_name, $form, FALSE );
	}  
    
	/**
	 * Delete promotion
	 *
	 * @return	void
	 */
	protected function delete()
	{
		/* Delete the promotion */
		try
		{
			$promotion = \IPS\donate\Promotion::load( \IPS\Request::i()->id );
			$promotion->delete();
		}
		catch( \OutOfRangeException $e )
		{
			\IPS\Output::i()->error( 'promotion_not_found', '', 404, '' );
		}	   
		
		/* Redirect */
		\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=donate&module=donations&controller=promotions' ), 'deleted' );
	}          
}