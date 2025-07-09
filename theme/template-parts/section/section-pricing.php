<?php

$pricing_content = get_field( 'pricing' );

if ( ! isset( $pricing_content ) || empty( $pricing_content ) ) {
	return;
}


function currency_switch() {
	?>
	<div class="w-full justify-center md:justify-end flex items-center gap-4 flex-wrap mb-10">
		<label for="currency" class="w-max block text-bodyBold lg:text-[1rem] lg:leading-[1.5rem] lg:font-medium">
			<?php esc_html_e( 'Display Price in:', 'plmt' ) ?>
		</label>
		<div
			class="relative max-w-[13.75rem] grid items-center justify-center w-full h-8 grid-cols-2 bg-[#F3F4F4] select-none">
			<button value="eur" :class="currency==='eur' ? 'font-bold' : ''" @click="currency='eur'" type="button"
				class="relative z-20 inline-flex items-center justify-center w-full h-7 px-3 transition-all cursor-pointer whitespace-nowrap">
				EUR
			</button>
			<button value="usd" :class="currency==='usd' ? 'font-bold' : ''" @click="currency='usd'" type="button"
				class="relative z-20 inline-flex items-center justify-center w-full h-7 px-3 transition-all cursor-pointer whitespace-nowrap">
				USD
			</button>
			<div :class="currency==='eur' ? 'left-[2px]' : 'right-[2px]'" x-transition
				class="absolute z-10 w-1/2 h-7 duration-300 ease-out" x-cloak>
				<div class="w-full h-7 bg-white shadow-sm"></div>
			</div>
		</div>
	</div>
	<?php
}

function fillout_modal() {
	?>
	<div @keydown.escape.window="modalOpen = false" class="relative z-50 w-auto h-auto">
		<template x-teleport="body">
			<div x-show="modalOpen"
				class="fixed top-0 left-0 z-[1000] flex items-center justify-center w-screen h-screen px-4 lg:px-0" x-cloak>
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
						<div class="pricing-fillout" style="width:100%;height:500px;" data-fillout-id="9SvwFGShaWus"
							data-fillout-embed-type="standard" data-fillout-inherit-parameters data-fillout-dynamic-resize>
						</div>
						<script src="https://server.fillout.com/embed/v1/"></script>
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
						class="relative flex flex-col h-full p-[1.875rem] py-[4.125rem] bg-white border border-lightGray <?php echo $package['is_best_value'] ? 'best-value-package' : '' ?>">
						<?php if ( $package['is_best_value'] ) : ?>
							<span
								class="uppercase bg-accent absolute top-0 left-0 px-3 py-2 text-bodyBold text-white font-bold"><?php esc_html_e( 'MOST POPULAR', 'plmt' ) ?></span>
						<?php endif; ?>
						<div>
							<div class="flex items-center justify-between mb-6">
								<h4 class="text-h4Bold <?php echo $package['is_best_value'] ? 'text-accent' : '' ?>">
									<?php echo esc_html( $package['title'] ) ?>
								</h4>
								<?php if ( isset( $package['popup_text'] ) && ! empty( $package['popup_text'] ) ) : ?>
									<svg class="pricing-mobile-tippy"
										data-tippy-content="<?php echo esc_attr( $package['popup_text'] ) ?>" width="23" height="24"
										viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path
											d="M11.5 0.625C9.25024 0.625 7.051 1.29213 5.18039 2.54203C3.30978 3.79193 1.85182 5.56847 0.990875 7.64698C0.129929 9.72549 -0.0953343 12.0126 0.343573 14.2192C0.782479 16.4257 1.86584 18.4525 3.45667 20.0433C5.04749 21.6342 7.07432 22.7175 9.28085 23.1564C11.4874 23.5953 13.7745 23.3701 15.853 22.5091C17.9315 21.6482 19.7081 20.1902 20.958 18.3196C22.2079 16.449 22.875 14.2498 22.875 12C22.8716 8.98421 21.6721 6.09292 19.5396 3.96043C17.4071 1.82794 14.5158 0.628413 11.5 0.625ZM11.2813 5.87504C11.5409 5.87504 11.7947 5.95202 12.0105 6.09624C12.2263 6.24046 12.3946 6.44544 12.4939 6.68527C12.5932 6.9251 12.6192 7.189 12.5686 7.4436C12.518 7.6982 12.3929 7.93206 12.2094 8.11562C12.0258 8.29918 11.792 8.42418 11.5374 8.47482C11.2828 8.52546 11.0189 8.49947 10.779 8.40013C10.5392 8.30079 10.3342 8.13257 10.19 7.91673C10.0458 7.70089 9.96881 7.44713 9.96881 7.18754C9.96881 6.83944 10.1071 6.5056 10.3532 6.25946C10.5994 6.01332 10.9332 5.87504 11.2813 5.87504ZM12.375 18.125H11.5C11.268 18.125 11.0454 18.0328 10.8813 17.8687C10.7172 17.7046 10.625 17.4821 10.625 17.25V12C10.3929 12 10.1704 11.9078 10.0063 11.7437C9.8422 11.5796 9.75001 11.3571 9.75001 11.125C9.75001 10.8929 9.8422 10.6704 10.0063 10.5063C10.1704 10.3422 10.3929 10.25 10.625 10.25H11.5C11.7321 10.25 11.9546 10.3422 12.1187 10.5063C12.2828 10.6704 12.375 10.8929 12.375 11.125V16.375C12.6071 16.375 12.8296 16.4672 12.9937 16.6313C13.1578 16.7954 13.25 17.0179 13.25 17.25C13.25 17.4821 13.1578 17.7046 12.9937 17.8687C12.8296 18.0328 12.6071 18.125 12.375 18.125Z"
											fill="#B2B2B2" />
									</svg>
								<?php endif; ?>
							</div>
							<div class="text-h4Bold lg:text-h2 inline-flex items-baseline mb-2.5">
								<span x-html="currency === 'usd' ? '$' : '€'"></span>
								<span
									x-html="currency === 'usd' ? '<?php echo esc_html( $package['price_usd'] ) ?>' : '<?php echo esc_html( $package['price_eur'] ) ?>'"></span>
							</div>
							<div class="mb-6">
								<?php echo esc_html( $package['description'] ) ?>
							</div>
							<?php plmt_button( "modalOpen=true;selectedPackage='" . esc_js( $package['title'] ) . "'", esc_html__( 'Choose Package', 'plmt' ), array(
								"classes" => "pricing-button w-full text-bodyBold h-auto py-5 justify-center",
								"variant" => ! $package['is_best_value'] ? 'secondary' : 'primary',
								"is_button" => true,
								"value" => $package['title']
							) ) ?>
							<?php if ( isset( $package['services'] ) ) : ?>
								<div class="flex flex-col gap-3 border-t border-t-[#E9E9E9] pt-[1.875rem] mt-[1.875rem]">
									<?php foreach ( $package['services'] as $service ) : ?>
										<div class="flex items-start gap-2">
											<svg class="flex-shrink-0 w-[14px] h-[14px]" width="16" height="17" viewBox="0 0 16 17"
												fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M13.5 5.00024L6.5 11.9999L3 8.50024" stroke="#ED5623" stroke-width="2"
													stroke-linecap="round" stroke-linejoin="round" />
											</svg>
											<p class="text-bodySmall"><?php echo esc_html( $service['service'] ) ?></p>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<?php if ( isset( $package['sow_file'] ) && ! empty( $package['sow_file'] ) ) : ?>
								<a href="<?php echo esc_url( $package['sow_file']['url'] ) ?>"
									target="<?php echo esc_attr( $package['sow_file']['target'] ) ?>"
									class="group mt-[1.875rem] py-2 hover:text-accent justify-self-center flex gap-2 items-center justify-center text-bodySmall text-darkGray">
									<?php esc_html_e( 'Open SOW Doc', 'plmt' ) ?>
									<div class="text-accent">
										<?php plmt_arrow() ?>
									</div>
								</a>
							<?php endif; ?>
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
		<div class="max-w-sm mx-auto grid grid-cols-[24%_24%_28%_24%] lg:max-w-none items-center py-[14px]">
			<?php foreach ( $packages as $package ) : ?>
				<div class=" <?php echo $package['is_best_value'] ? '!h-[calc(100%+28px)]' : 'h-full w-full' ?>">
					<div
						class="relative flex flex-col h-full p-[1.875rem] pt-10 pb-[2.75rem] bg-white border border-lightGray <?php echo $package['is_best_value'] ? 'best-value-package pt-[54px]' : '' ?>">
						<?php if ( $package['is_best_value'] ) : ?>
							<span
								class="uppercase bg-accent absolute top-0 left-0 px-3 py-2 text-bodyBold text-white font-bold"><?php esc_html_e( 'MOST POPULAR', 'plmt' ) ?></span>
						<?php endif; ?>
						<div class="h-full flex flex-col justify-between">
							<div>
								<div class="mb-6">
									<div class="flex items-center justify-between mb-8">
										<h4 class="text-h4Bold <?php echo $package['is_best_value'] ? 'text-accent' : '' ?>">
											<?php echo esc_html( $package['title'] ) ?>
										</h4>
										<?php if ( isset( $package['popup_text'] ) && ! empty( $package['popup_text'] ) ) : ?>
											<svg class="pricing-tippy"
												data-tippy-content="<?php echo esc_attr( $package['popup_text'] ) ?>" width="23"
												height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path
													d="M11.5 0.625C9.25024 0.625 7.051 1.29213 5.18039 2.54203C3.30978 3.79193 1.85182 5.56847 0.990875 7.64698C0.129929 9.72549 -0.0953343 12.0126 0.343573 14.2192C0.782479 16.4257 1.86584 18.4525 3.45667 20.0433C5.04749 21.6342 7.07432 22.7175 9.28085 23.1564C11.4874 23.5953 13.7745 23.3701 15.853 22.5091C17.9315 21.6482 19.7081 20.1902 20.958 18.3196C22.2079 16.449 22.875 14.2498 22.875 12C22.8716 8.98421 21.6721 6.09292 19.5396 3.96043C17.4071 1.82794 14.5158 0.628413 11.5 0.625ZM11.2813 5.87504C11.5409 5.87504 11.7947 5.95202 12.0105 6.09624C12.2263 6.24046 12.3946 6.44544 12.4939 6.68527C12.5932 6.9251 12.6192 7.189 12.5686 7.4436C12.518 7.6982 12.3929 7.93206 12.2094 8.11562C12.0258 8.29918 11.792 8.42418 11.5374 8.47482C11.2828 8.52546 11.0189 8.49947 10.779 8.40013C10.5392 8.30079 10.3342 8.13257 10.19 7.91673C10.0458 7.70089 9.96881 7.44713 9.96881 7.18754C9.96881 6.83944 10.1071 6.5056 10.3532 6.25946C10.5994 6.01332 10.9332 5.87504 11.2813 5.87504ZM12.375 18.125H11.5C11.268 18.125 11.0454 18.0328 10.8813 17.8687C10.7172 17.7046 10.625 17.4821 10.625 17.25V12C10.3929 12 10.1704 11.9078 10.0063 11.7437C9.8422 11.5796 9.75001 11.3571 9.75001 11.125C9.75001 10.8929 9.8422 10.6704 10.0063 10.5063C10.1704 10.3422 10.3929 10.25 10.625 10.25H11.5C11.7321 10.25 11.9546 10.3422 12.1187 10.5063C12.2828 10.6704 12.375 10.8929 12.375 11.125V16.375C12.6071 16.375 12.8296 16.4672 12.9937 16.6313C13.1578 16.7954 13.25 17.0179 13.25 17.25C13.25 17.4821 13.1578 17.7046 12.9937 17.8687C12.8296 18.0328 12.6071 18.125 12.375 18.125Z"
													fill="#B2B2B2" />
											</svg>
										<?php endif; ?>
									</div>
									<div class="text-h4Bold lg:text-h2 inline-flex items-baseline mb-2.5">
										<span x-html="currency === 'usd' ? '$' : '€'"></span>
										<span
											x-html="currency === 'usd' ? '<?php echo esc_html( $package['price_usd'] ) ?>' : '<?php echo esc_html( $package['price_eur'] ) ?>'"></span>
									</div>
									<div class="lg:text-darkGray min-h-[4.5rem]">
										<?php echo esc_html( $package['description'] ) ?>
									</div>
								</div>
								<?php plmt_button( "modalOpen=true;selectedPackage='" . esc_js( $package['title'] ) . "'", esc_html__( 'Choose ' . $package['title'], 'plmt' ), array(
									"classes" => "pricing-button w-full text-bodyBold h-auto py-5 justify-center",
									"variant" => ! $package['is_best_value'] ? 'secondary' : 'primary',
									"is_button" => true,
									"value" => $package['title']
								) ) ?>

								<?php if ( isset( $package['services'] ) ) : ?>
									<div class="flex flex-col gap-3 border-t border-t-[#E9E9E9] pt-[1.875rem] mt-[1.875rem]">
										<?php foreach ( $package['services'] as $service ) : ?>
											<div class="flex items-start gap-2">
												<svg class="flex-shrink-0 w-[14px] h-[14px]" width="16" height="17" viewBox="0 0 16 17"
													fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M13.5 5.00024L6.5 11.9999L3 8.50024" stroke="#ED5623" stroke-width="2"
														stroke-linecap="round" stroke-linejoin="round" />
												</svg>
												<p class="text-bodySmall"><?php echo esc_html( $service['service'] ) ?></p>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
							<?php if ( isset( $package['sow_file'] ) && ! empty( $package['sow_file'] ) ) : ?>
								<a href="<?php echo esc_url( $package['sow_file']['url'] ) ?>"
									target="<?php echo esc_attr( $package['sow_file']['target'] ) ?>"
									class="group mt-[1.875rem] py-2 hover:text-accent justify-self-center flex gap-2 items-center justify-center text-bodySmall text-darkGray">
									<?php esc_html_e( 'Open SOW Doc', 'plmt' ) ?>
									<div class="text-accent">
										<?php plmt_arrow() ?>
									</div>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
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

	<?php fillout_modal() ?>
</div>