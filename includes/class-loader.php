<?php

if (!defined('ABSPATH')) {
    exit;
}

class VSAP_Loader
{
    /**
     * Initialize Plugin
     */
    public static function init()
    {
        self::load_core();
        self::load_modules();
    }

    /**
     * Load Core Classes
     */
    private static function load_core()
    {
        require_once VSAP_PLUGIN_PATH . 'includes/class-admin.php';
        require_once VSAP_PLUGIN_PATH . 'includes/class-settings.php';
        require_once VSAP_PLUGIN_PATH . 'includes/class-database.php';

        VSAP_Admin::init();
    }

    /**
     * Load Modules
     */
    private static function load_modules()
    {
        require_once VSAP_PLUGIN_PATH . 'modules/audit/class-analyzer.php';
        require_once VSAP_PLUGIN_PATH . 'modules/audit/class-results.php';
        require_once VSAP_PLUGIN_PATH . 'modules/audit/class-scanner.php';
        require_once VSAP_PLUGIN_PATH . 'modules/audit/class-audit.php';

        VSAP_Audit::init();
    }
}