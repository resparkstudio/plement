<?php
$license = get_field('license');

if (!isset($license) || empty($license)) {
	return;
}

?>
<section id='license'
	class="container overflow-x-hidden lg:overflow-x-visible mx-auto relative py-7 lg:py-20 mt-6 lg:mt-[7.5rem] gap-[9.1875rem] justify-center flex items-center">
	<div class="w-full">
		<?php if ($license['heading']): ?>
			<h2 class="text-h2Mobile lg:text-h1 font-bold mb-4 lg:mb-6"><?php echo esc_html($license['heading']); ?></h2>
		<?php endif; ?>
		<?php if ($license['subtext']): ?>
			<p class="text-titleMobile lg:text-title text-darkGray">
				<?php echo esc_html($license['subtext']); ?>
			</p>
		<?php endif; ?>
		<?php if ($license['badges']): ?>
			<div class="flex flex-wrap gap-2 md:gap-3 mt-6">
				<?php foreach ($license['badges'] as $index => $badge): ?>
					<img class="w-auto <?php echo $index === 2 ? 'h-[2.8125rem] md:h-[5rem]' : 'h-[2.125rem] md:h-[3.25rem] '; ?>"
						src="<?php echo esc_url($badge['url']) ?>" alt="<?php echo esc_attr($badge['alt']) ?>">
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<?php if ($license['image']): ?>
		<div class="absolute -right-16 max-w-[14.75rem] lg:max-w-[28rem] w-full">
			<img class="w-full" src="<?php echo esc_url($license['image']['url']); ?>"
				alt="<?php echo esc_attr($license['image']['alt']); ?>">
		</div>
	<?php endif; ?>
</section>