<?php 
/**
 * Template par défaut pour les pages listant les articles.
 */
get_header(); ?>

<?php if(have_posts()):  ?>
    <?php while(have_posts()): the_post(); ?>
    <?php endwhile; ?>
<?php elseif(is_commerce_related()): ?>
    Désolé, les fées ont pris tous ces articles. <br>
    Nous en ajouterons de nouveaux bientôt.
<?php else:?>
    Cette page ne contient aucun article.
<?php endif; ?>
<?php get_footer(); ?>