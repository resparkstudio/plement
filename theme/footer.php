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

?>

</div><!-- #content -->

<?php get_template_part( 'template-parts/layout/footer', 'content' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script>
	tippy('[data-tippy-content]', {
		theme: 'custom',
	});

	const tippyButton = document.querySelectorAll('.tippy-button');
	const xIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"/></svg>';
	tippyButton.forEach((button) => {
		const content = button.getAttribute('data-content');

		tippy(button, {
			theme: 'custom',
			placement: 'top',
			allowHTML: true,
			content: `${content}`,
			interactive: true,
			trigger: 'click',
			maxWidth: 'none',
		});
	})
</script>
<!-- Start cookieyes banner -->
<script id="cookieyes" type="text/javascript"
	src="https://cdn-cookieyes.com/client_data/7ee0da461f6d84df18a2e37b/script.js"></script>
<!-- End cookieyes banner -->
</body>

</html>