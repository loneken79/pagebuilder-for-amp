<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Icon_List extends Widget_Base {

	public function get_name() {
		return 'icon-list';
	}

	public function get_title() {
		return __( 'Amp Icon List', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$settings = $this->get_settings_for_display();
		
		$settings['icon_align'] = (!empty($settings['icon_align']) ? $settings['icon_align']:'left');
		$settings['icon_color'] = (!empty($settings['icon_color']) ? $settings['icon_color']:'#6ec1e4');
		$settings['text_color'] = (!empty($settings['text_color']) ? $settings['text_color']:'#ffffff');
		
		$settings['icon_size']['size'] = (!empty($settings['icon_size']['size']) ? $settings['icon_size']['size']:'14');
		$settings['icon_size']['unit'] = (!empty($settings['icon_size']['unit']) ? $settings['icon_size']['unit']:'px');
		$settings['space_between']['size'] = (!empty($settings['space_between']['size']) ? $settings['space_between']['size']:'30');
		$settings['space_between']['unit'] = (!empty($settings['space_between']['unit']) ? $settings['space_between']['unit']:'px');
		$settings['text_indent']['size'] = (!empty($settings['text_indent']['size']) ? $settings['text_indent']['size']:'5');
		$settings['text_indent']['unit'] = (!empty($settings['text_indent']['unit']) ? $settings['text_indent']['unit']:'px');
		$inline_styles = '
			.elementor-element-'.$this->get_id().' .elementor-icon-list-items{
				text-align:'.$settings['icon_align'].';
			}
			.elementor-element-'.$this->get_id().' .elementor-icon-list-items li{
				list-style:none;
				font-size:18px;
				color:'.$settings['text_color'].';
				padding-bottom:calc('.$settings['space_between']['size'].''.$settings['space_between']['unit'].'/2);
				margin-right: calc('.$settings['space_between']['size'].''.$settings['space_between']['unit'].'/2);
				margin-left: calc('.$settings['space_between']['size'].''.$settings['space_between']['unit'].'/2);
				padding: 0;
    			display: inherit;
			}
			.elementor-element-'.$this->get_id().' .elementor-inline-items li{
				    display: inline-flex;
    				align-items: center;
			}
			.elementor-element-'.$this->get_id().' .elementor-icon-list-icon{
				font-size:'.$settings['icon_size']['size'].''.$settings['icon_size']['unit'].';
				color:'.$settings['icon_color'].';
				line-height:0;
				display: inline-block;
    			vertical-align: middle;
			}
			.elementor-element-'.$this->get_id().' .elementor-icon-list-text{
				padding-left:'.$settings['text_indent']['size'].''.$settings['text_indent']['unit'].';
			}
		';
        global $amp_elemetor_custom_css;
		$amp_elemetor_custom_css['amp-icon-list'][$this->get_id()] = $inline_styles;
	}
	public function amp_elementor_icon_list_inline_styles(){
		//.elementor-680 .elementor-element.elementor-element-572b607 .elementor-icon-list-text
		$settings = $this->get_settings_for_display();
		// print_r($settings);
		// die;
		$dynamicStyles = '';
		echo $dynamicStyles;
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		add_action('amp_post_template_css',array($this,'amp_elementor_icon_list_inline_styles'));
		$this->amp_elementor_widget_styles();
		if( $settings['view'] == 'inline'){
			$this->add_render_attribute( 'icon_list', 'class', 'elementor-icon-list-items elementor-inline-items' );
		}else{
			$this->add_render_attribute( 'icon_list', 'class', 'elementor-icon-list-items' );
		}
		
		$this->add_render_attribute( 'list_item', 'class', 'elementor-icon-list-item' );

		if ( 'inline' === $settings['view'] ) {
			$this->add_render_attribute( 'icon_list', 'class', 'elementor-inline-items' );
			$this->add_render_attribute( 'list_item', 'class', 'elementor-inline-item' );
		}
		?>
		<ul <?php echo $this->get_render_attribute_string( 'icon_list' ); ?>>
			<?php
			foreach ( $settings['icon_list'] as $index => $item ) :
				$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );

				$this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-icon-list-text' );

				$this->add_inline_editing_attributes( $repeater_setting_key );
				?>
				<li class="elementor-icon-list-item" >
					<?php
					if ( ! empty( $item['link']['url'] ) ) {
						$link_key = 'link_' . $index;

						$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

						if ( $item['link']['is_external'] ) {
							$this->add_render_attribute( $link_key, 'target', '_blank' );
						}

						if ( $item['link']['nofollow'] ) {
							$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
						}

						echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
					}

					if ( ! empty( $item['icon'] ) ) :
						?>
						<span class="elementor-icon-list-icon">
							<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
						</span>
					<?php endif; ?>
					<span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>><?php echo $item['text']; ?></span>
					<?php if ( ! empty( $item['link']['url'] ) ) : ?>
						</a>
					<?php endif; ?>
				</li>
				<?php
			endforeach;
			?>
		</ul>
		<?php
	}

	protected function _content_template() {
		?>
		<#
			view.addRenderAttribute( 'icon_list', 'class', 'elementor-icon-list-items' );
			view.addRenderAttribute( 'list_item', 'class', 'elementor-icon-list-item' );

			if ( 'inline' == settings.view ) {
				view.addRenderAttribute( 'icon_list', 'class', 'elementor-inline-items' );
				view.addRenderAttribute( 'list_item', 'class', 'elementor-inline-item' );
			}
		#>
		<# if ( settings.icon_list ) { #>
			<ul {{{ view.getRenderAttributeString( 'icon_list' ) }}}>
			<# _.each( settings.icon_list, function( item, index ) {

					var iconTextKey = view.getRepeaterSettingKey( 'text', 'icon_list', index );

					view.addRenderAttribute( iconTextKey, 'class', 'elementor-icon-list-text' );

					view.addInlineEditingAttributes( iconTextKey ); #>

					<li {{{ view.getRenderAttributeString( 'list_item' ) }}}>
						<# if ( item.link && item.link.url ) { #>
							<a href="{{ item.link.url }}">
						<# } #>
						<# if ( item.icon ) { #>
						<span class="elementor-icon-list-icon">
							<i class="{{ item.icon }}" aria-hidden="true"></i>
						</span>
						<# } #>
						<span {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{{ item.text }}}</span>
						<# if ( item.link && item.link.url ) { #>
							</a>
						<# } #>
					</li>
				<#
				} ); #>
			</ul>
		<#	} #>

		<?php
	}
}
