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

?>

<footer id="colophon" class="bg-accent text-white h-[700px] z-0 relative lg:h-[495px] " x-data="{calendlyOpen: false}">
	<div class="fixed bottom-0 w-full  pt-16 lg:pt-[166px] pb-6 lg:pb-[46px]">
		<div class="container flex flex-col gap-10 lg:flex-row justify-between lg:mb-[104px]">
			<div>
				<p class="font-medium text-2xl mb-3">
					<?php echo esc_html_e( 'It can be simple', 'plmt' ) ?>
				</p>
				<a href="<?php echo esc_url( '/contact-us' ) ?>"
					class="group underline inline-flex gap-12 items-center text-[4rem] leading-[70px] lg:text-[5.25rem] lg:leading-[92px]"><?php esc_html_e( "Let's talk" ) ?>
					<div class="z-1 flex justify-center items-center relative overflow-hidden ">
						<div
							class="justify-center items-center w-[3rem] h-[2.5rem] lg:w-[3.5rem] lg:h-[3rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0">
							<svg width="42" height="42" viewBox="0 0 42 42" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M41.1963 3.80469C41.1963 2.14783 39.8531 0.804688 38.1963 0.804688L11.1963 0.804687C9.53944 0.804687 8.19629 2.14783 8.19629 3.80469C8.19629 5.46154 9.53944 6.80469 11.1963 6.80469H35.1963V30.8047C35.1963 32.4615 36.5394 33.8047 38.1963 33.8047C39.8531 33.8047 41.1963 32.4615 41.1963 30.8047L41.1963 3.80469ZM4.31761 41.926L40.3176 5.92601L36.075 1.68337L0.0749688 37.6834L4.31761 41.926Z"
									fill="white"></path>
							</svg>
						</div>
						<div
							class="justify-center items-center w-[3rem] h-[2.5rem] lg:w-[3.5rem] lg:h-[3rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]">
							<svg width="42" height="42" viewBox="0 0 42 42" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M41.1963 3.80469C41.1963 2.14783 39.8531 0.804688 38.1963 0.804688L11.1963 0.804687C9.53944 0.804687 8.19629 2.14783 8.19629 3.80469C8.19629 5.46154 9.53944 6.80469 11.1963 6.80469H35.1963V30.8047C35.1963 32.4615 36.5394 33.8047 38.1963 33.8047C39.8531 33.8047 41.1963 32.4615 41.1963 30.8047L41.1963 3.80469ZM4.31761 41.926L40.3176 5.92601L36.075 1.68337L0.0749688 37.6834L4.31761 41.926Z"
									fill="white"></path>
							</svg>
						</div>
					</div>
				</a>
			</div>
			<div class="flex flex-col-reverse lg:flex-col">
				<div class="mb-10 lg:mb-12">
					<span class="font-medium mb-2 inline-block"><?php esc_html_e( 'Got a question?', 'plmt' ) ?></span>
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
							<button @click="copyToClipboard();" class="flex items-center gap-2 justify-center">
								<svg x-show="!copyNotification" x-cloak
									class="w-[15px] h-[19px] lg:w-[19px] lg:h-[25px]" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 448 512">
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
						<a target="_blank"
							href="<?php echo esc_url( $contact_information['footer_linkedin']['url'] ) ?>">
							<svg class=" z-0 w-[20px] h-[20px] lg:w-[24px] lg:h-[25px]" width="24" height="25"
								viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M20.7283 0.5H3.2737C2.40572 0.5 1.57329 0.844804 0.959536 1.45856C0.345781 2.07232 0.000976563 2.90475 0.000976562 3.77273L0.000976563 21.2273C0.000976563 22.0953 0.345781 22.9277 0.959536 23.5414C1.57329 24.1552 2.40572 24.5 3.2737 24.5H20.7283C21.5962 24.5 22.4287 24.1552 23.0424 23.5414C23.6562 22.9277 24.001 22.0953 24.001 21.2273V3.77273C24.001 2.90475 23.6562 2.07232 23.0424 1.45856C22.4287 0.844804 21.5962 0.5 20.7283 0.5ZM8.18279 19.4927C8.18297 19.5593 8.17002 19.6252 8.14468 19.6867C8.11933 19.7483 8.0821 19.8042 8.0351 19.8513C7.9881 19.8985 7.93227 19.9359 7.8708 19.9614C7.80934 19.9869 7.74344 20 7.67689 20H5.52098C5.45431 20.0002 5.38827 19.9872 5.32664 19.9618C5.26501 19.9363 5.20902 19.899 5.16188 19.8518C5.11474 19.8047 5.07738 19.7487 5.05195 19.6871C5.02652 19.6254 5.01352 19.5594 5.0137 19.4927V10.4545C5.0137 10.32 5.06715 10.191 5.16228 10.0958C5.25741 10.0007 5.38644 9.94727 5.52098 9.94727H7.67689C7.81119 9.94763 7.93986 10.0012 8.0347 10.0963C8.12954 10.1914 8.1828 10.3202 8.18279 10.4545V19.4927ZM6.59825 9.09091C6.1937 9.09091 5.79823 8.97095 5.46186 8.74619C5.12548 8.52143 4.86331 8.20197 4.7085 7.82822C4.55368 7.45446 4.51317 7.04319 4.5921 6.64641C4.67102 6.24963 4.86583 5.88516 5.1519 5.5991C5.43796 5.31304 5.80242 5.11823 6.1992 5.0393C6.59598 4.96038 7.00725 5.00089 7.38101 5.1557C7.75477 5.31052 8.07423 5.57269 8.29898 5.90906C8.52374 6.24543 8.6437 6.6409 8.6437 7.04545C8.6437 7.58794 8.4282 8.10821 8.0446 8.49181C7.66101 8.87541 7.14074 9.09091 6.59825 9.09091ZM19.4519 19.5282C19.4521 19.5895 19.4401 19.6502 19.4168 19.7069C19.3934 19.7635 19.359 19.815 19.3157 19.8584C19.2724 19.9017 19.2209 19.936 19.1642 19.9594C19.1075 19.9828 19.0468 19.9947 18.9855 19.9945H16.6673C16.606 19.9947 16.5453 19.9828 16.4887 19.9594C16.432 19.936 16.3805 19.9017 16.3372 19.8584C16.2938 19.815 16.2595 19.7635 16.2361 19.7069C16.2127 19.6502 16.2008 19.5895 16.201 19.5282V15.2941C16.201 14.6614 16.3864 12.5232 14.5469 12.5232C13.1219 12.5232 12.8314 13.9864 12.7742 14.6436V19.5336C12.7742 19.6562 12.726 19.7738 12.64 19.861C12.554 19.9483 12.4371 19.9982 12.3146 20H10.0755C10.0143 20 9.95376 19.9879 9.89726 19.9645C9.84075 19.941 9.78943 19.9066 9.74623 19.8633C9.70304 19.82 9.66881 19.7686 9.64553 19.712C9.62224 19.6554 9.61034 19.5948 9.61052 19.5336V10.415C9.61034 10.3538 9.62224 10.2932 9.64553 10.2366C9.66881 10.1801 9.70304 10.1286 9.74623 10.0853C9.78943 10.042 9.84075 10.0076 9.89726 9.98416C9.95376 9.96071 10.0143 9.94864 10.0755 9.94864H12.3146C12.4383 9.94864 12.5569 9.99777 12.6444 10.0852C12.7318 10.1727 12.781 10.2913 12.781 10.415V11.2032C13.3101 10.4082 14.0942 9.79727 15.7673 9.79727C19.4737 9.79727 19.4492 13.2582 19.4492 15.1591L19.4519 19.5282Z"
									fill="#FFF8EE" />
							</svg>
						</a>
					</div>
				</div>
				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<aside role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'plement' ); ?>">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</aside>
				<?php endif; ?>

				<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
					<nav aria-label="<?php esc_attr_e( 'Footer Menu', 'plement' ); ?>">
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
				<?php endif; ?>

			</div>
		</div>
		<div
			class="container border-t border-t-[#FFFFFF4D] pt-6 gap-4 text-sm flex flex-row justify-between w-full items-end md:items-center md:gap-[20px]">

			<div class="flex flex-col-reverse md:flex-row gap-4 md:gap-[20px]">
				<span><?php esc_html_e( '© 2024 Plement. All rights reserved.', 'plmt' ) ?></span>
				<div class="flex flex-col md:flex-row gap-4 md:gap-[20px]">
					<span class="hidden md:inline">|</span>
					<a
						href="<?php echo esc_url( home_url( '/privacy-policy' ) ) ?>"><?php esc_html_e( 'Privacy policy', 'plmt' ) ?></a>
					<span class="hidden md:inline">|</span>
					<a
						href="<?php echo esc_url( home_url( '/terms-and-conditions' ) ) ?>"><?php esc_html_e( 'Terms and conditions', 'plmt' ) ?></a>
				</div>
			</div>
			<div>
				<a href="http://respark.digital/" target="_blank">

					<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M6.12161 5.85922C5.19456 6.78486 4.07607 7.53838 2.87061 8.00017C4.07839 8.46288 5.19888 9.21842 6.12699 10.1465C7.05515 11.0747 7.81072 12.1952 8.27344 13.403C8.73615 12.1952 9.49173 11.0747 10.4199 10.1465C11.348 9.21837 12.4686 8.46281 13.6764 8.0001C12.471 7.5383 11.3526 6.7848 10.4256 5.85918C9.49486 4.9298 8.73723 3.80706 8.27367 2.59667C7.8101 3.80707 7.05242 4.92982 6.12161 5.85922Z"
							stroke="white" />
					</svg>
				</a>

			</div>
		</div>
		<?php get_template_part( 'template-parts/content/content-calendly-modal' ); ?>

	</div>
</footer><!-- #colophon -->