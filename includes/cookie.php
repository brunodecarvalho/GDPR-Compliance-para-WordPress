<?php
/**
 * COOKIE
 */
// Default functions to create a unique cookie name
function get_unique_cookie_name()
{
    $site_url = get_bloginfo('url');
    $site_name = get_bloginfo('name');
    $suffix = '-saved-cookie';

    $cookie_name = $site_url . $site_name . $suffix;

    // Now let's strip everything
    $cookie_name = str_replace(array('[\', \']'), '', $cookie_name);
    $cookie_name = preg_replace('/\[.*\]/U', '', $cookie_name);
    $cookie_name = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $cookie_name);
    $cookie_name = htmlentities($cookie_name, ENT_COMPAT, 'utf-8');
    $cookie_name = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $cookie_name);
    $cookie_name = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $cookie_name);
    $cookie_name = strtolower(trim($cookie_name, '-'));

    return $cookie_name;
}

// Default functions set cookie 
function set_cookie($name, $value = 'Aceito', $time = null)
{
    $time = $time != null ? $time : time() + apply_filters('cookie_expiration', 60 * 60 * 24 * 30);
    $value = base64_encode(json_encode(stripslashes_deep($value)));
    $expiration = apply_filters('cookie_expiration_time', $time);

    $_COOKIE[$name] = $value;
    setcookie($name, $value, $expiration, COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN, false);
}

// Default functions get cookie 
function get_cookie($name)
{
    if (isset($_COOKIE[$name])) {
        return json_decode(base64_decode(stripslashes($_COOKIE[$name])), true);
    }

    return array();
}