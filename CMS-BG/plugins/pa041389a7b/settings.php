//<?php

		$form->add( new \IPS\Helpers\Form\YesNo( 'topicAuthorPosts_enableCounter', \IPS\Settings::i()->topicAuthorPosts_enableCounter, FALSE ) );

if ( $values = $form->values() )
{
	$form->saveAsSettings();
	return TRUE;
}

return $form;