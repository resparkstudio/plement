<section class="bg-lightGrayBg p-10 grid grid-cols-[200px,1fr] gap-[1.25rem]">
	<div>
		<h2 class="text-h4Bold"><?php the_sub_field( 'title' ); ?></h2>
	</div>
	<div>
		<div class="flex flex-col justify-between h-full bg-lightGrayBg">
			<div class="mb-4">
				<div class="flex items-center mb-2 gap-2">
					<svg width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M16.8198 7.73795L13.316 11.1535L14.1434 15.9775C14.1794 16.1884 14.0928 16.4016 13.9195 16.5276C13.8217 16.599 13.7052 16.635 13.5888 16.635C13.4993 16.635 13.4093 16.6136 13.3272 16.5703L8.99484 14.2928L4.66303 16.5698C4.47403 16.6699 4.24396 16.6536 4.07071 16.527C3.89746 16.401 3.81084 16.1878 3.84684 15.9769L4.67428 11.1529L1.1699 7.73795C1.0169 7.58833 0.961214 7.36445 1.02759 7.16139C1.09396 6.95833 1.27003 6.80927 1.48209 6.77833L6.32465 6.0752L8.49028 1.68658C8.67984 1.30239 9.30984 1.30239 9.4994 1.68658L11.665 6.0752L16.5076 6.77833C16.7197 6.80927 16.8957 6.95777 16.9621 7.16139C17.0285 7.36502 16.9728 7.58777 16.8198 7.73795Z"
							fill="#ED5623" />
					</svg>
					<span class="text-bodyBold"><?php echo esc_html_e( the_sub_field( 'rating' ) ) ?></span>
				</div>
				<h5 class="text-bodyBold mb-3 lg:text-h5Bold lg:mb-4">
					<?php echo esc_html( the_sub_field( 'testimonial_title' ) ) ?>
				</h5>
				<p class="mb-3 whitespace-pre-line"><?php echo esc_html( the_sub_field( 'text' ) ) ?></p>
			</div>
			<div class="flex items-center gap-5">
				<?php $image = get_sub_field( 'icon' ) ?>
				<img class="rounded-full w-[3.75rem] h-[3.75rem]" src="<?php echo esc_url( $image['url'] ) ?>"
					alt="<?php echo esc_attr( $image['alt'] ) ?>">
				<div class="text-bodySmall lg:text-bodyRegular text-darkGray">
					<p><?php esc_html_e( the_sub_field( 'name' ) ) ?></p>
					<div
						class="[&_a]:underline [&_a]:hover:text-accentHover [&_a]:transition [&_a]:duration-200 [&_a]:ease-in-out">
						<?php echo the_sub_field( 'position' ) ?>
					</div>
				</div>
			</div>
		</div>
</section>