<?php
	global $themename;
	global $shortname;
?>
<?php get_header(); ?>  
<!-- #Container Area -->
<div id="container" class="clearfix">
	<div class="container_24 clearfix">
		<!-- Content -->
		<div id="content" class="grid_24">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <?php if ( ! empty( $post->post_parent ) ) : ?>
      <div class="pagetitle-wrap clearfix"> <div class="page-title"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'biznez-lite' ), get_the_title( $post->post_parent ) ) ); ?>" data-rel="gallery">
        <?php 			/* translators: %s - title of parent post */
							printf( __( '<span class="meta-nav">&larr;</span> %s', 'biznez-lite' ), get_the_title( $post->post_parent ) );
		?>
        </a> </p>
      <?php endif; ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="title">
          <?php the_title(); ?>
        </h1>
        <div class="skepost-meta">
          <?php
							printf( __( '<span class="%1$s">by</span> %2$s', 'biznez-lite' ),
								'meta-prep meta-prep-author',
								sprintf( '<span class="author"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
									get_author_posts_url( get_the_author_meta( 'ID' ) ),
									sprintf( esc_attr__( 'View all posts by %s', 'biznez-lite' ), get_the_author() ),
									get_the_author()
								));
			?>
          <span class="skepost-meta-sep"> | </span>
          <?php
							printf( __( '<span class="%1$s">Published</span> %2$s', 'biznez-lite' ),
								'meta-prep meta-prep-ske-post-date',
								sprintf( '<span class="date"><abbr class="published" title="%1$s">%2$s</abbr></span>',
									esc_attr( get_the_time() ),
									get_the_date()
								));

							if ( wp_attachment_is_image() ) {
								echo ' <span class="skepost-meta-sep">|</span> ';
								$metadata = wp_get_attachment_metadata();
								printf( __( 'Full size is %s pixels', 'biznez-lite' ),
									sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
										wp_get_attachment_url(),
										esc_attr( __( 'Link to full-size image', 'biznez-lite' ) ),
										$metadata['width'],
										$metadata['height']
									));
							}
			?>
          <?php edit_post_link( __( 'Edit', 'biznez-lite' ), '<span class="skepost-meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
        </div>
        <!-- skepost-meta -->
        
        <div class="skepost">
          <div class="ske-post-attachment">
            <?php if ( wp_attachment_is_image() ) :


	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 image attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image attachment, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
            <p class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" data-rel="attachment">
              <?php
							$attachment_width  = apply_filters( 'sketch_attachment_size', 900 );
							$attachment_height = apply_filters( 'sketch_attachment_height', 900 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) ); // filterable image width with, essentially, no limit for image height.
			?>
              </a></p>
            <div id="nav-below" class="navigation">
              <div class="nav-previous">
                <?php previous_image_link( false, '&larr; Previous Image' ); ?>
              </div>
              <div class="nav-next">
                <?php next_image_link( false, 'Next Image &rarr;' ); ?>
              </div>
            </div>
            <!-- #nav-below -->
            
            <?php else : ?>
            <a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" data-rel="attachment"><?php echo basename( get_permalink() ); ?></a>
            <?php endif; ?>
          </div>
          <!-- .ske-post-attachment -->
          
          <div class="ske-post-caption">
            <?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?>
          </div>
          <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'biznez-lite' ) ); ?>
          <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'biznez-lite' ), 'after' => '</div>' ) ); ?>
        </div>
        <!-- .ske-post-content -->
        
        <div class="ske-post-utility">
          <?php edit_post_link( __( 'Edit', 'biznez-lite' ), ' <span class="edit-link">', '</span>' ); ?>
        </div>
        <!-- .ske-post-utility --> 
        
      </div>
      <!-- skepost -->
      
      <?php comments_template(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
    <!-- #content --> 
    
  </div>
  <!-- #container --> 
  
</div>
</div>
<?php get_footer(); ?>