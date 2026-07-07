<?php
add_action('wp_head', function () {
	if (!is_post_type_archive('case-study') || empty($_GET['tool'])) {
		return;
	}

	$tool_slug = sanitize_text_field($_GET['tool']);

	$term = get_term_by('slug', $tool_slug, 'tool');

	if (!$term || is_wp_error($term)) {
		return;
	}

	$seo_fields  = get_field('seo_fields', $term);
	$title       = $seo_fields['seo_title'] ? $seo_fields['seo_title'] : $term->name;
	$description = $seo_fields['seo_description'];
	$image       = $seo_fields['og_image'];

	if (is_array($image)) {
		$image = $image['url'];
	}

	if ($title) {
		echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
	}

	if ($description) {
		echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
	}

	if ($image) {
		echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
	}
});
