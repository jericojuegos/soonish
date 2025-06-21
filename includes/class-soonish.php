<?php
if (!defined('ABSPATH')) exit;

class Soonish {
    private static $instance = null;
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function __construct() {
        // Only set up the singleton instance
    }
    public function run() {
        // Load dependencies
        require_once plugin_dir_path(__FILE__) . '/../admin/class-soonish-admin.php';
        require_once plugin_dir_path(__FILE__) . '/class-soonish-frontend.php';
        require_once plugin_dir_path(__FILE__) . '/class-soonish-adminbar.php';
        require_once plugin_dir_path(__FILE__) . '/class-soonish-ajax.php';
        require_once plugin_dir_path(__FILE__) . '/class-soonish-api.php';

        // Initialize components
        Soonish_Admin::get_instance();
        Soonish_Frontend::get_instance();
        Soonish_Adminbar::get_instance();
        Soonish_Ajax::get_instance();
        Soonish_API::get_instance();
    }
} 