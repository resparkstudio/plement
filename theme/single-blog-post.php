<?php
/**
 * The template for displaying single blog post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Plement
 */

get_header(null, array('type' => 'light'));

$excerpt = get_field('excerpt');

$blog_page = get_page_by_path('blog');

$related_posts_enabled = $blog_page
	? get_field('related_posts_enabled', $blog_page->ID)
	: null;

function plmt_get_headings_from_content($content)
{
	if (!$content) {
		return [];
	}

	$headings = [];

	libxml_use_internal_errors(true);

	$dom = new DOMDocument();
	$dom->loadHTML('<?xml encoding="utf-8" ?>' . $content);

	$xpath = new DOMXPath($dom);
	$nodes = $xpath->query('//h1|//h2|//h3|//h4|//h5|//h6');

	foreach ($nodes as $node) {
		$tag        = strtolower($node->nodeName);
		$headings[] = [
			'tag' => $tag,
			'text' => trim($node->textContent),
			'id' => $node->getAttribute('id'),
		];
	}

	libxml_clear_errors();

	return $headings;
}


$headings = plmt_get_headings_from_content(get_the_content());

function plmt_blog_contents($headings)
{
	?>
	<div class="hidden lg:block">
		<span class="text-title font-bold">
			<?php esc_html_e('Contents', 'plmt'); ?>
		</span>
		<ul>
			<?php foreach ($headings as $heading): ?>
				<li>
					<a href="#<?php echo $heading['id'] ?>"
						class="blog-scroll-to text-title hover:text-accent transition-all duration-200">
						<?php echo esc_html($heading['text']) ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="relative w-full sm:max-w-max lg:hidden"
		x-data="{selectOpen: false, selectedItem: {value: 'all', title: 'All'}}" @click.away="selectOpen = false">
		<button @click="selectOpen = !selectOpen"
			class="text-titleMobile relative flex items-center justify-between w-full text-left cursor-default focus:outline-none font-bold">
			<span>
				<?php esc_html_e('Contents', 'plmt'); ?>
			</span>
			<span>
				<svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg"
					:class="{ 'rotate-180' : selectOpen }">
					<path
						d="M10.9619 0.308655C10.9241 0.217292 10.86 0.139204 10.7778 0.0842643C10.6956 0.0293243 10.5989 5.83729e-08 10.5 0H0.500002C0.40111 -3.89443e-07 0.304439 0.0293245 0.222214 0.0842662C0.139988 0.139208 0.0759017 0.217299 0.0380584 0.308663C0.000215113 0.400028 -0.00968528 0.500563 0.00960936 0.597554C0.028904 0.694546 0.0765272 0.783637 0.146456 0.853562L5.14646 5.85355C5.19288 5.89998 5.248 5.93681 5.30866 5.96194C5.36932 5.98707 5.43434 6 5.5 6C5.56566 6 5.63068 5.98707 5.69134 5.96194C5.752 5.93681 5.80712 5.89998 5.85355 5.85355L10.8535 0.853562C10.9235 0.783636 10.9711 0.694543 10.9904 0.59755C11.0097 0.500557 10.9998 0.400021 10.9619 0.308655Z"
						fill="#111F24" />
				</svg>
			</span>
		</button>
		<ul x-show="selectOpen" x-transition class="w-full overflow-auto text-titleMobile" x-cloak>
			<?php foreach ($headings as $heading): ?>
				<li @click="selectOpen = false"
					class="pt-2 first:pt-3 relative z-[100] flex items-center justify-between h-full cursor-default select-none">
					<a href="#<?php echo esc_url($heading['id']) ?>">
						<?php echo esc_html($heading['text']) ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}

?>

<div class="container pt-7 pb-10 lg:pt-6 lg:pb-16">
	<a href="/blog"
		class="flex text-darkGray gap-2 text-sm lg:text-bodyRegular items-center hover:text-accent transition-colors duration-200 ease-in-out">
		<?php plmt_arrow_left(); ?>
		<?php esc_html_e('Back to Blog'); ?>
	</a>
	<div class="lg:text-center mt-3">
		<div class="flex w-full lg:justify-center">
			<?php plmt_blog_card_taxonomy_beads(get_post()); ?>
		</div>
		<h1 class="text-h1Mobile lg:text-h1 max-w-[57.25rem] w-full mx-auto mt-2 lg:mt-3">
			<?php echo get_the_title() ?>
		</h1>
		<?php if ($excerpt): ?>
			<p class="text-titleMobile lg:text-title text-darkGray mt-3 lg:mt-4 max-w-[53.25rem] w-full mx-auto">
				<?php esc_html_e($excerpt); ?>
			</p>
		<?php endif; ?>
		<div class="flex w-full lg:justify-center mt-2 lg:mt-3">
			<?php plmt_blog_data_row(get_post()); ?>
		</div>
		<div>
			<?php
			if (has_post_thumbnail()) {
				echo get_the_post_thumbnail(get_post(), 'medium_large', [
					'class' => 'max-w-[75rem] mx-auto w-full h-auto object-cover aspect-[343/240] mt-6 lg:mt-10 lg:aspect-[1200/480]',
					'alt' => get_the_title(),
				]);
			}
			?>
		</div>
	</div>
	<div class="flex-col gap-6 lg:grid grid-cols-[1fr_720px_1fr] flex mx-auto mt-6 lg:mt-10 max-w-[75rem] w-full">
		<?php plmt_blog_contents($headings) ?>
		<div class="article-content max-w-[45rem] w-full mx-auto">
			<?php the_content(); ?>
		</div>
	</div>

	<?php if ($related_posts_enabled): ?>
		<?php get_template_part('template-parts/section/blog/section-related-articles') ?>
	<?php endif; ?>
</div>

<?php
get_footer();