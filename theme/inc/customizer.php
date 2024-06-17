<?php
function site_logo( $wp_customize ) {
	$wp_customize->add_setting( 'site_logo' );

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'site_logo',
			array(
				'label' => 'Upload a logo',
				'section' => 'title_tagline',
				'settings' => 'site_logo'
			)
		)
	);
}
add_action( 'customize_register', 'site_logo' );