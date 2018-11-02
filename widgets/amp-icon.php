<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Icon extends Widget_Base {

	public function get_name() {
		return 'icon';
	}

	public function get_title() {
		return __( 'Amp Icon', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$settings = $this->get_settings_for_display();
		$settings['align'] = (!empty($settings['align']) ? $settings['align']:'center');
		// print_r($settings);
		// die;
		$inline_styles = '
		.elementor-element-'.$this->get_id().' .elementor-icon-wrapper{
			text-align:'.$settings['align'].';
		}
		.elementor-element-'.$this->get_id().' .elementor-icon{
			font-size: 50px;
			color:#818a91;
			padding: .5em;
			line-height:0;
			display: inline-block;
		    border-radius: 50%;
		}
		.elementor-element-'.$this->get_id().' .elementor-view-framed .elementor-icon{
		    color: #818a91;
		    border: 3px solid #818a91;
		}
		.elementor-element-'.$this->get_id().' .elementor-view-stacked .elementor-icon{
		    color: #fff;
    		background-color: #818a91;
		}
		';
        echo $inline_styles;
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-icon-wrapper elementor-view-'.$settings['view'] );

		$this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-icon' );

		if ( ! empty( $settings['hover_animation'] ) ) {
			$this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		$icon_tag = 'div';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'icon-wrapper', 'href', $settings['link']['url'] );
			$icon_tag = 'a';

			if ( ! empty( $settings['link']['is_external'] ) ) {
				$this->add_render_attribute( 'icon-wrapper', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'icon-wrapper', 'rel', 'nofollow' );
			}
		}

		if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<<?php echo $icon_tag . ' ' . $this->get_render_attribute_string( 'icon-wrapper' ); ?>>
				<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
			</<?php echo $icon_tag; ?>>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<# var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
				iconTag = link ? 'a' : 'div'; #>
		<div class="elementor-icon-wrapper">
			<{{{ iconTag }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}" {{{ link }}}>
				<i class="{{ settings.icon }}" aria-hidden="true"></i>
			</{{{ iconTag }}}>
		</div>
		<?php
	}
}
