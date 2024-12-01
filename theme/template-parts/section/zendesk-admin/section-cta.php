<?php
$cta_content = get_field( 'cta' );

if ( ! isset( $cta_content ) || empty( $cta_content ) ) {
	return;
}
?>

<section id="cta" class="container text-center pt-[13rem] pb-20 lg:pt-[10rem] lg:pb-[8.875rem]">
	<h4 class="text-h4Bold mb-6 lg:text-h2 lg:mb-[2.375rem]">
		<?php esc_html_e( $cta_content['heading'] ) ?>
	</h4>
	<p class="text-title mb-10 lg:text-h5Regular lg:max-w-[35.125rem] lg:mx-auto">
		<?php esc_html_e( $cta_content['description'] ) ?>
	</p>
	<div class="max-w-[13.4375rem] mx-auto">
		<p class="text-darkGray mb-3">
			<?php esc_html_e( $cta_content['price'] ) ?>
		</p>
		<?php plmt_button(
			$cta_content['link']['url'],
			$cta_content['link']['title'],
			array(
				'classes' => 'w-full justify-center',
			)
		) ?>
	</div>
</section>