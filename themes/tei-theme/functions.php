<?php

/**
 * Theme functions and definitions
 */

// Theme setup
function tailwind_theme_setup()
{
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register navigation menus
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

// Get Vite asset URL
function get_vite_asset($asset)
{
    if (is_vite_development()) {
        return "http://localhost:3000/{$asset}";
    }

    // In production, read from manifest
    $manifest_path = get_template_directory() . '/assets/.vite/manifest.json';
    if (file_exists($manifest_path)) {
        $manifest = json_decode(file_get_contents($manifest_path), true);
        if (isset($manifest[$asset])) {
            return get_template_directory_uri() . '/assets/' . $manifest[$asset]['file'];
        }
    }

    // Fallback - direct asset path
    return get_template_directory_uri() . '/assets/' . $asset;
}

// Enqueue Vite assets
function tailwind_theme_scripts()
{

    if (is_vite_development()) {
        // Development mode - load Vite dev server
        wp_enqueue_script(
            'vite-client',
            'http://localhost:3000/@vite/client',
            array(),
            null,
            false
        );

        wp_enqueue_script(
            'tailwind-main',
            'http://localhost:3000/src/main.js',
            array('vite-client'),
            null,
            true
        );

        // Add module type to Vite scripts
        add_filter('script_loader_tag', 'add_type_module_to_vite_script', 10, 3);
    } else {
        // Production mode - load built assets

        // CSS file path - FIXED THE BUG HERE
        $css_path = get_template_directory() . '/assets/css/style.css';
        if (file_exists($css_path)) {
            wp_enqueue_style(
                'tailwind-style',
                get_vite_asset('css/style.css'),
                array(),
                filemtime($css_path)
            );
        }

        // JS file path - FIXED THE BUG HERE  
        $js_path = get_template_directory() . '/assets/js/main.js';
        if (file_exists($js_path)) {
            wp_enqueue_script(
                'tailwind-main',
                 get_vite_asset('js/main.js'),
                array(),
                filemtime($js_path),
                true
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'tailwind_theme_scripts');

// Add type="module" to Vite scripts
function add_type_module_to_vite_script($tag, $handle, $src)
{
    if (strpos($src, 'localhost:3000') !== false || $handle === 'vite-client' || $handle === 'tailwind-main') {
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
        'description'   => __('Add widgets here.', 'tailwind-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-xl font-bold mb-3">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'tailwind_theme_widgets_init');

// Custom excerpt length
function tailwind_theme_excerpt_length($length)
{
    return 20;
}
add_filter('excerpt_length', 'tailwind_theme_excerpt_length', 999);

// Remove WordPress block editor styles (optional)
function tailwind_theme_remove_block_styles()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
}
add_action('wp_enqueue_scripts', 'tailwind_theme_remove_block_styles', 100);

// Allow Vite HMR in development
function allow_vite_hmr()
{
    if (is_vite_development()) {
?>
        <script>
            // Allow Vite HMR WebSocket connections
            if (typeof window !== 'undefined') {
                window.addEventListener('beforeunload', () => {
                    if (window.__vite_plugin_react_preamble_installed__) {
                        window.__vite_plugin_react_preamble_installed__ = false;
                    }
                });
            }
        </script>
<?php
    }
}
add_action('wp_head', 'allow_vite_hmr');

//Automatically switching image paths on development and production
function get_image_url($image_path) {
    $base_path = get_template_directory_uri();
    
    // Check for development flag file
    $is_development = file_exists(get_template_directory() . '/.dev');
    
    if ($is_development) {
        return $base_path . '/src/images/' . $image_path;
    } else {
        return $base_path . '/assets/images/' . $image_path;
    }
}