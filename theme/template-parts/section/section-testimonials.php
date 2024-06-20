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
	<div class="w-[420px] shadow-testimonial py-6 px-4 lg:p-8">

		<div class="flex items-center mb-4">
			<?php for ( $i = 0; $i < 5; $i++ ) : ?>
				<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M16.8198 7.73795L13.316 11.1535L14.1434 15.9775C14.1794 16.1884 14.0928 16.4016 13.9195 16.5276C13.8217 16.599 13.7052 16.635 13.5888 16.635C13.4993 16.635 13.4093 16.6136 13.3272 16.5703L8.99484 14.2928L4.66303 16.5698C4.47403 16.6699 4.24396 16.6536 4.07071 16.527C3.89746 16.401 3.81084 16.1878 3.84684 15.9769L4.67428 11.1529L1.1699 7.73795C1.0169 7.58833 0.961214 7.36445 1.02759 7.16139C1.09396 6.95833 1.27003 6.80927 1.48209 6.77833L6.32465 6.0752L8.49028 1.68658C8.67984 1.30239 9.30984 1.30239 9.4994 1.68658L11.665 6.0752L16.5076 6.77833C16.7197 6.80927 16.8957 6.95777 16.9621 7.16139C17.0285 7.36502 16.9728 7.58777 16.8198 7.73795Z"
						fill="#ED5623" />
				</svg>
			<?php endfor; ?>
		</div>

		<h5 class="text-lg font-medium mb-3"><?php echo esc_html( $testimonial['title'] ) ?></h5>
		<p class="text-textGray mb-4"><?php echo esc_html( $testimonial['description'] ) ?></p>
		<div>
			- <?php echo esc_html( $testimonial['name'] ) ?>
			<?php if ( ! empty( $testimonial['company'] ) ) : ?>
				at
				<a href="<?php echo esc_url( $testimonial['company']['url'] ) ?>">
					<?php echo esc_html( $testimonial['company']['title'] ) ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

?>

<section id="testimonials" class="py-16 lg:py-36">
	<h2 class="max-w-lg text-center mx-auto mb-8 lg:mb-20"><?php echo esc_html( $testimonials_content['heading'] ) ?>
	</h2>
	<div class="flex flex-col">
		<div class='flex overflow-hidden space-x-6 pb-6'>
			<div class='flex space-x-6 animate-marquee'>
				<?php
				if ( isset( $testimonials_content['testimonials_row_1'] ) ) :
					foreach ( $testimonials_content['testimonials_row_1'] as $testimonial ) :
						testimonial_card( $testimonial );
					endforeach;
				endif;
				?>
			</div>
			<div class='flex space-x-6 animate-marquee' aria-hidden='true'>
				<?php
				if ( isset( $testimonials_content['testimonials_row_1'] ) ) :
					foreach ( $testimonials_content['testimonials_row_1'] as $testimonial ) :
						testimonial_card( $testimonial );
					endforeach;
				endif;
				?>
			</div>
		</div>
		<div class='flex overflow-hidden space-x-6'>
			<div class='flex space-x-6 animate-marquee2'>
				<?php
				if ( isset( $testimonials_content['testimonials_row_2'] ) ) :
					foreach ( $testimonials_content['testimonials_row_2'] as $testimonial ) :
						testimonial_card( $testimonial );
					endforeach;
				endif;
				?>
			</div>
			<div class='flex space-x-6 animate-marquee2' aria-hidden='true'>
				<?php
				if ( isset( $testimonials_content['testimonials_row_2'] ) ) :
					foreach ( $testimonials_content['testimonials_row_2'] as $testimonial ) :
						testimonial_card( $testimonial );
					endforeach;
				endif;
				?>
			</div>
		</div>
	</div>
</section>