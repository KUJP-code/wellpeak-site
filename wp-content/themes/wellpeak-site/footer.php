				<section id="footer" class="footer">

<div class="footer-inner">

<div class="footer-contents-row">
<div class="footer-logo-sns-section">
	<div class="footer-logo">
		<a href="<?php echo esc_url(home_url("/")); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.svg" alt="学童保育型　英会話スクール・幼児クラス - KidsUP" class="footer-logo-img"></a></div>
	<div class="sns-box">
				<div class="sns-contents">
													<a href="https://www.instagram.com">
									<img src="<?php echo get_template_directory_uri(); ?>/images/sns-instagram.svg" alt="学童保育型　英会話スクール・幼児クラス - Wellpeak インスタグラム" width="100%" height="auto">
												    </a>
				</div>

				<div class="sns-contents">

								<a href="https://www.tiktok.com">
									<img src="<?php echo get_template_directory_uri(); ?>/images/sns-tiktok.svg" alt="学童保育型　英会話スクール・幼児クラス - Wellpeak　Tiktok" width="100%" height="auto">
								</a>
				</div>
				<div class="sns-contents">

								<a href="https://www.youtube.com">
									<img src="<?php echo get_template_directory_uri(); ?>/images/sns-youtube.svg" alt="学童保育型　英会話スクール・幼児クラス - Wellpeak YOUTUBE" width="100%" height="auto">
								</a>
				</div>

	</div>
</div>

<div class="footer-page-contents">
	<?php wp_nav_menu([
     "theme_location" => "footer-menu",
 ]); ?>
</div>
</div>

<div class="footer-lower-row">
	<div class="footer-lower-links">

	<div class="button-wrapper">

	<a href="https://www.p-up.world/privacypolicy/" class="footer-lower-link-button">プライバシーポリシーについて</a>

</div>

	</div>

	<small class="copyright"><script type="text/javascript">myDate = new Date();myYear = myDate.getFullYear ();document.write(myYear);</script> WELLPEAK All Rights Reserved.</small>


	</div>


				</section><!-- end footer-->

			</div><!-- end cp_content-->
		</div><!-- end cp_container-->
	</div><!-- end cp_cont-->
<div class="footer-bar-wrapper only_mb_only" >
	<section id="footer-bar">
		<div id="nav_cta">
			<div class="nav_school"><a href="<?php echo esc_url(
       home_url("/"),
   ); ?>school">&emsp;教室</a></div>
			<div class="nav_tel"><a href="tel:0120-378-056">&emsp;電話</a></div>
			<div class="nav_trial"><a href="<?php echo esc_url(
       home_url("/"),
   ); ?>entry">無料体験</a></div>
		</div>
	</section>
</div>
</div>
</div>
<?php wp_footer(); ?>
<script>
new WOW().init();
</script>
</body>
<script>
  function inquiryLink() {
    window.location.href = "https://kids-up.jp/inquiry/";
  }
</script>

</html>
