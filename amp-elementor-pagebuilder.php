<?php 
final class Elementor_For_Amp {

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	const MINIMUM_PHP_VERSION = '5.0';

	public function __construct() {
		
		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}
	
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}
		add_action('amp_post_template_head', [$this, 'amp_elementor_pagebuilder_canonical_link']);
		add_action('amp_post_template_css', [$this, 'amp_elementor_pagebuilder_global_styles']);
		add_filter('amp_post_template_data', [$this, 'amp_elementor_pagebuilder_scripts'], 20);
		require_once( AMP_WPBAKERY_PLUGIN_DIR.'load-elementor-widgets.php' );
		
	}

	public function amp_elementor_pagebuilder_global_styles(){
		include_once AMP_WPBAKERY_PLUGIN_DIR.'amp-elementor-global-styles.php';
		ampforwp_elementor_global_styles();
	}
	public function amp_elementor_pagebuilder_scripts($data){
        
            $data['amp_component_scripts']['amp-selector'] = 'https://cdn.ampproject.org/v0/amp-selector-0.1.js';
            $data['amp_component_scripts']['amp-bind'] = 'https://cdn.ampproject.org/v0/amp-bind-0.1.js';
            $data['amp_component_scripts']['amp-accordion'] = 'https://cdn.ampproject.org/v0/amp-accordion-0.1.js';
            $data['amp_component_scripts']['amp-lightbox'] = 'https://cdn.ampproject.org/v0/amp-lightbox-0.1.js';
            $data['amp_component_scripts']['amp-audio'] = 'https://cdn.ampproject.org/v0/amp-audio-0.1.js';
            $data['amp_component_scripts']['amp-video'] = 'https://cdn.ampproject.org/v0/amp-video-0.1.js';
            $data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
            $data['amp_component_scripts']['amp-image-lightbox'] = 'https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js';
           
            $data['amp_component_scripts']['amp-fit-text'] = 'https://cdn.ampproject.org/v0/amp-fit-text-0.1.js';
            $data['amp_component_scripts']['amp-youtube'] = 'https://cdn.ampproject.org/v0/amp-youtube-0.1.js';
            $data['amp_component_scripts']['amp-lightbox-gallery'] = 'https://cdn.ampproject.org/v0/amp-lightbox-gallery-0.1.js';
            $data['amp_component_scripts']['amp-mustache'] = 'https://cdn.ampproject.org/v0/amp-mustache-0.2.js';
            $data['amp_component_scripts']['amp-form'] = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
            
        return $data;
    }

    public function amp_elementor_pagebuilder_canonical_link(){
        ?>
        <link rel='stylesheet' id='font-awesome-css'  href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=4.6.3' type='text/css' media='all' />
        <?php
    }
    
    public function amp_elementor_enqueue_styles(){
    	$suffix = Utils::is_script_debug() ? '' : '.min';

		$direction_suffix = is_rtl() ? '-rtl' : '';

		wp_register_style(
			'font-awesome',
			ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/font-awesome' . $suffix . '.css',
			[],
			'4.7.0'
		);
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-hello-world' ),
			'<strong>' . esc_html__( 'AMP Elementor Pagebuilder', 'elementor-hello-world' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-hello-world' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-hello-world' ),
			'<strong>' . esc_html__( 'AMP Elementor Pagebuilder', 'elementor-hello-world' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-hello-world' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-hello-world' ),
			'<strong>' . esc_html__( 'AMP Elementor Pagebuilder', 'elementor-hello-world' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-hello-world' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate Elementor_For_Amp.
new Elementor_For_Amp();


add_action('pre_amp_render_post' ,'ampforwp_pdf_embedder_compatibility' );
function ampforwp_pdf_embedder_compatibility(){
	if( ( function_exists('ampforwp_is_amp_endpoint')  && ampforwp_is_amp_endpoint() ) || ( function_exists('is_amp_endpoint')  && is_amp_endpoint() ) ) {
            remove_shortcode('pdf-embedder');
            add_shortcode('pdf-embedder','ampforwp_pdfemb_shortcode_display_pdf');
    }
}

function ampforwp_pdfemb_shortcode_display_pdf($atts, $content=null) {
	$atts = apply_filters('pdfemb_filter_shortcode_attrs', $atts);

	if (!isset($atts['url'])) {
		return '<b>PDF Embedder requires a url attribute</b>';
	}
	$url = $atts['url'];
	add_filter('amp_post_template_data', 'amp_elementor_amp_google_document_embed_scripts', 20);

	return '<amp-google-document-embed  src="'.$url.'" width="8.5"  height="11"
      layout="responsive"></amp-google-document-embed>';
}

function amp_elementor_amp_google_document_embed_scripts($data){
	$data['amp_component_scripts']['amp-google-document-embed'] = 'https://cdn.ampproject.org/v0/amp-google-document-embed-0.1.js';
	return $data;
}



