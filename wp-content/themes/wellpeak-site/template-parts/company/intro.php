add_action('wp_enqueue_scripts', function () {
  $ver = wp_get_theme()->get('Version');
  if (is_page_template('page-company.php')) {
    wp_enqueue_style('wellpeak-company', get_stylesheet_directory_uri().'/css/company.css', [], $ver);
  }
});
