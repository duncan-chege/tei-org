<?php get_header(); ?>

<!-- Hero Section -->
<section id="hero">
    <div class="mx-auto text-center pt-8 lg:pt-16 pb-8 lg:pb-16 px-6 lg:px-0">
        <h1 class="text-navy-blue font-bold text-3xl lg:text-7xl leading-tight lg:leading-[64px] mb-4 lg:mb-8">
            Housing Request
        </h1>
    </div>

    <div class="bg-fixed bg-cover bg-top h-[300px] lg:h-[400px]" style="background-image: url('<?php echo get_image_url('housing-request-hero.jpg'); ?>');"></div>
</section>

<section class="lg:px-12 px-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-8 gap-0 lg:my-16 items-center">
        <div class="space-y-6 my-8 lg:my-0">
            <h5 class="text-maroon">
                OUR SAFE HOUSE
            </h5>

            <p>
                Our safehouse in Nairobi provides a temporary shelter where transmasculine/gender non-conforming individuals can live free from violence, experience autonomy, and fully express their identities.
            </p>
        </div>

        <img class="w-full lg:h-[500px] h-[300px] object-cover object-top" src="<?php echo get_image_url('our-story-bg.jpg'); ?>" alt="our story image" />
    </div>
</section>

<?php get_footer(); ?>