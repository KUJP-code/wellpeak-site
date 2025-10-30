<?php
/* archive-news.php */
get_header();

// --- Get the latest News post thumbnail ---
$latest_news = new WP_Query([
    "post_type" => "news",
    "posts_per_page" => 1,
    "post_status" => "publish",
    "orderby" => "date",
    "order" => "DESC",
]);

$banner_image = "";
if ($latest_news->have_posts()) {
    $latest_news->the_post();
    if (has_post_thumbnail()) {
        $banner_image = get_the_post_thumbnail_url(get_the_ID(), "news_hero");
    }
}
wp_reset_postdata();

// --- Use that in the banner (fallback if no image) ---
get_template_part("template-parts/page-banner", null, [
    "title" => "ニュース",
    "image" => esc_url(
        $banner_image ?:
        get_stylesheet_directory_uri() . "/images/section-2-image.jpg",
    ),
]);
?>

<main class="news-archive container">
  <header class="news-header-wrap">
    <span class="news-underline" aria-hidden="true"></span>
  </header>

  <?php if (have_posts()): ?>
    <div class="news-grid">
      <?php while (have_posts()):
          the_post(); ?>
          <article <?php post_class("news-item media-right"); ?>>
            <div class="news-text">
              <div class="news-date"><?php echo get_the_date("Y.m.d"); ?></div>
              <h2 class="news-heading"><?php the_title(); ?></h2>
              <p class="news-excerpt"><?php echo get_the_excerpt(); ?></p>

              <a href="<?php the_permalink(); ?>" class="btn-more" aria-label="<?php echo esc_attr(
    get_the_title(),
); ?>">
                さらにくわしく
              </a>
            </div>

            <a class="news-media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(
    get_the_title(),
); ?>">
              <div class="news-thumb">
                <?php if (has_post_thumbnail()):
                    the_post_thumbnail("news_card", [
                        "loading" => "lazy",
                        "decoding" => "async",
                        "alt" => esc_attr(get_the_title()),
                    ]);
                else:
                     ?>
                  <div class="news-thumb--placeholder" aria-hidden="true"></div>
                <?php
                endif; ?>
              </div>
            </a>
          </article>

      <?php
      endwhile; ?>
    </div>

    <div class="news-pagination">
      <?php the_posts_pagination([
          "mid_size" => 2,
          "prev_text" => "←",
          "next_text" => "→",
      ]); ?>
    </div>
  <?php else: ?>
    <p class="news-empty">現在お知らせはありません。</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
