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


class SkelementorPlugin {
  
    function __construct() {
        add_action('init', array($this, 'custom_post_type'));
    }

    function register() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue')); 
        //if we need the css to load up in the frontend, not the backend, we use wp_enqueue_scripts instead. check by inspecting the network tab and seeing if you can find the css file.
    }

    function activate() {
        $this -> custom_post_type();
        flush_rewrite_rules();
    }
    
    function deactivate() {
        flush_rewrite_rules();
    }

    function uninstall() {
        // delete CPT 
        // delete all the plugin data from the DB
    }

    function custom_post_type() {
        register_post_type( 'book', ['public' => true, 'label' => 'Books']);
    }

    // to store javascript and css and stuff, we have to call te enqueue function
    function enqueue() {
        // enqueue all our scripts, but the scripts must be stored in a separate folder.
        wp_enqueue_style( 'mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
        //custom name of the style, the url for the folder relative to the plugin folder, the place where to start looking from, more options are there but optional
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
register_deactivation_hook(__FILE__, array($skelementorPlugin, 'deactivate'));

//on uninstall (hook gets triggered when the user both deactivates and clicks on delete)
// register_uninstall_hook(__FILE__, array($skelementorPlugin, 'deactivate')); //this works, but requires it to be a static method, so we have to prefix the functions with static, which is annoying
//a better way is to create a separate file for uninstalls in this same directory.