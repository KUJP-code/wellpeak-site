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

add_action("wp_enqueue_scripts", function () {
    $theme_uri = get_stylesheet_directory_uri();
    $theme_path = get_stylesheet_directory();

    // Cache-busting helper: filemtime if file exists, else theme version, good for having changes appear.
    $ver = function (string $rel) use ($theme_path) {
        $path = $theme_path . "/" . ltrim($rel, "/");
        return file_exists($path)
            ? filemtime($path)
            : wp_get_theme()->get("Version");
    };

    // global css import
    if (file_exists($theme_path . "/css/style.css")) {
        wp_enqueue_style(
            "wellpeak-style",
            $theme_uri . "/css/style.css",
            [],
            $ver("css/style.css"),
        );
    }

    // sheet imports - apparently this is a wordpress convention rather than declaring it at the top of a page.
    if (
        is_page_template("page-company.php") &&
        file_exists($theme_path . "/css/company.css")
    ) {
        wp_enqueue_style(
            "wellpeak-company",
            $theme_uri . "/css/company.css",
            ["wellpeak-style"],
            $ver("css/company.css"),
        );
    }

    if (file_exists($theme_path . "/js/main.js")) {
        wp_enqueue_script(
            "wellpeak-main",
            $theme_uri . "/js/main.js",
            [],
            $ver("js/main.js"),
            true,
        );
    }
});
