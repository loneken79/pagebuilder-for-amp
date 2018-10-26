<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Html extends Widget_Base {

	public function get_name() {
		return 'html';
	}

	public function get_title() {
		return __( 'Amp HTML', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$inline_styles = '';
        echo $inline_styles;
	}
	
	protected function render() {
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		 echo $this->get_settings_for_display( 'html' );
	}

	protected function _content_template() {
		?>
		{{{ settings.html }}}
		<?php
	}
}
