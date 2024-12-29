<section class="bg-mainBlack text-white p-10 grid grid-cols-[200px,1fr] gap-[1.25rem]">
	<div>
		<h2 class="text-h4Bold"><?php the_sub_field( 'title' ); ?></h2>
	</div>
	<div>
		<?php
		if ( have_rows( 'items' ) ) :
			?>
			<ul>
				<?php
				while ( have_rows( 'items' ) ) :
					the_row();
					$is_first = get_row_index() === 1;
					?>
					<li
						class="flex flex-col gap-[0.375rem] py-[1.875rem] border-b border-b-[#526369] <?php echo $is_first ? 'border-t border-t-[#526369]' : ''; ?>">
						<h3 class="text-title"><?php the_sub_field( 'title' ); ?></h3>
						<div class="text-bodySmall"><?php the_sub_field( 'text' ); ?></div>
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