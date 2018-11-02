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
		$inline_styles = '';
        echo $inline_styles;
	}

	protected function render() {
		//$settings = $this->get_settings_for_display();
		// print_r($settings);
		// die;
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
