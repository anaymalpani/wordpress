<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ultra
 * @since ultra 0.9
 * @license GPL 2.0
 */

if ( ! function_exists( 'ultra_author_box' ) ) :
/**
 * Displays the author author biographical info on single posts.
 */
function ultra_author_box() { ?>
	<div class="author-box">
		<div class="author-avatar">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
			</a>
		</div><!-- .author-avatar -->
		<div class="author-description">
			<h3><?php echo get_the_author(); ?></h3>
			<span class="author-posts">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php esc_html_e( 'View posts by ', 'ultra' );
					echo get_the_author(); ?>
				</a>
			</span>	
			<div><?php echo wp_kses( get_the_author_meta( 'description' ), null ); ?></div>
		</div><!-- .author-description -->
	</div>
<?php }
endif;

if ( ! function_exists( 'ultra_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time, author, comment count and categories.
 */

function ultra_posted_on() {

	echo '<div class="entry-meta-inner">';

	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'ultra' ) . '</span>';
	}

	if ( is_home() && siteorigin_setting('blog_post_date') || is_archive() && siteorigin_setting('blog_post_date') || is_search() && siteorigin_setting('blog_post_date') ) {
		echo '<span class="entry-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date( 'j F Y' ) ) . '</time><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time></span></a>';
	}

	if ( is_single() && siteorigin_setting('blog_post_date') ) {
		echo '<span class="entry-date"><time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date( 'j F Y' ) ) . '</time><time class="updated" datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( get_the_modified_date() ) . '</time></span>';
	}

	if ( siteorigin_setting('blog_post_author') ) {
		echo '<span class="byline"><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . esc_html( get_the_author() ) . '</a></span></span>';
	}

	if ( comments_open() && siteorigin_setting('blog_post_comment_count') ) { 
		echo '<span class="comments-link">';
  		comments_popup_link( esc_html__( 'Leave a comment', 'ultra' ), esc_html__( '1 Comment', 'ultra' ), esc_html__( '% Comments', 'ultra' ) );
  		echo '</span>';
	}

	echo '</div>';

	if ( is_single() && siteorigin_setting( 'navigation_post_nav' ) ) {
		the_post_navigation( $args = array( 'prev_text' => '', 'next_text' => '', ) );
	}
}
endif;

if ( ! function_exists( 'ultra_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function ultra_entry_footer() {

	if ( is_single() && has_category() && siteorigin_setting( 'blog_post_cats' ) ) {
		echo '<span class="cat-links">' . get_the_category_list( esc_html__( ', ', 'ultra' ) ) . '</span>';
	}

	if ( is_single() && has_tag() && siteorigin_setting( 'blog_post_tags' ) ) {
		echo '<span class="tags-links">' . get_the_tag_list( '', esc_html__( ', ', 'ultra' ) ) . '</span>';
	}

	if ( siteorigin_setting( 'blog_edit_link' ) ) { 
		edit_post_link( esc_html__( 'Edit', 'ultra' ), '<span class="edit-link">', '</span>' ); 
	}	
}
endif;

if ( ! function_exists( 'ultra_display_logo' ) ) :
/**
 * Display the logo.
 */
function ultra_display_logo() {
	$logo = siteorigin_setting( 'header_logo' );
	$logo = apply_filters( 'ultra_logo_image_id', $logo );

	if ( empty( $logo ) ) {
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
			return;
		}

		// Just display the site title.
		$logo_html = '<h1 class="site-title">' . get_bloginfo( 'name' ) . '</h1>';
		$logo_html = apply_filters( 'ultra_logo_text', $logo_html );
	}
	else {
		// Load the logo image.
		if ( is_array( $logo ) ) {
			list ( $src, $height, $width ) = $logo;
		}
		else {
			$image = wp_get_attachment_image_src( $logo, 'full' );
			$src = $image[0];
			$height = $image[2];
			$width = $image[1];
		}

		// Add the logo attributes.
		$logo_attributes = apply_filters( 'ultra_logo_image_attributes', array(
			'src' => $src,
			'width' => round( $width ),
			'height' => round( $height ),
			'alt' => sprintf( esc_html__( '%s Logo', 'ultra' ), get_bloginfo( 'name' ) ),
		) );

		if ( siteorigin_setting( 'header_sticky' ) && siteorigin_setting( 'header_scale' ) ) $logo_attributes['data-scale'] = '1';

		$logo_attributes_str = array();
		if ( ! empty( $logo_attributes ) ) {
			foreach($logo_attributes as $name => $val) {
				if ( empty( $val ) ) continue;
				$logo_attributes_str[] = $name.'="'.esc_attr($val).'" ';
			}
		}

		$logo_html = apply_filters( 'ultra_logo_image', '<img '.implode( ' ', $logo_attributes_str ).' />' );
	}

	// Echo the image.
	echo apply_filters( 'ultra_logo_html', $logo_html );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function ultra_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'ultra_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ultra_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so ultra_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ultra_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in ultra_categorized_blog.
 */
function ultra_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ultra_categories' );
}
add_action( 'edit_category', 'ultra_category_transient_flusher' );
add_action( 'save_post',     'ultra_category_transient_flusher' );