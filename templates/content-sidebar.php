<?php
/**
 *
 * Template Name: Content-Sidebar
 * Template Post Type: page
 * 
 */

//* Force full-width-content layout setting.
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

genesis();
