<?php

if (! defined('WP_DEBUG') )
	die( 'Direct access forbidden.' );

const TAINACAN_DISABLE_ITEM_THE_CONTENT_FILTER = true;

// Helper function to get asset data from wp-scripts generated .asset.php files
function mateuswetah_get_asset_data( $asset_name ) {
	$asset_file = get_stylesheet_directory() . '/build/js/' . $asset_name . '.asset.php';
	
	if ( file_exists( $asset_file ) ) {
		$asset_data = include $asset_file;
		return array(
			'dependencies' => $asset_data['dependencies'] ?? array(),
			'version' => $asset_data['version'] ?? wp_get_theme()->get('Version')
		);
	}
	
	// Fallback if .asset.php doesn't exist
	return array(
		'dependencies' => array(),
		'version' => wp_get_theme()->get('Version')
	);
}

// Enqueue assets
function mateuswetah_enqueue_assets() {
	// Check if built assets exist, otherwise fall back to source files
	$build_dir = get_stylesheet_directory_uri() . '/build';
	$source_dir = get_stylesheet_directory_uri();
	
	// Main theme stylesheet - use .asset.php for versioning
	if ( file_exists( get_stylesheet_directory() . '/build/style.css' ) ) {
		$style_asset = mateuswetah_get_asset_data( 'style' );
		wp_enqueue_style( 'mateuswetah-style', $build_dir . '/style.css', array(), $style_asset['version'] );
	} else {
		wp_enqueue_style( 'mateuswetah-style', $source_dir . '/style.css', array(), wp_get_theme()->get('Version') );
	}
	
	// Main JavaScript - use .asset.php for dependencies and versioning
	if ( file_exists( get_stylesheet_directory() . '/build/js/main.js' ) ) {
		$main_asset = mateuswetah_get_asset_data( 'main' );
		wp_enqueue_script( 'mateuswetah-script', $build_dir . '/js/main.js', $main_asset['dependencies'], $main_asset['version'], true );
	} else {
		wp_enqueue_script( 'mateuswetah-script', $source_dir . '/assets/js/scroll.js', array(), wp_get_theme()->get('Version'), true );
	}

	// Portfolio/Development styles - only load on specific pages
	if ( is_post_type_archive('tnc_col_1051_item') || get_post_type() === 'tnc_col_1051_item' || is_post_type_archive('tnc_col_1021_item') || get_post_type() === 'tnc_col_1021_item' ) {
		if ( file_exists( get_stylesheet_directory() . '/build/dev.css' ) ) {
			$dev_asset = mateuswetah_get_asset_data( 'dev' );
			wp_enqueue_style( 'mateuswetah-dev-style', $build_dir . '/dev.css', array('mateuswetah-style'), $dev_asset['version'] );
		} else {
			wp_enqueue_style( 'mateuswetah-dev-style', $source_dir . '/assets/css/dev.css', array('mateuswetah-style'), wp_get_theme()->get('Version') );
		}
	}
	// Blog/Alternative styles - only load on specific pages
	else if ( is_post_type_archive('post') || get_post_type() === 'post'  || is_post_type_archive('tnc_col_2096_item') || get_post_type() === 'tnc_col_2096_item' ) {
		if ( file_exists( get_stylesheet_directory() . '/build/alt.css' ) ) {
			$alt_asset = mateuswetah_get_asset_data( 'alt' );
			wp_enqueue_style( 'mateuswetah-alt-style', $build_dir . '/alt.css', array('mateuswetah-style'), $alt_asset['version'] );
		} else {
			wp_enqueue_style( 'mateuswetah-alt-style', $source_dir . '/assets/css/alt.css', array('mateuswetah-style'), wp_get_theme()->get('Version') );
		}
	}

	// Unregister styles not used
	wp_deregister_style( 'roboto-fonts-css' );

}
add_action( 'wp_enqueue_scripts', 'mateuswetah_enqueue_assets' );

// Add editor styles
function mateuswetah_after_setup_theme() {
	
	//add_theme_support( 'editor-styles'); // Is this necessary? Should this prevent us from needing to add .editor-styles-wrapper in our css?
	
	// Editor styles - use built if available with proper versioning
	if ( file_exists( get_stylesheet_directory() . '/build/style.css' ) ) {
		$style_asset = mateuswetah_get_asset_data( 'style' );
		add_editor_style( get_stylesheet_directory_uri() . '/build/style.css' );
	} else {
		add_editor_style( get_stylesheet_directory_uri() . '/style.css' );
	}

	// Add conditional editor styles based on post type
	if (
		isset($_GET['postId']) && ( str_contains( $_GET['postId'], 'tnc_col_1051_item' ) || str_contains( $_GET['postId'], 'tnc_col_1021_item' ) ) ||	// Site editor
		isset($_GET['post']) && ( get_post_type($_GET['post']) === 'tnc_col_1051_item' || get_post_type($_GET['post']) === 'tnc_col_1021_item' )	// Post Editor
	) {
		if ( file_exists( get_stylesheet_directory() . '/build/dev.css' ) ) {
			add_editor_style( get_stylesheet_directory_uri() . '/build/dev.css' );
		} else {
			add_editor_style( get_stylesheet_directory_uri() . '/assets/css/dev.css' );
		}
	}

	else if (
		isset($_GET['postId']) && ( str_contains( $_GET['postId'], 'single-post') || str_contains( $_GET['postId'], 'home' ) || str_contains( $_GET['postId'], 'tnc_col_2096_item' ) ) || 	// Site editor
		isset($_GET['post']) && ( get_post_type($_GET['post']) === 'post' || get_post_type($_GET['post']) === 'tnc_col_2096_item' )		// Post Editor
	) {
		if ( file_exists( get_stylesheet_directory() . '/build/alt.css' ) ) {
			add_editor_style( get_stylesheet_directory_uri() . '/build/alt.css' );
		} else {
			add_editor_style( get_stylesheet_directory_uri() . '/assets/css/alt.css' );
		}
	}
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
