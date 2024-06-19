<?php
$faq_content = get_field( 'faq' );

if ( ! isset( $faq_content ) || empty( $faq_content ) ) {
	return;
}

function faq_item( $item ) {
	if ( empty( $item ) ) {
		return;
	}
	?>
	<div x-data="{ id: $id('accordion') }" class="py-6 border-b border-solid border-gray-200 active">
		<button @click="setActiveAccordion(id)" class="group inline-flex gap-5 items-center w-full">
			<div :class="{ 'rotate-90': activeAccordion==id }"
				class="relative flex items-center justify-center w-[12.5px] h-[12.5px] duration-300 ease-out">
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

<section id="faq" class="py-24">
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<div
			class="flex flex-col justify-center items-start gap-x-16 gap-y-5 xl:gap-28 lg:flex-row lg:justify-between max-lg:max-w-2xl mx-auto max-w-full">
			<div class="w-full lg:w-1/2">
				<h2><?php echo esc_html( $faq_content['heading'] ) ?></h2>
			</div>
			<div class="w-full lg:w-1/2">
				<div class="lg:max-w-xl">
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
	</div>
</section>