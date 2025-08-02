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

function plmt_arrow( $width_class = 'w-[1.125rem]', $height_class = 'h-[1.125rem]' ) {
	?>
		<div class="z-1 flex justify-center items-center relative overflow-hidden ">
			<div
				class="justify-center items-center transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0 <?php echo $width_class . ' ' . $height_class ?>">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
					role="img" class="iconify iconify--ic" width=" 100%" height=" 100%" preserveAspectRatio="xMidYMid meet"
					viewBox="0 0 24 24">
					<path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path>
				</svg>
			</div>
			<div
				class="justify-center items-center transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%] <?php echo $width_class . ' ' . $height_class ?>">
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
				'dark_image' => get_field( 'dark_image', $item->ID ) ?? '',
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

add_filter( 'wp_get_nav_menu_items', 'my_wp_get_nav_menu_items', 10, 3 );
function my_wp_get_nav_menu_items( $items, $menu, $args ) {
	foreach ( $items as $key => $item )
		$items[ $key ]->description = '';

	return $items;
}

function plmt_modify_case_study_archive_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'case-study' ) ) {
		$query->set( 'posts_per_page', 6 );
	}
}
add_action( 'pre_get_posts', 'plmt_modify_case_study_archive_query' );

function success_modal() {
	plmt_modal( "successModalOpen", function () {
		?>
			<div class="flex flex-col justify-center items-center h-full gap-3 w-full">
				<div class="bg-[#88C941] rounded-full w-[57px] h-[57px] mb-3 flex justify-center items-center">
					<svg width="32" height="23" viewBox="0 0 32 23" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M30.9246 4.17438L13.1121 21.9869C12.8934 22.2088 12.6327 22.385 12.3453 22.5053C12.0578 22.6256 11.7493 22.6875 11.4377 22.6875C11.1262 22.6875 10.8177 22.6256 10.5302 22.5053C10.2428 22.385 9.98211 22.2088 9.76337 21.9869L1.45087 13.6744C1.0068 13.2303 0.757324 12.628 0.757324 12C0.757324 11.372 1.0068 10.7697 1.45087 10.3256C1.89495 9.88156 2.49724 9.63208 3.12525 9.63208C3.75326 9.63208 4.35555 9.88156 4.79962 10.3256L11.4377 16.9519L27.5759 0.825629C28.0199 0.381558 28.6222 0.13208 29.2502 0.13208C29.8783 0.13208 30.4806 0.381558 30.9246 0.825629C31.3687 1.2697 31.6182 1.87199 31.6182 2.5C31.6182 3.12802 31.3687 3.73031 30.9246 4.17438Z"
							fill="white" />
					</svg>
				</div>
				<h3><?php esc_html_e( "Thank your for contacting us!", "plmt" ) ?></h3>
				<p class="max-w-md text-lg font-medium text-center">
					<?php esc_html_e( "We have received your message and will respond to you soon", "plmt" ) ?>
				</p>
			</div>
			<?php
	} )
		?>
		<?php
}

function plmt_tool_tag( $tool ) {
	$tool_icon = get_field( 'icon', $tool->taxonomy . '_' . $tool->term_id );

	if ( $tool_icon ) {
		$icon_html = '<img src="' . esc_url( $tool_icon['url'] ) . '" alt="' . esc_attr( $tool_icon['alt'] ) . '" class="w-4 lg:w-5 h-auto shrink-0">';
	} else {
		$icon_html = '';
	}

	$tool_name = esc_html( $tool->name );

	?>
		<div
			class="bg-accent/10 text-accent p-2 lg:text-bodyBold absolute top-4 right-4 flex items-center gap-1 text-bodySmall font-bold">
			<?php echo $icon_html; ?>
			<?php echo esc_html( $tool_name ); ?>
		</div>
		<?php
}

function plmt_dropdown( $options, $button_text = 'Select Item', $button_class = '' ) {
	?>
		<div class="relative max-w-[13.1875rem] w-full sm:max-w-max"
			x-data="{selectOpen: false, selectedItem: {value: 'all', title: 'All'}}" @click.away="selectOpen = false">
			<button @click="selectOpen = !selectOpen" :class="{ 'bg-mainBlack text-white' : selectOpen }"
				class="relative min-h-[39px] flex items-center justify-between w-full py-[0.625rem] pl-4 pr-[2.625rem] text-left bg-lightGrayBg cursor-default text-darkGray focus:outline-none text-bodySmall font-bold lg:text-bodyBold">
				<span x-text="selectedItem ? `<?php echo esc_attr( $button_text ) ?> ${selectedItem.title}` : 'Select Item'"
					class="truncate">
					<?php echo esc_html( $button_text ); ?> <span x-text="selectedItem.title"></span>
				</span>
				<span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
					<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg"
						:class="{ 'rotate-180' : selectOpen }">
						<path
							d="M13.4619 6.30865C13.4241 6.21729 13.36 6.1392 13.2778 6.08426C13.1956 6.02932 13.0989 6 13 6H3C2.90111 6 2.80444 6.02932 2.72221 6.08427C2.63999 6.13921 2.5759 6.2173 2.53806 6.30866C2.50022 6.40003 2.49031 6.50056 2.50961 6.59755C2.5289 6.69455 2.57653 6.78364 2.64646 6.85356L7.64646 11.8535C7.69288 11.9 7.748 11.9368 7.80866 11.9619C7.86932 11.9871 7.93434 12 8 12C8.06566 12 8.13068 11.9871 8.19134 11.9619C8.252 11.9368 8.30712 11.9 8.35355 11.8535L13.3535 6.85356C13.4235 6.78364 13.4711 6.69454 13.4904 6.59755C13.5097 6.50056 13.4998 6.40002 13.4619 6.30865Z"
							fill="currentColor" />
					</svg>

				</span>
			</button>
			<ul x-show="selectOpen"
				class="absolute z-[1000] w-full py-3 mt-0.5 overflow-auto text-bodySmall font-bold lg:text-bodyBold bg-mainBlack ring-1 ring-black ring-opacity-5 focus:outline-none"
				x-cloak>
				<li data-value="all"
					@click="selectedItem = { value: 'all', title: '<?php echo esc_js( 'All' ); ?>' }; selectOpen = false"
					class="relative z-[100] flex items-center justify-between h-full pb-[0.3125rem] px-3 text-white cursor-default select-none <?php echo esc_attr( $button_class ); ?>">
					<span>
						<?php esc_html_e( 'All', 'plmt' ); ?>
					</span>
					<svg x-show="selectedItem.value=='all'" width="18" height="18" viewBox="0 0 18 18" fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path d="M14 6L7.3333 13L4 9.5" stroke="#ED5623" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>

				</li>
				<?php foreach ( $options as $value => $label ) : ?>
					<li data-value="<?php echo esc_attr( $value ); ?>"
						@click="selectedItem = { value: '<?php echo esc_js( $value ); ?>', title: '<?php echo esc_js( $label ); ?>' }; selectOpen = false"
						class="relative z-[100] flex items-center justify-between h-full py-[0.3125rem] px-3 text-white cursor-default select-none <?php echo esc_attr( $button_class ); ?>">
						<span class="block truncate">
							<?php echo esc_html( $label ); ?>
						</span>
						<svg x-show="selectedItem.value=='<?php echo esc_js( $value ); ?>'" width="18" height="18"
							viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14 6L7.3333 13L4 9.5" stroke="#ED5623" stroke-width="1.5" stroke-linecap="round"
								stroke-linejoin="round" />
						</svg>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
}
function currency_switch() {
	?>
		<div class="w-full justify-center md:justify-end flex items-center gap-4 flex-wrap mb-10">
			<label for="currency" class="w-max block text-bodyBold lg:text-[1rem] lg:leading-[1.5rem] lg:font-medium">
				<?php esc_html_e( 'Display Price in:', 'plmt' ) ?>
			</label>
			<div
				class="relative lg:max-w-[13.75rem] grid items-center justify-center w-full h-8 grid-cols-2 bg-[#F3F4F4] select-none">
				<button value="eur" :class="currency==='eur' ? 'font-bold' : ''" @click="currency='eur'" type="button"
					class="relative z-20 inline-flex items-center justify-center w-full h-7 px-3 transition-all cursor-pointer whitespace-nowrap">
					EUR
				</button>
				<button value="usd" :class="currency==='usd' ? 'font-bold' : ''" @click="currency='usd'" type="button"
					class="relative z-20 inline-flex items-center justify-center w-full h-7 px-3 transition-all cursor-pointer whitespace-nowrap">
					USD
				</button>
				<div :class="currency==='eur' ? 'left-[2px]' : 'right-[2px]'" x-transition
					class="absolute z-10 w-1/2 h-7 duration-300 ease-out" x-cloak>
					<div class="w-full h-7 bg-white shadow-sm"></div>
				</div>
			</div>
		</div>
		<?php
}

function bottom_tooltip( $content, $is_mobile = false ) {
	?>
		<svg class="<?php echo $is_mobile ? 'bottom-item-mobile-tippy' : 'bottom-item-tippy' ?>"
			data-tippy-content="<?php echo esc_attr( $content ) ?>" width="18" height="19" viewBox="0 0 18 19" fill="none"
			xmlns="http://www.w3.org/2000/svg">
			<path
				d="M14.9932 9.20508C14.9593 8.51791 14.8068 7.84108 14.543 7.2041C14.2414 6.47615 13.7993 5.81496 13.2422 5.25781C12.685 4.70066 12.0239 4.25856 11.2959 3.95703C10.6589 3.69319 9.98208 3.54065 9.29492 3.50684L9 3.5C8.21209 3.5 7.43204 3.65552 6.7041 3.95703C5.97615 4.25856 5.31496 4.70066 4.75781 5.25781C4.20066 5.81496 3.75856 6.47615 3.45703 7.2041C3.15552 7.93204 3 8.71209 3 9.5L3.00684 9.79492C3.04065 10.4821 3.19319 11.1589 3.45703 11.7959C3.75856 12.5239 4.20066 13.185 4.75781 13.7422C5.31496 14.2993 5.97615 14.7414 6.7041 15.043C7.43204 15.3445 8.21209 15.5 9 15.5L9.29492 15.4932C9.98209 15.4593 10.6589 15.3068 11.2959 15.043C12.0239 14.7414 12.685 14.2993 13.2422 13.7422C13.7993 13.185 14.2414 12.5239 14.543 11.7959C14.8445 11.068 15 10.2879 15 9.5L14.9932 9.20508ZM8.25 13.2578V13.25C8.25 12.8358 8.58579 12.5 9 12.5C9.41421 12.5 9.75 12.8358 9.75 13.25V13.2578C9.74983 13.6719 9.41411 14.0078 9 14.0078C8.58589 14.0078 8.25017 13.6719 8.25 13.2578ZM16.4912 9.86914C16.4489 10.728 16.2585 11.574 15.9287 12.3701C15.5518 13.28 15.0001 14.1073 14.3037 14.8037C13.6073 15.5001 12.78 16.0518 11.8701 16.4287C11.074 16.7585 10.228 16.9489 9.36914 16.9912L9 17C8.01509 17 7.03982 16.8056 6.12988 16.4287C5.21999 16.0518 4.39269 15.5001 3.69629 14.8037C2.99988 14.1073 2.4482 13.28 2.07129 12.3701C1.74154 11.574 1.55111 10.728 1.50879 9.86914L1.5 9.5C1.5 8.51509 1.69438 7.53982 2.07129 6.62988C2.4482 5.71999 2.99988 4.8927 3.69629 4.19629C4.3927 3.49988 5.21999 2.9482 6.12988 2.57129C7.03982 2.19438 8.01509 2 9 2L9.36914 2.00879C10.228 2.05111 11.074 2.24154 11.8701 2.57129C12.78 2.9482 13.6073 3.49988 14.3037 4.19629C15.0001 4.89269 15.5518 5.71999 15.9287 6.62988C16.3056 7.53982 16.5 8.51509 16.5 9.5L16.4912 9.86914Z"
				fill="#646464" />
			<path
				d="M9.06048 4.97852C9.47838 4.97968 9.89107 5.07823 10.2646 5.26563C10.6379 5.45303 10.9632 5.72441 11.2138 6.0586C11.4644 6.39274 11.6336 6.78063 11.7089 7.19142C11.7842 7.60247 11.7633 8.02624 11.6474 8.42774C11.5315 8.82909 11.3237 9.1983 11.041 9.50587C10.7582 9.8134 10.4077 10.051 10.0175 10.2002C10.0114 10.2026 10.0052 10.2049 9.99896 10.207C9.92228 10.234 9.85655 10.2859 9.81146 10.3535C9.76648 10.421 9.74445 10.501 9.74896 10.582C9.77242 10.9956 9.45548 11.3506 9.04193 11.374C8.62859 11.3972 8.27436 11.0804 8.25091 10.667C8.22799 10.2614 8.33807 9.85955 8.56341 9.52149C8.78633 9.18712 9.11031 8.93288 9.48822 8.79688C9.65918 8.73042 9.81228 8.62533 9.93646 8.49024C10.062 8.35362 10.1545 8.19 10.206 8.01173C10.2575 7.83328 10.2668 7.64461 10.2333 7.46192C10.1999 7.27953 10.1248 7.10739 10.0136 6.95899C9.90217 6.81041 9.75774 6.68877 9.59173 6.60548C9.42574 6.5222 9.24229 6.47904 9.05658 6.47852C8.87103 6.47804 8.68775 6.52031 8.52142 6.60255C8.355 6.68489 8.20984 6.80523 8.09759 6.95313C7.8473 7.28303 7.37679 7.3478 7.04681 7.09767C6.71692 6.84737 6.65217 6.37686 6.90228 6.04688C7.15487 5.71396 7.48183 5.44413 7.85638 5.2588C8.23075 5.0736 8.64281 4.97743 9.06048 4.97852Z"
				fill="#646464" />
		</svg>

		<?php
}

function plmt_dark_info_card( $contact_content ) {
	?>
		<div class="h-full relative p-5 pt-12 lg:p-10 lg:pt-14 bg-mainBlack text-white" x-data="{filloutOpen: false}">
			<?php if ( $contact_content['bead'] ) : ?>
				<span>
					<div
						class="absolute top-3 right-0 bg-accent/15 text-accent text-bodySmall font-bold py-1 px-2 lg:top-4 lg:right-5">
						<?php esc_html_e( $contact_content['bead'] ); ?>
					</div>
				</span>
			<?php endif; ?>

			<div class="mb-5">
				<h3 class="mb-2 text-h5Bold lg:text-h4Regular"><?php esc_html_e( $contact_content['info_heading'] ) ?>
				</h3>
				<p class="text-textSecondary text-bodyRegular"><?php esc_html_e( $contact_content['info_text'] ) ?></p>
			</div>
			<?php plmt_button_with_arrow( "filloutOpen=true", esc_html__( 'Book Meeting', 'plmt' ), null, array(
				"classes" => "contact-button mb-5 bg-transparent border border-accent justify-between text-accent !h-auto py-4 px-6 text-title hover:text-white hover:bg-accent",
			) ) ?>
			<div class="flex flex-col xl:flex-row xl:items-center">
				<div class="flex items-center justify-between w-full">
					<a href="<?php echo esc_url( $contact_content['linkedin']['url'] ) ?>" target="_blank">
						<div>
							<div class="flex items-center gap-1">
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<g clip-path="url(#clip0_247_5748)">
										<path
											d="M13.8182 0H2.18182C1.60316 0 1.04821 0.229869 0.63904 0.63904C0.229869 1.04821 0 1.60316 0 2.18182L0 13.8182C0 14.3968 0.229869 14.9518 0.63904 15.361C1.04821 15.7701 1.60316 16 2.18182 16H13.8182C14.3968 16 14.9518 15.7701 15.361 15.361C15.7701 14.9518 16 14.3968 16 13.8182V2.18182C16 1.60316 15.7701 1.04821 15.361 0.63904C14.9518 0.229869 14.3968 0 13.8182 0ZM5.45455 12.6618C5.45467 12.7062 5.44603 12.7501 5.42913 12.7912C5.41224 12.8322 5.38741 12.8695 5.35608 12.9009C5.32475 12.9323 5.28753 12.9572 5.24655 12.9742C5.20557 12.9912 5.16164 13 5.11727 13H3.68C3.63556 13.0001 3.59153 12.9915 3.55044 12.9745C3.50936 12.9575 3.47203 12.9326 3.4406 12.9012C3.40917 12.8698 3.38427 12.8325 3.36732 12.7914C3.35036 12.7503 3.3417 12.7063 3.34182 12.6618V6.63636C3.34182 6.54667 3.37745 6.46065 3.44087 6.39723C3.50429 6.33381 3.59031 6.29818 3.68 6.29818H5.11727C5.20681 6.29842 5.29259 6.33416 5.35582 6.39755C5.41904 6.46095 5.45455 6.54683 5.45455 6.63636V12.6618ZM4.39818 5.72727C4.12848 5.72727 3.86484 5.6473 3.64059 5.49746C3.41634 5.34762 3.24156 5.13465 3.13835 4.88548C3.03514 4.63631 3.00813 4.36212 3.06075 4.0976C3.11336 3.83308 3.24324 3.59011 3.43395 3.3994C3.62465 3.20869 3.86763 3.07882 4.13215 3.0262C4.39667 2.97359 4.67085 3.00059 4.92002 3.1038C5.16919 3.20701 5.38217 3.38179 5.532 3.60604C5.68184 3.83029 5.76182 4.09393 5.76182 4.36364C5.76182 4.7253 5.61815 5.07214 5.36242 5.32787C5.10669 5.5836 4.75984 5.72727 4.39818 5.72727ZM12.9673 12.6855C12.9674 12.7263 12.9594 12.7668 12.9439 12.8046C12.9283 12.8424 12.9054 12.8767 12.8765 12.9056C12.8476 12.9345 12.8133 12.9574 12.7755 12.9729C12.7377 12.9885 12.6972 12.9965 12.6564 12.9964H11.1109C11.07 12.9965 11.0296 12.9885 10.9918 12.9729C10.954 12.9574 10.9197 12.9345 10.8908 12.9056C10.8619 12.8767 10.839 12.8424 10.8234 12.8046C10.8078 12.7668 10.7999 12.7263 10.8 12.6855V9.86273C10.8 9.44091 10.9236 8.01545 9.69727 8.01545C8.74727 8.01545 8.55364 8.99091 8.51545 9.42909V12.6891C8.51546 12.7708 8.48333 12.8492 8.426 12.9073C8.36868 12.9655 8.29076 12.9988 8.20909 13H6.71636C6.67558 13 6.63519 12.992 6.59752 12.9763C6.55985 12.9607 6.52564 12.9378 6.49684 12.9089C6.46804 12.88 6.44522 12.8457 6.4297 12.808C6.41417 12.7703 6.40624 12.7299 6.40636 12.6891V6.61C6.40624 6.56921 6.41417 6.5288 6.4297 6.49109C6.44522 6.45337 6.46804 6.41909 6.49684 6.39021C6.52564 6.36133 6.55985 6.33841 6.59752 6.32277C6.63519 6.30714 6.67558 6.29909 6.71636 6.29909H8.20909C8.29155 6.29909 8.37063 6.33185 8.42894 6.39015C8.48724 6.44846 8.52 6.52754 8.52 6.61V7.13545C8.87273 6.60545 9.39546 6.19818 10.5109 6.19818C12.9818 6.19818 12.9655 8.50546 12.9655 9.77273L12.9673 12.6855Z"
											fill="#3291F0" />
									</g>
									<defs>
										<clipPath id="clip0_247_5748">
											<rect width="16" height="16" fill="white" />
										</clipPath>
									</defs>
								</svg>
								<span class="text-title"><?php echo esc_html( $contact_content['info_name'] ) ?></span>
							</div>
							<p class="text-textSecondary text-bodySmall mt-1">
								<?php echo esc_html( $contact_content['info_occupation'] ) ?>
						</div>
					</a>
					<img src="<?php echo esc_url( $contact_content['info_image']['url'] ) ?>"
						alt="<?php echo esc_attr( $contact_content['info_image']['alt'] ) ?>"
						class="rounded-full w-[40px] h-[40px] border border-textSecondary">
				</div>
			</div>
			<?php get_template_part( 'template-parts/content/content-fillout-modal' ); ?>
		</div>
		<?php
}
function plmt_light_info_card( $contact_content ) {
	?>
		<div class="h-full relative p-5 pt-12 lg:p-10 lg:pt-14 bg-lightGrayBg" x-data="{strategyFilloutOpen: false}">
			<?php if ( $contact_content['bead'] ) : ?>
				<span>
					<div
						class="absolute top-3 right-0 bg-accent/15 text-accent text-bodySmall font-bold py-1 px-2 lg:top-4 lg:right-5">
						<?php esc_html_e( $contact_content['bead'] ); ?>
					</div>
				</span>
			<?php endif; ?>

			<div class="mb-5">
				<h3 class="mb-2 text-h5Bold lg:text-h4Regular"><?php esc_html_e( $contact_content['heading'] ) ?>
				</h3>
				<p class="text-darkGray text-bodyRegular"><?php esc_html_e( $contact_content['description'] ) ?></p>
			</div>
			<?php plmt_button_with_arrow( "strategyFilloutOpen=true", esc_html__( 'Book Strategy Session', 'plmt' ), null, array(
				"classes" => "contact-button mb-5 bg-transparent border border-accent justify-between text-accent !h-auto py-4 px-6 text-title hover:text-white hover:bg-accent",
			) ) ?>
			<p class="text-darkGray text-bodySmall">
				<?php esc_html_e( $contact_content['bottom_description'] ) ?>
			</p>
			<?php get_template_part( 'template-parts/content/content-strategy-modal' ); ?>
		</div>
		<?php
}