<?php get_header(); ?>

<!-- Hero Section -->
<section id="hero">
    <div class="mx-auto text-center pt-8 lg:pt-16 pb-8 lg:pb-16 px-6 lg:px-0">
        <h1 class="text-navy-blue font-bold text-3xl lg:text-7xl leading-tight lg:leading-[64px] mb-4 lg:mb-8">
            About Us
        </h1>
    </div>

    <div class="bg-fixed bg-cover bg-top h-[400px]" style="background-image: url('<?php echo get_image_url('about-hero.jpg'); ?>');"></div>
</section>

<section class="lg:px-12 px-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-8 gap-0 lg:my-16 items-center">
        <div class="space-y-6 my-8 lg:my-0">
            <p class="text-maroon text-lg font-bold tracking-widest">
                OUR STORY
            </p>

            <h2 class="text-dark text-base lg:text-base leading-normal">
                Trans Empowerment Initiative (TEI) is a queer and trans youth-led collective and registered Community-Based Organization
                (CBO) based in Kenya, operating since 2019. We work across East Africa to empower and support trans men, transmasculine,
                and gender non-conforming (TGNC) folks especially those who are refugees, asylum seekers, internally displaced,
                undocumented, and facing extreme marginalization.
            </h2>
        </div>

        <img class="w-full lg:h-[500px] h-[300px] object-cover object-top" src="<?php echo get_image_url('our-story-bg.jpg'); ?>" alt="our story image" />
    </div>
</section>

<section class="lg:px-12 px-6 mt-12 lg:mt-0">
    <div class="grid sm:gap-3 sm:grid-cols-[1fr_0.1fr_1fr] sm:grid-rows-[0.10fr_1fr]">
        <div class="grid content-center gap-3 bg-mustard md:p-10 p-6 sm:col-start-1 sm:col-end-3 sm:row-start-2 sm:row-end-3 z-1">
            <p>
                We are a community that understands what it means to survive violence, exclusion, and systemic neglect.
                Many of our members have been pushed to the edges surviving homelessness, unemployment, internet trolling,
                substance abuse, and rejection even within LGBTQ+ circles. We bring our lived experiences into our
                organizing, transforming pain into purpose, and isolation into connection.
            </p>
        </div>
        <div class="sm:col-start-2 sm:col-end-4 sm:row-start-1 sm:row-end-3 overflow-hidden">
            <img class="w-full h-full object-cover" src="<?php echo get_image_url('community-img.jpg'); ?>" alt="">
        </div>
    </div>
</section>

<div class="md:grid md:grid-cols-[1fr_0.5fr_1fr] lg:px-12 px-6 md:my-20 my-8 md:items-center">
    <div class="md:shadow-md md:p-8 p-6 mission">
        <h3 class="mb-2 text-maroon text-center text-lg tracking-widest font-bold">MISSION</h3>
        <p>To build and strengthen affirming, empowering, and transformative spaces for transmasculine and TGNC communities in East Africa through grassroots organizing, radical care, advocacy, and capacity building while advancing our collective journey toward liberation.</p>
    </div>
    <div class="w-full h-full overflow-hidden mx-auto">
        <img class="h-full object-cover" src="<?php echo get_image_url('mission-vision-img.jpg'); ?>" alt="">
    </div>
    <div class="md:shadow-md md:p-8 p-6 vision">
        <h3 class="mb-2 text-maroon text-center text-lg tracking-widest font-bold">VISION</h3>
        <p>A just and liberated East Africa where trans men, transmasculine, and gender non-conforming people live with dignity, safety, and full access to health, housing, education, and economic opportunity free from violence, stigma, and systemic oppression.</p>
    </div>
</div>

<div class="bg-pink/50 mt-16 py-8 lg:py-16 px-6">
    <h2 class="font-bold text-center text-dark text-xl tracking-widest mb-10">
        OUR CORE VALUES
    </h2>

    <div class="lg:w-4/5 mx-auto">
        <div class="grid md:grid-cols-2 grid-cols-1 md:gap-8 md:mb-10 gap-6 mb-6 divide-solid divide-maroon md:divide-x-3">
            <div class="flex items-center gap-4 pr-6">
                <img class="h-fit" src="<?php echo get_image_url('compassion-icon.svg'); ?>" alt="">
                <div class="">
                    <h4 class="text-maroon text-lg font-bold"> Compassion & Care </h4>
                    <p class="tracking-normal">We lead with empathy, tending to each individual with curiosity and kindness.</p>
                </div>
            </div>
            <div class="flex items-center gap-4 lg:pl-6">
                <img class="h-fit" src="<?php echo get_image_url('community-led-icon.svg'); ?>" alt="">
                <div class="">
                    <h4 class="text-maroon text-lg font-bold"> Community Led Solutions </h4>
                    <p>We believe those most affected must be at the forefront of shaping responses to our challenges.</p>
                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 md:gap-8 md:mb-10 gap-6 mb-6 divide-solid divide-maroon md:divide-x-3">
            <div class="flex items-center gap-4 pr-6">
                <img class="h-fit" src="<?php echo get_image_url('intersectionality-icon.svg'); ?>" alt="">
                <div class="">
                    <h4 class="text-maroon text-lg font-bold"> Intersectionality </h4>
                    <p class="tracking-normal">Our work acknowledges and addresses the multiple layers of oppression our community faces.</p>
                </div>
            </div>
            <div class="flex items-center gap-4 lg:pl-6">
                <img class="h-fit" src="<?php echo get_image_url('radical-icon.svg'); ?>" alt="">
                <div class="">
                    <h4 class="text-maroon text-lg font-bold"> Radical Honesty & Visibility </h4>
                    <p>We tell our truths, document our stories, and affirm our existence unapologetically.</p>
                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 md:gap-8 md:mb-10 gap-6 mb-6 divide-solid divide-maroon md:divide-x-3">
            <div class="flex items-center gap-4 pr-6">
                <img class="h-fit" src="<?php echo get_image_url('liberation-icon.svg'); ?>" alt="">
                <div class="">
                    <h4 class="text-maroon text-lg font-bold"> Liberation-Oriented </h4>
                    <p class="tracking-normal">Our work is part of a broader struggle to dismantle all systems of oppression, from transphobia and sexism to colonialism and capitalism.</p>
                </div>
            </div>
            <div class="flex items-center gap-4 lg:pl-6">
                <img class="h-fit" src="<?php echo get_image_url('solidarity-icon.svg'); ?>" alt="">
                <div class="">
                    <h4 class="text-maroon text-lg font-bold"> Solidarity & Collective Power </h4>
                    <p>We grow stronger through connection, collaboration, and mutual support.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>