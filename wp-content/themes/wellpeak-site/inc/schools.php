<?php
/**
 Schools module
 meta: postal_code, pref, city, address1, address2, signup_url
 */
if (!defined("ABSPATH")) {
    exit();
}

/*  Register CPT (no public pages) */
add_action("init", function () {
    register_post_type("school", [
        "label" => __("学校", "wellpeak-site"),
        "labels" => [
            "name" => __("学校", "wellpeak-site"),
            "singular_name" => __("学校", "wellpeak-site"),
            "add_new" => __("新規追加", "wellpeak-site"),
            "add_new_item" => __("学校を追加", "wellpeak-site"),
            "edit_item" => __("学校を編集", "wellpeak-site"),
            "new_item" => __("新しい学校", "wellpeak-site"),
            "search_items" => __("学校を検索", "wellpeak-site"),
            "not_found" => __("学校が見つかりません", "wellpeak-site"),
        ],
        "public" => false,
        "publicly_queryable" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_rest" => true,
        "has_archive" => false,
        "rewrite" => false,
        "menu_icon" => "dashicons-location",
        "supports" => ["title", "thumbnail"],
    ]);
});

add_action("init", function () {
    foreach (["postal_code", "pref", "city", "address1", "address2"] as $key) {
        register_post_meta("school", $key, [
            "type" => "string",
            "single" => true,
            "show_in_rest" => true,
            "sanitize_callback" => "sanitize_text_field",
            "auth_callback" => function () {
                return current_user_can("edit_posts");
            },
        ]);
    }
    register_post_meta("school", "signup_url", [
        "type" => "string",
        "single" => true,
        "show_in_rest" => true,
        "sanitize_callback" => function ($v) {
            return esc_url_raw(trim((string) $v));
        },
        "auth_callback" => function () {
            return current_user_can("edit_posts");
        },
    ]);
});

add_action("add_meta_boxes", function () {
    add_meta_box(
        "wellpeak_school_meta",
        __("学校情報", "wellpeak-site"),
        "wellpeak_render_school_meta_box",
        "school",
        "side",
        "high",
    );
});

function wellpeak_render_school_meta_box($post)
{
    $fields = [
        "postal_code" => __("郵便番号（例: 151-0066）", "wellpeak-site"),
        "pref" => __("都道府県（例: 東京都）", "wellpeak-site"),
        "city" => __("市区町村（例: 渋谷区）", "wellpeak-site"),
        "address1" => __("町名・番地（例: 西原3-○-○）", "wellpeak-site"),
        "address2" => __("建物名・階（任意）", "wellpeak-site"),
        "signup_url" => __("説明会申込リンク（外部）", "wellpeak-site"),
    ];
    wp_nonce_field("wellpeak_save_school_meta", "wellpeak_school_meta_nonce");

    echo '<style>
      .wellpeak-school-meta p{margin:0 0 .65rem}
      .wellpeak-school-meta label{font-weight:600;display:block;margin-bottom:.25rem}
      .wellpeak-school-meta input{width:100%}
    </style><div class="wellpeak-school-meta">';
    foreach ($fields as $key => $label) {
        $val = get_post_meta($post->ID, $key, true);
        printf(
            '<p><label for="%1$s">%2$s</label><input type="text" id="%1$s" name="%1$s" value="%3$s"></p>',
            esc_attr($key),
            esc_html($label),
            esc_attr($val),
        );
    }
    echo "<p><small>" .
        esc_html__(
            "「アイキャッチ画像」に横長画像を設定してください（比率は自由。表示はCSSで整えます）。",
            "wellpeak-site",
        ) .
        "</small></p></div>";
}

add_action("save_post_school", function ($post_id) {
    if (
        !isset($_POST["wellpeak_school_meta_nonce"]) ||
        !wp_verify_nonce(
            $_POST["wellpeak_school_meta_nonce"],
            "wellpeak_save_school_meta",
        )
    ) {
        return;
    }
    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can("edit_post", $post_id)) {
        return;
    }

    foreach (["postal_code", "pref", "city", "address1", "address2"] as $k) {
        if (isset($_POST[$k])) {
            update_post_meta($post_id, $k, sanitize_text_field($_POST[$k]));
        }
    }
    if (isset($_POST["signup_url"])) {
        update_post_meta(
            $post_id,
            "signup_url",
            esc_url_raw(trim((string) $_POST["signup_url"])),
        );
    }
});
// Admin list
add_filter("manage_school_posts_columns", function ($cols) {
    $new = [];
    foreach ($cols as $k => $v) {
        $new[$k] = $v;
        if ($k === "title") {
            $new["pref_city"] = __("所在地", "wellpeak-site");
            $new["postal_code"] = __("郵便番号", "wellpeak-site");
            $new["signup_url"] = __("申込リンク", "wellpeak-site");
        }
    }
    return $new;
});
add_action(
    "manage_school_posts_custom_column",
    function ($col, $post_id) {
        if ($col === "pref_city") {
            $pref = get_post_meta($post_id, "pref", true);
            $city = get_post_meta($post_id, "city", true);
            echo esc_html(trim($pref . " " . $city));
        } elseif ($col === "postal_code") {
            echo esc_html(get_post_meta($post_id, "postal_code", true));
        } elseif ($col === "signup_url") {
            $url = get_post_meta($post_id, "signup_url", true);
            if ($url) {
                echo '<a href="' .
                    esc_url($url) .
                    '" target="_blank" rel="noopener">' .
                    esc_html__("リンク", "wellpeak-site") .
                    "</a>";
            }
        }
    },
    10,
    2,
);
