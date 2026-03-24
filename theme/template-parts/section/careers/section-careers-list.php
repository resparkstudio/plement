<?php

const JOB_CATEGORY_TAXONOMY_SLUG = 'job-category';

$careers = get_posts([
	'post_type' => 'career',
	'posts_per_page' => -1,
	'orderby' => 'title',
	'order' => 'ASC',
]);

$grouped_careers = [];

foreach ($careers as $career) {
	$terms = get_the_terms($career->ID, JOB_CATEGORY_TAXONOMY_SLUG);

	if ($terms && !is_wp_error($terms)) {
		foreach ($terms as $term) {
			$grouped_careers[$term->name][] = $career;
		}
	}
}

ksort($grouped_careers);

function career_tags_list($tags)
{
	if ($tags): ?>
		<div class="flex w-full justify-between">
			<div class="flex items-center gap-2 mb-4">
				<?php foreach ($tags as $tag): ?>
					<span class="text-xs lg:text-sm font-bold text-accent bg-accent/15 px-2 py-1">
						<?php echo esc_html($tag['tag']); ?>
					</span>
				<?php endforeach; ?>
			</div>
			<div class="lg:hidden text-accent">
				<?php plmt_arrow() ?>
			</div>
		</div>
	<?php endif;
}

function career_content($title, $excerpt)
{
	?>
	<h3 class="text-h5Mobile lg:text-h5Bold mb-2">
		<?php echo esc_html($title); ?>
	</h3>
	<?php if ($excerpt): ?>
		<p class="text-darkGray text-bodySmall lg:text-bodyRegular">
			<?php echo esc_html($excerpt); ?>
		</p>
	<?php endif; ?>
<?php
}

function mobile_career_card($career)
{
	$tags    = get_field('tags', $career->ID);
	$excerpt = get_field('excerpt', $career->ID);
	$link    = get_permalink($career->ID);
	?>
	<a href="<?php echo esc_url($link) ?>"
		class="flex justify-between items-center w-full py-3 px-4 lg:py-6 lg:px-8 border border-lightGray">
		<div class="block">
			<?php career_tags_list($tags) ?>
			<?php career_content(get_the_title($career->ID), $excerpt) ?>
		</div>
	</a>
	<?php
}

function desktop_career_card($career)
{
	$tags    = get_field('tags', $career->ID);
	$excerpt = get_field('excerpt', $career->ID);
	$link    = get_permalink($career->ID);
	?>
	<div class="flex justify-between items-center w-full py-3 px-4 lg:py-6 lg:px-8 border border-lightGray">
		<div class=" block">
			<?php career_tags_list($tags) ?>
			<?php career_content(get_the_title($career->ID), $excerpt) ?>
		</div>
		<?php plmt_icon_button($link, 'Open', array(
			'variant' => 'outlined'
		)) ?>
	</div>
	<?php
}
?>

<div class="bg-lightGrayBg">
	<div class="container py-10 lg:py-20 space-y-6">
		<?php foreach ($grouped_careers as $category_name => $careers_in_category): ?>
			<div>
				<h2 class="text-h4BoldMobile lg:text-h4Bold mb-4"><?php echo esc_html($category_name); ?></h2>

				<div class="space-y-4">
					<?php foreach ($careers_in_category as $career):
						?>
						<div class="block lg:hidden">
							<?php mobile_career_card($career) ?>
						</div>
						<div class="hidden lg:block">
							<?php desktop_career_card($career) ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>