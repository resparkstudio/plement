<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Plement
 */

get_header( null, array( 'type' => 'light' ) );

?>

<section id="primary" class="container pt-6 pb-[4.375rem] lg:pb-[7.5rem]">
	<div class="mb-6 lg:mb-4">
		<a href="<?php echo esc_url( home_url( '/case-studies' ) ) ?>"
			class="flex items-center gap-2 text-mainBlack hover:text-accent transition duration-200 ease-in-out">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M20.4853 12.4853H3.51472M3.51472 12.4853L12 20.9706M3.51472 12.4853L12 4" stroke="currentColor"
					stroke-width="1.5" />
			</svg>
			<?php esc_html_e( 'Back to all case studies', 'plmt' ) ?>
		</a>
	</div>
	<div class="flex flex-col-reverse lg:flex-row gap-[3.4375rem] mb-[4.375rem] lg:mb-[6.875rem]">
		<div class="">
			<?php get_template_part( 'template-parts/section/case-study/section-contact-info' ); ?>
		</div>
		<div class="space-y-10 lg:space-y-8">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/section/case-study/section-header' );

				if ( have_rows( 'content' ) ) {
					while ( have_rows( 'content' ) ) {
						the_row();
						if ( get_row_layout() == 'video_block' ) {
							get_template_part( 'template-parts/section/case-study/section-video-block' );
						} elseif ( get_row_layout() == 'text_block' ) {
							get_template_part( 'template-parts/section/case-study/section-text-block' );
						} elseif ( get_row_layout() == 'list_block' ) {
							get_template_part( 'template-parts/section/case-study/section-list-block' );
						} elseif ( get_row_layout() == 'timeline_block' ) {
							get_template_part( 'template-parts/section/case-study/section-timeline-block' );
						} elseif ( get_row_layout() == 'testimonial_block' ) {
							get_template_part( 'template-parts/section/case-study/section-testimonial-block' );
						} elseif ( get_row_layout() == 'tools_block' ) {
							get_template_part( 'template-parts/section/case-study/section-tools-block' );
						}
					}
				}

			endwhile; // End of the loop.
			?>
		</div>
	</div>
	<h3 class="text-[2.25rem] leading-[2.25rem] font-extrabold lg:text-h2 mb-10 lg:mb-8">Other case studies</h3>
	<?php
	get_template_part( 'template-parts/section/case-study/section-other-studies' );
	?>
</section><!-- #primary -->

<?php
get_footer();
