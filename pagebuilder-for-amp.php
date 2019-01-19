<?php
/*
Plugin Name: Page Builder for AMP
Description: This is an AMP Compatibility extension for Pagebuilder like Divi, WpBakery and Elementor Pagebuilder.
Author: AMPforWP Team
Version: 0.8
Author URI: http://ampforwp.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define('AMP_WPBAKERY_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('AMP_WPBAKERY_PLUGIN_DIR_URI', plugin_dir_url(__FILE__));
define('AMP_WPBAKERY_IMAGE_DIR',plugin_dir_url(__FILE__).'assets/images');
define('AMP_WPBAKERY_MAIN_PLUGIN_DIR', plugin_dir_path( __DIR__ ) );
define('AMP_WPBAKERY_VERSION','0.8');
 

// this is the URL our updater / license checker pings. This should be the URL of the site with Page builder for AMP installed
define( 'PB_FOR_AMP_STORE_URL', 'https://accounts.ampforwp.com/' ); // you should use your own CONSTANT name, and be sure to replace it throughout this file

// the name of your product. This should match the download name in Page builder for AMP exactly
define( 'PB_FOR_AMP_ITEM_NAME', 'Page Builder for AMP' );

// the name of the settings page for the license input to be displayed
define( 'PB_FOR_AMP_LICENSE_PAGE', 'pagebuilder-for-amp' );

//Divi Pagebuilder constant
//define( 'AMP_DIVI_PB_VERSION', '1.0.0' );

// the name of the settings page for the license input to be displayed
if(! defined('PB_FOR_AMP_ITEM_FOLDER_NAME')){
    $folderName = basename(__DIR__);
    define( 'PB_FOR_AMP_ITEM_FOLDER_NAME', $folderName );
}
if ( ! function_exists( 'is_plugin_active' ) ) {
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
	require_once AMP_WPBAKERY_PLUGIN_DIR.'amp-vc-pagebuilder.php';
}
$theme = wp_get_theme(); // gets the current theme
if ( is_plugin_active( 'divi-builder/divi-builder.php' ) || 'Divi' == $theme->name || 'Divi' == $theme->parent_theme ) {
	 require_once AMP_WPBAKERY_PLUGIN_DIR.'amp-divi-pagebuilder.php';
}

if ( did_action( 'elementor/loaded' ) ) {

    require_once AMP_WPBAKERY_PLUGIN_DIR.'amp-elementor-pagebuilder.php';
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
    $license_key = trim( get_option( 'amp_ads_license_key' ) );
    $selectedOption = get_option('redux_builder_amp',true);
    $license_key = '';//trim( get_option( 'amp_ads_license_key' ) );
    $pluginItemName = '';
    $pluginItemStoreUrl = '';
    $pluginstatus = '';
    if( isset($selectedOption['amp-license']) && "" != $selectedOption['amp-license'] && isset($selectedOption['amp-license'][PB_FOR_AMP_ITEM_FOLDER_NAME])){

       $pluginsDetail = $selectedOption['amp-license'][PB_FOR_AMP_ITEM_FOLDER_NAME];
       $license_key = $pluginsDetail['license'];
       $pluginItemName = $pluginsDetail['item_name'];
       $pluginItemStoreUrl = $pluginsDetail['store_url'];
       $pluginstatus = $pluginsDetail['status'];
    }
    
    // setup the updater
    $edd_updater = new PB_FOR_AMP_EDD_SL_Plugin_Updater( PB_FOR_AMP_STORE_URL, __FILE__, array(
            'version'   => AMP_WPBAKERY_VERSION,                // current version number
            'license'   => $license_key,                        // license key (used get_option above to retrieve from DB)
           'license_status'=>$pluginstatus,
            'item_name' => PB_FOR_AMP_ITEM_NAME,          // name of this plugin
            'author'    => 'Mohammed Kaludi',                   // author of this plugin
            'beta'      => false,
        )
    );
}
add_action( 'admin_init', 'pb_for_amp_plugin_updater', 0 );

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

//***************************//
// Updater code ends here //
//**************************//