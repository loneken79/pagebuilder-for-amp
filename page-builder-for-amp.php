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

class AmpWpbakeryPro{

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		register_activation_hook(  __FILE__ ,[ 'AmpWpbakeryPro', 'amp_wpbakery_activation_hook']  );
		add_action( 'vc_before_init', [$this, 'vc_before_init_actions'] );
		//add_action( 'vc_after_init', [$this, 'vc_after_init_actions'] );
	}
	public function amp_wpbakery_activation_hook(){
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

		}
	}
	public function init(){
		
	}
	public function vc_after_init_actions(){
		// // Remove Params
	 //    if( function_exists('vc_remove_param') ){ 
	 //        vc_remove_param( 'vc_column_text', 'css_animation' ); 
	 //        vc_remove_param( 'vc_column_text', 'el_class' ); 
	 //    }
		// // Add Params
	 //    $vc_column_text_new_params = array(
	         
	 //        // Example
	 //        array(
	 //            'type' => 'textfield',
	 //            'holder' => 'h3',
	 //            'class' => 'class-name',
	 //            'heading' => __( 'Field Title', 'text-domain' ),
	 //            'param_name' => 'example',
	 //            'value' => __( 'Default value', 'text-domain' ),
	 //            'description' => __( 'Field Description', 'text-domain' ),
	 //            'admin_label' => true,
	 //            'dependency' => '',
	 //            'weight' => 0,
	 //            'group' => 'Custom Group',
	 //        ),      
	     
	 //    );
     
  //   	vc_add_params( 'vc_column_text', $vc_column_text_new_params ); 
	}
	public function vc_before_init_actions() {
	     
	    // Link your VC elements's folder
	    if( function_exists('vc_set_shortcodes_templates_dir') ){ 
	     	$amp_vc_template_dir = AMP_WPBAKERY_PLUGIN_DIR . 'vc_templates';
			vc_set_shortcodes_templates_dir( $amp_vc_template_dir );
	    }
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
require_once AMP_WPBAKERY_PLUGIN_DIR.'amp_vc_shortcode_inline.php';

add_filter('amp_post_template_css','amp_vc_custom_styles');
function amp_vc_custom_styles(){
	
	if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
		require_once AMP_WPBAKERY_PLUGIN_DIR.'amp_vc_shortcode_styles.php';
	}
}
add_action('amp_post_template_head', 'amp_vc_shortcodes_canonical_link');
function amp_vc_shortcodes_canonical_link(){
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
?>
<link rel='stylesheet' id='font-awesome-css'  href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=4.6.3' type='text/css' media='all' />
	<?php
	}
}
add_filter('amp_post_template_data', 'amp_vc_shortcode_scripts', 20);
function amp_vc_shortcode_scripts($data){
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
	//global $amp_su_widget_data;
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
		// foreach ( $amp_su_widget_data as $id => $attributes ) {
		// 	if($id == 'document'){
		// 		$data['amp_component_scripts']['amp-google-document-embed'] = 'https://cdn.ampproject.org/v0/amp-google-document-embed-0.1.js';
		// 	}
		// }
	}
	return $data;
}
