<?php 
/**
 * Template par défaut pour le détail d'un article.
 */
get_header(); ?>
<p>Ceci est le détail d'un article.</p>
<?php if(have_posts()):  ?>
    <?php while(have_posts()): the_post(); ?>

    <?php the_title(); ?>
    <?php the_content(); ?>

    <?php endwhile; ?>
<?php endif; ?>
<?php wp_footer(); ?>