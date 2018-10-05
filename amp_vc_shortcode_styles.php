<?php 
global $amp_vc_elements_atts;
foreach ( $amp_vc_elements_atts as $slug => $atts) {
	switch ($slug) {
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
			echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		case 'vc_cta':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-cta.css';
			//echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		case 'vc_icon':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-icon.css';
			//echo amp_vc_shortcode_inline_css( $slug, $atts );
		break;
		case 'vc_message':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-message.css';
		break;
		case 'vc_separator':
			include_once AMP_WPBAKERY_PLUGIN_DIR.'assets/css/amp-vc-separator.css';
		break;
		default:
		break;
	}
}