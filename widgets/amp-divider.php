<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_divider extends Widget_Base {

	public function get_name() {
		return 'divider';
	}
	
	public function get_title() {
		return __( 'Amp Divider', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-divider';
	}
	
	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$settings = $this->get_settings_for_display();
		$settings['align'] = (!empty($settings['align']) ? $settings['align']:'left');
		$settings['style'] = (!empty($settings['style']) ? $settings['style']:'solid');
		// print_r($settings);
		// die;
		$inline_styles = '
			.elementor-element-'.$this->get_id().' .elementor-divider{
				text-align:'.$settings['align'].';
				padding:'.$settings['gap']['size'].''.$settings['gap']['unit'].' 0;
				line-height: 0;
			}
			.elementor-element-'.$this->get_id().' .elementor-divider-separator{
				border-top-style: '.$settings['style'].';
			    border-top-width: '.$settings['weight']['size'].''.$settings['weight']['unit'].';
			    width: '.$settings['width']['size'].''.$settings['width']['unit'].';
			    display: inline-block;
			    color:'.$settings['color'].';
			}
		';
        echo $inline_styles;
	}

	protected function render() {
		// $settings = $this->get_settings_for_display();
		// print_r($settings);
		// die;
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		?>
		<div class="elementor-divider">
			<span class="elementor-divider-separator"></span>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="elementor-divider">
			<span class="elementor-divider-separator"></span>
		</div>
		<?php
	}
}
