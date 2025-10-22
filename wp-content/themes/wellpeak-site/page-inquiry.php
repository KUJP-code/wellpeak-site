<?php
/*
 Template Name: 問い合わせ（Inquiry）
*/

get_header(); ?>

<main id="問い合わせ" class="inquiry-page">
  <?php get_template_part("template-parts/company/intro"); ?>
  <?php get_template_part("template-parts/company/executives"); ?>
  <?php get_template_part("template-parts/company/profile"); ?>
</main>

<?php get_footer();
// set route as  company in wordpress for consistency.
