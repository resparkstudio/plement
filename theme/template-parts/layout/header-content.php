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
	<div class="container py-[20px] lg:py-9 flex items-center justify-between relative z-[1] bg-white">
		<?php if ( get_theme_mod( 'site_logo' ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_attr( get_theme_mod( 'site_logo' ) ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="lg:h-[44px]">
			</a>
		<?php else : ?>
			<a class="site-title"
				href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_url( bloginfo( 'name' ) ); ?></a>
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

		<div class="lg:hidden">
			<button @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" type="button"
				class="flex text-textBlack lg:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
				<div class=" text-center text-textBlack three col">
					<div class="hamburger" id="hamburger-1">
						<span
							class="w-[25px] h-[2px] rounded-full bg-textBlack block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[6px] rotate-[45deg]' : ''"></span>
						<span
							class="w-[25px] h-[2px] rounded-full bg-textBlack block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'opacity-0' : ''"></span>
						<span
							class="w-[25px] h-[2px] rounded-full bg-textBlack block my-[4px] mx-auto transition-all duration-300 ease-in-out"
							:class="menuOpen ? 'translate-y-[-6px] rotate-[-45deg]' : ''"></span>
					</div>
				</div>
			</button>

		</div>
	</div>
	<nav x-cloak x-show="menuOpen" @click.away="menuOpen=false" id="site-navigation"
		class="absolute z-[100] top-[72px] lg:top-[108px] left-0 w-full flex flex-col pb-10 bg-lightGrayBg  px-4 py-10 lg:hidden"
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
		<a href='<?php echo esc_url( home_url( '/contact-us' ) ) ?>' class='button group h-auto py-4 w-max'>
			<?php esc_html_e( 'Contact Us', 'plmt' ) ?>
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
	</nav>


</header><!-- #masthead -->