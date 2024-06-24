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
				<li class="swiper-slide group ">
					<div class="container">
						<div
							class="flex flex-col justify-between py-8 px-4 bg-white md:p-0 md:flex-row border border-lightGray rounded-lg">
							<img class="w-[40px] h-[40px] lg:w-[45px] lg:h-[45px] rounded-md mb-[18px]"
								src="<?php echo esc_url( $service['icon']['url'] ) ?>"
								alt="<?php echo esc_url( $service['icon']['alt'] ) ?>">
							<h4 class="text-xl font-medium mb-3 inline-block lg:text-[1.375rem] lg:leading-7">
								<?php echo esc_html( $service['title'] ); ?>
							</h4>
							<div
								class=" md:hidden max-w-[530px] md:opacity-0 md:invisible transition-opacity group-hover:md:opacity-100 group-hover:md:visible group-hover:md:block">
								<p class="font-medium text-textDarkGray">
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
		<div class="swiper-pagination !static mt-6"></div>
	</div>
	<?php
}

function services_list( $services ) {
	if ( empty( $services ) ) {
		return;
	}
	?>
	<div class="container ">
		<ul class="grid grid-cols-6 gap-6 h-full">
			<?php
			$index = 0;
			foreach ( $services as $service ) {
				if ( count( $services ) - $index <= 3 ) {
					$service['class'] = 'col-span-3 lg:col-span-2';
				} else {
					$service['class'] = 'col-span-3';
				}
				?>
				<li class="<?php echo esc_attr( $service['class'] ) ?>">
					<div class="h-full flex flex-col  p-8 bg-white border border-lightGray rounded-lg">
						<img class="w-[40px] h-[40px] lg:w-[45px] lg:h-[45px] rounded-md mb-4"
							src="<?php echo esc_url( $service['icon']['url'] ) ?>"
							alt="<?php echo esc_url( $service['icon']['alt'] ) ?>">
						<h4 class="text-xl font-medium inline-block lg:text-[1.375rem] lg:leading-7 mb-3">
							<?php echo esc_html( $service['title'] ); ?>
						</h4>
						<div>
							<p class="font-medium mb-6 text-textDarkGray">
								<?php echo esc_html( $service['description'] ); ?>
							</p>
							<?php if ( isset( $service['tags'] ) && ! empty( $service['tags'] ) ) : ?>
								<div>
									<?php foreach ( $service['tags'] as $tag ) : ?>
										<span
											class="mr-3 mb-3 text-sm px-4 py-[10px] font-medium rounded-full border border-textBlack inline-block"><?php echo esc_html( $tag['title'] ) ?></span>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</li>
				<?php
				$index++;
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
	<div class="hidden md:block">
		<?php isset( $services_content['services_list'] ) && services_list( $services_content['services_list'] ); ?>
	</div>
	<div class="block md:hidden">
		<?php isset( $services_content['services_list'] ) && services_list_mobile( $services_content['services_list'] ); ?>

	</div>
</section>