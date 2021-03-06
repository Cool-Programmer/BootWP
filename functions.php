<?php 
	require_once 'wp-bootstrap-navwalker.php';
	require_once 'widgets/class-wp-widget-categories.php';
	require_once 'widgets/class-wp-widget-recent-posts.php';
	require_once 'widgets/class-wp-widget-recent-comments.php';

	function bootwp_theme_setup()
	{
		// Featured images
		add_theme_support('post-thumbnails');

		// Navigation
		register_nav_menus([
			'primary' => __('Primary')
		]);
	}

	add_action('after_setup_theme', 'bootwp_theme_setup');

	// Widgets
	function init_widgets($id)
	{
		register_sidebar([
			'name' => 'Sidebar',
			'id' => 'sidebar',
			'before_widget' => '<div class="panel panel-default">',
			'after_widget' => '</div>',
			'before_title' => '<div class="panel-heading"><h3 class="panel-title">',
			'after_title' => '</h3></div><div class="panel-body">'
		]);
	}

	add_action('widgets_init', 'init_widgets');

	// Custom widgets
	function custom_register_widgets()
	{
		register_widget('WP_Widget_Categories_Custom');
		register_widget('WP_Widget_Recent_Posts_Custom');
		register_widget('WP_Widget_Recent_Comments_Custom');
	}

	add_action('widgets_init', 'custom_register_widgets');

	// Add list-group-item to li in category widget
	function add_new_class_li_cats($list)
	{
		$list = str_replace('cat-item', 'cat-item list-group-item', $list);
		return $list;
	}

	add_filter('wp_list_categories', 'add_new_class_li_cats');


	// Needed for comments
	function add_theme_comments($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ('div' == $args['style']) {
			$tag = 'div';
			$add_below = 'comment';
		}else{
			$tag = 'li class="well comment-item"';
			$add_below = 'div-comment';
		}

		 ?><<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php
        /* translators: 1: date, 2: time */
        printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
        ?>
    </div>

    <?php comment_text(); ?>

    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
    }
	