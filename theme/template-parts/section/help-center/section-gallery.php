<?php
$gallery_content = get_field( 'gallery' );

if ( ! isset( $gallery_content ) || empty( $gallery_content ) ) {
	return;
}
?>

<section id="gallery" class="container py-20 lg:py-[7.5rem]">
	<h2 class="text-h4Bold text-center mb-10 lg:text-left lg:text-h2">
		<?php esc_html_e( $gallery_content['heading'] ) ?>
	</h2>

	<div class="swiper help-center-gallery">
		<div class="swiper-wrapper">
			<?php foreach ( $gallery_content['images'] as $image ) : ?>
				<div class="swiper-slide md:aspect-square md:!w-[26.25rem]">
					<img class="w-full h-full object-cover" src="<?php echo esc_url( $image['url'] ) ?>"
						alt="<?php echo esc_attr( $image['alt'] ) ?>">
				</div>
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