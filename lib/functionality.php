<?php

/* All these are good candidates for a separate functionality plugin. */



/**********************

WORDPRESS

**********************/

//* change tinymce's paste-as-text functionality
add_filter( 'tiny_mce_before_init', 'genesis_custom_change_paste_as_text', 10, 2 );
function genesis_custom_change_paste_as_text( $mceInit, $editor_id ){
	
	//turn on paste_as_text by default
	//this has no effect on the browser's right-click context menu's paste!
	$mceInit['paste_as_text'] = true;
	
	return $mceInit;
}



/**********************

RESPONSIVE LIGHTBOX

**********************/

//* Remove lightbox script.
global $responsive_lightbox;
remove_action( 'wp_enqueue_scripts', array( $responsive_lightbox, 'front_scripts_styles' ) );


/**********************

ACF

**********************/

//* Register ACF field groups.
add_action( 'acf/init', 'genesis_custom_register_acf_field_groups' );
function genesis_custom_register_acf_field_groups() {

	foreach ( glob( get_stylesheet_directory() . '/acf-field-groups/*.php' ) as $file ) {

	    require_once $file;
	}
}

//* Register simple acf wysiwyg toolbar.
add_filter( 'acf/fields/wysiwyg/toolbars' , 'genesis_custom_acf_wysiwyg_toolbars'  );
function genesis_custom_acf_wysiwyg_toolbars( $toolbars ) {

	// Add a new toolbar called "Very Simple"
	// - this toolbar has only 1 row of buttons
	$toolbars['simple' ] = array();
	$toolbars['simple' ][1] = array( 'bold' , 'bullist' , 'numlist' );

	return $toolbars;
}


/**********************

END-USER ADMIN CLEANUP & RESTRICTIONS

**********************/

add_action( 'init', 'genesis_custom_customize_user_admin' );
function genesis_custom_customize_user_admin() {

    if ( !current_user_can( 'administrator' ) ) {// Non admins

        // Remove admin menus.
        add_action( 'admin_menu', 'genesis_custom_remove_admin_menu_items', 999 );//999 prio for jetpack

        // Remove admin bar.
        add_action( 'wp_before_admin_bar_render', 'genesis_custom_remove_admin_bar_items' );

        // Remove metaboxes.
        add_action( 'do_meta_boxes', 'genesis_custom_remove_metaboxes' );

        // Hide add new page button.
        add_action( 'admin_head', 'genesis_custom_hide_new_page_button' );

        // Remove default content editor for Pages
        add_action( 'admin_init', 'genesis_custom_remove_page_editor' );

        // Redirect to pages
        add_filter( 'login_redirect', 'genesis_custom_redirect_to_pages' );   

        // Redirect from dashboard to pages
        add_action( 'load-index.php', 'genesis_custom_redirect_dashboard_to_pages' );

        // Remove Quick edit from pages (hierarchical, otherwise use post_row_actions filter)
        add_filter( 'page_row_actions', 'genesis_custom_remove_quick_edit', 10, 2);
    }
}

//* move yoast metabox to bottom
add_filter( 'wpseo_metabox_prio', 'genesis_custom_move_yoast_to_bottom');
function genesis_custom_move_yoast_to_bottom() {
	return 'low';
}


//* Remove Quick edit from pages
function genesis_custom_remove_quick_edit( $actions, $post ){

    if( $post->post_type == 'page' ) {
        
        unset( $actions['inline hide-if-no-js'] );
    }
    return $actions;
}

//* Hide add new page button
function genesis_custom_hide_new_page_button() {
	global $current_screen;

	if( $current_screen->id == 'edit-page' || $current_screen->id == 'page' ) {
		echo '<style>.page-title-action{display: none;}</style>';  
	}
}

//* Cleanup admin menu
function genesis_custom_remove_admin_menu_items() {

    //Admin menus
    remove_menu_page( 'tools.php' );
    remove_menu_page( 'wpcf7' );
    remove_menu_page( 'jetpack' );
    remove_menu_page( 'index.php' ); //dashboard

    // if the user doesn't have edit_posts cap then the pages admin screen crashes
    // wp-admin/includes/menu  around line 177. When a menu has only 1 submenu item, and that submenu item is the same link as the parent, that submenu removed. 
    // Since there's no submenu, the get_admin_page_parent() fails, and user_can_access_admin_page() instead checks the _wp_menu_nopriv global array, which stores pages with no access for the current user. somehow edit.php for pages is being added as a nopriv back in 
    // wp-admin/includes/menu. 
    // Workaround: do another subitem (general settings page);
    remove_submenu_page( 'edit.php?post_type=page', 'post-new.php?post_type=page' );
}

//* Cleanup Admin bar 
function genesis_custom_remove_admin_bar_items() {
    
    global $wp_admin_bar;
    $wp_admin_bar->remove_node( 'new-page' );
}

//* Cleanup Metaboxes 
function genesis_custom_remove_metaboxes() {

	//Page Edit screen 
	remove_meta_box( 'pageparentdiv' , 'page' , 'side' ); 
	remove_meta_box( 'postimagediv' , 'page' , 'side' ); 
	remove_meta_box( 'genesis_inpost_seo_box' , 'page' , 'normal' ); 
    remove_meta_box( 'genesis_inpost_layout_box' , 'page' , 'normal' ); 
    remove_meta_box( 'trackbacksdiv' , 'page' , 'normal' ); 
    remove_meta_box( 'postcustom' , 'page' , 'normal' ); 
    remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' ); 
    remove_meta_box( 'commentsdiv' , 'page' , 'normal' ); 
    remove_meta_box( 'authordiv' , 'page' , 'normal' ); 
    remove_meta_box( 'slugdiv' , 'page' , 'normal' ); 
    remove_meta_box( 'sharing_meta' , 'page' , 'advanced' ); 
}

//* Remove content editor from pages
function genesis_custom_remove_page_editor() {

    remove_post_type_support( 'page', 'editor' );
}


// Redirect to pages on login
function genesis_custom_redirect_to_pages( $url ) {
	
    return admin_url( 'edit.php?post_type=page' );
}

// Redirect from dashboard to pages
function genesis_custom_redirect_dashboard_to_pages() {
    
    $qs = empty($_GET) ? '' : '?'.http_build_query($_GET);
    wp_safe_redirect(admin_url( 'edit.php?post_type=page' ).$qs);
    exit;
}



