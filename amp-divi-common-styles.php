<?php
function ampforwp_divi_common_styles(){
	?>
	@font-face {
	font-family: "ETmodules";
	src: url("<?php echo AMP_WPBAKERY_PLUGIN_DIR_URI;?>core/admin/fonts/modules.eot");
	src: url("<?php echo AMP_WPBAKERY_PLUGIN_DIR_URI;?>core/admin/fonts/modules.eot?#iefix") format("embedded-opentype"), url("<?php echo AMP_WPBAKERY_PLUGIN_DIR_URI;?>core/admin/fonts/modules.ttf") format("truetype"), url("<?php echo AMP_WPBAKERY_PLUGIN_DIR_URI;?>core/admin/fonts/modules.woff") format("woff"), url("<?php echo AMP_WPBAKERY_PLUGIN_DIR_URI;?>core/admin/fonts/modules.svg#ETmodules") format("svg");
	font-weight: normal;
	font-style: normal;
}
.et_pb_row {
    position: relative;
    width: 80%;
    max-width: 1080px;
    margin: auto;
}
	/* Boxed Layout */
.et_boxed_layout #page-container {
	-webkit-box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
	-moz-box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
	box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
}

.et_boxed_layout #page-container,
.et_boxed_layout.et_non_fixed_nav.et_transparent_nav #page-container #top-header,
.et_non_fixed_nav.et_transparent_nav.et_boxed_layout #page-container #main-header,
.et_fixed_nav.et_boxed_layout #page-container #top-header,
.et_fixed_nav.et_boxed_layout #page-container #main-header,
.et_boxed_layout #page-container .container,
.et_boxed_layout #page-container .et_pb_row,
.et_boxed_layout.et_pb_pagebuilder_layout.single.et_full_width_page #page-container .et_pb_row,
.et_boxed_layout.et_pb_pagebuilder_layout.single.et_full_width_portfolio_page #page-container .et_pb_row,
.et_boxed_layout.et_pb_pagebuilder_layout.single #page-container .et_pb_row {
	width: 90%;
	max-width: 1200px;
	margin: auto;
}

.et_boxed_layout.et_vertical_nav #page-container {
	max-width: 1425px;
}

.et_boxed_layout.et_vertical_nav #page-container #top-header {
	width: auto;
	max-width: none;
}

.et_boxed_layout.et_vertical_right.et_vertical_fixed #main-header {
	opacity: 0;
}

.et_boxed_layout.et_vertical_right.et_vertical_fixed #page-container #main-header.et_vertical_menu_set {
	opacity: 1;
	-webkit-transition: opacity 0.4s ease-in-out;
	-moz-transition: opacity 0.4s ease-in-out;
	transition: opacity 0.4s ease-in-out;
}

.et_button_icon_visible .et_pb_button{
	padding-right: 2em;
	padding-left: 0.7em;
}

.et_button_icon_visible .et_pb_button:after{
	margin-left: 0;
	opacity: 1;
}

.et_button_left .et_pb_button:hover:after{
	left: 0.15em;
}
.et_button_left .et_pb_button:after{
	left: 1em;
	margin-left: 0;
}
.et_button_left .et_pb_button:hover,
.et_button_left .et_pb_module .et_pb_button:hover,
.et_button_icon_visible.et_button_left .et_pb_button{
	padding-right: 0.7em;
	padding-left: 2em;
}

.et_button_left .et_pb_button:hover:after,
.et_button_icon_visible.et_button_left .et_pb_button:after{
	left: 0.15em;
}
.form-submit .et_pb_button:hover,
.et_password_protected_form .et_submit_button:hover{
	padding: 0.3em 1em;
}
/* Headers */
.et_pb_column_1_3 h1,
.et_pb_column_1_4 h1 { font-size: 26px; }
.et_pb_column_1_3 h2,
.et_pb_column_1_4 h2 { font-size: 23px; }

.et_pb_column_1_3 h3,
.et_pb_column_1_4 h3 {
    font-size: 20px;
}

.et_pb_column_1_3 h4,
.et_pb_column_1_4 h4 {
    font-size: 18px;
}

.et_pb_column_1_3 h5,
.et_pb_column_1_4 h5 {
    font-size: 16px;
}

.et_pb_column_1_3 h6,
.et_pb_column_1_4 h6 {
    font-size: 15px;
}

/* Clearfix */
.clearfix:after {
    display: block;
    visibility: hidden;
    clear: both;
    height: 0;
    font-size: 0;
    content: " ";
}
* html .clearfix {
	zoom: 1;
}

/* IE6 */
*:first-child + html .clearfix {
	zoom: 1;
}

/* IE7 */
/* Word Break */
.et_pb_gallery_item,
.et_pb_portfolio_item,
.et_pb_blurb_content,
.et_pb_tabs_controls,
.et_pb_tab,
.et_pb_slide_description,
.et_pb_pricing_heading,
.et_pb_pricing_content,
.et_pb_promo_description,
.et_pb_newsletter_description,
.et_pb_counter_title,
.et_pb_circle_counter,
.et_pb_number_counter,
.et_pb_toggle_title,
.et_pb_toggle_content,
.et_pb_contact_main_title,
.et_pb_testimonial_description_inner,
.et_pb_team_member,
.et_pb_countdown_timer_container,
.et_pb_post,
.et_pb_text,
.product,
.et_pb_widget {
	word-wrap: break-word;
}

/* Accent Color */
.et_pb_sum,
.et_pb_pricing li a,
.et_pb_pricing_table_button,
.et_overlay:before,
.et_pb_member_social_links a:hover,
.woocommerce-page #content input.button:hover .et_pb_widget li a:hover,
.et_pb_bg_layout_light .et_pb_promo_button,
.et_pb_bg_layout_light.et_pb_module.et_pb_button,
.et_pb_bg_layout_light .et_pb_more_button,
.et_pb_filterable_portfolio .et_pb_portfolio_filters li a.active,
.et_pb_filterable_portfolio .et_pb_portofolio_pagination ul li a.active,
.et_pb_gallery .et_pb_gallery_pagination ul li a.active,
.et_pb_contact_submit,
.et_pb_bg_layout_light .et_pb_newsletter_button {
	color: #2ea3f2;
}

.et_pb_pricing li span:before {
	border-color: #2ea3f2;
}

.et_pb_counter_amount,
.et_pb_featured_table .et_pb_pricing_heading,
.et_quote_content,
.et_link_content,
.et_audio_content {
	background-color: #2ea3f2;
}

/* Containers */
.et_pb_row {
	position: relative;
	width: 80%;
	max-width: 1080px;
	margin: auto;
}

/* Columns */
.et_pb_column {
	float: left;
	position: relative;
	z-index: 9;
	background-position: center;
	background-size: cover;
}

.et_pb_column.et_pb_section_parallax {
	position: relative;
}

.et_pb_css_mix_blend_mode_passthrough {
	mix-blend-mode: unset ;
}

/* Module */
.et_pb_module_inner {
	position: relative;
}
/* Default Background Image Styles */
.et_pb_posts_nav a,
.et_pb_row,
.et_pb_row_inner,
.et_pb_module,
.et_pb_counters .et_pb_counter_container,
.et_pb_portfolio_item,
.et_pb_pricing_table,
.et_pb_all_tabs,
.et_pb_tab,
.et_pb_slide,
.et_pb_with_background {
	background-repeat: no-repeat;
	background-position: center;
	background-size: cover;
}
/* Default Border Styles */
.et_pb_with_border,
.et_pb_with_border .et_pb_portfolio_item,
.et_pb_with_border .et_pb_portfolio_image,
.et_pb_with_border .et_pb_gallery_item,
.et_pb_with_border .et_pb_counter_container,
.et_pb_with_border .et_pb_main_blurb_image,
.et_pb_with_border .et_portfolio_image,
.et_pb_with_border .et_pb_gallery_image,
.et_pb_with_border .et_pb_team_member_image,
.et_pb_with_border .et_pb_testimonial_portrait,
.et_pb_with_border .et_pb_image_wrap,
.et_pb_with_border .et_pb_newsletter_form input,
.et_pb_with_focus_border .et_pb_newsletter_form input:focus,
.et_pb_with_border .et_pb_contact_form input,
.et_pb_with_border .et_pb_contact_form textarea,
.et_pb_with_border .et_pb_contact_form select,
.et_pb_with_border .et_pb_contact_form .input[type="checkbox"] + label i,
.et_pb_with_border .et_pb_contact_form .input[type="radio"] + label i,
.et_pb_with_border.et_pb_contact_field input,
.et_pb_with_border.et_pb_contact_field textarea,
.et_pb_with_border.et_pb_contact_field select,
.et_pb_with_border.et_pb_contact_field .input[type="checkbox"] + label i,
.et_pb_with_border.et_pb_contact_field .input[type="radio"] + label i,
.et_pb_with_border.et_pb_posts .et_pb_post,
.et_pb_with_border.et_pb_comments_module textarea,
.et_pb_with_border.et_pb_comments_module input,
.et_pb_with_border.et_pb_posts_nav span.nav-previous a,
.et_pb_with_border.et_pb_posts_nav span.nav-next a,
.et_pb_with_border.et_pb_video_slider .et_pb_slider,
.et_pb_with_border.et_pb_video_slider .et_pb_carousel_item,
.et_pb_with_border.et_pb_shop .et_shop_image > img {
	border-width: 0;
	border-style: solid;
	border-color: #333;
}
/* Column Adjustments */
.et_pb_column_1_4 .et_pb_slider_carousel .et_pb_slide {
	min-height: initial ;
}

.et_pb_column_4_4 .et_pb_carousel_item .et_pb_video_play,
.et_pb_column_3_4 .et_pb_carousel_item .et_pb_video_play,
.et_pb_column_2_3 .et_pb_carousel_item .et_pb_video_play,
.et_pb_column_1_2 .et_pb_carousel_item .et_pb_video_play {
	margin-top: -1.39rem;
	margin-left: -1.39rem;
	font-size: 2.78rem;
	line-height: 2.78rem;
}

.et_pb_column_3_8 .et_pb_carousel_item .et_pb_video_play,
.et_pb_column_1_3 .et_pb_carousel_item .et_pb_video_play {
	margin-top: -1rem;
	margin-left: -1rem;
	font-size: 2rem;
	line-height: 2rem;
}

.et_pb_column_1_4 .et_pb_carousel_item .et_pb_video_play {
	margin-top: -0.75rem;
	margin-left: -0.75rem;
	font-size: 1.5rem;
	line-height: 1.5rem;
}
/* Sections and Rows */
	.et_pb_section {
		padding: 4% 0;
	}

	.et_pb_fullwidth_section {
		padding: 0;
	}

	.et_pb_row {
		padding: 2% 0;
	}

	.et_pb_column_3_4 .et_pb_row_inner {
		padding: 3.735% 0;
	}

	.et_pb_column_2_3 .et_pb_row_inner {
		padding: 4.2415% 0;
	}

	.et_pb_column_1_2 .et_pb_row_inner {
		padding: 5.82% 0;
	}

	.et_pb_column_single {
		padding: 2.855% 0;
	}

	.et_pb_column_single .et_pb_module:first-child,
	.et_pb_column_single .et_pb_module.et-first-child {
		margin-top: 0;
	}

	.et_pb_column_single .et_pb_module:last-child,
	.et_pb_column_single .et_pb_module.et-last-child {
		margin-bottom: 0;
	}

	.et_pb_section .et_pb_row .et_pb_column .et_pb_module:last-child,
	.et_pb_section .et_pb_row .et_pb_column .et_pb_module.et-last-child,
	.et_pb_section.et_section_specialty .et_pb_row .et_pb_column .et_pb_column .et_pb_module:last-child,
	.et_pb_section.et_section_specialty .et_pb_row .et_pb_column .et_pb_column .et_pb_module.et-last-child,
	.et_pb_section.et_section_specialty .et_pb_row .et_pb_column .et_pb_row_inner .et_pb_column .et_pb_module:last-child,
	.et_pb_section.et_section_specialty .et_pb_row .et_pb_column .et_pb_row_inner .et_pb_column .et_pb_module.et-last-child {
		margin-bottom: 0;
	}

	.et_section_specialty > .et_pb_row {
		padding: 0;
	}

	.et_pb_row_inner {
		width: 100%;
	}

	.et_pb_row .et_pb_column:last-child,
	.et_pb_row .et_pb_column.et-last-child,
	.et_pb_row_inner .et_pb_column:last-child,
	.et_pb_row_inner .et_pb_column.et-last-child {
		margin-right: 0 ;
	}

/* Fullwidth Rows */
	.et_pb_row.et_pb_row_fullwidth,
	.et_pb_specialty_fullwidth > .et_pb_row {
		width: 89% ;
		max-width: 89% ;
	}

	.et_pb_gutters4.et_pb_row.et_pb_row_fullwidth,
	.et_pb_gutters4 .et_pb_row.et_pb_row_fullwidth,
	.et_pb_specialty_fullwidth > .et_pb_gutters4.et_pb_row,
	.et_pb_gutters4 .et_pb_specialty_fullwidth > .et_pb_row {
		width: 86% ;
		max-width: 86% ;
	}

	.et_pb_gutters2.et_pb_row.et_pb_row_fullwidth,
	.et_pb_gutters2 .et_pb_row.et_pb_row_fullwidth,
	.et_pb_specialty_fullwidth > .et_pb_gutters2.et_pb_row,
	.et_pb_gutters2 .et_pb_specialty_fullwidth > .et_pb_row {
		width: 94% ;
		max-width: 94% ;
	}

	.et_pb_row.et_pb_row_fullwidth,
	 .et_pb_row.et_pb_row_fullwidth,
	.et_pb_specialty_fullwidth > .et_pb_row,
	 .et_pb_specialty_fullwidth > .et_pb_row {
		width: 100% ;
		max-width: 100% ;
	}

/* Equalize Column Heights */
	.et_pb_row.et_pb_equal_columns,
	.et_pb_row_inner.et_pb_equal_columns,
	.et_pb_section.et_pb_equal_columns > .et_pb_row {
		display: -webkit-box;
		display: -moz-box;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;

		direction: ltr;
	}

/* Modify column's order in equalize column row so clearfix is displayed early and its
	   actual width (0px) remains to avoid unwanted window's unwanted horizontal scroll */
	.et_pb_row.et_pb_equal_columns > .et_pb_column {
		order: 1;
	}
/*Desktop Media Styles for Sections*/
.et_pb_section{
    padding: 10px 0;
    width: 100%;
    display: inline-block;
    clear: both;
}
/*Column and Rows Styles*/
@media all and (min-width: 981px) {
	 .et_pb_column,
	.et_pb_row .et_pb_column {
		margin-right: 5.5%;
	}

	 .et_pb_column_4_4,
	.et_pb_row .et_pb_column_4_4 {
		width: 100%;
	}

	 .et_pb_column_4_4 .et_pb_module,
	.et_pb_row .et_pb_column_4_4 .et_pb_module {
		margin-bottom: 1%;
	}

	 .et_pb_column_3_4,
	.et_pb_row .et_pb_column_3_4 {
		width: 73.625%;
	}

	 .et_pb_column_3_4 .et_pb_module,
	.et_pb_row .et_pb_column_3_4 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_3_4 .et_pb_column_4_4 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_3_4 .et_pb_row_inner .et_pb_column_4_4 .et_pb_module {
		margin-bottom: 3.735%;
	}

	 .et_pb_column_2_3,
	.et_pb_row .et_pb_column_2_3 {
		width: 64.833%;
	}

	 .et_pb_column_2_3 .et_pb_module,
	.et_pb_row .et_pb_column_2_3 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_2_3 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_2_3 .et_pb_row_inner .et_pb_module {
		margin-bottom: 4.242%;
	}

	 .et_pb_column_1_2,
	.et_pb_row .et_pb_column_1_2 {
		width: 47.25%;
	}

	 .et_pb_column_1_2 .et_pb_module,
	.et_pb_row .et_pb_column_1_2 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_1_2 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_1_2 .et_pb_row_inner .et_pb_module {
		margin-bottom: 1%;
	}

	 .et_pb_column_1_3,
	.et_pb_row .et_pb_column_1_3 {
		width: 29.666%;
	}

	 .et_pb_column_1_3 .et_pb_module,
	.et_pb_row .et_pb_column_1_3 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_1_3 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_2_3 .et_pb_row_inner .et_pb_column_1_3 .et_pb_module {
		margin-bottom: 9.27%;
	}

	 .et_pb_column_1_4,
	.et_pb_row .et_pb_column_1_4 {
		width: 20.875%;
	}

	 .et_pb_column_1_4 .et_pb_module,
	.et_pb_row .et_pb_column_1_4 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_3_4 .et_pb_column_1_4 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_1_2 .et_pb_column_1_4 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_3_4 .et_pb_row_inner .et_pb_column_1_4 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_1_2 .et_pb_row_inner .et_pb_column_1_4 .et_pb_module {
		margin-bottom: 13.174%;
	}

	 .et_pb_column_3_4 .et_pb_row_inner .et_pb_column_3_8,
	.et_pb_row > .et_pb_column_3_4 .et_pb_row_inner .et_pb_column_3_8,
	.et_section_specialty .et_pb_row .et_pb_column_3_4 .et_pb_row_inner .et_pb_column_3_8 {
		width: 46.265%;
		margin-right: 7.47%;
	}

	 .et_pb_column_3_4 .et_pb_row_inner .et_pb_column_3_8 .et_pb_module,
	.et_pb_row > .et_pb_column_3_4 .et_pb_row_inner .et_pb_column_3_8 .et_pb_module,
	.et_section_specialty .et_pb_row .et_pb_column_3_4 .et_pb_row_inner .et_pb_column_3_8 .et_pb_module {
		margin-bottom: 7.47%;
	}

	 .et_pb_row .et_pb_column_single.et_pb_column_1_4 .et_pb_module,
	.et_pb_row .et_pb_column_single.et_pb_column_1_4 .et_pb_module {
		margin-bottom: 13.174%;
	}

	 .et_pb_row .et_pb_column_single.et_pb_column_1_3 .et_pb_module,
	.et_pb_row .et_pb_column_single.et_pb_column_1_3 .et_pb_module {
		margin-bottom: 9.27%;
	}

	 .et_pb_row .et_pb_column_single.et_pb_column_1_2 .et_pb_module,
	.et_pb_row .et_pb_column_single.et_pb_column_1_2 .et_pb_module {
		margin-bottom: 5.82%;
	}
}

/* Responsive Smartphone Ladnscape And Above */
@media all and (min-width: 480px) {
	/* Slider Module */
	.et_pb_column_1_4 .et_pb_slide_description {
		padding-bottom: 26%;
	}
}

/* Responsive Styles Tablet And Below */
@media all and (max-width: 980px) {
	/* Page Containers */
	.et_pb_column {
		width: 100% ;
	}

/* Rows and Sections */
	.et_pb_section {
		padding: 50px 0;
	}

	.et_pb_fullwidth_section {
		padding: 0;
	}

	.et_pb_row,
	.et_pb_column .et_pb_row_inner {
		padding: 30px 0;
	}

	.et_section_specialty > .et_pb_row {
		padding: 0;
	}

	.et_pb_column {
		margin-bottom: 30px;
	}

	.et_pb_row:last-child .et_pb_column:last-child,
	.et_pb_row.et-last-child .et_pb_column.et-last-child {
		margin-bottom: 0;
	}

	
	.et_pb_column .et_pb_module {
		margin-bottom: 0;
	}

	 .et_section_specialty .et_pb_row > .et_pb_column > .et_pb_module,
	.et_section_specialty .et_pb_row > .et_pb_column > .et_pb_module {
		margin: 0;
	}

	.et_section_specialty .et_pb_row > .et_pb_column {
		padding-bottom: 0;
	}

	.et_pb_row .et_pb_column .et_pb_module:last-child,
	.et_pb_row .et_pb_column .et_pb_module.et-last-child,
	.et_section_specialty .et_pb_row .et_pb_column .et_pb_module:last-child,
	.et_section_specialty .et_pb_row .et_pb_column .et_pb_module.et-last-child {
		margin-bottom: 0;
	}

	.et_pb_column.et_pb_column_empty {
		display: none;
	}

/* 1_4 Column Breakdown */
	.et_pb_row_4col,
	.et_pb_row_1-4_1-4_1-2,
	.et_pb_row_1-2_1-4_1-4,
	.et_pb_row_1-4_1-4 {
		display: -webkit-box;
		display: -moz-box;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
		overflow: hidden;

		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
	}

	.et_pb_row_4col > .et_pb_column.et_pb_column_1_4,
	.et_pb_row_1-4_1-4_1-2 > .et_pb_column.et_pb_column_1_4,
	.et_pb_row_1-2_1-4_1-4 > .et_pb_column.et_pb_column_1_4,
	.et_pb_row_1-4_1-4 > .et_pb_column.et_pb_column_1_4 {
		width: 47.25% ;
		margin-right: 5.5%;
	}

	 .et_pb_row_4col > .et_pb_column.et_pb_column_1_4,
	 .et_pb_row_1-4_1-4_1-2 > .et_pb_column.et_pb_column_1_4,
	 .et_pb_row_1-2_1-4_1-4 > .et_pb_column.et_pb_column_1_4,
	 .et_pb_row_1-4_1-4 .et_pb_column.et_pb_column_1_4,
	.et_pb_row_4col > .et_pb_column.et_pb_column_1_4,
	.et_pb_row_1-4_1-4_1-2 > .et_pb_column.et_pb_column_1_4,
	.et_pb_row_1-2_1-4_1-4 > .et_pb_column.et_pb_column_1_4,
	.et_pb_row_1-4_1-4 .et_pb_column.et_pb_column_1_4 {
		width: 50% ;
		margin-right: 0;
	}

	.et_pb_row_4col > .et_pb_column.et_pb_column_1_4:nth-child(even),
	.et_pb_row_1-4_1-4_1-2 > .et_pb_column.et_pb_column_1_4:nth-child(even),
	.et_pb_row_1-4_1-4 > .et_pb_column.et_pb_column_1_4:nth-child(even),
	.et_pb_row_1-2_1-4_1-4 > .et_pb_column.et_pb_column_1_4:nth-child(odd) {
		margin-right: 0;
	}

	.et_pb_row_4col .et_pb_column:nth-last-child(-n+2),
	.et_pb_row_1-4_1-4 .et_pb_column:nth-last-child(-n+2),
	.et_pb_row_1-2_1-4_1-4 .et_pb_column:nth-last-child(-n+2) {
		margin-bottom: 0;
	}


}


	<?php
}