<?php
/*
Plugin Name:Una Sailing Class Example
*/


/* Note there is an issue with permalinks not working after the plugin is activated.
You can fix this by visiting the permalink page which flushes the rewrite rules
*/
 
 /*
* Creating a function to create our Sailing Class custom post type
*/

// function unasailingclass_custom_post_type() {

// // Set UI labels for Custom Post Type
	// $labels = array(
		// 'name'                => _x( 'Sailing Class', 'Post Type General Name', 'twentyseventeen-child' ),
		// 'singular_name'       => _x( 'Sailing Class', 'Post Type Singular Name', 'twentyseventeen-child' ),
		// 'menu_name'           => __( 'Sailing Classes', 'twentyseventeen-child' ),
		// 'parent_item_colon'   => __( 'Parent Sailing Class', 'twentyseventeen-child' ),
		// 'all_items'           => __( 'All Sailing Classes', 'twentyseventeen-child' ),
		// 'view_item'           => __( 'View Sailing Class', 'twentyseventeen-child' ),
		// 'add_new_item'        => __( 'Add New Sailing Class', 'twentyseventeen-child' ),
		// 'add_new'             => __( 'Add New', 'twentyseventeen-child' ),
		// 'edit_item'           => __( 'Edit Sailing Class', 'twentyseventeen-child' ),
		// 'update_item'         => __( 'Update Sailing Class', 'twentyseventeen-child' ),
		// 'search_items'        => __( 'Search Sailing Class', 'twentyseventeen-child' ),
		// 'not_found'           => __( 'Not Found', 'twentyseventeen-child' ),
		// 'not_found_in_trash'  => __( 'Not found in Trash', 'twentyseventeen-child' ),
	// );
	
// // Set other options for Custom Post Type
	
	// $args = array(
		// 'label'               => __( 'films', 'twentyseventeen-child' ),
		// 'description'         => __( 'Sailing Class news and reviews', 'twentyseventeen-child' ),
		// 'labels'              => $labels,
		// // Features this CPT supports in Post Editor
		// 'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),

		// /* A hierarchical CPT is like Pages and can have
		// * Parent and child items. A non-hierarchical CPT
		// * is like Posts.
		// */	
		// 'hierarchical'        => false,
		// 'public'              => true,
		// 'show_ui'             => true,
		// 'show_in_menu'        => true,
		// 'show_in_nav_menus'   => true,
		// 'show_in_admin_bar'   => true,
		// 'menu_position'       => 5,
		// 'can_export'          => true,
		// 'has_archive'         => true,
		// 'exclude_from_search' => false,
		// 'publicly_queryable'  => true,
		// 'capability_type'     => 'page',
	// );
	
	// // Registering your Custom Post Type
	// register_post_type( 'sailingclass', $args );

// }

// /* Hook into the 'init' action so that the function
// * Containing our post type registration is not 
// * unnecessarily executed. 
// */

// add_action( 'init', 'unasailingclass_custom_post_type', 0 );

 
 
 
 
 
// use widgets_init Action hook to execute custom function
add_action( 'widgets_init', 'unawidgetsailingclass_register_widgets' );



 //register our widget
function unawidgetsailingclass_register_widgets() {

    register_widget( 'unawidgetfilms_widget' );
}

//The Class: Note this code is the same as 
class unawidgetsailingclass_widget extends WP_Widget {

    //process our new widget
    function __construct() {

        parent::__construct( 'unasailingclass_widget', 'Una\'s Sailing Class Widget' );

    }

    
    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div>'
    );

    //display our widget
    public function widget( $args, $instance ) {
        
 wp_reset_postdata();
 
        echo $args['before_widget'];

 
        echo '<div class="sailingclasswidget">';
		
		$queryArgs = array ('posts_per_page' => '5',
		                    'post_type' => 'films');
 
        $mySailingClasss = new WP_Query ($queryArgs);
		
		while ($mySailingClasses->have_posts()): $mySailingClass-->the_post();
		?>
		<a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a><br/>
		<?php 
		endwhile;
		
		wp_reset_postdata();
		
 
        echo '</div>';
 
        echo $args['after_widget'];
 
    }

    //the form which is used for setting options - no options at the moment

        public function form( $instance ) {
 
        
 
    }

    // the function for updating options: No options - but could change this.

        public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
       
        return $instance;
    }
}
