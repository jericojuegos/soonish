<?php
/**
 * Plugin Name: Soonish
 * Plugin URI: https://jericojuegos.com/soonish
 * Description: A simple and elegant coming soon / maintenance mode plugin
 * Version: 1.0.0
 * Author: Jerico Juegos
 * Author URI: https://jericojuegos.com
 * Text Domain: soonish
 * License: GPL v2 or later
 */

if (!defined('ABSPATH')) {
    exit;
}

// Load the main plugin class
require_once plugin_dir_path(__FILE__) . 'includes/class-soonish.php';

// Initialize the plugin
function run_soonish() {
    $plugin = Soonish::get_instance();
    $plugin->run();
}
add_action('plugins_loaded', 'run_soonish');
