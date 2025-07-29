<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

$is_dark = $args['is_dark'];

if ( ! function_exists( 'plmt_header_button' ) ) {
	function plmt_header_button( $item, $has_children, $is_contact_us = false ) {
		$use_span  = empty( $item['url'] ) || $item['url'] === '#';
		$tag       = $use_span ? 'span' : 'a';
		$href_attr = $use_span ? '' : 'href="' . esc_url( $item['url'] ) . '"';
		?>
		<<?php echo $tag; ?> 		<?php echo $href_attr; ?>
			class="group flex items-center justify-center h-full w-full text-bodyRegular transition-colors duration-300
			hover:bg-accent <?php echo $is_contact_us ? 'text-accent gap-2 font-bold' : '' ?>
			<?php echo $use_span ? 'cursor-pointer' : '' ?>"
			:class="overlayOpen && <?php echo $has_children ? 1 : 0 ?> ? '!bg-accent text-white' : ''">
			<span class="group-hover:text-white">
				<?php echo esc_html( $item['title'] ); ?>
			</span>
			<?php if ( $has_children ) : ?>
				<svg :class="overlayOpen && 'rotate-180 text-white'" class="group-hover:text-white" width="17" height="16"
					viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M14.295 5.80865C14.2571 5.71729 14.193 5.6392 14.1108 5.58426C14.0286 5.52932 13.9319 5.5 13.833 5.5H3.83301C3.73412 5.5 3.63745 5.52932 3.55522 5.58427C3.473 5.63921 3.40891 5.7173 3.37107 5.80866C3.33322 5.90003 3.32332 6.00056 3.34262 6.09755C3.36191 6.19455 3.40953 6.28364 3.47946 6.35356L8.47946 11.3535C8.52589 11.4 8.58101 11.4368 8.64167 11.4619C8.70233 11.4871 8.76735 11.5 8.83301 11.5C8.89867 11.5 8.96369 11.4871 9.02435 11.4619C9.08501 11.4368 9.14013 11.4 9.18656 11.3535L14.1866 6.35356C14.2565 6.28364 14.3041 6.19454 14.3234 6.09755C14.3427 6.00056 14.3328 5.90002 14.295 5.80865Z"
						fill="currentColor" />
				</svg>
			<?php endif; ?>
			<?php if ( $is_contact_us ) : ?>
				<?php plmt_arrow(); ?>
			<?php endif; ?>
		</<?php echo $tag; ?>>
		<?php
	}
}
?>

<style>
	[x-cloak] {
		display: none !important;
	}
</style>

<header id="masthead" x-data="{menuOpen: false}" class="sticky top-0 z-[1000]">
	<div
		class="flex items-center justify-between z-[100]  container lg:max-w-none lg:p-0 lg:border-b  <?php echo $is_dark ? 'bg-mainBlack lg:border-b-darkGray' : 'bg-white lg:border-b-lightGray' ?>">
		<?php if ( get_theme_mod( 'site_logo' ) && $is_dark ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				class="lg:border-r py-[1.0625rem] lg:px-[75px] <?php echo $is_dark ? 'border-r-darkGray' : 'border-r-lightGray' ?>">
				<img src="<?php echo esc_attr( get_theme_mod( 'site_logo' ) ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="lg:h-[2.875rem] aspect-[150/46]">
			</a>
		<?php elseif ( get_theme_mod( 'site_logo_dark' ) && ! $is_dark ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				class="lg:border-r py-[1.0625rem] lg:px-[75px] <?php echo $is_dark ? 'border-r-darkGray' : 'border-r-lightGray' ?>">
				<img src="<?php echo esc_attr( get_theme_mod( 'site_logo_dark' ) ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="lg:h-[2.875rem] aspect-[150/46]">
			</a>
		<?php endif; ?>

		<nav id="site-navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'plement' ); ?>">
			<?php
			$menu_locations = get_nav_menu_locations();
			$menu_id        = $menu_locations['menu-1'];

			$items = plmt_menu_builder( $menu_id );

			?>
			<ul class="hidden h-[5rem] w-full items-center lg:flex" @mouseover.away="overlayOpen = false"
				@click.away="overlayOpen = false">
				<?php
				foreach ( $items as $item ) :
					$is_contact_us = isset( $item['is_contact_us'] ) && $item['is_contact_us'];
					$has_children  = isset( $item['children'] ) && count( $item['children'] );
					?>
					<li class="h-full w-full border-r <?php echo $is_dark ? 'text-white border-r-darkGray' : 'text-mainBlack border-r-lightGray' ?>"
						<?php echo ! $has_children ? '@mouseover="overlayOpen = false"' : '' ?>
						@click='overlayOpen = <?php echo $has_children ? '!overlayOpen' : 0 ?>'>
						<?php plmt_header_button( $item, $has_children, $is_contact_us ); ?>
						<?php if ( $has_children ) : ?>
							<ul x-cloak x-show='overlayOpen'
								class='border-t border-t-textSecondary px-[4.125rem] grid grid-cols-2 top-[5rem]  z-[1000] absolute left-1/2 -translate-x-1/2  w-full focus:outline-none <?php echo $is_dark ? 'bg-mainBlack' : 'bg-white' ?>'
								role='menu' aria-orientation='vertical' tabindex='-1'
								x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0"
								x-transition:enter-end="opacity-100" x-transition:leave="transition duration-200"
								x-transition:leave-end="opacity-0">
								<?php foreach ( $item['children'] as $child ) :
									$bullets = get_field( 'bullets', $child['ID'] );
									?>
									<li
										class=" transition-colors duration-300 ease-in-out <?php echo $is_dark ? 'hover:bg-darkGray2' : 'hover:bg-lightGrayBg' ?>">
										<a href="<?php echo esc_url( url: $child['url'] ); ?>"
											class="inline-block py-5 px-10 w-full h-full">
											<div class="flex items-center gap-2 mb-4">
												<?php if ( isset( $child['image'] ) && $child['image'] && $is_dark ) : ?>
													<img class="w-5 h-5" src="<?php echo esc_url( $child['image']['url'] ) ?>"
														alt="<?php echo esc_attr( $child['image']['alt'] ) ?>">
												<?php endif; ?>
												<?php if ( isset( $child['dark_image'] ) && $child['dark_image'] && ! $is_dark ) : ?>
													<img class="w-5 h-5" src="<?php echo esc_url( $child['dark_image']['url'] ); ?>"
														alt="<?php echo esc_attr( $child['title'] ); ?> dark_image">
												<?php endif; ?>
												<p class="text-h5Bold">
													<?php echo esc_html( $child['title'] ); ?>
												</p>
											</div>
											<?php if ( isset( $child['description'] ) ) : ?>
												<p
													class="text-bodyRegular <?php echo $is_dark ? 'text-textSecondary' : 'text-textBlack' ?>">
													<?php echo esc_html( $child['description'] ); ?>
												</p>
											<?php endif; ?>
											<?php if ( $bullets ) : ?>
												<ul class="mt-4 space-y-2">
													<?php foreach ( $bullets as $bullet ) : ?>
														<li
															class="flex items-center gap-2 <?php echo $is_dark ? 'text-textSecondary' : 'text-textBlack' ?>">
															<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																xmlns="http://www.w3.org/2000/svg">
																<circle cx="8" cy="8" r="2" fill="currentColor" />
															</svg>
															<span class="text-bodySmall">
																<?php echo esc_html( $bullet['item'] ); ?>
															</span>
														</li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>

		</nav><!-- #site-navigation -->

		<div class="lg:hidden relative z-[1000]">
			<button @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" type="button"
				class="flex text-textBlack lg:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
				<div class=" text-center  three col <?php echo $is_dark ? 'text-white' : 'text-textBlack' ?>">
					<div class="hamburger" id="hamburger-1">
						<span
							class="w-[24px] h-[2px] rounded-full block my-[4px] mx-auto transition-all duration-300 ease-in-out <?php echo $is_dark ? 'bg-white' : 'bg-textBlack' ?>"
							:class="menuOpen ? 'translate-y-[6px] rotate-[45deg] !bg-white' : ''"></span>
						<span
							class="w-[21px] h-[2px] rounded-full block my-[4px] mx-auto transition-all duration-300 ease-in-out <?php echo $is_dark ? 'bg-white' : 'bg-textBlack' ?>"
							:class="menuOpen ? 'opacity-0' : ''"></span>
						<span
							class="w-[24px] h-[2px] rounded-full block my-[4px] mx-auto transition-all duration-300 ease-in-out <?php echo $is_dark ? 'bg-white' : 'bg-textBlack' ?>"
							:class="menuOpen ? 'translate-y-[-6px] rotate-[-45deg] !bg-white' : ''"></span>
					</div>
				</div>
			</button>

		</div>
	</div>
	<nav x-data="{childOpen: false}" x-cloak x-show="menuOpen" x-trap.inert.noscroll="menuOpen"
		@click.away="menuOpen=false" id="site-navigation"
		class="fixed inset-y-0 right-0 z-[100] w-full flex justify-end lg:hidden bg-[#0000003D] h-screen transition-[cubic-bezier(.13,1.24,.92,.93)]"
		aria-label="<?php esc_attr_e( 'Main Navigation', 'plement' ); ?>" x-transition:enter="transform duration-800"
		x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
		x-transition:leave="transform duration-800" x-transition:leave-start="translate-x-0"
		x-transition:leave-end="translate-x-full">
		<?php
		$menu_locations = get_nav_menu_locations();
		$menu_id        = $menu_locations['menu-1'];

		$items = plmt_menu_builder( $menu_id );

		?>
		<div class="w-full">
			<ul class="overflow-y-scroll bg-mainBlack text-white h-screen w-full pt-[8.25rem]">
				<?php
				foreach ( $items as $item ) :
					$is_contact_us = isset( $item['is_contact_us'] ) && $item['is_contact_us'];
					$has_children  = isset( $item['children'] ) && count( $item['children'] );
					?>
					<li x-data="{open: false}" @mouseover='open = true' @mouseover.away="open = false" class="w-full"
						:class="childOpen ? 'mb-4' : 'mb-8'" <?php echo $has_children ? '@click="childOpen = !childOpen"' : '' ?>>
						<a href="<?php echo esc_url( $item['url'] ); ?>"
							class="text-white px-4 py-3 group flex items-center h-full w-full text-h5Regular <?php echo $is_contact_us ? 'text-accent gap-2' : 'justify-between' ?>">
							<span>
								<?php echo esc_html( $item['title'] ); ?>
							</span>
							<?php if ( $is_contact_us ) : ?>
								<?php plmt_arrow(); ?>
							<?php endif; ?>
							<?php if ( $has_children ) : ?>
								<svg class="mr-4" width="16" height="16" viewBox="0 0 16 16" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M13.4619 5.80865C13.4241 5.71729 13.36 5.6392 13.2778 5.58426C13.1956 5.52932 13.0989 5.5 13 5.5H3C2.90111 5.5 2.80444 5.52932 2.72221 5.58427C2.63999 5.63921 2.5759 5.7173 2.53806 5.80866C2.50022 5.90003 2.49031 6.00056 2.50961 6.09755C2.5289 6.19455 2.57653 6.28364 2.64646 6.35356L7.64646 11.3535C7.69288 11.4 7.748 11.4368 7.80866 11.4619C7.86932 11.4871 7.93434 11.5 8 11.5C8.06566 11.5 8.13068 11.4871 8.19134 11.4619C8.252 11.4368 8.30712 11.4 8.35355 11.3535L13.3535 6.35356C13.4235 6.28364 13.4711 6.19454 13.4904 6.09755C13.5097 6.00056 13.4998 5.90002 13.4619 5.80865Z"
										fill="white" />
								</svg>
							<?php endif; ?>
						</a>
					</li>
					<?php if ( $has_children ) : ?>
						<ul x-show="childOpen" class="space-y-3 mb-[2.75rem]">
							<?php foreach ( $item['children'] as $item ) :
								$bullets = get_field( 'bullets', $item['ID'] );
								?>
								<li x-data="{open: false}" @mouseover='open = true' @mouseover.away="open = false"
									class="w-full px-4">
									<a href="<?php echo esc_url( $item['url'] ); ?>"
										class="py-3 border-b-lightGray border-b group flex items-start gap-2 justify-between h-full w-full">
										<div>
											<div class="flex items-center gap-1 mb-3">
												<?php if ( isset( $item['image'] ) && $item['image'] && $is_dark ) : ?>
													<img class="w-5 h-5 mr-2" src="<?php echo esc_url( $item['image']['url'] ); ?>"
														alt="<?php echo esc_attr( $item['title'] ); ?> image">
												<?php endif; ?>
												<?php if ( isset( $item['dark_image'] ) && $item['dark_image'] && ! $is_dark ) : ?>
													<img class="w-5 h-5 mr-2" src="<?php echo esc_url( $item['dark_image']['url'] ); ?>"
														alt="<?php echo esc_attr( $item['title'] ); ?> dark_image">
												<?php endif; ?>
												<span class="text-bodyBold">
													<?php echo esc_html( $item['title'] ); ?>
												</span>
											</div>
											<?php if ( $bullets ) : ?>
												<ul class="space-y-1">
													<?php foreach ( $bullets as $bullet ) : ?>
														<li class="flex items-center gap-2 text-bodySmall">
															<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																xmlns="http://www.w3.org/2000/svg">
																<circle cx="8" cy="8" r="2" fill="#B2B2B2" />
															</svg>
															<span class="text-bodySmall text-textSecondary">
																<?php echo esc_html( $bullet['item'] ); ?>
															</span>
														</li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>
										</div>
										<svg class="min-w-6 min-h-6" width="24" height="24" viewBox="0 0 24 24" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M3.75 12H20.25" stroke="#ED5623" stroke-width="1.5" stroke-linecap="round"
												stroke-linejoin="round" />
											<path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="#ED5623" stroke-width="1.5"
												stroke-linecap="round" stroke-linejoin="round" />
										</svg>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

				<?php endforeach; ?>
			</ul>
		</div>
	</nav>


</header><!-- #masthead -->

<div x-cloak x-show='overlayOpen'
	class="absolute bg-[#4B4B4B29] w-full left-0 top-[5rem] min-h-full backdrop-blur-[4px] z-[100]">
</div>