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
        <button type="button" class="news-prev" aria-label="前へ">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.86 15.01" width="20" height="20" aria-hidden="true">
            <path fill="currentColor"
              d="M1.84,5.39c.63,1.34.63,2.89,0,4.24L.13,13.28c-.21.45-.13,1,.23,1.34.4.37.99.51,1.55.27l12.75-5.55c1.6-.7,1.6-2.97,0-3.67L1.91.12C1.28-.15.6.06.22.54-.05.86-.06,1.33.12,1.71l1.72,3.68Z"/>
          </svg>
        </button>

        <button type="button" class="news-next" aria-label="次へ">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.86 15.01" width="20" height="20" aria-hidden="true">
            <path fill="currentColor"
              d="M1.84,5.39c.63,1.34.63,2.89,0,4.24L.13,13.28c-.21.45-.13,1,.23,1.34.4.37.99.51,1.55.27l12.75-5.55c1.6-.7,1.6-2.97,0-3.67L1.91.12C1.28-.15.6.06.22.54-.05.86-.06,1.33.12,1.71l1.72,3.68Z"/>
          </svg>
        </button>
      </div>
    <?php else: ?>
      <p class="news-empty">現在お知らせはありません。</p>
    <?php endif;
    ?>
  </div>
</section>
