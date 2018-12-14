<?php
/**
 *
 * Template Name: Hidden Title
 * Template Post Type: page
 * 
 */


add_filter( "genesis_attr_entry-header", 'genesis_custom_add_screen_reader_text_class', 10, 3 );
function genesis_custom_add_screen_reader_text_class( $attributes, $context, $args ) {

	$attributes['class'].= ' screen-reader-text';
	return $attributes;
}

genesis();
