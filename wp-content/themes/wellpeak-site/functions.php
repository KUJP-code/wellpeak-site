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
        "footer-menu" => __("Footer Menu", "wellpeak-site"),
    ]);

    // Example card size for news thumbnails
    add_image_size("card", 640, 360, true);
});
add_action(
    "wp_enqueue_scripts",
    function () {
        $dir = get_stylesheet_directory();
        $uri = get_stylesheet_directory_uri();

        if (!is_dir("$dir/css")) {
            wp_mkdir_p("$dir/css");
        }
        if (!file_exists("$dir/css/main.css")) {
            file_put_contents(
                "$dir/css/main.css",
                "/* placeholder; WP-SCSS will overwrite */\n",
            );
        }

        $ver = file_exists("$dir/css/main.css")
            ? filemtime("$dir/css/main.css")
            : wp_get_theme()->get("Version");

        wp_enqueue_style(
            "wellpeak-main-styles",
            $uri . "/css/main.css",

            $ver,
        );

        if (file_exists("$dir/js/main.js")) {
            wp_enqueue_script(
                "wellpeak-main",
                $uri . "/js/main.js",
                [],
                filemtime("$dir/js/main.js"),
                true,
            );
        }
    },
    10,
);
