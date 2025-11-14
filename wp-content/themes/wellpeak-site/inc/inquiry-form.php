<?php
if (!defined("ABSPATH")) {
    exit();
}

function wellpeak_get_schools_list()
{
    if (function_exists("wellpeak_get_schools")) {
        $schools = wellpeak_get_schools();
        $out = [];
        if (is_array($schools)) {
            foreach ($schools as $k => $v) {
                if (is_array($v) && isset($v["id"], $v["name"])) {
                    $out[] = ["id" => $v["id"], "name" => $v["name"]];
                } else {
                    $out[] = [
                        "id" => is_numeric($k) ? $v : $k,
                        "name" => is_array($v)
                            ? $v["title"] ?? ($v["name"] ?? "")
                            : $v,
                    ];
                }
            }
        }
        return $out;
    }

    if (post_type_exists("school")) {
        $posts = get_posts([
            "post_type" => "school",
            "numberposts" => -1,
            "orderby" => "title",
            "order" => "ASC",
        ]);
        return array_map(
            fn($p) => ["id" => $p->ID, "name" => $p->post_title],
            $posts,
        );
    }

    return [
        ["id" => "machida", "name" => "町田スクール"],
        ["id" => "tamaplaza", "name" => "たまプラーザスクール"],
        ["id" => "kawasaki", "name" => "川崎スクール"],
    ];
}

add_action("init", function () {
    if (post_type_exists("inquiry")) {
        return;
    }
    register_post_type("inquiry", [
        "label" => "Inquiries",
        "labels" => ["name" => "Inquiries", "singular_name" => "Inquiry"],
        "public" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "supports" => ["title", "editor", "custom-fields"],
        "menu_icon" => "dashicons-email-alt",
    ]);
});

add_action("wp_ajax_nopriv_wellpeak_submit_inquiry", "wellpeak_handle_inquiry");
add_action("wp_ajax_wellpeak_submit_inquiry", "wellpeak_handle_inquiry");

function wellpeak_handle_inquiry()
{
    check_ajax_referer("wellpeak_inquiry", "nonce");

    $school = isset($_POST["school"])
        ? sanitize_text_field(wp_unslash($_POST["school"]))
        : "";
    $gname = isset($_POST["guardian_name"])
        ? sanitize_text_field(wp_unslash($_POST["guardian_name"]))
        : "";
    $cname = isset($_POST["child_name"])
        ? sanitize_text_field(wp_unslash($_POST["child_name"]))
        : "";
    $birth = isset($_POST["child_birth"])
        ? sanitize_text_field(wp_unslash($_POST["child_birth"]))
        : "";
    $phone = isset($_POST["phone"])
        ? sanitize_text_field(wp_unslash($_POST["phone"]))
        : "";
    $email = isset($_POST["email"])
        ? sanitize_email(wp_unslash($_POST["email"]))
        : "";
    $message = isset($_POST["message"])
        ? wp_kses_post(wp_unslash($_POST["message"]))
        : "";
    $consent = !empty($_POST["consent"]) ? 1 : 0;

    $errors = [];
    if ($school === "") {
        $errors["school"] = "スクールを選択してください。";
    }
    if ($gname === "") {
        $errors["guardian_name"] = "保護者のお名前は必須です。";
    }
    if ($email === "" || !is_email($email)) {
        $errors["email"] = "メールアドレスの形式が正しくありません。";
    }
    if (!$consent) {
        $errors["consent"] = "同意が必要です。";
    }

    if ($errors) {
        wp_send_json_error(["errors" => $errors], 422);
    }

    $post_id = wp_insert_post([
        "post_type" => "inquiry",
        "post_status" => "publish",
        "post_title" => sprintf(
            "%s (%s) - %s",
            $gname,
            $school,
            current_time("Y-m-d H:i"),
        ),
        "post_content" => wp_strip_all_tags($message),
        "meta_input" => [
            "school" => $school,
            "guardian_name" => $gname,
            "child_name" => $cname,
            "child_birth" => $birth,
            "phone" => $phone,
            "email" => $email,
            "consent" => $consent,
            "user_agent" => isset($_SERVER["HTTP_USER_AGENT"])
                ? sanitize_text_field($_SERVER["HTTP_USER_AGENT"])
                : "",
            "ip" => isset($_SERVER["REMOTE_ADDR"])
                ? sanitize_text_field($_SERVER["REMOTE_ADDR"])
                : "",
        ],
    ]);

    if (is_wp_error($post_id)) {
        wp_send_json_error(["message" => "保存に失敗しました。"], 500);
    }

    $to = get_option("wellpeak_inquiry_email", get_option("admin_email"));

    $subj = "【お問い合わせ】" . $gname . " - " . $school;
    $body =
        "お問い合わせが届きました。\n\n" .
        "スクール: {$school}\n" .
        "保護者: {$gname}\n" .
        "お子様: {$cname}\n" .
        "生年月日: {$birth}\n" .
        "電話番号: {$phone}\n" .
        "メール: {$email}\n" .
        "同意: " .
        ($consent ? "はい" : "いいえ") .
        "\n\n" .
        "内容:\n{$message}\n\n" .
        "管理URL: " .
        admin_url("post.php?post={$post_id}&action=edit");

    $headers = [];
    $from_email =
        "no-reply@" . preg_replace("/^www\./", "", $_SERVER["SERVER_NAME"]);
    $headers[] = "From: Wellpeak Kids English School <" . $from_email . ">";
    if ($email) {
        $headers[] = "Reply-To: " . $gname . " <" . $email . ">";
    }

    wp_mail($to, $subj, $body, $headers);

    if ($email) {
        $auto_subj = "お問い合わせありがとうございます";
        $auto_body = "{$gname} 様\n\nお問い合わせありがとうございます。担当者より折り返しご連絡いたします。\n\n送信内容の控え：\n\n{$body}";
        wp_mail($email, $auto_subj, $auto_body, $headers);
    }

    wp_send_json_success([
        "message" => "送信しました。ありがとうございました。",
        "post_id" => $post_id,
    ]);
}

add_shortcode("inquiry_form", function ($atts) {
    $atts = shortcode_atts(
        [
            "image" =>
                get_stylesheet_directory_uri() . "/images/section-1-image.jpg",
            "privacy_url" => home_url("/privacy-policy/"),
        ],
        $atts,
    );

    $uri = get_stylesheet_directory_uri();
    $file = get_stylesheet_directory() . "/js/inquiry.js";
    $ver = file_exists($file) ? filemtime($file) : null;

    wp_enqueue_script(
        "wellpeak-inquiry",
        $uri . "/js/inquiry.js",
        [],
        $ver,
        true,
    );
    wp_localize_script("wellpeak-inquiry", "WellpeakInquiry", [
        "ajax_url" => admin_url("admin-ajax.php"),
        "nonce" => wp_create_nonce("wellpeak_inquiry"),
    ]);

    $schools = wellpeak_get_schools_list();

    ob_start();
    ?>
    <section class="inquiry">
      <div class="inquiry-inner">
        <form class="inquiry-form" novalidate>
          <div class="form-pane">
            <div class="field">
              <label for="school">お問い合わせ先のスクールをお選びください <span class="req">*</span></label>
              <select id="school" name="school" required>
                <option value="" selected disabled>選択してください</option>
                <?php foreach ($schools as $s): ?>
                  <option value="<?php echo esc_attr(
                      $s["id"],
                  ); ?>"><?php echo esc_html($s["name"]); ?></option>
                <?php endforeach; ?>
              </select>
              <p class="error" aria-live="polite"></p>
            </div>

            <div class="field">
              <label for="guardian_name">保護者のお名前 <span class="req">*</span></label>
              <input type="text" id="guardian_name" name="guardian_name" required>
              <p class="error" aria-live="polite"></p>
            </div>

            <div class="field">
              <label for="child_name">お子様のお名前</label>
              <input type="text" id="child_name" name="child_name">
              <p class="error" aria-live="polite"></p>
            </div>

            <div class="field">
              <label for="child_birth">お子様の生年月日</label>
              <input type="date" id="child_birth" name="child_birth" inputmode="numeric" pattern="\d{4}-\d{2}-\d{2}">
              <p class="error" aria-live="polite"></p>
            </div>

            <div class="field">
              <label for="phone">電話番号</label>
              <input type="tel" id="phone" name="phone" inputmode="tel" pattern="^[0-9+\-\s()]{8,20}$" placeholder="例）090-1234-5678">
              <p class="error" aria-live="polite"></p>
            </div>

            <div class="field">
              <label for="email">メールアドレス <span class="req">*</span></label>
              <input type="email" id="email" name="email" required placeholder="example@example.com">
              <p class="error" aria-live="polite"></p>
            </div>

            <div class="field">
              <label for="message">お問い合わせ内容</label>
              <textarea id="message" name="message" rows="5"></textarea>
              <p class="error" aria-live="polite"></p>
            </div>

            <div class="consent">
              <p><a href="<?php echo esc_url(
                  $atts["privacy_url"],
              ); ?>" target="_blank" rel="noopener">プライバシーポリシー</a>をご確認いただき、ご同意の上で送信ください。</p>
              <label class="checkbox">
                <input type="checkbox" id="consent" name="consent" required>
                <span>個人情報保護方針に同意する <span class="req">*</span></span>
              </label>
              <p class="error" aria-live="polite"></p>
            </div>

            <div class="actions">
              <button type="submit" class="btn-submit">送信</button>
            </div>

            <div class="form-status" aria-live="polite"></div>
          </div>

          <div class="image-pane">
            <img src="<?php echo esc_url(
                $atts["image"],
            ); ?>" alt="" loading="lazy" decoding="async">
          </div>
        </form>
      </div>
    </section>
    <?php return ob_get_clean();
});
