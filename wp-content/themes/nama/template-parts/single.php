<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package nama
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 8 : 12;

?>

<section class="ss-post-details__area">
   <div class="container">
      <div class="row">
         <div class="col-lg-<?php print esc_attr($blog_column); ?>">
            <div class="ss-post__wrapper">
               <?php
               while (have_posts()) :
                  the_post();

                  get_template_part('template-parts/content', get_post_format());

               ?>

                  <?php
                  if (get_previous_post_link() and get_next_post_link()) : ?>

                     <div class="ss-post__navigation d-none">
                        <div class="row align-items-center">
                           <?php
                           if (get_previous_post_link()) : ?>
                              <div class="col-md-6">
                                 <div class="navigation__post prev-post">
                                    <span><?php print esc_html__('Prev Post', 'nama'); ?></span>
                                    <h4><?php print get_previous_post_link('%link ', '%title'); ?></h4>
                                 </div>
                              </div>
                           <?php
                           endif; ?>

                           <?php
                           if (get_next_post_link()) : ?>
                              <div class="col-md-6">
                                 <div class="navigation__post next-post">
                                    <span><?php print esc_html__('Next Post', 'nama'); ?></span>
                                    <h4><?php print get_next_post_link('%link ', '%title'); ?></h4>
                                 </div>
                              </div>
                           <?php
                           endif; ?>

                        </div>
                     </div>

                  <?php
                  endif; ?>
               <?php

                  get_template_part('template-parts/biography');

                  // If comments are open or we have at least one comment, load up the comment template.
                  if (comments_open() || get_comments_number()) :
                     comments_template();
                  endif;

               endwhile; // End of the loop.
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
</section>

<?php
get_footer();
