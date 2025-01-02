<div class="swiper-container relative mx-auto">
	<div class="swiper other-studies-swiper">
		<div class="swiper-wrapper !flex">
			<?php
			$case_studies = get_posts( array(
				'post_type' => 'case-study',
				'posts_per_page' => 6,
				'post__not_in' => array( get_the_ID() ),
			) );

			foreach ( $case_studies as $case_study ) {
				$thumbnail = get_the_post_thumbnail_url( $case_study->ID, 'medium' );
				?>
				<article
					class="swiper-slide group flex flex-col justify-between bg-lightGrayBg p-5 lg:p-10 gap-5 border border-transparent hover:border-accent transition duration-200 ease-in-out">
					<a href="<?php echo esc_url( get_the_permalink( $case_study->ID ) ) ?>"
						class="flex flex-col justify-between bg-lightGrayBg gap-4 lg:gap-6">
						<div class="flex-shrink-0 [&_img]:aspect-[172/100] [&_img]:w-[10.75rem] [&_img]:h-[6.25rem]">
							<img src="<?php echo esc_url( $thumbnail ); ?>"
								alt="<?php echo esc_attr( $case_study->post_title ); ?>">
						</div>
						<div class="max-w-[43.5rem] w-full">
							<header class="mb-5 lg:mb-9">
								<h2 class="text-h5Bold">
									<?php
									echo get_the_title( $case_study->ID );
									?>
								</h2>
							</header><!-- .entry-header -->


							<div class="border-l-2 border-l-accent pl-5 mb-5 lg:mb-9">
								<?php echo get_the_excerpt( $case_study->ID ) ?>
							</div><!-- .entry-content -->

							<div>
								<?php
								$category = get_the_category( $case_study->ID );
								if ( $category ) {
									echo '<span class="text-darkGray">' . esc_html( $category[0]->name ) . '</span>';
								}
								?>
							</div>
							<div class="flex items-center gap-2 mt-4 lg:mt-6">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M12 2.25C10.0716 2.25 8.18657 2.82183 6.58319 3.89317C4.97982 4.96451 3.73013 6.48726 2.99218 8.26884C2.25422 10.0504 2.06114 12.0108 2.43735 13.9021C2.81355 15.7934 3.74215 17.5307 5.10571 18.8943C6.46928 20.2579 8.20656 21.1865 10.0979 21.5627C11.9892 21.9389 13.9496 21.7458 15.7312 21.0078C17.5127 20.2699 19.0355 19.0202 20.1068 17.4168C21.1782 15.8134 21.75 13.9284 21.75 12C21.747 9.41506 20.7188 6.93684 18.891 5.10901C17.0632 3.28118 14.5849 2.25299 12 2.25ZM16.4423 12.2864C16.4047 12.3779 16.3493 12.4611 16.2794 12.5312L13.0986 15.7119C12.9579 15.8523 12.7673 15.9311 12.5685 15.931C12.3698 15.9309 12.1792 15.8519 12.0387 15.7113C11.8981 15.5708 11.8191 15.3802 11.819 15.1815C11.8189 14.9827 11.8977 14.7921 12.0381 14.6514L13.9395 12.75H8.25C8.05109 12.75 7.86033 12.671 7.71967 12.5303C7.57902 12.3897 7.5 12.1989 7.5 12C7.5 11.8011 7.57902 11.6103 7.71967 11.4697C7.86033 11.329 8.05109 11.25 8.25 11.25H13.9395L12.0381 9.34863C11.8977 9.20794 11.8189 9.01728 11.819 8.81852C11.8191 8.61977 11.8981 8.42919 12.0387 8.28865C12.1792 8.14811 12.3698 8.06911 12.5685 8.069C12.7673 8.0689 12.9579 8.1477 13.0986 8.28809L16.2794 11.4688C16.3841 11.5738 16.4555 11.7075 16.4845 11.853C16.5135 11.9984 16.4988 12.1492 16.4423 12.2864V12.2864Z"
										fill="#ED5623" />
								</svg>
								<span
									class="text-bodyBold group-hover:text-accent transition duration-200 ease-in-out"><?php esc_html_e( 'READ THE FULL CASE STUDY', 'plmt' ); ?></span>
							</div>
						</div>
					</a>
				</article><!-- #post-${ID} -->
				<?php
			}
			?>
		</div>
		<div class="swiper-pagination !static mt-5"></div>
	</div>
	<button
		class="hidden lg:block absolute top-1/2 -translate-y-1/2 -left-[3.125rem] custom-swiper-button-prev p-3 rounded-full bg-lightGrayBg text-[#646464] hover:text-[#111F24] disabled:bg-[#E9E9E9] disabled:text-[#B2B2B2] disabled:pointer-events-none transition-colors ease-in-out">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M20.25 12H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
				stroke-linejoin="round" />
			<path d="M10.5 5.25L3.75 12L10.5 18.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
				stroke-linejoin="round" />
		</svg>
	</button>
	<button
		class="hidden lg:block absolute top-1/2 -translate-y-1/2 -right-[3.125rem] custom-swiper-button-next p-3 rounded-full bg-lightGrayBg text-[#646464] hover:text-[#111F24] disabled:bg-[#E9E9E9] disabled:text-[#B2B2B2] disabled:pointer-events-none transition-colors ease-in-out">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M3.75 12H20.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
				stroke-linejoin="round" />
			<path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
				stroke-linejoin="round" />
		</svg>
	</button>
</div>