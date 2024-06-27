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

function success_modal() {
	?>
	<div @keydown.escape.window="successModalOpen = false" class="relative z-50 w-auto h-auto">
		<template x-teleport="body">
			<div x-show="successModalOpen"
				class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
				<div x-show="successModalOpen" x-transition:enter="ease-out duration-300"
					x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
					x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
					x-transition:leave-end="opacity-0" @click="successModalOpen=false"
					class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
				<div x-show="successModalOpen" x-trap.inert.noscroll="successModalOpen"
					x-transition:enter="ease-out duration-300"
					x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
					x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
					x-transition:leave="ease-in duration-200"
					x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
					x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
					class="max-w-[800px] relative w-full py-6 bg-lightGrayBg px-7 lg:px-[105px] sm:rounded-lg container">
					<button @click="successModalOpen=false"
						class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
						<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
					<div class="flex flex-col justify-center items-center py-20 gap-3">
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
				</div>
			</div>
		</template>
	</div>
	<?php
}

?>

<main class="relative z-10 bg-white">
	<section id='primary'>
		<div id='main' class="">
			<div class="container">
				<h2 class="my-10 lg:mt-8 max-w-[34.875rem] font-medium">
					<?php echo esc_html( $heading ) ?>
				</h2>
			</div>
			<div class="relative" x-data="{successModalOpen: false}" @flash.window="
						successModalOpen = true;
						setTimeout(() => successModalOpen = false, 3000);
					">
				<div class="absolute bg-lightGrayBg h-full w-1/4 left-0 top-0 hidden lg:block"></div>
				<div
					class="container flex flex-col-reverse lg:flex-row gap-8 justify-between items-center lg:items-start">
					<div class="bg-lightGrayBg py-8 px-4 lg:p-12 lg:pl-0 max-w-[652px] w-full z-10">
						<svg class="mb-4 w-[40px] h-[40px] lg:w-[45px] lg:h-[45px] rounded-md" width="50" height="50"
							viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect width="50" height="50" rx="8" fill="#ED5623" />
							<path
								d="M27.0057 27.705C26.4086 28.1031 25.7151 28.3135 25 28.3135C24.285 28.3135 23.5914 28.1031 22.9943 27.705L13.1598 21.1485C13.1052 21.1121 13.0521 21.0742 13 21.0352V31.7788C13 33.0106 13.9996 33.9882 15.2094 33.9882H34.7906C36.0224 33.9882 37 32.9886 37 31.7788V21.0352C36.9478 21.0742 36.8945 21.1123 36.8398 21.1487L27.0057 27.705Z"
								fill="white" />
							<path
								d="M13.9398 19.977L23.7744 26.5336C24.1466 26.7818 24.5733 26.9058 25 26.9058C25.4267 26.9058 25.8534 26.7817 26.2256 26.5336L36.0602 19.977C36.6487 19.5849 37 18.9286 37 18.2203C37 17.0025 36.0092 16.0117 34.7914 16.0117H15.2086C13.9908 16.0118 13 17.0025 13 18.2215C13 18.9286 13.3514 19.5849 13.9398 19.977Z"
								fill="white" />
						</svg>
						<h3 class=" mb-8"><?php esc_html_e( 'Send us a message', 'plmt' ) ?></h3>
						<?php echo apply_shortcodes( $shortcode ); ?>
					</div>
					<div>
						<?php get_template_part( 'template-parts/section/section-contact-info' ); ?>
					</div>
				</div>
				<?php success_modal(); ?>
			</div>
			<?php get_template_part( 'template-parts/section/section-faq' ); ?>
		</div>
	</section>

	<?php
	get_footer();
	?>
	<script>
		document.addEventListener('wpcf7mailsent', function (event) {
			window.dispatchEvent(new CustomEvent('flash'))
		}, false);
	</script>
</main>