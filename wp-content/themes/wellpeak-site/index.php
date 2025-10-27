<?php
/**
 * The main template file
 *
 * This is the fallback for all queries that don’t have a page, this shouldn't really be called over 4.4 unless there is a mistake in the front end
 */

get_header(); ?>

<main id="main" class="site-main container">
  <?php if (have_posts()):
      // loop posts/pages if available
      while (have_posts()):
          the_post();
          get_template_part("template-parts/content", get_post_type());
      endwhile;

      the_posts_navigation();
      echo '<p style="text-align:center; margin:2rem 0;">コンテンツがありません。</p>';
      // no content fallback
  else:
      get_template_part("404");
  endif; ?>
</main>

<?php get_footer(); ?>
