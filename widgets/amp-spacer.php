<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Spacer extends Widget_Base {

	public function get_name() {
		return 'spacer';
	}
	
	public function get_title() {
		return __( 'Amp Spacer', 'elementor-hello-world' );
	}
	
	public function get_icon() {
		return 'eicon-spacer';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$settings = $this->get_settings_for_display();
		$inline_styles = '
		.elementor-element-'.$this->get_id().' .elementor-spacer-inner{
			height:'.$settings['space']['size'].''.$settings['space']['unit'].';
		}
		';
        echo $inline_styles;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		?>
		<div class="elementor-spacer">
			<div class="elementor-spacer-inner"></div>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="elementor-spacer">
			<div class="elementor-spacer-inner spacer"></div>
		</div>
		<?php
	}
}
