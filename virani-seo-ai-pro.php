<?php
/**
 * Plugin Name: Virani SEO AI Pro
 * Plugin URI: https://github.com/viraniglobal/SEO
 * Description: AI Powered Enterprise SEO Plugin for WordPress.
 * Version: 0.1.0
 * Author: Virani Global
 * Author URI: https://github.com/viraniglobal
 * License: GPL-2.0-or-later
 * Text Domain: virani-seo-ai-pro
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Plugin Constants
 */
define('VSAP_VERSION', '0.1.0');
define('VSAP_PLUGIN_FILE', __FILE__);
define('VSAP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('VSAP_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Load Core Files
 */
require_once VSAP_PLUGIN_PATH . 'includes/class-installer.php';
require_once VSAP_PLUGIN_PATH . 'includes/class-loader.php';

/**
 * Activation Hook
 */
register_activation_hook(__FILE__, ['VSAP_Installer', 'activate']);

/**
 * Start Plugin
 */
VSAP_Loader::init();