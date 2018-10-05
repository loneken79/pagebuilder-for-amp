<?php
/*
Plugin Name: AMP WpBakery Pro
Description: This is an extension for WpBakery Plugin
Author: AMPforWP Team
Version: 1.8.5
Author URI: http://ampforwp.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define('AMP_WPBAKERY_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('AMP_WPBAKERY_PLUGIN_DIR_URI', plugin_dir_url(__FILE__));
define('AMP_WPBAKERY_IMAGE_DIR',plugin_dir_url(__FILE__).'assets/images');
define('AMP_WPBAKERY_MAIN_PLUGIN_DIR', plugin_dir_path( __DIR__ ) );
define('AMP_WPBAKERY_VERSION','1.0');

require_once AMP_WPBAKERY_PLUGIN_DIR.'amp_vc_shortcode_inline.php';

class AmpWpbakeryPro{

	public function __construct() {
		add_action( 'vc_before_init', [$this, 'vc_before_init_actions'] );
		add_filter('amp_post_template_data', [$this,'amp_vc_shortcode_scripts'], 20);
		add_filter('amp_post_template_css', [$this,'amp_vc_custom_styles']);
		add_action('amp_post_template_head', [$this,'amp_vc_shortcodes_canonical_link']);
	}
	
	public function vc_before_init_actions() {
	     
	    // Link your VC elements's folder
	    if( function_exists('vc_set_shortcodes_templates_dir') ){ 
	     	$amp_vc_template_dir = AMP_WPBAKERY_PLUGIN_DIR . 'vc_templates';
			vc_set_shortcodes_templates_dir( $amp_vc_template_dir );
	    }
	}

	public function amp_vc_custom_styles(){
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			require_once AMP_WPBAKERY_PLUGIN_DIR.'amp_vc_shortcode_styles.php';
		}
	}

	public function amp_vc_shortcodes_canonical_link(){
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {	?>
	<link rel='stylesheet' id='font-awesome-css'  href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=4.6.3' type='text/css' media='all' />
		<?php }
	}
	public function amp_vc_shortcode_scripts($data){
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			
			$data['amp_component_scripts']['amp-selector'] = 'https://cdn.ampproject.org/v0/amp-selector-0.1.js';
			$data['amp_component_scripts']['amp-bind'] = 'https://cdn.ampproject.org/v0/amp-bind-0.1.js';
			$data['amp_component_scripts']['amp-accordion'] = 'https://cdn.ampproject.org/v0/amp-accordion-0.1.js';
			$data['amp_component_scripts']['amp-lightbox'] = 'https://cdn.ampproject.org/v0/amp-lightbox-0.1.js';
			$data['amp_component_scripts']['amp-audio'] = 'https://cdn.ampproject.org/v0/amp-audio-0.1.js';
			$data['amp_component_scripts']['amp-video'] = 'https://cdn.ampproject.org/v0/amp-video-0.1.js';
			$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			$data['amp_component_scripts']['amp-image-lightbox'] = 'https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js';
			$data['amp_component_scripts']['amp-carousel'] = 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js';
			$data['amp_component_scripts']['amp-fit-text'] = 'https://cdn.ampproject.org/v0/amp-fit-text-0.1.js';
			$data['amp_component_scripts']['amp-youtube'] = 'https://cdn.ampproject.org/v0/amp-youtube-0.1.js';
			$data['amp_component_scripts']['amp-lightbox-gallery'] = 'https://cdn.ampproject.org/v0/amp-lightbox-gallery-0.1.js';
				
		}
		return $data;
	}
			
}

add_action( 'plugins_loaded', 'amp_vc_shortcode_override' );
function amp_vc_shortcode_override(){
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
  	$explode_path = explode('/', $url_path);
	if ( 'amp' === end( $explode_path) ){
		global $ampwpbakery;
		$ampwpbakery = new AmpWpbakeryPro();
	}
}
