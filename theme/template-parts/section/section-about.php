<?php

$statistics_content = get_field( 'statistics' );

if ( empty( $statistics_content ) ) {
	return;
}

function statistics_counts( $stats ) {
	if ( empty( $stats ) ) {
		return;
	}
	?>
	<ul class="flex flex-col gap-8 md:flex-row md:gap-14">
		<?php
		foreach ( $stats as $stat ) {
			?>
			<li class="max-w-[200px]">
				<span
					class="text-2xl font-bold mb-2 inline-block md:text-[2rem] md:mb-3"><?php echo esc_html( $stat['count'] ); ?></span>
				<div class="font-medium md:text-lg rich-text"><?php echo $stat['description'] ?></div>
			</li>
			<?php
		}
		?>
	</ul>
	<?php
}
?>

<section id="about" class="bg-lightGrayBg py-16 lg:py-36">
	<div class="container">
		<h2 class="font-medium text-2xl max-w-5xl mb-16 lg:text-5xl lg:leading-[72px] lg:mb-28">
			<?php echo esc_html( $statistics_content['text'] ); ?>
		</h2>
		<?php isset( $statistics_content['stats'] ) && statistics_counts( $statistics_content['stats'] ); ?>
	</div>
</section>