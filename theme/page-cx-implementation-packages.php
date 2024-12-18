<?php
/**
 * The template for Proven CS Launch Package  page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
?>

<section class="container relative z-10 bg-white pb-[7.5rem]">
	<div
		class="pt-6 pb-[5.75rem] space-y-4 lg:pt-20 lg:pb-[3.9375rem] lg:text-center lg:max-w-[39.75rem] lg:mx-auto lg:space-y-6">
		<?php if ( $heading ) : ?>
			<h1 class="text-h1Mobile lg:text-h2"><?php esc_html_e( $heading ) ?></h1>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="text-bodyRegular text-darkGray lg:text-title"><?php esc_html_e( $description ) ?></p>
		<?php endif; ?>
	</div>
	<div>
		<?php get_template_part( 'template-parts/section/section-pricing' ) ?>
	</div>
</section>

<?php
get_footer();
?>