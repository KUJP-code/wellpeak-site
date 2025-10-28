<?php
if (!defined("ABSPATH")) {
    exit();
}

$id = $args["post_id"] ?? get_the_ID();
$title = get_the_title($id);
$postal = get_post_meta($id, "postal_code", true);
$pref = get_post_meta($id, "pref", true);
$city = get_post_meta($id, "city", true);
$addr1 = get_post_meta($id, "address1", true);
$addr2 = get_post_meta($id, "address2", true);
$url = get_post_meta($id, "signup_url", true);

$thumb = get_the_post_thumbnail($id, "full", [
    "class" => "school-row-thumb",
    "loading" => "lazy",
    "decoding" => "async",
    "alt" => esc_attr($title),
]);
?>
<article <?php post_class(
    "school-row",
); ?> id="school-<?php echo (int) $id; ?>">
  <div class="school-row__left">
    <h3 class="school-row__title"><?php echo esc_html($title); ?></h3>
    <div class="school-row__address">
      <?php if ($postal): ?><div>〒<?php echo esc_html(
    $postal,
); ?></div><?php endif; ?>
      <?php if ($pref || $city): ?><div><?php echo esc_html(
    trim($pref . " " . $city),
); ?></div><?php endif; ?>
      <?php if ($addr1): ?><div><?php echo esc_html(
    $addr1,
); ?></div><?php endif; ?>
      <?php if ($addr2): ?><div><?php echo esc_html(
    $addr2,
); ?></div><?php endif; ?>
    </div>

    <?php if ($url): ?>
      <p class="school-row__cta">
        <!-- reuse your main button, just smaller -->
        <a class="btn-more btn-more--sm" href="<?php echo esc_url(
            $url,
        ); ?>" target="_blank" rel="noopener">
          選び出す
        </a>
      </p>
    <?php endif; ?>
  </div>

  <div class="school-row__right">
    <div class="school-row__media">
      <?php if ($thumb) {
          echo $thumb;
      } else {
           ?>
        <div class="school-row-thumb school-row-thumb--placeholder"></div>
      <?php
      } ?>
    </div>
  </div>
</article>
