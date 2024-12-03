<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero' class='container pt-6 pb-[5.5rem] lg:pt-[3.75rem] lg:pb-[7.5rem] flex flex-col'>
	<div class='flex flex-col gap-12 items-center lg:flex-row lg:justify-center lg:gap-[3.75rem]'>
		<div class="hidden lg:block">
			<img class="w-full max-w-[26.125rem]" src='<?php echo esc_url( $hero_content['image']['url'] ) ?>'
				alt='<?php echo esc_attr( $hero_content['image']['alt'] ) ?>'>
		</div>
		<div class='hero-content lg:max-w-[31.625rem]'>
			<h1 class='text-h1Mobile w-full lg:text-h2 lg:text-center mb-4 lg:mb-[2.125rem]'>
				<?php esc_html_e( $hero_content['heading'] ) ?>
			</h1>
			<p
				class='text-darkGray mb-6 lg:text-mainBlack lg:text-h5Regular lg:max-w-[22.9375rem] lg:mx-auto lg:text-center'>
				<?php esc_html_e( $hero_content['description'] ) ?>
			</p>
			<div class="lg:max-w-[22.9375rem] lg:mx-auto">
				<p class="text-center text-darkGray text-bodySmall mb-2 lg:text-bodyRegular">
					<?php esc_html_e( $hero_content['price'] ) ?>
				</p>
				<div class='flex flex-wrap'>
					<?php plmt_button( $hero_content['link']['url'], $hero_content['link']['title'], array(
						'classes' => 'w-full justify-center px-[3.75rem]',
					) ) ?>
				</div>
			</div>
		</div>
	</div>
</section>