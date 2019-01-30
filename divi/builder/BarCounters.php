<?php
if(class_exists('ET_Builder_Module_Bar_Counters')){
class AMP_ET_Builder_Module_Bar_Counters extends ET_Builder_Module {
	function init() {
		$this->name            = esc_html__( 'Bar Counters', 'et_builder' );
		$this->slug            = 'et_pb_counters';
		$this->vb_support      = 'on';
		$this->child_slug      = 'et_pb_counter';
		$this->child_item_text = esc_html__( 'Bar Counter', 'et_builder' );

		$this->main_css_element = '%%order_class%%.et_pb_counters';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'elements'   => esc_html__( 'Elements', 'et_builder' ),
					'background' => esc_html__( 'Background', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'layout' => esc_html__( 'Layout', 'et_builder' ),
					'text'   => array(
						'title'    => esc_html__( 'Text', 'et_builder' ),
						'priority' => 49,
					),
					'bar' => esc_html__( 'Bar Counter', 'et_builder' ),
				),
			),
		);

		$this->advanced_fields = array(
			'borders'               => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .et_pb_counter_container, %%order_class%% .et_pb_counter_amount",
							'border_styles' => "%%order_class%% .et_pb_counter_container",
						),
					),
				),
			),
			'box_shadow'            => array(
				'default' => array(
					'css' => array(
						'main'         => '%%order_class%% .et_pb_counter_container',
						'custom_style' => true,

					),
				),
			),
			'fonts'                 => array(
				'title' => array(
					'label'    => esc_html__( 'Title', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .et_pb_counter_title",
					),
				),
				'percent'   => array(
					'label'    => esc_html__( 'Percentage', 'et_builder' ),
					'css'      => array(
						'main'       => "{$this->main_css_element} .et_pb_counter_amount_number",
						'text_align' => "{$this->main_css_element} .et_pb_counter_amount",
					),
				),
			),
			'background'            => array(
				'use_background_color' => 'fields_only',
				'css' => array(
					'main' => "{$this->main_css_element} .et_pb_counter_container",
				),
				'options' => array(
					'background_color' => array(
						'default'          => '#dddddd',
					),
				),
			),
			'margin_padding' => array(
				'css'           => array(
					'margin'    => "{$this->main_css_element}",
					'padding'   => "{$this->main_css_element} .et_pb_counter_amount",
					'important' => array( 'custom_margin' ),
				),
			),
			'text'                  => array(
				'use_background_layout' => true,
				'options' => array(
					'background_layout' => array(
						'default_on_front' => 'light',
					),
				),
			),
			'filters'               => array(
				'css' => array(
					'main' => '%%order_class%%',
				),
			),
			'button'                => false,
		);

		$this->custom_css_fields = array(
			'counter_title' => array(
				'label'    => esc_html__( 'Counter Title', 'et_builder' ),
				'selector' => '.et_pb_counter_title',
			),
			'counter_container' => array(
				'label'    => esc_html__( 'Counter Container', 'et_builder' ),
				'selector' => '.et_pb_counter_container',
			),
			'counter_amount' => array(
				'label'    => esc_html__( 'Counter Amount', 'et_builder' ),
				'selector' => '.et_pb_counter_amount',
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( '2QLX8Lwr3cs' ),
				'name' => esc_html__( 'An introduction to the Bar Counter module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'bar_bg_color' => array(
				'label'             => esc_html__( 'Bar Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'bar',
				'description'       => esc_html__( 'This will change the fill color for the bar.', 'et_builder' ),
				'default'           => et_builder_accent_color(),
			),
			'use_percentages' => array(
				'label'             => esc_html__( 'Use Percentages', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'On', 'et_builder' ),
					'off' => esc_html__( 'Off', 'et_builder' ),
				),
				'toggle_slug'       => 'elements',
				'default_on_front'  => 'on',
			),
		);

		return $fields;
	}

	function before_render() {
		global $et_pb_counters_settings;

		$background_color          = $this->props['background_color'];
		$background_image          = $this->props['background_image'];
		$parallax                  = $this->props['parallax'];
		$parallax_method           = $this->props['parallax_method'];
		$background_video_mp4      = $this->props['background_video_mp4'];
		$background_video_webm     = $this->props['background_video_webm'];
		$background_video_width    = $this->props['background_video_width'];
		$background_video_height   = $this->props['background_video_height'];
		$allow_player_pause        = $this->props['allow_player_pause'];
		$bar_bg_color              = $this->props['bar_bg_color'];
		$use_percentages           = $this->props['use_percentages'];
		$background_video_pause_outside_viewport = $this->props['background_video_pause_outside_viewport'];

		$et_pb_counters_settings = array(
			'background_color'          => $background_color,
			'background_image'          => $background_image,
			'parallax'                  => $parallax,
			'parallax_method'           => $parallax_method,
			'background_video_mp4'      => $background_video_mp4,
			'background_video_webm'     => $background_video_webm,
			'background_video_width'    => $background_video_width,
			'background_video_height'   => $background_video_height,
			'allow_player_pause'        => $allow_player_pause,
			'bar_bg_color'              => $bar_bg_color,
			'use_percentages'           => $use_percentages,
			'background_video_pause_outside_viewport' => $background_video_pause_outside_viewport,
		);
	}
	public function amp_divi_inline_styles(){
    global $et_pb_counters_settings;
    $standard_styles = '/* Bar Counter Module */
.et_pb_counters span.et_pb_counter_amount_number {
	display: inline-block;
	padding-left: 5px;
}

.et_pb_counters.et_pb_section_video > li {
	position: relative;
}

.et_pb_counters > li.et_pb_section_video .et_pb_counter_amount {
	position: relative;
}

.et_pb_counters li:last-of-type .et_pb_counter_container {
	margin-bottom: 0;
}

.et_pb_text_align_left .et_pb_counter_amount {
	text-align: left;
}

.et_pb_text_align_center .et_pb_counter_amount {
	text-align: center;
}

.et_pb_text_align_right .et_pb_counter_amount {
	text-align: right;
}

.et_pb_text_align_justified .et_pb_counter_amount {
	text-align: justify;
}';

    $inline_styles = '.graph {
                width: 100%;
                height: 25px;
                background: #dddddd;
                position: relative;
            }
            #bar {
                height: 25px;
                background: #7EBEC5; 
                position: relative;
            }
            #bar p {     
           		position: absolute;
			    text-align: right;
			    width: 100%;
			    line-height: 25px;
			    color: #fff;
			    padding-right: 20px;
			}
            .error {
                background-color: #fceabb;
                padding: 1em;
                font-weight: bold;
                color: red;
                border: 1px solid red;
            }
            .et_pb_counters li{
            	list-style-type:none;
            	font-size: 12px;
    			margin-bottom: 10px;
            }
            ';
            echo $standard_styles.''.$inline_styles;
  		}
  	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}
	function render( $attrs, $content = null, $render_slug ) {
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$background_layout  = $this->props['background_layout'];

		$video_background = $this->video_background();

		// Module classname
		$this->add_classname( array(
			'et-waypoint',
			"et_pb_bg_layout_{$background_layout}",
		) );

		$this->add_classname( $this->get_text_orientation_classname() );

		$output = sprintf(
			'<ul%3$s class="%2$s">
				%1$s
			</ul> <!-- .et_pb_counters -->',
			$this->content,
			$this->module_classname( $render_slug ),
			$this->module_id()
		);

		return $output;
	}
}

$barCountersObj = new AMP_ET_Builder_Module_Bar_Counters();
remove_shortcode( 'et_pb_counters' );
add_shortcode( 'et_pb_counters', array($barCountersObj, '_render'));
}