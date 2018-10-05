<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Section
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
WPBakeryShortCode_VC_Tta_Section::$self_count ++;
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
$isPageEditable = vc_is_page_editable();
$classes = esc_attr( $this->getElementClasses() );

$output .= '<section class="' . esc_attr( $this->getElementClasses() ) . '"';
$output .= ' id="' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '"';
$output .= ' data-vc-content=".vc_tta-panel-body">';
//$output .= '<div class="vc_tta-panel-heading">';
//$output .= $this->getTemplateVariable( 'heading' );
$head = $this->getTemplateVariable( 'heading' );
$output .= strip_tags($head,"<h4><span><i>");

//$output .= '</div>';
$output .= '<div role="tabpanel" class="tabContent vc_tta-panel-body">';
if ( $isPageEditable ) {
	$output .= '<div data-js-panel-body>'; // fix for fe - shortcodes container, not required in b.e.
}
$output .= $this->getTemplateVariable( 'content' );
if ( $isPageEditable ) {
	$output .= '</div>';
}
$output .= '</div>';
$output .= '</section>';

echo $output;
