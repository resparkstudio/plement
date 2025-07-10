<?php
/**
 * The template for displaying case studies archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

$active_category_filter = $_GET['category'] ?? '';

get_header( null, array( 'type' => 'light' ) );

?>

<section id="primary">
	<main id="main" class="container pt-4 pb-20 lg:pt-10">
		<?php
		$categories = get_categories( array(
			'taxonomy' => 'category',
			'hide_empty' => true,
		) );

		$tools = get_terms( array(
			'taxonomy' => 'tool',
			'hide_empty' => true,
		) );

		$tool_options = array();
		if ( $tools ) {
			foreach ( $tools as $tool ) {
				$tool_options[ $tool->slug ] = $tool->name;
			}
		}

		$categories_options = array();
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$categories_options[ $category->slug ] = $category->name;
			}
		}
		?>
		<div class="flex gap-2 mb-[0.625rem] lg:mb-6 overflow-x-auto">
			<?php plmt_dropdown( $tool_options, __( 'Filter by tools:', 'plmt' ), 'tool-filter' ); ?>
			<?php plmt_dropdown( $categories_options, __( 'Filter by category:', 'plmt' ), 'category-filter' ); ?>
		</div>

		<div>
			<?php if ( have_posts() ) : ?>
				<div class="case-studies-container space-y-[1.875rem]">

					<?php
					// Start the Loop.
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', 'case-study' );

						// End the loop.
					endwhile; ?>
				</div>
				<?php
				// Previous/next page navigation.
				global $wp_query;
				$total_posts     = $wp_query->found_posts;
				$posts_per_page  = $wp_query->query_vars['posts_per_page'];
				$current_page    = max( 1, get_query_var( 'paged' ) );
				$displayed_posts = $current_page * $posts_per_page;
				$remaining_posts = max( 0, $total_posts - $displayed_posts );

				if ( $wp_query->max_num_pages > 1 ) : ?>
					<button
						class="mt-8 load-more-button w-full md:w-auto mx-auto flex justify-center items-center text-accent border border-accent text-title py-4 px-[4.6875rem] hover:bg-accentHover hover:text-white transition duration-200 ease-in-out">
						<?php esc_html_e( 'See more', 'plement' ); ?>
						<?php if ( $remaining_posts > 0 ) : ?>
							(<?php echo esc_html( $remaining_posts ); ?>)
						<?php endif; ?>
					</button>
				<?php endif;

			else :

				// If no content, include the "No posts found" template.
				get_template_part( 'template-parts/content/content', 'none' );

			endif;
			?>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
