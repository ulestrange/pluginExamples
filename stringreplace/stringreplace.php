<?php
/*
Plugin Name: string_replace
*/
 
add_action( 'admin_menu', 'string_replace_menu' );
function string_replace_menu() {
  
    // This has two different places to find the menu
	// the first is commented out.
	// below adds another menu item at the bottom of the settings sub-menu
	add_options_page( 'String Replace Options', 'String Replace', 
	'manage_options', 'my-unique-identifier',
	'string_replace_options' );
    //  below adds a menu item to the dashboard.
	add_menu_page( 'String Replace Page', 'String Replace Plugin', 
	'manage_options', 'string_replace_main_menu', 
	'string_replace_options' );
	 add_action( 'admin_init', 'string_replace_register_settings' );
}
function string_replace_register_settings() {
    //register our settings
    register_setting( 'string_replace-settings-group', 
'string_replace_options', 'string_replace_sanitize_options' );
}
function string_replace_sanitize_options($input)
{
	$input['option_one']  = sanitize_text_field( $input['option_one'] );
    $input['option_two'] = sanitize_text_field( $input['option_two'] );
    return $input;
}
function string_replace_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
	<div class="wrap">
	   <h1> Setting Options for string_replace Page
	   <form method="post" action="options.php">
	   	   
	   <?php 
	   settings_fields( 'string_replace-settings-group' ); 
	   $string_replace_options = get_option("string_replace_options");
	   ?> 
		<table class="form-table">
			<tr valign="top">
			<th scope="row"><label for="option_one"> String to Replace </label></th>
			<td><input type="text"id="option_one" name="string_replace_options[option_one]"
			value="<?php echo esc_attr( $string_replace_options['option_one'] ); ?>" /></td>
			</tr>

			<tr valign="top">
			<th scope="row"><label for="option_two"> Replace with<label /></th>
			<td><input type="text" id="option_two" name="string_replace_options[option_two]"
			value="<?php esc_attr_e($string_replace_options['option_two']) ?>" /></td>
			</tr>
		</table>

		<p class="submit">
			<input type="submit" class="button-primary"	value="Save Changes" />
		</p>
	</form>
	</div>
	<?php
}
function string_replace_changecontent ($text)
{
	
	$string_replace_options= get_option('string_replace_options');
	

    $text = str_ireplace($string_replace_options["option_one"], $string_replace_options["option_two"], $text);
	
	
	return $text;
	
}
add_filter ('the_content', 'string_replace_changecontent');