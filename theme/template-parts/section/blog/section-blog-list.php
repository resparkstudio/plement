<?php

$featured_blog = get_posts([
	'post_type' => 'blog-post',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'DESC',
	'meta_query' => [
		[
			'key' => 'featured',
			'value' => 1,
			'compare' => '=',
		],
	],
]);

$featured_blog_id = !empty($featured_blog) ? $featured_blog[0]->ID : 0;

$blogs = get_posts([
	'post_type' => 'blog-post',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'DESC',
	'post__not_in' => $featured_blog_id ? [$featured_blog_id] : [],
]);



function featured_blog_card($blog)
{
	$excerpt = get_field('excerpt', $blog->ID);
	?>
	<div class="flex flex-col-reverse lg:flex-row w-full justify-between gap-4 lg:gap-8 pb-4 lg:pb-8">
		<div>
			<?php plmt_blog_card_taxonomy_beads($blog); ?>
			<div class="mt-3 mb-2 lg:mb-3 lg:mt-6">
				<?php plmt_blog_data_row($blog); ?>
			</div>
			<a href="<?php echo esc_url(get_permalink($blog->ID)) ?>">
				<h3 class="text-h5Mobile lg:text-h4Bold">
					<?php echo esc_html(get_the_title($blog)) ?>
				</h3>
			</a>
			<?php if ($excerpt): ?>
				<p class="text-darkGray text-sm lg:text-bodyRegular mt-2 lg:mt-3">
					<?php esc_html_e($excerpt); ?>
				</p>
			<?php endif; ?>
		</div>
		<a href="<?php echo esc_url(get_permalink($blog->ID)) ?>"
			class="max-w-[40rem] w-full h-auto aspect-[343/240] lg:aspect-[640/316]">
			<?php
			if (has_post_thumbnail($blog->ID)) {
				echo get_the_post_thumbnail($blog->ID, 'medium_large', [
					'class' => 'max-w-[40rem] w-full h-auto object-cover aspect-[343/240] lg:aspect-[640/316]',
					'alt' => get_the_title($blog->ID),
				]);
			}
			?>
		</a>
	</div>
	<?php
}

function blog_card($blog)
{
	?>
	<div
		class="flex w-full justify-between gap-8 py-4 lg:py-8 border-b border-b-lightGray first:pt-0 last:border-0 last:pb-0">
		<div>
			<?php plmt_blog_card_taxonomy_beads($blog); ?>
			<div class="mt-3 mb-2 lg:mb-3 lg:mt-6">
				<?php plmt_blog_data_row($blog); ?>
			</div>
			<a href="<?php echo esc_url(get_permalink($blog->ID)) ?>">
				<h3 class="text-h5Mobile lg:text-h4Bold">
					<?php echo esc_html(get_the_title($blog)) ?>
				</h3>
			</a>
		</div>
		<a href="<?php echo esc_url(get_permalink($blog->ID)) ?>"
			class="max-w-[23rem] w-full h-auto object-cover hidden lg:block">
			<?php
			if (has_post_thumbnail($blog->ID)) {
				echo get_the_post_thumbnail($blog->ID, 'medium_large', [
					'class' => 'max-w-[23rem] w-full h-auto object-cover',
					'alt' => get_the_title($blog->ID),
				]);
			}
			?>
		</a>

	</div>
	<?php

}

?>

<div class="container">
	<?php if ($featured_blog): ?>
		<?php featured_blog_card($featured_blog[0]) ?>
	<?php endif; ?>
	<?php foreach ($blogs as $blog):
		blog_card($blog);
	endforeach; ?>
</div>