<?php
/*
Plugin Name: Page Builder For AMP
Description: This is an extension for WpBakery Plugin
Author: AMPforWP Team
Version: 0.4
Author URI: http://ampforwp.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define('AMP_WPBAKERY_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('AMP_WPBAKERY_PLUGIN_DIR_URI', plugin_dir_url(__FILE__));
define('AMP_WPBAKERY_IMAGE_DIR',plugin_dir_url(__FILE__).'assets/images');
define('AMP_WPBAKERY_MAIN_PLUGIN_DIR', plugin_dir_path( __DIR__ ) );
define('AMP_WPBAKERY_VERSION','0.4');
 

// this is the URL our updater / license checker pings. This should be the URL of the site with Page builder for AMP installed
define( 'PB_FOR_AMP_STORE_URL', 'https://accounts.ampforwp.com/' ); // you should use your own CONSTANT name, and be sure to replace it throughout this file

// the name of your product. This should match the download name in Page builder for AMP exactly
define( 'PB_FOR_AMP_ITEM_NAME', 'Page Builder for AMP' );

// the name of the settings page for the license input to be displayed
define( 'PB_FOR_AMP_LICENSE_PAGE', 'pagebuilder-for-amp' );

// the name of the settings page for the license input to be displayed
if(! defined('PB_FOR_AMP_ITEM_FOLDER_NAME')){
    $folderName = basename(__DIR__);
    define( 'PB_FOR_AMP_ITEM_FOLDER_NAME', $folderName );
}
 


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

//***************************//
// Updater code Starts here //
//**************************//
  /*
  Plugin Update Method
 */
require_once dirname( __FILE__ ) . '/updater/EDD_SL_Plugin_Updater.php';

// Check for updates
function pb_for_amp_plugin_updater() {

    // retrieve our license key from the DB
    //$license_key = trim( get_option( 'amp_ads_license_key' ) );
    $selectedOption = get_option('redux_builder_amp',true);
    $license_key = '';//trim( get_option( 'amp_ads_license_key' ) );
    $pluginItemName = '';
    $pluginItemStoreUrl = '';
    $pluginstatus = '';
    /*if( isset($selectedOption['amp-license']) && "" != $selectedOption['amp-license'] && isset($selectedOption['amp-license'][PB_FOR_AMP_ITEM_FOLDER_NAME])){

       $pluginsDetail = $selectedOption['amp-license'][PB_FOR_AMP_ITEM_FOLDER_NAME];
       $license_key = $pluginsDetail['license'];
       $pluginItemName = $pluginsDetail['item_name'];
       $pluginItemStoreUrl = $pluginsDetail['store_url'];
       $pluginstatus = $pluginsDetail['status'];
    }*/
    
    // setup the updater
    $edd_updater = new PB_FOR_AMP_EDD_SL_Plugin_Updater( PB_FOR_AMP_STORE_URL, __FILE__, array(
            'version'   => AMP_WPBAKERY_VERSION,                // current version number
/*            'license'   => $license_key,                        // license key (used get_option above to retrieve from DB)
*///            'license_status'=>$pluginstatus,
            'item_name' => PB_FOR_AMP_ITEM_NAME,          // name of this plugin
            'author'    => 'Mohammed Kaludi',                   // author of this plugin
            'beta'      => false,
        )
    );
}
add_action( 'admin_init', 'pb_for_amp_plugin_updater', 0 );
/*
// Notice to enter license key once activate the plugin

$path = plugin_basename( __FILE__ );
    add_action("after_plugin_row_{$path}", function( $plugin_file, $plugin_data, $status ) {
        global $redux_builder_amp;
        if(! defined('PB_FOR_AMP_ITEM_FOLDER_NAME')){
        $folderName = basename(__DIR__);
            define( 'PB_FOR_AMP_ITEM_FOLDER_NAME', $folderName );
        }
        $pluginsDetail = $redux_builder_amp['amp-license'][PB_FOR_AMP_ITEM_FOLDER_NAME];
        $pluginstatus = $pluginsDetail['status'];

       if(empty($redux_builder_amp['amp-license'][PB_FOR_AMP_ITEM_FOLDER_NAME]['license'])){
            echo "<tr class='active'><td>&nbsp;</td><td colspan='2'><a href='".esc_url(  self_admin_url( 'admin.php?page=amp_options&tabid=opt-go-premium' )  )."'>Please enter the license key</a> to get the <strong>latest features</strong> and <strong>stable updates</strong></td></tr>";
               }elseif($pluginstatus=="valid"){
                $update_cache = get_site_transient( 'update_plugins' );
            $update_cache = is_object( $update_cache ) ? $update_cache : new stdClass();
            if(isset($update_cache->response[ PB_FOR_AMP_ITEM_FOLDER_NAME ]) 
                && empty($update_cache->response[ PB_FOR_AMP_ITEM_FOLDER_NAME ]->download_link) 
             ){
               unset($update_cache->response[ PB_FOR_AMP_ITEM_FOLDER_NAME ]);
            }
            set_site_transient( 'update_plugins', $update_cache );
            
        }
    }, 10, 3 );
*/
//***************************//
// Updater code ends here //
//**************************//