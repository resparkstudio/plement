<?php
$price_content = get_field( 'price' );

if ( ! isset( $price_content ) || empty( $price_content ) || $price_content['hide_section'] ) {
	return;
}

if ( ! function_exists( 'plmt_price_card' ) ) {
	function plmt_price_card( $price ) {
		?>
		<div class="relative border border-accent w-full px-5 lg:px-7 pt-12 lg:pt-16 pb-5 lg:pb-8">
			<div class="absolute top-0 left-0 text-bodyBold">
				<div class="py-2 px-6 lg:py-3 lg:px-[1.875rem] text-white bg-accent">
					<?php esc_html_e( $price['bead_text'], ); ?>
				</div>
			</div>
			<div class="pb-5 lg:pb-4 border-b border-b-[#E9E9E9] flex items-center justify-between">
				<span class="text-accent text-h3 font-bold lg:text-h4Bold">
					<?php esc_html_e( 'Price ', 'plement' ); ?>
				</span>
				<div class="flex items-center">
					<span class="text-h2Mobile lg:text-h2" x-html="currency === 'usd' ? '$' : '€'"></span>
					<span class="text-h2Mobile lg:text-h2" x-show="currency === 'eur'">
						<?php echo esc_html( $price['price_usd'] ); ?>
					</span>
					<span class="text-h2Mobile lg:text-h2" x-show="currency === 'usd'">
						<?php echo esc_html( $price['price_eur'] ); ?>
					</span>
				</div>
			</div>
			<div class="mt-5 lg:mt-4 flex flex-col gap-3">
				<?php foreach ( $price['services'] as $service ) : ?>
					<div class="flex gap-2">
						<svg class="shrink-0" width="18" height="18" viewBox="0 0 18 18" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path d="M14 6L7.3333 13L4 9.5" stroke="#ED5623" stroke-width="1.5" stroke-linecap="round"
								stroke-linejoin="round" />
						</svg>
						<span class="text-bodyRegular">
							<?php echo esc_html( $service['service'] ); ?>
						</span>
					</div>
				<?php endforeach; ?>
			</div>
			<?php if ( $price['bottom_items'] ) : ?>
				<div class="flex flex-col gap-3 border-t border-t-[#E9E9E9] pt-3 mt-3">
					<div class="flex items-center gap-1">
						<?php foreach ( $price['bottom_items'] as $item ) : ?>
							<div class="flex items-start gap-2">
								<img class="flex-shrink-0 w-[1.125rem] h-[1.125rem]" src="<?php echo esc_url( $item['icon']['url'] ) ?>"
									alt="<?php echo esc_attr( $item['icon']['alt'] ) ?>">
								<div class="text-bodySmall">
									<span>
										<?php echo esc_html( $item['text'] ) ?>
									</span>
									<span class="font-bold">
										<?php echo esc_html( $item['bold_text'] ) ?>
									</span>
								</div>
							</div>
							<?php if ( isset( $item['tooltip'] ) && ! empty( $item['tooltip'] ) ) : ?>
								<div class="shrink-0">
									<?php bottom_tooltip( esc_html( $item['tooltip'] ), true ) ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}
?>

<section id="price" class="bg-lightGrayBg mt-14 lg:mt-20 py-8 lg:py-20">
	<div class="container flex flex-col lg:items-center lg:flex-row lg:gap-16">
		<div class="text-center max-w-[39rem]	">
			<h2 class="text-displayLargeMobile lg:text-displayLarge mb-4 lg:mb-6">
				<?php echo esc_html( $price_content['heading'] ); ?>
			</h2>
			<p class="mb-5 lg:mb-6">
				<?php echo esc_html( $price_content['description'] ); ?>
			</p>
			<div class="hidden lg:block">

				<?php plmt_button( $price_content['button']['url'], $price_content['button']['title'], array(
					'classes' => 'px-14',
				) ); ?>
			</div>
		</div>
		<div class="max-w-[38.9375rem] w-full">
			<?php currency_switch(); ?>
			<?php echo plmt_price_card( $price_content['price_card'] ); ?>
		</div>
		<div class="lg:hidden mt-10">
			<?php plmt_button( $price_content['button']['url'], $price_content['button']['title'], array(
				'classes' => 'w-full justify-center',
			) ); ?>
		</div>
	</div>

</section>