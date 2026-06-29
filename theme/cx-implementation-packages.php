<?php
/**
 * Template Name: Proven CS Launch Package
 * The template for Proven CS Launch Package  page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header(null, ['type' => 'dark']);

$heading      = get_field('heading');
$description  = get_field('description');
$hide_pricing = get_field('hide_pricing');
?>

<section class="relative z-10 bg-white pb-14 lg:pb-20" x-data="{currency: 'eur'}">
	<?php get_template_part('template-parts/section/zendesk/section-hero') ?>
	<?php get_template_part('template-parts/section/zendesk/section-cards-carousel') ?>
	<?php if (!$hide_pricing): ?>
		<div class="py-7 lg:py-16 mb-14 lg:mb-20 bg-lightGrayBg">
			<div class="container space-y-4 lg:text-center lg:max-w-[82rems] lg:mx-auto lg:space-y-6">
				<?php if ($heading): ?>
					<h1 class="text-h1Mobile lg:text-displayLarge text-center"><?php esc_html_e($heading) ?></h1>
				<?php endif; ?>
				<?php if ($description): ?>
					<p class="text-titleMobile text-darkGray lg:text-title text-center"><?php esc_html_e($description) ?></p>
				<?php endif; ?>
			</div>
			<div class="container">
				<?php get_template_part('template-parts/section/section-pricing') ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="py-8 lg:py-20">
		<?php get_template_part('template-parts/section/intercom/section-price') ?>
		<?php get_template_part('template-parts/section/zendesk/section-services') ?>
		<?php get_template_part('template-parts/section/zendesk/section-bottom-block') ?>
	</div>
</section>

<?php
get_footer();
?>