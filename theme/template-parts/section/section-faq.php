<?php
$front_page_id = get_option( 'page_on_front' );

$faq_content = get_field( 'faq', $front_page_id );

if ( ! isset( $faq_content ) || empty( $faq_content ) ) {
	return;
}

function faq_item( $item ) {
	if ( empty( $item ) ) {
		return;
	}
	?>
	<div x-data="{ id: $id('accordion') }" class="border-b border-solid border-[#E9E9E9] active last-of-type:border-b-0">
		<button @click="setActiveAccordion(id)" class="py-6 group inline-flex gap-5 items-center w-full">
			<div :class="{ 'rotate-90': activeAccordion==id }"
				class="relative flex items-center justify-center min-w-[12.5px] min-h-[12.5px] duration-300 ease-out">
				<div class="absolute w-0.5 h-full bg-mainBlack rounded-full"></div>
				<div :class="{ 'rotate-90': activeAccordion==id }"
					class="absolute w-full h-0.5 ease duration-500 bg-mainBlack rounded-full">
				</div>
			</div>
			<h4 class="text-left text-h5Bold"><?php echo esc_html( $item['question'] ) ?></h4>
		</button>
		<div x-show="activeAccordion==id" x-collapse x-cloak class="ml-[30px] w-full px-0 overflow-hidden pr-4 max-w-[95%]">
			<div class="faq-answer text-darkGray text-bodyRegular mt-4">
				<?php echo $item['answer'] ?>
			</div>
		</div>
	</div>
	<?php
}

?>

<section id="faq" class="container py-[7.5rem] lg:py-20">
	<div
		class="grid grid-cols-1 justify-center items-start gap-x-12 gap-y-6 xl:gap-28 lg:grid-cols-2 lg:justify-between max-lg:max-w-2xl  max-w-full">
		<div class="w-full h-full flex flex-col justify-between">
			<h2 class="max-w-md text-h4Bold lg:text-h2"><?php echo esc_html( $faq_content['heading'] ) ?></h2>
			<div class="hidden lg:block">
				<span
					class="text-bodyRegular mb-[10px] inline-block"><?php esc_html_e( 'Still got a question?', 'plmt' ) ?></span>
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
						<span x-show="!copyNotification" x-cloak
							class="text-h5Bold"><?php echo esc_html( $faq_content['email'] ) ?></span>
						<span x-show="copyNotification" x-cloak
							class="text-h5Bold"><?php esc_html_e( 'Email copied', 'plmt' ) ?></span>
					</button>
				</div>
			</div>
		</div>
		<div class="w-full ">
			<div>
				<div x-data="{
						activeAccordion: '',
						setActiveAccordion(id) {
							this.activeAccordion = (this.activeAccordion == id) ? '' : id
						}
					}">
					<?php if ( isset( $faq_content['faq_list'] ) ) : ?>
						<?php foreach ( $faq_content['faq_list'] as $item ) : ?>
							<?php faq_item( $item ) ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="lg:hidden flex flex-col items-center mt-14">
		<span
			class="text-textGray font-medium inline-block mb-2"><?php esc_html_e( 'Still got a question?', 'plmt' ) ?></span>
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
				<svg x-show="!copyNotification" class="w-[15px] h-[19px] lg:w-[19px] lg:h-[25px]"
					xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
					<path fill="currentColor"
						d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z" />
				</svg>
				<svg x-show="copyNotification" class="w-[15px] h-[19px] lg:w-[19px] lg:h-[25px]"
					xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
					<path fill="currentColor"
						d="M208 0H332.1c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9V336c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V48c0-26.5 21.5-48 48-48zM48 128h80v64H64V448H256V416h64v48c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V176c0-26.5 21.5-48 48-48z" />
				</svg>
				<span x-show="!copyNotification"
					class="text-xl lg:text-[1.5rem] font-bold"><?php echo esc_html( $faq_content['email'] ) ?></span>
				<span x-show="copyNotification"
					class="text-xl lg:text-[1.5rem] font-bold"><?php esc_html_e( 'Email copied', 'plmt' ) ?></span>
			</button>
		</div>
	</div>

</section>