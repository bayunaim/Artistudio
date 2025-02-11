<?php
namespace Artistudio\Popup\PostType;

use Artistudio\Popup\Interfaces\PopupInterface;

class PopupCPT implements PopupInterface {
    public function register() {
    add_action('admin_menu', [$this, 'register_popup_cpt']);
}

    public function register_popup_cpt() {
		error_log("register_post_type dipanggil!");
		register_post_type('popup', [
			'labels'      => [
				'name'          => __('Popups', 'artistudio'),
				'singular_name' => __('Popup', 'artistudio'),
				'menu_name'     => __('Popups', 'artistudio'),
			],
			'public'      => true,
			'has_archive' => true,
			'menu_icon'   => 'dashicons-format-chat',
			'supports'    => ['title', 'editor', 'thumbnail'],
			'show_ui'     => true,
			'show_in_menu'=> true,
			'menu_position' => 5,
		]);
	}
}
