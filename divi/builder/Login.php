<?php
if(class_exists('ET_Builder_Module_Login')){
class AMP_ET_Builder_Module_Login extends ET_Builder_Module {
	function init() {
		$this->name       = esc_html__( 'Login', 'et_builder' );
		$this->slug       = 'et_pb_login';
		$this->vb_support = 'on';

		$this->main_css_element = '%%order_class%%.et_pb_login';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'et_builder' ),
					'redirect'     => esc_html__( 'Redirect', 'et_builder' ),
					'background'   => esc_html__( 'Background', 'et_builder' ),
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
				'header' => array(
					'label'    => esc_html__( 'Title', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h2, {$this->main_css_element} h1.et_pb_module_header, {$this->main_css_element} h3.et_pb_module_header, {$this->main_css_element} h4.et_pb_module_header, {$this->main_css_element} h5.et_pb_module_header, {$this->main_css_element} h6.et_pb_module_header",
						'important' => 'all',
					),
					'header_level' => array(
						'default' => 'h2',
					),
				),
				'body'   => array(
					'label'    => esc_html__( 'Body', 'et_builder' ),
					'css'      => array(
						'line_height' => "{$this->main_css_element} p",
						'font'        => "{$this->main_css_element}, {$this->main_css_element} .et_pb_newsletter_description_content, {$this->main_css_element} p, {$this->main_css_element} span",
						'text_shadow' => "{$this->main_css_element}, {$this->main_css_element} .et_pb_newsletter_description_content, {$this->main_css_element} p, {$this->main_css_element} span",
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
					'css' => array(
						'plugin_main' => "{$this->main_css_element} .et_pb_newsletter_button.et_pb_button",
					),
					'no_rel_attr' => true,
					'box_shadow'  => array(
						'css' => array(
							'main' => '%%order_class%% .et_pb_button',
						),
					),
				),
			),
			'background'            => array(
				'has_background_color_toggle' => true,
				'use_background_color' => 'fields_only',
				'options' => array(
					'background_color' => array(
						'depends_show_if'  => 'on',
						'default'          => et_builder_accent_color(),
					),
					'use_background_color' => array(
						'default'          => 'on',
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
						)
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
					'fields_after' => array(
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
							'default_on_front'=> 'off',
						),
					),
				),
				'fields_focus' => array(
					'css'             => array(
						'main' => array(
							'border_radii' => "%%order_class%% .et_pb_newsletter_form p input:focus",
							'border_styles' => "%%order_class%% .et_pb_newsletter_form p input:focus",
						)
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
					'label'           => esc_html__( 'Fields Box Shadow', 'et_builder' ),
					'option_category' => 'layout',
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'fields',
					'css'             => array(
						'main' => '%%order_class%% .et_pb_newsletter_form .input',
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
						),
					),
					'default_on_fronts'  => array(
						'color'    => '',
						'position' => '',
					),
				),
				'fields_focus' => array(
					'css'             => array(
						'main' => array(
							'border_radii' => "%%order_class%% .et_pb_newsletter_form input:focus",
							'border_styles' => "%%order_class%% .et_pb_newsletter_form input:focus",
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
					'default_on_fronts'  => array(
						'color'    => '',
						'position' => '',
					),
				),
			),
			'text'                  => array(
				'use_background_layout' => true,
				'options' => array(
					'text_orientation'  => array(
						'default'          => 'left',
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
				'label'    => esc_html__( 'Login Title', 'et_builder' ),
				'selector' => "{$this->main_css_element} h2, {$this->main_css_element} h1.et_pb_module_header, {$this->main_css_element} h3.et_pb_module_header, {$this->main_css_element} h4.et_pb_module_header, {$this->main_css_element} h5.et_pb_module_header, {$this->main_css_element} h6.et_pb_module_header",
			),
			'newsletter_description' => array(
				'label'    => esc_html__( 'Login Description', 'et_builder' ),
				'selector' => '.et_pb_newsletter_description',
			),
			'newsletter_form' => array(
				'label'    => esc_html__( 'Login Form', 'et_builder' ),
				'selector' => '.et_pb_newsletter_form',
			),
			'newsletter_fields' => array(
				'label'    => esc_html__( 'Login Fields', 'et_builder' ),
				'selector' => '.et_pb_newsletter_form input',
			),
			'newsletter_button' => array(
				'label'    => esc_html__( 'Login Button', 'et_builder' ),
				'selector' => '.et_pb_login .et_pb_login_form .et_pb_newsletter_button.et_pb_button',
				'no_space_before_selector' => true,
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( '6ZEw-Izfjg8' ),
				'name' => esc_html__( 'An introduction to the Login module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'title' => array(
				'label'           => esc_html__( 'Title', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Choose a title of your login box.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
			),
			'current_page_redirect' => array(
				'label'           => esc_html__( 'Redirect To The Current Page', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'default_on_front' => 'off',
				'toggle_slug'     => 'redirect',
				'description'     => esc_html__( 'Here you can choose whether the user should be redirected to the current page.', 'et_builder' ),
			),
			'content' => array(
				'label'             => esc_html__( 'Content', 'et_builder' ),
				'type'              => 'tiny_mce',
				'option_category'   => 'basic_option',
				'description'       => esc_html__( 'Input the main text content for your module here.', 'et_builder' ),
				'toggle_slug'       => 'main_content',
			),
			'form_field_background_color' => array(
				'label'             => esc_html__( 'Form Field Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'fields',
			),
			'form_field_text_color' => array(
				'label'             => esc_html__( 'Form Field Text Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'fields',
			),
			'focus_background_color' => array(
				'label'             => esc_html__( 'Focus Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'fields',
			),
			'focus_text_color' => array(
				'label'             => esc_html__( 'Focus Text Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'fields',
			),
		);

		return $fields;
	}

	public function amp_divi_inline_styles(){
    
    		$inline_styles = '.et_pb_lg{
			        background-color:#7EBEC5;
			        padding: 30px;
    				display: inline-flex;
			      }
			      .et_pb_login .et_pb_newsletter_description h2{
			          margin-bottom: 10px;
			          font-weight: 500;
			      }
			      .et_pb_login .et_pb_newsletter_description_content a{
			          margin-top: 20px;
			          display: inline-block;
			          color: #fff;
			      }
			      .et_pb_login input {
				    padding: 14px 4%;
				    font-size: 16px;
				    color: #666;
				    width: 100%;
				    font-weight: 400;
				    border-width: 0;
				    border-radius: 3px;
				}
				.et_pb_login p{
					margin-bottom:10px
				}
				.et_pb_forgot_password{
					font-size: 12px;
					font-weight: 600;
				}
				.et_pb_forgot_password a{color:#fff;}
				@media(max-width:767px){
					.et_pb_login{
					    flex-direction: column;
					}
					.et_pb_login .et_pb_newsletter_description{
						margin-bottom:30px;
					}
				}
			      ';
            echo $inline_styles;
  	}
  	function amp_divi_pagebuilder_scripts($data){
  		$data['amp_component_scripts']['amp-mustache'] = 'https://cdn.ampproject.org/v0/amp-mustache-0.2.js';
        $data['amp_component_scripts']['amp-form'] = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
  		return $data;
  	}
  	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}
	function render( $attrs, $content = null, $render_slug ) {
		add_filter('amp_post_template_data', [$this, 'amp_divi_pagebuilder_scripts']);
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$module_id                   = $this->props['module_id'];
		$title                       = $this->props['title'];
		$background_color            = $this->props['background_color'];
		$background_layout           = $this->props['background_layout'];
		$use_background_color        = $this->props['use_background_color'];
		$current_page_redirect       = $this->props['current_page_redirect'];
		$form_field_background_color = $this->props['form_field_background_color'];
		$form_field_text_color       = $this->props['form_field_text_color'];
		$focus_background_color      = $this->props['focus_background_color'];
		$focus_text_color            = $this->props['focus_text_color'];
		$button_custom               = $this->props['custom_button'];
		$custom_icon                 = $this->props['button_icon'];
		$header_level                = $this->props['header_level'];
		$content                     = $this->content;
		$use_focus_border_color      = $this->props['use_focus_border_color'];

		if ( '' !== $focus_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_newsletter_form p input:focus',
				'declaration' => sprintf(
					'background-color: %1$s%2$s;',
					esc_html( $focus_background_color ),
					et_is_builder_plugin_active() ? ' !important' : ''
				),
			) );
		}

		if ( '' !== $focus_text_color ) {
			$placeholder_selectors = array(
				'%%order_class%% .et_pb_newsletter_form p input:focus::-webkit-input-placeholder',
				'%%order_class%% .et_pb_newsletter_form p input:focus::-moz-placeholder',
				'%%order_class%% .et_pb_newsletter_form p input:focus:-ms-input-placeholder',
			);

			foreach ( $placeholder_selectors as $single_selector ) {
				ET_Builder_Element::set_style( $render_slug, array(
					'selector'    => $single_selector,
					'declaration' => sprintf(
						'color: %1$s;',
						esc_html( $focus_text_color )
					),
				) );
			}

			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_newsletter_form p input:focus',
				'declaration' => sprintf(
					'color: %1$s;',
					esc_html( $focus_text_color )
				),
			) );
		}

		if ( '' !== $form_field_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% input[type="text"], %%order_class%% textarea, %%order_class%% .input',
				'declaration' => sprintf(
					'background-color: %1$s%2$s;',
					esc_html( $form_field_background_color ),
					et_is_builder_plugin_active() ? ' !important' : ''
				),
			) );
		}

		if ( '' !== $form_field_text_color ) {
			$placeholder_selectors = array(
				'%%order_class%% .input::-webkit-input-placeholder',
				'%%order_class%% .input::-moz-placeholder',
				'%%order_class%% .input:-ms-input-placeholder',
			);

			foreach ( $placeholder_selectors as $single_selector ) {
				ET_Builder_Element::set_style( $render_slug, array(
					'selector'    => $single_selector,
					'declaration' => sprintf(
						'color: %1$s;',
						esc_html( $form_field_text_color )
					),
				) );
			}

			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% input[type="text"], %%order_class%% textarea, %%order_class%% .input',
				'declaration' => sprintf(
					'color: %1$s;',
					esc_html( $form_field_text_color )
				),
			) );
		}

		$redirect_url = 'on' === $current_page_redirect
			? ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
			: '';

		if ( is_user_logged_in() && ! is_customize_preview() && ! is_et_pb_preview() ) {
			$current_user = wp_get_current_user();

			$content .= sprintf( '<br/>%1$s <a href="%2$s">%3$s</a>',
				sprintf( esc_html__( 'Logged in as %1$s', 'et_builder' ), esc_html( $current_user->display_name ) ),
				esc_url( wp_logout_url( $redirect_url ) ),
				esc_html__( 'Log out', 'et_builder' )
			);
		}

		$video_background = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		$form = '';
		if ( ! is_user_logged_in() || is_customize_preview() || is_et_pb_preview() ) {
			$username = esc_html__( 'Username', 'et_builder' );
			$password = esc_html__( 'Password', 'et_builder' );

			$form = sprintf( '
				<div class="et_pb_newsletter_form et_pb_login_form">
					<form action="%7$s" method="post">
						<p>
							<label class="et_pb_contact_form_label" for="user_login_%12$s" style="display: none;">%3$s</label>
							<input id="user_login_%12$s" placeholder="%4$s" class="input" type="text" value="" name="log" />
						</p>
						<p>
							<label class="et_pb_contact_form_label" for="user_pass_%12$s" style="display: none;">%5$s</label>
							<input id="user_pass_%12$s" placeholder="%6$s" class="input" type="password" value="" name="pwd" />
						</p>
						<p class="et_pb_forgot_password"><a href="%2$s">%1$s</a></p>
						<p>
							<button type="submit" class="et_pb_newsletter_button et_pb_button%11$s"%10$s>%8$s</button>
							%9$s
						</p>
					</form>
				</div>',
				esc_html__( 'Forgot your password?', 'et_builder' ),
				esc_url( wp_lostpassword_url() ),
				esc_html( $username ),
				esc_attr( $username ),
				esc_html( $password ),
				esc_attr( $password ),
				esc_url( site_url( 'wp-login.php', 'login_post' ) ),
				esc_html__( 'Login', 'et_builder' ),
				( 'on' === $current_page_redirect
					? sprintf( '<input type="hidden" name="redirect_to" value="%1$s" />', esc_url( $redirect_url ) )
					: ''
				),
				'' !== $custom_icon && 'on' === $button_custom ? sprintf(
					' data-icon="%1$s"',
					esc_attr( et_pb_process_font_icon( $custom_icon ) )
				) : '',
				'' !== $custom_icon && 'on' === $button_custom ? ' et_pb_custom_button_icon' : '',
				// Prevent an accidental "duplicate ID" error if there's more than one instance of this module
				( '' !== $module_id ? esc_attr( $module_id ) : uniqid() )
			);
		}

		// Module classnames
		$this->add_classname( array(
			'et_pb_newsletter',
			'clearfix',
			"et_pb_bg_layout_{$background_layout}",
			$this->get_text_orientation_classname()
		) );

		if ( is_customize_preview() || is_et_pb_preview() ) {
			$this->add_classname( 'et_pb_in_customizer' );
		}

		if ( 'on' === $use_focus_border_color ) {
			$this->add_classname( 'et_pb_with_focus_border' );
		}

		$output = sprintf(
			'<div%6$s class="%4$s et_pb_lg"%5$s>
				%8$s
				%7$s
				<div class="et_pb_newsletter_description">
					%1$s
					%2$s
				</div>
				%3$s
			</div>',
			( '' !== $title ? sprintf( '<%1$s class="et_pb_module_header">%2$s</%1$s>', et_pb_process_header_level( $header_level, 'h2' ), esc_html( $title ) ) : '' ),
			( '' !== $content ? '<div class="et_pb_newsletter_description_content">' . $content . '</div>' : '' ),
			$form,
			$this->module_classname( $render_slug ),
			( 'on' === $use_background_color
				? sprintf( ' style="background-color: %1$s;"', esc_attr( $background_color ) )
				: ''
			),
			$this->module_id(),
			$video_background,
			$parallax_image_background
		);

		return $output;
	}
}

$loginObj = new AMP_ET_Builder_Module_Login();
remove_shortcode( 'et_pb_login' );
add_shortcode( 'et_pb_login', array($loginObj, '_render'));
}