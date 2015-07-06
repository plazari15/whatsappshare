<?php 
/**
 * Plugin Name: WhatsApp Share
 * Plugin URI: #
 * Description:  Share all your posts, pages and custom posts with every body in WhatsApp, setup your button to keep with the face of your site / blog
 * Version: 2.1.1
 * Requires at least: 4.0
 * Tested up to: 4.2
 * Author: Pedro Lazari
 * Author URI: http://www.codecanyon.net/plazari15
 */

//defines
define('whatsapp_versao', '4.1.1');
define('WhatsAppDir', plugin_dir_path( __FILE__ ));
define('WhatsAppURL', plugin_dir_url( __FILE__ ));
define('Domain', 'whatsapp-share');

//ACTIVATION
register_activation_hook(WhatsAppDir . 'whatsappshare.php', 'CriaPlugin' );
function CriaPlugin(){
	global $wp_version;
	if(version_compare(whatsapp_versao, $wp_version, '>')):
		wp_die('Versão mínima requerida ' . whatsapp_versao . ' para rodar o plugin.', 'problemas com a versão');
	endif;
}

add_action('admin_menu', 'MenuWhatsApp' );
function MenuWhatsApp(){
	add_menu_page(
		'WhatsApp Share',
		'WhatsApp Share',
		'manage_options',
		'WhatsAppShare',
		'WhatsAppShareConfig_Callback',
		WhatsAppURL . 'front/img/whatsapp.fw.png',
		'81' );
}

//Style FOR FRONT
function EstiloWhatsApp(){
	wp_register_style('WhatsAppPlugin', plugin_dir_url( __FILE__ ) . 'front/css/style.css?v=1.2.2', false, '1.2.2');
	wp_enqueue_style('WhatsAppPlugin' );

	wp_register_style('WhatsAppIcons', plugin_dir_url( __FILE__ ) . 'front/css/font-awesome.min.css?v=1.0.0', false, '1.0.0' );
	wp_enqueue_style('WhatsAppIcons' );
}
add_action('wp_enqueue_scripts', 'EstiloWhatsApp' );

//SCRIPTS FOR ADMIN
function AdminScriptsWhats( $hooks ){
	wp_register_style('WhatsAppIcons', plugin_dir_url( __FILE__ ) . 'front/css/font-awesome.min.css?v=1.0.0', false, '1.0.0' );
	wp_enqueue_style('WhatsAppIcons' );

	//enqueue COlor Picker
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-script', plugin_dir_url( __FILE__ ) . 'admin/js/color-script.js', array('wp-color-picker'), false, true);


}
add_action('admin_enqueue_scripts', 'AdminScriptsWhats' );

//Translate 
add_action('init', 'LinguasDoPlugin' );
function LinguasDoPlugin(){
$result = load_plugin_textdomain('whatsapp-share', false, dirname( plugin_basename( __FILE__ )) . '/lang');
}

//REQUIRES ARCHIVE
add_action('after_setup_theme', 'WhatsAppRequire' );
function WhatsAppRequire(){
	if(is_admin()):
		require_once WhatsAppDir . 'admin/whatsappconfig.php';
		require_once WhatsAppDir . 'admin/whatsapp-metabox.php';
		
		
	else:
		require_once WhatsAppDir . 'front/whatsappfront.php';
	endif;
	
if ( defined('WPB_VC_VERSION') ):
	require_once WhatsAppDir . 'admin/addons/home-page-button.php';
endif;
}

//When delete
register_uninstall_hook( WhatsAppDir . 'whatsappshare.php', 'WhatsAppDesativacao' );
function WhatsAppDesativacao(){
	delete_option( 'whatsappsharePage' );
}