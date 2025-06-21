<?php
if (!defined('ABSPATH')) exit;

class Soonish_Admin {
    public static function get_instance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }
    private function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
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
        include_once plugin_dir_path(__FILE__) . 'settings.php';
    }

    public function admin_scripts($hook) {
        if ('settings_page_soonish' !== $hook) {
            return;
        }
        wp_enqueue_style('soonish-admin', plugin_dir_url(__DIR__) . 'assets/css/admin.css');
        wp_enqueue_script('soonish-admin-js', plugin_dir_url(__DIR__) . 'assets/js/soonish-admin.js', array('jquery'), null, true);
        wp_localize_script('soonish-admin-js', 'SoonishAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('soonish_toggle_mode_nonce'),
            'enabled' => (bool) get_option('soonish_enabled', false),
        ));
    }
} 