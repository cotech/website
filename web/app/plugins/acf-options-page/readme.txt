=== Advanced Custom Fields: Options Page ===
Contributors: elliotcondon
Requires at least: 3.6.0
Tested up to: 4.9.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Global Options have never been so easy

== Description ==

= Global Options have never been so easy =

The “options page” add-on creates a new menu item called “Options” which can hold advanced custom field groups (just like any other edit page). You can also register multiple options pages

http://www.advancedcustomfields.com/add-ons/options-page/


== Installation ==

This software can be treated as both a WP plugin and a theme include.
However, only when activated as a plugin will updates be available/

= Plugin =
1. Copy the 'acf-options-page' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

= Include =
1. Copy the 'acf-options-page' folder into your theme folder (can use sub folders)
   * You can place the folder anywhere inside the 'wp-content' directory
2. Edit your functions.php file and add the following code to include the field:

`
include_once('acf-options-page/acf-options-page.php');

`

3. Make sure the path is correct to include the acf-options-page.php file
4. Remove the acf-options-page-update.php file from the folder.


== Changelog ==

= 2.1.0 =
* Added support for ACF version 5.7.0

= 2.0.1 =
* Minor fixes and improvements

= 2.0.0 =
* Added support for ACF version 5
* Added new settings to the acf_add_options_page() function https://www.advancedcustomfields.com/resources/acf_add_options_page/
* Added new acf_add_options_sub_page() function https://www.advancedcustomfields.com/resources/acf_add_options_sub_page/

= 1.2.0 =
* Added Polish translation - Thanks to matczar (http://support.advancedcustomfields.com/forums/users/matczar/)
* Added function acf_set_options_page_menu()
* Added new param 'menu' to the acf_add_options_sub_page function

= 1.1.0 =
* Big thank you to Edir Pedro (http://edirpedro.com.br) for his contribution to this version!
* Added function acf_add_options_sub_page()
* Added function acf_set_options_page_title()
* Added function acf_set_options_page_capability()
* Improved sub page functionality to allow for individual title, capability, parent and slug. This allows you to place the sub page onto any parent page in the wp-admin menu!
* Added lang folder including .pot file
* Added Portuguese translation - Thanks to Edir Pedro (http://edirpedro.com.br)

= 1.0.1 =
* wrapped the register_options_page function in an if statement to prevent error when activation this add-on with ACF v3

= 1.0.0 =
* [Updated] Updated update_field parameters
* Official Release

= 0.0.4 =
* [Updated] Update nonce name to 'acf_nonce' => 'input' to match naming convention

= 0.0.3 =
* [Updated] Drop support of old filters / actions

= 0.0.2 =
* Fixed errors caused by an update to the core functions.

= 0.0.1 =
* Initial Release.
