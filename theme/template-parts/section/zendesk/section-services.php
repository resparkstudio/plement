<?php
$services = get_field( 'services' );

if ( ! isset( $services ) || empty( $services ) ) {
	return;
}

if ( ! function_exists( 'plmt_gallery' ) ) {
	function plmt_gallery( $gallery ) {
		?>
		<h2 class="text-h4BoldMobile lg:text-h4Bold mb-4 lg:mb-6">
			<?php echo esc_html( $gallery['gallery_heading'] ); ?>
		</h2>
		<div class="swiper help-center-gallery">
			<div class="swiper-wrapper">
				<?php foreach ( $gallery['gallery_items'] as $item ) : ?>
					<?php if ( ! empty( $item['link'] ) ) : ?>
						<div class="swiper-slide md:aspect-square md:!w-[26.25rem] bg-black group/container border border-[#E8E8E8]">
							<a href="<?php echo esc_url( $item['link']['url'] ) ?>" class="w-full h-full" target="_blank">
								<img class="w-full h-full object-cover group-hover/container:lg:opacity-60 transition-opacity duration-300 ease-in-out"
									src="<?php echo esc_url( $item['image']['url'] ) ?>"
									alt="<?php echo esc_attr( $item['image']['alt'] ) ?>">
								<div
									class="group/button absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 flex items-center w-[22.25rem] py-4 px-6 bg-white justify-between text-accent opacity-0 group-hover/container:lg:opacity-100 transition-all duration-200 hover:bg-accent hover:text-white">
									<span class="font-bold"><?php esc_html_e( 'Go to full page' ) ?></span>
									<div class="z-1 flex justify-center items-center relative overflow-hidden ">
										<div
											class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover/button:translate-x-0 group-hover/button:translate-y-0">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
												aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
												preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
												<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
											</svg>
										</div>
										<div
											class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover/button:translate-x-[100%] group-hover/button:translate-y-[-100%]">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
												aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
												preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
												<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>
							<a href="<?php echo esc_url( $item['link']['url'] ) ?>" target="_blank"
								class="inline-flex items-center justify-between w-full py-4 px-6 lg:hidden bg-mainBlack text-white text-[1.125rem] font-medium">
								<span><?php esc_html_e( 'Go to full page' ) ?></span>
								<div class="z-1 flex justify-center items-center relative overflow-hidden">
									<div
										class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] ">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
											preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
											<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
										</svg>
									</div>
									<div
										class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300  ">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
											preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
											<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
										</svg>
									</div>
								</div>
							</a>
						</div>
					<?php else : ?>
						<div class="swiper-slide md:aspect-square md:!w-[26.25rem] border border-[#E8E8E8]">
							<img class="w-full h-full object-cover" src="<?php echo esc_url( $item['image']['url'] ) ?>"
								alt="<?php echo esc_attr( $item['image']['alt'] ) ?>">
						</div>

					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<div class="flex justify-center gap-4 mt-4 lg:mt-10">
				<button
					class="custom-swiper-button-prev p-3 rounded-full bg-lightGrayBg text-[#646464] hover:text-[#111F24] disabled:bg-[#E9E9E9] disabled:text-[#B2B2B2] disabled:pointer-events-none transition-colors ease-in-out">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M20.25 12H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
						<path d="M10.5 5.25L3.75 12L10.5 18.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
				</button>
				<button
					class="custom-swiper-button-next p-3 rounded-full bg-lightGrayBg text-[#646464] hover:text-[#111F24] disabled:bg-[#E9E9E9] disabled:text-[#B2B2B2] disabled:pointer-events-none transition-colors ease-in-out">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3.75 12H20.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
						<path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
				</button>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'plmt_steps_list' ) ) {
	function plmt_steps_list( $steps_heading, $steps, $is_horizontal = false ) {
		?>
		<div
			class="bg-accent/5 px-3 lg:px-0 py-4 lg:py-6 w-full <?php echo $is_horizontal ? 'flex flex-col lg:flex-row items-center justify-center gap-16' : ''; ?>">
			<?php if ( $steps_heading ) : ?>
				<h3
					class="text-h4BoldMobile lg:text-h4Bold <?php echo $is_horizontal ? 'lg:text-left' : 'text-center mb-4 lg:mb-6' ?>">
					<?php echo esc_html( $steps_heading ); ?>
				</h3>
			<?php endif; ?>
			<div
				class="flex flex-col gap-3 lg:gap-8   <?php echo $is_horizontal ? 'lg:max-w-[37.25rem]' : 'lg:max-w-[26.25rem] mx-auto' ?>">
				<?php foreach ( $steps as $index => $step ) :
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
		<?php
	}
}
?>
<section id='services'>
	<?php foreach ( $services as $index => $service ) :
		$is_even         = $index % 2 === 0;
		$is_with_image   = $service['type'] === 'with_image';
		$is_with_gallery = $service['type'] === 'with_gallery';
		?>
		<div class="bg-lightGrayBg py-7 lg:py-20 mt-14 lg:mt-20">
			<div
				class="container mx-auto flex flex-col gap-5 lg:gap-10 <?php echo $is_even ? 'lg:flex-row' : 'lg:flex-row-reverse'; ?>">
				<div class="text-center">
					<?php if ( $is_with_image ) : ?>
						<img class="w-full h-full object-contain mb-6 lg:hidden"
							src="<?php echo esc_url( $service['image']['url'] ); ?>"
							alt="<?php echo esc_attr( $service['image']['alt'] ); ?>">
					<?php endif; ?>
					<h2 class="mb-4 lg:mb-6 text-displayLargeMobile lg:text-displayLarge ">
						<?php echo esc_html( $service['title'] ); ?>
					</h2>
					<p class="text-titleMobile lg:text-title text-darkGray lg:mb-6">
						<?php echo esc_html( $service['subtext'] ); ?>
					</p>
				</div>
				<div class="lg:max-w-[39.6875rem] w-full">
					<?php if ( $is_with_image ) : ?>
						<img class="w-full h-full object-contain hidden lg:block"
							src="<?php echo esc_url( $service['image']['url'] ); ?>"
							alt="<?php echo esc_attr( $service['image']['alt'] ); ?>">
					<?php else : ?>
						<?php plmt_steps_list( $service['steps_heading'], $service['steps'] ); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php if ( $service['bottom_text'] ) : ?>
				<p class="container text-center text-accent text-h4BoldMobile lg:text-h4Bold mt-5 lg:mt-16">
					<?php echo esc_html( $service['bottom_text'] ); ?>
				</p>
			<?php endif; ?>
			<?php if ( $is_with_gallery && ! empty( $service['gallery'] ) ) : ?>
				<div class="container mx-auto mt-6 lg:mt-14">
					<?php plmt_gallery( $service['gallery'] ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $is_with_image ) : ?>
				<div class="container mx-auto mt-6 lg:mt-14">
					<?php plmt_steps_list( $service['steps_heading'], $service['steps'], true ); ?>
				</div>
			<?php endif; ?>
			<div class="container mx-auto lg:hidden <?php echo $is_with_gallery || $is_with_image ? 'mt-6' : 'mt-5' ?>">
				<?php plmt_button( esc_url( $service['button']['url'] ), esc_html( $service['button']['title'] ), array(
					'classes' => 'w-full justify-center',
				) ) ?>
			</div>
		</div>
	<?php endforeach; ?>
</section>