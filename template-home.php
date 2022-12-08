<?php

/**
 * Template Name: Home Page
 */

get_header(); ?>
<div class="content-area">
    <main>
        <section class="slider">
            <!-- Removed Bootstrap container so slider spans 100% of page -->
            <!-- Slider Code - do not change class names-->
            <div class="flexslider">
                <ul class="slides">

                    <?php
                    //Create arrays that store the data we want to display
                    for ($i = 1; $i < 4; $i++) {
                        $slider_page[$i] = get_theme_mod('set_slider_page' . $i);
                        $slider_button_text[$i] = get_theme_mod('set_slider_button_text' . $i);
                        $slider_button_url[$i] = get_theme_mod('set_slider_button_url' . $i);
                    }



                    $args = array(
                        'post_type' => 'page',
                        'posts_per_page' => 3,
                        'post__in' => $slider_page,
                        'orderby' => 'post__in'

                    );
                    $slider_loop = new WP_Query($args);
                    $j = 1;


                    if ($slider_loop->have_posts()) :
                        while ($slider_loop->have_posts()) : $slider_loop->the_post();
                            // do stuff ... 
                    ?>
                            <li>
                                <?php the_post_thumbnail('style-maven-slider', array('class' => 'img-fluid')); ?>
                                <div class="container">
                                    <div class="slider-details-container">
                                        <div class="slider-title">
                                            <h1><?php the_title() ?></h1>
                                        </div>
                                        <div class="slider-description">
                                            <div class="subtitle"><?php the_content(); ?></div>
                                            <a href="<?php echo esc_url($slider_button_url[$j]); ?>" class="link"><?php echo esc_html__($slider_button_text[$j]); ?></a>

                                        </div>
                                    </div>


                                </div>

                            </li>
                    <?php
                            $j++;
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </ul>
        </section>
        <?php if (class_exists('WooCommerce')) : ?>
            <section class="popular-products">

                <?php

                $popular_limit = get_theme_mod('set_popular_max_num', 9);
                $popular_cols = get_theme_mod('set_popular_cols_numb', 3);
                $arrival_limit = get_theme_mod('set_arrivals_max_num', 9);
                $arrival_cols = get_theme_mod('set_arrivals_cols_num', 3);





                ?>
                <div class="container">
                    <div class="section-title">
                        <h2><?php echo esc_html(get_theme_mod('set_popular_title', __('Popular products', 'style-maven'))); ?></h2>


                    </div>
                    <?php echo do_shortcode(
                        '[products limit="' . esc_attr($popular_limit) . '" columns="' . esc_attr($popular_cols) . '" orderby="popularity"]'
                    );
                    ?>

                </div>
            </section>
            <section class="new-arrivals">
                <div class="container">
                    <div class="section-title">
                        <h2><?php echo esc_html(get_theme_mod('set_new_arrivals_title', __('New Arrivals', 'style-maven'))); ?></h2>
                    </div>
                    <?php echo do_shortcode(
                        '[products limit="' . esc_attr($arrival_limit) . '" columns="' . esc_attr($arrival_cols) . '" orderby="date" order="descending" visiblity="visible"]'
                    );
                    ?>

                </div>
            </section>
            <?php
            $showdeal = get_theme_mod('toggle_deal_of_week', 0);
            $deal = get_theme_mod('set_deal_of_week');
            $currency = get_woocommerce_currency_symbol();
            //pass in the post id as the key
            $regular = get_post_meta($deal, '_regular_price', true);
            $sale = get_post_meta($deal, '_sale_price', true);


            if ($showdeal == 1 && (!empty($deal))) :
                $discount_percentage = absint(100 - (($sale / $regular) * 100));
            ?>


                <section class="deal-of-the-week">

                    <div class="container">
                        <div class="section-title">
                            <h2><?php echo esc_html(get_theme_mod('set_deal_title', __('Deal Of The Week', 'style-maven')));  ?></h2>

                        </div>
                        <div class="row d-flex align-items-center">
                            <div class="deal-img col-md-6 col-12 ml-auto text-center">
                                <?php echo get_the_post_thumbnail($deal, 'large', array('class' => 'img-fluid')); ?>
                            </div>
                            <div class="deal-desc col-md-4 col-12 mr-auto text-center">
                                <?php if (!empty($sale)) : ?>
                                    <span class="discount">
                                        <?php echo esc_html($discount_percentage) . esc_html__('% OFF', 'style-maven'); ?>
                                    </span>
                                <?php endif; ?>
                                <h3><a href="<?php echo esc_url(get_permalink($deal)) ?>"><?php echo esc_html(get_the_title($deal)) ?></a></h3>
                                <p><?php echo esc_html(get_the_excerpt($deal)); ?></p>
                                <div class="prices">
                                    <span class="regular">
                                        <?php echo esc_html($currency); ?>
                                        <?php echo esc_html($regular); ?>
                                    </span>
                                    <?php if (!empty($sale)) : ?>
                                        <span class="sale">
                                            <?php echo esc_html($currency); ?>
                                            <?php echo esc_html($sale); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php echo esc_url('?add-to-cart=' . $deal); ?>" class="add-to-cart"><?php esc_html_e('Add to cart', 'style-maven'); ?> </a>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>
        <section class="lab-blog">
            <div class="container">
                <div class="section-title">
                    <h2><?php echo esc_html(get_theme_mod('set_blog_title', __('News From Our Blog', 'style-maven'))); ?></h2>
                </div>
                <div class="row">

                    <?php
                    //if there are any posts
                    // Custom WP query blog_posts
                    $args_blog_posts = array(
                        'post_type' => 'post',
                        'posts_per_page' => 2,
                        'order' => 'ASC',

                    );
                    $blog_posts = new WP_Query($args_blog_posts);
                    if ($blog_posts->have_posts()) :
                        //load post loop
                        while ($blog_posts->have_posts()) :  $blog_posts->the_post();
                            // do stuff ...>
                    ?>
                            <article class="col-12 col-md-6">
                                <?php
                                //check for thumbnail and render it
                                if (has_post_thumbnail()) :
                                ?>
                                    <a href="<?php the_permalink() ?>">
                                        <?php
                                        the_post_thumbnail('style-maven-blog', array('class' => 'img-fluid'));
                                        ?>
                                    </a>
                                <?php
                                endif;
                                ?>
                                <h3>
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="excerpt"><?php the_excerpt(); ?>
                                </div>
                            </article>

                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <p><?php esc_html_e('Nothing to display', 'style-maven'); ?></p>


                    <?php
                    endif;
                    ?>
                </div>

            </div>
        </section>
    </main>
</div>

<?php get_footer(); ?>