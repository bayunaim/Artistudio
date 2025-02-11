<?php
/**
 * Plugin Name: Artistudio Popup
 * Description: Custom popup plugin.
 */

use Artistudio\Popup\PostType\PopupCPT;

if (!defined('ABSPATH')) exit;

class ArtistudioPopup {
    public function __construct() {
        add_action('init', [$this, 'init']);
    }

    public function init() {
        (new PopupCPT())->register();
    }
}

add_action('add_meta_boxes', function() {
    add_meta_box('popup_meta', 'Popup Settings', 'render_popup_meta', 'popup');
});

function render_popup_meta($post) {
    $page = get_post_meta($post->ID, 'popup_page', true);
    echo '<label>Display on Page:</label>';
    echo '<input type="text" name="popup_page" value="'.esc_attr($page).'">';
}

add_action('save_post', function($post_id) {
    if (array_key_exists('popup_page', $_POST)) {
        update_post_meta($post_id, 'popup_page', sanitize_text_field($_POST['popup_page']));
    }
});

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('artistudio-popup', plugin_dir_url(__FILE__) . 'assets/js/index.js', ['wp-element'], '1.0', true);
});


new ArtistudioPopup();

