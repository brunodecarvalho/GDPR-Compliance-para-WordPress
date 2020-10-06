<?php
/**
 * Plugin Name:       GDPR Compliance para WordPress
 * Plugin URI:        https://github.com/brunodecarvalho/GDPR-Compliance-para-WordPress/
 * Description:       Plugin de GDPR Compliance para WordPress.
 * Version:           1.0.0
 * Author:            Bruno de Carvalho
 * Author URI:        http://brunodecarvalho.com.br/
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

include_once('includes/enqueue-scripts.php');
include_once('includes/register_settings.php');
include_once('includes/cookie.php');
include_once('includes/fields-settings.php');
include_once('includes/admin-settings.php');
include_once('includes/ajax-callback.php');

/**
 * Front-end dependencies
 */
function gdpr_compliance_scripts() {
    // Styles
    wp_enqueue_style( 'gdpr-compliance-style', plugins_url( '/public/css/styles.css', __FILE__ ) );
    //Scripts
    wp_enqueue_script( 'jquery-library', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', null, '1.11.0', true );
    wp_enqueue_script( 'gdpr-compliance-script', plugins_url( '/public/js/scripts.js', __FILE__ ), 'jquery-library', '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'gdpr_compliance_scripts' );

/**
 * 
 */
function show_gdpr_message()
{
    $options = get_option('gdpr-compliance-settings');

    //Default content
    $message_text = 'We use cookies to provide our services and for analytics and marketing. To find out more about our use of cookies, please see our Privacy Policy. By continuing to browse our website, you agree to our use of cookies.';
    $button_text = 'Aceito';
    $message_theme = 'ocean';

    if (!empty($options['message-text'])) {
        $message_text = $options['message-text'];
    }

    if (!empty($options['button-text'])) {
        $button_text = $options['button-text'];
    }

    if (!empty($options['message-theme'])) {
        $message_theme = $options['message-theme'];
    }

    if (!empty($options['toggle-content']) && get_cookie(get_unique_cookie_name()) != 'Aceito') :
        $position = $options['message-position'];
    ?>

    <div class="panel_out <?php echo $bdp = ($position == 'top') ? 'top' : 'bottom'; ?> <?php echo $message_theme.'-theme'; ?>">
        <div class="wrap_inner">
            <div class="message_text">
                <?php echo $message_text; ?>
            </div>
            <button class="button_text" 
                    data-nonce="<?php echo wp_create_nonce("save_cookie_nonce"); ?>" 
                    data-saved-cookie="Aceito"
                    data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>">
                <?php echo $button_text; ?>
            </button>
        </div>
    </div>
    
<?php
    endif;
}
add_action('wp_footer', 'show_gdpr_message');