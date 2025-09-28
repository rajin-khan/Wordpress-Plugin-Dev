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

//if someone else tries to access, we won't let them. three ways to do it.

// if ( ! defined('ABSPATH') ) {
//     die;
// }

defined('ABSPATH') or die('You shall not pass!');

// if ( ! function_exists('add_action') ) { //could be any function that pre loads
//     echo 'You shall not pass!';
//     exit;
// }


class SkelementorPlugin {
  
    //constructors in php oop are defined like this, no need to keep, but i am for reference.
    function __construct() {}

    //the three triggers defined as functions
    function activate() {
        // generate a CPT (custom post type)
        // flush rewrite rules
    }
    
    function deactivate() {
        // flush rewrite rules
    }

    function uninstall() {
        // delete CPT 
        // delete all the plugin data from the DB
    }
}

//vars in php are prefixed with $
if ( class_exists('SkelementorPlugin')) {
    $skelementorPlugin = new SkelementorPlugin(); //basic oop structure
}

//wordpress triggers stuff on 3 actions by default (hooks that are provided to plugins by default from wordpress),

//on activation
register_activation_hook(__FILE__, array($skelementorPlugin, 'activate')); //how php works, so, to call a function inside a class, we pass it as an array)
//in the array, we first pass the class variable where it's initialized, and then the string of the function name that is to be triggered.
//by writing __FILE__, we ask the hook to only look inside this file regardless of other paths to find the function defined.

//on deactivation
register_deactivation_hook(__FILE__, array($skelementorPlugin, 'deactivate'));

//on uninstall