<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero' class='container pt-6 pb-[8.25rem] lg:pb-[60px]'>
	<div class='flex flex-col gap-14 items-center lg:flex-row lg:justify-between lg:gap-14'>
		<div class='lg:w-1/2 hero-content lg:max-w-2xl'>
			<h1 class='text-h1Mobile w-full lg:text-h2 mb-4'>
				<?php echo esc_html( $hero_content['heading'] ) ?>
			</h1>
			<p class='text-darkGray mb-6 lg:text-mainBlack lg:text-h5Regular lg:mb-8'>
				<?php echo esc_html( $hero_content['description'] ) ?>
			</p>
			<div class='flex flex-wrap'>
				<?php plmt_button( $hero_content['link']['url'], $hero_content['link']['title'], array(
					'classes' => 'w-full justify-center lg:w-auto px-[3.75rem]',
				) ) ?>
			</div>
		</div>
		<div class="hidden lg:block lg:w-1/2">
			<img class="w-full max-w-[32rem]" src='<?php echo esc_url( $hero_content['image']['url'] ) ?>'
				alt='<?php echo esc_attr( $hero_content['image']['alt'] ) ?>'>
		</div>
	</div>
</section>