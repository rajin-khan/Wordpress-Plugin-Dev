<?php
/**
 * @package SkelementorPlugin
 */
namespace Inc\Base;

class SettingsLinks {

    protected $plugin;

    public function __construct() {
        $this -> plugin = PLUGIN;
    }

    public function register() {
        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
    }

    public function settings_link($links) {

        $settings_link = '<a href="admin.php?page=skelementor_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
}








// use Inc\Activate;
// use Inc\Deactivate;
// use Inc\Admin\AdminPages;

// if (!class_exists('SkelementorPlugin')) {

//     class SkelementorPlugin {

//         public $plugin;

//         function __construct() {
//             $this -> plugin = plugin_basename(__FILE__);
//         }

//         function register() {
//             add_action('admin_enqueue_scripts', array($this, 'enqueue'));
//             add_action('admin_menu', array($this, 'add_admin_pages'));
//             add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
//         }

//         public function settings_link($links) {
//             $settings_link = '<a href="admin.php?page=skelementor_plugin">Settings</a>';
//             array_push($links, $settings_link);
//             return $links;
//         }

//         public function add_admin_pages() {
//             add_menu_page('Skelementor Plugin', 'Skelementor', 'manage_options', 'skelementor_plugin', array($this, 'admin_index'), 'dashicons-buddicons-topics', 110);
//         }

//         public function admin_index() {
//             require_once plugin_dir_path( __FILE__) . 'templates/admin.php';
//         }

//         protected function create_post_type() {
//             add_action('init', array($this, 'custom_post_type'));
//         }

//         function activate() {
//             Activate::activate();
//         }

//         function deactivate() {
//             Deactivate::deactivate();
//         }


//         function custom_post_type() {
//             register_post_type( 'book', ['public' => true, 'label' => 'Books']);
//         }

//         function enqueue() {
//             wp_enqueue_style( 'mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
//             wp_enqueue_script( 'mypluginscript', plugins_url('/assets/myscript.js', __FILE__));
//         }
//     }

//     if ( class_exists('SkelementorPlugin')) {
//         $skelementorPlugin = new SkelementorPlugin();
//         $skelementorPlugin -> register();
//     }

//     //on activation
//     register_activation_hook(__FILE__, array($skelementorPlugin, 'activate'));

//     //on deactivation
//     register_deactivation_hook(__FILE__, array($skelementorPlugin, 'deactivate'));

// }