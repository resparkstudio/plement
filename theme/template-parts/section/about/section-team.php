<?php
$team_content = get_field('team');

if (!isset($team_content) || empty($team_content)) {
	return;
}

function step_icon($index)
{
	if (!isset($index))
		return;
	?>
	<div class="aspect-square bg-accent rounded-full h-[9px] w-[9px] z-10">
	</div>
	<?php
}

function step_card($step, $index)
{
	if (empty($step)) {
		return;
	}
	?>
	<div class="max-w-[680px] rounded-[4px]">
		<h2 class="text-bodyRegular text-accent mb-1"><?php echo esc_html($step['year']) ?></h2>
		<p class="text-title lg:text-h5Bold"><?php echo esc_html($step['title']) ?></p>
	</div>
	<?php
}

function member_card($member)
{
	?>
	<div class="border border-lightGray p-3 lg:p-4 relative">
		<?php if ($member['bead']): ?>
			<div class="absolute py-1 px-1.5 right-4 top-4 text-badgesMobile lg:text-badges text-accent bg-accent/15">
				<?php esc_html_e($member['bead']) ?>
			</div>
		<?php endif; ?>
		<div class="flex gap-3 items-center">
			<?php if ($member['photo']): ?>
				<img src="<?php echo esc_url($member['photo']['url']) ?>"
					class="h-[5.5rem] w-[5.5rem] lg:w-[7.5rem] lg:h-[7.5rem]" />
			<?php endif; ?>
			<div class="flex flex-col gap-2">
				<?php if ($member['name']): ?>
					<div class="flex items-center gap-2 lg:gap-3">
						<span class="text-h5Mobile lg:text-h5Bold">
							<?php esc_html_e($member['name']) ?>
						</span>
						<?php if ($member['linkedin']): ?>
							<a class="text-accent hover:text-accentHover transition duration-200 ease-in-out"
								href="<?php echo esc_url($member['linkedin']['url']) ?>"
								target="<?php echo esc_attr($member['linkedin']['target']) ?>">
								<svg class="h-5 w-5 lg:h-6 lg:w-6" width="24" height="24" viewBox="0 0 16 16" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<g clip-path="url(#clip0_247_5748)">
										<path
											d="M13.8182 0H2.18182C1.60316 0 1.04821 0.229869 0.63904 0.63904C0.229869 1.04821 0 1.60316 0 2.18182L0 13.8182C0 14.3968 0.229869 14.9518 0.63904 15.361C1.04821 15.7701 1.60316 16 2.18182 16H13.8182C14.3968 16 14.9518 15.7701 15.361 15.361C15.7701 14.9518 16 14.3968 16 13.8182V2.18182C16 1.60316 15.7701 1.04821 15.361 0.63904C14.9518 0.229869 14.3968 0 13.8182 0ZM5.45455 12.6618C5.45467 12.7062 5.44603 12.7501 5.42913 12.7912C5.41224 12.8322 5.38741 12.8695 5.35608 12.9009C5.32475 12.9323 5.28753 12.9572 5.24655 12.9742C5.20557 12.9912 5.16164 13 5.11727 13H3.68C3.63556 13.0001 3.59153 12.9915 3.55044 12.9745C3.50936 12.9575 3.47203 12.9326 3.4406 12.9012C3.40917 12.8698 3.38427 12.8325 3.36732 12.7914C3.35036 12.7503 3.3417 12.7063 3.34182 12.6618V6.63636C3.34182 6.54667 3.37745 6.46065 3.44087 6.39723C3.50429 6.33381 3.59031 6.29818 3.68 6.29818H5.11727C5.20681 6.29842 5.29259 6.33416 5.35582 6.39755C5.41904 6.46095 5.45455 6.54683 5.45455 6.63636V12.6618ZM4.39818 5.72727C4.12848 5.72727 3.86484 5.6473 3.64059 5.49746C3.41634 5.34762 3.24156 5.13465 3.13835 4.88548C3.03514 4.63631 3.00813 4.36212 3.06075 4.0976C3.11336 3.83308 3.24324 3.59011 3.43395 3.3994C3.62465 3.20869 3.86763 3.07882 4.13215 3.0262C4.39667 2.97359 4.67085 3.00059 4.92002 3.1038C5.16919 3.20701 5.38217 3.38179 5.532 3.60604C5.68184 3.83029 5.76182 4.09393 5.76182 4.36364C5.76182 4.7253 5.61815 5.07214 5.36242 5.32787C5.10669 5.5836 4.75984 5.72727 4.39818 5.72727ZM12.9673 12.6855C12.9674 12.7263 12.9594 12.7668 12.9439 12.8046C12.9283 12.8424 12.9054 12.8767 12.8765 12.9056C12.8476 12.9345 12.8133 12.9574 12.7755 12.9729C12.7377 12.9885 12.6972 12.9965 12.6564 12.9964H11.1109C11.07 12.9965 11.0296 12.9885 10.9918 12.9729C10.954 12.9574 10.9197 12.9345 10.8908 12.9056C10.8619 12.8767 10.839 12.8424 10.8234 12.8046C10.8078 12.7668 10.7999 12.7263 10.8 12.6855V9.86273C10.8 9.44091 10.9236 8.01545 9.69727 8.01545C8.74727 8.01545 8.55364 8.99091 8.51545 9.42909V12.6891C8.51546 12.7708 8.48333 12.8492 8.426 12.9073C8.36868 12.9655 8.29076 12.9988 8.20909 13H6.71636C6.67558 13 6.63519 12.992 6.59752 12.9763C6.55985 12.9607 6.52564 12.9378 6.49684 12.9089C6.46804 12.88 6.44522 12.8457 6.4297 12.808C6.41417 12.7703 6.40624 12.7299 6.40636 12.6891V6.61C6.40624 6.56921 6.41417 6.5288 6.4297 6.49109C6.44522 6.45337 6.46804 6.41909 6.49684 6.39021C6.52564 6.36133 6.55985 6.33841 6.59752 6.32277C6.63519 6.30714 6.67558 6.29909 6.71636 6.29909H8.20909C8.29155 6.29909 8.37063 6.33185 8.42894 6.39015C8.48724 6.44846 8.52 6.52754 8.52 6.61V7.13545C8.87273 6.60545 9.39546 6.19818 10.5109 6.19818C12.9818 6.19818 12.9655 8.50546 12.9655 9.77273L12.9673 12.6855Z"
											fill="currentColor" />
									</g>
									<defs>
										<clipPath id="clip0_247_5748">
											<rect width="24" height="24" fill="white" />
										</clipPath>
									</defs>
								</svg>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ($member['position']): ?>
					<span class="text-titleMobile lg:text-title text-accent">
						<?php esc_html_e($member['position']) ?>
					</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="flex flex-wrap gap-2 mt-3">
			<?php foreach ($member['tags'] as $tag): ?>
				<span class="text-badgesMobile py-1 px-1.5 text-darkGray bg-lightGray lg:text-badges">
					<?php esc_html_e($tag['tag']); ?>
				</span>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

function last_card($last_card)
{
	?>
	<div
		class="border border-lightGray p-3 lg:p-4 relative group hover:border-accent hover:border-dashed hover:bg-accent/5 transition-all duration-200">
		<div class="flex gap-3 items-center">
			<?php if ($last_card['icon']): ?>
				<img src="<?php echo esc_url($last_card['icon']['url']) ?>"
					class="w-10 h-10 lg:w-16 lg:h-16 aspect-square p-[7px] lg:p-3 bg-accent/10" />
			<?php endif; ?>
			<div class="flex flex-col gap-2">
				<?php if ($last_card['title']): ?>
					<span class="text-h5Mobile lg:text-h5Bold">
						<?php esc_html_e($last_card['title']) ?>
					</span>
				<?php endif; ?>
			</div>
		</div>
		<?php if ($last_card['description']): ?>
			<p class="text-bodyRegularMobile lg:text-bodyRegular mt-3 text-darkGray">
				<?php esc_html_e($last_card['description']) ?>
			</p>
		<?php endif; ?>
		<div class="mt-3">
			<a href="<?php echo esc_url($last_card['link']['url']) ?>"
				target="<?php echo esc_url($last_card['link']['target']) ?>"
				class="inline-flex items-center gap-2 text-mainBlack font-bold text-[1.125rem] leading-[120%] hover:text-accent transition-colors duration-200 group-hover:text-accent">
				<?php plmt_arrow_circle_icon(); ?>
				<?php echo esc_html($last_card['link']['title']); ?>
			</a>
		</div>
	</div>
	<?php
}

?>

<section id="team" class="bg-lightGrayBg py-6 lg:py-20">
	<div class="container lg:mx-auto">
		<div class="text-center mb-6 lg:mb-10">
			<?php if ($team_content['heading']): ?>
				<h2 class="text-h1Mobile mb-4 lg:text-h1">
					<?php esc_html_e($team_content['heading']) ?>
				</h2>
			<?php endif; ?>
			<?php if ($team_content['description']): ?>
				<div class="text-titleMobile lg:text-title max-w-[51.625rem] text-darkGray mx-auto">
					<?php echo $team_content['description'] ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-3 lg:gap-6">
			<?php foreach ($team_content['members'] as $member): ?>
				<?php member_card($member) ?>
			<?php endforeach; ?>
			<?php last_card($team_content['last_card']) ?>
		</div>
	</div>
</section>