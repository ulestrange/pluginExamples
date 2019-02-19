<?php
/*
Plugin Name: Web ShortCodes
*/
 
add_action ('init', 'web_shortcodes_init');
function web_shortcodes_init()
{
 add_shortcode ('itsligoweb', 'web_shortcodes_itsligoweb');
  add_shortcode ('deptweb', 'web_shortcodes_deptweb');
}

// takes a short code with or without content and outputs 
// a anchor element pointing the itsligo web site.


function web_shortcodes_itsligoweb($atts, $content = null)
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
 
function web_shortcodes_deptweb($atts, $content = null)
{	

   $atts= array_change_key_case((array)$atts, CASE_LOWER);
	
	extract (shortcode_atts(array ('staff' => 'none'), $atts) );
	
	if ($staff == 'none') {
	return '<a href="http://itsligo.ie"> General Dept Home Page </a>';
	}
	elseif ($staff == 'una') {
		return '<a href="http://itsligo.ie/staff/ulestrange">
		Una\'s Web Site </a>';
	}
	elseif ($staff == 'alan')
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
