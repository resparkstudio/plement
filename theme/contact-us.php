<?php
/**
 * Template Name: Contact Us
 * The template for displaying ftont page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header( null, array( 'type' => 'light' ) );

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$shortcode   = get_field( 'form_shortcode' );

?>

<main class="relative z-10 bg-white">
	<div class="container">
		<div class="flex flex-col lg:items-center py-10 gap-3 lg:pt-[3.75rem] lg:pb-[5.875rem] lg:gap-4">
			<h2 class="text-h4Bold lg:text-h1">
				<?php echo esc_html( $heading ) ?>
			</h2>
			<p class="lg:text-title">
				<?php echo esc_html( $description ) ?>
			</p>
		</div>
		<div class="relative" x-data="{successModalOpen: false}" @flash.window="
						successModalOpen = true;
						setTimeout(() => successModalOpen = false, 4000);
						">
			<div class="flex flex-col-reverse lg:flex-row gap-8 justify-between items-center lg:items-stretch">
				<div class="max-w-[652px] w-full z-10">
					<?php echo apply_shortcodes( $shortcode ); ?>
				</div>
				<div>
					<?php get_template_part( 'template-parts/section/section-contact-info' ); ?>
				</div>
			</div>
			<?php success_modal(); ?>
		</div>
	</div>
	<?php get_template_part( 'template-parts/section/section-faq' ); ?>
	<?php
	get_footer();
	?>
	<script>
		document.addEventListener('wpcf7mailsent', function (event) {
			window.dispatchEvent(new CustomEvent('flash'))
		}, false);
	</script>
</main>