<?php 
/**
 * Template par défaut pour les pages listant les articles.
 */
get_header(); ?>
<p>Ceci est ma liste d'article.</p>
<?php if(have_posts()):  ?>
    <?php while(have_posts()): the_post(); ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php wp_footer(); ?>