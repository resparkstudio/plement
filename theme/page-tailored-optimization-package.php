<?php
/**
 * The template for Zendesk Tailored Optimization Package page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();

?>

<div class="relative bg-white z-10">
	<?php get_template_part( 'template-parts/section/optimization/section-hero' ) ?>
	<?php get_template_part( 'template-parts/section/optimization/section-services' ) ?>
	<?php get_template_part( 'template-parts/section/optimization/section-cta' ) ?>
</div>

<?php
get_footer();
?>