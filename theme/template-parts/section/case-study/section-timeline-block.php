<section class="bg-mainBlack text-white p-6 lg:p-10 grid grid-cols-1 lg:grid-cols-[200px,1fr] gap-[1.25rem]">
	<div>
		<h2 class="font-extrabold text-[1.5rem] leading-[1.65rem] lg:text-h4Bold"><?php the_sub_field( 'title' ); ?>
		</h2>
	</div>
	<div>
		<?php
		$total_items = count( get_sub_field( 'items' ) );
		if ( have_rows( 'items' ) ) :
			?>
			<ul class="divide-y divide-[#526369]">
				<?php
				while ( have_rows( 'items' ) ) :
					the_row();
					$is_first = get_row_index() === 1;
					$is_last  = get_row_index() === $total_items;
					?>
					<li
						class="flex flex-col gap-[0.375rem] py-[1.875rem] <?php echo $is_first ? '!pt-0' : ''; ?> <?php echo $is_last ? '!pb-0' : ''; ?>">
						<h3 class="text-title"><?php the_sub_field( 'title' ); ?></h3>
						<div><?php the_sub_field( 'text' ); ?></div>
					</li>
					<?php
				endwhile;
				?>
			</ul>
			<?php
		endif;
		?>
	</div>
</section>