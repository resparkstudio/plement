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
	<ul class="grid grid-cols-1 lg:grid-cols-3 gap-6">
		<?php foreach ( $cards as $card ) : ?>
			<li class="bg-mainBlack p-10 min-h-[17.3125rem] lg:min-h-[21.25rem] h-full flex flex-col justify-between">
				<div>
					<img class="w-[32px] h-[32px] mb-5 lg:mb-10" src="<?php echo esc_url( $card['icon']['url'] ) ?>"
						alt="<?php echo esc_url( $card['icon']['alt'] ) ?>">
					<h4 class="text-white mb-3 text-h5Bold lg:text-h4Bold"><?php echo esc_html( $card['title'] ) ?></h4>
				</div>
				<p class="text-textSecondary text-bodyRegular"><?php echo esc_html( $card['description'] ) ?></p>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

?>

<section id="partner" class="bg-lightGrayBg py-20">
	<div class="container">
		<h2 class="text-center text-h4Bold mb-10 lg:text-[3rem] lg:leading-[3.9rem] lg:font-extrabold lg:mb-20">
			<?php echo esc_html( $partner_content['heading'] ) ?>
		</h2>
		<?php isset( $partner_content['cards'] ) && partner_cards( $partner_content['cards'] ) ?>
	</div>
</section>