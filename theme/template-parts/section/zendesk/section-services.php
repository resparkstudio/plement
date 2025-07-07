<?php
$services = get_field( 'services' );

if ( ! isset( $services ) || empty( $services ) ) {
	return;
}
?>
<section id='services'>
	<?php foreach ( $services as $index => $service ) : ?>
		<div class="bg-lightGrayBg py-7 lg:py-20 mt-14 lg:mt-20">
			<div
				class="container mx-auto flex flex-col gap-5 lg:gap-10 <?php echo $index % 2 === 0 ? 'lg:flex-row' : 'lg:flex-row-reverse'; ?>">
				<div>
					<h2 class="mb-4 lg:mb-6 text-displayLargeMobile lg:text-displayLarge">
						<?php echo esc_html( $service['title'] ); ?>
					</h2>
					<p class="text-titleMobile lg:text-title text-darkGray lg:mb-6">
						<?php echo esc_html( $service['subtext'] ); ?>
					</p>
					<div class="hidden lg:block">
						<?php plmt_button( esc_url( $service['button']['url'] ), esc_html( $service['button']['title'] ) ) ?>
						<?php if ( $service['bottom_text'] ) : ?>
							<p class="text-accent mt-10 text-h4Bold">
								<?php echo esc_html( $service['bottom_text'] ); ?>
							</p>
						<?php endif; ?>
					</div>
				</div>
				<div class="lg:max-w-[39.6875rem] w-full">
					<div class="bg-accent/5 px-3 lg:px-0 py-4 lg:py-6 w-full">
						<?php if ( $service['steps_heading'] ) : ?>
							<h3 class="text-h4BoldMobile lg:text-h4Bold text-center mb-4 lg:mb-6">
								<?php echo esc_html( $service['steps_heading'] ); ?>
							</h3>
						<?php endif; ?>
						<div class="flex flex-col gap-3 lg:gap-8 lg:max-w-[26.25rem] mx-auto">
							<?php foreach ( $service['steps'] as $index => $step ) :
								$has_icon  = ! empty( $step['icon'] );
								$icon_html = $has_icon ? '<img src="' . esc_url( $step['icon']['url'] ) . '" alt="' . esc_attr( $step['icon']['alt'] ) . '" class="w-6 h-6 lg:w-8 lg:h-8">' : '';
								?>
								<div class="flex gap-3 lg:gap-4  <?php echo $has_icon ? 'items-start' : 'items-center'; ?>">
									<?php if ( $has_icon ) : ?>
										<span class="shrink-0">
											<?php echo $icon_html; ?>
										</span>
									<?php else : ?>
										<span
											class="shrink-0 text-accent bg-accent/10 text-h5Mobile lg:text-h5Bold w-7 h-7 flex items-center justify-center">
											<?php echo esc_html( $index + 1 ); ?>
										</span>
									<?php endif; ?>
									<p class="text-bodySmall lg:text-h5Regular">
										<?php echo esc_html( $step['text'] ); ?>
									</p>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php if ( $service['bottom_text'] ) : ?>
						<p class="lg:hidden text-center text-accent text-h4BoldMobile mt-5">
							<?php echo esc_html( $service['bottom_text'] ); ?>
						</p>
					<?php endif; ?>
					<?php plmt_button( esc_url( $service['button']['url'] ), esc_html( $service['button']['title'] ), array(
						'classes' => 'mt-5 w-full justify-center lg:hidden',
					) ) ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</section>