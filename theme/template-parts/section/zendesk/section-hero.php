<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero'
	class='pt-6 mb-[3.75rem] lg:py-[4.25rem] lg:mb-[8.75rem] flex flex-col bg-mainBlack text-white relative lg:min-h-[calc(100vh-5rem)]'>
	<div class="lg:container mx-auto">
		<div class='flex flex-col gap-4 items-center lg:flex-row lg:justify-between lg:gap-14'>
			<div class='lg:w-1/2 hero-content lg:max-w-2xl px-5 lg:px-0'>
				<?php if ( $hero_content['heading'] ) : ?>
					<h1
						class='text-[3rem] font-semibold lg:text-[5.625rem] lg:font-medium leading-[100%] max-w-[33.125rem] w-full mb-4 lg:mb-6'>
						<?php echo $hero_content['heading'] ?>
					</h1>
				<?php endif; ?>

				<div class='flex'>
					<?php if ( $hero_content['primary_button'] ) : ?>
						<?php plmt_button( esc_url( $hero_content['primary_button']['url'] ), esc_attr( $hero_content['primary_button']['title'] ), array(
							'classes' => 'w-full justify-center lg:w-auto lg:px-[5.625rem] lg:py-5'
						) ) ?>
					<?php endif; ?>
					<?php if ( $hero_content['secondary_button'] ) : ?>
						<?php plmt_button( esc_url( $hero_content['secondary_button']['url'] ), esc_attr( $hero_content['secondary_button']['title'] ), array( 'classes' => 'h-full w-full justify-center lg:w-auto scroll-to lg:px-[5.625rem] lg:py-5', 'variant' =>
							'secondary' ) ) ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="block w-full lg:w-1/2">
				<?php if ( $hero_content['image'] ) : ?>
					<img class="w-auto hidden lg:block absolute top-0 right-0 h-full"
						src='<?php echo esc_url( $hero_content['image']['url'] ) ?>'
						alt='<?php echo esc_attr( $hero_content['image']['alt'] ) ?>'>
				<?php endif; ?>
				<?php if ( $hero_content['mobile_image'] ) : ?>
					<img class="w-full h-auto lg:hidden" src='<?php echo esc_url( $hero_content['mobile_image']['url'] ) ?>'
						alt='<?php echo esc_attr( $hero_content['mobile_image']['alt'] ) ?>'>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>