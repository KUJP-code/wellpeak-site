<?php
/*
 Template Name: カリキュラム（Curriculum Overview）
*/

get_header(); ?>

<main id="curriculum" class="curriculum-page">
<?php get_template_part("template-parts/page-banner", null, [
    "title" => get_the_title(),
    "image" => get_stylesheet_directory_uri() . "/images/hero-splash.jpg",
]); ?>
  <?php get_template_part("template-parts/curriculum/intro"); ?>
  <?php get_template_part("template-parts/curriculum/about"); ?>
  <?php get_template_part("template-parts/cta"); ?>
  <?php get_template_part("template-parts/curriculum/ku-msg"); ?>
  <?php get_template_part("template-parts/curriculum/course"); ?>
</main>

<?php get_footer();
// set route as  curriculum in wp-admin for this page
