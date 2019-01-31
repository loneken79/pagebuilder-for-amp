<?php
class AMP_Divi_Pagebuidler {

    public function __construct()
    {
        $this->load_dependencies();
        $this->define_public_hooks();
    }
    
    private function load_dependencies(){
        add_filter('amp_content_sanitizers',[$this,'ampforwp_add_divi_blacklist'], 85);
        add_action('init', [$this, 'amp_divi_pagebuilder_plugin_init'], 25);
        add_action('amp_post_template_head', [$this, 'amp_divi_pagebuilder_canonical_link']);
        
        add_action('wp_ajax_divi_contact_form_submission',[$this,'divi_contact_form_submission']);
        add_action('wp_ajax_nopriv_divi_contact_form_submission',[$this,'divi_contact_form_submission']);
        add_action('amp_post_template_css',[$this,'ampforwp_divi_standard_css']);
        add_action('wp_ajax_ampforwp_et_pb_submit_subscribe_form',[$this,'ampforwp_et_pb_submit_subscribe_form']);
        add_action('wp_ajax_nopriv_ampforwp_et_pb_submit_subscribe_form',[$this,'ampforwp_et_pb_submit_subscribe_form']);
    }
    public function ampforwp_divi_standard_css(){
        require_once AMP_WPBAKERY_PLUGIN_DIR .'amp-divi-common-styles.php';
        ampforwp_divi_common_styles();
    }
    public function ampforwp_et_pb_submit_subscribe_form(){
        header("access-control-allow-credentials:true");
        header("access-control-allow-headers:Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token");
        header("Access-Control-Allow-Origin:".$_SERVER['HTTP_ORIGIN']);

        $siteUrl = parse_url(  get_site_url() );
        header("AMP-Access-Control-Allow-Source-Origin:".$siteUrl['scheme'] . '://' . $siteUrl['host']);
        header("access-control-expose-headers:AMP-Access-Control-Allow-Source-Origin");
        header("Content-Type:application/json;charset=utf-8");

        et_core_security_check( '', 'et_frontend_nonce' );

        $providers = ET_Core_API_Email_Providers::instance();
        $utils     = ET_Core_Data_Utils::instance();

        $provider_slug = sanitize_text_field( $utils->array_get( $_POST, 'et_pb_signup_provider' ) );
        $account_name  = sanitize_text_field( $utils->array_get( $_POST, 'et_pb_signup_account_name' ) );

        if ( ! $provider = $providers->get( $provider_slug, $account_name, 'builder' ) ) {
            et_core_die( esc_html__( 'Configuration Error: Invalid data.', 'et_builder' ) );
        }

        $args = array(
            'list_id'   => sanitize_text_field( $utils->array_get( $_POST, 'et_pb_signup_list_id' ) ),
            'email'     => sanitize_text_field( $utils->array_get( $_POST, 'et_pb_signup_email' ) ),
            'name'      => sanitize_text_field( $utils->array_get( $_POST, 'et_pb_signup_firstname' ) ),
            'last_name' => sanitize_text_field( $utils->array_get( $_POST, 'et_pb_signup_lastname' ) ),
        );

        if ( ! is_email( $args['email'] ) ) {
            et_core_die( esc_html__( 'Please input a valid email address.', 'et_builder' ) );
        }

        if ( empty( $args['list_id'] ) ) {
            et_core_die( esc_html__( 'Configuration Error: No list has been selected for this form.', 'et_builder' ) );
        }

        et_builder_email_maybe_migrate_accounts();

        $result = $provider->subscribe( $args );

        if ( 'success' === $result ) {
            $message = isset($_POST['et_pb_success_message'])? $_POST['et_pb_success_message']:'Subcription Successful..!';
            $result  = array( 'success' => $result.'! Successful' );
        } else {
            $message = esc_html__( 'Subscription Error: ', 'et_builder' );
            $result  = array( 'error' => $message . $result );
        }

        die( json_encode( $result ) );
    }
    public function divi_contact_form_submission(){
        header("access-control-allow-credentials:true");
        header("access-control-allow-headers:Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token");
        header("Access-Control-Allow-Origin:".$_SERVER['HTTP_ORIGIN']);

        $siteUrl = parse_url(  get_site_url() );
        header("AMP-Access-Control-Allow-Source-Origin:".$siteUrl['scheme'] . '://' . $siteUrl['host']);
        header("access-control-expose-headers:AMP-Access-Control-Allow-Source-Origin");
        header("Content-Type:application/json;charset=utf-8");
        $contact_form_num = $_POST['unique_id'];

        $hidden_form_fields = isset( $_POST['et_pb_contact_email_hidden_fields_' . $contact_form_num] ) ? $_POST['et_pb_contact_email_hidden_fields_' . $contact_form_num] : false;
        $contact_email = '';
        $processed_fields_values = array();

        $nonce_result = isset( $_POST['_wpnonce-et-pb-contact-form-submitted'] ) && wp_verify_nonce( $_POST['_wpnonce-et-pb-contact-form-submitted'], 'et-pb-contact-form-submit' ) ? true : false;

        // check that the form was submitted and et_pb_contactform_validate field is empty to protect from spam
       
        $response = '';
        $et_contact_error = false;
        if ( $nonce_result && isset( $_POST['et_pb_contactform_submit_' . $contact_form_num] ) && empty( $_POST['et_pb_contactform_validate_' . $contact_form_num] ) ) {
            $fields_data_array = '';
            $custom_message = $_POST['custom_msg'];
            if( !empty($_POST['title'])){
                $title = $_POST['title'];
            }else{
                $title = '';
            }
            $success_message = $_POST['success_msg'];
            if( !isset($success_message) || empty($success_message) ){
                $success_message = esc_html__( 'Thanks for contacting us', 'et_builder' );
            }
            
            $email = $_POST['to_email'];
            $ampContactformFields = $_POST['contact_fields'];
            if ( ''!== $ampContactformFields ) {
                //$fields_data_json = str_replace( '\\', '' ,  $amp_current_form_fields );
                $fields_data_json = stripslashes($_POST['contact_fields']);
                $fields_data_array = json_decode( $fields_data_json , true );
                // check whether captcha field is not empty

                if ( 'on' === $captcha && ( ! isset( $_POST['et_pb_contact_captcha_' . $contact_form_num] ) || empty( $_POST['et_pb_contact_captcha_' . $contact_form_num] ) ) ) {
                    $et_error_message = sprintf( '%1$s', esc_html__( 'Make sure you entered the captcha.', 'et_builder' ) );
                    $response = array( "error" => $et_error_message);
                    echo json_encode($response);
                    die;
                }else{
                    $divi_captcha = $_POST['et_pb_contact_captcha_' . $contact_form_num];
                    $captcha_result = $_POST['captcha_result'];
                    $captcha_result = base64_decode($captcha_result);
                    
                    if($captcha_result != $divi_captcha ){
                        $response = array( "error" => "Invalid captcha entered.");
                        echo json_encode($response);
                        die;
                    }
                }

                // check all fields on current form and generate error message if needed
                if ( ! empty( $fields_data_array ) ) {
                    foreach( $fields_data_array as $index => $value ) {

                        // check all the required fields, generate error message if required field is empty
                        if( strpos( $value['field_id'], $contact_form_num)){
                            $field_value = isset( $_POST[ $value['field_id'] ] ) ? trim( $_POST[ $value['field_id'] ] ) : '';
                            if ( 'on' === $value['required_mark'] && empty( $field_value ) && ! is_numeric( $field_value ) ) {
                                $et_error_message .= sprintf( '%1$s', esc_html__( 'Make sure you fill in all required fields.', 'et_builder' ) );
                                $et_contact_error == true;
                                $response = array( "error" => $et_error_message);
                                echo json_encode($response);
                                die;
                            }
                            if ( 'email' === $value['field_type'] && 'on' === $value['required_mark'] && ! empty( $_POST[ $value['field_id'] ] ) ) {
                                $contact_email = sanitize_email( $_POST[ $value['field_id'] ] );
                                if ( ! is_email( $contact_email ) ) {
                                    $et_error_message .= sprintf( '%1$s', esc_html__( 'Invalid Email.', 'et_builder' ) );
                                    $et_contact_error == true;
                                    $response = array( "error" => $et_error_message);
                                    echo json_encode($response);
                                    die;
                                }
                            }
                        }
                        
                        // prepare the array of processed field values in convenient format
                        if ( false === $et_contact_error && strpos( $value['field_id'], $contact_form_num) ){
                            $processed_fields_values[ $value['original_id'] ]['value'] = $field_value;
                            $processed_fields_values[ $value['original_id'] ]['label'] = $value['field_label'];
                        }
                    }
                }
            } else {
                $et_error_message .= sprintf( '%1$s', esc_html__( 'Make sure you fill in all required fields.', 'et_builder' ) );
                $et_contact_error = true;
                $response = array( "error" => $et_error_message);
                echo json_encode($response);
                die;
            }
            
        } else {
            if ( false === $nonce_result && isset( $_POST['et_pb_contactform_submit_' . $contact_form_num] ) && empty( $_POST['et_pb_contactform_validate_' . $contact_form_num] ) ) {
                
                $et_error_message .= sprintf( '%1$s', esc_html__( 'Please refresh the page and try again.', 'et_builder' ) );
            }
            $et_contact_error = true;
             
        }
        $et_pb_first_digit = rand( 1, 15 );
        $et_pb_second_digit = rand( 1, 15 );

        if ( ! $et_contact_error && $nonce_result ) {
            
            $et_email_to = '' !== $email? $email: get_site_option( 'admin_email' );

            $et_site_name = get_option( 'blogname' );
            $contact_name = isset( $processed_fields_values['name'] ) ? stripslashes( sanitize_text_field( $processed_fields_values['name']['value'] ) ) : '';
            
            if ( '' !== $custom_message ) {
                // decode html entites to make sure HTML from the message pattern is rendered properly
                $message_pattern = et_builder_convert_line_breaks( html_entity_decode( $custom_message ), "\r\n" );

                // insert the data from contact form into the message pattern
                foreach ( $processed_fields_values as $key => $value ) {
                    // strip all tags from each field. Don't strip tags from the entire message to allow using HTML in the pattern.
                    $message_pattern = str_ireplace( "%%{$key}%%", wp_strip_all_tags( $value['value'] ), $message_pattern );
                }

                if ( false !== $hidden_form_fields ) {
                    $hidden_form_fields = str_replace( '\\', '' ,  $hidden_form_fields );
                    $hidden_form_fields = json_decode( $hidden_form_fields );

                    if ( is_array( $hidden_form_fields ) ) {
                        foreach ( $hidden_form_fields as $hidden_field_label ) {
                            $message_pattern = str_ireplace( "%%{$hidden_field_label}%%", '', $message_pattern );
                        }
                    }
                }
            } else {
                // use default message pattern if custom pattern is not defined
                $message_pattern = isset( $processed_fields_values['message']['value'] ) ? $processed_fields_values['message']['value'] : '';

                // Add all custom fields into the message body by default
                foreach ( $processed_fields_values as $key => $value ) {
                    if ( ! in_array( $key, array( 'message', 'name', 'email' ) ) ) {
                        $message_pattern .= "\r\n";
                        $message_pattern .= sprintf(
                            '%1$s: %2$s',
                            '' !== $value['label'] ? $value['label'] : $key,
                            $value['value']
                        );
                    }
                }

                // strip all tags from the message content
                $message_pattern = wp_strip_all_tags( $message_pattern );
            }
            $http_host = str_replace( 'www.', '', $_SERVER['HTTP_HOST'] );

            $headers[] = "From: \"{$contact_name}\" <mail@{$http_host}>";
            $headers[] = "Reply-To: \"{$contact_name}\" <{$contact_email}>";

            add_filter( 'et_get_safe_localization', 'et_allow_ampersand' );

            // don't strip tags at this point to properly send the HTML from pattern. All the unwanted HTML stripped at this point.
            $email_message = trim( stripslashes( $message_pattern ) );
            $status = '';
            if( $et_error_message == '' ){
                $status = wp_mail( apply_filters( 'et_contact_page_email_to', $et_email_to ),
                et_get_safe_localization( sprintf(
                    __( 'New Message From %1$s%2$s', 'et_builder' ),
                    sanitize_text_field( html_entity_decode( $et_site_name, ENT_QUOTES, 'UTF-8' ) ),
                    ( '' !== $title ? sprintf( _x( ' - %s', 'contact form title separator', 'et_builder' ), sanitize_text_field( html_entity_decode( $title, ENT_QUOTES, 'UTF-8' ) ) ) : '' )
                ) ),
                ! empty( $email_message ) ? $email_message : ' ',
                apply_filters( 'et_contact_page_headers', $headers, $contact_name, $contact_email )
                );
                if($status!=''){
                    $et_error_message = sprintf( '%1$s', esc_html( $success_message ) );
                    $et_error_message = str_replace("&#039;","'",$et_error_message);
                    $response = array('success' => $et_error_message);
                    echo json_encode($response);
                    die;
                }else{
                    $et_error_message = sprintf( '%1$s', esc_html( "Unable to send mail." ) );
                    $response = array('error' => $et_error_message);
                    echo json_encode($response);
                    die;
                }   
            }else{
                $response = array('error' => $et_error_message);
                echo json_encode($response);
                die;
            }
        }
    }
    public function amp_divi_pagebuilder_plugin_init(){
        if(!defined('AMPFORWP_AMP__DIR__')) {
            define( 'AMPFORWP_AMP__DIR__', AMP__DIR__);
        }
        require_once AMP_WPBAKERY_PLUGIN_DIR .'includes/class-amp-divi-blacklist.php';
    } 

    public function ampforwp_add_divi_blacklist($data){
    global $redux_builder_amp;

        unset($data['AMP_Blacklist_Sanitizer']);
        unset($data['AMPFORWP_Blacklist_Sanitizer']);
        $data[ 'AMPFORWP_DIVI_Blacklist' ] = array();
       
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
