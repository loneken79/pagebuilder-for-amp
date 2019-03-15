<?php
if ( ! defined( 'ABSPATH' ) ) exit;
require_once AMP_WPBAKERY_PLUGIN_DIR.'/parser/index.php';

class AmpWpbakeryPro{

	public function __construct() {
		add_filter('amp_post_template_css', [$this,'amp_vc_custom_styles'],11);
		add_filter('ampforwp_body_class', [$this,'ampforwp_body_class_for_vc'],11);
		add_filter('amp_post_template_head', [$this,'ampforwp_fontawesome_for_vc'],11);

		//add_action( 'parse_query', [$this,'poly_parse_query'], 6 );
	}
	function poly_parse_query($query){
		global $wp_query;
		if(!function_exists('ampforwp_is_front_page') || !function_exists('ampforwp_is_home') || !function_exists('ampforwp_is_blog')){
			return ;
		}
		/* if(is_main_query()){
			print_r($query);die;
		} */
		if(!ampforwp_is_front_page() && !ampforwp_is_home() && !ampforwp_is_blog() && !is_singular() && !is_archive()){
			//$query->is_home = true;
		}
	}
	
	/**
	* create vc font support
	**/
	public function ampforwp_fontawesome_for_vc(){
		global $post, $redux_builder_amp;
		$postID = $post->ID;
		if (function_exists('ampforwp_is_front_page') && ampforwp_is_front_page() ) {
			$postID = ampforwp_get_frontpage_id();
		}
		$vc_enabled = get_post_meta($postID, '_wpb_vc_js_status');
		if($vc_enabled && $redux_builder_amp['vc_fontawesome_support']==1){
			echo '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">';
		}
	}
	public function ampforwp_body_class_for_vc($classes){
		global $post;
		$postID = $post->ID;
		if (function_exists('ampforwp_is_front_page') && ampforwp_is_front_page() ) {
			$postID = ampforwp_get_frontpage_id();
		}
		$vc_enabled = get_post_meta($postID, '_wpb_vc_js_status');
		if($vc_enabled){
			$classes[] = 'amp_vc';
		}
		return $classes;
	}
	public function vc_before_init_actions() {
	     
	    // Link your VC elements's folder
	    if( function_exists('vc_set_shortcodes_templates_dir') ){ 
	     	$amp_vc_template_dir = AMP_WPBAKERY_PLUGIN_DIR . 'vc_templates';
			vc_set_shortcodes_templates_dir( $amp_vc_template_dir );
	    }
	}

	public function amp_vc_custom_styles(){
		global $post, $wp_styles, $redux_builder_amp;
		$postID = $post->ID;
		 if ( ampforwp_is_front_page() ) {
			$postID = ampforwp_get_frontpage_id();
		}
		if(function_exists('vc_path_dir')){
			require_once vc_path_dir( 'PARAMS_DIR', 'vc_grid_item/class-vc-grid-item.php' );
		}
		//require_once AMP_WPBAKERY_PLUGIN_DIR.'amp_vc_shortcode_styles.php';
		$css = '';
		$srcs = array();
		foreach( $wp_styles->queue as $style ) :
			$src = $wp_styles->registered[$style]->src;
			if($style=='animate-css' || filter_var($src, FILTER_VALIDATE_URL) === FALSE){
				continue;
			}
			$srcs[$style] = $src;
		endforeach;

		$update_css = $redux_builder_amp['vcCssKeys'];
		$csslinks = explode(",", $update_css);
		$csslinks = array_filter($csslinks);
		$srcs = array_merge($srcs, $csslinks);
		$srcs['theme_style'] = get_stylesheet_uri();
		
		if(is_array($srcs) && count($srcs)){
			foreach ($srcs as $key => $valuesrc) {
				$valuesrc = trim($valuesrc);
				if( filter_var($valuesrc, FILTER_VALIDATE_URL) === FALSE ){
					continue;
				}
				$cssData = '';
				$response = wp_remote_get( $valuesrc );
				
				if ( wp_remote_retrieve_response_code($response) == 200 && is_array( $response ) ) {
				  $header = wp_remote_retrieve_headers($response); // array of http header lines
				  $cssData =  wp_remote_retrieve_body($response); // use the content
				}
		  		$css .= preg_replace("/\/\*(.*?)\*\//si", "", $cssData);
			}
		}
		echo $css;
		
		//Post Editor global CSS
		$postCutomCss =  get_post_meta( $postID, '_wpb_post_custom_css', true );
		echo strip_tags( $postCutomCss );
		
		//shortcode specific css
		$shortcodes_custom_css = get_post_meta( $postID, '_wpb_shortcodes_custom_css', true );
		echo $shortcodes_custom_css;
		$shortcodes_custom_css = visual_composer()->parseShortcodesCustomCss( vc_frontend_editor()->getTemplateContent() );
		if ( ! empty( $shortcodes_custom_css ) ) {
			$shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
			echo $shortcodes_custom_css;
		}
		
		if ( preg_match( '/^\d+$/', $postID ) ) {
			$shortcodes_custom_css = get_post_meta( $postID, '_wpb_shortcodes_custom_css', true );
		} elseif (method_exists('Vc_Grid_Item', 'predefinedTemplate') && false !== ( $predefined_template = Vc_Grid_Item::predefinedTemplate( $postID ) ) ) {
			$shortcodes_custom_css = visual_composer()->parseShortcodesCustomCss( $predefined_template['template'] );
		}
		if ( ! empty( $shortcodes_custom_css ) ) {
			$shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
			echo $shortcodes_custom_css;
			
		}
		
		//amp custom Css
		$update_custom = $redux_builder_amp['vcCss-custom'];
		echo $update_custom;  
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
	if(is_admin()){
		new AmpVCAdminSettings();
	}else{
		$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
	  	$explode_path = explode('/', $url_path);
		if ( 'amp' === end( $explode_path) ){
			global $ampwpbakery;
			$ampwpbakery = new AmpWpbakeryPro();
		}
	}
}



/**
 * Admin settings
 **/
class AmpVCAdminSettings{
	public function __construct() {
		add_filter("redux/options/redux_builder_amp/sections", array($this,'ampforwp_settings_vc_settings'));
	}

	public function ampforwp_settings_vc_settings($sections){
		 $sections[] = array(
            'title'      => esc_html__( 'AMP WPBakery', 'accelerated-mobile-pages' ),
            'icon'       => 'el el-forward',
            'subsection' => false,
            'id'         => 'opt-amp-pagebuilder-wpbakery',
            'fields'     => $this->amp_wpbakery_fields(),
                        );
        return $sections;
	}

	public function amp_wpbakery_fields(){
		$contents[] = array(
                        'id'       => 'vcCssKeys',
                        'type'     => 'textarea',
                        'title'    => esc_html__('Enter css url', 'accelerated-mobile-pages'),
                        'subtitle'  => esc_html__('Add your css url in comma saperated', 'accelerated-mobile-pages'),
                        'default'  => '',
                        'desc'      => esc_html__( 'Add your css url in comma saperated', 'accelerated-mobile-pages' ),
                    );
		$contents[] = array(
                        'id'       => 'vcCss-custom',
                        'type'     => 'textarea',
                        'title'    => esc_html__('Enter custom css', 'accelerated-mobile-pages'),
                        'subtitle'  => esc_html__('Add your custom css code', 'accelerated-mobile-pages'),
                        'default'  => '',
                        'desc'      => esc_html__( 'Add your custom css code', 'accelerated-mobile-pages' ),
                    );

		$contents[] = array(
                        'id'       => 'vc_fontawesome_support',
                        'type'     => 'switch',
                        'title'    => esc_html__('Load fontawesome', 'accelerated-mobile-pages'),
                        'subtitle'  => esc_html__('Increase the performance with compression mode', 'accelerated-mobile-pages'),
                        'default'  => 0,
                        'true'      => 'Enabled',
                        'false'     => 'Disabled',
                    );
		return $contents;
	}
}