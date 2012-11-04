<?php

/* Update to Bootstrap 2.2.1 */

function update_bootstrap() {

	wp_dequeue_style( 'standard' );

	wp_dequeue_style( 'bootstrap' ); 
	wp_register_style( 'bootstrap-two', get_stylesheet_directory_uri() . '/css/lib/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-two' );
	
	wp_dequeue_style( 'bootstrap-responsive' );
	
	wp_dequeue_script( 'bootstrap' );
	wp_register_script( 'bootstrap-two', get_stylesheet_directory_uri() . '/js/lib/bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap-two' );
	
	wp_enqueue_style( 'standard' );
	
}

add_action( 'wp_enqueue_scripts', 'update_bootstrap', 1000 );

/* Utility Functions */

/* Turn a string into a 'slug' */

function slug($str) {
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	return $str;
}

/* Bootstrap Shortcodes */

/* Collapse: http://twitter.github.com/bootstrap/javascript.html#collapse */

/* [collapse title=null element="h2" open=false][/collapse] */

function bs_collapse_func($atts, $content = null) {

	extract( 
		shortcode_atts( 
			array(
			'title' => '',
			'element' => 'h3',
			'open' => false
			), 
			$atts
		)
	);
	
	$idnum = rand(1,50);
	$open == true ? $open = ' in' : $open = '';
	
	$collapse_content = "<" . $element . "><a data-toggle='collapse' data-target='#coll" . $idnum . "' class='pointer'>" . $title . " +</a></" . $element . "><div id='coll" . $idnum . "' class='collapse" . $open . "'>" . $content . "</div>";

	return $collapse_content;
	 
}

add_shortcode( 'collapse', 'bs_collapse_func' );

/* Tabs: http://twitter.github.com/bootstrap/javascript.html#tabs */

/* [tabs class=null][/tabs] */

function bs_tabs_func($atts, $content = null) {
	
	extract( 
		shortcode_atts( 
			array(
			'class' => ''
			), 
			$atts
		)
	);
		
	if ( $class != '' ) {
		$class = " " . $class;
	}
		
	$tabs_content = "<ul class='nav nav-tabs'>" . do_shortcode($content) . "</ul>";
	
	return $tabs_content;
	
}

add_shortcode( 'tabs', 'bs_tabs_func' );

/* Tab: http://twitter.github.com/bootstrap/javascript.html#tabs */

/* [tab title="default" active=false] */

function bs_tab_func($atts, $content = null) {
	
	extract( 
		shortcode_atts( 
			array(
			'title' => 'default',
			'active' => false
			), 
			$atts
		)
	);
		
	if ( $active == true ) {
		$active = " class='active'";
	} else {
		$active = "";
	}
		
	$tab_content = "<li" . $active . "><a href='#" . slug($title) . "' data-toggle='tab'>" . $title . "</a></li>";
	
	return $tab_content;
	
}

add_shortcode( 'tab', 'bs_tab_func' );

/* Tab Content Group: http://twitter.github.com/bootstrap/javascript.html#tabs */

/* [tab-content-group][/tab-content-group] */

function bs_tab_content_group_func($atts, $content = null) {
		
	$tab_content_group_content = "<div class='tab-content'>" . do_shortcode($content) . "</div>";
	
	return $tab_content_group_content;
	
}

add_shortcode( 'tabcontent-group', 'bs_tab_content_group_func' );

/* Tab Content: http://twitter.github.com/bootstrap/javascript.html#tabs */

/* [tabcontent title=null active=true][/tabcontent] */

function bs_tab_content_func($atts, $content = null) {
	
	extract( 
		shortcode_atts( 
			array(
			'title' => 'default',
			'active' => false
			), 
			$atts
		)
	);
		
	if ( $active == true ) {
		$active = " active";
	} else {
		$active = "";
	}
		
	$tab_content = "<div class='tab-pane" . $active . "' id='" . slug($title) . "'>" . do_shortcode($content) . "</div>";
	
	return $tab_content;
	
}

add_shortcode( 'tabcontent', 'bs_tab_content_func' );

/* Buttons: http://twitter.github.com/bootstrap/base-css.html#buttons */

/* [button text=null link="#" style=null size=null icon=null iconwhite=false class=null newwindow=false] */

function bs_button_func($atts) {

	extract( 
		shortcode_atts( 
			array(
			'text' => '',
			'link' => '',
			'style' => '',
			'size' => '',
			'icon' => '',
			'iconwhite' => false,
			'class' => '',
			'newwindow' => false
			), 
			$atts
		)
	);
	
	if ( $style != '' ) {
		$style = " btn-" . $style;
	}
	
	if ( $size != '' ) {
		$size = " btn-" . $size;
	}
	
	$iconwhite == true ? $iconclr = " icon-white" : $iconclr = "";
	
	if ( $icon != '' ) {
		$icon = " <i class='icon-" . $icon . $iconclr . "'></i>";
	}
	
	if ( $class != '' ) {
		$class = " " . $class;
	}
	
	$newwindow == true ? $newwindow = " target='_blank'" : $newwindow = "";
	
	if ( $link != '' ) {
		$button_content = "<a href='" . $link . "' class='btn" . $style . $size . $class . "'" . $newwindow . ">" . $text . $icon . "</a>";
	} else {
		$button_content = "<button class='btn" . $style . $size . $class . "'>" . $text . $icon . "</button>";
	}	

	return $button_content;
	 
}

add_shortcode( 'button', 'bs_button_func' );

/* Row: http://twitter.github.com/bootstrap/scaffolding.html */

/* [row fluid=false class=null] */

function bs_row_func($atts, $content = null) {
	
	extract( 
		shortcode_atts( 
			array(
			'fluid' => false,
			'class' => ''
			), 
			$atts
		)
	);
	
	$fluid == true ? $fluid = "-fluid" : $fluid = "";
	
	if ( $class != '' ) {
		$class = " " . $class;
	}
	
	$row_content = "<div class='row" . $fluid . $class . "'>" . do_shortcode($content) . "</div>";
	
	return $row_content;
	
}

add_shortcode( 'row', 'bs_row_func' );

/* Span: http://twitter.github.com/bootstrap/scaffolding.html */

/* [span width=12 offset=0 class=null] */

function bs_span_func($atts, $content = null) {
	
	extract( 
		shortcode_atts( 
			array(
			'width' => 12,
			'offset' => 0,
			'class' => ''
			), 
			$atts
		)
	);
	
	$offset != '0' ? $offset = " offset" . $offset : $offset = "";
	
	if ( $class != '' ) {
		$class = " " . $class;
	}
		
	$span_content = "<div class='span" . $width . $offset . $class . "'>" . do_shortcode($content) . "</div>";
	
	return $span_content;
	
}

add_shortcode( 'span', 'bs_span_func' );

/* Button Group: http://twitter.github.com/bootstrap/components.html#buttonGroups */

/* [btngroup class=null] */

function bs_btngrp_func($atts, $content = null) {
	
	extract( 
		shortcode_atts( 
			array(
			'class' => ''
			), 
			$atts
		)
	);
		
	if ( $class != '' ) {
		$class = " " . $class;
	}
		
	$btngrp_content = "<div class='btn-group" . $class . "'>" . do_shortcode($content) . "</div>";
	
	return $btngrp_content;
	
}

add_shortcode( 'btngroup', 'bs_btngrp_func' );

/* Hero: http://twitter.github.com/bootstrap/components.html#typography */

/* [hero] */

function bs_hero_func($atts, $content = null) {
		
	$hero_content = "<div class='hero-unit'>" . do_shortcode($content) . "</div>";
	
	return $hero_content;
	
}

add_shortcode( 'hero', 'bs_hero_func' );

/* Well: http://twitter.github.com/bootstrap/components.html#misc */

/* [well size=null] */

function bs_well_func($atts, $content = null) {

	extract( 
		shortcode_atts( 
			array(
			'size' => false
			), 
			$atts
		)
	);
	
	$size != '' ? $size = " well-" . $size : $size = "";
		
	$well_content = "<div class='well" . $size . "'>" . do_shortcode($content) . "</div>";
	
	return $well_content;
	
}

add_shortcode( 'well', 'bs_well_func' );

/* Icon: http://fortawesome.github.com/Font-Awesome/ */

/* [icon type=null class=null] */

function bs_icon_func($atts) {

	extract( 
		shortcode_atts( 
			array(
			'type' => '',
			'class' => ''
			), 
			$atts
		)
	);
	
	if ( $class != '' ) {
		$class = " " . $class;
	}
		
	$icon_content = "<i class='icon-" . $type . $class . "'></i>";
	
	return $icon_content;
	
}

add_shortcode( 'icon', 'bs_icon_func' );

/* Move wpautop() to run after shortcodes */

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 11);
add_filter('widget_text', 'do_shortcode');