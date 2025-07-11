<?php
$services_content = get_field( 'services' );

if ( ! isset( $services_content ) || empty( $services_content ) ) {
	return;
}
?>
<section id="services"
	class="container bg-lightGrayBg py-[3.75rem] lg:px-10 lg:pb-[4.375rem] bg-services bg-no-repeat bg-right-bottom bg-[length:212px_160px] lg:bg-[length:298px_226px]">
	<div class="flex flex-col gap-6 md:flex-row md:items-center mb-[3.25rem]">
		<h2 class="text-h4Bold text-center md:w-1/2 md:text-left md:text-h2">
			<?php esc_html_e( $services_content['heading'] ) ?>
		</h2>
		<p class="border-l-2 border-l-accent pl-4 md:w-1/2 lg:pl-10">
			<?php esc_html_e( $services_content['description'] ) ?>
		</p>
	</div>
	<div class="grid grid-cols-1 gap-10 mb-[3.75rem] lg:mb-[5.4375rem] md:grid-cols-3 lg:gap-[3.75rem]">
		<?php foreach ( $services_content['services_list'] as $service ) : ?>
			<div>
				<img class="w-8 h-8 mb-4" src="<?php echo esc_url( $service['image']['url'] ) ?>"
					alt="<?php echo esc_attr( $service['image']['alt'] ) ?>">
				<h3 class="text-h5Bold mb-4">
					<?php esc_html_e( $service['title'] ) ?>
				</h3>
				<p class="md:text-title">
					<?php esc_html_e( $service['description'] ) ?>
				</p>
			</div>
		<?php endforeach; ?>
	</div>
	<p class="text-h5Bold text-accent lg:text-h4Bold">
		<?php esc_html_e( $services_content['bottom_text'] ) ?>
	</p>
</section>