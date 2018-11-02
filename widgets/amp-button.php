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
		$settings = $this->get_settings_for_display();
		// print_r($settings);
		// die;
		$settings['align'] = (!empty($settings['align']) ? $settings['align']:'left');
		$inline_styles = '
		.elementor-widget-wrap{
			margin:10px;
		}
		.elementor-element-'.$this->get_id().' .elementor-button-wrapper{
			text-align:'.$settings['align'].';
		}
		.elementor-element-'.$this->get_id().' .elementor-button-wrapper a{
			color:#fff;
			border-radius: 5px;
			display:inline-block;
		}
		.elementor-element-'.$this->get_id().' .align-justify a{
			width:100%;
			display:inline-block;
		}
		.elementor-element-'.$this->get_id().' .elementor-size-xs{
			font-size:14px;
			padding:7px 20px;
		}
		.elementor-element-'.$this->get_id().' .elementor-size-sm{
			font-size: 15px;
    		padding: 10px 24px;
		}
		.elementor-element-'.$this->get_id().' .elementor-size-md {
    		font-size: 16px;
    		padding: 12px 30px;
    	}
    	.elementor-element-'.$this->get_id().' .elementor-size-lg {
    		font-size: 18px;
    		padding: 16px 40px;
    	}
    	.elementor-element-'.$this->get_id().' .elementor-size-xl {
    		font-size: 20px;
   	 		padding: 18px 50px;
   	 	}
   	 	.elementor-element-'.$this->get_id().' .elementor-button-info a{
   	 		background-color: #5bc0de;
   	 	}
   	 	.elementor-element-'.$this->get_id().' .elementor-button-success a{
   	 		background-color: #5cb85c;
   	 	}
   	 	.elementor-element-'.$this->get_id().' .elementor-button-warning a{
   	 		background-color: #f0ad4e;
   	 	}
   	 	.elementor-element-'.$this->get_id().' .elementor-button-danger a{
   	 		background-color: #d9534f;
   	 	}
   	 	.elementor-element-'.$this->get_id().' .elementor-align-icon-left{
   	 		margin-right:'.$settings['icon_indent']['size'].''.$settings['icon_indent']['unit'].';
   	 	}
   	 	.elementor-element-'.$this->get_id().' .elementor-align-icon-right{
   	 		float:right;
   	 		margin-left:'.$settings['icon_indent']['size'].''.$settings['icon_indent']['unit'].';
   	 	}	
		';
        echo $inline_styles;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper elementor-button-'.$settings['button_type'] );

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
		if(! empty( $settings['button_type'] )){
			$settings['size'] = (!empty($settings['size']) ? $settings['size']:'sm');
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
		$settings['icon_align'] = (!empty($settings['icon_align']) ? $settings['icon_align']:'left');
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
