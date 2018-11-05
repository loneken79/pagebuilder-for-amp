<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Icon_Box extends Widget_Base {

	public function get_name() {
		return 'icon-box';
	}

	public function get_title() {
		return __( 'Amp Icon Box', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$settings = $this->get_settings_for_display();
		
		$settings['icon'] = (!empty($settings['icon']) ? $settings['icon']:'fa fa-star');
		$settings['view'] = (!empty($settings['view']) ? $settings['view']:'default');
		$settings['shape'] = (!empty($settings['shape']) ? $settings['shape']:'cicle');
		$settings['primary_color'] = (!empty($settings['primary_color']) ? $settings['primary_color']:'#6ec1e4');
		$settings['secondary_color'] = (!empty($settings['secondary_color']) ? $settings['secondary_color']:'#fff');
		$settings['icon_space']['size'] = (!empty($settings['icon_space']['size']) ? $settings['icon_space']['size']:'15');
		$settings['icon_space']['unit'] = (!empty($settings['icon_space']['unit']) ? $settings['icon_space']['unit']:'px');
		$settings['icon_size']['size'] = (!empty($settings['icon_size']['size']) ? $settings['icon_size']['size']:'50');
		$settings['icon_size']['unit'] = (!empty($settings['icon_size']['unit']) ? $settings['icon_size']['unit']:'px');
		$settings['icon_padding']['size'] = (!empty($settings['icon_padding']['size']) ? $settings['icon_padding']['size']:'25');
		$settings['icon_padding']['unit'] = (!empty($settings['icon_padding']['unit']) ? $settings['icon_padding']['unit']:'px');

		$settings['title_bottom_space']['size'] = (!empty($settings['title_bottom_space']['size']) ? $settings['title_bottom_space']['size']:'0');
		$settings['title_bottom_space']['unit'] = (!empty($settings['title_bottom_space']['unit']) ? $settings['title_bottom_space']['unit']:'px');
		$settings['title_color'] = (!empty($settings['title_color']) ? $settings['title_color']:'#333');
		$settings['description_color'] = (!empty($settings['description_color']) ? $settings['description_color']:'#555');
		$settings['align'] = (!empty($settings['align']) ? $settings['align']:'center');
		$inline_styles = '
			.elementor-element-'.$this->get_id().' .elementor-icon-box-wrapper{
				text-align:'.$settings['align'].';
			}
			.elementor-element-'.$this->get_id().' .elementor-icon-box-icon{
				font-size: '.$settings['icon_size']['size'].''.$settings['icon_size']['unit'].';
				color:'.$settings['primary_color'].';
				padding: '.$settings['icon_padding']['size'].''.$settings['icon_padding']['unit'].';
				line-height:0;
				display: inline-block;
			    border-radius: 50%;
			    margin-bottom:'.$settings['icon_space']['size'].''.$settings['icon_space']['unit'].';
			}
			.elementor-element-'.$this->get_id().' .elementor-shape-square .elementor-icon-box-icon{
				border-radius: 0;
			}
			.elementor-element-'.$this->get_id().' .elementor-view-framed .elementor-icon-box-icon{
			    color: '.$settings['primary_color'].';
			    border: 3px solid '.$settings['primary_color'].';
			}
			.elementor-element-'.$this->get_id().' .elementor-view-stacked .elementor-icon-box-icon{
			    color: '.$settings['secondary_color'].';
	    		background-color: '.$settings['primary_color'].';
			}
			.elementor-icon-box-title{
				font-size:18px;
				font-weight:600;
				color:'.$settings['title_color'].';
				margin-bottom:'.$settings['title_bottom_space']['size'].''.$settings['title_bottom_space']['unit'].';
			}
			.elementor-icon-box-description{
				font-size:17px;
				color:'.$settings['description_color'].';
				font-weight:500;
			}
		';
        echo $inline_styles;
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$settings['icon'] = (!empty($settings['icon'] || isset($settings['icon'])) ? $settings['icon']:'fa fa-star');
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		$this->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['hover_animation'] ] );
		
		$settings['title_size'] = (!empty($settings['title_size'] || isset($settings['title_size'])) ? $settings['title_size']:'h3');
		$icon_tag = 'span';
		$has_icon = ! empty( $settings['icon'] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
			$icon_tag = 'a';

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );

		$this->add_render_attribute( 'description_text', 'class', 'elementor-icon-box-description' );

		$this->add_inline_editing_attributes( 'title_text', 'none' );
		$this->add_inline_editing_attributes( 'description_text' );
		?>
		<div class="elementor-icon-box-wrapper elementor-view-<?php echo $settings['view'];?> elementor-shape-<?php echo $settings['shape'];?>">
		<?php if ( $has_icon ) : ?>
			<div class="elementor-icon-box-icon">
				<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
				<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
				</<?php echo $icon_tag; ?>>
			</div>
			<?php endif; ?>
			<div class="elementor-icon-box-content">
				<<?php echo $settings['title_size']; ?> class="elementor-icon-box-title">
					<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php echo $this->get_render_attribute_string( 'title_text' ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
				</<?php echo $settings['title_size']; ?>>
				<p <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo $settings['description_text']; ?></p>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<#
		var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
			iconTag = link ? 'a' : 'span';

		view.addRenderAttribute( 'description_text', 'class', 'elementor-icon-box-description' );

		view.addInlineEditingAttributes( 'title_text', 'none' );
		view.addInlineEditingAttributes( 'description_text' );
		#>
		<div class="elementor-icon-box-wrapper">
			<# if ( settings.icon ) { #>
			<div class="elementor-icon-box-icon">
				<{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
				<i class="{{ settings.icon }}" aria-hidden="true"></i>
			</{{{ iconTag }}}>
		</div>
			<# } #>
			<div class="elementor-icon-box-content">
				<{{{ settings.title_size }}} class="elementor-icon-box-title">
					<{{{ iconTag + ' ' + link }}} {{{ view.getRenderAttributeString( 'title_text' ) }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
				</{{{ settings.title_size }}}>
				<p {{{ view.getRenderAttributeString( 'description_text' ) }}}>{{{ settings.description_text }}}</p>
			</div>
		</div>
		<?php
	}
}
