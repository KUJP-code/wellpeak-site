<section class="page-banner fullwidth">
  <div class="page-banner__text">
    <h1 class="page-banner__title"><?= esc_html(
        $args["title"] ?? get_the_title(),
    ) ?></h1>
  </div>
  <div class="page-banner__media">
    <img src="<?= esc_url($args["image"] ?? "") ?>" alt="<?= esc_attr(
    $args["title"] ?? get_the_title(),
) ?>">
  </div>
</section>
