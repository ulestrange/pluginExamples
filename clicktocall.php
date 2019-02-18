<?php
/**
 * @package Click_to_Call
 * @version 1.0
 */
/*
Plugin Name: Click to Call
Plugin URI: http://wordpress.org/plugins/click_to_call/
Description: This plug has an option to take a number of digits. It will then search for that number
of digits and replace them with a clickable phone number. For example in Ireland mobile phone numbers are 10 digits.$_COOKI
Author: Una L'Estrange
Version: 1.1
Author URI: ...
*/
function click_to_call ($text)
{
	
	$num_digits = (int) get_option('click_to_call_number_length');

  if ($num_digits >0)
  {

	// the pattern matches any 10 digit number
	$pattern = '/([0-9]{' . $num_digits .'})/';
	
	$replacement = '<a href ="tel:$1"> $1  </a>';
	
	$text = preg_replace($pattern, $replacement, $text);
	
	return $text ;
  }

  return $text;

	
}
add_filter ('the_content', 'click_to_call');


// This is to set up the settings
function click_to_call_register_settings() {
   add_option( 'click_to_call_number_length', '10');
   register_setting( 'click_to_call_options_group', 'click_to_call_number_length', 
   'click_to_call_callback' );
}
add_action( 'admin_init', 'click_to_call_register_settings' );

function click_to_call_register_options_page() {
  add_options_page('Page Title', 'Click_to_call Menu', 'manage_options', 'click_to_call', 'click_to_call_options_page');
}
add_action('admin_menu', 'click_to_call_register_options_page');

function click_to_call_options_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <h2>Clock to Call Options</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'click_to_call_options_group' ); ?>
  <h3>How Many Digits is a Phone Number</h3>
  <p>This plugin will replace a string of digits with a href:tel.</p>
  <p>You can set how long you want this string to be </p>
  <table>
  <tr valign="top">
  <th scope="row"><label for="click_to_call_number_length">How many digits</label></th>
  <td><input type="number" id="click_to_call_number_length" name="click_to_call_number_length" 
  value="<?php echo esc_attr(get_option('click_to_call_number_length')); ?>" /></td>
  </tr>
  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php
} ?>