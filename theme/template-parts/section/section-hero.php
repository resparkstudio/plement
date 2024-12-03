<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero' class='container pt-10 pb-8 lg:pb-6 lg:h-[calc(100vh-108px)] flex flex-col'>
	<div class='flex flex-col gap-12 items-center lg:flex-row lg:justify-between lg:gap-14'>
		<div class='lg:w-1/2 hero-content lg:max-w-2xl'>
			<h1 class='text-h1Mobile max-w-[33.125rem] w-full lg:text-h2 mb-8 lg:mb-10'>
				<?php echo esc_html( $hero_content['heading'] ) ?>
			</h1>
			<div class='flex flex-wrap'>
				<?php plmt_button( home_url( path: '/contact-us' ), esc_html__( 'Contact Us', 'plmt' ), array(
					'classes' => 'lg:px-[90px] lg:h-[59px]'
				) ) ?>
				<?php plmt_button( '#services', esc_html__( 'Our services', 'plmt' ), array( 'classes' => 'scroll-to lg:px-[90px] lg:h-[59px]', 'variant' =>
					'secondary' ) ) ?>
			</div>
			<div class='mt-6 lg:mt-10 lg:flex justify-between items-center'>
				<div class='flex gap-4 flex-wrap'>
					<?php foreach ( $hero_content['hero_bottom']['partner_icons'] as $icon ) : ?>
						<img src='<?php echo esc_url( $icon['url'] ) ?>' alt='<?php echo esc_attr( $icon['alt'] ) ?>'
							class='w-[150px] h-[62px] object-contain'>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="hidden lg:block lg:w-1/2">
			<img src='<?php echo esc_url( $hero_content['hero_image']['url'] ) ?>'
				alt='<?php echo esc_attr( $hero_content['hero_image']['alt'] ) ?>'>
		</div>
	</div>
</section>