<?php 
//SELECT IF SHOW THE METABOX
$option = get_option("whatsappsharePage" );
if($option['Show Button'] == 'Show'):
	add_action('add_meta_boxes', 'AddButtonMetabox' );
endif;

//FUNCTION FOR METABOX
function AddButtonMetabox(){
	add_meta_box(
		'WhatsAppButton_Option',
		'<i class="fa fa-whatsapp fa-lg"></i> ' . __('WhatsApp Button Share', 'whatsapp-share'),
		'WhatsAppButton_Option_Callback',
		null,
		'side',
		'default'		
		);
}


function WhatsAppButton_Option_Callback(){ 
	$post_id = get_the_id();
		$postMeta = get_post_meta( $post_id, 'WhatsAppButtonShow');
	?>
	<p><?php _e('Check the option bellow to show the button in this post. If  you loose this option the button will no show.', 'whatsapp-share'); ?> </p>
<label>
<input type="checkbox" name="WhatsAppButtonShow" value="1" <?php echo $postMeta[0] == '1' ? 'checked' : '' ?>><?php _e('Show the button in this post / page ', 'whatsapp-share') ?>
</label>
<?php  }

//FUNCTION FOR SAVE METABOX
add_action('save_post','Whats' );
function Whats(){
	 $post_id = get_the_id();
	 $contentOfMeta = $_POST['WhatsAppButtonShow'];
	
	 if($contentOfMeta == '1'):
	 	update_post_meta( $post_id, 'WhatsAppButtonShow', '1'	);
	else:
		update_post_meta( $post_id, 'WhatsAppButtonShow', '0'	);
	endif;

}