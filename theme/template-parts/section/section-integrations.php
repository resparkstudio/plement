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
	<div
		class=" first-of-type:rounded-l-[4px] last-of-type:rounded-r-[4px] py-10 last-of-type:pb-0 first-of-type:pt-0 last-of-type:border-b-0 border-b border-b-lightGrayBorder lg:border-b-0 lg:border-r lg:border-r-grayBorder lg:!p-8 lg:last-of-type:border-r-0">
		<img class="w-[40px] h-[40px] mb-4 lg:w-[45px] lg:h-[45px] rounded-md"
			src="<?php echo esc_url( $integration['icon']['url'] ) ?>"
			alt="<?php echo esc_url( $integration['icon']['alt'] ) ?>">
		<h4 class="mb-3 text-xl font-medium lg:text-[22px]"><?php echo esc_html( $integration['title'] ) ?></h4>
		<p class="text-textDarkGray font-medium mb-6"><?php echo esc_html( $integration['description'] ) ?></p>
		<?php if ( isset( $integration['tags'] ) && ! empty( $integration['tags'] ) ) :
			plmt_tag_chips( $integration['tags'] );
		endif; ?>
	</div>
	<?php
}

?>

<section id="integrations" class="bg-lightGrayBg py-16 lg:py-36">
	<div class="container">
		<h2 class="max-w-md mb-12 lg:mb-20"><?php echo esc_html( $integrations_content['heading'] ) ?></h2>

		<div class="mb-[72px] grid grid-cols-1 lg:border lg:border-grayBorder rounded-[4px] lg:grid-cols-3">
			<?php
			if ( isset( $integrations_content['integrations_list'] ) ) :
				foreach ( $integrations_content['integrations_list'] as $integration ) :
					integration_card( $integration );
				endforeach;
			endif;
			?>
		</div>

		<div class="flex items-center flex-col text-center w-full">
			<h3 class="mb-3 lg:mb-4"><?php echo esc_html( $integrations_content['bottom']['heading'] ) ?></h3>
			<p class="font-medium max-w-[415px] text-textGray text-lg mb-6">
				<?php echo esc_html( $integrations_content['bottom']['description'] ) ?>
			</p>
			<?php plmt_icon_button( home_url( '/contact-us' ), esc_html__( 'Contact Us', 'plmt' ), array(
				'classes' => 'h-[48px]'
			) ) ?>
		</div>
	</div>
</section>