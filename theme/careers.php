<?php
/**
 * Template Name: Careers
 * The template for Careers page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header(null, ['type' => 'light']);

$heading     = get_field('heading');
$description = get_field('subtext');
?>

<section class="relative z-10 bg-white pb-14 lg:pb-16 pt-7 lg:pt-[3.75rem]" x-data="{currency: 'eur'}">
	<div class="container space-y-3 mb-10 lg:mb-20 lg:text-center lg:max-w-[30.875rem] lg:mx-auto lg:space-y-4">
		<?php if ($heading): ?>
			<h1 class="text-h1Mobile lg:text-h1"><?php esc_html_e($heading) ?></h1>
		<?php endif; ?>
		<?php if ($description): ?>
			<p class="text-titleMobile text-darkGray lg:text-title"><?php esc_html_e($description) ?></p>
		<?php endif; ?>
	</div>
	<?php get_template_part('template-parts/section/careers/section-careers-list') ?>
	<?php get_template_part('template-parts/section/careers/section-cta') ?>
</section>

<?php
get_footer();
?>