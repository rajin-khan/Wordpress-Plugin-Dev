<?php
/**
 * @package SkelementorPlugin
 */
namespace Inc\Base;

class BaseController {

    public $plugin_path;
    public $plugin_url;
    public $plugin;

    public function __construct() {

        $this -> plugin_path = plugin_dir_path(dirname(__FILE__, 2)); //2 is passed as a parameter because we're 2 levels indented from the main file
        $this -> plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this -> plugin = plugin_basename(dirname(__FILE__, 3)) . '/skelementor-plugin.php';
    }
}
