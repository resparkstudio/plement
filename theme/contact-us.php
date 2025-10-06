<?php

/**
 * Template Name: Contact Us
 * The template for displaying ftont page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header(null, array('type' => 'light'));

$heading     = get_field('heading');
$description = get_field('description');
$shortcode   = get_field('form_shortcode');

?>

<main class="relative z-10 bg-white">
	<div class="container">
		<div class="flex flex-col lg:items-center py-10 gap-3 lg:pt-[3.75rem] lg:pb-[5.875rem] lg:gap-4">
			<h2 class="text-h4Bold lg:text-h1">
				<?php echo esc_html($heading) ?>
			</h2>
			<p class="lg:text-title">
				<?php echo esc_html($description) ?>
			</p>
		</div>
		<div class="relative" x-data="{successModalOpen: false}" @flash.window="
						successModalOpen = true;
						setTimeout(() => successModalOpen = false, 4000);
						">
			<div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-10">
				<div class="h-full z-10 order-last lg:order-none mt-6 lg:mt-0">
					<h2 class="text-h4RegularMobile lg:text-h4Regular mb-3 lg:mb-5">Send us a Message or RFP</h2>
					<?php echo apply_shortcodes($shortcode); ?>
				</div>
				<div>
					<?php
					$information = get_field('information');
					$mapped_info = array(
						'bead' => $information['bead'],
						'info_heading' => $information['heading'],
						'info_text' => $information['description'],
						'info_image' => $information['image'],
						'info_name' => $information['name'],
						'info_occupation' => $information['position'],
						'linkedin' => $information['linkedin'],
					);
					plmt_dark_info_card($mapped_info); ?>
				</div>
			</div>
			<?php success_modal(); ?>
		</div>
	</div>
	<?php get_template_part('template-parts/section/section-faq'); ?>
	<?php
	get_footer();
	?>
	<script>
		document.addEventListener('wpcf7mailsent', function(event) {
			window.dispatchEvent(new CustomEvent('flash'))
		}, false);
	</script>
</main>