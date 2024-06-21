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
		class=" first-of-type:rounded-l-[4px] last-of-type:rounded-r-[4px] py-10 last-of-type:pb-0 first-of-type:pt-0 last-of-type:border-b-0 border-b border-b-lightGrayBorder lg:border-b-0 lg:border lg:border-r-grayBorder lg:!p-8 lg:last-of-type:border-r-0">
		<img class="w-[45px] h-[45px] mb-4 lg:w-[50px] lg:h-[50px]"
			src="<?php echo esc_url( $integration['icon']['url'] ) ?>"
			alt="<?php echo esc_url( $integration['icon']['alt'] ) ?>">
		<h4 class="mb-3 text-xl font-medium lg:text-[22px]"><?php echo esc_html( $integration['title'] ) ?></h4>
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
			<p class="font-medium max-w-[343px] text-textGray text-lg mb-6">
				<?php echo esc_html( $integrations_content['bottom']['description'] ) ?>
			</p>
			<a href='<?php echo esc_url( home_url( '/contact-us' ) ) ?>' class='button group'>
				<?php esc_html_e( 'Contact Us', 'plmt' ) ?>
				<div class="z-1 flex justify-center items-center relative overflow-hidden ">
					<div
						class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
							aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
							preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
							<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
						</svg>
					</div>
					<div
						class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
							aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
							preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
							<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
						</svg>
					</div>
				</div>
			</a>
		</div>
	</div>
</section>