<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero' class='pt-6 mb-[3.75rem] lg:py-[4.25rem] lg:mb-[8.75rem] flex flex-col bg-mainBlack text-white'>
	<div class="container mx-auto">
		<div class='flex flex-col gap-12 items-center lg:flex-row lg:justify-between lg:gap-14'>
			<div class='lg:w-1/2 hero-content lg:max-w-2xl'>
				<div class='flex gap-3 flex-wrap mb-6'>
					<?php foreach ( $hero_content['top_icons'] as $icon ) : ?>
						<img src='<?php echo esc_url( $icon['url'] ) ?>' alt='<?php echo esc_attr( $icon['alt'] ) ?>'
							class='h-10 w-auto'>
					<?php endforeach; ?>
				</div>
				<?php if ( $hero_content['heading'] ) : ?>
					<h1 class='text-[5.625rem] font-medium leading-[100%] max-w-[33.125rem] w-full mb-8 lg:mb-6'>
						<?php echo $hero_content['heading'] ?>
					</h1>
				<?php endif; ?>
				<?php if ( $hero_content['subtext'] ) : ?>
					<p class='text-h5Mobile lg:text-h5Regular text-white/80 mb-6 lg:mb-6'>
						<?php echo esc_html( $hero_content['subtext'] ) ?>
					</p>
				<?php endif; ?>
				<div class='flex'>
					<?php plmt_button( home_url( path: '/contact-us' ), esc_html__( 'Contact Us', 'plmt' ), array(
						'classes' => 'w-full justify-center lg:w-auto lg:px-[5.625rem] lg:py-5'
					) ) ?>
					<?php plmt_button( '#services', esc_html__( 'Our services', 'plmt' ), array( 'classes' => 'h-full w-full justify-center lg:w-auto scroll-to lg:px-[5.625rem] lg:py-5', 'variant' =>
						'secondary' ) ) ?>
				</div>
			</div>
			<div class="hidden lg:block lg:w-1/2">
				<img class="w-full" src='<?php echo esc_url( $hero_content['hero_image']['url'] ) ?>'
					alt='<?php echo esc_attr( $hero_content['hero_image']['alt'] ) ?>'>
			</div>
		</div>
	</div>
</section>