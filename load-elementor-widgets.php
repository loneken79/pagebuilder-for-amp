<?php
namespace ElementorForAmp;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */

class Amp_Elementor_Widgets_Loading {
	
	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function widget_scripts() {
		wp_register_script( 'elementor-hello-world', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
	}
	
	private function include_widgets_files() {

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
	}
}

// Instantiate Plugin Class
Amp_Elementor_Widgets_Loading::instance();
