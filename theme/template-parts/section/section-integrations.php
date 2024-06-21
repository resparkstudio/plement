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
			<h3 class="mb-4"><?php echo esc_html( $integrations_content['bottom']['heading'] ) ?></h3>
			<p class="font-medium max-w-[343px] text-textGray text-lg mb-6">
				<?php echo esc_html( $integrations_content['bottom']['description'] ) ?>
			</p>
			<a href='<?php echo esc_url( home_url( '/contact-us' ) ) ?>' class='button'>
				<?php esc_html_e( 'Contact Us', 'plmt' ) ?>
				<svg xmlns='http://www.w3.org/2000/svg' width='10' height='9' fill='none'
					xmlns:v='https://vecta.io/nano'>
					<path
						d='M1.154.667a.67.67 0 0 0 .667.667h5.06l-5.92 5.92c-.062.062-.111.135-.144.216s-.051.167-.051.254.017.174.051.254.082.154.144.216.135.111.216.144.167.051.254.051.174-.017.254-.051.154-.082.216-.144l5.92-5.92v5.06A.67.67 0 0 0 8.487 8a.67.67 0 0 0 .667-.667V.667A.67.67 0 0 0 8.487 0H1.821a.67.67 0 0 0-.667.667z'
						fill='#fff' />
				</svg>
			</a>
		</div>
	</div>
</section>