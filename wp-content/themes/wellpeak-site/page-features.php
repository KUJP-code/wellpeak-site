<?php
/*
 */

get_header(); ?>

<main id="features" class="features-page">
<?php get_template_part("template-parts/page-banner", null, [
    "title" => get_the_title(),
    "image" => get_stylesheet_directory_uri() . "/images/fun-learning.jpg",
]); ?>
  <?php get_template_part("template-parts/feature/points"); ?>
  <?php get_template_part("template-parts/cta", null, [
      "extra_class" => "cta-bottom",
  ]); ?>


</main>

<?php get_footer(); // set route as  curriculum in wp-admin for this page
