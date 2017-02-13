<?php
/*
Plugin Name: My_Plugin
*/
 

add_action( 'admin_menu', 'my_plugin_menu' );


function my_plugin_menu() {
  
    // This has two different places to find the menu
	// the first is commented out.


	// below adds another menu item at the bottom of the settings sub-menu
	add_options_page( 'My Plugin Options', 'My Plugin', 
	'manage_options', 'my-unique-identifier',
	'my_plugin_options' );

    //  below adds a menu item to the dashboard.
	add_menu_page( 'My Plugin Page', 'My Plugin', 
	'manage_options', 'my_plugin_main_menu', 
	'my_plugin_options' );


	 add_action( 'admin_init', 'my_plugin_register_settings' );
}

function my_plugin_register_settings() {

    //register our settings
    register_setting( 'my_plugin-settings-group', 
'my_plugin_options', 'my_plugin_sanitize_options' );

}

function my_plugin_sanitize_options($input)
{
	$input['option_one']  = sanitize_text_field( $input['option_one'] );
    $input['option_two'] = sanitize_text_field( $input['option_two'] );

    return $input;
}



function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
	<div class="wrap">
	   <h1> Setting Options for My_Plugin Page
	   <form method="post" action="options.php">
	   	   
	   <?php 
	   settings_fields( 'my_plugin-settings-group' ); 
	   $my_plugin_options = get_option("my_plugin_options");
	   ?> 
		<table class="form-table">
			<tr valign="top">
			<th scope="row"><label for="option_one"> String to Replace </label></th>
			<td><input type="text"id="option_one" name="my_plugin_options[option_one]"
			value="<?php echo esc_attr( $my_plugin_options['option_one'] ); ?>" /></td>
			</tr>

			<tr valign="top">
			<th scope="row"><label for="option_two"> Replace with<label /></th>
			<td><input type="text" id="option_two" name="my_plugin_options[option_two]"
			value="<?php echo esc_attr($my_plugin_options['option_two']) ?>" /></td>
			</tr>
		</table>

		<p class="submit">
			<input type="submit" class="button-primary"	value="Save Changes" />
		</p>
	</form>
	</div>
	<?php
}


function my_plugin_changecontent ($text)
{
	
	$my_plugin_options= get_option('my_plugin_options');
	echo ("options are");
	print_r($my_plugin_options);

    $text = str_ireplace($my_plugin_options["option_one"], $my_plugin_options["option_two"], $text);
	

	
	return $text;
	
}

add_filter ('the_content', 'my_plugin_changecontent');
