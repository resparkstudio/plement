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
				$category_link = get_category_link( $category->term_id );
				?>
				<a href="<?php echo esc_url( $category_link ); ?>"
					class="text-darkGray bg-lightGrayBg px-4 py-[0.625rem] rounded-lg  hover:text-white hover:bg-mainBlack text-bodyBold transition duration-200 ease-in-out"><?php echo esc_html( $category->name ); ?></a>
				<?php
			}
			?>
		</div>

		<div class="space-y-[1.875rem]">
			<?php if ( have_posts() ) : ?>

				<?php
				// Start the Loop.
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', 'case-study' );

					// End the loop.
				endwhile;

				// Previous/next page navigation.
				plmt_the_posts_navigation();

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
