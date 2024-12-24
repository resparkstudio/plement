<?php
$cta_content = get_field( 'cta' );

if ( ! isset( $cta_content ) || empty( $cta_content ) ) {
	return;
}
?>

<section id="cta"
	class="container relative flex flex-col gap-20 lg:gap-[4.875rem] pt-[5rem] pb-[7.5rem] lg:flex-row lg:pt-[7.5rem] lg:pb-20 lg:items-center">
	<div class="lg:w-1/2 bg-mainBlack text-white p-6">
		<h2 class="text-h4Bold mb-[2.25rem] lg:text-h2">
			<?php esc_html_e( $cta_content['heading_1'] ) ?>
		</h2>
		<img class="w-8 h-8 mb-[2.25rem]" src="<?php echo esc_url( $cta_content['icon']['url'] ) ?>"
			alt="<?php echo esc_url( $cta_content['icon']['alt'] ) ?>">
		<div class="text-bodyRegular">
			<?php echo $cta_content['description_1'] ?>
		</div>
	</div>
	<div class="lg:w-1/2">
		<h2 class="text-h4Bold mb-6 lg:text-h2">
			<?php esc_html_e( $cta_content['heading_2'] ) ?>
		</h2>
		<div class="text-bodyRegular lg:text-title mb-6">
			<?php echo $cta_content['description_2'] ?>
		</div>
		<div class="text-bodyRegular mb-4 text-darkGray">
			<?php echo $cta_content['button_text'] ?>
		</div>
		<div>
			<div class="flex justify-center lg:justify-start">
				<?php plmt_button( $cta_content['link']['url'], $cta_content['link']['title'], array(
					'classes' => 'justify-center w-full lg:w-auto lg:px-[4rem]',
				) ) ?>
			</div>
		</div>
	</div>
</section>