<?php
/**
 * Plugin Name: Virani SEO AI Pro
 * Plugin URI: https://github.com/viraniglobal/SEO
 * Description: AI Powered SEO Suite with Competitor Tracking, Technical Audit, Keyword Tracking, Google Search Console Integration and White Label.
 * Version: 0.1.0
 * Requires at least: 6.5
 * Requires PHP: 8.1
 * Author: Virani Global
 * Author URI: https://github.com/viraniglobal
 * License: GPL v2 or later
 * Text Domain: virani-seo-ai-pro
 */

if (!defined('ABSPATH')) {
    exit;
}

define('VSAP_VERSION', '0.1.0');
define('VSAP_PLUGIN_FILE', __FILE__);
define('VSAP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('VSAP_PLUGIN_URL', plugin_dir_url(__FILE__));

register_activation_hook(__FILE__, 'vsap_activate');
register_deactivation_hook(__FILE__, 'vsap_deactivate');

function vsap_activate() {
    flush_rewrite_rules();
}

function vsap_deactivate() {
    flush_rewrite_rules();
}

add_action('admin_menu', 'vsap_admin_menu');

function vsap_admin_menu() {

    add_menu_page(
        'Virani SEO AI Pro',
        'Virani SEO',
        'manage_options',
        'vsap-dashboard',
        'vsap_dashboard_page',
        'dashicons-chart-area',
        2
    );

}

function vsap_dashboard_page() {
    ?>
    <div class="wrap">
        <h1>🚀 Virani SEO AI Pro</h1>

        <p>Plugin Installed Successfully.</p>

        <h2>Version 0.1</h2>

        <ul>
            <li>✅ Dashboard</li>
            <li>✅ Plugin Core</li>
            <li>⏳ SEO Audit</li>
            <li>⏳ Google Search Console</li>
            <li>⏳ Competitor Tracking</li>
            <li>⏳ AI Assistant</li>
        </ul>

    </div>
    <?php
}