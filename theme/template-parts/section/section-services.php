<?php

$services_content = get_field( 'services' );

if ( ! isset( $services_content ) || empty( $services_content ) ) {
	return;
}

function services_list_mobile( $services ) {
	if ( empty( $services ) ) {
		return;
	}
	?>
	<div class="services-list swiper">
		<ul class="swiper-wrapper md:flex md:flex-col md:gap-8">
			<?php
			foreach ( $services as $service ) {
				?>
				<li class="swiper-slide group md:hover:bg-lightGrayBg ">
					<div class="container">
						<div
							class="flex flex-col justify-between py-8 px-4 rounded-lg bg-lightGrayBg md:bg-inherit md:p-0 md:flex-row">
							<h4 class="text-xl font-medium mb-3 inline-block lg:text-[1.375rem] lg:leading-7 md:mb-0">
								<?php echo esc_html( $service['title'] ); ?>
							</h4>
							<div
								class=" md:hidden max-w-[530px] md:opacity-0 md:invisible transition-opacity group-hover:md:opacity-100 group-hover:md:visible group-hover:md:block">
								<p class="font-medium md:text-lg"><?php echo esc_html( $service['description'] ); ?></p>
								<?php if ( isset( $service['tags'] ) && ! empty( $service['tags'] ) ) : ?>
									<div class="mt-6">
										<?php foreach ( $service['tags'] as $tag ) : ?>
											<span
												class="mr-3 mb-3 text-sm px-4 py-[10px] font-medium rounded-full border border-textBlack inline-block"><?php echo esc_html( $tag['title'] ) ?></span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</li>
				<?php
			}
			?>
		</ul>
		<div class="swiper-pagination !static mt-6"></div>
	</div>
	<?php
}

function services_list( $services ) {
	if ( empty( $services ) ) {
		return;
	}
	?>
	<div>
		<ul class="md:flex md:flex-col md:gap-8">
			<?php
			foreach ( $services as $service ) {
				?>
				<li
					class="group md:hover:bg-lightGrayBg transition-[padding] duration-500 py-8 hover:transition-[padding] hover:duration-500 hover:lg:py-12">
					<div class="container">
						<div
							class="flex flex-col justify-between py-8 px-4 rounded-lg bg-lightGrayBg md:bg-inherit md:p-0 md:flex-row">
							<h4 class="text-xl font-medium mb-3 inline-block lg:text-[1.375rem] lg:leading-7 md:mb-0">
								<?php echo esc_html( $service['title'] ); ?>
							</h4>
							<div
								class="max-w-[530px] md:opacity-0 md:invisible max-h-0 group-hover:max-h-[300px] transition-[opacity,max-height]  group-hover:md:opacity-100 group-hover:md:visible delay-150 duration-500">
								<p
									class="font-medium md:text-lg max-h-0 group-hover:max-h-[300px] transition-[height] duration-500">
									<?php echo esc_html( $service['description'] ); ?>
								</p>
								<?php if ( isset( $service['tags'] ) && ! empty( $service['tags'] ) ) : ?>
									<div class="mt-6">
										<?php foreach ( $service['tags'] as $tag ) : ?>
											<span
												class="mr-3 mb-3 text-sm px-4 py-[10px] font-medium rounded-full border border-textBlack inline-block"><?php echo esc_html( $tag['title'] ) ?></span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</li>
				<?php
			}
			?>
		</ul>
		<div class="swiper-pagination"></div>
	</div>
	<?php
}

?>
<section id="services" class="py-16 lg:py-36">
	<div class="container">
		<h2 class="max-w-md  mb-8  lg:mb-20">
			<?php echo esc_html( $services_content['heading'] ) ?>
		</h2>
	</div>
	<div class="hidden lg:block">
		<?php isset( $services_content['services_list'] ) && services_list( $services_content['services_list'] ); ?>
	</div>
	<div class="block lg:hidden">
		<?php isset( $services_content['services_list'] ) && services_list_mobile( $services_content['services_list'] ); ?>

	</div>
</section>