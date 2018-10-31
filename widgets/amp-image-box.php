<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Image_Box extends Widget_Base {

	public function get_name() {
		return 'image-box';
	}

	public function get_title() {
		return __( 'Amp Image Box', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$inline_styles = '
			.el-image-box-wrapper{
				width:100%;
				text-align:center;
			}
			.el-image-box-img{
				margin:0 auto;
			}
			.el-image-box-content{
				color: #555;
    			font-size: 18px;
    			margin-top: 15px;
			}
			.el-image-box-content h2{
				font-size:18px;
				color:#333;
				font-weight:600;
    			display: inline-block;
			}
		';
        echo $inline_styles;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		$has_content = ! empty( $settings['title_text'] ) || ! empty( $settings['description_text'] );

		$html = '<div class="elementor-image-box-wrapper">';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );

			if ( $settings['hover_animation'] ) {
				$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['hover_animation'] );
			}

			$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );

			if ( ! empty( $settings['link']['url'] ) ) {
				$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
			}

			$html .= '<figure class="elementor-image-box-img">' . $image_html . '</figure>';
		}

		if ( $has_content ) {
			$html .= '<div class="elementor-image-box-content">';

			if ( ! empty( $settings['title_text'] ) ) {
				$this->add_render_attribute( 'title_text', 'class', 'elementor-image-box-title' );

				$this->add_inline_editing_attributes( 'title_text', 'none' );

				$title_html = $settings['title_text'];

				if ( ! empty( $settings['link']['url'] ) ) {
					$title_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $title_html . '</a>';
				}

				$html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->get_render_attribute_string( 'title_text' ), $title_html );
			}

			if ( ! empty( $settings['description_text'] ) ) {
				$this->add_render_attribute( 'description_text', 'class', 'elementor-image-box-description' );

				$this->add_inline_editing_attributes( 'description_text' );

				$html .= sprintf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'description_text' ), $settings['description_text'] );
			}

			$html .= '</div>';
		}

		$html .= '</div>';

		echo $html;
	}

	protected function _content_template() {
		?>
		<#
		var html = '<div class="elementor-image-box-wrapper">';

		if ( settings.image.url ) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.thumbnail_size,
				dimension: settings.thumbnail_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );

			var imageHtml = '<img src="' + image_url + '" class="elementor-animation-' + settings.hover_animation + '" />';

			if ( settings.link.url ) {
				imageHtml = '<a href="' + settings.link.url + '">' + imageHtml + '</a>';
			}

			html += '<figure class="elementor-image-box-img">' + imageHtml + '</figure>';
		}

		var hasContent = !! ( settings.title_text || settings.description_text );

		if ( hasContent ) {
			html += '<div class="elementor-image-box-content">';

			if ( settings.title_text ) {
				var title_html = settings.title_text;

				if ( settings.link.url ) {
					title_html = '<a href="' + settings.link.url + '">' + title_html + '</a>';
				}

				view.addRenderAttribute( 'title_text', 'class', 'elementor-image-box-title' );

				view.addInlineEditingAttributes( 'title_text', 'none' );

				html += '<' + settings.title_size  + ' ' + view.getRenderAttributeString( 'title_text' ) + '>' + title_html + '</' + settings.title_size  + '>';
			}

			if ( settings.description_text ) {
				view.addRenderAttribute( 'description_text', 'class', 'elementor-image-box-description' );

				view.addInlineEditingAttributes( 'description_text' );

				html += '<p ' + view.getRenderAttributeString( 'description_text' ) + '>' + settings.description_text + '</p>';
			}

			html += '</div>';
		}

		html += '</div>';

		print( html );
		#>
		<?php
	}
}
