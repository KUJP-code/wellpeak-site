<?php
if (!defined("ABSPATH")) {
    exit();
}

// --- Includes ---
$wellpeak_inc = get_stylesheet_directory() . "/inc";
if (is_dir($wellpeak_inc)) {
    require_once $wellpeak_inc . "/schools.php";
}

// Include inquiry form logic
$inquiry_form_file = get_stylesheet_directory() . "/inc/inquiry-form.php";
if (file_exists($inquiry_form_file)) {
    require_once $inquiry_form_file;
}

// --- Redirect for /privacy_policy/ legacy URL ---
add_action("template_redirect", function () {
    $req = esc_url_raw($_SERVER["REQUEST_URI"] ?? "");
    if (trailingslashit($req) === "/privacy_policy/") {
        wp_redirect(home_url("/privacy-policy/"), 301);
        exit();
    }
});

add_action("init", function () {
    register_post_type("inquiry", [
        "label" => "Inquiries",
        "labels" => [
            "name" => "Inquiries",
            "singular_name" => "Inquiry",
        ],
        "public" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "supports" => ["title", "editor", "custom-fields"],
        "capability_type" => "post",
        "menu_icon" => "dashicons-email-alt",
    ]);
});

add_action("init", function () {
    register_post_type("policy", [
        "label" => "Policies",
        "labels" => [
            "name" => "Policies",
            "singular_name" => "Policy",
            "add_new_item" => "Add New Policy",
            "edit_item" => "Edit Policy",
        ],
        "public" => false,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "supports" => ["title", "editor", "revisions"],
        "has_archive" => false,
        "rewrite" => false,
        "menu_icon" => "dashicons-lock",
    ]);

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
        "has_archive" => true,
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

    $scripts = [
        "main" => "$dir/js/main.js",
        "header" => "$dir/js/header.js",
        "faq" => "$dir/js/faq.js",
        "news" => "$dir/js/news-slider.js",
    ];

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

    foreach ($scripts as $handle => $path) {
        if (file_exists($path)) {
            $ver = filemtime($path);
            wp_enqueue_script(
                "wellpeak-$handle",
                $uri . "/js/" . basename($path),
                $handle === "news" ? ["swiper"] : [],
                $ver,
                true,
            );
            if ($handle === "header") {
                wp_script_add_data("wellpeak-$handle", "defer", true);
            }
        }
    }
});
