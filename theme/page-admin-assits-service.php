<?php
/**
 * The template for Zendesk Admin Assits Service  page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();

?>

<div class="relative bg-white z-10">
	<?php get_template_part( 'template-parts/section/zendesk-admin/section-hero' ) ?>
	<?php get_template_part( 'template-parts/section/zendesk-admin/section-benefits' ) ?>
	<?php get_template_part( 'template-parts/section/zendesk-admin/section-includes' ) ?>
	<?php get_template_part( 'template-parts/section/zendesk-admin/section-cta' ) ?>
</div>

<?php
get_footer();
?>