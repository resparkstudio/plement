<?php

function plmt_button( $url = '#', $text, $options = array() ) {
	$variants = array(
		"primary" => "button",
		"secondary" => "button_secondary",
	);

	$defaults = array(
		"classes" => "",
		"target" => "_self",
		"variant" => "primary",
	);

	$options = wp_parse_args( $options, $defaults );

	$classes = $variants[ $options['variant'] ];

	if ( ! empty( $options['classes'] ) ) {
		$classes .= " " . $options['classes'];
	}
	?>
	<a href="<?php echo esc_url( $url ) ?>" class="<?php echo esc_attr( $classes ) ?>"><?php echo $text ?></a>
	<?php
}

function plmt_icon_button( $url = '#', $text, $options = array() ) {
	$defaults = array(
		"classes" => "",
		"target" => "_self",
	);

	$options = wp_parse_args( $options, $defaults );

	$classes = "button group h-auto";

	if ( ! empty( $options['classes'] ) ) {
		$classes .= " " . $options['classes'];
	}
	?>
	<a href='<?php echo esc_url( $url ) ?>' class='<?php echo esc_attr( $classes ) ?>'>
		<?php echo $text ?>
		<?php plmt_arrow() ?>
	</a>
	<?php
}