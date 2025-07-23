<?php
$partnership = get_field( 'partnership' );

if ( ! isset( $partnership ) || empty( $partnership ) ) {
	return;
}

?>

<section id='partnership' class='bg-lightGrayBg py-7 lg:py-4 mt-6 lg:mt-[7.5rem]'>
	<div class="">
		<div class='container flex flex-col gap-8 items-center lg:flex-row lg:justify-between lg:gap-[3.375rem]]'>
			<div class=' partnership-content lg:max-w-2xl text-center lg:text-left'>
				<?php if ( $partnership['heading'] ) : ?>
					<h2 class='text-h1Mobile lg:text-h1 mb-4 lg:mb-5'><?php echo esc_html( $partnership['heading'] ) ?></h2>
				<?php endif; ?>
				<?php if ( $partnership['subtext'] ) : ?>
					<p class='text-titleMobile lg:text-title text-darkGray mb-6 lg:mb-7'>
						<?php echo esc_html( $partnership['subtext'] ) ?>
					</p>
				<?php endif; ?>
				<?php if ( $partnership['bottom_text'] ) : ?>
					<p class='text-titleMobile font-bold lg:text-bodyBold text-mainBlack mb-[0.625rem]'>
						<?php echo esc_html( $partnership['bottom_text'] ) ?>
					</p>
				<?php endif; ?>
				<div class='flex justify-center lg:justify-start'>
					<?php plmt_button( esc_url( $partnership['button']['url'] ), esc_attr( $partnership['button']['title'] ), array(
						'classes' => 'w-full justify-center lg:w-auto',
					) ) ?>
				</div>
			</div>
			<div>
				<?php if ( $partnership['image'] ) : ?>
					<img class="w-auto h-full hidden lg:block min-[1440px]:hidden translate-x-[1.25rem]"
						src='<?php echo esc_url( $partnership['image']['url'] ) ?>'
						alt='<?php echo esc_attr( $partnership['image']['alt'] ) ?>'>
				<?php endif; ?>
				<?php if ( $partnership['mobile_image'] ) : ?>
					<img class="w-auto h-full lg:hidden" src='<?php echo esc_url( $partnership['mobile_image']['url'] ) ?>'
						alt='<?php echo esc_attr( $partnership['mobile_image']['alt'] ) ?>'>
				<?php endif; ?>
				<?php if ( $partnership['large_screen_image'] ) : ?>
					<img class="w-auto h-full hidden min-[1440px]:block translate-x-[1.25rem]"
						src='<?php echo esc_url( $partnership['large_screen_image']['url'] ) ?>'
						alt='<?php echo esc_attr( $partnership['large_screen_image']['alt'] ) ?>'>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>