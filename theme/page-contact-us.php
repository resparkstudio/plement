<?php
/**
 * The template for displaying ftont page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();
$heading   = get_field( 'heading' );
$shortcode = get_field( 'form_shortcode' );

?>

<section id='primary'>
	<main id='main' class="container">
		<h1
			class="my-10 lg:mb-20 lg:mt-[5.75rem] text-[2.375rem] leading-[2.625rem] lg:text-7xl lg:leading-[5rem] max-w-[52.75rem] font-medium">
			<?php echo esc_html( $heading ) ?>
		</h1>
		<div class="flex flex-col-reverse lg:flex-row gap-8 justify-between items-center lg:items-start">
			<div class="bg-lightGrayBg py-8 px-4 lg:p-14 max-w-[652px] w-full">
				<svg class="mb-4" width="50" height="50" viewBox="0 0 50 50" fill="none"
					xmlns="http://www.w3.org/2000/svg">
					<rect width="50" height="50" rx="8" fill="#ED5623" />
					<path
						d="M27.0057 27.705C26.4086 28.1031 25.7151 28.3135 25 28.3135C24.285 28.3135 23.5914 28.1031 22.9943 27.705L13.1598 21.1485C13.1052 21.1121 13.0521 21.0742 13 21.0352V31.7788C13 33.0106 13.9996 33.9882 15.2094 33.9882H34.7906C36.0224 33.9882 37 32.9886 37 31.7788V21.0352C36.9478 21.0742 36.8945 21.1123 36.8398 21.1487L27.0057 27.705Z"
						fill="white" />
					<path
						d="M13.9398 19.977L23.7744 26.5336C24.1466 26.7818 24.5733 26.9058 25 26.9058C25.4267 26.9058 25.8534 26.7817 26.2256 26.5336L36.0602 19.977C36.6487 19.5849 37 18.9286 37 18.2203C37 17.0025 36.0092 16.0117 34.7914 16.0117H15.2086C13.9908 16.0118 13 17.0025 13 18.2215C13 18.9286 13.3514 19.5849 13.9398 19.977Z"
						fill="white" />
				</svg>
				<h3 class=" mb-8"><?php esc_html_e( 'Send us a message', 'plmt' ) ?></h3>
				<?php echo apply_shortcodes( $shortcode ); ?>
			</div>
			<div>

				<?php get_template_part( 'template-parts/section/section-contact-info' ); ?>
			</div>
		</div>
		<?php get_template_part( 'template-parts/section/section-faq' ); ?>

	</main>
</section>

<?php
get_footer();
