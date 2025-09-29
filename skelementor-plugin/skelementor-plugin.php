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

    //OOP IN PHP (Refresher)

    //Public (Can be accessed everywhere)
    //if no access modifiers, assumed to be a public function,

    //Protected
    //function/method can only be called inside the class itself where it's defined.
    //can also be called by a class that extends the other class

    //Private
    //function/method can only be called inside the class itself where it's defined. cannot be accessed by a class that extends it either

    //all this applies to variables too.

    //Static
    //allows you to use methods without registering the class, comes after access modifiers.
    //can be called like this ( e.g, if the register function was a public static function, 'SkelementorPlugin::register();' )

    public static function register() {
        //add_action('admin_enqueue_scripts', array($this, 'enqueue')); 
        //'$this' won't work as a static function assumes the class isn't initialized, and '$this' variable refers to the current class. 
        //so, we make enqueue a static function, and call it as such:
        add_action('admin_enqueue_scripts', array('SkelementorPlugin', 'enqueue')); 
    }

    protected function create_post_type() {
        add_action('init', array($this, 'custom_post_type'));
    }

    function activate() {
        $this -> custom_post_type();
        flush_rewrite_rules();
    }
    
    function deactivate() {
        flush_rewrite_rules();
    }

    function custom_post_type() {
        register_post_type( 'book', ['public' => true, 'label' => 'Books']);
    }

    static function enqueue() {
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
register_deactivation_hook(__FILE__, array($skelementorPlugin, 'deactivate'));