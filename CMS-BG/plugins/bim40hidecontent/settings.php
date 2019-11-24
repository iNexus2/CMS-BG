//<?php
$form->add( new \IPS\Helpers\Form\YesNo( 'bim_hide_on', \IPS\Settings::i()->bim_hide_on ) );

$form->add( new \IPS\Helpers\Form\Select( 'bim_hide_groups', array_filter( explode( ',', \IPS\Settings::i()->bim_hide_groups ) ), FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'multiple' => TRUE ) ) );

$form->add( new \IPS\Helpers\Form\Node( 'bim_hide_forums', ( \IPS\Settings::i()->bim_hide_forums == 0 ) ? 0 : \IPS\Settings::i()->bim_hide_forums, FALSE, array( 'class' => 'IPS\forums\Forum', 'multiple' => TRUE, 'zeroVal' => 'all' ) ) );
		
$form->add( new \IPS\Helpers\Form\YesNo( 'bim_hide_link', \IPS\Settings::i()->bim_hide_link ) );

$form->add( new \IPS\Helpers\Form\YesNo( 'bim_hide_code', \IPS\Settings::i()->bim_hide_code ) );

$form->add( new \IPS\Helpers\Form\YesNo( 'bim_hide_manual', \IPS\Settings::i()->bim_hide_manual ) );	

if ( $values = $form->values() )
{
	$form->saveAsSettings();
	return TRUE;
}

return $form;