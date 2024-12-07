<?php
/**
 * The template for displaying ftont page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();
$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$shortcode   = get_field( 'form_shortcode' );

function success_modal() {
	plmt_modal( "successModalOpen", function () {
		?>
		<div class="flex flex-col justify-center items-center h-full gap-3 w-full">
			<div class="bg-[#88C941] rounded-full w-[57px] h-[57px] mb-3 flex justify-center items-center">
				<svg width="32" height="23" viewBox="0 0 32 23" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M30.9246 4.17438L13.1121 21.9869C12.8934 22.2088 12.6327 22.385 12.3453 22.5053C12.0578 22.6256 11.7493 22.6875 11.4377 22.6875C11.1262 22.6875 10.8177 22.6256 10.5302 22.5053C10.2428 22.385 9.98211 22.2088 9.76337 21.9869L1.45087 13.6744C1.0068 13.2303 0.757324 12.628 0.757324 12C0.757324 11.372 1.0068 10.7697 1.45087 10.3256C1.89495 9.88156 2.49724 9.63208 3.12525 9.63208C3.75326 9.63208 4.35555 9.88156 4.79962 10.3256L11.4377 16.9519L27.5759 0.825629C28.0199 0.381558 28.6222 0.13208 29.2502 0.13208C29.8783 0.13208 30.4806 0.381558 30.9246 0.825629C31.3687 1.2697 31.6182 1.87199 31.6182 2.5C31.6182 3.12802 31.3687 3.73031 30.9246 4.17438Z"
						fill="white" />
				</svg>
			</div>
			<h3><?php esc_html_e( "Thank your for contacting us!", "plmt" ) ?></h3>
			<p class="max-w-md text-lg font-medium text-center">
				<?php esc_html_e( "We have received your message and will respond to you soon", "plmt" ) ?>
			</p>
		</div>
		<?php
	} )
		?>
	<?php
}

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