<?php
if(class_exists('ET_Builder_Module_Signup')){
class AMP_ET_Builder_Module_Signup extends ET_Builder_Module {

	private static $_providers;

	public static $enabled_providers;

	function init() {
		$this->name       = esc_html__( 'Email Optin', 'et_builder' );
		$this->slug       = 'et_pb_signup';
		$this->vb_support = 'on';

		$providers               = self::providers()->names_by_slug();
		$providers['feedburner'] = 'FeedBurner';

		self::$enabled_providers = apply_filters( 'et_builder_module_signup_enabled_providers', $providers );

		ksort( self::$enabled_providers );

		$this->main_css_element = '%%order_class%%.et_pb_subscribe';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content'   => esc_html__( 'Text', 'et_builder' ),
					'background'     => esc_html__( 'Background', 'et_builder' ),
					'provider'       => esc_html__( 'Email Account', 'et_builder' ),
					'fields'         => esc_html__( 'Fields', 'et_builder' ),
					'success_action' => esc_html__( 'Success Action', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'fields' => esc_html__( 'Fields', 'et_builder' ),
					'text'   => array(
						'title'    => esc_html__( 'Text', 'et_builder' ),
						'priority' => 49,
					),
				),
			),
		);

		$this->advanced_fields = array(
			'fonts'                 => array(
				'header'         => array(
					'label' => esc_html__( 'Title', 'et_builder' ),
					'css'   => array(
						'main'      => "{$this->main_css_element} .et_pb_newsletter_description h2, {$this->main_css_element} .et_pb_newsletter_description h1.et_pb_module_header, {$this->main_css_element} .et_pb_newsletter_description h3.et_pb_module_header, {$this->main_css_element} .et_pb_newsletter_description h4.et_pb_module_header, {$this->main_css_element} .et_pb_newsletter_description h5.et_pb_module_header, {$this->main_css_element} .et_pb_newsletter_description h6.et_pb_module_header",
						'important' => 'all',
					),
					'header_level' => array(
						'default' => 'h2',
					),
				),
				'body'           => array(
					'label' => esc_html__( 'Body', 'et_builder' ),
					'css'   => array(
						'main'        => "{$this->main_css_element} .et_pb_newsletter_description, {$this->main_css_element} .et_pb_newsletter_form",
						'line_height' => "{$this->main_css_element} p",
						'text_shadow' => "{$this->main_css_element} .et_pb_newsletter_description",
					),
				),
				'result_message' => array(
					'label' => esc_html__( 'Result Message', 'et_builder' ),
					'css'   => array(
						'main' => "{$this->main_css_element} .et_pb_newsletter_form .et_pb_newsletter_result h2",
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'button'                => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
					'css'   => array(
						'plugin_main' => "{$this->main_css_element} .et_pb_newsletter_button.et_pb_button",
					),
					'box_shadow' => array(
						'css' => array(
							'main' => '%%order_class%% .et_pb_newsletter_button',
						),
					),
				),
			),
			'background'            => array(
				'has_background_color_toggle' => true,
				'use_background_color' => 'fields_only',
				'options' => array(
					'use_background_color' => array(
						'default'          => 'on',
					),
					'background_color' => array(
						'depends_show_if' => 'on',
						'default'         => et_builder_accent_color(),
					),
				),
			),
			'borders'               => array(
				'default' => array(),
				'fields' => array(
					'css'             => array(
						'main' => array(
							'border_radii' => "%%order_class%% .et_pb_newsletter_form p input",
							'border_styles' => "%%order_class%% .et_pb_newsletter_form p input",
						),
					),
					'label_prefix'    => esc_html__( 'Fields', 'et_builder' ),
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'fields',
					'defaults'        => array(
						'border_radii'  => 'on|3px|3px|3px|3px',
						'border_styles' => array(
							'width' => '0px',
							'color' => '#333333',
							'style' => 'solid',
						),
					),
					'fields_after'    => array(
						'use_focus_border_color' => array(
							'label'           => esc_html__( 'Use Focus Borders', 'et_builder' ),
							'type'            => 'yes_no_button',
							'option_category' => 'color_option',
							'options'         => array(
								'off' => esc_html__( 'No', 'et_builder' ),
								'on'  => esc_html__( 'Yes', 'et_builder' ),
							),
							'affects'     => array(
								'border_radii_fields_focus',
								'border_styles_fields_focus',
							),
							'tab_slug'        => 'advanced',
							'toggle_slug'     => 'fields',
							'default'         => 'off',
						),
					),
				),
				'fields_focus' => array(
					'css'             => array(
						'main' => array(
							'border_radii' => "%%order_class%% .et_pb_newsletter_form p input:focus",
							'border_styles' => "%%order_class%% .et_pb_newsletter_form p input:focus",
						),
					),
					'label_prefix'    => esc_html__( 'Focus', 'et_builder' ),
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'fields',
					'depends_on'      => array( 'use_focus_border_color' ),
					'depends_show_if' => 'on',
					'defaults'        => array(
						'border_radii'  => 'on|3px|3px|3px|3px',
						'border_styles' => array(
							'width' => '0px',
							'color' => '#333333',
							'style' => 'solid',
						),
					),
				),
			),
			'box_shadow'            => array(
				'default' => array(),
				'fields'  => array(
					'label'               => esc_html__( 'Fields Box Shadow', 'et_builder' ),
					'option_category'     => 'layout',
					'tab_slug'            => 'advanced',
					'toggle_slug'         => 'fields',
					'css'                 => array(
						'main' => '%%order_class%% .et_pb_newsletter_form .input',
					),
					'default_on_fronts'  => array(
						'color'    => '',
						'position' => '',
					),
				),
			),
			'max_width'             => array(),
			'text'                  => array(
				'use_background_layout' => true,
				'css' => array(
					'text_shadow' => '%%order_class%% .et_pb_newsletter_description',
				),
				'options' => array(
					'text_orientation' => array(
						'default' => 'left',
					),
					'background_layout' => array(
						'default' => 'dark',
					),
				),
			),
			'text_shadow'           => array(
				'default' => array(),
				'fields'  => array(
					'label'           => esc_html__( 'Fields', 'et_builder' ),
					'option_category' => 'layout',
					'tab_slug'        => 'advanced',
				),
			),
			'fields'                => array(
				'css' => array(
					'text_shadow' => "{$this->main_css_element} input",
				),
			),
		);

		$this->custom_css_fields = array(
			'newsletter_title' => array(
				'label'    => esc_html__( 'Opt-in Title', 'et_builder' ),
				'selector' => "{$this->main_css_element} .et_pb_newsletter_description h2, {$this->main_css_element} .et_pb_newsletter_description h1.et_pb_module_header, {$this->main_css_element} .et_pb_newsletter_description h3.et_pb_module_header, {$this->main_css_element} .et_pb_newsletter_description h4.et_pb_module_header, {$this->main_css_element} .et_pb_newsletter_description h5.et_pb_module_header, {$this->main_css_element} .et_pb_newsletter_description h6.et_pb_module_header",
			),
			'newsletter_description' => array(
				'label'    => esc_html__( 'Opt-in Description', 'et_builder' ),
				'selector' => '.et_pb_newsletter_description',
			),
			'newsletter_form'        => array(
				'label'    => esc_html__( 'Opt-in Form', 'et_builder' ),
				'selector' => '.et_pb_newsletter_form',
			),
			'newsletter_fields'      => array(
				'label'    => esc_html__( 'Opt-in Form Fields', 'et_builder' ),
				'selector' => '.et_pb_newsletter_form input',
			),
			'newsletter_button'      => array(
				'label'                    => esc_html__( 'Subscribe Button', 'et_builder' ),
				'selector'                 => '.et_pb_subscribe .et_pb_newsletter_button.et_pb_button',
				'no_space_before_selector' => true,
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'kauQ6xheNiw' ),
				'name' => esc_html__( 'An introduction to the Email Optin module', 'et_builder' ),
			),
		);
	}

	protected static function _get_account_fields( $provider_slug ) {
		$fields  = self::providers()->account_fields( $provider_slug );
		$is_VB   = isset( $_REQUEST['action'] ) && 'et_fb_retrieve_builder_data' === $_REQUEST['action'];
		$show_if = $is_VB ? 'add_new_account' : 'manage|add_new_account';

		$account_name_key = $provider_slug . '_account_name';
		$list_key         = $provider_slug . '_list';
		$description_text = esc_html__( 'Email Provider Account Setup Documentation', 'et_builder' );

		if ( $fields ) {
			$field_ids     = array_keys( $fields );
			$last_field_id = "{$provider_slug}_" . array_pop( $field_ids );
		} else {
			$last_field_id = $account_name_key;
		}

		$buttons = array(
			'option_class' => 'et-pb-option-group--last-field',
			'after'        => array(
				array(
					'type'  => 'button',
					'class' => 'et_pb_email_cancel',
					'text'  => esc_html__( 'Cancel', 'et_builder' ),
				),
				array(
					'type'  => 'button',
					'class' => 'et_pb_email_submit',
					'text'  => esc_html__( 'Submit', 'et_builder' ),
				),
			),
		);

		$account_fields = array(
			$account_name_key => array(
				'name'            => 'account_name',
				'label'           => esc_html__( 'Account Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'A name to associate with the account when displayed in the List select field.', 'et_builder' ),
				'show_if'         => array(
					$list_key => $show_if,
				),
				'class'           => "et_pb_email_{$provider_slug}_account_name",
				'toggle_slug'     => 'provider',
			),
		);

		foreach ( $fields as $field_id => $field_info ) {
			$field_id = "{$provider_slug}_{$field_id}";

			$account_fields[ $field_id ] = array(
				'name'            => $field_id,
				'label'           => et_esc_previously( $field_info['label'] ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => sprintf( '<a target="_blank" href="https://www.elegantthemes.com/documentation/bloom/accounts#%1$s">%2$s</a>', $provider_slug, $description_text ),
				'show_if'         => array(
					$list_key => $show_if,
				),
				'class'           => 'et_pb_email_' . $field_id,
				'toggle_slug'     => 'provider',
			);
		}

		$account_fields[ $last_field_id ] = array_merge( $account_fields[ $last_field_id ], $buttons );

		return $account_fields;
	}

	protected static function _get_provider_fields() {
		$fields   = array();
		$lists    = self::get_lists();
		$no_lists = array();

		$no_lists[] = array( 'none' => esc_html__( 'Select a list', 'et_builder' ) );

		$no_lists['manage'] = array(
			'add_new_account' => '',
			'remove_account'  => '',
			'fetch_lists'     => '',
		);

		foreach ( self::$enabled_providers as $provider_slug => $provider_name ) {
			if ( 'feedburner' === $provider_slug ) {
				continue;
			}

			$fields[ $provider_slug . '_list' ] = array(
				'label'           => sprintf( esc_html_x( '%s List', 'MailChimp, Aweber, etc', 'et_builder' ), $provider_name ),
				'type'            => 'select_with_option_groups',
				'option_category' => 'basic_option',
				'options'         => isset( $lists[ $provider_slug ] ) ? $lists[ $provider_slug ] : $no_lists,
				'description'     => esc_html__( 'Choose a list. If you don\'t see any lists, click "Add" to add an account.' ),
				'show_if'         => array(
					'provider' => $provider_slug,
				),
				'default'         => '0|none',
				'default_on_front'=> '',
				'toggle_slug'     => 'provider',
				'after'           => array(
					array(
						'type'  => 'button',
						'class' => 'et_pb_email_add_account',
						'text'  => esc_html__( 'Add', 'et_builder' ),
					),
					array(
						'type'       => 'button',
						'class'      => 'et_pb_email_remove_account',
						'text'       => esc_html__( 'Remove', 'et_builder' ),
						'attributes' => array(
							'data-confirm_text' => esc_attr__( 'Confirm', 'et_builder' ),
						),
					),
					array(
						'type'       => 'button',
						'class'      => 'et_pb_email_force_fetch_lists',
						'text'       => esc_html__( 'Fetch Lists', 'et_builder' ),
						'attributes' => array(
							'data-cancel_text' => esc_attr__( 'Cancel', 'et_builder' ),
						),
					),
				),
				'attributes'      => array(
					'data-confirm_remove_text'     => esc_attr__( 'The following account will be removed:', 'et_builder' ),
					'data-adding_new_account_text' => esc_attr__( 'Use the fields below to add a new account.', 'et_builder' ),
				),
			);

			$account_fields = is_admin() ? self::_get_account_fields( $provider_slug ) : array();
			$fields         = array_merge( $fields, $account_fields );
		}

		return $fields;
	}

	function get_fields() {
		$name_field_only = array_keys( self::providers()->names_by_slug( 'all', 'name_field_only' ) );

		return array_merge(
			array(
				'provider'       => array(
					'label'           => esc_html__( 'Service Provider', 'et_builder' ),
					'type'            => 'select',
					'option_category' => 'basic_option',
					'options'         => self::$enabled_providers,
					'description'     => esc_html__( 'Choose a service provider.', 'et_builder' ),
					'toggle_slug'     => 'provider',
					'default'         => 'mailchimp',
				),
				'feedburner_uri' => array(
					'label'           => esc_html__( 'Feed Title', 'et_builder' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'show_if'         => array(
						'provider' => 'feedburner',
					),
					'description'     => et_get_safe_localization( sprintf( __( 'Enter <a href="%1$s" target="_blank">Feed Title</a>.', 'et_builder' ), esc_url( 'http://feedburner.google.com/fb/a/myfeeds' ) ) ),
					'toggle_slug'     => 'provider',
				),
			),

			self::_get_provider_fields(),

			array(
				'name_field'                  => array(
					'label'           => esc_html__( 'Use Single Name Field', 'et_builder' ),
					'type'            => 'yes_no_button',
					'option_category' => 'configuration',
					'options'         => array(
						'on'  => esc_html__( 'Yes', 'et_builder' ),
						'off' => esc_html__( 'No', 'et_builder' ),
					),
					'default'         => 'off',
					'show_if_not'     => array(
						'provider' => array_merge( $name_field_only, array( 'feedburner' ) ),
					),
					'toggle_slug'     => 'fields',
					'description'     => esc_html__( 'Whether or not to use a single Name field in the opt-in form.', 'et_builder' ),
				),
				'first_name_field'            => array(
					'label'           => esc_html__( 'First Name', 'et_builder' ),
					'type'            => 'yes_no_button',
					'option_category' => 'configuration',
					'options'         => array(
						'on'  => esc_html__( 'Yes', 'et_builder' ),
						'off' => esc_html__( 'No', 'et_builder' ),
					),
					'default'         => 'on',
					'show_if'         => array(
						'name_field' => 'off',
					),
					'show_if_not'     => array(
						'provider' => array_merge( $name_field_only, array( 'feedburner' ) ),
					),
					'toggle_slug'     => 'fields',
					'description'     => esc_html__( 'Whether or not the First Name field should be included in the opt-in form.', 'et_builder' ),
				),
				'last_name_field'             => array(
					'label'           => esc_html__( 'Last Name', 'et_builder' ),
					'type'            => 'yes_no_button',
					'option_category' => 'configuration',
					'options'         => array(
						'on'  => esc_html__( 'Yes', 'et_builder' ),
						'off' => esc_html__( 'No', 'et_builder' ),
					),
					'default'         => 'on',
					'show_if'         => array(
						'name_field' => 'off',
					),
					'show_if_not'     => array(
						'provider' => array_merge( $name_field_only, array( 'feedburner' ) ),
					),
					'toggle_slug'     => 'fields',
					'description'     => esc_html__( 'Whether or not the Last Name field should be included in the opt-in form.', 'et_builder' ),
				),
				'name_field_only'             => array(
					'label'           => esc_html__( 'Name', 'et_builder' ),
					'type'            => 'yes_no_button',
					'option_category' => 'configuration',
					'options'         => array(
						'on'  => esc_html__( 'Yes', 'et_builder' ),
						'off' => esc_html__( 'No', 'et_builder' ),
					),
					'default'         => 'on',
					'show_if'         => array(
						'provider' => $name_field_only,
					),
					'toggle_slug'     => 'fields',
					'description'     => esc_html__( 'Whether or not the Name field should be included in the opt-in form.', 'et_builder' ),
				),
				'success_action'              => array(
					'label'           => esc_html__( 'Action', 'et_builder' ),
					'type'            => 'select',
					'option_category' => 'configuration',
					'options'         => array(
						'message'  => esc_html__( 'Display a message.', 'et_builder' ),
						'redirect' => esc_html__( 'Redirect to a custom URL.', 'et_builder' ),
					),
					'default'         => 'message',
					'toggle_slug'     => 'success_action',
					'description'     => esc_html__( 'Choose what happens when a site visitor has been successfully subscribed to your list.', 'et_builder' ),
				),
				'success_message'             => array(
					'label'             => esc_html__( 'Message', 'et_builder' ),
					'type'              => 'text',
					'option_category'   => 'configuration',
					'default'           => esc_html__( 'Success!', 'et_builder' ),
					'show_if'           => array(
						'success_action' => 'message',
					),
					'toggle_slug'       => 'success_action',
					'description'       => esc_html__( 'The message that will be shown to site visitors who subscribe to your list.', 'et_builder' ),
				),
				'success_redirect_url'        => array(
					'label'           => esc_html__( 'Redirect URL', 'et_builder' ),
					'type'            => 'text',
					'option_category' => 'configuration',
					'show_if'         => array(
						'success_action' => 'redirect',
					),
					'toggle_slug'     => 'success_action',
					'description'     => esc_html__( 'Site visitors who subscribe to your list will be redirected to this URL.', 'et_builder' ),
				),
				'success_redirect_query'      => array(
					'label'           => esc_html__( 'Redirect URL Query', 'et_builder' ),
					'type'            => 'multiple_checkboxes',
					'option_category' => 'configuration',
					'options'         => array(
						'name'       => esc_html__( 'Name' ),
						'last_name'  => esc_html__( 'Last Name' ),
						'email'      => esc_html__( 'Email' ),
						'ip_address' => esc_html__( 'IP Address' ),
						'css_id'     => esc_html__( 'CSS ID' ),
					),
					'show_if'         => array(
						'success_action' => 'redirect',
					),
					'toggle_slug'     => 'success_action',
					'description'     => esc_html__( 'Choose what data (if any) to include in the redirect URL as query arguments.', 'et_builder' ),
				),
				'title'                       => array(
					'label'           => esc_html__( 'Title', 'et_builder' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'description'     => esc_html__( 'Choose a title of your signup box.', 'et_builder' ),
					'toggle_slug'     => 'main_content',
				),
				'button_text'                 => array(
					'label'           => esc_html__( 'Button Text', 'et_builder' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'description'     => esc_html__( 'Define custom text for the subscribe button.', 'et_builder' ),
					'toggle_slug'     => 'main_content',
					'default_on_front' => esc_html__( 'Subscribe', 'et_builder' ),
				),
				'content'                 => array(
					'label'           => esc_html__( 'Content', 'et_builder' ),
					'type'            => 'tiny_mce',
					'option_category' => 'basic_option',
					'description'     => esc_html__( 'Input the main text content for your module here.', 'et_builder' ),
					'toggle_slug'     => 'main_content',
				),
				'form_field_background_color' => array(
					'label'        => esc_html__( 'Form Field Background Color', 'et_builder' ),
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'fields',
				),
				'form_field_text_color'       => array(
					'label'        => esc_html__( 'Form Field Text Color', 'et_builder' ),
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'fields',
				),
				'focus_background_color'      => array(
					'label'        => esc_html__( 'Focus Background Color', 'et_builder' ),
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'fields',
				),
				'focus_text_color'            => array(
					'label'        => esc_html__( 'Focus Text Color', 'et_builder' ),
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'fields',
				),
			)
		);
	}

	public static function get_lists() {
		static $migrated = false;

		if ( ! $migrated ) {
			et_builder_email_maybe_migrate_accounts();
			$migrated = true;
		}

		$all_accounts = self::providers()->accounts();
		$lists        = array();

		foreach ( $all_accounts as $provider_slug => $accounts ) {
			if ( ! in_array( $provider_slug, array_keys( self::$enabled_providers ) ) ) {
				continue;
			}

			$lists[ $provider_slug ] = array(
				0 => array( 'none' => esc_html__( 'Select a list', 'et_builder' ) ),
			);

			foreach ( $accounts as $account_name => $account_details ) {
				if ( empty( $account_details['lists'] ) ) {
					continue;
				}

				foreach ( (array) $account_details['lists'] as $list_id => $list_details ) {
					if ( ! empty( $list_details['name'] ) ) {
						$lists[ $provider_slug ][ $account_name ][ $list_id ] = esc_html( $list_details['name'] );
					}
				}
			}

			$lists[ $provider_slug ]['manage'] = array(
				'add_new_account' => '',
				'remove_account'  => '',
				'fetch_lists'     => esc_html__( 'Fetching lists...', 'et_builder' ),
			);
		}

		return $lists;
	}

	public static function get_account_name_for_list_id( $provider_slug, $list_id ) {
		$providers    = ET_Core_API_Email_Providers::instance();
		$all_accounts = $providers->accounts();
		$result       = '';

		if ( ! isset( $all_accounts[ $provider_slug ] ) ) {
			return $result;
		}

		foreach ( $all_accounts[ $provider_slug ] as $account_name => $account_details ) {
			if ( ! empty( $account_details['lists'][ $list_id ] ) ) {
				$result = $account_name;
				break;
			}
		}

		return $result;
	}

	public function get_form_field_html( $field, $single_name_field = false ) {
		$html = '';

		switch ( $field ) {
			case 'name':
				$label = $single_name_field ? __( 'Name', 'et_builder' ) : __( 'First Name', 'et_builder' );
				$html  = sprintf( '
					<p>
						<label class="et_pb_contact_form_label" for="et_pb_signup_firstname" style="display: none;">%1$s</label>
						<input id="et_pb_signup_firstname" class="input" type="text" placeholder="%2$s" name="et_pb_signup_firstname">
					</p>',
					esc_html( $label ),
					esc_attr( $label )
				);
				break;

			case 'last_name':
				$label = __( 'Last Name', 'et_builder' );
				$html  = sprintf( '
					<p>
						<label class="et_pb_contact_form_label" for="et_pb_signup_lastname" style="display: none;">%1$s</label>
						<input id="et_pb_signup_lastname" class="input" type="text" placeholder="%2$s" name="et_pb_signup_lastname">
					</p>',
					esc_html( $label ),
					esc_attr( $label )
				);
				break;

			case 'email':
				$label = __( 'Email', 'et_builder' );
				$html  = sprintf( '
					<p>
						<label class="et_pb_contact_form_label" for="et_pb_signup_email" style="display: none;">%1$s</label>
						<input id="et_pb_signup_email" class="input" type="text" placeholder="%2$s" name="et_pb_signup_email">
					</p>',
					esc_html( $label ),
					esc_attr( $label )
				);
				break;

			case 'submit_button':
				$button_icon = $this->props['button_icon'] && 'on' === $this->props['custom_button'];
				$button_rel  = $this->props['button_rel'];

				$icon_class = $button_icon ? ' et_pb_custom_button_icon' : '';
				$icon_attr  = $button_icon ? et_pb_process_font_icon( $this->props['button_icon'] ) : '';

				$html = sprintf( '
					<p>
						<a class="et_pb_newsletter_button et_pb_button%1$s" href="#"%2$s data-icon="%3$s">
							<span class="et_subscribe_loader"></span>
							<span class="et_pb_newsletter_button_text">%4$s</span>
						</a>
					</p>',
					esc_attr( $icon_class ),
					$this->get_rel_attributes( $button_rel ),
					esc_attr( $icon_attr ),
					esc_html( $this->props['button_text'] )
				);
				break;

			case 'hidden':
				$provider = $this->props['provider'];

				if ( 'feedburner' === $provider ) {
					$html = sprintf( '
						<input type="hidden" value="%1$s" name="uri" />
						<input type="hidden" name="loc" value="%2$s" />',
						esc_url( $this->props['feedburner_uri'] ),
						esc_attr( get_locale() )
					);
				} else {
					$list = $this->props[ $provider . '_list' ];

					if ( false !== strpos( $list, '|' ) ) {
						list( $account_name, $list ) = explode( '|', $list );
					} else {
						$account_name = self::get_account_name_for_list_id( $provider, $list );
					}

					$html = sprintf( '
						<input type="hidden" value="%1$s" name="et_pb_signup_provider" />
						<input type="hidden" value="%2$s" name="et_pb_signup_list_id" />
						<input type="hidden" value="%3$s" name="et_pb_signup_account_name" />',
						esc_attr( $provider ),
						esc_attr( $list ),
						esc_attr( $account_name )
					);
				}
				break;
		}

		/**
		 * Filters the html output for individual opt-in form fields. The dynamic portion of the filter
		 * name ("$field"), will be one of: 'name', 'last_name', 'email', 'submit_button', 'hidden'.
		 *
		 * @since 3.0.75
		 *
		 * @param string $html              The form field's HTML.
		 * @param bool   $single_name_field Whether or not a single name field is being used.
		 *                                  Only applicable when "$field" is 'name'.
		 */
		return apply_filters( "et_pb_signup_form_field_html_{$field}", $html, $single_name_field );
	}

	public static function providers() {
		if ( null === self::$_providers ) {
			self::$_providers = ET_Core_API_Email_Providers::instance();
		}

		return self::$_providers;
	}
	public function amp_divi_inline_styles(){
    		$standard_styles = '/* Newsletter Module */
.et_pb_newsletter {
	padding: 25px;
}

.et_pb_newsletter_form,
.et_pb_newsletter_description {
	position: relative;
	width: 50%;
	padding: 0;
}

.et_pb_newsletter_description {
	float: left;
	margin-bottom: 20px;
}

.et_pb_newsletter_description p:last-of-type {
	padding-bottom: 0;
}

.et_pb_newsletter_form {
	float: left;
}

.et_pb_newsletter_form p input {
	width: 100%;
	padding: 14px 4% !important;
	border: none;
	border-radius: 3px;
	color: #666;
	background-color: #fff;
	font-size: 14px;
	font-size: 16px;
	font-weight: 400;

	-webkit-appearance: none;
}

.et_pb_newsletter_form p .et_pb_signup_error {
	border: 1px solid #f00 !important;
}

.et_pb_newsletter_result,
.et_pb_newsletter_success {
	display: none;
	text-align: center;
}

.et_pb_newsletter_button {
	display: block;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	width: 100%;
	color: inherit;
	text-align: center;
}

.et_pb_login_form .et_pb_newsletter_button,
.et_pb_feedburner_form .et_pb_newsletter_button {
	width: 100%;
	margin: 0;
	cursor: pointer;
}

.et_pb_login_form form,
.et_pb_feedburner_form form {
	text-align: left;
}

.et_pb_login_form ::-webkit-input-placeholder,
.et_pb_feedburner_form ::-webkit-input-placeholder {
	color: #666;
}

.et_pb_login_form ::-moz-placeholder,
.et_pb_feedburner_form ::-moz-placeholder {
	color: #666;
}

.et_pb_login_form :-ms-input-placeholder,
.et_pb_feedburner_form :-ms-input-placeholder {
	color: #666;
}

.et_pb_no_bg {
	padding: 0 !important;
}

/* Column Adjustments */
.logged-in:not(.et-fb) .et_pb_login .et_pb_newsletter_description,
.et_pb_column_1_2 .et_pb_newsletter_form,
.et_pb_column_1_2 .et_pb_newsletter_description,
.et_pb_column_3_8.et_pb_column_inner .et_pb_newsletter_form,
.et_pb_column_3_8.et_pb_column_inner .et_pb_newsletter_description,
.et_pb_column_1_3 .et_pb_newsletter_form,
.et_pb_column_1_3 .et_pb_newsletter_description,
.et_pb_column_1_3.et_pb_column_inner .et_pb_newsletter_form,
.et_pb_column_1_3.et_pb_column_inner .et_pb_newsletter_description,
.et_pb_column_1_4 .et_pb_newsletter_form,
.et_pb_column_1_4 .et_pb_newsletter_description,
.et_pb_column_1_4.et_pb_column_inner .et_pb_newsletter_form,
.et_pb_column_1_4.et_pb_column_inner .et_pb_newsletter_description {
	width: 100%;
	padding: 0;
}

.et_pb_column_4_4 .et_pb_newsletter_form,
.et_pb_column_3_4 .et_pb_newsletter_form,
.et_pb_column_2_3 .et_pb_newsletter_form {
	padding-left: 40px;
}

.et_pb_column_4_4 > .et_pb_newsletter .et_pb_newsletter_description,
.et_pb_column_3_4 > .et_pb_newsletter .et_pb_newsletter_description,
.et_pb_column_2_3 > .et_pb_newsletter .et_pb_newsletter_description {
	margin-bottom: 0;

	align-self: start;
}

.et_pb_column_4_4 > .et_pb_newsletter,
.et_pb_column_3_4 > .et_pb_newsletter,
.et_pb_column_2_3 > .et_pb_newsletter {
	display: flex;

	align-items: center;
}
';
    		$inline_styles = '.et_pb_sg{
		            background-color: #7EBEC5;
		            padding: 30px;
		            display: inline-flex;
		            flex-wrap:wrap;
		      }
		      .et_pb_newsletter_description{
		          width:50%;
		      }
		      .et_pb_newsletter_form{
		         width:50%;
		         padding-left: 30px;
		      }
		      .et_pb_newsletter_success{
		        display:none;
		      }
		      .et_pb_sg .et_pb_module_header{
		          font-size: 17px;
		          color: #fff;
		          line-height: 1.2;
		          font-weight: 500;
		      }
		      .et_pb_newsletter_description, .et_pb_newsletter_form{
		          color:#fff;
		          font-size: 16px;
		      }
		      .et_pb_newsletter_fields input{
		        padding: 14px 4%;
		        font-size: 16px;
		        color: #666;
		        width: 100%;
		        font-weight: 400;
		        border-width: 0;
		        border-radius: 3px;
		      }
		      .et_pb_newsletter_button {
		          font-size: 20px;
		          font-weight: 500;
		          padding: .3em 1em;
		          line-height: 1.7em;
		          background-color: transparent;
		          border: 2px solid #fff;
		          border-radius: 3px;
		          width: 100%;
		          display: inline-block;
		          text-align: center;
		          color: #fff;
		      }
		      .et_pb_newsletter_button:hover{
		          background-color: rgba(255,255,255,.2);
		          border: 2px solid transparent;
		      }
		      @media(max-width:767px){
		        .et_pb_newsletter_description, .et_pb_newsletter_form {
		            width: 100%;
		        }
		        .et_pb_newsletter_form{padding-left:0px;}
		      }';
            echo $standard_styles.''.$inline_styles;
  	}
	function render( $attrs, $content = null, $render_slug ) {
		global $et_pb_half_width_counter;
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));

		$title                       = $this->props['title'];
		$background_color            = $this->props['background_color'];
		$use_background_color        = $this->props['use_background_color'];
		$provider                    = $this->props['provider'];
		$feedburner_uri              = $this->props['feedburner_uri'];
		$list                        = $this->props[ $provider . '_list' ];
		$background_layout           = $this->props['background_layout'];
		$form_field_background_color = $this->props['form_field_background_color'];
		$form_field_text_color       = $this->props['form_field_text_color'];
		$focus_background_color      = $this->props['focus_background_color'];
		$focus_text_color            = $this->props['focus_text_color'];
		$success_action              = $this->props['success_action'];
		$success_message             = $this->props['success_message'];
		$success_redirect_url        = $this->props['success_redirect_url'];
		$success_redirect_query      = $this->props['success_redirect_query'];
		$header_level                = $this->props['header_level'];
		$use_focus_border_color      = $this->props['use_focus_border_color'];

		$_provider   = self::providers()->get( $provider, '', 'builder' );
		$_name_field = $_provider->name_field_only ? 'name_field_only' : 'name_field';

		$name_field       = 'on' === $this->props[ $_name_field ];
		$first_name_field = 'on' === $this->props['first_name_field'] && ! $_provider->name_field_only;
		$last_name_field  = 'on' === $this->props['last_name_field'] && ! $_provider->name_field_only;

		if ( '' !== $focus_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_newsletter_form p input.input:focus',
				'declaration' => sprintf(
					'background-color: %1$s%2$s;',
					esc_html( $focus_background_color ),
					et_is_builder_plugin_active() ? ' !important' : ''
				),
			) );
		}

		if ( '' !== $focus_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_newsletter_form p .input:focus',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $focus_text_color )
				),
			) );

			// Placeholder
			$focus_placeholders = array(
				'::-webkit-input-placeholder',
				'::-moz-placeholder',
				'::-ms-input-placeholder'
			);

			foreach ( $focus_placeholders as $placeholder ) {
				ET_Builder_Element::set_style( $render_slug, array(
					'selector'    => '%%order_class%% .et_pb_newsletter_form p .input:focus' . $placeholder ,
					'declaration' => sprintf(
						'color: %1$s !important;',
						esc_html( $focus_text_color )
					),
				) );
			}
		}

		if ( '' !== $form_field_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% input[type="text"], %%order_class%% textarea',
				'declaration' => sprintf(
					'background-color: %1$s%2$s;',
					esc_html( $form_field_background_color ),
					et_is_builder_plugin_active() ? ' !important' : ''
				),
			) );
		}

		if ( '' !== $form_field_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% input[type="text"], %%order_class%% textarea',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $form_field_text_color )
				),
			) );
		}

		if ( 'message' === $success_action || empty( $success_redirect_url ) ) {
			$success_redirect_url = $success_redirect_query = '';
		}

		if ( 'redirect' === $success_action && ! empty( $success_redirect_url ) ) {
			$success_redirect_url = et_html_attr( 'data-redirect_url', esc_url( $success_redirect_url ) );

			if ( ! empty( $success_redirect_query ) ) {
				$value_map              = array( 'name', 'last_name', 'email', 'ip_address', 'css_id' );
				$success_redirect_query = $this->process_multiple_checkboxes_field_value( $value_map, $success_redirect_query );
				$success_redirect_query = et_html_attr( 'data-redirect_query', $success_redirect_query );

				if ( false !== strpos( $success_redirect_query, 'ip_address' ) ) {
					$success_redirect_query .= et_html_attr( 'data-ip_address', et_core_get_ip_address() );
				}
			} else {
				$success_redirect_query = '';
			}
		}

		$video_background = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();
		$form          = '';
		$list_selected = ! in_array( $list, array( '', 'none' ) );

		if ( $list_selected && 'feedburner' === $provider ) {

			$form = sprintf( '
				<div class="et_pb_newsletter_form et_pb_feedburner_form">
					<form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(\'https://feedburner.google.com/fb/a/mailverify?uri=%4$s\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\'); return true">
						%1$s
						%2$s
						%3$s
					</form>
				</div>',
				$this->get_form_field_html( 'email' ),
				$this->get_form_field_html( 'submit_button' ),
				$this->get_form_field_html( 'hidden' ),
				esc_url( $feedburner_uri )
			);
		} else if ( $list_selected ) {

			$name_field_html      = '';
			$last_name_field_html = '';

			if ( $first_name_field || $name_field ) {
				$name_field_html = $this->get_form_field_html( 'name', $name_field );
			}

			if ( $last_name_field && ! $name_field ) {
				$last_name_field_html = $this->get_form_field_html( 'last_name' );
			}
			$footer_content = $this->props['footer_content'];
			$footer_content = str_replace( '<br />', '', $footer_content );
			$footer_content = html_entity_decode( $footer_content, ENT_COMPAT, 'UTF-8' );

			if ( $footer_content ) {
				$footer_content = sprintf('<div class="et_pb_newsletter_footer">%1$s</div>', et_esc_previously( $footer_content ) );
			}
			$site_url = esc_url( home_url( '/' ) );
			$actionXhrUrl = preg_replace('#^https?:#', '', $site_url);
			$form = sprintf( '
				<div class="et_pb_newsletter_form">
					<form action-xhr="'.$actionXhrUrl.'" method="post">
					<div class="et_pb_newsletter_result et_pb_newsletter_error"></div>
					<div class="et_pb_newsletter_result et_pb_newsletter_success">
						<h2>%1$s</h2>
					</div>
					<div class="et_pb_newsletter_fields">
						%2$s
						%3$s
						%4$s
						%5$s
						%6$s
						%7$s
					</div>
					%8$s
					</form>
				</div>',
				esc_html( $success_message ),
				$name_field_html,
				$last_name_field_html,
				$this->get_form_field_html( 'email' ),
				$this->get_form_field_html( 'submit_button' ),
				$footer_content,
				$this->get_form_field_html( 'hidden' ),
				'on' === $use_custom_fields ? ' class="et_pb_newsletter_custom_fields"' : ''
			);
		}

		// Module classnames
		$this->add_classname( array(
			'et_pb_newsletter',
			'et_pb_subscribe',
			'clearfix',
			"et_pb_bg_layout_{$background_layout}",
			$this->get_text_orientation_classname(),
		) );

		if ( 'on' !== $use_background_color ) {
			$this->add_classname( 'et_pb_no_bg' );
		}

		if ( 'on' === $use_focus_border_color ) {
			$this->add_classname( 'et_pb_with_focus_border' );
		}

		// Remove automatically added classnames
		$this->remove_classname( array(
			$render_slug,
		) );

		// $description = $this->props['description'];
		// $description = str_replace( '&gt;<br />', '&gt;', $description );
		// $description = html_entity_decode( $description, ENT_COMPAT, 'UTF-8' );

		$output = sprintf(
			'<div%6$s class="%4$s et_pb_sg"%5$s%9$s%10$s>
				%8$s
				%7$s
				<div class="et_pb_newsletter_description">
					%1$s
					%2$s
				</div>
				%3$s
			</div>',
			( '' !== $title ? sprintf( '<%1$s class="et_pb_module_header">%2$s</%1$s>', et_pb_process_header_level( $header_level, 'h2' ), esc_html( $title ) ) : '' ),
			$this->content,
			$form,
			$this->module_classname( $render_slug ),
			( 'on' === $use_background_color
				? sprintf( ' style="background-color: %1$s;"', esc_attr( $background_color ) )
				: ''
			), // #5
			$this->module_id(),
			$video_background,
			$parallax_image_background,
			$success_redirect_url,
			$success_redirect_query // #10
		);

		return $output;
	}
}
$emailOptinObj = new AMP_ET_Builder_Module_Signup();
remove_shortcode( 'et_pb_signup' );
add_shortcode( 'et_pb_signup', array($emailOptinObj, '_render'));
}