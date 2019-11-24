<?php
namespace IPS\Theme\Cache;
class class_core_global_login extends \IPS\Theme\Template
{
	public $cache_key = '5f739e309b3ced1095d348a6df0355fc';
	function facebook( $url ) {
		$return = '';
		$return .= <<<CONTENT


<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_fullWidth ipsSocial ipsSocial_facebook'>
	<span class='ipsSocial_icon'><i class='fa fa-facebook'></i></span>
	<span class='ipsSocial_text'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login_facebook', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
</a>
CONTENT;

		return $return;
}

	function google( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_fullWidth ipsSocial ipsSocial_google'>
	<span class='ipsSocial_icon'><i class='fa fa-google-plus'></i></span>
	<span class='ipsSocial_text'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login_google', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
</a>
CONTENT;

		return $return;
}

	function googleAuthenticatorAuth( $waitUntil ) {
		$return = '';
		$return .= <<<CONTENT

<div id="elGoogleAuthenticator" data-controller="core.global.core.googleAuth" data-waitUntil="
CONTENT;
$return .= htmlspecialchars( $waitUntil, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<div class="ipsPad ipsType_normal ipsType_richText ipsType_center">
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_auth', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</div>
	<ul class="ipsList_reset ipsPad ipsClearfix ipsAreaBackground" data-role="codeInput">
		<li class="ipsFieldRow ipsClearfix " id="google_authenticator_form_google_authenticator_setup_code">
			<div class="ipsFieldRow_content">
				<input type="text" name="google_authenticator_auth_code" value="" class="
CONTENT;

if ( \IPS\Request::i()->google_authenticator_auth_code ):
$return .= <<<CONTENT
ipsField_error
CONTENT;

endif;
$return .= <<<CONTENT
" autocomplete="off" >
				
CONTENT;

if ( \IPS\Request::i()->google_authenticator_auth_code ):
$return .= <<<CONTENT

					<p class="ipsType_warning">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_invalid_code', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</li>
		<li>
			<button type='submit' class='ipsButton ipsButton_primary ipsButton_fullWidth ipsButton_medium'>
				<i class='fa fa-lock'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_submit_code', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</button>
		</li>
	</ul>
	<div class="ipsType_center ipsHide" data-role="codeWaiting">
		<div class="ipsProgressBar ipsProgressBar_animated">
			<div class="ipsProgressBar_progress" data-role="codeWaitingProgress"></div>
		</div>
		<p class="ipsType_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_wait_for_code', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	</div>
</div>
CONTENT;

		return $return;
}

	function googleAuthenticatorSetup( $qrCodeUrl, $secretKey, $showingMultipleForms ) {
		$return = '';
		$return .= <<<CONTENT

<div id="elGoogleAuthenticator" data-controller="core.global.core.googleAuth">
	<input type="hidden" name="secret" value="
CONTENT;
$return .= htmlspecialchars( $secretKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<div data-role="barcode">
		<div class='ipsPad'>
			
CONTENT;

if ( !$showingMultipleForms ):
$return .= <<<CONTENT

				<h1 class='ipsType_center ipsType_pageTitle ipsSpacer_bottom ipsSpacer_half'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_popup_setup_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class="ipsType_medium ipsType_richText ipsType_center c2FA_info">
				
CONTENT;

if ( $showingMultipleForms ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_desc_multi', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_desc_single', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		<div class='ipsGrid ipsGrid_collapsePhone'>
			<div class='ipsGrid_span4 ipsType_center'>
				<img src="
CONTENT;
$return .= htmlspecialchars( $qrCodeUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" width="150" height="150">
			</div>
			<div class='ipsGrid_span8 ipsType_center'>
				
CONTENT;

$langCode = mb_substr( \IPS\Member::loggedIn()->language()->bcp47(), 0, 2 );
$return .= <<<CONTENT

				<a href="
CONTENT;

$return .= \IPS\Http\Url::ips( "docs/googleauth_ios" );
$return .= <<<CONTENT
" target="_blank"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "appstores/ios/{$langCode}.svg", "core", 'global', false );
$return .= <<<CONTENT
" class="ipsSpacer_both"></a>
				<a href="
CONTENT;

$return .= \IPS\Http\Url::ips( "docs/googleauth_android" );
$return .= <<<CONTENT
" target="_blank"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "appstores/android/{$langCode}.png", "core", 'global', false );
$return .= <<<CONTENT
" style="height: 60px"></a>
		
				<p class='ipsType_reset'>
					<a class="ipsCursor_pointer" data-action="showManual">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_help', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</p>
			</div>
		</div>
	</div>
	<div data-role="manual" class="ipsHide">
		<div class="ipsPad ipsType_normal ipsType_richText ipsType_center">
			
CONTENT;

if ( !$showingMultipleForms ):
$return .= <<<CONTENT

				<h1 class='ipsType_center ipsType_pageTitle ipsSpacer_bottom ipsSpacer_half'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_popup_setup_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class="ipsType_medium ipsType_richText ipsType_center c2FA_info">
				
CONTENT;

if ( $showingMultipleForms ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_desc_multi_manual', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_desc_single_manual', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		<div class='ipsGrid ipsGrid_collapsePhone'>
			<div class='ipsGrid_span5'>
				<ul class="ipsDataList ipsDataList_reducedSpacing">
					<li class="">
						<span class="ipsDataItem_generic">
							<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_account', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong><br>
							<em>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_account_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em>
						</span>
					</li>
					<li class="">
						<span class="ipsDataItem_generic">
							<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_key', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong><br>
							<code>
CONTENT;
$return .= htmlspecialchars( $secretKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</code>
						</span>
					</li>
					<li class="">
						<span class="ipsDataItem_generic">
							<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_timebased', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong><br>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'yes', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</span>
					</li>
				</ul>
			</div>
			<div class='ipsGrid_span7 ipsType_center'>
				
CONTENT;

$langCode = mb_substr( \IPS\Member::loggedIn()->language()->bcp47(), 0, 2 );
$return .= <<<CONTENT

				<a href="
CONTENT;

$return .= \IPS\Http\Url::ips( "docs/googleauth_ios" );
$return .= <<<CONTENT
" target="_blank"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "appstores/ios/{$langCode}.svg", "core", 'global', false );
$return .= <<<CONTENT
" class="ipsSpacer_both"></a>
				<a href="
CONTENT;

$return .= \IPS\Http\Url::ips( "docs/googleauth_android" );
$return .= <<<CONTENT
" target="_blank"><img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "appstores/android/{$langCode}.png", "core", 'global', false );
$return .= <<<CONTENT
" style="height: 60px"></a>
		
				<p class='ipsType_reset ipsType_center'>
					<a class="ipsCursor_pointer" data-action="showBarcode">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_help_reset', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</p>
			</div>
		</div>
	</div>

	<ul class="ipsList_reset ipsPad ipsClearfix ipsAreaBackground">
		<li class="ipsFieldRow ipsClearfix " id="google_authenticator_form_google_authenticator_setup_code">
			<div class="ipsFieldRow_content">
				<input type="text" name="google_authenticator_setup_code" value="" class="
CONTENT;

if ( \IPS\Request::i()->google_authenticator_setup_code ):
$return .= <<<CONTENT
ipsField_error
CONTENT;

endif;
$return .= <<<CONTENT
">
				
CONTENT;

if ( \IPS\Request::i()->google_authenticator_setup_code ):
$return .= <<<CONTENT

					<p class="ipsType_warning">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_mfa_invalid_code', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</li>
		<li>
			<button type='submit' class='ipsButton ipsButton_primary ipsButton_fullWidth ipsButton_medium'>
				<i class='fa fa-lock'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'google_submit_code', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</button>
		</li>
	</ul>
</div>
CONTENT;

		return $return;
}

	function linkedin( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_fullWidth ipsSocial ipsSocial_linkedIn'>
	<span class='ipsSocial_icon'><i class='fa fa-linkedin'></i></span>
	<span class='ipsSocial_text'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login_linkedin', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
</a>
CONTENT;

		return $return;
}

	function live( $url ) {
		$return = '';
		$return .= <<<CONTENT


<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_fullWidth ipsSocial ipsSocial_microsoft'>
	<span class='ipsSocial_icon'><i class='fa fa-windows'></i></span>
	<span class='ipsSocial_text'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login_live', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
</a>
CONTENT;

		return $return;
}

	function mfaAuthenticate( $screen, $url ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elTwoFactorAuthentication' class='ipsModal' data-controller='core.global.core.2fa'>
	<div>
		<h1 class='ipsType_center ipsType_pageTitle ipsSpacer_top'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_popup_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
		<form action="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" accept-charset='utf-8' data-ipsForm class="ipsForm ipsForm_fullWidth">
			<input type="hidden" name="mfa_auth" value="1">
			{$screen}
			<div class="ipsAreaBackground ipsType_center">
				<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( '_mfa' => 'alt', '_mfaMethod' => '' ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_link ipsButton_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_try_another_method', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-angle-right'></i></a>
			</div>
		</form>
	</div>
</div>
CONTENT;

		return $return;
}

	function mfaLockout( $lockEndTime=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elTwoFactorAuthentication' class='ipsModal' data-controller='core.global.core.2fa'>
	<div>
		
CONTENT;

if ( \IPS\Settings::i()->mfa_lockout_behaviour == 'lock' ):
$return .= <<<CONTENT

			<div class="ipsPad ipsType_normal ipsType_richText ipsType_center">
				
CONTENT;

$sprintf = array($lockEndTime); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_locked_out_end_time', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

			</div>
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class="ipsPad ipsType_normal ipsType_richText ipsType_center">
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_locked_out', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</div>			
			
CONTENT;

if ( \IPS\Settings::i()->mfa_lockout_behaviour == 'email' ):
$return .= <<<CONTENT

				<div class="ipsAreaBackground ipsPad">
					<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=mfarecovery", "front", "mfarecovery", array(), 0 ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_primary ipsButton_fullWidth ipsButton_medium">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_recovery_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</div>
			
CONTENT;

elseif ( \IPS\Settings::i()->mfa_lockout_behaviour == 'contact' ):
$return .= <<<CONTENT

				<div class="ipsAreaBackground ipsPad">
					<a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=contact&controller=contact", "front", "contact", array(), 0 ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_primary ipsButton_fullWidth ipsButton_medium">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_recovery_contact', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function mfaRecovery( $handlers, $url ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elTwoFactorAuthentication' class='ipsModal' data-controller='core.global.core.2fa'>
	<div>
		<h1 class='ipsType_center ipsType_pageTitle ipsSpacer_top'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_popup_recover_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
		<p class='ipsType_medium ipsType_richText ipsType_center c2FA_info'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_popup_recover_info', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
		<div class="ipsPad">
			<ul class="ipsList_reset">
				
CONTENT;

foreach ( $handlers as $key => $handler ):
$return .= <<<CONTENT

					<li class="ipsSpacer_bottom ipsSpacer_half">
						<a href="
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( '_mfa' => 'alt', '_mfaMethod' => $key ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_primary ipsButton_fullWidth ipsButton_medium">
CONTENT;

$val = "mfa_recovery_{$key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

if ( in_array( 'email', explode( ',', \IPS\Settings::i()->mfa_forgot_behaviour ) ) ):
$return .= <<<CONTENT

					<li class="ipsSpacer_bottom ipsSpacer_half"><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=mfarecovery", "front", "mfarecovery", array(), 0 ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_light ipsButton_fullWidth ipsButton_medium">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_recovery_email', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( in_array( 'contact', explode( ',', \IPS\Settings::i()->mfa_forgot_behaviour ) ) and \IPS\core\modules\front\contact\contact::canUseContactUs() ):
$return .= <<<CONTENT

					<li class="ipsSpacer_bottom ipsSpacer_half"><a href="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=contact&controller=contact", "front", "contact", array(), 0 ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_light ipsButton_fullWidth ipsButton_medium">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_recovery_contact', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function mfaSetup( $acceptableHandlers, $member, $url ) {
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
			
CONTENT;

if ( count( $acceptableHandlers ) > 1 ):
$return .= <<<CONTENT

				<div class='ipsAreaBackground ipsType_center'>
					<div class='ipsPad'>
						<h1 class='ipsType_center ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_popup_setup_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
						<p class='ipsSpacer_top ipsSpacer_half ipsPos_center ipsType_medium ipsType_richText c2FA_info'>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_setup_multiple', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</p>
					</div>
					<div class='ipsTabs ipsTabs_small ipsTabs_stretch ipsClearfix ipsJS_show' id='tabs_2fa' data-ipsTabBar data-ipsTabBar-contentArea='#ipsTabs_content_2fa'>
						<a href='#tabs_2fa' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
						<ul role='tablist'>
							
CONTENT;

$checked = NULL;
$return .= <<<CONTENT

							
CONTENT;

foreach ( $acceptableHandlers as $key => $handler ):
$return .= <<<CONTENT

								<li>
									<a href='#ipsTabs_tabs_2fa_2fa_tab_
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' id='2fa_tab_
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsTabs_item 
CONTENT;

if ( !$checked ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

$checked = $key;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" role="tab">
										<input class='ipsJS_hide' type="radio" name="mfa_method" value="
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id="el2FARadio_
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $checked == $key ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
										
CONTENT;

$val = "mfa_{$key}_title"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

									</a>
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT
						
						</ul>
					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div id='ipsTabs_content_2fa' class='ipsTabs_panels'>
				
CONTENT;

foreach ( $acceptableHandlers as $key => $handler ):
$return .= <<<CONTENT

					<div id='ipsTabs_tabs_2fa_2fa_tab_
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class="ipsTabs_panel" aria-labelledby="2fa_tab_
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
						{$handler->configurationScreen( $member, ( count( $acceptableHandlers ) > 1 ) )}
					</div>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</div>

			
CONTENT;

if ( \IPS\Settings::i()->mfa_required_groups != '*' and !\IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Settings::i()->mfa_required_groups ) ) ):
$return .= <<<CONTENT

				<div class="ipsAreaBackground ipsType_center">
					<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( '_mfa', 'optout' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_link ipsButton_medium' data-confirm 
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists('security_questions_opt_out_warning_value') ):
$return .= <<<CONTENT
data-confirmSubMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'security_questions_opt_out_warning_value', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_opt_out', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</form>
	</div>
</div>
CONTENT;

		return $return;
}

	function securityQuestionsAuth( $question ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad ipsType_normal ipsType_richText ipsType_center">
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'security_questions_auth_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>
<ul class="ipsList_reset ipsPad ipsClearfix">
	<li class="ipsFieldRow ipsClearfix">
		<label class='ipsFieldRow_label'>
			
CONTENT;
$return .= htmlspecialchars( $question->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

		</label>
		<div class="ipsFieldRow_content">
			<input type="text" name="security_answer" 
CONTENT;

if ( \IPS\Request::i()->security_answer ):
$return .= <<<CONTENT
class="ipsField_error"
CONTENT;

endif;
$return .= <<<CONTENT
>
			
CONTENT;

if ( \IPS\Request::i()->security_answer ):
$return .= <<<CONTENT

				<p class="ipsType_warning">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'security_answer_incorrect', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</li>
</ul>
<ul class="ipsList_reset ipsPad ipsClearfix ipsAreaBackground">
	<li>
		<button type='submit' class='ipsButton ipsButton_primary ipsButton_fullWidth ipsButton_medium'>
			<i class='fa fa-lock'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'security_answer_submit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</button>
	</li>
</ul>

CONTENT;

		return $return;
}

	function securityQuestionsSetup( $securityQuestions, $showingMultipleForms ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !$showingMultipleForms ):
$return .= <<<CONTENT

	<div class='ipsPad'>
		<h1 class='ipsType_center ipsType_pageTitle ipsSpacer_bottom ipsSpacer_half'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_popup_setup_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
		<div class="ipsType_normal ipsType_richText ipsType_center">
			
CONTENT;

$pluralize = array( \IPS\Settings::i()->security_questions_number ?: 3 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'security_questions_setup_blurb', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

<ul class="ipsList_reset ipsPad ipsClearfix">
	
CONTENT;

foreach ( range( 1, min( \IPS\Settings::i()->security_questions_number ?: 3, count( $securityQuestions ) ) ) as $i ):
$return .= <<<CONTENT

		<li class="ipsFieldRow ipsClearfix">
			<div class="ipsFieldRow_content">
				<select name="security_question[
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]">
					
CONTENT;

foreach ( $securityQuestions as $k => $v ):
$return .= <<<CONTENT

						<option value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( \IPS\Request::i()->security_question[$i] == $k ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</select>
			</div>
		</li>
		<li class="ipsFieldRow ipsClearfix">
			<div class="ipsFieldRow_content">
				<input type="text" name="security_answer[
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="
CONTENT;

if ( isset( \IPS\Request::i()->security_answer[$i] ) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->security_answer[$i], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
			</div>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>

CONTENT;

if ( \IPS\Request::i()->security_question ):
$return .= <<<CONTENT

	<div class="ipsPad ipsType_warning">
CONTENT;

$pluralize = array( \IPS\Settings::i()->security_questions_number ?: 3 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'security_questions_unique', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</div>

CONTENT;

endif;
$return .= <<<CONTENT

<ul class="ipsList_reset ipsPad ipsClearfix ipsAreaBackground">
	<li>
		<button type='submit' class='ipsButton ipsButton_primary ipsButton_fullWidth ipsButton_medium'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'security_questions_save', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</button>
	</li>
</ul>

CONTENT;

		return $return;
}

	function twitter( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href='
CONTENT;

$return .= htmlspecialchars( str_replace( '&', '&amp;', $url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_fullWidth ipsSocial ipsSocial_twitter'>
	<span class='ipsSocial_icon'><i class='fa fa-twitter'></i></span>
	<span class='ipsSocial_text'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login_twitter', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
</a>
CONTENT;

		return $return;
}}