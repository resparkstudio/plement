<?php

$price = get_field('price');

if ($price && isset($price['hide_section']) && $price['hide_section'] === true) {
	return null;
}

$priced_packages = get_field('priced_packages');

if (!$priced_packages)
	return null;

?>

<section id="priced-packages">
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
</section>