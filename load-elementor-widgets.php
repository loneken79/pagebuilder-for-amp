<?php
namespace ElementorForAmp;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
global $amp_elemetor_custom_css;
class Amp_Elementor_Widgets_Loading {
	
	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function load_global_styles() {
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
	}
	public function amp_elementor_widget_styles(){
		$common_css = '/*** Common Css **/
		
		@media (min-width: 768px){
		  .elementor-column.elementor-col-10, .elementor-column[data-col="10"] {
		    width: 10%; }
		  .elementor-column.elementor-col-11, .elementor-column[data-col="11"] {
		    width: 11.111%; }
		  .elementor-column.elementor-col-12, .elementor-column[data-col="12"] {
		    width: 12.5%; }
		  .elementor-column.elementor-col-14, .elementor-column[data-col="14"] {
		    width: 14.285%; }
		  .elementor-column.elementor-col-16, .elementor-column[data-col="16"] {
		    width: 16.666%; }
		  .elementor-column.elementor-col-20, .elementor-column[data-col="20"] {
		    width: 20%; }
		  .elementor-column.elementor-col-25, .elementor-column[data-col="25"] {
		    width: 25%; }
		  .elementor-column.elementor-col-30, .elementor-column[data-col="30"] {
		    width: 30%; }
		  .elementor-column.elementor-col-33, .elementor-column[data-col="33"] {
		    width: 33.333%; }
		  .elementor-column.elementor-col-40, .elementor-column[data-col="40"] {
		    width: 40%; }
		  .elementor-column.elementor-col-50, .elementor-column[data-col="50"] {
		    width: 50%; }
		  .elementor-column.elementor-col-60, .elementor-column[data-col="60"] {
		    width: 60%; }
		  .elementor-column.elementor-col-66, .elementor-column[data-col="66"] {
		    width: 66.666%; }
		  .elementor-column.elementor-col-70, .elementor-column[data-col="70"] {
		    width: 70%; }
		  .elementor-column.elementor-col-75, .elementor-column[data-col="75"] {
		    width: 75%; }
		  .elementor-column.elementor-col-80, .elementor-column[data-col="80"] {
		    width: 80%; }
		  .elementor-column.elementor-col-83, .elementor-column[data-col="83"] {
		    width: 83.333%; }
		  .elementor-column.elementor-col-90, .elementor-column[data-col="90"] {
		    width: 90%; }
		  .elementor-column.elementor-col-100, .elementor-column[data-col="100"] {
		    width: 100%; }
		}
		.elementor-column-gap-default>.elementor-row>.elementor-column>.elementor-element-populated {
		    padding: 10px;
		}
		.elementor-row{
		    width:100%;
		    display:flex;
		}
		.elementor-column-wrap, .elementor-widget-wrap {
		    width: 100%;
		    position: relative;
		}
		@media (max-width: 767px){
			.elementor-row {flex-wrap: wrap;}
			.elementor-column {width: 100%;}
		}';
		if(function_exists('wp_upload_dir')){
			$elementorGlobalCssPath = wp_upload_dir()['basedir']."/elementor/css/global.css";
			$elementorCssPath = wp_upload_dir()['basedir']."/elementor/css/post-".get_the_ID().".css";
			if(file_exists($elementorGlobalCssPath)){
				//$common_css .= file_get_contents($elementorGlobalCssPath);
			}
			if(file_exists($elementorCssPath)){
				//$common_css .= file_get_contents($elementorCssPath);
			}
		}
		global $amp_elemetor_custom_css;
		if(is_array($amp_elemetor_custom_css)){
			foreach ($amp_elemetor_custom_css as $key => $cssHeadingValue) {
				if(is_array($cssHeadingValue)){
					foreach ($cssHeadingValue as $key => $cssValue) {
						echo $cssValue;
					}
				}
			}
		}
		echo $common_css;
	}
	private function include_elements_files(){
		require_once( AMP_WPBAKERY_PLUGIN_DIR . '/elements/amp-column.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . '/elements/amp-section.php' );
	}
	private function include_widgets_files() {
		$this->load_global_styles();
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-heading.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-image.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-button.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-text-editor.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-spacer.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-divider.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-accordion.php' );
		//require_once( AMP_WPBAKERY_PLUGIN_DIR . '/widgets/amp-video.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-icon.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-image-box.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-icon-box.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-image-gallery.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-image-carousel.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-icon-list.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-counter.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-progress.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-testimonial.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-tabs.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-toggle.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-google-maps.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-social-icons.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-alert.php' );
		//require_once( AMP_WPBAKERY_PLUGIN_DIR . '/widgets/amp-audio.php' );
		
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-shortcode.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-html.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-menu-anchor.php' );
		require_once( AMP_WPBAKERY_PLUGIN_DIR . 'widgets/amp-sidebar.php' );
	}
	public function register_elementor_elements($elements_manager){
		if ( (function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint()) ||  (function_exists( 'is_wp_amp' ) && is_wp_amp()) || (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) ) {
			$this->include_elements_files();
			\Elementor\Plugin::instance()->elements_manager->register_element_type( new Elements\Amp_Section() );
			\Elementor\Plugin::instance()->elements_manager->register_element_type( new Elements\Amp_Column() );
		}
	}
	public function register_widgets($widgets_manager) {
		
		// Register Widgets
		if ( (function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint()) ||  (function_exists( 'is_wp_amp' ) && is_wp_amp()) || (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) ) {

			$this->include_widgets_files();
			

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Heading() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Image() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Button() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Text_Editor() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Spacer() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Divider() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Accordion() );
			//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Video() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Icon() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Image_Box() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Icon_Box() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Image_Gallery() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Image_Carousel() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Icon_List() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Counter() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Progress() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Testimonial() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Tabs() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Toggle() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Google_Maps() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Social_Icons() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Alert() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Shortcode() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Html() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Menu_Anchor() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Sidebar() );
			//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Amp_Audio() );
		}

	}

	public function __construct() {

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ], 999999 );
		add_action( 'elementor/elements/elements_registered', [ $this, 'register_elementor_elements' ], 999999 );
	}
}

// Instantiate Plugin Class
Amp_Elementor_Widgets_Loading::instance();
