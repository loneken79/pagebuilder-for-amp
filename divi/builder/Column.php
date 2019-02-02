<?php
if(class_exists('ET_Builder_Column')){
class AMP_ET_Builder_Column extends ET_Builder_Structure_Element {
	public $ampColumnAtts = array();
	public $ampColumnProps = array();
	function init() {
		$this->name                       = esc_html__( 'Column', 'et_builder' );
		$this->slug                       = 'et_pb_column';
		$this->additional_shortcode_slugs = array( 'et_pb_column_inner' );
		$this->vb_support                 = 'on';
		$this->advanced_fields           = false;

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'R9ds7bEaHE8' ),
				'name' => esc_html__( 'An introduction to the Column module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'type'                        => array(
				'default_on_front' => '4_4',
				'type' => 'skip',
			),
			'specialty_columns'           => array(
				'type' => 'skip',
			),
			'saved_specialty_column_type' => array(
				'type' => 'skip',
			),
		);

		return $fields;
	}
	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}
	function amp_divi_inline_styles(){
		$columnProps = $this->ampColumnProps;
		$columnAtts = $this->ampColumnAtts;
		$inline_styles = '';

		// print_r($columnProps);
		// print_r($columnAtts);
		// die;
		$inline_styles = '';
		echo $inline_styles;
		$column_main_css = '';
		foreach ($columnAtts as $uniqueKey => $properties) {
			$padding_bottom = '';
			if( isset($columnAtts[$uniqueKey]['padding_bottom']) ){
				$padding_bottom = 'padding-bottom:'.$columnAtts[$uniqueKey]['padding_bottom'].';';
			}
			$padding_left = '';
			if( isset($columnAtts[$uniqueKey]['padding_left']) ){
				$padding_left = 'padding-left:'.$columnAtts[$uniqueKey]['padding_left'].';';
			}
			$padding_right = '';
			if( isset($columnAtts[$uniqueKey]['padding_right']) ){
				$padding_right = 'padding-right:'.$columnAtts[$uniqueKey]['padding_right'].';';
			}
			$padding_top = '';
			if( isset($columnAtts[$uniqueKey]['padding_top']) ){
				$padding_top = 'padding-top:'.$columnAtts[$uniqueKey]['padding_top'].';';
			}
			$background_image = '';
			if( isset($columnAtts[$uniqueKey]['bg_img']) ){
				$background_image = 'background-image:url('.$columnAtts[$uniqueKey]['bg_img'].');';
			}
			if( $columnAtts[$uniqueKey]['use_background_color_gradient'] == 'on' ){
				$start_grad = $columnAtts[$uniqueKey]['background_color_gradient_start'];
				$end_grad = $columnAtts[$uniqueKey]['background_color_gradient_end'];
				
				
				if( !isset($columnAtts[$uniqueKey]['background_color_gradient_type'])){
					$direction = $columnAtts[$uniqueKey]['background_color_gradient_direction'];
					if(!isset($direction)){
						$direction = '180deg';
					}
					$gradient_style = 'linear-gradient('.$direction.','.$start_grad.' 0%,'.$end_grad.' 100%)';
				}
				if($columnAtts[$uniqueKey]['background_color_gradient_type'] == 'linear'){
					$direction = $columnAtts[$uniqueKey]['background_color_gradient_direction'];
					if(!isset($direction)){
						 $direction = '180deg';
					}
					$gradient_style = 'linear-gradient('.$direction.','.$start_grad.' 0%,'.$end_grad.' 100%)';
				}
				if($columnAtts[$uniqueKey]['background_color_gradient_type'] == 'radial'){
					$direction = $columnAtts[$uniqueKey]['background_color_gradient_direction_radial'];
					if(!isset($direction)){
						 $direction = 'center';
					}
					$gradient_style = 'radial-gradient(circle at '.$direction.','.$start_grad.' 0%,'.$end_grad.' 100%)';
				}
				if(isset($columnAtts[$uniqueKey]['bg_img'])){
					if($columnAtts[$uniqueKey]['background_color_gradient_overlays_image'] == 'on'){
						if(isset($columnAtts[$uniqueKey]['bg_img'])){
							$background_image = 'background-image:'.$gradient_style.',url('.$columnAtts[$uniqueKey]['bg_img'].');';
						}
					}
					if(!isset($columnAtts[$uniqueKey]['background_color_gradient_overlays_image']) || $columnAtts[$uniqueKey]['background_color_gradient_overlays_image'] == 'off'){
						if(isset($columnAtts[$uniqueKey]['bg_img'])){
							$background_image = 'background-image:url('.$columnAtts[$uniqueKey]['bg_img'].'),'.$gradient_style.';';
						}
					}
				}else{
					$background_image = 'background-image:'.$gradient_style.';';
				}
			}
			$background_color = '';
			if( isset($columnAtts[$uniqueKey]['background_color']) ){
				$background_color = 'background-color:'.$columnAtts[$uniqueKey]['background_color'].';';
			}
			$background_size = '';
			if( isset($columnAtts[$uniqueKey]['background_size']) ){
				$background_size = 'background-size:'.$columnAtts[$uniqueKey]['background_size'].';';
			}
			$column_main_css .= '.et_pb_column_'.$uniqueKey.'{';
			$column_main_css .= $padding_bottom;
			$column_main_css .= $padding_left;
			$column_main_css .= $padding_right;
			$column_main_css .= $padding_top;
			$column_main_css .= $background_image;
			$column_main_css .= $background_color;
			$column_main_css .= $background_size;
			$column_main_css .='}';
		}
		echo $column_main_css;
	}
	function render( $atts, $content = null, $function_name ) {
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$uniqueId = $this->render_count();
		$this->ampColumnAtts[$uniqueId] = $atts;
		$this->ampColumnProps[$uniqueId] = $this->props;

		$type                        = $this->props['type'];
		$specialty_columns           = $this->props['specialty_columns'];
		$saved_specialty_column_type = $this->props['saved_specialty_column_type'];

		global $et_pb_all_column_settings,
			$et_pb_all_column_settings_inner,
			$et_specialty_column_type,
			$et_pb_rendering_column_content,
			$et_pb_rendering_column_content_row,
			$et_pb_column_completion;
			
		$is_specialty_column = 'et_pb_column_inner' !== $function_name && '' !== $specialty_columns;

		$current_row_position = $et_pb_rendering_column_content_row ? 'internal_row' : 'regular_row';

		if ( 'et_pb_column_inner' !== $function_name ) {
			$et_specialty_column_type = $type;
			$array_index = self::$_->array_get( $et_pb_all_column_settings, "{$current_row_position}.et_pb_columns_counter", 0 );
			$backgrounds_array = self::$_->array_get( $et_pb_all_column_settings, "{$current_row_position}.et_pb_column_backgrounds", array() );
			$background_gradient = self::$_->array_get( $et_pb_all_column_settings, "{$current_row_position}.et_pb_column_backgrounds_gradient.[{$array_index}]", '' );
			$background_video = self::$_->array_get( $et_pb_all_column_settings, "{$current_row_position}.et_pb_column_backgrounds_video.[{$array_index}]", '' );
			$paddings_array = self::$_->array_get( $et_pb_all_column_settings, "{$current_row_position}.et_pb_column_paddings", array() );
			$paddings_mobile_array = self::$_->array_get( $et_pb_all_column_settings, "{$current_row_position}.et_pb_column_paddings_mobile", array() );
			$column_css_array = self::$_->array_get( $et_pb_all_column_settings, "{$current_row_position}.et_pb_column_css", array() );
			$keep_column_padding_mobile = self::$_->array_get( $et_pb_all_column_settings, "{$current_row_position}.keep_column_padding_mobile", 'on' );
			$column_parallax = self::$_->array_get( $et_pb_all_column_settings, "{$current_row_position}.et_pb_column_parallax", '' );
			if ( isset( $et_pb_all_column_settings[ $current_row_position ] ) ) {
				$et_pb_all_column_settings[ $current_row_position ]['et_pb_columns_counter']++;
			}
		} else {
			$array_index = self::$_->array_get( $et_pb_all_column_settings_inner, "{$current_row_position}.et_pb_columns_inner_counter", 0 );
			$backgrounds_array = self::$_->array_get( $et_pb_all_column_settings_inner, "{$current_row_position}.et_pb_column_inner_backgrounds", array() );
			$background_gradient = self::$_->array_get( $et_pb_all_column_settings_inner, "{$current_row_position}.et_pb_column_inner_backgrounds_gradient.[{$array_index}]", '' );
			$background_video = self::$_->array_get( $et_pb_all_column_settings_inner, "{$current_row_position}.et_pb_column_inner_backgrounds_video.[{$array_index}]", '' );
			$paddings_array = self::$_->array_get( $et_pb_all_column_settings_inner, "{$current_row_position}.et_pb_column_inner_paddings", array() );
			$column_css_array = self::$_->array_get( $et_pb_all_column_settings_inner, "{$current_row_position}.et_pb_column_inner_css", array() );
			$paddings_mobile_array = self::$_->array_get( $et_pb_all_column_settings_inner, "{$current_row_position}.et_pb_column_inner_paddings_mobile", array() );
			$keep_column_padding_mobile = self::$_->array_get( $et_pb_all_column_settings_inner, "{$current_row_position}.keep_column_padding_mobile", 'on' );
			$column_parallax = self::$_->array_get( $et_pb_all_column_settings_inner, "{$current_row_position}.et_pb_column_parallax", '' );
			if ( isset( $et_pb_all_column_settings_inner[ $current_row_position ] ) ) {
				$et_pb_all_column_settings_inner[ $current_row_position ]['et_pb_columns_inner_counter']++;
			}
		}

		// Get column type value in array
		$column_type = explode( '_', $type );

		// Just in case for some reason column shortcode has no `type` attribute and causes unexpected $column_type values
		if ( isset( $column_type[0] ) && isset( $column_type[1] ) ) {
			// Get column progress.
			$column_progress = intval( $column_type[0] ) / intval( $column_type[1] );

			if ( 0 === $array_index ) {
				$et_pb_column_completion = $column_progress;
			} else {
				$et_pb_column_completion = $et_pb_column_completion + $column_progress;
			}
		}

		// Last column is when sum of column type value equals to 1
		$is_last_column = 1 == $et_pb_column_completion;

		$background_color = isset( $backgrounds_array[$array_index]['color'] ) ? $backgrounds_array[$array_index]['color'] : '';
		$background_img = isset( $backgrounds_array[$array_index]['image'] ) ? $backgrounds_array[$array_index]['image'] : '';
		$background_size = isset( $backgrounds_array[$array_index]['image_size'] ) ? $backgrounds_array[$array_index]['image_size'] : '';
		$background_position = isset( $backgrounds_array[$array_index]['image_position'] ) ? $backgrounds_array[$array_index]['image_position'] : '';
		$background_repeat = isset( $backgrounds_array[$array_index]['image_repeat'] ) ? $backgrounds_array[$array_index]['image_repeat'] : '';
		$background_blend = isset( $backgrounds_array[$array_index]['image_blend'] ) ? $backgrounds_array[$array_index]['image_blend'] : '';
		$background_gradient_overlays_image = isset( $background_gradient['overlays_image'] ) ? $background_gradient['overlays_image'] : '';

		$padding_values = isset( $paddings_array[$array_index] ) ? $paddings_array[$array_index] : array();
		$padding_mobile_values = isset( $paddings_mobile_array[$array_index] ) ? $paddings_mobile_array[$array_index] : array();
		$padding_last_edited = isset( $padding_mobile_values['last_edited'] ) ? $padding_mobile_values['last_edited'] : 'off|desktop';
		$padding_responsive_active = et_pb_get_responsive_status( $padding_last_edited );
		$parallax_method = isset( $column_parallax[$array_index][0] ) && 'on' === $column_parallax[$array_index][0] ? $column_parallax[$array_index][1] : '';
		$custom_css_class = isset( $column_css_array['css_class'][$array_index] ) ? ' ' . $column_css_array['css_class'][$array_index] : '';
		$custom_css_id = isset( $column_css_array['css_id'][$array_index] ) ? $column_css_array['css_id'][$array_index] : '';
		$custom_css_before = isset( $column_css_array['custom_css_before'][$array_index] ) ? $column_css_array['custom_css_before'][$array_index] : '';
		$custom_css_main = isset( $column_css_array['custom_css_main'][$array_index] ) ? $column_css_array['custom_css_main'][$array_index] : '';
		$custom_css_after = isset( $column_css_array['custom_css_after'][$array_index] ) ? $column_css_array['custom_css_after'][$array_index] : '';
		$background_images = array();

		if ( '' !== $background_gradient && 'on' === $background_gradient['active'] ) {
			$has_background_gradient = true;

			$default_gradient = apply_filters( 'et_pb_default_gradient', array(
				'type'             => ET_Global_Settings::get_value( 'all_background_gradient_type' ),
				'direction'        => ET_Global_Settings::get_value( 'all_background_gradient_direction' ),
				'radial_direction' => ET_Global_Settings::get_value( 'all_background_gradient_direction_radial' ),
				'color_start'      => ET_Global_Settings::get_value( 'all_background_gradient_start' ),
				'color_end'        => ET_Global_Settings::get_value( 'all_background_gradient_end' ),
				'start_position'   => ET_Global_Settings::get_value( 'all_background_gradient_start_position' ),
				'end_position'     => ET_Global_Settings::get_value( 'all_background_gradient_end_position' ),
			) );

			$background_gradient = wp_parse_args( array_filter( $background_gradient ), $default_gradient );

			$direction               = $background_gradient['type'] === 'linear' ? $background_gradient['direction'] : "circle at {$background_gradient['radial_direction']}";
			$start_gradient_position = et_sanitize_input_unit( $background_gradient['start_position'], false, '%' );
			$end_gradient_position   = et_sanitize_input_unit( $background_gradient['end_position'], false, '%');
			$background_images[]     = "{$background_gradient['type']}-gradient(
				{$direction},
				{$background_gradient['color_start']} ${start_gradient_position},
				{$background_gradient['color_end']} ${end_gradient_position}
			)";
		}

		if ( '' !== $background_img && 'on' !== $parallax_method ) {
			$has_background_image = true;

			$background_images[] = sprintf(
				'url(%s)',
				esc_attr( $background_img )
			);

			if ( '' !== $background_size ) {
				ET_Builder_Element::set_style( $function_name, array(
					'selector'    => '%%order_class%%',
					'declaration' => sprintf(
						'background-size:%s;',
						esc_attr( $background_size )
					),
				) );
			}

			if ( '' !== $background_position ) {
				ET_Builder_Element::set_style( $function_name, array(
					'selector'    => '%%order_class%%',
					'declaration' => sprintf(
						'background-position:%s;',
						esc_attr( str_replace( '_', ' ', $background_position ) )
					),
				) );
			}

			if ( '' !== $background_repeat ) {
				ET_Builder_Element::set_style( $function_name, array(
					'selector'    => '%%order_class%%',
					'declaration' => sprintf(
						'background-repeat:%s;',
						esc_attr( $background_repeat )
					),
				) );
			}

			if ( '' !== $background_blend ) {
				ET_Builder_Element::set_style( $function_name, array(
					'selector'    => '%%order_class%%',
					'declaration' => sprintf(
						'background-blend-mode:%s;',
						esc_attr( $background_blend )
					),
				) );
			}
		}

		if ( ! empty( $background_images ) ) {
			if ( 'on' !== $background_gradient_overlays_image ) {
				// The browsers stack the images in the opposite order to what you'd expect.
				$background_images = array_reverse( $background_images );
			}

			$backgorund_images_declaration = sprintf(
				'background-image: %1$s;',
				esc_html( implode( ', ', $background_images ) )
			);

			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%%',
				'declaration' => esc_attr( $backgorund_images_declaration ),
			) );
		}

		if ( '' !== $background_color && 'rgba(0,0,0,0)' !== $background_color && ! isset( $has_background_gradient, $has_background_image ) ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%%',
				'declaration' => sprintf(
					'background-color:%s;',
					esc_attr( $background_color )
				),
			) );
		} else if ( isset( $has_background_gradient, $has_background_image ) ) {
			// Force background-color: initial
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%%',
				'declaration' => 'background-color: initial;'
			) );
		}

		if ( ! empty( $padding_values ) ) {
			foreach( $padding_values as $position => $value ) {
				if ( '' !== $value ) {
					$element_style = array(
						'selector'    => '%%order_class%%',
						'declaration' => sprintf(
							'%1$s:%2$s;',
							esc_html( $position ),
							esc_html( et_builder_process_range_value( $value ) )
						),
					);

					// Backward compatibility. Keep Padding on Mobile is deprecated in favour of responsive inputs mechanism for custom padding
					// To ensure that it is compatibility with previous version of Divi, this option is now only used as last resort if no
					// responsive padding value is found,  and padding_mobile value is saved (which is set to off by default)
					if ( in_array( $keep_column_padding_mobile, array( 'on', 'off' ) ) && 'on' !== $keep_column_padding_mobile && ! $padding_responsive_active ) {
						$element_style['media_query'] = ET_Builder_Element::get_media_query( 'min_width_981' );
					}

					ET_Builder_Element::set_style( $function_name, $element_style );
				}
			}
		}

		if ( $padding_responsive_active && ( ! empty( $padding_mobile_values['tablet'] ) || ! empty( $padding_values['phone'] ) ) ) {
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
				$padding_mobile_selector = 'et_pb_column_inner' !== $function_name ? '.et_pb_row > .et_pb_column%%order_class%%' : '.et_pb_row_inner > .et_pb_column%%order_class%%';
				et_pb_generate_responsive_css( $padding_mobile_values_processed, $padding_mobile_selector, '', $function_name );
			}
		}

		if ( '' !== $custom_css_before ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%%:before',
				'declaration' => trim( $custom_css_before ),
			) );
		}

		if ( '' !== $custom_css_main ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%%',
				'declaration' => trim( $custom_css_main ),
			) );
		}

		if ( '' !== $custom_css_after ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%%:after',
				'declaration' => trim( $custom_css_after ),
			) );
		}

		if ( 'et_pb_column_inner' === $function_name ) {
			if ( '1_1' === $type ) {
				$type = '4_4';
			}

			$et_specialty_column_type = '' !== $saved_specialty_column_type ? $saved_specialty_column_type : $et_specialty_column_type;

			switch ( $et_specialty_column_type ) {
				case '1_2':
					if ( '1_2' === $type ) {
						$type = '1_4';
					}

					break;
				case '2_3':
					if ( '1_2' === $type ) {
						$type = '1_3';
					}

					break;
				case '3_4':
					if ( '1_2' === $type ) {
						$type = '3_8';
					} else if ( '1_3' === $type ) {
						$type = '1_4';
					}

					break;
			}
		}

		$video_background = trim( $this->video_background( $background_video ) );

		// Remove automatically added classname
		$this->remove_classname( 'et_pb_module' );

		$this->add_classname( 'et_pb_column_' . $type, 1 );

		if ( '' !== $custom_css_class ) {
			$this->add_classname( $custom_css_class );
		}

		if ( $is_specialty_column ) {
			$this->add_classname( 'et_pb_specialty_column' );
		}

		// CSS Filters
		$this->add_classname( $this->generate_css_filters( $function_name ) );

		if ( '' !== $parallax_method ) {
			$this->add_classname( 'et_pb_section_parallax' );
		}

		if ( '' !== $video_background ) {
			$this->add_classname( array(
				'et_pb_section_video',
				'et_pb_preload',
			) );
		}

		if ( $is_last_column ) {
			$this->add_classname( 'et-last-child' );
		}

		// Module classname in column has to be contained in variable BEFORE content is being parsed
		// as shortcode because column and column inner use the same ET_Builder_Column's render
		// classname doesn't work in nested situation because each called module doesn't have its own class init
		$module_classname = $this->module_classname( $function_name );

		// Inner content shortcode parsing has to be done after all classname addition/removal
		$inner_content = do_shortcode( et_pb_fix_shortcodes( $content ) );

		// Inner content dependant class in column shouldn't use add_classname/remove_classname method
		$content_dependent_classname = '' == trim( $inner_content ) ? ' et_pb_column_empty' : '';

		$output = sprintf(
			'<div class="%1$s%6$s"%4$s>
				%5$s
				%3$s
				%2$s
			</div> <!-- .et_pb_column -->',
			$module_classname,
			$inner_content,
			( '' !== $background_img && '' !== $parallax_method
				? sprintf(
					'<div class="et_parallax_bg%2$s" style="background-image: url(%1$s);"></div>',
					esc_attr( $background_img ),
					( 'off' === $parallax_method ? ' et_pb_parallax_css' : '' )
				)
				: ''
			),
			'' !== $custom_css_id ? sprintf( ' id="%1$s"', esc_attr( $custom_css_id ) ) : '', // 5
			$video_background,
			$content_dependent_classname
		);

		return $output;
	}
}
$columnObj = new AMP_ET_Builder_Column();
remove_shortcode( 'et_pb_column' );
add_shortcode( 'et_pb_column', array($columnObj, '_render'));
}