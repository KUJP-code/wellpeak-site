<?php
status_header(404);
nocache_headers();
get_header();
?>

<main id="main" class="error-404 not-found">
  <?php get_template_part("template-parts/page-banner", null, [
      "title" => "404",
      "image" => get_stylesheet_directory_uri() . "/images/hero-splash.jpg",
  ]); ?>

  <section class="page-content" style="text-align:center; padding: 3rem 1rem;">
    <h2>404　～ページが見つかりません～</h2>
    <p>
      お探しのページは見つかりませんでした。<br>
          該当のページは、移動または削除、またはURLが間違っている可能性があります。

    </p>
    <p>
      <a href="<?php echo esc_url(home_url("/")); ?>" class="btn">
        トップページに戻るか、
      </a>
        メニューから目的のページをお探しください。
    </p>
  </section>
</main>

<?php get_footer(); ?>
