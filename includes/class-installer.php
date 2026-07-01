<?php

if (!defined('ABSPATH')) {
    exit;
}

class VSAP_Installer {

    public static function activate() {
        self::create_settings_table();
        self::create_audits_table();
        flush_rewrite_rules();
    }

    /**
     * Create Settings Table
     */
    private static function create_settings_table() {

        global $wpdb;

        $charset = $wpdb->get_charset_collate();
        $table = $wpdb->prefix . 'vsap_settings';

        $sql = "CREATE TABLE IF NOT EXISTS $table (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            setting_key VARCHAR(190) NOT NULL,
            setting_value LONGTEXT NULL,
            PRIMARY KEY (id),
            UNIQUE KEY setting_key (setting_key)
        ) $charset;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    /**
     * Create Audit Table
     */
    private static function create_audits_table() {

        global $wpdb;

        $charset = $wpdb->get_charset_collate();
        $table = $wpdb->prefix . 'vsap_audits';

        $sql = "CREATE TABLE IF NOT EXISTS $table (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            post_id BIGINT UNSIGNED NOT NULL,
            post_type VARCHAR(50) NOT NULL,
            url TEXT NOT NULL,
            title TEXT NULL,
            meta_title TEXT NULL,
            meta_description LONGTEXT NULL,
            h1_count INT DEFAULT 0,
            missing_alt INT DEFAULT 0,
            word_count INT DEFAULT 0,
            status VARCHAR(30) DEFAULT 'pending',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
}