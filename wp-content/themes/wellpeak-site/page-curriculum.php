<?php
/*
 Template Name: カリキュラム（Curriculum Overview）
*/

get_header(); ?>

<main id="curriculum" class="curriculum-page">
  <?php get_template_part("template-parts/company/intro"); ?>
  <?php get_template_part("template-parts/company/executives"); ?>
  <?php get_template_part("template-parts/company/profile"); ?>
</main>

<?php get_footer();
// set route as  company in wordpress for consistency.
