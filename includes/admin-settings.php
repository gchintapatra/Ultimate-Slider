<?php
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function() {
    // Top-level menu
    add_menu_page(
        'Ultimate Slider Settings', // Page title
        'Ultimate Slider',          // Menu title
        'manage_options',           // Capability
        'ultimate-slider',          // Menu slug
        'uss_render_admin_page',    // Callback
        'dashicons-images-alt2',    // Icon
        25                          // Position
    );
});

function uss_render_admin_page() { ?>
    <div class="wrap">
        <h1>Ultimate Slider Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('uss_settings_group');
            do_settings_sections('ultimate-slider');
            submit_button();
            ?>
        </form>
    </div>
<?php }
?>
