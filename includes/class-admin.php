<?php
if (!defined('ABSPATH')) {
    exit;
}

class VSAP_Admin {

    public static function init() {

        add_action('admin_menu', function () {

            add_menu_page(
                'Virani SEO AI Pro',
                'Virani SEO',
                'manage_options',
                'vsap-dashboard',
                [self::class, 'dashboard'],
                'dashicons-chart-area',
                2
            );

        });

    }

    public static function dashboard() {

        echo '<div class="wrap">';
        echo '<h1>Virani SEO AI Pro</h1>';
        echo '<p>Plugin Core Loaded Successfully.</p>';
        echo '</div>';

    }

}