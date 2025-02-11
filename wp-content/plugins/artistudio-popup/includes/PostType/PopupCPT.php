<?php
namespace Artistudio\Popup\PostType;
use Artistudio\Popup\Interfaces\PopupInterface;

class PopupCPT implements PopupInterface {
    public function register() {
        register_post_type('popup', [
            'labels' => ['name' => 'Pop-ups', 'singular_name' => 'Pop-up'],
            'public' => true,
            'menu_icon' => 'dashicons-welcome-view-site',
            'supports' => ['title', 'editor'],
        ]);
    }
}
