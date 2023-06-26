<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nama
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 8 : 12;

?>

<div class="full-width ss-posts__area" id="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-<?php print esc_attr($blog_column); ?>">
        <div class="ss-post__container">

          <?php if (have_posts()) : ?>

            <?php if (apply_filters('nama_page_title', true)) : ?>
              <header class="ss-page__header">
                <?php
                if (is_home() && !is_front_page()) :
                  single_post_title('<h1 class="entry-title ss-page__title">', '</h1>');

                else :
                  the_archive_title('<h1 class="entry-title ss-archive__title">', '</h1>');
                  the_archive_description('<div class="ss-archive__description">', '</div>');
                endif;
                ?>
                <?php


                ?>
              </header><!-- .page-header -->
            <?php
            endif; // .hide-title

            /* Start the Loop */
            while (have_posts()) :
              the_post();

              /*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
              get_template_part('template-parts/content', get_post_type());
            endwhile;
            ?>

            <div class="ss__pagination">
              <?php nama_pagination('<i class="fal fa-arrow-left"></i>', '<i class="fal fa-arrow-right"></i>', '', ['class' => '']); ?>
            </div>
          <?php
          else :
            get_template_part('template-parts/content', 'none');
          endif;
          ?>
        </div>
      </div>
      <!-- sidebar -->
      <?php if (is_active_sidebar('blog-sidebar')) : ?>
        <div class="col-lg-4">
          <div class="ss-main__sidebar">
            <?php get_sidebar(); ?>
          </div>
        </div>
      <?php endif; ?>
      <!--! sidebar -->
    </div>
  </div>
</div>
<?php
get_footer();
