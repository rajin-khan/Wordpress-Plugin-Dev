<?php
/**
 * @package SkelementorPlugin
 */

namespace Inc; //to make this file auto-load and not have to use require_once checks line after line in the main php file

class Activate { //class name must be the same as filename for psr-4 to work

    public static function activate() {
        flush_rewrite_rules();
    }
}