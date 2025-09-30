<?php
/**
 * @package SkelementorPlugin
 */

namespace Inc; //same as Activate

class Deactivate { //rename the class and file both to Deactivate

    public static function deactivate() {
        flush_rewrite_rules();
    }
}