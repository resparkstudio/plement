<?php
$pricing_data            = get_field( 'pricing' );
$package_comparison_data = get_field( 'package_comparison' );

if ( ! isset( $package_comparison_data ) || empty( $package_comparison_data ) ) {
	return;
}

function minimal_package_card( $package ) {
	?>
	<a href="#pricing"
		class="w-1/5 flex items-center gap-[6px] justify-center group text-h5Bold hover:text-accent transition-colors duration-300">
		<?php echo esc_attr( $package['title'] ) ?>
	</a>
	<?php
}

function pricing_accordion_body( $features ) {
	?>
	<div x-show="accordionOpen" x-collapse x-cloak>
		<?php foreach ( $features as $feature ) : ?>
			<div class="grid grid-cols-5 border-b border-lightGray">
				<div class="flex items-center gap-3 p-4">
					<?php if ( isset( $feature['popup_text'] ) && ! empty( $feature['popup_text'] ) ) : ?>
						<div class="relative">
							<div data-tippy-content="<?php echo esc_attr( $feature['popup_text'] ) ?>" class="cursor-pointer">
								<div class="text-bodyBold max-w-[243px] underline"><?php echo esc_html( $feature['title'] ) ?></div>
							</div>
						</div>
					<?php else : ?>
						<div class="font-medium max-w-[243px]"><?php echo esc_html( $feature['title'] ) ?></div>
					<?php endif; ?>
				</div>
				<?php foreach ( $feature['columns'] as $column ) : ?>
					<div class=" justify-self-center flex flex-col gap-2 items-center justify-center p-4">
						<?php if ( $column['included'] ) : ?>
							<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_515_6320)">
									<path fill-rule="evenodd" clip-rule="evenodd"
										d="M16.5551 2.4503C16.8814 2.82141 16.8814 3.42311 16.5551 3.79423L7.39128 14.2217C7.06723 14.5904 6.54254 14.5931 6.21557 14.2277L1.04975 8.45453C0.720691 8.08686 0.715923 7.48513 1.03911 7.11071L1.62431 6.43267C1.9475 6.05826 2.47626 6.05284 2.80534 6.42061L6.79017 10.8739L14.7836 1.77834C15.1097 1.40723 15.6385 1.40722 15.9646 1.77834L16.5551 2.4503Z"
										fill="#ED5623" />
								</g>
								<defs>
									<clipPath id="clip0_515_6320">
										<rect width="16" height="16" fill="white" transform="translate(0.799805)" />
									</clipPath>
								</defs>
							</svg>
						<?php endif; ?>
						<?php if ( isset( $column['note'] ) && ! empty( $column['note'] ) ) : ?>
							<p class="text-accent font-medium text-center">
								<?php echo esc_html( $column['note'] ) ?>
							</p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}

function comparison_footer_rows( $pricing_data, $sow_files ) {

	?>
	<div class="grid grid-cols-5 pt-[2.875rem] pb-4 gap-6">
		<div></div>
		<?php foreach ( $pricing_data['packages'] as $package ) : ?>
			<?php plmt_button( "modalOpen=true", esc_html__( 'Choose ' . $package['title'], 'plmt' ), array(
				"classes" => "pricing-button w-full text-bodyBold h-auto py-5 justify-center hover:text-white hover:bg-mainBlack hover:border-mainBlack",
				"variant" => 'secondary',
				"is_button" => true
			) ) ?>
		<?php endforeach; ?>
	</div>
	<div class="grid grid-cols-5 py-3 border-b border-lightGray last-of-type:border-b-0">
		<div></div>
		<?php foreach ( $sow_files as $file ) : ?>
			<a href="<?php echo esc_url( $file['file']['url'] ) ?>"
				class=" justify-self-center flex gap-2 items-center justify-center text-bodySmall text-darkGray">
				<?php echo esc_html( $file['text'] ) ?>

				<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M7.21875 8.59473L10.5 11.8751L13.7812 8.59473" stroke="#646464" stroke-width="1.5"
						stroke-linecap="round" stroke-linejoin="round" />
					<path d="M10.5 3.125V11.8727" stroke="#646464" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
					<path
						d="M17.375 11.875V16.25C17.375 16.4158 17.3092 16.5747 17.1919 16.6919C17.0747 16.8092 16.9158 16.875 16.75 16.875H4.25C4.08424 16.875 3.92527 16.8092 3.80806 16.6919C3.69085 16.5747 3.625 16.4158 3.625 16.25V11.875"
						stroke="#646464" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>

			</a>
		<?php endforeach; ?>
	</div>

	<?php
}

?>

<div class="container pt-[3.75rem]"
	x-data="{selectedGroup: '<?php echo $package_comparison_data['feature_groups'][0]['title'] ?>'}">
	<h3 class="text-h4Regular mb-10">
		<?php echo esc_html( $package_comparison_data['heading'] ) ?>
	</h3>
	<div class="flex">
		<?php
		foreach ( $package_comparison_data['feature_groups'] as $feature_group ) :
			?>
			<button @click="selectedGroup = '<?php echo $feature_group['title'] ?>'"
				:class="selectedGroup === '<?php echo $feature_group['title'] ?>' ? 'border-b-mainBlack' : 'border-b-textSecondary text-darkGray'"
				class="w-full px-4 pt-6 pb-[0.875rem] border-b-2 hover:text-[#272727] transition-colors ease-in-out">
				<?php echo esc_html( $feature_group['title'] ) ?>
			</button>
		<?php endforeach; ?>
	</div>
	<div class="w-full z-[1]">
		<div class="flex justify-end items-end h-auto bg-white pt-14 pb-9">
			<div class="w-1/5 justify-center text-h5Bold">
				<?php esc_html_e( 'Parameter', 'plmt' ) ?>
			</div>
			<?php foreach ( $pricing_data['packages'] as $package ) :
				minimal_package_card( $package );
			endforeach; ?>
		</div>
	</div>
	<div class="grid grid-cols-5 gap-6 overflow-x-auto">
		<?php
		foreach ( $package_comparison_data['feature_groups'] as $feature_group ) :
			?>
			<div x-show="selectedGroup === '<?php echo $feature_group['title'] ?>'" class="col-span-5"
				x-data="{accordionOpen: true}">
				<?php pricing_accordion_body( $feature_group['features'] ) ?>
			</div>
			<?php
		endforeach; ?>
	</div>


	<?php comparison_footer_rows( $pricing_data, $package_comparison_data['sow_files'] ) ?>

</div>