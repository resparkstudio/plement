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
						<div x-cloak x-show="isExpanded" class="mt-2">
							<p class="text-bodySmall">
								<?php echo esc_html( $service['description'] ); ?>
							</p>
							<div>
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
			<li class="flex items-center justify-center border-t border-t-accent py-[4.625rem]">
				<a href="<?php echo esc_url( home_url( '/contact-us' ) ) ?>" class="text-center text-h4Bold text-accent">
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
	?>
	<div class="container ">
		<ul class="grid grid-cols-3 h-full">
			<li class="flex items-center justify-center">
				<h2 class="text-center text-h4Bold lg:text-h3">
					<?php echo esc_html( $heading ) ?>
				</h2>
			</li>
			<?php
			$index = 0;
			foreach ( $services as $service ) {
				?>
				<li class="group">
					<div
						class="h-full flex flex-col px-10 py-[3.75rem] border border-darkGray min-h-[360px] group-hover:bg-accent">
						<img class="w-[32px] h-[32px] rounded-md mb-4" src="<?php echo esc_url( $service['icon']['url'] ) ?>"
							alt="<?php echo esc_url( $service['icon']['alt'] ) ?>">
						<h4 class="text-xl font-medium inline-block lg:text-[1.375rem] lg:leading-7 mb-2">
							<?php echo esc_html( $service['title'] ); ?>
						</h4>
						<p class="hidden group-hover:block text-bodySmall">
							<?php echo esc_html( $service['description'] ); ?>
						</p>
						<div class="group-hover:hidden">
							<?php if ( isset( $service['tags'] ) && ! empty( $service['tags'] ) ) :
								plmt_arrow_list( $service['tags'] );
							endif; ?>
						</div>

					</div>
				</li>
				<?php
				$index++;
			}
			?>
			<li class="flex items-center justify-center border border-accent">
				<a href="<?php echo esc_url( home_url( '/contact-us' ) ) ?>" class="text-center text-h4Bold text-accent">
					<?php echo __( 'Contact Us', 'plmt' ) ?>
				</a>
			</li>
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