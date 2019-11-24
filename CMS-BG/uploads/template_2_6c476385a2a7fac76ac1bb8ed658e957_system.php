<?php
namespace IPS\Theme\Cache;
class class_core_front_system extends \IPS\Theme\Template
{
	public $cache_key = '93826fd1df1590e282335a3fa4af4fad';
	function announcement( $announcement ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT
<h2 class='ipsType_sectionTitle'>
CONTENT;
$return .= htmlspecialchars( $announcement->mapped( 'title' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT


<article class='ipsPad'>


CONTENT;

if ( !$announcement->active ):
$return .= <<<CONTENT

	<p class='ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announcement_not_active', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p><br />

CONTENT;

endif;
$return .= <<<CONTENT

  
<div class='ipsPhotoPanel ipsPhotoPanel_tiny ipsClearfix'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $announcement->author(), 'tiny' );
$return .= <<<CONTENT

	<div>
		<p class='ipsType_reset ipsType_large ipsType_blendLinks'>
			
CONTENT;

$htmlsprintf = array($announcement->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

            
CONTENT;

if ( $announcement->start ):
$return .= <<<CONTENT

                <br>
                <span class='ipsType_light ipsType_medium'>
CONTENT;

$val = ( $announcement->start instanceof \IPS\DateTime ) ? $announcement->start : \IPS\DateTime::ts( $announcement->start );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>
            
CONTENT;

endif;
$return .= <<<CONTENT

		</p>
	</div>
</div>
<br />
  
	<section class='ipsType_richText ipsType_normal'>
		{$announcement->mapped( 'content' )}
		
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_manage_announcements') and ( $announcement->canEdit() or $announcement->canDelete() ) ):
$return .= <<<CONTENT

			<hr class='ipsHr'>
			<a href='#elAnnouncementActions_menu' id='elAnnouncementActions' class='ipsButton ipsButton_light ipsButton_verySmall' data-ipsMenu>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_actions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
			<ul id='elAnnouncementActions_menu' class='ipsMenu ipsMenu_auto ipsHide'>
				
CONTENT;

if ( $announcement->canEdit() ):
$return .= <<<CONTENT

					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url( 'create' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-modal='true' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_announcement', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action='ipsMenu_ping'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $announcement->canDelete() ):
$return .= <<<CONTENT

					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url( 'delete' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url( 'status' )->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

if ( $announcement->active ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_mark_inactive', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_mark_active', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

if ( $announcement->active ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_mark_inactive', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_mark_active', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a></li>
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</section>
</article>

CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function banned( $message, $warnings, $banEnd ) {
		$return = '';
		$return .= <<<CONTENT

<section class='ipsType_center ipsPad ipsBox'>
	<br>
	<i class='ipsType_huge fa fa-lock'></i>
	<h1 class='ipsType_veryLarge'>
CONTENT;

if ( $banEnd instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'suspended', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'banned', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h1>
	<p class='ipsType_large'>
		
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</p>
</section>


CONTENT;

if ( $warnings ):
$return .= <<<CONTENT

	<h2 class='ipsType_sectionTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warnings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	{$warnings}

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function completeProfile( $form ) {
		$return = '';
		$return .= <<<CONTENT


<section class='ipsPad'>
	<br>
	<h1 class='ipsType_veryLarge ipsType_center ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'need_more_info', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<p class='ipsType_large ipsType_center ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'need_more_info_text', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	<br>
	<div class='ipsBox ipsPad'>
		{$form}
	</div>
</section>

CONTENT;

		return $return;
}

	function contact( $form ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('contact') );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

<div class='ipsPad'>

CONTENT;

endif;
$return .= <<<CONTENT

<div class='ipsType_normal ipsType_richText'>
	{$form}
</div>

CONTENT;

if ( \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function contactDone(  ) {
		$return = '';
		$return .= <<<CONTENT


<br><br>
<p class='ipsType_reset ipsType_center ipsType_huge'>
	<i class='fa fa-envelope'></i>
</p>

<h1 class='ipsType_veryLarge ipsType_center'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact_sent', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>

<div class='ipsType_large ipsType_center ipsType_richText'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact_sent_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>
<br>
<p class='ipsType_center'>
	<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "/", null, "", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_normal ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_community_home', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</p>
CONTENT;

		return $return;
}

	function coppa( $form ) {
		$return = '';
		$return .= <<<CONTENT


<section class='ipsPad'>
	<br>
	<h1 class='ipsType_veryLarge ipsType_center ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<p class='ipsType_large ipsType_center ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'existing_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></p>
	<br>

	<div data-role='registerForm' class='ipsBox ipsPad'>
		<section class='ipsType_center'>
			<p class='ipsType_large ipsType_reset'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_verify', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></p>
			<p class='ipsType_normal ipsType_light ipsType_reset'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_verification_only', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

if ( \IPS\Settings::i()->privacy_type != "none" ):
$return .= <<<CONTENT
 <a href='
CONTENT;

if ( \IPS\Settings::i()->privacy_type == "internal" ):
$return .= <<<CONTENT

CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=privacy", null, "privacy", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Settings::i()->privacy_link;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'privacy', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>.
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
			<br><br>

			{$form->customTemplate( array( \IPS\Theme::i()->getTemplate( 'system', 'core', 'front' ), 'coppaForm' ) )}
		</section>
	</div>
</section>
CONTENT;

		return $return;
}

	function coppaConsent(  ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPrint">
	<h1>
CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT
</h1>
	<h2>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>

	
CONTENT;

$sprintf = array(\IPS\Settings::i()->board_name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_intro', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	
	<table>
		<tr>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_child_name', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_child_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
		</tr>
		<tr>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
		</tr>
	</table>
	
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_disclaimer', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
	<div></div>
	<div></div>

	<table>
		<tr>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_name', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_relation', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
		</tr>
		<tr>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
		</tr>
		<tr>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_phone', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
		</tr>
		<tr>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
		</tr>
		<tr>
			<th colspan="2">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_sig', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
		</tr>
		<tr>
			<td colspan="2" class="ipsPrint_tripleHeight">&nbsp;</td>
		</tr>
		<tr>
			<th colspan="2">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_date', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
		</tr>
		<tr>
			<td colspan="2" class="ipsPrint_doubleHeight">&nbsp;</td>
		</tr>
	</table>

	<div></div>

	
CONTENT;

if ( \IPS\Settings::i()->privacy_type != "none" ):
$return .= <<<CONTENT

		<p>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_privacy', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

if ( \IPS\Settings::i()->privacy_type == "internal" ):
$return .= <<<CONTENT

CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=privacy", null, "privacy", array(), 0 ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Settings::i()->privacy_link;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</p>
		<div></div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->coppa_address ):
$return .= <<<CONTENT

		<p>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_mail', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\GeoLocation::parseForOutput( \IPS\Settings::i()->coppa_address );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->coppa_fax ):
$return .= <<<CONTENT

		<p>
CONTENT;

if ( \IPS\Settings::i()->coppa_address and \IPS\Settings::i()->coppa_fax ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_fax', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Settings::i()->coppa_fax;
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function coppaForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar ) {
		$return = '';
		$return .= <<<CONTENT


<form accept-charset='utf-8' method="post" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='elCoppaForm' class='ipsType_center' data-ipsForm>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT


	
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

			
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Date ):
$return .= <<<CONTENT

				<input type="date" class='ipsField_short ipsField_primary' required placeholder="
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name='
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

	&nbsp;&nbsp;<button type='submit' class='ipsButton ipsButton_large ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'continue', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
</form>
CONTENT;

		return $return;
}

	function followForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form 
CONTENT;

if ( \IPS\Request::i()->isAjax()  ):
$return .= <<<CONTENT
data-controller='core.front.core.followForm'
CONTENT;

endif;
$return .= <<<CONTENT
 accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" 
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT
enctype="multipart/form-data"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm >
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT

		<input type="hidden" name="MAX_FILE_SIZE" value="
CONTENT;
$return .= htmlspecialchars( $uploadField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<input type="hidden" name="plupload" value="
CONTENT;

$return .= htmlspecialchars( md5( uniqid() ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class="ipsPad">
		<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
		<br><br>
		<ul class='ipsList_reset'>
			
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

					
CONTENT;

if ( is_string( $input ) ):
$return .= <<<CONTENT

						{$input}
						<hr class='ipsHr'>
					
CONTENT;

elseif ( $input instanceof \IPS\Helpers\Form\Radio ):
$return .= <<<CONTENT

						<li class="ipsFieldRow">
							<strong class='ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_send_me', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
							{$input->html($form)}
							<hr class='ipsHr'>
						</li>
					
CONTENT;

elseif ( $input instanceof \IPS\Helpers\Form\Checkbox ):
$return .= <<<CONTENT

						{$input->html($form)}
					
CONTENT;

else:
$return .= <<<CONTENT

						{$input->rowHtml($form)}
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>
	<div class="ipsAreaBackground ipsPad">
		{$actionButtons[0]} 
CONTENT;

if ( isset( $actionButtons[1] ) ):
$return .= <<<CONTENT
{$actionButtons[1]}
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</form>
CONTENT;

		return $return;
}

	function followedContent( $types, $currentAppModule, $currentType, $table ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('menu_followed_content') );
$return .= <<<CONTENT

<div>
	<div data-role="profileContent">

CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsColumns ipsColumns_collapsePhone">
			<div class="ipsColumn ipsColumn_medium">
				<div class="ipsSideMenu" id="modcp_menu" data-ipsTabBar data-ipsTabBar-contentArea='#elFollowedContent' data-ipsTabBar-itemselector=".ipsSideMenu_item" data-ipsTabBar-activeClass="ipsSideMenu_itemActive" data-ipsSideMenu>
					<h3 class="ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium">
						<a href="#user_content" class="ipsPad_double" data-action="openSideMenu"><i class="fa fa-bars"></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_content_type', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;<i class="fa fa-caret-down"></i></a>
					</h3>
					<div>
						
CONTENT;

foreach ( $types as $app => $_types ):
$return .= <<<CONTENT

							
CONTENT;

if ( $app != "core" ):
$return .= <<<CONTENT

								<h4 class='ipsSideMenu_subTitle'>
CONTENT;

$val = "module__{$app}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
								<ul class="ipsSideMenu_list">
									
CONTENT;

foreach ( $_types as $key => $class ):
$return .= <<<CONTENT

										<li><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'type' => $key, 'change_section' => 1, 'page' => NULL ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( $currentType == $key ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

if ( is_subclass_of( $class, 'IPS\Content\Item' ) ):
$return .= <<<CONTENT

CONTENT;

$val = "{$class::$title}_pl"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$val = "{$class::$nodeTitle}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a></li>	
									
CONTENT;

endforeach;
$return .= <<<CONTENT

								</ul>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

						<h4 class='ipsSideMenu_subTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'other', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
						<ul class='ipsSideMenu_list'>
							<li><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'type' => 'core_member', 'change_section' => 1, 'page' => NULL ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( $currentType == 'core_member' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						</ul>
					</div>			
				</div>
			</div>
			<div class="ipsColumn ipsColumn_fluid" id='elFollowedContent'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core" )->followedContentSection( $types, $currentAppModule, $currentType, (string) $table );
$return .= <<<CONTENT

			</div>
		</div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function followedContentMemberRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$loadedMember = \IPS\Member::load( $row->member_id );
$return .= <<<CONTENT

	<li class='ipsDataItem' data-controller='core.front.system.manageFollowed' data-followID='
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_area'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
-
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_rel_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<div class='ipsDataItem_icon'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $loadedMember, 'small' );
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<h3 class='ipsType_reset ipsType_large ipsType_unbold'>{$loadedMember->link()}</h3> 
CONTENT;

if ( $loadedMember->isOnline() ):
$return .= <<<CONTENT
<i class="fa fa-circle ipsOnlineStatus_online" data-ipsTooltip title='
CONTENT;

$sprintf = array($row->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_now', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'></i>
CONTENT;

endif;
$return .= <<<CONTENT

			<span class='ipsType_normal'>
CONTENT;

$return .= \IPS\Member\Group::load( $row->member_group_id )->formattedName;
$return .= <<<CONTENT
</span>
			<ul class='ipsList_inline ipsType_light'>
				<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_member_posts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: 
CONTENT;
$return .= htmlspecialchars( $loadedMember->member_posts, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</li>
				<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_joined', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: 
CONTENT;

$val = ( $loadedMember->joined instanceof \IPS\DateTime ) ? $loadedMember->joined : \IPS\DateTime::ts( $loadedMember->joined );$return .= $val->html();
$return .= <<<CONTENT
</li>
				
CONTENT;

if ( $loadedMember->last_activity ):
$return .= <<<CONTENT

					<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_last_visit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: 
CONTENT;

$val = ( $loadedMember->last_activity instanceof \IPS\DateTime ) ? $loadedMember->last_activity : \IPS\DateTime::ts( $loadedMember->last_activity );$return .= $val->html();
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>
		<div class='ipsDataItem_generic ipsDataItem_size1 ipsType_center ipsType_large'>
			<span class='ipsBadge ipsBadge_icon ipsBadge_new 
CONTENT;

if ( !$row->_followData['follow_is_anon'] ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='followAnonymous' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_is_anon', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
		</div>

		<div class='ipsDataItem_generic ipsDataItem_size6'>
			<ul class='ipsList_reset'>
				<li title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_when', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-role='followDate'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $row->_followData['follow_added'] instanceof \IPS\DateTime ) ? $row->_followData['follow_added'] : \IPS\DateTime::ts( $row->_followData['follow_added'] );$return .= $val->html();
$return .= <<<CONTENT
</li>
				<li title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_how', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-role='followFrequency'>
					
CONTENT;

if ( $row->_followData['follow_notify_freq'] == 'none' ):
$return .= <<<CONTENT

						<i class='fa fa-bell-slash-o'></i>
					
CONTENT;

else:
$return .= <<<CONTENT

						<i class='fa fa-bell'></i>
					
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

$val = "follow_freq_{$row->_followData['follow_notify_freq']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</li>
			</ul>
		</div>

		<div class='ipsDataItem_generic ipsDataItem_size6 ipsType_center'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core" )->manageFollow( $row->_followData['follow_app'], $row->_followData['follow_area'], $row->_followData['follow_rel_id'] );
$return .= <<<CONTENT

		</div>

		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->member_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state=''>
					<span></span>
				</span>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function followedContentSection( $types, $currentAppModule, $currentType, $table ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox ipsfocus_reset'>
	
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT
<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

if ( is_subclass_of( $types[ $currentAppModule ][ $currentType ], 'IPS\Content\Item' ) ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $types[ $currentAppModule ][ $currentType ]::$title . '_pl' )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stuff_i_follow', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

elseif ( $types[ $currentAppModule ][ $currentType ] == "\IPS\Member" ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_i_follow', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $types[ $currentAppModule ][ $currentType ]::$nodeTitle )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stuff_i_follow', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h2>
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT

	{$table}
  
CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function followers( $url, $pagination, $followers, $anonymous, $removeAllUrl ) {
		$return = '';
		$return .= <<<CONTENT

<div data-ipsInfScroll data-ipsInfScroll-scrollScope="#elFollowerList" data-ipsInfScroll-container="#elFollowerList" data-ipsInfScroll-url="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsInfScroll-pageParam="followerPage" data-ipsInfScroll-pageBreakTpl="">
	<div class="ipsJS_hide">{$pagination}</div>
	<div class='ipsFollowerList ipsPad ipsScrollbar'>
		<ul class="ipsDataList ipsList_reset" id="elFollowerList">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->followersRows( $followers );
$return .= <<<CONTENT

		</ul>
		
CONTENT;

if ( $anonymous ):
$return .= <<<CONTENT

			
CONTENT;

if ( count( $followers ) ):
$return .= <<<CONTENT

				<div class="ipsPad_half ipsType_center ipsType_light">
CONTENT;

$pluralize = array( $anonymous ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_x_others', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class="ipsPad_half ipsType_center ipsType_light">
CONTENT;

$pluralize = array( $anonymous ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_anonymous_members', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_remove_followers') ):
$return .= <<<CONTENT

		<ul class="ipsPad ipsToolList ipsToolList_horizontal ipsList_reset ipsClearfix ipsAreaBackground">
			<li>
				<a href="
CONTENT;
$return .= htmlspecialchars( $removeAllUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-confirm data-confirmmessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_followers_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class="ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_negative">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_followers', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function followersRows( $followers ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $followers as $follower ):
$return .= <<<CONTENT

	<li class='ipsDataItem ipsClearfix'>
		<div class='ipsDataItem_icon ipsPos_top'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $follower['follow_member_id'] ), 'tiny' );
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<strong class='ipsDataItem_title'>
CONTENT;

$link = \IPS\Member::load( $follower['follow_member_id'] )->link();
$return .= <<<CONTENT
{$link}</strong><br>
			<span class='ipsType_light'>
CONTENT;

$val = ( $follower['follow_added'] instanceof \IPS\DateTime ) ? $follower['follow_added'] : \IPS\DateTime::ts( $follower['follow_added'] );$return .= $val->html();
$return .= <<<CONTENT
</span>
		</div>
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function guidelines( $guidelines ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('guidelines') );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<div class='ipsType_normal ipsType_richText ipsPad ipsBox'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guidelines_value', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function ignore( $form, $table, $id=0 ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('ignored_users'), \IPS\Member::loggedIn()->language()->addToStack('ignored_users_blurb') );
$return .= <<<CONTENT

<div data-controller='core.front.ignore.new' data-id="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<div class='ipsAreaBackground ipsPad'>
		<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignored_users_add', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignored_users_add_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<br>
		{$form}
	</div>
	<br>
	{$table}
</div>
CONTENT;

		return $return;
}

	function ignoreEditForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar ) {
		$return = '';
		$return .= <<<CONTENT


<form accept-charset='utf-8' id="elIgnoreForm" class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" 
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT
enctype="multipart/form-data"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm data-controller='core.front.ignore.edit'>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<ul class="ipsForm ipsForm_vertical ipsPad">
		
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

			<li class='ipsFieldRow ipsFieldRow_fullWidth'>
				<ul class='ipsFieldRow_content ipsList_reset'>
					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Checkbox ):
$return .= <<<CONTENT

							<li class='ipsFieldRow_inlineCheckbox'>
								{$input->html()}
								<label for='check_
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
	<div class='ipsAreaBackground ipsPad ipsType_right'>
		
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

			{$button}
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>
</form>
CONTENT;

		return $return;
}

	function ignoreForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' id="elIgnoreForm" class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" 
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT
enctype="multipart/form-data"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<ul class="ipsForm ipsForm_vertical">
		
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

				
CONTENT;

if ( !( $input instanceof \IPS\Helpers\Form\Checkbox ) ):
$return .= <<<CONTENT

					<li class='ipsFieldRow ipsFieldRow_noLabel ipsFieldRow_fullWidth'>
						<div class='ipsFieldRow_content'>
							{$input->html()}
							
CONTENT;

if ( $input->error ):
$return .= <<<CONTENT

								<br>
								<span class="ipsType_warning">
CONTENT;

$val = "{$input->error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

			<li class='ipsFieldRow ipsFieldRow_fullWidth' id='elIgnoreTypes'>
				<strong class='ipsFieldRow_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignored_users_ignore', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				<ul class='ipsFieldRow_content ipsList_reset'>
					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Checkbox ):
$return .= <<<CONTENT

							<li class='ipsFieldRow_inlineCheckbox'>
								{$input->html()}
								<label for='check_
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		<li class='ipsFieldRow' id='elIgnoreSubmitRow'>
			<div class='ipsFieldRow_content'>
				
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

					{$button}
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</div>
		</li>
	</ul>
	<div id='elIgnoreLoading'></div>
</form>
CONTENT;

		return $return;
}

	function ignoreTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsBox' data-baseurl='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-resort='
CONTENT;
$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.global.core.table' id='elTable_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $table->title ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset ipsClear'>
CONTENT;

$val = "{$table->title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		<ul class="ipsButtonRow ipsPos_right ipsClearfix">
			
CONTENT;

if ( !empty( $table->filters ) ):
$return .= <<<CONTENT

				<li>
					<a href="#elFilterByMenu_menu" data-role="tableFilterMenu" id="elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'filter_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
						<li data-ipsMenuValue='' class='ipsMenu_item 
CONTENT;

if ( !$table->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection, 'page' => '1', 'filter' => '', 'group' => \IPS\Request::i()->group ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='
CONTENT;

if ( !array_key_exists( $table->filter, $table->filters ) ):
$return .= <<<CONTENT
ipsButtonRow_active
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

foreach ( $table->filters as $k => $q ):
$return .= <<<CONTENT

							<li data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsMenu_item 
CONTENT;

if ( $k === $table->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection, 'page' => '1', 'group' => \IPS\Request::i()->group ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cIgnoreType_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$table->langPrefix}{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
		
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

	<ol class='ipsDataList ipsGrid ipsGrid_collapsePhone ipsClear' id='elIgnoreUsers' data-role='tableRows'>
		
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

	</ol>

	
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function ignoreTableRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( empty($rows) ):
$return .= <<<CONTENT

	<li class='ipsDataItem'>
		<div class='ipsPad ipsType_light ipsType_center'><br><br>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	</li>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $r ):
$return .= <<<CONTENT

		<li class='ipsDataItem ipsGrid_span6 ipsFaded_withHover' id='elIgnoreRow
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="ignoreRow" data-ignoreUserID='
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.front.ignore.existing'>
			<p class='ipsType_reset ipsDataItem_icon'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $r['ignore_ignore_id'] ), 'tiny' );
$return .= <<<CONTENT

			</p>
			<div class='ipsDataItem_main'>
				<h4 class='ipsDataItem_title'><strong data-role="ignoreRowName">
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $r['ignore_ignore_id'] )->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></h4>
				<ul class='ipsList_inline'>
					
CONTENT;

foreach ( \IPS\core\Ignore::types() as $t ):
$return .= <<<CONTENT

						
CONTENT;

if ( $r["ignore_{$t}"] ):
$return .= <<<CONTENT

							<li class='ipsType_light'><i class='fa fa-check'></i> 
CONTENT;

$val = "ignore_$t"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

					<li class='ipsFaded'>
						<a href='#elUserIgnore
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elUserIgnore
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_large ipsPos_middle ipsType_blendLinks' data-ipsMenu data-ipsMenu-appendTo='#elIgnoreRow
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='ignoreMenu'>
							<i class='fa fa-cog'></i> <i class='fa fa-caret-down'></i>
						</a>
					</li>
				</ul>

				<ul class='ipsMenu ipsJS_hide' id='elUserIgnore
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
					<li class='ipsMenu_item' data-ipsMenuValue='edit'>
						<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=edit&id={$r['ignore_ignore_id']}", null, "", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-remoteSubmit data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$sprintf = array(\IPS\Member::load( $r['ignore_ignore_id'] )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_ignore_for', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_ignored_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
					<li class='ipsMenu_item' data-ipsMenuValue='remove'>
						<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=remove&id={$r['ignore_ignore_id']}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stop_ignoring_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				</ul>
			</div>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function login( $forms, $error ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	<div class=''>
		<div class='ipsPageHeader ipsType_center'>
		<h1 class='ipsType_reset ipsType_veryLarge ipsType_center'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
		
CONTENT;

if ( \IPS\Settings::i()->allow_reg ):
$return .= <<<CONTENT

			<p class='ipsType_large ipsType_center ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dont_have_an_account', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>.</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

		</div>

CONTENT;

endif;
$return .= <<<CONTENT


	<div class='ipsColumns ipsColumns_collapsePhone'>
		<div class='ipsColumn ipsColumn_fluid ipsBox'>
			<div class='ipsPad'>
				
CONTENT;

if ( $error !== NULL ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app, 'global' )->message( $error, 'error' );
$return .= <<<CONTENT

					<br>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

foreach ( $forms as $k => $form ):
$return .= <<<CONTENT

					
CONTENT;

if ( $k === '_standard' ):
$return .= <<<CONTENT

						{$form}
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</div>
		</div>
		
CONTENT;

if ( count ( $forms ) > 1 ):
$return .= <<<CONTENT

			<div class='ipsColumn ipsColumn_veryWide ipsBox'>
				<div class='ipsPad'>
					<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_faster', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
					
CONTENT;

if ( count ( $forms ) > 2 ):
$return .= <<<CONTENT

						<p class='ipsType_normal ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_connect', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<br>
					
CONTENT;

foreach ( $forms as $k => $form ):
$return .= <<<CONTENT

						
CONTENT;

if ( $k !== '_standard' ):
$return .= <<<CONTENT

							<div class='ipsPad_half'>{$form}</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function loginForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsPad ipsForm ipsForm_vertical" method='post' action='
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsValidation novalidate>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<h4 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
	<br><br>
	<ul class='ipsList_reset'>
		
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

				
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Text ):
$return .= <<<CONTENT

					<li class="ipsFieldRow ipsFieldRow_noLabel ipsFieldRow_fullWidth">
						<input type="
CONTENT;
$return .= htmlspecialchars( $input->formType, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" required placeholder="
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name='
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					</li>
				
CONTENT;

else:
$return .= <<<CONTENT

					{$input->rowHtml($form)}
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

		<li class="ipsFieldRow ipsFieldRow_fullWidth">
			<br>
			<input type="submit" class="ipsButton ipsButton_primary ipsButton_small" value="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" id="elSignIn_submit">
			<br>
			<p class="ipsType_right ipsType_small">
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=lostpass", null, "lostpassword", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</p>
		</li>
	</ul>
</form>
CONTENT;

		return $return;
}

	function lostPass( $form ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('lost_password') );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<div class='ipsBox ipsPad'>
	<p class='ipsType_normal'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lost_pass_instructions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</p>
	<br>
	<br>
	{$form}
</div>

CONTENT;

		return $return;
}

	function lostPassConfirm( $message ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('lost_password') );
$return .= <<<CONTENT

<div class='ipsLayout_contentSection'>
	
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function manageFollow( $app, $area, $id ) {
		$return = '';
		$return .= <<<CONTENT


<div data-followApp='
CONTENT;
$return .= htmlspecialchars( $app, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-followArea='
CONTENT;
$return .= htmlspecialchars( $area, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-followID='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-buttonType='manage' data-controller='core.front.core.followButton'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core" )->manageFollowButton( $app, $area, $id );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function manageFollowButton( $app, $area, $id ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->following( $app, $area, $id ) ):
$return .= <<<CONTENT

		<div class="ipsFollow" data-role="followButton">
			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_light ipsButton_fullWidth ipsButton_verySmall' data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_change_preference', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function mergeSocialAccount( $handler, $existingAccount, $form ) {
		$return = '';
		$return .= <<<CONTENT

<h1 class='ipsType_veryLarge ipsType_center'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'link_your_accounts', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
<p class='ipsType_large ipsType_center ipsType_light'>
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( 'login_handler_' . ucfirst( $handler ) )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'link_your_accounts_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
<hr class='ipsHr'>
{$form}
CONTENT;

		return $return;
}

	function mfaAccountRecovery( $message ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('mfa_account_recovery') );
$return .= <<<CONTENT

<div class='ipsLayout_contentSection'>
	
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function myAttachments( $files, $used ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPageHeader ipsClearfix">
	<h1 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
</div>

CONTENT;

if ( \IPS\Member::loggedIn()->group['g_attach_max'] > 0 ):
$return .= <<<CONTENT

	<div class='ipsAreaBackground_light ipsPad'>
		<p>
CONTENT;

$sprintf = array(\IPS\Output\Plugin\Filesize::humanReadableFilesize( $used ), \IPS\Output\Plugin\Filesize::humanReadableFilesize( \IPS\Member::loggedIn()->group['g_attach_max'] * 1024 )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( empty($files) ):
$return .= <<<CONTENT

	<div class='ipsPad ipsAreaBackground_light'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments_empty', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<div class="ipsGrid ipsAttachment_fileList">
		
CONTENT;

foreach ( $files as $url => $file ):
$return .= <<<CONTENT

			
CONTENT;

$id = mb_substr( $url, mb_strrpos( $url, '=' ) + 1 );
$return .= <<<CONTENT

			<div class='ipsDataItem ipsAttach ipsAttach_done'>
				<div class='ipsDataItem_generic ipsDataItem_size1 ipsResponsive_hidePhone ipsResponsive_block ipsType_center'>
					
CONTENT;

if ( in_array( mb_strtolower( mb_substr( $file->filename, mb_strrpos( $file->filename, '.' ) + 1 ) ), \IPS\Image::$imageExtensions ) ):
$return .= <<<CONTENT

						<a href="
CONTENT;
$return .= htmlspecialchars( $file, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><img src="
CONTENT;
$return .= htmlspecialchars( $file, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" alt='' class='ipsImage' data-ipsLightbox data-ipsLightbox-group="myAttachments"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<i class='fa fa-file ipsType_large'></i>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<div class='ipsDataItem_main' data-action='selectFile'>
					<h2 class='ipsDataItem_title ipsType_reset ipsType_medium ipsAttach_title ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $file->originalFilename, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
					<p class='ipsDataItem_meta ipsType_light'>
						
CONTENT;

$return .= \IPS\Output\Plugin\Filesize::humanReadableFilesize( $file->filesize() );
$return .= <<<CONTENT

					</p>
				</div>
				<div class='ipsDataItem_generic ipsDataItem_size6 ipsType_right'>
					<ul class='ipsButton_split'>
						<li>
							<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=attachments&do=view&id={$id}", null, "attachments", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments_view', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-search'></i></a>
						</li>
						
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_delete_attachments'] ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=attachments&do=delete&id={$id}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "attachments", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action="deleteAttachment" ><i class='fa fa-trash-o'></i></a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</div>		
			</div>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function notAdminValidated(  ) {
		$return = '';
		$return .= <<<CONTENT

<section class='ipsType_center ipsPad ipsBox'>
	<br>
	<i class='ipsType_huge fa fa-lock'></i>
	<h1 class='ipsType_veryLarge'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_admin_validation', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>

	<p class='ipsType_large'>
		
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->email); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_admin_validation_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	</p>
	
CONTENT;

$guest = new \IPS\Member;
$return .= <<<CONTENT

	<p class='ipsType_normal'>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login&do=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "logout", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary'>
CONTENT;

if ( $guest->group['g_view_board'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_continue_as_guest', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
	</p>
	<hr class='ipsHr'>
	<p class='ipsType_normal'>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=changeEmail", null, "register", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-modal='true' class='ipsButton ipsButton_light ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_change_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=cancel" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "register", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall' data-confirm data-confirmMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</p>
</section>
CONTENT;

		return $return;
}

	function notCoppaValidated(  ) {
		$return = '';
		$return .= <<<CONTENT

<section class='ipsType_center ipsPad ipsBox'>
	<h1 class='ipsType_veryLarge ipsType_center'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_consent_required', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<br>

	<div data-role='registerForm'>
		<p class='ipsType_large'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_consent_required_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
		<br><br>

		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=coppaForm", null, "register", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_print_form', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</div>
</section>
CONTENT;

		return $return;
}

	function notValidated( $validating=array() ) {
		$return = '';
		$return .= <<<CONTENT

<section class='ipsType_center ipsPad'>
	<br><br>
	<i class='ipsType_huge fa fa-envelope'></i>
	<h1 class='ipsType_veryLarge'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_confirm_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>

	<p class='ipsType_large'>
		
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->email); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_confirm_email_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	</p>
	<p class='ipsType_large'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_confirm_email_must', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</p>
	<hr class='ipsHr'>
	<p class='ipsType_normal'>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=resend" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "register", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_resend_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=changeEmail", null, "register", array(), 0 ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_change_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-modal='true' class='ipsButton ipsButton_light ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_change_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login&do=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "logout", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

if ( $validating['new_reg'] ):
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=cancel" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "register", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall' data-confirm data-confirmMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel_confirm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</p>
</section>
CONTENT;

		return $return;
}

	function notifications( $table ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom'>
	<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<div class="ipsPos_right">
		<a class="ipsButton ipsButton_link" href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=options", null, "notifications_options", array(), 0 ) );
$return .= <<<CONTENT
"><i class="fa fa-cog"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notification_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		<a class="ipsButton ipsButton_link" href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&format=rss", null, "notifications_rss", array(), 0 ) );
$return .= <<<CONTENT
"><i class="fa fa-rss"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rss', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</div>
</div>
<div class='ipsBox'>
	{$table}
</div>
CONTENT;

		return $return;
}

	function notificationsAjax( $notifications ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( empty( $notifications ) ):
$return .= <<<CONTENT

	<li class='ipsDataItem ipsDataItem_unread'>
		<div class='ipsPad ipsType_light ipsType_center ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results_notifications', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	</li>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

foreach ( $notifications as $notification ):
$return .= <<<CONTENT

		<li class='ipsDataItem 
CONTENT;

if ( !$notification['notification']->read_time ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
' itemprop="itemListElement">
			<div class='ipsDataItem_icon'>
				
CONTENT;

if ( isset( $notification['data']['author'] ) ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $notification['data']['author'], 'mini' );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main'>
				<a href="
CONTENT;
$return .= htmlspecialchars( $notification['data']['url'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					<span class='ipsDataItem_title'>
CONTENT;
$return .= htmlspecialchars( $notification['data']['title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					<br>
					<span class="ipsType_light">
CONTENT;

$val = ( $notification['notification']->updated_time instanceof \IPS\DateTime ) ? $notification['notification']->updated_time : \IPS\DateTime::ts( $notification['notification']->updated_time );$return .= $val->html();
$return .= <<<CONTENT
</span>
				</a>
			</div>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function notificationsRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT
 
	
CONTENT;

foreach ( $rows as $notification ):
$return .= <<<CONTENT

		
CONTENT;

if ( isset( $notification['data']['title'] ) ):
$return .= <<<CONTENT

			<li class='ipsDataItem 
CONTENT;

if ( $notification['data']['unread'] ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix' itemprop="itemListElement">
				<div class='ipsDataItem_icon'>
					
CONTENT;

if ( isset( $notification['data']['author'] ) ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $notification['data']['author'], 'tiny' );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<div class='ipsDataItem_main'>
					
CONTENT;

if ( !$notification['data']['unread'] ):
$return .= <<<CONTENT

						<span class="ipsItemStatus ipsItemStatus_small ipsItemStatus_read">
							<i class="fa fa-circle"></i>
						</span>
						<strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

							<a href="
CONTENT;
$return .= htmlspecialchars( $notification['data']['url'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsDataItem_title'>
CONTENT;
$return .= htmlspecialchars( $notification['data']['title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

if ( !$notification['data']['unread'] ):
$return .= <<<CONTENT

						</strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<br>
					<span class="ipsType_light">
CONTENT;

$val = ( $notification['notification']->updated_time instanceof \IPS\DateTime ) ? $notification['notification']->updated_time : \IPS\DateTime::ts( $notification['notification']->updated_time );$return .= $val->html();
$return .= <<<CONTENT
</span>
				</div>
			</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function notificationsSettings( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('notification_options') );
$return .= <<<CONTENT

<form accept-charset='utf-8' action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" 
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT
enctype="multipart/form-data"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

		
	<div class='ipsBox' data-controller='core.front.system.notificationSettings'>
		<div class='ipsPad'><div class='ipsGrid ipsGrid_collapsePhone ipsAreaBackground_reset ipsPad ipsSpacer_bottom'>
			<ul class="ipsForm ipsForm_vertical ipsGrid_span8">
				
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT


						
CONTENT;

if ( !( $input instanceof \IPS\Helpers\Form\Matrix ) ):
$return .= <<<CONTENT

							<li class='ipsFieldRow ipsFieldRow_checkbox' 
CONTENT;

if ( $input->htmlId ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
								
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\CheckboxSet or $input instanceof \IPS\Helpers\Form\Radio ):
$return .= <<<CONTENT

									<strong class='ipsType_normal'>
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
								
CONTENT;

endif;
$return .= <<<CONTENT

								{$input->html()}

								
CONTENT;

if ( !( $input instanceof \IPS\Helpers\Form\CheckboxSet ) && !( $input instanceof \IPS\Helpers\Form\Radio ) ):
$return .= <<<CONTENT

								<div class="ipsFieldRow_content">
									<
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Checkbox ):
$return .= <<<CONTENT
label for="check_
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

else:
$return .= <<<CONTENT
span
CONTENT;

endif;
$return .= <<<CONTENT
 class="ipsType_normal">
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Checkbox ):
$return .= <<<CONTENT
label
CONTENT;

else:
$return .= <<<CONTENT
span
CONTENT;

endif;
$return .= <<<CONTENT
>
									
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists("{$input->name}_desc")  ):
$return .= <<<CONTENT

										<span class='ipsFieldRow_desc'>
CONTENT;

$val = "{$input->name}_desc"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</div>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</li>					
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
			<div class='ipsGrid_span4 ipsPad ipsHide' data-role='browserNotifyInfo'>
		
			</div>
          </div></div>
		<div class='ipsAreaBackground ipsType_center ipsPad'>
			
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

				{$button}
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</div>
	</div>
	<br>
	
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

			
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Matrix ):
$return .= <<<CONTENT

				<br>
				<div class='ipsBox'>
					{$input->nested()}
					<div class='ipsAreaBackground ipsPad ipsType_center'>
						
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

							{$button}
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT


	<br>
	
</form>
CONTENT;

		return $return;
}

	function notificationsTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom'>
	<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<div class="ipsPos_right">
		<a class="ipsButton ipsButton_light ipsButton_verySmall" href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=options", null, "notifications_options", array(), 0 ) );
$return .= <<<CONTENT
"><i class="fa fa-cog"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notification_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</div>
</div>

<div class='ipsBox'>
	
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		<div data-role="tablePagination">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

		</div>
	</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( count( $rows ) ):
$return .= <<<CONTENT

		<ol class='ipsDataList ipsClear cForumTopicTable 
CONTENT;

foreach ( $table->classes as $class ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

endforeach;
$return .= <<<CONTENT
' id='elTable_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="tableRows" itemscope itemtype="http://schema.org/ItemList">
			<meta itemprop="itemListOrder" content="Descending">
			
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

		</ol>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsType_center'>
			<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications_none', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function offline( $message ) {
		$return = '';
		$return .= <<<CONTENT

<div id='ipsLayout_mainArea'>
	<div class='ipsBox ipsPad'><h1 class='ipsType_pageTitle'>
CONTENT;

$sprintf = array(\IPS\Settings::i()->board_name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'offline_unavailable', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</h1>
	<br>
	<div class='ipsRichText ipsType_normal'>
		{$message}
	</div>
	<br>
	
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "logout", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_medium ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	
CONTENT;

else:
$return .= <<<CONTENT

		<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_medium ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
      
CONTENT;

endif;
$return .= <<<CONTENT
</div>
</div>
CONTENT;

		return $return;
}

	function privacy(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT

<h2 class="ipsType_sectionTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'privacy', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>

CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT


<div class='ipsType_normal ipsType_richText ipsPad'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'privacy_text_value', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->site_address and \IPS\Settings::i()->site_address != "null" ):
$return .= <<<CONTENT

		<p>
CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT
, 
CONTENT;

$return .= \IPS\GeoLocation::parseForOutput( \IPS\Settings::i()->site_address );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>


CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reconfirmTerms( $terms, $privacy, $form ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsType_large ipsSpacer_bottom">
	
CONTENT;

if ( $terms and $privacy ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reconfirm_terms_and_policy_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

elseif ( $terms ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reconfirm_terms_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reconfirm_privacy_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>


CONTENT;

if ( $terms ):
$return .= <<<CONTENT

	<div class="ipsSpacer_bottom">
		<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_terms', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class='ipsType_normal ipsType_richText ipsPad'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_rules_value', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( $privacy ):
$return .= <<<CONTENT

	<div class="ipsSpacer_bottom">
		<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'privacy', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class='ipsType_normal ipsType_richText ipsPad'>
			
CONTENT;

if ( \IPS\Settings::i()->privacy_type == 'external' ):
$return .= <<<CONTENT

				<a href='
CONTENT;

$return .= \IPS\Settings::i()->privacy_link;
$return .= <<<CONTENT
' rel='external'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_privacy_policy', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'privacy_text_value', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Settings::i()->site_address and \IPS\Settings::i()->site_address != "null" ):
$return .= <<<CONTENT

				<p>
CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT
, 
CONTENT;

$return .= \IPS\GeoLocation::parseForOutput( \IPS\Settings::i()->site_address );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


{$form}
CONTENT;

		return $return;
}

	function register( $form, $login ) {
		$return = '';
		$return .= <<<CONTENT

<section>
	<div data-role='registerForm'>
		<div class='ipsColumns ipsColumns_collapseTablet'>
			<div class='ipsColumn ipsColumn_fluid'>
				<div class='ipsBox ipsPad'>
                  
                  <h1 class='ipsType_veryLarge ipsType_center ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
                  <p class='ipsType_large ipsType_center ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'existing_user', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></p>
                  <br />
                  
					{$form}
				</div>
			</div>
			
CONTENT;

if ( count ( $login->forms( FALSE, TRUE ) ) > 1 ):
$return .= <<<CONTENT

				<div class='ipsColumn ipsColumn_wide' id='elRegisterSocial'>
					<div class='ipsBox ipsPad'>
						<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_start_faster', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
						<p class='ipsType_normal ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_connect', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
						<br>
						
CONTENT;

foreach ( $login->forms( FALSE, TRUE ) as $k => $form ):
$return .= <<<CONTENT

							
CONTENT;

if ( $k !== '_standard' ):
$return .= <<<CONTENT

								<div class='ipsPad_half ipsType_center'>
									{$form}
								</div>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</section>
CONTENT;

		return $return;
}

	function registerWrapper( $content ) {
		$return = '';
		$return .= <<<CONTENT


<div id='elRegisterForm' class='ipsPos_center ipsPad' data-controller='core.front.system.register'>
	{$content}
</div>
CONTENT;

		return $return;
}

	function resetPass( $form ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('lost_password') );
$return .= <<<CONTENT

<div class='ipsLayout_contentSection'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reset_pass_instructions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	<br>
	<br>
	{$form}
</div>
CONTENT;

		return $return;
}

	function searchResult( $indexData, $articles, $authorData, $itemData, $unread, $objectUrl, $itemUrl, $containerUrl, $containerTitle, $repCount, $showRepUrl, $snippet, $iPostedIn, $view, $canIgnoreComments=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsStreamItem ipsStreamItem_contentBlock ipsStreamItem_
CONTENT;
$return .= htmlspecialchars( $view, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsAreaBackground_reset ipsPad 
CONTENT;

if ( $indexData['index_hidden'] ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='activityItem' data-timestamp='
CONTENT;
$return .= htmlspecialchars( $indexData['index_date_created'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<div class='ipsStreamItem_container ipsClearfix'>
		
CONTENT;

if ( in_array( 'IPS\Content\Comment', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

			
CONTENT;

$itemClass = $indexData['index_class']::$itemClass;
$return .= <<<CONTENT

			<div class='ipsStreamItem_header ipsPhotoPanel ipsPhotoPanel_mini'>
				
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

					<span class='ipsStreamItem_contentType' data-ipsTooltip title='
CONTENT;

$val = "{$itemClass::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $itemClass::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i></span>
				
CONTENT;

else:
$return .= <<<CONTENT
				
					<span class='ipsStreamItem_contentType' data-ipsTooltip title='
CONTENT;

$val = "{$indexData['index_class']::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $indexData['index_class']::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i></span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhotoFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'], \IPS\Member::photoUrl( $authorData ), ( $view !== 'condensed' ) ? 'mini' : 'tiny' );
$return .= <<<CONTENT

				<div class='
CONTENT;

if ( $unread ):
$return .= <<<CONTENT
ipsStreamItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
CONTENT;

if ( $view == 'condensed' && $snippet ):
$return .= <<<CONTENT

						<div class='ipsPhotoPanel ipsPhotoPanel_small'>
							{$snippet}
							<div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<h2 class='ipsType_reset ipsStreamItem_title ipsContained_container 
CONTENT;

if ( !$indexData['index_title'] or $view == 'condensed' ):
$return .= <<<CONTENT
ipsStreamItem_titleSmall
CONTENT;

endif;
$return .= <<<CONTENT
'>
						
CONTENT;

if ( $unread ):
$return .= <<<CONTENT

							<span>
								<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl->stripQueryString( array( 'comment' => 'comment', 'review' => 'review' ) )->setQueryString( 'do', 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-linkType="star" 
CONTENT;

if ( $iPostedIn ):
$return .= <<<CONTENT
data-iPostedIn
CONTENT;

endif;
$return .= <<<CONTENT
 title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
									<span class='ipsItemStatus'><i class="fa fa-
CONTENT;

if ( $iPostedIn ):
$return .= <<<CONTENT
star
CONTENT;

else:
$return .= <<<CONTENT
circle
CONTENT;

endif;
$return .= <<<CONTENT
"></i></span>
								</a>
							</span>
						
CONTENT;

elseif ( $iPostedIn ):
$return .= <<<CONTENT

							<span><span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( isset( $indexData['index_prefix'] ) ):
$return .= <<<CONTENT

								<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( rawurlencode($indexData['index_prefix']), $indexData['index_prefix'] );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<div class='ipsType_break ipsContained'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-linkType="link" data-searchable>
CONTENT;
$return .= htmlspecialchars( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['title'] ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						</div>
						
CONTENT;

if ( $indexData['index_hidden'] ):
$return .= <<<CONTENT

								
CONTENT;

if ( $indexData['index_hidden'] === -1 ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hidden', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
								
CONTENT;

elseif ( $indexData['index_hidden'] === 1 ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span></span>
								
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</h2>
					
CONTENT;

if ( $view != 'condensed' ):
$return .= <<<CONTENT

						<p class='ipsType_reset ipsStreamItem_status ipsType_light ipsType_blendLinks'>
							
CONTENT;

if ( in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

								
CONTENT;

if ( isset( $itemData['author'] ) ):
$return .= <<<CONTENT

									
CONTENT;

$sprintf = array($authorData['name'], $itemData['author']['name'], $articles['definite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_other_activity_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$sprintf = array($authorData['name'], $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_own_activity_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( $itemClass::$firstCommentRequired ):
$return .= <<<CONTENT

									
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

										
CONTENT;

$sprintf = array($authorData['name'], $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_own_activity_item', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
									
CONTENT;

else:
$return .= <<<CONTENT

										
CONTENT;

if ( isset( $itemData['author'] ) ):
$return .= <<<CONTENT

											
CONTENT;

$sprintf = array($authorData['name'], $itemData['author']['name'], $articles['definite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_other_activity_reply', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
										
CONTENT;

else:
$return .= <<<CONTENT

											
CONTENT;

$sprintf = array($authorData['name'], $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_own_activity_reply', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
										
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

if ( isset( $itemData['author'] ) ):
$return .= <<<CONTENT

										
CONTENT;

$sprintf = array($authorData['name'], $itemData['author']['name'], $articles['definite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_other_activity_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
									
CONTENT;

else:
$return .= <<<CONTENT

										
CONTENT;

$sprintf = array($authorData['name'], $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_own_activity_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT
							
						</p>
					
CONTENT;

else:
$return .= <<<CONTENT

						<ul class='ipsList_inline ipsStreamItem_stats ipsType_light ipsType_blendLinks'>
							<li>
								<a href='
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findReview', 'review' => $indexData['index_object_id'] ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findComment', 'comment' => $indexData['index_object_id'] ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsType_blendLinks'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a>
							</li>
							
CONTENT;

if ( isset( $itemClass::$databaseColumnMap['num_comments'] ) and isset( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] ) and $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] > ( $itemClass::$firstCommentRequired ? 1 : 0 ) ):
$return .= <<<CONTENT

								<li>
									<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl->setQueryString( 'do', 'getFirstComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
										
CONTENT;

if ( $itemClass::$firstCommentRequired ):
$return .= <<<CONTENT

											<i class='fa fa-comment'></i> 
CONTENT;

$return .= htmlspecialchars( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ]-1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

else:
$return .= <<<CONTENT

											<i class='fa fa-comment'></i> 
CONTENT;

$return .= htmlspecialchars( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

endif;
$return .= <<<CONTENT

									</a>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( isset( $itemClass::$databaseColumnMap['num_reviews'] ) and isset( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_reviews'] ] ) and $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_reviews'] ] ):
$return .= <<<CONTENT

								<li>
									<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
#reviews' class='ipsType_blendLinks'><i class='fa fa-star-half-o'></i> 
CONTENT;
$return .= htmlspecialchars( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_reviews'] ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>

						<p class='ipsStreamItem_status ipsType_reset ipsType_blendLinks'>
							
CONTENT;

if ( in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

								
CONTENT;

if ( isset( $itemData['author'] ) ):
$return .= <<<CONTENT

									
CONTENT;

$sprintf = array($authorData['name'], $itemData['author']['name'], $articles['definite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_other_activity_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$sprintf = array($authorData['name'], $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_own_activity_review', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( $itemClass::$firstCommentRequired ):
$return .= <<<CONTENT

									
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

										
CONTENT;

$sprintf = array($authorData['name'], $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_own_activity_item', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
									
CONTENT;

else:
$return .= <<<CONTENT

										
CONTENT;

if ( isset( $itemData['author'] ) ):
$return .= <<<CONTENT

											
CONTENT;

$sprintf = array($authorData['name'], $itemData['author']['name'], $articles['definite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_other_activity_reply', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
										
CONTENT;

else:
$return .= <<<CONTENT

											
CONTENT;

$sprintf = array($authorData['name'], $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_own_activity_reply', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
										
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

if ( isset( $itemData['author'] ) ):
$return .= <<<CONTENT

										
CONTENT;

$sprintf = array($authorData['name'], $itemData['author']['name'], $articles['definite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_other_activity_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
									
CONTENT;

else:
$return .= <<<CONTENT

										
CONTENT;

$sprintf = array($authorData['name'], $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_own_activity_comment', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $indexData['index_tags'] ) and $view == 'condensed' ):
$return .= <<<CONTENT

						<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( explode( ',', $indexData['index_tags'] ), true, true );
$return .= <<<CONTENT
</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

						
					
CONTENT;

if ( $view == 'condensed' && $snippet ):
$return .= <<<CONTENT

							</div>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
			
CONTENT;

if ( $view !== 'condensed' ):
$return .= <<<CONTENT

				<div class='ipsStreamItem_snippet ipsType_break'>
					
CONTENT;

if ( $canIgnoreComments and isset( $itemData['author'] ) and \IPS\Member::loggedIn()->member_id and isset( $authorData['member_id'] ) and isset ( $authorData['member_group_id'] ) and \IPS\Member::loggedIn()->isIgnoring( $authorData, 'topics' ) ):
$return .= <<<CONTENT

					<div class='ipsComment_ignored ipsType_light' id='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ignoreCommentID='elComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ignoreUserID='
CONTENT;
$return .= htmlspecialchars( $authorData['member_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						
CONTENT;

$sprintf = array($authorData['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignoring_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu data-ipsMenu-menuID='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu-appendTo='#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="ignoreOptions" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_post_ignore_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
						<ul class='ipsMenu ipsHide' id='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
							<li class='ipsMenu_item ipsJS_show' data-ipsMenuValue='showPost'><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_this_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class='ipsMenu_sep ipsJS_show'><hr></li>
							<li class='ipsMenu_item' data-ipsMenuValue='stopIgnoring'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=remove&id={$authorData['member_id']}", null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array($authorData['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stop_ignoring_posts_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a></li>
							<li class='ipsMenu_item'><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore", null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_ignore_preferences', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						</ul>
					</div>
					<div id='elComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsHide">
						{$snippet}
					</div>
					
CONTENT;

else:
$return .= <<<CONTENT

					 	{$snippet}
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<ul class='ipsList_inline ipsStreamItem_meta'>
					<li class='ipsType_light ipsType_medium'>
						<a href='
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findReview', 'review' => $indexData['index_object_id'] ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findComment', 'comment' => $indexData['index_object_id'] ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsType_blendLinks'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a>
					</li>
					
CONTENT;

if ( isset( $itemClass::$databaseColumnMap['num_comments'] ) and isset( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] ) and $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] > ( $itemClass::$firstCommentRequired ? 1 : 0 ) ):
$return .= <<<CONTENT

						<li class='ipsType_light ipsType_medium'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl->setQueryString( 'do', 'getFirstComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
								
CONTENT;

if ( $itemClass::$firstCommentRequired ):
$return .= <<<CONTENT

									<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_replies', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( in_array( 'IPS\Content\Reputation', class_implements( $indexData['index_class'] ) ) and \IPS\Settings::i()->reputation_enabled && $repCount ):
$return .= <<<CONTENT

						<li class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationMini( $repCount, FALSE, FALSE, $showRepUrl, NULL );
$return .= <<<CONTENT
</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $indexData['index_tags'] ) ):
$return .= <<<CONTENT

						<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( explode( ',', $indexData['index_tags'] ), true, true );
$return .= <<<CONTENT
</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsStreamItem_header ipsPhotoPanel ipsPhotoPanel_mini'>
				<span class='ipsStreamItem_contentType' data-ipsTooltip title='
CONTENT;

$val = "{$indexData['index_class']::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'ucfirst' => TRUE ) );
$return .= <<<CONTENT
'><i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $indexData['index_class']::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i></span>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhotoFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'], \IPS\Member::photoUrl( $authorData ), ( $view !== 'condensed' ) ? 'mini' : 'tiny' );
$return .= <<<CONTENT

				<div class='
CONTENT;

if ( $unread ):
$return .= <<<CONTENT
ipsStreamItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
CONTENT;

if ( $view == 'condensed' && $snippet ):
$return .= <<<CONTENT

						<div class='ipsPhotoPanel ipsPhotoPanel_small'>
							{$snippet}
							<div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<h2 class='ipsType_reset ipsContained_container ipsStreamItem_title ipsType_break 
CONTENT;

if ( $view == 'condensed' ):
$return .= <<<CONTENT
ipsStreamItem_titleSmall
CONTENT;

endif;
$return .= <<<CONTENT
'>
						
CONTENT;

if ( $unread ):
$return .= <<<CONTENT

							<span><a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( 'do', 'getNewComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-linkType="star" 
CONTENT;

if ( $iPostedIn ):
$return .= <<<CONTENT
data-iPostedIn
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsTooltip>
								<span class='ipsItemStatus'><i class="fa fa-
CONTENT;

if ( $iPostedIn ):
$return .= <<<CONTENT
star
CONTENT;

else:
$return .= <<<CONTENT
circle
CONTENT;

endif;
$return .= <<<CONTENT
"></i></span>
							</a></span>
						
CONTENT;

elseif ( $iPostedIn ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( isset( $indexData['index_prefix'] ) ):
$return .= <<<CONTENT

							<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( rawurlencode($indexData['index_prefix']), $indexData['index_prefix'] );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<div class='ipsContained ipsType_break'><a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-linkType="link" data-searchable>
CONTENT;
$return .= htmlspecialchars( $indexData['index_title'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
						
CONTENT;

if ( $indexData['index_hidden'] ):
$return .= <<<CONTENT

							<span class="ipsBadge ipsBadge_icon ipsBadge_warning ipsBadge_small" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hidden', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT
	
						
CONTENT;

if ( isset( $indexData['index_tags'] ) and $view == 'condensed' ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( explode( ',', $indexData['index_tags'] ), true, true );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</h2>
					
CONTENT;

if ( $view != 'condensed' ):
$return .= <<<CONTENT

						<p class='ipsType_reset ipsStreamItem_status ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($authorData['name'], $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_own_activity_item', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></p>
					
CONTENT;

else:
$return .= <<<CONTENT

						<ul class='ipsList_inline ipsStreamItem_stats ipsType_light ipsType_blendLinks'>
							<li>
								<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a>
							</li>
							
CONTENT;

if ( isset( $indexData['index_class']::$databaseColumnMap['num_comments'] ) and isset( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] ) and $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] > ( $indexData['index_class']::$firstCommentRequired ? 1 : 0 ) ):
$return .= <<<CONTENT

								<li>
									<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl->setQueryString( 'do', 'getFirstComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
										
CONTENT;

if ( $indexData['index_class']::$firstCommentRequired ):
$return .= <<<CONTENT

											<i class='fa fa-comment'></i> 
CONTENT;

$return .= htmlspecialchars( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] - 1, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

else:
$return .= <<<CONTENT

											<i class='fa fa-comment'></i> 
CONTENT;

$return .= htmlspecialchars( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

endif;
$return .= <<<CONTENT

									</a>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( isset( $indexData['index_class']::$databaseColumnMap['num_reviews'] ) and isset( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ] ) and $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ] ):
$return .= <<<CONTENT

								<li>
									<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
#reviews' class='ipsType_blendLinks'><i class='fa fa-star-half-o'></i> 
CONTENT;

$return .= htmlspecialchars( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
						<p class='ipsStreamItem_status ipsType_reset ipsType_blendLinks'>
							
CONTENT;

$sprintf = array($authorData['name'], $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_own_activity_item', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $containerTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
					
CONTENT;

if ( $view == 'condensed' && $snippet ):
$return .= <<<CONTENT

							</div>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
			
CONTENT;

if ( $view !== 'condensed' ):
$return .= <<<CONTENT

				<div class='ipsStreamItem_snippet ipsType_break'>
					{$snippet}
				</div>
				<ul class='ipsList_inline ipsStreamItem_meta'>
					<li class='ipsType_light ipsType_medium'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a>
					</li>
					
CONTENT;

if ( isset( $indexData['index_class']::$databaseColumnMap['num_comments'] ) and isset( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] ) and $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] > ( $indexData['index_class']::$firstCommentRequired ? 1 : 0 ) ):
$return .= <<<CONTENT

						<li class='ipsType_light ipsType_medium'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl->setQueryString( 'do', 'getFirstComment' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
								
CONTENT;

if ( $indexData['index_class']::$firstCommentRequired ):
$return .= <<<CONTENT

									<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_replies', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_comments', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $indexData['index_class']::$databaseColumnMap['num_reviews'] ) and isset( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ] ) and $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ] ):
$return .= <<<CONTENT

						<li class='ipsType_light ipsType_medium'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
#reviews' class='ipsType_blendLinks'><i class='fa fa-star-half-o'></i> 
CONTENT;

$pluralize = array( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_reviews', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( in_array( 'IPS\Content\Reputation', class_implements( $indexData['index_class'] ) ) and \IPS\Settings::i()->reputation_enabled and $repCount ):
$return .= <<<CONTENT

						<li class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationMini( $repCount, FALSE, FALSE, $showRepUrl, NULL );
$return .= <<<CONTENT
</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $indexData['index_tags'] ) ):
$return .= <<<CONTENT

						<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( explode( ',', $indexData['index_tags'] ), true, true );
$return .= <<<CONTENT
</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</li>
CONTENT;

		return $return;
}

	function searchResultSnippet( $indexData ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( trim( $indexData['index_content'] ) !== '' ):
$return .= <<<CONTENT

	<div class='ipsType_richText ipsContained ipsType_medium'>
		<div 
CONTENT;

if ( !( \IPS\Dispatcher::i()->application->directory == 'core' and \IPS\Dispatcher::i()->module and \IPS\Dispatcher::i()->module->key == 'search' ) ):
$return .= <<<CONTENT
data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='3 lines' data-ipsTruncate-watch='false'
CONTENT;

else:
$return .= <<<CONTENT
data-searchable data-findTerm
CONTENT;

endif;
$return .= <<<CONTENT
>
			{$indexData['index_content']}
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function settings( $tab, $output, $canChangeEmail, $canChangePassword, $canChangeUsername, $canChangeSignature, $services ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('settings'), \IPS\Member::loggedIn()->language()->addToStack('settings_blurb') );
$return .= <<<CONTENT

<div class='ipsBox'>
<div class='ipsTabs ipsTabs_withIcons ipsTabs_contained ipsTabs_stretch ipsClearfix' id='elSettingsTabs' data-ipsTabBar data-ipsTabBar-contentArea='#elProfileTabContent'>
	<a href='#elSettingsTabs' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
	<ul role='tablist' class='ipsList_reset'>
		<li>
			<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings", null, "settings", array(), 0 ) );
$return .= <<<CONTENT
' id='setting_overview' class='ipsTabs_item 
CONTENT;

if ( $tab === 'overview' ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'overview', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="true">
				<i class='fa fa-tachometer'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'overview', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</a>
		</li>
		
CONTENT;

if ( $canChangeEmail ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=email", null, "settings_email", array(), 0 ) );
$return .= <<<CONTENT
' id='setting_email' class='ipsTabs_item 
CONTENT;

if ( $tab === 'email' ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="false">
					<i class='fa fa-envelope-o'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $canChangePassword ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=password", null, "settings_password", array(), 0 ) );
$return .= <<<CONTENT
' id='setting_password' class='ipsTabs_item 
CONTENT;

if ( $tab === 'password' ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="false">
					<i class='fa fa-lock'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $canChangeUsername ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=username", null, "settings_username", array(), 0 ) );
$return .= <<<CONTENT
' id='setting_username' class='ipsTabs_item 
CONTENT;

if ( $tab === 'username' ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="false">
					<i class='fa fa-user'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $canChangeSignature ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=signature", null, "settings_signature", array(), 0 ) );
$return .= <<<CONTENT
' id='setting_signature' class='ipsTabs_item 
CONTENT;

if ( $tab === 'signature' ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'signature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="false">
					<i class='fa fa-pencil'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'signature', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

foreach ( $services as $k => $class ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=profilesync&service={$k}", null, "settings_{$k}", array(), 0 ) );
$return .= <<<CONTENT
' id='setting_profilesync_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_item 
CONTENT;

if ( $tab === "profilesync_{$k}" ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$val = "profilesync__{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="false">
					<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $class::$icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i> 
CONTENT;

$val = "profilesync__{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
<section id='elProfileTabContent' class='ipsTabs_contained ipsTabs_panels'>
	<div id="ipsTabs_elSettingsTabs_setting_
CONTENT;
$return .= htmlspecialchars( $tab, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel" class="ipsTabs_panel" aria-labelledby="setting_overview" aria-hidden="false">
		{$output}
	</div>
</section>
</div>
CONTENT;

		return $return;
}

	function settingsEmail( $form=null ) {
		$return = '';
		$return .= <<<CONTENT

<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_address', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>

CONTENT;

if ( $form ):
$return .= <<<CONTENT

	<br><br>
	
CONTENT;

if ( \IPS\Settings::i()->reg_auth_type == 'user' or \IPS\Settings::i()->reg_auth_type == 'admin_user' ):
$return .= <<<CONTENT

		<div class='ipsType_textBlock ipsType_normal'>
			<ul class='ipsList_bullets'>
				<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_explain_1', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
				<li>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_explain_2', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</li>
			</ul>
		</div>
		<br><hr class='ipsHr'><br>
	
CONTENT;

endif;
$return .= <<<CONTENT

	{$form}

CONTENT;

else:
$return .= <<<CONTENT

	<hr class='ipsHr'><br>
	<div class='ipsType_normal'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_admin_1', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</div>

	<ol class='ipsList_bullets ipsList_numbers ipsSpacer_top ipsType_normal'>
		<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_admin_2', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
		<li>
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_admin_3', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</li>
		<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_admin_4', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
		<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_admin_5', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
	</ol>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function settingsMfa( $handlers ) {
		$return = '';
		$return .= <<<CONTENT


<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_settings_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
<hr class='ipsHr'>
<p class='ipsType_normal ipsSpacer_bottom ipsSpacer_double'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_ucp_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>


CONTENT;

foreach ( $handlers as $key => $handler ):
$return .= <<<CONTENT

	<div class="ipsSpacer_bottom ipsPad ipsAreaBackground_light ipsClearfix">
		<h2 class="ipsType_sectionHead ipsType_large">
CONTENT;

$val = "mfa_{$key}_title"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

if ( $handler->memberHasConfiguredHandler( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT
&nbsp;&nbsp;<span class='ipsType_positive ipsType_medium'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enabled', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT
</h2>
		<p class='ipsType_medium'>
CONTENT;

$val = "mfa_{$key}_desc_user"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<ul class="ipsList_inline">
		
CONTENT;

if ( $handler->memberHasConfiguredHandler( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

			<li><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=mfa&do=enableMfa&type={$key}", null, "settings_mfa", array(), 0 ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_verySmall ipsButton_primary">
CONTENT;

$val = "mfa_{$key}_reauth"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
			<li><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=mfa&do=disableMfa&type={$key}", null, "settings_mfa", array(), 0 ) );
$return .= <<<CONTENT
" class="ipsType_negative" data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_disable', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

else:
$return .= <<<CONTENT

			<li><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=mfa&do=enableMfa&type={$key}", null, "settings_mfa", array(), 0 ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_verySmall ipsButton_primary">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enable', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function settingsMfaPassword( $form ) {
		$return = '';
		$return .= <<<CONTENT


<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_settings_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
<hr class='ipsHr'>
<p class='ipsType_normal ipsSpacer_bottom ipsSpacer_double'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_ucp_blurb_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>

{$form}
CONTENT;

		return $return;
}

	function settingsMfaSetup( $configurationScreen, $url ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elTwoFactorAuthentication' class='ipsModal' data-controller='core.global.core.2fa'>
	<div>
		<form action="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" accept-charset='utf-8' data-ipsForm class="ipsForm ipsForm_fullWidth">
			<input type="hidden" name="mfa_setup" value="1">
			{$configurationScreen}
		</form>
	</div>
</div>
CONTENT;

		return $return;
}

	function settingsOverview( $services ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsColumns ipsColumns_collapsePhone'>
	<div class='ipsColumn ipsColumn_fluid'>
		<ul class='ipsDataList'>
			<li class='ipsDataItem'>
				<div class='ipsDataItem_main'>
					<h4 class='ipsDataItem_title'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></h4><br>
					
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</div>
			</li>
			<li class='ipsDataItem'>
				<div class='ipsDataItem_main'>
					<h4 class='ipsDataItem_title'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></h4><br>
					
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->email, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</div>
			</li>
			
CONTENT;

if ( \IPS\Member::loggedIn()->members_pass_hash ):
$return .= <<<CONTENT

				<li class='ipsDataItem'>
					<div class='ipsDataItem_main'>
						<h4 class='ipsDataItem_title'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></h4><br>
						********
					</div>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $services as $k => $service ):
$return .= <<<CONTENT

				<li class='ipsDataItem'>
					<div class='ipsDataItem_main'>
						
CONTENT;

if ( $service->connected() ):
$return .= <<<CONTENT

							<h4 class='ipsDataItem_title'><span class='ipsBadge ipsBadge_positive'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enabled', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span> <strong>
CONTENT;

$val = "profilesync__{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></h4><br>
							
CONTENT;

if ( $service->name() ):
$return .= <<<CONTENT

                                
CONTENT;

$sprintf = array($service->name()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_logged_in_as', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
<br>
                            
CONTENT;

endif;
$return .= <<<CONTENT

							<span class='ipsType_light'>
CONTENT;
$return .= htmlspecialchars( $service->settingsDesc(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
						
CONTENT;

else:
$return .= <<<CONTENT

							<h4 class='ipsDataItem_title'><span class='ipsBadge ipsBadge_negative'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disabled', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span> <strong>
CONTENT;

$val = "profilesync__{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></h4><br>
							<span class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_not_syncing', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>
	<div class='ipsColumn ipsColumn_wide ipsAreaBackground_light'>
		<div class='ipsPad'>
			
CONTENT;

$thisMemberID = \IPS\Member::loggedIn()->member_id;
$return .= <<<CONTENT

			<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'other_settings', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
			<br><br>
			<ul class='ipsList ipsList_reset ipsType_medium'>
				<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=options", null, "notifications_options", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notification_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->url()->setQueryString( 'do', 'edit' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-modal='true' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li><a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=ignore", null, "ignore", array(), 0 ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_manage_ignore', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			</ul>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function settingsPassword( $form=null ) {
		$return = '';
		$return .= <<<CONTENT

<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
<hr class='ipsHr'><br>

CONTENT;

if ( $form ):
$return .= <<<CONTENT

	{$form}

CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsType_normal'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password_admin_1', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</div>

	<ol class='ipsList_bullets ipsList_numbers ipsSpacer_top ipsType_normal'>
		<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password_admin_2', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
		<li>
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password_admin_3', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</li>
		<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password_admin_4', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
		<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password_admin_5', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
	</ol>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function settingsProfileSync( $photo, $headline, $status, $form, $service, $langKey, $syncingOn ) {
		$return = '';
		$return .= <<<CONTENT

<div class='
CONTENT;

if ( $photo ):
$return .= <<<CONTENT
ipsPhotoPanel ipsPhotoPanel_mini 
CONTENT;

endif;
$return .= <<<CONTENT
ipsClearfix'>
	
CONTENT;

if ( $photo ):
$return .= <<<CONTENT
<img src='
CONTENT;
$return .= htmlspecialchars( $photo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='' class='ipsUserPhoto ipsUserPhoto_mini'>
CONTENT;

endif;
$return .= <<<CONTENT

	<div>
		<h2 class='ipsType_sectionHead'>
CONTENT;
$return .= htmlspecialchars( $headline, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
		
CONTENT;

if ( $status and \IPS\Settings::i()->profile_comments ):
$return .= <<<CONTENT

			<p class='ipsType_reset ipsType_light ipsType_normal' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='3 lines'>
				{$status->content}
			</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
<br><hr class='ipsHr'>

<div class='ipsGrid ipsGrid_collapsePhone'>
	<div class='ipsGrid_span6'>
		<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
		<br><br>
		{$form}
	</div>
	<div class='ipsGrid_span6'>
	
		<div class='ipsAreaBackground ipsPad ipsType_normal'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_sync_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
<br>
			<span class='ipsType_light'>
CONTENT;

if ( \IPS\Member::loggedIn()->profilesync_lastsync ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( \IPS\Member::loggedIn()->profilesync_lastsync )->localeDate()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_last_sync', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_not_synced', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
			<br><br>

			
CONTENT;

if ( $syncingOn ):
$return .= <<<CONTENT
<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=profilesync&service={$service}&sync=1", null, "settings_{$service}", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_normal ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_sync', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a> &nbsp;&nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;&nbsp; 
CONTENT;

endif;
$return .= <<<CONTENT
<a href='
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=profilesync&service={$service}&disassociate=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings_{$service}", array(), 0 ) );
$return .= <<<CONTENT
' class='ipsType_normal ipsType_warning'>
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $langKey )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_off', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a>
		</div>
	</div>
</div>

CONTENT;

		return $return;
}

	function settingsProfileSyncLogin( $form, $langKey ) {
		$return = '';
		$return .= <<<CONTENT

<p class="ipsMessage ipsMessage_info">
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $langKey ), \IPS\Member::loggedIn()->language()->addToStack( $langKey )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
<div class='ipsPad ipsAreaBackground ipsPos_center'>{$form}</div>
CONTENT;

		return $return;
}

	function settingsSignature( $form, $sigLimits ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $sigLimits[1] != "" or $sigLimits[2] or $sigLimits[3] or $sigLimits[4] or $sigLimits[5] ):
$return .= <<<CONTENT

	<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'signature_restrictions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	<p class='ipsType_medium ipsType_reset'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ensure_signature_restrictions', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
:
	</p>

	<div class='ipsType_textBlock ipsType_normal'>
		<br>
		<ul class='ipsList_inline'>
			
CONTENT;

if ( $sigLimits[1] != "" ):
$return .= <<<CONTENT

				<li>
CONTENT;

if ( $sigLimits[1] ):
$return .= <<<CONTENT
<i class='fa fa-check'></i> 
CONTENT;

$pluralize = array( $sigLimits[1] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sig_max_imagesr', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
<i class='fa fa-close'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sig_max_imagesr_none', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $sigLimits[2] or $sigLimits[3] ):
$return .= <<<CONTENT

				<li><i class='fa fa-check'></i> 
CONTENT;

$sprintf = array($sigLimits[2], $sigLimits[3]); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sig_max_imgsize', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $sigLimits[4] ):
$return .= <<<CONTENT

				<li><i class='fa fa-check'></i> 
CONTENT;

$pluralize = array( $sigLimits[4] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sig_max_urls', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $sigLimits[5] ):
$return .= <<<CONTENT

				<li><i class='fa fa-check'></i> 
CONTENT;

$pluralize = array( $sigLimits[5] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sig_max_lines', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>
	<hr class='ipsHr'><br>

CONTENT;

endif;
$return .= <<<CONTENT

{$form}

CONTENT;

		return $return;
}

	function settingsUsername( $form, $made, $allowed, $since, $days ) {
		$return = '';
		$return .= <<<CONTENT

<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_username', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>

CONTENT;

if ( \IPS\Member::loggedIn()->group['g_dname_changes'] != -1 ):
$return .= <<<CONTENT

	<div class='ipsType_textBlock ipsType_normal'>
		<ul class='ipsList_bullets'>
			<li>
CONTENT;

$sprintf = array($made, $allowed, $since->localeDate(), $days); $pluralize = array( $allowed ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_username_explain', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf, 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
		</ul>
	</div>
	<br>

CONTENT;

endif;
$return .= <<<CONTENT

<hr class='ipsHr'><br>
{$form}

CONTENT;

		return $return;
}

	function settingsUsernameLimitReached( $message ) {
		$return = '';
		$return .= <<<CONTENT

<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_username', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
<hr class='ipsHr'><br>
{$message}

CONTENT;

		return $return;
}

	function terms(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT



CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b1'];
$return .= <<<CONTENT

<h2 class="ipsType_sectionTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_terms', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>

CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b2'];
$return .= <<<CONTENT



CONTENT;

endif;
$return .= <<<CONTENT



<div class='ipsType_normal ipsType_richText ipsPad'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_rules_value', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>



CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT



CONTENT;

$return .= \IPS\Theme::i()->settings['ipsfocus_b3'];
$return .= <<<CONTENT



CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function unsubscribed(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('unsubscribed') );
$return .= <<<CONTENT

<div class='ipsLayout_contentSection'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unsubscribed_desc', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function warningRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class="ipsDataItem 
CONTENT;

if ( method_exists( $row, 'tableClass' ) && $row->tableClass() ):
$return .= <<<CONTENT
ipsDataItem_
CONTENT;
$return .= htmlspecialchars( $row->tableClass(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 ">
		<div class='ipsDataItem_icon ipsPos_top'>
			<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=view&id={$row->member}&w={$row->id}", null, "warn_view", array( \IPS\Member::load( $row->member )->members_seo_name ), 0 ) );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' class="ipsType_blendLinks" data-ipsTooltip title='
CONTENT;

$pluralize = array( $row->points ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'wan_action_points', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
				<span class="ipsPoints">
CONTENT;
$return .= htmlspecialchars( $row->points, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</a>
		</div>
		<div class='ipsDataItem_main'>
			<h4 class='ipsDataItem_title'>				
				<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_announcement', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' 
CONTENT;

if ( $row->tableHoverUrl ):
$return .= <<<CONTENT
data-ipsHover
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

if ( $row->mapped('title') ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
<em class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em>
CONTENT;

endif;
$return .= <<<CONTENT

				</a>
			</h4>
            
CONTENT;

if ( $row->note_member ):
$return .= <<<CONTENT

                <div class='ipsDataItem_meta ipsType_richText ipsType_medium' data-ipsTruncate data-ipsTruncate-size='1 lines' data-ipsTruncate-type='remove'>
                    
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_member_note', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: {$row->note_member}
                </div>
            
CONTENT;

endif;
$return .= <<<CONTENT

            
CONTENT;

if ( $row->note_mods and \IPS\Member::loggedIn()->modPermission('mod_see_warn') ):
$return .= <<<CONTENT

                <div class='ipsDataItem_meta ipsType_richText ipsType_medium' data-ipsTruncate data-ipsTruncate-size='1 lines' data-ipsTruncate-type='remove'>
                    
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_mod_note', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: {$row->note_mods}
                </div>
            
CONTENT;

endif;
$return .= <<<CONTENT

            <ul class='ipsList_inline ipsSpacer_top ipsSpacer_half'>
            
CONTENT;

if ( \IPS\Settings::i()->warnings_acknowledge ):
$return .= <<<CONTENT

            	<li>
					
CONTENT;

if ( $row->acknowledged ):
$return .= <<<CONTENT

						<strong class='ipsType_success'><i class='fa fa-check-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_acknowledged', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					
CONTENT;

else:
$return .= <<<CONTENT

						<strong class='ipsType_light'><i class='fa fa-circle-o'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_not_acknowledged', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<li class='ipsType_light'>
CONTENT;

$sprintf = array(\IPS\Member::load( $row->moderator )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warned_by', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $row->__get( $row::$databaseColumnMap['date'] ) instanceof \IPS\DateTime ) ? $row->__get( $row::$databaseColumnMap['date'] ) : \IPS\DateTime::ts( $row->__get( $row::$databaseColumnMap['date'] ) );$return .= $val->html();
$return .= <<<CONTENT
 
CONTENT;

if ( $row->expire_date > 0 ):
$return .= <<<CONTENT
<em><strong>(
CONTENT;

$sprintf = array(\IPS\DateTime::ts( $row->expire_date )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_expires', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
)</em></strong>
CONTENT;

endif;
$return .= <<<CONTENT
</li>
		</div>
		
CONTENT;

if ( $row->canDelete() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_generic ipsDataItem_size3'>
				<a href="
CONTENT;
$return .= htmlspecialchars( $row->url('delete')->csrf(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke_this_warning', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action="revoke" class='ipsPos_right ipsButton ipsButton_verySmall ipsButton_light' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke_this_warning', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-size='medium'><i class="fa fa-undo"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke_this_warning', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck ipsType_noBreak ipsPos_center'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( !$row->active ):
$return .= <<<CONTENT
hidden
CONTENT;

endif;
$return .= <<<CONTENT
'>
					<span></span>
				</span>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}