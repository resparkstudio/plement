<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

?>

<style>
	[x-cloak] {
		display: none !important;
	}
</style>

<header id="masthead" class="relative" x-data="{menuOpen: false}">
	<div
		class="flex items-center justify-between relative z-[100] bg-white container lg:max-w-none lg:p-0 lg:border-b lg:border-b-textSecondary">
		<?php if ( get_theme_mod( 'site_logo' ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				class="lg:border-r border-r-textSecondary py-5 lg:px-[75px]">
				<img src="<?php echo esc_attr( get_theme_mod( 'site_logo' ) ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="lg:h-[40px]">
			</a>
		<?php else : ?>
			<a class="site-title"
				href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_url( bloginfo( 'name' ) ); ?></a>
		<?php endif; ?>

		<nav id="site-navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'plement' ); ?>">
			<?php
			$menu_locations = get_nav_menu_locations();
			$menu_id        = $menu_locations['menu-1'];

			$items = plmt_menu_builder( $menu_id );

			?>
			<ul class="hidden h-[5rem] w-full items-center lg:flex">
				<?php
				foreach ( $items as $item ) :
					$is_contact_us = isset( $item['is_contact_us'] ) && $item['is_contact_us'];
					$has_children  = isset( $item['children'] ) && count( $item['children'] );
					?>
					<li x-data="{open: false}" @mouseover='open = true' @mouseover.away="open = false"
						class="border-r-textSecondary h-full w-full border-r font-semibold">
						<a href="<?php echo esc_url( $item['url'] ); ?>"
							class="group flex items-center justify-center h-full w-full text-bodyRegular hover:text-white hover:bg-accent transition-colors duration-300 <?php echo $is_contact_us ? 'text-accent !text-bodyBold gap-2' : '' ?> <?php echo $has_children ? 'scroll-to' : '' ?>"><?php echo esc_html( $item['title'] ); ?>
							<?php if ( $has_children ) : ?>
								<svg :class="open && 'rotate-180'" width="17" height="16" viewBox="0 0 17 16" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M14.295 5.80865C14.2571 5.71729 14.193 5.6392 14.1108 5.58426C14.0286 5.52932 13.9319 5.5 13.833 5.5H3.83301C3.73412 5.5 3.63745 5.52932 3.55522 5.58427C3.473 5.63921 3.40891 5.7173 3.37107 5.80866C3.33322 5.90003 3.32332 6.00056 3.34262 6.09755C3.36191 6.19455 3.40953 6.28364 3.47946 6.35356L8.47946 11.3535C8.52589 11.4 8.58101 11.4368 8.64167 11.4619C8.70233 11.4871 8.76735 11.5 8.83301 11.5C8.89867 11.5 8.96369 11.4871 9.02435 11.4619C9.08501 11.4368 9.14013 11.4 9.18656 11.3535L14.1866 6.35356C14.2565 6.28364 14.3041 6.19454 14.3234 6.09755C14.3427 6.00056 14.3328 5.90002 14.295 5.80865Z"
										fill="currentColor" />
								</svg>
							<?php endif; ?>
							<?php if ( $is_contact_us ) : ?>
								<?php plmt_arrow(); ?>
							<?php endif; ?>
						</a>
						<?php if ( $has_children ) : ?>
							<ul x-cloak x-show='open' @mouseover='open = true' @click.away='open = false'
								class='border-t border-t-textSecondary px-[4.125rem] grid grid-cols-3 top-[5rem] bg-white absolute left-1/2 -translate-x-1/2 z-10 w-full focus:outline-none'
								role='menu' aria-orientation='vertical' tabindex='-1'
								x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0"
								x-transition:enter-end="opacity-100" x-transition:leave="transition duration-200"
								x-transition:leave-end="opacity-0">
								<?php foreach ( $item['children'] as $child ) : ?>
									<li class="py-[3.5625rem] px-10">
										<a href="<?php echo esc_url( $child['url'] ); ?>"
											class="hover:text-accent transition-colors duration-300">
											<img class="w-5 h-5 mb-3" src="<?php echo esc_url( $child['image']['url'] ) ?>"
												alt="<?php echo esc_attr( $child['image']['alt'] ) ?>">
											<p class="text-h5Bold mb-4">
												<?php echo esc_html( $child['title'] ); ?>
											</p>
											<p class="text-bodySmall text-darkGray">
												<?php echo esc_html( $child['description'] ); ?>
											</p>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav><!-- #site-navigation -->

		<div class="lg:hidden">
			<button @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" type="button"
				class="flex text-textBlack lg:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
				<div class=" text-center text-textBlack three col">
					<div class="hamburger" id="hamburger-1">
						<span
							class="w-[24px] h-[2px] rounded-full bg-textBlack block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[6px] rotate-[45deg]' : ''"></span>
						<span
							class="w-[21px] h-[2px] rounded-full bg-textBlack block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'opacity-0' : ''"></span>
						<span
							class="w-[24px] h-[2px] rounded-full bg-textBlack block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[-6px] rotate-[-45deg]' : ''"></span>
					</div>
				</div>
			</button>

		</div>
	</div>
	<nav x-data="{childOpen: false}" x-cloak x-show="menuOpen" x-trap.inert.noscroll="menuOpen"
		@click.away="menuOpen=false" id="site-navigation"
		class="absolute z-[100] top-0 left-0 w-full flex justify-end lg:hidden bg-[#0000003D] h-screen"
		aria-label="<?php esc_attr_e( 'Main Navigation', 'plement' ); ?>">
		<?php
		$menu_locations = get_nav_menu_locations();
		$menu_id        = $menu_locations['menu-1'];

		$items = plmt_menu_builder( $menu_id );

		?>
		<div class="relative">
			<button @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" type="button"
				class="absolute top-5 right-4 flex text-textBlack lg:hidden" aria-label="mobile menu"
				aria-controls="mobileMenu">
				<div class=" text-center text-textBlack three col">
					<div class="hamburger" id="hamburger-1">
						<span
							class="w-[24px] h-[2px] rounded-full bg-textBlack block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[6px] rotate-[45deg]' : ''"></span>
						<span
							class="w-[21px] h-[2px] rounded-full bg-textBlack block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'opacity-0' : ''"></span>
						<span
							class="w-[24px] h-[2px] rounded-full bg-textBlack block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[-6px] rotate-[-45deg]' : ''"></span>
					</div>
				</div>
			</button>
			<ul class="overflow-y-scroll bg-white h-screen w-[15.9375rem] pt-[7rem]">
				<?php
				foreach ( $items as $item ) :
					$is_contact_us = isset( $item['is_contact_us'] ) && $item['is_contact_us'];
					$has_children  = isset( $item['children'] ) && count( $item['children'] );
					?>
					<li x-show="!childOpen" x-data="{open: false}" @mouseover='open = true' @mouseover.away="open = false"
						class="px-4 text-center w-full font-semibold h-[10rem] hover:bg-accent <?php echo $is_contact_us ? 'border border-accent' : 'border-t-textSecondary border-t' ?>"
						<?php echo $has_children ? '@click="childOpen = true"' : '' ?>>
						<a href="<?php echo esc_url( $item['url'] ); ?>"
							class="group flex items-center justify-center h-full w-full text-bodyRegular hover:text-white transition-colors duration-300 <?php echo $is_contact_us ? 'text-accent !text-bodyBold gap-2' : '' ?>"><?php echo esc_html( $item['title'] ); ?>
							<?php if ( $is_contact_us ) : ?>
								<?php plmt_arrow(); ?>
							<?php endif; ?>
						</a>
					</li>

					<?php if ( $has_children ) : ?>
						<ul x-show="childOpen">
							<?php foreach ( $item['children'] as $item ) : ?>
								<li x-data="{open: false}" @mouseover='open = true' @mouseover.away="open = false"
									class="px-4 text-center w-full font-semibold h-[10rem] hover:bg-accent <?php echo $is_contact_us ? 'border border-accent' : 'border-t-textSecondary border-t' ?>">
									<a href="<?php echo esc_url( $item['url'] ); ?>"
										class="group flex items-center justify-center h-full w-full text-bodyRegular hover:text-white transition-colors duration-300 <?php echo $is_contact_us ? 'text-accent !text-bodyBold gap-2' : '' ?>"><?php echo esc_html( $item['title'] ); ?>
										<?php if ( $is_contact_us ) : ?>
											<?php plmt_arrow(); ?>
										<?php endif; ?>
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