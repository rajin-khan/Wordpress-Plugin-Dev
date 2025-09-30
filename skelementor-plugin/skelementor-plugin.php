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

// If this file is called directly, abort
defined('ABSPATH') or die('You shall not pass!');


// require once the composes autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';

}

// code that runs during plugin activation

function activate_skelementor_plugin() {
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_skelementor_plugin');

// code that runs during plugin deactivation

function deactivate_skelementor_plugin() {
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_skelementor_plugin');

if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}