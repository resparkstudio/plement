<section class="bg-lightGrayBg pt-5 lg:p-10 grid grid-cols-1 lg:grid-cols-[200px,1fr] gap-[1.25rem]">
	<div class="px-5 lg:px-0">
		<h2 class="font-extrabold text-[1.5rem] leading-[1.65rem] lg:text-h4Bold">
			<?php the_sub_field( 'title' ); ?>
		</h2>
	</div>
	<div>
		<ul class="flex flex-wrap gap-2">
			<?php while ( have_rows( 'tools' ) ) :
				the_row(); ?>
				<li class="py-1.5 px-3 bg-white border border-lightGray">
					<?php the_sub_field( 'tool' ); ?>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>
</section>