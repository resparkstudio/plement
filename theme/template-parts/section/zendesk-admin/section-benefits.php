<?php
$benefits_content = get_field( 'benefits' );

if ( ! isset( $benefits_content ) || empty( $benefits_content ) ) {
	return;
}
?>
<section id="benefits" class="container bg-lightGrayBg py-[3.75rem] mb-20 lg:px-10 lg:mb-[7.5rem] lg:pb-[4.375rem]">
	<h2 class="text-h4Bold md:text-center md:text-h2 mb-10 lg:mb-[3.75rem]">
		<?php esc_html_e( $benefits_content['heading'] ) ?>
	</h2>
	<div class="grid grid-cols-1 gap-10 mb-10 lg:mb-[4.625rem] md:grid-cols-2 lg:gap-[3.75rem]">
		<?php foreach ( $benefits_content['benefits_list'] as $benefit ) : ?>
			<div>
				<img class="w-8 h-8 mb-4" src="<?php echo esc_url( $benefit['image']['url'] ) ?>"
					alt="<?php echo esc_attr( $benefit['image']['alt'] ) ?>">
				<h3 class="text-h5Bold mb-4">
					<?php esc_html_e( $benefit['title'] ) ?>
				</h3>
				<p class="text-title">
					<?php esc_html_e( $benefit['description'] ) ?>
				</p>
			</div>
		<?php endforeach; ?>
	</div>
	<p class="text-h5Bold text-accent lg:text-h4Regular max-w-[52.6875rem]">
		<?php esc_html_e( $benefits_content['bottom_text'] ) ?>
	</p>
</section>