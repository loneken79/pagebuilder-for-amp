<?php
if( class_exists('ET_Builder_Row')){
class AMP_ET_Builder_Row extends ET_Builder_Structure_Element {
	public $ampRowAtts = array();
	public $ampRowProps = array();
	function init() {
		$this->name = esc_html__( 'Row', 'et_builder' );
		$this->slug = 'et_pb_row';
		$this->vb_support = 'on';

		$this->advanced_fields = array(
			'background'            => array(
				'use_background_color' => true,
				'use_background_image' => true,
				'use_background_color_gradient' => true,
				'use_background_video' => true,
				'options' => array(
					'background_color' => array(
						'default' => '',
					),
					'allow_player_pause' => array(
						'default_on_front' => 'off',
					),
					'parallax' => array(
						'default_on_front' => 'off',
					),
					'parallax_method' => array(
						'default_on_front' => 'on',
					),
				),
			),
			'max_width'             => array(
				'use_max_width' => false,
				'css'           => array(
					'module_alignment' => '%%order_class%%.et_pb_row',
				),
				'options' => array(
					'module_alignment' => array(
						'label' => esc_html__( 'Row Alignment', 'et_builder' ),
					),
				),
				'toggle_slug'     => 'alignment',
				'toggle_title'    => esc_html__( 'Alignment', 'et_builder' ),
				'toggle_priority' => 50,
			),
			'margin_padding' => array(
				'use_padding'       => false,
				'custom_margin'     => array(
					'priority' => 1,
				),
				'css' => array(
					'main' => '%%order_class%%.et_pb_row',
					'important' => 'all',
				),
			),
			'fonts'                 => false,
			'text'                  => false,
			'button'                => false,
		);

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
							'column_4' => array( 'name' => esc_html__( 'Column 4', 'et_builder' ) ),
						),
					),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'width'          => array(
						'title'    => esc_html__( 'Sizing', 'et_builder' ),
						'priority' => 65,
					),
					'margin_padding' => array(
						'title'       => esc_html__( 'Spacing', 'et_builder' ),
						'sub_toggles' => array(
							'main'     => '',
							'column_1' => array( 'name' => esc_html__( 'Column 1', 'et_builder' ) ),
							'column_2' => array( 'name' => esc_html__( 'Column 2', 'et_builder' ) ),
							'column_3' => array( 'name' => esc_html__( 'Column 3', 'et_builder' ) ),
							'column_4' => array( 'name' => esc_html__( 'Column 4', 'et_builder' ) ),
						),
						'priority' => 70,
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
							'column_4' => array( 'name' => esc_html__( 'Column 4', 'et_builder' ) ),
						),
					),
					'custom_css' => array(
						'title'  => esc_html__( 'Custom CSS', 'et_builder' ),
						'sub_toggles' => array(
							'main'     => '',
							'column_1' => array( 'name' => esc_html__( 'Column 1', 'et_builder' ) ),
							'column_2' => array( 'name' => esc_html__( 'Column 2', 'et_builder' ) ),
							'column_3' => array( 'name' => esc_html__( 'Column 3', 'et_builder' ) ),
							'column_4' => array( 'name' => esc_html__( 'Column 4', 'et_builder' ) ),
						),
					),
				),
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'R9ds7bEaHE8' ),
				'name' => esc_html__( 'An introduction to Rows', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'make_fullwidth' => array(
				'label'             => esc_html__( 'Make This Row Fullwidth', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'layout',
				'options'           => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'default'           => 'off',
				'depends_show_if'   => 'off',
				'description'       => esc_html__( 'Enable this option to extend the width of this row to the edge of the browser window.', 'et_builder' ),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'width',
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
				'description'       => esc_html__( 'Change to Yes if you would like to adjust the width of this row to a non-standard width.', 'et_builder' ),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'width',
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
				'description'         => esc_html__( 'Define custom width for this Row', 'et_builder' ),
				'tab_slug'            => 'advanced',
				'toggle_slug'         => 'width',
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
				'description'     => esc_html__( 'Define custom width for this Row', 'et_builder' ),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'width',
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
				'description'       => esc_html__( 'Enable this option to define custom gutter width for this row.', 'et_builder' ),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'width',
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
				'description'      => esc_html__( 'Adjust the spacing between each column in this row.', 'et_builder' ),
				'validate_unit'    => false,
				'fixed_range'      => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'width',
				'default_on_front' => et_get_option( 'gutter_width', 3 ),
			),
			'custom_padding' => array(
				'label'           => esc_html__( 'Custom Padding', 'et_builder' ),
				'type'            => 'custom_padding',
				'mobile_options'  => true,
				'option_category' => 'layout',
				'description'     => esc_html__( 'Adjust padding to specific values, or leave blank to use the default padding.', 'et_builder' ),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'margin_padding',
			),
			'custom_padding_tablet' => array(
				'type'        => 'skip',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'margin_padding',
				'default_on_front' => '',
			),
			'custom_padding_phone' => array(
				'type'        => 'skip',
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'margin_padding',
				'default_on_front' => '',
			),
			'padding_mobile' => array(
				'label' => esc_html__( 'Keep Custom Padding on Mobile', 'et_builder' ),
				'type'        => 'skip', // Remaining attribute for backward compatibility
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'margin_padding',
				'default_on_front' => '',
			),
			'custom_margin' => array(
				'label'           => esc_html__( 'Custom Margin', 'et_builder' ),
				'type'            => 'custom_margin',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'margin_padding',
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
			),
			'columns_background' => array(
				'type'            => 'column_settings_background',
				'option_category' => 'configuration',
				'toggle_slug'     => 'background',
				'priority'        => 99,
			),
			'columns_padding' => array(
				'type'            => 'column_settings_padding',
				'option_category' => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'margin_padding',
				'priority'        => 99,
			),
			'column_padding_mobile' => array(
				'label' => esc_html__( 'Keep Column Padding on Mobile', 'et_builder' ),
				'type'  => 'skip', // Remaining attribute for backward compatibility
				'default_on_front' => '',
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
				'type'     => 'skip',
				'tab_slug' => 'advanced',
			),
			'__video_background' => array(
				'type' => 'computed',
				'computed_callback' => array( 'ET_Builder_Row', 'get_video_background' ),
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
		);

		$column_fields = $this->get_column_fields( 4, array(
			'background_color'                           => array(),
			'bg_img'                                     => array(),
			'padding_top'                                => array(),
			'padding_right'                              => array(),
			'padding_bottom'                             => array(),
			'padding_left'                               => array(),
			'parallax'                                   => array(
				'default_on_front' => 'off',
			),
			'parallax_method'                            => array(
				'default_on_front' => 'on',
			),
			'background_size'                            => array(),
			'background_position'                        => array(),
			'background_repeat'                          => array(),
			'background_blend'                           => array(),
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
				'computed_affects'   => array(
					'__video_background',
				),
			),
			'background_video_webm'                      => array(
				'computed_affects'   => array(
					'__video_background',
				),
			),
			'background_video_width'                     => array(
				'computed_affects'   => array(
					'__video_background',
				),
			),
			'background_video_height'                    => array(
				'computed_affects'   => array(
					'__video_background',
				),
			),
			'allow_player_pause'                         => array(
				'computed_affects'   => array(
					'__video_background',
				),
			),
			'background_video_pause_outside_viewport'    => array(
				'computed_affects'   => array(
					'__video_background',
				),
			),
			'__video_background'                         => array(
				'type' => 'computed',
				'computed_callback' => array(
					'ET_Builder_Column',
					'get_column_video_background'
				),
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
			'padding_%column_index%_tablet'              => array( 'has_custom_index_location' => true ),
			'padding_%column_index%_phone'               => array( 'has_custom_index_location' => true ),
			'padding_%column_index%_last_edited'         => array( 'has_custom_index_location' => true ),
			'module_id'                                  => array(),
			'module_class'                               => array(),
			'custom_css_before'                          => array(),
			'custom_css_main'                            => array(),
			'custom_css_after'                           => array(),
		) );

		return array_merge( $fields, $column_fields );
	}
	function amp_divi_inline_styles(){
		$inline_styles = '';
		echo $inline_styles;
		
		$rowProps = $this->ampRowProps;
		$rowAtts = $this->ampRowAtts;
		//print_r($this->ampRowAtts);
		//print_r($this->ampRowProps);
		//die;
		$row_css = '';
		foreach($rowAtts as $uniqueKey => $properties){
			$border_width_all = '';
			if(isset($rowAtts[$uniqueKey]['border_width_all'])){
				$border_width_all = 'border-width:'.$rowAtts[$uniqueKey]['border_width_all'].';';
			}
			$border_color_all = '';
			if( isset($rowAtts[$uniqueKey]['border_color_all']) ){
				$border_color_all = 'border-color:'.$rowAtts[$uniqueKey]['border_color_all'].';';
			}
			$border_style_all = '';
			if( isset($rowAtts[$uniqueKey]['border_style_all']) ){
				$border_style_all = 'border-style:'.$rowAtts[$uniqueKey]['border_style_all'].';';
			}
			$background_color = '';
			if(isset($rowAtts[$uniqueKey]['background_color'])){
				$background_color = 'background-color:'.$rowAtts[$uniqueKey]['background_color'].';';
			}
			$background_image = '';
			if(isset($rowAtts[$uniqueKey]['background_image'])){
				$background_image = 'background-image:url('.$rowAtts[$uniqueKey]['background_image'].');';
			}
			$background_position = '';
			if(isset($rowAtts[$uniqueKey]['background_image'])){
				$background_position = 'background-position:'.str_replace('_', ' ', $rowAtts[$uniqueKey]['background_position']).';';
			}
			$background_size = '';
			if(isset($rowAtts[$uniqueKey]['background_size'])){
				$background_size = 'background-size:'.$rowAtts[$uniqueKey]['background_size'].';';
			}
			$border_radii = '';
			if(isset($rowAtts[$uniqueKey]['border_radii'])){
				$radii = explode("|",$rowAtts[$uniqueKey]['border_radii']);
				if(count($radii)>1){
					$radius = '';
					for($i=1;$i<count($radii);$i++){
						$radius .= $radii[$i].' ';
					}
				}
				$border_radii = 'border-radius:'.$radius.';';
			}
			$border_style_all = '';
			if( isset($rowAtts[$uniqueKey]['border_style_all']) ){
				$border_style_all = 'border-style:'.$rowAtts[$uniqueKey]['border_style_all'].';';
			}
			$border_color_all = '';
			if( isset($rowAtts[$uniqueKey]['border_color_all']) ){
				$border_color_all = 'border-color:'.$rowAtts[$uniqueKey]['border_color_all'].';';
			}
			$custom_margin = '';
			if( isset($rowAtts[$uniqueKey]['custom_margin']) ){
				$margins = explode("|",$rowAtts[$uniqueKey]['custom_margin']);
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
			if( isset($rowAtts[$uniqueKey]['custom_padding']) ){
				$paddings = explode("|",$rowAtts[$uniqueKey]['custom_padding']);
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
			
			$row_css .= '.et_pb_row_'.$uniqueKey.'{';
			$row_css .= $background_image;
			$row_css .= $background_size;
			$row_css .= $background_color;
			$row_css .= $border_radii;
			$row_css .= $border_style_all;
			$row_css .= $border_color_all;
			$row_css .= $custom_margin;
			$row_css .= $custom_padding;
			$row_css .='}';
		}
		echo $row_css;
		//die;
	}
	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}
	function render( $atts, $content = null, $function_name ) {
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$uniqueId = $this->render_count();
		$this->ampRowAtts[$uniqueId] = $atts;
		$this->ampRowProps[$uniqueId] = $this->props;

		$custom_padding          = $this->props['custom_padding'];
		$custom_padding_tablet   = $this->props['custom_padding_tablet'];
		$custom_padding_phone    = $this->props['custom_padding_phone'];
		$custom_padding_last_edited = $this->props['custom_padding_last_edited'];
		$column_padding_mobile   = $this->props['column_padding_mobile'];
		$make_fullwidth          = $this->props['make_fullwidth'];
		$make_equal              = $this->props['make_equal'];
		$background_color_1      = $this->props['background_color_1'];
		$background_color_2      = $this->props['background_color_2'];
		$background_color_3      = $this->props['background_color_3'];
		$background_color_4      = $this->props['background_color_4'];
		$bg_img_1                = $this->props['bg_img_1'];
		$bg_img_2                = $this->props['bg_img_2'];
		$bg_img_3                = $this->props['bg_img_3'];
		$bg_img_4                = $this->props['bg_img_4'];
		$background_size_1       = $this->props['background_size_1'];
		$background_size_2       = $this->props['background_size_2'];
		$background_size_3       = $this->props['background_size_3'];
		$background_size_4       = $this->props['background_size_4'];
		$background_position_1   = $this->props['background_position_1'];
		$background_position_2   = $this->props['background_position_2'];
		$background_position_3   = $this->props['background_position_3'];
		$background_position_4   = $this->props['background_position_4'];
		$background_repeat_1     = $this->props['background_repeat_1'];
		$background_repeat_2     = $this->props['background_repeat_2'];
		$background_repeat_3     = $this->props['background_repeat_3'];
		$background_repeat_4     = $this->props['background_repeat_4'];
		$background_blend_1      = $this->props['background_blend_1'];
		$background_blend_2      = $this->props['background_blend_2'];
		$background_blend_3      = $this->props['background_blend_3'];
		$background_blend_4      = $this->props['background_blend_4'];
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
		$padding_top_4           = $this->props['padding_top_4'];
		$padding_right_4         = $this->props['padding_right_4'];
		$padding_bottom_4        = $this->props['padding_bottom_4'];
		$padding_left_4          = $this->props['padding_left_4'];
		$padding_1_tablet        = $this->props['padding_1_tablet'];
		$padding_2_tablet        = $this->props['padding_2_tablet'];
		$padding_3_tablet        = $this->props['padding_3_tablet'];
		$padding_4_tablet        = $this->props['padding_4_tablet'];
		$padding_1_phone         = $this->props['padding_1_phone'];
		$padding_2_phone         = $this->props['padding_2_phone'];
		$padding_3_phone         = $this->props['padding_3_phone'];
		$padding_4_phone         = $this->props['padding_4_phone'];
		$padding_1_last_edited   = $this->props['padding_1_last_edited'];
		$padding_2_last_edited   = $this->props['padding_2_last_edited'];
		$padding_3_last_edited   = $this->props['padding_3_last_edited'];
		$padding_4_last_edited   = $this->props['padding_4_last_edited'];
		$padding_mobile          = $this->props['padding_mobile'];
		$gutter_width            = $this->props['gutter_width'];
		$use_custom_width        = $this->props['use_custom_width'];
		$custom_width_px         = $this->props['custom_width_px'];
		$custom_width_percent    = $this->props['custom_width_percent'];
		$width_unit              = $this->props['width_unit'];
		$global_module           = $this->props['global_module'];
		$use_custom_gutter       = $this->props['use_custom_gutter'];
		$parallax_1              = $this->props['parallax_1'];
		$parallax_method_1       = $this->props['parallax_method_1'];
		$parallax_2              = $this->props['parallax_2'];
		$parallax_method_2       = $this->props['parallax_method_2'];
		$parallax_3              = $this->props['parallax_3'];
		$parallax_method_3       = $this->props['parallax_method_3'];
		$parallax_4              = $this->props['parallax_4'];
		$parallax_method_4       = $this->props['parallax_method_4'];
		$module_id_1             = $this->props['module_id_1'];
		$module_id_2             = $this->props['module_id_2'];
		$module_id_3             = $this->props['module_id_3'];
		$module_id_4             = $this->props['module_id_4'];
		$module_class_1          = $this->props['module_class_1'];
		$module_class_2          = $this->props['module_class_2'];
		$module_class_3          = $this->props['module_class_3'];
		$module_class_4          = $this->props['module_class_4'];
		$custom_css_before_1     = $this->props['custom_css_before_1'];
		$custom_css_before_2     = $this->props['custom_css_before_2'];
		$custom_css_before_3     = $this->props['custom_css_before_3'];
		$custom_css_before_4     = $this->props['custom_css_before_4'];
		$custom_css_main_1       = $this->props['custom_css_main_1'];
		$custom_css_main_2       = $this->props['custom_css_main_2'];
		$custom_css_main_3       = $this->props['custom_css_main_3'];
		$custom_css_main_4       = $this->props['custom_css_main_4'];
		$custom_css_after_1      = $this->props['custom_css_after_1'];
		$custom_css_after_2      = $this->props['custom_css_after_2'];
		$custom_css_after_3      = $this->props['custom_css_after_3'];
		$custom_css_after_4      = $this->props['custom_css_after_4'];
		$use_background_color_gradient_1              = $this->props['use_background_color_gradient_1'];
		$use_background_color_gradient_2              = $this->props['use_background_color_gradient_2'];
		$use_background_color_gradient_3              = $this->props['use_background_color_gradient_3'];
		$use_background_color_gradient_4              = $this->props['use_background_color_gradient_4'];
		$background_color_gradient_type_1             = $this->props['background_color_gradient_type_1'];
		$background_color_gradient_type_2             = $this->props['background_color_gradient_type_2'];
		$background_color_gradient_type_3             = $this->props['background_color_gradient_type_3'];
		$background_color_gradient_type_4             = $this->props['background_color_gradient_type_4'];
		$background_color_gradient_direction_1        = $this->props['background_color_gradient_direction_1'];
		$background_color_gradient_direction_2        = $this->props['background_color_gradient_direction_2'];
		$background_color_gradient_direction_3        = $this->props['background_color_gradient_direction_3'];
		$background_color_gradient_direction_4        = $this->props['background_color_gradient_direction_4'];
		$background_color_gradient_direction_radial_1 = $this->props['background_color_gradient_direction_radial_1'];
		$background_color_gradient_direction_radial_2 = $this->props['background_color_gradient_direction_radial_2'];
		$background_color_gradient_direction_radial_3 = $this->props['background_color_gradient_direction_radial_3'];
		$background_color_gradient_direction_radial_4 = $this->props['background_color_gradient_direction_radial_4'];
		$background_color_gradient_start_1            = $this->props['background_color_gradient_start_1'];
		$background_color_gradient_start_2            = $this->props['background_color_gradient_start_2'];
		$background_color_gradient_start_3            = $this->props['background_color_gradient_start_3'];
		$background_color_gradient_start_4            = $this->props['background_color_gradient_start_4'];
		$background_color_gradient_end_1              = $this->props['background_color_gradient_end_1'];
		$background_color_gradient_end_2              = $this->props['background_color_gradient_end_2'];
		$background_color_gradient_end_3              = $this->props['background_color_gradient_end_3'];
		$background_color_gradient_end_4              = $this->props['background_color_gradient_end_4'];
		$background_color_gradient_start_position_1   = $this->props['background_color_gradient_start_position_1'];
		$background_color_gradient_start_position_2   = $this->props['background_color_gradient_start_position_2'];
		$background_color_gradient_start_position_3   = $this->props['background_color_gradient_start_position_3'];
		$background_color_gradient_start_position_4   = $this->props['background_color_gradient_start_position_4'];
		$background_color_gradient_end_position_1     = $this->props['background_color_gradient_end_position_1'];
		$background_color_gradient_end_position_2     = $this->props['background_color_gradient_end_position_2'];
		$background_color_gradient_end_position_3     = $this->props['background_color_gradient_end_position_3'];
		$background_color_gradient_end_position_4     = $this->props['background_color_gradient_end_position_4'];
		$background_color_gradient_overlays_image_1   = $this->props['background_color_gradient_overlays_image_1'];
		$background_color_gradient_overlays_image_2   = $this->props['background_color_gradient_overlays_image_2'];
		$background_color_gradient_overlays_image_3   = $this->props['background_color_gradient_overlays_image_3'];
		$background_color_gradient_overlays_image_4   = $this->props['background_color_gradient_overlays_image_4'];
		$background_video_mp4_1     = $this->props['background_video_mp4_1'];
		$background_video_mp4_2     = $this->props['background_video_mp4_2'];
		$background_video_mp4_3     = $this->props['background_video_mp4_3'];
		$background_video_mp4_4     = $this->props['background_video_mp4_4'];
		$background_video_webm_1    = $this->props['background_video_webm_1'];
		$background_video_webm_2    = $this->props['background_video_webm_2'];
		$background_video_webm_3    = $this->props['background_video_webm_3'];
		$background_video_webm_4    = $this->props['background_video_webm_4'];
		$background_video_width_1   = $this->props['background_video_width_1'];
		$background_video_width_2   = $this->props['background_video_width_2'];
		$background_video_width_3   = $this->props['background_video_width_3'];
		$background_video_width_4   = $this->props['background_video_width_4'];
		$background_video_height_1  = $this->props['background_video_height_1'];
		$background_video_height_2  = $this->props['background_video_height_2'];
		$background_video_height_3  = $this->props['background_video_height_3'];
		$background_video_height_4  = $this->props['background_video_height_4'];
		$allow_player_pause_1       = $this->props['allow_player_pause_1'];
		$allow_player_pause_2       = $this->props['allow_player_pause_2'];
		$allow_player_pause_3       = $this->props['allow_player_pause_3'];
		$allow_player_pause_4       = $this->props['allow_player_pause_4'];
		$background_video_pause_outside_viewport_1 = $this->props['background_video_pause_outside_viewport_1'];
		$background_video_pause_outside_viewport_2 = $this->props['background_video_pause_outside_viewport_2'];
		$background_video_pause_outside_viewport_3 = $this->props['background_video_pause_outside_viewport_3'];
		$background_video_pause_outside_viewport_4 = $this->props['background_video_pause_outside_viewport_4'];

		global $et_pb_all_column_settings, $et_pb_rendering_column_content, $et_pb_rendering_column_content_row;

		$et_pb_all_column_settings = ! isset( $et_pb_all_column_settings ) ?  array() : $et_pb_all_column_settings;

		$et_pb_all_column_settings_backup = $et_pb_all_column_settings;

		$keep_column_padding_mobile = $column_padding_mobile;

		if ( '' !== $global_module ) {
			$global_content = et_pb_load_global_module( $global_module, $function_name );

			if ( '' !== $global_content ) {
				return do_shortcode( et_pb_fix_shortcodes( wpautop( $global_content ) ) );
			}
		}

		$custom_padding_responsive_active = et_pb_get_responsive_status( $custom_padding_last_edited );

		$padding_mobile_values = $custom_padding_responsive_active ? array(
			'tablet' => explode( '|', $custom_padding_tablet ),
			'phone'  => explode( '|', $custom_padding_phone ),
		) : array(
			'tablet' => false,
			'phone' => false,
		);

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
			array(
				'color'          => $background_color_4,
				'image'          => $bg_img_4,
				'image_size'     => $background_size_4,
				'image_position' => $background_position_4,
				'image_repeat'   => $background_repeat_4,
				'image_blend'    => $background_blend_4,
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
			array(
				'active'           => $use_background_color_gradient_4,
				'type'             => $background_color_gradient_type_4,
				'direction'        => $background_color_gradient_direction_4,
				'radial_direction' => $background_color_gradient_direction_radial_4,
				'color_start'      => $background_color_gradient_start_4,
				'color_end'        => $background_color_gradient_end_4,
				'start_position'   => $background_color_gradient_start_position_4,
				'end_position'     => $background_color_gradient_end_position_4,
				'overlays_image'   => $background_color_gradient_overlays_image_4,
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
			array(
				'background_video_mp4'         => $background_video_mp4_4,
				'background_video_webm'        => $background_video_webm_4,
				'background_video_width'       => $background_video_width_4,
				'background_video_height'      => $background_video_height_4,
				'background_video_allow_pause' => $allow_player_pause_4,
				'background_video_pause_outside_viewport' => $background_video_pause_outside_viewport_4,
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
			array(
				'padding-top'    => $padding_top_4,
				'padding-right'  => $padding_right_4,
				'padding-bottom' => $padding_bottom_4,
				'padding-left'   => $padding_left_4,
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
			array(
				'tablet' => explode( '|', $padding_4_tablet ),
				'phone'  => explode( '|', $padding_4_phone ),
				'last_edited' => $padding_4_last_edited,
			),
		);

		$et_pb_column_parallax = array(
			array( $parallax_1, $parallax_method_1 ),
			array( $parallax_2, $parallax_method_2 ),
			array( $parallax_3, $parallax_method_3 ),
			array( $parallax_4, $parallax_method_4 ),
		);

		$et_pb_column_css = array(
			'css_class'         => array( $module_class_1, $module_class_2, $module_class_3, $module_class_4 ),
			'css_id'            => array( $module_id_1, $module_id_2, $module_id_3, $module_id_4 ),
			'custom_css_before' => array( $custom_css_before_1, $custom_css_before_2, $custom_css_before_3, $custom_css_before_4 ),
			'custom_css_main'   => array( $custom_css_main_1, $custom_css_main_2, $custom_css_main_3, $custom_css_main_4 ),
			'custom_css_after'  => array( $custom_css_after_1, $custom_css_after_2, $custom_css_after_3, $custom_css_after_4 ),
		);

		$internal_columns_settings_array = array(
			'keep_column_padding_mobile' => $keep_column_padding_mobile,
			'et_pb_column_backgrounds' => $et_pb_column_backgrounds,
			'et_pb_column_backgrounds_gradient' => $et_pb_column_backgrounds_gradient,
			'et_pb_column_backgrounds_video' => $et_pb_column_backgrounds_video,
			'et_pb_columns_counter' => $et_pb_columns_counter,
			'et_pb_column_paddings' => $et_pb_column_paddings,
			'et_pb_column_paddings_mobile' => $et_pb_column_paddings_mobile,
			'et_pb_column_parallax' => $et_pb_column_parallax,
			'et_pb_column_css' => $et_pb_column_css,
		);


		$current_row_position = $et_pb_rendering_column_content ? 'internal_row' : 'regular_row';

		$et_pb_all_column_settings[ $current_row_position ] = $internal_columns_settings_array;

		if ( $et_pb_rendering_column_content ) {
			$et_pb_rendering_column_content_row = true;
		}

		if ( 'on' === $make_equal ) {
			$this->add_classname( 'et_pb_equal_columns' );
		}

		if ( 'on' === $use_custom_gutter && '' !== $gutter_width ) {
			$gutter_width = '0' === $gutter_width ? '1' : $gutter_width; // set the gutter width to 1 if 0 entered by user
			$this->add_classname( 'et_pb_gutters' . $gutter_width );
		}


		$padding_values = explode( '|', $custom_padding );

		if ( ! empty( $padding_values ) ) {
			// old version of Rows support only top and bottom padding, so we need to handle it along with the full padding in the recent version
			if ( 2 === count( $padding_values ) ) {
				$padding_settings = array(
					'top' => isset( $padding_values[0] ) ? $padding_values[0] : '',
					'bottom' => isset( $padding_values[1] ) ? $padding_values[1] : '',
				);
			} else {
				$padding_settings = array(
					'top' => isset( $padding_values[0] ) ? $padding_values[0] : '',
					'right' => isset( $padding_values[1] ) ? $padding_values[1] : '',
					'bottom' => isset( $padding_values[2] ) ? $padding_values[2] : '',
					'left' => isset( $padding_values[3] ) ? $padding_values[3] : '',
				);
			}

			foreach( $padding_settings as $padding_side => $value ) {
				if ( '' !== $value ) {
					$element_style = array(
						'selector'    => '%%order_class%%.et_pb_row',
						'declaration' => sprintf(
							'padding-%1$s: %2$s;',
							esc_html( $padding_side ),
							esc_html( $value )
						),
					);

					// Backward compatibility. Keep Padding on Mobile is deprecated in favour of responsive inputs mechanism for custom padding
					// To ensure that it is compatibility with previous version of Divi, this option is now only used as last resort if no
					// responsive padding value is found,  and padding_mobile value is saved (which is set to off by default)
					if ( in_array( $padding_mobile, array( 'on', 'off' ) ) && 'on' !== $padding_mobile && ! $custom_padding_responsive_active ) {
						$element_style['media_query'] = ET_Builder_Element::get_media_query( 'min_width_981' );
					}

					ET_Builder_Element::set_style( $function_name, $element_style );
				}
			}
		}

		if ( ! empty( $padding_mobile_values['tablet'] ) || ! empty( $padding_values['phone'] ) ) {
			$padding_mobile_values_processed = array();

			foreach( array( 'tablet', 'phone' ) as $device ) {
				if ( empty( $padding_mobile_values[$device] ) ) {
					continue;
				}

				$padding_mobile_values_processed[ $device ] = array(
					'padding-top'    => isset( $padding_mobile_values[$device][0] ) ? $padding_mobile_values[$device][0] : '',
					'padding-right'  => isset( $padding_mobile_values[$device][1] ) ? $padding_mobile_values[$device][1] : '',
					'padding-bottom' => isset( $padding_mobile_values[$device][2] ) ? $padding_mobile_values[$device][2] : '',
					'padding-left'   => isset( $padding_mobile_values[$device][3] ) ? $padding_mobile_values[$device][3] : '',
				);
			}

			if ( ! empty( $padding_mobile_values_processed ) ) {
				et_pb_generate_responsive_css( $padding_mobile_values_processed, '%%order_class%%.et_pb_row', '', $function_name, ' !important; ' );
			}
		}

		if ( 'on' === $make_fullwidth && 'off' === $use_custom_width ) {
			$this->add_classname( 'et_pb_row_fullwidth' );
		}

		if ( 'on' === $use_custom_width ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%%',
				'declaration' => sprintf(
					'max-width:%1$s !important;
					%2$s',
					'on' === $width_unit ? esc_attr( sprintf( '%1$spx', intval( $custom_width_px ) ) ) : esc_attr( sprintf( '%1$s%%', intval( $custom_width_percent ) ) ),
					'on' !== $width_unit ? esc_attr( sprintf( 'width: %1$s%%;', intval( $custom_width_percent ) ) ) : ''
				),
			) );
		}

		$parallax_image = $this->get_parallax_image_background();
		$background_video = $this->video_background();

		if ( $et_pb_rendering_column_content_row ) {
			$et_pb_rendering_column_content_row = false;
		}

		// CSS Filters
		$this->add_classname( $this->generate_css_filters( $function_name ) );

		// Remove automatically added classnames
		$this->remove_classname( 'et_pb_module' );

		// Save module classes into variable BEFORE processing the content with `do_shortcode()`
		// Otherwise order classes messed up with internal rows if exist
		$module_classes = $this->module_classname( $function_name );

		// Inner content shortcode parsing has to be done after all classname addition/removal
		$inner_content = do_shortcode( et_pb_fix_shortcodes( $content ) );
		$content_dependent_classname = '' == trim( $inner_content ) ? ' et_pb_row_empty' : '';

		// reset the global column settings to make sure they are not affected by internal content
		// This has to be done after inner content's shortcode being parsed
		$et_pb_all_column_settings = $et_pb_all_column_settings_backup;

		$output = sprintf(
			'<div%4$s class="%2$s%7$s">
				%1$s
				%6$s
				%5$s
			</div> <!-- .%3$s -->',
			$inner_content,
			$module_classes,
			esc_html( $function_name ),
			$this->module_id(),
			$background_video,
			$parallax_image,
			$content_dependent_classname
		);

		return $output;
	}
}
$rowObj = new AMP_ET_Builder_Row();
remove_shortcode( 'et_pb_row' );
add_shortcode( 'et_pb_row', array($rowObj, '_render'));

}