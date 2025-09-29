<?php
/**
 * @package SkelementorPlugin
 */

class SkelementorPluginActivate {

    public static function activate() {
        flush_rewrite_rules();
    }
}