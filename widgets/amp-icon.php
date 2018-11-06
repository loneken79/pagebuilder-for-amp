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
		// print_r($settings);
		// die;
		$settings['icon'] = (!empty($settings['icon']) ? $settings['icon']:'fa fa-star');
		$settings['view'] = (!empty($settings['view']) ? $settings['view']:'default');
		$settings['shape'] = (!empty($settings['shape']) ? $settings['shape']:'cicle');

		$settings['primary_color'] = (!empty($settings['primary_color']) ? $settings['primary_color']:'#6ec1e4');
		$settings['secondary_color'] = (!empty($settings['secondary_color']) ? $settings['secondary_color']:'#fff');
		$settings['icon_space']['size'] = (!empty($settings['icon_space']['size']) ? $settings['icon_space']['size']:'15');
		$settings['icon_space']['unit'] = (!empty($settings['icon_space']['unit']) ? $settings['icon_space']['unit']:'px');
		$settings['size']['size'] = (!empty($settings['size']['size']) ? $settings['size']['size']:'50');
		$settings['size']['unit'] = (!empty($settings['size']['unit']) ? $settings['size']['unit']:'px');
		$settings['icon_padding']['size'] = (!empty($settings['icon_padding']['size']) ? $settings['icon_padding']['size']:'25');
		$settings['icon_padding']['unit'] = (!empty($settings['icon_padding']['unit']) ? $settings['icon_padding']['unit']:'px');
		$settings['align'] = (!empty($settings['align']) ? $settings['align']:'center');
		$inline_styles = '
		.elementor-element-'.$this->get_id().' .elementor-icon-wrapper{
			text-align:'.$settings['align'].';
		}
		.elementor-element-'.$this->get_id().' .elementor-icon{
			font-size: '.$settings['size']['size'].''.$settings['size']['unit'].';
			color:'.$settings['primary_color'].';
			padding: '.$settings['icon_padding']['size'].''.$settings['icon_padding']['unit'].';
			line-height:0;
			display: inline-block;
		    border-radius: 50%;
		}
		.elementor-element-'.$this->get_id().' .elementor-shape-square .elementor-icon{
			border-radius: 0;
		}
		.elementor-element-'.$this->get_id().' .elementor-view-framed .elementor-icon{
		    color: '.$settings['primary_color'].';
		    border: 3px solid '.$settings['primary_color'].';
		    background-color: '.$settings['secondary_color'].';
		}
		.elementor-element-'.$this->get_id().' .elementor-view-stacked .elementor-icon{
		    color: '.$settings['secondary_color'].';
	    	background-color: '.$settings['primary_color'].';
		}
		';
        global $amp_elemetor_custom_css;
		$amp_elemetor_custom_css['amp-icon'][$this->get_id()] = $inline_styles;
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$settings['icon'] = (!empty($settings['icon']) || isset($settings['icon']) ? $settings['icon']:'fa fa-star');
		$this->amp_elementor_widget_styles();//$settings['shape']
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-icon-wrapper elementor-view-'.$settings['view'] .' elementor-shape-'.$settings['shape'] );

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
