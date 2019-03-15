<?php
if ( ! defined( 'ABSPATH' ) ) exit;
add_filter('ampforwp_the_content_last_filter','ampforwp_purify_amphtmls');
/* add_action('pre_amp_render_post', 'ampforwp_ob_start');
function ampforwp_ob_start(){
	ob_start('ampforwp_purify_amphtmls');
	
} */ 
function ampforwp_purify_amphtmls($completeContent){
	if ( file_exists( AMP_WPBAKERY_PLUGIN_DIR . '/parser/autoload.php' ) ) {
		require_once AMP_WPBAKERY_PLUGIN_DIR . '/parser/autoload.php';
	}
	global $post;
	$postID = $post->ID;
	if (function_exists('ampforwp_is_front_page') && ampforwp_is_front_page() ) {
		$postID = ampforwp_get_frontpage_id();
	}
	//require_once AMP_WPBAKERY_PLUGIN_DIR."/parser/autoload.php";
	require_once AMP_WPBAKERY_PLUGIN_DIR."/parser/class-amp-rule-spec.php";
	require_once AMP_WPBAKERY_PLUGIN_DIR."/parser/class-amp-dom-utils.php";
	require_once AMP_WPBAKERY_PLUGIN_DIR."/parser/class-amp-allowed-tags-generated.php";
	require_once AMP_WPBAKERY_PLUGIN_DIR."/parser/AMP_Base_Sanitizer.php";
	require_once AMP_WPBAKERY_PLUGIN_DIR."/parser/class-amp-style-sanitizer.php";
	/***Replacements***/
	$completeContent = preg_replace("/wpb_animate_when_almost_visible/", "", $completeContent);
	$completeContent = str_replace(array("<amp-img ", 'sizes="(min-width: 1000px) 1000px, 100vw"'), array('<amp-img layout="responsive"', 'sizes="(min-width: 1000px) 100vw, 100vw"'), $completeContent);

	$update_class = '';
	$vc_enabled = get_post_meta($postID, '_wpb_vc_js_status');
	if($vc_enabled){
		$completeContent = str_replace('class="cntr"', "class='".$update_class."'", $completeContent);
	}
	//Remove breadcrumb
	$completeContent = preg_replace("/<ul id=\"breadcrumbs\" class=\"breadcrumbs\">(.*?)<\/ul>/", "", $completeContent);
	$completeContent = preg_replace("/<div class=\"amp-comments\">(.*?)<\/div>/", "", $completeContent);
	$completeContent = preg_replace("/class=\"(.*?)animate(.*?)\"/", 'class="$1 $2"', $completeContent);
	//removefooterCss
	$completeContent = preg_replace("/\.footer{(\s|)margin-top(\s|):(\s|)80px(;|)}/", "", $completeContent);
	$completeContent = preg_replace("/\.left{(\s|)float(\s|):(\s|)left(;|)}/", "", $completeContent);
	/***Replacements***/
	
	
		$tmpDoc = new DOMDocument();
		libxml_use_internal_errors(true);
		$tmpDoc->loadHTML($completeContent);
		//return json_encode(AMP_PB_Style_Sanitizer::has_required_php_css_parser());
		if(AMP_PB_Style_Sanitizer::has_required_php_css_parser()){ 
			$sheet = '';

			$obj = new AMP_PB_Style_Sanitizer($tmpDoc);
			$obj->sanitize();
			$data = $obj->get_stylesheets();
			foreach($data as $styles){
				$sheet .= $styles;
			}
			$sheet = stripcslashes($sheet);
			$completeContent = preg_replace("/<style amp-custom>(.*?)<\/style>/si", "<style	 amp-custom>".$sheet."</style>", $completeContent ); 
		}
		
	return $completeContent;
}