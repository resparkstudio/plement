<?php

$cta_content = get_field( 'cta' );

if ( empty( $cta_content ) ) {
	return;
}
?>

<section id="cta" class="bg-lightGrayBg mt-20 mb-[9.75rem] py-20 lg:mt-0 lg:mb-20 lg:py-[7.5rem] relative 3xl:static">
	<div class="container mx-auto flex flex-col lg:flex-row gap-10 lg:gap-[5.75rem]">
		<div class="max-w-[35.4375rem]">
			<h2 class="text-h4Bold lg:text-h2 mb-6">
				<?php echo esc_html( $cta_content['title'] ); ?>
			</h2>
			<ul class="flex flex-col gap-6 mb-[3.75rem]">
				<?php foreach ( $cta_content['benefits'] as $benefit ) : ?>
					<li class="flex gap-3 items-center">
						<svg class="flex-shrink-0" width="16" height="17" viewBox="0 0 16 17" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path d="M1 4.47905L7.91097 8.49998L14.8638 4.47905L7.91097 0.5L1 4.47905Z" fill="#ED5623" />
							<path d="M7.91097 8.49993V16.4999L1 12.479V4.479L7.91097 8.49993Z" fill="#FD8158" />
							<path d="M14.8572 4.479V12.479L7.9043 16.4999V8.49993L14.8572 4.479Z" fill="#D54515" />
						</svg>
						<span class="text-title text-darkGray">
							<?php echo $benefit['benefit'] ?>
						</span>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php plmt_button( $cta_content['link']['url'], $cta_content['link']['title'], array(
				"classes" => "w-full justify-center lg:w-auto",
			) ) ?>
		</div>
		<div>
			<img class="max-w-[37.25rem] w-full" src="<?php echo esc_url( $cta_content['image']['url'] ) ?>"
				alt="<?php echo esc_attr( $cta_content['image']['alt'] ) ?>">
		</div>
	</div>

</section>