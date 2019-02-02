<?php
if(class_exists('ET_Builder_Module_Text')){
class AMP_ET_Builder_Module_Text extends ET_Builder_Module {
	public $ampTextAtts = array();
	public $ampTextProps = array();
	function init() {
		$this->name       = esc_html__( 'Text', 'et_builder' );
		$this->slug       = 'et_pb_text';
		$this->vb_support = 'on';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'text' => array(
						'title'    => esc_html__( 'Text', 'et_builder' ),
						'priority' => 45,
						'tabbed_subtoggles' => true,
						'bb_icons_support' => true,
						'sub_toggles' => array(
							'p'     => array(
								'name' => 'P',
								'icon' => 'text-left',
							),
							'a'     => array(
								'name' => 'A',
								'icon' => 'text-link',
							),
							'ul'    => array(
								'name' => 'UL',
								'icon' => 'list',
							),
							'ol'    => array(
								'name' => 'OL',
								'icon' => 'numbered-list',
							),
							'quote' => array(
								'name' => 'QUOTE',
								'icon' => 'text-quote',
							),
						),
					),
					'header' => array(
						'title'    => esc_html__( 'Heading Text', 'et_builder' ),
						'priority' => 49,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'h1' => array(
								'name' => 'H1',
								'icon' => 'text-h1',
							),
							'h2' => array(
								'name' => 'H2',
								'icon' => 'text-h2',
							),
							'h3' => array(
								'name' => 'H3',
								'icon' => 'text-h3',
							),
							'h4' => array(
								'name' => 'H4',
								'icon' => 'text-h4',
							),
							'h5' => array(
								'name' => 'H5',
								'icon' => 'text-h5',
							),
							'h6' => array(
								'name' => 'H6',
								'icon' => 'text-h6',
							),
						),
					),
					'width' => array(
						'title'    => esc_html__( 'Sizing', 'et_builder' ),
						'priority' => 65,
					),
				),
			),
		);

		$this->main_css_element = '%%order_class%%';

		$this->advanced_fields = array(
			'fonts'                 => array(
				'text'   => array(
					'label'    => esc_html__( 'Text', 'et_builder' ),
					'css'      => array(
						'line_height' => "{$this->main_css_element} p",
						'color' => "{$this->main_css_element}.et_pb_text",
					),
					'line_height' => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size' => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'text',
					'sub_toggle'  => 'p',
					'hide_text_align' => true,
				),
				'link'   => array(
					'label'    => esc_html__( 'Link', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} a",
						'color' => "{$this->main_css_element}.et_pb_text a",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size' => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'text',
					'sub_toggle'  => 'a',
				),
				'ul'   => array(
					'label'    => esc_html__( 'Unordered List', 'et_builder' ),
					'css'      => array(
						'main'        => "{$this->main_css_element} ul",
						'color'       => "{$this->main_css_element}.et_pb_text ul",
						'line_height' => "{$this->main_css_element} ul li",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size' => array(
						'default' => '14px',
					),
					'toggle_slug' => 'text',
					'sub_toggle'  => 'ul',
				),
				'ol'   => array(
					'label'    => esc_html__( 'Ordered List', 'et_builder' ),
					'css'      => array(
						'main'        => "{$this->main_css_element} ol",
						'color'       => "{$this->main_css_element}.et_pb_text ol",
						'line_height' => "{$this->main_css_element} ol li",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size' => array(
						'default' => '14px',
					),
					'toggle_slug' => 'text',
					'sub_toggle'  => 'ol',
				),
				'quote'   => array(
					'label'    => esc_html__( 'Blockquote', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} blockquote",
						'color' => "{$this->main_css_element}.et_pb_text blockquote",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size' => array(
						'default' => '14px',
					),
					'toggle_slug' => 'text',
					'sub_toggle'  => 'quote',
				),
				'header'   => array(
					'label'    => esc_html__( 'Heading', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h1",
					),
					'font_size' => array(
						'default' => absint( et_get_option( 'body_header_size', '30' ) ) . 'px',
					),
					'toggle_slug' => 'header',
					'sub_toggle'  => 'h1',
				),
				'header_2'   => array(
					'label'    => esc_html__( 'Heading 2', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h2",
					),
					'font_size' => array(
						'default' => '26px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'header',
					'sub_toggle'  => 'h2',
				),
				'header_3'   => array(
					'label'    => esc_html__( 'Heading 3', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h3",
					),
					'font_size' => array(
						'default' => '22px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'header',
					'sub_toggle'  => 'h3',
				),
				'header_4'   => array(
					'label'    => esc_html__( 'Heading 4', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h4",
					),
					'font_size' => array(
						'default' => '18px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'header',
					'sub_toggle'  => 'h4',
				),
				'header_5'   => array(
					'label'    => esc_html__( 'Heading 5', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h5",
					),
					'font_size' => array(
						'default' => '16px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'header',
					'sub_toggle'  => 'h5',
				),
				'header_6'   => array(
					'label'    => esc_html__( 'Heading 6', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h6",
					),
					'font_size' => array(
						'default' => '14px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'header',
					'sub_toggle'  => 'h6',
				),
			),
			'background'            => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'text'                  => array(
				'use_background_layout' => true,
				'sub_toggle'  => 'p',
				'options' => array(
					'text_orientation' => array(
						'default'          => 'left',
					),
					'background_layout' => array(
						'default' => 'light',
					),
				),
			),
			'text_shadow'           => array(
				// Don't add text-shadow fields since they already are via font-options
				'default' => false,
			),
			'button'                => false,
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'oL00RjEKZaU' ),
				'name' => esc_html__( 'An introduction to the Text module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'content' => array(
				'label'           => esc_html__( 'Content', 'et_builder' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can create the content that will be used within the module.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
			),
			'ul_type' => array(
				'label'             => esc_html__( 'Unordered List Style Type', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'disc'    => esc_html__( 'Disc', 'et_builder' ),
					'circle'  => esc_html__( 'Circle', 'et_builder' ),
					'square'  => esc_html__( 'Square', 'et_builder' ),
					'none'    => esc_html__( 'None', 'et_builder' ),
				),
				'priority'          => 80,
				'default'           => 'disc',
				'default_on_front'  => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'text',
				'sub_toggle'        => 'ul',
			),
			'ul_position' => array(
				'label'             => esc_html__( 'Unordered List Style Position', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'outside' => esc_html__( 'Outside', 'et_builder' ),
					'inside'  => esc_html__( 'Inside', 'et_builder' ),
				),
				'priority'          => 85,
				'default'           => 'outside',
				'default_on_front'  => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'text',
				'sub_toggle'        => 'ul',
			),
			'ul_item_indent' => array(
				'label'           => esc_html__( 'Unordered List Item Indent', 'et_builder' ),
				'type'            => 'range',
				'option_category' => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'text',
				'sub_toggle'      => 'ul',
				'priority'        => 90,
				'default'         => '0px',
				'default_unit'    => 'px',
				'default_on_front' => '',
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
			),
			'ol_type' => array(
				'label'             => esc_html__( 'Ordered List Style Type', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'decimal'              => 'decimal',
					'armenian'             => 'armenian',
					'cjk-ideographic'      => 'cjk-ideographic',
					'decimal-leading-zero' => 'decimal-leading-zero',
					'georgian'             => 'georgian',
					'hebrew'               => 'hebrew',
					'hiragana'             => 'hiragana',
					'hiragana-iroha'       => 'hiragana-iroha',
					'katakana'             => 'katakana',
					'katakana-iroha'       => 'katakana-iroha',
					'lower-alpha'          => 'lower-alpha',
					'lower-greek'          => 'lower-greek',
					'lower-latin'          => 'lower-latin',
					'lower-roman'          => 'lower-roman',
					'upper-alpha'          => 'upper-alpha',
					'upper-greek'          => 'upper-greek',
					'upper-latin'          => 'upper-latin',
					'upper-roman'          => 'upper-roman',
					'none'                 => 'none',
				),
				'priority'          => 80,
				'default'           => 'decimal',
				'default_on_front' => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'text',
				'sub_toggle'        => 'ol',
			),
			'ol_position' => array(
				'label'             => esc_html__( 'Ordered List Style Position', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'outside' => esc_html__( 'Outside', 'et_builder' ),
					'inside'  => esc_html__( 'Inside', 'et_builder' ),
				),
				'priority'          => 85,
				'default'           => 'outside',
				'default_on_front' => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'text',
				'sub_toggle'        => 'ol',
			),
			'ol_item_indent' => array(
				'label'           => esc_html__( 'Ordered List Item Indent', 'et_builder' ),
				'type'            => 'range',
				'option_category' => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'text',
				'sub_toggle'      => 'ol',
				'priority'        => 90,
				'default'         => '0px',
				'default_unit'    => 'px',
				'default_on_front' => '',
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
			),
			'quote_border_weight' => array(
				'label'           => esc_html__( 'Blockquote Border Weight', 'et_builder' ),
				'type'            => 'range',
				'option_category' => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'text',
				'sub_toggle'      => 'quote',
				'priority'        => 85,
				'default'         => '5px',
				'default_unit'    => 'px',
				'default_on_front' => '',
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
			),
			'quote_border_color' => array(
				'label'           => esc_html__( 'Blockquote Border Color', 'et_builder' ),
				'type'            => 'color-alpha',
				'option_category' => 'configuration',
				'custom_color'    => true,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'text',
				'sub_toggle'      => 'quote',
				'field_template'  => 'color',
				'priority'        => 90,
			),
		);

		return $fields;
	}
	public function amp_divi_inline_styles(){
		global $amp_et_pb_text_settings;
		$font_size = isset($this->props['header_font_size'])? $this->props['header_font_size']: '16px';
		$text_color = isset($this->props['header_text_color'])? $this->props['header_text_color']: '#333';
		$text_color = isset($this->props['header_line_height'])? $this->props['header_line_height']: '#333';
		
        $textProps = $this->ampTextProps;
		$textAtts = $this->ampTextAtts;
		//print_r($textAtts);
		// // //print_r($textProps);
		//die;
		
		$text_main_css = '';
		$header_styles = array();
		$header_tag_css = '';
		foreach ($textAtts as $uniqueKey => $properties) {
			
				foreach($properties as $pkey => $pVal){
					//echo $pkey.'';
					if(substr($pkey, 0, 7) === 'header_'){
						//$style_type = substr($pkey, strpos($pkey, "_") + 1);
						// echo $htag;
						// die;
						preg_match("/header_(\d+)_/", $pkey, $matches);
						if( empty($matches) ){
							$style_type = substr($pkey, strpos($pkey, "_") + 1);    
							$header_styles[1][$style_type] = $pVal;
						}else{
							$style_type = substr($pkey, strpos($pkey, $matches[1]."_") + 1);
							$styles = trim($style_type,"_"); 
							$header_styles[$matches[1]][$styles] = $pVal;
						}
						
					}
					
					//$htag = substr($pkey, strpos($pkey, "_") + 1);
					
				}
				
			if( count($header_styles)>0){
				
				foreach( $header_styles as $headKey => $headStyles){
					$header_tag_css .= '.et_pb_text_'.$uniqueKey.' h'.$headKey.'{';
					$font_size = '';
					if(isset($headStyles['font_size'])){
						$font_size = 'font-size:'.$headStyles['font_size'].';';
					}
					$text_align = '';
					if( isset($headStyles['text_align'])){
						$text_align = 'text-align:'.$headStyles['text_align'].';';
					}
					$text_color = '';
					if( isset($headStyles['text_color'])){
						$text_color = 'color:'.$headStyles['text_color'].';';
					}
					$line_height = '';
					if( isset($headStyles['line_height'])){
						$line_height = 'line-height:'.$headStyles['line_height'].';';
					}
						$header_tag_css .= $font_size;
						$header_tag_css .= $text_align;
						$header_tag_css .= $text_color;
						$header_tag_css .= $line_height;
					$header_tag_css .= '}';
				}
				
			}
			// echo  $htag;
			// //die;
			// die;
			
			$border_radii = '';
			if(isset($textAtts[$uniqueKey]['border_radii'])){
				$radii = explode("|",$textAtts[$uniqueKey]['border_radii']);
				if(count($radii)>1){
					$radius = '';
					for($i=1;$i<count($radii);$i++){
						$radius .= $radii[$i].' ';
					}
				}
				$border_radii = 'border-radius:'.$radius.';';
			}
			$border_width_all = '';
			if(isset($textAtts[$uniqueKey]['border_width_all'])){
				$border_width_all = 'border-width:'.$textAtts[$uniqueKey]['border_width_all'].';';
			}
			$border_color_all = '';
			if(isset($textAtts[$uniqueKey]['border_color_all'])){
				$border_color_all = 'border-color:'.$textAtts[$uniqueKey]['border_color_all'].';';
			}
			$max_width ='';
			if(isset($textAtts[$uniqueKey]['max_width'])){
				$max_width = 'max-width:'.$textAtts[$uniqueKey]['max_width'].';';
			}
			$custom_margin = '';
			if( isset($textAtts[$uniqueKey]['custom_margin']) ){
				$margins = explode("|",$textAtts[$uniqueKey]['custom_margin']);
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
			if( isset($textAtts[$uniqueKey]['custom_padding']) ){
				$paddings = explode("|",$textAtts[$uniqueKey]['custom_padding']);
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
			$text_font_size = '';
			if(isset($textAtts[$uniqueKey]['text_font_size'])){
				$text_font_size = 'font-size:'.$textAtts[$uniqueKey]['text_font_size'].';';
			}
			$text_letter_spacing = '';
			if( isset($textAtts[$uniqueKey]['text_letter_spacing']) ){
				$text_letter_spacing = 'letter-spacing:'.$textAtts[$uniqueKey]['text_letter_spacing'].';';
			}
			$text_line_height = '';
			if( isset($textAtts[$uniqueKey]['text_line_height']) ){
				$text_line_height = 'line-height:'.$textAtts[$uniqueKey]['text_line_height'].';';
			}
			$text_text_color = '';
			if( isset($textAtts[$uniqueKey]['text_text_color']) ){
				$text_text_color = 'color:'.$textAtts[$uniqueKey]['text_text_color'].';';
			}
			$text_main_css .= '.et_pb_text_'.$uniqueKey.'{';
			$text_main_css .= $border_radii;
			$text_main_css .= $border_width_all;
			$text_main_css .= $border_color_all;
			$text_main_css .= $max_width;
			$text_main_css .= $custom_margin;
			$text_main_css .= $custom_padding;
			$text_main_css .= $text_font_size;
			$text_main_css .= $text_letter_spacing;
			$text_main_css .= $text_line_height;
			$text_main_css .= $text_text_color;
			$text_main_css .= '}';
		}
		
		echo $header_tag_css;
		echo $text_main_css;
		//die;
		//echo $text_main_css;
  	}
  	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}

	function render( $attrs, $content = null, $render_slug ) {
		$uniqueId = $this->render_count();
		$this->ampTextAtts[$uniqueId] = $attrs;
		$this->ampTextProps[$uniqueId] = $this->props;
		
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$background_layout    = $this->props['background_layout'];
		$ul_type              = $this->props['ul_type'];
		$ul_position          = $this->props['ul_position'];
		$ul_item_indent       = $this->props['ul_item_indent'];
		$ol_type              = $this->props['ol_type'];
		$ol_position          = $this->props['ol_position'];
		$ol_item_indent       = $this->props['ol_item_indent'];
		$quote_border_weight  = $this->props['quote_border_weight'];
		$quote_border_color   = $this->props['quote_border_color'];
		// 
		$this->content = et_builder_replace_code_content_entities( $this->content );

		$video_background = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		if ( '' !== $ul_type || '' !== $ul_position || '' !== $ul_item_indent ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% ul',
				'declaration' => sprintf(
					'%1$s
					%2$s
					%3$s',
					'' !== $ul_type ? sprintf( 'list-style-type: %1$s;', esc_html( $ul_type ) ) : '',
					'' !== $ul_position ? sprintf( 'list-style-position: %1$s;', esc_html( $ul_position ) ) : '',
					'' !== $ul_item_indent ? sprintf( 'padding-left: %1$s;', esc_html( $ul_item_indent ) ) : ''
				),
			) );
		}

		if ( '' !== $ol_type || '' !== $ol_position || '' !== $ol_item_indent ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% ol',
				'declaration' => sprintf(
					'%1$s
					%2$s
					%3$s',
					'' !== $ol_type ? sprintf( 'list-style-type: %1$s;', esc_html( $ol_type ) ) : '',
					'' !== $ol_position ? sprintf( 'list-style-position: %1$s;', esc_html( $ol_position ) ) : '',
					'' !== $ol_item_indent ? sprintf( 'padding-left: %1$s;', esc_html( $ol_item_indent ) ) : ''
				),
			) );
		}

		if ( '' !== $quote_border_weight || '' !== $quote_border_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% blockquote',
				'declaration' => sprintf(
					'%1$s
					%2$s',
					'' !== $quote_border_weight ? sprintf( 'border-width: %1$s;', esc_html( $quote_border_weight ) ) : '',
					'' !== $quote_border_color ? sprintf( 'border-color: %1$s;', esc_html( $quote_border_color ) ) : ''
				),
			) );
		}

		// Module classnames
		$this->add_classname( array(
			"et_pb_bg_layout_{$background_layout}",
			$this->get_text_orientation_classname(),
		) );

		$output = sprintf(
			'<div%3$s class="%2$s">
				%5$s
				%4$s
				<div class="et_pb_text_inner %6$s">
					%1$s
				</div>
			</div> <!-- .et_pb_text -->',
			$this->content,
			$this->module_classname( $render_slug ),
			$this->module_id(),
			$video_background,
			$parallax_image_background,
			$this->render_count()
		);

		return $output;
	}
}

$textObj = new AMP_ET_Builder_Module_Text();
remove_shortcode( 'et_pb_text' );
add_shortcode( 'et_pb_text', array( $textObj, '_render'));
}