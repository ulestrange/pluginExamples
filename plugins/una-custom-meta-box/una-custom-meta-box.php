<?php
/*
Plugin Name: Una's' Custom Meta Box Plugin
Plugin URI: Adapted from http://strangework.com/wordpress-plugins
Description: This is a plugin demonstrating meta boxes in WordPress
Version: 1.0
Author: Una adapted from Brad Williams
License: GPLv2
*/

add_action( 'add_meta_boxes', 'una_meta_box_init' );

// meta box functions for adding the meta box and saving the data
function una_meta_box_init() {

    // create our custom meta box
    add_meta_box( 'una-meta', 'Una\'s Meta Information', 'una_meta_box', 'post', 'side', 'default' );

}

function una_meta_box( $post, $box ) {

    // retrieve the custom meta box values
    $una_featured = get_post_meta( $post->ID, '_una_colour', true );
    $una_class = get_post_meta( $post->ID, '_una_class', true );

    //nonce for security
    wp_nonce_field( plugin_basename( __FILE__ ), 'una_save_meta_box' );

    // custom meta box form elements
    echo '<label for="una_class">Custom class: 
    <input type="text" id="una_class" name="una_class" value="'.esc_attr( $una_class ).'" class="5" /></label>';
    echo '<label for="una_color">Colour:
        <select name="una_product_colour" id="una_product_colour" id="una_color">
            <option value="yellow" ' .selected( $una_featured, 'yellow', false ). '>Yellow</option>
            <option value="red" ' .selected( $una_featured, 'red', false ). '>Red</option>
            <option value="orange" ' .selected( $una_featured, 'orange', false ). '>Orange</option>
            <option value="blue" ' .selected( $una_featured, 'blue', false ). '>Blue</option>
        </select></label>';

}

// hook to save our meta box data when the post is saved
add_action( 'save_post', 'una_save_meta_box' );

function una_save_meta_box( $post_id ) {

    // process form data if $_POST is set
    if( isset( $_POST['una_product_colour'] ) ) {

		// if auto saving skip saving our meta box data
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		//check nonce for security
		wp_verify_nonce( plugin_basename( __FILE__ ), 'una_save_meta_box' );

        // save the meta box data as post meta using the post ID as a unique prefix
        update_post_meta( $post_id, '_una_colour', sanitize_text_field( $_POST['una_product_colour'] ) );
        update_post_meta( $post_id, '_una_class', sanitize_text_field( $_POST['una_class'] ) );

    }

}

// this code uses the custom class meta-data

add_filter( 'post_class', 'una_custom_meta_post_class' );

function una_custom_meta_post_class( $classes ) {

  /* Get the current post ID. */
  $post_id = get_the_ID();

  /* If we have a post ID, proceed. */
  if ( !empty( $post_id ) ) {

    /* Get the custom post class. */
    $post_class = get_post_meta( $post_id, '_una_class', true );
  

    /* If a post class was input, sanitize it and add it to the post class array. */
    if ( !empty( $post_class ) )
      $classes[] = sanitize_html_class( $post_class );
  }

  return $classes;
}




