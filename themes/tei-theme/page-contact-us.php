<?php get_header(); ?>

<section id="hero">
    <div class="mx-auto text-center pt-8 lg:pt-16 pb-8 lg:pb-16 px-4 lg:px-0">
        <h1>
            Contact Us
        </h1>
    </div>

    <div class="bg-cover bg-top h-[300px] lg:h-[400px]" style="background-image: url('<?php echo get_image_url('contact-hero.jpg'); ?>');"></div>
</section>

<section class="lg:pr-12 pr-6 lg:pb-16 pb-8">
    <div class="lg:pl-12 pl-6 lg:my-16 my-6 text-center md:w-3/4 block mx-auto">
        <h2 class="text-maroon mb-8">Get In Touch</h2>
        <p class="text-maroon mb-8">We’d love to hear from you! Whether you’re seeking support, resources, or want to get involved with the Trans Empowerment
            Initiative, please reach out to us. Together, we can build a stronger, more inclusive community for trans masculine individuals.</p>
    </div>
    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-8 xl:w-5/6 pl-8 mx-auto text-navy-blue">
        <div class="md:text-center">
            <h3> Call Us</h3>
            <div class="flex gap-x-4 mt-2 md:justify-center items-center">
                <img class="w-[40px] h-[40px]" src="<?php echo get_image_url('call-icon.svg'); ?>" alt="call icon" />
                <p class="md:text-xl text-lg text-navy-blue">+254 111 393806</p>
            </div>
        </div>
        <div class="md:text-center">
            <h3>Email Us</h3>
            <div class="flex gap-x-4 mt-2 md:justify-center items-center">
                <img class="w-[40px] h-[40px]" src="<?php echo get_image_url('email-icon.svg'); ?>" alt="email icon" />
                <p class="md:text-xl text-lg text-navy-blue">info@transempowerment.com</p>
            </div>
        </div>
        <div class="md:text-center">
            <h3>Visit Us</h3>
            <div class="flex gap-x-4 mt-2 md:justify-center items-center">
                <img class="w-[40px] h-[40px]" src="<?php echo get_image_url('call-icon.svg'); ?>" alt="location icon" />
                <p class="md:text-xl text-lg text-navy-blue">Kiserian, Nairobi – Kenya</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer();  ?>