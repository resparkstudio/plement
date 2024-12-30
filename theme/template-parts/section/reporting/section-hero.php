<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero' class='container pt-6 pb-10 lg:pb-0 lg:pt-20 flex flex-col'>
	<div class='flex flex-col gap-4 lg:items-center lg:flex-row lg:justify-between lg:gap-[6.5625rem]'>
		<div class='w-full'>
			<h1 class='text-h4Bold w-full lg:text-h2'>
				<?php echo $hero_content['heading'] ?>
			</h1>
		</div>
		<div class="ml-auto max-w-[20.0625rem] lg:max-w-[40.25rem] w-full">
			<img src="<?php echo esc_url( $hero_content['image']['url'] ) ?>"
				alt="<?php echo esc_attr( $hero_content['image']['alt'] ) ?>">
		</div>
	</div>
</section>