<?php
/**
 * Template Part: Executives Section
 * Description: 幹部紹介 with image slider and dropdown details (container width).
 */
?>
<section class="executives">
  <div class="container executives-content">
    <div class="section-title">幹部について</div>
    <span class="faq-underline" aria-hidden="true"></span>

    <div class="exec-slider">
      <?php echo do_shortcode('[smartslider3 slider="2"]'); ?>
    </div>

    <div class="exec-accordion faq">
      <div class="faq-list">
        <div class="faq-item">
          <button class="faq-question" type="button" aria-expanded="false">
            <span class="faq-q">例名1</span>
            <span class="faq-toggle" aria-hidden="true"></span>
          </button>
          <div class="faq-answer" hidden>
            <p>役職や担当、簡単な紹介テキストをここに入れます。</p>
          </div>
        </div>
<!--Reuses the FAQ markup styling from front-page,
I should have extracted this into a plain naming convention but it's not a huge deal.-->
        <div class="faq-item">
          <button class="faq-question" type="button" aria-expanded="false">
            <span class="faq-q">例名2</span>
            <span class="faq-toggle" aria-hidden="true"></span>
          </button>
          <div class="faq-answer" hidden>
            <p>役職や担当、簡単な紹介テキストをここに入れます。</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" type="button" aria-expanded="false">
            <span class="faq-q">例名3</span>
            <span class="faq-toggle" aria-hidden="true"></span>
          </button>
          <div class="faq-answer" hidden>
            <p>役職や担当、簡単な紹介テキストをここに入れます。</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
