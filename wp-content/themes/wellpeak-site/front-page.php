<!--Aim is to separate most things into components.-->

<?php get_header(); ?>
<main id="main" class="front-page">
<?php get_template_part("template-parts/hero"); ?>
<?php get_template_part("template-parts/about"); ?>
<?php get_template_part("template-parts/faq"); ?>
<?php get_template_part("template-parts/cta"); ?>
<?php get_template_part("template-parts/news"); ?>
</main>
<?php get_footer(); ?>
