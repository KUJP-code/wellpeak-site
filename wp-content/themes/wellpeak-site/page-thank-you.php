<?php
/*
 Template Name: 送信完了（Thank You）
*/
if (!defined("ABSPATH")) {
    exit();
}

get_header();

get_template_part("template-parts/page-banner", null, [
    "title" => "お問い合わせ完了",
    "image" => esc_url(
        get_stylesheet_directory_uri() . "/images/contact-side-image.jpg",
    ),
]);
?>

<main id="thank-you" class="thank-you-page">
  <section class="thank-you-section">
    <div class="container thank-you-inner">
      <div class="thank-you-content">
        <h1 class="thank-you-title">お問い合わせが完了しました</h1>
        <p class="thank-you-message">
          お問い合わせいただき、有難うございました。<br>
          2～3営業日以内に担当者よりご連絡しますので、今しばらくお待ちください。
        </p>
        <a href="<?php echo esc_url(home_url("/")); ?>" class="btn-more">
          トップページに戻る
        </a>
      </div>
      <div class="thank-you-deco" aria-hidden="true"></div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
