<?php
/**
 * Template Name: Blog
 * The template for Blog page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header(null, ['type' => 'light']);

$heading     = get_field('heading');
$description = get_field('description');
?>

<section class="relative z-10 bg-white pb-14 lg:pb-20 pt-7 lg:pt-[3.75rem]">
	<div class="container space-y-3 mb-10 lg:mb-20 lg:text-center lg:mx-auto lg:space-y-4">
		<?php if ($heading): ?>
			<h1 class="text-h1Mobile lg:text-h1">
				<?php esc_html_e($heading) ?>
			</h1>
		<?php endif; ?>
		<?php if ($description): ?>
			<p class="text-titleMobile text-darkGray lg:text-title">
				<?php esc_html_e($description) ?>
			</p>
		<?php endif; ?>
	</div>
	<?php get_template_part('template-parts/section/blog/section-blog-content') ?>
</section>

<?php
get_footer();
?>