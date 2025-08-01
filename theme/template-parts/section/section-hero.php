<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero'
	class='py-16 mb-6 lg:py-[4.25rem] lg:mb-[7.5rem] flex flex-col bg-mainBlack text-white relative lg:min-h-[calc(100vh-5rem)]'>
	<div class="lg:container mx-auto lg:my-auto">
		<div class='flex flex-col gap-4 items-center lg:flex-row lg:justify-between lg:gap-14'>
			<div class='hero-content w-full px-5 lg:px-0 z-10'>
				<div class='flex gap-3 flex-wrap mb-6'>
					<?php foreach ( $hero_content['top_icons'] as $icon ) : ?>
						<img src='<?php echo esc_url( $icon['url'] ) ?>' alt='<?php echo esc_attr( $icon['alt'] ) ?>'
							class='h-10 lg:h-[3.5rem] w-auto'>
					<?php endforeach; ?>
				</div>
				<?php if ( $hero_content['heading'] ) : ?>
					<h1
						class='text-[3rem] font-semibold lg:text-[5.625rem] lg:font-medium leading-[100%] max-w-[48.125rem] w-full mb-4 lg:mb-6'>
						<?php echo $hero_content['heading'] ?>
					</h1>
				<?php endif; ?>
				<?php if ( $hero_content['subtext'] ) : ?>
					<p class='text-titleMobile lg:text-h5Regular text-white/80 mb-4 lg:mb-6'>
						<?php echo esc_html( $hero_content['subtext'] ) ?>
					</p>
				<?php endif; ?>
				<div class='flex'>
					<?php plmt_button( home_url( path: '/contact-us' ), esc_html__( 'Contact Us', 'plmt' ), array(
						'classes' => 'w-full justify-center lg:w-auto lg:px-[5.625rem] lg:py-5'
					) ) ?>
					<?php plmt_button( '#services', esc_html__( 'Our services', 'plmt' ), array( 'classes' => 'h-full w-full justify-center lg:w-auto scroll-to lg:px-[5.625rem] lg:py-5 text-white border-darkGray2 !bg-darkGray2', 'variant' =>
						'secondary' ) ) ?>
				</div>
			</div>
			<div class="block w-full lg:w-1/2">
				<?php if ( $hero_content['hero_image'] ) : ?>
					<img class="w-auto hidden lg:block absolute top-0 right-0 h-full"
						src='<?php echo esc_url( $hero_content['hero_image']['url'] ) ?>'
						alt='<?php echo esc_attr( $hero_content['hero_image']['alt'] ) ?>'>
				<?php endif; ?>

			</div>
		</div>
	</div>
</section>