<?php
// Enqueue Tailwind CSS CDN script
function seiyann_enqueue_styles() {
    wp_enqueue_script(
        'tailwind',
        'https://cdn.tailwindcss.com',
        array(),
        null,
        false
    );
}
add_action('wp_enqueue_scripts', 'seiyann_enqueue_styles', 999);

// Setup theme features and menu locations
function seiyann_theme_setup() {
    register_nav_menus(array(
        'primary-menu' => __('Primary Desktop Menu', 'seiyann'),
        'mobile-menu'  => __('Mobile Overlay Menu', 'seiyann'),
        'sidebar-nav'  => __('Sidebar Navigation Menu', 'seiyann'),
    ));

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'seiyann_theme_setup');