<?php

/* Update to Bootstrap 2.1 */

function update_bootstrap() {
	wp_dequeue_style( 'bootstrap' ); 
	wp_register_style( 'bootstrap-two', get_stylesheet_directory_uri() . '/css/lib/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-two' );
	
	wp_dequeue_style( 'bootstrap-responsive' );
	wp_register_style( 'bootstrap-responsive-two', get_stylesheet_directory_uri() . '/css/lib/bootstrap-responsive.min.css' );
	wp_enqueue_style( 'bootstrap-responsive-two' );
	
	wp_dequeue_script( 'bootstrap' );
	wp_register_script( 'bootstrap-two', get_stylesheet_directory_uri() . '/js/lib/bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap-two' );
	
}

add_action( 'wp_enqueue_scripts', 'update_bootstrap', 11 );