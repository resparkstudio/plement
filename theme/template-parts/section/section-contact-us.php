<?php
$contact_content = get_field('contact_us');

if (! isset($contact_content) || empty($contact_content)) {
	return;
}



?>



<section id="contact-us" class="container pb-[3.5rem] lg:pt-20 lg:pb-[7.5rem]" x-data="{successModalOpen: false}"
	@flash.window="
						successModalOpen = true;
						setTimeout(() => successModalOpen = false, 4000);
						">
	<div class="lg:text-center mb-6 lg:mb-10">
		<h2 class="text-h1Mobile lg:text-h1 mb-3 lg:mb-5"><?php esc_html_e($contact_content['heading']) ?></h2>
		<p class="text-titleMobile lg:text-regular text-darkGray"><?php esc_html_e($contact_content['bottom_text']) ?>
		</p>
	</div>
	<div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-10">

		<div class="order-last lg:order-none lg:mt-0">
			<h2 class="text-h4RegularMobile lg:text-h4Regular mb-3 lg:mb-5">Send us a Message or RFP</h2>
			<?php echo apply_shortcodes('[contact-form-7 id="0ec1d42" title="Contact form 1"]'); ?>
		</div>

		<?php plmt_dark_info_card($contact_content) ?>

		<div class="w-full flex items-center gap-2 my-6 lg:hidden">
			<div class="h-px grow bg-accent opacity-15"></div>
			<span class="text-accent text-caption1Regular">OR</span>
			<div class="h-px grow bg-accent opacity-15"></div>
		</div>

		<?php success_modal(); ?>
	</div>
</section>
<script>
	document.addEventListener('wpcf7mailsent', function(event) {
		window.dispatchEvent(new CustomEvent('flash'))
	}, false);
</script>