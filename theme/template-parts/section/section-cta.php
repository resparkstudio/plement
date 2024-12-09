<?php

$cta_content = get_field( 'cta' );

if ( empty( $cta_content ) ) {
	return;
}
?>

<section id="cta" class="bg-lightGrayBg mt-20 mb-[9.75rem] pt-20 lg:mt-0 lg:mb-20 lg:py-[7.5rem]">
	<div class="container flex flex-col lg:flex-row relative">
		<div class="max-w-[35.4375rem]">
			<h2 class="text-h4Bold lg:text-h2 mb-6">
				<?php echo esc_html( $cta_content['title'] ); ?>
			</h2>
			<div class="mb-6 text-darkGray text-title">
				<?php echo $cta_content['description'] ?>
			</div>
			<?php plmt_button( $cta_content['link']['url'], $cta_content['link']['title'], array(
				"classes" => "w-full justify-center lg:w-auto",
			) ) ?>
		</div>
		<div class="h-[16.875rem]">
			<img class="max-h-[16.875rem] absolute right-0 -bottom-20 lg:max-h-[22rem] xl:max-h-[30rem] lg:top-1/2 lg:-translate-y-1/2"
				src="<?php echo esc_url( $cta_content['image']['url'] ) ?>"
				alt="<?php echo esc_attr( $cta_content['image']['alt'] ) ?>">
		</div>
	</div>

</section>