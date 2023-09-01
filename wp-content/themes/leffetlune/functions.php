<?php 
add_theme_support( 'post-thumbnails' );

add_theme_support( 'title-tag' );

add_action( 'wp_enqueue_scripts', 'nwm_register_assets' );
add_action( 'after_setup_theme', 'nwm_theme_setup' );

add_filter("script_loader_tag", "nwm_filter_script_tags", 10, 3);

add_shortcode("nwmslider", "get_slider");
/**
 * Ajoute les scripts et styles.
 *
 * @return void
 */
function nwm_register_assets()
{
    wp_enqueue_style( "main", get_stylesheet_uri());
    wp_enqueue_style( "index", get_template_directory_uri()."/css/index.css");
    wp_enqueue_script("index", get_template_directory_uri()."/js/index.js");
}
/**
 * Filtre les balises scripts pour y ajouter le type module et l'attribut defer
 *
 * @param string $tag
 * @param string $handle
 * @param string $src
 * @return string
 */
function nwm_filter_script_tags(string $tag, string $handle, string $src):string
{
    if($handle !== "index") return $tag;
    return '<script src="'. esc_url($src).'" type="module" defer></script>';
}
/**
 * Paramètre le thème.
 *
 * @return void
 */
function nwm_theme_setup(): void
{
    register_nav_menus(
        [
            'primary' => __( 'Primary Menu', 'leffetlune' ),
            'social'  => __( 'Social Links Menu', 'leffetlune' ),
            'shop'  => __( 'Shop Links Menu', 'leffetlune' ),
            'footer'  => __( 'Footer Links Menu', 'leffetlune' ),
        ]
    );
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 240,
            'width'       => 240,
            'flex-height' => true,
        )
    );
}
/**
 * Vérifie si on est sur une page liée à la boutique.
 *
 * @return boolean
 */
function is_commerce_related():bool
{
    return is_woocommerce() || is_cart() || is_checkout() || is_account_page();
}

function get_slider($attr, $content)
{
    $count = substr_count($content, "<img");
    if($count < 1)return;
    get_template_part("template/slider", null, ["images"=>$content, "count"=>$count]);
}
?>