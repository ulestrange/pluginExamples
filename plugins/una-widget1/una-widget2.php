<?php
//The Class: Note this code is the same as 
class unawidget2_widget extends WP_Widget {

    //process our new widget
    function __construct() {
        parent::__construct( 'unawidget2_widget', 'Bare Minimum' );
    }
  
    public $args = array(
        'before_widget' => '<div class="widget-wrap">', // not quite minimum
        'after_widget'  => '</div></div>'
    );

    //display our widget
    public function widget( $args, $instance ) {       
        echo $args['before_widget'];
        echo "<h5>Hello World: Here I am</h5>";
        echo $args['after_widget'];
    }

    //the form which is used for setting options.

        public function form( $instance ) {			
    }

    // the function for updating options: The API does all the work :)

        public function update( $new_instance, $old_instance ) {        
        return $instance;
    }
}
