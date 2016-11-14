<?php
    global $themeum;
    if (isset($themeum['disable_pjt_dsc'])) {
        $disable_pjt_dsc = $themeum['disable_pjt_dsc'];
    } else {
        $disable_pjt_dsc = 0;
    }

    if (!$disable_pjt_dsc) {
       $left_class      = 'col-sm-8';
       $right_class     = 'col-sm-4';
    }else{
        $left_class      = 'col-sm-12';
        $right_class     = 'display-none';
    }
?>
<?php while( have_posts() ): the_post(); ?>
<?php
	$project_client 		= get_post_meta($post->ID,'thm_project_client',true);
	$project_url 			= get_post_meta($post->ID,'thm_project_url',true);
	$project_date 			= get_post_meta($post->ID,'thm_project_date',true);
	$project_feedback 		= get_post_meta($post->ID,'thm_project_feedback',true);

	$terms = get_the_terms( $post->ID, 'project_tag' );

	$term_name = '';

	if ($terms)
	{
		foreach ( $terms as $term )
		{
			$term_name .= $term->slug.', ';
		}
	}
	$term_name = substr($term_name, 0, -2);
?>
<section id="single-portfolio">
	<div class="row">		  	
		<div class="col-xs-6 col-sm-8 cross-icon">
			<a class="close-folio-item" href="#"><span class="glyphicon glyphicon-remove"></span></a>
		</div>
		 <div class="col-xs-12 col-sm-4 social-networks">
		 	<div class="pull-right">
		 		<a href="#"><i class="fa fa-facebook"></i></a>
	            <a href="#"><i class="fa fa-twitter"></i></a>
	            <a href="#"><i class="fa fa-dribbble"></i></a>
	            <a href="#"><i class="fa fa-google-plus"></i></a>
		 	</div>		           
        </div>
	</div>
    <div id="portfolio-details">
        <div class="row">
            
        	<?php
        	if (has_post_thumbnail($post->ID))
        	{
        		$thumb 			= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
        	?>
    		<div class="col-sm-12">
    			<img class="img-responsive" src="<?php echo $thumb[0]; ?>" title="" alt="">
    		</div>
        	<?php
        	}
        	?>
            
            <div class="<?php echo $left_class; ?>">
                <div class="project-info">
                    <h2><?php the_title(); ?></h2>
                    <div class="entry-content">
                    	<?php the_content(); ?>
                    </div>
                </div>
            </div>

            <div class="<?php echo $right_class; ?>">
                <div class="project-details">
                    <h2>Project Details</h2>
                    <?php if($project_client != ''){?>
                    <p><span><?php _e('Client: ','themeum'); ?></span><?php echo $project_client; ?></p>
                    <?php } ?>

                    <?php if($project_date != ''){?>
                    <p><span><?php _e('Date: ','themeum'); ?></span><?php echo $project_date; ?></p>
                    <?php } ?>

                    <?php if($project_url != ''){?>
                    <p><span><?php _e('Web URL: ','themeum'); ?></span><?php echo $project_url; ?></p>
                    <?php } ?>

                    <?php if($term_name != ''){?>
                    <p><span><?php _e('Tag: ','themeum'); ?></span><?php echo $term_name; ?></p>
                    <?php } ?>
                </div>  
            </div>
        </div>
    </div>
    <?php if( $project_feedback != '' ){
    	echo $project_feedback;
    }?>
</section>

<?php endwhile; ?>