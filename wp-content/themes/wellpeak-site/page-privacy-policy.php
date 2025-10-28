<?php
if (!defined("ABSPATH")) {
    exit();
}
get_header();

get_template_part("template-parts/page-banner", null, [
    "title" => get_the_title(),
    "image" => esc_url(
        get_stylesheet_directory_uri() . "/images/hero-splash.jpg",
    ),
]);

$q = new WP_Query([
    "post_type" => "policy",
    "post_status" => "publish",
    "posts_per_page" => 1,
    "orderby" => "date",
    "order" => "DESC",
]);
?>
<main class="container privacy">
  <?php
  if ($q->have_posts()):
      $q->the_post(); ?>
      </br>
      <div class="text">

    <article class="policy-content">
      <?php the_content(); ?>
    </article>
    </div>
  <?php
  else:
       ?>
    <?php if (have_posts()):
        the_post(); ?>

      <article class="policy-content">
        <?php the_content(); ?>
      </article>
    <?php
    else:
         ?>
      <p>No policy published yet.</p>
    <?php
    endif; ?>
  <?php
  endif;
  wp_reset_postdata();
  ?>
  </br> </br>
</main>
<?php get_footer(); ?>
