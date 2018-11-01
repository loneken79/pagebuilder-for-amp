<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Button extends Widget_Base {

	
	public function get_name() {
		return 'button';
	}

	
	public function get_title() {
		return __( 'Amp Button', 'elementor-hello-world' );
	}

	
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	
	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$inline_styles = '
		.elementor-widget-wrap{
			margin:10px;
		}
		.elementor-button-wrapper{
			/*text-align:center;*/
		}
		.elementor-button-wrapper a{
			color:#fff;
			border-radius: 5px;
			display:inline-block;
			background-color: #818a91;
			/*width:100%;*/
		}
		.elementor-size-xs{
			font-size:14px;
			padding:7px 20px;
		}
		.elementor-size-sm{
			font-size: 15px;
    		padding: 12px 24px;
		}
		.elementor-size-md {
    		font-size: 16px;
    		padding: 15px 30px;
    	}
    	.elementor-size-lg {
    		font-size: 18px;
    		padding: 28px 40px;
    	}
    	.elementor-size-xl {
    		font-size: 20px;
   	 		padding: 20px 50px;
   	 	}
   	 	.elementor-button-info .elementor-button-wrapper a{
   	 		background-color: #5bc0de;
   	 	}
   	 	.elementor-button-success .elementor-button-wrapper a{
   	 		background-color: #5cb85c;
   	 	}
   	 	.elementor-button-danger .elementor-button-wrapper a{
   	 		background-color: #f0ad4e;
   	 	}
   	 	.elementor-button-success .elementor-button-wrapper a{
   	 		background-color: #d9534f;
   	 	}

			.el-button-wrapper a{
				background-color: #818a91;
			    color: #fff;
			    padding: 7px 20px;
			    font-size: 17px;
			    border-radius: 3px;
			}
		';
        echo $inline_styles;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings['link']['url'] );
			$this->add_render_attribute( 'button', 'class', 'elementor-button-link' );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'button', 'class', 'elementor-button' );
		$this->add_render_attribute( 'button', 'role', 'button' );

		if ( ! empty( $settings['button_css_id'] ) ) {
			$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
		}

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
		}

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<?php $this->render_text(); ?>
			</a>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'text', 'class', 'elementor-button-text' );

		view.addInlineEditingAttributes( 'text', 'none' );
		#>
		<div class="elementor-button-wrapper">
			<a id="{{ settings.button_css_id }}" class="elementor-button elementor-size-{{ settings.size }} elementor-animation-{{ settings.hover_animation }}" href="{{ settings.link.url }}" role="button">
				<span class="elementor-button-content-wrapper">
					<# if ( settings.icon ) { #>
					<span class="elementor-button-icon elementor-align-icon-{{ settings.icon_align }}">
						<i class="{{ settings.icon }}" aria-hidden="true"></i>
					</span>
					<# } #>
					<span {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ settings.text }}}</span>
				</span>
			</a>
		</div>
		<?php
	}

	protected function render_text() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'elementor-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'elementor-button-icon',
					'elementor-align-icon-' . $settings['icon_align'],
				],
			],
			'text' => [
				'class' => 'elementor-button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['icon'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
			</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['text']; ?></span>
		</span>
		<?php
	}
}
