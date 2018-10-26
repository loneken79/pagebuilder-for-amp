<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Amp_Alert extends Widget_Base {
	
	public function get_name() {
		return 'alert';
	}

	public function get_title() {
		return __( 'Amp Alert', 'elementor-hello-world' );
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
		$settings = $this->get_settings_for_display();
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		if ( empty( $settings['alert_title'] ) ) {
			return;
		}

		if ( ! empty( $settings['alert_type'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-alert elementor-alert-' . $settings['alert_type'] );
		}

		$this->add_render_attribute( 'wrapper', 'role', 'alert' );

		$this->add_render_attribute( 'alert_title', 'class', 'elementor-alert-title' );

		$this->add_inline_editing_attributes( 'alert_title', 'none' );
		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<span <?php echo $this->get_render_attribute_string( 'alert_title' ); ?>><?php echo $settings['alert_title']; ?></span>
			<?php
			if ( ! empty( $settings['alert_description'] ) ) :
				$this->add_render_attribute( 'alert_description', 'class', 'elementor-alert-description' );

				$this->add_inline_editing_attributes( 'alert_description' );
				?>
				<span <?php echo $this->get_render_attribute_string( 'alert_description' ); ?>><?php echo $settings['alert_description']; ?></span>
			<?php endif; ?>
			<?php if ( 'show' === $settings['show_dismiss'] ) : ?>
				<button type="button" class="elementor-alert-dismiss">
					<span aria-hidden="true">&times;</span>
					<span class="elementor-screen-only"><?php echo __( 'Dismiss alert', 'elementor' ); ?></span>
				</button>
			<?php endif; ?>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<# if ( settings.alert_title ) {
			view.addRenderAttribute( {
				alert_title: { class: 'elementor-alert-title' },
				alert_description: { class: 'elementor-alert-description' }
			} );

			view.addInlineEditingAttributes( 'alert_title', 'none' );
			view.addInlineEditingAttributes( 'alert_description' );
			#>
			<div class="elementor-alert elementor-alert-{{ settings.alert_type }}" role="alert">
				<span {{{ view.getRenderAttributeString( 'alert_title' ) }}}>{{{ settings.alert_title }}}</span>
				<span {{{ view.getRenderAttributeString( 'alert_description' ) }}}>{{{ settings.alert_description }}}</span>
				<# if ( 'show' === settings.show_dismiss ) { #>
					<button type="button" class="elementor-alert-dismiss">
						<span aria-hidden="true">&times;</span>
						<span class="elementor-screen-only"><?php echo __( 'Dismiss alert', 'elementor' ); ?></span>
					</button>
				<# } #>
			</div>
		<# } #>
		<?php
	}
}
