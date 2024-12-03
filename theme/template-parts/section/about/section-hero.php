<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero' class='container pt-6 pb-20 lg:pt-[3.9375rem] lg:pb-[7.5rem] flex flex-col'>
	<div class='flex flex-col-reverse gap-4 lg:items-center lg:flex-row lg:justify-between lg:gap-14'>
		<div class='max-w-[12.375rem] ml-auto lg:w-1/2 hero-content lg:max-w-none'>
			<img class="lg:max-w-[22.6875rem]" src="<?php echo esc_url( $hero_content['image']['url'] ) ?> "
				alt="<?php esc_attr_e( $hero_content['image']['alt'] ) ?>">
		</div>
		<div class="lg:w-full max-w-[43.5rem]">
			<h1 class='text-h1Mobile w-full mb-6 lg:text-h1 lg:mb-9'>
				<?php echo esc_html( $hero_content['heading'] ) ?>
			</h1>
			<p class="border-l-2 border-l-accent pl-4 lg:pl-10">
				<?php echo esc_html( $hero_content['description'] ) ?>
			</p>
		</div>
	</div>
</section>