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
<?
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