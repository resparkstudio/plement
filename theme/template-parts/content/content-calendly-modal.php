<div @keydown.escape.window="calendlyOpen = false" class="relative z-50 w-auto h-auto">
	<template x-teleport="body">
		<div x-show="calendlyOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
			x-cloak>
			<div x-show="calendlyOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
				x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
				x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="calendlyOpen=false"
				class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
			<div x-show="calendlyOpen" x-trap.inert.noscroll="calendlyOpen" x-transition:enter="ease-out duration-300"
				x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
				x-transition:leave="ease-in duration-200"
				x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
				x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				class="max-w-[1350px] relative w-full py-6 bg-lightGrayBg px-7 lg:px-[105px] sm:rounded-lg container">
				<button @click="calendlyOpen=false"
					class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
					<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
						stroke-width="1.5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
				<div class="flex flex-col items-start justify-center">
					<h2 class="lg:pl-[100px] lg:mt-10"><?php esc_html_e( 'Book a Discovery Call', 'plmt' ) ?></h2>
					<div class="calendly-inline-widget w-full mx-auto"
						data-url="https://calendly.com/tomasatplement/intro-call?text_color=272727&primary_color=ed5623"
						style="min-width:320px;height:600px;max-width:1000px;"></div>
					<div class="lg:pl-[100px] text-textBlack font-medium text-lg">
						<span><?php esc_html_e( 'Got a question?', 'plmt' ) ?></span>
						<a class="underline"
							href="<?php echo esc_url( home_url( '/contact-us' ) ) ?>"><?php esc_html_e( 'Contact Us', 'plmt' ) ?></a>
					</div>
				</div>
			</div>
		</div>
	</template>
</div>