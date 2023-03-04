<?php

/**
 * The footer template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Style Maven
 *
 */
?>
<footer>
    <section class="footer-widgets">
        <div class="container">
            <div class="row">
                <?php
                if (is_active_sidebar('style-maven-footer-1')) : ?>
                    <div class="col-md-4 col-12">
                        <?php dynamic_sidebar('style-maven-footer-1'); ?>
                    </div>
                <?php endif; ?>
                <?php
                if (is_active_sidebar('style-maven-footer-2')) : ?>
                    <div class="col-md-4 col-12">
                        <?php dynamic_sidebar('style-maven-footer-2'); ?>
                    </div>
                <?php endif; ?>
                <?php
                if (is_active_sidebar('style-maven-footer-3')) : ?>
                    <div class="col-md-4 col-12">
                        <?php dynamic_sidebar('style-maven-footer-3'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </section>
    <section class="copyright">
        <div class="container">
            <div class="row">
                <div class="copyright-text col-12 col-md-6">
                    <?php echo esc_html(get_theme_mod('set_copyright', __('not fucking defined asshat', 'style-maven'))); ?>

                </div>

                <nav class="footer-menu col-12 col-md-6 text-start text-md-end">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'style_maven_footer_menu',
                            'depth' => 1
                        )
                    );

                    ?>
                </nav>
            </div>
        </div>
    </section>
</footer>

<?php wp_footer(); ?>
</body>

</html>