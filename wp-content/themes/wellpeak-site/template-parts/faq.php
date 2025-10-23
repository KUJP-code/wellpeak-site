<?php
/**
 * Template Part: FAQ Section
 * Description: Regular questions and answers
 */
?>

<section class="faq" id="faq">
  <div class="container">
    <div class="faq-header-wrap">
      <h2 class="faq-title">よくある質問</h2>
      <span class="faq-underline" aria-hidden="true"></span>
    </div>

    <div class="faq-list">
      <?php
      // array for now, will incorporate wordpress db.
      $faqs = [
          [
              "q" => "質問1",
              "a" =>
                  "これはダミーテキストです。これは仮のテキストです。こちらはプレースホルダーテキストです。ダミーテキスト、ダミーテキスト、これはあくまでサンプルです。仮の文章として使用しています。",
          ],
          [
              "q" => "質問2",
              "a" =>
                  "このテキストは実際の内容ではありません。これはプレースホルダーです。これはダミーテキストです。これはダミーテキストであり、本物の情報ではありません。",
          ],
          [
              "q" => "質問3",
              "a" =>
                  "仮に入力された文章です。これは仮のテキストです。これはサンプルのテキストです。繰り返しますが、これはダミーです。",
          ],
          [
              "q" => "質問4",
              "a" =>
                  "ダミーテキストです。これは仮のテキストであり、最終的な内容ではありません。プレースホルダーテキスト、ダミーテキスト、テスト用の文章です。何度も言いますが、これは本物ではありません。",
          ],
      ];
      foreach ($faqs as $i => $item):
          $qid = "faq-item-" . ($i + 1); ?>
      <div class="faq-item" id="<?= esc_attr($qid) ?>">
        <button class="faq-question" aria-expanded="false" aria-controls="<?= esc_attr(
            $qid,
        ) ?>-panel">
          <span class="faq-q"><?= esc_html($item["q"]) ?></span>
          <span class="faq-toggle" aria-hidden="true"></span>
        </button>
        <div class="faq-answer" id="<?= esc_attr($qid) ?>-panel" hidden>
          <p>
            これはダミーテキストです。これは仮のテキストです。こちらはプレースホルダーテキストです。
            ダミーテキスト、ダミーテキスト、これはあくまでサンプルです。仮の文章として使用しています。
            このテキストは実際の内容ではありません。これはプレースホルダーです。これはダミーテキストです。
            これはダミーテキストであり、本物の情報ではありません。仮に入力された文章です。これは仮のテキストです。
            これはサンプルのテキストです。繰り返しますが、これはダミーです。ダミーテキストです。これは仮のテキストであり、
            最終的な内容ではありません。プレースホルダーテキスト、ダミーテキスト、テスト用の文章です。何度も言いますが、
            これは本物ではありません。これはただのダミーテキストです。あくまでも仮のテキストで、実際の意味はありません。
          </p>
        </div>
      </div>
      <?php
      endforeach;
      ?>
    </div>
  </div>
</section>
