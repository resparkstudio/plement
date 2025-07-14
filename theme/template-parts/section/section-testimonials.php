<?php
$testimonials_content = get_field( 'testimonials' );

if ( ! isset( $testimonials_content ) || empty( $testimonials_content ) ) {
	return;
}

function testimonial_card( $testimonial ) {
	if ( empty( $testimonial ) ) {
		return;
	}
	?>
	<div class="flex flex-col justify-between h-full bg-lightGrayBg p-5 lg:p-10">
		<div>
			<div class="flex items-center mb-2 gap-2">
				<svg width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M16.8198 7.73795L13.316 11.1535L14.1434 15.9775C14.1794 16.1884 14.0928 16.4016 13.9195 16.5276C13.8217 16.599 13.7052 16.635 13.5888 16.635C13.4993 16.635 13.4093 16.6136 13.3272 16.5703L8.99484 14.2928L4.66303 16.5698C4.47403 16.6699 4.24396 16.6536 4.07071 16.527C3.89746 16.401 3.81084 16.1878 3.84684 15.9769L4.67428 11.1529L1.1699 7.73795C1.0169 7.58833 0.961214 7.36445 1.02759 7.16139C1.09396 6.95833 1.27003 6.80927 1.48209 6.77833L6.32465 6.0752L8.49028 1.68658C8.67984 1.30239 9.30984 1.30239 9.4994 1.68658L11.665 6.0752L16.5076 6.77833C16.7197 6.80927 16.8957 6.95777 16.9621 7.16139C17.0285 7.36502 16.9728 7.58777 16.8198 7.73795Z"
						fill="#ED5623" />
				</svg>
				<span class="text-bodyBold"><?php echo esc_html_e( $testimonial['rating'] ) ?></span>
			</div>
			<h5 class="text-bodyBold mb-3 lg:text-h5Bold lg:mb-4"><?php echo esc_html( $testimonial['title'] ) ?></h5>
			<p class="mb-3 whitespace-pre-line"><?php echo esc_html( $testimonial['description'] ) ?></p>
		</div>
		<div class="flex items-center gap-5">
			<img class="rounded-full w-[3.75rem] h-[3.75rem]" src="<?php echo esc_url( $testimonial['image']['url'] ) ?>"
				alt="<?php echo esc_attr( $testimonial['image']['alt'] ) ?>">
			<div class="text-bodySmall lg:text-bodyRegular text-darkGray">
				<p><?php esc_html_e( $testimonial['name'] ) ?></p>
				<p>
					<?php echo $testimonial['client'] ?>
				</p>
			</div>
		</div>
	</div>
	<?php
}

?>

<section id="testimonials" class="pt-[3.25rem] pb-6 lg:pt-[7.5rem] lg:pb-[7.5rem] overflow-hidden">
	<h2 class="container text-h4Bold lg:text-[3rem] lg:leading-[3.3rem] text-center mb-10 mx-auto lg:mb-[3.75rem]">
		<?php echo esc_html( $testimonials_content['heading'] ) ?>
	</h2>
	<div class="testimonials-swiper swiper">
		<div class="swiper-wrapper">
			<?php
			if ( isset( $testimonials_content['testimonials'] ) ) :
				foreach ( $testimonials_content['testimonials'] as $testimonial ) :
					?>
					<div class="swiper-slide flex min-h-[23.75rem] lg:min-h-[26.25rem]">
						<?php
						testimonial_card( $testimonial );
						?>
					</div>
					<?php
				endforeach;
				foreach ( $testimonials_content['testimonials'] as $testimonial ) :
					?>
					<div class="swiper-slide flex min-h-[23.75rem] lg:min-h-[26.25rem]">
						<?php
						testimonial_card( $testimonial );
						?>
					</div>
					<?php
				endforeach;
			endif;
			?>
		</div>
		<div class="flex justify-center gap-4 mt-10">
			<button
				class="custom-swiper-button-prev p-3 rounded-full bg-lightGrayBg text-[#646464] hover:text-[#111F24] disabled:bg-[#E9E9E9] disabled:text-[#B2B2B2] disabled:pointer-events-none transition-colors ease-in-out">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M20.25 12H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
					<path d="M10.5 5.25L3.75 12L10.5 18.75" stroke="currentColor" stroke-width="1.5"
						stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</button>
			<button
				class="custom-swiper-button-next p-3 rounded-full bg-lightGrayBg text-[#646464] hover:text-[#111F24] disabled:bg-[#E9E9E9] disabled:text-[#B2B2B2] disabled:pointer-events-none transition-colors ease-in-out">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M3.75 12H20.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
					<path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="currentColor" stroke-width="1.5"
						stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</button>
		</div>
	</div>

</section>