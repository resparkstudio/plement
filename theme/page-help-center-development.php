<?php
/**
 * The template for Help Center development page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();

?>

<div class="relative bg-white z-10">
	<?php get_template_part( 'template-parts/section/help-center/section-hero' ) ?>
	<?php get_template_part( 'template-parts/section/help-center/section-services' ) ?>
	<?php get_template_part( 'template-parts/section/help-center/section-gallery' ) ?>
</div>

<?php
get_footer();
?>