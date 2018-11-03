<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Toggle extends Widget_Base {

	public function get_name() {
		return 'toggle';
	}

	public function get_title() {
		return __( 'Amp Toggle', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$settings = $this->get_settings_for_display();
		// print_r($settings);//icon,icon_active,title_html_tag,border_width,border_color,space_between,title_background,title_color,tab_active_color,icon_align,icon_color,icon_active_color,icon_space,content_background_color,content_color,
		// die;
		$settings['border_color'] = (!empty($settings['border_color']) ? $settings['border_color']:'#333');
		$settings['title_background'] = (!empty($settings['title_background']) ? $settings['title_background']:'#333');
		$settings['title_color'] = (!empty($settings['title_color']) ? $settings['title_color']:'#333');
		$settings['tab_active_color'] = (!empty($settings['tab_active_color']) ? $settings['tab_active_color']:'#333');
		$settings['icon_align'] = (!empty($settings['icon_align']) ? $settings['icon_align']:'left');
		$settings['icon_color'] = (!empty($settings['icon_color']) ? $settings['icon_color']:'#333');
		$settings['icon_space'] = (!empty($settings['icon_space']) ? $settings['icon_space']:'#333');
		$settings['content_background_color'] = (!empty($settings['content_background_color']) ? $settings['content_background_color']:'#333');
		$settings['content_color'] = (!empty($settings['content_color']) ? $settings['content_color']:'#333');

		$settings['border_width']['size'] = (!empty($settings['border_width']['size']) ? $settings['border_width']['size']:'15');
		$settings['border_width']['unit'] = (!empty($settings['border_width']['unit']) ? $settings['border_width']['unit']:'px');
		$settings['space_between']['size'] = (!empty($settings['space_between']['size']) ? $settings['border_width']['size']:'15');
		$settings['space_between']['unit'] = (!empty($settings['space_between']['unit']) ? $settings['border_width']['unit']:'px');

		$inline_styles = '';
        echo $inline_styles;
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		$id_int = substr( $this->get_id_int(), 0, 3 );
		?>
		<amp-accordion class="elementor-toggle" role="tablist">
			<?php
			foreach ( $settings['tabs'] as $index => $item ) :
				$tab_count = $index + 1;

				$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

				$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

				$this->add_render_attribute( $tab_title_setting_key, [
					'id' => 'elementor-tab-title-' . $id_int . $tab_count,
					'class' => [ 'elementor-tab-title' ],
					'tabindex' => $id_int . $tab_count,
					'data-tab' => $tab_count,
					'role' => 'tab',
					'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
				] );

				$this->add_render_attribute( $tab_content_setting_key, [
					'id' => 'elementor-tab-content-' . $id_int . $tab_count,
					'class' => [ 'elementor-tab-content', 'elementor-clearfix' ],
					'data-tab' => $tab_count,
					'role' => 'tabpanel',
					'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
				] );

				$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
				$string = $this->parse_text_editor( $item['tab_content'] );
				if($string != strip_tags($string)) {
					$tab_content = $this->parse_text_editor( $item['tab_content'] );
				}else{
					$tab_content = '<p>'.$this->parse_text_editor( $item['tab_content'] ).'</p>';
				}
				?>
				
				<section>
			      	<h4><?php echo $item['tab_title']; ?></h4>
			      	<?php echo $tab_content; ?>
			    </section>
				
			<?php endforeach; ?>
		</amp-accordion>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="elementor-toggle" role="tablist">
			<#
			if ( settings.tabs ) {
				var tabindex = view.getIDInt().toString().substr( 0, 3 );

				_.each( settings.tabs, function( item, index ) {
					var tabCount = index + 1,
						tabTitleKey = view.getRepeaterSettingKey( 'tab_title', 'tabs', index ),
						tabContentKey = view.getRepeaterSettingKey( 'tab_content', 'tabs', index );

					view.addRenderAttribute( tabTitleKey, {
						'id': 'elementor-tab-title-' + tabindex + tabCount,
						'class': [ 'elementor-tab-title' ],
						'tabindex': tabindex + tabCount,
						'data-tab': tabCount,
						'role': 'tab',
						'aria-controls': 'elementor-tab-content-' + tabindex + tabCount
					} );

					view.addRenderAttribute( tabContentKey, {
						'id': 'elementor-tab-content-' + tabindex + tabCount,
						'class': [ 'elementor-tab-content', 'elementor-clearfix' ],
						'data-tab': tabCount,
						'role': 'tabpanel',
						'aria-labelledby': 'elementor-tab-title-' + tabindex + tabCount
					} );

					view.addInlineEditingAttributes( tabContentKey, 'advanced' );
					#>
					<div class="elementor-toggle-item">
						<{{{ settings.title_html_tag }}} {{{ view.getRenderAttributeString( tabTitleKey ) }}}>
							<# if ( settings.icon ) { #>
							<span class="elementor-toggle-icon elementor-toggle-icon-{{ settings.icon_align }}" aria-hidden="true">
								<i class="elementor-toggle-icon-closed {{ settings.icon }}"></i>
								<i class="elementor-toggle-icon-opened {{ settings.icon_active }}"></i>
							</span>
							<# } #>
							{{{ item.tab_title }}}
						</{{{ settings.title_html_tag }}}>
						<div {{{ view.getRenderAttributeString( tabContentKey ) }}}>{{{ item.tab_content }}}</div>
					</div>
					<#
				} );
			} #>
		</div>
		<?php
	}
}
