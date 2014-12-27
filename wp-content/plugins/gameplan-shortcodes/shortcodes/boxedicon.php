<?php
function parse_boxed($atts, $content, $id){
	$output = '';
	$id = 'box-'.rand();
	str_replace("[boxed_item","",$content,$i);
	$number_item =$i;
	global $style_box;
	$style_box = isset($atts['style']) ? $atts['style'] : '';
	if(class_exists('Mobile_Detect')){
	$detect = new Mobile_Detect;
		$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
		if(isset($atts['animation'])){
		$animation_class = ($atts['animation']&&$_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
		}
	}else{
		if(isset($atts['animation'])){
		$animation_class = $atts['animation']?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
		}
	}
	if($number_item==1){$w_col='item_1';}
	else if($number_item==2){$w_col='item_2';}
	else if($number_item==3){$w_col='item_3';}
	else if($number_item==4){$w_col='item_4';}
	else if($number_item==5){$w_col='item_5';}
	else if($number_item==6){$w_col='item_6';}

	$output .= '<div class="wpb_content_element not-column-inherit boxed">';
	$output .= '<div class="wpb_wrapper wpb_accordion_wrapper ui-accordion boxedicon">';
	$output .= '<div id="'.$id.'" class="boxed-icon '.$atts['style'].' '.$w_col.' '.$animation_class.' ">';

	$output .= do_shortcode(str_replace('<br class="nc" />', '', $content));
	$w_item=(100/$number_item);
	$output .= '</div> ';
	
	$output .= '</div> ';
	$output .= '</div> ';
	return $output;
}

function parse_boxed_item($atts, $content, $id){
	$title = isset($atts['title']) ? $atts['title'] : '';
	$icon = isset($atts['icon']) ? $atts['icon'] : '';
	$link = isset($atts['link']) ? $atts['link'] : '';
	$text = isset($atts['text']) ? $atts['text'] : '';
	$color_tt = isset($atts['color_tt']) ? $atts['color_tt'] : '';
	$bg_ttcolor = isset($atts['bg_ttcolor']) ? $atts['bg_ttcolor'] : '';
	$bg_color = isset($atts['bg_color']) ? $atts['bg_color'] : '';
	$id = rand();
	//$style = '';
	global $style_box;
	$gp_main_color='#ee4422';
	if(function_exists('ot_get_option')){
		$gp_main_color = ot_get_option('main_color','#ee4422');
		if(ot_get_option('theme_style') == 'dark') $gp_main_color = ot_get_option('main_color','#ffd600');
	}
	$bg_ttcolor = $bg_ttcolor?$bg_ttcolor:$gp_main_color;
	if(function_exists('ot_get_option')){
		if((ot_get_option('theme_style') == 'light' && $color_tt=='' && $style_box!='style-3')||(ot_get_option('theme_style') == '' && $color_tt=='' && $style_box!='style-3')){
			$color_tt='#ffffff';
		}
		else if (ot_get_option('theme_style') == 'dark' && $color_tt=='' && $style_box!='style-3'){
			$color_tt='#000000';
		} 
	}
	if($bg_color==''){
		
		if(function_exists('ot_get_option')){
			if(ot_get_option('theme_style') == 'light'){	
				$bg_color = '#e9e9e9';
			}else if(ot_get_option('theme_style') == 'dark'){
				$bg_color ='#323232';
			}
		}
	}
	$output_css = '';
	if($style_box=='style-1'){
	$output_css .= '
		.boxed-icon.style-1 #boxed-'.$id.' .heading{background:'.$bg_ttcolor.' !important;color:'.$color_tt.' !important;}
		.boxed-icon.style-1 #boxed-'.$id.' .heading .icon-caret-left:before{color:'.$bg_ttcolor.' !important;}
		.boxed-icon.style-1 #boxed-'.$id.' .boxed-item-bg{background:'.$bg_ttcolor.' !important;}
		.boxed-icon.style-1 #boxed-'.$id.' .contain{background:'.$bg_color.' !important;}
		.boxed-icon.style-1 #boxed-'.$id.':hover .contain-content{ position: relative; color:'.$color_tt.' !important; transition: color 0.4s ease !important; -moz-transition: color 0.4s ease !important;-webkit-transition: color 0.4s ease!important;}';
	} else
	if($style_box=='style-2'){
	$output_css .='
		.boxed-icon.style-2 #boxed-'.$id.' .heading{color:'.$bg_ttcolor.' !important;}
		.boxed-icon.style-2 #boxed-'.$id.':hover .heading{position: relative; color:'.$color_tt.' !important; transition: color 0.4s ease !important; -moz-transition: color 0.4s ease !important;-webkit-transition: color 0.4s ease!important;}
		.boxed-icon.style-2 #boxed-'.$id.' .boxed-item-s2{background:'.$bg_ttcolor.' !important;}
		.boxed-icon.style-2 #boxed-'.$id.' .margin-left{background:'.$bg_color.' !important;}
		.boxed-icon.style-2 #boxed-'.$id.':hover .contain-content{ position: relative; color:'.$color_tt.' !important; transition: color 0.4s ease !important; -moz-transition: color 0.4s ease !important;-webkit-transition: color 0.4s ease!important;}
	';
	}else
	if($style_box=='style-3'){
		if(function_exists('ot_get_option')){
			$color_tt = ot_get_option('main_color');
			if($color_tt==''){
				if(ot_get_option('theme_style') == 'light' && $color_tt==''){
					$color_tt='#ee4422';
				}
				else if (ot_get_option('theme_style') == 'dark' && $color_tt==''){
					$color_tt='#ffd600';
				}
			}
		}
		$output_css .= '
			.boxed-icon.style-3 #boxed-'.$id.':hover .heading{position: relative; color:'.$color_tt.' !important; transition: color 0.4s ease !important; -moz-transition: color 0.4s ease !important;-webkit-transition: color 0.4s ease!important;}
			.boxed-icon.style-3 #boxed-'.$id.':hover .contain-content{ position: relative; color:'.$color_tt.' !important; transition: color 0.4s ease !important; -moz-transition: color 0.4s ease !important;-webkit-transition: color 0.4s ease!important;}';
	}
	if($link!=''){
	$output_css .= '
		.boxed-icon #boxed-'.$id.'{cursor:pointer;}
	';
	}
	
	$output = '<style type="text/css" scoped="scoped">'.$output_css.'</style>';
	$output .= "\n\t\t\t" . '<div class="boxed-item" id="boxed-'.$id.'">';
	$output .= "\n\t\t\t\t" . '<div class="margin-left">';
	$output .= "\n\t\t\t\t" . '<div class="boxed-item-s2"></div>';
	$output .= "\n\t\t\t\t" . '<div class="heading" style=" "><i class="icon-caret-left" style="color:'.$bd_ttcolor.';" ></i><i class="'.$icon.' icon_ct" ></i><span class="boxed_title">'.$title.'</span></div>';
	$output .= "\n\t\t\t\t" . '<div class="contain"><div class="boxed-item-bg"></div><i class='.$icon.'></i>';
	
	$output .= "\n\t\t\t\t" . '<div class="contain-content"><div></div>'.$content.'</div>';
	$output .= "\n\t\t\t\t" . '</div>';

	$output .= "\n\t\t\t\t" . '</div>';
	$output .= "\n\t\t\t" . '</div> ';
	if($link!=''){
	$output .= '
	<script>
			jQuery(document).ready(function() {
			jQuery("#boxed-'.$id.'").click(function(){
				window.location=("'.$link.'");
			});
		});

	</script>
	';
	}
	return $output;
}
add_shortcode( 'boxed_item', 'parse_boxed_item' );
add_shortcode( 'boxed', 'parse_boxed' );

//Visual Composer

add_action( 'after_setup_theme', 'reg_boxed' );
function reg_boxed(){
	if(function_exists('wpb_map')){

		vc_map( array(
			"name"		=> __("Boxed", "cactusthemes"),
			"base"		=> "boxed",
			"as_parent" => array('only' => 'boxed_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-boxed",
			"params"	=> array(
				array(
					"type" => "textfield",
					"heading" => __("Name", "cactusthemes"),
					"param_name" => "name",
					"value" => "",
					"description" => '',
				),
				array(		
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __("CSS Animation", 'cactusthemes'),
					"param_name" => "animation",
					"value" => array(
						__("No", 'cactusthemes') => '',
						__("Top to bottom", 'cactusthemes') => 'top-to-bottom',
						__("Bottom to top", 'cactusthemes') => 'bottom-to-top',
						__("Left to right", 'cactusthemes') => 'left-to-right',
						__("Right to left", 'cactusthemes') => 'right-to-left',
						__("Appear from center", 'cactusthemes') => 'appear',
					),
					"description" => ''
				),
			),
			"js_view" => 'VcColumnView'
		) );
		vc_map( array(
			"name"		=> __("Boxed item", "cactusthemes"),
			"base"		=> "boxed_item",
			"content_element" => true,
			"as_child" => array('only' => 'boxed_item'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "icon-boxed",
			"params"	=> array(
				array(
					"type" => "textfield",
					"heading" => __("Title", "cactusthemes"),
					"param_name" => "title",
					"value" => "",
					"description" => '',
				),
				array(
					"type" => "attach_image",
					"heading" => __("Background", "cactusthemes"),
					"param_name" => "background",
					"value" => "",
					"description" => '',
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __("Content", "cactusthemes"),
					"param_name" => "content",
					"value" => '',
					"description" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Link to go", "cactusthemes"),
					"param_name" => "link",
					"value" => "",
					"description" => '',
				),
			),
		) );
	}
	if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
	class WPBakeryShortCode_boxed extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_boxed_item extends WPBakeryShortCode{}
	}
}
