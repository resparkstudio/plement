<section class="bg-lightGrayBg p-10 grid grid-cols-[200px,1fr] gap-[1.25rem]">
	<div>
		<h2 class="text-h4Bold"><?php the_sub_field( 'title' ); ?></h2>
	</div>
	<div>
		<?php the_sub_field( 'content' ); ?>
	</div>
</section>