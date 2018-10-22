<?php

class AMP_ET_Builder_Module_Tabs extends ET_Builder_Module {
	function init() {
		$this->name            = esc_html__( 'Tabs', 'et_builder' );
		$this->plural          = esc_html__( 'Tabs', 'et_builder' );
		$this->slug            = 'et_pb_tabs';
		$this->vb_support      = 'on';
		$this->child_slug      = 'et_pb_tab';
		$this->child_item_text = esc_html__( 'Tab', 'et_builder' );
		$this->main_css_element = '%%order_class%%.et_pb_tabs';

		$this->advanced_fields = array(
			'borders'               => array(
				'default' => array(
					'css'      => array(
						'main' => array(
							'border_radii'  => $this->main_css_element,
							'border_styles' => $this->main_css_element,
						),
					),
					'defaults' => array(
						'border_radii'  => 'on||||',
						'border_styles' => array(
							'width' => '1px',
							'color' => '#d9d9d9',
							'style' => 'solid',
						),
					),
				),
			),
			'fonts'                 => array(
				'tab' => array(
					'label'    => esc_html__( 'Tab', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .et_pb_tabs_controls li, {$this->main_css_element} .et_pb_tabs_controls li a",
						'color' => "{$this->main_css_element} .et_pb_tabs_controls li a",
					),
					'hide_text_align' => true,
				),
				'body'   => array(
					'label'    => esc_html__( 'Body', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .et_pb_all_tabs .et_pb_tab",
						'plugin_main' => "{$this->main_css_element} .et_pb_all_tabs .et_pb_tab, {$this->main_css_element} .et_pb_all_tabs .et_pb_tab p",
						'line_height' => "{$this->main_css_element} .et_pb_tab p",
					),
				),
			),
			'background'            => array(
				'css' => array(
					'main' => "{$this->main_css_element} .et_pb_all_tabs",
				),
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'margin_padding' => array(
				'css' => array(
					'padding' => '%%order_class%% .et_pb_tab',
					'important' => array( 'custom_margin' ), // needed to overwrite last module margin-bottom styling
				),
			),
			'text'                  => false,
			'button'                => false,
		);

		$this->custom_css_fields = array(
			'tabs_controls' => array(
				'label'    => esc_html__( 'Tabs Controls', 'et_builder' ),
				'selector' => '.et_pb_tabs_controls',
			),
			'tab' => array(
				'label'    => esc_html__( 'Tab', 'et_builder' ),
				'selector' => '.et_pb_tabs_controls li',
			),
			'active_tab' => array(
				'label'    => esc_html__( 'Active Tab', 'et_builder' ),
				'selector' => '.et_pb_tabs_controls li.et_pb_tab_active',
			),
			'tabs_content' => array(
				'label'    => esc_html__( 'Tabs Content', 'et_builder' ),
				'selector' => '.et_pb_tab',
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'xk2Ite-oFhg' ),
				'name' => esc_html__( 'An introduction to the Tabs module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'active_tab_background_color' => array(
				'label'             => esc_html__( 'Active Tab Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'tab',
				'hover'             => 'tabs',
			),
			'inactive_tab_background_color' => array(
				'label'             => esc_html__( 'Inactive Tab Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'tab',
				'hover'             => 'tabs',
			),
		);
		return $fields;
	}

	public function get_transition_fields_css_props() {
		$fields = parent::get_transition_fields_css_props();

		$fields['inactive_tab_background_color'] = array( 'background-color' => '%%order_class%% .et_pb_tabs_controls li' );
		$fields['active_tab_background_color'] = array( 'background-color' => '%%order_class%% .et_pb_tabs_controls li' );

		return $fields;
	}
	public function amp_divi_inline_styles(){
    
		$inline_styles = '.ampTabContainer {
			    display: flex;
			    flex-wrap: wrap;
			}

			.tabButton[selected] {
			    outline: none;
			    background: #ccc;
			}

			.tabButton {
			    list-style: none;
			    flex-grow: 1;
			    text-align: center;
			    cursor: pointer;
			}

			.tabContent {
			    display: none;
			    width: 100%;
			    order: 1; /* must be greater than the order of the tab buttons to flex to the next line */
			    border: 1px solid #ccc;
			}

			.tabButton[selected]+.tabContent {
			    display: block;
			}
			amp-selector {
			          padding: 1rem;
			          margin: 1rem;
			}
			.et_pb_tabs .tabButton[selected]{
			      background:#fff;
			      border-bottom: 1px solid #f4f4f4;
			      color:#333;
			    }
			    .et_pb_tabs amp-selector [option][selected]{
			      outline:none;
			    }
			    .et_pb_tabs .tabButton {
			      font-size: 16px;
			      font-weight: 600;
			      padding: 10px;
			      background: #f4f4f4;
			      color: #666;
			      border-right: 1px solid #d9d9d9;
			      border-bottom: 1px solid #d9d9d9;
			    }
			    .et_pb_tabs .tabContent {
			      padding: 25px;
			      font-size: 16px;
			      line-height: 1.3;
			      font-weight: 400;
			      color: #797f7f;
			      border:none;
			    }
			    .et_pb_tabs .ampTabContainer{
			      border:1px solid #d9d9d9;
			      padding:0;
			    }';
        echo $inline_styles;
  	}
	function render( $attrs, $content = null, $render_slug ) {
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$active_tab_background_color         = $this->props['active_tab_background_color'];
		$active_tab_background_color_hover   = $this->get_hover_value( 'active_tab_background_color' );
		$inactive_tab_background_color       = $this->props['inactive_tab_background_color'];
		$inactive_tab_background_color_hover = $this->get_hover_value( 'inactive_tab_background_color' );

		$all_tabs_content = $this->content;
		preg_match_all("/<div class=\"et_pb_tab_content\">(.*?)<\/div>/si", $all_tabs_content, $matchesContent);
		$all_tabs_contents = $matchesContent[1];

		global $et_pb_tab_titles;
		global $et_pb_tab_classes;

		if ( '' !== $inactive_tab_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_tabs_controls li',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $inactive_tab_background_color )
				),
			) );
		}

		if ( et_builder_is_hover_enabled( 'inactive_tab_background_color', $this->props ) ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%%:hover .et_pb_tabs_controls li',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $inactive_tab_background_color_hover )
				),
			) );
		}

		if ( '' !== $active_tab_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_tabs_controls li.et_pb_tab_active',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $active_tab_background_color )
				),
			) );
		}

		if ( et_builder_is_hover_enabled( 'active_tab_background_color', $this->props ) ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%%:hover .et_pb_tabs_controls li.et_pb_tab_active',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $active_tab_background_color_hover )
				),
			) );
		}

		$tabs = '';

		$i = 0;
		if ( ! empty( $et_pb_tab_titles ) ) {
			foreach ( $et_pb_tab_titles as $tab_title ){
				++$i;
				$tabs .= sprintf( '<div role="tab" class="tabButton" '.( $i==1 ?'selected':'').' option="'.$i.'">%2$s</div>
					<div role="tabpanel" class="tabContent">%4$s</div>',
					( 1 == $i ? ' et_pb_tab_active' : '' ),
					esc_html( $tab_title ),
					esc_attr( ltrim( $et_pb_tab_classes[ $i-1 ] ) ),
					$all_tabs_contents[$i-1]
				);
			}
		}

		$video_background = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		$et_pb_tab_titles = $et_pb_tab_classes = array();

		// Module classnames
		$this->add_classname( array(
			$this->get_text_orientation_classname(),
		) );

 		$output = sprintf(
			'<amp-selector role="tablist" layout="container" %3$s class="%4$s ampTabContainer">
				%6$s
				%5$s
					%1$s
			</amp-selector> <!-- .et_pb_tabs -->',
			$tabs,
			$all_tabs_content,
			$this->module_id(),
			$this->module_classname( $render_slug ),
			$video_background,
			$parallax_image_background
 		);

		return $output;
	}

	public function process_box_shadow( $function_name ) {
		$boxShadow = ET_Builder_Module_Fields_Factory::get( 'BoxShadow' );
		$style     = $boxShadow->get_value( $this->props );

		if ( $boxShadow->is_inset( $style ) ) {
			$this->advanced_fields['box_shadow'] = array(
				'default' => array(
					'css' => array(
						'main' => '%%order_class%% .et-pb-active-slide',
					),
				),
			);


		}

		parent::process_box_shadow( $function_name );
	}
}

$tabsObj = new AMP_ET_Builder_Module_Tabs();
remove_shortcode( 'et_pb_tabs' );
add_shortcode( 'et_pb_tabs', array($tabsObj, '_render'));