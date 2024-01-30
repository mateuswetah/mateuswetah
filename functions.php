<?php

if (! defined('WP_DEBUG') )
	die( 'Direct access forbidden.' );

const TAINACAN_DISABLE_ITEM_THE_CONTENT_FILTER = true;

// Enqueue assets
function mateuswetah_enqueue_assets() {
	wp_enqueue_style( 'mateuswetah-style', get_stylesheet_directory_uri() . '/style.css', wp_get_theme()->get('Version') );
	wp_enqueue_script( 'mateuswetah-script', get_stylesheet_directory_uri() . '/assets/js/scroll.js', array(), wp_get_theme()->get('Version') , true );

	if ( is_post_type_archive('tnc_col_1051_item') || get_post_type() === 'tnc_col_1051_item' || is_post_type_archive('tnc_col_1021_item') || get_post_type() === 'tnc_col_1021_item' )
		wp_enqueue_style( 'mateuswetah-dev-style', get_stylesheet_directory_uri() . '/assets/css/dev.css', wp_get_theme()->get('Version') );

	else if ( is_post_type_archive('post') || get_post_type() === 'post'  || is_post_type_archive('tnc_col_2096_item') || get_post_type() === 'tnc_col_2096_item' )
		wp_enqueue_style( 'mateuswetah-alt-style', get_stylesheet_directory_uri() . '/assets/css/alt.css', wp_get_theme()->get('Version') );

	// Unregister styles not used
	wp_deregister_style( 'roboto-fonts-css' );
	
	if ( ! is_admin() )
		wp_deregister_script('jquery');

}
add_action( 'wp_enqueue_scripts', 'mateuswetah_enqueue_assets' );

// Add editor styles
function mateuswetah_after_setup_theme() {
	
	//add_theme_support( 'editor-styles'); // Is this necessary? Should this prevent us from needing to add .editor-styles-wrapper in our css?
	add_editor_style( get_stylesheet_directory_uri() . '/assets/css/base.css' );

	if (
		isset($_GET['postId']) && ( str_contains( $_GET['postId'], 'tnc_col_1051_item' ) || str_contains( $_GET['postId'], 'tnc_col_1021_item' ) ) ||	// Site editor
		isset($_GET['post']) && ( get_post_type($_GET['post']) === 'tnc_col_1051_item' || get_post_type($_GET['post']) === 'tnc_col_1021_item' )	// Post Editor
	)
		add_editor_style( get_stylesheet_directory_uri() . '/assets/css/dev.css' );

	else if (
		isset($_GET['postId']) && ( str_contains( $_GET['postId'], 'single-post') || str_contains( $_GET['postId'], 'home' ) || str_contains( $_GET['postId'], 'tnc_col_2096_item' ) ) || 	// Site editor
		isset($_GET['post']) && ( get_post_type($_GET['post']) === 'post' || get_post_type($_GET['post']) === 'tnc_col_2096_item' )		// Post Editor
	)
		add_editor_style( get_stylesheet_directory_uri() . '/assets/css/alt.css' );
}
add_action( 'after_setup_theme', 'mateuswetah_after_setup_theme' );

// Allows SVG upload.
function mateuswetah_add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_filter('upload_mimes', 'mateuswetah_add_file_types_to_uploads');


// Block Styles
require get_stylesheet_directory() . '/inc/block-styles.php';
