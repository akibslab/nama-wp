<?php

/**
 * Template part for displaying quote posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nama
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('ss__post format-quote'); ?>>
    <div class="ss__content">
        <div class="post-text">
            <?php the_content(); ?>
        </div>
    </div>
</article>