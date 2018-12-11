<?php

class AMP_ET_Builder_Module_Video_Slider extends ET_Builder_Module {
	function init() {
		$this->name            = esc_html__( 'Video Slider', 'et_builder' );
		$this->slug            = 'et_pb_video_slider';
		$this->vb_support 	   = 'on';
		$this->child_slug      = 'et_pb_video_slider_item';
		$this->child_item_text = esc_html__( 'Video', 'et_builder' );
		$this->main_css_element = '.et_pb_video_slider%%order_class%%';
		$this->has_box_shadow  = false;
		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'elements' => esc_html__( 'Elements', 'et_builder' ),
					'overlay'  => esc_html__( 'Overlay', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'colors' => esc_html__( 'Controls Colors', 'et_builder' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'play_button' => array(
				'label'    => esc_html__( 'Play Button', 'et_builder' ),
				'selector' => '.et_pb_video_play',
			),
			'thumbnail_item' => array(
				'label'    => esc_html__( 'Thumbnail Item', 'et_builder' ),
				'selector' => '.et_pb_carousel_item',
			),
			'arrows' => array(
				'label'    => esc_html__( 'Slider Arrows', 'et_builder' ),
				'selector' => '.et-pb-slider-arrows a',
			),
		);

		$this->advanced_fields = array(
			'borders'               => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .et_pb_slider, {$this->main_css_element} .et_pb_carousel_item",
							'border_styles' => "{$this->main_css_element} .et_pb_slider, {$this->main_css_element} .et_pb_carousel_item",
						),
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => array( 'custom_margin' ), // needed to overwrite last module margin-bottom styling
				),
			),
			'fonts'                 => false,
			'text'                  => false,
			'button'                => false,
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'gwTruYDcxoE' ),
				'name' => esc_html__( 'An introduction to the Video Slider module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'show_image_overlay' => array(
				'label'           => esc_html__( 'Show Image Overlays on Main Video', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on' => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'off',
				'toggle_slug'     => 'overlay',
				'description'     => esc_html__( 'This option will cover the player UI on the main video. This image can either be uploaded in each video setting or auto-generated by Divi.', 'et_builder' ),
			),
			'show_arrows' => array(
				'label'           => esc_html__( 'Show Arrows', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'        => 'elements',
				'description'        => esc_html__( 'This setting will turn on and off the navigation arrows.', 'et_builder' ),
			),
			'show_thumbnails' => array(
				'label'             => esc_html__( 'Slider Controls', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Use Thumbnail Track', 'et_builder' ),
					'off' => esc_html__( 'Use Dot Navigation', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'        => 'elements',
				'description'        => esc_html__( 'This setting will let you choose to use the thumbnail track controls below the slider or dot navigation at the bottom of the slider.', 'et_builder' ),
			),
			'controls_color' => array(
				'label'             => esc_html__( 'Slider Controls Color', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'color_option',
				'options'           => array(
					'light' => esc_html__( 'Light', 'et_builder' ),
					'dark'  => esc_html__( 'Dark', 'et_builder' ),
				),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'colors',
				'description'       => esc_html__( 'This setting will make your slider controls either light or dark in color. Slider controls are either the arrows on the thumbnail track or the circles in dot navigation.', 'et_builder' ),
			),
			'play_icon_color' => array(
				'label'             => esc_html__( 'Play Icon Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'colors',
			),
			'thumbnail_overlay_color' => array(
				'label'             => esc_html__( 'Thumbnail Overlay Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'colors',
			),
		);
		return $fields;
	}

	function before_render() {
		global $et_pb_slider_image_overlay;

		$show_image_overlay = $this->props['show_image_overlay'];

		$et_pb_slider_image_overlay = $show_image_overlay;

	}
	public function amp_divi_inline_styles(){
    
		$inline_styles = '';
        echo $inline_styles;
  	}
	function render( $attrs, $content = null, $render_slug ) {
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$show_arrows        = $this->props['show_arrows'];
		$show_thumbnails    = $this->props['show_thumbnails'];
		$controls_color     = $this->props['controls_color'];
		$play_icon_color = $this->props['play_icon_color'];
		$thumbnail_overlay_color = $this->props['thumbnail_overlay_color'];

		global $et_pb_slider_image_overlay;

		$video_background          = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		if ( '' !== $play_icon_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_video_play, %%order_class%% .et_pb_carousel .et_pb_video_play',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $play_icon_color )
				),
			) );
		}

		if ( '' !== $thumbnail_overlay_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_carousel_item .et_pb_video_overlay_hover:hover, %%order_class%%.et_pb_video_slider .et_pb_slider:hover .et_pb_video_overlay_hover, %%order_class%% .et_pb_carousel_item.et-pb-active-control .et_pb_video_overlay_hover',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $thumbnail_overlay_color )
				),
			) );
		}

		$slider_classname  = '';
		$slider_classname .= 'off' === $show_arrows ? ' et_pb_slider_no_arrows' : '';
		$slider_classname .= 'on' === $show_thumbnails ? ' et_pb_slider_carousel et_pb_slider_no_pagination' : '';
		$slider_classname .= 'off' === $show_thumbnails ? ' et_pb_slider_dots' : '';
		$slider_classname .= " et_pb_controls_{$controls_color}";

		$content = $this->content;

		// Module classnames
		if ( $this->has_box_shadow ) {
			$this->add_classname( 'et_pb_has_box_shadow' );
		}

		$output = sprintf(
			'<amp-carousel %3$s controls class="%4$s" type="slides" width="400" height="300" layout="responsive" [slide]="selectedSlide" on="slideChange:AMP.setState({selectedSlide: event.index})">
				%2$s
			</amp-carousel>',
			esc_attr( $slider_classname ),
			$content,
			$this->module_id(),
			$this->module_classname( $render_slug ),
			$video_background,
			$parallax_image_background
		);

		return $output;
	}

	public function process_box_shadow( $function_name ) {
		/**
		 * @var ET_Builder_Module_Field_BoxShadow $boxShadow
		 */
		$boxShadow        = ET_Builder_Module_Fields_Factory::get( 'BoxShadow' );
		$class            = '.' . self::get_module_order_class( $function_name );
		$selector         = "$class>.et_pb_slider, $class>.et_pb_carousel .et_pb_carousel_item";
		$box_shadow_style = $boxShadow->get_style( $selector, $this->props );

		$this->has_box_shadow = isset( $box_shadow_style['declaration'] ) && '' !== trim( $box_shadow_style['declaration'] );

		self::set_style( $function_name, $box_shadow_style );
	}
}

$videSliderObj = new AMP_ET_Builder_Module_Video_Slider();
remove_shortcode( 'et_pb_video_slider' );
add_shortcode( 'et_pb_video_slider', array($videSliderObj, '_render'));
