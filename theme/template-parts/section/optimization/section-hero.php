<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero' class='container pt-6 pb-20 lg:pb-[10.875rem] lg:pt-[6.25rem] flex flex-col'>
	<div class='flex flex-col gap-6 items-center lg:flex-row lg:justify-between lg:gap-14'>
		<div class='lg:w-1/2 hero-content lg:max-w-2xl'>
			<h1 class='text-h1Mobile w-full lg:text-h2'>
				<?php echo esc_html( $hero_content['heading'] ) ?>
			</h1>
		</div>
		<div class="lg:w-1/2 border-l-2 border-l-accent pl-4 lg:pl-[2.375rem]">
			<p>
				<?php echo esc_html( $hero_content['description'] ) ?>
			</p>
		</div>
	</div>
</section>