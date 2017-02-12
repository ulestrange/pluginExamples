<?php
/*
Plugin Name: My_Plugin
*/
 

add_action( 'admin_menu', 'my_plugin_menu' );


function my_plugin_menu() {
	// add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier',
	//  'my_plugin_options' );

	add_menu_page( 'My Plugin Page', 'My Plugin', 'manage_options', 'my_plugin_main_menu', 'my_plugin_options' );

	 add_action( 'admin_init', 'my_plugin_register_settings' );
}

function my_plugin_register_settings() {

    //register our settings
    register_setting( 'my_plugin-settings-group', 'my_plugin_options', 'my_plugin_sanitize_options' );

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
	   echo "My plugin options are $my_plugin_options";
	   print_r ($my_plugin_options); 
	   ?> 
    

		<table class="form-table">
			<tr valign="top">
			<th scope="row">String to Replace</th>
			<td><input type="text" name="my_plugin_options[option_one]" value="<?php echo esc_attr( $my_plugin_options['option_one'] ); ?>" /></td>
			</tr>

			<tr valign="top">
			<th scope="row">Replace with</th>
			<td><input type="text" name="my_plugin_options[option_two]" value="<?php echo esc_attr( $my_plugin_options['option_two'] ); ?>" /></td>
			</tr>
		</table>

		<p class="submit">
			<input type="submit" class="button-primary"	value="Save Changes" />
		</p>

	</form>
	</div>
	<?php
}

