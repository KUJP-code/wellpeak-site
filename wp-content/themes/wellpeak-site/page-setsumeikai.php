<?php
/**
 * Template Name: Setsumeikai
 * Description: List of schools with buttons linking to the SS setsu page
 */
if (!defined("ABSPATH")) {
    exit();
}

get_header();
?>
<?php get_template_part("template-parts/page-banner", null, [
    "title" => get_the_title(),
    "image" => esc_url(
        get_stylesheet_directory_uri() . "/images/hero-splash.jpg",
    ),
]); ?>
<main id="setsumeikai" class="setsumeikai-page">
  <div class="container">
    <?php
    $schools = new WP_Query([
        "post_type" => "school",
        "post_status" => "publish",
        "posts_per_page" => -1,
        "orderby" => "title",
        "order" => "ASC",
        "no_found_rows" => true,
    ]);
    if ($schools->have_posts()):
        while ($schools->have_posts()):
            $schools->the_post();
            get_template_part("template-parts/setsumeikai/school-row", null, [
                "post_id" => get_the_ID(),
            ]);
        endwhile;
        wp_reset_postdata();
    else:
         ?>
      <p>登録された学校はまだありません。</p>
    <?php
    endif;
    ?>
  </div>
</main>

<?php get_footer();
