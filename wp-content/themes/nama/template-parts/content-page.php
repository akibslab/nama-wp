<div class="ss-page__post">
    <div class="post-text">
        <?php the_content(); ?>
        <?php
        wp_link_pages([
            'before'      => '<div class="ss-page__links"> <span class="ss-page-links__title">' . esc_html__('Pages:', 'nama') . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">' . esc_html__('Page', 'nama') . ' </span>%',
            'separator'   => '<span class="screen-reader-text"> </span>',
        ]);
        ?>
    </div>

    <?php
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
</div>