<?php
/**
 * The template for displaying single career post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Plement
 */

get_header(null, array('type' => 'light'));

$excerpt    = get_field('excerpt');
$info_tabs  = get_field('info_tabs');
$apply_link = get_field('apply_link');
function career_info_tabs($tabs)
{
	if (!$tabs)
		return null;

	$total = count($tabs);

	$even_classes = 'odd:border-r-0 border';
	$odd_classes  = 'odd:border-r-0 last:!border border';

	$classes = $total % 2 === 0 ? $even_classes : $odd_classes;
	?>
	<div class="grid grid-cols-2 lg:flex">
		<?php foreach ($tabs as $index => $tab): ?>
			<?php
			$is_last_odd = $total % 2 !== 0 && $index === $total - 1;
			$is_even     = $total % 2 === 0;
			$is_last_row = $is_even && $index >= $total - 2;

			$item_classes = '';

			if ($is_even && !$is_last_row) {
				$item_classes .= ' max-lg:border-b-0';
			}

			if (!$is_even && !$is_last_odd) {
				$item_classes .= ' max-lg:border-b-0';
			}

			?>
			<div
				class="flex-1 flex flex-col text-left gap-1 border-lightGray  p-4 lg:border-r-0 lg:last:border-r <?php echo $item_classes ?>  <?php echo $classes ?> <?php echo $is_last_odd ? 'col-span-2' : ''; ?>">
				<span class="text-xs font-bold text-textSecondary">
					<?php echo esc_html($tab['title']); ?>
				</span>
				<span class="text-sm font-bold">
					<?php echo esc_html($tab['content']); ?>
				</span>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}

function career_apply_section($apply_link)
{
	if (!$apply_link)
		return null;

	?>
	<div id="apply" class="bg-mainBlack flex p-4 lg:p-8 w-full flex-col gap-4 lg:flex-row justify-between">
		<div class="text-left flex lg:flex-col gap-6 lg:gap-1">
			<p class="text-white text-h5Mobile lg:text-h5Bold">
				<?php esc_html_e('Ready to apply?') ?>
			</p>
			<p class="text-[#888888] text-sm lg:text-bodyRegular text-right lg:text-left">
				<?php esc_html_e('Send your application to tomas@plementops.com') ?>
			</p>
		</div>
		<a href="<?php echo esc_url($apply_link['url']) ?>" class="icon_button_outlined_dark group"
			target="<?php echo esc_attr($apply_link['target']) ?>">
			<?php echo esc_html($apply_link['title']) ?>
			<?php plmt_arrow() ?>
		</a>
	</div>
	<?php
}

?>

<div class="container pt-7 pb-10 lg:pt-6 lg:pb-16">
	<a href="/careers"
		class="flex text-darkGray gap-2 text-sm lg:text-bodyRegular items-center hover:text-accent transition-colors duration-200 ease-in-out">
		<?php plmt_arrow_left(); ?>
		<?php esc_html_e('Back to Careers'); ?>
	</a>
	<div class="maw-w-[57.5rem] w-full mx-auto lg:text-center mt-3 lg:mt-4">
		<h1 class="text-h1Mobile lg:text-h1">
			<?php echo get_the_title() ?>
		</h1>
		<?php if ($excerpt): ?>
			<p class="text-titleMobile lg:text-title text-darkGray mt-3 lg:mt-4">
				<?php esc_html_e($excerpt); ?>
			</p>
		<?php endif; ?>
		<a href='#apply' class='button text-title font-medium mt-3 lg:mt-4 w-full justify-center md:w-auto scroll-to '>
			<?php esc_html_e('Apply for this role') ?>
			<span class="-rotate-90">
				<?php plmt_arrow_left() ?>
			</span>
		</a>
	</div>
	<div class="max-w-[45rem] w-full mx-auto mt-6 lg:mt-10">
		<?php career_info_tabs($info_tabs) ?>
	</div>
	<div class="article-content max-w-[45rem] mx-auto mt-8 lg:mt-10">
		<?php get_template_part('template-parts/section/careers/section-career-content') ?>
	</div>
	<div x-data="{filloutOpen: false}" class="max-w-[57.5rem] w-full mx-auto lg:text-center mt-8 lg:mt-10">
		<?php career_apply_section($apply_link) ?>
		<?php get_template_part('template-parts/content/content-fillout-modal'); ?>
	</div>
</div>
<?php
get_footer();