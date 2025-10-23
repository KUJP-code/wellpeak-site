<section class="news" id="news">
  <div class="container">
    <div class="news-header-wrap">
      <h2 class="news-title">ニュース</h2>
      <span class="news-underline" aria-hidden="true"></span>
    </div>

    <?php
    $q = new WP_Query([
        "post_type" => "news",
        "posts_per_page" => 12,
        "orderby" => "date",
        "order" => "DESC",
        "post_status" => "publish",
    ]);
    if ($q->have_posts()): ?>
      <div class="swiper news-thumbs-swiper">
        <div class="swiper-wrapper">
          <?php
          while ($q->have_posts()):
              $q->the_post(); ?>
            <div class="swiper-slide">
              <a class="news-thumb-card" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(
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
            </div>
          <?php
          endwhile;
          wp_reset_postdata();
          ?>
        </div>

        <div class="swiper-pagination" aria-hidden="true"></div>
      </div>

      <div class="news-controls">
        <button type="button" class="news-prev" aria-label="前へ"><span>&lt;</span></button>
        <button type="button" class="news-next" aria-label="次へ"><span>&gt;</span></button>
      </div>
    <?php else: ?>
      <p class="news-empty">現在お知らせはありません。</p>
    <?php endif;
    ?>
  </div>
</section>
