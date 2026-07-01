<?php
if (!defined('ABSPATH')) {
    exit;
}

class VSAP_Loader {

    public static function init() {
        require_once VSAP_PLUGIN_PATH . 'includes/class-admin.php';
        require_once VSAP_PLUGIN_PATH . 'includes/class-settings.php';
        require_once VSAP_PLUGIN_PATH . 'includes/class-database.php';
    }
}