<?php
if (!defined('ABSPATH')) exit;

function uss_get_settings() {
    $defaults = require USS_PLUGIN_DIR . 'includes/defaults.php';
    $theme_config = get_stylesheet_directory() . '/ultimate-swiper-slider/config.php';
    if (file_exists($theme_config)) {
        $custom = require $theme_config;
        $defaults = array_merge($defaults, $custom);
    }
    return apply_filters('ultimate_slider_settings', $defaults);
}

function uss_should_load_assets() {
    if (is_admin()) return false;
    global $post;
    if (!$post) return false;
    if (has_shortcode($post->post_content, 'ultimate_slider') || 
        (function_exists('has_block') && has_block('uss/slider', $post))) {
        return true;
    }
    if (did_action('elementor/frontend/before_render') || apply_filters('uss_force_load_assets', false)) {
        return true;
    }
    return false;
}

function uss_enqueue_assets() {
    if (!uss_should_load_assets()) return;

    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], null);

    $theme_css = get_stylesheet_directory() . '/ultimate-swiper-slider/slider.css';
    if (file_exists($theme_css)) {
        wp_enqueue_style('uss-theme-style', get_stylesheet_directory_uri() . '/ultimate-swiper-slider/slider.css', [], filemtime($theme_css));
    } else {
        wp_enqueue_style('uss-plugin-style', USS_PLUGIN_URL . 'assets/slider.css', [], '1.0');
    }

    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);
    wp_enqueue_script('uss-init', USS_PLUGIN_URL . 'assets/swiper-init.js', ['swiper-js'], '1.0', true);
    wp_localize_script('uss-init', 'USS_SETTINGS', uss_get_settings());
}
?>