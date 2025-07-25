<?php
$info_section = get_field( 'info_section' );

if ( ! isset( $info_section ) || empty( $info_section ) ) {
	return;
}

?>

<section id="info" class="container flex flex-col lg:flex-row gap-4 lg:gap-10 lg:items-center lg:justify-between">
	<div class=" space-y-4 lg:space-y-6 max-w-[54.375rem] w-full">
		<?php if ( $info_section['heading'] ) : ?>
			<h2 class="text-h2Mobile lg:text-h2"><?php echo esc_html( $info_section['heading'] ); ?></h2>
		<?php endif; ?>
		<?php if ( $info_section['subtext'] ) : ?>
			<p class="text-titleMobile text-darkGray lg:text-title">
				<?php echo esc_html( $info_section['subtext'] ); ?>
			</p>
		<?php endif; ?>
	</div>
	<?php if ( $info_section['image'] ) : ?>
		<div class="max-w-[9.25rem] lg:max-w-[14.6875rem] w-full">
			<img class="w-full h-auto" src="<?php echo esc_url( $info_section['image']['url'] ); ?>"
				alt="<?php echo esc_attr( $info_section['image']['alt'] ); ?>">
		</div>
	<?php endif; ?>
</section>