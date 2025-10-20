<?php
/*
 Template Name: 会社概要（Company Overview）
*/

get_header(); ?>

<main id="company" class="company-page">
  <?php get_template_part("template-parts/company/intro"); ?>
  <?php get_template_part("template-parts/company/executives"); ?>
  <?php get_template_part("template-parts/company/profile"); ?>
</main>

<?php get_footer();
