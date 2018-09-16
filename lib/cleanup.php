<?php

/**
 * Cleanup
 *
 * This file adds cleanup functions to the Genesis Custom Theme.
 *
 * @package Genesis Custom
 * @author  Daniel Bissinger
 * @license GPL-2.0+
 * @link    https://danielbissinger.com/
 */


/**********************

OUTPUT CLEANUP

**********************/

//* Remove emoji support scripts.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

//* Remove primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );


/**********************

ADMIN SCREENS CLEANUP

**********************/

//* Remove Genesis theme features.
add_action( 'after_setup_theme', 'genesis_custom_remove_theme_features', 9 );
function genesis_custom_remove_theme_features(){

	remove_theme_support( 'genesis-inpost-layouts' );
	remove_theme_support( 'genesis-archive-layouts' );
	remove_theme_support( 'genesis-admin-menu' );
	remove_theme_support( 'genesis-seo-settings-menu' );
	remove_theme_support( 'genesis-import-export-menu' );
	remove_theme_support( 'genesis-readme-menu' );
	remove_theme_support( 'genesis-customizer-theme-settings' );
	remove_theme_support( 'genesis-customizer-seo-settings' );
	remove_theme_support( 'genesis-auto-updates' );
	remove_theme_support( 'genesis-breadcrumbs' );
}

//* Remove Genesis post features.
add_action( 'after_setup_theme', 'genesis_custom_post_type_support' );
function genesis_custom_post_type_support() {

	remove_post_type_support( 'post', 'genesis-seo' );
	remove_post_type_support( 'post', 'genesis-scripts' );
	remove_post_type_support( 'post', 'genesis-layouts' );
	remove_post_type_support( 'post', 'genesis-rel-author' );

	remove_post_type_support( 'page', 'genesis-seo' );
	remove_post_type_support( 'page', 'genesis-scripts' );
	remove_post_type_support( 'page', 'genesis-layouts' );
}

//* Remove Genesis SEO features.
add_action( 'after_setup_theme', 'genesis_custom_remove_seo' );
function genesis_custom_remove_seo() {

    genesis_disable_seo();
}

//* Remove Genesis user profile options.
add_action( 'after_setup_theme', 'genesis_custom_remove_user_options' );
function genesis_custom_remove_user_options() {

    remove_action( 'show_user_profile', 'genesis_user_options_fields' );
    remove_action( 'edit_user_profile', 'genesis_user_options_fields' );
    remove_action( 'show_user_profile', 'genesis_user_archive_fields' );
    remove_action( 'edit_user_profile', 'genesis_user_archive_fields' );   
}

//* Remove Genesis taxonomy archive options.
add_action( 'after_setup_theme', 'genesis_custom_remove_taxonomy_archive_options' );
function genesis_custom_remove_taxonomy_archive_options() {

    remove_action( 'admin_init', 'genesis_add_taxonomy_archive_options' );    
}

//* Remove widget areas.
add_action( 'after_setup_theme', 'genesis_custom_remove_widget_areas' );
function genesis_custom_remove_widget_areas(){

	// Header right widget area.
	unregister_sidebar( 'header-right' );

	// Primary sidebar.
	unregister_sidebar( 'sidebar' );

	// Secondary sidebar.
	unregister_sidebar( 'sidebar-alt' );
}

//* Force full-width-content layout setting.
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove site layouts.
add_action( 'after_setup_theme', 'genesis_custom_remove_theme_layouts' );
function genesis_custom_remove_theme_layouts(){

	genesis_unregister_layout( 'content-sidebar' );
	genesis_unregister_layout( 'sidebar-content' );
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );
}

//* Remove Genesis page templates.
add_filter( 'theme_page_templates', 'genesis_custom_remove_page_templates' );
function genesis_custom_remove_page_templates( $page_templates ) {

	unset( $page_templates[ 'page_archive.php' ] );
	unset( $page_templates[ 'page_blog.php' ] );

	return $page_templates;
}