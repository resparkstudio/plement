<?php
$pricing_data            = get_field( 'pricing' );
$package_comparison_data = get_field( 'package_comparison' );

if ( ! isset( $package_comparison_data ) || empty( $package_comparison_data ) ) {
	return;
}

function mobile_minimal_package_card( $package ) {
	?>
	<div class="relative mb-7">
		<a href="#pricing"
			class="w-full flex items-center gap-[6px] justify-center group text-title hover:text-accent transition-colors duration-300">
			<?php echo esc_attr( $package['title'] ) ?>
			<div class="z-1 flex justify-center items-center relative overflow-hidden">
				<div
					class="justify-center items-center w-[1rem] h-[1rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
						role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
						preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
						<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
					</svg>
				</div>
				<div
					class="justify-center items-center w-[1rem] h-[1rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
						role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
						preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
						<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
					</svg>
				</div>
			</div>
		</a>
	</div>
	<?php
}

function mobile_pricing_accordion_head( $feature_group ) {
	?>
	<button @click="() => {
		mobileAccordionOpen=!mobileAccordionOpen;
		setTimeout(() => {
			const swiper = document.querySelector('.package-compare-mobile').swiper;
			swiper.updateAutoHeight();
		}, 300);
	}
	"
		class="refreshScrollTrigger flex items-center justify-between w-full p-4 text-left select-none group-hover:underline bg-lightGrayBg rounded-[4px] text-title">
		<span><?php echo esc_html( $feature_group['title'] ) ?></span>
		<svg class="w-[26px] h-[26px] duration-200 ease-out" :class="{ 'rotate-180': mobileAccordionOpen }"
			viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
			stroke-linecap="round" stroke-linejoin="round">
			<polyline points="6 9 12 15 18 9"></polyline>
		</svg>
	</button>
	<?php
}

function mobile_pricing_accordion_body( $features, $index ) {
	?>
	<div x-show="mobileAccordionOpen" x-collapse x-cloak>
		<?php foreach ( $features as $feature ) : ?>
			<div class="flex items-center justify-between w-full gap-6 px-4 py-3 border-b border-lightGray mt-2">
				<div class="flex items-center gap-3">
					<?php if ( isset( $feature['popup_text'] ) && ! empty( $feature['popup_text'] ) ) : ?>
						<div class="relative">
							<button data-content="<?php echo esc_attr( $feature['popup_text'] ) ?>"
								class="tippy-button cursor-pointer max-w-[123px] sm:max-w-[243px] underline text-left">
								<?php echo esc_html( $feature['title'] ) ?>
							</button>
						</div>
					<?php else : ?>
						<div class="max-w-[123px] sm:max-w-[243px]"><?php echo esc_html( $feature['title'] ) ?></div>
					<?php endif; ?>
				</div>
				<div class="justify-self-center flex flex-col gap-2 items-center justify-center w-[160px]">
					<?php if ( $feature['columns'][ $index ]['included'] ) : ?>
						<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0_515_6320)">
								<path fill-rule="evenodd" clip-rule="evenodd"
									d="M16.5551 2.4503C16.8814 2.82141 16.8814 3.42311 16.5551 3.79423L7.39128 14.2217C7.06723 14.5904 6.54254 14.5931 6.21557 14.2277L1.04975 8.45453C0.720691 8.08686 0.715923 7.48513 1.03911 7.11071L1.62431 6.43267C1.9475 6.05826 2.47626 6.05284 2.80534 6.42061L6.79017 10.8739L14.7836 1.77834C15.1097 1.40723 15.6385 1.40722 15.9646 1.77834L16.5551 2.4503Z"
									fill="#ED5623" />
							</g>
							<defs>
								<clipPath id="clip0_515_6320">
									<rect width="16" height="16" fill="white" transform="translate(0.799805)" />
								</clipPath>
							</defs>
						</svg>
					<?php endif; ?>
					<?php if ( isset( $feature['columns'][ $index ]['note'] ) && ! empty( $feature['columns'][ $index ]['note'] ) ) : ?>
						<p class="text-accent font-medium">
							<?php echo esc_html( $feature['columns'][ $index ]['note'] ) ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}

function mobile_comparison_footer_rows( $footer_rows, $index ) {
	?>
	<div>
		<?php foreach ( $footer_rows as $footer_row ) : ?>
			<div
				class="flex items-center gap-6 px-4 py-3 justify-between w-full border-b border-lightGray last-of-type:border-b-0">
				<div class="flex items-center gap-3">
					<?php if ( isset( $footer_row['popup_text'] ) && ! empty( $footer_row['popup_text'] ) ) : ?>
						<div class="relative">
							<div data-tippy-content="<?php echo esc_attr( $footer_row['popup_text'] ) ?>" class="cursor-pointer">
								<div class="font-medium max-w-[123px]  sm:max-w-[243px] underline">
									<?php echo esc_html( $footer_row['title'] ) ?>
								</div>
							</div>

						</div>
					<?php else : ?>
						<div class="font-medium max-w-[123px]  sm:max-w-[243px]"><?php echo esc_html( $footer_row['title'] ) ?>
						</div>

					<?php endif; ?>
				</div>
				<div class=" justify-self-center flex flex-col gap-2 items-center justify-center w-[160px]">
					<?php if ( $footer_row['columns'][ $index ]['included'] ) : ?>
						<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0_515_6320)">
								<path fill-rule="evenodd" clip-rule="evenodd"
									d="M16.5551 2.4503C16.8814 2.82141 16.8814 3.42311 16.5551 3.79423L7.39128 14.2217C7.06723 14.5904 6.54254 14.5931 6.21557 14.2277L1.04975 8.45453C0.720691 8.08686 0.715923 7.48513 1.03911 7.11071L1.62431 6.43267C1.9475 6.05826 2.47626 6.05284 2.80534 6.42061L6.79017 10.8739L14.7836 1.77834C15.1097 1.40723 15.6385 1.40722 15.9646 1.77834L16.5551 2.4503Z"
									fill="#ED5623" />
							</g>
							<defs>
								<clipPath id="clip0_515_6320">
									<rect width="16" height="16" fill="white" transform="translate(0.799805)" />
								</clipPath>
							</defs>
						</svg>
					<?php endif; ?>
					<?php if ( isset( $footer_row['columns'][ $index ]['note'] ) && ! empty( $footer_row['columns'][ $index ]['note'] ) ) : ?>
						<p class="text-accent font-medium text-center">
							<?php echo esc_html( $footer_row['columns'][ $index ]['note'] ) ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}

?>

<div class="container pt-10 lg:pt-16" x-data="{comparisonAccordionOpen: false}">
	<button @click="comparisonAccordionOpen=!comparisonAccordionOpen"
		class="refreshScrollTrigger flex gap-1 items-center mx-auto w-max text-title hover:text-accent transition-colors duration-300 ">
		<span><?php esc_html_e( 'Compare packages' ) ?></span>
		<svg class="w-[26px] h-[26px] duration-200 ease-out" :class="{ 'rotate-180': comparisonAccordionOpen }"
			viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
			stroke-linecap="round" stroke-linejoin="round">
			<polyline points="6 9 12 15 18 9"></polyline>
		</svg>
	</button>
	<div x-show="comparisonAccordionOpen" x-collapse x-cloak>
		<div class="swiper package-compare-mobile pt-10 lg:pt-24 mt-10">
			<div class="swiper-wrapper">
				<?php $index = 0;
				foreach ( $pricing_data['packages'] as $package ) :
					?>
					<div class="swiper-slide">
						<?php
						mobile_minimal_package_card( $package );
						foreach ( $package_comparison_data['feature_groups'] as $feature_group ) :
							?>
							<div x-data="{mobileAccordionOpen: true}" class="mt-4 first-of-type:mt-0 ">
								<?php
								mobile_pricing_accordion_head( $feature_group );
								mobile_pricing_accordion_body( $feature_group['features'], $index );
								?>
							</div><?php
						endforeach;
						?>
					</div>
					<?php
					$index++;
				endforeach; ?>
			</div>
			<div class="swiper-pagination !static mt-6"></div>
		</div>
	</div>

</div>