<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

// Check if user wants to delete everything
$delete_all = get_option('uss_delete_on_uninstall') === '1';

if (!$delete_all) return;

// List of plugin options to delete
$options = [
    'uss_speed',
    'uss_autoplay',
    'uss_arrows',
    'uss_dots',
    'uss_keyboard',
    'uss_touch',
    'uss_loop',
    'uss_effect',
    'uss_lazy',
    'uss_delete_on_uninstall',
];

// Delete plugin options
foreach ($options as $opt) {
    delete_option($opt);
}

// Delete all slide postmeta
global $wpdb;
$wpdb->query(
    $wpdb->prepare(
        "DELETE FROM {$wpdb->postmeta} WHERE meta_key LIKE %s",
        'uss_%'
    )
);

// Delete all slides (Custom Post Type)
$slides = get_posts([
    'post_type' => 'uss_slide',
    'numberposts' => -1,
    'post_status' => 'any'
]);

foreach ($slides as $slide) {
    wp_delete_post($slide->ID, true);
}

// Delete plugin-related transients
$wpdb->query(
    "DELETE FROM {$wpdb->options} 
     WHERE option_name LIKE '_transient_uss_%' 
        OR option_name LIKE '_transient_timeout_uss_%'"
);
