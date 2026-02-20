<?php
/*
Plugin Name: Ultimate Swiper Slider
Description: Fully responsive WordPress slider with top-level admin menu, slides CPT, Elementor & ACF compatible.
Version: 1.0.0
Author: Your Name
Text Domain: ultimate-swiper-slider
*/

if (!defined('ABSPATH')) exit;

// Constants
define('USS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('USS_PLUGIN_URL', plugin_dir_url(__FILE__));

// Includes
require_once USS_PLUGIN_DIR . 'includes/defaults.php';
require_once USS_PLUGIN_DIR . 'includes/functions.php';
require_once USS_PLUGIN_DIR . 'includes/slider-render.php';
require_once USS_PLUGIN_DIR . 'includes/admin-settings.php';
require_once USS_PLUGIN_DIR . 'includes/cpt-slides.php';

// Elementor widget
add_action('elementor/widgets/register', function($widgets_manager){
    if (class_exists('Elementor\Widget_Base')) {
        require_once USS_PLUGIN_DIR . 'elementor/slider-widget.php';
        $widgets_manager->register(new \USS_Elementor_Slider());
    }
});

// Enqueue scripts/styles
add_action('wp_enqueue_scripts', 'uss_enqueue_assets');
?>