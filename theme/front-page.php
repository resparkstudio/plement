<?php
/**
 * The template for displaying ftont page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();

$page_sections = [ 
	'hero',
	'about',
	'services-tabs',
	'compare',
	'license',
	'steps',
	'case-studies',
	'partnership',
	'testimonials',
	'partner',
	'faq',
	'contact-us'
]
	?>

<main class="relative z-10 bg-white">

	<section id='primary'>
		<div id='main'>
			<?php foreach ( $page_sections as $section ) : ?>
				<?php get_template_part( 'template-parts/section/section-' . $section ); ?>
			<?php endforeach; ?>
		</div>
	</section>

	<?php
	get_footer();
	?>
</main>