<?php
$industry_terms = get_terms([
	'taxonomy' => 'industry',
	'hide_empty' => true,
]);

$platform_terms = get_terms([
	'taxonomy' => 'blog-platform',
	'hide_empty' => true,
]);

$industry_options = array();
if ($industry_terms) {
	foreach ($industry_terms as $industry) {
		$industry_options[$industry->slug] = $industry->name;
	}
}

$platform_options = array();
if ($platform_terms) {
	foreach ($platform_terms as $platform) {
		$platform_options[$platform->slug] = $platform->name;
	}
}

$filters_enabled = get_field('filters_enabled');
?>

<div class="container">
	<?php if ($filters_enabled): ?>
		<div class="mb-6 lg:mb-10 flex flex-col sm:flex-row gap-2">
			<?php plmt_dropdown($industry_options, __('Filter by Industries:', 'plmt'), 'industry-filter'); ?>
			<?php plmt_dropdown($platform_options, __('Filter by Platform:', 'plmt'), 'platform-filter'); ?>
		</div>
	<?php endif; ?>
	<?php $initial_result = plmt_render_blog_results('', '', 0, 5); ?>
	<div id="blogs-results">
		<?php echo $initial_result['html']; ?>
	</div>
	<div class="flex justify-center  mt-8 lg:mt-10">
		<button id="blogs-load-more"
			class="button w-full md:w-auto justify-center group <?php echo $initial_result['has_more'] ? '' : 'hidden'; ?>"
			data-offset="<?php echo esc_attr($initial_result['next_offset']); ?>">
			<?php esc_html_e('Load more', 'plmt'); ?>
		</button>
	</div>
</div>