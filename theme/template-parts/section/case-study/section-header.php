<div class="bg-lightGrayBg p-6 lg:p-10">
	<header class="flex items-center [&_svg]:w-[24px] [&_svg]:h-[24px] [&_svg]:text-accent gap-[0.625rem] mb-5 lg:mb-9">
		<h2 class="text-h4Bold lg:text-h1 lg:!text-[3rem]">
			<?php
			the_title();
			?>
		</h2>
	</header><!-- .entry-header -->


	<div class="border-l-2 border-l-accent pl-5 lg:pl-10 mb-6 lg:mb-8">
		<?php the_excerpt(); ?>
	</div>

	<div>
		<?php
		$category = get_the_category();
		if ( $category ) {
			echo '<span class="text-darkGray">' . esc_html( $category[0]->name ) . '</span>';
		}
		?>
	</div>
</div>