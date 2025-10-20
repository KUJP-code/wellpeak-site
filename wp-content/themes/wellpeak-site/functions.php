<?php
if (!defined("ABSPATH")) {
    exit();
}

/**
 * TODO: This is slop that I imported as I dont use wordpress or PHP usually and I need to get this up and running, will curate this later.
 * Some of this is good to know though, the cache busting method for example stops some issues I noticed on the KU site, prevents browsers
 * from serving cached versions after updates.
 */
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
        "footer" => __("Footer Menu", "wellpeak-site"),
    ]);

    // Example card size for news thumbnails
    add_image_size("card", 640, 360, true);
});

add_action(
    "wp_enqueue_scripts",
    function () {
        $dir = get_stylesheet_directory();
        $uri = get_stylesheet_directory_uri();

        // cache-busting: mtime if present, else theme version
        $ver = function ($rel) use ($dir) {
            $path = $dir . "/" . ltrim($rel, "/");
            return file_exists($path)
                ? filemtime($path)
                : wp_get_theme()->get("Version");
        };

        $enqueue_if_exists = function (
            $handle,
            $rel,
            $deps = [],
            $in_footer = false,
        ) use ($dir, $uri, $ver) {
            $path = $dir . "/" . ltrim($rel, "/");
            if (!file_exists($path)) {
                return;
            }
            $url = $uri . "/" . ltrim($rel, "/");
            if (str_ends_with($rel, ".css")) {
                wp_enqueue_style($handle, $url, $deps, $ver($rel));
            } else {
                wp_enqueue_script($handle, $url, $deps, $ver($rel), $in_footer);
            }
        };

        // global styles
        $enqueue_if_exists("wellpeak-style", "css/style.css");

        $enqueue_if_exists("wellpeak-header", "css/header.css", [
            "wellpeak-style",
        ]);
        $enqueue_if_exists("wellpeak-footer", "css/footer.css", [
            "wellpeak-style",
        ]);

        // page specific styles
        if (is_page_template("page-company.php")) {
            $enqueue_if_exists("wellpeak-company", "css/company.css", [
                "wellpeak-style",
            ]);
        }

        // load js in footer rather than head to prevent early parsing
        $enqueue_if_exists("wellpeak-main", "js/main.js", [], true);
    },
    10,
);
