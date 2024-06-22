<?php
$front_page_id = get_option( 'page_on_front' );

$faq_content = get_field( 'faq', $front_page_id );

$is_contact_us = is_page( 'contact-us' );

if ( ! isset( $faq_content ) || empty( $faq_content ) ) {
	return;
}

function faq_item( $item ) {
	if ( empty( $item ) ) {
		return;
	}
	?>
	<div x-data="{ id: $id('accordion') }" class="py-6 border-b border-solid border-[#E9E9E9] active">
		<button @click="setActiveAccordion(id)" class="group inline-flex gap-5 items-center w-full">
			<div :class="{ 'rotate-90': activeAccordion==id }"
				class="relative flex items-center justify-center min-w-[12.5px] min-h-[12.5px] duration-300 ease-out">
				<div class="absolute w-0.5 h-full bg-textBlack rounded-full"></div>
				<div :class="{ 'rotate-90': activeAccordion==id }"
					class="absolute w-full h-0.5 ease duration-500 bg-textBlack rounded-full">
				</div>
			</div>
			<h4 class="text-left text-xl font-medium lg:text-[22px]"><?php echo esc_html( $item['question'] ) ?></h4>
		</button>
		<div x-show="activeAccordion==id" x-collapse x-cloak class="ml-[30px] w-full px-0 overflow-hidden pr-4">
			<p class="text-lg font-medium text-darkGray mt-4">
				<?php echo esc_html( $item['answer'] ) ?>
			</p>
		</div>
	</div>
	<?php
}

?>

<section id="faq" class=" <?php echo ! $is_contact_us ? 'container' : '' ?> py-16 lg:py-36"
	style="<?php echo ! $is_contact_us ? 'border-bottom: 1px solid #E9E9E9' : '' ?>">

	<div
		class="grid grid-cols-1 justify-center items-start gap-x-12 gap-y-6 xl:gap-28 lg:grid-cols-2 lg:justify-between max-lg:max-w-2xl  max-w-full">
		<div class="w-full h-full flex flex-col justify-between">
			<h2 class="max-w-md"><?php echo esc_html( $faq_content['heading'] ) ?></h2>

			<div class="hidden lg:block">
				<span
					class="text-textGray font-medium mb-2 inline-block"><?php esc_html_e( 'Still got a question?', 'plmt' ) ?></span>
				<div x-data="{
							copyText: 'hello@plement.io',
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
						<svg class="w-[15px] h-[19px] lg:w-[19px] lg:h-[25px]" width="19" height="25"
							viewBox="0 0 19 25" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M18.7313 7.56338L11.9526 0.738318C11.7804 0.56468 11.5466 0.467019 11.3029 0.466797H8.27517C7.38119 0.466797 6.52371 0.824378 5.89154 1.46089C5.25936 2.09738 4.9042 2.96066 4.9042 3.86081V5.40355H3.37194C2.4779 5.40355 1.62049 5.76113 0.988315 6.39764C0.356129 7.03413 0.000976562 7.89741 0.000976562 8.79757V21.1394C0.000976562 22.0395 0.356129 22.9029 0.988315 23.5393C1.62049 24.1759 2.4779 24.5335 3.37194 24.5335H11.9526C12.8466 24.5335 13.704 24.1759 14.3362 23.5393C14.9684 22.9029 15.3236 22.0395 15.3236 21.1394V19.5967H15.63C16.524 19.5967 17.3814 19.2392 18.0136 18.6026C18.6459 17.9661 19.001 17.1028 19.001 16.2027V8.18047C18.9913 7.94795 18.8951 7.72764 18.7313 7.56338ZM12.259 3.62632L15.8629 7.25483H12.259V3.62632ZM13.4848 21.1394C13.4848 21.5486 13.3234 21.941 13.0361 22.2303C12.7488 22.5196 12.3589 22.6822 11.9526 22.6822H3.37194C2.96556 22.6822 2.57583 22.5196 2.28848 22.2303C2.00112 21.941 1.83969 21.5486 1.83969 21.1394V8.79757C1.83969 8.38841 2.00112 7.99601 2.28848 7.70669C2.57583 7.41737 2.96556 7.25483 3.37194 7.25483H4.9042V16.2027C4.9042 17.1028 5.25936 17.9661 5.89154 18.6026C6.52371 19.2392 7.38119 19.5967 8.27517 19.5967H13.4848V21.1394ZM15.63 17.7454H8.27517C7.86882 17.7454 7.47901 17.5829 7.19168 17.2936C6.90435 17.0043 6.74291 16.6118 6.74291 16.2027V3.86081C6.74291 3.45166 6.90435 3.05926 7.19168 2.76994C7.47901 2.48062 7.86882 2.31808 8.27517 2.31808H10.4203V8.18047C10.4235 8.42498 10.5213 8.65856 10.6931 8.83147C10.8648 9.00437 11.0969 9.10292 11.3397 9.10611H17.1623V16.2027C17.1623 16.6118 17.0008 17.0043 16.7135 17.2936C16.4262 17.5829 16.0364 17.7454 15.63 17.7454Z"
								fill="#272727" />
						</svg>
						<span x-show="!copyNotification"
							class="text-xl lg:text-[1.5rem] font-semibold">hello@plement.io</span>
						<span x-show="copyNotification" class="text-xl lg:text-[1.5rem] font-semibold">Email
							copied</span>
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
		<div class="flex items-center gap-2">
			<svg class="w-[15px] h-[19px] lg:w-[19px] lg:h-[25px]" width="19" height="25" viewBox="0 0 19 25"
				fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M18.7313 7.56338L11.9526 0.738318C11.7804 0.56468 11.5466 0.467019 11.3029 0.466797H8.27517C7.38119 0.466797 6.52371 0.824378 5.89154 1.46089C5.25936 2.09738 4.9042 2.96066 4.9042 3.86081V5.40355H3.37194C2.4779 5.40355 1.62049 5.76113 0.988315 6.39764C0.356129 7.03413 0.000976562 7.89741 0.000976562 8.79757V21.1394C0.000976562 22.0395 0.356129 22.9029 0.988315 23.5393C1.62049 24.1759 2.4779 24.5335 3.37194 24.5335H11.9526C12.8466 24.5335 13.704 24.1759 14.3362 23.5393C14.9684 22.9029 15.3236 22.0395 15.3236 21.1394V19.5967H15.63C16.524 19.5967 17.3814 19.2392 18.0136 18.6026C18.6459 17.9661 19.001 17.1028 19.001 16.2027V8.18047C18.9913 7.94795 18.8951 7.72764 18.7313 7.56338ZM12.259 3.62632L15.8629 7.25483H12.259V3.62632ZM13.4848 21.1394C13.4848 21.5486 13.3234 21.941 13.0361 22.2303C12.7488 22.5196 12.3589 22.6822 11.9526 22.6822H3.37194C2.96556 22.6822 2.57583 22.5196 2.28848 22.2303C2.00112 21.941 1.83969 21.5486 1.83969 21.1394V8.79757C1.83969 8.38841 2.00112 7.99601 2.28848 7.70669C2.57583 7.41737 2.96556 7.25483 3.37194 7.25483H4.9042V16.2027C4.9042 17.1028 5.25936 17.9661 5.89154 18.6026C6.52371 19.2392 7.38119 19.5967 8.27517 19.5967H13.4848V21.1394ZM15.63 17.7454H8.27517C7.86882 17.7454 7.47901 17.5829 7.19168 17.2936C6.90435 17.0043 6.74291 16.6118 6.74291 16.2027V3.86081C6.74291 3.45166 6.90435 3.05926 7.19168 2.76994C7.47901 2.48062 7.86882 2.31808 8.27517 2.31808H10.4203V8.18047C10.4235 8.42498 10.5213 8.65856 10.6931 8.83147C10.8648 9.00437 11.0969 9.10292 11.3397 9.10611H17.1623V16.2027C17.1623 16.6118 17.0008 17.0043 16.7135 17.2936C16.4262 17.5829 16.0364 17.7454 15.63 17.7454Z"
					fill="#272727" />
			</svg>
			<span class="text-xl lg:text-[1.5rem] font-bold">hello@plement.io</span>
		</div>
	</div>

</section>