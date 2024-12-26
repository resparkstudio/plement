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

	<div class="max-w-[43.5rem] w-full">
		<header
			class="flex items-center lg:items-end [&_svg]:w-[24px] [&_svg]:h-[24px] [&_svg]:text-accent gap-[0.625rem] mb-5 lg:mb-9 group hover:text-accent trasition duration-200 ease-in-out">
			<?php
			the_title( sprintf( '<h2 class="text-h5Bold lg:text-h4Bold"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			plmt_arrow( 'w-[24px]', 'h-[24px]' );
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
	</div>
	<div
		class="flex-shrink-0 [&_img]:aspect-[172/100] [&_img]:lg:aspect-[340/197] [&_img]:w-[10.75rem] [&_img]:h-[6.25rem] [&_img]:lg:w-[340px] [&_img]:lg:h-[197px]">
		<?php plmt_post_thumbnail(); ?>
	</div>

</article><!-- #post-${ID} -->