<?php

$principles_content = get_field( 'principles' );

if ( ! isset( $principles_content ) || empty( $principles_content ) ) {
	return;
}

function partner_cards( $cards ) {
	if ( empty( $cards ) ) {
		return;
	}
	?>
	<ul class="grid grid-cols-1 lg:grid-cols-3 gap-6">
		<?php foreach ( $cards as $card ) : ?>
			<li class="bg-mainBlack p-10 min-h-[16.875rem] lg:min-h-[21.25rem] h-full flex flex-col justify-between">
				<div>
					<img class="w-8 h-8 mb-5 lg:mb-[5.125rem]" src="<?php echo esc_url( $card['image']['url'] ) ?>"
						alt="<?php echo esc_url( $card['image']['alt'] ) ?>">
					<h4 class="text-white text-h5Bold lg:text-h4Bold"><?php echo esc_html( $card['title'] ) ?></h4>
				</div>
				<p class="text-white text-bodyRegular"><?php echo esc_html( $card['description'] ) ?></p>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

?>

<section id="partner" class="pb-20">
	<div class="container">
		<h2 class="text-center text-h4Bold mb-10 lg:text-h2 lg:mb-9">
			<?php echo esc_html( $principles_content['heading'] ) ?>
		</h2>
		<?php isset( $principles_content['principles_list'] ) && partner_cards( $principles_content['principles_list'] ) ?>
	</div>
</section>