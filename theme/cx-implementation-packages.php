<?php
/**
 * Template Name: Proven CS Launch Package
 * The template for Proven CS Launch Package  page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();

$heading      = get_field( 'heading' );
$description  = get_field( 'description' );
$hide_pricing = get_field( 'hide_pricing' );
?>

<section class="relative z-10 bg-white pb-14 lg:pb-20" x-data="{currency: 'eur'}">
	<?php get_template_part( 'template-parts/section/zendesk/section-hero' ) ?>
	<?php get_template_part( 'template-parts/section/zendesk/section-info' ) ?>
	<?php if ( ! $hide_pricing ) : ?>
		<div class="bg-lightGrayBg mt-6 lg:mt-20 pb-7 lg:pb-16">
			<div
				class="container pt-6 pb-4 space-y-4 lg:pt-20 lg:pb-10 lg:text-center lg:max-w-[82rems] lg:mx-auto lg:space-y-6">
				<?php if ( $heading ) : ?>
					<h1 class="text-h1Mobile lg:text-displayLarge text-center"><?php esc_html_e( $heading ) ?></h1>
				<?php endif; ?>
				<?php if ( $description ) : ?>
					<p class="text-titleMobile text-darkGray lg:text-title text-center"><?php esc_html_e( $description ) ?></p>
				<?php endif; ?>
			</div>
			<div class="container">
				<?php get_template_part( 'template-parts/section/section-pricing' ) ?>
			</div>
		</div>
	<?php endif; ?>
	<?php get_template_part( 'template-parts/section/intercom/section-price' ) ?>
	<?php if ( $hide_pricing ) : ?>
		<?php get_template_part( 'template-parts/section/zendesk/section-large-service' ) ?>
	<?php endif; ?>
	<?php get_template_part( 'template-parts/section/zendesk/section-services' ) ?>
</section>

<?php
get_footer();
?>