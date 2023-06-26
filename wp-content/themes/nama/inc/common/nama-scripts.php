<?php

/**
 * nama_scripts description
 * @return [type] [description]
 */
function nama_scripts() {

    /**
     * all css files
     */

    wp_enqueue_style('nama-fonts', nama_fonts_url(), [], '1.0.0');

    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', NAMA_THEME_CSS_DIR . 'bootstrap.rtl.min.css', []);
    } else {
        wp_enqueue_style('bootstrap', NAMA_THEME_CSS_DIR . 'bootstrap.min.css', []);
    }
    wp_enqueue_style('font-awesome-pro', NAMA_THEME_CSS_DIR . 'font-awesome-pro.css', []);
    wp_enqueue_style('nice-select', NAMA_THEME_CSS_DIR . 'nice-select.css', []);
    wp_enqueue_style('nama-core', NAMA_THEME_CSS_DIR . 'nama-core.css', []);
    wp_enqueue_style('nama-unit', NAMA_THEME_CSS_DIR . 'nama-unit.css', []);
    wp_enqueue_style('nama-responsive', NAMA_THEME_CSS_DIR . 'nama-responsive.css', []);
    wp_enqueue_style('nama-custom', NAMA_THEME_CSS_DIR . 'nama-custom.css', []);
    wp_enqueue_style('nama-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('bootstrap-bundle', NAMA_THEME_JS_DIR . 'bootstrap.bundle.min.js', ['jquery'], '', true);
    wp_enqueue_script('nice-select', NAMA_THEME_JS_DIR . 'nice-select.js', ['jquery'], '', true);
    wp_enqueue_script('nama-main', NAMA_THEME_JS_DIR . 'main.js', ['jquery'], false, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'nama_scripts');

/*
Register Fonts
 */
function nama_fonts_url() {
    $font_url = '';
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'nama')) {
        $font_url = 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap';
    }
    return $font_url;
}
