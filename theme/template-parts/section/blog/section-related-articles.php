<?php
$related_articles = get_posts(array(
	'post_type' => 'blog-post',
	'posts_per_page' => 3,
	'post__not_in' => array(get_the_ID()),
));

function plmt_related_blog_card($blog)
{
	?>
	<div
		class="flex-1 flex flex-col-reverse lg:flex-row w-full justify-between gap-4 lg:gap-8 pb-4 pt-4 lg:pt-0 lg:pb-0 border-t border-t-lightGray first:border-t-0 first:pt-0">
		<div>
			<a href="<?php echo esc_url(get_permalink($blog->ID)) ?>"
				class="max-w-[40rem] w-full h-auto hidden lg:block aspect-[424/240] mb-5">
				<?php
				if (has_post_thumbnail($blog->ID)) {
					echo get_the_post_thumbnail($blog->ID, 'medium_large', [
						'class' => 'max-w-[40rem] w-full h-auto object-cover aspect-[424/240]',
						'alt' => get_the_title($blog->ID),
					]);
				}
				?>
			</a>
			<?php plmt_blog_card_taxonomy_beads($blog); ?>
			<div class="mt-3 mb-2 lg:mb-3 lg:mt-5">
				<?php plmt_blog_data_row($blog); ?>
			</div>
			<a href="<?php echo esc_url(get_permalink($blog->ID)) ?>">
				<h3 class="text-h5Mobile lg:text-h5Bold">
					<?php echo esc_html(get_the_title($blog)) ?>
				</h3>
			</a>
		</div>
	</div>
	<?php
}

?>

<div class="mt-8 lg:mt-16 pt-4 lg:pt-6 border-t border-t-lightGray">
	<div class="flex items-center w-full justify-between mb-4 lg:mb-6">
		<span class="text-h3Mobile lg:text-h3">
			<?php esc_html_e('Related articles', 'plmt'); ?>
		</span>
		<a href="/blog"
			class="text-darkGray flex items-center gap-2 hover:text-accent transition-colors duration-200 ease-in-out">
			<span class="hidden lg:inline">
				<?php esc_html_e('Browse All Articles', 'plmt') ?>
			</span>
			<span class="lg:hidden">
				<?php esc_html_e('Browse All', 'plmt') ?>
			</span>
			<span class="rotate-180">
				<?php plmt_arrow_left(); ?>
			</span>
		</a>
	</div>
	<div class="flex flex-col lg:flex-row lg:gap-5">
		<?php foreach ($related_articles as $blog): ?>
			<?php plmt_related_blog_card($blog) ?>
		<?php endforeach; ?>
	</div>
</div>