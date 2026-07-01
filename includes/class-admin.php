<?php

if (!defined('ABSPATH')) {
    exit;
}

class VSAP_Admin
{
    /**
     * Initialize Admin
     */
    public static function init()
    {
        add_action('admin_menu', [self::class, 'menu']);
        add_action('admin_enqueue_scripts', [self::class, 'enqueue']);
    }

    /**
     * Load CSS & JS
     */
    public static function enqueue($hook)
    {
        // Load only on our plugin page
        if ($hook !== 'toplevel_page_vsap-dashboard') {
            return;
        }

        wp_enqueue_style(
            'vsap-admin',
            VSAP_PLUGIN_URL . 'assets/css/admin.css',
            [],
            VSAP_VERSION
        );

        wp_enqueue_script(
            'vsap-admin',
            VSAP_PLUGIN_URL . 'assets/js/admin.js',
            ['jquery'],
            VSAP_VERSION,
            true
        );

        wp_localize_script(
            'vsap-admin',
            'vsap_admin',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('vsap_audit'),
            ]
        );
    }

    /**
     * Admin Menu
     */
    public static function menu()
    {
        add_menu_page(
            'Virani SEO AI Pro',
            'Virani SEO',
            'manage_options',
            'vsap-dashboard',
            [self::class, 'dashboard'],
            'dashicons-chart-area',
            2
        );
    }

    /**
     * Dashboard
     */
    public static function dashboard()
    {
        include VSAP_PLUGIN_PATH . 'templates/dashboard.php';
    }

    /**
     * Dashboard Card
     */
    public static function card($title, $value)
    {
        ?>
        <div class="vsap-card">
            <h3><?php echo esc_html($title); ?></h3>
            <h2><?php echo esc_html($value); ?></h2>
        </div>
        <?php
    }
}