<!--Doing things as template parts is probably smart so we can work on them separately.-->

<?php get_header(); ?>

<?php get_template_part("template-parts/hero"); ?>
<?php get_template_part("template-parts/features"); ?>
<?php get_template_part("template-parts/cta"); ?>
<?php get_template_part("template-parts/faq"); ?>
<?php get_template_part("template-parts/news"); ?>

<?php get_footer(); ?>
