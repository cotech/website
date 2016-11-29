<?php
/*
Plugin Name: Advanced Custom Fields: Flexible Content Field
Plugin URI: http://www.advancedcustomfields.com/
Description: This premium Add-on adds a flexible content field type for the Advanced Custom Fields plugin
Version: 1.1.1
Author: Elliot Condon
Author URI: http://www.elliotcondon.com/
License: GPL
Copyright: Elliot Condon
*/

// only include add-on once
if( !function_exists('acf_register_flexible_content_field') ):


// add action to include field
add_action('acf/register_fields', 'acf_register_flexible_content_field');

function acf_register_flexible_content_field()
{
	include_once('flexible-content.php');
}


/*
*  Update
*
*  if update file exists, allow this add-on to connect and recieve updates.
*  all ACF premium Add-ons which are distributed within a plugin or theme, must have the update file removed.
*
*  @type	file
*  @date	13/07/13
*
*  @param	N/A
*  @return	N/A
*/

if( is_admin() && file_exists(  dirname( __FILE__ ) . '/acf-flexible-content-update.php' ) )
{
	include_once( dirname( __FILE__ ) . '/acf-flexible-content-update.php' );
}

endif; // class_exists check

?>
