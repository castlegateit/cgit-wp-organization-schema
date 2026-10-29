<?php

/**
 * Plugin Name:      Castlegate IT WP Organization Schema
 * Plugin URI:       https://github.com/castlegateit/cgit-wp-organization-schema
 * Description:      Organization schema generation.
 * Version:          1.0.1
 * Requires PHP:     8.2
 * Author:           Castlegate IT
 * Author URI:       https://www.castlegateit.co.uk/
 * License:          MIT
 * Update URI:       https://github.com/castlegateit/cgit-wp-organization-schema
 * Requires Plugins: advanced-custom-fields-pro, cgit-wp-schema-map
 */

use Castlegate\OrganizationSchema\Plugin;

if (!defined('ABSPATH')) {
    wp_die('Access denied');
}

define('CGIT_WP_ORGANIZATION_SCHEMA_VERSION', '1.0.1');
define('CGIT_WP_ORGANIZATION_SCHEMA_PLUGIN_FILE', __FILE__);
define('CGIT_WP_ORGANIZATION_SCHEMA_PLUGIN_DIR', __DIR__);

require_once __DIR__ . '/vendor/autoload.php';

Plugin::init();
