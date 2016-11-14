<?php 
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!','biznez-lite'));
	if ( post_password_required() ) { ?>
<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','biznez-lite'); ?></p>
<?php
		return;
	}
?>
<!-- You can start editing here. -->
<div id="commentsbox" class="clearfix">
<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number(__('No Comments','biznez-lite'), __('One Comment','biznez-lite'), __('% Comments ','biznez-lite'));?><?php _e(' so far:','biznez-lite'); ?></h3>
	<ol class="commentlist">
		<?php wp_list_comments(); ?>
	</ol>
	<div class="comment-nav clearfix">
		<div class="alignleft">
			<?php previous_comments_link() ?>
		</div>
		<div class="alignright">
			<?php next_comments_link() ?>
		</div>
	</div>
<?php else : // this is displayed if there are no comments so far ?>
	<?php if ( ! comments_open() && ! is_page() ) : ?>
		<?php _e('Comments are closed.','biznez-lite'); ?>
	<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
	<div id="comment-form">
		<?php comment_form(); ?>
	</div>
<?php endif; // if you delete this the sky will fall on your head ?>
</div>
