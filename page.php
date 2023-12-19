<?php 
/**
 * Template par défaut pour les pages indépendante.
 */
get_header(); ?>

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
<?php elseif(is_commerce_related()): ?>
    Désolé, les fées ont pris tous ces articles. <br>
    Nous en ajouterons de nouveaux bientôt.
<?php else:?>
    Cette page ne contient aucun article.
<?php endif; ?>
<?php get_footer(); ?>