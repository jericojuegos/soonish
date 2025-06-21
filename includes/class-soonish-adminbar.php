<?php
if (!defined('ABSPATH')) exit;

class Soonish_Adminbar {
    public static function get_instance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }
    private function __construct() {
        add_action('admin_bar_menu', array($this, 'add_admin_bar_notification'), 100);
        add_action('admin_head', array($this, 'admin_bar_notification_css'));
        add_action('wp_head', array($this, 'admin_bar_notification_css'));
    }

    public function add_admin_bar_notification($wp_admin_bar) {
        if (!get_option('soonish_enabled', false)) {
            return;
        }
        $wp_admin_bar->add_node(array(
            'id'    => 'soonish-notification',
            'title' => '<span class="ab-icon"></span> Coming Soon Mode is enabled',
            'href'  => admin_url('options-general.php?page=soonish'),
            'meta'  => array(
                'class' => 'soonish-notification',
            ),
        ));
    }

    public function admin_bar_notification_css() {
        ?>
        <style>
            #wpadminbar .soonish-notification {
                background-color: #d63638;
            }
            #wpadminbar .soonish-notification .ab-item {
                color: #fff !important;
                font-weight: bold;
            }
            #wpadminbar .soonish-notification .ab-icon:before {
                content: '\f534';
                top: 2px;
                color: #fff !important;
            }
        </style>
        <?php
    }
} 