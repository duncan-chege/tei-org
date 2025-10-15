<?php get_header(); ?>

<!-- Hero Section -->
<section id="hero">
    <div class="mx-auto text-center pt-8 lg:pt-16 pb-8 lg:pb-16 px-4 lg:px-0">
        <h1 class="text-navy-blue font-bold text-3xl lg:text-7xl leading-tight lg:leading-[64px] mb-4 lg:mb-8">
            Housing Request
        </h1>
    </div>

    <div class="bg-cover bg-top h-[300px] lg:h-[400px]" style="background-image: url('<?php echo get_image_url('housing-request-hero.jpg'); ?>');"></div>
</section>

<section class="lg:pr-12">
    <div class="bg-mustard lg:pl-12 lg:px-0 px-4 grid grid-cols-1 lg:grid-cols-2 lg:gap-8 gap-0 lg:my-16 my-6 items-center">
        <div class="my-8 lg:my-0">
            <h5 class="text-maroon">
                OUR SAFE HOUSE
            </h5>

            <p>
                Our safehouse in Nairobi provides a temporary shelter where transmasculine/gender non-conforming
                individuals can live free from violence, experience autonomy, and fully express their identities.
            </p>

            <p>TEI is dedicated to providing a harassment-free physical and digital experience for everyone.
                We do not tolerate harassment of coordinators or residents in any form, and we will promptly
                remove anyone who does so. If you are being harassed, notice that someone else is being harassed,
                or have any other concerns, please contact us:</p>
        </div>

        <img class="w-full lg:h-auto h-[300px] object-cover object-top" src="<?php echo get_image_url('safe-house-bg.jpg'); ?>" alt="our story" />
    </div>
</section>

<div class="lg:px-12 px-4 xl:w-1/2 w-full mx-auto my-16">
    <h3 class="text-maroon mb-4">
        Fill in the form below if you need short term housing
    </h3>
    <div>
        <p class="my-4">Trans Empowerment Initiative is a collective of queer and trans youth mobilising to address our right to
            political education, health, wellness and housing in order to mitigate the challenges that leave us
            vulnerable to systemic oppression.</p>
        <p class="my-4">Our Nairobi-based safehouse provides a temporary shelter where trans/gender non-conforming individuals can live free from violence, experience
            autonomy and fully express their identities.</p>
        <p class="my-4">If you are in need of emergency housing, please submit this form and we will respond to your request
            within 24 hours. </p>
        <p class="font-bold">Please note :</p>
        <ul class="list-disc mt-4 mb-6">
            <li>The information provided is confidential and will only be accessed by the TEI Staff.</li>
            <li>The maximum housing period is 2 months</li>
            <li>Priority will be given to queer transmasc/trans men/gender non-conforming individuals</li>
        </ul>
    </div>
    <div>
        <?php echo do_shortcode('[forminator_form id="68"]'); ?>
    </div>
</div>

<?php get_footer(); ?>