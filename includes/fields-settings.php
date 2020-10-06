<?php
/**
 * Fields settings
 */

// Register setting.
function gdpr_compliance_sandbox_register_setting($input)
{
    $new_input = array();
    if (isset($input)) {
        // Loop trough each input and sanitize the value if the input id isn't post-types
        foreach ($input as $key => $value) {
            if ($key == 'post-types') {
                $new_input[$key] = $value;
            } else {
                $new_input[$key] = sanitize_text_field($value);
            }
        }
    }
    return $new_input;
}

// Add Section
function gdpr_compliance_sandbox_add_settings_section()
{
    return;
}

/**
 * FIELDs
 */

// Enable/Disable functionality
function gdpr_compliance_sandbox_add_settings_field_single_checkbox($args)
{
    $field_id = $args['label_for'];
    $field_description = $args['description'];

    $options = get_option('gdpr-compliance-settings');
    $option = 0;

    if (!empty($options[$field_id])) {
        $option = $options[$field_id];
    }
?>
    <label for="<?php echo 'gdpr-compliance-settings[' . $field_id . ']'; ?>">
        <input  type="checkbox" 
                name="<?php echo 'gdpr-compliance-settings[' . $field_id . ']'; ?>" 
                id="<?php echo 'gdpr-compliance-settings[' . $field_id . ']'; ?>" 
                value="1"
                <?php checked($option, true, 1); ?> />
        <span class="description"><?php echo esc_html($field_description); ?></span>
    </label>
<?php
}


// Display position
function gdpr_compliance_sandbox_add_settings_field_select($args)
{
    $field_id = $args['label_for'];
    $field_default = $args['default'];
    $field_description = $args['description'];

    $options = get_option('gdpr-compliance-settings');
    $option = $field_default;

    if (!empty($options[$field_id])) {
        $option = $options[$field_id];
    }
?>
    <select name="<?php echo 'gdpr-compliance-settings[' . $field_id . ']'; ?>" 
            id="<?php echo 'gdpr-compliance-settings[' . $field_id . ']'; ?>">
        <option value="top" <?php selected($option, "top"); ?>>Topo</option>
        <option value="bottom" <?php selected($option, "bottom"); ?>>Rodapé</option>
    </select>
<?php
}


// Message content
function gdpr_compliance_sandbox_add_settings_field_textarea($args)
{
    $field_id = $args['label_for'];
    $field_description = $args['description'];
    $default_message = 'We use cookies to provide our services and for analytics and marketing. To find out more about our use of cookies, please see our Privacy Policy. By continuing to browse our website, you agree to our use of cookies.';

    $options = get_option('gdpr-compliance-settings');
    $option = $default_message;

    if (!empty($options[$field_id])) {
        $option = $options[$field_id];
    }

    wp_editor($option, 'gdpr-compliance-settings[' . $field_id . ']', array(
        'wpautop'             => false,
        'media_buttons'       => false,
        'default_editor'      => '',
        'drag_drop_upload'    => false,
        'textarea_name'       => 'gdpr-compliance-settings[' . $field_id . ']',
        'textarea_rows'       => 4,
        'tabindex'            => '',
        'tabfocus_elements'   => ':prev,:next',
        'editor_css'          => '',
        'editor_class'        => '',
        'teeny'               => false,
        '_content_editor_dfw' => false,
        'tinymce'             => true,
        'quicktags'           => true,
    ));
}


// Button label
function gdpr_compliance_sandbox_add_settings_field_input_text($args)
{
    $field_id = $args['label_for'];
    $field_default = $args['default'];

    $options = get_option('gdpr-compliance-settings');
    $option = $field_default;

    if (!empty($options[$field_id])) {
        $option = $options[$field_id];
    }
?>
    <input  type="text" 
            name="<?php echo 'gdpr-compliance-settings[' . $field_id . ']'; ?>" 
            id="<?php echo 'gdpr-compliance-settings[' . $field_id . ']'; ?>" 
            value="<?php echo esc_attr($option); ?>" 
            class="regular-text" />
<?php
}


// Theme options
function gdpr_compliance_sandbox_add_settings_theme($args)
{
    $field_id = $args['label_for'];
    $field_default = 'ocean';
    $field_description = $args['description'];

    $options = get_option('gdpr-compliance-settings');
    $option = $field_default;

    if (!empty($options[$field_id])) {
        $option = $options[$field_id];
    }
?>
    <select name="<?php echo 'gdpr-compliance-settings[' . $field_id . ']'; ?>" 
            id="<?php echo 'gdpr-compliance-settings[' . $field_id . ']'; ?>">
        <option value="ocean" <?php selected($option, "ocean"); ?>>Ocean</option>
        <option value="light" <?php selected($option, "light"); ?>>Light</option>
        <option value="forest" <?php selected($option, "forest"); ?>>Forest</option>
    </select>
<?php
}