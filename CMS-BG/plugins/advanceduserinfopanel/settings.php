//<?php

$form->addHeader('Advanced User Info Panel Settings');
$form->add( new \IPS\Helpers\Form\YesNo( 'User_Group_Active', \IPS\Settings::i()->User_Group_Active, FALSE, array('togglesOn' => array( 'User_Group_Active' ) ) ) );
$form->add( new \IPS\Helpers\Form\YesNo( 'User_Rank_Active', \IPS\Settings::i()->User_Rank_Active, FALSE, array('togglesOn' => array( 'User_Rank_Active' ) ) ) );
$form->add( new \IPS\Helpers\Form\YesNo( 'User_ID_Active', \IPS\Settings::i()->User_ID_Active, FALSE, array('togglesOn' => array( 'User_ID_Active' ) ) ) );
$form->add( new \IPS\Helpers\Form\YesNo( 'Post_Count_Active', \IPS\Settings::i()->Post_Count_Active, FALSE, array('togglesOn' => array( 'Post_Count_Active' ) ) ) );
$form->add( new \IPS\Helpers\Form\YesNo( 'User_Rep_Active', \IPS\Settings::i()->User_Rep_Active, FALSE, array('togglesOn' => array( 'User_Rep_Active' ) ) ) );
$form->add( new \IPS\Helpers\Form\YesNo( 'User_Join_Date_Active', \IPS\Settings::i()->User_Join_Date_Active, FALSE, array('togglesOn' => array( 'User_Join_Date_Active' ) ) ) );
$form->add( new \IPS\Helpers\Form\YesNo( 'Online_Status_Active', \IPS\Settings::i()->Online_Status_Active, FALSE, array('togglesOn' => array( 'Online_Status_Active' ) ) ) );
$form->add( new \IPS\Helpers\Form\YesNo( 'User_MOTD_Active', \IPS\Settings::i()->User_MOTD_Active, FALSE, array('togglesOn' => array( 'User_MOTD_Active' ) ) ) );
$form->add( new \IPS\Helpers\Form\YesNo( 'User_Moods_Active', \IPS\Settings::i()->User_Moods_Active, FALSE, array('togglesOn' => array( 'User_Moods_Active' ) ) ) );
$form->addHtml('<center><br><li class="ipsFieldRow ipsClearfix"><div class="rowsForm_button"><a href="https://nullednation.com" class="ipsButton ipsButton_primary ipsButton_medium" target="_blank">Visit Nulled Nation For More Of My Work</a></div></li></center><br>');


if ( $values = $form->values() )
{
	$form->saveAsSettings();
	return TRUE;
}

return $form;