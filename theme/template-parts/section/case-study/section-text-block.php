<section class="bg-lightGrayBg p-5 lg:p-10 grid grid-cols-1 lg:grid-cols-[200px,1fr] gap-[1.25rem]">
	<div>
		<h2 class="font-extrabold text-[1.5rem] leading-[1.65rem] lg:text-h4Bold"><?php the_sub_field( 'title' ); ?>
		</h2>
	</div>
	<div>
		<?php the_sub_field( 'content' ); ?>
	</div>
</section>