<?php

$price = get_field('price');

if ($price && isset($price['hide_section']) && $price['hide_section'] === true) {
	return null;
}

$priced_packages = get_field('priced_packages');

if (!$priced_packages)
	return null;

$packages_count = count($priced_packages['prices_packages_list']);

if (!function_exists('plmt_package_price')) {
	function plmt_package_price($package)
	{
		$price_eur = $package['price_eur'];
		$price_usd = $package['price_usd'];
		?>
		<div x-data="{currency: 'eur'}" class="flex flex-col gap-2 border-l-accent border-l-[3px] pl-6 py-4 mt-6">
			<div class="flex items-center gap-4 flex-wrap">
				<label for="currency" class=" text-[0.875rem] w-max block font-medium lg:text-[1rem]">
					<?php esc_html_e('Display Price in:', 'plmt') ?>
				</label>
				<div
					class="relative max-w-[6.3125rem] grid items-center justify-center w-full h-8 grid-cols-2 bg-[#F3F4F4] select-none">
					<button value="eur" :class="currency==='eur' ? 'text-white' : ''" @click="currency='eur'" type="button"
						class="text-badgesMobile lg:text-badges relative z-20 inline-flex items-center justify-center w-full h-7 px-[10px] transition-all cursor-pointer whitespace-nowrap">
						EUR
					</button>
					<button value="usd" :class="currency==='usd' ? 'text-white' : ''" @click="currency='usd'" type="button"
						class="text-badgesMobile lg:text-badges relative z-20 inline-flex items-center justify-center w-full h-7 px-[10px] transition-all cursor-pointer whitespace-nowrap">
						USD
					</button>
					<div :class="currency==='eur' ? 'left-[2px]' : 'right-[2px]'" x-transition
						class="absolute z-10 w-1/2 h-7 duration-300 ease-out" x-cloak>
						<div class="w-full h-7 bg-accent shadow-sm"></div>
					</div>
				</div>
			</div>
			<div class="text-left text-h4BoldMobile lg:text-h4Bold">
				<span x-show="currency === 'eur'">
					€<?php echo esc_html($price_eur); ?>
				</span>
				<span x-show="currency === 'usd'">
					$<?php echo esc_html($price_usd); ?>
				</span>
			</div>
		</div>
		<?php
	}
}

if (!function_exists('plmt_tabbed_steps_list')) {
	function plmt_tabbed_steps_list($step)
	{
		?>
		<div class="bg-accent/5 w-full px-3 py-4 lg:p-8">
			<?php if ($step['heading']): ?>
				<h3 class="text-h4BoldMobile lg:text-h4Bold text-center mb-6">
					<?php echo esc_html($step['heading']); ?>
				</h3>
			<?php endif; ?>
			<div class="w-full flex flex-col gap-3 lg:gap-8" x-data="{active: 0}">
				<div class="flex flex-col lg:flex-row w-full justify-center">
					<?php foreach ($step['stages'] as $index => $stage): ?>
						<button @click="active = <?php echo esc_attr($index) ?>"
							class="py-3 px-6 border text-[1.125rem] lg:text-[1.25rem]"
							:class="active === <?php echo esc_attr($index) ?> ? 'text-accent border-accent font-bold' : 'text-textSecondary border-textSecondary'">
							<?php echo esc_html($stage['title']); ?>
						</button>
					<?php endforeach; ?>
				</div>
				<div>
					<span class="text-h5Bold">
						<?php echo esc_html($stage['subtitle']); ?>
					</span>
					<?php foreach ($step['stages'] as $index => $stage): ?>
						<ul x-show="active === <?php echo esc_attr($index) ?>" class="list-none mt-4 flex flex-col gap-3 pl-[13px]">
							<?php foreach ($stage['bullet_points'] as $index => $step):
								?>
								<li
									class="relative before:content-[''] before:absolute before:-left-[13px] before:top-1/2 before:-translate-y-1/2 before:w-[6px] before:h-[6px] before:bg-accent before:rounded-full">
									<?php echo esc_html($step['bullet_point']); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
?>

<section id="priced-packages" class="bg-lightGrayBg">
	<?php if ($priced_packages['heading'] || $priced_packages['subtext']): ?>
		<div class="container space-y-4 text-center mb-10 lg:mb-14">
			<?php if ($priced_packages['heading']): ?>
				<h2 class="text-displayLargeMobile lg:text-displayLarge">
					<?php echo $priced_packages['heading'] ?>
				</h2>
			<?php endif; ?>
			<?php if ($priced_packages['subtext']): ?>
				<p class="text-titleMobile text-darkGray lg:text-title">
					<?php echo esc_html($priced_packages['subtext']) ?>
				</p>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php foreach ($priced_packages['prices_packages_list'] as $index => $package):
		$is_even = $index % 2 === 0;
		?>
		<div class="">
			<div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-7 lg:gap-16 lg:items-center">
				<div class="text-center lg:text-left <?php echo $is_even ? 'lg:order-first' : 'lg:order-last'; ?>">
					<?php if ($package['bead']): ?>
						<p
							class="text-badgesMobile lg:text-badges text-accent bg-accent/15 w-fit py-1 px-2 mb-4 lg:mb-6 mx-auto lg:mx-0">
							<?php echo esc_html($package['bead']); ?>
						</p>
					<?php endif; ?>
					<h2 class="mb-4 lg:mb-6 text-h2Mobile lg:text-h2">
						<?php echo esc_html($package['title']); ?>
					</h2>
					<p class="text-darkGray mb-4 lg:mb-6">
						<?php echo esc_html($package['description']); ?>
					</p>
					<?php if ($package['selling_point']): ?>
						<p class="text-h5Mobile lg:text-h5Bold text-accent">
							<?php echo esc_html($package['selling_point']); ?>
						</p>
					<?php endif; ?>
					<?php plmt_package_price($package); ?>

					<div class="hidden lg:block mt-6">
						<?php plmt_button(esc_url($package['button']['url']), esc_html($package['button']['title']), array(
							'classes' => '',
						)) ?>
					</div>
				</div>
				<div class="w-full flex items-center <?php echo $is_even ? 'lg:order-last' : 'lg:order-first'; ?>">
					<?php plmt_tabbed_steps_list($package['includes']); ?>
				</div>
			</div>
			<hr class="bg-lightGray container my-8 lg:my-14" />
		<?php endforeach; ?>
</section>