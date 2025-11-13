<?php
get_header();

while (have_posts()):

    the_post();

    $banner_image = has_post_thumbnail()
        ? get_the_post_thumbnail_url(get_the_ID(), "news_hero")
        : get_stylesheet_directory_uri() . "/images/section-2-image.jpg";

    get_template_part("template-parts/page-banner", null, [
        "title" => get_the_title(),
        "image" => esc_url($banner_image),
    ]);
    ?>

<main class="news-single container">

  <div class="news-date">
    <?php echo esc_html(get_the_date("Y.m.d")); ?>
  </div>

  <?php if (has_post_thumbnail()): ?>
    <div class="news-single-thumb">
      <?php the_post_thumbnail("large"); ?>
    </div>
  <?php endif; ?>

  <div class="news-single-body">
    <?php the_content(); ?>
  </div>

  <div class="news-single-back">
    <a href="<?php echo esc_url(get_post_type_archive_link("news")); ?>"
       class="btn-more"
       style="margin: 0.75rem 0;">
      ニュース一覧へ戻る
    </a>
  </div>

</main>

<?php
endwhile;

get_footer();
