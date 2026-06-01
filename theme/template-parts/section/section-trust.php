<?php

$companies_content = get_field('statistics');

$companies = $companies_content['companies'];


if (empty($companies_content)) {
	return;
}

?>

<section id="companies" class="pt-6 lg:pt-[7.5rem]">
	<div class="container">
		<h2 class="text-h4Bold mb-8 lg:mb-10">
			<?php echo esc_html($companies['title']); ?>
		</h2>
	</div>
	<div
		class="hidden relative md:flex overflow-hidden space-x-3 items-center after:content-[''] after:absolute after:top-0 after:right-0 after:bottom-0 before:z-10 after:block after:bg-gradientRight  before:content-[''] before:absolute before:top-0 before:left-0  before:bottom-0 before:block before:bg-gradientLeft before:w-14 after:w-14">
		<div class='flex space-x-3 animate-loop-scroll items-center'>
			<?php foreach ($companies['icons'] as $logo): ?>
				<img src='<?php echo esc_url($logo['url']) ?>' alt='<?php echo esc_attr($logo['alt']) ?>'
					class='max-w-none object-contain gs h-[60px]' width='200' height="60">
			<?php endforeach; ?>
		</div>
		<div class='flex space-x-3 animate-loop-scroll items-center' aria-hidden='true'>
			<?php foreach ($companies['icons'] as $logo): ?>
				<img src='<?php echo esc_url($logo['url']) ?>' alt='<?php echo esc_attr($logo['alt']) ?>'
					class='max-w-none object-contain gs h-[60px]' width='200' height="60">
			<?php endforeach; ?>
		</div>
		<div class='flex space-x-3 animate-loop-scroll items-center' aria-hidden='true'>
			<?php foreach ($companies['icons'] as $logo): ?>
				<img src='<?php echo esc_url($logo['url']) ?>' alt='<?php echo esc_attr($logo['alt']) ?>'
					class='max-w-none object-contain gs h-[60px]' width='200' height="60">
			<?php endforeach; ?>
		</div>
	</div>
	<div class="md:hidden space-y-6">
		<?php
		$companies['icons'] = array_chunk($companies['icons'], ceil(count($companies['icons'])) / 2);
		if (count($companies['icons']) > 2) {
			$last_chunk            = array_pop($companies['icons']);
			$companies['icons'][1] = array_merge($companies['icons'][1], $last_chunk);
		}
		$index = 0;

		foreach ($companies['icons'] as $companies):

			?>
			<div
				class="relative flex overflow-hidden space-x-3 items-center after:content-[''] after:absolute after:top-0 after:right-0 after:bottom-0 before:z-10 after:block after:bg-gradientRight  before:content-[''] before:absolute before:top-0 before:left-0  before:bottom-0 before:block before:bg-gradientLeft before:w-14 after:w-14">
				<div
					class='flex space-x-3 items-center <?php echo $index === 0 ? 'animate-loop-scroll' : 'animate-loop-scroll2' ?>'>
					<?php foreach ($companies as $logo): ?>
						<img src='<?php echo esc_url($logo['url']) ?>' alt='<?php echo esc_attr($logo['alt']) ?>'
							class='max-w-none object-contain gs h-[60px]' width='200' height="60">
					<?php endforeach; ?>
				</div>
				<div class='flex space-x-3 items-center <?php echo $index === 0 ? 'animate-loop-scroll' : 'animate-loop-scroll2' ?>'
					aria-hidden='true'>
					<?php foreach ($companies as $logo): ?>
						<img src='<?php echo esc_url($logo['url']) ?>' alt='<?php echo esc_attr($logo['alt']) ?>'
							class='max-w-none object-contain gs h-[60px]' width='200' height="60">
					<?php endforeach; ?>
				</div>
			</div>
			<?php
			$index++;
		endforeach; ?>
	</div>
</section>