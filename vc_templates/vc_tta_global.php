<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $el_class
 * @var $el_id
 * @var $this WPBakeryShortCode_VC_Tta_Accordion|WPBakeryShortCode_VC_Tta_Tabs|WPBakeryShortCode_VC_Tta_Tour|WPBakeryShortCode_VC_Tta_Pageable
 */
global $amp_vc_elements_atts;

$el_class = $css = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$this->resetVariables( $atts, $content );
extract( $atts );
$shortcode_slug = $this->getShortcode();
$amp_vc_elements_atts[$shortcode_slug] = $atts;
$this->setGlobalTtaInfo();

$this->enqueueTtaStyles();
$this->enqueueTtaScript();

// It is required to be before tabs-list-top/left/bottom/right for tabs/tours
$prepareContent = $this->getTemplateVariable( 'content' );

$class_to_filter = $this->getTtaGeneralClasses();
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getCSSAnimation( $css_animation );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$accordion = '';

if( $shortcode_slug == 'vc_tta_accordion' ){
	$prepareContent = preg_replace("#<section\sclass=\"(.*?)vc_active(.*?)\"(.*?)>#", '<section class="$1 vc_active $2" $3 expanded">', $prepareContent, 1);

	$accordion .= '<amp-accordion class="vc_tta-panels" expand-single-section disable-session-states>';
	$accordion .= $prepareContent;
	$accordion .= '</amp-accordion>';
}

if( $shortcode_slug == 'vc_tta_tabs' ){
	$accordion .= '<amp-selector role="tablist" layout="container" class="ampTabContainer">';
	$content = $prepareContent;
	$tags = "section";
	$content = preg_replace('/<\/?' . $tags . '(.|\s)*?>/', '', $content);
	$accordion .= $content;
	$accordion = preg_replace('/(<h4\b[^><]*)>/i', '$1 role="tab" option="'.esc_attr($this->getTemplateVariable( 'tab_id' )).'">', $accordion);
	$accordion = preg_replace("#(<h4\s(.*?))>#", '$1 selected">', $accordion,1);
	$accordion = preg_replace('#class="vc_tta-panel-title"#', 'class="tabButton"', $accordion);
	$accordion .= '</amp-selector>';
}

$output = '<div ' . $this->getWrapperAttributes() . '>';
$output .= $this->getTemplateVariable( 'title' );
$output .= '<div class="' . esc_attr( $css_class ) . '">';
//$output .= $this->getTemplateVariable( 'tabs-list-top' );
$output .= $this->getTemplateVariable( 'tabs-list-left' );
$output .= '<div class="vc_tta-panels-container">';
$output .= $this->getTemplateVariable( 'pagination-top' );
$output .= $accordion;
$output .= $this->getTemplateVariable( 'pagination-bottom' );
$output .= '</div>';
$output .= $this->getTemplateVariable( 'tabs-list-bottom' );
$output .= $this->getTemplateVariable( 'tabs-list-right' );
$output .= '</div>';
$output .= '</div>';

echo $output;

