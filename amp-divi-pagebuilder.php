<?php
class AMP_Divi_Pagebuidler {

    public function __construct()
    {
        $this->load_dependencies();
        $this->define_public_hooks();
    }
    
    private function load_dependencies(){
        add_filter('amp_post_template_data', [$this, 'amp_divi_pagebuilder_scripts'], 20);
        add_filter('amp_content_sanitizers',[$this,'ampforwp_add_divi_blacklist'], 85);
        add_action('init', [$this, 'amp_divi_pagebuilder_plugin_init'], 25);
        add_action('amp_post_template_head', [$this, 'amp_divi_pagebuilder_canonical_link']);
        
        add_action('wp_ajax_divi_contact_form_submission',[$this,'divi_contact_form_submission']);
        add_action('wp_ajax_nopriv_divi_contact_form_submission',[$this,'divi_contact_form_submission']);
    }
    public function divi_contact_form_submission(){
        if(isset($_POST['_wpnonce-et-pb-contact-form-submitted']) && $_POST['_wpnonce-et-pb-contact-form-submitted'] != ''){
            echo "Thanks for conatacting us.";
        } ;
        wp_die();
    }
    public function amp_divi_pagebuilder_plugin_init(){
        define( 'AMPFORWP_AMP__DIR__', AMP__DIR__);
        require_once AMP_WPBAKERY_PLUGIN_DIR .'includes/class-amp-divi-blacklist.php';
    } 

    public function ampforwp_add_divi_blacklist($data){
    global $redux_builder_amp;

        unset($data['AMP_Blacklist_Sanitizer']);
        unset($data['AMPFORWP_Blacklist_Sanitizer']);
        $data[ 'AMPFORWP_DIVI_Blacklist' ] = array();
       
        return $data;
    }
    public function amp_divi_pagebuilder_scripts($data){
        if ( class_exists( 'ET_Builder_Module' ) ) {

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
            $data['amp_component_scripts']['amp-date-countdown'] = 'https://cdn.ampproject.org/v0/amp-date-countdown-0.1.js';
            $data['amp_component_scripts']['amp-mustache'] = 'https://cdn.ampproject.org/v0/amp-mustache-0.2.js';
            $data['amp_component_scripts']['amp-form'] = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
        }
        return $data;

    }
   
    public function amp_divi_pagebuilder_canonical_link(){
        if ( class_exists( 'ET_Builder_Module' ) ) { ?>
        <link rel='stylesheet' id='font-awesome-css'  href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=4.6.3' type='text/css' media='all' />
        <?php }
    }
    private function define_public_hooks() {
        add_action( 'et_builder_ready', [$this,'amp_divi_pagebuidler_override'] );
    }
    public function amp_divi_pagebuidler_override(){
        if ( (function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint()) ||  (function_exists( 'is_wp_amp' ) && is_wp_amp()) || (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) ) {
        
            if ( class_exists( 'ET_Builder_Module' ) ) {
                foreach(glob(AMP_WPBAKERY_PLUGIN_DIR.'divi/builder/*.php') as $file){
                    require_once $file;
                }
            
            }
        }
    }
    
}

new AMP_Divi_Pagebuidler();
