<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

$front_page_id      = get_option( 'page_on_front' );
$contact_us_page_id = get_page_by_path( 'contact-us' )->ID;

$contact_information = get_field( 'information', $contact_us_page_id );
$faq_content         = get_field( 'faq', $front_page_id );
$logo                = get_field( 'logo', 'option' );
$links               = get_field( 'links', 'option' );

function services_link( $links ) {
	?>
	<li x-data="{isExpanded: false}" class="text-button flex flex-col items-center">
		<button @click="isExpanded = !isExpanded" class="flex items-center gap-2" :class="isExpanded ? 'mb-6' : ''">
			<?php echo esc_html_e( 'Services', 'plmt' ) ?>
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M13.4619 5.80865C13.4241 5.71729 13.36 5.6392 13.2778 5.58426C13.1956 5.52932 13.0989 5.5 13 5.5H3C2.90111 5.5 2.80444 5.52932 2.72221 5.58427C2.63999 5.63921 2.5759 5.7173 2.53806 5.80866C2.50022 5.90003 2.49031 6.00056 2.50961 6.09755C2.5289 6.19455 2.57653 6.28364 2.64646 6.35356L7.64646 11.3535C7.69288 11.4 7.748 11.4368 7.80866 11.4619C7.86932 11.4871 7.93434 11.5 8 11.5C8.06566 11.5 8.13068 11.4871 8.19134 11.4619C8.252 11.4368 8.30712 11.4 8.35355 11.3535L13.3535 6.35356C13.4235 6.28364 13.4711 6.19454 13.4904 6.09755C13.5097 6.00056 13.4998 5.90002 13.4619 5.80865Z"
					fill="white" />
			</svg>
		</button>
		<?php if ( ! empty( $links ) ) : ?>
			<ul x-show="isExpanded" x-cloak class="space-y-8 py-6 border-y border-y-darkGray">
				<?php foreach ( $links as $link ) : ?>
					<li class="text-bodyRegular">
						<a href="<?php echo esc_url( $link['link']['url'] ) ?>">
							<?php echo esc_html( $link['link']['title'] ) ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</li>
	<?php
}

function mobile_menu( $links ) {
	?>
	<nav class="mb-[3.75rem] lg:hidden">
		<ul class="text-center space-y-10">
			<li class="text-button">
				<a href="<?php echo esc_url( home_url( '/' ) ) ?>">
					<?php echo esc_html_e( 'Home', 'plmt' ) ?>
				</a>
			</li>
			<?php services_link( links: $links ); ?>
			<li class="text-button">
				<a href="<?php echo esc_url( home_url( '/case-studies' ) ) ?>">
					<?php echo esc_html_e( 'Case studies', 'plmt' ) ?>
				</a>
			</li>
			<li class="text-button">
				<a href="<?php echo esc_url( home_url( '/about-us' ) ) ?>">
					<?php echo esc_html_e( 'About', 'plmt' ) ?>
				</a>
			</li>
			<li class="text-button">
				<a href="<?php echo esc_url( home_url( '/contact-us' ) ) ?>">
					<?php echo esc_html_e( 'Contact Us', 'plmt' ) ?>
				</a>
			</li>
		</ul>
	</nav>
	<?php
}

function menu_colunn() {
	?>
	<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
		<div class="hidden lg:block">
			<span
				class="hidden lg:inline-block uppercase text-textSecondary font-bold mb-8 leading-[1rem]"><?php esc_html_e( 'Menu', 'plmt' ) ?></span>
			<nav class="text-center mb-[3.75rem] lg:mb-0 lg:text-left"
				aria-label="<?php esc_attr_e( 'Footer Menu', 'plement' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_class' => 'footer-menu',
						'depth' => 1,
					)
				);
				?>
			</nav>
		</div>
	<?php endif;

}

function services_column( $links ) {
	?>
	<div class="hidden lg:block">
		<span
			class="inline-block uppercase text-textSecondary font-bold mb-8 leading-[1rem]"><?php esc_html_e( 'Our Services', 'plmt' ) ?></span>
		<nav>
			<ul class="flex flex-col gap-10 lg:gap-5">
				<?php foreach ( $links as $link ) : ?>
					<li>
						<a class="hover:text-accent duration-200 transition-colors"
							href="<?php echo esc_url( $link['link']['url'] ) ?>">
							<?php echo esc_html( $link['link']['title'] ) ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
	<?php
}
?>

<footer id="colophon" class="bg-mainBlack text-white z-0 relative" x-data="{filloutOpen: false}">
	<div class=" container bottom-0 w-full py-20 lg:pb-[4.75rem]">
		<div
			class="grid gird-cols-1 jusitify-center justify-items-center lg:justify-items-start lg:grid-cols-4 lg:justify-between lg:mb-[104px]">
			<?php if ( get_theme_mod( 'site_logo' ) ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mb-[1.875rem]">
					<img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>"
						class="h-[2.875rem] aspect-[150/46]">
				</a>
			<?php else : ?>
				<a class="site-title"
					href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_url( bloginfo( 'name' ) ); ?></a>
			<?php endif; ?>
			<?php mobile_menu( $links ); ?>
			<?php menu_colunn(); ?>
			<?php services_column( $links ); ?>
			<div class="text-center mb-10 lg:text-left lg:mb-12">
				<span class="font-medium mb-4 inline-block"><?php esc_html_e( 'Got a question?', 'plmt' ) ?></span>
				<div class="flex items-center gap-4">
					<div x-data="{
							copyText: '<?php echo esc_html( $faq_content['email'] ) ?>',
							copyNotification: false,
							copyToClipboard() {
								navigator.clipboard.writeText(this.copyText);
								this.copyNotification = true;
								let that = this;
								setTimeout(function(){
									that.copyNotification = false;
								}, 3000);
							}
						}" class="relative z-20 flex items-center">
						<button @click="copyToClipboard();"
							class="flex items-center gap-2 justify-center hover:text-accent duration-200 transition-colors">
							<svg x-show="!copyNotification" x-cloak class="w-[15px] h-[19px] lg:w-[19px] lg:h-[25px]"
								xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
								<path fill="currentColor"
									d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z" />
							</svg>
							<svg x-show="copyNotification" x-cloak class="w-[15px] h-[19px] lg:w-[19px] lg:h-[25px]"
								xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
								<path fill="currentColor"
									d="M208 0H332.1c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9V336c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V48c0-26.5 21.5-48 48-48zM48 128h80v64H64V448H256V416h64v48c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V176c0-26.5 21.5-48 48-48z" />
							</svg>
							<span x-show="!copyNotification" x-cloak class="text-xl font-semibold">
								<?php echo esc_html( $faq_content['email'] ) ?>
							</span>
							<span x-show="copyNotification" x-cloak class="text-xl font-semibold">
								<?php esc_html_e( 'Email copied', 'plmt' ) ?>
							</span>
						</button>
					</div>
					<span class="bg-white w-[1px] h-[26px]"></span>
					<a target="_blank" href="<?php echo esc_url( $contact_information['footer_linkedin']['url'] ) ?>">
						<svg class=" z-0 w-[20px] h-[20px] lg:w-[24px] lg:h-[25px] text-[#FFF8EE] hover:text-accent duration-200 transition-colors"
							width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M20.7283 0.5H3.2737C2.40572 0.5 1.57329 0.844804 0.959536 1.45856C0.345781 2.07232 0.000976563 2.90475 0.000976562 3.77273L0.000976563 21.2273C0.000976563 22.0953 0.345781 22.9277 0.959536 23.5414C1.57329 24.1552 2.40572 24.5 3.2737 24.5H20.7283C21.5962 24.5 22.4287 24.1552 23.0424 23.5414C23.6562 22.9277 24.001 22.0953 24.001 21.2273V3.77273C24.001 2.90475 23.6562 2.07232 23.0424 1.45856C22.4287 0.844804 21.5962 0.5 20.7283 0.5ZM8.18279 19.4927C8.18297 19.5593 8.17002 19.6252 8.14468 19.6867C8.11933 19.7483 8.0821 19.8042 8.0351 19.8513C7.9881 19.8985 7.93227 19.9359 7.8708 19.9614C7.80934 19.9869 7.74344 20 7.67689 20H5.52098C5.45431 20.0002 5.38827 19.9872 5.32664 19.9618C5.26501 19.9363 5.20902 19.899 5.16188 19.8518C5.11474 19.8047 5.07738 19.7487 5.05195 19.6871C5.02652 19.6254 5.01352 19.5594 5.0137 19.4927V10.4545C5.0137 10.32 5.06715 10.191 5.16228 10.0958C5.25741 10.0007 5.38644 9.94727 5.52098 9.94727H7.67689C7.81119 9.94763 7.93986 10.0012 8.0347 10.0963C8.12954 10.1914 8.1828 10.3202 8.18279 10.4545V19.4927ZM6.59825 9.09091C6.1937 9.09091 5.79823 8.97095 5.46186 8.74619C5.12548 8.52143 4.86331 8.20197 4.7085 7.82822C4.55368 7.45446 4.51317 7.04319 4.5921 6.64641C4.67102 6.24963 4.86583 5.88516 5.1519 5.5991C5.43796 5.31304 5.80242 5.11823 6.1992 5.0393C6.59598 4.96038 7.00725 5.00089 7.38101 5.1557C7.75477 5.31052 8.07423 5.57269 8.29898 5.90906C8.52374 6.24543 8.6437 6.6409 8.6437 7.04545C8.6437 7.58794 8.4282 8.10821 8.0446 8.49181C7.66101 8.87541 7.14074 9.09091 6.59825 9.09091ZM19.4519 19.5282C19.4521 19.5895 19.4401 19.6502 19.4168 19.7069C19.3934 19.7635 19.359 19.815 19.3157 19.8584C19.2724 19.9017 19.2209 19.936 19.1642 19.9594C19.1075 19.9828 19.0468 19.9947 18.9855 19.9945H16.6673C16.606 19.9947 16.5453 19.9828 16.4887 19.9594C16.432 19.936 16.3805 19.9017 16.3372 19.8584C16.2938 19.815 16.2595 19.7635 16.2361 19.7069C16.2127 19.6502 16.2008 19.5895 16.201 19.5282V15.2941C16.201 14.6614 16.3864 12.5232 14.5469 12.5232C13.1219 12.5232 12.8314 13.9864 12.7742 14.6436V19.5336C12.7742 19.6562 12.726 19.7738 12.64 19.861C12.554 19.9483 12.4371 19.9982 12.3146 20H10.0755C10.0143 20 9.95376 19.9879 9.89726 19.9645C9.84075 19.941 9.78943 19.9066 9.74623 19.8633C9.70304 19.82 9.66881 19.7686 9.64553 19.712C9.62224 19.6554 9.61034 19.5948 9.61052 19.5336V10.415C9.61034 10.3538 9.62224 10.2932 9.64553 10.2366C9.66881 10.1801 9.70304 10.1286 9.74623 10.0853C9.78943 10.042 9.84075 10.0076 9.89726 9.98416C9.95376 9.96071 10.0143 9.94864 10.0755 9.94864H12.3146C12.4383 9.94864 12.5569 9.99777 12.6444 10.0852C12.7318 10.1727 12.781 10.2913 12.781 10.415V11.2032C13.3101 10.4082 14.0942 9.79727 15.7673 9.79727C19.4737 9.79727 19.4492 13.2582 19.4492 15.1591L19.4519 19.5282Z"
								fill="currentColor" />
						</svg>
					</a>
				</div>
			</div>
		</div>
		<div class="lg:px-0">
			<a href="<?php echo esc_url( home_url( '/contact-us' ) ) ?>"
				class="inline-block text-center mb-[3.75rem] text-[2rem] leading-[2.2rem] text-accent border border-accent w-full py-6 lg:text-[3rem] lg:leading-[3.3rem] lg:mb-10 hover:text-white hover:bg-accent transition duration-300 ease-in-out">
				<?php esc_html_e( "Let's talk", 'plmt' ) ?>
			</a>
		</div>
		<div
			class="text-center border-t border-t-[#FFFFFF4D] pt-1 md:pt-6 text-[0.875rem] leading-[1.3125rem] font-medium flex flex-col-reverse md:flex-row gap-2 md:gap-5">
			<span><?php esc_html_e( '© 2025 Plement, MB.', 'plmt' ) ?></span>
			<div class="flex flex-col md:flex-row gap-2 md:gap-5">
				<span class="hidden md:inline">|</span>
				<a class="underline md:no-underline"
					href="<?php echo esc_url( home_url( '/privacy-policy' ) ) ?>"><?php esc_html_e( 'Privacy policy', 'plmt' ) ?></a>
				<span class="hidden md:inline">|</span>
				<a class="underline md:no-underline"
					href="<?php echo esc_url( home_url( '/terms-and-conditions' ) ) ?>"><?php esc_html_e( 'Terms and conditions', 'plmt' ) ?></a>
			</div>
		</div>
		<?php get_template_part( 'template-parts/content/content-fillout-modal' ); ?>

	</div>
</footer><!-- #colophon -->