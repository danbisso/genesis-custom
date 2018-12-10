<?php
/**
 * Genesis Custom.
 *
 * This file adds functions to the Genesis Custom Theme.
 *
 * @package Genesis Custom
 * @author  Daniel Bissinger
 * @license GPL-2.0+
 * @link    https://danielbissinger.com/
 */


/**********************

INCLUDES

**********************/

//* Load Genesis Framework
require_once get_template_directory() . '/lib/init.php';

//* Load theme functions
require_once get_stylesheet_directory() . '/lib/cleanup.php';
require_once get_stylesheet_directory() . '/lib/functionality.php';


/**********************

WORDPRESS

**********************/

//* Setup localization
add_action( 'after_setup_theme', 'genesis_custom_localization_setup', 9 );// Prio 9 so textdomain loads before genesis functions
function genesis_custom_localization_setup() {

	load_child_theme_textdomain( 'genesis-custom', get_stylesheet_directory() . '/languages' );
}

//* Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 702; // Pixels.
}

//* Add support for HTML5 markup structure.
add_theme_support(
	'html5', array(
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
	)
);

//* Add custom logo in Customizer > Site Identity.
add_theme_support(
	'custom-logo', array(
		'flex-width'  => true,
		'flex-height' => true,
	)
);

//* Add WP 5.0 alignwide and alignfull support
add_theme_support( 'align-wide' );



add_filter( 'upload_mimes', 'genesis_custom_svg_support' );
function genesis_custom_svg_support($mimes) {

	if( current_user_can( 'manage_options' ) ) {

		$mimes['svg'] = 'image/svg+xml';
	}
	
	return $mimes;
}


/**********************

GENESIS

**********************/

//* Add viewport meta tag for mobile browsers.
add_theme_support(
	'genesis-responsive-viewport'
);

//* Add support for accessibility features.
add_theme_support(
	'genesis-accessibility', array(
		'404-page',
		// 'drop-down-menu',// This enqueues hoverIntent/superFish
		'headings',
		'search-form',
		'skip-links',
	)
);

//* Add support for structural wraps.
add_theme_support( 
	'genesis-structural-wraps', array( 
		'header',
		// 'menu-primary',
		// 'menu-secondary',
		// 'footer-widgets',
		'footer' 
	)
);


/**********************

GENERAL

**********************/

//* Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_custom_add_google_fonts' );
function genesis_custom_add_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Fira+Sans:400');
}


/**********************

HEADER

**********************/

//* Display the custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

//* Add responsive menu script.
add_action( 'wp_enqueue_scripts', 'genesis_custom_add_menu_script' );
function genesis_custom_add_menu_script() {

	wp_enqueue_script(
		'genesis-custom-menu',
		get_stylesheet_directory_uri() . "/js/menu.js",
		array(),
		false,
		true
	);
}

//* Rename primary and remove secondary navigation menu.
add_action( 'after_setup_theme', 'genesis_custom_menus', 9 );// Prio 9 so it runs before genesis registers menus
function genesis_custom_menus() {

	add_theme_support(
		'genesis-menus', array(
			'primary'   => __( 'Main Menu', 'genesis-custom' ),
		)
	);
}

//* Force primary navigation to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_custom_primary_menu_depth' );
function genesis_custom_primary_menu_depth( $args ) {

	if ( 'primary' !== $args['theme_location'] ) {

		return $args;
	}

	$args['depth'] = 1;

	return $args;
}

//* Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Add toggle button markup to primary navigation menu.
add_filter( 'genesis_markup_nav-primary_open', 'genesis_custom_menu_add_toggle', 10, 2 );
function genesis_custom_menu_add_toggle( $open, $args ) {

	ob_start();
	?>

	<button 
		class="menu-toggle" 
		id="nav-primary-toggle"
		aria-hidden="true">

		<span class="menu-toggle-box">
			<span class="menu-toggle-inner">
			</span>
		</span>

	</button>

	<?php
	return $open.ob_get_clean();
}

//* Force 'primary-menu' element id.
add_filter( 'wp_nav_menu_args', 'fun' );
function fun( $args ) {
	

	if( $args[ 'theme_location' ] == 'primary' ) {

		$args[ 'menu_id' ] = 'primary-menu';
	}

	return $args;
}

// add_filter( 'wp_nav_menu_args', 'genesis_custom_primary_menu_add_toggle' );
// function genesis_custom_primary_menu_add_toggle( $args ) {

// 	var_dump($args);
// 	return $args;
// }

/**********************

FOOTER

**********************/

//* Add footer widget areas
// add_theme_support( 'genesis-footer-widgets', 3 );

// //* Override footer creds text
// add_filter( 'genesis_footer_creds_text', 'genesis_custom_footer_creds' );
// function genesis_custom_footer_creds( $creds ) {	

// 	return $creds;
// }










