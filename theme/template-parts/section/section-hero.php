<?php
$hero_content = get_field('hero');

if (!isset($hero_content) || empty($hero_content)) {
	return;
}

?>
<section id='hero'
	class='py-16 mb-6 lg:py-[4.25rem] lg:mb-[7.5rem] flex flex-col bg-mainBlack text-white relative lg:min-h-[calc(100vh-5rem)]'>
	<div class="lg:container mx-auto lg:my-auto">
		<div class='flex flex-col gap-4 items-center lg:flex-row lg:justify-center lg:gap-14 lg:text-center'>
			<div class='hero-content w-full px-5 lg:px-0 z-10'>
				<div class='flex gap-3 flex-wrap mb-6'>
					<?php if ($hero_content['top_icons']): ?>
						<?php foreach ($hero_content['top_icons'] as $icon): ?>
							<img src='<?php echo esc_url($icon['url']) ?>' alt='<?php echo esc_attr($icon['alt']) ?>'
								class='h-10 lg:h-[3.5rem] w-auto'>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<?php if ($hero_content['heading']): ?>
					<h1
						class='text-[3rem] leading-[100%] font-semibold lg:text-[5.625rem] lg:font-bold min-[1920px]:text-[6rem] min-[1920px]:leading-[6rem] w-full mb-4 lg:mb-8'>
						<?php echo $hero_content['heading'] ?>
					</h1>
				<?php endif; ?>
				<?php if ($hero_content['subtext']): ?>
					<p class='text-titleMobile lg:text-h4Regular text-white/80 mb-6 lg:mb-8'>
						<?php echo esc_html($hero_content['subtext']) ?>
					</p>
				<?php endif; ?>
				<div class='flex justify-center'>
					<?php plmt_button(home_url(path: '/contact-us'), esc_html__('Contact Us', 'plmt'), array(
						'classes' => 'w-full justify-center lg:w-auto lg:px-[5.625rem] lg:py-5'
					)) ?>
					<?php plmt_button('#services', esc_html__('Our services', 'plmt'), array(
						'classes' => 'h-full w-full justify-center lg:w-auto scroll-to lg:px-[5.625rem] lg:py-5 text-white border-darkGray2 !bg-darkGray2',
						'variant' =>
							'secondary'
					)) ?>
				</div>
				<?php if ($hero_content['services']): ?>
					<div
						class="opacity-80 grid grid-cols-2 gap-x-10 gap-y-6 lg:flex items-center justify-center mt-10 lg:gap-20 flex-wrap lg:mt-[6rem]">
						<?php foreach ($hero_content['services'] as $service): ?>
							<img src='<?php echo esc_url($service['url']) ?>' alt='<?php echo esc_attr($service['alt']) ?>'
								class='h-8 lg:h-[2.875rem] w-auto'>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
	<?php if ($hero_content['hero_image']): ?>
		<img class="w-auto hidden lg:block absolute top-0 left-1/2 -translate-x-1/2 h-full"
			src='<?php echo esc_url($hero_content['hero_image']['url']) ?>' alt='
		<?php echo esc_attr($hero_content['hero_image']['alt']) ?>'>
	<?php endif; ?>
	<?php if ($hero_content['mobile_image']): ?>
		<img class="lg:hidden absolute top-0 left-0 w-full"
			src='<?php echo esc_url($hero_content['mobile_image']['url']) ?>' alt='
		<?php echo esc_attr($hero_content['mobile_image']['alt']) ?>'>
	<?php endif; ?>
</section>