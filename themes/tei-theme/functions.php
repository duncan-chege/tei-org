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

// Allow iframes in content - MUST run early
function allow_iframe_tags() {
    global $allowedposttags;
    
    $allowedposttags['iframe'] = array(
        'src' => true,
        'width' => true,
        'height' => true,
        'frameborder' => true,
        'allowfullscreen' => true,
        'loading' => true,
        'allow' => true,
        'title' => true,
        'class' => true,
        'id' => true,
        'style' => true,
        'referrerpolicy' => true,
        'sandbox' => true,
        'name' => true,
    );
}
add_action('init', 'allow_iframe_tags', 1);

// MAIN SOLUTION: Direct YouTube iframe replacement
function replace_youtube_embeds_with_iframes($content) {
    // Find all YouTube embed blocks and replace them with working iframes
    $pattern = '/<figure class="[^"]*wp-block-embed-youtube[^"]*"[^>]*>.*?<div class="wp-block-embed__wrapper">\s*(https:\/\/(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\s<&]+)).*?<\/div>.*?<\/figure>/s';
    
    $content = preg_replace_callback($pattern, function($matches) {
        $full_match = $matches[0];
        $url = $matches[1];
        $video_id_raw = $matches[2];
        
        // Extract clean video ID (11 characters)
        if (preg_match('/([a-zA-Z0-9_-]{11})/', $video_id_raw, $id_matches)) {
            $video_id = $id_matches[1];
        } else {
            return $full_match; // Return original if can't extract ID
        }
        
        // Get the original figure classes
        preg_match('/class="([^"]*)"/', $full_match, $class_matches);
        $figure_classes = $class_matches[1] ?? 'wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube';
        
        // Create the YouTube iframe
        $iframe = sprintf(
            '<iframe 
                title="YouTube video player" 
                width="560" 
                height="315" 
                src="https://www.youtube.com/embed/%s?rel=0" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                referrerpolicy="strict-origin-when-cross-origin" 
                allowfullscreen>
            </iframe>',
            $video_id
        );
        
        // Return the complete figure with iframe
        return sprintf(
            '<figure class="%s"><div class="wp-block-embed__wrapper">%s</div></figure>',
            $figure_classes,
            $iframe
        );
    }, $content);
    
    return $content;
}
add_filter('the_content', 'replace_youtube_embeds_with_iframes', 99); // Very late priority

// Additional method using render_block for double coverage
function fix_youtube_render_block($block_content, $block) {
    // Only process YouTube embed blocks
    if ($block['blockName'] !== 'core/embed' || 
        !isset($block['attrs']['providerNameSlug']) || 
        $block['attrs']['providerNameSlug'] !== 'youtube' ||
        !isset($block['attrs']['url'])) {
        return $block_content;
    }
    
    $url = $block['attrs']['url'];
    
    // Skip if iframe already exists
    if (strpos($block_content, '<iframe') !== false) {
        return $block_content;
    }
    
    // Extract video ID
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
        $video_id = $matches[1];
        
        // Create iframe
        $iframe = sprintf(
            '<iframe 
                title="YouTube video player" 
                width="560" 
                height="315" 
                src="https://www.youtube.com/embed/%s?rel=0" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                referrerpolicy="strict-origin-when-cross-origin" 
                allowfullscreen>
            </iframe>',
            $video_id
        );
        
        // Replace URL with iframe
        $block_content = preg_replace(
            '/<div class="wp-block-embed__wrapper">\s*' . preg_quote($url, '/') . '.*?<\/div>/s',
            '<div class="wp-block-embed__wrapper">' . $iframe . '</div>',
            $block_content
        );
    }
    
    return $block_content;
}
add_filter('render_block', 'fix_youtube_render_block', 10, 2);

// Force refresh of post content (clear any cached content)
function force_content_refresh() {
    if (current_user_can('manage_options') && isset($_GET['refresh_content'])) {
        // Clear all post caches
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE meta_key LIKE '_oembed_%'");
        
        // Clear any object cache
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }
        
        // Clear any transients
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%'");
        
        wp_redirect(remove_query_arg('refresh_content'));
        exit;
    }
}
add_action('admin_init', 'force_content_refresh');

// Add styles for YouTube embeds
function add_youtube_embed_styles() {
    ?>
    <style>
    /* YouTube embed styles */
    .wp-block-embed {
        margin: 1.5rem 0;
    }
    
    .wp-block-embed__wrapper {
        position: relative;
        width: 100%;
        display: block; /* Force display */
    }
    
    /* Responsive 16:9 aspect ratio */
    .wp-block-embed-youtube.wp-embed-aspect-16-9 .wp-block-embed__wrapper {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }
    
    .wp-block-embed-youtube.wp-embed-aspect-16-9 .wp-block-embed__wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
        border: 0;
    }
    
    /* Default sizing for non-aspect-ratio embeds */
    .wp-block-embed-youtube .wp-block-embed__wrapper iframe {
        max-width: 100%;
        width: 100%;
        height: 315px;
        border: 0;
        display: block !important;
        visibility: visible !important;
    }
    
    /* Ensure visibility and override any theme conflicts */
    .wp-block-embed iframe {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 1 !important;
    }
    
    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .wp-block-embed-youtube .wp-block-embed__wrapper iframe {
            width: 100%;
            height: 250px;
        }
    }
    
    @media (max-width: 480px) {
        .wp-block-embed-youtube .wp-block-embed__wrapper iframe {
            height: 200px;
        }
    }
    </style>
    <?php
}
add_action('wp_head', 'add_youtube_embed_styles');

// Enhanced debug function
function debug_youtube_comprehensive() {
    if (current_user_can('manage_options') && isset($_GET['debug_youtube_full'])) {
        echo '<h2>YouTube Embed Debug Information</h2>';
        
        // Test URL
        $test_url = 'https://youtu.be/ru9cfT8uwi8?si=0rfpqiwOR56CqOOB';
        echo '<h3>Test URL: ' . $test_url . '</h3>';
        
        // Test video ID extraction
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $test_url, $matches)) {
            $video_id = $matches[1];
            echo '<p><strong>Extracted Video ID:</strong> ' . $video_id . '</p>';
            
            // Create and display iframe
            $iframe = sprintf(
                '<iframe title="YouTube video player" width="560" height="315" src="https://www.youtube.com/embed/%s?rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
                $video_id
            );
            
            echo '<h4>Generated iframe HTML:</h4>';
            echo '<pre>' . esc_html($iframe) . '</pre>';
            
            echo '<h4>Rendered iframe:</h4>';
            echo '<div style="border: 2px solid #f00; padding: 10px; background: #f9f9f9;">';
            echo $iframe;
            echo '</div>';
        }
        
        // Test WordPress oEmbed
        echo '<h4>WordPress oEmbed Test:</h4>';
        $oembed = wp_oembed_get($test_url);
        if ($oembed) {
            echo '<p>✅ oEmbed is working</p>';
            echo '<pre>' . esc_html($oembed) . '</pre>';
        } else {
            echo '<p>❌ oEmbed failed - this is common on localhost</p>';
        }
        
        // Show current post content for comparison
        if (isset($_GET['post_id'])) {
            $post_id = intval($_GET['post_id']);
            $post = get_post($post_id);
            if ($post) {
                echo '<h4>Current Post Content:</h4>';
                echo '<pre>' . esc_html($post->post_content) . '</pre>';
                
                echo '<h4>Processed Content:</h4>';
                echo '<div style="border: 1px solid #ccc; padding: 10px;">';
                echo apply_filters('the_content', $post->post_content);
                echo '</div>';
            }
        }
        
        exit;
    }
}
add_action('wp', 'debug_youtube_comprehensive');

// Add admin notice with helpful links
function youtube_embed_admin_notice() {
    if (current_user_can('manage_options')) {
        $refresh_url = add_query_arg('refresh_content', '1');
        $debug_url = add_query_arg('debug_youtube_full', '1');
        
        echo '<div class="notice notice-info is-dismissible">';
        echo '<p><strong>YouTube Embed Tools:</strong> ';
        echo '<a href="' . esc_url($refresh_url) . '" class="button">Clear All Caches</a> ';
        echo '<a href="' . esc_url($debug_url) . '" class="button" target="_blank">Test YouTube Embeds</a>';
        echo '</p></div>';
    }
}
add_action('admin_notices', 'youtube_embed_admin_notice');