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
			class="button"><?php esc_html_e( 'Contact Us', 'plmt' ) ?><svg xmlns="http://www.w3.org/2000/svg" width="10"
				height="9" fill="none" xmlns:v="https://vecta.io/nano">
				<path
					d="M1.154.667a.67.67 0 0 0 .667.667h5.06l-5.92 5.92c-.062.062-.111.135-.144.216s-.051.167-.051.254.017.174.051.254.082.154.144.216.135.111.216.144.167.051.254.051.174-.017.254-.051.154-.082.216-.144l5.92-5.92v5.06A.67.67 0 0 0 8.487 8a.67.67 0 0 0 .667-.667V.667A.67.67 0 0 0 8.487 0H1.821a.67.67 0 0 0-.667.667z"
					fill="#fff" />
			</svg></a>
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