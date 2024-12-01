<?php

$integrations_content = get_field( 'integrations' );

if ( ! isset( $integrations_content ) || empty( $integrations_content ) ) {
	return;
}

function integration_cards( $cards ) {
	if ( empty( $cards ) ) {
		return;
	}
	?>
	<ul class="grid grid-cols-1 lg:grid-cols-3 gap-6">
		<?php foreach ( $cards as $card ) : ?>
			<li class="bg-mainBlack p-10 h-full flex flex-col justify-between min-h-[23.5rem] lg:gap-[1.8125rem]">
				<div>
					<img class="w-8 h-8 mb-6" src="<?php echo esc_url( $card['image']['url'] ) ?>"
						alt="<?php echo esc_url( $card['image']['alt'] ) ?>">
					<h4 class="text-white mb-4 text-h5Bold lg:text-h4Regular"><?php echo esc_html( $card['title'] ) ?></h4>
					<p class="text-white"><?php echo esc_html( $card['description'] ) ?></p>
				</div>
				<?php if ( isset( $card['chips'] ) && ! empty( $card['chips'] ) ) :
					plmt_tag_chips( $card['chips'] );
				endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

?>

<section id="integrations" class="py-20">
	<div class="lg:container lg:mx-auto">
		<h2 class="text-center text-h4Bold mb-10 lg:text-h3 lg:mb-[3.75rem]">
			<?php echo esc_html( $integrations_content['heading'] ) ?>
		</h2>
		<?php isset( $integrations_content['integrations_list'] ) && integration_cards( $integrations_content['integrations_list'] ) ?>
	</div>
</section>