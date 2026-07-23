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
	} else {
		$grouped_careers['Uncategorized'][] = $career;
	}
}

// Sort careers inside each group (future openings last)
foreach ($grouped_careers as &$group) {
	usort($group, function ($a, $b) {
		$aFuture = (bool) get_field('is_future_opening', $a->ID);
		$bFuture = (bool) get_field('is_future_opening', $b->ID);

		return $aFuture <=> $bFuture;
	});
}
unset($group);

// Sort groups
uksort($grouped_careers, function ($groupA, $groupB) use ($grouped_careers) {
	$currentA = 0;
	$futureA  = 0;

	foreach ($grouped_careers[$groupA] as $career) {
		if (get_field('is_future_opening', $career->ID)) {
			$futureA++;
		} else {
			$currentA++;
		}
	}

	$currentB = 0;
	$futureB  = 0;

	foreach ($grouped_careers[$groupB] as $career) {
		if (get_field('is_future_opening', $career->ID)) {
			$futureB++;
		} else {
			$currentB++;
		}
	}

	// Current openings first
	if ($currentA !== $currentB) {
		return $currentB <=> $currentA;
	}

	// More future openings last
	return $futureA <=> $futureB;
});

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

function career_content($title, $excerpt, $extra_description_short)
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
	<?php if ($extra_description_short): ?>
		<p class="text-darkGray italic text-bodySmallMobile lg:text-bodySmall mt-4 lg:mt-6">
			<?php echo esc_html($extra_description_short); ?>
		</p>
	<?php endif; ?>
<?php
}

function mobile_career_card($career)
{
	$tags                    = get_field('tags', $career->ID);
	$excerpt                 = get_field('excerpt', $career->ID);
	$extra_description       = get_field('extra_description', $career->ID);
	$extra_description_short = get_field('extra_description', $career->ID);
	$link                    = get_permalink($career->ID);

	if (!$extra_description_short) {
		$extra_description_short = $extra_description;
	}
	?>
	<a href="<?php echo esc_url($link) ?>"
		class="flex justify-between items-center w-full py-3 px-4 lg:py-6 lg:px-8 border border-lightGray">
		<div class="block">
			<?php career_tags_list($tags) ?>
			<?php career_content(get_the_title($career->ID), $excerpt, $extra_description_short) ?>
		</div>
	</a>
	<?php
}

function desktop_career_card($career)
{
	$tags                    = get_field('tags', $career->ID);
	$excerpt                 = get_field('excerpt', $career->ID);
	$extra_description       = get_field('extra_description', $career->ID);
	$extra_description_short = get_field('extra_description', $career->ID);
	$link                    = get_permalink($career->ID);

	if (!$extra_description_short) {
		$extra_description_short = $extra_description;
	}
	?>
	<div class="flex justify-between items-center w-full py-3 px-4 lg:py-6 lg:px-8 border border-lightGray">
		<div class=" block">
			<?php career_tags_list($tags) ?>
			<?php career_content(get_the_title($career->ID), $excerpt, $extra_description_short) ?>
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
				<?php if ($category_name !== 'Uncategorized'): ?>
					<h2 class="text-h4BoldMobile lg:text-h4Bold mb-4"><?php echo esc_html($category_name); ?></h2>
				<?php endif; ?>

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