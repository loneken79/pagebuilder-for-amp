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
		/* if( $this->get_id() == 'tmbj0v5'){			print_r($settings);			die;		} */		$typography_font_size = '';		if( !empty($settings['typography_font_size']['size']) && !empty($settings['typography_font_size']['unit'])){			$typography_font_size = 'font-size:'.$settings['typography_font_size']['size'].''.$settings['typography_font_size']['unit'].';';		}		$typography_font_weight = '';		if( isset($settings['typography_font_weight'])){			$typography_font_weight = 'font-weight:'.$settings['typography_font_weight'].';';		}		$typography_letter_spacing = '';		if(!empty($settings['typography_letter_spacing']['size']) && !empty($settings['typography_letter_spacing']['unit']) ){			$typography_letter_spacing = 'letter-spacing:'.$settings['typography_letter_spacing']['size'].''.$settings['typography_letter_spacing']['unit'].';';		}		$button_text_color = '';		if( isset($settings['button_text_color'])){			$button_text_color = 'color:'.$settings['button_text_color'].';';		}		$background_color = '';		if( isset($settings['background_color'])){			$background_color = 'background-color:'.$settings['background_color'].';';		}
		$settings['icon'] = (!empty($settings['icon']) ? $settings['icon']:'');
		$settings['align'] = (!empty($settings['align']) ? $settings['align']:'left');
		$settings['button_type'] = (!empty($settings['button_type']) ? $settings['button_type']:'default');
		$settings['button_text_color'] = (!empty($settings['button_text_color']) ? $settings['button_text_color']:'#FFF');
		$settings['background_color'] = (!empty($settings['background_color']) ? $settings['background_color']:'');
		
		if( !empty($settings['background_color'])){
			$default_button_colors = '.elementor-element-'.$this->get_id().' .elementor-button-info a{
					   	 		background:'.$settings['background_color'].';
					   	 	}
					   	 	.elementor-element-'.$this->get_id().' .elementor-button-success a{
					   	 		background:'.$settings['background_color'].';
					   	 	}
					   	 	.elementor-element-'.$this->get_id().' .elementor-button-warning a{
					   	 		background:'.$settings['background_color'].';
					   	 	}
					   	 	.elementor-element-'.$this->get_id().' .elementor-button-danger a{
					   	 		background:'.$settings['background_color'].';
					   	 	}';
		}else{
			$default_button_colors = '.elementor-element-'.$this->get_id().' .elementor-button-info a{
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
				   	 	}';
		}
		
		$inline_styles = '
		.elementor-element-'.$this->get_id().' .elementor-type-justify a{
			width:100%;
			text-align:center
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
   	 	.elementor-element-'.$this->get_id().' .elementor-type-justify{padding:0;}
   	 	.elementor-element-'.$this->get_id().' .elementor-align-icon-left{
   	 		margin-right:'.$settings['icon_indent']['size'].''.$settings['icon_indent']['unit'].';
   	 	}
   	 	.elementor-element-'.$this->get_id().' .elementor-align-icon-right{
   	 		float:right;
   	 		margin-left:'.$settings['icon_indent']['size'].''.$settings['icon_indent']['unit'].';
   	 	}
		'.$default_button_colors;				$dynamicStyles = '.elementor-element-'.$this->get_id().' a.elementor-button, .elementor-element.elementor-element-'.$this->get_id().' .elementor-button{			'.$typography_font_size.''.$typography_font_weight.''.$typography_letter_spacing.''.$button_text_color.''.$background_color.'		}';
        global $amp_elemetor_custom_css;
		$amp_elemetor_custom_css['amp-button'][$this->get_id()] = $inline_styles.''.$dynamicStyles;
	}
	function amp_elementor_button_inline_styles(){
		$settings = $this->get_settings_for_display();
		// print_r($settings);
		// die;
		$typography_font_size = '';
		if( !empty($settings['typography_font_size']['unit']) && !empty($settings['typography_font_size']['size'])){
			$unit = $settings['typography_font_size']['unit'];
			$size = $settings['typography_font_size']['size'];
			$typography_font_size = 'font-size:'.$size.''.$unit.';';
		}
		$typography_font_weight = '';
		if(!empty($settings['typography_font_weight'])){
			$typography_font_weight = 'font-weight:'.$settings['typography_font_weight'].';';
		}
		$button_text_color = '';
		if( !empty($settings['button_text_color']) ){
			$button_text_color = 'color:'.$settings['button_text_color'].';';
		}
		$background_color = '';
		if( !empty($settings['background_color']) ){
			$background_color = 'background-color:'.$settings['background_color'].';';
		}
		$border_radius = '';
		$allBorders = '';
		if( !empty($settings['border_radius']) ){
			$radius = $settings['border_radius'];
			
			foreach ($radius as $key => $value) {

				if( $key=='top' || $key == 'right' || $key == 'bottom' || $key == 'left' ){
					//echo $radius[$key];

					//if(!empty($radius[$key])){
						$allBorders .= $radius[$key].''.$radius['unit'].' ';	
					//}
				}
			}
			
			$border_radius = 'border-radius:'.$allBorders.';';
		}
		$button_text_color = '';
		if( !empty($settings['button_text_color']) ){
			$button_text_color = 'color:'.$settings['button_text_color'].';';
		}
		$icon_align = '';
		$icon_styles = '';
		if( !empty($settings['icon_align']) ){
			$icon_align = 'float:'.$settings['icon_align'].';';
			$icon_styles = '.elementor-element-'.$this->get_id().' .elementor-align-icon-'.$icon_align.'{
				'.$icon_align.'
			}';
		}	
		$icon_indent = '';
		$typography_text_transform = '';
		if( !empty($settings['typography_text_transform']) ){
			$typography_text_transform = 'text-transform:'.$settings['typography_text_transform'].';';
		}
		$typography_letter_spacing = '';
		if(!empty($settings['typography_letter_spacing']['unit']) && !empty($settings['typography_letter_spacing']['size'])){
			$unit = $settings['typography_letter_spacing']['unit'];
			$size = $settings['typography_letter_spacing']['size'];
			$typography_letter_spacing = 'letter-spacing:'.$size.''.$unit.';';
		}
		$dynamicStyles .= '.elementor-'.get_the_ID().' .elementor-element-'.$this->get_id().' a.elementor-button, .elementor-'.get_the_ID().' .elementor-element-'.$this->get_id().' .elementor-button{
			'.$typography_font_size.''.$typography_font_weight.''.$button_text_color.'display:inline-block;'.$typography_text_transform.''.$typography_letter_spacing.''.$border_radius.''.$background_color.'
		}';
		//.elementor-680 .elementor-element.elementor-element-e6nrtsj .elementor-button .elementor-align-icon-right
		echo $dynamicStyles;
		echo $icon_styles;
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		add_action('amp_post_template_css',array($this,'amp_elementor_button_inline_styles'));
		$settings['hover_animation'] = (!empty($settings['hover_animation']) ? $settings['hover_animation']:0);
		$settings['size'] = (!empty($settings['size']) ? $settings['size']:'sm');
		$settings['align'] = (!empty($settings['align']) ? $settings['align']:'left');
		$settings['link']['url'] = (!empty($settings['link']['url'] ) ? $settings['link']['url'] :'#');
		$settings['button_type'] = (!empty($settings['button_type']) ? $settings['button_type']:'default');
		$this->amp_elementor_widget_styles();
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper elementor-button-'.$settings['button_type'].' elementor-type-'.$settings['align'].' elementor-size-'.$settings['size'] );

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
