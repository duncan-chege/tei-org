<?php get_header(); ?>

<!-- Hero Section -->
<section id="hero">
    <div class="mx-auto text-center pt-8 lg:pt-16 pb-8 lg:pb-16 px-6 lg:px-0">
        <h1 class="text-navy-blue font-bold text-3xl lg:text-7xl leading-tight lg:leading-[64px] mb-4 lg:mb-8">
            Our Projects
        </h1>
    </div>

    <div class="bg-cover bg-top h-[300px] lg:h-[400px]" style="background-image: url('<?php echo get_image_url('projects-hero.jpg'); ?>');"></div>
</section>

<div class="lg:px-12 px-6 lg:my-16 my-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:px-12">
        <?php
        $project_query = new WP_Query(array(
            'post_type'      => 'project',
            'posts_per_page' => -1,
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
                        <h4 class="text-maroon group-hover:text-navy-blue">
                            <?php the_title(); ?>
                        </h4>
                        <p class="text-sm text-gray-600! mb-2">
                            <?php echo wp_trim_words(get_the_content(), 15, '...'); ?>
                        </p>
                        <p class="font-medium text-grey! group-hover:text-navy-blue cursor-pointer">
                            Read More →
                        </p>
                    </a>
                </div>
        <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>

    </div>
</div>

<?php get_footer(); ?>