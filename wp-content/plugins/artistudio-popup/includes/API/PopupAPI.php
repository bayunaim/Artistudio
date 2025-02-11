<?php
namespace Artistudio\Popup\API;

class PopupAPI {
    public function register() {
        register_rest_route('artistudio/v1', '/popup', [
            'methods' => 'GET',
            'callback' => [$this, 'get_popup'],
            'permission_callback' => function() {
                return is_user_logged_in();
            }
        ]);
    }

    public function get_popup() {
        $popups = get_posts(['post_type' => 'popup']);
        return rest_ensure_response($popups);
    }
}

add_action('rest_api_init', function() {
    (new PopupAPI())->register();
});
