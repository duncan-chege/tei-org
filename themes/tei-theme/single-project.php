<?php get_header(); ?>

<div class="">
    <h1 class="text-4xl text-center mt-10 mb-8"><?php the_title(); ?></p>
</div>

<div class="py-10 bg-mustard/20 single-body">
    <?php the_post_thumbnail('full', ['style' => 'height: 400px; width: auto; display: block; margin: 0 auto;']); ?>

    <div class="lg:px-40 md:px-20 px-8 py-8">
        <?php echo get_the_content(); ?>
    </div>

    <div class="text-center mt-6">
        <a href="<?php echo site_url('/projects'); ?>" class="button bg-maroon">
            Back To Projects
        </a>
    </div>
</div>

<?php get_footer(); ?>