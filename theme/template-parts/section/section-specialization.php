<?php

$specialization = get_field('specialization');

if (empty($specialization)) {
	return;
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
			<p class="text-title text-darkGray mb-6">
				<?php echo esc_html($tool['description']); ?>
			</p>
		<?php endif; ?>
		<div class="flex flex-col gap-8">
			<?php if ($tool['tag_groups']): ?>
				<?php foreach ($tool['tag_groups'] as $tag_group): ?>
					<div class="">
						<?php if ($tag_group['group_title']): ?>
							<p class="text-badges mb-3 text-darkGray">
								<?php echo esc_html($tag_group['group_title']); ?>
							</p>
						<?php endif; ?>
						<?php if ($tag_group['tags']): ?>
							<ul class="flex flex-wrap gap-2">
								<?php foreach ($tag_group['tags'] as $tag): ?>
									<li class="bg-white border border-lightGray text-mainBlack p-4">
										<?php echo esc_html($tag['tag']); ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

function plmt_specialization_categories($categories)
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
				<div class="text-h5RegularMobile lg:text-h5Regular !font-bold mb-4 lg:mb-6">
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
			<div>
				<?php plmt_specialization_categories($specialization['categories']); ?>
			</div>
		</div>
	</div>
</section>