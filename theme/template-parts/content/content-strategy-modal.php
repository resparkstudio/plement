<div @keydown.escape.window="strategyFilloutOpen = false" class="relative z-50 w-auto h-auto">
	<template x-teleport="body">
		<div x-show="strategyFilloutOpen"
			class="fixed top-0 left-0 z-[1000] flex items-center justify-center w-screen h-screen px-4 lg:px-0" x-cloak>
			<div x-show="strategyFilloutOpen" x-transition:enter="ease-out duration-300"
				x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
				x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
				x-transition:leave-end="opacity-0" @click="strategyFilloutOpen=false"
				class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
			<div x-show="strategyFilloutOpen" x-trap.inert.noscroll="strategyFilloutOpen"
				x-transition:enter="ease-out duration-300"
				x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
				x-transition:leave="ease-in duration-200"
				x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
				x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				class="relative w-full py-14 lg:py-6 bg-lightGrayBg lg:px-[105px] container h-screen overflow-y-auto lg:overflow-hidden lg:h-auto">
				<button @click="strategyFilloutOpen=false"
					class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
					<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
						stroke-width="1.5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
				<div class="flex flex-col items-start justify-center">
					<div style="width:100%;height:100%;" data-fillout-id="e5ppAwVB6aus"
						data-fillout-embed-type="standard" data-fillout-inherit-parameters data-fillout-dynamic-resize>
					</div>
					<script src="https://server.fillout.com/embed/v1/"></script>
				</div>
			</div>
		</div>
	</template>
</div>