<?php

$statistics_content = get_field('statistics');

if (empty($statistics_content)) {
	return;
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
?>

<section id="about" class="bg-lightGrayBg pt-[3.75rem] pb-10 lg:py-20 mb-6 lg:mb-[7.5rem]">
	<div class="container">
		<h2
			class="text-h5Bold mb-[4.6875rem] lg:text-center lg:text-h4Regular lg:mb-[4.25rem] lg:max-w-[61.625rem] lg:mx-auto">
			<?php echo esc_html($statistics_content['text']); ?>
		</h2>
		<?php isset($statistics_content['stats']) && statistics_counts($statistics_content['stats']); ?>
	</div>
</section>