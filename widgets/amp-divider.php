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
		$inline_styles = '
			
		';
        echo $inline_styles;
	}

	protected function render() {
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
