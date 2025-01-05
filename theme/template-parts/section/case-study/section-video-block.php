<section class="bg-lightGrayBg pt-5 lg:p-10 grid grid-cols-1 lg:grid-cols-[200px,1fr] gap-[1.25rem]">
	<div class="px-5 lg:px-0">
		<h2 class="font-extrabold text-[1.5rem] leading-[1.65rem] lg:text-h4Bold"><?php the_sub_field( 'title' ); ?>
		</h2>
	</div>
	<div class="[&_iframe]:w-full [&_iframe]:h-auto [&_iframe]:aspect-[595/337]">
		<?php the_sub_field( 'video_embed' ); ?>
	</div>
</section>