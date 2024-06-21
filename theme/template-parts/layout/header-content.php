<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

?>

<header id="masthead" class="container py-[20px] lg:py-9 flex items-center justify-between relative">
	<?php if ( get_theme_mod( 'site_logo' ) ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_attr( get_theme_mod( 'site_logo' ) ); ?>"
				alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		</a>
	<?php else : ?>
		<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_url( bloginfo( 'name' ) ); ?></a>
	<?php endif; ?>

	<nav id="site-navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'plement' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id' => 'primary-menu',
				'menu_class' => 'menu-primary-list',
				'items_wrap' => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
			)
		);
		?>
	</nav><!-- #site-navigation -->

	<div class="hidden lg:block">
		<a href="<?php echo esc_url( home_url( '/contact-us' ) ) ?>"
			class="button group h-auto py-4"><?php esc_html_e( 'Contact Us', 'plmt' ) ?>
			<div class="z-1 flex justify-center items-center relative overflow-hidden ">
				<div
					class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
						aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
						preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
						<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
					</svg>
				</div>
				<div
					class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
						aria-hidden="true" role="img" class="iconify iconify--ic" width=" 100%" height=" 100%"
						preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
						<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
					</svg>
				</div>
			</div>
		</a>
	</div>

	<div x-data="{menuOpen: false}" class="lg:hidden">
		<button @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" type="button"
			class="flex text-textBlack lg:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
			<svg x-cloak x-show="!menuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true"
				viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
				<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
			</svg>
			<svg x-cloak x-show="menuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true"
				viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
			</svg>
		</button>

		<nav x-show="menuOpen" @click.away="menuOpen=false" x-cloak id="site-navigation"
			aria-label="<?php esc_attr_e( 'Main Navigation', 'plement' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id' => 'primary-menu',
					'menu_class' => 'mobile-menu-primary-list',
					'items_wrap' => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
				)
			);
			?>
		</nav>
	</div>

</header><!-- #masthead -->