<?php 
/**
 * Template gérant la page d'accueil.
 */
get_header(); ?>
<p>Ceci est ma page d'accueil</p>
<?php if(have_posts()):  ?>
    <?php while(have_posts()): the_post(); ?>

    <?php the_title(); ?>
    <div class="default-content">
        <?php the_content(); ?>
    </div>

    <?php endwhile; ?>
<?php endif; ?>
<?php wp_footer(); ?>