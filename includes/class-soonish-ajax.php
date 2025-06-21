<?php
if (!defined('ABSPATH')) exit;

class Soonish_Ajax {
    public static function get_instance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }
    private function __construct() {
        add_action('wp_ajax_soonish_toggle_mode', array($this, 'toggle_coming_soon_mode'));
    }

    public function toggle_coming_soon_mode() {
        check_ajax_referer('soonish_toggle_mode_nonce', 'nonce');
        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => 'Unauthorized'], 403);
        }
        $enabled = isset($_POST['enabled']) && $_POST['enabled'] === 'true';
        update_option('soonish_enabled', $enabled);
        wp_send_json_success(['enabled' => $enabled]);
    }
} 