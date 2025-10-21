<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo("charset"); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
  <div class="container bar">
    <a class="brand" href="<?php echo esc_url(home_url("/")); ?>">
      <img src="<?php echo esc_url(
          get_stylesheet_directory_uri() . "/images/logo.svg",
      ); ?>" alt="Wellpeak">
      <span>Wellpeak</span>
    </a>

    <button class="nav-toggle" aria-controls="primary-nav" aria-expanded="false">Menu</button>

    <nav id="primary-nav" class="nav" role="navigation">
      <ul>
        <li><a href="<?php echo esc_url(
            home_url("/company/"),
        ); ?>">会社概要 </a></li>
        <li><a href="<?php echo esc_url(
            home_url("/curriculum/"),
        ); ?>">カリキュラム</a></li>
        <li><a href="<?php echo esc_url(
            home_url("/course/"),
        ); ?>">コース</a></li>
        <li><a href="<?php echo esc_url(
            home_url("/setsumeikai-yoyaku/"),
        ); ?>">説明会予約</a></li>
        <li><a href="<?php echo esc_url(
            home_url("/toiawase/"),
        ); ?>">お問い合わせ</a></li>
      </ul>
    </nav>
  </div>
</header>
