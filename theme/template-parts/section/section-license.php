<?php
$license = get_field( 'license' );

if ( ! isset( $license ) || empty( $license ) ) {
	return;
}

?>
<section id='license'
	class="container overflow-hidden mx-auto relative pt-[3.25rem] lg:pt-[7.5rem] gap-[9.1875rem] justify-center flex items-center">
	<div class="max-w-[38.75rem] w-full">
		<?php if ( $license['heading'] ) : ?>
			<h2 class="text-h2Mobile lg:text-h1 font-bold mb-4 lg:mb-6"><?php echo esc_html( $license['heading'] ); ?></h2>
		<?php endif; ?>
		<?php if ( $license['subtext'] ) : ?>
			<p class="text-titleMobile lg:text-title text-darkGray">
				<?php echo esc_html( $license['subtext'] ); ?>
			</p>
		<?php endif; ?>
	</div>
	<div class="absolute -right-16 max-w-[14.75rem] lg:max-w-[23.1875rem] lg:static w-full">
		<?php if ( $license['image'] ) : ?>
			<img class="w-full" src="<?php echo esc_url( $license['image']['url'] ); ?>"
				alt="<?php echo esc_attr( $license['image']['alt'] ); ?>">
		<?php endif; ?>
	</div>
</section>