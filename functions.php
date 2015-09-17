<?php 

add_action( 'wp_enqueue_scripts', 'research_enqueue_scripts');
/*
 * Enqueue custom scripting in child theme.
 */
function research_enqueue_scripts() {
	wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/custom.css' );
}