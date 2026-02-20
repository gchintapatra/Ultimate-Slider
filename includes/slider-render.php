<?php
if (!defined('ABSPATH')) exit;

add_shortcode('ultimate_slider', 'uss_render_shortcode');

function uss_render_shortcode($atts){
    $atts = shortcode_atts([
        'autoplay' => 'true',
        'speed'    => 4000,
    ], $atts, 'ultimate_slider');

    $atts['autoplay'] = filter_var($atts['autoplay'], FILTER_VALIDATE_BOOLEAN);
    $atts['speed'] = intval($atts['speed']);

    return uss_render_slider($atts);
}

function uss_render_slider($settings){
    $slides = get_posts(['post_type'=>'uss_slide','post_status'=>'publish','numberposts'=>-1]);
    ob_start(); ?>
    <div class="uss-slider">
        <div class="swiper-wrapper">
            <?php foreach($slides as $slide):
                $width = get_post_meta($slide->ID, '_uss_width', true);
                $height = get_post_meta($slide->ID, '_uss_height', true);
                $full_width = get_post_meta($slide->ID, '_uss_full_width', true);
                $style = '';
                if($full_width) { $style = 'width:100%;'; }
                else if($width || $height) { $style = 'width:'.$width.'px;height:'.$height.'px;'; }
            ?>
            <div class="swiper-slide" style="<?php echo esc_attr($style); ?>">
                <?php if(has_post_thumbnail($slide->ID)) echo get_the_post_thumbnail($slide->ID,'full'); ?>
                <div class="uss-slide-title"><?php echo esc_html($slide->post_title); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if($settings['arrows']): ?>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <?php endif; ?>
        <?php if($settings['dots']): ?>
        <div class="swiper-pagination"></div>
        <?php endif; ?>
    </div>
    <?php return ob_get_clean();
}
?>