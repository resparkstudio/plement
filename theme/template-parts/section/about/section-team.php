<?php
$team_content = get_field( 'team' );

if ( ! isset( $team_content ) || empty( $team_content ) ) {
	return;
}
?>


<section id="team" class="bg-lightGrayBg container py-[3.75rem] lg:pt-20 lg:pb-[5.625rem] lg:px-10">
	<div
		class="flex flex-col gap-10 pb-10 lg:flex-row lg:items-center lg:justify-between lg:pb-[5.25rem] lg:border-b lg:border-b-[#15151533] lg:border-opacity-20">
		<div class="max-w-[40.625rem] w-full">
			<h2 class="text-h4Bold mb-6 lg:mb-8 lg:text-h2"><?php esc_html_e( $team_content['heading'] ) ?></h2>
			<div class="text-title"><?php echo $team_content['description'] ?></div>
		</div>
		<div class="max-w-[27.6875rem] w-full">
			<img class="w-full" src="<?php echo esc_url( $team_content['image']['url'] ) ?>"
				alt="<?php esc_attr_e( $team_content['image']['alt'] ) ?>">
		</div>
	</div>
	<div class="flex flex-col gap-6 lg:flex-row lg:pt-20">
		<h2 class="text-h4Bold w-full lg:text-h2">
			<?php esc_html_e( $team_content['bottom_heading'] ) ?>
		</h2>
		<div class="flex flex-col gap-6 w-full lg:flex-row">
			<img class="w-8 h-8" src="<?php echo esc_url( $team_content['bottom_image']['url'] ) ?>"
				alt="<?php esc_attr_e( $team_content['image']['alt'] ) ?>">
			<div class="text-title">
				<?php echo $team_content['bottom_description'] ?>
			</div>
		</div>
	</div>

</section>