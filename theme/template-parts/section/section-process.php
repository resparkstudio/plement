<?php

$process_content = get_field( 'process' );

if ( ! isset( $process_content ) || empty( $process_content ) ) {
	return;
}

function step_icon( $index ) {
	if ( ! isset( $index ) )
		return;
	?>
	<div
		class="text-xl md:text-[32px] font-medium text-lightGray md:absolute md:group-odd:left-1/2 md:group-even:right-1/2 flex items-center justify-center w-[52px] h-[52px] rounded-full border border-white bg-white group-[.is-active]:bg-white group-[.is-active]:text-accent shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 md:w-20 md:h-20 ">
		<?php echo $index < 10 ? '0' . $index : $index ?>
	</div>
	<?php
}

function step_card( $step, $index ) {
	if ( empty( $step ) ) {
		return;
	}
	?>
	<div class="border border-lightGray px-10 py-8 max-w-[443px] rounded-[4px]">
		<span class="text-accent font-bold inline-block mb-3"><?php echo $index < 10 ? '0' . $index : $index ?></span>
		<h2 class="text-xl font-medium mb-3 lg:text-[22px]"><?php echo esc_html( $step['title'] ) ?></h2>
		<p class="text-textGray font-medium"><?php echo esc_html( $step['description'] ) ?></p>
	</div>
<?
}

?>

<section id="process" class="container py-20 lg:py-36">
	<h2 class="text-left max-w-[542px] lg:mx-auto mb-8 lg:mb-20 lg:text-center">
		<?php echo esc_html( $process_content['heading'] ) ?>
	</h2>
	<div
		class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
		<?php
		$index = 1;
		foreach ( $process_content['steps'] as $step ) : ?>
			<div
				class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
				<!-- Icon -->
				<?php step_icon( $index ) ?>
				<?php step_card( $step, $index ) ?>
			</div>
			<?php
			$index++;
		endforeach; ?>
	</div>
</section>