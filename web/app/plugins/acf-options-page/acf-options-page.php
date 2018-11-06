<?php
/*
Plugin Name: Advanced Custom Fields: Options Page
Plugin Slug: acf-options-page
Plugin URI: http://www.advancedcustomfields.com/
Description: This premium Add-on creates a static menu item for the Advanced Custom Fields plugin
Version: 2.1.0
Author: Elliot Condon
Author URI: http://www.elliotcondon.com/
License: GPL
Copyright: Elliot Condon
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists('acf_plugin_options_page') ):

class acf_plugin_options_page {
	
	// vars
	var $settings;
	
	
	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct() {
		
		// vars
		$this->settings = array(
			
			// basic
			'name'				=> __('Advanced Custom Fields: Options Page', 'acf'),
			'version'			=> '2.1.0',
						
			// urls
			'slug'				=> dirname(plugin_basename( __FILE__ )),
			'basename'			=> plugin_basename( __FILE__ ),
			'path'				=> plugin_dir_path( __FILE__ ),
			'dir'				=> plugin_dir_url( __FILE__ ),
			
		);
		
		
		// include
		$this->include_file('includes/options-page.php');
		
		
		// add default options page
		acf_add_options_page();
		
		
		// include v5 field
		add_action('acf/include_field_types', array($this, 'include_field_types'));
		
		
		// include v4 field
		add_action('acf/register_fields', array($this, 'register_fields'));
		

		// include updates
		if( is_admin() ) {
			
			$this->include_file('acf-options-page-update.php');
			
		}
		
	}
	
	
	/*
	*  include_file
	*
	*  This function will check if a file exists before including it
	*
	*  @type	function
	*  @date	22/2/17
	*  @since	5.5.8
	*
	*  @param	$file (string)
	*  @return	n/a
	*/
	
	function include_file( $file = '' ) {
		
		$file = dirname(__FILE__) . '/'. $file;
		
		if( file_exists($file) ) include_once( $file );
		
	}
	
	
	/*
	*  include_field_types
	*
	*  This function will include the v5 field type
	*
	*  @type	function
	*  @date	12/06/2015
	*  @since	5.2.3
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function include_field_types() {
		
		// bail ealry if already installed
		if( class_exists('acf_admin_options_page') ) return;
		
		
		// check admin
		if( is_admin() ) {
			
			$this->include_file('includes/admin/admin-options-page.php');
			$this->include_file('includes/admin/admin-options-page-5.php');
			
		}
		
	}
	
	
	/*
	*  register_fields
	*
	*  This function will include the v4 field type
	*
	*  @type	function
	*  @date	12/06/2015
	*  @since	5.2.3
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function register_fields() {
		
		// bail ealry if already installed
		if( class_exists('acf_admin_options_page') ) return;
		
		
		// check admin
		if( is_admin() ) {
			
			$this->include_file('includes/admin/admin-options-page.php');
			$this->include_file('includes/admin/admin-options-page-4.php');
			
		}
		
	}
	
}


// globals
global $acf_plugin_options_page;


// instantiate
$acf_plugin_options_page = new acf_plugin_options_page();


// end class
endif;

?>