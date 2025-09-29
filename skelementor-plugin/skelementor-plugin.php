<?php
/**
 * @package SkelementorPlugin
 */

/*
Plugin Name: Skelementor Plugin
Plugin URI: http://skelementor.com
Description: First Custom Plugin for Skelementor.
Version: 1.0.0
Author: Rajin Khan
Author URI: https://rajinkhan.com
License: GPLv2 or later
Text Domain: skelementor-plugin
*/  

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
Copyright 2005-2015 Automattic, Inc.
*/

defined('ABSPATH') or die('You shall not pass!');

if (!class_exists('SkelementorPlugin')) { //making sure class isn't duplicated

    class SkelementorPlugin {

        public $plugin; //the var for dynamically holding the name of the plugin

        function __construct() {
            $this -> plugin = plugin_basename(__FILE__); //this grabs the name of the file dynamically
        }

        function register() { //we define the things to do once the plugin activates because this is what's called initially whenever the class is created.
            add_action('admin_enqueue_scripts', array($this, 'enqueue'));
            add_action('admin_menu', array($this, 'add_admin_pages')); //creates the page in the sidebar

            add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
            //the first arg is plugin_action_link_NAME-OF-PLUGIN, and it should be dynamic, so that if the file name changes it adapts automatically, so we use plugin_basename(__FILE__), stored in $plugin var
            //now, in php, strings in single quotes can't use escape sequences or dynamically inject vars, but using double quotes, we can.
        }

        public function settings_link($links) {
            $settings_link = '<a href="admin.php?page=skelementor_plugin">Settings</a>'; //link to the page we want to be taken to
            array_push($links, $settings_link); //push it to the list of links under the plugin name in the menu
            return $links; //return the new list of links
        }

        public function add_admin_pages() {
            add_menu_page('Skelementor Plugin', 'Skelementor', 'manage_options', 'skelementor_plugin', array($this, 'admin_index'), 'dashicons-buddicons-topics', 110);
            //so you have the arguments: page title, menu title, capabilities, unique menu slug (always with '_', no '-'), ...
            //... callback function (what page needs to be created when this tab is clicked, maybe via a function), the icon url (include with plugins_url(__FILE__).'path', or by using the default icons included in wordpress for devs, called dashicons-nameoficon), ...
            //... and the position of the link in the sidebar, bottom means 110
        }

        public function admin_index() {
            require_once plugin_dir_path( __FILE__) . 'templates/admin.php'; //include the template file you wanna show when the plugin is clicked here
        }

        protected function create_post_type() {
            add_action('init', array($this, 'custom_post_type'));
        }

        function activate() {
            require_once plugin_dir_path( __FILE__) . 'inc/skelementor-plugin-activate.php';
            SkelementorPluginActivate::activate();
        }

        function custom_post_type() {
            register_post_type( 'book', ['public' => true, 'label' => 'Books']);
        }

        function enqueue() {
            wp_enqueue_style( 'mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
            wp_enqueue_script( 'mypluginscript', plugins_url('/assets/myscript.js', __FILE__));
        }
    }

    if ( class_exists('SkelementorPlugin')) {
        $skelementorPlugin = new SkelementorPlugin();
        $skelementorPlugin -> register();
    }

    //on activation
    register_activation_hook(__FILE__, array($skelementorPlugin, 'activate'));

    //on deactivation
    require_once plugin_dir_path( __FILE__).'inc/skelementor-plugin-deactivate.php';
    register_deactivation_hook(__FILE__, array('SkelementorPluginDeactivate', 'deactivate'));

}