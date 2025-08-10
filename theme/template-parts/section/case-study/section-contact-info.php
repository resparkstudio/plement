<?php

$contact_us_id = get_page_by_path( 'contact-us' )->ID;



?>

<div class=" w-full lg:w-[23.25rem] flex flex-col gap-6 lg:justify-between sticky top-[6rem]">
	<div class="w-full">
		<?php
		$information = get_field( 'information', $contact_us_id );
		$mapped_info = array(
			'bead' => $information['bead'],
			'info_heading' => $information['heading'],
			'info_text' => $information['description'],
			'info_image' => $information['image'],
			'info_name' => $information['name'],
			'info_occupation' => $information['position'],
			'linkedin' => $information['linkedin'],
		);
		plmt_dark_info_card( $mapped_info ); ?>
	</div>
	<div class="w-full ">
		<?php
		$strategy_block = get_field( 'strategy_block', $contact_us_id );

		plmt_light_info_card( $strategy_block ); ?>
	</div>
</div>