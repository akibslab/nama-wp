<?php

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nama
 */

$categories = get_the_terms($post->ID, 'category');
$nama_blog_date = get_theme_mod('nama_blog_date', true);
$nama_blog_comments = get_theme_mod('nama_blog_comments', true);
$nama_blog_author = get_theme_mod('nama_blog_author', true);
$nama_blog_cat = get_theme_mod('nama_blog_cat', false);

?>
<div class="ss-post__meta">
    <?php if (!empty($nama_blog_author)) : ?>
        <span><a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="far fa-user"></i> <?php print get_the_author(); ?></a></span>
    <?php endif; ?>
    <?php if (!empty($nama_blog_cat)) : ?>
        <?php if (!empty($categories[0]->name)) : ?>
            <span><i class="icon_tag_alt"></i> <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a> </span>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!empty($nama_blog_date)) : ?>
        <span><i class="fal fa-clock"></i> <?php the_time(get_option('date_format')); ?> </span>
    <?php endif; ?>

    <?php if (!empty($nama_blog_comments)) : ?>
        <span><a href="<?php comments_link(); ?>"><i class="far fa-comments"></i> <?php comments_number(); ?></a></span>
    <?php endif; ?>
</div>