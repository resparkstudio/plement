<?php
$includes_content = get_field( 'includes' );

if ( ! isset( $includes_content ) || empty( $includes_content ) ) {
	return;
}

?>
<section id="includes" class="bg-mainBlack text-white py-[3.75rem] md:py-8">
	<div class="container md:flex items-center justify-center gap-6">
		<div class="mb-10 md:w-1/2">
			<h2 class="text-h4Bold text-center md:text-h2"><?php esc_html_e( $includes_content['heading'] ) ?></h2>
		</div>
		<div class="md:w-1/2">
			<ul class="space-y-10 md:space-y-14">
				<?php foreach ( $includes_content['service'] as $service ) : ?>
					<li class="flex items-start gap-4">
						<img class="w-8 h-8" src="<?php echo esc_url( $service['image']['url'] ) ?>"
							alt="<?php esc_attr_e( $service['image']['alt'] ) ?>">
						<span class="text-h5Regular"><?php esc_html_e( $service['title'] ) ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>