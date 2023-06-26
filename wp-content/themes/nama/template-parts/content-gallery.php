<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nama
 */

$gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';
if (is_single()) : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('ss__post format-gallery'); ?>>
        <?php if (!empty($gallery_images)) : ?>
            <div class="ss-feature__image">
                <div class="ss-post__slider swiper-container p-relative">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery_images as $key => $image) : ?>
                            <div class="ss-blog__slider-item swiper-slide">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="ss-post-gallery__nav">
                        <button class="ss-gallery-button__next"><i class="fal fa-arrow-right"></i></button>
                        <button class="ss-gallery-button__prev"><i class="fal fa-arrow-left"></i></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="ss__content">
            <!-- post meta -->
            <?php get_template_part('template-parts/blog/blog-meta'); ?>

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

            <!-- tags -->
            <?php echo nama_get_tag(); ?>
        </div>
    </article>
<?php else : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('ss-post__grid format-gallery'); ?>>
        <div class="ss-post__wrapper">
            <?php if (!empty($gallery_images)) : ?>
                <div class="ss-post__thumb">
                    <div class="ss-post__slider swiper-container p-relative">
                        <div class="swiper-wrapper">
                            <?php foreach ($gallery_images as $key => $image) : ?>
                                <div class="ss-blog__slider-item swiper-slide">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="ss-post-gallery__nav">
                            <button class="ss-gallery-button__next"><i class="fal fa-arrow-right"></i></button>
                            <button class="ss-gallery-button__prev"><i class="fal fa-arrow-left"></i></button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="ss-post-content__wrapper">
                <!-- post meta -->
                <?php get_template_part('template-parts/blog/post-meta'); ?>

                <h3 class="ss-post__title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                <?php the_excerpt(); ?>

                <?php get_template_part('template-parts/blog/post-btn'); ?>
            </div>
            <div class="ss-clearfix"></div>
        </div>
    </article>


<?php
endif; ?>