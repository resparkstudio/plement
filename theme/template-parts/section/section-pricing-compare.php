<?php
$pricing_data            = get_field( 'pricing' );
$package_comparison_data = get_field( 'package_comparison' );

if ( ! isset( $package_comparison_data ) || empty( $package_comparison_data ) ) {
	return;
}

function minimal_package_card( $package ) {
	?>
	<div
		class="p-4 rounded-[4px] border border-lightGrayBorder relative <?php echo $package['is_best_value'] ? 'best-value-minimal-package' : '' ?>">
		<?php if ( $package['is_best_value'] ) : ?>
			<span
				class="uppercase bg-accent absolute top-0 right-0 px-3 py-2 text-xs rounded-l-[4px] text-white font-bold"><?php esc_html_e( 'Best value', 'plmt' ) ?></span>
		<?php endif; ?>
		<span class="text-lg font-medium"><?php echo esc_html( $package['title'] ) ?></span>
		<div class="mb-2 flex items-center">
			<span class="font-medium text-[1.375rem] leading-[28px]" x-html="currency === 'usd' ? '$' : '€'"></span>
			<span class="font-medium text-[1.375rem] leading-[28px]"
				x-html="currency === 'usd' ? '<?php echo esc_html( $package['price_usd'] ) ?>' : '<?php echo esc_html( $package['price_eur'] ) ?>'"></span>
		</div>
		<p class="mb-4 text-sm font-medium text-textGray"><?php echo esc_html( $package['description'] ) ?></p>
		<button @click="modalOpen=true" value="<?php echo esc_attr( $package['title'] ) ?>"
			class="pricing-button w-full justify-center group <?php echo $package['is_best_value'] ? 'button' : 'button_outlined' ?>">Choose
			Package
			<div class="z-1 flex justify-center items-center relative overflow-hidden ">
				<div
					class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
						role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
						preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
						<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
					</svg>
				</div>
				<div
					class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
						role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
						preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
						<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
					</svg>
				</div>
			</div>
		</button>
	</div>
	<?php
}

function pricing_accordion_head( $feature_group ) {
	?>
	<button @click="accordionOpen=!accordionOpen"
		class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline bg-lightGrayBg rounded-[4px] text-lg font-medium">
		<span><?php echo esc_html( $feature_group['title'] ) ?></span>
		<svg class="w-[26px] h-[26px] duration-200 ease-out" :class="{ 'rotate-180': accordionOpen }" viewBox="0 0 24 24"
			xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
			stroke-linejoin="round">
			<polyline points="6 9 12 15 18 9"></polyline>
		</svg>

	</button>
	<?php
}

function pricing_accordion_body( $features ) {
	?>
	<div x-show="accordionOpen" x-collapse x-cloak>
		<?php foreach ( $features as $feature ) : ?>
			<div class="grid grid-cols-5 p-4 border-b border-lightGray">
				<div class="flex items-center gap-3">
					<div class="font-medium max-w-[243px]"><?php echo esc_html( $feature['title'] ) ?></div>
					<?php if ( isset( $feature['popup_text'] ) && ! empty( $feature['popup_text'] ) ) : ?>
						<div x-data="{
						tooltipVisible: false,
						tooltipText: '<?php echo esc_html( $feature['popup_text'] ) ?>',
						tooltipArrow: true,
						tooltipPosition: 'top',
					}" x-init="$refs.content.addEventListener('mouseenter', () => { tooltipVisible = true; }); $refs.content.addEventListener('mouseleave', () => { tooltipVisible = false; });"
							class="relative">
							<div x-ref="tooltip" x-show="tooltipVisible"
								:class="{ 'top-0 left-1/2 -translate-x-1/2 -mt-0.5 -translate-y-full' : tooltipPosition == 'top', 'top-1/2 -translate-y-1/2 -ml-0.5 left-0 -translate-x-full' : tooltipPosition == 'left', 'bottom-0 left-1/2 -translate-x-1/2 -mb-0.5 translate-y-full' : tooltipPosition == 'bottom', 'top-1/2 -translate-y-1/2 -mr-0.5 right-0 translate-x-full' : tooltipPosition == 'right' }"
								class="absolute w-auto text-sm" x-cloak>
								<div x-show="tooltipVisible" x-transition
									class="relative px-2 py-1 text-textBlack bg-white rounded">
									<p x-text="tooltipText" class="flex-shrink-0 block text-sm whitespace-nowrap"></p>
									<div x-ref="tooltipArrow" x-show="tooltipArrow"
										:class="{ 'bottom-0 -translate-x-1/2 left-1/2 w-2.5 translate-y-full' : tooltipPosition == 'top', 'right-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px translate-x-full' : tooltipPosition == 'left', 'top-0 -translate-x-1/2 left-1/2 w-2.5 -translate-y-full' : tooltipPosition == 'bottom', 'left-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px -translate-x-full' : tooltipPosition == 'right' }"
										class="absolute inline-flex items-center justify-center overflow-hidden">
										<div :class="{ 'origin-top-left -rotate-45' : tooltipPosition == 'top', 'origin-top-left rotate-45' : tooltipPosition == 'left', 'origin-bottom-left rotate-45' : tooltipPosition == 'bottom', 'origin-top-right -rotate-45' : tooltipPosition == 'right' }"
											class="w-1.5 h-1.5 transform bg-white"></div>
									</div>
								</div>
							</div>
							<div x-ref="content" class="cursor-pointer">
								<svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd"
										d="M8.5 16.5C12.6421 16.5 16 13.1421 16 9C16 4.85786 12.6421 1.5 8.5 1.5C4.35786 1.5 1 4.85786 1 9C1 13.1421 4.35786 16.5 8.5 16.5ZM8.5 17.5C13.1944 17.5 17 13.6944 17 9C17 4.30558 13.1944 0.5 8.5 0.5C3.80558 0.5 0 4.30558 0 9C0 13.6944 3.80558 17.5 8.5 17.5Z"
										fill="#272727" />
									<path
										d="M6.30273 5.66991C6.42673 5.55391 6.56273 5.44391 6.71073 5.33991C6.86273 5.23591 7.02673 5.14391 7.20273 5.06391C7.38273 4.98391 7.57473 4.92191 7.77873 4.87791C7.98673 4.82991 8.21073 4.80591 8.45073 4.80591C8.76673 4.80591 9.05873 4.85191 9.32673 4.94391C9.59873 5.03591 9.83273 5.16591 10.0287 5.33391C10.2247 5.50191 10.3787 5.70591 10.4907 5.94591C10.6027 6.18591 10.6587 6.45591 10.6587 6.75591C10.6587 7.05991 10.6127 7.32191 10.5207 7.54191C10.4327 7.76191 10.3187 7.95591 10.1787 8.12391C10.0427 8.28791 9.89273 8.43191 9.72873 8.55591C9.56873 8.67591 9.41673 8.78991 9.27273 8.89791C9.12873 9.00591 9.00473 9.11391 8.90073 9.22191C8.80073 9.32991 8.74273 9.44991 8.72673 9.58191L8.61873 10.4999H7.88673L7.81473 9.50391C7.79873 9.32391 7.83273 9.16791 7.91673 9.03591C8.00073 8.89991 8.11073 8.77391 8.24673 8.65791C8.38273 8.53791 8.53273 8.42191 8.69673 8.30991C8.86073 8.19391 9.01273 8.06591 9.15273 7.92591C9.29673 7.78591 9.41673 7.62791 9.51273 7.45191C9.60873 7.27191 9.65673 7.05791 9.65673 6.80991C9.65673 6.63791 9.62273 6.48191 9.55473 6.34191C9.48673 6.20191 9.39473 6.08391 9.27873 5.98791C9.16273 5.88791 9.02473 5.81191 8.86473 5.75991C8.70873 5.70791 8.54073 5.68191 8.36073 5.68191C8.11673 5.68191 7.90673 5.71191 7.73073 5.77191C7.55873 5.83191 7.41273 5.89791 7.29273 5.96991C7.17273 6.04191 7.07473 6.10791 6.99873 6.16791C6.92673 6.22791 6.86673 6.25791 6.81873 6.25791C6.71873 6.25791 6.64073 6.21191 6.58473 6.11991L6.30273 5.66991ZM7.47273 12.8399C7.47273 12.7359 7.49073 12.6379 7.52673 12.5459C7.56673 12.4539 7.61873 12.3739 7.68273 12.3059C7.75073 12.2379 7.83073 12.1839 7.92273 12.1439C8.01473 12.1039 8.11273 12.0839 8.21673 12.0839C8.32073 12.0839 8.41873 12.1039 8.51073 12.1439C8.60273 12.1839 8.68273 12.2379 8.75073 12.3059C8.81873 12.3739 8.87274 12.4539 8.91273 12.5459C8.95273 12.6379 8.97273 12.7359 8.97273 12.8399C8.97273 12.9479 8.95273 13.0479 8.91273 13.1399C8.87274 13.2279 8.81873 13.3059 8.75073 13.3739C8.68273 13.4419 8.60273 13.4939 8.51073 13.5299C8.41873 13.5699 8.32073 13.5899 8.21673 13.5899C8.11273 13.5899 8.01473 13.5699 7.92273 13.5299C7.83073 13.4939 7.75073 13.4419 7.68273 13.3739C7.61873 13.3059 7.56673 13.2279 7.52673 13.1399C7.49073 13.0479 7.47273 12.9479 7.47273 12.8399Z"
										fill="#272727" />
								</svg>
							</div>

						</div>
					<?php endif; ?>
				</div>
				<?php foreach ( $feature['columns'] as $column ) : ?>
					<div class=" justify-self-center flex flex-col gap-2 items-center justify-center">
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
							<p class="text-accent font-medium">
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

function comparison_footer_rows( $footer_rows ) {
	?>
	<div class="border-t border-t-lightGray">

		<?php foreach ( $footer_rows as $footer_row ) : ?>
			<div class="grid grid-cols-5 p-4 border-b border-lightGray last-of-type:border-b-0">
				<div class="flex items-center gap-3">
					<div class="font-medium"><?php echo esc_html( $footer_row['title'] ) ?></div>
					<?php if ( isset( $footer_row['popup_text'] ) && ! empty( $footer_row['popup_text'] ) ) : ?>
						<div x-data="{
							tooltipVisible: false,
							tooltipText: '<?php echo esc_html( $footer_row['popup_text'] ) ?>',
							tooltipArrow: true,
							tooltipPosition: 'top',
					}" x-init="$refs.content.addEventListener('mouseenter', () => { tooltipVisible = true; }); $refs.content.addEventListener('mouseleave', () => { tooltipVisible = false; });"
							class="relative">
							<div x-ref="tooltip" x-show="tooltipVisible"
								:class="{ 'top-0 left-1/2 -translate-x-1/2 -mt-0.5 -translate-y-full' : tooltipPosition == 'top', 'top-1/2 -translate-y-1/2 -ml-0.5 left-0 -translate-x-full' : tooltipPosition == 'left', 'bottom-0 left-1/2 -translate-x-1/2 -mb-0.5 translate-y-full' : tooltipPosition == 'bottom', 'top-1/2 -translate-y-1/2 -mr-0.5 right-0 translate-x-full' : tooltipPosition == 'right' }"
								class="absolute w-auto text-sm" x-cloak>
								<div x-show="tooltipVisible" x-transition
									class="relative px-2 py-1 text-textBlack bg-white rounded">
									<p x-text="tooltipText" class="flex-shrink-0 block text-sm whitespace-nowrap"></p>
									<div x-ref="tooltipArrow" x-show="tooltipArrow"
										:class="{ 'bottom-0 -translate-x-1/2 left-1/2 w-2.5 translate-y-full' : tooltipPosition == 'top', 'right-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px translate-x-full' : tooltipPosition == 'left', 'top-0 -translate-x-1/2 left-1/2 w-2.5 -translate-y-full' : tooltipPosition == 'bottom', 'left-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px -translate-x-full' : tooltipPosition == 'right' }"
										class="absolute inline-flex items-center justify-center overflow-hidden">
										<div :class="{ 'origin-top-left -rotate-45' : tooltipPosition == 'top', 'origin-top-left rotate-45' : tooltipPosition == 'left', 'origin-bottom-left rotate-45' : tooltipPosition == 'bottom', 'origin-top-right -rotate-45' : tooltipPosition == 'right' }"
											class="w-1.5 h-1.5 transform bg-white"></div>
									</div>
								</div>
							</div>
							<div x-ref="content" class="cursor-pointer">
								<svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd"
										d="M8.5 16.5C12.6421 16.5 16 13.1421 16 9C16 4.85786 12.6421 1.5 8.5 1.5C4.35786 1.5 1 4.85786 1 9C1 13.1421 4.35786 16.5 8.5 16.5ZM8.5 17.5C13.1944 17.5 17 13.6944 17 9C17 4.30558 13.1944 0.5 8.5 0.5C3.80558 0.5 0 4.30558 0 9C0 13.6944 3.80558 17.5 8.5 17.5Z"
										fill="#272727" />
									<path
										d="M6.30273 5.66991C6.42673 5.55391 6.56273 5.44391 6.71073 5.33991C6.86273 5.23591 7.02673 5.14391 7.20273 5.06391C7.38273 4.98391 7.57473 4.92191 7.77873 4.87791C7.98673 4.82991 8.21073 4.80591 8.45073 4.80591C8.76673 4.80591 9.05873 4.85191 9.32673 4.94391C9.59873 5.03591 9.83273 5.16591 10.0287 5.33391C10.2247 5.50191 10.3787 5.70591 10.4907 5.94591C10.6027 6.18591 10.6587 6.45591 10.6587 6.75591C10.6587 7.05991 10.6127 7.32191 10.5207 7.54191C10.4327 7.76191 10.3187 7.95591 10.1787 8.12391C10.0427 8.28791 9.89273 8.43191 9.72873 8.55591C9.56873 8.67591 9.41673 8.78991 9.27273 8.89791C9.12873 9.00591 9.00473 9.11391 8.90073 9.22191C8.80073 9.32991 8.74273 9.44991 8.72673 9.58191L8.61873 10.4999H7.88673L7.81473 9.50391C7.79873 9.32391 7.83273 9.16791 7.91673 9.03591C8.00073 8.89991 8.11073 8.77391 8.24673 8.65791C8.38273 8.53791 8.53273 8.42191 8.69673 8.30991C8.86073 8.19391 9.01273 8.06591 9.15273 7.92591C9.29673 7.78591 9.41673 7.62791 9.51273 7.45191C9.60873 7.27191 9.65673 7.05791 9.65673 6.80991C9.65673 6.63791 9.62273 6.48191 9.55473 6.34191C9.48673 6.20191 9.39473 6.08391 9.27873 5.98791C9.16273 5.88791 9.02473 5.81191 8.86473 5.75991C8.70873 5.70791 8.54073 5.68191 8.36073 5.68191C8.11673 5.68191 7.90673 5.71191 7.73073 5.77191C7.55873 5.83191 7.41273 5.89791 7.29273 5.96991C7.17273 6.04191 7.07473 6.10791 6.99873 6.16791C6.92673 6.22791 6.86673 6.25791 6.81873 6.25791C6.71873 6.25791 6.64073 6.21191 6.58473 6.11991L6.30273 5.66991ZM7.47273 12.8399C7.47273 12.7359 7.49073 12.6379 7.52673 12.5459C7.56673 12.4539 7.61873 12.3739 7.68273 12.3059C7.75073 12.2379 7.83073 12.1839 7.92273 12.1439C8.01473 12.1039 8.11273 12.0839 8.21673 12.0839C8.32073 12.0839 8.41873 12.1039 8.51073 12.1439C8.60273 12.1839 8.68273 12.2379 8.75073 12.3059C8.81873 12.3739 8.87274 12.4539 8.91273 12.5459C8.95273 12.6379 8.97273 12.7359 8.97273 12.8399C8.97273 12.9479 8.95273 13.0479 8.91273 13.1399C8.87274 13.2279 8.81873 13.3059 8.75073 13.3739C8.68273 13.4419 8.60273 13.4939 8.51073 13.5299C8.41873 13.5699 8.32073 13.5899 8.21673 13.5899C8.11273 13.5899 8.01473 13.5699 7.92273 13.5299C7.83073 13.4939 7.75073 13.4419 7.68273 13.3739C7.61873 13.3059 7.56673 13.2279 7.52673 13.1399C7.49073 13.0479 7.47273 12.9479 7.47273 12.8399Z"
										fill="#272727" />
								</svg>
							</div>

						</div>
					<?php endif; ?>
				</div>
				<?php foreach ( $footer_row['columns'] as $column ) : ?>
					<div class=" justify-self-center flex flex-col gap-2 items-center justify-center">
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
							<p class="text-accent font-medium">
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

?>

<div class="container pt-16 lg:pt-36">
	<div class="grid grid-cols-5 gap-6 overflow-x-auto">
		<h2>
			Compare Packages
		</h2>
		<?php foreach ( $pricing_data['packages']['packages_list'] as $package ) :
			minimal_package_card( $package );
		endforeach; ?>
		<?php
		$index = 0;
		foreach ( $package_comparison_data['feature_groups'] as $feature_group ) :
			?>
			<div class="col-span-5" x-data="{accordionOpen: <?php echo $index === 0 ? "true" : "false" ?>}">
				<?php pricing_accordion_head( $feature_group ) ?>
				<?php pricing_accordion_body( $feature_group['features'] ) ?>
			</div>
			<?php
			$index++;
		endforeach; ?>
		<div class="col-span-5">
			<?php comparison_footer_rows( $package_comparison_data['footer_rows'] ) ?>
		</div>

	</div>
</div>