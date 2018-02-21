<?php
/**
 * @package Click_to_Call
 * @version 1.0
 */
/*
Plugin Name: Click to Call
Plugin URI: http://wordpress.org/plugins/click_to_call/
Description: This plug in will make any 10 digit number into a callable link
Author: Una L'Estrange
Version: 1.0
Author URI: ...
*/

function click_to_call ($text)
{
	$text = $text . "Hello it is me";
	
	return $text;
	
}

add_filter ('the_content', 'click_to_call');