<?php get_header(); ?>

<section id="hero">
    <div class="mx-auto text-center pt-8 lg:pt-16 pb-8 lg:pb-16 px-4 lg:px-0">
        <h1>
            Become A Volunteer
        </h1>
    </div>

    <div class="bg-cover bg-top h-[300px] lg:h-[400px]" style="background-image: url('<?php echo get_image_url('volunteer-hero.jpg'); ?>');"></div>
</section>

<section class="lg:pr-12 pr-6">
    <div class="lg:pl-12 pl-6 grid grid-cols-1 lg:grid-cols-2 lg:gap-8 gap-0 lg:my-16 my-6">
        <div class="bg-light-blue text-dark space-y-3 my-8 lg:my-0 lg:py-8 py-4 lg:px-10 px-4">
            <h5 class="text-navy-blue mb-6 mt-2">
                VOLUNTEER CALL OUT
            </h5>

            <p>
                The Trans Empowerment Initiative is powered by community. We’re looking for passionate volunteers who
                believe in creating safer, affirming spaces for trans masculine people to thrive.
            </p>

            <p>Whether you have skills in organizing, outreach, social media, fundraising, or simply a desire to give your
                time and energy, your contribution can make a huge difference.</p>

            <p>By volunteering, you’ll:</p>
            <ul class="list-disc">
                <li>Help build visibility and support for trans masculine voices.</li>
                <li>Gain experience in advocacy and community organizing.</li>
                <li>Connect with a network of people committed to empowerment and change.</li>
            </ul>
            <p>No matter your background or skill set, there’s a place for you here. Together, we can create impact and strengthen our community.</p>
        </div>
        <div>
            <?php echo do_shortcode('[forminator_form id="113"]'); ?>
        </div>
    </div>
</section>

<?php get_footer();  ?>