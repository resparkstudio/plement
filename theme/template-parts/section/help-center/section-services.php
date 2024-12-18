<?php
$services_content = get_field( 'services' );

if ( ! isset( $services_content ) || empty( $services_content ) ) {
	return;
}
?>
<section id="services" class="container bg-lightGrayBg py-[3.75rem] lg:px-10 lg:mt-20 lg:pt-[7.5rem] lg:pb-[4.375rem]">
	<h2 class="text-h4Bold md:text-center md:text-h2 mb-10 lg:mb-[3.75rem]">
		<?php esc_html_e( $services_content['heading'] ) ?>
	</h2>
	<div
		class="grid grid-cols-1 gap-10 mb-[3.75rem] lg:mb-[5.4375rem] lg:justify-center lg:grid-cols-[repeat(2,420px)] lg:gap-[3.75rem]">
		<?php foreach ( $services_content['services_list'] as $service ) : ?>
			<div class="">
				<img class="w-8 h-8 mb-4" src="<?php echo esc_url( $service['image']['url'] ) ?>"
					alt="<?php echo esc_attr( $service['image']['alt'] ) ?>">
				<h3 class="text-h5Bold mb-4">
					<?php esc_html_e( $service['title'] ) ?>
				</h3>
				<p class="text-title">
					<?php esc_html_e( $service['description'] ) ?>
				</p>
			</div>
		<?php endforeach; ?>
	</div>

	<h2 class="text-h5Bold lg:text-h4Bold text-center mb-10 lg:mb-[3.375rem]">
		<?php esc_html_e( $services_content['subheading'] ) ?>
	</h2>

	<ul class="grid grid-cols-1 lg:justify-center lg:grid-cols-[repeat(2,520px)] gap-x-[7.5rem] gap-y-8 mb-10 lg:mb-16">
		<?php foreach ( $services_content['includes'] as $include ) : ?>
			<li class="flex items-start gap-4">
				<img class="w-8 h-8" src="<?php echo esc_url( $include['image']['url'] ) ?>"
					alt="<?php echo esc_attr( $include['image']['alt'] ) ?>">
				<p class="text-title lg:text-h5Regular">
					<?php esc_html_e( $include['title'] ) ?>
				</p>
			</li>
		<?php endforeach; ?>
	</ul>
	<div class="flex flex-col max-w-[27.6875rem] mx-auto gap-2">
		<p class="text-darkGray text-center">
			<?php esc_html_e( $services_content['button_text'] ) ?>
		</p>
		<?php plmt_button(
			$services_content['link']['url'],
			$services_content['link']['title'],
			array(
				'classes' => 'justify-center',
			)
		) ?>
	</div>
</section>