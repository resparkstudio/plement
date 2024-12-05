<?php
$gallery_heading = get_field( 'gallery_heading' );
$gallery_content = get_field( 'gallery' );

if ( ! isset( $gallery_content ) || empty( $gallery_content ) ) {
	return;
}
?>

<section id="gallery" class="container py-20 lg:py-[7.5rem]">
	<h2 class="text-h4Bold text-center mb-10 lg:text-left lg:text-h2">
		<?php esc_html_e( $gallery_heading ) ?>
	</h2>

	<div class="swiper help-center-gallery">
		<div class="swiper-wrapper">
			<?php foreach ( $gallery_content as $item ) : ?>
				<?php if ( ! empty( $item['link'] ) ) : ?>
					<div class="swiper-slide md:aspect-square md:!w-[26.25rem] bg-black group">
						<a href="<?php echo esc_url( $item['link']['url'] ) ?>" class="w-full h-full  ">
							<img class="w-full h-full object-cover group-hover:opacity-60 transition-opacity duration-300 ease-in-out"
								src="<?php echo esc_url( $item['image']['url'] ) ?>"
								alt="<?php echo esc_attr( $item['image']['alt'] ) ?>">
							<div
								class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 flex items-center w-[22.25rem] py-4 px-6 bg-white justify-between text-accent opacity-0 group-hover:opacity-100 transition-opacity duration-100">
								<span><?php esc_html_e( 'Go to full page' ) ?></span>
								<div class="z-1 flex justify-center items-center relative overflow-hidden ">
									<div
										class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] ">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%"
											height=" 100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
											<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
										</svg>
									</div>
									<div
										class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300  ">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%"
											height=" 100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
											<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
										</svg>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php else : ?>
					<div class="swiper-slide md:aspect-square md:!w-[26.25rem]">

						<img class="w-full h-full object-cover" src="<?php echo esc_url( $item['image']['url'] ) ?>"
							alt="<?php echo esc_attr( $item['image']['alt'] ) ?>">
					</div>

				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div class="flex justify-center gap-4 mt-10">
			<button class="custom-swiper-button-prev p-3 rounded-full bg-lightGrayBg">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M20.25 12H3.75" stroke="#646464" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
					<path d="M10.5 5.25L3.75 12L10.5 18.75" stroke="#646464" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
				</svg>
			</button>
			<button class="custom-swiper-button-next p-3 rounded-full bg-lightGrayBg">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M3.75 12H20.25" stroke="#646464" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
					<path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="#646464" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
				</svg>
			</button>
		</div>
	</div>
</section>