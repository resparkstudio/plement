<?php

$bottom_block = get_field('bottom_block');

if (!$bottom_block) {
	return;
}

?>

<section class="container">
	<?php if ($bottom_block['heading']): ?>
		<h2 class="text-h3Mobile lg:text-h3 text-center mb-4 lg:mb-6">
			<?php echo esc_html($bottom_block['heading']); ?>
		</h2>
	<?php endif; ?>
	<?php if ($bottom_block['text']): ?>
		<p class="text-titleMobile lg:text-title text-darkGray text-center mb-4 lg:mb-8">
			<?php echo esc_html($bottom_block['text']); ?>
		</p>
	<?php endif; ?>
	<?php if ($bottom_block['button']): ?>
		<div class="flex justify-center">
			<?php plmt_button(esc_url($bottom_block['button']['url']), esc_html($bottom_block['button']['title']), array(
				'classes' => 'w-full lg:w-auto',
			)) ?>
		</div>
	<?php endif; ?>
</section>