<?php
/********************************************
Follow Us WIDGET START
*********************************************/
class SktFollowWidget extends WP_Widget {
        /**
    * Register widget with WordPress.
    */
    function __construct() {
        $widget_ops = array('classname' => 'SktFollowContact', 'description' => "Sketch Themes widget for Follow Us" );
        parent::__construct(
            'SktFollowWidget', // Base ID
            __('Follow Us - Biznez','biznez-lite'), // Name
           $widget_ops ); // Args
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		$title = esc_attr($instance['title']);
		if(empty($title))
		{
			$title=__('Get in Touch','biznez-lite');
		}				
		
		$follow_size = esc_attr($instance['follow_size'])."px ";
		if(empty($follow_size))
		{
			$follow_size=__('26px','biznez-lite');
		}
		if(isset($instance['follow_linkedin'])&&$instance['follow_linkedin']!=''){$follow_linkedin = esc_url($instance['follow_linkedin']); }
		if(isset($instance['follow_facebook'])&&$instance['follow_facebook']!=''){$follow_facebook = esc_url($instance['follow_facebook']); }
		if(isset($instance['follow_twitter'])&&$instance['follow_twitter']!=''){$follow_twitter = esc_url($instance['follow_twitter']); }
		if(isset($instance['follow_flickr'])&&$instance['follow_flickr']!=''){$follow_flickr = esc_url($instance['follow_flickr']); }
		if(isset($instance['follow_gplusicon'])&&$instance['follow_gplusicon']!=''){$follow_gplusicon = esc_url($instance['follow_gplusicon']); }
		if(isset($instance['follow_skype'])&&$instance['follow_skype']!=''){$follow_skype = $instance['follow_skype']; }
		if(isset($instance['follow_youtube'])&&$instance['follow_youtube']!=''){$follow_youtube = esc_url($instance['follow_youtube']); }
		if(isset($instance['follow_wordpress'])&&$instance['follow_wordpress']!=''){$follow_wordpress = esc_url($instance['follow_wordpress']); }
		if(isset($instance['follow_dribble'])&&$instance['follow_dribble']!=''){$follow_dribble = esc_url($instance['follow_dribble']); }
		if(isset($instance['follow_pinterest'])&&$instance['follow_pinterest']!=''){ $follow_pinterest = esc_url($instance['follow_pinterest']); }
		if(isset($instance['follow_vimeo'])&&$instance['follow_vimeo']!=''){ $follow_vimeo = esc_url($instance['follow_vimeo']); }
		if(isset($instance['follow_deviantart'])&&$instance['follow_deviantart']!=''){ $follow_deviantart = esc_url($instance['follow_deviantart']); }
		if(isset($instance['follow_tumblr'])&&$instance['follow_tumblr']!=''){$follow_tumblr = esc_url($instance['follow_tumblr']); }
		if(isset($instance['follow_stumbleupon'])&&$instance['follow_stumbleupon']!=''){$follow_stumbleupon = esc_url($instance['follow_stumbleupon']); }
		if(isset($instance['follow_picasa'])&&$instance['follow_picasa']!=''){$follow_picasa = esc_url($instance['follow_picasa']); }
		if(isset($instance['follow_friendfeed'])&&$instance['follow_friendfeed']!=''){$follow_friendfeed = esc_url($instance['follow_friendfeed']); }
		if(isset($instance['follow_slideshare'])&&$instance['follow_slideshare']!=''){$follow_slideshare = esc_url($instance['follow_slideshare']); }
		if(isset($instance['follow_behance'])&&$instance['follow_behance']!=''){$follow_behance = esc_url($instance['follow_behance']); }
		if(isset($instance['follow_github'])&&$instance['follow_github']!=''){$follow_github = esc_url($instance['follow_github']); }
		if(isset($instance['follow_reddit'])&&$instance['follow_reddit']!=''){$follow_reddit = esc_url($instance['follow_reddit']); }
		if(isset($instance['follow_foursquare'])&&$instance['follow_foursquare']!=''){$follow_foursquare = esc_url($instance['follow_foursquare']); }
		if(isset($instance['follow_digg'])&&$instance['follow_digg']!=''){$follow_digg = esc_url($instance['follow_digg']); }
		if(isset($instance['follow_delicious'])&&$instance['follow_delicious']!=''){$follow_delicious = esc_url($instance['follow_delicious']); }
		if(isset($instance['follow_vk'])&&$instance['follow_vk']!=''){$follow_vk = esc_url($instance['follow_vk']); }
		if(isset($instance['follow_instagram'])&&$instance['follow_instagram']!=''){$follow_instagram = esc_url($instance['follow_instagram']); }
        ?>
        <?php echo $before_widget; ?>
		<style  scoped>
			.follow-icons li{font-size:<?php echo $follow_size ?>;line-height:<?php echo $follow_size ?>;}
		</style>
		<?php 
        if($title)
        echo $before_title . $title . $after_title; 
        ?>
        <div class="follow-icons">
		<ul class="social clearfix"> 
		<?php if(isset($follow_linkedin)){ ?> <li class="linkedin-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_linkedin;?>" title="Linkedin"></a></li> <?php } ?>
		<?php if(isset($follow_facebook)){ ?> <li class="facebook-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_facebook;?>" title="Facebook"></a></li> <?php } ?>
		<?php if(isset($follow_twitter)){ ?> <li class="twitter-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_twitter;?>" title="Twitter"></a></li> <?php } ?>
		<?php if(isset($follow_flickr)){ ?> <li class="flickr-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_flickr;?>" title="Flickr"></a></li> <?php } ?>
		<?php if(isset($follow_gplusicon)){ ?> <li class="gplusicon-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_gplusicon;?>" title="Googleplus"></a></li> <?php } ?>
		<?php if(isset($follow_skype)){ ?> <li class="skype-icon"> <a class="tooltip" target="_blank" href="skype:<?php echo $follow_skype;?>?call" title="Skype"></a></li> <?php } ?>
		<?php if(isset($follow_youtube)){ ?> <li class="youtube-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_youtube;?>" title="Youtube"></a></li> <?php } ?>
		<?php if(isset($follow_wordpress)){ ?> <li class="wordpresse-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_wordpress;?>" title="Wordpress"></a></li> <?php } ?>
		<?php if(isset($follow_dribble)){ ?> <li class="dribble-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_dribble;?>" title="Dribble"></a></li> <?php } ?>
		<?php if(isset($follow_pinterest)){ ?> <li class="pinterest-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_pinterest;?>" title="Pinterest"></a></li> <?php } ?>
		<?php if(isset($follow_vimeo)){ ?> <li class="vimeo-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_vimeo;?>" title="Vimeo"></a></li> <?php } ?>
		<?php if(isset($follow_deviantart)){ ?> <li class="deviantart-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_deviantart;?>" title="Deviantart"></a></li> <?php } ?>
		<?php if(isset($follow_tumblr)){ ?> <li class="tumblr-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_tumblr;?>" title="Tumblr"></a></li> <?php } ?>
		<?php if(isset($follow_stumbleupon)){ ?> <li class="stumbleupon-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_stumbleupon;?>" title="Stumbleupon"></a></li> <?php } ?>
		<?php if(isset($follow_picasa)){ ?> <li class="picasa-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_picasa;?>" title="Picasa"></a></li> <?php } ?>
		<?php if(isset($follow_friendfeed)){ ?> <li class="friendfeed-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_friendfeed;?>" title="Friendfeed"></a></li> <?php } ?>
		<?php if(isset($follow_slideshare)){ ?> <li class="slideshare-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_slideshare;?>" title="Slideshare"></a></li> <?php } ?>
		<?php if(isset($follow_behance)){ ?> <li class="behance-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_behance;?>" title="Behance"></a></li> <?php } ?>
		<?php if(isset($follow_github)){ ?> <li class="github-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_github;?>" title="Github"></a></li> <?php } ?>
		<?php if(isset($follow_reddit)){ ?> <li class="reddit-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_reddit;?>" title="Reddit"></a></li> <?php } ?>
		<?php if(isset($follow_foursquare)){ ?> <li class="foursquare-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_foursquare;?>" title="Foursquare"></a></li> <?php } ?>
		<?php if(isset($follow_digg)){ ?> <li class="digg-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_digg;?>" title="Digg"></a></li> <?php } ?>
		<?php if(isset($follow_delicious)){ ?> <li class="delicious-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_delicious;?>" title="Delicious"></a></li> <?php } ?>
		<?php if(isset($follow_vk)){ ?> <li class="vk-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_vk;?>" title="vk"></a></li> <?php } ?>
		<?php if(isset($follow_instagram)){ ?> <li class="instagram-icon"> <a class="tooltip" target="_blank" href="<?php echo $follow_instagram;?>" title="instagram"></a></li> <?php } ?>
		 </ul>
        <div class="clear"></div>
        </div>
        
        <?php echo $after_widget; ?>
        <?php
    }
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['follow_linkedin'] = esc_url($new_instance['follow_linkedin']);
		$instance['follow_facebook'] = esc_url($new_instance['follow_facebook']);
		$instance['follow_twitter'] = esc_url($new_instance['follow_twitter']);
		$instance['follow_flickr'] = esc_url($new_instance['follow_flickr']);
		$instance['follow_gplusicon'] = esc_url($new_instance['follow_gplusicon']);
		$instance['follow_skype'] = $new_instance['follow_skype'];
		$instance['follow_youtube'] = esc_url($new_instance['follow_youtube']);
		$instance['follow_wordpress'] = esc_url($new_instance['follow_wordpress']);
		$instance['follow_dribble'] = esc_url($new_instance['follow_dribble']);
		$instance['follow_pinterest'] = esc_url($new_instance['follow_pinterest']);
		$instance['follow_vimeo'] = esc_url($new_instance['follow_vimeo']);
		$instance['follow_deviantart'] = esc_url($new_instance['follow_deviantart']);
		$instance['follow_tumblr'] = esc_url($new_instance['follow_tumblr']);
		$instance['follow_stumbleupon'] = esc_url($new_instance['follow_stumbleupon']);
		$instance['follow_picasa'] = esc_url($new_instance['follow_picasa']);
		$instance['follow_friendfeed'] = esc_url($new_instance['follow_friendfeed']);
		$instance['follow_slideshare'] = esc_url($new_instance['follow_slideshare']);
		$instance['follow_behance'] = esc_url($new_instance['follow_behance']);
		$instance['follow_github'] = esc_url($new_instance['follow_github']);
		$instance['follow_reddit'] = esc_url($new_instance['follow_reddit']);
		$instance['follow_foursquare'] = esc_url($new_instance['follow_foursquare']);
		$instance['follow_digg'] = esc_url($new_instance['follow_digg']);
		$instance['follow_delicious'] = esc_url($new_instance['follow_delicious']);
		$instance['follow_vk'] = esc_url($new_instance['follow_vk']);
		$instance['follow_instagram'] = esc_url($new_instance['follow_instagram']);

		$instance['follow_size'] = strip_tags($new_instance['follow_size']);
		
		
        return $instance;
    }
    /** @see WP_Widget::form */
    function form($instance) {
      if(isset($instance['title'])){
		$title = esc_attr($instance['title']);				
	}
     if(isset($instance['follow_linkedin'])){
			$follow_linkedin = esc_url($instance['follow_linkedin']);
        }
	 if(isset($instance['follow_facebook'])){
		$follow_facebook = esc_url($instance['follow_facebook']);
     }
	 if(isset($instance['follow_twitter'])){
		$follow_twitter = esc_url($instance['follow_twitter']);
    }
	 if(isset($instance['follow_flickr'])){
		$follow_flickr = esc_url($instance['follow_flickr']);
      }	  
	  if(isset($instance['follow_gplusicon'])){
		$follow_gplusicon = esc_url($instance['follow_gplusicon']);
      }
	  if(isset($instance['follow_skype'])){
		$follow_skype = $instance['follow_skype'];
      }
	  if(isset($instance['follow_youtube'])){
		$follow_youtube = esc_url($instance['follow_youtube']);
      }
	  if(isset($instance['follow_wordpress'])){
		$follow_wordpress = esc_url($instance['follow_wordpress']);
      }
	  if(isset($instance['follow_dribble'])){
		$follow_dribble = esc_url($instance['follow_dribble']);
      }
	  if(isset($instance['follow_pinterest'])){
		$follow_pinterest = esc_url($instance['follow_pinterest']);
      }
	  if(isset($instance['follow_vimeo'])){
		$follow_vimeo = esc_url($instance['follow_vimeo']);
      }
	  if(isset($instance['follow_deviantart'])){
		$follow_deviantart = esc_url($instance['follow_deviantart']);
      }
	  if(isset($instance['follow_tumblr'])){
		$follow_tumblr = esc_url($instance['follow_tumblr']);
      }
	  if(isset($instance['follow_stumbleupon'])){
		$follow_stumbleupon = esc_url($instance['follow_stumbleupon']);
      }
	  if(isset($instance['follow_picasa'])){
		$follow_picasa = esc_url($instance['follow_picasa']);
      }
	  if(isset($instance['follow_friendfeed'])){
		$follow_friendfeed = esc_url($instance['follow_friendfeed']);
      }
 	  if(isset($instance['follow_slideshare'])){
		$follow_slideshare = esc_url($instance['follow_slideshare']);
      }
 	  if(isset($instance['follow_behance'])){
		$follow_behance = esc_url($instance['follow_behance']);
      }
	  if(isset($instance['follow_github'])){
		$follow_github = esc_url($instance['follow_github']);
      }
      if(isset($instance['follow_reddit'])){
		$follow_reddit = esc_url($instance['follow_reddit']);
      }

	  if(isset($instance['follow_foursquare'])){
				$follow_foursquare = esc_url($instance['follow_foursquare']);
	  }
	  if(isset($instance['follow_digg'])){
				$follow_digg = esc_url($instance['follow_digg']);
	   }
	  if(isset($instance['follow_delicious'])){
				$follow_delicious = esc_url($instance['follow_delicious']);
	   }
	   if(isset($instance['follow_vk'])){
				$follow_vk = esc_url($instance['follow_vk']);
	   }
	   if(isset($instance['follow_instagram'])){
				$follow_instagram = esc_url($instance['follow_instagram']);
	   }
	   

	   if(isset($instance['follow_size'])){
		$follow_size = esc_attr($instance['follow_size']);
      }
        ?>
         <p>
         <label for="<?php echo $this->get_field_id('title'); ?>">
		 <?php _e('Title:','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)){ echo $title; } ?>" />
         </label></p>
		  <p>
         <label for="<?php echo $this->get_field_id('follow_size'); ?>"><?php _e('Icon size','biznez-lite'); ?> 
			<select id="<?php echo $this->get_field_id('follow_size'); ?>" name="<?php echo $this->get_field_name('follow_size'); ?>">
				<option <?php if(isset($instance['follow_size'])){ if ( '16' == $instance['follow_size'] ) echo 'selected="selected"'; } ?> value="16"><?php _e('16px','biznez-lite');?></option>
				<option <?php if(isset($instance['follow_size'])){ if ( '26' == $instance['follow_size'] ) echo 'selected="selected"'; } ?> value="26"><?php _e('26px','biznez-lite');?></option>
				<option <?php if(isset($instance['follow_size'])){ if ( '32' == $instance['follow_size'] ) echo 'selected="selected"'; } ?> value="32"><?php _e('32px','biznez-lite');?></option>
				<option <?php if(isset($instance['follow_size'])){ if ( '48' == $instance['follow_size'] ) echo 'selected="selected"'; } ?> value="48"><?php _e('48px','biznez-lite');?></option>
			</select>	
		 </label>
         </p>
         <p>
			<label for="<?php echo $this->get_field_id('follow_linkedin'); ?>"><?php _e('Link for Linkedin','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_linkedin'); ?>" name="<?php echo $this->get_field_name('follow_linkedin'); ?>" type="text" value="<?php if(isset($follow_linkedin)){ echo $follow_linkedin; }?>" /></label>
         </p>
         <p>
			<label for="<?php echo $this->get_field_id('follow_facebook'); ?>"><?php _e('Link for Facebook','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_facebook'); ?>" name="<?php echo $this->get_field_name('follow_facebook'); ?>" type="text" value="<?php if(isset($follow_facebook)){ echo $follow_facebook; }?>" /></label>
         </p>
         <p>
			<label for="<?php echo $this->get_field_id('follow_twitter'); ?>"><?php _e('Link for Twitter','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_twitter'); ?>" name="<?php echo $this->get_field_name('follow_twitter'); ?>" type="text" value="<?php if(isset($follow_twitter)){ echo $follow_twitter; }?>" /></label>
         </p>
         <p>
			<label for="<?php echo $this->get_field_id('follow_flickr'); ?>"><?php _e('Link for Flickr','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_flickr'); ?>" name="<?php echo $this->get_field_name('follow_flickr'); ?>" type="text" value="<?php if(isset($follow_flickr)){ echo $follow_flickr; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_gplusicon'); ?>"><?php _e('Link for Google+','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_gplusicon'); ?>" name="<?php echo $this->get_field_name('follow_gplusicon'); ?>" type="text" value="<?php if(isset($follow_gplusicon)){ echo $follow_gplusicon; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_skype'); ?>"><?php _e('Skype UserID','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_skype'); ?>" name="<?php echo $this->get_field_name('follow_skype'); ?>" type="text" value="<?php if(isset($follow_skype)){ echo $follow_skype; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_youtube'); ?>"><?php _e('Link for YouTube','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_youtube'); ?>" name="<?php echo $this->get_field_name('follow_youtube'); ?>" type="text" value="<?php if(isset($follow_youtube)){ echo $follow_youtube; }?>" /></label>
         </p>
		  <p>
			<label for="<?php echo $this->get_field_id('follow_wordpress'); ?>"><?php _e('Link for Wordpress','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_wordpress'); ?>" name="<?php echo $this->get_field_name('follow_wordpress'); ?>" type="text" value="<?php if(isset($follow_wordpress)){ echo $follow_wordpress; }?>" /></label>
         </p>
		  <p>
			<label for="<?php echo $this->get_field_id('follow_dribble'); ?>"><?php _e('Link for Dribble','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_dribble'); ?>" name="<?php echo $this->get_field_name('follow_dribble'); ?>" type="text" value="<?php if(isset($follow_dribble)){ echo $follow_dribble; }?>" /></label>
         </p>
		  <p>
			<label for="<?php echo $this->get_field_id('follow_pinterest'); ?>"><?php _e('Link for Pinterest','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_pinterest'); ?>" name="<?php echo $this->get_field_name('follow_pinterest'); ?>" type="text" value="<?php if(isset($follow_pinterest)){ echo $follow_pinterest; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_vimeo'); ?>"><?php _e('Link for Vimeo','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_vimeo'); ?>" name="<?php echo $this->get_field_name('follow_vimeo'); ?>" type="text" value="<?php if(isset($follow_vimeo)){ echo $follow_vimeo; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_deviantart'); ?>"><?php _e('Link for Deviantart','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_deviantart'); ?>" name="<?php echo $this->get_field_name('follow_deviantart'); ?>" type="text" value="<?php if(isset($follow_deviantart)){ echo $follow_deviantart; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_tumblr'); ?>"><?php _e('Link for Tumblr','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_tumblr'); ?>" name="<?php echo $this->get_field_name('follow_tumblr'); ?>" type="text" value="<?php if(isset($follow_tumblr)){ echo $follow_tumblr; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_stumbleupon'); ?>"><?php _e('Link for Stumbleupon','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_stumbleupon'); ?>" name="<?php echo $this->get_field_name('follow_stumbleupon'); ?>" type="text" value="<?php if(isset($follow_stumbleupon)){ echo $follow_stumbleupon; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_picasa'); ?>"><?php _e('Link for Picasa','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_picasa'); ?>" name="<?php echo $this->get_field_name('follow_picasa'); ?>" type="text" value="<?php if(isset($follow_picasa)){ echo $follow_picasa; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_friendfeed'); ?>"><?php _e('Link for Friendfeed','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_friendfeed'); ?>" name="<?php echo $this->get_field_name('follow_friendfeed'); ?>" type="text" value="<?php if(isset($follow_friendfeed)){ echo $follow_friendfeed; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_slideshare'); ?>"><?php _e('Link for Slideshare','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_slideshare'); ?>" name="<?php echo $this->get_field_name('follow_slideshare'); ?>" type="text" value="<?php if(isset($follow_slideshare)){ echo $follow_slideshare; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_behance'); ?>"><?php _e('Link for Behance','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_behance'); ?>" name="<?php echo $this->get_field_name('follow_behance'); ?>" type="text" value="<?php if(isset($follow_behance)){ echo $follow_behance; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_github'); ?>"><?php _e('Link for Github','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_github'); ?>" name="<?php echo $this->get_field_name('follow_github'); ?>" type="text" value="<?php if(isset($follow_github)){ echo $follow_github; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_reddit'); ?>"><?php _e('Link for Reddit','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_reddit'); ?>" name="<?php echo $this->get_field_name('follow_reddit'); ?>" type="text" value="<?php if(isset($follow_reddit)){ echo $follow_reddit; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_foursquare'); ?>"><?php _e('Link for Foursquar','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_foursquare'); ?>" name="<?php echo $this->get_field_name('follow_foursquare'); ?>" type="text" value="<?php if(isset($follow_foursquare)){ echo $follow_foursquare; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_digg'); ?>"><?php _e('Link for Digg','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_digg'); ?>" name="<?php echo $this->get_field_name('follow_digg'); ?>" type="text" value="<?php if(isset($follow_digg)){ echo $follow_digg; }?>" /></label>
         </p>
		 <p>
			<label for="<?php echo $this->get_field_id('follow_delicious'); ?>"><?php _e('Link for Delicious','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_delicious'); ?>" name="<?php echo $this->get_field_name('follow_delicious'); ?>" type="text" value="<?php if(isset($follow_delicious)){ echo $follow_delicious; }?>" /></label>
         </p>
          <p>
			<label for="<?php echo $this->get_field_id('follow_vk'); ?>"><?php _e('Link for vk','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_vk'); ?>" name="<?php echo $this->get_field_name('follow_vk'); ?>" type="text" value="<?php if(isset($follow_vk)){ echo $follow_vk; }?>" /></label>
         </p>
          <p>
			<label for="<?php echo $this->get_field_id('follow_instagram'); ?>"><?php _e('Link for instagram','biznez-lite'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_instagram'); ?>" name="<?php echo $this->get_field_name('follow_instagram'); ?>" type="text" value="<?php if(isset($follow_instagram)){ echo $follow_instagram; }?>" /></label>
         </p>
          
        <?php 
    }
}
add_action('widgets_init', create_function('', 'return register_widget("SktFollowWidget");'));
/********************************************
Follow us and contact WIDGET END
*********************************************/
