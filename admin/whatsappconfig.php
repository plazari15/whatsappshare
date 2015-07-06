<?php 
function WhatsAppShareConfig_Callback(){  ?>
	
	<h3><?php _e( 'WhatsApp Share', 'whatsapp-share' ); ?></h3>
<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-1">
			<!-- main content -->
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">
						<div class="inside">
							<h2><?php _e('Whats App Share Config', 'whatsapp-share'); ?></h2>						
							<p><?php _e('Setup your Plugin and button as you wish', 'whatsapp-share'); ?></p>						
							
								<?php settings_errors(); ?>
							<div class="whats-form">
								<form method="post" action="options.php">
									<?php do_settings_sections( 'whatsappsharePage' ); ?>
									<?php settings_fields( 'whatsappsharePage' ); ?>
									<?php submit_button(); ?>
								</form>
							</div>

							
						</div>
						<!-- .inside -->
					</div>
					<!-- .postbox -->
				</div>
				<!-- .meta-box-sortables .ui-sortable -->
			</div>
			<!-- post-body-content -->			
			</div>
			<!-- #postbox-container-1 .postbox-container -->
		</div>
		<!-- #post-body .metabox-holder .columns-2 -->
		<div class="clear"></div>
	<!-- #poststuff -->
</div> <!-- .wrap -->
<?php }

add_action('admin_init', 'SettingsSectionWhatsApp' );
function SettingsSectionWhatsApp(){
	$SectionID = 'whatsappshareSection';
	$SectionPage = 'whatsappsharePage';

	if(!get_option( 'whatsappsharePage' )):
		add_option( 'whatsappsharePage' );
	endif;

	add_settings_section(
		$SectionID,
		'WhatsApp Share Config',
		'WhatsAppShareCallback',
		$SectionPage
	);

	add_settings_field(
		'WhatsAppShare_ShowButton',
		__('Show button', 'whatsapp-share'),
		'WhatsAppShare_ShowButton_Callback',
		$SectionPage,
		$SectionID,
		array(__('This Includes posts, pages, in the posts or pages edition you´ll can select if the button will ou not be showed.', 'whatsapp-share'))
	);

	add_settings_field(
		'WhatsAppShare_Content',
		__('Show in Content', 'whatsapp-share'),
		'WhatsAppShare_Content_Callback',
		$SectionPage,
		$SectionID,
		array(__('Select the part of the text where the button will appear', 'whatsapp-share'))
	);

	add_settings_field(
		'WhatsAppShare_ButtonName',
		__('Button Text', 'whatsapp-share'),
		'WhatsAppShare_ButtonText_Callback',
		$SectionPage,
		$SectionID,
		array(__('Set the text of the button', 'whatsapp-share'))
	);

	add_settings_field(
		'WhatsAppShare_IconPosition',
		__('Icon Position', 'whatsapp-share'),
		'WhatsAppShare_IconPosition_Callback',
		$SectionPage,
		$SectionID,
		array(__('Select the position of the Icon', 'whatsapp-share'))
	);

	add_settings_field(
		'whatsAppShare_Icon',
		__('Icon', 'whatsapp-share'),
		'WhatsAppShare_Icon_Callback',
		$SectionPage,
		$SectionID,
		array(__('Select the Icon', 'whatsapp-share'))
	);

	add_settings_field(
		'WhatsAppShare_BackgroundColor',
		__('Background Color', 'whatsapp-share'),
		'WhatsAppShare_BackgroundColor_Callback',
		$SectionPage,
		$SectionID,
		array(__('Chose the Color Background. Default WhatsApp Color: #34af23', 'whatsapp-share'))
	);

	add_settings_field(
		'WhatsAppShare_TextColor',
		__('Text Color', 'whatsapp-share'),
		'WhatsAppShare_TextColor_Callback',
		$SectionPage,
		$SectionID,
		array(__('Chose the Color of the Text.', 'whatsapp-share'))
	);

	add_settings_field(
		'WhatsAppShare_ButtonStyle',
		__('Button Style', 'whatsapp-share'),
		'WhatsAppShare_ButtonStyle_Callback',
		$SectionPage,
		$SectionID,
		array(__('Select the type of the Button', 'whatsapp-share'))
	);

	add_settings_field(
		'WhatsAppShare_ButtonTypeText',
		__('Type of Text', 'whatsapp-share'),
		'WhatsAppShare_ButtonTypeText_Callback',
		$SectionPage,
		$SectionID,
		array(__('Select the type of the text to the button', 'whatsapp-share'))
	);

	add_settings_field(
		'WhatsAppShare_TextFont',
		__('Select the Font', Domain),
		'WhatsAppShare_TextFont_Callback',
		$SectionPage,
		$SectionID,
		array(__('Select the font. If you don´t select the font, the button will get the template default', 'whatsapp-share'))
	);

	register_setting(
		'whatsappsharePage',
		'whatsappsharePage'
		);

}



function WhatsAppShareCallback(){
	_e('Setup your plugin, button and other things as you wish.', 'whatsapp-share');
}

function WhatsAppShare_ShowButton_Callback( $args ){
		if( get_option( 'whatsappsharePage' ) ):
			$option = get_option( 'whatsappsharePage' );
		else:
			$option = '';
		endif;
	?>
	<input type="checkbox" name="whatsappsharePage[Show Button]" value="Show" <?php echo $option['Show Button'] == 'Show' ? 'checked' : '' ?>>
	<label><?= $args[0] ?> </label>
<?php }

function WhatsAppShare_Content_Callback( $args ){ 
		if( get_option( 'whatsappsharePage' ) ):
			$option = get_option( 'whatsappsharePage' );
		else:
			$option = '';
		endif;
	?>

	<select name="whatsappsharePage[ButtonPosition]">
		<option  value="Before" <?= $option['ButtonPosition'] == 'Before' ? 'selected' : '' ?>><?php _e('Before', 'whatsapp-share') ?></option>
		<option  value="After" <?= $option['ButtonPosition'] == 'After' ? 'selected' : '' ?>><?php _e('After', 'whatsapp-share') ?></option>
	</select>
	<label><?= $args[0] ?></label>
<?php }

function WhatsAppShare_ButtonText_Callback( $args ){ 
		if( get_option( 'whatsappsharePage' ) ):
			$option = get_option( 'whatsappsharePage' );
		else:
			$option = '';
		endif;
	?>

<input type="text" name="whatsappsharePage[ButtonName]" value="<?php echo $option['ButtonName'] != '' ? $option['ButtonName'] : '' ?> ">
<label><?php echo $args[0] ?> </label>
<?php 
}

function WhatsAppShare_IconPosition_Callback( $args ){ 
		if( get_option( 'whatsappsharePage' ) ):
			$option = get_option( 'whatsappsharePage' );
		else:
			$option = '';
		endif;
	?>

	<select name="whatsappsharePage[IconPosition]">
		<option  value="Left" <?= $option['IconPosition'] == 'Left' ? 'selected' : '' ?>><?php _e('Left', 'whatsapp-share') ?></option>
		<option  value="Right" <?= $option['IconPosition'] == 'Right' ? 'selected' : '' ?>><?php _e('Right', 'whatsapp-share') ?></option>
		<option  value="NoText" <?= $option['IconPosition'] == 'NoText' ? 'selected' : '' ?>><?php _e('No Text, just Icon', 'whatsapp-share') ?></option>
	</select>
	<label><?= $args[0] ?></label>
<?php }

function WhatsAppShare_Icon_Callback( $args ){ 
		if( get_option( 'whatsappsharePage' ) ):
			$option = get_option( 'whatsappsharePage' );
		else:
			$option = '';
		endif;
	?>

	<select name="whatsappsharePage[IconSelect]">
		<option  value="" <?= $option['IconSelect'] == '' ? 'selected' : '' ?>><?php _e('Select an Option', 'whatsapp-share') ?></option>
		<option  value="share" <?= $option['IconSelect'] == 'share' ? 'selected' : '' ?>><?php _e('Share Icon', 'whatsapp-share') ?></option>
		<option  value="bullhorn" <?= $option['IconSelect'] == 'bullhorn' ? 'selected' : '' ?>><?php _e('Bullhorn', 'whatsapp-share') ?></option>
		<option  value="share-box" <?= $option['IconSelect'] == 'share-box' ? 'selected' : '' ?>><?php _e('Share Icon Black Box', 'whatsapp-share') ?></option>
		<option  value="whatsapp" <?= $option['IconSelect'] == 'whatsapp' ? 'selected' : '' ?>><?php _e('WhatsApp Icon', 'whatsapp-share') ?></option>
	</select>
	<label><?= $args[0] ?></label>
<?php }

function WhatsAppShare_BackgroundColor_Callback( $args){ 
		if( get_option( 'whatsappsharePage' ) ):
			$option = get_option( 'whatsappsharePage' );
		else:
			$option = '';
		endif;
	?>
	<input type="text" name="whatsappsharePage[BackgroundColor]" class="my-color-field" data-default-color="#34af23" value="<?php echo $option['BackgroundColor'] != '' ? $option['BackgroundColor'] : '#34af23' ?>">
	<label><?php echo  $args[0] ?> </label>
<?php 
}


function WhatsAppShare_TextColor_Callback( $args){ 
		if( get_option( 'whatsappsharePage' ) ):
			$option = get_option( 'whatsappsharePage' );
		else:
			$option = '';
		endif;
	?>
	<input type="text" name="whatsappsharePage[TextColor]" class="my-color-field" value="<?php echo $option['TextColor'] != '' ? $option['TextColor'] : '' ?>">
	<label><?php echo  $args[0] ?> </label>
<?php 
}

function WhatsAppShare_ButtonStyle_Callback( $args ){
	if( get_option( 'whatsappsharePage' ) ):
			$option = get_option( 'whatsappsharePage' );
		else:
			$option = '';
		endif;
	?>
	<select name="whatsappsharePage[ButtonStyle]">
		<option value="50Base" <?php echo $option['ButtonStyle'] == '50Base' ? 'selected' : '' ?>><?php _e('50% of the content', 'whatsapp-share') ?></option>
		<option value="50Round" <?php echo $option['ButtonStyle'] == '50Round' ? 'selected' : '' ?>><?php _e('50% and rounded corners', 'whatsapp-share') ?></option>
		<option value="100Base" <?php echo $option['ButtonStyle'] == '100Base' ? 'selected' : '' ?>><?php _e('100% of the content', 'whatsapp-share') ?></option>
		<option value="100Round" <?php echo $option['ButtonStyle'] == '100Round' ? 'selected' : '' ?>><?php _e('100% and rounded corners', 'whatsapp-share') ?></option>
		<option value="10Base" <?php echo $option['ButtonStyle'] == '10Base' ? 'selected' : '' ?>><?php _e('10% Just for Icon ', 'whatsapp-share') ?></option>
		<option value="10Round" <?php echo $option['ButtonStyle'] == '10Round' ? 'selected' : '' ?>><?php _e('10% Just for Icon and circle', 'whatsapp-share') ?></option>
	</select>
	<label><?php echo $args[0] ?> </label>
<?php }

function WhatsAppShare_ButtonTypeText_Callback( $args ){
	if( get_option( 'whatsappsharePage' ) ):
			$option = get_option( 'whatsappsharePage' );
		else:
			$option = '';
		endif;
	?>
	<select name="whatsappsharePage[ButtonTypeText]">
		<option value="upper" <?php echo $option['ButtonTypeText'] == 'upper' ? 'selected' : '' ?>><?php _e('Text in capital letters', 'whatsapp-share') ?></option>
		<option value="not-upper" <?php echo $option['ButtonTypeText'] == 'not-upper' ? 'selected' : '' ?>><?php _e('Text not in capital letters', 'whatsapp-share') ?></option>
	</select>
	<label><?php echo $args[0] ?> </label>
<?php }

function WhatsAppShare_TextFont_Callback( $args ){
	if( get_option( 'whatsappsharePage' ) ):
			$option = get_option( 'whatsappsharePage' );
			$text = $option['TextFont'];
		else:
			$option = '';
			$text = 'Default';
		endif;
	?>
	<label>
		<select name="whatsappsharePage[TextFont]">
			<option value="Default" <?= $text == 'Default' ? 'selected' : '' ?> ><?php _e('Use Theme Default' , Domain) ?></option>
			<option value="Open Sans" <?= $text == 'Open Sans' ? 'selected' : '' ?> >Open Sans</option>
			<option value="Roboto" <?= $text == 'Roboto' ? 'selected' : '' ?> >Roboto</option>
			<option value="Lato" <?= $text == 'Lato' ? 'selected' : '' ?> >Lato</option>
			<option value="Oswald" <?= $text == 'Oswald' ? 'selected' : '' ?> >Oswald</option>
			<option value="Lora" <?= $text == 'Lara' ? 'selected' : '' ?> >Lara</option>
			<option value="PT Sans" <?= $text == 'PT Sans' ? 'selected' : '' ?> >PT Sans</option>
			<option value="Source Sans Pro" <?= $text == 'Source Sans Pro' ? 'selected' : '' ?> >Source Sans Pro</option>
		</select>
		<?php echo $args[0] ?>
	</label>
<?php }

