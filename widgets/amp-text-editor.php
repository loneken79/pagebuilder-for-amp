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
		$settings['drop_cap'] = (!empty($settings['drop_cap']) ? $settings['drop_cap']:'no');
		$drop_cap_css = '';
		$margin = '';		
		$all_margins = array_filter($settings['_margin'], function($value){return $value != ''; });
		if(count($all_margins)>1){
			unset($all_margins['unit']);
			unset($all_margins['isLinked']);
			foreach ($all_margins as $key => $value) {
				$margin .= $value.'px ';
			}
			$margin = 'margin:'.$margin.';'; 
		}
		$padding = '';
		$all_paddings = array_filter($settings['_padding'],function($value){return $value != '';});
		if( count($all_paddings)>1){

			unset($all_paddings['unit']);
			unset($all_paddings['isLinked']);
			foreach ($all_paddings as $key => $value) {
				$padding .= $value.'px ';
			}
			$padding = 'padding:'.$padding.';'; 
		}
		$align = '';
		if(!empty($settings['align']) && isset($settings['align']) ){
			$align = 'text-align:'.$settings['align'].';';
		}
		$text_color = '';
		if(isset($settings['text_color']) && !empty($settings['text_color'])){
			$text_color = 'color:'.$settings['text_color'].';';
		}
		$typography_font_size ='';
		if(!empty($settings['typography_font_size']['unit']) && !empty($settings['typography_font_size']['size'])){
			$typography_font_size = 'font-size:'.$settings['typography_font_size']['size'].''.$settings['typography_font_size']['unit'].';';
		}
		$typography_font_weight = '';
		if( isset($settings['typography_font_weight']) && !empty($settings['typography_font_weight']) ){
			$typography_font_weight = 'font-weight:'.$settings['typography_font_weight'].';';
		}
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
		/*.elementor-'.get_the_ID().' .elementor-element.elementor-element-'.$this->get_id().' > .elementor-widget-container{
			    '.$margin.''.$padding.'
		}*/
		$dynamicStyles = '.elementor-element-'.$this->get_id().' .elementor-text-editor{
			'.$align.''.$text_color.''.$typography_font_size.''.$typography_font_weight.'
		}
		';
        global $amp_elemetor_custom_css;
		$amp_elemetor_custom_css['amp-text-editor'][$this->get_id()] = $inline_styles.''.$dynamicStyles.''.$drop_cap_css;		/*if($this->get_id() == '438238bd'){			print_r($amp_elemetor_custom_css['amp-text-editor'][$this->get_id()]);			die;		}*/
	}

	protected function render() {

		$this->amp_elementor_widget_styles();
		$settings = $this->get_settings_for_display();
		
		$default_text = '<p>Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>';
		
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
