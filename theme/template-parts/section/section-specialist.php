<?php
$specialist = get_field('specialist');

if (empty($specialist)) {
	return;
}

function plmt_specialist_card($card)
{
	if (empty($card)) {
		return;
	}
	?>
	<div class="bg-white border border-lightGray p-3 lg:p-6 flex flex-col gap-2 lg:gap-4">
		<div class="flex items-center gap-3">
			<?php if ($card['icon']): ?>
				<div class="flex items-center justify-center shrink-0 bg-accent/10 p-[10px]">
					<img src="<?php echo esc_url($card['icon']['url']); ?>" alt="<?php echo esc_attr($card['icon']['alt']); ?>"
						class="mx-auto">
				</div>
			<?php endif; ?>
			<?php if ($card['title']): ?>
				<h3 class="text-h5RegularMobile lg:text-h5Regular !font-bold">
					<?php echo esc_html($card['title']); ?>
				</h3>
			<?php endif; ?>
		</div>
		<?php if ($card['description']): ?>
			<p class="text-darkGray lg:text-bodyRegular">
				<?php echo esc_html($card['description']); ?>
			</p>
		<?php endif; ?>
	</div>
	<?php
}
?>

<section id="specialist" class="container bg-lightGrayBg py-7 lg:py-16 lg:!px-16">
	<?php if ($specialist['heading']): ?>
		<h2 class="text-h1Mobile lg:text-h1 text-center mb-6">
			<?php echo $specialist['heading']; ?>
		</h2>
	<?php endif; ?>
	<?php if ($specialist['subtext']): ?>
		<div class="text-titleMobile lg:text-title text-center text-darkGray mb-6">
			<?php echo esc_html($specialist['subtext']); ?>
		</div>
	<?php endif; ?>
	<?php if ($specialist['cards']): ?>
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-2 lg:gap-6 px-[3.625rem]">
			<?php foreach ($specialist['cards'] as $card): ?>
				<?php plmt_specialist_card($card); ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php if ($specialist['button']): ?>
		<div class="flex justify-center mt-10">
			<a href="<?php echo esc_url($specialist['button']['url']); ?>"
				class="inline-block bg-accent text-white py-[0.875rem] px-8 hover:bg-accent/90 transition-all duration-200 font-bold">
				<?php echo esc_html($specialist['button']['title']); ?>
			</a>
		</div>
	<?php endif; ?>
</section>