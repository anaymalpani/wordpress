<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function ultra_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'ultra_jetpack_setup' );
