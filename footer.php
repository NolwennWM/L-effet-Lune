<?php 
/**
 * Template gérant l'affichage du pied de page du site.
 */
?>        
        </main><!-- main.content -->
        <footer id="footer">
            <span class="footer-button">
                <img src="<?php echo get_template_directory_uri() ?>/assets/logo/gem.svg" alt="logo en forme de diamant">
            </span>
            <?php if(is_active_sidebar("sidebar-footer")):?>
                <div class="footer-widget">
                    <?php dynamic_sidebar("sidebar-footer");?>
                </div>
            <?php endif; ?>
            <div class="footer-menu">
                <?php if ( has_nav_menu( 'footer' ) ) : ?>
                    <nav class="footer-navigation">
                        <?php wp_nav_menu(
                            [
                                'theme_location' => 'footer'
                            ]) ?>
                    </nav>
                <?php endif; ?>
            </div>
            <div class="social-menu">
                <?php if ( has_nav_menu( 'social' ) ) : ?>
                    <nav class="social-navigation">
                        <?php wp_nav_menu(
                            [
                                'theme_location' => 'social',
                            ]) ?>
                    </nav>
                <?php endif; ?>
            </div>
            <div class="author">
                <a href="https://www.marquiset.fr" target="_blank">Thème Réalisé par Nolwenn WEBER-MARQUISET</a>
            </div>
        </footer>
    </div><!-- div.page -->
<?php wp_footer(); ?>
</body>
</html>