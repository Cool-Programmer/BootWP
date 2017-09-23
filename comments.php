<div class="comments">
	<?php if(have_comments()): ?>
		<h3 class="comments-title">
			<?php 
				if (get_comments_number() == 1) {
					echo get_comments_number() . ' comment';
				}else{
					echo get_comments_number() . ' comment';
				}
			?>
		</h3>

		<ul class="row comment-list">
			<?php 
				wp_list_comments([
					'avatar_size' => 90,
					'callback' => 'add_theme_comments'
				]);
			?>
		</ul>
	<?php endif; ?>

	<?php if(!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_tyle(), 'comments')): ?>
		<p class="no-comments"><?php echo __('Sorry, comments are closed', 'textdomain') ?></p>
	<?php endif; ?>
</div>

<hr>

<!-- Comment Form -->
<?php
 	$form_args = array(
        // change the title of send button 
        'label_submit'=>'Send',
        // change the title of the reply section
        'title_reply'=>'Write a Reply or Comment',
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => '',
        // redefine your own textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" cols="45" rows="8" name="comment" aria-required="true"></textarea></p>',
);

comment_form($form_args);