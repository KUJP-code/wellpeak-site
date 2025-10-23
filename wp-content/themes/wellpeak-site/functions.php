<?php
if (!defined("ABSPATH")) {
    exit();
}

add_action("init", function () {
    register_post_type("news", [
        "label" => "ニュース",
        "labels" => [
            "name" => "ニュース",
            "singular_name" => "ニュース",
            "add_new" => "新規追加",
            "add_new_item" => "ニュースを追加",
            "edit_item" => "ニュースを編集",
            "new_item" => "新しいニュース",
            "view_item" => "ニュースを表示",
            "search_items" => "ニュースを検索",
        ],
        "public" => true,
        "menu_icon" => "dashicons-megaphone",
        "supports" => [
            "title",
            "editor",
            "thumbnail",
            "excerpt",
            "revisions",
            "author",
        ],
        "show_in_rest" => true,
        "has_archive" => false,
        "rewrite" => ["slug" => "news"],
    ]);
    add_image_size("news_card", 640, 360, true);
});

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

add_filter(
    "wp_resource_hints",
    function ($urls, $relation_type) {
        if ("preconnect" === $relation_type) {
            $urls[] = "https://fonts.googleapis.com";
            $urls[] = "https://fonts.gstatic.com";
        }
        return $urls;
    },
    10,
    2,
);

function wellpeak_enqueue_fonts()
{
    wp_enqueue_style(
        "wellpeak-fonts",
        "https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap",
        [],
        null,
    );
}
add_action("wp_enqueue_scripts", "wellpeak_enqueue_fonts", 5);

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
        file_put_contents("$dir/css/main.css", "/* placeholder */\n");
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
    $faq_js_ver = file_exists("$dir/js/faq.js")
        ? filemtime("$dir/js/faq.js")
        : null;
    $news_js_ver = file_exists("$dir/js/news-slider.js")
        ? filemtime("$dir/js/news-slider.js")
        : null;

    wp_enqueue_style(
        "wellpeak-main-styles",
        $uri . "/css/main.css",
        ["wellpeak-fonts"],
        $css_ver,
    );

    wp_enqueue_style(
        "swiper",
        "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css",
        [],
        null,
    );
    wp_enqueue_script(
        "swiper",
        "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js",
        [],
        null,
        true,
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
    if ($faq_js_ver) {
        wp_enqueue_script(
            "wellpeak-faq",
            $uri . "/js/faq.js",
            [],
            $faq_js_ver,
            true,
        );
    }
    if ($news_js_ver) {
        wp_enqueue_script(
            "wellpeak-news-slider",
            $uri . "/js/news-slider.js",
            ["swiper"],
            $news_js_ver,
            true,
        );
    }
});
