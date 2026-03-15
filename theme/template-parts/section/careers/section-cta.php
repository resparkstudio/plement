<?php
$ctaSection = get_field('cta_section');
$enabled    = $ctaSection['enabled'] ?? false;

if (!$enabled) {
	return;
}

?>

<section id='cta' class='bg-lightGrayBg py-7 lg:py-4 mt-6 lg:mt-[7.5rem]'>
	<div class="">
		<div class='container flex flex-col gap-8 items-center lg:flex-row lg:justify-between lg:gap-[3.375rem]]'>
			<div class=' partnership-content lg:max-w-2xl text-center lg:text-left'>
				<?php if ($ctaSection['heading']): ?>
					<h2 class='text-h1Mobile lg:text-h1 mb-4 lg:mb-5'>
						<?php echo esc_html($ctaSection['heading']) ?>
					</h2>
				<?php endif; ?>
				<?php if ($ctaSection['description']): ?>
					<p class='text-titleMobile lg:text-title text-darkGray mb-6 lg:mb-7'>
						<?php echo esc_html($ctaSection['description']) ?>
					</p>
				<?php endif; ?>

				<div class='flex justify-center lg:justify-start'>
					<?php plmt_button(esc_url($ctaSection['button']['url']), esc_attr($ctaSection['button']['title']), array(
						'classes' => 'w-full justify-center lg:w-auto',
					)) ?>
				</div>
			</div>
			<div>
				<?php if ($ctaSection['image']): ?>
					<img class="w-auto h-full hidden lg:block min-[1440px]:hidden translate-x-[1.25rem]"
						src='<?php echo esc_url($ctaSection['image']['url']) ?>' alt='
				<?php echo esc_attr($ctaSection['image']['alt']) ?>'>
				<?php endif; ?>
				<?php if ($ctaSection['mobile_image']): ?>
					<img class="w-auto h-full lg:hidden" src='<?php echo esc_url($ctaSection['mobile_image']['url']) ?>'
						alt='
				<?php echo esc_attr($ctaSection['mobile_image']['alt']) ?>'>
				<?php endif; ?>
				<?php if ($ctaSection['large_screen_image']): ?>
					<img class="w-auto h-full hidden min-[1440px]:block translate-x-[1.25rem]"
						src='<?php echo esc_url($ctaSection['large_screen_image']['url']) ?>' alt='
				<?php echo esc_attr($ctaSection['large_screen_image']['alt']) ?>'>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>