<?php
$about_plement    = get_field('about_plement');
$role_overview    = get_field('role_overview');
$responsibilities = get_field('responsibilities');
$skills           = get_field('skills');
$nice_to_have     = get_field('nice_to_have');
$why_join         = get_field('why_join');
$apply            = get_field('apply');

function plmt_render_career_heading($section)
{
	?>
	<?php if ($section['subheading']): ?>
		<h6 class="text-xs lg:text-sm font-bold mb-3 text-accent">
			<?php echo esc_html($section['subheading']) ?>
		</h6>
	<?php endif; ?>
	<?php if ($section['heading']): ?>
		<h4 class="text-h4BoldMobile lg:text-h4Bold mb-3">
			<?php echo esc_html($section['heading']) ?>
		</h4>
	<?php endif; ?>
<?php
}

function plmt_render_paragraphs($section)
{
	if (!$section['paragraphs']) {
		return;
	}

	?>
	<div>
		<?php plmt_render_career_heading($section) ?>
		<div class="flex flex-col w-full gap-4 lg:gap-5 text-bodySmall lg:text-lg">
			<?php
			foreach ($section['paragraphs'] as $paragraph) {
				echo $paragraph['paragraph'];
			}
			?>
		</div>
	</div>
	<?php
}

function plmt_render_disc_list($section)
{
	if (!$section['list']) {
		return;
	}

	?>
	<div>
		<?php plmt_render_career_heading($section) ?>

		<ul class="text-bodySmall lg:text-lg text-darkGray">
			<?php foreach ($section['list'] as $item): ?>
				<li>
					<?php echo $item['list_item'] ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}

function plmt_render_check_list($section)
{
	if (!$section['list']) {
		return;
	}

	?>
	<div>
		<?php plmt_render_career_heading($section) ?>

		<ul class="article-checklist text-bodySmall lg:text-lg text-darkGray">
			<?php foreach ($section['list'] as $item): ?>
				<li>
					<?php echo $item['list_item'] ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}

function plmt_render_ordered_list($section)
{
	if (!$section['list']) {
		return;
	}

	?>
	<div>
		<?php plmt_render_career_heading($section) ?>

		<ol class="text-bodySmall lg:text-lg text-darkGray">
			<?php foreach ($section['list'] as $item): ?>
				<li>
					<?php echo $item['list_item'] ?>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
	<?php
}

?>

<div class="flex flex-col w-full gap-7 lg:gap-10">
	<?php
	plmt_render_paragraphs($about_plement);
	plmt_render_paragraphs($role_overview);
	plmt_render_disc_list($responsibilities);
	plmt_render_disc_list($skills);
	plmt_render_disc_list($nice_to_have);
	plmt_render_check_list($why_join);
	plmt_render_ordered_list($apply);
	?>
</div>