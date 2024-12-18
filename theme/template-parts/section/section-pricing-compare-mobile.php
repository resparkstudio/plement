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
							<div class="text-bodyRegular max-w-[243px] split-text flex gap-[0.4em] flex-wrap">
								<?php echo esc_html( $feature['title'] ) ?>
								<svg class="compare-tippy min-w-[17px] min-h-[17px] cursor-pointer"
									data-tippy-content="<?php echo esc_attr( $feature['popup_text'] ) ?>" width="17" height="17"
									viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd"
										d="M8.5 16C12.6421 16 16 12.6421 16 8.5C16 4.35786 12.6421 1 8.5 1C4.35786 1 1 4.35786 1 8.5C1 12.6421 4.35786 16 8.5 16ZM8.5 17C13.1944 17 17 13.1944 17 8.5C17 3.80558 13.1944 0 8.5 0C3.80558 0 0 3.80558 0 8.5C0 13.1944 3.80558 17 8.5 17Z"
										fill="#111F24" />
									<path
										d="M6.30225 5.16997C6.42625 5.05397 6.56225 4.94397 6.71025 4.83997C6.86225 4.73597 7.02625 4.64397 7.20225 4.56397C7.38225 4.48397 7.57425 4.42197 7.77825 4.37797C7.98625 4.32997 8.21025 4.30597 8.45025 4.30597C8.76625 4.30597 9.05825 4.35197 9.32625 4.44397C9.59825 4.53597 9.83225 4.66597 10.0282 4.83397C10.2242 5.00197 10.3782 5.20597 10.4902 5.44597C10.6022 5.68597 10.6582 5.95597 10.6582 6.25597C10.6582 6.55997 10.6122 6.82197 10.5202 7.04197C10.4322 7.26197 10.3182 7.45597 10.1782 7.62397C10.0422 7.78797 9.89225 7.93197 9.72825 8.05597C9.56825 8.17597 9.41625 8.28997 9.27225 8.39797C9.12825 8.50597 9.00425 8.61397 8.90025 8.72197C8.80025 8.82997 8.74225 8.94997 8.72625 9.08197L8.61825 9.99997H7.88625L7.81425 9.00397C7.79825 8.82397 7.83225 8.66797 7.91625 8.53597C8.00025 8.39997 8.11025 8.27397 8.24625 8.15797C8.38225 8.03797 8.53225 7.92197 8.69625 7.80997C8.86025 7.69397 9.01225 7.56597 9.15225 7.42597C9.29625 7.28597 9.41625 7.12797 9.51225 6.95197C9.60825 6.77197 9.65625 6.55797 9.65625 6.30997C9.65625 6.13797 9.62225 5.98197 9.55425 5.84197C9.48625 5.70197 9.39425 5.58397 9.27825 5.48797C9.16225 5.38797 9.02425 5.31197 8.86425 5.25997C8.70825 5.20797 8.54025 5.18197 8.36025 5.18197C8.11625 5.18197 7.90625 5.21197 7.73025 5.27197C7.55825 5.33197 7.41225 5.39797 7.29225 5.46997C7.17225 5.54197 7.07425 5.60797 6.99825 5.66797C6.92625 5.72797 6.86625 5.75797 6.81825 5.75797C6.71825 5.75797 6.64025 5.71197 6.58425 5.61997L6.30225 5.16997ZM7.47225 12.34C7.47225 12.236 7.49025 12.138 7.52625 12.046C7.56625 11.954 7.61825 11.874 7.68225 11.806C7.75025 11.738 7.83025 11.684 7.92225 11.644C8.01425 11.604 8.11225 11.584 8.21625 11.584C8.32025 11.584 8.41825 11.604 8.51025 11.644C8.60225 11.684 8.68225 11.738 8.75025 11.806C8.81825 11.874 8.87225 11.954 8.91225 12.046C8.95225 12.138 8.97225 12.236 8.97225 12.34C8.97225 12.448 8.95225 12.548 8.91225 12.64C8.87225 12.728 8.81825 12.806 8.75025 12.874C8.68225 12.942 8.60225 12.994 8.51025 13.03C8.41825 13.07 8.32025 13.09 8.21625 13.09C8.11225 13.09 8.01425 13.07 7.92225 13.03C7.83025 12.994 7.75025 12.942 7.68225 12.874C7.61825 12.806 7.56625 12.728 7.52625 12.64C7.49025 12.548 7.47225 12.448 7.47225 12.34Z"
										fill="#111F24" />
								</svg>
							</div>

						</div>
					<?php else : ?>
						<div class="font-medium max-w-[243px]"><?php echo esc_html( $feature['title'] ) ?></div>
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