<?php
if(class_exists('ET_Builder_Module_Code')){
class AMP_ET_Builder_Module_Code extends ET_Builder_Module {
	function init() {
		$this->name            = esc_html__( 'Code', 'et_builder' );
		$this->slug            = 'et_pb_code';
		$this->vb_support      = 'on';
		$this->use_row_content = true;
		$this->decode_entities = true;

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'width' => array(
						'title'    => esc_html__( 'Sizing', 'et_builder' ),
						'priority' => 65,
					),
				),
			),
		);

		$this->advanced_fields = array(
			'borders'               => array(
				'default' => false,
			),
			'margin_padding' => array(
				'css' => array(
					'important' => array( 'custom_margin' ), // needed to overwrite last module margin-bottom styling
				),
			),
			'text_shadow'           => array(
				// Don't add text-shadow fields since they already are via font-options
				'default' => false,
			),
			'box_shadow'            => array(
				'default' => false,
			),
			'fonts'                 => false,
			'button'                => false,
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'dTY6-Cbr00A' ),
				'name' => esc_html__( 'An introduction to the Code module', 'et_builder' ),
			),
		);

		// wptexturize is often incorrectly parsed single and double quotes
		// This disables wptexturize on this module
		add_filter( 'no_texturize_shortcodes', array( $this, 'disable_wptexturize' ) );
	}

	function get_fields() {
		$fields = array(
			'raw_content' => array(
				'label'           => esc_html__( 'Content', 'et_builder' ),
				'type'            => 'codemirror',
				'mode'            => 'html',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can create the content that will be used within the module.', 'et_builder' ),
				'is_fb_content'   => true,
				'toggle_slug'     => 'main_content',
			),
		);

		return $fields;
	}
	public function amp_divi_inline_styles(){
    		$inline_styles = '.et_pd_cd{
			        font-size: 16px;
			        color: #555;
			      }';
            echo $inline_styles;
  	}
  	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}
	function render( $attrs, $content = null, $render_slug ) {
		add_action('amp_post_template_css',array($this,'amp_divi_inline_styles'));
		$video_background          = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();
		$this->content             = et_builder_convert_line_breaks( et_builder_replace_code_content_entities( $this->content ) );

		// Module classnames
		$this->add_classname( $this->get_text_orientation_classname() );

		$output = sprintf(
			'<div%2$s class="%3$s">
				%5$s
				%4$s
				<div class="et_pb_code_inner">
					%1$s
				</div> <!-- .et_pb_code_inner -->
			</div> <!-- .et_pb_code -->',
			$this->content,
			$this->module_id(),
			$this->module_classname( $render_slug ),
			$video_background,
			$parallax_image_background
		);

		return $output;
	}
}

$codeObj = new AMP_ET_Builder_Module_Code();
remove_shortcode( 'et_pb_code' );
add_shortcode( 'et_pb_code', array($codeObj, '_render'));
}