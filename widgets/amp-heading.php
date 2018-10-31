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
		$inline_styles = '
			.el-heading-title{
				font-size:16px;
				font-weight:600;
				color:#555;
			}
		';
        echo $inline_styles;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		if ( empty( $settings['title'] ) ) {
			return;
		}

		$this->add_render_attribute( 'title', 'class', 'elementor-heading-title' );

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'title', 'class', 'elementor-size-' . $settings['size'] );
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
