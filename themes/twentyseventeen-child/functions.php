<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

/*
* Creating a function to create our Films custom post type
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Films', 'Post Type General Name', 'twentyseventeen-child' ),
		'singular_name'       => _x( 'Film', 'Post Type Singular Name', 'twentyseventeen-child' ),
		'menu_name'           => __( 'Films', 'twentyseventeen-child' ),
		'parent_item_colon'   => __( 'Parent Film', 'twentyseventeen-child' ),
		'all_items'           => __( 'All Films', 'twentyseventeen-child' ),
		'view_item'           => __( 'View Film', 'twentyseventeen-child' ),
		'add_new_item'        => __( 'Add New Film', 'twentyseventeen-child' ),
		'add_new'             => __( 'Add New', 'twentyseventeen-child' ),
		'edit_item'           => __( 'Edit Film', 'twentyseventeen-child' ),
		'update_item'         => __( 'Update Film', 'twentyseventeen-child' ),
		'search_items'        => __( 'Search Film', 'twentyseventeen-child' ),
		'not_found'           => __( 'Not Found', 'twentyseventeen-child' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentyseventeen-child' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'films', 'twentyseventeen-child' ),
		'description'         => __( 'Film news and reviews', 'twentyseventeen-child' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'films', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type', 0 );
