<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Text_Editor extends Widget_Base {
	
	public function get_name() {
		return 'text-editor';
	}
	
	public function get_title() {
		return __( 'Amp Text Editor', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}
	
	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$settings = $this->get_settings_for_display( );
		// print_r($settings);//align,,
		// die;
		$settings['align'] = (!empty($settings['align']) ? $settings['align']:'left');
		$settings['text_color'] = (!empty($settings['text_color']) ? $settings['text_color']:'#7a7a7a');
		$drop_cap_css = '';
		if($settings['drop_cap'] == 'yes'){
			$drop_cap_css = '.elementor-element-'.$this->get_id().' .elementor-text-editor p:first-child:first-letter {
			  color:'.$settings['text_color'].';
			  float: left;
			  font-family: Georgia;
			  font-size: 60px;
			  line-height: 60px;
			  padding-right: 8px;
			}';
		}
		$inline_styles = '
			.elementor-element-'.$this->get_id().' .elementor-text-editor{
				font-size:16px;
				color:'.$settings['text_color'].';
				line-height:1.5;
				text-align:'.$settings['align'].';
			}
			'.$drop_cap_css.'
		';
        echo $inline_styles;
	}

	protected function render() {
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		$settings = $this->get_settings_for_display();
		$default_text = '<p>Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>';
		
		//$settings['editor'] = (!empty($settings['editor']) ? $settings['editor']: $default_text );
		$editor_content = $this->get_settings_for_display( 'editor' );
		$editor_content = (!empty($editor_content) ? $editor_content: $default_text );
		$editor_content = $this->parse_text_editor( $editor_content );

		$this->add_render_attribute( 'editor', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );

		$this->add_inline_editing_attributes( 'editor', 'advanced' );
		?>
		<div <?php echo $this->get_render_attribute_string( 'editor' ); ?>><?php echo $editor_content; ?></div>
		<?php
	}

	public function render_plain_content() {
		// In plain mode, render without shortcode
		echo $this->get_settings( 'editor' );
	}
	
	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'editor', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );

		view.addInlineEditingAttributes( 'editor', 'advanced' );
		#>
		<div {{{ view.getRenderAttributeString( 'editor' ) }}}>{{{ settings.editor }}}</div>
		<?php
	}
}
