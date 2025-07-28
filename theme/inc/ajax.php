<?php
function filter_case_studies() {
	// Sanitize input
	$category = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';
	$tool     = isset( $_POST['tool'] ) ? sanitize_text_field( $_POST['tool'] ) : '';

	$tax_query = array();

	// Handle category filtering
	if ( $category !== 'all' && ! empty( $category ) ) {
		$categories_array = explode( ',', $category );
		$categories_array = array_filter( $categories_array );

		if ( ! empty( $categories_array ) ) {
			$tax_query[] = array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $categories_array,
			);
		}
	}

	// Handle tool filtering
	if ( $tool !== 'all' && ! empty( $tool ) ) {
		$tools_array = explode( ',', $tool );
		$tools_array = array_filter( $tools_array );

		if ( ! empty( $tools_array ) ) {
			$tax_query[] = array(
				'taxonomy' => 'tool', // Replace 'tool' with your actual tool taxonomy name
				'field' => 'slug',
				'terms' => $tools_array,
			);
		}
	}

	// Set relation to AND if we have multiple taxonomies
	if ( count( $tax_query ) > 1 ) {
		$tax_query['relation'] = 'AND';
	}

	$ajaxposts = new WP_Query(
		array(
			'post_type' => 'case-study',
			'posts_per_page' => 6,
			'paged' => 1,
			'order' => 'desc',
			'tax_query' => $tax_query,
		)
	);

	$response = '';

	if ( $ajaxposts->have_posts() ) {
		while ( $ajaxposts->have_posts() ) :
			$ajaxposts->the_post();
			ob_start();
			get_template_part( 'template-parts/content/content', 'case-study', array( 'taxonomy' => 'category' ) );
			$response .= ob_get_clean();
		endwhile;
	} else {
		$response = 'No case studies found';
	}

	$more_count = $ajaxposts->found_posts - 3;

	wp_send_json( array( 'html' => $response, 'moreCount' => $more_count >= 0 ? $more_count : 0 ) );
	exit;
}
add_action( 'wp_ajax_filter_case_studies', 'filter_case_studies' );
add_action( 'wp_ajax_nopriv_filter_case_studies', 'filter_case_studies' );

function load_more_case_studies() {
	$paged          = $_POST['page'] + 1;
	$posts_per_page = 3;

	$category = $_POST['category'];

	// Sanitize input
	$category = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';

	$categories_array = explode( ',', string: $category );
	$categories_array = array_filter( $categories_array );

	$tax_query = array();

	if ( $category !== 'all' && ! empty( $categories_array ) ) {
		$tax_query = array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $categories_array,
			),
		);
	}

	$ajaxposts = new WP_Query(
		array(
			'post_type' => 'case-study',
			'posts_per_page' => $posts_per_page,
			'paged' => $paged,
			'order' => 'desc',
			'tax_query' => $tax_query,
		)
	);


	$response = '';

	if ( $ajaxposts->have_posts() ) {
		while ( $ajaxposts->have_posts() ) :
			$ajaxposts->the_post();
			ob_start();
			get_template_part( 'template-parts/content/content', 'case-study', array( 'taxonomy' => 'category' ) );
			$response .= ob_get_clean();
		endwhile;
	} else {
		$response = 'No case studies found';
	}

	$has_more_posts = $ajaxposts->max_num_pages > $paged;

	wp_send_json(
		array(
			'html' => $response,
			'has_more_posts' => $has_more_posts,
			'tax_query' => $tax_query,
		)
	);

	exit;
}

add_action( 'wp_ajax_load_more_case_studies', 'load_more_case_studies' );
add_action( 'wp_ajax_nopriv_load_more_case_studies', 'load_more_case_studies' );