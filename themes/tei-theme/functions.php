<?php

/**
 * Theme functions and definitions
 */

// Theme setup
function tailwind_theme_setup()
{
    // Essential theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Block editor support
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_theme_support('responsive-embeds');


    // Navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'tailwind-theme'),
        'footer' => __('Footer Menu', 'tailwind-theme'),
    ));
}
add_action('after_setup_theme', 'tailwind_theme_setup');

// Check if we're in development mode
function is_vite_development()
{
    // Check if we're on localhost or development domain
    $current_domain = $_SERVER['HTTP_HOST'] ?? '';
    $dev_domains = ['localhost', '127.0.0.1', 'dev.', 'staging.'];

    foreach ($dev_domains as $dev_domain) {
        if (strpos($current_domain, $dev_domain) !== false) {
            return true;
        }
    }

    // Also check if node_modules exists (development setup)
    return file_exists(get_template_directory() . '/node_modules');
}

// Handle all theme assets
function tailwind_theme_assets()
{
    $assets_uri = get_template_directory_uri() . '/assets';

    // Front-end assets
    if (!is_admin()) {
        if (is_vite_development()) {
            wp_enqueue_script('vite-client', 'http://localhost:3000/@vite/client', [], null);
            wp_enqueue_script('tailwind-main', 'http://localhost:3000/src/main.js', ['vite-client'], null, true);
            add_filter('script_loader_tag', 'add_module_type', 10, 3);
        } else {
            wp_enqueue_style('tailwind-style', "$assets_uri/css/style.css");
            wp_enqueue_script('tailwind-main', "$assets_uri/js/main.js", [], '1.0.0', true);
        }

        wp_enqueue_style('wp-block-library');
        wp_enqueue_style('tailwind-blocks', "$assets_uri/css/blocks.css", ['wp-block-library']);
    }

    // Editor assets
    if (is_admin()) {
        add_editor_style([
            "$assets_uri/css/style.css",
            "$assets_uri/css/blocks.css"
        ]);
    }
}
add_action('wp_enqueue_scripts', 'tailwind_theme_assets');
add_action('admin_init', 'tailwind_theme_assets');

// Add module type for Vite scripts
function add_module_type($tag, $handle, $src)
{
    if (strpos($src, 'localhost:3000') !== false) {
        return str_replace('<script ', '<script type="module" ', $tag);
    }
    return $tag;
}

// Widget areas
function tailwind_theme_widgets_init()
{
    register_sidebar(array(
        'name'          => __('Sidebar', 'tailwind-theme'),
        'id'            => 'sidebar-1',
        'before_widget' => '<section class="widget mb-6">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-xl font-bold mb-3">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'tailwind_theme_widgets_init');

//Automatically switching image paths on development and production
function get_image_url($image_path)
{
    $base_path = get_template_directory_uri();

    // Check for development flag file
    $is_development = file_exists(get_template_directory() . '/.dev');

    if ($is_development) {
        return $base_path . '/src/images/' . $image_path;
    } else {
        return $base_path . '/assets/images/' . $image_path;
    }
}
