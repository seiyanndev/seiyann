<?php get_header(); ?>

<main id="main" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content(); // Elementor or WP editor content goes here
    endwhile;
    ?>
</main>

<?php get_footer(); ?>