<?php
/*
FUNCTION FOR THE BUTTON
*/
function BotaoWhatsApp(){
		//Get the title
		$NormalTitle = get_the_title();
		//Array Map for change the caracters
		$mapa = array( 
			'!' => '!',
			'?' => '%3f',
			'&' => '%26',
			'%' => '%25',
			':' => '%3a',
			';' => '%3b',
			'#' => '%23'
		);		
		$NormalTitle = strtr($NormalTitle, $mapa); 
		$NormalTitle = explode(' ', $NormalTitle); 
		$CorrectTitle = implode('%20', $NormalTitle);  
		$options =  get_option('whatsappsharePage' );

		//ICONS
		$IconPosition = $options['IconPosition'];
		$Icon = $options['IconSelect'];

		//Condition for ICONS
		switch ($Icon) {
			case 'share':
				$IconEcho = '<i class="fa fa-share-alt fa-lg"></i>';
			break;

			case 'bullhorn':
				$IconEcho = '<i class="fa fa-bullhorn fa-lg"></i>';
			break;

			case 'share-box':
				$IconEcho = '<i class="fa fa-share-square fa-lg"></i>';
			break;

			case 'whatsapp':
				$IconEcho = '<i class="fa fa-whatsapp fa-lg"></i>';
			break;
			
			default:
				$IconEcho = '';
			break;
		}

		//Colors 
		$Background = 'background-color: ' . $options['BackgroundColor'] . ';';
		$TextColor = ' color: ' . $options['TextColor'] . ';';
		
		//Button style
		switch ($options['ButtonStyle']) {
			case '50Base':
				$Width = 'width: 48%;';
			break;

			case '50Round':
				$Width = 'width: 48%; border-radius: 10px;';
			break;

			case '100Base':
				$Width = 'width: 96%;';
			break;

			case '100Round':
				$Width = 'width: 96%; border-radius: 10px;';
			break;

			case '10Base':
				$Width = 'width: 6%;';
			break;

			case '10Round':
				$Width = 'width: 6%; border-radius: 100px;';
			break;

			default:
				$Width = 'width: 96%;';
				break;
		}

		//UPPERCASE TEXT 
		switch ($options['ButtonTypeText']) {
			case 'upper':
				$upper = 'uppercase-bt';
				break;

				case 'not-upper':
					$upper = '';
				break;
			
			default:
					$upper = 'uppercase-bt';
				break;
		}

		/**
		 * Select the font
		 */
		switch ($options['TextFont']) {
			case 'Open Sans':
					echo "<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>";
					$Font = "font-family: 'Open Sans', sans-serif;";
				break;

				case 'Roboto':
					echo "<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>";
					$Font = "font-family: 'Roboto', sans-serif;";
				break;

				case 'Lato':
					echo "<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>";
					$Font = "font-family: 'Lato', sans-serif;";
				break;

				case 'Oswald':
					echo "<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>";
					$Font = "font-family: 'Oswald', sans-serif;";
				break;

				case 'Lora':
					echo "<link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>";
					$Font = "font-family: 'Lora', serif;";
				break;

				case 'PT Sans':
					echo "<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>";
					$Font = "font-family: 'PT Sans', sans-serif;";
				break;

				case 'Source Sans Pro':
					echo "<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>";
					$Font = "font-family: 'Source Sans Pro', sans-serif;";
				break;
			
			default:
					$Font = "";
				break;
		}
		
	//End of Options
		if($IconPosition == 'Right'):
			$Button = '<a style="text-decoration: none;' . $TextColor  . $Font .'" href="whatsapp://send?text=' . $CorrectTitle . '%20-%20' . get_the_permalink() . '"><section style="' . $Background . $TextColor . $Width . '" class="bt-whats ' . $upper .' ">	' . $options['ButtonName']. ' ' . $IconEcho .' </section></a>';
		elseif($IconPosition == 'Left'):
			$Button = '<a style="text-decoration: none;' . $TextColor  . $Font .'" href="whatsapp://send?text=' . $CorrectTitle . '%20-%20' . get_the_permalink() . '"> <section style="' . $Background . $TextColor . $Width . '" class="bt-whats ' . $upper . ' "> '. $IconEcho . ' ' . $options['ButtonName']. ' </section></a>';
		else:
			$Button = '<a style="text-decoration: none;' . $TextColor  . $Font .'" href="whatsapp://send?text=' . $CorrectTitle . '%20-%20' . get_the_permalink() . '"><section style="' . $Background . $TextColor . $Width . '" class="bt-whats ' . $upper . ' ">	' . $IconEcho . ' </section></a>';
		endif;

		//RETURN THE BUTTON 
		return $Button; 
}

//SELECT IF SHOW OR NOT 
$option = get_option( 'whatsappsharePage' );
if($option['Show Button'] == "Show"):
	add_filter('the_content', 'WhatsAppShareShowButton' );
endif;

//FUNCTION FOR WHERE THE BUTTON WILL BE SHOWED
function WhatsAppShareShowButton( $content ){
	$option = get_option( 'whatsappsharePage' ); //Get Option
	$Post_ID = get_the_ID();
	$MetaPostWhats = get_post_meta($Post_ID, 'WhatsAppButtonShow'); 

	if($MetaPostWhats[0] == '1'):
		switch ($option['ButtonPosition']) {
			case 'Before':
			return BotaoWhatsApp() . "<div class='clearWhatsB'></div>" . $content;
			break;
			
			case 'After':
				return $content . "<div class='clearWhats'></div>" . BotaoWhatsApp();
				
				break;

			default:
				return $content . "<div class='clearWhats'></div>" . BotaoWhatsApp();
				break;
		}
		else:
			return $content;
	endif;
}