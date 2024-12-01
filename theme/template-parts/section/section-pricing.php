<?php

$pricing_content = get_field( 'pricing' );

if ( ! isset( $pricing_content ) || empty( $pricing_content ) ) {
	return;
}

$hide_standalone_solutions = isset( $pricing_content['standalone_solutions'] );


function currency_switch() {
	?>
	<div class="w-full justify-center md:justify-end flex mb-10 h-[30px] md:h-auto">
		<form class=" w-full justify-center md:justify-end flex items-center gap-2 ">
			<label for="currency"
				class="w-max block text-bodyBold lg:text-[1rem] lg:leading-[1.5rem] lg:font-medium"><?php esc_html_e( 'Display Price in:', 'plmt' ) ?></label>
			<select id="currency" x-model="currency"
				class="bg-lightGrayBg max-w-20 text-bodyBold rounded-lg block w-full p-2.5 lg:text-[1rem] lg:leading-[1rem] lg:font-medium">
				<option value="eur" selected>EUR</option>
				<option value="usd">USD</option>
			</select>
		</form>
	</div>
	<?php
}

function calendly_modal() {
	?>
	<div @keydown.escape.window="modalOpen = false" class="relative z-50 w-auto h-auto">
		<template x-teleport="body">
			<div x-show="modalOpen"
				class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen px-4 lg:px-0" x-cloak>
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
					class="relative w-full py-14 lg:py-6 bg-lightGrayBg lg:px-[105px] rounded-lg container">
					<button @click="modalOpen=false"
						class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
						<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
					<div class="flex flex-col items-start justify-center">
						<div id="calendlyDiv" class="h-[600px] lg:h-[1000px] lg:max-h-[94vh] min-w-[320px] w-full"></div>
					</div>
				</div>
			</div>
		</template>
	</div>
	<?php
}

function package_cards_mobile( $packages ) {
	if ( empty( $packages ) )
		return;
	?>
	<div class="packages-list swiper">
		<div class="swiper-wrapper">
			<?php foreach ( $packages as $package ) : ?>
				<div class="swiper-slide h-full">
					<div
						class="relative flex flex-col h-full p-[1.875rem] py-[4.125rem] bg-white border border-lightGray lg:hover:shadow-testimonial lg:hover:scale-105 transition-all duration-300 <?php echo $package['is_best_value'] ? 'best-value-package' : '' ?>">
						<?php if ( $package['is_best_value'] ) : ?>
							<span
								class="uppercase bg-accent absolute top-0 left-0 px-3 py-2 text-bodyBold text-white font-bold"><?php esc_html_e( 'MOST POPULAR', 'plmt' ) ?></span>
						<?php endif; ?>
						<div>
							<div class="flex items-center justify-between mb-6">
								<h4 class="text-h4Bold">
									<?php echo esc_html( $package['title'] ) ?>
								</h4>
								<svg data-tippy-content="<?php echo esc_attr( $package['popup_text'] ) ?>" width="23"
									height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M11.5 0.625C9.25024 0.625 7.051 1.29213 5.18039 2.54203C3.30978 3.79193 1.85182 5.56847 0.990875 7.64698C0.129929 9.72549 -0.0953343 12.0126 0.343573 14.2192C0.782479 16.4257 1.86584 18.4525 3.45667 20.0433C5.04749 21.6342 7.07432 22.7175 9.28085 23.1564C11.4874 23.5953 13.7745 23.3701 15.853 22.5091C17.9315 21.6482 19.7081 20.1902 20.958 18.3196C22.2079 16.449 22.875 14.2498 22.875 12C22.8716 8.98421 21.6721 6.09292 19.5396 3.96043C17.4071 1.82794 14.5158 0.628413 11.5 0.625ZM11.2813 5.87504C11.5409 5.87504 11.7947 5.95202 12.0105 6.09624C12.2263 6.24046 12.3946 6.44544 12.4939 6.68527C12.5932 6.9251 12.6192 7.189 12.5686 7.4436C12.518 7.6982 12.3929 7.93206 12.2094 8.11562C12.0258 8.29918 11.792 8.42418 11.5374 8.47482C11.2828 8.52546 11.0189 8.49947 10.779 8.40013C10.5392 8.30079 10.3342 8.13257 10.19 7.91673C10.0458 7.70089 9.96881 7.44713 9.96881 7.18754C9.96881 6.83944 10.1071 6.5056 10.3532 6.25946C10.5994 6.01332 10.9332 5.87504 11.2813 5.87504ZM12.375 18.125H11.5C11.268 18.125 11.0454 18.0328 10.8813 17.8687C10.7172 17.7046 10.625 17.4821 10.625 17.25V12C10.3929 12 10.1704 11.9078 10.0063 11.7437C9.8422 11.5796 9.75001 11.3571 9.75001 11.125C9.75001 10.8929 9.8422 10.6704 10.0063 10.5063C10.1704 10.3422 10.3929 10.25 10.625 10.25H11.5C11.7321 10.25 11.9546 10.3422 12.1187 10.5063C12.2828 10.6704 12.375 10.8929 12.375 11.125V16.375C12.6071 16.375 12.8296 16.4672 12.9937 16.6313C13.1578 16.7954 13.25 17.0179 13.25 17.25C13.25 17.4821 13.1578 17.7046 12.9937 17.8687C12.8296 18.0328 12.6071 18.125 12.375 18.125Z"
										fill="#B2B2B2" />
								</svg>
							</div>
							<div class="text-h4Bold lg:text-h2 inline-flex items-baseline mb-4">
								<span x-html="currency === 'usd' ? '$' : '€'"></span>
								<span
									x-html="currency === 'usd' ? '<?php echo esc_html( $package['price_usd'] ) ?>' : '<?php echo esc_html( $package['price_eur'] ) ?>'"></span>
							</div>
							<div class="mb-6">
								<?php echo esc_html( $package['description'] ) ?>
							</div>
							<?php plmt_button( "modalOpen=true", esc_html__( 'Choose Package', 'plmt' ), array(
								"classes" => "pricing-button w-full text-bodyBold h-auto py-5 justify-center",
								"variant" => ! $package['is_best_value'] ? 'secondary' : 'primary',
							) ) ?>
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
	if ( empty( $packages ) )
		return;
	?>
	<div x-cloak>
		<div class="max-w-sm mx-auto grid lg:grid-cols-4 items-start lg:max-w-none">
			<?php foreach ( $packages as $package ) : ?>
				<div class="h-full">
					<div
						class="relative flex flex-col h-full p-[1.875rem] pt-10 pb-[2.75rem] bg-white border border-lightGray lg:hover:shadow-testimonial lg:hover:scale-105 transition-all duration-300 <?php echo $package['is_best_value'] ? 'best-value-package' : '' ?>">
						<?php if ( $package['is_best_value'] ) : ?>
							<span
								class="uppercase bg-accent absolute top-0 left-0 px-3 py-2 text-bodyBold text-white font-bold"><?php esc_html_e( 'MOST POPULAR', 'plmt' ) ?></span>
						<?php endif; ?>
						<div class="h-full flex flex-col justify-between">
							<div class="mb-6">
								<div class="flex items-center justify-between mb-12">
									<h4 class="text-h4Bold">
										<?php echo esc_html( $package['title'] ) ?>
									</h4>
									<svg data-tippy-content="<?php echo esc_attr( $package['popup_text'] ) ?>" width="23"
										height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path
											d="M11.5 0.625C9.25024 0.625 7.051 1.29213 5.18039 2.54203C3.30978 3.79193 1.85182 5.56847 0.990875 7.64698C0.129929 9.72549 -0.0953343 12.0126 0.343573 14.2192C0.782479 16.4257 1.86584 18.4525 3.45667 20.0433C5.04749 21.6342 7.07432 22.7175 9.28085 23.1564C11.4874 23.5953 13.7745 23.3701 15.853 22.5091C17.9315 21.6482 19.7081 20.1902 20.958 18.3196C22.2079 16.449 22.875 14.2498 22.875 12C22.8716 8.98421 21.6721 6.09292 19.5396 3.96043C17.4071 1.82794 14.5158 0.628413 11.5 0.625ZM11.2813 5.87504C11.5409 5.87504 11.7947 5.95202 12.0105 6.09624C12.2263 6.24046 12.3946 6.44544 12.4939 6.68527C12.5932 6.9251 12.6192 7.189 12.5686 7.4436C12.518 7.6982 12.3929 7.93206 12.2094 8.11562C12.0258 8.29918 11.792 8.42418 11.5374 8.47482C11.2828 8.52546 11.0189 8.49947 10.779 8.40013C10.5392 8.30079 10.3342 8.13257 10.19 7.91673C10.0458 7.70089 9.96881 7.44713 9.96881 7.18754C9.96881 6.83944 10.1071 6.5056 10.3532 6.25946C10.5994 6.01332 10.9332 5.87504 11.2813 5.87504ZM12.375 18.125H11.5C11.268 18.125 11.0454 18.0328 10.8813 17.8687C10.7172 17.7046 10.625 17.4821 10.625 17.25V12C10.3929 12 10.1704 11.9078 10.0063 11.7437C9.8422 11.5796 9.75001 11.3571 9.75001 11.125C9.75001 10.8929 9.8422 10.6704 10.0063 10.5063C10.1704 10.3422 10.3929 10.25 10.625 10.25H11.5C11.7321 10.25 11.9546 10.3422 12.1187 10.5063C12.2828 10.6704 12.375 10.8929 12.375 11.125V16.375C12.6071 16.375 12.8296 16.4672 12.9937 16.6313C13.1578 16.7954 13.25 17.0179 13.25 17.25C13.25 17.4821 13.1578 17.7046 12.9937 17.8687C12.8296 18.0328 12.6071 18.125 12.375 18.125Z"
											fill="#B2B2B2" />
									</svg>
								</div>
								<div class="text-h4Bold lg:text-h2 inline-flex items-baseline mb-4 lg:mb-0">
									<span x-html="currency === 'usd' ? '$' : '€'"></span>
									<span
										x-html="currency === 'usd' ? '<?php echo esc_html( $package['price_usd'] ) ?>' : '<?php echo esc_html( $package['price_eur'] ) ?>'"></span>
								</div>
								<div class="lg:text-darkGray">
									<?php echo esc_html( $package['description'] ) ?>
								</div>
							</div>
							<?php plmt_button( "modalOpen=true", esc_html__( 'Choose Package', 'plmt' ), array(
								"classes" => "pricing-button w-full text-bodyBold h-auto py-5 justify-center",
								"variant" => ! $package['is_best_value'] ? 'secondary' : 'primary',
							) ) ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

function circular_checkbox() {
	?>
	<span
		class="inline-flex justify-center items-center w-[30px] h-[30px] absolute top-4 right-4 border-2 rounded-full border-lightGray peer-checked:bg-accent"
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
				}}" class="standalone-list swiper">
		<ul class="standalone-wrap swiper-wrapper md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6">
			<?php foreach ( $standalone_solutions['standalone_list'] as $solution ) : ?>
				<li class="swiper-slide relative" x-data="{id: '<?php echo esc_attr( $solution['title'] ) ?>'}">
					<input type="checkbox" id="<?php echo esc_attr( $solution['title'] ) ?>"
						value="<?php echo esc_attr( $solution['title'] ) ?>" class="hidden peer" required="">
					<label @click="toggle(id)" for=" <?php echo esc_attr( $solution['title'] ) ?>"
						class="relative inline-flex items-center justify-between w-full pt-10 px-4 pb-16 bg-white border-2 border-lightGray rounded-2xl cursor-pointer peer-checked:border-textBlack  hover:bg-gray-50"
						:class="selectedServices.includes(id) ? 'border-textBlack' : ''">
						<div class="block">
							<p class="w-full text-xl font-medium"><?php echo esc_html( $solution['title'] ) ?>
							</p>
							<div class="inline-flex items-baseline mb-4">
								<span class="font-medium text-[2rem] leading-[41px]"
									x-html="currency === 'usd' ? '$' : '€'"></span>
								<span class="font-medium text-[2rem] leading-[41px]"
									x-html="currency === 'usd' ? <?php echo esc_html( $solution['price_usd'] ) ?> : <?php echo esc_html( $solution['price_eur'] ) ?>"></span>
							</div>
							<p class="max-w-[30rem] font-medium text-textGray">
								<?php echo esc_html( $solution['description'] ) ?>
							</p>
						</div>
					</label>
					<?php circular_checkbox() ?>
				</li>
			<?php endforeach; ?>
			<li
				class="hidden md:inline-flex justify-between w-full  bg-accent text-white rounded-2xl  <?php echo count( $standalone_solutions['standalone_list'] ) % 4 === 0 ? 'col-span-2 col-start-2 flex-row items-center p-10' : 'flex-col p-6' ?>">
				<div>
					<div class=" text-[2.5rem] font-medium flex ">
						<span class="selected-services-count" x-text="selectedServices.length">0</span>
						/
						<span><?php echo count( $standalone_solutions['standalone_list'] ) ?></span>
					</div>
					<span class="text-xl"><?php echo esc_html_e( 'Services selected', 'plmt' ) ?></span>
				</div>
				<div>
					<button @click="modalOpen=true" :value="selectedServices"
						class="standalone-button group w-full justify-center button bg-white text-accent hover:bg-white">
						<?php esc_html_e( 'Book a Call', 'plmt' ) ?>
						<?php plmt_arrow() ?>
					</button>
				</div>
			</li>
		</ul>
		<div class="swiper-pagination !static mt-6"></div>
		<div class="container">
			<div class=" mt-8 inline-flex md:hidden flex-col justify-between w-full p-5 bg-accent text-white rounded-2xl">
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
		</div>
		<?php
}

?>

	<div x-data="{ modalOpen: false, selectedPackage: '', currency: 'eur' }" @uscountry.window="currency = 'usd';">
		<div id="pricing" class="relative">
			<div class="relative flex flex-col justify-center overflow-hidden">
				<div>
					<input id="selected-package" type="hidden" x-bind:value="selectedPackage">
					<div class="container">
						<?php currency_switch() ?>
						<div class="hidden lg:block">
							<?php isset( $pricing_content['packages'] ) ? package_cards( $pricing_content['packages'] ) : ''; ?>
						</div>
					</div>
					<div class="lg:hidden">
						<?php isset( $pricing_content['packages'] ) ? package_cards_mobile( $pricing_content['packages'] ) : ''; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="hidden lg:block">
			<?php get_template_part( 'template-parts/section/section-pricing-compare' ); ?>
		</div>

		<div class="lg:hidden">
			<?php get_template_part( 'template-parts/section/section-pricing-compare-mobile' ); ?>
		</div>
	</div>