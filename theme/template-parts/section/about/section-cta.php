<?php
$cta_content = get_field( 'cta' );

if ( ! isset( $cta_content ) || empty( $cta_content ) ) {
	return;
}
?>

<section id="cta"
	class="container flex flex-col gap-10 pt-20 pb-[7.5rem] lg:flex-row lg:pt-[10rem] lg:pb-20 lg:items-center">
	<div class="lg:w-2/3">
		<h2 class="text-h4Bold mb-6 lg:text-h2">
			<?php esc_html_e( $cta_content['heading'] ) ?>
		</h2>
		<p class="text-title mb-6">
			<?php esc_html_e( $cta_content['description'] ) ?>
		</p>
		<div>
			<p class="text-darkGray mb-6 lg:mb-4">
				<?php esc_html_e( $cta_content['button_text'] ) ?>
			</p>
			<div class="flex justify-center lg:justify-start">
				<?php plmt_button( $cta_content['link']['url'], $cta_content['link']['title'], array(
					'classes' => 'px-[4rem]',
				) ) ?>
			</div>
		</div>
	</div>
	<div class="lg:w-1/3">
		<img class="hidden lg:block max-w-[14.5625rem] w-full mx-auto mb-10 lg:mb-0 lg:max-w-[24.3125rem]"
			src="<?php echo esc_url( $cta_content['image']['url'] ) ?>"
			alt="<?php echo esc_attr( $cta_content['image']['alt'] ) ?>">
	</div>
</section>