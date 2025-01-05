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
				<article class="swiper-slide flex flex-col justify-between bg-lightGrayBg p-5 lg:p-10 gap-5">
					<div class="flex flex-col justify-between bg-lightGrayBg gap-4 lg:gap-6">
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
							<a href="<?php echo esc_url( get_the_permalink( $case_study->ID ) ) ?>"
								class="flex items-center gap-2 mt-4 lg:mt-6 hover:text-accent transition duration-200 ease-in-out">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<rect x="2" y="2" width="20" height="20" rx="10" fill="#ED5623" />
									<path d="M7.75736 11.9995H16.2426M16.2426 11.9995L12 7.75691M16.2426 11.9995L12 16.2422"
										stroke="white" />
								</svg>

								<span
									class="text-bodyBold"><?php esc_html_e( 'READ THE FULL CASE STUDY', 'plmt' ); ?></span>
							</a>
						</div>
					</div>
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