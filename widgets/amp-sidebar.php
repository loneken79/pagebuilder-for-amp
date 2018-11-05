<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Sidebar extends Widget_Base {

	public function get_name() {
		return 'sidebar';
	}

	public function get_title() {
		return __( 'Amp Sidebar', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$inline_styles = '
			.elementor-element-'.$this->get_id().' .elementor-widget-sidebar .amp-sidebar ul li a:hover{
				box-shadow: none;
			}
		';
        echo $inline_styles;
	}

	protected function render() {
		$sidebar = $this->get_settings_for_display( 'sidebar' );
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		if ( empty( $sidebar ) ) {
			return;
		}

		dynamic_sidebar( $sidebar );
	}

	protected function _content_template() {}

	public function render_plain_content() {}
}
