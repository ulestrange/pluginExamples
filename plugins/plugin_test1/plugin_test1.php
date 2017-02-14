<?php
/*
Plugin Name: Plugin_Test1
*/
 


/*The function below creates a menu which sits under settings.
if you run this and click on the menu you will get an eror because
the function test1_main_plugin_page does not exist yet */

function test1_create_menu()
{	
	//create new top level menu
add_menu_page ("test1 plugin page","test1 plugin",'manage_options',
'test1_main_menu','test1_main_plugin_page');
 
}

// function test1_register_settings()
// {
// 	// register the settings for the plugin
	
// 	register_setting('test1-settings-group', 'test1_options'),
// 	'test1_sanitize_options');
// }



// }
	

// update_option ('test1_options', $test1_options_array);

function test1_changecontent ($text)
{
	
	$test1_options= get_option('test1_mode1');

	if ($test1_options == 'on'){
        $text = str_ireplace("WordPress", "PressWord", $text);
		update_option ('test1_mode1', 'off');
	}
	else {
		update_option ('test1_mode1', 'on');
	}
	
	return $text;
	
}

add_filter ('the_content', 'test1_changecontent');

// this uses an action hook to create the menu it is triggered
// after the basic admin menu structure is is place.

add_action ('admin_menu', 'test1_create_menu');

// add_action ('admin_menu', 'test1_create_settings_submenu');

// function test1_create_settings_submenu()
// {
	// add_options_page ('Test1 Settings Page', 'Test1 Settings',
	// 'manage_options', 'test1_settings_menu', 'test1_settings_page');
// }

// function prowp_register_settings() {

//     //register our settings
//     register_setting( 'prowp-settings-group', 'prowp_options', 'prowp_sanitize_options' );

// }

// function prowp_sanitize_options( $input ) {

//     $input['option_name']  = sanitize_text_field( $input['option_name'] );
//     $input['option_email'] = sanitize_email( $input['option_email'] );
//     $input['option_url']   = esc_url( $input['option_url'] );

//     return $input;

// }

function test1_main_plugin_page ()
{
	echo "<h1> This is where my menu will be </h1>";
}
