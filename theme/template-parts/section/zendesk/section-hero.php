<?php
$hero_content = get_field('hero');

if (!isset($hero_content) || empty($hero_content)) {
	return;
}

$bigger_icon = isset($hero_content['bigger_icon']) ? $hero_content['bigger_icon'] : false;

?>
<section id='hero' class='mb-6  lg:mb-20 flex flex-col bg-mainBlack text-white relative '>
	<div
		class="pt-6 lg:py-[4.25rem] mx-auto lg:min-h-[calc(100vh-5rem)] flex flex-col gap-10 items-center lg:justify-between lg:gap-14 <?php echo $hero_content['image_left'] ? 'lg:flex-row-reverse' : 'lg:flex-row' ?>">
		<div class='min-[1920px]:w-full  hero-content px-5 lg:px-0 z-10 pb-[10rem] lg:pb-0'>
			<?php if ($hero_content['top_icon']): ?>
				<img src="<?php echo esc_url($hero_content['top_icon']['url']); ?>"
					alt="<?php echo esc_attr($hero_content['top_icon']['alt']); ?>"
					class=" w-auto mb-6 <?php echo $bigger_icon ? 'h-[4rem] lg:h-[5.5rem]' : 'h-[2.5625rem] lg:h-14'; ?>">
			<?php endif; ?>
			<?php if ($hero_content['heading']): ?>
				<h1
					class='text-displayLargeMobile lg:text-displayLarge min-[1920px]:text-[6rem] min-[1920px]:leading-[6rem]  w-full mb-6'>
					<?php echo $hero_content['heading'] ?>
				</h1>
			<?php endif; ?>

			<div class='flex flex-wrap md:flex-nowrap'>
				<?php if ($hero_content['primary_button']): ?>
					<?php plmt_button(esc_url($hero_content['primary_button']['url']), esc_attr($hero_content['primary_button']['title']), array(
						'classes' => '!w-[10rem] lg:!w-[16.875rem] w-full !px-0 py-3 justify-center lg:w-auto lg:py-5'
					)) ?>
				<?php endif; ?>
				<?php if ($hero_content['secondary_button']): ?>
					<?php plmt_button(esc_url($hero_content['secondary_button']['url']), esc_attr($hero_content['secondary_button']['title']), array(
						'classes' => '!w-[10rem] h-full justify-center lg:!w-[16.875rem] scroll-to lg:py-5 text-white border-darkGray2 !bg-darkGray2',
						'variant' =>
							'secondary'
					)) ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="block w-full">
			<?php if ($hero_content['image']): ?>
				<img class="w-auto hidden lg:block absolute top-0 h-full <?php echo $hero_content['image_left'] ? 'left-0' : 'right-0' ?>"
					src='<?php echo esc_url($hero_content['image']['url']) ?>'
					alt='<?php echo esc_attr($hero_content['image']['alt']) ?>'>
			<?php endif; ?>
			<?php if ($hero_content['mobile_image']): ?>
				<img class="w-auto absolute top-0 left-0 h-full lg:hidden"
					src='<?php echo esc_url($hero_content['mobile_image']['url']) ?>'
					alt='<?php echo esc_attr($hero_content['mobile_image']['alt']) ?>'>
			<?php endif; ?>
		</div>
	</div>
</section>