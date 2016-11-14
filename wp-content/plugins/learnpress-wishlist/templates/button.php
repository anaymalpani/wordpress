<?php
/**
 * Template for displaying button to toggle course wishlist on/off
 *
 * @author ThimPress
 */
defined( 'ABSPATH' ) || exit();
printf(
	'<button class="learn-press-course-wishlist-button-%2$d %s" data-id="%s" data-nonce="%s" title="%s" data-text="%s">%s</button>',
	join( " ", $classes ),
	$course_id,
	wp_create_nonce( 'course-toggle-wishlist' ),
	$title,
	__( 'Processing', 'learnpress-wishlist' ),
	$state == 'on' ? __( 'Remove from Wishlist', 'learnpress-wishlist' ) : __( 'Add to Wishlist', 'learnpress-wishlist' )
);