<?php

$statistics_content = get_field( 'statistics' );

$companies = $statistics_content['companies'];


if ( empty( $statistics_content ) ) {
	return;
}

function statistics_counts( $stats ) {
	if ( empty( $stats ) ) {
		return;
	}
	?>
	<ul class="flex flex-col gap-8 md:flex-row md:gap-[3.0625rem] justify-between">
		<?php
		foreach ( $stats as $stat ) {
			?>
			<li class="max-w-[200px]">
				<span
					class="text-h3 md:text-displayLarge mb-2 inline-block md:mb-3"><?php echo esc_html( $stat['count'] ); ?></span>
				<div class="rich-text text-darkGray text-title"><?php echo $stat['description'] ?></div>
			</li>
			<?php
		}
		?>
	</ul>
	<?php
}
?>

<section id="about" class="bg-lightGrayBg pt-[3.75rem] pb-12 lg:py-20">
	<div class="container">
		<h2 class="text-h5Bold mb-[4.6875rem] lg:text-center lg:text-h4Regular lg:mb-[4.25rem]">
			<?php echo esc_html( $statistics_content['text'] ); ?>
		</h2>
		<?php isset( $statistics_content['stats'] ) && statistics_counts( $statistics_content['stats'] ); ?>
	</div>
</section>

<section id="companies" class="py-20 lg:pb-[10.25rem]">
	<div class="container">
		<h2 class="text-h4Bold mb-4 lg:mb-10">
			<?php echo esc_html( $companies['title'] ); ?>
		</h2>
	</div>
	<div
		class="hidden relative md:flex overflow-hidden space-x-3 items-center after:content-[''] after:absolute after:top-0 after:right-0 after:bottom-0 before:z-10 after:block after:bg-gradientRight  before:content-[''] before:absolute before:top-0 before:left-0  before:bottom-0 before:block before:bg-gradientLeft before:w-14 after:w-14">
		<div class='flex space-x-3 animate-loop-scroll items-center'>
			<?php foreach ( $companies['icons'] as $logo ) : ?>
				<img src='<?php echo esc_url( $logo['url'] ) ?>' alt='<?php echo esc_attr( $logo['alt'] ) ?>'
					class='max-w-none object-contain gs h-[60px]' width='200' height="60">
			<?php endforeach; ?>
		</div>
		<div class='flex space-x-3 animate-loop-scroll items-center' aria-hidden='true'>
			<?php foreach ( $companies['icons'] as $logo ) : ?>
				<img src='<?php echo esc_url( $logo['url'] ) ?>' alt='<?php echo esc_attr( $logo['alt'] ) ?>'
					class='max-w-none object-contain gs h-[60px]' width='200' height="60">
			<?php endforeach; ?>
		</div>
	</div>
	<div class="md:hidden">
		<?php
		$companies['icons'] = array_chunk( $companies['icons'], ceil( count( $companies['icons'] ) ) / 3 );
		foreach ( $companies['icons'] as $companies ) :
			?>
			<div
				class="relative flex overflow-hidden space-x-3 items-center after:content-[''] after:absolute after:top-0 after:right-0 after:bottom-0 before:z-10 after:block after:bg-gradientRight  before:content-[''] before:absolute before:top-0 before:left-0  before:bottom-0 before:block before:bg-gradientLeft before:w-14 after:w-14">
				<div class='flex space-x-3 animate-loop-scroll items-center'>
					<?php foreach ( $companies as $logo ) : ?>
						<img src='<?php echo esc_url( $logo['url'] ) ?>' alt='<?php echo esc_attr( $logo['alt'] ) ?>'
							class='max-w-none object-contain gs h-[60px]' width='200' height="60">
					<?php endforeach; ?>
				</div>
				<div class='flex space-x-3 animate-loop-scroll items-center' aria-hidden='true'>
					<?php foreach ( $companies as $logo ) : ?>
						<img src='<?php echo esc_url( $logo['url'] ) ?>' alt='<?php echo esc_attr( $logo['alt'] ) ?>'
							class='max-w-none object-contain gs h-[60px]' width='200' height="60">
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>