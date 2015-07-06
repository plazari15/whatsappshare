<?php 

class WhatsAppHomeButton {

	function __construct(){
		//Init
		add_action('init', array($this, 'WhatsAppHomeButtonFunc') );

		//Shortcode
		add_shortcode('WhatsAppHomeButtonShortcode', array($this, 'RenderWhatsAppHomeButton') );

		// Register CSS and JS
		//add_action('wp_enqueue_scripts', array($this, 'WhatsAppHomeButtonScripts') );
	}


	/**
	 * Essa será a primeira função, vamos ver se o Visual Composer está instalado. Se tiver ele vai
	 * Rodar o mapa e o botão.
	 */

	public function WhatsAppHomeButtonFunc(){
		if( !defined('WPB_VC_VERSION') ):
			//Display that visual comoser required
			add_action('admin_notices', array($this, 'ShowWhatsAppHomeButtonVersion') );
		endif;
		$option = get_option('whatsappsharePage');
		vc_map(
			array(
				"name" => __('WhatsApp Share Button', Domain),
				"description" => __('Show the WhatsApp Button in the page with Visual Composer',Domain),
				"base" => "WhatsAppHomeButtonShortcode",
				"class" => "",
				"controls" => "full",
				"icon" => WhatsAppURL . 'admin/addons/assets/images/icon.jpg',
				"category" => __('WhatsApp Share', Domain),
				"params" => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __('Button Text', Domain),
						"param_name" => "btn_name",
						"value" => $option['ButtonName'],
						"description" => __('Set a text for the button', Domain)
						),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __('Icon Position', Domain),
						"param_name" => "icon_position",
						"value" => array(
							'Left' => 'Left',
							'Right' => 'Right'
							),
						"description" => __('Select the Position of The Icon', Domain)
						),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __('Button Color', Domain),
						"param_name" => "btn_color",
						"value" => '#34af23',
						"description" => __('Select the color of the Button', Domain)
						),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __('Text Color', Domain),
						"param_name" => "text_color",
						"value" => '#fff',
						"description" => __('Select the color of the Text', Domain)
						),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __('Button Icon', Domain),
						"param_name" => "icon",
						"value" => array(
							__('Share Icon', Domain) => 'Share Icon',
							__('Bullhorn', Domain) => 'Bullhorn',
							__('Share Icon Black Box', Domain) => 'Share Icon Black Box',
							__('WhatsApp Icon', Domain) => 'WhatsApp Icon'
							),
						"description" => __('Select the Position of The Icon', Domain)
						),
					)
				)
			);
	}

		/**
		 * Lógica para funcionamento do ShortCode
		 */
		public function RenderWhatsAppHomeButton( $atts, $content = null){		
			extract(shortcode_atts( array(
				'btn_name' => __('Share on WhatsApp', Domain),
				'icon_position' => 'Left',
				'btn_color' => '#34af23',
				'text_color' => '#fff',
				'icon' => 'WhatsApp Icon'	
				), $atts ) );
			switch ($icon) {
				case 'Share Icon':
					$IconEcho = '<i class="fa fa-share-alt fa-lg"></i>';
					break;

				case 'Bullhorn':
					$IconEcho = '<i class="fa fa-bullhorn fa-lg"></i>';
					break;

				case 'Share Icon Black Box':
					$IconEcho = '<i class="fa fa-share-square fa-lg"></i>';
					break;

				case 'WhatsApp Icon':
					$IconEcho = '<i class="fa fa-whatsapp fa-lg"></i>';
					break;
				
				default:
					$IconEcho = '<i class="fa fa-whatsapp fa-lg"></i>';
					break;
			}
			$PostTitle = get_the_title();
			$PostLink = get_the_permalink();
			if($icon_position == 'Left'):
				$btn = "<a style='text-decoration: none; color:{$text_color};background-color:{$btn_color}' href='whatsapp://send?text={$PostTitle} %20-%20 {$PostLink}' title='{$btnname}'><section style='color:{$text_color};background-color:{$btn_color}' class='bt-whats'>{$IconEcho}{$btn_name}</section></a>";
			else:
				$btn = "<a style='text-decoration: none; color:{$text_color};background-color:{$btn_color}' href='whatsapp://send?text={$PostTitle} %20-%20 {$PostLink}' title='{$btnname}'><section style='color:{$text_color};background-color:{$btn_color}' class='bt-whats'>{$btn_name}{$IconEcho}</section></a>";
			endif;
			return $btn;
		}	

		/**
		 * Aqui deve vir a função caso precise carregar CSS ou JS
		 */

		/**
		 * Aqui vem a função para mostrar o Erro
		 */
		public function ShowWhatsAppHomeButtonVersion(){
			 $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
          <p>'.sprintf(__('We realize that you do not have Visual Composer. This plugin has some unique features to the Visual Composer.', Domain), $plugin_data['Name']).'</p>
        </div>';
		}
}

/**
 * Por fim, vamos iniciar a porra toda
 */

new WhatsAppHomeButton();