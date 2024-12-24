<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero' class='container pt-6 pb-20 lg:pb-[7.5rem] lg:pt-[4.5rem] flex flex-col'>
	<div class='flex flex-col gap-12 items-center lg:flex-row lg:gap-[8.375rem]'>
		<div class='lg:w-1/2 hero-content lg:max-w-2xl'>
			<h1 class='text-h1Mobile max-w-[33.125rem] w-full lg:text-h2 mb-6 lg:pl-10'>
				<?php echo esc_html( $hero_content['heading'] ) ?>
			</h1>
			<div class="border-l-2 pl-4 lg:pl-10 border-l-accent">
				<?php echo $hero_content['description'] ?>
			</div>
			<div class='mt-6 flex justify-between items-center lg:pl-10'>
				<div class='flex gap-8 flex-wrap'>
					<?php foreach ( $hero_content['icons'] as $icon ) : ?>
						<img src='<?php echo esc_url( $icon['url'] ) ?>' alt='<?php echo esc_attr( $icon['alt'] ) ?>'
							class='h-10'>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="hidden lg:block lg:max-w-[16.25rem]">
			<img class="w-full" src='<?php echo esc_url( $hero_content['image']['url'] ) ?>'
				alt='<?php echo esc_attr( $hero_content['image']['alt'] ) ?>'>
		</div>
	</div>
</section>