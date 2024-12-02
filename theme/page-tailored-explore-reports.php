<?php
/**
 * The template for Tailored Explore Reports page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();

?>

<div class="relative bg-white z-10">
	<?php get_template_part( 'template-parts/section/reporting/section-hero' ) ?>
	<?php get_template_part( 'template-parts/section/reporting/section-services' ) ?>
</div>

<?php
get_footer();
?>