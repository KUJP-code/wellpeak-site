<?php
if (!defined("ABSPATH")) {
    exit();
}

/** Theme setup */
add_action("after_setup_theme", function () {
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
    add_theme_support("html5", [
        "search-form",
        "comment-form",
        "comment-list",
        "gallery",
        "caption",
        "style",
        "script",
    ]);
    register_nav_menus([
        "primary" => __("Primary Menu", "wellpeak-site"),
        "footer-menu" => __("Footer Menu", "wellpeak-site"),
    ]);
    add_image_size("card", 640, 360, true);
});

/** Optional: resource hints for Google Fonts speed */
add_filter(
    "wp_resource_hints",
    function ($urls, $relation_type) {
        if ("preconnect" === $relation_type) {
            $urls[] = "https://fonts.googleapis.com";
            $urls[] = "https://fonts.gstatic.com"; // gstatic needs crossorigin
        }
        return $urls;
    },
    10,
    2,
);

/** Enqueue Google Fonts */
function wellpeak_enqueue_fonts()
{
    wp_enqueue_style(
        "wellpeak-fonts",
        "https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap",
        [],
        null,
    );
}
add_action("wp_enqueue_scripts", "wellpeak_enqueue_fonts", 5); // early

/** Styles & scripts */
add_action("wp_enqueue_scripts", function () {
    $dir = get_stylesheet_directory();
    $uri = get_stylesheet_directory_uri();

    if (!is_dir("$dir/css")) {
        wp_mkdir_p("$dir/css");
    }
    if (
        !file_exists("$dir/css/main.css") &&
        is_writable(dirname("$dir/css/main.css"))
    ) {
        file_put_contents(
            "$dir/css/main.css",
            "/* placeholder; WP-SCSS will overwrite */\n",
        );
    }

    $css_ver = file_exists("$dir/css/main.css")
        ? filemtime("$dir/css/main.css")
        : wp_get_theme()->get("Version");
    $main_js_ver = file_exists("$dir/js/main.js")
        ? filemtime("$dir/js/main.js")
        : null;
    $header_js_ver = file_exists("$dir/js/header.js")
        ? filemtime("$dir/js/header.js")
        : null;

    // Note: depend on fonts so order is guaranteed
    wp_enqueue_style(
        "wellpeak-main-styles",
        $uri . "/css/main.css",
        ["wellpeak-fonts"],
        $css_ver,
    );

    if ($header_js_ver) {
        wp_enqueue_script(
            "header-toggle",
            $uri . "/js/header.js",
            [],
            $header_js_ver,
            true,
        );
        wp_script_add_data("header-toggle", "defer", true);
    }
    if ($main_js_ver) {
        wp_enqueue_script(
            "wellpeak-main",
            $uri . "/js/main.js",
            [],
            $main_js_ver,
            true,
        );
    }
});
