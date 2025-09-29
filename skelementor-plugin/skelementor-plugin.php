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

        function register() {
            add_action('admin_enqueue_scripts', array($this, 'enqueue'));
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