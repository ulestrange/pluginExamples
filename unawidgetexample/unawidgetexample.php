
<?php
/*
Plugin Name:Una Widgets Examples
Description: This plugin adds two widgets which the user can use they are very simple
*/


 
// use widgets_init Action hook to execute custom function
add_action( 'widgets_init', 'una_widgetexample_register_widgets' );


include "widget1.php";
include "widget2.php";

 //register our widget
function una_widgetexample_register_widgets() {
    register_widget( 'widget1_widget' );
    register_widget( 'widget2_widget' );
}