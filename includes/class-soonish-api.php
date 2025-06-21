<?php
if (!defined('ABSPATH')) exit;

class Soonish_API {
    public static function get_instance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }
    private function __construct() {
        add_action('rest_api_init', array($this, 'register_routes'));
    }

    public function register_routes() {
        register_rest_route('soonish/v1', '/status', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_status'),
            'permission_callback' => '__return_true',
        ));
    }

    public function get_status($request) {
        $enabled = get_option('soonish_enabled', false);
        return rest_ensure_response(['enabled' => (bool)$enabled]);
    }
} 