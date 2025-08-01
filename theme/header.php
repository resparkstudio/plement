<?php
/**
 * The header for our theme
 *
 * This is the template that displays the `head` element and everything up
 * until the `#content` element.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Plement
 */

$type = 'dark';

if ( isset( $args['type'] ) && $args['type'] === 'light' ) {
	$type = 'light';
}


$is_dark = $type === 'dark';


?><!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100..1000&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

	<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/themes/light.css" />
	<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<div id="page" class="relative" x-data="{overlayOpen: false}">
		<a href="#content" class="sr-only"><?php esc_html_e( 'Skip to content', 'plement' ); ?></a>

		<?php get_template_part( 'template-parts/layout/header', 'content', array(
			'is_dark' => $is_dark,
		) ); ?>

		<div id="content">