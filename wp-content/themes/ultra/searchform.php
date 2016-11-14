<?php
/**
 * The template for displaying search forms.
 *
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'ultra' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'ultra' ); ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'ultra' ) ?>" />
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'ultra' ) ?>" />
</form>