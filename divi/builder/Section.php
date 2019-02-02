<?php
if(class_exists('ET_Builder_Section')){
class AMP_ET_Builder_Section extends ET_Builder_Structure_Element {
	public $ampSectionAtts = array();
	public $ampSectionProps = array();
	public $_render_count = 0;
	function init() {
		$this->name = esc_html__( 'Section', 'et_builder' );
		$this->slug = 'et_pb_section';
		$this->vb_support = 'on';

		$this->settings_modal_toggles = array(
			'general' => array(
				'toggles' => array(
					'background'     => array(
						'title'       => esc_html__( 'Background', 'et_builder' ),
						'sub_toggles' => array(
							'main'     => '',
							'column_1' => array( 'name' => esc_html__( 'Column 1', 'et_builder' ) ),
							'column_2' => array( 'name' => esc_html__( 'Column 2', 'et_builder' ) ),
							'column_3' => array( 'name' => esc_html__( 'Column 3', 'et_builder' ) ),
						),
					),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'layout'          => esc_html__( 'Layout', 'et_builder' ),
					'width'           => array(
						'title'    => esc_html__( 'Sizing', 'et_builder' ),
						'priority' => 65,
					),
					'margin_padding'  => array(
						'title'       => esc_html__( 'Spacing', 'et_builder' ),
						'sub_toggles' => array(
							'main'     => '',
							'column_1' => array( 'name' => esc_html__( 'Column 1', 'et_builder' ) ),
							'column_2' => array( 'name' => esc_html__( 'Column 2', 'et_builder' ) ),
							'column_3' => array( 'name' => esc_html__( 'Column 3', 'et_builder' ) ),
						),
						'priority'   => 70,
					),
				),
			),
			'custom_css' => array(
				'toggles' => array(
					'classes' => array(
						'title'  => esc_html__( 'CSS ID & Classes', 'et_builder' ),
						'sub_toggles' => array(
							'main'     => '',
							'column_1' => array( 'name' => esc_html__( 'Column 1', 'et_builder' ) ),
							'column_2' => array( 'name' => esc_html__( 'Column 2', 'et_builder' ) ),
							'column_3' => array( 'name' => esc_html__( 'Column 3', 'et_builder' ) ),
						),
					),
					'custom_css' => array(
						'title'  => esc_html__( 'Custom CSS', 'et_builder' ),
						'sub_toggles' => array(
							'main'     => '',
							'column_1' => array( 'name' => esc_html__( 'Column 1', 'et_builder' ) ),
							'column_2' => array( 'name' => esc_html__( 'Column 2', 'et_builder' ) ),
							'column_3' => array( 'name' => esc_html__( 'Column 3', 'et_builder' ) ),
						),
					),
				),
			),
		);

		$this->advanced_fields = array(
			'background' => array(
				'use_background_color'          => 'fields_only',
				'use_background_image'          => true,
				'use_background_color_gradient' => true,
				'use_background_video'          => true,
				'css'                           => array(
					'important' => 'all',
					'main'      => 'div.et_pb_section%%order_class%%',
				),
				'options'    => array(
					'background_color' => array(
						'default' => '',
					),
					'allow_player_pause' => array(
						'default_on_front' => 'off',
					),
					'background_video_pause_outside_viewport' => array(
						'default_on_front' => 'on',
					),
					'parallax' => array(
						'default_on_front' => 'off',
					),
					'parallax_method' => array(
						'default_on_front' => 'on',
					),
				),
			),
			'max_width'  => array(
				'css' => array(
					'module_alignment' => '%%order_class%%',
				),
				'options' => array(
					'module_alignment' => array(
						'label' => esc_html__( 'Section Alignment', 'et_builder' ),
					),
				),
			),
			'fonts'      => false,
			'text'       => false,
			'button'     => false,
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( '3kmJ_mMVB1w' ),
				'name' => esc_html__( 'An introduction to Sections', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'inner_shadow' => array(
				'label'           => esc_html__( 'Show Inner Shadow', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'default'         => 'off',
				'description'     => esc_html__( 'Here you can select whether or not your section has an inner shadow. This can look great when you have colored backgrounds or background images.', 'et_builder' ),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'layout',
				'default_on_front'=> 'off',
			),
			'make_fullwidth' => array(
				'label'             => esc_html__( 'Make This Section Fullwidth', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'layout',
				'options'           => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'default'           => 'off',
				'depends_show_if'   => 'off',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'width',
				'specialty_only'    => 'yes',
			),
			'use_custom_width' => array(
				'label'             => esc_html__( 'Use Custom Width', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'layout',
				'options'           => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'default'           => 'off',
				'affects'           => array(
					'make_fullwidth',
					'custom_width',
					'width_unit',
				),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'width',
				'specialty_only'    => 'yes',
			),
			'width_unit' => array(
				'label'             => esc_html__( 'Unit', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'layout',
				'options'           => array(
					'on'  => esc_html__( 'px', 'et_builder' ),
					'off' => '%',
				),
				'default'           => 'on',
				'button_options'    => array(
					'button_type' => 'equal',
				),
				'depends_show_if'   => 'on',
				'affects'           => array(
					'custom_width_px',
					'custom_width_percent',
				),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'width',
				'specialty_only'    => 'yes',
			),
			'custom_width_px' => array(
				'default'             => '1080px',
				'label'               => esc_html__( 'Custom Width', 'et_builder' ),
				'type'                => 'range',
				'option_category'     => 'layout',
				'depends_show_if_not' => 'off',
				'validate_unit'       => true,
				'fixed_unit'          => 'px',
				'range_settings'      => array(
					'min'  => 500,
					'max'  => 2600,
					'step' => 1,
				),
				'tab_slug'            => 'advanced',
				'toggle_slug'         => 'width',
				'specialty_only'      => 'yes',
			),
			'custom_width_percent' => array(
				'default'         => '80%',
				'label'           => esc_html__( 'Custom Width', 'et_builder' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'depends_show_if' => 'off',
				'validate_unit'   => true,
				'fixed_unit'      => '%',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'width',
				'specialty_only'  => 'yes',
			),
			'make_equal' => array(
				'label'             => esc_html__( 'Equalize Column Heights', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'layout',
				'options'           => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'default'           => 'off',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'width',
				'specialty_only'    => 'yes',
			),
			'use_custom_gutter' => array(
				'label'             => esc_html__( 'Use Custom Gutter Width', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'layout',
				'options'           => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'default'           => 'off',
				'affects'           => array(
					'gutter_width',
				),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'width',
				'specialty_only'    => 'yes',
			),
			'gutter_width' => array(
				'label'            => esc_html__( 'Gutter Width', 'et_builder' ),
				'type'             => 'range',
				'option_category'  => 'layout',
				'range_settings'   => array(
					'min'  => 1,
					'max'  => 4,
					'step' => 1,
				),
				'depends_show_if'  => 'on',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'width',
				'specialty_only'   => 'yes',
				'validate_unit'    => false,
				'fixed_range'      => true,
				'default_on_front' => et_get_option( 'gutter_width', 3 ),
			),
			'columns_background' => array(
				'type'            => 'column_settings_background',
				'option_category' => 'configuration',
				'toggle_slug'     => 'background',
				'specialty_only'  => 'yes',
				'priority'        => 99,
			),
			'columns_padding' => array(
				'type'            => 'column_settings_padding',
				'option_category' => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'margin_padding',
				'specialty_only'  => 'yes',
				'priority'        => 99,
			),
			'fullwidth' => array(
				'type'    => 'hidden',
				'default_on_front' => 'off',
			),
			'specialty' => array(
				'type'    => 'skip',
				'default_on_front' => 'off',
			),
			'columns_css' => array(
				'type'            => 'column_settings_css',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'toggle_slug'     => 'custom_css',
				'priority'        => 20,
			),
			'columns_css_fields' => array(
				'type'            => 'column_settings_css_fields',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'toggle_slug'     => 'classes',
				'priority'        => 20,
			),
			'custom_padding_last_edited' => array(
				'type'           => 'skip',
				'tab_slug'       => 'advanced',
				'specialty_only' => 'yes',
			),
			'__video_background' => array(
				'type' => 'computed',
				'computed_callback' => array( 'ET_Builder_Section', 'get_video_background' ),
				'computed_depends_on' => array(
					'background_video_mp4',
					'background_video_webm',
					'background_video_width',
					'background_video_height',
				),
				'computed_minimum' => array(
					'background_video_mp4',
					'background_video_webm',
				),
			),
			'prev_background_color' => array(
				'type' => 'skip',
			),
			'next_background_color' => array(
				'type' => 'skip',
			),
		);

		$column_fields = $this->get_column_fields( 3, array(
			'parallax'                                   => array(
				'default_on_front' => 'off',
			),
			'parallax_method'                            => array(
				'default_on_front' => 'on',
			),
			'background_color'                           => array(),
			'bg_img'                                     => array(),
			'background_size'                            => array(),
			'background_position'                        => array(),
			'background_repeat'                          => array(),
			'background_blend'                           => array(),
			'padding_top'                                => array(),
			'padding_right'                              => array(),
			'padding_bottom'                             => array(),
			'padding_left'                               => array(),
			'padding_%column_index%_tablet'              => array( 'has_custom_index_location' => true ),
			'padding_%column_index%_phone'               => array( 'has_custom_index_location' => true ),
			'padding_%column_index%_last_edited'         => array( 'has_custom_index_location' => true ),
			'module_id'                                  => array(),
			'module_class'                               => array(),
			'custom_css_before'                          => array(),
			'custom_css_main'                            => array(),
			'custom_css_after'                           => array(),
			'use_background_color_gradient'              => array(),
			'background_color_gradient_start'            => array(),
			'background_color_gradient_end'              => array(),
			'background_color_gradient_type'             => array(),
			'background_color_gradient_direction'        => array(),
			'background_color_gradient_direction_radial' => array(),
			'background_color_gradient_start_position'   => array(),
			'background_color_gradient_end_position'     => array(),
			'background_color_gradient_overlays_image'   => array(),
			'background_video_mp4'                       => array(
				'computed_affects' => array(
					'__video_background',
				),
			),
			'background_video_webm'                      => array(
				'computed_affects' => array(
					'__video_background',
				),
			),
			'background_video_width'                     => array(
				'computed_affects' => array(
					'__video_background',
				),
			),
			'background_video_height'                    => array(
				'computed_affects' => array(
					'__video_background',
				),
			),
			'allow_player_pause'                         => array(
				'computed_affects' => array(
					'__video_background',
				),
			),
			'background_video_pause_outside_viewport'    => array(
				'computed_affects'   => array(
					'__video_background',
				),
			),
			'__video_background'                         => array(
				'type'                => 'computed',
				'computed_callback'   => array(
					'ET_Builder_Column',
					'get_column_video_background'
				),
				'computed_depends_on' => array(
					'background_video_mp4',
					'background_video_webm',
					'background_video_width',
					'background_video_height',
				),
				'computed_minimum'    => array(
					'background_video_mp4',
					'background_video_webm',
				),
			),
		) );

		return array_merge( $fields, $column_fields );
	}
	function amp_divi_inline_styles(){
		
		$sectionProps = $this->ampSectionProps;
		$sectionAtts = $this->ampSectionAtts;
		//print_r($sectionProps);
		// print_r($sectionAtts);
		// die;
		$section_css = '';
		$section_main_css = '';
		foreach($sectionAtts as $uniqueKey => $properties){
			$border_width_all = '';
			if(isset($sectionAtts[$uniqueKey]['border_width_all'])){
				$border_width_all = 'border-width:'.$sectionAtts[$uniqueKey]['border_width_all'].';';
			}
			$border_color_all = '';
			if( isset($sectionAtts[$uniqueKey]['border_color_all']) ){
				$border_color_all = 'border-color:'.$sectionAtts[$uniqueKey]['border_color_all'].';';
			}
			$border_style_all = '';
			if( isset($sectionAtts[$uniqueKey]['border_style_all']) ){
				$border_style_all = 'border-style:'.$sectionAtts[$uniqueKey]['border_style_all'].';';
			}
			$background_color = '';
			if(isset($sectionAtts[$uniqueKey]['background_color'])){
				$background_color = 'background-color:'.$sectionAtts[$uniqueKey]['background_color'].';';
			}
			$background_image = '';
			if(isset($sectionAtts[$uniqueKey]['background_image'])){
				$background_image = 'background-image:url('.$sectionAtts[$uniqueKey]['background_image'].');';
			}
			if( $sectionAtts[$uniqueKey]['use_background_color_gradient'] == 'on' ){
				$start_grad = $sectionProps[$uniqueKey]['background_color_gradient_start'];
				$end_grad = $sectionProps[$uniqueKey]['background_color_gradient_end'];
				
				if($sectionProps[$uniqueKey]['background_color_gradient_type'] == 'linear'){
					$direction = $sectionProps[$uniqueKey]['background_color_gradient_direction'];
					$gradient_style = 'linear-gradient('.$direction.','.$start_grad.' 0%,'.$end_grad.' 100%)';
				}
				if($sectionProps[$uniqueKey]['background_color_gradient_type'] == 'radial'){
					$direction = $sectionProps[$uniqueKey]['background_color_gradient_direction_radial'];
					$gradient_style = 'radial-gradient(circle at '.$direction.','.$start_grad.' 0%,'.$end_grad.' 100%)';
				}
				if(isset($sectionAtts[$uniqueKey]['background_image'])){
					if($sectionProps[$uniqueKey]['background_color_gradient_overlays_image'] == 'on'){
						if(isset($sectionAtts[$uniqueKey]['background_image'])){
							$background_image = 'background-image:'.$gradient_style.',url('.$sectionAtts[$uniqueKey]['background_image'].');';
						}
					}
					if($sectionProps[$uniqueKey]['background_color_gradient_overlays_image'] == 'off'){
						if(isset($sectionAtts[$uniqueKey]['background_image'])){
							$background_image = 'background-image:url('.$sectionAtts[$uniqueKey]['background_image'].'),'.$gradient_style.';';
						}
					}
				}else{
					$background_image = 'background-image:'.$gradient_style.';';
				}
			}
			$background_blend = '';
			$blend_gradient_color = '';
			if(isset($sectionAtts[$uniqueKey]['background_blend'])){
				$background_blend = 'background-blend-mode:'.$sectionAtts[$uniqueKey]['background_blend'].';';
				if(isset($sectionAtts[$uniqueKey]['use_background_color_gradient'])){
					$blend_gradient_color = 'background-color:initial;';
				}
			}
			$background_position = '';
			if(isset($sectionAtts[$uniqueKey]['background_image'])){
				$background_position = 'background-position:'.str_replace('_', ' ', $sectionAtts[$uniqueKey]['background_position']).';';
			}
			$background_size = '';
			if(isset($sectionAtts[$uniqueKey]['background_size'])){
				$background_size = 'background-size:'.$sectionAtts[$uniqueKey]['background_size'].';';
			}
			$border_radii = '';
			if(isset($sectionAtts[$uniqueKey]['border_radii'])){
				$radii = explode("|",$sectionAtts[$uniqueKey]['border_radii']);
				if(count($radii)>1){
					$radius = '';
					for($i=1;$i<count($radii);$i++){
						$radius .= $radii[$i].' ';
					}
				}
				$border_radii = 'border-radius:'.$radius.';';
			}
			$max_width = '';
			if(isset($sectionAtts[$uniqueKey]['max_width'])){
				$max_width = 'max-width:'.$sectionAtts[$uniqueKey]['max_width'].';';
			}
			$custom_margin = '';
			if( isset($sectionAtts[$uniqueKey]['custom_margin']) ){
				$margins = explode("|",$sectionAtts[$uniqueKey]['custom_margin']);
				$margins_styles = '';
				if(is_array($margins) && count($margins)>0){
					$margin_top = '';
					if(!empty($margins[0])){
						$margin_top = 'margin-top:'.$margins[0].';';
					}
					$margin_right = '';
					if(!empty($margins[1])){
						$margin_right = 'margin-right:'.$margins[1].';';
					}
					$margin_bottom = '';
					if(!empty($margins[2])){
						$margin_bottom = 'margin-bottom:'.$margins[2].';';
					}
					$margin_left = '';
					if(!empty($margins[3])){
						$margin_left = 'margin-left:'.$margins[3].';';
					}

					$margins_styles .= $margin_top.''.$margin_right.''.$margin_bottom.''.$margin_left;
					
				}
				$custom_margin = $margins_styles;
			}
			$custom_padding = '';
			if( isset($sectionAtts[$uniqueKey]['custom_padding']) ){
				$paddings = explode("|",$sectionAtts[$uniqueKey]['custom_padding']);
				$paddings_styles = '';
				if(is_array($paddings) && count($paddings)>0){
					$padding_top = '';
					if(!empty($paddings[0])){
						$padding_top = 'padding-top:'.$paddings[0].';';
					}
					$padding_right = '';
					if(!empty($paddings[1])){
						$padding_right = 'padding-right:'.$paddings[1].';';
					}
					$padding_bottom = '';
					if(!empty($paddings[2])){
						$padding_bottom = 'padding-bottom:'.$paddings[2].';';
					}
					$padding_left = '';
					if(!empty($paddings[3])){
						$padding_left = 'padding-left:'.$paddings[3].';';
					}
					$paddings_styles .= $padding_top.''.$padding_right.''.$padding_bottom.''.$padding_left;
					
				}
				$custom_padding = $paddings_styles;
			}
			$section_main_css .= '.et_pb_section_'.$uniqueKey.'{';
			$section_main_css .= $border_radii;
			$section_main_css .= $custom_margin;
			$section_main_css .= $custom_padding;
			$section_main_css .= $max_width;
			$section_main_css .= $border_style_all;
			$section_main_css .= $border_color_all;
			$section_main_css .= $border_width_all;
			$section_main_css .='}';
			$section_css .= 'div.et_pb_section.et_pb_section_'.$uniqueKey.'{';
			$section_css .= $background_image;
			$section_css .= $background_position;
			$section_css .= $background_size;
			$section_css .= $background_color;
			$section_css .= $background_blend;
			$section_css .= $blend_gradient_color;
			$section_css .='}';
		}
		echo $section_css.''.$section_main_css;
	}
	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}
	function render( $atts, $content = null, $function_name ) {

		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$uniqueId = $this->render_count();
		$this->ampSectionAtts[$uniqueId] = $atts;
		$this->ampSectionProps[$uniqueId] = $this->props;
		$background_image        = $this->props['background_image'];
		$background_color        = $this->props['background_color'];
		$background_video_mp4    = $this->props['background_video_mp4'];
		$background_video_webm   = $this->props['background_video_webm'];
		$inner_shadow            = $this->props['inner_shadow'];
		$parallax                = $this->props['parallax'];
		$parallax_method         = $this->props['parallax_method'];
		$fullwidth               = $this->props['fullwidth'];
		$specialty               = $this->props['specialty'];
		$background_color_1      = $this->props['background_color_1'];
		$background_color_2      = $this->props['background_color_2'];
		$background_color_3      = $this->props['background_color_3'];
		$bg_img_1                = $this->props['bg_img_1'];
		$bg_img_2                = $this->props['bg_img_2'];
		$bg_img_3                = $this->props['bg_img_3'];
		$background_size_1       = $this->props['background_size_1'];
		$background_size_2       = $this->props['background_size_2'];
		$background_size_3       = $this->props['background_size_3'];
		$background_position_1   = $this->props['background_position_1'];
		$background_position_2   = $this->props['background_position_2'];
		$background_position_3   = $this->props['background_position_3'];
		$background_repeat_1     = $this->props['background_repeat_1'];
		$background_repeat_2     = $this->props['background_repeat_2'];
		$background_repeat_3     = $this->props['background_repeat_3'];
		$background_blend_1      = $this->props['background_blend_1'];
		$background_blend_2      = $this->props['background_blend_2'];
		$background_blend_3      = $this->props['background_blend_3'];
		$parallax_1              = $this->props['parallax_1'];
		$parallax_2              = $this->props['parallax_2'];
		$parallax_3              = $this->props['parallax_3'];
		$parallax_method_1       = $this->props['parallax_method_1'];
		$parallax_method_2       = $this->props['parallax_method_2'];
		$parallax_method_3       = $this->props['parallax_method_3'];
		$padding_top_1           = $this->props['padding_top_1'];
		$padding_right_1         = $this->props['padding_right_1'];
		$padding_bottom_1        = $this->props['padding_bottom_1'];
		$padding_left_1          = $this->props['padding_left_1'];
		$padding_top_2           = $this->props['padding_top_2'];
		$padding_right_2         = $this->props['padding_right_2'];
		$padding_bottom_2        = $this->props['padding_bottom_2'];
		$padding_left_2          = $this->props['padding_left_2'];
		$padding_top_3           = $this->props['padding_top_3'];
		$padding_right_3         = $this->props['padding_right_3'];
		$padding_bottom_3        = $this->props['padding_bottom_3'];
		$padding_left_3          = $this->props['padding_left_3'];
		$padding_1_tablet        = $this->props['padding_1_tablet'];
		$padding_2_tablet        = $this->props['padding_2_tablet'];
		$padding_3_tablet        = $this->props['padding_3_tablet'];
		$padding_1_phone         = $this->props['padding_1_phone'];
		$padding_2_phone         = $this->props['padding_2_phone'];
		$padding_3_phone         = $this->props['padding_3_phone'];
		$padding_1_last_edited   = $this->props['padding_1_last_edited'];
		$padding_2_last_edited   = $this->props['padding_2_last_edited'];
		$padding_3_last_edited   = $this->props['padding_3_last_edited'];
		$gutter_width            = $this->props['gutter_width'];
		$use_custom_width        = $this->props['use_custom_width'];
		$custom_width_px         = $this->props['custom_width_px'];
		$custom_width_percent    = $this->props['custom_width_percent'];
		$width_unit              = $this->props['width_unit'];
		$make_equal              = $this->props['make_equal'];
		$make_fullwidth          = $this->props['make_fullwidth'];
		$global_module           = $this->props['global_module'];
		$use_custom_gutter       = $this->props['use_custom_gutter'];
		$module_id_1             = $this->props['module_id_1'];
		$module_id_2             = $this->props['module_id_2'];
		$module_id_3             = $this->props['module_id_3'];
		$module_class_1          = $this->props['module_class_1'];
		$module_class_2          = $this->props['module_class_2'];
		$module_class_3          = $this->props['module_class_3'];
		$custom_css_before_1     = $this->props['custom_css_before_1'];
		$custom_css_before_2     = $this->props['custom_css_before_2'];
		$custom_css_before_3     = $this->props['custom_css_before_3'];
		$custom_css_main_1       = $this->props['custom_css_main_1'];
		$custom_css_main_2       = $this->props['custom_css_main_2'];
		$custom_css_main_3       = $this->props['custom_css_main_3'];
		$custom_css_after_1      = $this->props['custom_css_after_1'];
		$custom_css_after_2      = $this->props['custom_css_after_2'];
		$custom_css_after_3      = $this->props['custom_css_after_3'];
		$use_background_color_gradient_1              = $this->props['use_background_color_gradient_1'];
		$use_background_color_gradient_2              = $this->props['use_background_color_gradient_2'];
		$use_background_color_gradient_3              = $this->props['use_background_color_gradient_3'];
		$background_color_gradient_type_1             = $this->props['background_color_gradient_type_1'];
		$background_color_gradient_type_2             = $this->props['background_color_gradient_type_2'];
		$background_color_gradient_type_3             = $this->props['background_color_gradient_type_3'];
		$background_color_gradient_direction_1        = $this->props['background_color_gradient_direction_1'];
		$background_color_gradient_direction_2        = $this->props['background_color_gradient_direction_2'];
		$background_color_gradient_direction_3        = $this->props['background_color_gradient_direction_3'];
		$background_color_gradient_direction_radial_1 = $this->props['background_color_gradient_direction_radial_1'];
		$background_color_gradient_direction_radial_2 = $this->props['background_color_gradient_direction_radial_2'];
		$background_color_gradient_direction_radial_3 = $this->props['background_color_gradient_direction_radial_3'];
		$background_color_gradient_start_1            = $this->props['background_color_gradient_start_1'];
		$background_color_gradient_start_2            = $this->props['background_color_gradient_start_2'];
		$background_color_gradient_start_3            = $this->props['background_color_gradient_start_3'];
		$background_color_gradient_end_1              = $this->props['background_color_gradient_end_1'];
		$background_color_gradient_end_2              = $this->props['background_color_gradient_end_2'];
		$background_color_gradient_end_3              = $this->props['background_color_gradient_end_3'];
		$background_color_gradient_start_position_1   = $this->props['background_color_gradient_start_position_1'];
		$background_color_gradient_start_position_2   = $this->props['background_color_gradient_start_position_2'];
		$background_color_gradient_start_position_3   = $this->props['background_color_gradient_start_position_3'];
		$background_color_gradient_end_position_1     = $this->props['background_color_gradient_end_position_1'];
		$background_color_gradient_end_position_2     = $this->props['background_color_gradient_end_position_2'];
		$background_color_gradient_end_position_3     = $this->props['background_color_gradient_end_position_3'];
		$background_color_gradient_overlays_image_1   = $this->props['background_color_gradient_overlays_image_1'];
		$background_color_gradient_overlays_image_2   = $this->props['background_color_gradient_overlays_image_2'];
		$background_color_gradient_overlays_image_3   = $this->props['background_color_gradient_overlays_image_3'];
		$background_video_mp4_1     = $this->props['background_video_mp4_1'];
		$background_video_mp4_2     = $this->props['background_video_mp4_2'];
		$background_video_mp4_3     = $this->props['background_video_mp4_3'];
		$background_video_webm_1    = $this->props['background_video_webm_1'];
		$background_video_webm_2    = $this->props['background_video_webm_2'];
		$background_video_webm_3    = $this->props['background_video_webm_3'];
		$background_video_width_1   = $this->props['background_video_width_1'];
		$background_video_width_2   = $this->props['background_video_width_2'];
		$background_video_width_3   = $this->props['background_video_width_3'];
		$background_video_height_1  = $this->props['background_video_height_1'];
		$background_video_height_2  = $this->props['background_video_height_2'];
		$background_video_height_3  = $this->props['background_video_height_3'];
		$allow_player_pause_1       = $this->props['allow_player_pause_1'];
		$allow_player_pause_2       = $this->props['allow_player_pause_2'];
		$allow_player_pause_3       = $this->props['allow_player_pause_3'];
		$background_video_pause_outside_viewport_1 = $this->props['background_video_pause_outside_viewport_1'];
		$background_video_pause_outside_viewport_2 = $this->props['background_video_pause_outside_viewport_2'];
		$background_video_pause_outside_viewport_3 = $this->props['background_video_pause_outside_viewport_3'];
		$prev_background_color = $this->props['prev_background_color'];
		$next_background_color = $this->props['next_background_color'];

		if ( '' !== $global_module ) {
			$global_content = et_pb_load_global_module( $global_module, '', $prev_background_color, $next_background_color );

			if ( '' !== $global_content ) {
				return do_shortcode( et_pb_fix_shortcodes( wpautop( $global_content ) ) );
			}
		}

		$gutter_class = '';

		if ( 'on' === $specialty ) {
			global $et_pb_all_column_settings, $et_pb_rendering_column_content, $et_pb_rendering_column_content_row;

			$et_pb_all_column_settings_backup = $et_pb_all_column_settings;

			$et_pb_all_column_settings = ! isset( $et_pb_all_column_settings ) ?  array() : $et_pb_all_column_settings;

			if ('on' === $make_equal) {
				$this->add_classname( 'et_pb_equal_columns' );
			}

			if ( 'on' === $use_custom_gutter && '' !== $gutter_width ) {
				$gutter_width = '0' === $gutter_width ? '1' : $gutter_width; // set the gutter to 1 if 0 entered by user
				$gutter_class .= ' et_pb_gutters' . $gutter_width;
			}

			$et_pb_columns_counter = 0;
			$et_pb_column_backgrounds = array(
				array(
					'color'          => $background_color_1,
					'image'          => $bg_img_1,
					'image_size'     => $background_size_1,
					'image_position' => $background_position_1,
					'image_repeat'   => $background_repeat_1,
					'image_blend'    => $background_blend_1,
				),
				array(
					'color'          => $background_color_2,
					'image'          => $bg_img_2,
					'image_size'     => $background_size_2,
					'image_position' => $background_position_2,
					'image_repeat'   => $background_repeat_2,
					'image_blend'    => $background_blend_2,
				),
				array(
					'color'          => $background_color_3,
					'image'          => $bg_img_3,
					'image_size'     => $background_size_3,
					'image_position' => $background_position_3,
					'image_repeat'   => $background_repeat_3,
					'image_blend'    => $background_blend_3,
				),
			);

			$et_pb_column_backgrounds_gradient = array(
				array(
					'active'           => $use_background_color_gradient_1,
					'type'             => $background_color_gradient_type_1,
					'direction'        => $background_color_gradient_direction_1,
					'radial_direction' => $background_color_gradient_direction_radial_1,
					'color_start'      => $background_color_gradient_start_1,
					'color_end'        => $background_color_gradient_end_1,
					'start_position'   => $background_color_gradient_start_position_1,
					'end_position'     => $background_color_gradient_end_position_1,
					'overlays_image'   => $background_color_gradient_overlays_image_1,
				),
				array(
					'active'           => $use_background_color_gradient_2,
					'type'             => $background_color_gradient_type_2,
					'direction'        => $background_color_gradient_direction_2,
					'radial_direction' => $background_color_gradient_direction_radial_2,
					'color_start'      => $background_color_gradient_start_2,
					'color_end'        => $background_color_gradient_end_2,
					'start_position'   => $background_color_gradient_start_position_2,
					'end_position'     => $background_color_gradient_end_position_2,
					'overlays_image'   => $background_color_gradient_overlays_image_2,
				),
				array(
					'active'           => $use_background_color_gradient_3,
					'type'             => $background_color_gradient_type_3,
					'direction'        => $background_color_gradient_direction_3,
					'radial_direction' => $background_color_gradient_direction_radial_3,
					'color_start'      => $background_color_gradient_start_3,
					'color_end'        => $background_color_gradient_end_3,
					'start_position'   => $background_color_gradient_start_position_3,
					'end_position'     => $background_color_gradient_end_position_3,
					'overlays_image'   => $background_color_gradient_overlays_image_3,
				),
			);

			$et_pb_column_backgrounds_video = array(
				array(
					'background_video_mp4'         => $background_video_mp4_1,
					'background_video_webm'        => $background_video_webm_1,
					'background_video_width'       => $background_video_width_1,
					'background_video_height'      => $background_video_height_1,
					'background_video_allow_pause' => $allow_player_pause_1,
					'background_video_pause_outside_viewport' => $background_video_pause_outside_viewport_1,
				),
				array(
					'background_video_mp4'         => $background_video_mp4_2,
					'background_video_webm'        => $background_video_webm_2,
					'background_video_width'       => $background_video_width_2,
					'background_video_height'      => $background_video_height_2,
					'background_video_allow_pause' => $allow_player_pause_2,
					'background_video_pause_outside_viewport' => $background_video_pause_outside_viewport_2,
				),
				array(
					'background_video_mp4'         => $background_video_mp4_3,
					'background_video_webm'        => $background_video_webm_3,
					'background_video_width'       => $background_video_width_3,
					'background_video_height'      => $background_video_height_3,
					'background_video_allow_pause' => $allow_player_pause_3,
					'background_video_pause_outside_viewport' => $background_video_pause_outside_viewport_3,
				),
			);

			$et_pb_column_paddings = array(
				array(
					'padding-top'    => $padding_top_1,
					'padding-right'  => $padding_right_1,
					'padding-bottom' => $padding_bottom_1,
					'padding-left'   => $padding_left_1,
				),
				array(
					'padding-top'    => $padding_top_2,
					'padding-right'  => $padding_right_2,
					'padding-bottom' => $padding_bottom_2,
					'padding-left'   => $padding_left_2,
				),
				array(
					'padding-top'    => $padding_top_3,
					'padding-right'  => $padding_right_3,
					'padding-bottom' => $padding_bottom_3,
					'padding-left'   => $padding_left_3,
				),
			);

			$et_pb_column_paddings_mobile = array(
				array(
					'tablet' => explode( '|', $padding_1_tablet ),
					'phone'  => explode( '|', $padding_1_phone ),
					'last_edited' => $padding_1_last_edited,
				),
				array(
					'tablet' => explode( '|', $padding_2_tablet ),
					'phone'  => explode( '|', $padding_2_phone ),
					'last_edited' => $padding_2_last_edited,
				),
				array(
					'tablet' => explode( '|', $padding_3_tablet ),
					'phone'  => explode( '|', $padding_3_phone ),
					'last_edited' => $padding_3_last_edited,
				),
			);

			$et_pb_column_parallax = array(
				array( $parallax_1, $parallax_method_1 ),
				array( $parallax_2, $parallax_method_2 ),
				array( $parallax_3, $parallax_method_3 ),
			);

			if ( 'on' === $make_fullwidth && 'off' === $use_custom_width ) {
				$this->add_classname('et_pb_specialty_fullwidth');
			}

			if ( 'on' === $use_custom_width ) {
				ET_Builder_Element::set_style( $function_name, array(
					'selector'    => '%%order_class%% > .et_pb_row',
					'declaration' => sprintf(
						'max-width:%1$s !important;
						%2$s',
						'on' === $width_unit ? esc_attr( sprintf( '%1$spx', intval( $custom_width_px ) ) ) : esc_attr( sprintf( '%1$s%%', intval( $custom_width_percent ) ) ),
						'on' !== $width_unit ? esc_attr( sprintf( 'width: %1$s%%;', intval( $custom_width_percent ) ) ) : ''
					),
				) );
			}

			$et_pb_column_css = array(
				'css_class'         => array( $module_class_1, $module_class_2, $module_class_3 ),
				'css_id'            => array( $module_id_1, $module_id_2, $module_id_3 ),
				'custom_css_before' => array( $custom_css_before_1, $custom_css_before_2, $custom_css_before_3 ),
				'custom_css_main'   => array( $custom_css_main_1, $custom_css_main_2, $custom_css_main_3 ),
				'custom_css_after'  => array( $custom_css_after_1, $custom_css_after_2, $custom_css_after_3 ),
			);

			$internal_columns_settings_array = array(
				'keep_column_padding_mobile' => 'on',
				'et_pb_column_backgrounds' => $et_pb_column_backgrounds,
				'et_pb_column_backgrounds_gradient' => $et_pb_column_backgrounds_gradient,
				'et_pb_column_backgrounds_video' => $et_pb_column_backgrounds_video,
				'et_pb_column_parallax' => $et_pb_column_parallax,
				'et_pb_columns_counter' => $et_pb_columns_counter,
				'et_pb_column_paddings' => $et_pb_column_paddings,
				'et_pb_column_paddings_mobile' => $et_pb_column_paddings_mobile,
				'et_pb_column_css' => $et_pb_column_css,
			);

			$current_row_position = $et_pb_rendering_column_content ? 'internal_row' : 'regular_row';

			$et_pb_all_column_settings[ $current_row_position ] = $internal_columns_settings_array;

			if ( $et_pb_rendering_column_content ) {
				$et_pb_rendering_column_content_row = true;
			}
		}

		$background_video = '';

		if ( '' !== $background_video_mp4 || '' !== $background_video_webm ) {
			$background_video = $this->video_background();
		}

		if ( '' !== $background_color && 'rgba(255,255,255,0)' !== $background_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%%.et_pb_section',
				'declaration' => sprintf(
					'background-color:%s !important;',
					esc_attr( $background_color )
				),
			) );
		}

		$is_transparent_background = 'rgba(255,255,255,0)' === $background_color || ( et_is_builder_plugin_active() && '' === $background_color );

		if ( '' !== $background_video_mp4 || '' !== $background_video_webm || ( '' !== $background_color && ! $is_transparent_background ) || '' !== $background_image ) {
			$this->add_classname( 'et_pb_with_background' );
		}

		// Background UI
		if ( 'on' === $parallax ) {
			$this->add_classname( 'et_pb_section_parallax' );
		}

		// CSS Filters
		$this->add_classname( $this->generate_css_filters( $function_name ) );

		if ( 'on' === $inner_shadow && ! ( '' !== $background_image && 'on' === $parallax && 'off' === $parallax_method ) ) {
			$this->add_classname( 'et_pb_inner_shadow' );
		}

		if ( 'on' === $fullwidth ) {
			$this->add_classname( 'et_pb_fullwidth_section' );
		}

		if ( 'on' === $specialty ) {
			$this->add_classname( 'et_section_specialty' );
		} else {
			$this->add_classname( 'et_section_regular' );
		}

		if ( $is_transparent_background ) {
			$this->add_classname( 'et_section_transparent' );
		}

		// Setup for SVG.
		$bottom  = '';
		$top     = '';
		$divider = ET_Builder_Module_Fields_Factory::get( 'Divider' );
		// pass section number for background color usage.
		$divider->count = $this->render_count();

		// Check if style is not default.
		if ( '' !== $this->props['bottom_divider_style'] ) {
			// get an svg for using in ::before
			$divider->process_svg( 'bottom', $this->props );

			// apply responsive styling
			$bottom_divider_responsive = et_pb_get_responsive_status( $this->props['bottom_divider_height_last_edited'] ) || et_pb_get_responsive_status( $this->props['bottom_divider_repeat_last_edited'] );

			if ( $bottom_divider_responsive ) {
				$divider->process_svg( 'bottom', $this->props, 'tablet' );
				$divider->process_svg( 'bottom', $this->props, 'phone' );
			}

			// get the placeholder for the bottom
			$bottom = $divider->get_svg( 'bottom' );

			// add a corresponding class
			$this->add_classname( $divider->classes );
		}

		// Check if style is not default.
		if ( '' !== $this->props['top_divider_style'] ) {
			// process the top section divider.
			$divider->process_svg( 'top', $this->props );

			// apply responsive styling
			$top_divider_responsive = et_pb_get_responsive_status( $this->props['top_divider_height_last_edited'] ) || et_pb_get_responsive_status( $this->props['top_divider_repeat_last_edited'] );

			if ( $top_divider_responsive ) {
				$divider->process_svg( 'top', $this->props, 'tablet' );
				$divider->process_svg( 'top', $this->props, 'phone' );
			}

			// get the placeholder for the top
			$top = $divider->get_svg( 'top' );

			// add a corresponding class
			$this->add_classname( $divider->classes );
		}

		// Remove automatically added classnames
		$this->remove_classname( 'et_pb_module' );

		// Save module classes into variable BEFORE processing the content with `do_shortcode()`
		// Otherwise order classes messed up with internal sections if exist
		$module_classes = $this->module_classname( $function_name );

		$output = sprintf(
			'<div%4$s class="%3$s"%8$s>
				%9$s
				%7$s
				%2$s
				%5$s
					%1$s
				%6$s
				%10$s
			</div> <!-- .et_pb_section -->',
			do_shortcode( et_pb_fix_shortcodes( $content ) ), // 1
			$background_video, // 2
			$module_classes, // 3
			$this->module_id(), // 4
			( 'on' === $specialty ?
				sprintf( '<div class="et_pb_row%1$s">', $gutter_class )
				: '' ), // 5
			( 'on' === $specialty ? '</div> <!-- .et_pb_row -->' : '' ), // 6
			( '' !== $background_image && 'on' === $parallax
				? sprintf(
					'<div class="et_parallax_bg%2$s%3$s" style="background-image: url(%1$s);"></div>',
					esc_attr( $background_image ),
					( 'off' === $parallax_method ? ' et_pb_parallax_css' : '' ),
					( ( 'off' !== $inner_shadow && 'off' === $parallax_method ) ? ' et_pb_inner_shadow' : '' )
				)
				: ''
			), // 7
			$this->get_module_data_attributes(), // 8
			et_esc_previously( $top ), // 9
			et_esc_previously( $bottom ) // 10
			);

		if ( 'on' === $specialty ) {
			// reset the global column settings to make sure they are not affected by internal content
			$et_pb_all_column_settings = $et_pb_all_column_settings_backup;

			if ( $et_pb_rendering_column_content_row ) {
				$et_pb_rendering_column_content_row = false;
			}
		}

	

		return $output;

	}

	public function process_box_shadow( $function_name ) {
		/**
		 * @var ET_Builder_Module_Field_BoxShadow $boxShadow
		 */
		$boxShadow = ET_Builder_Module_Fields_Factory::get( 'BoxShadow' );
		$style = $boxShadow->get_value( $this->props );

		self::set_style( $function_name, array(
			'selector'    => '%%order_class%%',
			'declaration' => $style,
		) );

		if ( ! empty( $style ) && 'none' !== $style && false === strpos( $style, 'inset' ) ) {
			// Make section z-index higher if it has outer box shadow #4762
			self::set_style( $function_name, array(
				'selector'    => '%%order_class%%',
				'declaration' => 'z-index: 10;'
			) );
		}
	}

	private function _keep_box_shadow_compatibility( $function_name ) {
		/**
		 * @var ET_Builder_Module_Field_BoxShadow $box_shadow
		 */
		$box_shadow = ET_Builder_Module_Fields_Factory::get( 'BoxShadow' );
		$utils      = ET_Core_Data_Utils::instance();
		$atts       = $this->props;
		$style      = $box_shadow->get_value( $atts );

		if (
			! empty( $style )
			&&
			! is_admin()
			&&
			version_compare( $utils->array_get( $atts, '_builder_version', '3.0.93' ), '3.0.94', 'lt' )
			&&
			! $box_shadow->is_inset( $box_shadow->get_value( $atts ) )
		) {
			$class = '.' . self::get_module_order_class( $function_name );

			return sprintf(
				'<style type="text/css">%1$s</style>',
				sprintf( '%1$s { z-index: 11; %2$s }', esc_html( $class ), esc_html( $style ) )
			);
		}

		return '';
	}
}
$sectionObj = new AMP_ET_Builder_Section();
remove_shortcode( 'et_pb_section' );
add_shortcode( 'et_pb_section', array($sectionObj, '_render'));
}
