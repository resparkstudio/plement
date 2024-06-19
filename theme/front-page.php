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
	'services',
	'pricing',
	'partner',
	'process',
	'integrations',
	'faq',
	'testimonials',
]
	?>

<section id='primary'>
	<main id='main'>
		<?php foreach ( $page_sections as $section ) : ?>
			<?php get_template_part( 'template-parts/section/section-' . $section ); ?>
		<?php endforeach; ?>
	</main>
</section>

<?php
get_footer();
