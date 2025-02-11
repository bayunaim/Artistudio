<?php

namespace Artistudio\Popup;

if (!defined('ABSPATH')) {
    exit; 
}

class WPPopupPlugin {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('init', [$this, 'register_custom_post_type']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('rest_api_init', [$this, 'register_rest_routes']);
    }

    public function register_custom_post_type() {
        register_post_type('popup', [
            'label' => 'Popups',
            'public' => true,
            'supports' => ['title', 'editor', 'custom-fields'],
            'show_in_rest' => true,
        ]);
    }

    public function enqueue_scripts() {
        wp_enqueue_script('popup-js', plugin_dir_url(__FILE__) . 'assets/js/popup.js', ['wp-element'], '1.0', true);
        wp_enqueue_style('popup-css', plugin_dir_url(__FILE__) . 'assets/css/popup.css');
    }

    public function register_rest_routes() {
        register_rest_route('artistudio/v1', '/popup', [
            'methods'  => 'GET',
            'callback' => [$this, 'get_popup_data'],
            'permission_callback' => function () {
                return is_user_logged_in();
            },
        ]);
    }

    public function get_popup_data() {
        $args = [
            'post_type'      => 'popup',
            'posts_per_page' => -1,
        ];
        $query = new \WP_Query($args);
        $data = [];
        
        while ($query->have_posts()) {
            $query->the_post();
            $data[] = [
                'title'       => get_the_title(),
                'content'     => get_the_content(),
                'page'        => get_post_meta(get_the_ID(), 'page', true),
            ];
        }
        
        wp_reset_postdata();
        return rest_ensure_response($data);
    }
}

WPPopupPlugin::getInstance();
