<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Heading extends Widget_Base {

	public function get_name() {
		return 'heading';
	}
	
	public function get_title() {
		return __( 'Hello World', 'elementor-hello-world' );
	}
	
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$settings = $this->get_settings_for_display();
	
		$settings['link']['url'] = (!empty($settings['link']['url']) ? $settings['link']['url']:'#');
		$settings['align'] = (!empty($settings['align']) ? $settings['align']:'left');
		$settings['title_color'] = (!empty($settings['title_color']) ? $settings['title_color']:'#6ec1e4');
		$inline_styles = '
		.elementor-element-'.$this->get_id().' .elementor-size-medium{
			font-size: 19px;
		}
		.elementor-element-'.$this->get_id().' .elementor-size-small{
			font-size: 15px;
		}
		.elementor-element-'.$this->get_id().' .elementor-size-default{
			font-size: 16px;
		}
		.elementor-element-'.$this->get_id().' .elementor-size-large{
			font-size: 29px;
		}
		.elementor-element-'.$this->get_id().' .elementor-size-xl{
			font-size: 39px;
		}
		.elementor-element-'.$this->get_id().' .elementor-size-xxl{
			font-size: 59px;
		}
		.elementor-heading-title-'.$this->get_id().', .elementor-heading-title-'.$this->get_id().' a{
			font-weight:600;
			color:'.$settings['title_color'].';
			text-align:'.$settings['align'].';
		}
		';
		global $amp_elemetor_custom_css;
		$amp_elemetor_custom_css['amp-heading'][$this->get_id()] = $inline_styles;
        //echo $inline_styles;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->amp_elementor_widget_styles();
		$settings['header_size'] = (!empty($settings['header_size']) ? $settings['header_size']:'h2');
		$settings['size'] = (!empty($settings['size']) ? $settings['size']:'default');
		if ( empty( $settings['title'] ) ) {
			return;
		}

		$this->add_render_attribute( 'title', 'class', 'elementor-heading-title-'.$this->get_id().' elementor-size-'.$settings['size'] );

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'title', 'class', 'elementor-size-'. $settings['size'] );
		}

		$this->add_inline_editing_attributes( 'title' );

		$title = $settings['title'];

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'url', 'rel', 'nofollow' );
			}

			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}

		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'title' ), $title );

		echo $title_html;
	}

	protected function _content_template() {
		?>
		<#
		var title = settings.title;

		if ( '' !== settings.link.url ) {
			title = '<a href="' + settings.link.url + '">' + title + '</a>';
		}

		view.addRenderAttribute( 'title', 'class', [ 'elementor-heading-title', 'elementor-size-' + settings.size ] );

		view.addInlineEditingAttributes( 'title' );

		var title_html = '<' + settings.header_size  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + title + '</' + settings.header_size + '>';

		print( title_html );
		#>
		<?php
	}
}
