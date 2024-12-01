<?php
$cta_content = get_field( 'cta' );

if ( ! isset( $cta_content ) || empty( $cta_content ) ) {
	return;
}
?>

<section id="cta" class="container flex flex-col gap-10 py-20 lg:flex-row lg:pt-[10rem] lg:pb-[5.625rem]">
	<div class="lg:w-2/3">
		<h2 class="text-h4Bold mb-6 text-center lg:text-h2 lg:text-left lg:mb-4">
			<?php esc_html_e( $cta_content['heading'] ) ?>
		</h2>
		<p class="text-center lg:text-title lg:text-darkGray lg:mb-[3.75rem] lg:text-left lg:max-w-[34.9375rem]">
			<?php esc_html_e( $cta_content['description'] ) ?>
		</p>
		<div class="hidden lg:flex items-start gap-[3.75rem]">
			<p class="text-h4Bold">
				<?php esc_html_e( $cta_content['button_text'] ) ?>
			</p>
			<?php plmt_button( $cta_content['link']['url'], $cta_content['link']['title'], array(
				'classes' => 'px-[6.625rem]',
			) ) ?>
		</div>
	</div>
	<div class="lg:w-1/3">
		<img class="max-w-[14.5625rem] w-full mx-auto mb-10 lg:mb-0 lg:max-w-[24.3125rem]"
			src="<?php echo esc_url( $cta_content['image']['url'] ) ?>"
			alt="<?php echo esc_attr( $cta_content['image']['alt'] ) ?>">
		<div class="lg:hidden">
			<p class="text-h4Bold mb-6 text-center">
				<?php esc_html_e( $cta_content['button_text'] ) ?>
			</p>
			<?php plmt_button( $cta_content['link']['url'], $cta_content['link']['title'], array(
				'classes' => 'w-full justify-center lg:w-auto px-[3.75rem]',
			) ) ?>
		</div>
	</div>
</section>