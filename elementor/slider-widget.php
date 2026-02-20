<?php
if (!defined('ABSPATH')) exit;
if (!class_exists('\Elementor\Widget_Base')) return;

class USS_Elementor_Slider extends \Elementor\Widget_Base {

    public function get_name() { return 'uss_slider'; }
    public function get_title() { return 'Ultimate Slider'; }
    public function get_icon() { return 'eicon-slides'; }
    public function get_categories() { return ['general']; }

    protected function render() {
        echo do_shortcode('[ultimate_slider]');
    }
}
