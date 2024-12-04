<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Plement
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function plmt_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'plmt_pingback_header' );

/**
 * Changes comment form default fields.
 *
 * @param array $defaults The default comment form arguments.
 *
 * @return array Returns the modified fields.
 */
function plmt_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'plmt_comment_form_defaults' );

/**
 * Filters the default archive titles.
 */
function plmt_get_the_archive_title() {
	if ( is_category() ) {
		$title = __( 'Category Archives: ', 'plement' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = __( 'Tag Archives: ', 'plement' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = __( 'Author Archives: ', 'plement' ) . '<span>' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = __( 'Yearly Archives: ', 'plement' ) . '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'plement' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = __( 'Monthly Archives: ', 'plement' ) . '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'plement' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = __( 'Daily Archives: ', 'plement' ) . '<span>' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$cpt   = get_post_type_object( get_queried_object()->name );
		$title = sprintf(
			/* translators: %s: Post type singular name */
			esc_html__( '%s Archives', 'plement' ),
			$cpt->labels->singular_name
		);
	} elseif ( is_tax() ) {
		$tax   = get_taxonomy( get_queried_object()->taxonomy );
		$title = sprintf(
			/* translators: %s: Taxonomy singular name */
			esc_html__( '%s Archives', 'plement' ),
			$tax->labels->singular_name
		);
	} else {
		$title = __( 'Archives:', 'plement' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'plmt_get_the_archive_title' );

/**
 * Determines whether the post thumbnail can be displayed.
 */
function plmt_can_show_post_thumbnail() {
	return apply_filters( 'plmt_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
 * Returns the size for avatars used in the theme.
 */
function plmt_get_avatar_size() {
	return 60;
}

/**
 * Create the continue reading link
 *
 * @param string $more_string The string shown within the more link.
 */
function plmt_continue_reading_link( $more_string ) {

	if ( ! is_admin() ) {
		$continue_reading = sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s', 'plement' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="sr-only">"', '"</span>', false )
		);

		$more_string = '<a href="' . esc_url( get_permalink() ) . '">' . $continue_reading . '</a>';
	}

	return $more_string;
}

// Filter the excerpt more link.
add_filter( 'excerpt_more', 'plmt_continue_reading_link' );

// Filter the content more link.
add_filter( 'the_content_more_link', 'plmt_continue_reading_link' );

/**
 * Outputs a comment in the HTML5 format.
 *
 * This function overrides the default WordPress comment output in HTML5
 * format, adding the required class for Tailwind Typography. Based on the
 * `html5_comment()` function from WordPress core.
 *
 * @param WP_Comment $comment Comment to display.
 * @param array      $args    An array of arguments.
 * @param int        $depth   Depth of the current comment.
 */
function plmt_html5_comment( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

	$commenter          = wp_get_current_commenter();
	$show_pending_links = ! empty( $commenter['comment_author'] );

	if ( $commenter['comment_author_email'] ) {
		$moderation_note = __( 'Your comment is awaiting moderation.', 'plement' );
	} else {
		$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'plement' );
	}
	?>
	<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment->has_children ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
					if ( 0 !== $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					}
					?>
					<?php
					$comment_author = get_comment_author_link( $comment );

					if ( '0' === $comment->comment_approved && ! $show_pending_links ) {
						$comment_author = get_comment_author( $comment );
					}

					printf(
						/* translators: %s: Comment author link. */
						wp_kses_post( __( '%s <span class="says">says:</span>', 'plement' ) ),
						sprintf( '<b class="fn">%s</b>', wp_kses_post( $comment_author ) )
					);
					?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<?php
					printf(
						'<a href="%s"><time datetime="%s">%s</time></a>',
						esc_url( get_comment_link( $comment, $args ) ),
						esc_attr( get_comment_time( 'c' ) ),
						esc_html(
							sprintf(
								/* translators: 1: Comment date, 2: Comment time. */
								__( '%1$s at %2$s', 'plement' ),
								get_comment_date( '', $comment ),
								get_comment_time()
							)
						)
					);

					edit_comment_link( __( 'Edit', 'plement' ), ' <span class="edit-link">', '</span>' );
					?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' === $comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation"><?php echo esc_html( $moderation_note ); ?></em>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div <?php plmt_content_class( 'comment-content' ); ?>>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
			if ( '1' === $comment->comment_approved || $show_pending_links ) {
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth' => $depth,
							'max_depth' => $args['max_depth'],
							'before' => '<div class="reply">',
							'after' => '</div>',
						)
					)
				);
			}
			?>
		</article><!-- .comment-body -->
		<?php
}

function plmt_arrow() {
	?>
		<div class="z-1 flex justify-center items-center relative overflow-hidden ">
			<div
				class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
					role="img" class="iconify iconify--ic" width=" 100%" height=" 100%" preserveAspectRatio="xMidYMid meet"
					viewBox="0 0 24 24">
					<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
				</svg>
			</div>
			<div
				class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
					role="img" class="iconify iconify--ic" width=" 100%" height=" 100%" preserveAspectRatio="xMidYMid meet"
					viewBox="0 0 24 24">
					<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
				</svg>
			</div>
		</div>
		<?php
}

function plmt_button_with_arrow( $on_click, $text, $value, $config = array() ) {

	$variant_map = array(
		'primary' => 'button',
		'outlined' => 'button_outlined',
	);

	$defaults = array(
		'classes' => '',
		'variant' => 'primary',
	);

	$config = wp_parse_args( $config, $defaults );

	$selected_variant = ! empty( $config['variant'] ) ? $config['variant'] : 'primary';

	$classes = 'group justify-center w-full ' . $config['classes'] . ' ' . $variant_map[ $selected_variant ];

	?>
		<button @click="<?php echo $on_click ?>" class="<?php echo esc_attr( $classes ) ?>"
			value="<?php echo esc_attr( $value ) ?>">
			<?php echo $text ?>
			<?php plmt_arrow() ?>
		</button>
		<?php
}

function plmt_modal( $modal_id, $contentCallback ) {
	ob_start();
	call_user_func( $contentCallback );
	$content = ob_get_clean();

	?>
		<div @keydown.escape.window="<?php echo esc_attr( $modal_id ) ?> = false" class="relative z-50 w-auto h-auto">
			<template x-teleport="body">
				<div x-show="<?php echo esc_attr( $modal_id ) ?>"
					class="fixed top-0 left-0 z-[1000] flex items-center justify-center w-screen h-screen px-4 lg:px-0"
					x-cloak>
					<div x-show="<?php echo esc_attr( $modal_id ) ?>" x-transition:enter="ease-out duration-300"
						x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
						x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
						x-transition:leave-end="opacity-0" @click="<?php echo esc_attr( $modal_id ) ?>=false"
						class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
					<div x-show="<?php echo esc_attr( $modal_id ) ?>"
						x-trap.inert.noscroll="<?php echo esc_attr( $modal_id ) ?>"
						x-transition:enter="ease-out duration-300"
						x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
						x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
						x-transition:leave="ease-in duration-200"
						x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
						x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
						class="relative px-4 py-14 w-full lg:p-20 bg-lightGrayBg rounded-lg container lg:w-max">
						<button @click="<?php echo esc_attr( $modal_id ) ?>=false"
							class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
							<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
								stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
						<?php echo $content ?>
					</div>
				</div>
			</template>
		</div>
		<?php
}

function plmt_arrow_list( $tags ) {
	?>
		<div>
			<?php foreach ( $tags as $tag ) : ?>
				<span class="flex items-center gap-2 py-2 text-bodySmall">
					<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M13.5 5.00024L6.5 11.9999L3 8.50024" stroke="#ED5623" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
					<?php echo esc_html( $tag['title'] ) ?>
				</span>
			<?php endforeach; ?>
		</div>
		<?php
}

function plmt_tag_chips( $tags ) {
	?>
		<div class="flex flex-wrap gap-2">
			<?php foreach ( $tags as $tag ) : ?>
				<span
					class="bg-chipGray px-3 py-[6px] rounded-full text-lightGrayBg inline-block text-center text-bodySmall"><?php echo esc_html( $tag['chip'] ) ?></span>
			<?php endforeach; ?>
		</div>
		<?php
}

function plmt_build_menu_tree( $menu, $parent_id ) {
	$branch = array();

	foreach ( $menu as $item ) {
		if ( $item->menu_item_parent == $parent_id ) {
			$children = plmt_build_menu_tree( $menu, $item->ID );

			if ( $children ) {
				$item->children = $children;
			}

			$branch[] = array(
				'ID' => $item->ID,
				'title' => $item->title,
				'url' => $item->url,
				'children' => $children ?? null,
				'description' => get_field( 'description', $item->ID ) ?? '',
				'image' => get_field( 'image', $item->ID ) ?? '',
				'is_contact_us' => get_field( 'is_contact_us', $item->ID ) ?? false,
				'parentID' => $item->menu_item_parent,
			);
		}
	}

	return $branch;
}

function plmt_menu_builder( $menu_id = '' ) {
	$menu = wp_get_nav_menu_items( $menu_id );
	return plmt_build_menu_tree( $menu, 0 );
}

function plmt_arrow_dom_node() {
	$dom  = new DOMDocument();
	$html = '<div class="z-1 flex justify-center items-center relative overflow-hidden ">
                <div class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--ic" width="100%" height="100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
                    </svg>
                </div>
                <div class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--ic" width="100%" height="100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
                    </svg>
                </div>
            </div>';
	$dom->loadHTML( $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
	return $dom->documentElement;
}

function plmt_rich_content_link( $content ) {
	// Get link from rich content and add plmt_arrow() output inside the a element
	$dom = new DOMDocument();
	libxml_use_internal_errors( true ); // Suppress warnings for invalid HTML
	$dom->loadHTML( $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
	libxml_clear_errors();

	$links = $dom->getElementsByTagName( 'a' );

	foreach ( $links as $link ) {
		// Add plmt_arrow() output inside the a element
		$link->appendChild( new DOMText( ' ' ) );
		$link->appendChild( $dom->importNode( plmt_arrow_dom_node(), true ) );
	}

	return $dom->saveHTML();
}