<?php

/**
 * The header template file
 *

 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Style Maven
 *
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> <head>
<meta charset=<?php bloginfo('charset'); ?>>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <header>
            <section class="search">
                <div class="container ">
                    <div class="text-center d-md-flex align-items-center">
                        <?php get_search_form(); ?>
                    </div>

                </div>
            </section>
            <section class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="brand col-md-3 col-12 col-lg-2 text-center text-md-left">Logo</div>
                        <div class="second-column col-md-9 col-12 col-lg-10">
                            <div class="row">

                                <div class="account col-12">Account</div>
                                <div class="col-12">
                                    <nav class="navbar navbar-expand-md navbar-light" role="navigation">
                                        <!-- Brand and toggle get grouped for better mobile display -->
                                        <button class=" main-menu navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'your-theme-slug'); ?>">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>

                                        <?php
                                        wp_nav_menu(array(
                                            'theme_location'    =>  'style_maven_main_menu',
                                            'depth'             => 3,
                                            'container'         => 'div',
                                            'container_class'   => 'collapse navbar-collapse',
                                            'container_id'      => 'bs-example-navbar-collapse-1',
                                            'menu_class'        => 'nav navbar-nav',
                                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                            'walker'            => new WP_Bootstrap_Navwalker(),
                                        ));
                                        ?>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </header>