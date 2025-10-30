<?php
/*
 Template Name: faq
*/

get_header(); ?>

<main id="curriculum" class="curriculum-page">
<?php get_template_part("template-parts/page-banner", null, [
    "title" => get_the_title(),
    "image" => get_stylesheet_directory_uri() . "/images/curriculum-hero.jpg",
]); ?>
  <?php get_template_part("template-parts/faq/faq"); ?>

  <?php get_template_part("template-parts/cta", null, [
      "extra_class" => "cta-bottom",
  ]); ?>
</main>

<?php get_footer();
