<?php
/*
Plugin Name: Plugin_Test2
*/
 
add_action ('init', 'test2_shortcodes_init');

function test2_shortcodes_init()
{
 add_shortcode ('itsligoweb', 'test2_itsligoweb');

  add_shortcode ('deptweb', 'test2_deptweb');

}

function test2_itsligoweb($atts, $content = null)
{
	if ($content == null){
		return '<a href=https://www.itsligo.ie/about-it-sligo/about-it-sligo/>
            About IT Sligo </a>';
	}
	else{
		$content = esc_html($content);
		return "<a href=https://www.itsligo.ie/about-it-sligo/about-it-sligo/>  $content </a>";
	}

}


 


function test2_deptweb($atts, $content = null)
{	
   $atts= array_change_key_case((array)$atts, CASE_LOWER);
	
	extract (shortcode_atts(array ('staff' => 'none'), $atts) );
	
	if ($staff == 'none') {
	return '<a href="http://itsligo.ie"> General Dept Home Page </a>';
	}
	elseif ($staff == 'Una') {
		return '<a href="http://itsligo.ie/staff/ulestrange">
		Una\'s Web Site </a>';
	}
	elseif ($staff == 'Alan')
	{
		return '<a href="http://itsligo.ie/staff/akelly"> 
		Alan\'s Web Site </a>';
	}
	else
	{
		return "<a href=https://www.itsligo.ie/about-it-sligo/about-it-sligo/>
	   Default About IT Sligo </a>";
	}
}


