<?php
$hero_content = get_field( 'hero' );

if ( ! isset( $hero_content ) || empty( $hero_content ) ) {
	return;
}


?>
<section id='hero' class='container pt-10 pb-8 lg:pb-6 lg:h-[calc(100vh-108px)] flex flex-col justify-between'>
	<div class='flex flex-col gap-12 items-center lg:flex-row lg:gap-14'>
		<div class='hero-content lg:max-w-2xl'>
			<h1 class='text-center mb-8 lg:text-left lg:mb-10'>
				<?php echo esc_html( $hero_content['heading'] ) ?>
			</h1>
			<div class='flex flex-wrap gap-6 justify-center lg:justify-start lg:gap-8'>
				<?php plmt_link_with_arrow( home_url( '/contact-us' ), esc_html__( 'Contact Us', 'plmt' ) ) ?>
				<a href='#services'
					class='button_secondary h-auto py-4'><?php esc_html_e( 'Our services', 'plmt' ) ?></a>
			</div>
		</div>
		<div>
			<img src='<?php echo esc_url( $hero_content['hero_image']['url'] ) ?>'
				alt='<?php echo esc_attr( $hero_content['hero_image']['alt'] ) ?>'>
		</div>
	</div>
	<div class='mt-[60px] lg:flex justify-between items-center'>
		<div class='hidden lg:flex gap-4'>
			<?php foreach ( $hero_content['hero_bottom']['partner_icons'] as $icon ) : ?>
				<img src='<?php echo esc_url( $icon['url'] ) ?>' alt='<?php echo esc_attr( $icon['alt'] ) ?>'
					class='w-[150px] h-[62px] object-contain'>
			<?php endforeach; ?>
		</div>
		<div class='lg:flex'>
			<p class='text-textGray font-medium text-sm max-w-40 text-center mx-auto mb-4 lg:mb-0 lg:mr-4 lg:text-left'>
				<?php echo esc_html( $hero_content['hero_bottom']['company_logos']['text'] ) ?>
			</p>
			<div
				class="relative flex overflow-hidden space-x-4 lg:max-w-xl items-center after:content-[''] after:absolute after:top-0 after:right-0 after:bottom-0 before:z-10 after:block after:bg-gradientRight  before:content-[''] before:absolute before:top-0 before:left-0  before:bottom-0 before:block before:bg-gradientLeft before:w-14 after:w-14">
				<div class='flex space-x-4 animate-loop-scroll items-center'>
					<?php foreach ( $hero_content['hero_bottom']['company_logos']['logos'] as $logo ) : ?>
						<img src='<?php echo esc_url( $logo['url'] ) ?>' alt='<?php echo esc_attr( $logo['alt'] ) ?>'
							class='max-w-none object-contain gs h-[40px]' width='125' height="40">
					<?php endforeach; ?>
				</div>
				<div class='flex space-x-4 animate-loop-scroll items-center' aria-hidden='true'>
					<?php foreach ( $hero_content['hero_bottom']['company_logos']['logos'] as $logo ) : ?>
						<img src='<?php echo esc_url( $logo['url'] ) ?>' alt='<?php echo esc_attr( $logo['alt'] ) ?>'
							class='max-w-none object-contain gs h-[40px]' width='125' height="40">
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>