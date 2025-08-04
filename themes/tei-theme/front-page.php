<?php get_header(); ?>

<!-- Hero Section -->
<section id="home" class="relative pt-8 lg:pt-16 pb-8 lg:pb-16">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-0 text-center">
        <h1 class="text-navy-blue font-bold text-3xl lg:text-7xl leading-tight lg:leading-[64px] mb-4 lg:mb-8">
            Trans Empowerment Initiative (TEI)
        </h1>

        <p class="text-navy-blue text-xl lg:text-[32px] leading-relaxed lg:leading-[32px] max-w-4xl mx-auto px-4">
            Uplifting Trans Masculine Voices. Building Power, Dignity, and Belonging in East Africa.
        </p>
    </div>
</section>

<!-- Hero Images Grid -->
<section class="relative">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-0 h-auto">
        <img class="w-full" src="<?php echo get_image_url('hero-img-1.jpg'); ?>" alt="first transmale" />
        <img class="w-full" src="<?php echo get_image_url('hero-img-2.jpg'); ?>" alt="second transmale" />
        <img class="w-full" src="<?php echo get_image_url('hero-img-3.jpg'); ?>" alt="third transmale" />
        <img class="w-full" src="<?php echo get_image_url('hero-img-4.jpg'); ?>" alt="forth transmale" />
    </div>
</section>

<!-- About Section -->
<section id="about" class="lg:px-12 px-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 items-center">
        <!-- Left Content -->
        <div class="space-y-6 my-8 lg:my-0">
            <p class="font-bold text-maroon text-lg tracking-widest">
                ABOUT US
            </p>

            <h2 class=" font-medium text-dark text-xl lg:text-[40px] leading-tight">
                We Support Trans Men, Transmasculine, and Gender Non-conforming (TGNC) Folks
            </h2>
        </div>

        <!-- Right Content -->
        <div class="bg-pink p-6 lg:p-16 relative overflow-hidden">

            <div class="relative space-y-6">
                <h3 class=" font-medium text-dark text-xl lg:text-[24px] leading-normal">
                    Trans Empowerment Initiative (TEI) is a queer and trans youth-led collective and registered Community-Based Organization (CBO) based in Kenya, operating since 2019
                </h3>

                <p class=" text-dark text-base lg:text-base leading-normal">
                    We work across East Africa to empower and support trans men, transmasculine, and gender non-conforming (TGNC) folks especially those who are refugees, asylum seekers, internally displaced, undocumented, and facing extreme marginalization.
                </p>

                <div class="pt-4">
                    <p class="font-medium text-maroon cursor-pointer">
                        LEARN MORE
                    </p>
                    <div class="bg-maroon h-[2px] w-[100px] mt-1"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="relative lg:px-12 px-6 mt-8 lg:mt-0">
    <div class="grid lg:grid-cols-2 grid-cols-1">
        <img class="w-full lg:h-[500px] h-[300px] object-cover" src="<?php echo get_image_url('group-session.jpg'); ?>" alt="group meeting">
        <div class="relative lg:h-full h-[300px]">
            <div class="absolute inset-0 bg-mustard z-0"></div>
            <img
                class="absolute inset-0 w-full h-full object-cover opacity-60 z-10"
                src="<?php echo get_image_url('map-bg.png'); ?>"
                alt="map background" />
            <!-- text content on top -->
            <div class="relative z-20 grid grid-cols-2 gap-16 lg:py-20 py-5 text-center text-dark">
                <div class="space-y-2">
                    <p class="font-medium text-4xl lg:text-[70px]">300</p>
                    <p class="font-medium text-lg lg:text-[20px]">Chest Binders</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-4xl lg:text-[70px]">1</p>
                    <p class="font-medium text-lg lg:text-[20px]">Shelter</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-4xl lg:text-[70px]">100+</p>
                    <p class="font-medium text-lg lg:text-[20px]">Trans folk supported</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-4xl lg:text-[70px]">5</p>
                    <p class="font-medium text-lg lg:text-[20px]">Volunteers</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Projects Section -->
<section id="projects" class="py-12 lg:py-24">
    <div class="mx-auto px-4 lg:px-0">
        <div class="text-center mb-12">
            <p class="font-medium text-maroon text-xl tracking-widest mb-4">
                EXPLORE
            </p>
            <h2 class="font-semibold text-dark text-2xl lg:text-[32px] tracking-[3.2px] uppercase">
                LATEST PROJECTS
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:px-12 px-6">
            <?php
            $project_query = new WP_Query(array(
                'post_type'      => 'project',
                'posts_per_page' => 3,
            ));

            if ($project_query->have_posts()) :
                while ($project_query->have_posts()) : $project_query->the_post(); ?>
                    <div class="space-y-4">
                        <div class="h-[200px] lg:h-[264px] bg-[#d9d9d9] overflow-hidden">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover'));
                            } else {
                                // fallback image if no featured image set
                                echo '<img src="https://via.placeholder.com/406x264?text=No+Image" alt="' . esc_attr(get_the_title()) . '" class="w-full h-full object-cover" />';
                            }
                            ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="group">
                            <h3 class="font-medium text-maroon group-hover:text-navy-blue text-xl leading-normal">
                                <?php the_title(); ?>
                            </h3>
                            <p class="font-medium text-grey group-hover:text-navy-blue cursor-pointer">
                                Read More →
                            </p>
                        </a>
                    </div>
            <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>

        </div>

        <div class="text-center mt-6">
            <a href="" class="button bg-maroon">
                All Projects
            </a>
        </div>
    </div>
</section>

<!-- Need Shelter Section -->
<section id="housing" class="relative lg:px-12 px-6">
    <div class="grid sm:gap-3 sm:grid-cols-[1fr_0.1fr_1fr] sm:grid-rows-[0.10fr_1fr]">
        <h2 class="text-maroon tracking-widest font-bold px-4 my-2 sm:col-start-1 sm:col-end-2 sm:row-start-1 sm:row-end-2">NEED SHELTER</h2>
        <div class="grid gap-3 bg-mustard p-10 sm:col-start-1 sm:col-end-3 sm:row-start-2 sm:row-end-3 z-1">
            <p>
                Are you a transmasculine/gender non-conforming person in Nairobi who urgently needs short-term safe housing?
                Click the link below to learn about our shelter
            </p>
            <div>
                <button class="button bg-maroon">
                    Our Shelter
                </button>
            </div>
        </div>
        <div class="sm:col-start-2 sm:col-end-4 sm:row-start-1 sm:row-end-3 overflow-hidden">
            <img class="w-auto h-full object-cover" src="<?php echo get_image_url('shelter-lady.jpg'); ?>" alt="">
        </div>
    </div>
</section>


<!-- Get Involved Section -->
<section id="involved" class="mt-16 py-8 lg:py-16 bg-navy-blue/10">
    <div class="lg:w-3/4 w-full mx-auto lg:px-0 px-8">
        <div class="text-center mb-12">
            <h2 class="font-bold text-maroon text-xl tracking-widest mb-4">
                GET INVOLVED
            </h2>
            <p class="text-dark text-lg max-w-2xl mx-auto">
                Help us support our organization either as a volunteer or fundraising for our various projects
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Give Money -->
            <div class="relative">
                <div class="relative">
                    <img src="<?php echo get_image_url('give-money.jpg'); ?>"
                        alt="Give Money"
                        class="w-full h-full object-cover">
                    <div class="absolute bottom-4 left-8 flex items-end">
                        <div class="text-left space-y-4">
                            <!-- Donate Icon -->
                            <img src="<?php echo get_image_url('money-icon.svg'); ?>"
                                alt="money icon" />
                            <h3 class=" font-semibold text-white text-xl lg:text-[32px]">
                                Give Money
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="mt-4 space-y-3">
                    <p class=" text-dark leading-normal">
                        Support the trans-masculine community. Your cash will aid our projects
                    </p>
                    <a href="" class="button bg-maroon mt-2">
                        Donate
                    </a>
                </div>
            </div>

            <!-- Give Time -->
            <div class="relative">
                <div class="relative">
                    <img src="<?php echo get_image_url('give-time.jpg'); ?>"
                        alt="Give Money"
                        class="w-full h-full object-cover">
                    <div class="absolute bottom-4 left-8 flex items-end">
                        <div class="text-left space-y-4">
                            <!-- Donate Icon -->
                            <img src="<?php echo get_image_url('time-icon.svg'); ?>"
                                alt="time icon" />
                            <h3 class=" font-semibold text-white text-xl lg:text-[32px]">
                                Give Time
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="mt-4 space-y-3">
                    <p class="text-dark leading-normal">
                        Share your time. Share your talents. Share your love for community.
                    </p>
                    <a href="" class="button bg-navy-blue mt-2">
                        Volunteer
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>