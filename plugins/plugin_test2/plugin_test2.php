<?php
/*
Plugin Name: Plugin_Test2
*/
 
add_shortcode ('itsligoweb', 'test2_itsligoweb');
 
 
function test2_itsligoweb()
{	
	return '<a href="http://itsligo.ie"> IT Sligo Home Page </a>';
}


