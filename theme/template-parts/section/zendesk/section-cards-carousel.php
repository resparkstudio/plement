<?php
$cards_carousel = get_field('cards_carousel');

if (!$cards_carousel)
	return null;

$has_top_row    = isset($cards_carousel['top_row_cards']) && !empty($cards_carousel['top_row_cards']);
$has_bottom_row = isset($cards_carousel['bottom_row_cards']) && !empty($cards_carousel['bottom_row_cards']);


if (!$has_top_row && !$has_bottom_row) {
	return null;
}

function render_card($card)
{
	?>
	<div
		class="h-full flex flex-col items-start gap-3 lg:gap-4 p-3 lg:p-6 bg-white rounded-lg border border-lightGray shrink-0">
		<div class="flex items-center gap-3">
			<?php if ($card['icon']): ?>
				<img src="<?php echo esc_url($card['icon']['url']); ?>" alt="<?php echo esc_attr($card['icon']['alt']); ?>"
					class="w-7 lg:w-10 h-7 lg:h-10 shrink-0">
			<?php endif; ?>
			<?php if ($card['title']): ?>
				<h3 class="text-[1rem] lg:text-[1.0625rem] font-bold leading-[22.1px] text-mainBlack">
					<?php echo esc_html($card['title']); ?>
				</h3>
			<?php endif; ?>
		</div>
		<?php if ($card['bullet_points']): ?>
			<ul class="flex flex-col gap-2 list-none text-sm text-darkGray pl-[18px] ">
				<?php foreach ($card['bullet_points'] as $point): ?>
					<li
						class="relative before:content-[''] before:absolute before:-left-[18px] before:top-1/2 before:-translate-y-1/2 before:w-[6px] before:h-[6px] before:bg-accent before:rounded-full">
						<?php echo esc_html($point['bullet_point']); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<?php
}
?>

<section id="cards-carousel" class="bg-lightGrayBg py-7 lg:py-16 mb-20">
	<div class="container mb-10 lg:mb-16">
		<?php if ($cards_carousel['heading']): ?>
			<h2 class="text-h1Mobile lg:text-h1">
				<?php echo $cards_carousel['heading']; ?>
			</h2>
		<?php endif; ?>
		<?php if ($cards_carousel['subheading']): ?>
			<p class="text-darkGray mt-4">
				<?php echo $cards_carousel['subheading']; ?>
			</p>
		<?php endif; ?>
	</div>
	<?php if ($has_top_row || $has_bottom_row): ?>
		<div class="lg:hidden">
			<div class="swiper cards-swiper w-full">
				<div class="swiper-wrapper !w-full">
					<?php
					$merged_cards = array_merge($cards_carousel['top_row_cards'], $cards_carousel['bottom_row_cards']);
					foreach ($merged_cards as $card): ?>
						<div class="swiper-slide">
							<?php render_card($card); ?>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-pagination !static mt-6"></div>
			</div>
		</div>
	<?php endif; ?>
	<div
		class="hidden lg:block relative after:content-[''] after:absolute after:top-0 after:right-0 after:bottom-0 before:z-10 after:z-10 after:block after:bg-gradientRight  before:content-[''] before:absolute before:top-0 before:left-0  before:bottom-0 before:block before:bg-gradientLeft before:w-14 after:w-14">

		<?php if ($has_top_row): ?>
			<div class="mb-4 swiper marquee-slider">
				<div class='swiper-wrapper'>
					<?php foreach ($cards_carousel['top_row_cards'] as $card): ?>
						<div class="swiper-slide max-w-[340px]">
							<?php render_card($card); ?>
						</div>
					<?php endforeach; ?>
					<?php foreach ($cards_carousel['top_row_cards'] as $card): ?>
						<div class="swiper-slide max-w-[340px]">
							<?php render_card($card); ?>
						</div>
					<?php endforeach; ?>
					<?php foreach ($cards_carousel['top_row_cards'] as $card): ?>
						<div class="swiper-slide max-w-[340px]">
							<?php render_card($card); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($has_bottom_row): ?>
			<div
				class="swiper marquee-slider-reverse items-center after:content-[''] after:absolute after:top-0 after:right-0 after:bottom-0 before:z-10 after:block after:bg-gradientRight  before:content-[''] before:absolute before:top-0 before:left-0  before:bottom-0 before:block before:bg-gradientLeft before:w-14 after:w-14">
				<div class='swiper-wrapper marquee-slider-reverse'>
					<?php foreach ($cards_carousel['bottom_row_cards'] as $card): ?>
						<div class="swiper-slide marquee-slider-reverse max-w-[340px]">
							<?php render_card($card); ?>
						</div>
					<?php endforeach; ?>
					<?php foreach ($cards_carousel['bottom_row_cards'] as $card): ?>
						<div class="swiper-slide marquee-slider-reverse max-w-[340px]">
							<?php render_card($card); ?>
						</div>
					<?php endforeach; ?>
					<?php foreach ($cards_carousel['bottom_row_cards'] as $card): ?>
						<div class="swiper-slide marquee-slider-reverse max-w-[340px]">
							<?php render_card($card); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>