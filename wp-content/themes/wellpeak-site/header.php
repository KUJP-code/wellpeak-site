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
          get_stylesheet_directory_uri() . "/images/nav-logo.svg",
      ); ?>" alt="Wellpeak">
    </a>

    <button class="nav-toggle" aria-controls="primary-nav" aria-expanded="false" aria-label="Menu">
      <span class="hamburger" aria-hidden="true"></span>
    </button>

    <nav id="primary-nav" class="nav" role="navigation">
        <div class="nav-inner">
      <?php wp_nav_menu([
          "theme_location" => "primary",
          "container" => false,
          "menu_class" => "menu",
          "depth" => 2,
      ]); ?>
      </div>
    </nav>

  </div>
</header>
