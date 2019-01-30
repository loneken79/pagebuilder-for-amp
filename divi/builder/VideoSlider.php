<?php
if(class_exists('ET_Builder_Module_Video_Slider')){
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
    	$standard_styles = '/* Video Slider Module */
.et_pb_video_slider {
	position: relative;
}

.et_pb_video_slider .et_pb_slider:hover .et_pb_video_overlay_hover {
	background: rgba(0, 0, 0, 0.6);
}

.et_pb_video_slider .et_pb_slider_dots.et_pb_controls_light ~ .et-pb-controllers a {
	background-color: rgba(255, 255, 255, 0.5);
}

.et_pb_video_slider .et_pb_slider_dots.et_pb_controls_light ~ .et-pb-controllers .et-pb-active-control {
	background-color: #fff !important;
}

.et_pb_video_slider .et_pb_slider_dots.et_pb_controls_dark ~ .et-pb-controllers a {
	background-color: rgba(51, 51, 51, 0.5);
}

.et_pb_video_slider .et_pb_slider_dots.et_pb_controls_dark ~ .et-pb-controllers .et-pb-active-control {
	background-color: #333 !important;
}

.et_pb_video_slider .et_pb_controls_dark .et-pb-slider-arrows {
	color: #333;
}

.et_pb_video_slider .et-pb-controllers-has-video-tag.et-pb-controllers {
	bottom: 35px;
}

.et_pb_video_slider.et_pb_has_box_shadow .et_pb_carousel,
.et_pb_video_slider.et_pb_has_box_shadow .et_pb_carousel .et_pb_carousel_items {
	overflow: visible;
}

.et_pb_video_slider.et_pb_has_box_shadow .et_pb_carousel_items .et-carousel-group .item-fade-out {
	opacity: 0;
	background: transparent !important;
	box-shadow: none !important;
	-webkit-animation-name: et_pb_video_slider_item_fade_out;
	animation-name: et_pb_video_slider_item_fade_out;
	-webkit-animation-duration: 200ms;
	-moz-animation-duration: 200ms;
	-o-animation-duration: 200ms;
	animation-duration: 200ms;
}

.et_pb_video_slider.et_pb_has_box_shadow .et_pb_carousel_items .et-carousel-group .item-fade-out .et_pb_video_overlay {
	-webkit-animation-name: et_pb_video_slider_item_overlay_fade_out;
	animation-name: et_pb_video_slider_item_overlay_fade_out;
	-webkit-animation-duration: 200ms;
	-moz-animation-duration: 200ms;
	-o-animation-duration: 200ms;
	animation-duration: 200ms;
}

.et_pb_video_slider.et_pb_has_box_shadow .et_pb_carousel_items .et-carousel-group.prev .et_pb_carousel_item,
.et_pb_video_slider.et_pb_has_box_shadow .et_pb_carousel_items .et-carousel-group.next .et_pb_carousel_item {
	opacity: 0;
}

.et_pb_video_slider.et_pb_has_box_shadow .et_pb_carousel_items .et-carousel-group .et_pb_carousel_item.item-fade-in {
	display: block;
	opacity: 1;
	-webkit-animation-name: et_pb_video_slider_item_fade_in;
	animation-name: et_pb_video_slider_item_fade_in;
	-webkit-animation-duration: 400ms;
	-moz-animation-duration: 400ms;
	-o-animation-duration: 400ms;
	animation-duration: 400ms;
}

.et-pb-is-sliding-carousel {
	overflow-x: hidden;
}

.et_pb_carousel {
	overflow: hidden;
	position: relative;
	margin-top: 2%;
}

.et_pb_carousel:hover .et-pb-arrow-prev {
	left: 10px;
	opacity: 1;
}

.et_pb_carousel:hover .et-pb-arrow-next {
	right: 10px;
	opacity: 1;
}

.et_pb_slider_carousel {
	margin-bottom: 0 !important;
}

.et_pb_slider_carousel.et_pb_controls_light + .et_pb_carousel .et-pb-arrow-prev,
.et_pb_slider_carousel.et_pb_controls_light + .et_pb_carousel .et-pb-arrow-next,
.et_pb_slider_carousel.et_pb_controls_light + .et_pb_carousel .et_pb_video_play {
	color: #fff;
}

.et_pb_slider_carousel.et_pb_controls_dark .et-pb-arrow-prev,
.et_pb_slider_carousel.et_pb_controls_dark .et-pb-arrow-next,
.et_pb_slider_carousel.et_pb_controls_dark + .et_pb_carousel .et-pb-arrow-prev,
.et_pb_slider_carousel.et_pb_controls_dark + .et_pb_carousel .et-pb-arrow-next,
.et_pb_slider_carousel.et_pb_controls_dark + .et_pb_carousel .et_pb_video_play {
	color: #333;
}

.et_pb_carousel_items {
	overflow: hidden;
	position: relative;
	width: 100%;
	height: auto;
}

.et_pb_carousel_items .et-carousel-group {
	display: none;
	float: left;
	position: relative;
	width: 100%;
}

.et_pb_carousel_items .et-carousel-group.active {
	display: block;
}

.et_pb_carousel_items .et-carousel-group.active .et_pb_carousel_item:last-child {
	margin-right: 0;
}

.et_pb_carousel_item {
	display: none;
	float: left;
	position: relative;
	margin: 0 2% 0 0;
	padding: 0;
	background: rgba(0, 0, 0, 0.25);
}

.et_pb_carousel_items.columns-6 .et_pb_carousel_item {
	width: 15%;
}

.et_pb_carousel_items.columns-5 .et_pb_carousel_item {
	width: 18.4%;
}

.et_pb_carousel_items.columns-4 .et_pb_carousel_item {
	width: 23.5%;
}

.et_pb_carousel_items.columns-3 .et_pb_carousel_item {
	width: 32%;
}

.et_pb_carousel_items.columns-2 .et_pb_carousel_item {
	width: 49%;
}

.et_pb_carousel_items.columns-1 .et_pb_carousel_item {
	width: 100%;
}

.et_pb_carousel_item:after {
	display: block;
	padding-top: 75%;
	content: "";
}

.et_pb_carousel_item .et_pb_video_overlay {
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
}

.et_pb_carousel_item.et-pb-active-control .et_pb_video_overlay_hover {
	background: rgba(0, 0, 0, 0.6);
}

.et_pb_carousel_item .et_pb_video_play {
	opacity: 0;
	-webkit-transition: all 0.5s ease-in-out;
	-moz-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	transition: all 0.5s ease-in-out;
}

.et_pb_carousel_item .et_pb_video_overlay:hover .et_pb_video_play {
	opacity: 1;
}

.et_pb_carousel_item .et_pb_video_overlay_hover:hover {
	background: rgba(0, 0, 0, 0.6);
}

@-webkit-keyframes et_pb_video_slider_item_fade_out {
	from {
		opacity: 1;
	}

	to {
		opacity: 0;
	}
}

@keyframes et_pb_video_slider_item_fade_out {
	from {
		opacity: 1;
	}

	to {
		opacity: 0;
	}
}

@-webkit-keyframes et_pb_video_slider_item_overlay_fade_out {
	from {
		transform: scale(1);
	}

	to {
		transform: scale(0.8);
	}
}

@keyframes et_pb_video_slider_item_overlay_fade_out {
	from {
		transform: scale(1);
	}

	to {
		transform: scale(0.8);
	}
}

@-webkit-keyframes et_pb_video_slider_item_fade_in {
	from {
		opacity: 0;
		transform: scale(0.8);
	}

	to {
		opacity: 1;
		transform: scale(1);
	}
}

@keyframes et_pb_video_slider_item_fade_in {
	from {
		opacity: 0;
		transform: scale(0.8);
	}

	to {
		opacity: 1;
		transform: scale(1);
	}
}
';
		$inline_styles = '';
        echo $standard_styles.''.$inline_styles;
  	}
  	function amp_divi_pagebuilder_scripts($data){
  		$data['amp_component_scripts']['amp-carousel'] = 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js';
  		$data['amp_component_scripts']['amp-video'] = 'https://cdn.ampproject.org/v0/amp-video-0.1.js';
  		$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
  		return $data;
  	}
  	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}
	function render( $attrs, $content = null, $render_slug ) {
		add_filter('amp_post_template_data', [$this, 'amp_divi_pagebuilder_scripts']);
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
			'<amp-carousel %3$s class="%4$s" type="slides" width="400" height="300" layout="responsive">
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

	// public function process_box_shadow( $function_name ) {
	// 	/**
	// 	 * @var ET_Builder_Module_Field_BoxShadow $boxShadow
	// 	 */
	// 	$boxShadow        = ET_Builder_Module_Fields_Factory::get( 'BoxShadow' );
	// 	$class            = '.' . self::get_module_order_class( $function_name );
	// 	$selector         = "$class>.et_pb_slider, $class>.et_pb_carousel .et_pb_carousel_item";
	// 	$box_shadow_style = $boxShadow->get_style( $selector, $this->props );

	// 	$this->has_box_shadow = isset( $box_shadow_style['declaration'] ) && '' !== trim( $box_shadow_style['declaration'] );

	// 	self::set_style( $function_name, $box_shadow_style );
	// }
}

$videSliderObj = new AMP_ET_Builder_Module_Video_Slider();
remove_shortcode( 'et_pb_video_slider' );
add_shortcode( 'et_pb_video_slider', array($videSliderObj, '_render'));
}