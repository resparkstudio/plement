<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

?>

<header id="masthead" class="container h-[108px] flex items-center justify-between">
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

	<div>
		<a href="#" class="button">Contact us <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" fill="none"
				xmlns:v="https://vecta.io/nano">
				<path
					d="M1.154.667a.67.67 0 0 0 .667.667h5.06l-5.92 5.92c-.062.062-.111.135-.144.216s-.051.167-.051.254.017.174.051.254.082.154.144.216.135.111.216.144.167.051.254.051.174-.017.254-.051.154-.082.216-.144l5.92-5.92v5.06A.67.67 0 0 0 8.487 8a.67.67 0 0 0 .667-.667V.667A.67.67 0 0 0 8.487 0H1.821a.67.67 0 0 0-.667.667z"
					fill="#fff" />
			</svg></a>
	</div>

</header><!-- #masthead -->