<?php

/**
 * Style Maven functions and definitions
 *  @package Style Maven
 */

/**
 * Register Custom Navigation Walker
 */

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/required-plugins.php';
if (!file_exists(get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php')) {
    // File does not exist... return an error.
    return new WP_Error('class-wp-bootstrap-navwalker-missing', esc_html('It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'style-maven'));
} else {
    // File exists... require it.
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

//customerizer includes
require_once get_template_directory() . '/inc/customizer.php';

if (!isset($content_width))
    $content_width = 600;


add_theme_support('title-tag');



if (!function_exists('style_maven_scripts')) {
    /**
     * Insert comments here
     */
    function style_maven_scripts()
    {
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/inc/bootstrap.min.js', ['jquery'], '4.3.1', true);
        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', [], '4.3.1', 'all');
        wp_enqueue_style('style-maven-style', get_stylesheet_uri(), [], filemtime(get_template_directory() . '/style.css'), 'all');

        //Flexslider files
        wp_enqueue_script('flexslider-min-js', get_template_directory_uri() . '/inc/flexslider/jquery.flexslider-min.js', ['jquery'], '', true);
        wp_enqueue_style('flexslider-css', get_template_directory_uri() . '/inc/flexslider/flexslider.css', [], '', 'all');
        wp_enqueue_script('flexslider.js', get_template_directory_uri() . '/inc/flexslider/flexslider.js', ['jquery'], '', true);

        if (is_singular() && comments_open() && get_option('thread_coments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    add_action('wp_enqueue_scripts', 'style_maven_scripts');
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function style_maven_config()
{

    register_nav_menus(
        array(
            'style_maven_main_menu' => esc_html('Style Maven Main Menu', 'style-maven'),
            'style_maven_footer_menu' => esc_html__('Style Maven Footer Menu', 'style-maven')

        )
    );

    $textdomain = "style-maven";
    //child theme
    load_theme_textdomain($textdomain, get_stylesheet_directory() . '/languages/');
    //parent
    load_theme_textdomain($textdomain, get_template_directory() . '/languages/');
}
add_action('after_setup_theme', 'style_maven_config', 0);


function mytheme_add_woocommerce_support()
{
    //custom logo
    add_theme_support(
        'custom-logo',
        array(
            'height' => 85,
            'width' => 160,
            'flex-height' => true,
            'flex-width' => true,
        )
    );
    add_theme_support('post-thumbnails');
    add_image_size('style-maven-slider', 1920, 800, ['center', 'center']);
    add_image_size('style-maven-blog', 960, 640, ['center', 'center']);

    add_theme_support(
        'woocommerce',
        array(
            'thumbnail_image_width' => 255,
            'single_image_width'    => 255,
            'product_grid'          => array(
                'default_rows'    => 10,
                'min_rows'        => 5,
                'max_rows'        => 10,
                'default_columns' => 1,
                'min_columns'     => 1,
                'max_columns'     => 1
            ),
        )
    );

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('automatic-feed-links');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support', 0);

//check if woocommerce exists

if (class_exists("WooCommerce")) {
    require get_template_directory() . '/inc/wc-modifications.php';
}


/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();

?>
    <span class="items"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
<?php
    $fragments['span.items'] = ob_get_clean();
    return $fragments;
}


add_action('widgets_init', 'style_maven_sidebars');

function style_maven_sidebars()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Style Maven Main Sidebar', 'style-maven'),
            'description'   => esc_html__('Drag and drop widgets here', 'style-maven'),
            'id'            => 'style-maven-sidebar-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>'
        )
    );


    register_sidebar(
        array(
            'name'          => esc_html__('Style Maven Woocommerce Sidebar', 'style-maven'),
            'description'   => esc_html__('Drag and drop Woocommerce widgets here', 'style-maven'),
            'id'            => 'style-maven-woocommerce-sidebar-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>'
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Style Maven Footer Widget 1', 'style-maven'),
            'description'   => esc_html__('Drag and drop Footer widgets here', 'style-maven'),
            'id'            => 'style-maven-footer-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>'
        )
    );
    register_sidebar(
        array(
            'name'          => esc_html__('Style Maven Footer Widget 2', 'style-maven'),
            'description'   => esc_html__('Drag and drop Footer widgets here', 'style-maven'),
            'id'            => 'style-maven-footer-2',
            'before_widget' => '<div id="%1$s" class="widget %2$s widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>'
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Style Maven Footer Widget 3', 'style-maven'),
            'description'   => esc_html__('Drag and drop Footer widgets here', 'style-maven'),
            'id'            => 'style-maven-footer-3',
            'before_widget' => '<div id="%1$s" class="widget %2$s widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>'
        )
    );
};
