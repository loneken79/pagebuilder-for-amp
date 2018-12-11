<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Menu_Anchor extends Widget_Base {

	public function get_name() {
		return 'menu-anchor';
	}

	public function get_title() {
		return __( 'Amp Menu Anchor', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$inline_styles = '';
        global $amp_elemetor_custom_css;
		$amp_elemetor_custom_css['amp-menu-anchor'][$this->get_id()] = $inline_styles;
	}
	
	protected function render() {
		$anchor = $this->get_settings_for_display( 'anchor' );
		$this->amp_elementor_widget_styles();
		if ( ! empty( $anchor ) ) {
			$this->add_render_attribute( 'inner', 'id', $anchor );
		}

		$this->add_render_attribute( 'inner', 'class', 'elementor-menu-anchor' );
		?>
		<div <?php echo $this->get_render_attribute_string( 'inner' ); ?>></div>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="elementor-menu-anchor"{{{ settings.anchor ? ' id="' + settings.anchor + '"' : '' }}}></div>
		<?php
	}
}
