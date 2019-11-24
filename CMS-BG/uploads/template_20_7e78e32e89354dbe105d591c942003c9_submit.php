<?php
namespace IPS\Theme\Cache;
class class_forums_front_submit extends \IPS\Theme\Template
{
	public $cache_key = '6e1f840c39b425b524abd74ce399d994';
	function createTopic( $form, $forum, $title ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack( $title ) );
endif;
$return .= <<<CONTENT


{$form}
CONTENT;

		return $return;
}

	function createTopicForm( $forum, $hasModOptions, $topic, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL, $errorTabs=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$modOptions = array( 'topic_create_state', 'create_topic_locked', 'create_topic_pinned', 'create_topic_hidden', 'create_topic_featured', 'topic_open_time', 'topic_close_time');
$return .= <<<CONTENT


<form accept-charset='utf-8' class="ipsForm 
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

	
	
CONTENT;

if ( $form->error ):
$return .= <<<CONTENT

		<p class="ipsMessage ipsMessage_error">
CONTENT;
$return .= htmlspecialchars( $form->error, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT


	<div class='ipsBox'>
		<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_details', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		
CONTENT;

if ( count( $elements ) > 1 ):
$return .= <<<CONTENT

			
CONTENT;

if ( !empty( $errorTabs ) ):
$return .= <<<CONTENT

				<p class="ipsMessage ipsMessage_error ipsJS_show">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'tab_error', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsTabs ipsClearfix ipsJS_show' id='tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTabBar data-ipsTabBar-contentArea='#ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				<a href='#tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
				<ul role='tablist'>
					
CONTENT;

foreach ( $elements as $name => $content ):
$return .= <<<CONTENT

						<li>
							<a href='#ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' id='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsTabs_item 
CONTENT;

if ( in_array( $name, $errorTabs ) ):
$return .= <<<CONTENT
ipsTabs_error
CONTENT;

endif;
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $name == 'mainTab' ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
">
								
CONTENT;

if ( in_array( $name, $errorTabs ) ):
$return .= <<<CONTENT
<i class="fa fa-exclamation-circle"></i> 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			</div>
			<div id='ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_panels'>
				
CONTENT;

foreach ( $elements as $name => $contents ):
$return .= <<<CONTENT

					<div id='ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class="ipsTabs_panel ipsPad" aria-labelledby="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">

						
CONTENT;

if ( $hasModOptions && $name == 'topic_mainTab' ):
$return .= <<<CONTENT

							<div class='ipsColumns ipsColumns_collapsePhone'>
								<div class='ipsColumn ipsColumn_fluid'>
						
CONTENT;

endif;
$return .= <<<CONTENT

							<ul class='ipsForm ipsForm_vertical'>
								
CONTENT;

foreach ( $contents as $inputName => $input ):
$return .= <<<CONTENT

									
CONTENT;

if ( !in_array( $inputName, $modOptions ) ):
$return .= <<<CONTENT

										{$input}
									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</ul>
						
CONTENT;

if ( $hasModOptions && $name == 'topic_mainTab' ):
$return .= <<<CONTENT

								</div>
								<div class='ipsColumn ipsColumn_wide'>
									
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "submit", "forums" )->createTopicModOptions( $elements, $modOptions );
$return .= <<<CONTENT

								</div>
							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</div>		
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsPad'>
				
CONTENT;

if ( $hasModOptions ):
$return .= <<<CONTENT

					<div class='ipsColumns ipsColumns_collapsePhone'>
						<div class='ipsColumn ipsColumn_fluid'>
				
CONTENT;

endif;
$return .= <<<CONTENT

					<ul class='ipsForm ipsForm_vertical'>
						
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

							
CONTENT;

foreach ( $collection as $inputName => $input ):
$return .= <<<CONTENT

								
CONTENT;

if ( !in_array( $inputName, $modOptions ) ):
$return .= <<<CONTENT

									{$input}
								
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
				
CONTENT;

if ( $hasModOptions ):
$return .= <<<CONTENT

						</div>
						<div class='ipsColumn ipsColumn_wide'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "submit", "forums" )->createTopicModOptions( $elements, $modOptions );
$return .= <<<CONTENT

						</div>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT


		<div class='ipsAreaBackground ipsPad ipsType_center'>
			<a href="
CONTENT;

if ( !is_null($topic) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $topic->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $forum->url(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" class="ipsButton ipsButton_link ipsButton ipsButton_link">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cancel', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

if ( $topic ):
$return .= <<<CONTENT

			<button type='submit' class='ipsButton ipsButton_medium ipsButton_primary' tabindex="1" accesskey="s" role="button">
CONTENT;

if ( $forum->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_question_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_topic_edit', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</button>
			
CONTENT;

else:
$return .= <<<CONTENT

			<button type='submit' class='ipsButton ipsButton_medium ipsButton_primary' tabindex="1" accesskey="s" role="button">
CONTENT;

if ( $forum->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_question', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_topic', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</button>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>	
</form>
CONTENT;

		return $return;
}

	function createTopicModOptions( $elements, $modOptions ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsPad ipsAreaBackground_light'>
	<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_moderator_options', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<ul class='ipsForm ipsForm_vertical ipsSpacer_top'>
		
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $collection as $inputName => $input ):
$return .= <<<CONTENT

				
CONTENT;

if ( in_array( $inputName, $modOptions ) ):
$return .= <<<CONTENT

					
CONTENT;

if ( $inputName == 'topic_open_time' or $inputName == 'topic_close_time' ):
$return .= <<<CONTENT

						<li class='ipsFieldRow ipsClearfix'>
							<label class="ipsFieldRow_label" for="
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							<ul class='ipsFieldRow_content ipsList_reset cCreateTopic_date'>
								<li>
									<i class='fa fa-calendar'></i>
									<input type="date" name="
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsField_short" data-control="date" placeholder='
CONTENT;

$return .= htmlspecialchars( str_replace( array( 'YYYY', 'MM', 'DD' ), array( \IPS\Member::loggedIn()->language()->addToStack('_date_format_yyyy'), \IPS\Member::loggedIn()->language()->addToStack('_date_format_mm'), \IPS\Member::loggedIn()->language()->addToStack('_date_format_dd') ), str_replace( 'Y', 'YY', \IPS\Member::loggedIn()->language()->preferredDateFormat() ) ), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
' value="
CONTENT;

if ( $input->value instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $input->value->format('Y-m-d'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $input->value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" data-preferredFormat="
CONTENT;

if ( $input->value instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $input->value->localeDate(), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $input->value, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
								</li>
								<li>
									<i class='fa fa-clock-o'></i>
									<input name="
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT
_time" type="time" size="12" class="ipsField_short" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( '_time_format_hhmm', \IPS\HTMLENTITIES, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" step="60" min="00:00" value="
CONTENT;

if ( $input->value instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $input->value->format('H:i'), ENT_QUOTES | \IPS\HTMLENTITIES, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
								</li>
							</ul>
						</li>
					
CONTENT;

else:
$return .= <<<CONTENT

						{$input}
					
CONTENT;

endif;
$return .= <<<CONTENT

				
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
CONTENT;

		return $return;
}}