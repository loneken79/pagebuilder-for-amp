<?php
if(class_exists('ET_Builder_Module_Map')){
class AMP_ET_Builder_Module_Map extends ET_Builder_Module {
	function init() {
		$this->name            = esc_html__( 'Map', 'et_builder' );
		$this->slug            = 'et_pb_map';
		$this->vb_support      = 'on';
		$this->child_slug      = 'et_pb_map_pin';
		$this->child_item_text = esc_html__( 'Pin', 'et_builder' );

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'map' => esc_html__( 'Map', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'controls' => esc_html__( 'Controls', 'et_builder' ),
					'child_filters' => array(
						'title' => esc_html__( 'Map', 'et_builder' ),
						'priority' => 51,
					),
				),
			),
		);

		$this->advanced_fields = array(
			'box_shadow'            => array(
				'default' => array(
					'css' => array(
						'custom_style' => true,
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => array( 'custom_margin' ), // needed to overwrite last module margin-bottom styling
				),
			),
			'filters'               => array(
				'css' => array(
					'main' => '%%order_class%%',
				),
				'child_filters_target' => array(
					'tab_slug' => 'advanced',
					'toggle_slug' => 'child_filters',
				),
			),
			'child_filters'         => array(
				'css' => array(
					'main' => '%%order_class%% .gm-style>div>div>div>div>div>img',
				),
			),
			'fonts'                 => false,
			'text'                  => false,
			'button'                => false,
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'rV3rxmACDmw' ),
				'name' => esc_html__( 'An introduction to the Map module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'google_maps_script_notice' => array(
				'type'              => 'warning',
				'value'             => et_pb_enqueue_google_maps_script(),
				'display_if'        => false,
				'message'           => esc_html__(
					sprintf(
						'The Google Maps API Script is currently disabled in the <a href="%s" target="_blank">Theme Options</a>. This module will not function properly without the Google Maps API.',
						admin_url( 'admin.php?page=et_divi_options' )
					),
					'et_builder'
				),
				'toggle_slug'       => 'map',
			),
			'google_api_key' => array(
				'label'             => esc_html__( 'Google API Key', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'basic_option',
				'attributes'        => 'readonly',
				'additional_button' => sprintf(
					' <a href="%2$s" target="_blank" class="et_pb_update_google_key button" data-empty_text="%3$s">%1$s</a>',
					esc_html__( 'Change API Key', 'et_builder' ),
					esc_url( et_pb_get_options_page_link() ),
					esc_attr__( 'Add Your API Key', 'et_builder' )
				),
				'additional_button_type' => 'change_google_api_key',
				'class' => array( 'et_pb_google_api_key', 'et-pb-helper-field' ),
				'description'       => et_get_safe_localization( sprintf( __( 'The Maps module uses the Google Maps API and requires a valid Google API Key to function. Before using the map module, please make sure you have added your API key inside the Divi Theme Options panel. Learn more about how to create your Google API Key <a href="%1$s" target="_blank">here</a>.', 'et_builder' ), esc_url( 'http://www.elegantthemes.com/gallery/divi/documentation/map/#gmaps-api-key' ) ) ),
				'toggle_slug'       => 'map',
			),
			'address' => array(
				'label'             => esc_html__( 'Map Center Address', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'basic_option',
				'additional_button' => sprintf(
					' <a href="#" class="et_pb_find_address button">%1$s</a>',
					esc_html__( 'Find', 'et_builder' )
				),
				'class' => array( 'et_pb_address' ),
				'description'       => esc_html__( 'Enter an address for the map center point, and the address will be geocoded and displayed on the map below.', 'et_builder' ),
				'toggle_slug'       => 'map',
			),
			'zoom_level' => array(
				'type'    => 'hidden',
				'class'   => array( 'et_pb_zoom_level' ),
				'default' => '18',
			),
			'address_lat' => array(
				'type'  => 'hidden',
				'class' => array( 'et_pb_address_lat' ),
			),
			'address_lng' => array(
				'type'  => 'hidden',
				'class' => array( 'et_pb_address_lng' ),
			),
			'map_center_map' => array(
				'type'                  => 'center_map',
				'use_container_wrapper' => false,
				'option_category'       => 'basic_option',
				'toggle_slug'           => 'map',
			),
			'mouse_wheel' => array(
				'label'           => esc_html__( 'Mouse Wheel Zoom', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'On', 'et_builder' ),
					'off' => esc_html__( 'Off', 'et_builder' ),
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'controls',
				'description'     => esc_html__( 'Here you can choose whether the zoom level will be controlled by mouse wheel or not.', 'et_builder' ),
				'default_on_front' => 'on',
			),
			'mobile_dragging' => array(
				'label'           => esc_html__( 'Draggable on Mobile', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'On', 'et_builder' ),
					'off' => esc_html__( 'Off', 'et_builder' ),
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'controls',
				'description'     => esc_html__( 'Here you can choose whether or not the map will be draggable on mobile devices.', 'et_builder' ),
				'default_on_front' => 'on',
			),
			'use_grayscale_filter' => array(
				'label'           => esc_html__( 'Use Grayscale Filter', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects'     => array(
					'grayscale_filter_amount',
				),
				'tab_slug'    => 'advanced',
				'toggle_slug' => 'child_filters',
				'default_on_front' => 'off',
			),
			'grayscale_filter_amount' => array(
				'label'           => esc_html__( 'Grayscale Filter Amount (%)', 'et_builder' ),
				'type'            => 'range',
				'default'         => '0',
				'option_category' => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'child_filters',
				'depends_show_if' => 'on',
				'unitless'        => false,
			),
		);
		return $fields;
	}
	function amp_divi_pagebuilder_scripts($data){
  		
  		$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
  		return $data;
  	}
  	function amp_divi_inline_styles(){
  			$standard_styles = '/* Map Module */
				.et_pb_map {
					position: relative;
					width: 100%;
					height: 440px;
				}

				body.chrome.parallax-map-support .et_pb_map {
					transform: inherit !important;
				}

				.et_pb_fullwidth_section .et_pb_map_container {
					margin: 0;
				}

				.et_pb_map_container img {
					max-width: inherit;
				}

				.et_pb_map_pin {
					display: none;
					visibility: hidden;
				}

				/* Column Adjustments */
				.et_pb_column_2_3 .et_pb_map {
					height: 400px;
				}

				.et_pb_column_1_2 .et_pb_map,
				.et_pb_column_3_8 .et_pb_map {
					height: 280px;
				}

				.et_pb_column_1_3 .et_pb_map,
				.et_pb_column_1_4 .et_pb_map {
					height: 230px;
				}';
				$inline_styles = '';
				echo $standard_styles.''.$inline_styles;
			}
	function render( $attrs, $content = null, $render_slug ) {
		add_filter('amp_post_template_data', [$this, 'amp_divi_pagebuilder_scripts']);
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$address_lat             = $this->props['address_lat'];
		$address_lng             = $this->props['address_lng'];
		$zoom_level              = $this->props['zoom_level'];
		$mouse_wheel             = $this->props['mouse_wheel'];
		$mobile_dragging         = $this->props['mobile_dragging'];
		$use_grayscale_filter    = $this->props['use_grayscale_filter'];
		$grayscale_filter_amount = $this->props['grayscale_filter_amount'];

		if ( et_pb_enqueue_google_maps_script() ) {
			wp_enqueue_script( 'google-maps-api' );
		}

		$video_background          = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		$all_pins_content = $this->content;

		$grayscale_filter_data = '';
		if ( 'on' === $use_grayscale_filter && '' !== $grayscale_filter_amount ) {
			$grayscale_filter_data = sprintf( ' data-grayscale="%1$s"', esc_attr( $grayscale_filter_amount ) );
		}

		// Map Tiles: Add CSS Filters and Mix Blend Mode rules (if set)
		if ( array_key_exists( 'child_filters', $this->advanced_fields ) && array_key_exists( 'css', $this->advanced_fields['child_filters'] ) ) {
			$this->add_classname( $this->generate_css_filters(
				$render_slug,
				'child_',
				self::$data_utils->array_get( $this->advanced_fields['child_filters']['css'], 'main', '%%order_class%%' )
			) );
		}

		// Module classnames
		$this->add_classname( array(
			'et_pb_map_container',
		) );

		$this->remove_classname( $render_slug );

		$output = sprintf(
			'<amp-iframe width="600" title="Google map pin on Googleplex, Mountain View CA"
                          height="400"
                          layout="responsive"
                          sandbox="allow-scripts allow-same-origin allow-popups"
                          frameborder="0"
                          src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ2eUgeAK6j4ARbn5u_wAGqWA&key=AIzaSyCNCZ0Twm_HFRaZ5i-FuPDYs3rLwm4_848">
  			</amp-iframe>',
			esc_attr( $address_lat ),
			esc_attr( $address_lng ),
			esc_attr( $zoom_level ),
			$all_pins_content,
			$this->module_id(),
			$this->module_classname( $render_slug ),
			esc_attr( $mouse_wheel ),
			$grayscale_filter_data,
			esc_attr( $mobile_dragging ),
			$video_background,
			$parallax_image_background
		);

		return $output;
	}
}

$mapObj = new AMP_ET_Builder_Module_Map();
remove_shortcode( 'et_pb_map' );
add_shortcode( 'et_pb_map', array($mapObj, '_render'));
}