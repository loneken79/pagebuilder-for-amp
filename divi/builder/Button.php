<?php
if(class_exists('ET_Builder_Module_Button')){
class AMP_ET_Builder_Module_Button extends ET_Builder_Module {
	function init() {
		$this->name       = esc_html__( 'Button', 'et_builder' );
		$this->slug       = 'et_pb_button';
		$this->vb_support = 'on';
		$this->main_css_element = '%%order_class%%';

		$this->custom_css_fields = array(
			'main_element' => array(
				'label'    => esc_html__( 'Main Element', 'et_builder' ),
				'selector' => '.et_pb_button.et_pb_module',
				'no_space_before_selector' => true,
			),
		);

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'et_builder' ),
					'link'         => esc_html__( 'Link', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'alignment'  => esc_html__( 'Alignment', 'et_builder' ),
					'text'       => array(
						'title'    => esc_html__( 'Text', 'et_builder' ),
						'priority' => 49,
					),
				),
			),
		);

		$this->advanced_fields = array(
			'borders'               => array(
				'default' => false,
			),
			'button'                => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
					'css' => array(
						'main' => $this->main_css_element,
						'plugin_main' => "{$this->main_css_element}.et_pb_module",
					),
					'box_shadow' => false,
				),
			),
			'margin_padding' => array(
				'css' => array(
					'main' => "{$this->main_css_element}.et_pb_module, .et_pb_module {$this->main_css_element}.et_pb_module:hover",
					'important' => 'all',
				),
			),
			'text'                  => array(
				'use_text_orientation' => false,
				'use_background_layout' => true,
				'options' => array(
					'background_layout' => array(
						'default_on_front' => 'light',
					),
				),
			),
			'text_shadow'           => array(
				// Text Shadow settings are already included on button's advanced style
				'default' => false,
			),
			'background'            => false,
			'fonts'                 => false,
			'max_width'             => false,
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'XpM2G7tQQIE' ),
				'name' => esc_html__( 'An introduction to the Button module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'button_url' => array(
				'label'            => esc_html__( 'Button URL', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Input the destination URL for your button.', 'et_builder' ),
				'toggle_slug'      => 'link',
			),
			'url_new_window' => array(
				'label'            => esc_html__( 'Url Opens', 'et_builder' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'off' => esc_html__( 'In The Same Window', 'et_builder' ),
					'on'  => esc_html__( 'In The New Tab', 'et_builder' ),
				),
				'toggle_slug'      => 'link',
				'description'      => esc_html__( 'Here you can choose whether or not your link opens in a new window', 'et_builder' ),
				'default_on_front' => 'off',
			),
			'button_text' => array(
				'label'            => esc_html__( 'Button Text', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Input your desired button text.', 'et_builder' ),
				'toggle_slug'      => 'main_content',
			),
			'button_alignment' => array(
				'label'            => esc_html__( 'Button Alignment', 'et_builder' ),
				'type'             => 'text_align',
				'option_category'  => 'configuration',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'alignment',
				'description'      => esc_html__( 'Here you can define the alignment of Button', 'et_builder' ),
			),
		);

		return $fields;
	}

	public function get_button_alignment() {
		$text_orientation = isset( $this->props['button_alignment'] ) ? $this->props['button_alignment'] : '';

		return et_pb_get_alignment( $text_orientation );
	}
	public function amp_divi_inline_styles(){
    		$standard_styles = '.et_pb_button a{
						position: relative;
						padding: 0.3em 1em;
						border: 2px solid;
						-webkit-border-radius: 3px;
						-moz-border-radius: 3px;
						border-radius: 3px;
						background-color: transparent;
						background-repeat: no-repeat;
						background-position: center;
						background-size: cover;
						
						line-height: 1.7em !important;
						-webkit-transition: all 0.2s;
						-moz-transition: all 0.2s;
						transition: all 0.2s;
					}
					.et_pb_button_inner {
						position: relative;
					}
					/* Button Hover */
				.et_pb_module .et_pb_button a:hover,
				.et_pb_button a:hover {
					padding: 0.3em 2em 0.3em 0.7em;
					border: 2px solid transparent;
				}

				/* Button Hover Light Text */
				.et_pb_button a:hover {
					background-color: rgba(255, 255, 255, 0.2);
				}

				/* Button Hover Dark Text */
				.et_pb_bg_layout_light .et_pb_button:hover,
				.et_pb_pricing_table_button a:hover,
				.et_pb_contact_submit:hover,
				.et_pb_contact_reset:hover,
				.et_pb_bg_layout_light.et_pb_button:hover {
					background-color: rgba(0, 0, 0, 0.05);
				}

				/* Button - With Icon */
				.et_pb_button a:before,
				.et_pb_button a:after {
					position: absolute;
					margin-left: -1em;
					opacity: 0;
					text-shadow: none;
					
					font-style: normal;
					font-variant: none;
					line-height: 1em;
					text-transform: none;
					content: "\35";
					-webkit-transition: all 0.2s;
					-moz-transition: all 0.2s;
					transition: all 0.2s;
					font-family: "ETmodules";
				}

				.et_pb_button:before {
					display: none;
				}

				.et_pb_button a:hover:after,
				.et_pb_more_button a:hover:after,
				.et_pb_promo_button a:hover:after,
				.et_pb_newsletter_button a:hover:after,
				.et_pb_pricing_table_button a:hover:after {
					margin-left: 0;
					opacity: 1;
				}

				/* Button Hover - No Icon */
				.et_pb_contact_reset a:hover {
					padding: 0.3em 1em;
				}

				/* Subscribe Button Loader Icon */
				.et_subscribe_loader {
					display: none;
					position: absolute;
					top: 16px;
					left: 50%;
					width: 16px;
					height: 16px;
					margin-left: -8px;
					background: url("includes/builder/styles/images/subscribe-loader.gif");
				}

				.et_pb_button_text_loading .et_pb_newsletter_button_text {
					visibility: hidden;
				}';
		    $inline_styles = '.et_pd_btn a{ 
		          padding: 10px 20px;
		          border: 2px solid #2ea3f2;
		          color: #2ea3f2;
		          display: inline-block;
		          width:auto;
		      }
		      .et_pd_btn a:hover{ 
		          background-color: rgba(0,0,0,.05);
		          border: 2px solid transparent;
		          transition:0.3s ease-in-out 0s;
		      }';
            echo $standard_styles.''.$inline_styles;
  	}
	function render( $attrs, $content = null, $render_slug ) {
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$button_url        = $this->props['button_url'];
		$button_rel        = $this->props['button_rel'];
		$button_text       = $this->props['button_text'];
		$background_layout = $this->props['background_layout'];
		$url_new_window    = $this->props['url_new_window'];
		$custom_icon       = $this->props['button_icon'];
		$button_custom     = $this->props['custom_button'];
		$button_alignment  = $this->get_button_alignment();

		// Nothing to output if neither Button Text nor Button URL defined
		$button_url = trim( $button_url );

		if ( '' === $button_text && '' === $button_url ) {
			return '';
		}

		// Module classnames
		$this->add_classname( "et_pb_bg_layout_{$background_layout}" );

		// Render Button
		$button = $this->render_button( array(
			'button_id'        => $this->module_id( false ),
			'button_classname' => explode( ' ', $this->module_classname( $render_slug ) ),
			'button_custom'    => $button_custom,
			'button_rel'       => $button_rel,
			'button_text'      => $button_text,
			'button_url'       => $button_url,
			'custom_icon'      => $custom_icon,
			'has_wrapper'      => false,
			'url_new_window'   => $url_new_window,
		) );

		// Render module output
		$output = sprintf(
			'<div class="et_pd_btn et_pb_button_module_wrapper et_pb_button_%3$s_wrapper %2$s et_pb_module">
				%1$s
			</div>',
			$button,
			sprintf( ' et_pb_button_alignment_%1$s', esc_attr( $button_alignment ) ),
			$this->render_count()
		);

		return $output;
	}
}


$buttonObj = new AMP_ET_Builder_Module_Button();
remove_shortcode( 'et_pb_button' );
add_shortcode( 'et_pb_button', array($buttonObj, '_render'));
}