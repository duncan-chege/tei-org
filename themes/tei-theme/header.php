<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
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
            <div class="flex justify-center w-60">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img class="w-auto h-[70px]" src="<?php echo get_image_url('main-logo.png'); ?>" alt="<?php bloginfo('name'); ?>" />
                </a>
            </div>

            <div class="lg:hidden block">
                <a href="<?php echo esc_url(home_url('/donate')); ?>" class="button bg-maroon py-1">Donate</a>
            </div>

            <!-- Mobile menu button (visible below lg) -->
            <button class="lg:hidden p-2" id="mobile-menu-toggle" aria-label="Toggle Menu" aria-expanded="false">
                <svg class="w-6 h-6" fill="none" stroke="#a51f53" viewBox="0 0 24 24">
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
                <a href="<?php echo esc_url(home_url('/donate')); ?>" class="button bg-maroon">Donate</a>
            </div>
        </nav>

        <!-- Mobile navigation (hidden initial, visible when toggled) -->
        <div class="hidden shadow-md px-4 py-2 bg-white text-maroon" id="mobile-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'flex flex-col space-y-2',
                'container' => false,
                'fallback_cb' => false,
            ));
            ?>

            <div class="my-4">
                <h5 class="text-navy-blue tracking-normal mb-2"> Follow Our Socials</h5>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/people/Trans-Empowerment-Initiative-TEI/100064763375978/#" target="_blank" class="text-navy-blue hover:text-maroon transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/trans_empowerment_initiative/" target="_blank" class="text-navy-blue hover:text-maroon transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                        </svg>
                    </a>
                    <a href="https://www.tiktok.com/@transempowerment7" target="_blank" class="text-navy-blue hover:text-maroon transition-colors">
                        <span class="sr-only">TikTok</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </header>