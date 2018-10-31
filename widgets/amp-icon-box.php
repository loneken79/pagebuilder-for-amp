<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Icon_Box extends Widget_Base {

	public function get_name() {
		return 'icon-box';
	}

	public function get_title() {
		return __( 'Amp Icon Box', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$inline_styles = '
			.el-icon-box-wrapper{
				text-align: center;
			}
			.el-icon-box-content span{
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
		$this->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['hover_animation'] ] );

		$icon_tag = 'span';
		$has_icon = ! empty( $settings['icon'] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
			$icon_tag = 'a';

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );

		$this->add_render_attribute( 'description_text', 'class', 'elementor-icon-box-description' );

		$this->add_inline_editing_attributes( 'title_text', 'none' );
		$this->add_inline_editing_attributes( 'description_text' );
		?>
		<div class="elementor-icon-box-wrapper">
		<?php if ( $has_icon ) : ?>
			<div class="elementor-icon-box-icon">
				<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
				<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
				</<?php echo $icon_tag; ?>>
			</div>
			<?php endif; ?>
			<div class="elementor-icon-box-content">
				<<?php echo $settings['title_size']; ?> class="elementor-icon-box-title">
					<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php echo $this->get_render_attribute_string( 'title_text' ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
				</<?php echo $settings['title_size']; ?>>
				<p <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo $settings['description_text']; ?></p>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<#
		var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
			iconTag = link ? 'a' : 'span';

		view.addRenderAttribute( 'description_text', 'class', 'elementor-icon-box-description' );

		view.addInlineEditingAttributes( 'title_text', 'none' );
		view.addInlineEditingAttributes( 'description_text' );
		#>
		<div class="elementor-icon-box-wrapper">
			<# if ( settings.icon ) { #>
			<div class="elementor-icon-box-icon">
				<{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
				<i class="{{ settings.icon }}" aria-hidden="true"></i>
			</{{{ iconTag }}}>
		</div>
			<# } #>
			<div class="elementor-icon-box-content">
				<{{{ settings.title_size }}} class="elementor-icon-box-title">
					<{{{ iconTag + ' ' + link }}} {{{ view.getRenderAttributeString( 'title_text' ) }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
				</{{{ settings.title_size }}}>
				<p {{{ view.getRenderAttributeString( 'description_text' ) }}}>{{{ settings.description_text }}}</p>
			</div>
		</div>
		<?php
	}
}
