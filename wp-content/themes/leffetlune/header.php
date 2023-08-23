<?php 
/**
 * Template gérant l'affichage de l'en-tête du site.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>const test = "coucou";</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <div class="page">
        <canvas id="background"></canvas>
        <!-- Header -->
        <header class="header">
            <?php 
                if(function_exists('the_custom_logo'))the_custom_logo();
            ?>
            <h1 class="site-title"><?php bloginfo('name') ?></h1>
            <p class="site-slogan"><?php bloginfo("description") ?></p>
            <nav id="header-navigation">
                <button class="burger">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>
                <?php if ( !is_commerce_related() && has_nav_menu('primary')) : ?>
                    <?php wp_nav_menu(
                        [
                            'theme_location' => 'primary',
                            'menu_class' => 'menu',
                        ]) ?>
                <?php elseif(is_commerce_related() && has_nav_menu("shop")): ?>
                    <?php  wp_nav_menu(
                        [
                            'theme_location' => 'shop',
                            'menu_class' => 'menu',
                        ]) ?>
                <?php endif; ?>
            </nav> <!-- #header-navigation -->
        </header> <!-- .header -->
        <!-- Contenu de la page -->
        <main class="content">
    