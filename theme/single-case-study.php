<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Plement
 */

get_header();
?>

<section id="primary"
	class="container flex flex-col-reverse lg:flex-row gap-[3.4375rem] pt-8 lg:pt-[3.75rem] pb-[4.375rem] lg:pb-[6.875rem]">
	<div class="">
		<?php get_template_part( 'template-parts/section/case-study/section-contact-info' ); ?>
	</div>
	<div class="space-y-[3.75rem]">
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
					}
				}
			}
		endwhile; // End of the loop.
		?>
	</div>
</section><!-- #primary -->

<?php
get_footer();
