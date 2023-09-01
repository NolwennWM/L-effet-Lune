<?php 
/**
 * Template par défaut pour les pages indépendante.
 */
get_header(); ?>
<p>Ceci est ma page indépendante.</p>
<?php if(have_posts()):  ?>
    <?php while(have_posts()): the_post(); ?>

    <div class="default-content">
        <h2 class="page-title">
            <?php the_title(); ?>
        </h2>
        <div class="page-content">
            <?php the_content(); ?>
        </div>
    </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>