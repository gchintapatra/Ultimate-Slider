<?php
if (!defined('ABSPATH')) exit;

add_action('init', function() {
    $labels = [
        'name' => 'Slides',
        'singular_name' => 'Slide',
        'menu_name' => 'Slides',
        'add_new_item' => 'Add New Slide',
        'edit_item' => 'Edit Slide'
    ];

    $args = [
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'supports' => ['title','editor','thumbnail'],
        'capability_type' => 'post',
        'has_archive' => false,
        'menu_position' => 26
    ];

    register_post_type('uss_slide', $args);
});

// Add meta boxes for width, height, full-width
add_action('add_meta_boxes', function() {
    add_meta_box('uss_slide_meta', 'Slide Options', 'uss_slide_meta_box', 'uss_slide', 'normal', 'high');
});

function uss_slide_meta_box($post) {
    $width = get_post_meta($post->ID, '_uss_width', true);
    $height = get_post_meta($post->ID, '_uss_height', true);
    $full_width = get_post_meta($post->ID, '_uss_full_width', true);
    ?>
    <p>
        <label>Width (px):</label>
        <input type="number" name="uss_width" value="<?php echo esc_attr($width); ?>" />
    </p>
    <p>
        <label>Height (px):</label>
        <input type="number" name="uss_height" value="<?php echo esc_attr($height); ?>" />
    </p>
    <p>
        <label>Full Width:</label>
        <input type="checkbox" name="uss_full_width" value="1" <?php checked($full_width,1); ?> />
    </p>
    <?php
}

// Save meta
add_action('save_post', function($post_id) {
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(isset($_POST['uss_width'])) update_post_meta($post_id, '_uss_width', intval($_POST['uss_width']));
    if(isset($_POST['uss_height'])) update_post_meta($post_id, '_uss_height', intval($_POST['uss_height']));
    update_post_meta($post_id, '_uss_full_width', isset($_POST['uss_full_width']) ? 1 : 0);
});
?>