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

class Soonish {
    private static $instance = null;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('template_redirect', array($this, 'display_coming_soon_page'));
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
    }

    public function add_admin_menu() {
        add_options_page(
            'Soonish Settings',
            'Soonish',
            'manage_options',
            'soonish',
            array($this, 'settings_page')
        );
    }

    public function register_settings() {
        register_setting('soonish_options', 'soonish_enabled');
        register_setting('soonish_options', 'soonish_title');
        register_setting('soonish_options', 'soonish_description');
        register_setting('soonish_options', 'soonish_launch_date');
        register_setting('soonish_options', 'soonish_background');
    }

    public function settings_page() {
        include_once plugin_dir_path(__FILE__) . 'admin/settings.php';
    }

    public function admin_scripts($hook) {
        if ('settings_page_soonish' !== $hook) {
            return;
        }
        wp_enqueue_style('soonish-admin', plugin_dir_url(__FILE__) . 'assets/css/admin.css');
    }

    public function display_coming_soon_page() {
        if (!get_option('soonish_enabled', false)) {
            return;
        }

        if (current_user_can('manage_options') || is_admin()) {
            return;
        }

        include_once plugin_dir_path(__FILE__) . 'templates/coming-soon.php';
        exit;
    }
}

// Initialize the plugin
function soonish_init() {
    Soonish::get_instance();
}
add_action('plugins_loaded', 'soonish_init');
