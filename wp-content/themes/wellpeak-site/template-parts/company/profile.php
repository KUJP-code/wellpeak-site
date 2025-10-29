<?php
/**
 * Template Part: Company Profile
 * Description: 商号・所在地などの会社情報を表示。
 */
?>
<section class="company-profile">
  <div class="container profile-inner">
    <h2 class="section-title">会社概要</h2>

    <div class="profile-logo">
      <img
        src="<?php echo get_stylesheet_directory_uri(); ?>/images/nav-logo.svg"
        alt="株式会社何々 ロゴ"
        decoding="async"
        loading="lazy"
      />
    </div>

    <div class="profile-card" role="table" aria-label="会社概要">
        <dl>
          <div><dt>商号</dt><dd>WELLPEAK KIDS ENGLISH SCHOOL （セルテック株式会社）</dd></div>
          <div><dt>所在地</dt><dd>〒151-0064 東京都渋谷区上原3丁目1−16 （WELLPEAK 代々木上原校）</dd></div>
          <div><dt>設立</dt><dd>2026年2月</dd></div>
          <div><dt>事業責任者</dt><dd>佐藤 健二</dd></div>
          <div><dt>役員一覧</dt><dd>代表取締役 何々太郎</dd></div>
          <div><dt>事業内容</dt><dd>アフタースクールの運営（幼児/小学生）イベント事業、キャンプ事業</dd></div>
        </dl>
    </div>
  </div>
</section>
