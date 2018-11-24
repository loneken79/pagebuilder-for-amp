<?php 
global $amp_vc_elements_atts;
foreach ( $amp_vc_elements_atts as $slug => $atts) {
	switch ($slug) {
		case 'vc_column_text':
			echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		case 'vc_tta_tabs':
				include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-tabs.css';
		break;
		case 'vc_tta_accordion':
				include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-accordion.css';
		break;
		case 'vc_btn':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-button.css';
			//echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		case 'vc_hoverbox':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-hoverbox.css';
			echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		case 'vc_cta':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-cta.css';
			//echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		case 'vc_icon':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-icon.css';
			echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		case 'vc_message':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-message.css';
		break;
		case 'vc_separator':
			//include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-separator.css';
			echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		case 'vc_text_separator':
			echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		case 'vc_toggle':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-toggle.css';
		break;
		case 'vc_single_image':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-single-image.css';
		break;
		case 'vc_video':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-video.css';
		break;
		case 'vc_gmaps':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-gmaps.css';
		break;
		case 'vc_basic_grid':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-posts-grid.css';
		break;
		case 'vc_progress_bar':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-progress-bar.css';
			echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		default:
		break;
	}
}