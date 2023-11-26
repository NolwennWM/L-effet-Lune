<?php 
add_action( 'admin_menu', 'slider_options_page' );
add_action( 'admin_init', 'slider_settings_init');
add_action( 'admin_enqueue_scripts', 'nwm_register_admin_assets' );

add_shortcode("nwmslider", "get_slider");
/**
 * Callback du shortcode affichant le slider
 *
 * @return void
 */
function get_slider()
{
    $imgs = get_slider_images("large");
    if(isEmptySlider($imgs))return;
    get_template_part("template/slider", null, $imgs);
}
/**
 * Vérifie si le slider est vide.
 *
 * @param null|array $content contenu du slider sous forme de tableau
 * @return boolean true si vide.
 */
function isEmptySlider(null|array $content): bool
{
    return !$content || !$content["images"] || !$content["count"];
}
/**
 * Récupère les images du slider au format HTML.
 * Ainsi que le total d'image et les ids
 *
 * @param string $size Taille des images
 * @return array|null tableau de contenu du slider ou null
 */
function get_slider_images($size="thumbnail"): array|null
{
    $content = "";
    $imagesOption = get_option('slider_images');
    $imagesId = explode(",", $imagesOption);
    $count = count($imagesId);
    if(!$count)return null;
    foreach($imagesId as $id)
    {
        $content .=  wp_get_attachment_image((int)$id, $size);
    }
    return ["images"=>$content, "count"=>$count, "option"=>$imagesOption];
}
/**
 * Affiche la page d'option du slider.
 *
 * @return void
 */
function slider_options_page_html() {
    // var_dump("output")
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg_options"
            settings_fields( 'slider_settings_field' );
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections( 'slider' );
            // output save settings button
            submit_button( __( 'Sauvegarder Paramètre', 'textdomain' ) );
            ?>
        </form>
    </div>
    <?php
}
/**
 * Affiche le menu d'option du slider dans l'administration
 *
 * @return void
 */
function slider_options_page() 
{
    $gem_icon = "data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgMjAwIDIwMCIgd2lkdGg9IjIwMCIgaGVpZ2h0PSIyMDAiIHN0cm9rZS13aWR0aD0iMTAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+DQogIDxwb2x5Z29uIHN0cm9rZT0iIzFkMjMyNyIgZmlsbD0ibm9uZSIgcG9pbnRzPSI2MCA1LCAxNDAgNSwgMTk1IDYwLCAxOTUgMTQwLCAxNDAgMTk1LCA2MCAxOTUsIDUgMTQwLCA1IDYwLCA2MCA1Ii8+DQogIDxwb2x5Z29uIHN0cm9rZT0iIzFkMjMyNyIgZmlsbD0ibm9uZSIgcG9pbnRzPSI3NSAzNSwgMTI1IDM1LCAxNjUgNzUsIDE2NSAxMjUsIDEyNSAxNjUsIDc1IDE2NSwgMzUgMTI1LCAzNSA3NSwgNzUgMzUiLz4NCiAgPGxpbmUgc3Ryb2tlPSIjMWQyMzI3IiB4MT0iNjAiIHkxPSI1IiB4Mj0iNzUiIHkyPSIzNSIvPg0KICA8bGluZSBzdHJva2U9IiMxZDIzMjciIHgxPSIxNDAiIHkxPSI1IiB4Mj0iMTI1IiB5Mj0iMzUiLz4NCiAgPGxpbmUgc3Ryb2tlPSIjMWQyMzI3IiB4MT0iMTk1IiB5MT0iNjAiIHgyPSIxNjUiIHkyPSI3NSIvPg0KICA8bGluZSBzdHJva2U9IiMxZDIzMjciIHgxPSIxOTUiIHkxPSIxNDAiIHgyPSIxNjUiIHkyPSIxMjUiLz4NCiAgPGxpbmUgc3Ryb2tlPSIjMWQyMzI3IiB4MT0iMTQwIiB5MT0iMTk1IiB4Mj0iMTI1IiB5Mj0iMTY1Ii8+DQogIDxsaW5lIHN0cm9rZT0iIzFkMjMyNyIgeDE9IjYwIiB5MT0iMTk1IiB4Mj0iNzUiIHkyPSIxNjUiLz4NCiAgPGxpbmUgc3Ryb2tlPSIjMWQyMzI3IiB4MT0iNSIgeTE9IjE0MCIgeDI9IjM1IiB5Mj0iMTI1Ii8+DQogIDxsaW5lIHN0cm9rZT0iIzFkMjMyNyIgeDE9IjUiIHkxPSI2MCIgeDI9IjM1IiB5Mj0iNzUiLz4NCjwvc3ZnPg==";

    add_menu_page(
        'Slider',
        'Slider Options',
        'manage_options',
        'slider',
        'slider_options_page_html',
        $gem_icon,
        20
    );
}
/**
 * Ajoute le javascript sur la page d'option du slider
 *
 * @return void
 */
function nwm_register_admin_assets($hook_suffix)
{
    if($hook_suffix !== "toplevel_page_slider")return;
    if ( ! did_action( 'wp_enqueue_media' ) ) 
    {
		wp_enqueue_media();
	}
    wp_enqueue_style( "slideradmin", get_template_directory_uri()."/css/admin.css");
    wp_enqueue_script( 
		'mediauploading', 
		get_stylesheet_directory_uri() . '/js/jquery_slider_admin.js',
		array( 'jquery' )
	);
}
/**
 * Initialise les options de la page de paramétrage du slider.
 *
 * @return void
 */
function slider_settings_init()
{
    // register a new setting for "reading" page
    register_setting('slider_settings_field', 'slider_images', ["type"=>"array"]);

    // register a new section in the "reading" page
    add_settings_section(
        'slider_settings_section',
        'Slider Settings Section', 'slider_settings_section_callback',
        'slider'
    );

    // register a new field in the "slider_settings_section" section, inside the "reading" page
    add_settings_field(
        'slider_settings_field',
        'Slider Setting', 'slider_settings_field_callback',
        'slider',
        'slider_settings_section'
    );
}
/**
 * Affiche le titre de la section de paramétrage du slider.
 *
 * @return void
 */
function slider_settings_section_callback() 
{
	echo '<p>Selection des images du slider.</p>';
}
/**
 * Affiche le champ de paramétrage des images du slider.
 *
 * @return void
 */
function slider_settings_field_callback() 
{
    $setting = get_slider_images();
	?>
    <a href="#" class="button slider-upload">Modifier image</a>
    <div class="slider-preview"><?php echo isEmptySlider($setting)?"":$setting["images"] ?></div>
    <input type="hidden" class="slider_img" name="slider_images" value="<?php echo !isEmptySlider($setting) ? esc_attr( $setting["option"] ) : '';  ?>">
    <?php
}
?>