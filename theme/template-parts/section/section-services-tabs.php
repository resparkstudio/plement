<?php

$services_tabs = get_field( 'services_tabs' );


if ( ! isset( $services_tabs ) || empty( $services_tabs ) ) {
	return;
}

function services_desktop( $services_tabs, $bottom_link ) {
	?>
	<div x-data="{ selectedTab: '<?php echo $services_tabs[0]['title'] ?>'}" class='text-title'>
		<div @keydown.right.prevent="$focus.wrap().next()" @keydown.left.prevent="$focus.wrap().previous()"
			class="flex mb-[5.375rem]" role="tablist" aria-label="tab options">
			<?php foreach ( $services_tabs as $tab ) : ?>
				<button @click="selectedTab = '<?php echo $tab['title'] ?>'"
					:aria-selected="selectedTab === '<?php echo $tab['title'] ?>'"
					:class="selectedTab === '<?php echo $tab['title'] ?>' ? 'text-accent bg-white' : 'text-white hover:text-accent transition-colors duration-200'"
					class='w-full p-6 border border-darkGray'>
					<?php echo esc_html( $tab['title'] ) ?>
				</button>
			<?php endforeach; ?>
		</div>
		<div class="pb-[7.75rem] px-10">
			<?php foreach ( $services_tabs as $tab ) : ?>
				<div x-show="selectedTab === '<?php echo $tab['title'] ?>'" role="tabpanel" aria-labelledby="tab">
					<div class='flex flex-col items-start w-full justify-between lg:flex-row '>
						<div class="max-w-[37.5rem] w-full">
							<h3 class='text-h3 mb-4'>
								<?php echo esc_html( $tab['title'] ) ?>
							</h3>
							<div class='mb-8 text-title text-textSecondary whitespace-pre-line'>
								<?php echo $tab['description'] ?>
							</div>
							<ul class="space-y-5 mb-8">
								<?php foreach ( $tab['points'] as $point ) : ?>
									<li class='flex items-center gap-3 font-semibold'>
										<svg width="16" height="17" viewBox="0 0 16 17" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M13.5 5.00024L6.5 11.9999L3 8.50024" stroke="#ED5623" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round" />
										</svg>
										<?php echo esc_html( $point['point'] ) ?>
									</li>
								<?php endforeach; ?>
							</ul>

						</div>
						<div>
							<img src="<?php echo esc_url( $tab['image']['url'] ) ?>"
								alt="<?php echo esc_attr( $tab['image']['alt'] ) ?>">
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<?php if ( $bottom_link ) : ?>
				<div class="flex justify-center w-full">
					<?php plmt_button( $bottom_link['url'], $bottom_link['title'], array(
						'classes' => ''
					) ) ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

function services_mobile( $services_tabs, $bottom_link ) {
	?>
	<ul>
		<?php
		$index = 0;
		foreach ( $services_tabs as $tab ) {
			?>
			<li class="group border-t border-t-darkGray">
				<div x-data="{ isExpanded: false }" class="flex flex-col p-6">
					<button @click="isExpanded = ! isExpanded" class="flex justify-between items-center">
						<h4 class="text-left text-h5Bold">
							<?php echo esc_html( $tab['title'] ); ?>
						</h4>
						<svg :class="isExpanded && 'rotate-180'" width="32" height="32" viewBox="0 0 32 32" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path d="M6 12L16 22L26 12" stroke="white" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" />
						</svg>
					</button>
					<div x-cloak x-show="isExpanded" class="mt-4">
						<p class="text-textSecondary mb-8 whitespace-pre-line">
							<?php echo esc_html( $tab['description'] ); ?>
						</p>
						<ul class="space-y-5">
							<?php foreach ( $tab['points'] as $point ) : ?>
								<li class='flex items-center gap-3 text-bodyBold'>
									<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.5 5.00024L6.5 11.9999L3 8.50024" stroke="#ED5623" stroke-width="2"
											stroke-linecap="round" stroke-linejoin="round" />
									</svg>
									<?php echo esc_html( $point['point'] ) ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>

				</div>
			</li>
			<?php
			$index++;
		}
		?>
		<?php if ( $bottom_link ) : ?>
			<li class="border-t border-t-darkGray">
				<div class="flex justify-center pt-6 pb-7 px-[3.4063rem]">
					<?php plmt_button( $bottom_link['url'], $bottom_link['title'], array( 'classes' => 'w-full justify-center' ) ) ?>
				</div>
			</li>
		<?php endif; ?>
	</ul>
	<?php
}
?>

<section id='services' class='container'>
	<div class="bg-mainBlack pt-[3.75rem] lg:pt-20 text-white"
		x-data="{toolSelected: '<?php echo $services_tabs['tabs'][0]['tab_button']['title'] ?>'}">
		<div class="flex justify-center w-full mb-6 lg:mb-8">
			<?php foreach ( $services_tabs['tabs'] as $service_tab ) : ?>
				<button
					class="flex gap-2 text-white py-3 px-6 border border-darkGray hover:border-accent transition-colors duration-200 hover:text-accent text-h5Mobile lg:text-h5Bold group"
					x-bind:class="toolSelected === '<?php echo $service_tab['tab_button']['title'] ?>' ? '!text-accent !border-accent' : ''"
					@click="toolSelected = '<?php echo $service_tab['tab_button']['title'] ?>'">
					<div class="w-5 h-5 lg:w-6 lg:h-6 bg-white group-hover:bg-accent transition-all duration-300 ease-in-out <?php echo $has_description ? 'group-hover:bg-mainBlack' : '' ?>"
						x-bind:class="toolSelected === '<?php echo $service_tab['tab_button']['title'] ?>' ? '!bg-accent' : ''"
						style="mask-image: url(<?php echo esc_url( $service_tab['tab_button']['icon']['url'] ) ?>);mask-size: cover;">
					</div>
					<?php echo esc_html( $service_tab['tab_button']['title'] ); ?>
				</button>
			<?php endforeach; ?>
		</div>
		<?php foreach ( $services_tabs['tabs'] as $service_tab ) : ?>
			<h4 class="text-center text-h1Mobile lg:text-h1 mb-6" x-cloak
				x-show="toolSelected === '<?php echo $service_tab['tab_button']['title'] ?>'">
				<?php echo esc_html( $service_tab['heading'] ); ?>
			</h4>
		<?php endforeach; ?>
		<?php foreach ( $services_tabs['tabs'] as $service_tab ) : ?>
			<div class="hidden lg:block" x-cloak
				x-show="toolSelected === '<?php echo $service_tab['tab_button']['title'] ?>'">
				<?php services_desktop( $service_tab['inner_tabs'], $service_tab['bottom_link'] ) ?>

			</div>
		<?php endforeach; ?>
		<?php foreach ( $services_tabs['tabs'] as $service_tab ) : ?>
			<div class="lg:hidden" x-cloak x-show="toolSelected === '<?php echo $service_tab['tab_button']['title'] ?>'">
				<?php services_mobile( $service_tab['inner_tabs'], $service_tab['bottom_link'] ) ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>