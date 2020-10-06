<?php
/**
 * Register settings
 */
function gdpr_compliance_register_settings()
{
    $plugin_name = 'gdpr-compliance';

    // Register setting.
    register_setting(
        $plugin_name . '-settings',
        $plugin_name . '-settings',
        'gdpr_compliance_sandbox_register_setting'
    );

    // Add Section
    add_settings_section(
        $plugin_name . '-settings-section',
        __('Configurações', $plugin_name),
        'gdpr_compliance_sandbox_add_settings_section',
        $plugin_name . '-settings'
    );

    /**
     * FIELDs
     */

    // Enable/Disable functionality
    add_settings_field(
        'toggle-content',
        __('Mostrar a mensagem de consentimento?', $plugin_name),
        'gdpr_compliance_sandbox_add_settings_field_single_checkbox',
        $plugin_name . '-settings',
        $plugin_name . '-settings-section',
        array(
            'label_for' => 'toggle-content',
            'description' => __('Se marcado, habilita para mostrar a mensagem de consentimento no site.', $plugin_name)
        )
    );


    // Display position
    add_settings_field(
        'message-position',
        __('Escolher a posição onde a mensagem deve aparecer', $plugin_name),
        'gdpr_compliance_sandbox_add_settings_field_select',
        $plugin_name . '-settings',
        $plugin_name . '-settings-section',
        array(
            'label_for' => 'message-position',
            'description' => __('Posição padrão', $plugin_name)
        )
    );


    // Message content
    add_settings_field(
        'message-text',
        __('Alterar a mensagem da caixa de consentimento', $plugin_name),
        'gdpr_compliance_sandbox_add_settings_field_textarea',
        $plugin_name . '-settings',
        $plugin_name . '-settings-section',
        array(
            'label_for' => 'message-text',
            'description'   => __('Alterar a mensagem da caixa de consentimento', $plugin_name)
        )
    );


    // Button label
    add_settings_field(
        'button-text',
        __('Alterar o label do botão', $plugin_name),
        'gdpr_compliance_sandbox_add_settings_field_input_text',
        $plugin_name . '-settings',
        $plugin_name . '-settings-section',
        array(
            'label_for' => 'button-text',
            'default'   => __('Aceito', $plugin_name)
        )
    );


    // Theme options
    add_settings_field(
        'message-theme',
        __('Escolher o tema', $plugin_name),
        'gdpr_compliance_sandbox_add_settings_theme',
        $plugin_name . '-settings',
        $plugin_name . '-settings-section',
        array(
            'label_for' => 'message-theme',
            'description' => __('Tema padrão', $plugin_name)
        )
    );

}
add_action('admin_init', 'gdpr_compliance_register_settings');