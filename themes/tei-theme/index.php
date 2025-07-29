<?php get_header(); ?>

<main id="main-content" class="mx-auto px-4 py-8">

    <?php if (have_posts()) : ?>
        <header class="mb-8">
            <h1 class="text-3xl font-bold"><?php single_post_title(); ?></h1>
        </header>

        <div class="space-y-8">
            <?php
            // Start the Loop
            while (have_posts()) :
                the_post();
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('prose max-w-none'); ?>>

                    <div class="mb-4 text-gray-700">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="text-cyan-600 hover:text-cyan-800 font-medium">
                        Read More &rarr;
                    </a>
                </article>
            <?php endwhile; ?>
        </div>

    <?php else : ?>
        <section class="text-center py-20">
            <h2 class="text-2xl font-bold mb-4">Nothing Found</h2>
            <p class="mb-4">Sorry, no posts matched your criteria.</p>
        </section>
    <?php endif; ?>

</main>


<?php get_footer(); ?>