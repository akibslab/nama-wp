<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
          <?php
          if (have_posts()) :
          ?>
            <div class="ss-page__header d-none">
              <h1 class="page__title"><?php esc_html_e('Search Results For:', 'nama'); ?> <?php print get_search_query(); ?></h1>
            </div>
            <?php
            while (have_posts()) : the_post();
              get_template_part('template-parts/content', 'search');
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
      <?php if (is_active_sidebar('blog-sidebar')) : ?>
        <div class="col-lg-4">
          <div class="ss-main__sidebar">
            <?php get_sidebar(); ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php
get_footer();
