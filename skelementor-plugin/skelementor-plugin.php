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

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) { //this helps us load the file but just checking for the require_once check just one time.
    require_once dirname(__FILE__) . '/vendor/autoload.php';

}

use Inc\Activate; //here, i'm using the namespace to refer to the activate class file, i don't have to manually take the trouble to include the file.
use Inc\Deactivate; //same as the activate class file
use Inc\Admin\AdminPages;
//use backward slash here instead of forward slash

if (!class_exists('SkelementorPlugin')) {

    class SkelementorPlugin {

        public $plugin;

        function __construct() {
            $this -> plugin = plugin_basename(__FILE__);
        }

        function register() {
            add_action('admin_enqueue_scripts', array($this, 'enqueue'));
            add_action('admin_menu', array($this, 'add_admin_pages'));
            add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
        }

        public function settings_link($links) {
            $settings_link = '<a href="admin.php?page=skelementor_plugin">Settings</a>'; //link to the page we want to be taken to
            array_push($links, $settings_link);
            return $links;
        }

        public function add_admin_pages() {
            add_menu_page('Skelementor Plugin', 'Skelementor', 'manage_options', 'skelementor_plugin', array($this, 'admin_index'), 'dashicons-buddicons-topics', 110);
        }

        public function admin_index() {
            require_once plugin_dir_path( __FILE__) . 'templates/admin.php';
        }

        protected function create_post_type() {
            add_action('init', array($this, 'custom_post_type'));
        }

        function activate() {
            // require_once plugin_dir_path( __FILE__) . 'inc/skelementor-plugin-activate.php'; //so now this can be commented out
            Activate::activate(); //we can change the name of the class to just 'Activate' as it's what the class is named 
        }

        function deactivate() {
            Deactivate::deactivate(); //we can change the name of the class to just 'Deactivate' as it's what the class is named 
            //calling the deactivate function the alternate way was causing errors, so it's called the same way that the activate function is called when using the namespace
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
    /* The commented line `//require_once plugin_dir_path(
    __FILE__).'inc/skelementor-plugin-deactivate.php'; //this is not needed anymore` was previously
    used to include a file named `skelementor-plugin-deactivate.php` for deactivating the plugin.
    However, with the introduction of namespaces and restructuring the code, the direct inclusion of
    this file is no longer necessary. */
    // require_once plugin_dir_path( __FILE__).'inc/skelementor-plugin-deactivate.php'; //this is not needed anymore
    register_deactivation_hook(__FILE__, array($skelementorPlugin, 'deactivate')); //we are calling the deactivate function the same way bc the prev way was causing errors.

}