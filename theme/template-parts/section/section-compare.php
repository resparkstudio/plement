<?php
$compare = get_field( 'compare' );

if ( ! isset( $compare ) || empty( $compare ) ) {
	return;
}

if ( ! function_exists( 'plmt_compare_card' ) ) {
	function plmt_compare_card( $item ) {
		?>
		<div class="p-7 border border-lightGray">
			<div class="flex items-center gap-2 pb-4 border-b border-lightGray">
				<img src="<?php echo esc_url( $item['icon']['url'] ); ?>" alt="<?php echo esc_attr( $item['icon']['alt'] ); ?>">
				<p class="text-h4Bold">
					<?php echo esc_html( $item['title'] ); ?>
				</p>
			</div>
			<div class="mt-4 pb-4 border-b border-lightGray">
				<?php foreach ( $item['bullets'] as $bullet ) : ?>
					<div class="flex items-center gap-2 py-2">
						<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M13.5 5.00024L6.5 11.9999L3 8.50024" stroke="#ED5623" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" />
						</svg>
						<p class="text-bodyRegular text-darkGray">
							<?php echo $bullet['item']; ?>
						</p>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="mt-4">
				<?php if ( $item['tags_heading'] ) : ?>
					<p class="text-h5Bold mb-3">
						<?php echo esc_html( $item['tags_heading'] ); ?>
					</p>
				<?php endif; ?>
				<div class="flex flex-wrap gap-2">
					<?php foreach ( $item['tags'] as $tag ) : ?>
						<span class="inline-block text-accent bg-accent/15 text-bodySmall font-bold py-1 px-2">
							<?php echo esc_html( $tag['tag'] ); ?>
						</span>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'plmt_compare_slider' ) ) {
	function plmt_compare_slider( $items ) {
		?>
		<div class="swiper compare-slider">
			<div class="swiper-wrapper">
				<?php foreach ( $items as $item ) : ?>
					<div class="swiper-slide">
						<?php plmt_compare_card( $item ); ?>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="swiper-pagination !static mt-6"></div>
		</div>
		<?php
	}
}

?>
<section id='compare' class="lg:container mx-auto pt-6 lg:pt-[7.5rem]">
	<div class="bg-lightGrayBg lg:px-[5.1875rem] py-16">
		<?php if ( $compare['heading'] ) : ?>
			<h2 class="text-center text-h1Mobile lg:text-h1 font-bold mb-4 lg:mb-6"><?php echo $compare['heading']; ?></h2>
		<?php endif; ?>
		<?php if ( $compare['subtext'] ) : ?>
			<p class="text-center text-titleMobile lg:text-title mb-4 lg:mb-6 text-darkGray">
				<?php echo esc_html( $compare['subtext'] ); ?>
			</p>
		<?php endif; ?>

		<div class="hidden lg:grid grid-cols-2 gap-[1.875rem]">
			<?php foreach ( $compare['services'] as $item ) : ?>
				<?php plmt_compare_card( $item ); ?>
			<?php endforeach; ?>
		</div>
		<div class="px-6 lg:hidden">
			<?php plmt_compare_slider( $compare['services'] ); ?>
		</div>
		<?php if ( $compare['bottom_button'] ) : ?>
			<div class="mt-6 flex justify-center">
				<?php plmt_button( $compare['bottom_button']['url'], $compare['bottom_button']['title'], array( 'classes' => 'justify-center' ) ) ?>
			</div>
		<?php endif; ?>
	</div>
</section>