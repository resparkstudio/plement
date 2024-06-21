<?php

$partner_content = get_field( 'partner' );

if ( ! isset( $partner_content ) || empty( $partner_content ) ) {
	return;
}

function partner_cards( $cards ) {
	if ( empty( $cards ) ) {
		return;
	}
	?>
	<ul class="grid grid-cols-1 gap-10 lg:grid-cols-3 lg:gap-20">
		<?php foreach ( $cards as $card ) : ?>
			<li>
				<img class="w-[45px] h-[45px] mb-4 lg:w-[50px] lg:h-[50px]" src="<?php echo esc_url( $card['icon']['url'] ) ?>"
					alt="<?php echo esc_url( $card['icon']['alt'] ) ?>">
				<h4 class="mb-3 text-xl font-medium lg:text-[22px]"><?php echo esc_html( $card['title'] ) ?></h4>
				<p class="text-textDarkGray font-medium"><?php echo esc_html( $card['description'] ) ?></p>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

?>

<section id="partner" class="bg-lightGrayBg py-16 lg:py-36">
	<div class="container">
		<h2 class="max-w-lg mb-10 lg:mb-20"><?php echo esc_html( $partner_content['heading'] ) ?></h2>
		<?php isset( $partner_content['cards'] ) && partner_cards( $partner_content['cards'] ) ?>
	</div>
</section>