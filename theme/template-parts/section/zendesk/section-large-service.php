<?php
$large_service_content = get_field( 'large_service' );
if ( ! isset( $large_service_content ) || empty( $large_service_content ) ) {
	return;
}
?>

<section class="bg-lightGrayBg py-8 lg:py-20 mt-14 lg:mt-20">
	<div class="container">
		<h2 class="text-center text-displayLargeMobile lg:text-displayLarge mb-4 lg:mb-6">
			<?php echo esc_html( $large_service_content['heading'] ); ?>
		</h2>
		<p class="text-center mx-auto text-titleMobile lg:text-title mb-10 text-darkGray max-w-[56.25rem]">
			<?php echo esc_html( $large_service_content['description'] ); ?>
		</p>
		<div class="bg-accent/5 py-4 px-3 lg:px-6 lg:py-8">
			<h4 class="mb-4 lg:mb-6 text-center text-h4BoldMobile lg:text-h4Bold">
				<?php echo esc_html( $large_service_content['steps']['heading'] ); ?>
			</h4>
			<div class="flex flex-col gap-3 lg:flex-row  lg:justify-center">
				<?php foreach ( $large_service_content['steps']['steps_list'] as $index => $step ) : ?>
					<div
						class="flex items-center gap-4 lg:flex-col lg:text-center lg:max-w-[18.5625rem] w-full lg:py-5 lg:px-3">
						<span
							class="shrink-0 text-accent bg-accent/10 text-h5Mobile lg:text-h5Bold w-7 h-7 flex items-center justify-center">
							<?php echo esc_html( $index + 1 ); ?>
						</span>
						<div>
							<h3 class="text-bodyBold lg:text-h5Bold mb-1">
								<?php echo esc_html( $step['title'] ); ?>
							</h3>
							<p class="text-bodyRegular lg:text-h5Regular">
								<?php echo esc_html( $step['description'] ); ?>
							</p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<p
			class="text-center text-h4BoldMobile lg:text-h4Bold mt-10 mb-4 lg:my-10 text-accent max-w-[56.25rem] w-full mx-auto">
			<?php echo esc_html( $large_service_content['bottom_text'] ); ?>
		</p>
		<div class="flex justify-center">
			<?php plmt_button( $large_service_content['button']['url'], $large_service_content['button']['title'], array(
				'classes' => 'w-full lg:w-auto justify-center',
			) ); ?>
		</div>

</section>