<?php
/**
 * Template Name: Custom Ticketing System
 * The template for Custom Ticketing System
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();

?>

<div class="relative bg-white z-10">
	<?php get_template_part( 'template-parts/section/ticketing/section-hero' ) ?>
	<?php get_template_part( 'template-parts/section/ticketing/section-services' ) ?>
	<?php get_template_part( 'template-parts/section/ticketing/section-integrations' ) ?>
	<?php get_template_part( 'template-parts/section/ticketing/section-cta' ) ?>
</div>

<?php
get_footer();
?>