<section class="bg-lightGrayBg p-10 grid grid-cols-[200px,1fr] gap-[1.25rem]">
	<div>
		<h2 class="text-h4Bold"><?php the_sub_field( 'title' ); ?></h2>
	</div>
	<div class="[&_iframe]:w-full [&_iframe]:aspect-widescreen">
		<?php the_sub_field( 'video_embed' ); ?>
	</div>
</section>