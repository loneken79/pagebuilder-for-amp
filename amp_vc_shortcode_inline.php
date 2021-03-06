<?php
global $custom_inlinecss;
function amp_vc_shortcode_inline_css($slug='',$atts = ''){
	global $custom_inlinecss;
	$inlineCss = '';
	$default_colors = array('sky' => '#5aa1e3','blue' => '#5472d2','turquoise' => '#00c1cf','pink'=> '#fe6c61','violet'=>'#8d6dc4','peacoc'=> '#4cadc9','mulled_wine'=>'#50485b','vista_blue'=> '#75d69c','chino'=>'#cec2ab','black'=> '#000000','grey'=>'#ebebeb','orange'=> '#f7be68','sky'=>'#5aa1e3','green'=> '#6dab3c','juicy_pink'=>'#f4524d','sandy_brown'=> '#f79468','purple'=>'#b97ebb','white' => '#ffffff');
	switch ($slug) {
		case 'vc_column_text':
		$inlineCss = $atts['css'];
			return $inlineCss;
		break;
		case 'vc_hoverbox':
			if ( ! empty( $atts['image'] ) ) {
				$image = intval( $atts['image'] );
				$image_data = wp_get_attachment_image_src( $image, 'large' );
				$image_src = $image_data[0];
			} else {
				$image_src = vc_asset_url( 'vc/no_image.png' );
			}
			$image_src = esc_url( $image_src );
			$inlineCss = '
				.flip-box-front {
				  background-color: #bbb;
				  color: black;
				  background-image: url('.$image_src.');
				  background-repeat: no-repeat;
    			  background-size: 100% 100%;
				}';
			return $inlineCss;
		case 'vc_progress_bar':
			$inlineCss = '.vc_progress_bar_'.$atts['uniq_id'].'{
				background-color:green;
			}.vc_single_bar{
				color:red;
			}';
			return $inlineCss;
		break;
		case 'vc_icon':
		//color,background_style,background_color,size,align
		
		if($atts['color'] == 'custom'){
			$color = $atts['custom_color'];
		}else{
			$color = $default_colors[$atts['color']];
		}
		if($atts['background_color'] == 'custom'){
			$background_color = $atts['custom_background_color'];
		}else{
			$background_color = $default_colors[$atts['background_color']];
		}
		switch ($atts['size']) {
			case 'xs':
				$font_size = '1.2em';
				$bg_size = '2em';
				break;
			case 'sm':
				$font_size = '1.6em';
				$bg_size = '3.15em';
				break;
			case 'md':
				$font_size = '2.15em';
				$bg_size = '4em';
				break;
			case 'lg':
				$font_size = '2.85em';
				$bg_size = '5em';
				break;
			case 'xl':
				$font_size = '5em';
				$bg_size = '7em';
				break;
			default:
				$font_size = '1.2em';
				break;
		}
		$background_shapes = array('rounded-less' => '5px','rounded' => '50%','boxed' => '0px','boxed-outline' => '0px','rounded-outline' => '50%','rounded-less-outline' => '5px');

		if(strpos($atts['background_style'],"outline")){
			$outline_color = '.vc_icon_element-background-color-'.$atts['background_color'].' {
			    background-color: transparent;
			}';
		}else{
			$outline_color = '.vc_icon_element-background-color-'.$atts['background_color'].' {
			    background-color: '.$background_color.';
			}';
		}
		$inlineCss = '
			.vc_icon_element-size-'.$atts['size'].' .vc_icon_element-icon:before{
			    font-size: '.$font_size.';
			    display:block;
			}
			'.$outline_color.'
			.vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-style-'.$atts['background_style'].' {
				border-color: '.$background_color.';
			    border-radius: '.$background_shapes[$atts['background_style']].';
			}
			
			.vc_icon_element-size-'.$atts['size'].'.vc_icon_element-have-style-inner {
			    width: '.$bg_size.';
			    height: '.$bg_size.';
			}
			.vc_icon_element-inner .vc_icon_element-icon {
			    font-weight: 400;
			    line-height: 1;
			    display: inline-block;
			    position: absolute;
			    top: 50%;
			    left: 50%;
			    transform: translate(-50%,-50%);
			}
			.vc_icon_element.vc_icon_element-outer .vc_icon_element-inner {
			    text-align: center;
			    display: inline-block;
			    border: 2px solid transparent;
			    position: relative;
			}
			.vc_icon_element-align-'.$atts['align'].'{
				text-align:'.$atts['align'].';
			}
			.vc_icon_element-icon{
				color:'.$color.';
			}
		';
		return $inlineCss;
		break;
		case 'vc_separator':

			if($atts['color'] == 'custom'){
				$color = $atts['accent_color'];
			}else{
				$color = $default_colors[$atts['color']];
			}
		
			$inlineCss = '
			
			.vc_sep_width_'.$atts['el_width'].' {
			    width: '.$atts['el_width'].'%;
			}
			.vc_separator .vc_sep_holder .vc_sep_line {
			    height: 1px;
			    border-top: 1px solid '.$color.';
			    display: block;
			    position: relative;
			    top: 1px;
			    width: 100%;
			}
			.vc_separator.vc_sep_'.$atts['style'].' .vc_sep_line {
			    border-top-style: '.$atts['style'].';
			}
			.vc_separator.vc_sep_border_width_'.$atts['border_width'].' .vc_sep_holder .vc_sep_line {
			    border-top-width: '.$atts['border_width'].'px;
			}
			.vc_separator.vc_sep_color_violet .vc_sep_line {
			    border-color: '.$color.';
			}
			.vc_sep_holder_r{display:none;}
			.vc_sep_pos_align_center{
				 margin-left: auto;
			    margin-right: auto;
			}
			.vc_sep_pos_align_left {
				margin-left: 0;
			    margin-right: auto;
			}
			.vc_sep_pos_align_right {
			    margin-left: auto;
			    margin-right: 0;
			}
			.amp-wp-inline-31dea72d02bfe004a0d413f6bbe20cbd{
				border-color:'.$color.';
			}';
		return $inlineCss;
		break;
		case 'vc_btn':
		//style,gradient_color_1,gradient_color_2,gradient_custom_color_1,gradient_custom_color_2,gradient_text_color,custom_text,outline_custom_color,outline_custom_hover_background,shape,color,size,align,i_align
		$inlineCss = '';
		return $inlineCss;
		break;
		case 'vc_text_separator':
		//title_align, align, color,accent_color,style,border_width,el_width
		if($atts['color'] == 'custom'){
			$color = $atts['accent_color'];
		}else{
			$color = $default_colors[$atts['color']];
		}
		$inlineCss = '

					';
				
		$inlineCss .= $custom_inlinecss['text_separator'];
		return $inlineCss;
		break;
		case 'vc_message':
		$style = $atts['message_box_style'];
		$default_colors = array('info' => array('bg_color'=>'#dff2fe','color'=>'#5e7f96'),'warning' => array('bg_color'=>'#fff4e2','color'=>'#9d8967'),'violet' => array('bg_color'=>'#8d6dc4','color'=>'#8d6dc4'),'pink'=> array('bg_color'=>'#fe6c61','color'=>'#fe6c61'),'peacoc'=> '#4cadc9','mulled_wine'=>'#50485b','vista_blue'=> '#75d69c','chino'=>'#cec2ab','black'=> '#000000','grey'=>'#ebebeb','orange'=> '#f7be68','sky'=>'#5aa1e3','green'=> '#6dab3c','juicy_pink'=>'#f4524d','sandy_brown'=> '#f79468','purple'=>'#b97ebb','white' => '#ffffff');

			switch ($style) {
				case 'standard':
					$msgbox_style = 'color:'.$default_colors[$atts['message_box_color']]['color'].';
				    border-color: '.$default_colors[$atts['message_box_color']]['bg_color'].';
				    background-color: '.$default_colors[$atts['message_box_color']]['bg_color'].';';
					break;
				case 'solid':
					$msgbox_style = 'color:'.$default_colors[$atts['message_box_color']]['color'].';
					    border-color: transparent;
					    background-color: '.$default_colors[$atts['message_box_color']]['bg_color'].';';
					break;
				case 'solid-icon':
					$msgbox_style = 'color: '.$default_colors[$atts['message_box_color']]['color'].';
					    border-color: '.$default_colors[$atts['message_box_color']]['bg_color'].';
					    background-color: transparent;';
					break;
				case 'outline':
					$msgbox_style = 'color: '.$default_colors[$atts['message_box_color']]['color'].';
					    border-color: '.$default_colors[$atts['message_box_color']]['bg_color'].';
					    background-color: transparent;';
					break;
				case '3d':
					$msgbox_style = '
					color:'.$default_colors[$atts['message_box_color']]['color'].';
				    border-color: '.$default_colors[$atts['message_box_color']]['bg_color'].';
				    background-color: '.$default_colors[$atts['message_box_color']]['bg_color'].'1c;
				    box-shadow: 0 5px 0 '.$default_colors[$atts['message_box_color']]['bg_color'].';';
					break;
				default:
					
					break;
			}
			$inlineCss = '
				
				.vc_color-'.$atts['message_box_color'].'.vc_message_box-'.$atts['message_box_style'].' {
				    '.$msgbox_style.'
				}
				.vc_message_box-rounded {
				    border-radius: 5px;
				}
				.vc_message_box {
				    border: 1px solid transparent;
				    display: block;
				    overflow: hidden;
				    margin: 0 0 21.73913043px 0;
				    padding: 1em 1em 1em 4em;
				    position: relative;
				    font-size: 1em;
				    box-sizing: border-box;
				}
				.vc_message_box-icon {
				    bottom: 0;
				    font-size: 1em;
				    font-style: normal;
				    font-weight: 400;
				    left: 0;
				    position: absolute;
				    top: 15px;
				    width: 4em;
				    text-align: center;
				}
				.vc_message_box p{margin:0;}
				.vc_message_box-icon>.fa {
				    font-size: 1.7em;
				    line-height: 1;
				    color:'.$default_colors[$atts['message_box_color']]['color'].';	
				}
				
				.vc_message_box-outline, .vc_message_box-solid-icon {
				    border-width: 2px;
				}
				.vc_message_box-round{
					border-radius:4em;
				}
				.vc_message_box-square{
					border-radius:0px;
				}
				.vc_message_box-rounded {
				    border-radius: 5px;
				}

			';
		return $inlineCss;
		break;

		default:
		
		break;
	}
}