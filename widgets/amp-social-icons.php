<?php
namespace ElementorForAmp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Amp_Social_Icons extends Widget_Base {

	public function get_name() {
		return 'social-icons';
	}

	public function get_title() {
		return __( 'Amp Social Icons', 'elementor-hello-world' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function amp_elementor_widget_styles(){
		$settings = $this->get_settings_for_display();
		// print_r($settings);//shape,icon_color,icon_primary_color,icon_secondary_color,icon_size,icon_padding,icon_spacing,
		// die;
		
		$settings['shape'] = (!empty($settings['shape']) ? $settings['shape']:'rounded');
		$settings['align'] = (!empty($settings['align']) ? $settings['align']:'center');

		
		$settings['icon_primary_color'] = (!empty($settings['icon_primary_color']) ? $settings['icon_primary_color']:'#818a91');
		$settings['icon_secondary_color'] = (!empty($settings['icon_secondary_color']) ? $settings['icon_secondary_color']:'#333');
		$settings['icon_size']['size'] = (!empty($settings['icon_size']['size']) ? $settings['icon_size']['size']:'25');
		$settings['icon_size']['unit'] = (!empty($settings['icon_size']['unit']) ? $settings['icon_size']['unit']:'px');
		$settings['icon_padding']['size'] = (!empty($settings['icon_padding']['size']) ? $settings['icon_padding']['size']:'10');
		$settings['icon_padding']['unit'] = (!empty($settings['icon_padding']['unit']) ? $settings['icon_padding']['unit']:'px');
		$settings['icon_spacing']['size'] = (!empty($settings['icon_spacing']['size']) ? $settings['icon_spacing']['size']:'5');
		$settings['icon_spacing']['unit'] = (!empty($settings['icon_spacing']['unit']) ? $settings['icon_spacing']['unit']:'px');
		if($settings['icon_color'] == 'custom'){
			$custom_icon_css = '
				.elementor-social-icons-wrapper a{
					background:'.$settings['icon_primary_color'].';
					color:'.$settings['icon_secondary_color'].';
				}
				.elementor-icon i {
					color:'.$settings['icon_secondary_color'].';
				}
			';
		}else{
			$custom_icon_css = '
				.elementor-social-icons-wrapper a{
					color:#fff;
				}
			';
		}

		$inline_styles = '
			.elementor-social-icons-wrapper{
				width:100%;
				text-align:'.$settings['align'].';
				font-size:0;
			}
			.elementor-social-icons-wrapper.elementor-shape-rounded a{
				border-radius:10%;
			}
			.elementor-social-icons-wrapper.elementor-shape-square a{
				border-radius:0px;
			}
			.elementor-social-icons-wrapper.elementor-shape-circle a{
				border-radius: 50%;
			}
			.elementor-social-icons-wrapper span{
				display:none;
			}
			.elementor-social-icons-wrapper a{
				font-size: '.$settings['icon_size']['size'].''.$settings['icon_size']['unit'].';
			    text-align: center;
			    padding: '.$settings['icon_padding']['size'].''.$settings['icon_padding']['unit'].';
			    margin-right: '.$settings['icon_spacing']['size'].''.$settings['icon_spacing']['unit'].';
			    cursor: pointer;
			    display: inline-block;
    			line-height: 1;
			}
			.elementor-social-icons-wrapper a:last-child {
			    margin: 0;
			}
			.elementor-icon i {
			    width: 1em;
			    height: 1em;
			    position: relative;
			    display: block;
			}
			.elementor-icon i:before {
			    position: absolute;
			    left: 50%;
			    transform: translateX(-50%); 
			}
		'.$custom_icon_css;
        echo $inline_styles;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		add_action('amp_post_template_css',array($this,'amp_elementor_widget_styles'));
		$class_animation = '';
		$settings['shape'] = (!empty($settings['shape']) ? $settings['shape']:'rounded');
		if ( ! empty( $settings['hover_animation'] ) ) {
			$class_animation = ' elementor-animation-' . $settings['hover_animation'];
		}

		?>
		<div class="elementor-social-icons-wrapper elementor-shape-<?php echo $settings['shape'];?>">
			<?php
			foreach ( $settings['social_icon_list'] as $index => $item ) {
				$social = str_replace( 'fa fa-', '', $item['social'] );

				$link_key = 'link_' . $index;
				if(empty($item['link']['url'])){
					$item['link']['url'] = '#';
				}
				$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

				if ( $item['link']['is_external'] ) {
					$this->add_render_attribute( $link_key, 'target', '_blank' );
				}

				if ( $item['link']['nofollow'] ) {
					$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
				}
				?>
				<a class="elementor-icon elementor-social-icon elementor-social-icon-<?php echo $social . $class_animation; ?>" <?php echo $this->get_render_attribute_string( $link_key ); ?>>
					<span class="elementor-screen-only"><?php echo ucwords( $social ); ?></span>
					<i class="<?php echo $item['social']; ?>"></i>
				</a>
			<?php } ?>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="elementor-social-icons-wrapper">
			<# _.each( settings.social_icon_list, function( item ) {
				var link = item.link ? item.link.url : '',
					social = item.social.replace( 'fa fa-', '' ); #>
				<a class="elementor-icon elementor-social-icon elementor-social-icon-{{ social }} elementor-animation-{{ settings.hover_animation }}" href="{{ link }}">
					<span class="elementor-screen-only">{{{ social }}}</span>
					<i class="{{ item.social }}"></i>
				</a>
			<# } ); #>
		</div>
		<?php
	}
}
