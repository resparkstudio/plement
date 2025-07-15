<?php
$steps = get_field( 'steps' );

if ( ! isset( $steps ) || empty( $steps ) ) {
	return;
}
?>

<section id='steps' class="bg-mainBlack text-white mt-[3.25rem] lg:mt-[7.5rem]">
	<div class="container mx-auto py-7 lg:py-[4.625rem]">
		<div class="mx-auto mb-8 lg:mb-14 text-center">
			<?php if ( $steps['heading'] ) : ?>
				<h2 class="text-h1Mobile lg:text-h1 mb-4 lg:mb-6"><?php echo esc_html( $steps['heading'] ); ?></h2>
			<?php endif; ?>
			<?php if ( $steps['subtext'] ) : ?>
				<p class="text-titleMobile lg:text-title text-textSecondary">
					<?php echo esc_html( $steps['subtext'] ); ?>
				</p>
			<?php endif; ?>
		</div>
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-[2rem]">
			<?php foreach ( $steps['steps'] as $index => $step ) : ?>
				<div class="relative">
					<?php if ( $index + 1 < count( $steps['steps'] ) ) : ?>
						<svg class="absolute -bottom-9 left-1/2 -translate-x-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:-rotate-90 lg:w-[3.25rem] lg:h-[3.25rem] lg:-right-11 lg:left-auto lg:translate-x-0"
							width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M28.1624 38.1623L33.1624 33.1623C33.328 32.9845 33.4182 32.7495 33.4139 32.5066C33.4096 32.2637 33.3112 32.032 33.1395 31.8602C32.9677 31.6885 32.736 31.5901 32.4931 31.5858C32.2502 31.5815 32.0152 31.6717 31.8374 31.8373L28.4374 35.2357L28.4374 32.4998C28.4374 24.9998 24.1468 23.2123 20.3609 21.6341C16.8234 20.1607 13.7468 18.8748 13.4609 13.3529C14.9343 13.1097 16.2619 12.3203 17.1793 11.1419C18.0966 9.96358 18.5362 8.48283 18.4105 6.99481C18.2848 5.50679 17.603 4.12077 16.501 3.11301C15.399 2.10524 13.9577 1.54974 12.4644 1.5572C10.9711 1.56467 9.53542 2.13456 8.44355 3.15329C7.35167 4.17203 6.68376 5.56479 6.57294 7.05399C6.46212 8.5432 6.91652 10.0195 7.84558 11.1886C8.77464 12.3577 10.1101 13.1338 11.5859 13.3623C11.9078 20.1341 16.0062 21.8451 19.6406 23.3623C23.3546 24.9123 26.5624 26.2498 26.5624 32.4998L26.5624 35.2357L23.1624 31.8373C23.0766 31.7452 22.9731 31.6713 22.8581 31.62C22.7431 31.5688 22.619 31.5412 22.4931 31.539C22.3672 31.5368 22.2422 31.56 22.1254 31.6071C22.0087 31.6543 21.9027 31.7244 21.8136 31.8135C21.7246 31.9025 21.6544 32.0085 21.6073 32.1253C21.5601 32.242 21.537 32.367 21.5392 32.4929C21.5414 32.6188 21.569 32.7429 21.6202 32.8579C21.6715 32.9729 21.7453 33.0764 21.8374 33.1623L26.8374 38.1623C27.0132 38.3378 27.2515 38.4364 27.4999 38.4364C27.7484 38.4364 27.9867 38.3378 28.1624 38.1623ZM8.43745 7.49976C8.43745 6.69627 8.67571 5.91083 9.1221 5.24276C9.56849 4.57468 10.203 4.05398 10.9453 3.7465C11.6876 3.43902 12.5045 3.35857 13.2925 3.51532C14.0805 3.67207 14.8044 4.05899 15.3726 4.62714C15.9407 5.19529 16.3276 5.91916 16.4844 6.70721C16.6411 7.49525 16.5607 8.31209 16.2532 9.05441C15.9457 9.79674 15.425 10.4312 14.757 10.8776C14.0889 11.324 13.3034 11.5623 12.4999 11.5623C11.4225 11.5623 10.3892 11.1342 9.62732 10.3724C8.86546 9.61051 8.43745 8.5772 8.43745 7.49976Z"
								fill="#F8F8FA" />
						</svg>
					<?php endif; ?>
					<div
						class="absolute -top-5 lg:-top-10 left-3 lg:left-1/2 border-2 border-mainBlack lg:-translate-x-1/2 rounded-full bg-accent text-white w-[2.375rem] h-[2.375rem] lg:w-[2.875rem] lg:h-[2.875rem] flex items-center justify-center text-[1.5rem] font-bold">
						<?php echo $index + 1; ?>
					</div>
					<div
						class="mb-1 flex items-center justify-center gap-2 text-titleMobile font-bold lg:text-h5Bold bg-accent/15 text-accent py-[0.5938rem] lg:py-[0.875rem]">
						<img src="<?php echo esc_url( $step['icon']['url'] ); ?>"
							alt="<?php echo esc_attr( $step['icon']['alt'] ); ?>"
							class="w-[1.375rem] h-[1.375rem] lg:w-7 lg:h-7">
						<?php echo esc_html( $step['title'] ); ?>
					</div>
					<div class="bg-darkGray/30 text-lightGrayBg p-3 lg:p-4 text-center">
						<?php foreach ( $step['tasks'] as $task ) : ?>
							<p class="text-bodySmall lg:text-[1.125rem] lg:leading-[1.4625rem]">
								<?php echo esc_html( $task['item'] ); ?>
							</p>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>