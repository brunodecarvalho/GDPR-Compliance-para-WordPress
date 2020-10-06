<?php
/**
 * AJAX CALLBACK.
 */
function ajax_callback_function()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], "save_cookie_nonce")) {
        exit("No naughty business please");
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = $_REQUEST["saved_cookie"];
        set_cookie(get_unique_cookie_name(), $result);
        // echo get_cookie(get_unique_cookie_name());
    }

    die();
}
add_action('wp_ajax_my_action_name', 'ajax_callback_function');    // If called from admin panel
add_action('wp_ajax_nopriv_my_action_name', 'ajax_callback_function');    // If called from front end