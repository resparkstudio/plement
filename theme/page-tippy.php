<?php
/**
 * Tippy page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Plement
 */

get_header();

?>
<div class="mx-auto w-[100px]">

	<button data-tippy-content="this is some content" class="tippy-test p-5 bg-blue-500 text-white my-10">
		<?php echo esc_html( 'hello' ) ?>
	</button>

</div>
<?php
get_footer();
?>