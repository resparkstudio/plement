<?php

$services_tabs = get_field( 'services_tabs' );


if ( ! isset( $services_tabs ) || empty( $services_tabs ) ) {
	return;
}

function services_desktop( $services_tabs ) {
	?>
	<div x-data="{ selectedTab: '<?php echo $services_tabs['tabs'][0]['title'] ?>'}" class='mb-6 text-title'>
		<div @keydown.right.prevent="$focus.wrap().next()" @keydown.left.prevent="$focus.wrap().previous()"
			class="flex mb-[5.375rem]" role="tablist" aria-label="tab options">
			<?php foreach ( $services_tabs['tabs'] as $tab ) : ?>
				<button @click="selectedTab = '<?php echo $tab['title'] ?>'"
					:aria-selected="selectedTab === '<?php echo $tab['title'] ?>'"
					:class="selectedTab === '<?php echo $tab['title'] ?>' ? 'text-accent bg-white' : 'text-white hover:text-accent transition-colors duration-200'"
					class='w-full p-6 border border-darkGray'>
					<?php echo esc_html( $tab['title'] ) ?>
				</button>
			<?php endforeach; ?>
		</div>
		<?php foreach ( $services_tabs['tabs'] as $tab ) : ?>
			<div x-show="selectedTab === '<?php echo $tab['title'] ?>'" role="tabpanel" aria-labelledby="tab">
				<div class='flex flex-col items-start w-full justify-between lg:flex-row pb-[7.75rem] pl-10 pr-[10rem]'>
					<div class="max-w-[37.5rem] w-full">
						<h3 class='text-h3 mb-4'>
							<?php echo esc_html( $tab['title'] ) ?>
						</h3>
						<div class='mb-8 text-title text-textSecondary'>
							<?php echo $tab['description'] ?>
						</div>
						<ul class="space-y-5 mb-8">
							<?php foreach ( $tab['points'] as $point ) : ?>
								<li class='flex items-center gap-3 font-semibold'>
									<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.5 5.00024L6.5 11.9999L3 8.50024" stroke="#ED5623" stroke-width="2"
											stroke-linecap="round" stroke-linejoin="round" />
									</svg>
									<?php echo esc_html( $point['point'] ) ?>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php plmt_button( $tab['link']['url'], $tab['link']['title'] ) ?>
					</div>
					<div>
						<img src="<?php echo esc_url( $tab['image']['url'] ) ?>"
							alt="<?php echo esc_attr( $tab['image']['alt'] ) ?>">
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}

function services_mobile( $services_tabs ) {
	?>
	<ul>
		<?php
		$index = 0;
		foreach ( $services_tabs['tabs'] as $tab ) {
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
						<p class="text-textSecondary mb-8">
							<?php echo esc_html( $tab['description'] ); ?>
						</p>
						<ul class="space-y-5 mb-8">
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
						<?php plmt_button( $tab['link']['url'], $tab['link']['title'], array( 'classes' => 'w-full justify-center' ) ) ?>
					</div>

				</div>
			</li>
			<?php
			$index++;
		}
		?>
	</ul>
	<?php
}
?>

<section id='services' class='container'>
	<div class="bg-mainBlack pt-[3.75rem] lg:pt-20 text-white">
		<h2 class='text-center text-h4Bold lg:text-h2 mb-6'>
			<?php echo esc_html( $services_tabs['heading'] ) ?>
		</h2>
		<div class="hidden lg:block">
			<?php services_desktop( $services_tabs ) ?>
		</div>
		<div class="lg:hidden">
			<?php services_mobile( $services_tabs ) ?>
		</div>
	</div>
</section>