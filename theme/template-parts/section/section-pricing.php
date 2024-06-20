<?php

$pricing_content = get_field( 'pricing' );

if ( ! isset( $pricing_content ) || empty( $pricing_content ) ) {
	return;
}

function pricing_header( $pricing_content ) {
	?>
	<div class="container relative flex flex-col items-center justify-center text-center mb-8 md:mb-2">
		<h2 class="mb-8 md:mb-12 max-w-[506px]">
			<?php echo esc_html( $pricing_content['heading'] ) ?>
		</h2>
		<div class="flex justify-center max-w-[25rem] m-auto w-full mb-4 md:mb-5">
			<div class="relative flex w-full p-1 bg-white rounded-full">
				<span class="absolute inset-0 m-1 pointer-events-none" aria-hidden="true">
					<span
						class="absolute inset-0 w-1/2 bg-textBlack rounded-full shadow-sm transform transition-transform duration-150 ease-in-out"
						:class="isPackages ? 'translate-x-0' : 'translate-x-full'"></span>
				</span>
				<button class="relative flex-1 h-12 rounded-full font-bold transition-colors duration-150 ease-in-out"
					:class="isPackages ? 'text-white' : 'text-textBlack'" @click="isPackages = true"
					:aria-pressed="isPackages">
					<?php esc_html_e( 'Packages', 'plmt' ) ?>
				</button>
				<button class="relative flex-1 font-bold h-12 rounded-full transition-colors duration-150 ease-in-out w-max"
					:class="isPackages ? 'text-textBlack' : 'text-white'" @click="isPackages = false"
					:aria-pressed="isPackages">
					<?php esc_html_e( 'Stand-Alone Solutions', 'plmt' ) ?>
				</button>
			</div>
		</div>
		<p class="max-w-[30rem] text-[1.125rem] leading-[1.75rem] text-textGray">
			<?php echo esc_html( $pricing_content['description'] ) ?>
		</p>
	</div>
	<?php
}

function currency_switch() {
	?>
	<div class=" w-full  justify-end hidden md:flex md:mb-[62px]">
		<form class="max-w-sm w-full justify-end md:flex items-center gap-2 ">
			<label for="currency"
				class="block text-sm font-medium"><?php esc_html_e( 'Display Price in:', 'plmt' ) ?></label>
			<select id="currency" class="bg-lightGrayBg max-w-20 text-sm rounded-lg block w-full p-2.5">
				<option value="usd" selected>USD</option>
				<option value="eur">EUR</option>
			</select>
		</form>
	</div>
	<?php
}

function package_cards( $packages ) {
	if ( empty( $packages['packages_list'] ) )
		return;
	?>
	<div class="max-w-sm mx-auto grid gap-6 lg:grid-cols-4 items-start lg:max-w-none" x-show="isPackages">
		<?php foreach ( $packages['packages_list'] as $package ) : ?>
			<div class="h-full">
				<div
					class="relative flex flex-col h-full p-6 rounded-[4px] bg-white border border-lightGray <?php echo $package['is_best_value'] ? 'best-value-package' : '' ?>">
					<?php if ( $package['is_best_value'] ) : ?>
						<span
							class="uppercase bg-accent absolute top-4 right-0 px-3 py-2 text-xs rounded-l-[4px] text-white"><?php esc_html_e( 'Best value', 'plmt' ) ?></span>
					<?php endif; ?>
					<div class="mb-9">
						<div class="font-medium text-[1.375rem] leading-7"><?php echo esc_html( $package['title'] ) ?></div>
						<div class="inline-flex items-baseline mb-3">
							<span class="font-medium text-[2rem] leading-[41px]">$</span>
							<span
								class="font-medium text-[2rem] leading-[41px]"><?php echo esc_html( $package['price_usd'] ) ?></span>
						</div>
						<div class="mb-6 text-textGray font-medium"><?php echo esc_html( $package['description'] ) ?></div>
						<a class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-accent px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-accentHover focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150"
							href="#0">
							<?php esc_html_e( 'Choose Package', 'plmt' ) ?>
						</a>
					</div>
					<ul class="text-sm space-y-3 grow">
						<?php foreach ( $package['services'] as $service ) : ?>
							<li class="flex items-center">
								<svg class="w-2 h-2 fill-accent mr-2 shrink-0" viewBox="0 0 12 12"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z" />
								</svg>
								<span class="text-textDarkGray"><?php echo esc_html( $service['title'] ) ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}

function standalone_solution( $standalone_solutions ) {

	if ( empty( $standalone_solutions['standalone_list'] ) )
		return;

	?>

	<ul class="grid grid-cols-4 gap-6" x-show="!isPackages">
		<?php foreach ( $standalone_solutions['standalone_list'] as $solution ) : ?>
			<li>
				<input type="checkbox" id="<?php echo esc_attr( $solution['title'] ) ?>" value="" class="hidden peer"
					required="">
				<label for="<?php echo esc_attr( $solution['title'] ) ?>"
					class="inline-flex items-center justify-between w-full p-5 bg-white border-2 border-lightGrayBorder rounded-2xl cursor-pointer peer-checked:border-textBlack peer-checked:text-gray-600 hover:bg-gray-50 ">
					<div class="block">
						<p class="w-full text-xl font-semibold"><?php echo esc_html( $solution['title'] ) ?></p>
						<div class="inline-flex items-baseline mb-3">
							<span class="font-medium text-[2rem] leading-[41px]">$</span>
							<span
								class="font-medium text-[2rem] leading-[41px]"><?php echo esc_html( $solution['price_usd'] ) ?></span>
						</div>
						<p class="max-w-[30rem] text-[1.125rem] leading-[1.75rem] text-textGray">
							<?php echo esc_html( $solution['description'] ) ?>
						</p>
					</div>
					</la>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

?>
<section id="pricing" class="pb-16 lg:pb-36">
	<div class="relative">
		<div class="container relative flex flex-col justify-center overflow-hidden">
			<div x-data="{ isPackages: true }">
				<?php pricing_header( $pricing_content ) ?>
				<?php currency_switch() ?>
				<?php isset( $pricing_content['packages'] ) ? package_cards( $pricing_content['packages'] ) : ''; ?>
				<?php isset( $pricing_content['standalone_solutions'] ) ? standalone_solution( $pricing_content['standalone_solutions'] ) : ''; ?>
			</div>
		</div>
	</div>
</section>