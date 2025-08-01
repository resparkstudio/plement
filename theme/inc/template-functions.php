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
