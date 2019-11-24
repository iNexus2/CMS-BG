<?php
namespace IPS\Theme\Cache;
class class_core_global_forms extends \IPS\Theme\Template
{
	public $cache_key = 'ad19c80bb6cea0d40015fa79985f2872';
	function address( $name, $value, $googleApiKey, $minimize=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<ul class="ipsField_fieldList" data-ipsAddressForm 
CONTENT;

if ( $googleApiKey ):
$return .= <<<CONTENT
data-ipsAddressForm-googlePlaces data-ipsAddressForm-googleApiKey="
CONTENT;
$return .= htmlspecialchars( $googleApiKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $minimize ):
$return .= <<<CONTENT
data-ipsAddressForm-minimize
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $value->country AND !$value->city AND !$value->region AND !$value->postalCode ):
$return .= <<<CONTENT
 data-ipsAddressForm-country="
CONTENT;
$return .= htmlspecialchars( $value->country, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
	<li>
		<select name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[country]" data-role="countrySelect" data-sort>
			<option value='' 
CONTENT;

if ( !$value->country OR (!$value->city AND !$value->region AND !$value->postalCode) ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'country', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
			
CONTENT;

foreach ( \IPS\GeoLocation::$countries as $k ):
$return .= <<<CONTENT

				<option value="$k" 
CONTENT;

if ( $k == $value->country AND ( ( $value->city AND ( $value->postalCode OR $value->region ) ) OR !$minimize ) ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

$val = "country-{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</option>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</select>
	</li>
	
CONTENT;

foreach ( $value->addressLines as $i => $line ):
$return .= <<<CONTENT

		<li>
			<input type="text" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[address][]" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'address_line', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $line, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="addressLine">
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<li>
		<input type="text" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[city]" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'city', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $value->city, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="city">
	</li>
	<li>
		<input type="text" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[region]" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'region', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $value->region, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="regionText">
	</li>
	<li>
		<input type="text" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[postalCode]" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'zip', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $value->postalCode, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="postalCode">
	</li>
</ul>
CONTENT;

		return $return;
}

	function autocomplete( $name, $value='', $required, $maxlength=NULL, $disabled=FALSE, $class='', $placeholder='', $nullLang=NULL, $autoComplete=NULL ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$valueAsArray = is_array( $value ) ? $value : explode( ',', $value );
$return .= <<<CONTENT


CONTENT;

$valueToDisplay = is_array( $value ) ? implode( "\n", $value ) : $value;
$return .= <<<CONTENT



CONTENT;

if ( ( !isset( $autoComplete['commaTrigger'] ) || $autoComplete['commaTrigger'] !== FALSE ) ):
$return .= <<<CONTENT

	
CONTENT;

// If the stored value has commas in it, we need to explode then implode to get the newlines
$return .= <<<CONTENT

	
CONTENT;

if ( mb_stripos( $valueToDisplay, ',') !== FALSE ):
$return .= <<<CONTENT

		
CONTENT;

$valueToDisplay = implode("\n", explode(",", $valueToDisplay));
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT
	

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( ( isset( $autoComplete['freeChoice'] ) && !$autoComplete['freeChoice'] ) || ( isset( $autoComplete['prefix'] ) and $autoComplete['prefix'] )  ):
$return .= <<<CONTENT

<div 
CONTENT;

if ( isset( $autoComplete['freeChoice'] ) && !$autoComplete['freeChoice'] ):
$return .= <<<CONTENT
class="ipsJS_show"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $autoComplete['prefix'] ) and $autoComplete['prefix'] ):
$return .= <<<CONTENT
data-controller='core.global.core.prefixedAutocomplete'
CONTENT;

endif;
$return .= <<<CONTENT
>

CONTENT;

endif;
$return .= <<<CONTENT

<textarea
	name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	id='elInput_
CONTENT;

$return .= htmlspecialchars( preg_replace('/[^a-zA-Z0-9\-_]/', '_', $name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
	class="
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

if ( $maxlength !== NULL ):
$return .= <<<CONTENT
maxlength="
CONTENT;
$return .= htmlspecialchars( $maxlength, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $required === TRUE ):
$return .= <<<CONTENT
aria-required='true'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $placeholder ):
$return .= <<<CONTENT
placeholder="
CONTENT;
$return .= htmlspecialchars( $placeholder, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	data-ipsAutocomplete
	
CONTENT;

if ( isset( $autoComplete['freeChoice'] ) && !$autoComplete['freeChoice'] ):
$return .= <<<CONTENT
data-ipsAutocomplete-freeChoice='false'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( isset( $autoComplete['forceLower'] ) && $autoComplete['forceLower'] ):
$return .= <<<CONTENT
data-ipsAutocomplete-forceLower
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( isset( $autoComplete['maxItems'] ) ):
$return .= <<<CONTENT
data-ipsAutocomplete-maxItems='
CONTENT;
$return .= htmlspecialchars( $autoComplete['maxItems'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( !empty($autoComplete['unique']) ):
$return .= <<<CONTENT

		data-ipsAutocomplete-unique
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( isset($autoComplete['source']) AND is_array( $autoComplete['source'] ) ):
$return .= <<<CONTENT

		list='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_datalist'
	
CONTENT;

elseif ( !empty($autoComplete['source']) ):
$return .= <<<CONTENT

		data-ipsAutocomplete-dataSource="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "{$autoComplete['source']}", null, "", array(), 0 ) );
$return .= <<<CONTENT
"
		data-ipsAutocomplete-queryParam='input'
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( !empty($autoComplete['resultItemTemplate']) ):
$return .= <<<CONTENT

		data-ipsAutocomplete-resultItemTemplate="
CONTENT;
$return .= htmlspecialchars( $autoComplete['resultItemTemplate'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( isset( $autoComplete['minLength'] ) ):
$return .= <<<CONTENT
data-ipsAutocomplete-minLength='
CONTENT;
$return .= htmlspecialchars( $autoComplete['minLength'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( isset( $autoComplete['maxLength'] ) ):
$return .= <<<CONTENT
data-ipsAutocomplete-maxLength='
CONTENT;
$return .= htmlspecialchars( $autoComplete['maxLength'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( isset( $autoComplete['minAjaxLength'] ) ):
$return .= <<<CONTENT
data-ipsAutocomplete-minAjaxLength='
CONTENT;
$return .= htmlspecialchars( $autoComplete['minAjaxLength'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( isset( $autoComplete['disallowedCharacters'] ) ):
$return .= <<<CONTENT
data-ipsAutocomplete-disallowedCharacters='
CONTENT;

$return .= htmlspecialchars( json_encode( $autoComplete['disallowedCharacters'] ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( isset( $autoComplete['commaTrigger'] ) && $autoComplete['commaTrigger'] === FALSE ):
$return .= <<<CONTENT
data-ipsAutocomplete-commaTrigger='false'
CONTENT;

endif;
$return .= <<<CONTENT

>
CONTENT;
$return .= htmlspecialchars( $valueToDisplay, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</textarea>


CONTENT;

if ( isset( $autoComplete['prefix'] ) and $autoComplete['prefix'] ):
$return .= <<<CONTENT

	<div data-role='prefixRow' class='ipsHide' id='
CONTENT;

if ( ! empty($htmlId) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
_prefixWrap'>
		<input type='checkbox' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_freechoice_prefix' 
CONTENT;

if ( isset($valueAsArray['prefix']) ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 class='ipsJS_hide'> <button type='button' id='
CONTENT;

if ( ! empty($htmlId) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
_prefix' data-role="prefixButton" data-ipsMenu data-ipsMenu-selectable="radio" data-ipsMenu-appendTo="
CONTENT;

if ( ! empty($htmlId) ):
$return .= <<<CONTENT
#
CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
#
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
_prefixWrap" class='ipsButton ipsButton_light ipsButton_verySmall'><span>
CONTENT;

if ( isset($valueAsArray['prefix']) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $valueAsArray['prefix'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_prefix', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span> <i class='fa fa-caret-down'></i></button>
		<input type='hidden' data-role='prefixValue' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_prefix' value='
CONTENT;

if ( isset($valueAsArray['prefix']) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $valueAsArray['prefix'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
		<ul id='
CONTENT;

if ( ! empty($htmlId) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
_prefix_menu' data-role="prefixMenu" class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide'>
			<li data-ipsMenuValue='-' class='ipsMenu_item ipsMenu_itemChecked'>
				<a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_prefix', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			<li class='ipsMenu_sep'>
				<hr>
			</li>
		</ul>
	</div>
	<noscript>
		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_first_as_prefix" value="0">
		
CONTENT;

$valueKeys = is_array( $value ) ? array_keys( $value ) : array_keys( explode( ',', $value ) );
$return .= <<<CONTENT

		<input type="checkbox" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_first_as_prefix" value="1" id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_first_as_prefix" 
CONTENT;

if ( array_shift( $valueKeys ) === 'prefix' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
> <label for="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_first_as_prefix">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'use_first_tag_as_prefix', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
	</noscript>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( ( isset( $autoComplete['freeChoice'] ) && !$autoComplete['freeChoice'] ) || ( isset( $autoComplete['prefix'] ) and $autoComplete['prefix'] )  ):
$return .= <<<CONTENT

</div>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( isset( $autoComplete['desc'] ) ):
$return .= <<<CONTENT

	<span class='ipsFieldRow_desc'>
		{$autoComplete['desc']}
	</span>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( $nullLang ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
	<span class='ipsCustomInput'>
		<input type="checkbox" role='checkbox' data-control="unlimited" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null" id="
CONTENT;

$return .= htmlspecialchars( preg_replace('/[^a-zA-Z0-9\-_]/', '_', $name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null" value="1" 
CONTENT;

if ( $value === NULL ):
$return .= <<<CONTENT
checked aria-checked='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
 aria-controls='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' aria-labelledby='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null_label'>
		<span></span>
	</span> <label for='
CONTENT;

$return .= htmlspecialchars( preg_replace('/[^a-zA-Z0-9\-_]/', '_', $name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null' id='
CONTENT;

$return .= htmlspecialchars( preg_replace('/[^a-zA-Z0-9\-_]/', '_', $name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null_label' class='ipsField_unlimited'>
CONTENT;

$val = "{$nullLang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( isset($autoComplete['source']) AND is_array( $autoComplete['source'] ) ):
$return .= <<<CONTENT

	<datalist id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_datalist">
		
CONTENT;

foreach ( $autoComplete['source'] as $v ):
$return .= <<<CONTENT

			<option value="$v">
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</datalist>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( isset( $autoComplete['freeChoice'] ) && !$autoComplete['freeChoice'] ):
$return .= <<<CONTENT

<noscript>
	<select name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_noscript[]" multiple>
		
CONTENT;

foreach ( $autoComplete['source'] as $v ):
$return .= <<<CONTENT

			<option value="$v" 
CONTENT;

if ( in_array( $v, $valueAsArray ) ):
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
	
CONTENT;

if ( isset( $autoComplete['prefix'] ) and $autoComplete['prefix'] ):
$return .= <<<CONTENT

		<br><br>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prefix_noscript', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		<select name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_noscript_prefix">
			<option value=""></option>
			
CONTENT;

foreach ( $autoComplete['source'] as $v ):
$return .= <<<CONTENT

				<option value="$v" 
CONTENT;

if ( isset( $valueAsArray['prefix'] ) and $valueAsArray['prefix'] === $v ):
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
	
CONTENT;

endif;
$return .= <<<CONTENT

</noscript>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function button( $lang, $type, $href=NULL, $class='', $attributes=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $type === 'link' ):
$return .= <<<CONTENT

	<a href="
CONTENT;
$return .= htmlspecialchars( $href, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='
CONTENT;

if ( ! $class or ! mb_stristr( $class, 'ipsButton' ) ):
$return .= <<<CONTENT
ipsButton ipsButton_link
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $class ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $attributes ):
$return .= <<<CONTENT

CONTENT;

foreach ( $attributes as $key => $value ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 role="button">
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>

CONTENT;

else:
$return .= <<<CONTENT

	<button type="
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $class ):
$return .= <<<CONTENT
class="
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $attributes ):
$return .= <<<CONTENT

CONTENT;

foreach ( $attributes as $key => $value ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 role="button">
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function checkbox( $name, $value=FALSE, $disabled=FALSE, $togglesOn=array(), $togglesOff=array(), $label='', $hiddenName='', $id=NULL, $fancyToggle=FALSE, $tooltip=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $hiddenName, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="0">

CONTENT;

if ( !$fancyToggle ):
$return .= <<<CONTENT
<span class='ipsCustomInput'>
CONTENT;

endif;
$return .= <<<CONTENT

	<input
		type='checkbox'
		role='checkbox'
		name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
		value='1'
		id="check_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		data-toggle-id="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		
CONTENT;

if ( $value ):
$return .= <<<CONTENT
checked aria-checked='true'
CONTENT;

else:
$return .= <<<CONTENT
aria-checked='false'
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( !empty($togglesOn) OR !empty($togglesOff) ):
$return .= <<<CONTENT

			data-control="toggle"
			
CONTENT;

if ( $fancyToggle ):
$return .= <<<CONTENT

				data-toggle-visibleCheck="#check_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrapper"
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( !empty($togglesOn) ):
$return .= <<<CONTENT
 data-togglesOn="
CONTENT;

$return .= htmlspecialchars( implode( ',', $togglesOn ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-controls="
CONTENT;

$return .= htmlspecialchars( implode( ',', $togglesOn ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( !empty($togglesOff) ):
$return .= <<<CONTENT
 data-togglesOff="
CONTENT;

$return .= htmlspecialchars( implode( ',', $togglesOff ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-controls="
CONTENT;

$return .= htmlspecialchars( implode( ',', $togglesOff ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $fancyToggle ):
$return .= <<<CONTENT

			data-ipsToggle
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $tooltip ):
$return .= <<<CONTENT
title='
CONTENT;
$return .= htmlspecialchars( $tooltip, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip
CONTENT;

endif;
$return .= <<<CONTENT

	>
	
CONTENT;

if ( !$fancyToggle ):
$return .= <<<CONTENT

	<span></span>
</span>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $label ):
$return .= <<<CONTENT

<label for="check_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

$val = "{$label}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</label>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function checkboxset( $name, $value, $required, $options, $multiple=FALSE, $class='', $disabled=FALSE, $toggles=array(), $id=NULL, $unlimited=NULL, $unlimitedLang='all', $unlimitedToggles=array(), $toggleOn=TRUE, $descriptions=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $multiple ):
$return .= <<<CONTENT

	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[__EMPTY]" value="__EMPTY">

CONTENT;

endif;
$return .= <<<CONTENT

<ul class="ipsField_fieldList">

CONTENT;

foreach ( $options as $k => $v ):
$return .= <<<CONTENT

	<li>
		<span class='ipsCustomInput'>
			<input type="checkbox" 
CONTENT;

if ( $class ):
$return .= <<<CONTENT
class="
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1" 
CONTENT;

if ( is_array( $value ) AND in_array( $k, $value ) ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled === TRUE or ( is_array( $disabled ) and in_array( $k, $disabled ) ) ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $toggles[ $k ] ) and !empty( $toggles[ $k ] ) ):
$return .= <<<CONTENT
data-control="toggle" 
CONTENT;

if ( $toggleOn === FALSE ):
$return .= <<<CONTENT
data-togglesOff
CONTENT;

else:
$return .= <<<CONTENT
data-togglesOn
CONTENT;

endif;
$return .= <<<CONTENT
="
CONTENT;

$return .= htmlspecialchars( implode( ',', $toggles[ $k ] ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 id="elCheckbox_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			<span></span>
		</span>
		<div class='ipsField_fieldList_content'>
			<label for='elCheckbox_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label'>{$v}</label>
			
CONTENT;

if ( isset( $descriptions[ $k ] ) ):
$return .= <<<CONTENT

				<br>
				<span class='ipsFieldRow_desc'>
					{$descriptions[ $k ]}
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
CONTENT;

		return $return;
}

	function codemirror( $name, $value='', $required, $maxlength=NULL, $disabled=FALSE, $class='', $placeholder='', $tags=array(), $mode='htmlmixed', $id=NULL, $height='300px' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !empty( $tags ) ):
$return .= <<<CONTENT

<div class='ipsColumns ipsColumns_collapseTablet' data-controller='core.global.editor.customtags' data-tagFieldType='codemirror' data-tagFieldID='elCodemirror_
CONTENT;

if ( $id ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
	<div class='ipsColumn_fluid ipsColumn'>

CONTENT;

endif;
$return .= <<<CONTENT

<div class='ipsAreaBackground ipsPad_half' data-role="editor">
	<textarea
	name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	id='elCodemirror_
CONTENT;

if ( $id ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'
	value="
CONTENT;

$return .= htmlspecialchars( htmlentities( $value, \IPS\HTMLENTITIES, 'UTF-8', TRUE ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	class="ipsField_fullWidth 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

if ( $maxlength !== NULL ):
$return .= <<<CONTENT
maxlength="
CONTENT;
$return .= htmlspecialchars( $maxlength, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $required === TRUE ):
$return .= <<<CONTENT
aria-required='true'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $placeholder ):
$return .= <<<CONTENT
placeholder="
CONTENT;
$return .= htmlspecialchars( $placeholder, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	data-control="codemirror"
	data-mode="
CONTENT;
$return .= htmlspecialchars( $mode, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

if ( $height ):
$return .= <<<CONTENT
data-height="
CONTENT;
$return .= htmlspecialchars( $height, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

>
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</textarea>
</div>

CONTENT;

if ( !empty( $tags ) ):
$return .= <<<CONTENT

	</div>
	<div class='ipsColumn_medium ipsColumn ipsAreaBackground_light ipsComposeArea_sidebar 
CONTENT;

if ( !isset( \IPS\Request::i()->cookie['tagSidebar'] ) ):
$return .= <<<CONTENT
ipsComposeArea_sidebarOpen
CONTENT;

else:
$return .= <<<CONTENT
ipsComposeArea_sidebarClosed
CONTENT;

endif;
$return .= <<<CONTENT
' data-codemirrorid='elCodemirror_
CONTENT;

if ( $id ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
		<a href='#' data-action='tagsToggle' data-ipsTooltip data-ipsTooltip-label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'toggle_sidebar', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'toggle_sidebar', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		<h3 class='ipsAreaBackground ipsPad_half ipsType_reset' data-role='tagsHeader'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_tags', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
		<ul class='ipsList_reset ipsScrollbar' data-role='tagsList'>
		
CONTENT;

foreach ( $tags as $tagKey => $tagValue ):
$return .= <<<CONTENT

			
CONTENT;

if ( is_array( $tagValue ) ):
$return .= <<<CONTENT

				<li>
					<ul class='ipsList_reset'>
						<li><h4 class='ipsAreaBackground ipsPad_half ipsType_reset'>
CONTENT;

$val = "{$tagKey}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4></li>
						<li>
							<ul class='ipsList_reset'>
							
CONTENT;

foreach ( $tagValue as $key => $value ):
$return .= <<<CONTENT

								<li class='ipsPad_half'>
									<label data-tagKey="
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</label>
									<div class='ipsType_light ipsType_small'>
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

							</ul>
						</li>
					</ul>
				</li>
			
CONTENT;

else:
$return .= <<<CONTENT

				<li class='ipsPad_half'>
					<label data-tagKey="
CONTENT;
$return .= htmlspecialchars( $tagKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $tagKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</label>
					<div class='ipsType_light ipsType_small'>
CONTENT;
$return .= htmlspecialchars( $tagValue, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function color( $name, $value, $required, $disabled=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<input type="text" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"	
CONTENT;

if ( $required === TRUE ):
$return .= <<<CONTENT
aria-required='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT
 data-control="color" class="">
CONTENT;

		return $return;
}

	function colorDisplay( $color ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsClearFix">
	<div style="background-color: 
CONTENT;
$return .= htmlspecialchars( $color, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
; height: 15px; width: 15px; border: 1px solid black;" class="ipsPos_left"></div><div class="ipsPos_left"> &nbsp; 
CONTENT;

$return .= htmlspecialchars( mb_strtoupper( $color ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
</div>
CONTENT;

		return $return;
}

	function date( $name, $value, $required, $min=NULL, $max=NULL, $disabled=FALSE, $time=FALSE, $unlimited=NULL, $unlimitedLang=NULL, $unlimitedName=NULL, $toggles=array(), $toggleOn=TRUE, $class='ipsField_short', $placeholder=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<input
	type="date"
	name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

if ( $unlimited === NULL or $value !== $unlimited ):
$return .= <<<CONTENT
value="
CONTENT;

if ( $value instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $value->format('Y-m-d'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" data-preferredFormat="
CONTENT;

if ( $value instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $value->localeDate(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $required === TRUE ):
$return .= <<<CONTENT
aria-required='true'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $min !== NULL ):
$return .= <<<CONTENT
min="
CONTENT;
$return .= htmlspecialchars( $min, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $max !== NULL ):
$return .= <<<CONTENT
max="
CONTENT;
$return .= htmlspecialchars( $max, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT

	class="
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	data-control="date"
	placeholder='
CONTENT;

if ( $placeholder !== NULL ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $placeholder, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( str_replace( array( 'YYYY', 'MM', 'DD' ), array( \IPS\Member::loggedIn()->language()->addToStack('_date_format_yyyy'), \IPS\Member::loggedIn()->language()->addToStack('_date_format_mm'), \IPS\Member::loggedIn()->language()->addToStack('_date_format_dd') ), str_replace( 'Y', 'YY', \IPS\Member::loggedIn()->language()->preferredDateFormat() ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'
>

CONTENT;

if ( $time ):
$return .= <<<CONTENT

<input name="
CONTENT;
$return .= htmlspecialchars( $time, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" type="time" size="12" class="ipsField_short" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( '_time_format_hhmm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" step='60' min='00:00' value="
CONTENT;

if ( $value instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $value->format('H:i'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" 
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT
>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $unlimited !== NULL and ( !$disabled or $unlimited === $value ) ):
$return .= <<<CONTENT

	&nbsp;
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	&nbsp;
	<span class='ipsCustomInput'>
		<input type="checkbox" role='checkbox' data-control="unlimited
CONTENT;

if ( count( $toggles ) ):
$return .= <<<CONTENT
 toggle
CONTENT;

endif;
$return .= <<<CONTENT
" name="
CONTENT;
$return .= htmlspecialchars( $unlimitedName, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='
CONTENT;
$return .= htmlspecialchars( $unlimitedName, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' value="
CONTENT;
$return .= htmlspecialchars( $unlimited, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $unlimited === $value ):
$return .= <<<CONTENT
checked aria-checked='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( count( $toggles ) ):
$return .= <<<CONTENT

CONTENT;

if ( $toggleOn === FALSE ):
$return .= <<<CONTENT
data-togglesOff
CONTENT;

else:
$return .= <<<CONTENT
data-togglesOn
CONTENT;

endif;
$return .= <<<CONTENT
="
CONTENT;

$return .= htmlspecialchars( implode( ',', $toggles ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 aria-labelledby='label_
CONTENT;
$return .= htmlspecialchars( $unlimitedName, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<span></span>
	</span>
	<label for='
CONTENT;
$return .= htmlspecialchars( $unlimitedName, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='label_
CONTENT;
$return .= htmlspecialchars( $unlimitedName, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsField_unlimited'>
CONTENT;

$val = "{$unlimitedLang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function dateRange( $start, $end ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'between', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 {$start} 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 {$end}
CONTENT;

		return $return;
}

	function editor( $name, $value, $options, $toolbars, $postKey, $uploadControl, $emoticons, $tags=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !empty( $tags ) ):
$return .= <<<CONTENT

<div class='ipsColumns ipsColumns_collapseTablet' data-controller='core.global.editor.customtags' data-tagFieldType='editor' data-tagFieldID='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<div class='ipsColumn_fluid ipsColumn'>

CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsComposeArea_editor' data-role="editor">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->editorRaw( $name, $value, $options, $toolbars, $postKey, $uploadControl, $emoticons );
$return .= <<<CONTENT

		</div>

CONTENT;

if ( !empty( $tags ) ):
$return .= <<<CONTENT

	</div>
	<div class='ipsColumn_medium ipsColumn ipsAreaBackground_light ipsComposeArea_sidebar 
CONTENT;

if ( !isset( \IPS\Request::i()->cookie['tagSidebar'] ) ):
$return .= <<<CONTENT
ipsComposeArea_sidebarOpen
CONTENT;

else:
$return .= <<<CONTENT
ipsComposeArea_sidebarClosed
CONTENT;

endif;
$return .= <<<CONTENT
'>
		<a href='#' class="ipsJS_show" data-action='tagsToggle' data-ipsTooltip data-ipsTooltip-label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'toggle_sidebar', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'toggle_sidebar', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		<h3 class='ipsAreaBackground ipsPad_half ipsType_reset' data-role='tagsHeader'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_tags', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
		<ul class='ipsList_reset ipsScrollbar' data-role='tagsList'>
		
CONTENT;

foreach ( $tags as $tagKey => $tagValue  ):
$return .= <<<CONTENT

			<li class='ipsPad_half'>
				<label class="ipsJS_show" data-tagKey="
CONTENT;
$return .= htmlspecialchars( $tagKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $tagKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</label>
				<div class='ipsJS_hide ipsType_light'><strong>
CONTENT;
$return .= htmlspecialchars( $tagKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></div>
				<div class='ipsType_light '>
CONTENT;
$return .= htmlspecialchars( $tagValue, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
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

CONTENT;

		return $return;
}

	function editorAttachments( $name, $value, $minimize, $maxFileSize, $maxFiles, $maxChunkSize, $totalMaxSize, $allowedFileTypes, $pluploadKey, $multiple=FALSE, $editor=FALSE, $forceNoscript=FALSE, $template='core.attachments.fileItem', $existing=array(), $default=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<input name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" type="hidden" value="
CONTENT;
$return .= htmlspecialchars( $pluploadKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

CONTENT;

if ( $forceNoscript ):
$return .= <<<CONTENT

	<input name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_noscript[]" type="file" 
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT
multiple
CONTENT;

endif;
$return .= <<<CONTENT
>

CONTENT;

else:
$return .= <<<CONTENT

	<noscript>
		<input name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_noscript[]" type="file" 
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT
multiple
CONTENT;

endif;
$return .= <<<CONTENT
>
		<span class="ipsType_light ipsType_small">
			
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

				<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_accepted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
CONTENT;

$return .= htmlspecialchars( implode( ', ', $allowedFileTypes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $multiple and $totalMaxSize ):
$return .= <<<CONTENT

				
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

					&middot;
				
CONTENT;

endif;
$return .= <<<CONTENT

				<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_total_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
CONTENT;
$return .= htmlspecialchars( $totalMaxSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !$multiple or !$totalMaxSize or $maxChunkSize < $totalMaxSize ):
$return .= <<<CONTENT

				
CONTENT;

if ( $allowedFileTypes !== NULL or ( $multiple and $totalMaxSize ) ):
$return .= <<<CONTENT

					&middot;
				
CONTENT;

endif;
$return .= <<<CONTENT

				<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
CONTENT;
$return .= htmlspecialchars( $maxChunkSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $maxFiles ):
$return .= <<<CONTENT

				<br>
CONTENT;

$pluralize = array( $maxFiles ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</span>
	</noscript>
	
CONTENT;

if ( $value ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $value as $id => $file ):
$return .= <<<CONTENT

			<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_existing[
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="">
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	<div data-ipsEditor-toolList>
		
CONTENT;

$editorName = preg_replace( "/(.+?)_(\d+?)_$/", "$1[$2]", mb_substr( $name, 0, -7 ) );
$return .= <<<CONTENT

		<div data-role='attachmentArea' data-controller='core.global.editor.uploader, core.global.editor.insertable' data-editorID='
CONTENT;
$return .= htmlspecialchars( $editorName, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComposeArea_attachments ipsClearfix ipsAreaBackground_light' id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_drop_
CONTENT;

$return .= htmlspecialchars( md5( uniqid() ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsUploader data-ipsUploader-dropTarget='#elEditorDrop_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsUploader-button='[data-action="browse"]' 
CONTENT;

if ( $maxFileSize ):
$return .= <<<CONTENT
data-ipsUploader-maxFileSize="
CONTENT;
$return .= htmlspecialchars( $maxFileSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsUploader-maxChunkSize="
CONTENT;
$return .= htmlspecialchars( $maxChunkSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $allowedFileTypes ):
$return .= <<<CONTENT
data-ipsUploader-allowedFileTypes='
CONTENT;

$return .= htmlspecialchars( json_encode( $allowedFileTypes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsUploader-name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsUploader-key="
CONTENT;
$return .= htmlspecialchars( $pluploadKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT
data-ipsUploader-multiple 
CONTENT;

if ( $totalMaxSize ):
$return .= <<<CONTENT
data-ipsUploader-maxTotalSize="
CONTENT;
$return .= htmlspecialchars( $totalMaxSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $minimize ):
$return .= <<<CONTENT
data-ipsUploader-minimized
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsUploader-insertable data-ipsUploader-postkey="
CONTENT;
$return .= htmlspecialchars( $editor, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsUploader-template='core.editor.attachments' 
CONTENT;

if ( $value ):
$return .= <<<CONTENT
data-ipsUploader-existingFiles='
CONTENT;

$return .= htmlspecialchars( json_encode( $existing ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $default ) ):
$return .= <<<CONTENT
data-ipsUploader-default='
CONTENT;
$return .= htmlspecialchars( $default, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
			<div class="ipsComposeArea_dropZone 
CONTENT;

if ( $minimize ):
$return .= <<<CONTENT
ipsComposeArea_dropZoneSmall
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix" id='elEditorDrop_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				<i class='fa fa-paperclip'></i>
				<div>
					<ul class='ipsList_inline ipsClearfix'>
						<li class='ipsType_normal'>
							<span class='ipsAttachment_supportDrag'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_attach_drag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
							<a href='#' data-action='browse'>
								<span class='ipsAttachment_supportDrag'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_attach_choose_drag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
								<span class='ipsAttachment_nonDrag'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_attach_choose_nodrag', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
							</a>
							
CONTENT;

if ( $allowedFileTypes !== NULL || $maxFileSize || $totalMaxSize ):
$return .= <<<CONTENT

								<br>
								<span class='ipsType_medium ipsType_light'>
									
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

										<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_accepted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
										
CONTENT;

$return .= htmlspecialchars( implode( ', ', $allowedFileTypes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $multiple and $totalMaxSize ):
$return .= <<<CONTENT

										
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

											&middot;
										
CONTENT;

endif;
$return .= <<<CONTENT

										<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_total_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
										
CONTENT;
$return .= htmlspecialchars( $totalMaxSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $maxFileSize and ( !$multiple or !$totalMaxSize or $maxFileSize < $totalMaxSize ) ):
$return .= <<<CONTENT

										
CONTENT;

if ( $allowedFileTypes !== NULL or ( $multiple and $totalMaxSize ) ):
$return .= <<<CONTENT

											&middot;
										
CONTENT;

endif;
$return .= <<<CONTENT

										<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
										
CONTENT;

$return .= htmlspecialchars( round($maxFileSize,2), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $maxFiles ):
$return .= <<<CONTENT

										<br>
CONTENT;

$pluralize = array( $maxFiles ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

								</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</li>
						<li class='ipsPos_right ipsResponsive_noFloat'>
							<a href='#' class='ipsButton ipsButton_light ipsButton_verySmall' data-ipsMenu id='elEditorAttach_media
CONTENT;

$return .= htmlspecialchars( md5($editorName), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_attach_other', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
							<ul class='ipsMenu ipsMenu_auto ipsHide' id='elEditorAttach_media
CONTENT;

$return .= htmlspecialchars( md5($editorName), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
								<li class='ipsMenu_item'><a href='#' data-ipsDialog data-ipsDialog-fixed data-ipsDialog-forceReload data-ipsDialog-destructOnClose data-ipsDialog-remoteSubmit='false' data-ipsDialog-remoteVerify='false' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_insert_existing_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-url="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=editor&do=myMedia&postKey={$editor}&editorId={$editorName}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_insert_existing_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

if ( \IPS\Settings::i()->allow_remote_images ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='#' data-ipsDialog data-ipsDialog-forceReload data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_insert_from_url', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-url="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=editor&do=link&image=1&postKey={$editor}&editorId={$editorName}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_insert_from_url', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</ul>
						</li>
					</ul>
					<div data-role='fileList' class='ipsComposeArea_attachmentsInner 
CONTENT;

if ( count($value) == 0 ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'>
						<div data-role='files' class='ipsAreaBackground_reset ipsHide'>
							<p class='ipsType_normal ipsPad_half ipsType_reset'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_uploaded_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></p>
							<ul class='ipsList_reset ipsDataList ipsPad_half' data-role='fileContainer'>
								
CONTENT;

foreach ( $value as $attachID => $file ):
$return .= <<<CONTENT

									
CONTENT;

if ( !$file->isImage() ):
$return .= <<<CONTENT

										<li class='ipsDataItem ipsAttach ipsAttach_done ipsContained' id='elAttach_
CONTENT;
$return .= htmlspecialchars( $attachID, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='file' data-fileid='
CONTENT;
$return .= htmlspecialchars( $attachID, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
											<div class='ipsDataItem_generic ipsDataItem_size1 ipsType_center'>
												<i class='fa fa-file ipsType_large'></i>
											</div>
											<div class='ipsDataItem_main'>
												<strong class='ipsDataItem_title ipsType_medium' data-role='title'>
CONTENT;
$return .= htmlspecialchars( $file->originalFilename, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong><br><span class='ipsType_light'>
CONTENT;

$return .= \IPS\Output\Plugin\Filesize::humanReadableFilesize( $file->filesize() );
$return .= <<<CONTENT
</span>
											</div>
											<div class='ipsDataItem_generic ipsDataItem_size8 ipsType_right'>
												<ul class='ipsList_inline'>
													<li>
														<a href='#' data-action='insertFile' class='ipsAttach_selection' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'insert_into_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-plus'></i></a>
													</li>
													<li>
														<a href='#' class='ipsType_warning' data-role='deleteFile'><i class='fa fa-trash-o'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
													</li>
												</ul>
											</div>
										</li>
									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</ul>
						</div>
						<div data-role='images' class='ipsAreaBackground_reset 
CONTENT;

if ( count($value) == 0 ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<p class='ipsType_normal ipsPad_half ipsType_reset'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_uploaded_images', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></p>
							<ul class='ipsPad_half ipsList_reset ipsGrid ipsGrid_collapsePhone' data-role='fileContainer' data-ipsGrid data-ipsGrid-minItemSize='150' data-ipsGrid-maxItemSize='250'>
								
CONTENT;

foreach ( $value as $attachID => $file ):
$return .= <<<CONTENT

									
CONTENT;

if ( $file->isImage() ):
$return .= <<<CONTENT

										<li class='ipsGrid_span3 ipsAttach ipsContained ipsImageAttach ipsPad_half ipsAreaBackground_light' id='elAttach_
CONTENT;
$return .= htmlspecialchars( $attachID, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='file' data-fileid='
CONTENT;
$return .= htmlspecialchars( $attachID, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-fullsizeurl='
CONTENT;
$return .= htmlspecialchars( $file->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-thumbnailurl='
CONTENT;
$return .= htmlspecialchars( $file->attachmentThumbnailUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-isImage="1">
											<ul class='ipsList_inline ipsImageAttach_controls'>
												<li>
													<a href='#' data-action='insertFile' class='ipsAttach_selection' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'insert_into_post', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-plus'></i></a>
												</li>
												<li class='ipsPos_right' data-role='deleteFileWrapper'>
													<a href='#' data-role='deleteFile' class='ipsButton ipsButton_verySmall ipsButton_light' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-trash-o'></i></a>
												</li>
											</ul>

											<div class='ipsImageAttach_thumb ipsType_center' style='background-image: url( "
CONTENT;

$return .= htmlspecialchars( str_replace( array( '(', ')' ), array( '\(', '\)' ), $file->attachmentThumbnailUrl ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" )' data-role='preview' data-grid-ratio='65' data-action='insertFile'>
												<img src='
CONTENT;
$return .= htmlspecialchars( $file->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt=''>
											</div>
											<h2 class='ipsType_reset ipsAttach_title ipsTruncate ipsTruncate_line ipsType_medium' data-role='title'>
CONTENT;
$return .= htmlspecialchars( $file->originalFilename, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
											<p class='ipsType_light'>
CONTENT;

$return .= \IPS\Output\Plugin\Filesize::humanReadableFilesize( $file->filesize() );
$return .= <<<CONTENT
</p>
										</li>
									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</ul>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function editorAttachmentsMinimized( $name ) {
		$return = '';
		$return .= <<<CONTENT

<div data-ipsEditor-toolList data-ipsEditor-toolListMinimized data-name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsAreaBackground_light ipsClearfix ipsHide">
	<div data-role='attachmentArea'>
		<div class="ipsComposeArea_dropZone ipsComposeArea_dropZoneSmall ipsClearfix">
			<i class='fa fa-paperclip'></i>
			<div class='ipsType_light ipsType_normal'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'loading', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</div>
		</div>		
	</div>
</div>
CONTENT;

		return $return;
}

	function editorAttachmentsPlaceholder( $name, $editor ) {
		$return = '';
		$return .= <<<CONTENT

	<div data-ipsEditor-toolList class="ipsAreaBackground_light ipsClearfix">
		<div data-role='attachmentArea'>
			<div class="ipsComposeArea_dropZone ipsComposeArea_dropZoneSmall ipsClearfix ipsClearfix" id='elEditorDrop_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				<div>
					<ul class='ipsList_inline ipsClearfix'>
						<li class='ipsPos_right'>
							<a href='#' class='ipsButton ipsButton_light ipsButton_verySmall' data-ipsMenu id='elEditorAttach_media
CONTENT;

$return .= htmlspecialchars( md5($name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_attach_other', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
							<ul class='ipsMenu ipsMenu_auto ipsHide' id='elEditorAttach_media
CONTENT;

$return .= htmlspecialchars( md5($name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
								<li class='ipsMenu_item'><a href='#' data-ipsDialog data-ipsDialog-fixed data-ipsDialog-forceReload data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_insert_existing_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-url="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=editor&do=myMedia&postKey={$editor}&editorId={$name}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_insert_existing_file', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
                                
CONTENT;

if ( \IPS\Settings::i()->allow_remote_images ):
$return .= <<<CONTENT

                                    <li class='ipsMenu_item'><a href='#' data-ipsDialog data-ipsDialog-forceReload data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_insert_from_url', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-url="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "app=core&module=system&controller=editor&do=link&image=1&postKey={$editor}&editorId={$name}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_insert_from_url', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
                                
CONTENT;

endif;
$return .= <<<CONTENT

							</ul>
						</li>
					</ul>
				</div>
			</div>		
		</div>
	</div>
CONTENT;

		return $return;
}

	function editorRaw( $name, $value, $options, $toolbars, $postKey, $uploadControl, $emoticons ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsType_normal ipsType_richText ipsType_break' data-ipsEditor data-ipsEditor-controller="
CONTENT;

$return .= str_replace( '&', '&amp;', \IPS\Http\Url::internal( "{$options['controller']}", null, "", array(), 0 ) );
$return .= <<<CONTENT
" 
CONTENT;

if ( $options['minimize'] !== NULL ):
$return .= <<<CONTENT
data-ipsEditor-minimized
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $options['allButtons'] ):
$return .= <<<CONTENT
data-ipsEditor-allbuttons='true'
CONTENT;

else:
$return .= <<<CONTENT
data-ipsEditor-toolbars='
CONTENT;

$return .= htmlspecialchars( json_encode( $toolbars ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsEditor-extraPlugins='
CONTENT;

$return .= \IPS\Settings::i()->ckeditor_extraPlugins;
$return .= <<<CONTENT
' 
CONTENT;

if ( $postKey ):
$return .= <<<CONTENT
data-ipsEditor-postKey="
CONTENT;
$return .= htmlspecialchars( $postKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $options['autoSaveKey'] ):
$return .= <<<CONTENT
data-ipsEditor-autoSaveKey="
CONTENT;
$return .= htmlspecialchars( $options['autoSaveKey'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $options['defaultIfNoAutoSave'] ):
$return .= <<<CONTENT
data-ipsEditor-defaultIfNoAutoSave
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsEditor-skin="
CONTENT;

$return .= htmlspecialchars( \IPS\IN_DEV ? 'ips' : \IPS\Theme::i()->editor_skin, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsEditor-name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

if ( !$options['autoGrow'] ):
$return .= <<<CONTENT
 data-ipsEditor-autoGrow='false'
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsEditor-emoticons='
CONTENT;
$return .= htmlspecialchars( $emoticons, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsEditor-pasteBehaviour='
CONTENT;

$return .= \IPS\Settings::i()->editor_paste_behaviour;
$return .= <<<CONTENT
' 
CONTENT;

if ( !\IPS\Settings::i()->editor_embeds ):
$return .= <<<CONTENT
data-ipsEditor-autoEmbed='false'
CONTENT;

endif;
$return .= <<<CONTENT
>
	<div data-role='editorComposer' class='ipsContained'>
		<noscript>
			<textarea name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_noscript" rows="15">
CONTENT;

$return .= htmlspecialchars( \IPS\Helpers\Form\Editor::valueForNoJsFallback( $value ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</textarea>
		</noscript>
		<div 
CONTENT;

if ( $options['minimize'] ):
$return .= <<<CONTENT
class="ipsHide"
CONTENT;

endif;
$return .= <<<CONTENT
 data-role="mainEditorArea">
			<textarea name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role='contentEditor' class="ipsHide" tabindex='1'>
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', TRUE );
$return .= <<<CONTENT
</textarea>
		</div>
		
CONTENT;

if ( $options['minimize'] ):
$return .= <<<CONTENT

			<div class='ipsComposeArea_dummy ipsJS_show' tabindex='1'><i class='
CONTENT;
$return .= htmlspecialchars( $options['minimizeIcon'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i> 
CONTENT;

$val = "{$options['minimize']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsHide ipsComposeArea_editorPaste" data-role="pasteMessage">
			<p class='ipsType_reset ipsPad_half'>
				
CONTENT;

if ( \IPS\Settings::i()->editor_paste_behaviour == 'force' ):
$return .= <<<CONTENT

					<a class="ipsPos_right ipsType_normal ipsCursor_pointer ipsComposeArea_editorPasteSwitch" data-action="removePasteFormatting" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_keep_no_formatting', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>&times;</a>
					<i class="fa fa-info-circle"></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_pasted_with_formatting', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
. &nbsp;&nbsp;<a class='ipsCursor_pointer' data-action="keepPasteFormatting">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_restore_formatting', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

else:
$return .= <<<CONTENT

					<a class="ipsPos_right ipsType_normal ipsCursor_pointer ipsComposeArea_editorPasteSwitch" data-action="keepPasteFormatting" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_keep_formatting', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>&times;</a>
					<i class="fa fa-info-circle"></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_pasted_with_formatting', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
. &nbsp;&nbsp;<a class='ipsCursor_pointer' data-action="removePasteFormatting">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_remove_formatting', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
		</div>
		<div class="ipsHide ipsComposeArea_editorPaste" data-role="emoticonMessage">
			<p class='ipsType_reset ipsPad_half'>
				<i class="fa fa-info-circle"></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_too_many_emoticons', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
.
			</p>
		</div>
		<div class="ipsHide ipsComposeArea_editorPaste" data-role="embedMessage">
			<p class='ipsType_reset ipsPad_half'>
				<a class="ipsPos_right ipsType_normal ipsCursor_pointer ipsComposeArea_editorPasteSwitch" data-action="keepEmbeddedMedia" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_keep_embed', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>&times;</a>
				<i class="fa fa-info-circle"></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_pasted_embed_link', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
. &nbsp;&nbsp;<a class='ipsCursor_pointer' data-action="removeEmbeddedMedia">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_remove_embed', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</p>
		</div>
		<div class="ipsHide ipsComposeArea_editorPaste" data-role="embedFailMessage">
			<p class='ipsType_reset ipsPad_half'>
			</p>
		</div>
		<div class="ipsHide ipsComposeArea_editorPaste" data-role="autoSaveRestoreMessage">
			<p class='ipsType_reset ipsPad_half'>
				<a class="ipsPos_right ipsType_normal ipsCursor_pointer ipsComposeArea_editorPasteSwitch" data-action="keepRestoredContents" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_keep_restored_contents', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>&times;</a>
				<i class="fa fa-info-circle"></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_restored_autosave', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
. &nbsp;&nbsp;<a class='ipsCursor_pointer' data-action="clearEditorContents">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'clear_editor_contents', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</p>
		</div>
		{$uploadControl}
	</div>
	<div data-role='editorPreview' class='ipsHide'>
		<div class='ipsAreaBackground_light ipsPad_half' data-role='previewToolbar'>
			<a href='#' class='ipsPos_right' data-action='closePreview' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_close_preview', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>&times;</a>
			<ul class='ipsButton_split'>
				<li data-action='resizePreview' data-size='desktop'><a href='#' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_desktop_preview', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip class='ipsButton ipsButton_verySmall ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_desktop', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li data-action='resizePreview' data-size='tablet'><a href='#' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_tablet_preview', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip class='ipsButton ipsButton_verySmall ipsButton_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_tablet', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li data-action='resizePreview' data-size='phone'><a href='#' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_phone_preview', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip class='ipsButton ipsButton_verySmall ipsButton_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_phone', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			</ul>
		</div>
		<div data-role='previewContainer' class='ipsAreaBackground ipsType_center'></div>
	</div>
</div>
CONTENT;

		return $return;
}

	function ftp( $name, $value, $showBypassValidationCheckbox=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller="core.global.core.ftp">
	<ul class='ipsList_reset'>
		<li class='ipsFieldRow_inlineCheckbox'>
			<input type="radio" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[protocol]" value="ftp" id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_ftp" data-role="portToggle" data-port="21" 
CONTENT;

if ( !isset( $value['protocol'] ) or $value['protocol'] == 'ftp' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
> <label for='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_ftp'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'FTP', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
		</li>
		<li class='ipsFieldRow_inlineCheckbox'>
			<input type="radio" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[protocol]" value="ssl_ftp" id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_ssl_ftp" data-role="portToggle" data-port="21" 
CONTENT;

if ( isset( $value['protocol'] ) and $value['protocol'] == 'ssl_ftp' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
> <label for='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_ssl_ftp'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ftp_with_ssl', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
		</li>
		<li class='ipsFieldRow_inlineCheckbox'>
			<input type="radio" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[protocol]" value="sftp" id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_sftp" data-role="portToggle" data-port="22" 
CONTENT;

if ( isset( $value['protocol'] ) and $value['protocol'] == 'sftp' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
> <label for='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_sftp'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'SFTP', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
		</li>
	</ul>
	<br>
	<ul class='ipsField_translatable ipsList_inline ipsList_reset'>
		<li class='ipsClearfix'>
			<span class="ipsFlag fa fa-globe"></span>
			<input type='text' name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[server]" placeholder="ftp.example.com" data-role="serverInput" 
CONTENT;

if ( isset( $value['server'] ) ):
$return .= <<<CONTENT
value="
CONTENT;
$return .= htmlspecialchars( $value['server'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 class="ipsField_medium">
		</li>
		<li class='ipsClearfix'>
			<span class="ipsFlag fa fa-bolt"></span>
			<input type='text' name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[port]" data-role="portInput" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'port', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" value="
CONTENT;

if ( isset( $value['port'] ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $value['port'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
21
CONTENT;

endif;
$return .= <<<CONTENT
" class="ipsField_tiny">
		</li>
	</ul>
	<ul class='ipsField_translatable ipsList_reset'>
		<li class='ipsClearfix'>
			<span class="ipsFlag fa fa-user"></span>
			<input type='text' name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[un]" data-role="usernameInput" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ftp_username', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" 
CONTENT;

if ( isset( $value['un'] ) ):
$return .= <<<CONTENT
value="
CONTENT;
$return .= htmlspecialchars( $value['un'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
		</li>
		<li class='ipsClearfix'>
			<span class="ipsFlag fa fa-lock"></span>
			<input type='text' name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[pw]" data-role="passwordInput" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" 
CONTENT;

if ( isset( $value['pw'] ) ):
$return .= <<<CONTENT
value="
CONTENT;
$return .= htmlspecialchars( $value['pw'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
		</li>
		<li class='ipsClearfix'>
			<span class="ipsFlag fa fa-folder-o"></span>
			<input type='text' name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[path]" data-role="pathInput" placeholder="/path/" 
CONTENT;

if ( isset( $value['path'] ) ):
$return .= <<<CONTENT
value="
CONTENT;
$return .= htmlspecialchars( $value['path'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
		</li>
	</ul>
	
CONTENT;

if ( $showBypassValidationCheckbox ):
$return .= <<<CONTENT

		<ul class='ipsList_reset'>
			<li>
				<label for='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_bypassValidation'>
					<input type='checkbox' name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[bypassValidation]" value="1" id='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_bypassValidation'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ftp_bypass_validation', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</label>
			</li>
		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function ftpDisplay( $value, $url ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsClearFix">
	<ul class="ipsList ipsList_inline">
		<li>
			
CONTENT;

if ( $value['protocol'] === 'sftp' ):
$return .= <<<CONTENT

				<span class="ipsBadge ipsBadge_style1">SFTP</span>
			
CONTENT;

elseif ( $value['protocol'] === 'ssl_ftp' ):
$return .= <<<CONTENT

				<span class="ipsBadge ipsBadge_style6">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ftp_with_ssl', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<span class="ipsType_monospace">
CONTENT;
$return .= htmlspecialchars( $value['server'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $value['port'] ):
$return .= <<<CONTENT
:
CONTENT;
$return .= htmlspecialchars( $value['port'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
		</li>
		<li>
			<i class="fa fa-user"></i> <span class="ipsType_monospace">
CONTENT;
$return .= htmlspecialchars( $value['un'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
		</li>
		<li>
			<i class="fa fa-lock"></i> <span class="ipsType_monospace">
CONTENT;
$return .= htmlspecialchars( $value['pw'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
		</li>
		
CONTENT;

if ( $value['path'] ):
$return .= <<<CONTENT

			<li>
				<i class="fa fa-folder"></i> <span class="ipsType_monospace">
CONTENT;
$return .= htmlspecialchars( $value['path'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<li>
			<a href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_light ipsButton_veryVerySmall">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'connect', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>
	</ul>
</div>
CONTENT;

		return $return;
}

	function item( $name, $value, $maxItems, $minAjaxLength, $datasource, $template ) {
		$return = '';
		$return .= <<<CONTENT

<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_values" value="
CONTENT;

$return .= htmlspecialchars( implode( ',', array_keys($value) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
<input
	type="text"
	name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	value=""
	id="elInput_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	data-ipsContentItem
	
CONTENT;

if ( $maxItems ):
$return .= <<<CONTENT
data-ipsContentItem-maxItems="
CONTENT;
$return .= htmlspecialchars( $maxItems, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	data-ipsContentItem-dataSource="
CONTENT;
$return .= htmlspecialchars( $datasource, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	data-ipsContentItem-minAjaxLength="
CONTENT;
$return .= htmlspecialchars( $minAjaxLength, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
>
<ul data-contentItem-results="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsList_reset ipsContentItemSelector">

CONTENT;

if ( is_array($value) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $value as $item ):
$return .= <<<CONTENT

		
CONTENT;

$html = call_user_func( $template, $item );
$return .= <<<CONTENT

		
CONTENT;

$idColumn = $item::$databaseColumnId;
$return .= <<<CONTENT

		<li data-id='
CONTENT;
$return .= htmlspecialchars( $item->$idColumn, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<span class='cContentItem_delete' data-action='delete'>&times;</span>
			{$html}
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

</ul>

CONTENT;

		return $return;
}

	function itemResult( $item ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $item::$databaseColumnId;
$return .= <<<CONTENT

<div data-itemid="
CONTENT;
$return .= htmlspecialchars( $item->$idField, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role='contentItemRow'>
	<strong>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
	
CONTENT;

if ( $item->container() ):
$return .= <<<CONTENT

		<em>
CONTENT;

$sprintf = array($item->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'item_selector_added_to_container', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</em>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( isset( $item::$databaseColumnMap['date'] ) ):
$return .= <<<CONTENT

		<span class='ipsType_light'>
CONTENT;

$htmlsprintf = array(\IPS\Datetime::ts($item->mapped('date'))->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'item_selector_added_on', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
	
CONTENT;

endif;
$return .= <<<CONTENT
	
</div>


CONTENT;

		return $return;
}

	function keyValue( $key, $value ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsField_stackItem_keyValue">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_key_value_key', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <span data-ipsStack-keyvalue-name="key">{$key}</span> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_key_value_value', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <span data-ipsStack-keyvalue-name="key">{$value}</span></div>
CONTENT;

		return $return;
}

	function matrix( $id, $headers, $rows, $action, $hiddenValues, $actionButtons, $langPrefix, $widths=array(), $manageable=TRUE, $checkAlls=array(), $checkAllRows=FALSE, $classes=array(), $showTooltips=FALSE, $squashFields=TRUE ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-ipsMatrix data-ipsMatrix-manageable='
CONTENT;

if ( $manageable ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $squashFields ):
$return .= <<<CONTENT
data-ipsMatrix-squashFields
CONTENT;

endif;
$return .= <<<CONTENT
>
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

foreach ( $rows as $rowId => $row ):
$return .= <<<CONTENT

		<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_matrixRows[
CONTENT;
$return .= htmlspecialchars( $rowId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]' data-matrixrowid='
CONTENT;
$return .= htmlspecialchars( $rowId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' value='1'>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

if ( $manageable ):
$return .= <<<CONTENT

		<div class='ipsClearfix'>
			<div class="ipsJS_show">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->buttons( array( 'add' => array( 'link' => \IPS\Http\Url::internal( '#' ), 'icon' => 'plus', 'title' => 'add_button', 'class' => 'matrixAdd', 'data' => array( 'matrixID' => $id ) ) ) );
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<table class='ipsTable ipsMatrix ipsClear ipsTable_responsive 
CONTENT;

if ( count( $classes ) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( implode( ' ', $classes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' role='grid' data-matrixID='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->matrixRows( $headers, $rows, $langPrefix, $manageable, $widths, $checkAlls, $checkAllRows, $showTooltips );
$return .= <<<CONTENT

	</table>	
	<div class="ipsAreaBackground_light ipsClearfix ipsPad ipsType_center">
		
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

	function matrixNested( $id, $headers, $rows, $action, $hiddenValues, $actionButtons, $langPrefix, $widths=array(), $manageable=TRUE, $checkAlls=array(), $checkAllRows=FALSE, $classes=array(), $showTooltips=FALSE, $squashFields=TRUE ) {
		$return = '';
		$return .= <<<CONTENT

<div data-ipsMatrix data-ipsMatrix-manageable='
CONTENT;

if ( $manageable ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $squashFields ):
$return .= <<<CONTENT
data-ipsMatrix-squashFields
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

foreach ( $rows as $rowId => $row ):
$return .= <<<CONTENT

		<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_matrixRows[
CONTENT;
$return .= htmlspecialchars( $rowId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]' data-matrixrowid='
CONTENT;
$return .= htmlspecialchars( $rowId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' value='1'>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

if ( $manageable ):
$return .= <<<CONTENT

		<div class='ipsClearfix'>
			<div class="ipsJS_show">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'admin' )->buttons( array( 'add' => array( 'link' => \IPS\Http\Url::internal( '#' ), 'icon' => 'plus', 'title' => 'add_button', 'class' => 'matrixAdd', 'data' => array( 'matrixID' => $id ) ) ) );
$return .= <<<CONTENT

			</div>
			<noscript>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</noscript>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<table class='ipsTable ipsMatrix ipsClear ipsTable_responsive 
CONTENT;

if ( count( $classes ) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( implode( ' ', $classes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' role='grid' data-matrixID='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->matrixRows( $headers, $rows, $langPrefix, $manageable, $widths, $checkAlls, $checkAllRows, $showTooltips );
$return .= <<<CONTENT

	</table>	
</div>
CONTENT;

		return $return;
}

	function matrixRows( $headers, $rows, $langPrefix, $manageable=TRUE, $widths=array(), $checkAlls=array(), $checkAllRows=FALSE, $showTooltips=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<thead>
	<tr>
		
CONTENT;

foreach ( $headers as $header ):
$return .= <<<CONTENT

			<th class="ipsMatrixHeader ipsType_center" style="width: 
CONTENT;
$return .= htmlspecialchars( $widths[ $header ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
%">
				
CONTENT;

$val = "{$langPrefix}{$header}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

if ( array_key_exists( $header, $checkAlls ) ):
$return .= <<<CONTENT

					<br>
					<input type="checkbox" role='checkbox' data-action="checkAll" name="__all[
CONTENT;
$return .= htmlspecialchars( $header, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-checkallheader="
CONTENT;
$return .= htmlspecialchars( $header, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $checkAlls[ $header ] ):
$return .= <<<CONTENT
checked aria-checked='true'
CONTENT;

endif;
$return .= <<<CONTENT
>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</th>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

if ( $manageable ):
$return .= <<<CONTENT

			<th class='ipsTable_controls'>
				<noscript>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</noscript>
			</th>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</tr>
</thead>
<tbody>
	<tr role='row' class='ipsMatrix_empty 
CONTENT;

if ( count( $rows ) > 0 ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'>
		<td colspan="
CONTENT;

$return .= htmlspecialchars( count( $headers ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsPad ipsType_light'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'matrix_no_rows', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</td>
	</tr>
	
CONTENT;

foreach ( $rows as $rowId => $row ):
$return .= <<<CONTENT

		
CONTENT;

if ( is_string( $row ) ):
$return .= <<<CONTENT

			<tr>
				<th class="ipsMatrix_subHeader" colspan="
CONTENT;

$return .= htmlspecialchars( count( $headers ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">{$row}</th>
			</tr>
		
CONTENT;

else:
$return .= <<<CONTENT

			<tr data-matrixrowid="
CONTENT;
$return .= htmlspecialchars( $rowId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" role='row' 
CONTENT;

if ( \IPS\Request::i()->type && \IPS\Request::i()->type == $rowId ):
$return .= <<<CONTENT
class='ipsMatrix_highlighted'
CONTENT;

endif;
$return .= <<<CONTENT
>
				
CONTENT;

foreach ( $headers as $header ):
$return .= <<<CONTENT

					
CONTENT;

if ( is_object( $row[ $header ] ) ):
$return .= <<<CONTENT

						<td role='gridcell' 
CONTENT;

if ( $showTooltips ):
$return .= <<<CONTENT
data-ipsTooltip title="
CONTENT;

$val = "{$langPrefix}{$header}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-col='
CONTENT;
$return .= htmlspecialchars( $header, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-title="
CONTENT;

$val = "{$langPrefix}{$header}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsType_center
CONTENT;

if ( $row[$header]->error ):
$return .= <<<CONTENT
 ipsMatrix_error
CONTENT;

endif;
$return .= <<<CONTENT
">
							{$row[ $header ]->html()}
							
CONTENT;

if ( $row[$header]->error ):
$return .= <<<CONTENT

								<p class="ipsType_warning">
CONTENT;
$return .= htmlspecialchars( $row[$header]->error, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</td>
					
CONTENT;

elseif ( is_string( $row[ $header ] ) ):
$return .= <<<CONTENT

						<td role='gridcell' class="ipsMatrix_rowTitle">
							<div 
CONTENT;

if ( isset( $row['_level'] ) ):
$return .= <<<CONTENT
style="margin-left: 
CONTENT;

$return .= htmlspecialchars( $row['_level']*15, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
px"
CONTENT;

endif;
$return .= <<<CONTENT
>
								<strong>
CONTENT;

if ( $langPrefix === FALSE ):
$return .= <<<CONTENT
{$row[ $header ]}
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$val = "{$row[ $header ]}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</strong>
								
CONTENT;

if ( $checkAllRows ):
$return .= <<<CONTENT

									<br>
									<small class="ipsJS_show">
										<a href='#' data-action="checkRow" class='ipsButton ipsButton_light ipsButton_verySmall'><i class='fa fa-plus'></i></a> <a href='#' data-action="unCheckRow" class='ipsButton ipsButton_light ipsButton_verySmall'><i class='fa fa-minus'></i></a>
									</small>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</div>
						</td>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

if ( $manageable ):
$return .= <<<CONTENT

					<td role='gridcell' class="ipsTable_controls">
						
CONTENT;

if ( mb_substr( $rowId, 0, 5 ) !== '_new_' ):
$return .= <<<CONTENT

							<span class="ipsJS_show">
								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->controlStrip( array( 'add' => array( 'icon' => 'times-circle', 'title' => 'delete', 'class' => 'matrixDelete' ) ) );
$return .= <<<CONTENT

							</span>
							<noscript>
								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->checkbox( $rowId . '_delete' );
$return .= <<<CONTENT

							</noscript>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</td>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</tr>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</tbody>
CONTENT;

		return $return;
}

	function message( $lang, $id=NULL, $css='', $parse=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<li 
CONTENT;

if ( $id !== NULL ):
$return .= <<<CONTENT
 id="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
	<div class="ipsPad">
		<div class="
CONTENT;
$return .= htmlspecialchars( $css, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			
CONTENT;

if ( $parse ):
$return .= <<<CONTENT

				
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				{$lang}
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</li>
CONTENT;

		return $return;
}

	function node( $name, $value, $multiple, $url, $title, $roots, $zeroVal, $noJs, $permCheck, $subnodes, $togglePerm=NULL, $toggleIds=array(), $disabledCallback=NULL, $zeroValTogglesOn=array(), $zeroValTogglesOff=array(), $autoPopulate=FALSE, $children=NULL, $nodeClass=NULL, $where=NULL, $disabledArray=array(), $noParentNodesTitle=NULL, $noParentNodes=array() ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsSelectTree ipsJS_show' data-name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsSelectTree data-ipsSelectTree-url="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT
data-ipsSelectTree-multiple
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsSelectTree-selected='{$value}'>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="" data-role="nodeValue">
	<div class='ipsSelectTree_value ipsSelectTree_placeholder'></div>
	<span class='ipsSelectTree_expand'><i class='fa fa-chevron-down'></i></span>
	<div class='ipsSelectTree_nodes ipsHide'>
		<div data-role='nodeList' class='ipsScrollbar'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->nodeCascade( $roots, FALSE, $permCheck, $subnodes, $togglePerm, $toggleIds, $disabledCallback, $autoPopulate, $children, $nodeClass, $where, $disabledArray, $noParentNodesTitle, $noParentNodes );
$return .= <<<CONTENT

		</div>
	</div>
</div>

CONTENT;

if ( $zeroVal !== NULL ):
$return .= <<<CONTENT

	&nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;
	<span class='ipsCustomInput'>
		<input type="checkbox" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
-zeroVal" id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
-zeroVal" data-role="zeroVal" 
CONTENT;

if ( $value === 0 ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !empty($zeroValTogglesOn) OR !empty($zeroValTogglesOff) ):
$return .= <<<CONTENT
data-control="toggle"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !empty($zeroValTogglesOn) ):
$return .= <<<CONTENT
 data-togglesOn="
CONTENT;

$return .= htmlspecialchars( implode( ',', $zeroValTogglesOn ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-controls="
CONTENT;

$return .= htmlspecialchars( implode( ',', $zeroValTogglesOn ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !empty($zeroValTogglesOff) ):
$return .= <<<CONTENT
 data-togglesOff="
CONTENT;

$return .= htmlspecialchars( implode( ',', $zeroValTogglesOff ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-controls="
CONTENT;

$return .= htmlspecialchars( implode( ',', $zeroValTogglesOff ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 > 
		<span></span>
	</span>
	<label for="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
-zeroVal" class='ipsField_unlimited'>
CONTENT;

$val = "{$zeroVal}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>

CONTENT;

endif;
$return .= <<<CONTENT

<noscript>
	
CONTENT;

if ( $noJs ):
$return .= <<<CONTENT

		{$noJs}
	
CONTENT;

else:
$return .= <<<CONTENT

		<meta http-equiv="refresh" content="0; url=
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( '_noJs', '1' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endif;
$return .= <<<CONTENT

</noscript>
CONTENT;

		return $return;
}

	function nodeAutocomplete( $v ) {
		$return = '';
		$return .= <<<CONTENT

<ol class="ipsNodeSelect_breadcrumb">
	
CONTENT;

foreach ( $v->parents() as $parent ):
$return .= <<<CONTENT

		<li><span class="ipsType_light">
CONTENT;
$return .= htmlspecialchars( $parent->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <i class="fa fa-angle-right"></i></span></li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<li>
CONTENT;
$return .= htmlspecialchars( $v->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</li>
</ol>
CONTENT;

		return $return;
}

	function nodeCascade( $nodes, $results=FALSE, $permCheck=NULL, $subnodes=TRUE, $togglePerm=NULL, $toggleIds=array(), $disabledCallback=NULL, $autoPopulate=FALSE, $children=NULL, $nodeClass=NULL, $where=NULL, $disabledArray=array(), $noParentNodesTitle=NULL, $noParentNodes=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( empty( $nodes ) ):
$return .= <<<CONTENT

	<p class='ipsPad_half ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>

CONTENT;

else:
$return .= <<<CONTENT

	<ul class='ipsList_reset'>
		
CONTENT;

foreach ( $nodes as $node ):
$return .= <<<CONTENT

			<li>
				
CONTENT;

if ( ( $permCheck === NULL or $node->can( $permCheck ) ) and ( $disabledCallback === NULL or call_user_func( $disabledCallback, $node ) ) and !in_array( $node->_id, $disabledArray ) ):
$return .= <<<CONTENT

					<div data-action="nodeSelect" class='ipsSelectTree_item 
CONTENT;

if ( $node->hasChildren( 'view', NULL, $subnodes, $where ) ):
$return .= <<<CONTENT
ipsSelectTree_withChildren
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $autoPopulate AND isset( $children[ $node->_id ] ) ):
$return .= <<<CONTENT
ipsSelectTree_itemOpen
CONTENT;

endif;
$return .= <<<CONTENT
' data-id="
CONTENT;
$return .= htmlspecialchars( $node->_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $nodeClass and !( $node instanceof $nodeClass ) ):
$return .= <<<CONTENT
.s
CONTENT;

endif;
$return .= <<<CONTENT
" data-breadcrumb='
CONTENT;

$return .= htmlspecialchars( json_encode( array_values( array_map( function( $val ){ return isset( $val::$titleLangPrefix ) ? \IPS\Member::loggedIn()->language()->addToStack( $val::$titleLangPrefix . $val->_id, FALSE, array( 'json' => TRUE, 'escape' => TRUE, 'striptags' => TRUE ) ) : ( $val->_stripTagsTitle ? $val->_stripTagsTitle : $val->_title ); }, iterator_to_array( $node->parents() ) ) ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $togglePerm AND $node->can( $togglePerm ) AND count( $toggleIds ) ):
$return .= <<<CONTENT
data-control="toggle" data-toggles="
CONTENT;

$return .= htmlspecialchars( implode( ',', $toggleIds ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $autoPopulate AND isset( $children[ $node->_id ] ) ):
$return .= <<<CONTENT
data-childrenloaded="true"
CONTENT;

endif;
$return .= <<<CONTENT
>
						
CONTENT;

if ( $node->hasChildren( 'view', NULL, $subnodes, $where ) ):
$return .= <<<CONTENT

							<a href='#' data-action="getChildren" class='ipsSelectTree_toggle'></a>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<span data-role="nodeTitle">
CONTENT;

if ( $node->_stripTagsTitle ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $node->_stripTagsTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $node->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
					</div>
					
CONTENT;

if ( $autoPopulate AND isset( $children[ $node->_id ] ) and get_class( $node ) == ltrim( $nodeClass, '\\' ) ):
$return .= <<<CONTENT

						<div data-role="childWrapper">
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->nodeCascade( $children[ $node->_id ], FALSE, $permCheck, $subnodes, $togglePerm, $toggleIds, $disabledCallback, FALSE, $children, $nodeClass, $where, $disabledArray );
$return .= <<<CONTENT

						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

if ( $disabledCallback === NULL or call_user_func( $disabledCallback, $node ) !== NULL ):
$return .= <<<CONTENT

						<div class='ipsSelectTree_item ipsSelectTree_itemDisabled 
CONTENT;

if ( $node->hasChildren( 'view', NULL, $subnodes, $where ) ):
$return .= <<<CONTENT
ipsSelectTree_withChildren
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $autoPopulate AND isset( $children[ $node->_id ] ) ):
$return .= <<<CONTENT
ipsSelectTree_itemOpen
CONTENT;

endif;
$return .= <<<CONTENT
' data-id="
CONTENT;
$return .= htmlspecialchars( $node->_id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-breadcrumb='
CONTENT;

$return .= htmlspecialchars( json_encode( array_values( array_map( function( $val ){ return isset( $val::$titleLangPrefix ) ? \IPS\Member::loggedIn()->language()->addToStack( $val::$titleLangPrefix . $val->_id, FALSE, array( 'json' => TRUE, 'escape' => TRUE, 'striptags' => TRUE ) ) : ( $val->_stripTagsTitle ? $val->_stripTagsTitle : $val->_title ); }, iterator_to_array( $node->parents() ) ) ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $autoPopulate AND isset( $children[ $node->_id ] ) ):
$return .= <<<CONTENT
data-childrenloaded="true"
CONTENT;

endif;
$return .= <<<CONTENT
>
							
CONTENT;

if ( $node->hasChildren( 'view', NULL, $subnodes, $where ) ):
$return .= <<<CONTENT

								<a href='#' data-action="getChildren" class='ipsSelectTree_toggle'></a>
							
CONTENT;

endif;
$return .= <<<CONTENT

							<span data-role="nodeTitle">
CONTENT;

if ( $node->_stripTagsTitle ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $node->_stripTagsTitle, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $node->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
						</div>
						
CONTENT;

if ( $autoPopulate AND isset( $children[ $node->_id ] ) ):
$return .= <<<CONTENT

							<div data-role="childWrapper">
								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->nodeCascade( $children[ $node->_id ], FALSE, $permCheck, $subnodes, $togglePerm, $toggleIds, $disabledCallback, FALSE, $children, $nodeClass, $where, $disabledArray );
$return .= <<<CONTENT

							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

if ( $noParentNodesTitle and count( $noParentNodes ) ):
$return .= <<<CONTENT

			<li>
				<div class='ipsSelectTree_item ipsSelectTree_itemDisabled ipsSelectTree_withChildren 
CONTENT;

if ( $autoPopulate ):
$return .= <<<CONTENT
ipsSelectTree_itemOpen
CONTENT;

endif;
$return .= <<<CONTENT
' data-id="0" data-breadcrumb='
CONTENT;

$return .= htmlspecialchars( json_encode( array() ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $autoPopulate ):
$return .= <<<CONTENT
data-childrenloaded="true"
CONTENT;

endif;
$return .= <<<CONTENT
>
					<a href='#' data-action="getChildren" class='ipsSelectTree_toggle'></a>
					<span data-role="nodeTitle">
CONTENT;

$val = "{$noParentNodesTitle}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</div>
				
CONTENT;

if ( $autoPopulate ):
$return .= <<<CONTENT

					<div data-role="childWrapper">
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->nodeCascade( $noParentNodes, FALSE, $permCheck, $subnodes, $togglePerm, $toggleIds, $disabledCallback, $autoPopulate, $children, $nodeClass, $where, $disabledArray );
$return .= <<<CONTENT

					</div>
				
CONTENT;

endif;
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

		return $return;
}

	function number( $name, $value, $required, $unlimited=NULL, $range=FALSE, $min=NULL, $max=NULL, $step=NULL, $decimals=0, $unlimitedLang='unlimited', $disabled=FALSE, $suffix=NULL, $toggles=array(), $toggleOn=TRUE, $valueToggles=array(), $id=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $range && $min !== NULL ):
$return .= <<<CONTENT

<strong class='ipsType_small' data-role='rangeBoundary'>
CONTENT;
$return .= htmlspecialchars( $min, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>

CONTENT;

endif;
$return .= <<<CONTENT

<input
	type="
CONTENT;

if ( $range ):
$return .= <<<CONTENT
range
CONTENT;

else:
$return .= <<<CONTENT
number
CONTENT;

endif;
$return .= <<<CONTENT
"
	name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

if ( $id !== NULL ):
$return .= <<<CONTENT

		id="elNumber_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

endif;
$return .= <<<CONTENT

	size="5"
	
CONTENT;

if ( $required === TRUE ):
$return .= <<<CONTENT
aria-required='true'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $unlimited !== NULL and $value === $unlimited ):
$return .= <<<CONTENT

		value=""
		data-jsdisable="true"
	
CONTENT;

elseif ( is_numeric( $value ) ):
$return .= <<<CONTENT

		value="
CONTENT;

$return .= htmlspecialchars( number_format( $value, $decimals === true ? mb_strlen( mb_substr( $value, mb_strpos( $value, '.' ) + 1 ) ) : $decimals, '.', '' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

else:
$return .= <<<CONTENT

		value="0"
	
CONTENT;

endif;
$return .= <<<CONTENT

	class="ipsField_short"
	
CONTENT;

if ( $min !== NULL ):
$return .= <<<CONTENT

		min="
CONTENT;
$return .= htmlspecialchars( $min, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $max !== NULL ):
$return .= <<<CONTENT

		max="
CONTENT;
$return .= htmlspecialchars( $max, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $step !== NULL and $step != 'any' ):
$return .= <<<CONTENT

		step="
CONTENT;

$return .= htmlspecialchars( number_format( $step, 2, '.', '' ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

else:
$return .= <<<CONTENT

		step="any"
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( count($valueToggles) ):
$return .= <<<CONTENT
data-control="toggle" data-toggles="
CONTENT;

$return .= htmlspecialchars( implode( ',', $valueToggles ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

>

CONTENT;

if ( $range && $max !== NULL ):
$return .= <<<CONTENT

<strong class='ipsType_small' data-role='rangeBoundary'><span id='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_rangeValue' data-role='rangeValue'>
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>/
CONTENT;
$return .= htmlspecialchars( $max, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( is_string( $suffix ) ):
$return .= <<<CONTENT

	{$suffix}

CONTENT;

elseif ( isset( $suffix['preUnlimited'] ) ):
$return .= <<<CONTENT

	{$suffix['preUnlimited']}

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $unlimited !== NULL ):
$return .= <<<CONTENT

	&nbsp;
	<div class="ipsFieldRow_inlineCheckbox">
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		&nbsp;
		<span class='ipsCustomInput'>
			<input type="checkbox" role='checkbox' data-control="unlimited
CONTENT;

if ( count($toggles) ):
$return .= <<<CONTENT
 toggle
CONTENT;

endif;
$return .= <<<CONTENT
" name="
CONTENT;

$return .= htmlspecialchars( preg_replace( '/\[(.+?)\]/', '[$1_unlimited]', $name, 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='
CONTENT;

$return .= htmlspecialchars( preg_replace( '/\[(.+?)\]/', '[$1_unlimited]', $name, 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
-unlimitedCheck' value="
CONTENT;
$return .= htmlspecialchars( $unlimited, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $unlimited === $value ):
$return .= <<<CONTENT
checked aria-checked='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( count($toggles) ):
$return .= <<<CONTENT

CONTENT;

if ( $toggleOn === FALSE ):
$return .= <<<CONTENT
data-togglesOff
CONTENT;

else:
$return .= <<<CONTENT
data-togglesOn
CONTENT;

endif;
$return .= <<<CONTENT
="
CONTENT;

$return .= htmlspecialchars( implode( ',', $toggles ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 aria-labelledby='
CONTENT;

$return .= htmlspecialchars( preg_replace( '/\[(.+?)\]/', '[$1_unlimited]', $name, 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label'>
			<span></span>
		</span> <label for='
CONTENT;

$return .= htmlspecialchars( preg_replace( '/\[(.+?)\]/', '[$1_unlimited]', $name, 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
-unlimitedCheck' id='
CONTENT;

$return .= htmlspecialchars( preg_replace( '/\[(.+?)\]/', '[$1_unlimited]', $name, 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label' class='ipsField_unlimited'>
CONTENT;

$val = "{$unlimitedLang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( is_array( $suffix ) and isset( $suffix['postUnlimited'] ) ):
$return .= <<<CONTENT

	&nbsp;&nbsp;&nbsp;{$suffix['postUnlimited']}

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function numberRange( $start, $end ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'between', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 {$start} 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 {$end}
CONTENT;

		return $return;
}

	function poll( $name, $value, $pollData, $allowPollOnly ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller='core.front.core.pollEditor' data-pollName='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-showCounts='
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_edit_poll_votes') ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
' data-maxQuestions="
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->max_poll_questions, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-maxChoices="
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->max_poll_choices, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='cPoll'>	
	<noscript>
		
CONTENT;

if ( $value ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[fallback]" value="
CONTENT;
$return .= htmlspecialchars( $value->pid, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_no_js', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</noscript>
	<div class='ipsForm_vertical ipsForm_noLabels ipsJS_show'>
		<ul class='ipsList_reset ipsAreaBackground_light ipsBox ipsBox_transparent ipsPad'>
			<li class='ipsFieldRow'>
				<input type='text' class='ipsField_primary ipsField_fullWidth' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[title]" maxlength="255" 
CONTENT;

if ( $value ):
$return .= <<<CONTENT
value="
CONTENT;
$return .= htmlspecialchars( $value->poll_question, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
			</li>
			
CONTENT;

if ( \IPS\Settings::i()->poll_allow_public or (\IPS\Settings::i()->ipb_poll_only and $allowPollOnly) ):
$return .= <<<CONTENT

				<li class='ipsFieldRow'>
					<ul class='ipsFieldRow_content ipsList_reset'>
						
CONTENT;

if ( \IPS\Settings::i()->poll_allow_public ):
$return .= <<<CONTENT

							<li class='ipsFieldRow_inlineCheckbox'>
								<span class='ipsCustomInput'>
									<input type="checkbox" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[public]" id='elPoll_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_public' 
CONTENT;

if ( $value and $value->poll_view_voters ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
									<span></span>
								</span>
								<label for='elPoll_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_public'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'make_votes_public', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Settings::i()->ipb_poll_only and $allowPollOnly ):
$return .= <<<CONTENT

							<li class='ipsFieldRow_inlineCheckbox'>
								<span class='ipsCustomInput'>
									<input type="checkbox" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[poll_only]" id='elPoll_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_pollOnly' 
CONTENT;

if ( $value and $value->poll_only ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
									<span></span>
								</span>
								<label for='elPoll_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_pollOnly'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_only_content', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>
	<br> 

	<section data-role='pollContainer'>

	</section>

	<a href='#' data-action='addQuestion' class='ipsButton ipsButton_medium ipsButton_alternate ipsJS_show' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_poll_question_title', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-plus-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_poll_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</div>
CONTENT;

		return $return;
}

	function radio( $name, $value, $required, $options, $disabled=FALSE, $toggles=array(), $descriptions=array(), $warnings=array(), $userSuppliedInput='', $unlimited=NULL, $unlimitedLang=NULL, $htmlId=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $unlimited !== NULL ):
$return .= <<<CONTENT

	<ul class="ipsField_fieldList" role="radiogroup">
		<li>
			<span class='ipsCustomInput'>
				<input type="checkbox" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $unlimited, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='elRadio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_{unlimited}_
CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-control="toggle" data-togglesOff="elRadio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $value === $unlimited ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
				<span></span>
			</span>
			<div class='ipsField_fieldList_content'>
				<label for='elRadio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_{unlimited}_
CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					
CONTENT;

$val = "{$unlimitedLang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</label>
			</div>
		</li>
	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

<input type="hidden" name="radio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
__empty" value='1'>
<ul class="ipsField_fieldList" role="radiogroup" id="elRadio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

CONTENT;

foreach ( $options as $k => $v ):
$return .= <<<CONTENT

	<li>
		<span class='ipsCustomInput'>
			<input type="radio" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $value == (string) $k or ( isset( $userSuppliedInput ) and !in_array( $value, array_keys( $options ) ) and $k == $userSuppliedInput ) ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled === TRUE or ( is_array( $disabled ) and in_array( $k, $disabled ) ) ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $toggles[ $k ] ) and !empty( $toggles[ $k ] ) ):
$return .= <<<CONTENT
data-control="toggle" data-toggles="
CONTENT;

$return .= htmlspecialchars( implode( ',', $toggles[ $k ] ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			<span></span>
		</span>
		<div class='ipsField_fieldList_content ipsType_break'>
			<label for='elRadio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label'>{$v}</label>
			
CONTENT;

if ( !empty( $userSuppliedInput ) AND $userSuppliedInput == $k ):
$return .= <<<CONTENT

				<input type='text' name='
CONTENT;
$return .= htmlspecialchars( $userSuppliedInput, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' value="
CONTENT;

if ( !in_array( $value, array_keys( $options ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" id='
CONTENT;
$return .= htmlspecialchars( $userSuppliedInput, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;

$return .= htmlspecialchars( preg_replace('/[^a-zA-Z0-9\-_]/', '_', $name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( isset( $descriptions[ $k ] ) ):
$return .= <<<CONTENT

				<br>
				<span class='ipsFieldRow_desc'>
					{$descriptions[ $k ]}
				</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( isset( $warnings[ $k ] ) ):
$return .= <<<CONTENT

				<div id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_warning">
					<br>
					<p class='ipsMessage ipsMessage_warning'>{$warnings[ $k ]}</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>
CONTENT;

		return $return;
}

	function radioImages( $name, $value, $required, $options, $disabled=FALSE, $toggles=array(), $descriptions=array(), $warnings=array(), $htmlId=NULL ) {
		$return = '';
		$return .= <<<CONTENT


<div class="ipsGrid ipsGrid_collapsePhone ipsAttachment_fileList ipsContained">
	
CONTENT;

foreach ( $options as $k => $v ):
$return .= <<<CONTENT

		<div class='ipsGrid_span3 ipsBox ipsAttach ipsImageAttach ipsPad_half'>
			<div class=' ipsType_center' data-role='preview'>
				<label for="elRadio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsCursor_pointer'><img src="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" alt='' class='ipsImage'></label>
			</div>
			<div class="ipsType_center ipsPad_half">
				<span class='ipsCustomInput'>
					<input type="radio" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( (string) $value == (string) $k or ( isset( $userSuppliedInput ) and !in_array( $value, array_keys( $options ) ) and $k == $userSuppliedInput ) ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled === TRUE or ( is_array( $disabled ) and in_array( $k, $disabled ) ) ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $toggles[ $k ] ) and !empty( $toggles[ $k ] ) ):
$return .= <<<CONTENT
data-control="toggle" data-toggles="
CONTENT;

$return .= htmlspecialchars( implode( ',', $toggles[ $k ] ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					<span></span>
				</span>
			</div>
			
CONTENT;

if ( isset( $descriptions[ $k ] ) ):
$return .= <<<CONTENT

				<p class='ipsType_light ipsType_center'>{$descriptions[ $k ]}</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function rating( $name, $value, $required, $max=5, $display=NULL, $userRated=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' value="0">
<div data-ipsRating data-ipsRating-changeRate='true' data-ipsRating-size='veryLarge' 
CONTENT;

if ( $display ):
$return .= <<<CONTENT
data-ipsRating-value="
CONTENT;

$return .= htmlspecialchars( number_format( $display, 1 ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $userRated ):
$return .= <<<CONTENT
data-ipsRating-userRated="
CONTENT;

$return .= htmlspecialchars( $userRated, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

foreach ( range( 1, $max ) as $i ):
$return .= <<<CONTENT

		<input type='radio' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' value='
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $i == floor( $value ) ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
> <label for='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</label>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function rowDesc( $label, $element, $required=FALSE, $error=NULL, $prefix=NULL, $suffix=NULL, $id=NULL, $object=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Dispatcher::i()->controllerLocation == 'admin' AND !( $object instanceof \IPS\Helpers\Form\Address ) AND !( $object instanceof \IPS\Helpers\Form\Upload ) AND !( $object instanceof \IPS\Helpers\Form\Node ) ):
$return .= <<<CONTENT
<br>
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Dispatcher::i()->controllerLocation == 'front' AND ( !( $object instanceof \IPS\Helpers\Form\Checkbox ) OR $object instanceof \IPS\Helpers\Form\YesNo ) ):
$return .= <<<CONTENT
<br>
CONTENT;

endif;
$return .= <<<CONTENT

<span class='ipsFieldRow_desc'>
	%s
</span>
CONTENT;

		return $return;
}

	function rowWarning( $label, $element, $required=FALSE, $error=NULL, $prefix=NULL, $suffix=NULL, $id=NULL, $object=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div 
CONTENT;

if ( $id !== NULL ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_warning"
CONTENT;

endif;
$return .= <<<CONTENT
>
	<br>
CONTENT;

if ( \IPS\Dispatcher::i()->controllerLocation == 'front' ):
$return .= <<<CONTENT
<br>
CONTENT;

endif;
$return .= <<<CONTENT

	<p class='ipsMessage ipsMessage_warning'>%s</p>
</div>
CONTENT;

		return $return;
}

	function sort( $name, $value ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsField_stack" data-ipsStack data-ipsStack-sortable data-ipsStack-fieldName="$name">
	<ul class="ipsList_reset" data-role="stack">
	
CONTENT;

$i = 0;
$return .= <<<CONTENT

	
CONTENT;

foreach ( $value as $id => $val ):
$return .= <<<CONTENT

		
CONTENT;

$i++;
$return .= <<<CONTENT

		<li class='ipsField_stackItem' data-role="stackItem">
			<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="
CONTENT;
$return .= htmlspecialchars( $val, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			<div class="ipsCursor_drag" data-action='stackDrag'>
				<span class="ipsField_stackDrag ipsDrag ipsJS_show">
					<i class='fa fa-bars ipsDrag_dragHandle'></i>
				</span>
				<div data-ipsStack-wrapper class="ipsPad ipsPad_half">
					
CONTENT;
$return .= htmlspecialchars( $val, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</div>
			</div>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
CONTENT;

		return $return;
}

	function stack( $name, $fields, $options=array() ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsField_stack" data-ipsStack data-ipsStack-sortable data-ipsStack-fieldName="$name" 
CONTENT;

if ( isset( $options['maxItems'] ) ):
$return .= <<<CONTENT
data-ipsStack-maxItems="
CONTENT;
$return .= htmlspecialchars( $options['maxItems'], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
	<ul class="ipsList_reset" data-role="stack">
	
CONTENT;

foreach ( $fields as $field ):
$return .= <<<CONTENT

		<li class='ipsField_stackItem' data-role="stackItem">
			<span class="ipsField_stackDrag ipsDrag ipsJS_show" data-action='stackDrag'>
				<i class='fa fa-bars ipsDrag_dragHandle'></i>
			</span>
			<a href='#' class="ipsField_stackDelete ipsCursor_pointer ipsJS_show" data-action="stackDelete">
				<i class='fa fa-times'></i>
			</a>
			<input type="submit" class="ipsField_stackDelete ipsJS_hide" name="form_remove_stack[
CONTENT;

$return .= htmlspecialchars( md5($field), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="&cross;">
			<div data-ipsStack-wrapper>{$field}</div>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
	<a class="ipsField_stackAdd ipsButton ipsButton_light ipsButton_small ipsJS_show" href='#' data-action="stackAdd" role="button"><i class='fa fa-plus-circle'></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stack_add', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	<input type="submit" class="ipsJS_hide" name="form_add_stack" value="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stack_add', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
</div>
CONTENT;

		return $return;
}

	function text( $name, $type, $value, $required, $maxlength=NULL, $size=NULL, $disabled=FALSE, $autoComplete=NULL, $placeholder=NULL, $regex=NULL, $nullLang=NULL, $htmlId=NULL, $showMeter=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$valueAsArray = is_array( $value ) ? $value : explode( ',', $value );
$return .= <<<CONTENT


CONTENT;

if ( $showMeter ):
$return .= <<<CONTENT

	<div data-ipsPasswordStrength 
CONTENT;

if ( \IPS\Settings::i()->password_strength_meter_enforce ):
$return .= <<<CONTENT
data-ipsPasswordStrength-enforced data-ipsPasswordStrength-enforcedStrength='
CONTENT;

$return .= \IPS\Settings::i()->password_strength_option;
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $autoComplete ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->autocomplete( $name, $value, $required, $maxlength, $disabled, '', $placeholder, $nullLang, $autoComplete );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<input
		type="
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		value="
CONTENT;

if ( is_array( $value ) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( implode( ',', $value ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
"
		id="elInput_
CONTENT;

if ( ! empty($htmlId) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $htmlId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
"
		
CONTENT;

if ( $required === TRUE ):
$return .= <<<CONTENT
aria-required='true'
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $maxlength !== NULL ):
$return .= <<<CONTENT
maxlength="
CONTENT;
$return .= htmlspecialchars( $maxlength, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $size !== NULL ):
$return .= <<<CONTENT
size="
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $placeholder !== NULL ):
$return .= <<<CONTENT
placeholder='
CONTENT;
$return .= htmlspecialchars( $placeholder, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $regex !== NULL and $regex ):
$return .= <<<CONTENT
pattern="
CONTENT;
$return .= htmlspecialchars( $regex, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	>
	
CONTENT;

if ( $showMeter ):
$return .= <<<CONTENT

		<div data-role='strengthInfo' class='ipsHide'>
			<meter max="100" value="0" class='ipsForm_meter' data-role='strengthMeter'></meter>
			<span data-role='strengthText' class='ipsForm_meterAdvice'></span>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $nullLang ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
		<span class='ipsCustomInput'>
			<input type="checkbox" data-control="unlimited" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null" id='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null' value="1" 
CONTENT;

if ( $value === NULL ):
$return .= <<<CONTENT
checked aria-checked='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT
 aria-labelledby='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null_label'>
			<span></span>
		</span> <label for='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null' id='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null_label' class='ipsField_unlimited'>
CONTENT;

$val = "{$nullLang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $showMeter ):
$return .= <<<CONTENT

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

	function textarea( $name, $value='', $required, $maxlength=NULL, $disabled=FALSE, $class='', $placeholder='', $nullLang=NULL, $tags=array(), $rows=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !empty( $tags ) ):
$return .= <<<CONTENT

<div class='ipsColumns ipsColumns_collapseTablet' data-controller='core.global.editor.customtags' data-tagFieldType='text' data-tagFieldID='elTextarea_
CONTENT;

$return .= htmlspecialchars( preg_replace('/[^a-zA-Z0-9\-_]/', '_', $name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<div class='ipsColumn_fluid ipsColumn'>
		<div data-role="editor">

CONTENT;

endif;
$return .= <<<CONTENT

<textarea
	name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	id='elTextarea_
CONTENT;

$return .= htmlspecialchars( preg_replace('/[^a-zA-Z0-9\-_]/', '_', $name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
	value="
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	class="ipsField_fullWidth 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

if ( $rows !== NULL ):
$return .= <<<CONTENT
rows="
CONTENT;
$return .= htmlspecialchars( $rows, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $maxlength !== NULL ):
$return .= <<<CONTENT
maxlength="
CONTENT;
$return .= htmlspecialchars( $maxlength, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $required === TRUE ):
$return .= <<<CONTENT
aria-required='true'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $placeholder ):
$return .= <<<CONTENT
placeholder="
CONTENT;
$return .= htmlspecialchars( $placeholder, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

>
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</textarea>

CONTENT;

if ( !empty( $tags ) ):
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $nullLang ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
	<span class='ipsCustomInput'>
		<input type="checkbox" role='checkbox' data-control="unlimited" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null" id="
CONTENT;

$return .= htmlspecialchars( preg_replace('/[^a-zA-Z0-9\-_]/', '_', $name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null" value="1" 
CONTENT;

if ( $value === NULL ):
$return .= <<<CONTENT
checked aria-checked='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
 aria-controls='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' aria-labelledby='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null_label'>
		<span></span>
	</span> <label for='
CONTENT;

$return .= htmlspecialchars( preg_replace('/[^a-zA-Z0-9\-_]/', '_', $name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null' id='
CONTENT;

$return .= htmlspecialchars( preg_replace('/[^a-zA-Z0-9\-_]/', '_', $name), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_null_label' class='ipsField_unlimited'>
CONTENT;

$val = "{$nullLang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( !empty( $tags ) ):
$return .= <<<CONTENT

	</div>
	<div class='ipsColumn_medium ipsColumn ipsAreaBackground_light ipsComposeArea_sidebar 
CONTENT;

if ( !isset( \IPS\Request::i()->cookie['tagSidebar'] ) ):
$return .= <<<CONTENT
ipsComposeArea_sidebarOpen
CONTENT;

else:
$return .= <<<CONTENT
ipsComposeArea_sidebarClosed
CONTENT;

endif;
$return .= <<<CONTENT
'>
		<a href='#' class="ipsJS_show" data-action='tagsToggle' data-ipsTooltip data-ipsTooltip-label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'toggle_sidebar', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'toggle_sidebar', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		<h3 class='ipsAreaBackground ipsPad_half ipsType_reset' data-role='tagsHeader'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_tags', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
		<ul class='ipsList_reset ipsScrollbar' data-role='tagsList'>
		
CONTENT;

foreach ( $tags as $tagKey => $tagValue  ):
$return .= <<<CONTENT

			<li class='ipsPad_half'>
				<label class="ipsJS_show" data-tagKey="
CONTENT;
$return .= htmlspecialchars( $tagKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $tagKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</label>
				<div class='ipsJS_hide ipsType_light'><strong>
CONTENT;
$return .= htmlspecialchars( $tagKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></div>
				<div class='ipsType_light ipsType_small'>
CONTENT;
$return .= htmlspecialchars( $tagValue, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
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

CONTENT;

		return $return;
}

	function translatable( $name, $languages, $values, $editors, $placeholder, $textarea=FALSE, $required=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( count( $languages ) === 1 ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $languages as $lang ):
$return .= <<<CONTENT

		
CONTENT;

if ( !isset( $editors[ $lang->id ] )  ):
$return .= <<<CONTENT

			
CONTENT;

if ( $textarea ):
$return .= <<<CONTENT

				<textarea name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $lang->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]">
CONTENT;

if ( isset($values[ $lang->id ]) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $values[ $lang->id ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</textarea>
			
CONTENT;

else:
$return .= <<<CONTENT

				<input type='text' name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $lang->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="
CONTENT;

if ( isset($values[ $lang->id ]) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $values[ $lang->id ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" 
CONTENT;

if ( $placeholder !== NULL ):
$return .= <<<CONTENT
placeholder='
CONTENT;
$return .= htmlspecialchars( $placeholder, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			{$editors[ $lang->id ]->html()}
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

if ( $textarea ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $languages as $lang ):
$return .= <<<CONTENT

			<span class="
CONTENT;
$return .= htmlspecialchars( $lang->_icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></span> 
CONTENT;
$return .= htmlspecialchars( $lang->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( $required and $lang->default ):
$return .= <<<CONTENT
<span class="ipsFieldRow_required">required</span>
CONTENT;

endif;
$return .= <<<CONTENT
<br>
			<br>
			<textarea name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $lang->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" aria-label='
CONTENT;
$return .= htmlspecialchars( $lang->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( !$required || !$lang->default ):
$return .= <<<CONTENT
class='ipsFieldRow_errorExclude'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

if ( isset( $values[ $lang->id ]) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $values[ $lang->id ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</textarea><br>
			<br>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		<ul class='ipsField_translatable ipsList_reset'>
			
CONTENT;

foreach ( $languages as $lang ):
$return .= <<<CONTENT

				<li class='ipsClearfix'>
					
CONTENT;

if ( !isset( $editors[ $lang->id ] )  ):
$return .= <<<CONTENT

						<span class="
CONTENT;
$return .= htmlspecialchars( $lang->_icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></span>
						<input type='text' name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $lang->id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" aria-label='
CONTENT;
$return .= htmlspecialchars( $lang->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' placeholder="
CONTENT;
$return .= htmlspecialchars( $lang->title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( isset( $values[ $lang->id ]) ):
$return .= <<<CONTENT
value="
CONTENT;
$return .= htmlspecialchars( $values[ $lang->id ], ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !$required || !$lang->default ):
$return .= <<<CONTENT
class='ipsFieldRow_errorExclude'
CONTENT;

endif;
$return .= <<<CONTENT
>
						
CONTENT;

if ( $required and $lang->default ):
$return .= <<<CONTENT

							<span class="ipsFieldRow_required">required</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						<p class='ipsFlagEditor'>
							<span class="
CONTENT;
$return .= htmlspecialchars( $lang->_icon, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></span> <span class='ipsFlagLabel'>
CONTENT;
$return .= htmlspecialchars( $lang->_title, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
							
CONTENT;

if ( $required and $lang->default ):
$return .= <<<CONTENT
<span class="ipsFieldRow_required">required</span>
CONTENT;

endif;
$return .= <<<CONTENT

						</p>
						{$editors[ $lang->id ]->html()}
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function upload( $name, $value, $minimize, $maxFileSize, $maxFiles, $maxChunkSize, $totalMaxSize, $allowedFileTypes, $pluploadKey, $multiple=FALSE, $editor=FALSE, $forceNoscript=FALSE, $template='core.attachments.fileItem', $existing=array(), $default=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<input name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" type="hidden" value="
CONTENT;
$return .= htmlspecialchars( $pluploadKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

CONTENT;

if ( $forceNoscript ):
$return .= <<<CONTENT

	<input name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_noscript[]" type="file" 
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT
multiple
CONTENT;

endif;
$return .= <<<CONTENT
>
	<span class="ipsType_light ipsType_small">
		
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

			<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_accepted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
			
CONTENT;

$return .= htmlspecialchars( implode( ', ', $allowedFileTypes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $multiple and $totalMaxSize ):
$return .= <<<CONTENT

			
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

				&middot;
			
CONTENT;

endif;
$return .= <<<CONTENT

			<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_total_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
			
CONTENT;
$return .= htmlspecialchars( $totalMaxSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( !$multiple or !$totalMaxSize or $maxChunkSize < $totalMaxSize ):
$return .= <<<CONTENT

			
CONTENT;

if ( $allowedFileTypes !== NULL or ( $multiple and $totalMaxSize ) ):
$return .= <<<CONTENT

				&middot;
			
CONTENT;

endif;
$return .= <<<CONTENT

			<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
			
CONTENT;
$return .= htmlspecialchars( $maxChunkSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $maxFiles ):
$return .= <<<CONTENT

			<br>
CONTENT;

$pluralize = array( $maxFiles ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</span>

CONTENT;

else:
$return .= <<<CONTENT

	<noscript>
		<input name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_noscript[]" type="file" 
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT
multiple
CONTENT;

endif;
$return .= <<<CONTENT
>
		<span class="ipsType_light ipsType_small">
			
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

				<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_accepted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
CONTENT;

$return .= htmlspecialchars( implode( ', ', $allowedFileTypes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $multiple and $totalMaxSize ):
$return .= <<<CONTENT

				
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

					&middot;
				
CONTENT;

endif;
$return .= <<<CONTENT

				<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_total_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
CONTENT;
$return .= htmlspecialchars( $totalMaxSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !$multiple or !$totalMaxSize or $maxChunkSize < $totalMaxSize ):
$return .= <<<CONTENT

				
CONTENT;

if ( $allowedFileTypes !== NULL or ( $multiple and $totalMaxSize ) ):
$return .= <<<CONTENT

					&middot;
				
CONTENT;

endif;
$return .= <<<CONTENT

				<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
CONTENT;
$return .= htmlspecialchars( $maxChunkSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $maxFiles ):
$return .= <<<CONTENT

				<br>
CONTENT;

$pluralize = array( $maxFiles ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</span>
	</noscript>
	
CONTENT;

if ( $value ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $value as $id => $file ):
$return .= <<<CONTENT

			<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_existing[
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="
CONTENT;
$return .= htmlspecialchars( $file->tempId, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	<div id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_drop_
CONTENT;

$return .= htmlspecialchars( md5( uniqid() ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		 data-ipsUploader
		 
CONTENT;

if ( $maxFileSize ):
$return .= <<<CONTENT
data-ipsUploader-maxFileSize="
CONTENT;
$return .= htmlspecialchars( $maxFileSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

		 
CONTENT;

if ( $maxFiles ):
$return .= <<<CONTENT
data-ipsUploader-maxFiles="
CONTENT;
$return .= htmlspecialchars( $maxFiles, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

		 data-ipsUploader-maxChunkSize="
CONTENT;
$return .= htmlspecialchars( $maxChunkSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		 
CONTENT;

if ( $allowedFileTypes ):
$return .= <<<CONTENT
data-ipsUploader-allowedFileTypes='
CONTENT;

$return .= htmlspecialchars( json_encode( $allowedFileTypes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

		 data-ipsUploader-name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		 data-ipsUploader-key="
CONTENT;
$return .= htmlspecialchars( $pluploadKey, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		 
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT
data-ipsUploader-multiple 
CONTENT;

if ( $totalMaxSize ):
$return .= <<<CONTENT
data-ipsUploader-maxTotalSize="
CONTENT;
$return .= htmlspecialchars( $totalMaxSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

		 
CONTENT;

if ( $minimize ):
$return .= <<<CONTENT
data-ipsUploader-minimized
CONTENT;

endif;
$return .= <<<CONTENT

		 
CONTENT;

if ( $editor ):
$return .= <<<CONTENT
data-ipsUploader-insertable
CONTENT;

endif;
$return .= <<<CONTENT

		 data-ipsUploader-template='
CONTENT;
$return .= htmlspecialchars( $template, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
		 data-ipsUploader-existingFiles='
CONTENT;

$return .= htmlspecialchars( json_encode( $existing ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
		 
CONTENT;

if ( isset( $default ) ):
$return .= <<<CONTENT
data-ipsUploader-default='
CONTENT;
$return .= htmlspecialchars( $default, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

	>
		<div class="ipsAttachment_dropZone 
CONTENT;

if ( $minimize ):
$return .= <<<CONTENT
ipsAttachment_dropZoneSmall
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix">
			
CONTENT;

if ( $minimize ):
$return .= <<<CONTENT

				<a href="#" data-action='uploadFile' class="ipsButton ipsButton_small ipsButton_primary ipsPos_left" id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_browse_
CONTENT;

$return .= htmlspecialchars( md5( uniqid() ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_choose', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_choose_one', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
				<div class='ipsAttachment_dropZoneSmall_info'>
					<span class="ipsAttachment_supportDrag">
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_dad_mini', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_dad_mini_one', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
<br></span>
					<span class="ipsType_light ipsType_small">
						
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

							<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_accepted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
							
CONTENT;

$return .= htmlspecialchars( implode( ', ', $allowedFileTypes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $multiple and $totalMaxSize ):
$return .= <<<CONTENT

							
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

								&middot;
							
CONTENT;

endif;
$return .= <<<CONTENT

							<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_total_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
							
CONTENT;
$return .= htmlspecialchars( $totalMaxSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $maxFileSize and ( !$multiple or !$totalMaxSize or $maxFileSize < $totalMaxSize ) ):
$return .= <<<CONTENT

							
CONTENT;

if ( $allowedFileTypes !== NULL or ( $multiple and $totalMaxSize ) ):
$return .= <<<CONTENT

								&middot;
							
CONTENT;

endif;
$return .= <<<CONTENT

							<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
							
CONTENT;

$return .= htmlspecialchars( round($maxFileSize,2), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $maxFiles ):
$return .= <<<CONTENT

							<br>
CONTENT;

$pluralize = array( $maxFiles ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</span>
				</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<i class="fa fa-cloud-upload"></i>
				<span class="ipsAttachment_supportDrag">
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_dad', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_dad_one', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
<br></span>
				<a href="#" data-action='uploadFile' class="ipsButton ipsButton_verySmall ipsButton_primary" id="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_browse_
CONTENT;

$return .= htmlspecialchars( md5( uniqid() ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_choose', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_choose_one', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
				<br>
				<span class="ipsType_light ipsType_small">
					
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_accepted', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
						
CONTENT;

$return .= htmlspecialchars( implode( ', ', $allowedFileTypes ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $multiple and $totalMaxSize ):
$return .= <<<CONTENT

						
CONTENT;

if ( $allowedFileTypes !== NULL ):
$return .= <<<CONTENT

							&middot;
						
CONTENT;

endif;
$return .= <<<CONTENT

						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_total_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
						
CONTENT;
$return .= htmlspecialchars( $totalMaxSize, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $maxFileSize and ( !$multiple or !$totalMaxSize or $maxFileSize < $totalMaxSize ) ):
$return .= <<<CONTENT

						
CONTENT;

if ( $allowedFileTypes !== NULL or ( $multiple and $totalMaxSize ) ):
$return .= <<<CONTENT

							&middot;
						
CONTENT;

endif;
$return .= <<<CONTENT

						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
						
CONTENT;

$return .= htmlspecialchars( round($maxFileSize,2), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
MB
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $maxFiles ):
$return .= <<<CONTENT

						<br>
CONTENT;

$pluralize = array( $maxFiles ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_max_files', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
		<div class="ipsAttachment_fileList ipsScrollbar">
			<div data-role='fileList'></div>
			<noscript>
				
CONTENT;

if ( $value ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $value as $id => $file ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->uploadFile( $id, $file, $name, $editor, ( $template === 'core.attachments.imageItem' ) );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</noscript>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function uploadDisplay( $file, $downloadUrl ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $file->isImage() ):
$return .= <<<CONTENT

	<img src="$file->url" class="ipsImage" data-ipsLightbox>

CONTENT;

else:
$return .= <<<CONTENT

	<a href="
CONTENT;
$return .= htmlspecialchars( $downloadUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $file->originalFilename, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function uploadFile( $id, $file, $name=NULL, $editor=FALSE, $showAsImages=FALSE, $link=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $showAsImages ):
$return .= <<<CONTENT

	<div class='ipsGrid_span3 ipsAttach ipsImageAttach ipsPad_half ipsAreaBackground_light 
CONTENT;

if ( $editor ):
$return .= <<<CONTENT
ipsAttach_done
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='file' data-fileid="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $link ):
$return .= <<<CONTENT
data-filelink="
CONTENT;
$return .= htmlspecialchars( $link, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-isImage="
CONTENT;
$return .= htmlspecialchars( $file->isImage(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $file->attachmentThumbnailUrl ):
$return .= <<<CONTENT
data-thumbnailurl="
CONTENT;
$return .= htmlspecialchars( $file->attachmentThumbnailUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $file->isImage() ):
$return .= <<<CONTENT
data-fullsizeurl="
CONTENT;
$return .= htmlspecialchars( $file->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
		<ul class='ipsList_inline ipsImageAttach_controls'>
			
CONTENT;

if ( $editor ):
$return .= <<<CONTENT

				<li><a href='#' data-action='selectFile' class='ipsAttach_selection' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_insert_one', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-check'></i></a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $name ):
$return .= <<<CONTENT

				<li class='ipsPos_right'>
					<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_keep[
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1">
					<a href='#' data-role='deleteFile' class='ipsButton ipsButton_verySmall ipsButton_light' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_media_remove', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-trash-o'></i></a>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
		
CONTENT;

$screenshot = isset( $file->screenshot ) ? $file->screenshot : $file;
$return .= <<<CONTENT

		
CONTENT;

if ( in_array( mb_strtolower( mb_substr( $screenshot->filename, mb_strrpos( $screenshot->filename, '.' ) + 1 ) ), \IPS\Image::$imageExtensions ) ):
$return .= <<<CONTENT

			<div class='ipsImageAttach_thumb ipsType_center' data-role='preview' data-grid-ratio='65' data-action='selectFile' style='background-image: url( "
CONTENT;

$return .= htmlspecialchars( str_replace( array( '(', ')' ), array( '\(', '\)' ), ( $screenshot->attachmentThumbnailUrl ) ? $screenshot->attachmentThumbnailUrl : $screenshot->url ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" );'>
				<img src="
CONTENT;
$return .= htmlspecialchars( $screenshot->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" alt='' class='ipsImage'>
			</div>
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsImageAttach_thumb ipsType_center' data-role='preview' data-grid-ratio='65' data-action='selectFile'>
				<div class='ipsNoThumb'></div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT
		
		<h2 class='ipsType_reset ipsAttach_title ipsType_medium ipsTruncate ipsTruncate_line ipsType_break' data-role='title'>
CONTENT;

if ( isset( $file->contextInfo ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $file->contextInfo, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $file->originalFilename, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h2>
		<p class='ipsType_light ipsType_small ipsTruncate ipsTruncate_line ipsType_break'><span data-role='status'>
CONTENT;

$return .= \IPS\Output\Plugin\Filesize::humanReadableFilesize( $file->filesize() );
$return .= <<<CONTENT
</span>
CONTENT;

if ( isset( $file->contextInfo ) ):
$return .= <<<CONTENT
 &middot; 
CONTENT;
$return .= htmlspecialchars( $file->originalFilename, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</p>
	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsDataItem ipsAttach 
CONTENT;

if ( $editor ):
$return .= <<<CONTENT
ipsAttach_done
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $file->attachmentThumbnailUrl ):
$return .= <<<CONTENT
data-thumbnailurl="
CONTENT;
$return .= htmlspecialchars( $file->attachmentThumbnailUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-role='file' data-fileid="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-fullsizeurl="
CONTENT;
$return .= htmlspecialchars( $file->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $link ):
$return .= <<<CONTENT
data-filelink="
CONTENT;
$return .= htmlspecialchars( $link, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-isImage="
CONTENT;
$return .= htmlspecialchars( $file->isImage(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<div class='ipsDataItem_generic ipsDataItem_size3 ipsResponsive_hidePhone ipsResponsive_block ipsType_center' data-action='selectFile'>
			
CONTENT;

if ( in_array( mb_strtolower( mb_substr( $file->filename, mb_strrpos( $file->filename, '.' ) + 1 ) ), \IPS\Image::$imageExtensions ) ):
$return .= <<<CONTENT

				<img src="
CONTENT;

if ( $file->attachmentThumbnailUrl ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $file->attachmentThumbnailUrl, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $file->url, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" alt='' class='ipsImage ipsThumb_small'>
			
CONTENT;

else:
$return .= <<<CONTENT

				<i class='fa fa-file ipsType_large'></i>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main' data-action='selectFile'>
			<h2 class='ipsDataItem_title ipsType_reset ipsType_medium ipsAttach_title ipsTruncate ipsTruncate_line ipsType_break' data-role='title'>
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
		<div class='ipsDataItem_generic ipsDataItem_size9 ipsType_light' data-role='status'>
			
		</div>
		<div class='ipsDataItem_generic ipsDataItem_size3 ipsType_right'>
			<ul class='ipsList_inline'>
				
CONTENT;

if ( $editor ):
$return .= <<<CONTENT

					<li><a href='#' data-action='selectFile' class='ipsAttach_selection' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'form_upload_insert_one', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-check'></i></a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $name ):
$return .= <<<CONTENT

					<li>
						<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_keep[
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1">
						<a href='#' data-role='deleteFile' class='ipsButton ipsButton_verySmall ipsButton_light' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_media_remove', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-trash-o'></i></a>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>		
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}