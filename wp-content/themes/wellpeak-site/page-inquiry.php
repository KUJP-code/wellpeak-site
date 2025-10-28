<?php
/*
 Template Name: 問い合わせ（Inquiry）
*/
if (!defined("ABSPATH")) {
    exit();
}

get_header();

get_template_part("template-parts/page-banner", null, [
    "title" => get_the_title(),
    "image" => esc_url(
        get_stylesheet_directory_uri() . "/images/section-2-image.jpg",
    ),
]);
?>

<main id="inquiry" class="inquiry-page container">
  <section class="inquiry-section">
    <?php echo do_shortcode("[inquiry_form]"); ?>
  </section>
</main>

<?php get_footer(); ?>
