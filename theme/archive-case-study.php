<?php
/**
 * The template for displaying case studies archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();
?>

<section id="primary">
	<main id="main" class="container pt-4 pb-20 lg:pt-10">
		<?php
		$categories = get_categories( array(
			'taxonomy' => 'category',
			'hide_empty' => false,
		) );
		?>
		<div class="flex flex-wrap gap-2 mb-[1.875rem] lg:mb-[2.625rem]">
			<?php
			foreach ( $categories as $category ) {
				$category_param = $_GET['category'] ?? '';
				$active_class   = $category_param === $category->slug ? 'active' : '';
				?>
				<button value="<?php echo $category->slug ?>"
					class="category-filter text-darkGray bg-lightGrayBg px-4 py-[0.625rem] rounded-lg  hover:text-white hover:bg-mainBlack text-bodyBold transition duration-200 ease-in-out <?php echo $active_class ?>"><?php echo esc_html( $category->name ); ?></button>
				<?php
			}
			?>
		</div>

		<div class="case-studies-container space-y-[1.875rem]">
			<?php if ( have_posts() ) : ?>

				<?php
				// Start the Loop.
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', 'case-study' );

					// End the loop.
				endwhile;

				// Previous/next page navigation.
				global $wp_query;
				$total_posts     = $wp_query->found_posts;
				$posts_per_page  = $wp_query->query_vars['posts_per_page'];
				$current_page    = max( 1, get_query_var( 'paged' ) );
				$displayed_posts = $current_page * $posts_per_page;
				$remaining_posts = max( 0, $total_posts - $displayed_posts );

				if ( $wp_query->max_num_pages > 1 ) : ?>
					<button id="load-more"
						class="w-full md:w-auto mx-auto flex justify-center items-center text-accent border border-accent text-title py-4 px-[4.6875rem] hover:bg-accentHover hover:text-white transition duration-200 ease-in-out">
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
