<?php
if(class_exists('ET_Builder_Module_Testimonial')){
class AMP_ET_Builder_Module_Testimonial extends ET_Builder_Module {
	function init() {
		$this->name       = esc_html__( 'Testimonial', 'et_builder' );
		$this->slug       = 'et_pb_testimonial';
		$this->vb_support = 'on';
		$this->main_css_element = '%%order_class%%.et_pb_testimonial';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'et_builder' ),
					'image'        => esc_html__( 'Image', 'et_builder' ),
					'link'         => esc_html__( 'Link', 'et_builder' ),
					'elements'     => esc_html__( 'Elements', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'icon'       => esc_html__( 'Quote Icon', 'et_builder' ),
					'text'       => array(
						'title'    => esc_html__( 'Text', 'et_builder' ),
						'priority' => 49,
					),
					'image' => array(
						'title' => esc_html__( 'Image', 'et_builder' ),
						'priority' => 51,
					),
					'animation' => array(
						'title'    => esc_html__( 'Animation', 'et_builder' ),
						'priority' => 100,
					),
				),
			),
		);

		$this->advanced_fields = array(
			'fonts'                 => array(
				'body' => array(
					'label'            => esc_html__( 'Body', 'et_builder' ),
					'css'              => array(
						'main' => "{$this->main_css_element} *",
					),
					'hide_text_shadow' => true,
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
						'depends_show_if'  => 'on',
						'default'          => '#f5f5f5',
					),
				),
				'settings'             => array(
					'color' => 'alpha',
				),
			),
			'borders'               => array(
				'default' => array(),
				'portrait' => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .et_pb_testimonial_portrait, %%order_class%% .et_pb_testimonial_portrait:before",
							'border_styles' => "%%order_class%% .et_pb_testimonial_portrait",
						),
					),
					'label_prefix' => esc_html__( 'Image', 'et_builder' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'image',
					'defaults'        => array(
						'border_radii'  => 'on|90px|90px|90px|90px',
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
				'image'   => array(
					'label'           => esc_html__( 'Image Box Shadow', 'et_builder' ),
					'option_category' => 'layout',
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'image',
					'css'             => array(
						'main'         => '%%order_class%% .et_pb_testimonial_portrait:before',
					),
					'default_on_fronts'  => array(
						'color'    => '',
						'position' => '',
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'text'                  => array(
				'use_background_layout' => true,
				'options' => array(
					'text_orientation'  => array(
						'default'      => 'left',
					),
					'background_layout' => array(
						'default' => 'light',
					),
				),
			),
			'filters'               => array(
				'child_filters_target' => array(
					'tab_slug' => 'advanced',
					'toggle_slug' => 'image',
				),
			),
			'image'                 => array(
				'css' => array(
					'main' => '%%order_class%% .et_pb_testimonial_portrait',
				),
			),
			'button'                => false,
		);

		$this->custom_css_fields = array(
			'testimonial_portrait' => array(
				'label'    => esc_html__( 'Testimonial Portrait', 'et_builder' ),
				'selector' => '.et_pb_testimonial_portrait',
			),
			'testimonial_description' => array(
				'label'    => esc_html__( 'Testimonial Description', 'et_builder' ),
				'selector' => '.et_pb_testimonial_description',
			),
			'testimonial_author' => array(
				'label'    => esc_html__( 'Testimonial Author', 'et_builder' ),
				'selector' => '.et_pb_testimonial_author',
			),
			'testimonial_meta' => array(
				'label'    => esc_html__( 'Testimonial Meta', 'et_builder' ),
				'selector' => '.et_pb_testimonial_meta',
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'FkQuawiGWUw' ),
				'name' => esc_html__( 'An introduction to the Testimonial module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'author' => array(
				'label'           => esc_html__( 'Author Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the name of the testimonial author.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
			),
			'job_title' => array(
				'label'           => esc_html__( 'Job Title', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the job title.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
			),
			'company_name' => array(
				'label'           => esc_html__( 'Company Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the name of the company.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
			),
			'url' => array(
				'label'           => esc_html__( 'Author/Company URL', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the website of the author or leave blank for no link.', 'et_builder' ),
				'toggle_slug'     => 'link',
			),
			'url_new_window' => array(
				'label'           => esc_html__( 'URLs Open', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'In The Same Window', 'et_builder' ),
					'on'  => esc_html__( 'In The New Tab', 'et_builder' ),
				),
				'toggle_slug'     => 'link',
				'description'     => esc_html__( 'Choose whether or not the URL should open in a new window.', 'et_builder' ),
				'default_on_front' => 'off',
			),
			'portrait_url' => array(
				'label'              => esc_html__( 'Portrait Image URL', 'et_builder' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
				'description'        => esc_html__( 'Upload your desired image, or type in the URL to the image you would like to display.', 'et_builder' ),
				'toggle_slug'        => 'image',
			),
			'quote_icon' => array(
				'label'           => esc_html__( 'Show Quote Icon', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'description'     => esc_html__( 'Choose whether or not the quote icon should be visible.', 'et_builder' ),
				'toggle_slug'     => 'elements',
			),
			'content' => array(
				'label'           => esc_html__( 'Content', 'et_builder' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the main text content for your module here.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
			),
			'quote_icon_color' => array(
				'label'             => esc_html__( 'Quote Icon Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'icon',
			),
			'quote_icon_background_color' => array(
				'label'             => esc_html__( 'Quote Icon Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'icon',
				'default'           => '#f5f5f5',
				'default_on_front' => '',
			),
			'portrait_width' => array(
				'label'           => esc_html__( 'Portrait Width', 'et_builder' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'image',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => '1',
					'max'  => '200',
					'step' => '1',
				),
			),
			'portrait_height' => array(
				'label'           => esc_html__( 'Portrait Height', 'et_builder' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'image',
				'range_settings'  => array(
					'min'  => '1',
					'max'  => '200',
					'step' => '1',
				),
			),
		);

		return $fields;
	}
	public function amp_divi_inline_styles(){
    	$standard_styles = '/* Testimonials Module */
.et_pb_testimonial {
	position: relative;
	padding: 30px;
	line-height: 1.5;
}

.et_pb_testimonial.et_pb_testimonial_no_bg {
	padding: 30px 0 0;
}

.et_pb_testimonial p:last-of-type {
	padding-bottom: 0;
}

.et_pb_testimonial_portrait,
.et_pb_testimonial_portrait:before {
	-webkit-border-radius: 90px;
	-moz-border-radius: 90px;
	border-radius: 90px;
}

.et_pb_testimonial_portrait {
	display: block;
	float: left;
	position: relative;
	width: 90px;
	height: 90px;
	margin-right: 30px;
	background-repeat: no-repeat;
	background-position: center;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	background-size: cover;
}

.et_pb_testimonial_portrait:before {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	-webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
	-moz-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
	box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
	content: "";
}

.et_pb_column_1_3 .et_pb_testimonial_portrait,
.et_pb_column_1_4 .et_pb_testimonial_portrait,
.et_pb_column_3_8 .et_pb_testimonial_portrait {
	display: block;
	float: none;
	margin: 0 auto 20px;
}

.et_pb_testimonial_description,
.et_pb_testimonial_description_inner {
	display: block;
	position: relative;
}

.et_pb_bg_layout_dark .et_pb_testimonial_description a {
	color: #fff;
}

.et_pb_testimonial_author {
	display: block;
	margin-top: 16px;
	font-weight: 700;
}

.et_pb_testimonial_author a {
	color: inherit;
}

.et_pb_testimonial:before {
	position: absolute;
	z-index: 2;
	top: -16px;
	left: 50%;
	margin-left: -16px;
	-webkit-border-radius: 31px;
	-moz-border-radius: 31px;
	border-radius: 31px;
	background: #f5f5f5;
	font-size: 32px;
	content: "\7c";
}

.et_pb_testimonial.et_pb_testimonial_no_bg:before {
	background: inherit;
}

.et_pb_testimonial.et_pb_icon_off:before {
	display: none;
}

.et_pb_testimonial_old_layout,
.et_pb_testimonial_old_layout .et_pb_testimonial_description a {
	color: #666 !important;
}
';
		$inline_styles = '
			.et_pd_testimon{
				background:#f5f5f5;
				padding:30px;
				position:relative;
			}
			.et_pd_testimon p{
				font-size: 16px;
			    line-height: 1.5;
			    color: #555;
			    margin: 0;
			}
			.et_pb_tstmnl{
				padding-bottom:20px;
			}
			.et_pd_testimon:after{
			    content: "\e244";
			    font-family: "icomoon";
			    position: absolute;
			    left: 0;
			    right: 0;
			    top: -17px;
			    bottom: 0;
			    margin: 0 auto;
			    text-align: center;
			    font-size: 40px;
			    line-height: 1;
			    color: #333;
			}
		';
        echo $standard_styles.''.$inline_styles;
  	}
	function render( $attrs, $content = null, $render_slug ) {
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$author                 = $this->props['author'];
		$job_title              = $this->props['job_title'];
		$portrait_url           = $this->props['portrait_url'];
		$company_name           = $this->props['company_name'];
		$url                    = $this->props['url'];
		$quote_icon             = $this->props['quote_icon'];
		$url_new_window         = $this->props['url_new_window'];
		$use_background_color   = $this->props['use_background_color'];
		$background_color       = $this->props['background_color'];
		$background_layout      = $this->props['background_layout'];
		$quote_icon_color       = $this->props['quote_icon_color'];
		$quote_icon_background_color = $this->props['quote_icon_background_color'];
		$portrait_width         = $this->props['portrait_width'];
		$portrait_height        = $this->props['portrait_height'];

		if ( '' !== $portrait_width ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_testimonial_portrait',
				'declaration' => sprintf(
					'width: %1$s;',
					esc_html( et_builder_process_range_value( $portrait_width ) )
				),
			) );
		}

		if ( '' !== $portrait_height ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_testimonial_portrait',
				'declaration' => sprintf(
					'height: %1$s;',
					esc_html( et_builder_process_range_value( $portrait_height ) )
				),
			) );
		}

		$style = '';

		if ( 'on' === $use_background_color && ! $this->_is_field_default( 'background_color', $background_color ) ) {
			$style .= sprintf(
				'background-color: %1$s !important; ',
				esc_html( $background_color )
			);
		}

		if ( '' !== $style ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%%.et_pb_testimonial',
				'declaration' => rtrim( $style ),
			) );
		}

		if ( '' !== $quote_icon_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%%.et_pb_testimonial:before',
				'declaration' => sprintf(
					'color: %1$s;',
					esc_html( $quote_icon_color )
				),
			) );
		}

		if ( '' !== $quote_icon_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%%.et_pb_testimonial:before',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $quote_icon_background_color )
				),
			) );
		}

		$portrait_image = '';

		$video_background = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		if ( '' !== $portrait_url ) {
			$portrait_image = sprintf(
				'<div class="et_pb_testimonial_portrait" style="background-image: url(%1$s);">
				</div>',
				esc_attr( $portrait_url )
			);
		}

		if ( '' !== $url && ( '' !== $company_name || '' !== $author ) ) {
			$link_output = sprintf( '<a href="%1$s"%3$s>%2$s</a>',
				esc_url( $url ),
				( '' !== $company_name ? esc_html( $company_name ) : esc_html( $author ) ),
				( 'on' === $url_new_window ? ' target="_blank"' : '' )
			);

			if ( '' !== $company_name ) {
				$company_name = $link_output;
			} else {
				$author = $link_output;
			}
		}

		// Images: Add CSS Filters and Mix Blend Mode rules (if set)
		if ( array_key_exists( 'image', $this->advanced_fields ) && array_key_exists( 'css', $this->advanced_fields['image'] ) ) {
			$this->add_classname( $this->generate_css_filters(
				$render_slug,
				'child_',
				self::$data_utils->array_get( $this->advanced_fields['image']['css'], 'main', '%%order_class%%' )
			) );
		}

		// Module classnames
		$this->add_classname( array(
			'clearfix',
			"et_pb_bg_layout_{$background_layout}",
			$this->get_text_orientation_classname(),
		) );

		if ( 'off' === $quote_icon ) {
			$this->add_classname( 'et_pb_icon_off' );
		}

		if ( '' === $portrait_image ) {
			$this->add_classname( 'et_pb_testimonial_no_image' );
		}

		if ( 'off' === $use_background_color ) {
			$this->add_classname( 'et_pb_testimonial_no_bg' );
		}

		$output = sprintf(
			'<div%3$s class="%4$s amp-tstml-container et_pd_testimon">
			  	%7$s
			  	<p class="et_pb_tstmnl">%1$s</p>
			  	<p><strong class="et_pb_testimonial_author">%2$s.</strong></p>
			  	<p class="et_pb_testimonial_meta">%5$s%6$s</p>
			</div>',
			$this->content,
			$author,
			$this->module_id(),
			$this->module_classname( $render_slug ),
			( '' !== $job_title ? esc_html( $job_title ) : '' ),
			( '' !== $company_name
				? sprintf( '%2$s%1$s',
					$company_name,
					( '' !== $job_title ? ', ' : '' )
				)
				: ''
			),
			( '' !== $portrait_image ? $portrait_image : '' ),
			( 'on' === $use_background_color
				? sprintf( ' style="background-color: %1$s;"', esc_attr( $background_color ) )
				: ''
			),
			$video_background,
			$parallax_image_background
		);

		return $output;
	}
}

$testimonialObj = new AMP_ET_Builder_Module_Testimonial();
remove_shortcode( 'et_pb_testimonial' );
add_shortcode( 'et_pb_testimonial', array( $testimonialObj, '_render'));
}