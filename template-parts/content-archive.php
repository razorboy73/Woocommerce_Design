<article <?php post_class(); ?>>
    <h2>
        <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
    </h2>
    <div class="post-thumbnail">
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
    </div>
    <div class="meta">
        <p><?php esc_html_e('Published by', 'style-maven') ?> <?php the_author_posts_link(); ?>
            <?php esc_html_e('on', 'style-maven'); ?> <a href="<?php the_permalink() ?>"><?php echo esc_html(get_the_date()); ?></a>
            <br>
            <?php if (has_category()) : ?>
                <?php esc_html_e('Categories', 'style-maven') ?>: <span><?php the_category(" "); ?></span>
            <?php endif; ?>
            <br>
            <?php
            if (has_tag()) :
            ?>
                <?php esc_html_e('Tags', 'style-maven') ?>: <span><?php the_tags("", ", ", ""); ?></span>
            <?php endif; ?>
        </p>
    </div>
    <!-- handles different froms of excerpts -->
    <?php if (has_excerpt()) : ?>
        <div class="content"><?php the_excerpt();  ?></div>
    <?php elseif (strpos($post->post_content, '<!--more-->')) : ?>
        <div class="content"><?php the_content('More'); ?></div>
    <?php else : ?>
        <div class="content"><?php the_excerpt();  ?></div>
    <?php endif; ?>
</article>