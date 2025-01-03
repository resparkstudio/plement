<section class="bg-lightGrayBg p-5 lg:p-10 grid grid-cols-1 lg:grid-cols-[200px,1fr] gap-[1.25rem]">
	<div>
		<h2 class="font-extrabold text-[1.5rem] leading-[1.65rem] lg:text-h4Bold"><?php the_sub_field( 'title' ); ?>
		</h2>
	</div>
	<div>
		<?php
		$list_type = get_sub_field( 'type' );
		if ( have_rows( 'items' ) ) :
			?>
			<ul class="space-y-10">
				<?php
				while ( have_rows( 'items' ) ) :
					the_row();
					?>
					<li class="<?php echo $list_type === 'icon_top' ? 'flex gap-5' : 'flex items-start gap-5' ?>">
						<svg class="flex-shrink-0 " width="32" height="32" viewBox="0 0 32 32" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path d="M2 7.95809L15.8219 16L29.7277 7.95809L15.8219 0L2 7.95809Z" fill="#ED5623" />
							<path d="M15.8219 15.9999V31.9998L2 23.958V7.95801L15.8219 15.9999Z" fill="#FD8158" />
							<path d="M29.7143 7.95801V23.958L15.8086 31.9998V15.9999L29.7143 7.95801Z" fill="#D54515" />
						</svg>
						<div>
							<span class="text-title font-bold">
								<?php the_sub_field( 'item_title' ); ?>
							</span>
							<div class="text-title">
								<?php the_sub_field( 'item_text' ); ?>
							</div>
						</div>
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