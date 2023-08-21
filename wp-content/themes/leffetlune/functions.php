<?php 
add_theme_support( 'post-thumbnails' );

add_theme_support( 'title-tag' );

add_action( 'wp_enqueue_scripts', 'nwm_register_assets' );
add_action( 'after_setup_theme', 'nwm_theme_setup' );

add_filter("script_loader_tag", "nwm_filter_tags", 10, 3);

function nwm_register_assets()
{
    wp_enqueue_style( "main", get_stylesheet_uri());
    wp_enqueue_style( "index", get_template_directory_uri()."/css/index.css");
    wp_enqueue_script("index", get_template_directory_uri()."/js/index.js");
}
function nwm_filter_tags($tag, $handle, $src)
{
    if($handle !== "index") return $tag;
    return '<script src="'. esc_url($src).'" type="module" defer></script>';
}
function nwm_theme_setup()
{
    register_nav_menus(
        [
            'primary' => __( 'Primary Menu', 'leffetlune' ),
            'social'  => __( 'Social Links Menu', 'leffetlune' ),
            'shop'  => __( 'Shop Links Menu', 'leffetlune' ),
            'footer'  => __( 'Footer Links Menu', 'leffetlune' ),
        ]
    );
}

?>