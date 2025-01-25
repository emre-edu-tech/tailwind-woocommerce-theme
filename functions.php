<?php
add_action('wp_enqueue_scripts', 'mediapons_woocommerce_enqueue_scripts');
function mediapons_woocommerce_enqueue_scripts() {
    // Add stylesheet
    wp_enqueue_style('mp-main-style', get_theme_file_uri('/build/css/index.css'), [], '1.0.0', 'all');
    // Add script
    wp_enqueue_script('mp-main-script', get_theme_file_uri('/build/index.js'), ['jquery'], '1.0.0', true);
}