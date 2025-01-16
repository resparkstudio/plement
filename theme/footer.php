<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the `#content` element and all content thereafter.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Plement
 */

$calendly_url_packages = get_field( 'calendly_url_packages', 'option' );
$calendly_url_contact  = get_field( 'calendly_url_contact', 'option' );

?>

</div><!-- #content -->

<?php get_template_part( 'template-parts/layout/footer', 'content' ); ?>

<div class="calendly-url-packages" data-url="<?php echo $calendly_url_packages ?>"></div>
<div class="calendly-url-contact" data-url="<?php echo $calendly_url_contact ?>"></div>
</div><!-- #page -->

<?php wp_footer(); ?>

<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script>
	tippy('.compare-tippy', {
		theme: 'custom',
		onTrigger: () => {
			console.log('clicked');
		}
	});

	tippy('.pricing-mobile-tippy', {
		theme: 'custom',
		placement: 'bottom-end',
		allowHTML: true,
		content: `${content}`,
		interactive: true,
		trigger: 'click',
		maxWidth: 'none',
	});

	tippy('.pricing-tippy', {
		theme: 'custom',
		placement: 'bottom-end',
	});
</script>
<!-- Start cookieyes banner -->
<script id="cookieyes" type="text/javascript"
	src="https://cdn-cookieyes.com/client_data/7ee0da461f6d84df18a2e37b/script.js"></script>
<!-- End cookieyes banner -->
</body>

</html>