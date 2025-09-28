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
        add_action('init', array($this, 'custom_post_type')); //so we search for the function right in this class, hence the $this variable.
        //but calling the add_action is often unsafe and may fail (rarely ever does), so just in case, call it in the activate function directly too
    }


    function activate() {
        // generate a CPT (custom post type)
        //we cannot call the function directly (as this is oop) as it's not globally defined, so we call it like this:
        $this -> custom_post_type();

        // flush rewrite rules
        flush_rewrite_rules(); //we can simply callthis function because it's defined globally.
    }
    
    function deactivate() {
        // flush rewrite rules
        flush_rewrite_rules();
    }

    function uninstall() {
        // delete CPT 
        // delete all the plugin data from the DB
    }

    function custom_post_type() {
        register_post_type( 'book', ['public' => true, 'label' => 'Books']); //this creates a custom post type (related to wordpress, figure out what this is later.)
    } //to call this function on initialization we have to use wordpress's add_action hook, but since that's a part of procedural programming, not oop, we must call it in the constructor.
}

if ( class_exists('SkelementorPlugin')) {
    $skelementorPlugin = new SkelementorPlugin();
}

//on activation
register_activation_hook(__FILE__, array($skelementorPlugin, 'activate'));

//on deactivation
register_deactivation_hook(__FILE__, array($skelementorPlugin, 'deactivate'));

//on uninstall