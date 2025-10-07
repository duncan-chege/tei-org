<?php get_header(); ?>

<!-- Hero Section -->
<section id="hero">
    <div class="mx-auto text-center pt-8 lg:pt-16 pb-8 lg:pb-16 px-6 lg:px-0">
        <h1 class="text-navy-blue font-bold text-3xl lg:text-7xl leading-tight lg:leading-[64px] mb-4 lg:mb-8">
            <?php the_title(); ?>
        </h1>
    </div>

    <div class="bg-cover bg-top h-[300px] lg:h-[400px]" style="background-image: url('<?php echo get_image_url('donate-hero.jpg'); ?>');"></div>
</section>

<section class="lg:pr-12">
    <div class="bg-mustard lg:pl-12 grid grid-cols-1 lg:grid-cols-2 lg:gap-8 gap-0 lg:my-16 my-6 items-center">
        <div class="space-y-6 my-8 lg:my-0">
            <h5 class="text-maroon">
                DONOR CALL OUT
            </h5>
            <p>
                Join our global network of donors! Individual support is essential to sustaining our urgent mission.
            </p>

            <p>TEI’s work is conducted by volunteers and community members - we have no office or paid staff members. This means that all funds
                raised go directly to supporting our community.</p>
        </div>

        <img class="w-full lg:h-auto h-[300px] object-cover object-top" src="<?php echo get_image_url('donation-call-out.jpg'); ?>" alt="a lady posing for a photo" />
    </div>
</section>

<div class="lg:px-12 px-6 lg:pb-16 pb-8">
    <div class="grid md:grid-cols-2 grid-cols-1 gap-x-8 gap-y-6">
        <div>
            <h4 class="text-maroon pb-8">
                Support Our Safehouse
            </h4>
            <p>We call on community support to sustain our trans safehouse in Nairobi by contributinng funds toward the rent, utilities, food,
                sanitary supplies, and emergency costs of our residents.</p>
        </div>
        <div class="bg-maroon text-white p-10 text-center">
            <h4>Send your contributions via Mpesa to:</h4>
            <div class="flex text-white gap-x-4 justify-center py-4">
                <p class="text-white text-xl">Night Okindo</p>
                <p class="font-bold text-white text-xl">0111393806</p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>