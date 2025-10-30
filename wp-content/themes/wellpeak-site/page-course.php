<?php
/*
 Template Name: コース （Course Overview）
*/

get_header(); ?>

<main id="course" class="course-page">
    <?php get_template_part("template-parts/page-banner", null, [
        "title" => get_the_title(),
        "image" => get_stylesheet_directory_uri() . "/images/course-hero.jpg",
    ]); ?>
  <?php get_template_part("template-parts/course/intro"); ?>
  <?php get_template_part("template-parts/course/beginner"); ?>
  <?php get_template_part("template-parts/cta"); ?>
  <?php get_template_part("template-parts/course/expert"); ?>
</main>

<?php get_footer();
