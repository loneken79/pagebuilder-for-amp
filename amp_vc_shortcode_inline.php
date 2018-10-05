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

			$inlineCss = '.flip-box {
				  background-color: transparent;
				  width: 300px;
				  height: 200px;
				  border: 1px solid #f1f1f1;
				  perspective: 1000px;
				}
				.flip-box-inner {
				  position: relative;
				  width: 100%;
				  height: 100%;
				  text-align: center;
				  transition: transform 0.8s;
				  transform-style: preserve-3d;
				}
				.flip-box:hover .flip-box-inner {
				  transform: rotateY(180deg);
				}
				.flip-box-front, .flip-box-back {
				  position: absolute;
				  width: 100%;
				  height: 100%;
				  backface-visibility: hidden;
				}
				.flip-box-front {
				  background-color: #bbb;
				  color: black;
				  background-image: url('.$image_src.');
				}
				.flip-box-back {
				  background-color: dodgerblue;
				  color: white;
				  transform: rotateY(180deg);
				}';
			return $inlineCss;
		break;
		default:
		
		break;
	}
}