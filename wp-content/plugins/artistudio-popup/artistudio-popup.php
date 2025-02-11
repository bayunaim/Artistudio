<?php
/**
 * Plugin Name: Artistudio Popup
 * Description: Custom popup plugin.
 */

if (!defined('ABSPATH')) exit;

// Autoloading function
spl_autoload_register(function ($class) {
    $prefix = 'Artistudio\\Popup\\';
    $base_dir = plugin_dir_path(__FILE__) . 'includes/';

    // Periksa apakah class memiliki prefix yang benar
    if (strpos($class, $prefix) !== 0) {
        return;
    }

    // Konversi namespace ke path file
    $relative_class = substr($class, strlen($prefix));
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Jika file ada, muat
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once plugin_dir_path(__FILE__) . 'includes/Interfaces/PopupInterface.php';
require_once plugin_dir_path(__FILE__) . 'includes/PostType/PopupCPT.php';
use Artistudio\Popup\PostType\PopupCPT;

class ArtistudioPopup {
    public function __construct() {
        add_action('init', [$this, 'init']);
    }

    public function init() {
        $popup = new PopupCPT();
        $popup->register_popup_cpt(); // Pastikan ini dipanggil
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

// Load Frontend Script dan Style
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('artistudio-popup', plugin_dir_url(__FILE__) . 'assets/js/index.js', [], '1.0', true);
    wp_enqueue_style('artistudio-popup-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
});

add_action('rest_api_init', function() {
    register_rest_route('artistudio/v1', '/popup', [
        'methods'  => 'GET',
        'callback' => 'get_popup_data',
        'permission_callback' => '__return_true' // Mengizinkan akses tanpa autentikasi
    ]);
});

function get_popup_data() {
    $args = [
        'post_type'      => 'popup',
        'posts_per_page' => 1,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $query->the_post();
        $data = [
            'title'       => get_the_title(),
            'description' => get_the_content(),
        ];
        wp_reset_postdata();
        return rest_ensure_response($data);
    } else {
        return new WP_Error('no_popups', 'Tidak ada popup yang ditemukan', ['status' => 404]);
    }
}


add_action('wp_footer', function() {
    $args = ['post_type' => 'popup', 'posts_per_page' => 1];
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div id="artistudio-popup" style="display:none;">';
            echo '<h2>' . get_the_title() . '</h2>';
            echo '<div>' . get_the_content() . '</div>';
            echo '<button onclick="closePopup()">Close</button>';
            echo '</div>';
        }
        wp_reset_postdata();
    }
});


new ArtistudioPopup();
