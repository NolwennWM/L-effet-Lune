<?php 
/**
 * Template par défaut pour les pages indépendante.
 */
get_header(); ?>
<p>Ceci est ma page indépendante.</p>
<?php if(have_posts()):  ?>
    <?php while(have_posts()): the_post(); ?>

    <?php the_title(); ?>
    <?php the_content(); ?>

    <?php endwhile; ?>
<?php endif; ?>
<?php wp_footer(); ?>