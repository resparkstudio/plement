<?php
/**
 * The template for displaying ftont page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();
$heading   = get_field( 'heading' );
$shortcode = get_field( 'form_shortcode' );
?>

<section id='primary'>
	<main id='main' class="container">
		<h1
			class="my-10 lg:mb-20 lg:mt-[5.75rem] text-[2.375rem] leading-[2.625rem] lg:text-7xl lg:leading-[5rem] max-w-[52.75rem] font-medium">
			<?php echo esc_html( $heading ) ?>
		</h1>
		<div class="flex">
			<div>
				<?php echo apply_shortcodes( $shortcode ); ?>
			</div>
			<div>

				<?php get_template_part( 'template-parts/section/section-contact-info' ); ?>
			</div>
		</div>

	</main>
</section>

<?php
get_footer();
