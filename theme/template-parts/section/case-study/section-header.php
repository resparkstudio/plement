<div class="bg-lightGrayBg p-10">
	<header class="flex items-center [&_svg]:w-[24px] [&_svg]:h-[24px] [&_svg]:text-accent gap-[0.625rem] mb-5 lg:mb-9">
		<?php
		the_title( sprintf( '<h2 class="text-h5Bold lg:text-h1"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		plmt_arrow( 'w-[24px]', 'h-[24px]' );
		?>
	</header><!-- .entry-header -->


	<div class="border-l-2 border-l-accent pl-5">
		<?php the_excerpt(); ?>
	</div>
</div>