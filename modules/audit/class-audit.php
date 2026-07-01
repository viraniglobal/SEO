<?php

if (!defined('ABSPATH')) {
    exit;
}

class VSAP_Audit
{
    /**
     * Register AJAX hooks
     */
    public static function init()
    {
        add_action(
            'wp_ajax_vsap_start_audit',
            [self::class, 'start']
        );
    }

    /**
     * Start Audit
     */
    public static function start()
    {
        check_ajax_referer(
            'vsap_audit',
            'nonce'
        );

        if (!current_user_can('manage_options')) {
            wp_send_json_error('Permission denied.');
        }

        $scanner = new VSAP_Scanner();

        $result = $scanner->scan();

        wp_send_json_success($result);
    }
}