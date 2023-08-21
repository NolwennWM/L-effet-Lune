<?php 
/**
 * Template gérant l'affichage de l'en-tête du site.
 *  
 * @package WordPress
 * @subpackage Blue Letter Cave
 * @since Blue Letter Cave 0.1
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
            <h1>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </h1>
            
        
            <nav id="header-navigation">
                <button class="burger">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>
                <?php if (!is_woocommerce() && has_nav_menu('primary')) : ?>
                    <?php wp_nav_menu(
                        [
                            'theme_location' => 'primary',
                            'menu_class' => 'menu',
                        ]) ?>
                <?php elseif(is_woocommerce() && has_nav_menu("shop")): ?>
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
    