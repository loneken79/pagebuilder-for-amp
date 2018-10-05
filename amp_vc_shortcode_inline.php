<?php

function amp_vc_shortcode_inline_css($slug='',$value = ''){
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
		break;
		default:
		
		break;
	}
}