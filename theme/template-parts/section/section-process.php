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
		class="aspect-square text-[1.5rem] leading-[1.5rem] lg:text-[2.5rem] lg:leading-[2.5rem] font-light bg-accent rounded-full h-[3.75rem] w-[3.75rem] lg:h-[5rem] lg:w-[5rem] text-white flex items-center justify-center border border-white">
		<span>
			<?php echo $index ?>
		</span>
	</div>
	<?php
}

function step_card( $step, $index ) {
	if ( empty( $step ) ) {
		return;
	}
	?>
	<div class="max-w-[680px] rounded-[4px] translate-y-3">
		<h2 class="text-title lg:text-h5Bold mb-1"><?php echo esc_html( $step['title'] ) ?></h2>
		<p class="text-bodyRegular text-darkGray"><?php echo esc_html( $step['description'] ) ?></p>
	</div>
	<?php
}

?>

<section id="process" class="container pb-[7.5rem] lg:pb-[10rem]">
	<h2
		class="text-h4Bold lg:text-[3rem] lg:leading-[3.3rem] lg:font-extrabold text-left lg:mx-auto mb-8 lg:mb-20 lg:text-center">
		<?php echo esc_html( $process_content['heading'] ) ?>
	</h2>
	<div class="relative">
		<div class="mx-auto max-w-[50rem] lg:w-full space-y-8 relative">
			<div
				class=" process-line-wrap -z-[1] bg-lightGrayBorder w-[2px] h-full absolute top-0 bottom-0 left-[30px] lg:left-[39px]">
				<div class="process-line bg-accent w-full h-full"></div>
			</div>
			<?php
			$index = 1;
			foreach ( $process_content['steps'] as $step ) :
				$is_last = count( $process_content['steps'] ) === $index;
				?>
				<div class="relative gap-2 lg:gap-10 flex items-start process-item <?php echo $is_last ? 'is-last' : '' ?>">
					<!-- Icon -->
					<?php step_icon( $index ) ?>
					<?php step_card( $step, $index ) ?>
				</div>
				<?php
				$index++;
			endforeach; ?>
		</div>
	</div>
</section>