<?php
if (!defined('ABSPATH')) exit;

class Soonish_Frontend {
    public static function get_instance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }
    private function __construct() {
        add_action('template_redirect', array($this, 'display_coming_soon_page'));
    }

    public function display_coming_soon_page() {
        if (!get_option('soonish_enabled', false)) {
            return;
        }
        // IP Whitelisting
        $whitelist_raw = get_option('soonish_whitelisted_ips', '');
        $whitelist = array_filter(array_map('trim', explode("\n", $whitelist_raw)));
        $user_ip = $_SERVER['REMOTE_ADDR'] ?? '';
        if ($user_ip && in_array($user_ip, $whitelist)) {
            return;
        }
        if (current_user_can('manage_options') || is_admin()) {
            return;
        }
        include_once plugin_dir_path(__DIR__) . 'templates/coming-soon.php';
        exit;
    }
} 