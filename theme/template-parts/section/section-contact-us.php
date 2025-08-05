<?php
$contact_content = get_field( 'contact_us' );

if ( ! isset( $contact_content ) || empty( $contact_content ) ) {
	return;
}



?>



<section id="contact-us" class="container pb-[6.25rem] lg:pt-20 lg:pb-[7.5rem]" x-data="{successModalOpen: false}"
	@flash.window="
						successModalOpen = true;
						setTimeout(() => successModalOpen = false, 4000);
						">
	<div class="lg:text-center mb-6 lg:mb-10">
		<h2 class="text-h1Mobile lg:text-h1 mb-3 lg:mb-5"><?php esc_html_e( $contact_content['heading'] ) ?></h2>
		<p class="text-titleMobile lg:text-regular text-darkGray"><?php esc_html_e( $contact_content['bottom_text'] ) ?>
		</p>
	</div>
	<div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-10">

		<div class="order-last lg:order-none mt-6 lg:mt-0">
			<?php echo apply_shortcodes( '[contact-form-7 id="0ec1d42" title="Contact form 1"]' ); ?>
		</div>

		<?php plmt_dark_info_card( $contact_content ) ?>

		<div class="mt-6 lg:mt-0">

			<?php plmt_light_info_card( $contact_content['strategy_block'] ) ?>
		</div>

		<?php success_modal(); ?>
	</div>
</section>
<script>
	document.addEventListener('wpcf7mailsent', function (event) {
		window.dispatchEvent(new CustomEvent('flash'))
	}, false);
</script>