<?php
/**
 * Template part for displaying case study archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

?>

<article id="case-study-<?php the_ID(); ?>"
	class="flex flex-col-reverse lg:flex-row justify-between bg-lightGrayBg p-5 lg:p-10 gap-5">
	<div href="<?php echo esc_url( get_permalink() ); ?>"
		class="flex flex-col-reverse lg:flex-row justify-between gap-5 w-full no-underline text-inherit">
		<div class="max-w-[43.5rem] w-full">
			<header class="mb-5 lg:mb-9">
				<?php
				the_title( '<h2 class="text-h5Bold lg:text-h4Bold">', '</h2>' );
				?>
			</header><!-- .entry-header -->

			<div class="border-l-2 border-l-accent pl-5 mb-5 lg:mb-9">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->

			<div>
				<?php
				$category = get_the_category();
				if ( $category ) {
					echo '<span class="text-darkGray">' . esc_html( $category[0]->name ) . '</span>';
				}
				?>
			</div>
			<a href="<?php echo esc_url( get_permalink() ); ?>"
				class="flex items-center gap-2 mt-4 lg:mt-6 hover:text-accent transition duration-200 ease-in-out">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="2" y="2" width="20" height="20" rx="10" fill="#ED5623" />
					<path d="M7.75736 11.9995H16.2426M16.2426 11.9995L12 7.75691M16.2426 11.9995L12 16.2422"
						stroke="white" />
				</svg>
				<span class="text-bodyBold"><?php esc_html_e( 'READ THE FULL CASE STUDY', 'plmt' ); ?></span>
			</a>
		</div>
		<div
			class="flex-shrink-0 [&_img]:w-auto [&_img]:h-[100px] [&_img]:object-contain [&_img]:lg:h-[197px] lg:flex items-center">
			<?php plmt_post_thumbnail(); ?>
		</div>
	</div>
</article><!-- #post-${ID} -->