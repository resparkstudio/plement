<?php

$statistics_content = get_field('statistics');

if (empty($statistics_content)) {
	return;
}

function plmt_5_stars()
{
	?>
	<span class="flex items-center justify-center gap-2">
		<?php for ($i = 0; $i < 5; $i++): ?>
			<svg width="35" height="33" viewBox="0 0 35 33" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M17.1218 27.4L8.82175 32.4C8.45508 32.6333 8.07175 32.7333 7.67175 32.7C7.27175 32.6667 6.92175 32.5333 6.62175 32.3C6.32175 32.0667 6.08842 31.7753 5.92175 31.426C5.75508 31.0767 5.72175 30.6847 5.82175 30.25L8.02175 20.8L0.671752 14.45C0.338418 14.15 0.130418 13.808 0.0477516 13.424C-0.0349151 13.04 -0.0102485 12.6653 0.121751 12.3C0.253751 11.9347 0.453751 11.6347 0.721751 11.4C0.989751 11.1653 1.35642 11.0153 1.82175 10.95L11.5218 10.1L15.2718 1.2C15.4384 0.8 15.6971 0.5 16.0478 0.3C16.3984 0.0999997 16.7564 0 17.1218 0C17.4871 0 17.8451 0.0999997 18.1958 0.3C18.5464 0.5 18.8051 0.8 18.9718 1.2L22.7218 10.1L32.4217 10.95C32.8884 11.0167 33.2551 11.1667 33.5218 11.4C33.7884 11.6333 33.9884 11.9333 34.1217 12.3C34.2551 12.6667 34.2804 13.042 34.1978 13.426C34.1151 13.81 33.9064 14.1513 33.5718 14.45L26.2218 20.8L28.4218 30.25C28.5218 30.6833 28.4884 31.0753 28.3218 31.426C28.1551 31.7767 27.9218 32.068 27.6218 32.3C27.3218 32.532 26.9718 32.6653 26.5718 32.7C26.1718 32.7347 25.7884 32.6347 25.4218 32.4L17.1218 27.4Z"
					fill="#ED5623" />
			</svg>
		<?php endfor; ?>
	</span>
	<?php
}

function statistics_counts($stats)
{
	if (empty($stats)) {
		return;
	}
	?>
	<ul class="grid grid-cols-1 gap-12 md:grid-cols-3 md:max-w-[68.125rem] mx-auto">
		<?php
		foreach ($stats as $stat) {
			?>
			<li class="border-r border-r-lightGray last-of-type:border-r-0">
				<div class="md:max-w-[12.5rem] mx-auto">
					<span
						class="text-h3 md:text-displayLarge mb-2 inline-block md:mb-5"><?php echo esc_html($stat['count']); ?></span>
					<div class="rich-content text-darkGray text-title [&_a]:text-accent [&_a]:no-underline">
						<?php echo $stat['description'] ?>
					</div>
				</div>
			</li>
			<?php
		}
		?>
	</ul>
	<?php
}

function plmt_trust_stats()
{
	?>
	<div>

		<div class="flex justify-center gap-40 relative">
			<div class="text-center">
				<span class="text-displayLarge leading-[100%] mb-5">100%</span>
				<div class="rich-content text-darkGray text-title [&_a]:text-accent [&_a]:no-underline">
					<p>Job success on <a href="https://www.upwork.com" target="_blank" rel="noopener noreferrer">Upwork</a>
					</p>
				</div>
			</div>
			<span class="absolute left-1/2 -translate-x-1/2 bg-lightGray h-full w-[1.5px] top-0"></span>
			<div class="text-center flex flex-col justify-center">
				<?php plmt_5_stars(); ?>
				<div class="mt-5 rich-content text-darkGray text-title [&_a]:text-accent [&_a]:no-underline">
					<p>
						Verified reviews on <a href="https://www.upwork.com" target="_blank"
							rel="noopener noreferrer">Clutch</a>
					</p>
				</div>
			</div>
		</div>
		<p class="text-h5Regular text-center mt-5 [&_b]:text-mainBlack text-darkGray"><b>200+</b> successful projects
			delivered</p>
	</div>
	<?php
}

function plmt_trust_companies($companies)
{
	if (!$companies) {
		return;
	} ?>
	<div class="overflow-hidden company-marquee-slider">
		<div class="flex gap-4 animate-loop-scroll hover:[animation-play-state:paused]">
			<div class="flex gap-4 shrink-0">
				<?php foreach ($companies as $company): ?>
					<div class="group flex flex-col items-center gap-2">
						<img src='<?php echo esc_url($company['icon']['url']) ?>'
							alt='<?php echo esc_attr($company['icon']['alt']) ?>'
							class='h-8 lg:h-[3.75rem] w-min grayscale hover:grayscale-0 transition-all duration-300'>
						<a href="<?php echo esc_url($company['link']['url']) ?>" target="_blank" rel="noopener noreferrer"
							class=" inline-block invisible group-hover:visible transition-all duration-300 bg-accent/10 text-accent p-2 font-bold hover:bg-accent hover:text-white">
							<?php echo esc_html($company['link']['title']); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="flex gap-4 shrink-0" aria-hidden="true">
				<?php foreach ($companies as $company): ?>
					<div class="group flex flex-col items-center gap-2">
						<img src='<?php echo esc_url($company['icon']['url']) ?>' alt='
				<?php echo esc_attr($company['icon']['alt']) ?>'
							class='h-8 lg:h-[3.75rem] w-min grayscale hover:grayscale-0 transition-all duration-300'>
						<a href="<?php echo esc_url($company['link']['url']) ?>" target="_blank" rel="noopener noreferrer"
							class=" inline-block invisible group-hover:visible transition-all duration-300 bg-accent/10 text-accent p-2 font-bold hover:bg-accent hover:text-white">
							<?php echo esc_html($company['link']['title']); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="flex gap-4 shrink-0" aria-hidden="true">
				<?php foreach ($companies as $company): ?>
					<div class="group flex flex-col items-center gap-2">
						<img src='<?php echo esc_url($company['icon']['url']) ?>'
							alt='<?php echo esc_attr($company['icon']['alt']) ?>'
							class='h-8 lg:h-[3.75rem] w-min grayscale hover:grayscale-0 transition-all duration-300'>
						<a href="<?php echo esc_url($company['link']['url']) ?>" target="_blank" rel="noopener noreferrer"
							class=" inline-block invisible group-hover:visible transition-all duration-300 bg-accent/10 text-accent p-2 font-bold hover:bg-accent hover:text-white">
							<?php echo esc_html($company['link']['title']); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
}
?>

<section id="about" class="my-6 py-7 lg:py-20 lg:my-[7.5rem]">
	<div class="container">
		<div class="mb-6 lg:mb-10">
			<?php if ($statistics_content['text']): ?>
				<h2 class="text-h1Mobile mb-4 text-center lg:text-h1">
					<?php echo esc_html($statistics_content['text']); ?>
				</h2>
			<?php endif; ?>
			<?php if ($statistics_content['subtitle']): ?>
				<h2 class="text-center text-h5RegularMobile lg:text-h5Regular">
					<?php echo esc_html($statistics_content['subtitle']); ?>
				</h2>
			<?php endif; ?>
		</div>
		<?php plmt_trust_stats(); ?>
	</div>
	<div class="max-w-[120rem] mx-auto mt-6 lg:mt-14">
		<?php plmt_trust_companies($statistics_content['company_list']); ?>
	</div>
	<?php isset($statistics_content['stats']) && statistics_counts($statistics_content['stats']); ?>
</section>