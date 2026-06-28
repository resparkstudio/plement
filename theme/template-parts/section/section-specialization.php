<?php

$specialization = get_field('specialization');

if (empty($specialization)) {
	return;
}

function plmt_caret_icon()
{
	?>
	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M4.5 9L12 16.5L19.5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round"
			stroke-linejoin="round" />
	</svg>
	<?php
}

function plmt_specialization_category_mobile($category)
{
	if (empty($category)) {
		return;
	}
	?>
	<div class="w-full">
		<?php if ($category['category_title']): ?>
			<h4 class="font-bold text-[0.875rem] leading-[120%] mb-3 text-darkGray">
				<?php echo esc_html($category['category_title']); ?>
			</h4>
		<?php endif; ?>
		<?php if ($category['tools']): ?>
			<div>
				<button @click="selectedTool = '<?php echo esc_js($category['tools'][0]['tool_title']); ?>'"
					class="w-full flex items-center justify-between gap-3 py-3 px-4 text-darkGray text-title font-bold hover:bg-accent/10 hover:text-accent transition-all duration-200"
					:class="selectedTool === '<?php echo esc_js($category['tools'][0]['tool_title']); ?>' ? 'bg-accent/10 !text-accent' : ''">
					<div class="flex items-center gap-3">
						<?php if ($category['tools'][0]['tool_icon']): ?>
							<img src="<?php echo esc_url($category['tools'][0]['tool_icon']['url']); ?>"
								alt="<?php echo esc_attr($category['tools'][0]['tool_icon']['alt']); ?>" class="w-6 h-6">
						<?php endif; ?>
						<?php if ($category['tools'][0]['tool_title']): ?>
							<p class="text-sm lg:text-base">
								<?php echo esc_html($category['tools'][0]['tool_title']); ?>
							</p>
						<?php endif; ?>
					</div>
					<span
						:class="selectedTool === '<?php echo esc_js($category['tools'][0]['tool_title']); ?>' ? 'rotate-180' : ''">
						<?php plmt_caret_icon(); ?>
					</span>
				</button>
				<div x-show="selectedTool === '<?php echo esc_js($category['tools'][0]['tool_title']); ?>'" x-cloak>
					<?php plmt_specialization_tool($category['tools'][0]); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php
}


function plmt_specialization_category($category)
{
	if (empty($category)) {
		return;
	}
	?>
	<div>
		<?php if ($category['category_title']): ?>
			<h4 class="font-bold mb-2 text-darkGray">
				<?php echo esc_html($category['category_title']); ?>
			</h4>
		<?php endif; ?>
		<?php if ($category['tools']): ?>
			<ul class="flex flex-col gap-1">
				<?php foreach ($category['tools'] as $tool): ?>
					<li class="w-full">
						<button @click="selectedTool = '<?php echo esc_js($tool['tool_title']); ?>'"
							class="w-full flex items-center gap-3 py-3 px-4 text-darkGray text-title font-bold hover:bg-accent/10 hover:text-accent transition-all duration-200"
							:class="selectedTool === '<?php echo esc_js($tool['tool_title']); ?>' ? 'bg-accent/10 !text-accent' : ''">
							<?php if ($tool['tool_icon']): ?>
								<img src="<?php echo esc_url($tool['tool_icon']['url']); ?>"
									alt="<?php echo esc_attr($tool['tool_icon']['alt']); ?>" class="w-6 h-6">
							<?php endif; ?>
							<?php if ($tool['tool_title']): ?>
								<p class="text-sm lg:text-base">
									<?php echo esc_html($tool['tool_title']); ?>
								</p>
							<?php endif; ?>
						</button>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<?php
}

function plmt_specialization_tool($tool)
{
	if (empty($tool)) {
		return;
	}
	?>
	<div x-show="selectedTool === '<?php echo esc_js($tool['tool_title']); ?>'" x-cloak>
		<?php if ($tool['description']): ?>
			<p class="text-titleMobile lg:text-title text-darkGray mb-6 pt-2">
				<?php echo esc_html($tool['description']); ?>
			</p>
		<?php endif; ?>
		<div class="flex flex-col gap-6 lg:gap-8">
			<?php if ($tool['tag_groups']): ?>
				<?php foreach ($tool['tag_groups'] as $tag_group): ?>
					<div class="">
						<?php if ($tag_group['group_title']): ?>
							<p class="text-badgesMobile lg:text-badges mb-3 text-darkGray">
								<?php echo esc_html($tag_group['group_title']); ?>
							</p>
						<?php endif; ?>
						<?php if ($tag_group['tags']): ?>
							<ul class="flex flex-wrap gap-2">
								<?php foreach ($tag_group['tags'] as $tag): ?>
									<li
										class="text-[0.875rem] leading-[120%] lg:text-[1rem] bg-white border border-lightGray text-mainBlack p-2 lg:p-4">
										<?php echo esc_html($tag['tag']); ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<?php if ($tool['button']): ?>
			<a href="<?php echo esc_url($tool['button']['url']); ?>"
				class="inline-block mt-6 lg:mt-10 bg-accent text-center text-white py-[0.875rem] w-full lg:w-auto lg:px-8 hover:bg-accent/90 transition-all duration-200 font-bold">
				<?php echo esc_html($tool['button']['title']); ?>
			</a>
		<?php endif; ?>
	</div>
	<?php
}

function plmt_specialization_categories_desktop($categories)
{
	if (empty($categories)) {
		return;
	}
	$first_tool = $categories[0]['tools'][0]['tool_title'] ?? null;
	?>
	<div x-data="{selectedTool: '<?php echo esc_js($first_tool); ?>'}" class="flex gap-20">
		<div class="flex flex-col gap-10 max-w-[13.75rem]">
			<?php foreach ($categories as $category): ?>
				<?php plmt_specialization_category($category); ?>
			<?php endforeach; ?>
		</div>
		<div>
			<?php foreach ($categories as $category): ?>
				<?php foreach ($category['tools'] as $tool): ?>
					<?php plmt_specialization_tool($tool); ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

function plmt_specialization_categories_mobile($categories)
{
	if (empty($categories)) {
		return;
	}
	$first_tool = $categories[0]['tools'][0]['tool_title'] ?? null;
	?>
	<div x-data="{selectedTool: '<?php echo esc_js($first_tool); ?>'}" class="flex gap-20 w-full">
		<div class="flex flex-col gap-10">
			<?php foreach ($categories as $category): ?>
				<?php plmt_specialization_category_mobile($category); ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

?>

<section id="specialization" class="bg-lightGrayBg py-7 lg:py-20">
	<div class="container">
		<div class="text-center mx-auto mb-6 lg:mb-14">
			<?php if ($specialization['heading']): ?>
				<h2 class="text-h1Mobile lg:text-h1 mb-4 lg:mb-6">
					<?php echo $specialization['heading']; ?>
				</h2>
			<?php endif; ?>
			<?php if ($specialization['subtitle']): ?>
				<div class="text-h5RegularMobile lg:text-h5Regular">
					<?php echo $specialization['subtitle']; ?>
				</div>
			<?php endif; ?>
		</div>
		<div>
			<?php if ($specialization['subheading']): ?>
				<h3 class="text-h3Mobile lg:text-h3 mb-6 lg:mb-8">
					<?php echo $specialization['subheading']; ?>
				</h3>
			<?php endif; ?>
			<div class="hidden lg:block">
				<?php plmt_specialization_categories_desktop($specialization['categories']); ?>
			</div>
			<div class="lg:hidden">
				<?php plmt_specialization_categories_mobile($specialization['categories']); ?>
			</div>
		</div>
	</div>
</section>