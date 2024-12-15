<?php

$services_content = get_field( 'services' );

if ( ! isset( $services_content ) || empty( $services_content ) ) {
	return;
}

function services_list_mobile( $services, $heading ) {
	if ( empty( $services ) ) {
		return;
	}
	?>
	<div>
		<h2 class="text-center text-h4Bold py-20">
			<?php echo esc_html( $heading ) ?>
		</h2>
		<ul>
			<?php
			$index = 0;
			foreach ( $services as $service ) {
				?>
				<li class="group border-t border-t-darkGray">
					<div x-data="{ isExpanded: false }" class="flex flex-col px-10 py-8">
						<button @click="isExpanded = ! isExpanded">
							<img class="w-[32px] h-[32px] rounded-md mb-4"
								src="<?php echo esc_url( $service['icon']['url'] ) ?>"
								alt="<?php echo esc_url( $service['icon']['alt'] ) ?>">
							<h4 class="text-left text-h5Bold">
								<?php echo esc_html( $service['title'] ); ?>
							</h4>
						</button>
						<div x-cloak x-show="isExpanded" class="mt-4">
							<?php if ( isset( $service['description'] ) && ! empty( $service['description'] ) ) : ?>
								<p class="text-bodyRegular mb-8">
									<?php echo esc_html( $service['description'] ); ?>
								</p>
							<?php endif; ?>
							<div>
								<?php if ( isset( $service['tags'] ) && ! empty( $service['tags'] ) ) : ?>
									<div class="space-y-5">
										<?php foreach ( $service['tags'] as $tag ) : ?>
											<span class="flex items-center gap-3 text-bodyBold">
												<svg width="16" height="17" viewBox="0 0 16 17" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path d="M13.5 5.00024L6.5 11.9999L3 8.50024" stroke="#ED5623" stroke-width="2"
														stroke-linecap="round" stroke-linejoin="round" />
												</svg>
												<?php echo esc_html( $tag['title'] ) ?>
											</span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

					</div>
				</li>
				<?php
				$index++;
			}
			?>
			<li class="bg-accent text-white hover:bg-[#CF491C] border-t border-t-accent py-[4.625rem]">
				<a href="<?php echo esc_url( home_url( '/contact-us' ) ) ?>"
					class="text-center h-full w-full flex items-center justify-center text-h4Bold">
					<?php echo __( 'Contact Us', 'plmt' ) ?>
				</a>
			</li>
		</ul>
	</div>
	<?php
}

function services_list( $services, $heading ) {
	if ( empty( $services ) ) {
		return;
	}

	$services_count = count( $services );

	$contact_us_only   = ( $services_count - 2 ) % 3 === 0;
	$contact_us_second = ( $services_count - 2 ) % 3 === 1;

	?>
	<div class="container ">
		<ul class="grid grid-cols-3 h-full">
			<li class="flex items-center justify-center flex-col gap-[3.75rem]">
				<h2 class="text-center text-h4Bold lg:text-h3">
					<?php echo esc_html( $heading ) ?>
				</h2>
				<?php if ( $contact_us_only ) : ?>
					<?php plmt_button( home_url( '/contact-us' ), __( 'Contact Us', 'plmt' ), array(
						"classes" => "px-[5.625rem]"
					) ) ?>
				<?php endif; ?>
			</li>
			<?php
			$index = 0;
			foreach ( $services as $service ) {
				$has_description = isset( $service['description'] ) && ! empty( $service['description'] );
				$is_last         = $index === $services_count - 1;
				?>
				<li x-data="{active: false}" @mouseout="active = false" @mouseover="active = true"
					class="group <?php echo $is_last && $contact_us_second ? 'col-start-2 col-end-3' : '' ?>">
					<div
						class="h-full flex flex-col px-10 py-[3.75rem] border border-darkGray min-h-[360px] <?php echo $has_description ? 'group-hover:bg-[#F8F8FA] group-hover:text-mainBlack' : '' ?>">
						<div class="w-[32px] h-[32px] rounded-md mb-4 bg-textSecondary transition-all duration-300 ease-in-out <?php echo $has_description ? 'group-hover:bg-mainBlack' : '' ?>"
							style="mask-image: url(<?php echo esc_url( $service['icon']['url'] ) ?>)">

						</div>
						<h4 class="text-xl font-medium inline-block lg:text-[1.375rem] lg:leading-7 mb-2">
							<?php echo esc_html( $service['title'] ); ?>
						</h4>
						<div class="relative">
							<?php if ( $has_description ) : ?>
								<p
									class="absolute top-0 left-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out delay-75">
									<?php echo esc_html( $service['description'] ); ?>
								</p>
							<?php endif; ?>
							<div
								class="absolute top-0 left-0 <?php echo $has_description ? 'group-hover:opacity-0 transition-opacity duration-300 ease-in-out' : '' ?>">
								<?php if ( isset( $service['tags'] ) && ! empty( $service['tags'] ) ) :
									plmt_arrow_list( $service['tags'] );
								endif; ?>
							</div>
						</div>

					</div>
				</li>
				<?php
				$index++;
			}
			?>
			<?php if ( ! $contact_us_only ) : ?>
				<li
					class=" bg-accent text-white hover:bg-[#CF491C] border border-accent transition duration-200 min-h-[360px] <?php echo $contact_us_second ? 'col-start-3 col-end-4' : '' ?>">
					<a href="<?php echo esc_url( home_url( '/contact-us' ) ) ?>"
						class="h-full w-full flex items-center justify-center text-h4Bold">
						<?php echo __( 'Contact Us', 'plmt' ) ?>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
	<?php
}

?>
<section id="services" class="bg-mainBlack text-white">
	<div class="hidden md:block">
		<?php isset( $services_content['services_list'] ) && services_list( $services_content['services_list'], $services_content['heading'] ); ?>
	</div>
	<div class="block md:hidden">
		<?php isset( $services_content['services_list'] ) && services_list_mobile( $services_content['services_list'], $services_content['heading'] ); ?>
	</div>
</section>