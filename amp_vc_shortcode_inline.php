<?php

function amp_vc_shortcode_inline_css($slug='',$atts = ''){
	$inlineCss = '';
	switch ($slug) {
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
		$inlineCss = '';
		return $inlineCss;
		break;
		case 'vc_separator':
		//color,align,accent_color,style,border_width,el_width
			$inlineCss = '';
		return $inlineCss;
		break;
		case 'vc_btn':
		//style,gradient_color_1,gradient_color_2,gradient_custom_color_1,gradient_custom_color_2,gradient_text_color,custom_text,outline_custom_color,outline_custom_hover_background,shape,color,size,align,i_align
		$inlineCss = '';
		return $inlineCss;
		break;
		default:
		
		break;
	}
}