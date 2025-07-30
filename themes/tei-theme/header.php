<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>
    <?php wp_body_open(); ?>

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <!-- CSS Debug Info -->
        <?php if (is_vite_development()): ?>
            <p style="background: yellow; padding: 10px;">
                DEVELOPMENT MODE: CSS should load from localhost:3000
            </p>
        <?php else: ?>
            <p style="background: lightblue; padding: 10px;">
                PRODUCTION MODE: CSS should load from assets/css/style.css
            </p>
        <?php endif; ?>
        <nav class="flex items-center justify-between py-2 px-4 md:px-8 gap-x-6">
            <!-- Logo/Site Title -->
            <div class="flex items-center">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img class="w-full h-[50px]" src="<?php echo get_image_url('main-logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" />
                </a>
            </div>

            <div class="lg:hidden block">
                <a href="#" class="button bg-maroon !py-1.5">Donate</a>
            </div>

            <!-- Mobile menu button (visible below lg) -->
            <button class="lg:hidden p-2" id="mobile-menu-toggle" aria-label="Toggle Menu" aria-expanded="false">
                <svg class="w-6 h-6" fill="none" stroke="#232323" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Desktop navigation (visible lg and above) -->
            <div class="hidden lg:flex space-x-12 text-maroon items-center">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'flex space-x-12',
                    'container' => false,
                    'fallback_cb' => false,
                ));
                ?>
            </div>
            <div class="hidden lg:block">
                <a href="#" class="button bg-maroon">Donate</a>
            </div>
        </nav>

        <!-- Mobile navigation (hidden initial, visible when toggled) -->
        <div class="hidden px-4 py-2 bg-white text-maroon" id="mobile-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'flex flex-col space-y-2',
                'container' => false,
                'fallback_cb' => false,
            ));
            ?>
        </div>

    </header>