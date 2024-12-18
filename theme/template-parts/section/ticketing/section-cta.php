<?php
$cta_content = get_field( 'cta' );

if ( ! isset( $cta_content ) || empty( $cta_content ) ) {
	return;
}
?>

<section id="cta"
	class="container bg-lightGrayBg grid grid-cols-1 gap-10 pt-[3.75rem] pb-[6.375rem] mb-20 lg:grid-cols-3 lg:items-center lg:p-10">
	<div>
		<h3 class="text-h4Bold mb-8 text-center lg:text-h3 lg:text-left"><?php esc_html_e( $cta_content['heading'] ) ?>
		</h3>
		<p class="text-title"><?php esc_html_e( $cta_content['description'] ) ?></p>
	</div>
	<div class="mx-auto">
		<img class="w-full max-w-[21.5rem]" src="<?php echo esc_url( $cta_content['image']['url'] ) ?>"
			alt="<?php esc_attr_e( $cta_content['image']['alt'] ) ?>">
	</div>
	<div>
		<p class="text-h5Bold mb-8 text-center"><?php esc_html_e( $cta_content['right_text'] ) ?></p>
		<?php plmt_button( $cta_content['link']['url'], $cta_content['link']['title'], array( 'classes' => 'w-full justify-center' ) ) ?>
	</div>
</section>