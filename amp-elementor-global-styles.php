<?php
function ampforwp_elementor_global_styles(){
	?>
	.elementor-align-left{
		text-align: left;
	}
	.elementor-align-right{
		text-align: right;
	}
	.elementor-section.elementor-section-boxed>.elementor-container {
	    max-width: 1140px;
	    margin:0 auto;
	}
	.elementor-section.elementor-section-items-middle>.elementor-container{
		-webkit-box-align: center;
	    -webkit-align-items: center;
	    -ms-flex-align: center;
	    align-items: center;
	}
	.elementor-row {
	    width: 100%;
	    display: -webkit-box;
	    display: -webkit-flex;
	    display: -ms-flexbox;
	    display: flex;
	}
	.elementor-column {
	    position: relative;
	    min-height: 1px;
	    display: -webkit-box;
	    display: -webkit-flex;
	    display: -ms-flexbox;
	    display: flex;
	}
	.elementor-background-overlay {
	    height: 100%;
	    width: 100%;
	    top: 0;
	    left: 0;
	    position: absolute;
	}
	.elementor-section {
	    position: relative;
	}
	.elementor-widget:not(:last-child) {
	    margin-bottom: 20px;
	}
	.elementor-column-wrap {
	    display: -webkit-box;
	    display: -webkit-flex;
	    display: -ms-flexbox;
	    display: flex;
	}
	.elementor-widget-text-editor {
	    color: #fff;
	    font-weight: 400;
	}
	.elementor-section-content-middle>.elementor-container>.elementor-row>.elementor-column>.elementor-column-wrap{
	    
	    align-items: center;
	}
	.elementor-column-gap-default>.elementor-row>.elementor-column>.elementor-element-populated {
	    padding: 10px;
	}
	.elementor-image amp-img{
		width:100%;
		height:100%;
	}
	.elementor-widget .elementor-icon-list-icon+.elementor-icon-list-text {		
		align-self: center;		
		padding-left: 5px;	
	}
	.elementor-widget.elementor-align-right .elementor-icon-list-item, .elementor-widget.elementor-align-right .elementor-icon-list-item a {
		justify-content: flex-end;
		text-align: right;
	}
	.elementor-widget .elementor-icon-list-items {		list-style-type: none;		margin: 0;		padding: 0;		text-align: left;	}
	<?php

} 