<?php
/**
 * @package SkelementorPlugin
 */

class SkelementorPluginDeactivate {

    public static function deactivate() {
        flush_rewrite_rules();
    }
}