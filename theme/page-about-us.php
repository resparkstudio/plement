<?php
/**
 * The template for About us page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();

?>

<div class="relative bg-white z-10">
	<?php get_template_part( 'template-parts/section/about/section-hero' ) ?>
	<?php get_template_part( 'template-parts/section/about/section-principles' ) ?>
	<?php get_template_part( 'template-parts/section/about/section-team' ) ?>
	<?php get_template_part( 'template-parts/section/about/section-cta' ) ?>
</div>

<?php
get_footer();
?>