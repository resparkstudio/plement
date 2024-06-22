<?php

$pricing_content = get_field( 'pricing' );

if ( ! isset( $pricing_content ) || empty( $pricing_content ) ) {
	return;
}

function pricing_header( $pricing_content ) {
	?>
	<div class="relative flex flex-col items-center justify-center text-center mb-8 md:mb-2">
		<h2 class="mb-8 md:mb-12 max-w-[506px]">
			<?php echo esc_html( $pricing_content['heading'] ) ?>
		</h2>
		<div class="flex justify-center max-w-[25rem] m-auto w-full mb-4 md:mb-5">
			<div class="relative flex w-full p-1 bg-white rounded-full">
				<span class="absolute inset-0 m-1 pointer-events-none bg-lightGrayBg rounded-full" aria-hidden="true">
					<span
						class="absolute inset-0 w-1/2 bg-textBlack rounded-full shadow-sm transform transition-transform duration-150 ease-in-out"
						:class="isPackages ? 'translate-x-0' : 'translate-x-full'"></span>
				</span>
				<button class="relative flex-1 py-4 rounded-full font-semibold transition-colors duration-150 ease-in-out"
					:class="isPackages ? 'text-white' : 'text-textBlack'" @click="isPackages = true"
					:aria-pressed="isPackages">
					<?php esc_html_e( 'Packages', 'plmt' ) ?>
				</button>
				<button
					class="relative flex-1 font-semibold py-4 rounded-full transition-colors duration-150 ease-in-out w-max"
					:class="isPackages ? 'text-textBlack' : 'text-white'" @click="isPackages = false"
					:aria-pressed="isPackages">
					<?php esc_html_e( 'Stand-Alone Solutions', 'plmt' ) ?>
				</button>
			</div>
		</div>
		<p class="max-w-[30rem] text-[1.125rem] leading-[1.75rem] text-textGray"
			x-text="isPackages ? '<?php echo esc_html( $pricing_content['description'] ) ?>' : '<?php echo esc_html( $pricing_content['standalone_description'] ) ?>'">
			<?php echo esc_html( $pricing_content['description'] ) ?>
		</p>
	</div>
	<?php
}

function currency_switch() {
	?>
	<div class=" w-full  justify-end hidden md:flex md:mb-6">
		<form class="max-w-sm w-full justify-end md:flex items-center gap-2 ">
			<label for="currency"
				class="block text-sm font-medium"><?php esc_html_e( 'Display Price in:', 'plmt' ) ?></label>
			<select id="currency" x-model="currency" class="bg-lightGrayBg max-w-20 text-sm rounded-lg block w-full p-2.5">
				<option value="usd" selected>USD</option>
				<option value="eur">EUR</option>
			</select>
		</form>
	</div>
	<?php
}

function calendly_modal() {
	?>
	<div @keydown.escape.window="modalOpen = false" class="relative z-50 w-auto h-auto">
		<template x-teleport="body">
			<div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
				x-cloak>
				<div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
					x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
					x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false"
					class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
				<div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300"
					x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
					x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
					x-transition:leave="ease-in duration-200"
					x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
					x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
					class="max-w-[1350px] relative w-full py-6 bg-lightGrayBg px-7 lg:px-[105px] sm:rounded-lg container">
					<button @click="modalOpen=false"
						class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
						<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
					<div class="flex flex-col items-start justify-center">
						<h2 class="lg:pl-[100px] lg:mt-10"><?php esc_html_e( 'Book a Discovery Call', 'plmt' ) ?></h2>
						<div id="calendlyDiv" class="w-full h-[600px]"></div>
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
	<?php
}

function terms_modal( $terms ) {
	if ( empty( $terms ) )
		return;
	?>
	<div @keydown.escape.window="termsModalOpen = false" class="relative z-50 w-auto h-auto">
		<template x-teleport="body">
			<div x-show="termsModalOpen"
				class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
				<div x-show="termsModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
					x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
					x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="termsModalOpen=false"
					class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
				<div x-show="termsModalOpen" x-trap.inert.noscroll="termsModalOpen"
					x-transition:enter="ease-out duration-300"
					x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
					x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
					x-transition:leave="ease-in duration-200"
					x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
					x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
					class="max-w-[1350px] relative w-full py-6 bg-lightGrayBg px-7 lg:px-[105px] sm:rounded-lg container">
					<button @click="termsModalOpen=false"
						class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
						<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
					<h2><?php echo esc_html( $terms['heading'] ) ?></h2>
					<p><?php echo esc_html( $terms['description'] ) ?></p>
				</div>
			</div>
		</template>
	</div>
	<?php
}

function package_cards_mobile( $packages ) {
	if ( empty( $packages['packages_list'] ) )
		return;
	?>
	<div x-show="isPackages" x-cloak class="packages-list swiper">
		<div class="swiper-wrapper">
			<?php foreach ( $packages['packages_list'] as $package ) : ?>
				<div class="swiper-slide h-full" x-data="{ readMoreOpen: false }">
					<div
						class="relative flex flex-col h-full p-6 rounded-[4px] bg-white border border-lightGray <?php echo $package['is_best_value'] ? 'best-value-package' : '' ?>">
						<?php if ( $package['is_best_value'] ) : ?>
							<span
								class="uppercase bg-accent absolute top-4 right-0 px-3 py-2 text-xs rounded-l-[4px] text-white font-bold"><?php esc_html_e( 'Best value', 'plmt' ) ?></span>
						<?php endif; ?>
						<div class="mb-9">
							<div class="font-medium text-[1.375rem] leading-7"><?php echo esc_html( $package['title'] ) ?></div>
							<div class="inline-flex items-baseline mb-3">
								<span class="font-medium text-[2rem] leading-[41px]"
									x-html="currency === 'usd' ? '$' : '€'"></span>
								<span class="font-medium text-[2rem] leading-[41px]"
									x-html="currency === 'usd' ? '<?php echo esc_html( $package['price_usd'] ) ?>' : '<?php echo esc_html( $package['price_eur'] ) ?>'"></span>
							</div>
							<div class="mb-6 text-textGray font-medium"><?php echo esc_html( $package['description'] ) ?></div>
							<button @click="modalOpen=true" value="<?php echo esc_attr( $package['title'] ) ?>"
								class="pricing-button group w-full justify-center <?php echo $package['is_best_value'] ? 'button' : 'button_outlined' ?>">
								<?php esc_html_e( 'Choose Package', 'plmt' ) ?>
								<div class="z-1 flex justify-center items-center relative overflow-hidden ">
									<div
										class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%"
											height=" 100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
											<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
										</svg>
									</div>
									<div
										class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%"
											height=" 100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
											<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
										</svg>
									</div>
								</div>
							</button>
						</div>
						<div>
							<ul class="text-sm space-y-3 grow prose overflow-hidden bg-gradientBottom"
								:class="!readMoreOpen ? 'max-h-[186px]' : 'h-auto'">
								<?php foreach ( $package['services'] as $service ) : ?>
									<li class="flex items-center">
										<svg class="w-2 h-2 fill-accent mr-2 shrink-0" viewBox="0 0 12 12"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z" />
										</svg>
										<span
											class="text-textDarkGray font-medium"><?php echo esc_html( $service['title'] ) ?></span>
									</li>
								<?php endforeach; ?>
							</ul>
							<div class="mt-6 w-full flex justify-center "
								x-show="!readMoreOpen && Boolean(<?php echo count( $package['services'] ) > 7 ?>)">
								<button @click="readMoreOpen = true"
									class="inline-flex gap-2 items-center  justify-center font-medium text-sm">See All
									Services
									<svg width="10" height="7" viewBox="0 0 10 7" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M0.839844 1.5L4.83984 5.5L8.83984 1.5" stroke="#272727" stroke-width="1.33333"
											stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</button>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="swiper-pagination !static mt-6"></div>
	</div>
	<?php
}

function package_cards( $packages ) {
	if ( empty( $packages['packages_list'] ) )
		return;
	?>
	<div x-show="isPackages" x-cloak>
		<div class="mb-10 max-w-sm mx-auto grid gap-6 lg:grid-cols-4 items-start lg:max-w-none">
			<?php foreach ( $packages['packages_list'] as $package ) : ?>
				<div class="h-full" x-data="{ readMoreOpen: false }">
					<div
						class="relative flex flex-col h-full p-6 py-10 rounded-[4px] bg-white border border-lightGray <?php echo $package['is_best_value'] ? 'best-value-package' : '' ?>">
						<?php if ( $package['is_best_value'] ) : ?>
							<span
								class="uppercase bg-accent absolute top-4 right-0 px-3 py-2 text-xs rounded-l-[4px] text-white font-bold"><?php esc_html_e( 'Best value', 'plmt' ) ?></span>
						<?php endif; ?>
						<div class="mb-9">
							<div class="font-medium text-[1.375rem] leading-7"><?php echo esc_html( $package['title'] ) ?></div>
							<div class="inline-flex items-baseline mb-3">
								<span class="font-medium text-[2rem] leading-[41px]"
									x-html="currency === 'usd' ? '$' : '€'"></span>
								<span class="font-medium text-[2rem] leading-[41px]"
									x-html="currency === 'usd' ? '<?php echo esc_html( $package['price_usd'] ) ?>' : '<?php echo esc_html( $package['price_eur'] ) ?>'"></span>
							</div>
							<div class="mb-6 text-textGray font-medium"><?php echo esc_html( $package['description'] ) ?></div>
							<button @click="modalOpen=true" value="<?php echo esc_attr( $package['title'] ) ?>"
								class="pricing-button group w-full justify-center <?php echo $package['is_best_value'] ? 'button' : 'button_outlined' ?>">
								<?php esc_html_e( 'Choose Package', 'plmt' ) ?>
								<div class="z-1 flex justify-center items-center relative overflow-hidden ">
									<div
										class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%"
											height=" 100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
											<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
										</svg>
									</div>
									<div
										class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%"
											height=" 100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
											<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
										</svg>
									</div>
								</div>
							</button>
						</div>
						<div>
							<ul class="text-sm space-y-3 grow prose overflow-hidden <?php echo count( $package['services'] ) > 7 ? 'with-gradient' : '' ?>"
								:class="!readMoreOpen ? 'max-h-[186px]' : 'h-auto hide-gradient'">
								<?php foreach ( $package['services'] as $service ) : ?>
									<li class="flex items-center">
										<svg class="w-2 h-2 fill-accent mr-2 shrink-0" viewBox="0 0 12 12"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z" />
										</svg>
										<span
											class="text-textDarkGray font-medium"><?php echo esc_html( $service['title'] ) ?></span>
									</li>
								<?php endforeach; ?>
							</ul>
							<div class="mt-6 w-full flex justify-center "
								x-show="!readMoreOpen && Boolean(<?php echo count( $package['services'] ) > 7 ?>)">
								<button @click="readMoreOpen = true"
									class="inline-flex gap-2 items-center  justify-center font-medium text-sm">See All
									Services

									<svg width="10" height="7" viewBox="0 0 10 7" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M0.839844 1.5L4.83984 5.5L8.83984 1.5" stroke="#272727" stroke-width="1.33333"
											stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</button>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<div
				class="col-span-2 col-start-2 w-full justify-between items-center mx-auto flex p-8 rounded-[4px] bg-white border border-lightGray">
				<div class="max-w-[349px]">
					<h4 class="font-medium text-[1.375rem] leading-7 mb-[10px]">
						<?php echo esc_html( $packages['custom_packages']['title'] ) ?>
					</h4>
					<p class="text-textGray font-medium">
						<?php echo esc_html( $packages['custom_packages']['description'] ) ?>
					</p>
				</div>
				<div>
					<a href='<?php echo esc_url( '/contact-us' ) ?>' class='button'>
						<?php esc_html_e( 'Contact Us', 'plmt' ) ?>
						<svg xmlns='http://www.w3.org/2000/svg' width='10' height='9' fill='none'
							xmlns:v='https://vecta.io/nano'>
							<path
								d='M1.154.667a.67.67 0 0 0 .667.667h5.06l-5.92 5.92c-.062.062-.111.135-.144.216s-.051.167-.051.254.017.174.051.254.082.154.144.216.135.111.216.144.167.051.254.051.174-.017.254-.051.154-.082.216-.144l5.92-5.92v5.06A.67.67 0 0 0 8.487 8a.67.67 0 0 0 .667-.667V.667A.67.67 0 0 0 8.487 0H1.821a.67.67 0 0 0-.667.667z'
								fill='#fff' />
						</svg>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function circular_checkbox() {
	?>
	<span
		class="inline-flex justify-center items-center w-[30px] h-[30px] absolute top-4 right-4 border-2 rounded-full border-lightGrayBorder peer-checked:bg-accent"
		:class="selectedServices.includes(id) ? '!border-0  bg-accent' : ''">
		<svg :class="selectedServices.includes(id) ? 'inline' : 'hidden'" width="14" height="10" viewBox="0 0 14 10"
			fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd"
				d="M13.2321 0.731002C13.4942 1.01647 13.4942 1.47931 13.2321 1.76479L5.86825 9.78593C5.60785 10.0696 5.18623 10.0716 4.92349 9.79053L0.772386 5.34964C0.50796 5.06682 0.504128 4.60395 0.763836 4.31593L1.23408 3.79436C1.49379 3.50635 1.91869 3.50218 2.18312 3.78508L5.38522 7.21069L11.8085 0.214105C12.0705 -0.0713647 12.4955 -0.071372 12.7575 0.214105L13.2321 0.731002Z"
				fill="white" />
		</svg>
	</span>
	<?php
}
function standalone_solution( $standalone_solutions ) {

	if ( empty( $standalone_solutions['standalone_list'] ) )
		return;

	?>
	<div x-data="{selectedServices: [],
				toggle(id) {
					if (this.selectedServices.includes(id)) {
						const index = this.selectedServices.indexOf(id);
						this.selectedServices.splice(index, 1)
					} else {
						this.selectedServices.push(id)
					}
				}}" class="standalone-list swiper" x-show="!isPackages">
		<ul class="standalone-wrap swiper-wrapper md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6">
			<?php foreach ( $standalone_solutions['standalone_list'] as $solution ) : ?>
				<li class="swiper-slide relative" x-data="{id: '<?php echo esc_attr( $solution['title'] ) ?>'}">
					<input type="checkbox" id="<?php echo esc_attr( $solution['title'] ) ?>"
						value="<?php echo esc_attr( $solution['title'] ) ?>" class="hidden peer" required="">
					<label @click="toggle(id)" for=" <?php echo esc_attr( $solution['title'] ) ?>"
						class="relative inline-flex items-center justify-between w-full pt-10 px-4 pb-16 bg-white border-2 border-lightGray rounded-2xl cursor-pointer peer-checked:border-textBlack  hover:bg-gray-50"
						:class="selectedServices.includes(id) ? 'border-textBlack' : ''">
						<div class="block">
							<p class="w-full text-xl font-medium"><?php echo esc_html( $solution['title'] ) ?></p>
							<div class="inline-flex items-baseline mb-4">
								<span class="font-medium text-[2rem] leading-[41px]"
									x-html="currency === 'usd' ? '$' : '€'"></span>
								<span class="font-medium text-[2rem] leading-[41px]"
									x-html="currency === 'usd' ? <?php echo esc_html( $solution['price_usd'] ) ?> : <?php echo esc_html( $solution['price_eur'] ) ?>"></span>
							</div>
							<p class="max-w-[30rem] text-[1.125rem] leading-[1.75rem] text-textGray">
								<?php echo esc_html( $solution['description'] ) ?>
							</p>
						</div>
					</label>
					<?php circular_checkbox() ?>
				</li>
			<?php endforeach; ?>
			<li class="hidden md:inline-flex flex-col justify-between w-full p-6 bg-accent text-white rounded-2xl">
				<div>
					<div class=" text-[2.5rem] font-medium flex ">
						<span class="selected-services-count" x-text="selectedServices.length">0</span>
						/
						<span><?php echo count( $standalone_solutions['standalone_list'] ) ?></span>
					</div>
					<span><?php echo esc_html_e( 'Services selected', 'plmt' ) ?></span>
				</div>
				<div>
					<button @click="modalOpen=true" :value="selectedServices"
						class="standalone-button group w-full justify-center button bg-white text-accent hover:bg-white">
						<?php esc_html_e( 'Book a Call', 'plmt' ) ?>
						<div class="z-1 flex justify-center items-center relative overflow-hidden ">
							<div
								class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
									preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
									<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
								</svg>
							</div>
							<div
								class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
									preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
									<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
								</svg>
							</div>
						</div>
					</button>
				</div>
			</li>
		</ul>
		<div class="swiper-pagination !static mt-6"></div>
		<li class=" mt-8 inline-flex md:hidden flex-col justify-between w-full p-5 bg-accent text-white rounded-2xl">
			<div class="mb-6">
				<div class="text-[2.5rem] font-medium flex">
					<span class="selected-services-count" x-text="selectedServices.length">0</span>
					/
					<span><?php echo count( $standalone_solutions['standalone_list'] ) ?></span>
				</div>
				<span><?php echo esc_html_e( 'Services selected', 'plmt' ) ?></span>
			</div>
			<div>
				<button @click="modalOpen=true" :value="selectedServices"
					class="standalone-button w-full justify-center button bg-white text-accent hover:bg-white">
					<?php esc_html_e( 'Book a Call', 'plmt' ) ?>
					<svg xmlns='http://www.w3.org/2000/svg' width='10' height='9' fill='none'
						xmlns:v='https://vecta.io/nano'>
						<path
							d='M1.154.667a.67.67 0 0 0 .667.667h5.06l-5.92 5.92c-.062.062-.111.135-.144.216s-.051.167-.051.254.017.174.051.254.082.154.144.216.135.111.216.144.167.051.254.051.174-.017.254-.051.154-.082.216-.144l5.92-5.92v5.06A.67.67 0 0 0 8.487 8a.67.67 0 0 0 .667-.667V.667A.67.67 0 0 0 8.487 0H1.821a.67.67 0 0 0-.667.667z'
							fill='#ED5623' />
					</svg>
				</button>
			</div>
	</div>
	<?php
}

?>

<section id="pricing" class="pb-16 lg:pb-36">
	<div class="relative">
		<div class="container relative flex flex-col justify-center overflow-hidden">
			<div
				x-data="{ isPackages: true, modalOpen: false, selectedPackage: '', termsModalOpen: false, currency: 'usd' }">
				<input id="selected-package" type="hidden" x-bind:value="selectedPackage">
				<?php pricing_header( $pricing_content ) ?>
				<?php currency_switch() ?>
				<div class="lg:hidden">
					<?php isset( $pricing_content['packages'] ) ? package_cards_mobile( $pricing_content['packages'] ) : ''; ?>
				</div>
				<div class="hidden lg:block">
					<?php isset( $pricing_content['packages'] ) ? package_cards( $pricing_content['packages'] ) : ''; ?>
				</div>


				<?php isset( $pricing_content['standalone_solutions'] ) ? standalone_solution( $pricing_content['standalone_solutions'] ) : ''; ?>

				<?php calendly_modal() ?>
				<?php terms_modal( $pricing_content['payment_terms'] ) ?>
				<div class="flex w-full justify-center mt-16">

					<button class="text-lg font-semibold underline hover:text-accent transition-colors duration-300 "
						@click="termsModalOpen=true"><?php esc_html_e( 'Payment terms' ) ?></button>
				</div>
			</div>
		</div>
	</div>
</section>