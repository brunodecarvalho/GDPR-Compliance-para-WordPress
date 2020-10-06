<?php
/**
 * ADMIN MENU.
 */
function gdpr_compliance_admin_menu()
{
  add_menu_page(
    __('GDPR Compliance para WordPress', 'gdpr-compliance'),
    __('GDPR Compliance para WordPress', 'gdpr-compliance'),
    'manage_options',
    'gdpr-compliance-settings',
    'gdpr_compliance_admin_page_contents',
    'dashicons-schedule',
    3
  );
}
add_action('admin_menu', 'gdpr_compliance_admin_menu');

/**
 * ADMIN PAGE FORM.
 */
function gdpr_compliance_admin_page_contents()
{
?>
    <div class="gdpr_compliance_admin_page_contents">
        <h1><?php esc_html_e('GDPR Compliance para WordPress.', 'gdpr-compliance'); ?></h1>
        <div id="wrap">
            <form method="post" action="options.php">
                <?php
                    settings_fields('gdpr-compliance-settings');
                    do_settings_sections('gdpr-compliance-settings');
                    submit_button();
                ?>
            </form>
        </div>
    </div>
    <?php
}