<?php

$integrations_content = get_field( 'integrations' );

if ( ! isset( $integrations_content ) || empty( $integrations_content ) ) {
	return;
}

function integration_card( $integration ) {
	if ( empty( $integration ) ) {
		return;
	}
	?>
	<div class="border border-r-grayBorder p-8 lg:last-of-type:border-r-0">
		<img class="w-[45px] h-[45px] mb-4 lg:w-[50px] lg:h-[50px]"
			src="<?php echo esc_url( $integration['icon']['url'] ) ?>"
			alt="<?php echo esc_url( $integration['icon']['alt'] ) ?>">
		<h4 class="mb-4 text-xl font-medium lg:text-[22px] lg:mb-6"><?php echo esc_html( $integration['title'] ) ?></h4>
		<p class="text-textDarkGray font-medium mb-6"><?php echo esc_html( $integration['description'] ) ?></p>
		<div>
			<?php foreach ( $integration['tags'] as $tag ) : ?>
				<span
					class="mr-3 mb-3 text-sm px-4 py-[10px] font-medium rounded-full border border-textBlack inline-block"><?php echo esc_html( $tag['title'] ) ?></span>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

?>

<section id="integrations" class="bg-lightGrayBg py-16 lg:py-36">
	<div class="container">
		<h2 class="max-w-md mb-12 lg:mb-20"><?php echo esc_html( $integrations_content['heading'] ) ?></h2>

		<div class="grid grid-cols-1 border border-grayBorder rounded-[4px] lg:grid-cols-3">
			<?php
			if ( isset( $integrations_content['integrations_list'] ) ) :
				foreach ( $integrations_content['integrations_list'] as $integration ) :
					integration_card( $integration );
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>