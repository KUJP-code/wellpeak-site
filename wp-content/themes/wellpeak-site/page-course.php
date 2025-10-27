<?php
/*
 Template Name: コース （Course Overview）
*/

get_header(); ?>

<main id="course" class="course-page">
    <?php get_template_part("template-parts/page-banner", null, [
        "title" => get_the_title(),
        "image" => get_stylesheet_directory_uri() . "/images/hero-splash.jpg",
    ]); ?>
  <?php get_template_part("template-parts/company/intro"); ?>
  <?php get_template_part("template-parts/company/executives"); ?>
  <?php get_template_part("template-parts/company/profile"); ?>
</main>

<?php get_footer();
