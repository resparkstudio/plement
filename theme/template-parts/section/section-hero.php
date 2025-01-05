<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero' class='container pt-6 mb-[3.75rem] lg:py-5 lg:mb-[8.75rem] flex flex-col'>
	<div class='flex flex-col gap-12 items-center lg:flex-row lg:justify-between lg:gap-14'>
		<div class='lg:w-1/2 hero-content lg:max-w-2xl'>
			<h1 class='text-h1Mobile max-w-[33.125rem] w-full lg:text-h2 mb-8 lg:mb-10'>
				<?php echo esc_html( $hero_content['heading'] ) ?>
			</h1>
			<div class='flex'>
				<?php plmt_button( home_url( path: '/contact-us' ), esc_html__( 'Contact Us', 'plmt' ), array(
					'classes' => 'w-full justify-center lg:w-auto lg:px-[5.625rem] lg:py-5'
				) ) ?>
				<?php plmt_button( '#services', esc_html__( 'Our services', 'plmt' ), array( 'classes' => 'h-full w-full justify-center lg:w-auto scroll-to lg:px-[5.625rem] lg:py-5', 'variant' =>
					'secondary' ) ) ?>
			</div>
			<div class='mt-6 lg:mt-10 lg:flex justify-between items-center'>
				<div class='flex gap-8 flex-wrap'>
					<?php foreach ( $hero_content['hero_bottom']['partner_icons'] as $icon ) : ?>
						<img src='<?php echo esc_url( $icon['url'] ) ?>' alt='<?php echo esc_attr( $icon['alt'] ) ?>'
							class='h-[3rem]'>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="hidden lg:block lg:w-1/2">
			<img class="w-full" src='<?php echo esc_url( $hero_content['hero_image']['url'] ) ?>'
				alt='<?php echo esc_attr( $hero_content['hero_image']['alt'] ) ?>'>
		</div>
	</div>
</section>