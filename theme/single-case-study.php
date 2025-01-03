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

<section id="primary" class="container pt-8 lg:pt-[3.75rem] pb-[4.375rem] lg:pb-[7.5rem]">
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
